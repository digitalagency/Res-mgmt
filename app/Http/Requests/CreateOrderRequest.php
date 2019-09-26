<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'tableId' => 'required|integer',
            'netPrice' => 'required|between: 1, 99999.99',
            'grossPrice' => 'required|between: 1, 99999.99',
            'vat' => 'required|between: 1, 99999.99',
            'dishList.*.dishId' => 'required_with:dishCategoryId|integer',
            'dishList.*.quantity' => 'integer|min:1',
            'dishList.*.price' => 'required|between: 1, 99999.99'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'tableId.integer' => 'Please select a table',
        ];
    }
}
