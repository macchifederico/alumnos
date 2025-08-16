<?php

namespace App\Filament\Widgets;

use App\Models\Alumno;
use App\Models\Curso;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Alumnos', Alumno::count())
                ->description('Estudiantes registrados')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),

            Stat::make('Total Cursos', Curso::count())
                ->description('Cursos en el sistema')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('info'),

            Stat::make('Cursos Vigentes', Curso::where('vigencia', '>=', now())->count())
                ->description('Cursos activos')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Cursos Vencidos', Curso::where('vigencia', '<', now())->count())
                ->description('Cursos expirados')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger'),
        ];
    }
}
