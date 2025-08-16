<?php

namespace App\Filament\Components;

use Filament\Forms;

class DomicilioForm
{
    public static function getSchema(): array
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
}
