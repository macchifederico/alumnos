<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfesorResource\Pages;
use App\Filament\Resources\ProfesorResource\RelationManagers;
use App\Models\Profesor;
use App\Models\Domicilio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProfesorResource extends Resource
{
    protected static ?string $model = Profesor::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Profesores';

    protected static ?string $modelLabel = 'Profesor';

    protected static ?string $pluralModelLabel = 'Profesores';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información Personal')
                    ->schema([
                        Forms\Components\TextInput::make('nombre')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('apellido')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('dni')
                            ->label('DNI')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('fecha_nacimiento')
                            ->label('Fecha de Nacimiento')
                            ->required()
                            ->displayFormat('d/m/Y')
                            ->format('Y-m-d')
                            ->native(false)
                            ->locale('es'),
                        Forms\Components\Select::make('nacionalidad')
                            ->options([
                                'Argentina' => 'Argentina',
                                'Brasil' => 'Brasil',
                                'Chile' => 'Chile',
                                'Uruguay' => 'Uruguay',
                                'Paraguay' => 'Paraguay',
                                'España' => 'España',
                                'Italia' => 'Italia',
                                'Otro' => 'Otro',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('telefono')
                            ->label('Teléfono')
                            ->tel()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Domicilio')
                    ->relationship('domicilio')
                    ->schema(DomicilioResource::getFormSchema())
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre_completo')
                    ->label('Nombre Completo')
                    ->searchable(['nombre', 'apellido'])
                    ->sortable(['nombre', 'apellido']),
                Tables\Columns\TextColumn::make('dni')
                    ->label('DNI')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('telefono')
                    ->label('Teléfono')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nacionalidad')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('edad')
                    ->label('Edad')
                    ->suffix(' años')
                    ->sortable(),
                Tables\Columns\TextColumn::make('cursos_count')
                    ->label('Cursos')
                    ->counts('cursos')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('nacionalidad')
                    ->options([
                        'Argentina' => 'Argentina',
                        'Brasil' => 'Brasil',
                        'Chile' => 'Chile',
                        'Uruguay' => 'Uruguay',
                        'Paraguay' => 'Paraguay',
                        'España' => 'España',
                        'Italia' => 'Italia',
                        'Otro' => 'Otro',
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
            'index' => Pages\ListProfesors::route('/'),
            'create' => Pages\CreateProfesor::route('/create'),
            'edit' => Pages\EditProfesor::route('/{record}/edit'),
        ];
    }
}
