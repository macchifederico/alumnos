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
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // Constantes para tipos de curso
    public const TIPO_PRESENCIAL = 'Presencial';
    public const TIPO_VIRTUAL = 'Virtual';
    public const TIPO_HIBRIDO = 'Híbrido';

    public static function getTiposCurso(): array
    {
        return [
            self::TIPO_PRESENCIAL => 'Presencial',
            self::TIPO_VIRTUAL => 'Virtual',
            self::TIPO_HIBRIDO => 'Híbrido',
        ];
    }

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
                            ->minLength(3)
                            ->label('Nombre del Curso'),
                        Forms\Components\TextInput::make('materia')
                            ->required()
                            ->maxLength(255)
                            ->minLength(2)
                            ->label('Materia'),
                        Forms\Components\TextInput::make('facultad')
                            ->required()
                            ->maxLength(255)
                            ->minLength(2)
                            ->label('Facultad'),
                        Forms\Components\DatePicker::make('vigencia')
                            ->required()
                            ->label('Vigencia')
                            ->displayFormat('d/m/Y')
                            ->format('Y-m-d')
                            ->native(false)
                            ->placeholder('dd/mm/aaaa')
                            ->closeOnDateSelection()
                            ->locale('es')
                            ->minDate(now())
                            ->helperText('La fecha debe ser igual o posterior a hoy'),
                        Forms\Components\TextInput::make('precio')
                            ->required()
                            ->label('Precio (AR$)')
                            ->prefix('$')
                            ->suffix(',00')
                            ->numeric()
                            ->minValue(1)
                            ->step(0.01)
                            ->placeholder('25000')
                            ->helperText('Ingrese el precio sin puntos ni comas (ej: 25000 para $25.000,00)')
                            ->formatStateUsing(fn ($state) => $state ? number_format($state, 0, ',', '') : '')
                            ->dehydrateStateUsing(fn ($state) => (float) str_replace(['.', ','], '', $state)),
                        Forms\Components\Select::make('tipo')
                            ->options(self::getTiposCurso())
                            ->required()
                            ->label('Tipo de Curso')
                            ->placeholder('Seleccione el tipo de curso'),
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
                    ->label('Estado')
                    ->badge()
                    ->color(fn ($record) => $record->vigencia < now() ? 'danger' : 'success')
                    ->formatStateUsing(fn ($record) =>
                        $record->vigencia < now()
                            ? '🔴 VENCIDO'
                            : '✅ VIGENTE'
                    ),
                Tables\Columns\TextColumn::make('precio')
                    ->sortable()
                    ->searchable()
                    ->label('Precio (AR$)')
                    ->money('ARS', locale: 'es_AR')
                    ->formatStateUsing(fn ($state) => '$' . number_format($state, 2, ',', '.')),
                Tables\Columns\TextColumn::make('tipo')
                    ->sortable()
                    ->searchable()
                    ->label('Tipo'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('estado_vigencia')
                    ->label('Estado de Vigencia')
                    ->options([
                        'vigente' => 'Vigentes',
                        'vencido' => 'Vencidos',
                    ])
                    ->query(function ($query, array $data) {
                        if ($data['value'] === 'vigente') {
                            return $query->where('vigencia', '>=', now()->toDateString());
                        } elseif ($data['value'] === 'vencido') {
                            return $query->where('vigencia', '<', now()->toDateString());
                        }
                        return $query;
                    }),
                Tables\Filters\SelectFilter::make('tipo')
                    ->label('Tipo de Curso')
                    ->options(self::getTiposCurso()),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            RelationManagers\ProfesoresRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCursos::route('/'),
            'create' => Pages\CreateCurso::route('/create'),
            'view' => Pages\ViewCurso::route('/{record}'),
            'edit' => Pages\EditCurso::route('/{record}/edit'),
        ];
    }
}
