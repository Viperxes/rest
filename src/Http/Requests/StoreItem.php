<?php

namespace Viperxes\Rest\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItem extends FormRequest
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
            'id' => 'numeric|unique:items',
            'name' => 'required|string|min:1|unique:items',
            'amount' => 'required|numeric|min:0'
        ];
    }
}
