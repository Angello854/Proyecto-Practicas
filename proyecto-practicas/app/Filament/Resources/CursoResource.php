<?php

namespace App\Filament\Resources;

use App\Enums\Rol;
use App\Filament\Resources\CursoResource\Pages;
use App\Filament\Resources\CursoResource\RelationManagers\AsignaturasRelationManager;
use App\Models\Asignatura;
use App\Models\Curso;
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

class CursoResource extends Resource
{
    protected static ?string $model = Curso::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::getEloquentQuery();

        if (getUserRol() === Rol::TutorDocente) {
            return $query->whereHas('asignaturas.profesores', function ($q) {
                $q->where('users.id', getUserId());
            });
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
                ->disabled(fn () => getUserRol() !== Rol::Admin)
                ->validationMessages([
                    'required' => 'Este campo es obligatorio.',
                ]),

                Select::make('asignaturas')
                    ->label('Asignaturas')
                    ->multiple()
                    ->disabled(fn () => getUserRol() !== Rol::Admin)
                    ->options(Asignatura::pluck('nombre', 'id'))
                    ->default(fn ($record) => $record?->asignaturas()->pluck('id')->toArray() ?? [])
                    ->preload()
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
                TextColumn::make('id')
                    ->label('ID')
                    ->visible(getUserRol() === Rol::Admin),

                TextColumn::make('nombre')
                    ->label('Nombre'),

                TextColumn::make('asignaturas')
                    ->label('Asignaturas')
                    ->getStateUsing(function ($record) {
                        return $record->asignaturas->pluck('nombre')->join(', ');
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
            AsignaturasRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCursos::route('/'),
            'create' => Pages\CreateCurso::route('/create'),
            'edit' => Pages\EditCurso::route('/{record}/edit'),
        ];
    }
}
