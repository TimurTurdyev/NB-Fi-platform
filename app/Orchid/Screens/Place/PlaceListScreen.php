<?php

namespace App\Orchid\Screens\Place;

use App\Models\Place;
use App\Orchid\Layouts\Place\PlaceFiltersLayout;
use App\Orchid\Layouts\Place\PlaceListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class PlaceListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Places';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'All registered places';

    /**
     * @var string
     */
    public $permission = 'platform.systems.users';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'places' => Place::with('building', 'company', 'client')
                ->filters()
                ->filtersApplySelection(PlaceFiltersLayout::class)
                ->defaultSort('id', 'desc')
                ->paginate(),
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make(__('Add'))
                ->icon('plus')
                ->route('platform.systems.places.create'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            PlaceFiltersLayout::class,
            PlaceListLayout::class
        ];
    }
}
