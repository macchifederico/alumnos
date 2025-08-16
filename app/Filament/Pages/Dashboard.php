<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $title = 'Sistema de Gestión de Alumnos';

    protected static ?string $navigationLabel = 'Dashboard';

    public function getTitle(): string
    {
        return 'Sistema de Gestión de Alumnos';
    }

    public function getSubheading(): ?string
    {
        return 'Panel de control principal';
    }
}
