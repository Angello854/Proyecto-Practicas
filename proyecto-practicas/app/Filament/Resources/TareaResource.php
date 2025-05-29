<?php

namespace App\Filament\Resources;

use App\Enums\Rol;
use App\Filament\Resources\TareaResource\Actions\ExportarTareaLatexPDF;
use App\Filament\Resources\TareaResource\Pages;

use App\Models\Asignatura;
use App\Models\Tarea;
use Awcodes\Shout\Components\Shout;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Symfony\Component\Process\Process;


class TareaResource extends Resource
{
    protected static ?string $model = Tarea::class;

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';




    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::getEloquentQuery();

        $usuario = auth()->user();

        if (getUserRol() === Rol::Alumno) {
            return $query->where('alumno_id', getUserId());
        }

        if (getUserRol() === Rol::TutorDocente) {
            // 1. Alumnos donde es tutor docente
            $alumnoIdsTutor = \App\Models\Tutor::where('tutor_docente_id', getUserId())
                ->pluck('alumno_id');

            // 2. Alumnos que tiene como profesor (relación alumno_profesor)
            $alumnoIdsProfesor = $usuario->alumnos()->pluck('users.id'); // relación definida en el modelo

            // 3. Tareas relacionadas con asignaturas que imparte
            $asignaturaIds = $usuario->asignaturas()->pluck('asignaturas.id');

            // 4. Tareas que estén en asignaturas que imparte
            $tareaIdsPorAsignaturas = \App\Models\Tarea::whereHas('asignaturas', function ($q) use ($asignaturaIds) {
                $q->whereIn('asignaturas.id', $asignaturaIds);
            })->pluck('id');

            // 5. Combinar: tareas de alumnos tutorizados o tareas de alumnos que le pertenecen como profesor y estén en asignaturas suyas
            return $query->where(function ($subQuery) use ($alumnoIdsTutor, $alumnoIdsProfesor, $tareaIdsPorAsignaturas) {
                $subQuery->whereIn('alumno_id', $alumnoIdsTutor)
                    ->orWhere(function ($q) use ($alumnoIdsProfesor, $tareaIdsPorAsignaturas) {
                        $q->whereIn('alumno_id', $alumnoIdsProfesor)
                            ->whereIn('id', $tareaIdsPorAsignaturas);
                    });
            });
        }

        if (getUserRol() === Rol::TutorLaboral) {
            $alumnoIds = \App\Models\Tutor::where('tutor_laboral_id', $usuario->id)->pluck('alumno_id');
            return $query->whereIn('alumno_id', $alumnoIds);
        }

        return $query;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('id'),

                TextInput::make('descripcion')
                    ->label('Descripción')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Máximo 255 caracteres')
                    ->validationMessages([
                        'required' => 'Este campo es obligatorio',
                        'max' => 'Este campo no debe superar los 255 caracteres',
                    ]),

                TextInput::make('aprendizaje')
                    ->label('Aprendizaje')
                    ->maxLength(255)
                    ->helperText('Máximo 255 caracteres')
                    ->validationMessages([
                        'max' => 'Este campo no debe superar los 255 caracteres',
                    ]),

                TextInput::make('refuerzo')
                    ->label('Refuerzo')
                    ->maxLength(255)
                    ->helperText('Máximo 255 caracteres')
                    ->validationMessages([
                        'max' => 'Este campo no debe superar los 255 caracteres',
                    ]),

                DatePicker::make('fecha')
                    ->label('Fecha')
                    ->default(now())
                    ->displayFormat('d/m/Y')
                    ->required()
                    ->validationMessages([
                        'required' => 'Este campo es obligatorio',
                    ]),

                Select::make('horas')
                    ->label('Horas')
                    ->options([
                        '0.5' => '30 min',
                        '1' => '1 hora',
                        '1.5' => '1 hora y 30 min',
                        '2' => '2 horas ',
                        '2.5' => '2 hora y 30 min',
                        '3' => '3 horas',
                        '3.5' => '3 hora y 30 min',
                        '4' => '4 horas',
                        '4.5' => '4 hora y 30 min',
                        '5' => '5 horas',
                        '5.5' => '5 hora y 30 min',
                        '6' => '6 horas',
                    ])
                    ->required()
                    ->dehydrateStateUsing(fn ($state) => (float) $state)
                    ->validationMessages([
                        'required' => 'Este campo es obligatorio',
                    ]),

                Select::make('materiales')
                    ->label('Material utilizado')
                    ->options([
                        'equipo propio' => 'Equipo propio',
                        'ordenador empresa' => 'Equipo empresa',
                    ])
                    ->required()
                    ->validationMessages([
                        'required' => 'Este campo es obligatorio',
                    ]),

                TiptapEditor::make('comentarios')
                    ->label('Comentarios')
                    ->extraInputAttributes(['style' => 'min-height: 11rem;'])
                    ->profile('default')
                    ->disableFloatingMenus()
                    ->disableBubbleMenus()
                    ->placeholder('Comenta la tarea con detalle')
                    ->disk('public')
                    ->acceptedFileTypes(['image/jfif','image/jpeg', 'image/png', 'image/webp', 'image/svg+xml', 'application/latex']),

                CheckboxList::make('asignaturas')
                    ->label('Asignaturas')
                    ->options(Asignatura::pluck('nombre', 'id')->toArray())
                    ->columns(2),

                Shout::make('importante')
                    ->content('Rellene los campos obligatorios')
                    ->iconSize('xl')
                    ->visible(fn (string $context) => $context === 'create')
                    ->color(Color::Zinc),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->visible(getUserRol() === Rol::Admin),

                TextColumn::make('descripcion')
                    ->label('Descripción'),

                TextColumn::make('fecha')
                    ->label('Fecha')
                    ->dateTime('d/m/Y'),

                TextColumn::make('asignaturas')
                    ->label('Asignaturas')
                    ->getStateUsing(function ($record) {
                        return $record->asignaturas->pluck('nombre')->join(', ');
                    }),

                TextColumn::make('aprendizaje')
                    ->label('Aprendizaje'),

                TextColumn::make('refuerzo')
                    ->label('Refuerzo'),

                TextColumn::make('horas')
                    ->label('Horas'),

                TextColumn::make('materiales')
                    ->label('Materiales')
                    ->formatStateUsing(fn($state) =>
                    $state === 'equipo propio' ? 'Equipo Propio' :
                        ($state === 'ordenador empresa' ? 'Equipo Empresa' : $state)),

                TextColumn::make('comentarios')
                    ->label('Comentarios'),

                TextColumn::make('usuario.name')
                    ->label('Alumno')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn ($state, $record) => $record->rol !== \App\Enums\Rol::Alumno ? $state : null)
                    ->visible(getUserRol() !== Rol::Alumno),
            ])
            ->filters([

            ])
            ->actions([
                Tables\Actions\EditAction::make(),

                ExportarTareaLatexPDF::make('exportar_pdf_tarea'),


            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportarTareaLatexPDF::makeBulk('exportar_pdf_tarea_bulk'),
                ]),
                ExportBulkAction::make()->exports([
                    ExcelExport::make()
                        ->withFilename(function () {
                            return 'Tarea - ' . getUserName();
                        })
                        ->fromTable()
                        ->except([
                            'id',
                        ]),
                ])
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTareas::route('/'),
            'create' => Pages\CreateTarea::route('/create'),
            'edit' => Pages\EditTarea::route('/{record}/edit'),
        ];
    }
}
