<?php

namespace App\Orchid\Layouts\Client;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class ClientInformationEditLayout extends Rows
{
    /**
     * Views.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('client.id')
                ->type('hidden'),

            Input::make('client.firstname')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Firstname'))
                ->placeholder(__('Firstname')),

            Input::make('client.lastname')
                ->type('text')
                ->max(255)
                ->title(__('Lastname'))
                ->placeholder(__('Lastname')),

            Input::make('client.patronymic')
                ->type('text')
                ->max(255)
                ->title(__('Patronymic'))
                ->placeholder(__('Patronymic')),
        ];
    }
}
