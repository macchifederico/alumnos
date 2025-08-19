<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlumnoResource\Pages;
use App\Filament\Resources\AlumnoResource\RelationManagers;
use App\Models\Alumno;
use App\Models\Curso;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\RelationManagers\HasManyRelationManager;

class AlumnoResource extends Resource
{
    protected static ?string $model = Alumno::class;
    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informacion del Alumno')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('nombre')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('apellido')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('telefono')
                            ->tel()
                            ->maxLength(15),
                        Forms\Components\TextInput::make('dnicuitcuil')
                            ->label('DNI')
                            ->required()
                            ->numeric()
                            ->maxLength(11),
                        Forms\Components\DatePicker::make('fecha_nacimiento')
                            ->label('Fecha de Nacimiento')
                            ->required()
                            ->displayFormat('d/m/Y')
                            ->format('Y-m-d')
                            ->maxDate(now())
                            ->native(false),
                        Forms\Components\TextInput::make('nacionalidad')
                            ->required()
                            ->maxLength(255),
                    ]),
                Section::make('Datos de Domicilio')
                    ->relationship('domicilio', 'id_alumno')
                    ->columns(2)
                    ->schema(DomicilioResource::getFormSchema()),
                Section::make('Datos de Curso')
                    ->columns(2)
                    ->schema([
                        Forms\Components\Select::make('cursos')
                            ->label('Seleccionar Cursos')
                            ->multiple()
                            ->options(Curso::all()->pluck('nombre', 'id'))
                            ->relationship('cursos', 'nombre')
                            ->preload()
                            ->searchable(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('apellido')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('dnicuitcuil')
                    ->label('DNI')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha_nacimiento')
                    ->label('Fecha de Nacimiento')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('edad')
                    ->label('Edad')
                    ->suffix(' años')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nacionalidad')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('telefono')
                    ->label('Teléfono')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            CursoRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAlumnos::route('/'),
            'create' => Pages\CreateAlumno::route('/create'),
            'edit' => Pages\EditAlumno::route('/{record}/edit'),
        ];
    }
}

class CursoRelationManager extends RelationManager
{
    protected static string $relationship = 'cursos';
    protected static ?string $recordTitleAttribute = 'nombre';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')->label('Nombre'),
                Tables\Columns\TextColumn::make('materia')->label('Materia'),
                Tables\Columns\TextColumn::make('facultad')->label('Facultad'),
                Tables\Columns\TextColumn::make('precio')->label('Precio'),
            ])
            ->filters([
                // Puedes agregar filtros aquí si lo deseas
            ]);
    }
}
