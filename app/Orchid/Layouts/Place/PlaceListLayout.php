<?php

namespace App\Orchid\Layouts\Place;

use App\Models\Place;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PlaceListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'places';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('address', __('Address'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (Place $place) {
                    return $place->address;
                }),

            TD::make('building_id', __('Building'))
                ->sort()
                ->cantHide()
                ->render(function (Place $place) {
                    return $place->building?->name;
                }),

            TD::make('company_id', __('Company'))
                ->sort()
                ->cantHide()
                ->render(function (Place $place) {
                    return $place->company?->name;
                }),

            TD::make('client_id', __('Client'))
                ->sort()
                ->cantHide()
                ->render(function (Place $place) {
                    return $place->client?->full;
                }),

            TD::make('updated_at', __('Last edit'))
                ->sort()
                ->render(function (Place $place) {
                    return $place?->updated_at->toDateTimeString();
                }),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Place $place) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.systems.places.edit', $place->id)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->confirm(__('Once the place is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->method('remove', [
                                    'id' => $place->id,
                                ]),
                        ]);
                }),
        ];
    }
}
