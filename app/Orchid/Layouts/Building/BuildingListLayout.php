<?php

namespace App\Orchid\Layouts\Building;

use App\Models\Building;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class BuildingListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'buildings';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('name', __('Name'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (Building $building) {
                    return $building->name;
                }),

            TD::make('places_count', __('Places count'))
                ->sort()
                ->filter(Input::make())
                ->render(function (Building $building) {
                    return $building->places_count;
                }),

            TD::make('time_zone', __('Time zone'))
                ->sort()
                ->filter(Input::make())
                ->render(function (Building $building) {
                    return $building->time_zone;
                }),

            TD::make('updated_at', __('Last edit'))
                ->sort()
                ->render(function (Building $building) {
                    return $building->updated_at->toDateTimeString();
                }),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Building $building) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.systems.buildings.edit', $building->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->confirm(__('Once the building is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->method('remove', [
                                    'id' => $building->id,
                                ]),
                        ]);
                }),
        ];
    }
}
