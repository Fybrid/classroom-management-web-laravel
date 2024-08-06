<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Table;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Dashboard\Actions\FilterAction;
use Filament\Pages\Dashboard\Concerns\HasFiltersAction;

class ReservationLink extends Widget
{
    use HasFiltersAction;
    
    protected function getHeaderActions(): array
    {
        return [
            FilterAction::make()
                ->form([
                    DatePicker::make('startDate'),
                    DatePicker::make('endDate'),
                    // ...
                ]),
        ];
    }
    protected static string $view = 'filament.widgets.reservation-link';
}
