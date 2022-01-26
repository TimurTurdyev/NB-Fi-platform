<?php

namespace App\Orchid\Layouts\Place;

use App\Orchid\Filters\BuildingFilter;
use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;

class PlaceFiltersLayout extends Selection
{
    /**
     * @return string[]|Filter[]
     */
    public function filters(): array
    {
        return [
            BuildingFilter::class,
        ];
    }
}
