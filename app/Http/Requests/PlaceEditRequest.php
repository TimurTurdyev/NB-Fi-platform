<?php

namespace App\Http\Requests;

use App\Models\Place;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlaceEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $place = $this->get('place');

        return [
            'place.address' => [
                'required',
                'string',
                'min:5',
                'max:255',
                Rule::unique(Place::class, 'address')
                    ->where(function ($query) use ($place) {
                        return $query
                            ->where('places.street', $place['street'] ?? '')
                            ->where('places.house', $place['house'] ?? '')
                            ->where('places.block', $place['block'] ?? '')
                            ->where('places.flat', $place['flat'] ?? '')
                            ->where('places.postcode', $place['postcode'] ?? '');
                    })->ignore($place['id'] ?? ''),
            ],
            'place.street' => [
                'string',
                'min:0',
                'max:128',
            ],
            'place.house' => [
                'string',
                'min:0',
                'max:32',
            ],
            'place.block' => [
                'string',
                'min:0',
                'max:32',
            ],
            'place.flat' => [
                'string',
                'min:0',
                'max:32',
            ],
            'place.postcode' => [
                'string',
                'min:0',
                'max:32',
            ],
            'place.company_id' => [
                'nullable',
                Rule::exists('companies', 'id'),
            ],
            'place.building_id' => [
                'nullable',
                Rule::exists('buildings', 'id'),
            ],
            'place.client_id' => [
                'nullable',
                Rule::exists('clients', 'id'),
            ],
        ];
    }

    public function prepareForValidation()
    {
        $place = $this->get('place');

        if (empty($place['street'])) {
            $place['street'] = '';
        }

        if (empty($place['house'])) {
            $place['house'] = '';
        }

        if (empty($place['block'])) {
            $place['block'] = '';
        }

        if (empty($place['flat'])) {
            $place['flat'] = '';
        }

        if (empty($place['postcode'])) {
            $place['postcode'] = '';
        }

        if (empty($place['company_id'])) {
            $place['company_id'] = null;
        }

        if (empty($place['building_id'])) {
            $place['building_id'] = null;
        }

        if (empty($place['client_id'])) {
            $place['client_id'] = null;
        }

        $this->merge(['place' => $place]);
    }
}
