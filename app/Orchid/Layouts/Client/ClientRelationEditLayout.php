<?php

namespace App\Orchid\Layouts\Client;

use App\Models\Place;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layouts\Rows;

class ClientRelationEditLayout extends Rows
{
    /**
     * Views.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Relation::make('client.places')
                ->fromModel(Place::class, 'address')
                ->multiple()
                ->title(__('Choice places')),
        ];
    }
}
