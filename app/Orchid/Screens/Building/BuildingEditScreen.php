<?php

namespace App\Orchid\Screens\Building;

use App\Models\Building;
use App\Orchid\Layouts\Building\BuildingEditLayout;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class BuildingEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Edit building';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Details such as name, email and password';

    /**
     * Permissions for this screen
     *
     * @var array|string
     */
    public $permission = [
        'platform.systems.users'
    ];


    /**
     * @var Building
     */
    private $building;

    /**
     * Query data.
     *
     * @param Building $building
     *
     * @return array
     */
    public function query(Building $building): array
    {
        $this->building = $building;

        if (!$building->exists) {
            $this->name = 'Create building';
        }

        return [
            'building' => $building,
        ];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make(__('Remove'))
                ->icon('trash')
                ->confirm(__('Once the building is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->method('remove')
                ->canSee($this->building->exists),

            Button::make(__('Save'))
                ->icon('check')
                ->method('save'),
        ];
    }

    /**
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): array
    {
        return [
            Layout::columns([BuildingEditLayout::class]),
        ];
    }

    /**
     * @param Building $building
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Building $building, Request $request)
    {
        $request_validated = $request->validate([
            'building.name' => [
                'required',
                Rule::unique(Building::class, 'name')->ignore($building),
            ],
            'building.time_zone' => [
                'required',
                'timezone',
            ]
        ])['building'];

        $building
            ->fill($request_validated)
            ->save();

        Toast::info(__('Building was saved.'));

        return redirect()->route('platform.systems.buildings');
    }

    /**
     * @param Building $building
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     *
     */
    public function remove(Building $building)
    {
        $building->delete();

        Toast::info(__('Building was removed'));

        return redirect()->route('platform.systems.buildings');
    }
}
