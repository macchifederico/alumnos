<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class QuickAccessWidget extends Widget
{
    protected static string $view = 'filament.widgets.quick-access-widget';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;
}
