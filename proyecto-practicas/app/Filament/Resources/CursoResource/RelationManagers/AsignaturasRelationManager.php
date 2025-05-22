<?php

namespace App\Filament\Resources\CursoResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AsignaturasRelationManager extends RelationManager
{
    protected static string $relationship = 'asignaturas';
    protected static ?string $title = 'Asignaturas';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Asignaturas')
            ->columns([
                TextColumn::make('nombre'),

                TextColumn::make('profesores')
                    ->label('Profesores')
                    ->getStateUsing(function ($record) {
                        return $record->profesores->pluck('name')->join(', ');
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
