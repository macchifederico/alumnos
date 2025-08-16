<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CursoResource\Pages;
use App\Filament\Resources\CursoResource\RelationManagers;
use App\Models\Curso;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CursoResource extends Resource
{
    protected static ?string $model = Curso::class;
    // protected static bool $shouldRegisterNavigation = false;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Información del Curso')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('nombre')
                            ->required()
                            ->maxLength(255)
                            ->label('Nombre del Curso'),
                        Forms\Components\TextInput::make('materia')
                            ->required()
                            ->maxLength(255)
                            ->label('Materia'),
                        Forms\Components\TextInput::make('facultad')
                            ->required()
                            ->maxLength(255)
                            ->label('Facultad'),
                        Forms\Components\TextInput::make('vigencia')
                            ->required()
                            ->maxLength(255)
                            ->label('Vigencia'),
                        Forms\Components\TextInput::make('precio')
                            ->required()
                            ->numeric()
                            ->maxLength(10)
                            ->label('Precio'),
                        Forms\Components\Select::make('tipo')
                            ->options([
                                'presencial' => 'Presencial',
                                'virtual' => 'Virtual',
                                'hibrido' => 'Híbrido',
                            ])
                            ->required()
                            ->label('Tipo de Curso'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->sortable()
                    ->searchable()
                    ->label('Nombre del Curso'),
                Tables\Columns\TextColumn::make('materia')
                    ->sortable()
                    ->searchable()
                    ->label('Materia'),
                Tables\Columns\TextColumn::make('facultad')
                    ->sortable()
                    ->searchable()
                    ->label('Facultad'),
                Tables\Columns\TextColumn::make('vigencia')
                    ->sortable()
                    ->searchable()
                    ->label('Vigencia'),
                Tables\Columns\TextColumn::make('precio')
                    ->sortable()
                    ->searchable()
                    ->label('Precio'),
                Tables\Columns\TextColumn::make('tipo')
                    ->sortable()
                    ->searchable()
                    ->label('Tipo'),
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
            'index' => Pages\ListCursos::route('/'),
            'create' => Pages\CreateCurso::route('/create'),
            'edit' => Pages\EditCurso::route('/{record}/edit'),
        ];
    }
}
