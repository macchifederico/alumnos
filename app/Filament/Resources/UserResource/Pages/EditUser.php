<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->requiresConfirmation()
                ->modalHeading('Eliminar usuario')
                ->modalDescription('¿Estás seguro de que quieres eliminar este usuario? Esta acción no se puede deshacer.')
                ->modalSubmitActionLabel('Eliminar')
                ->successNotification(
                    Notification::make()
                        ->success()
                        ->title('Usuario eliminado')
                        ->body('El usuario ha sido eliminado exitosamente.')
                ),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Usuario actualizado')
            ->body('El usuario ha sido actualizado exitosamente.');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Debugging: log para ver qué datos se están enviando
        Log::info('Datos antes de guardar:', $data);

        // Si la contraseña está vacía, la eliminamos del array para que no se actualice
        if (empty($data['password'])) {
            unset($data['password']);
        }

        Log::info('Datos después de procesar:', $data);

        return $data;
    }
}
