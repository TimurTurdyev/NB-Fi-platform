<?php

namespace App\Orchid\Filters;

use App\Models\Building;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Relation;

class CompanyFilter extends Filter
{
    /**
     * @var array
     */
    public $parameters = [
        'company',
    ];

    /**
     * @return string
     */
    public function name(): string
    {
        return __('Companies');
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        return $builder->whereHas('building', function (Builder $query) {
            $query->whereIn('name', $this->request->get('building'));
        });
    }

    /**
     * @return Field[]
     */
    public function display(): array
    {
        return [
            Relation::make('building')
                ->fromModel(Building::class, 'name', 'name')
                ->multiple()
                ->value($this->request->get('building'))
                ->title(__('Buildings')),
        ];
    }
}
