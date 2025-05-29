<?php

namespace App\Filament\Resources;

use App\Enums\Rol;
use App\Filament\Resources\AsignaturaResource\Pages;
use App\Filament\Resources\AsignaturaResource\RelationManagers\ProfesoresRelationManager;
use App\Models\Asignatura;
use App\Models\User;
use Awcodes\Shout\Components\Shout;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Filament\Resources\AsignaturaResource\RelationManagers;

class AsignaturaResource extends Resource
{
    protected static ?string $model = Asignatura::class;

    protected static ?string $relationship = 'profesores';
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::getEloquentQuery();

        if (getUserRol() === Rol::TutorDocente) {
            return $query->whereHas('profesores', function ($q) {
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
                    ->maxLength(255)
                    ->helperText('Máximo 255 caracteres')
                    ->validationMessages([
                        'max' => 'Este campo no debe superar los 255 caracteres',
                        'required' => 'Este campo es obligatorio',
                    ]),

                Select::make('profesores')
                    ->label('Profesores')
                    ->multiple()
                    ->disabled(fn () => getUserRol() !== Rol::Admin)
                    ->options(User::where('rol', 'tutor_docente')->pluck('name', 'id'))
                    ->default(fn ($record) => $record?->profesores()->pluck('id')->toArray() ?? [])
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

                TextColumn::make('profesores')
                    ->label('Profesores')
                    ->getStateUsing(function ($record) {
                        return $record->profesores->pluck('name')->join(', ');
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
            ProfesoresRelationManager::class
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAsignaturas::route('/'),
            'create' => Pages\CreateAsignatura::route('/create'),
            'edit' => Pages\EditAsignatura::route('/{record}/edit'),
        ];
    }
}
