<?php

namespace App\Filament\Resources;

use App\Enums\Rol;
use App\Filament\Resources\TitulacionResource\Pages;
use App\Filament\Resources\TitulacionResource\RelationManagers\CursosRelationManager;
use App\Models\Asignatura;
use App\Models\Curso;
use App\Models\Titulacion;
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

class TitulacionResource extends Resource
{
    protected static ?string $model = Titulacion::class;

    public static function getPluralModelLabel(): string
    {
        return 'titulaciones';
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::getEloquentQuery();

        if (getUserRol() === Rol::TutorDocente) {
            return $query->whereHas('cursos.asignaturas.profesores', function ($q) {
                $q->where('users.id',getUserId());
            });
        }

        return $query;
    }


    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('id'),

                TextInput::make('nombre')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255)
                    ->disabled(fn () => getUserRol() !== Rol::Admin)
                    ->helperText('Máximo 255 caracteres')
                    ->validationMessages([
                        'required' => 'Este campo es obligatorio',
                        'max' => 'Este campo no debe superar los 255 caracteres',
                    ]),

                Select::make('cursos')
                    ->label('Cursos')
                    ->multiple()
                    ->disabled(fn () => getUserRol() !== Rol::Admin)
                    ->options(Curso::pluck('nombre', 'id'))
                    ->default(fn ($record) => $record?->cursos()->pluck('id')->toArray() ?? [])
                    ->preload()
                    ->required(),

                Shout::make('importante')
                    ->content('Rellene los campos obligatorios')
                    ->iconSize('xl')
                    ->color(Color::Zinc)
                    ->visible(fn (string $context) => $context === 'create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->visible(getUserRol() === Rol::Admin),

                TextColumn::make('nombre')
                    ->label('Nombre'),

                TextColumn::make('cursos')
                    ->label('Cursos')
                    ->getStateUsing(function ($record) {
                        return $record->cursos->pluck('nombre')->join(', ');
                    }),
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
            CursosRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTitulacions::route('/'),
            'create' => Pages\CreateTitulacion::route('/create'),
            'edit' => Pages\EditTitulacion::route('/{record}/edit'),
        ];
    }
}
