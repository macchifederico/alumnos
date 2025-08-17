<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DomicilioResource\Pages;
use App\Filament\Resources\DomicilioResource\RelationManagers;
use App\Models\Domicilio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DomicilioResource extends Resource
{
    protected static ?string $model = Domicilio::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $navigationLabel = 'Domicilios';
    protected static ?string $modelLabel = 'Domicilio';
    protected static ?string $pluralModelLabel = 'Domicilios';
    protected static bool $shouldRegisterNavigation = false; // Cambiar a true si quieres que aparezca en el menú

    public static function form(Form $form): Form
    {
        return $form
            ->schema(self::getFormSchema());
    }

    /**
     * Schema reutilizable para formularios de domicilio
     */
    public static function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('calle')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('numero')
                ->label('Número')
                ->required()
                ->numeric()
                ->maxLength(10),
            Forms\Components\TextInput::make('piso')
                ->numeric()
                ->maxLength(10),
            Forms\Components\TextInput::make('departamento')
                ->maxLength(10),
            Forms\Components\TextInput::make('localidad')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('ciudad')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('provincia')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('codigo_postal')
                ->label('Código Postal')
                ->required()
                ->maxLength(10),
            Forms\Components\TextInput::make('pais')
                ->label('País')
                ->default('Argentina')
                ->required()
                ->maxLength(255),
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('calle')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('numero')
                    ->label('Número')
                    ->sortable(),
                Tables\Columns\TextColumn::make('localidad')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ciudad')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('provincia')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('codigo_postal')
                    ->label('Código Postal')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pais')
                    ->label('País')
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('provincia')
                    ->options([
                        'Buenos Aires' => 'Buenos Aires',
                        'CABA' => 'CABA',
                        'Córdoba' => 'Córdoba',
                        'Santa Fe' => 'Santa Fe',
                        // Agregar más provincias según necesidad
                    ]),
                Tables\Filters\SelectFilter::make('pais')
                    ->options([
                        'Argentina' => 'Argentina',
                        'Chile' => 'Chile',
                        'Uruguay' => 'Uruguay',
                        'Brasil' => 'Brasil',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListDomicilios::route('/'),
            'create' => Pages\CreateDomicilio::route('/create'),
            'edit' => Pages\EditDomicilio::route('/{record}/edit'),
        ];
    }
}
