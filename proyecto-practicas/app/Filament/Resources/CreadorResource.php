<?php

namespace App\Filament\Resources;

use App\Enums\Rol;
use App\Filament\Resources\CreadorResource\Pages;
use App\Models\Creador;
use Awcodes\Shout\Components\Shout;
use Filament\Forms;
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

class CreadorResource extends Resource
{
    protected static ?string $model = Creador::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Documentación';

    public static function getPluralModelLabel(): string
    {
        return 'creadores';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nombre')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Máximo 255 caracteres')
                    ->validationMessages([
                        'required' => 'Este campo es obligatorio',
                        'max' => 'Este campo no debe superar los 255 caracteres',
                    ]),
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
                ->label('Nombre')
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
            'index' => Pages\ListCreadors::route('/'),
            'create' => Pages\CreateCreador::route('/create'),
            'edit' => Pages\EditCreador::route('/{record}/edit'),
        ];
    }
}
