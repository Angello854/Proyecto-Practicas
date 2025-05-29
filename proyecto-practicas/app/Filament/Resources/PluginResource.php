<?php

namespace App\Filament\Resources;

use App\Enums\Rol;
use App\Filament\Resources\PluginResource\Pages;
use App\Models\Plugin;
use Awcodes\Shout\Components\Shout;
use Filament\Forms;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PluginResource extends Resource
{
    protected static ?string $model = Plugin::class;

    protected static ?string $navigationIcon = 'heroicon-o-plus';

    protected static ?string $navigationGroup = 'Documentación';

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

                Select::make('creador_id')
                    ->label('Creador')
                    ->relationship('creador', 'nombre')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->validationMessages([
                        'required' => 'Este campo es obligatorio',
                    ]),

                Radio::make('entorno')
                    ->label('Entorno')
                    ->options([
                        'laravel' => 'Laravel',
                        'filament' => 'Filament',
                    ])
                    ->required()
                    ->validationMessages([
                        'required' => 'Este campo es obligatorio',
                    ]),

                RichEditor::make('descripcion')
                ->label('Descripcion'),
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

                TextColumn::make('descripcion')
                    ->label('Descripcion'),

                TextColumn::make('creador.nombre')
                    ->label('Creador'),

                TextColumn::make('entorno')
                    ->label('Entorno')
                    ->formatStateUsing(fn (string $state) => ucfirst($state))
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListPlugins::route('/'),
            'create' => Pages\CreatePlugin::route('/create'),
            'edit' => Pages\EditPlugin::route('/{record}/edit'),
        ];
    }
}
