<?php

namespace App\Orchid\Screens\Place;

use App\Http\Requests\PlaceEditRequest;
use App\Models\Place;
use App\Orchid\Layouts\Place\PlaceInformationEditLayout;
use App\Orchid\Layouts\Place\PlaceRelationEditLayout;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class PlaceEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Edit place';

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
     * @var Place
     */
    private $place;

    /**
     * Query data.
     *
     * @param Place $place
     *
     * @return array
     */
    public function query(Place $place): array
    {
        $this->place = $place;

        if (!$place->exists) {
            $this->name = 'Create place';
        }

        return [
            'place' => $place,
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
                ->confirm(__('Once the place is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->method('remove')
                ->canSee($this->place->exists),

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
            Layout::columns([
                PlaceInformationEditLayout::class,
                PlaceRelationEditLayout::class,
            ]),
        ];
    }

    /**
     * @param Place $place
     * @param PlaceEditRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Place $place, PlaceEditRequest $request)
    {
        $data = $request->validated();

        $place
            ->fill($data['place'])
            ->save();

        Toast::info(__('Place was saved.'));

        return redirect()->route('platform.systems.places');
    }

    /**
     * @param Place $place
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     *
     */
    public function remove(Place $place)
    {
        $place->delete();

        Toast::info(__('Place was removed'));

        return redirect()->route('platform.systems.places');
    }
}
