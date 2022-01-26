<?php

namespace App\Orchid\Layouts\Building;

use DateTimeZone;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TimeZone;
use Orchid\Screen\Layouts\Rows;

class BuildingEditLayout extends Rows
{
    /**
     * Views.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('building.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Name'))
                ->placeholder(__('Name')),

            TimeZone::make('building.time_zone')
                ->listIdentifiers(DateTimeZone::ALL)
                ->title(__('Time Zone')),

        ];
    }
}
