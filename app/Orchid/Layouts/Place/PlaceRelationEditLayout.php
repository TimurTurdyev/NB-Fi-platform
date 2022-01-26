<?php

namespace App\Orchid\Layouts\Place;

use App\Models\Building;
use App\Models\Client;
use App\Models\Company;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layouts\Rows;

class PlaceRelationEditLayout extends Rows
{
    /**
     * Views.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Relation::make('place.company_id')
                ->fromModel(Company::class, 'name')
                ->title(__('Choice company')),

            Relation::make('place.building_id')
                ->fromModel(Building::class, 'name')
                ->title(__('Choice building')),

            Relation::make('place.client_id')
                ->fromModel(Client::class, 'firstname')
                ->displayAppend('full')
                ->title(__('Choice client'))
        ];
    }
}
