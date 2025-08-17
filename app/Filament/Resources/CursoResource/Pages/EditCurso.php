<?php

namespace App\Filament\Resources\CursoResource\Pages;

use App\Filament\Resources\CursoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditCurso extends EditRecord
{
    protected static string $resource = CursoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->requiresConfirmation()
                ->modalHeading('Eliminar curso')
                ->modalDescription('¿Estás seguro de que quieres eliminar este curso? Esta acción no se puede deshacer.')
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
            ->title('Curso actualizado')
            ->body('Los cambios se han guardado exitosamente.')
            ->duration(5000);
    }
}
