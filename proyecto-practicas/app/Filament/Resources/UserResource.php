<?php

namespace App\Filament\Resources;

use App\Enums\Rol;
use App\Filament\Resources\UserResource\Pages;
use App\Models\Empresa;
use App\Models\User;
use Awcodes\Shout\Components\Shout;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    public static function getModelLabel(): string
    {
        return 'usuario';
    }

    public static function getPluralModelLabel(): string
    {
        return 'usuarios';
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::getEloquentQuery();

        if (getUserRol() === Rol::TutorDocente) {

            $alumnoIdsPorTutoria = \App\Models\Tutor::where('tutor_docente_id', getUserId())
                ->pluck('alumno_id');

            $alumnoIdsPorDocencia = DB::table('alumno_profesor')
                ->where('profesor_id', getUserId())
                ->pluck('alumno_id');

            $alumnoIds = $alumnoIdsPorTutoria
                ->merge($alumnoIdsPorDocencia)
                ->unique();

            return $query->whereIn('id', $alumnoIds);
        }

        if (getUserRol() === Rol::TutorLaboral) {
            $alumnoIds = \App\Models\Tutor::where('tutor_laboral_id', getUserId())->pluck('alumno_id');
            return $query->whereIn('id', $alumnoIds);
        }

        return $query;
    }
    protected static ?string $navigationIcon = 'heroicon-o-identification';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('id')
                    ->label('ID')
                    ->disabled()
                    ->visible(fn ($get, $state, $context) => $context === 'edit' && $get('rol') === 'alumno'),

                TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Máximo 255 caracteres')
                    ->validationMessages([
                        'required' => 'Este campo es obligatorio',
                        'max' => 'Este campo no debe superar los 255 caracteres',
                    ]),

                TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->helperText('Máximo 255 caracteres')
                    ->validationMessages([
                        'required' => 'Este campo es obligatorio',
                        'max' => 'Este campo no debe superar los 255 caracteres',
                        'unique' => 'Este correo ya está en uso',
                    ]),

                TextInput::make('password')
                    ->label('Contraseña')
                    ->password()
                    ->required(fn (string $context) => $context === 'create')
                    ->dehydrateStateUsing(fn ($state) => $state ? Hash::make($state) : null)
                    ->dehydrated(fn ($state) => filled($state))
                    ->maxLength(255)
                    ->validationMessages([
                        'required' => 'Este campo es obligatorio',
                    ]),

                TextInput::make('telefono')
                    ->label('Teléfono')
                    ->maxLength(20)
                    ->helperText('Máximo 20 caracteres')
                    ->validationMessages([
                        'max' => 'Este campo no debe superar los 20 caracteres',
                    ]),

                Select::make('rol')
                    ->label('Roles')
                    ->options(Rol::class)
                    ->columns(1)
                    ->required()
                    ->live()
                    ->reactive()
                    ->helperText('Si selecciona el rol de alumno existen sorpresas')
                    ->validationMessages([
                        'required' => 'Este campo es obligatorio',
                    ]),

                Select::make('tutor_docente_id')
                    ->label('Tutor Docente')
                    ->options(fn () => User::where('rol', Rol::TutorDocente->value)->pluck('name', 'id'))
                    ->required(fn ($get) => $get('rol') === 'alumno')
                    ->visible(fn ($get) => $get('rol') === 'alumno')
                    ->searchable()
                    ->live()
                    ->dehydrated()
                    ->reactive()
                    ->validationMessages([
                        'required' => 'Este campo es obligatorio',
                    ]),

                Select::make('tutor_laboral_id')
                    ->label('Tutor Laboral')
                    ->options(fn () => User::where('rol', Rol::TutorLaboral->value)->pluck('name', 'id'))
                    ->required(fn ($get) => $get('rol') === 'alumno')
                    ->visible(fn ($get) => $get('rol') === 'alumno')
                    ->searchable()
                    ->live()
                    ->dehydrated()
                    ->reactive()
                    ->validationMessages([
                        'required' => 'Este campo es obligatorio',
                    ]),

                Select::make('empresa_id')
                    ->label('Empresa')
                    ->options(fn () => Empresa::pluck('nombre', 'id'))
                    ->required(fn ($get) => $get('rol') === 'alumno')
                    ->visible(fn ($get) => $get('rol') === 'alumno')
                    ->searchable()
                    ->live()
                    ->dehydrated()
                    ->reactive()
                    ->validationMessages([
                        'required' => 'Este campo es obligatorio',
                    ]),
                Select::make('profesores')
                    ->label('Profesores')
                    ->multiple()
                    ->options(function () {
                        return User::where('rol', Rol::TutorDocente->value)->pluck('name', 'id');
                    })
                    ->visible(fn (callable $get) => $get('rol') === 'alumno')
                    ->preload()
                    ->searchable()
                    ->reactive()
                    ->live(),

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

                TextColumn::make('name')
                    ->label('Nombre'),

                TextColumn::make('email')
                    ->label('Email')
                    ->copyable()
                    ->copyMessage('Email address copied')
                    ->copyMessageDuration(1500)
                    ->icon('heroicon-m-envelope'),

                TextColumn::make('rol')
                    ->label('Rol')
                    ->badge(),

                TextColumn::make('telefono')
                    ->label('Teléfono'),

                TextColumn::make('tutor.tutorDocente.name')
                    ->label('Tutor Docente')
                    ->formatStateUsing(fn ($state, $record) => $record->tutor && $record->tutor->tutorDocente ? $record->tutor->tutorDocente->name : '-'),

                TextColumn::make('tutor.tutorLaboral.name')
                    ->label('Tutor Laboral')
                    ->formatStateUsing(fn ($state, $record) => $record->tutor && $record->tutor->tutorLaboral ? $record->tutor->tutorLaboral->name : '-'),

                TextColumn::make('tutor.empresa.nombre')
                    ->label('Empresa')
                    ->formatStateUsing(fn ($state, $record) => $record->tutor && $record->tutor->empresa ? $record->tutor->empresa->nombre : '-'),

                TextColumn::make('profesores')
                    ->label('Profesores')
                    ->getStateUsing(function ($record) {
                        return $record->profesores->pluck('name')->join(', ');
                    }),

                TextColumn::make('two_factor_secret')->label('Verificado')
                    ->badge()
                    ->color(fn ($record) => $record->sesion?->two_factor_secret? 'success' : 'danger')
                    ->formatStateUsing(fn ($record) => $record->sesion?->two_factor_secret? 'Sí' : 'No'),


            ])
            ->filters([
                SelectFilter::make('rol')
                    ->label('Rol')
                    ->options([
                        'alumno' => 'Alumno',
                        'tutor docente' => 'Tutor Docente',
                        'tutor laboral' => 'Tutor Laboral',
                    ])

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return[];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
