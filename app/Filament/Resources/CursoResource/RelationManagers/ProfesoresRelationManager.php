<?php

namespace App\Filament\Resources\CursoResource\RelationManagers;

use App\Models\Profesor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProfesoresRelationManager extends RelationManager
{
    protected static string $relationship = 'profesores';

    protected static ?string $recordTitleAttribute = 'nombre';

    protected static ?string $title = 'Profesores Asignados';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // No se necesita esquema para AttachAction
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nombre')
            ->columns([
                Tables\Columns\TextColumn::make('nombre_completo')
                    ->label('Nombre Completo')
                    ->searchable(['nombre', 'apellido'])
                    ->sortable(['nombre', 'apellido']),
                Tables\Columns\TextColumn::make('dni')
                    ->label('DNI')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('telefono')
                    ->label('Teléfono')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nacionalidad')
                    ->searchable(),
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
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->label('Asignar Profesor')
                    ->recordSelectOptionsQuery(fn (Builder $query) =>
                        $query->orderBy('nombre')->orderBy('apellido')
                    )
                    ->recordSelectSearchColumns(['nombre', 'apellido', 'dni', 'email'])
                    ->recordTitle(fn ($record) => "{$record->nombre} {$record->apellido}")
                    ->preloadRecordSelect()
                    ->modalHeading('Asignar Profesor al Curso')
                    ->modalSubheading('Selecciona un profesor para asignar a este curso'),
            ])
            ->actions([
                Tables\Actions\DetachAction::make()
                    ->label('Desasignar'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make()
                        ->label('Desasignar seleccionados'),
                ]),
            ]);
    }
}
