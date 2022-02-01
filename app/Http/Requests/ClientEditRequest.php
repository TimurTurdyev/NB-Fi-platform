<?php

namespace App\Http\Requests;

use App\Models\Place;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientEditRequest extends FormRequest
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
        return [
            'client.firstname' => [
                'string',
                'min:0',
                'max:128',
            ],
            'client.lastname' => [
                'string',
                'min:0',
                'max:128',
            ],
            'client.patronymic' => [
                'string',
                'min:0',
                'max:128',
            ],
        ];
    }
}
