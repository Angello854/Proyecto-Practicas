<?php

namespace App\Filament\Resources;

use App\Enums\Rol;
use App\Filament\Resources\EmpresaResource\Pages;
use App\Filament\Resources\EmpresaResource\RelationManagers;
use App\Models\Empresa;
use App\Models\User;
use Awcodes\Shout\Components\Shout;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmpresaResource extends Resource
{
    protected static ?string $model = Empresa::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::getEloquentQuery();


        if (getUserRol() === Rol::TutorDocente) {
            // Obtener IDs de empresa de los alumnos que tutorea como tutor docente
            $empresaIds = \App\Models\Tutor::where('tutor_docente_id', getUserId())
                ->pluck('empresa_id');
            return $query->whereIn('id', $empresaIds);
        }

        if (getUserRol() === Rol::TutorLaboral) {
            // Obtener IDs de empresa de los alumnos que tutorea como tutor laboral
            $empresaIds = \App\Models\Tutor::where('tutor_laboral_id', getUserId())
                ->pluck('empresa_id');
            return $query->whereIn('id', $empresaIds);
        }

        return $query;
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('id'),

                TextInput::make('nombre')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Máximo 255 caracteres')
                    ->validationMessages([
                        'required' => 'Este campo es obligatorio',
                        'max' => 'Este campo no debe superar los 255 caracteres',
                    ]),

                Select::make('tutor_laboral_id')
                    ->label('Tutor Laboral')
                    ->options(fn () => User::where('rol', 'tutor_laboral')->pluck('name', 'id'))
                    ->searchable()
                    ->dehydrated()
                    ->validationMessages([
                        'required' => 'Este campo es obligatorio',
                    ])
                    ->required(),

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
                TextColumn::make('id')->label('ID')
                    ->visible(getUserRol() === Rol::Admin),

                TextColumn::make('nombre')->label('Nombre'),

                TextColumn::make('tutorLaboral.name')
                    ->label('Tutor Laboral'),

                TextColumn::make('tutorLaboral.email')
                    ->label('Correo'),
            ])
            ->filters([
                //
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmpresas::route('/'),
            'create' => Pages\CreateEmpresa::route('/create'),
            'edit' => Pages\EditEmpresa::route('/{record}/edit'),
        ];
    }
}
