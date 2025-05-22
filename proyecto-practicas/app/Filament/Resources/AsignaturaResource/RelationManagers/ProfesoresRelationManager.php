<?php

namespace App\Filament\Resources\AsignaturaResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProfesoresRelationManager extends RelationManager
{
    protected static string $relationship = 'profesores';
    protected static ?string $title = 'Profesores';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Profesores')
            ->columns([
                TextColumn::make('name'),

                TextColumn::make('email')
                    ->label('Email')
                    ->copyable()
                    ->copyMessage('Email address copied')
                    ->copyMessageDuration(1500)
                    ->icon('heroicon-m-envelope'),

                TextColumn::make('telefono')
                    ->label('Teléfono'),
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
