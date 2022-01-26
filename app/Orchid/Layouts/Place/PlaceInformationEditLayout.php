<?php

namespace App\Orchid\Layouts\Place;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class PlaceInformationEditLayout extends Rows
{
    /**
     * Views.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('place.id')
                ->type('hidden'),

            Input::make('place.address')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Address'))
                ->placeholder(__('Address')),

            Input::make('place.street')
                ->type('text')
                ->max(255)
                ->title(__('Street'))
                ->placeholder(__('Street')),

            Input::make('place.house')
                ->type('text')
                ->max(255)
                ->title(__('House'))
                ->placeholder(__('House')),

            Input::make('place.block')
                ->type('text')
                ->max(255)
                ->title(__('Block'))
                ->placeholder(__('Block')),

            Input::make('place.flat')
                ->type('text')
                ->max(255)
                ->title(__('Flat'))
                ->placeholder(__('Flat')),

            Input::make('place.postcode')
                ->type('text')
                ->max(255)
                ->title(__('Postal code'))
                ->placeholder(__('Postal code')),
        ];
    }
}
