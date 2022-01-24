<?php

namespace App\Orchid\Screens\Building;

use App\Models\Building;
use App\Orchid\Layouts\Building\BuildingListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class BuildingListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Buildings';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'All registered buildings';

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
            'buildings' => Building::defaultSort('id', 'desc')
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
                ->route('platform.systems.buildings.create'),
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
            BuildingListLayout::class
        ];
    }
}
