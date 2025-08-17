<?php

namespace App\Filament\Resources\AlumnoResource\Pages;

use App\Filament\Resources\AlumnoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditAlumno extends EditRecord
{
    protected static string $resource = AlumnoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->requiresConfirmation()
                ->modalHeading('Eliminar alumno')
                ->modalDescription('¿Estás seguro de que quieres eliminar este alumno? Esta acción no se puede deshacer.')
                ->modalSubmitActionLabel('Eliminar'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        // Redirigir a la lista después de guardar
        return $this->getResource()::getUrl('index');
    }
    
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Alumno actualizado')
            ->body('Los cambios se han guardado exitosamente.')
            ->duration(5000);
    }
}
