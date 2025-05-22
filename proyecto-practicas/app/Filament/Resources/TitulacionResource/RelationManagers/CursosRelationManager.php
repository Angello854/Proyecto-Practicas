<?php

namespace App\Filament\Resources\TitulacionResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CursosRelationManager extends RelationManager
{
    protected static string $relationship = 'cursos';
    protected static ?string $title = 'Cursos';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nombre')
                    ->label('Nombre')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Cursos')
            ->columns([
                TextColumn::make('nombre'),

                TextColumn::make('asignaturas')
                    ->label('Asignaturas')
                    ->getStateUsing(function ($record) {
                        return $record->asignaturas->pluck('nombre')->join(', ');
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
            ])
            ->actions([
            ])
            ->bulkActions([
            ]);
    }
}
