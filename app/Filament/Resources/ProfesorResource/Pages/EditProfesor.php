<?php

namespace App\Filament\Resources\ProfesorResource\Pages;

use App\Filament\Resources\ProfesorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class EditProfesor extends EditRecord
{
    protected static string $resource = ProfesorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->requiresConfirmation()
                ->modalHeading('Eliminar profesor')
                ->modalDescription('¿Estás seguro de que quieres eliminar este profesor? Esta acción no se puede deshacer.')
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
            ->title('Profesor actualizado')
            ->body('Los cambios se han guardado exitosamente.')
            ->duration(5000);
    }
    
    protected function mutateFormDataBeforeSave(array $data): array
    {
        Log::info('ProfesorResource - Datos antes de guardar:', $data);
        
        return $data;
    }
    
    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction()
                ->requiresConfirmation()
                ->modalHeading('Confirmar cambios')
                ->modalDescription('¿Estás seguro de que quieres guardar los cambios realizados?')
                ->modalSubmitActionLabel('Guardar cambios'),
            $this->getCancelFormAction(),
        ];
    }
}
