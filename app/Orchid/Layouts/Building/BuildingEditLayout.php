<?php

namespace App\Orchid\Layouts\Building;

use App\Models\Company;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
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

            Relation::make('building.company_id')
                ->fromModel(Company::class, 'name')
                ->title(__('Choice company'))

        ];
    }
}
