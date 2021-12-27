<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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
            'name' => 'required|max:255|unique:room_categories,name',
            'description' => 'max:5000',
            'price1' => 'required|numeric|min:1',
            'price2' => 'required|numeric|min:1',
            'price3' => 'required|numeric|min:1',
            'price4' => 'required|numeric|min:1',
            'adults'  => 'required|numeric|min:1',
            'children' => 'required|numeric|min:1',
            'image'   => 'nullable|mimes:jpeg,jpg,png|max:10240',
            'enabled' => 'nullable|in:on',
        ];
    }

    /**
     * Custom messages for validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.unique' => 'Category with name already exists',
            'name.*' => 'Please enter a valid name',
            'description' => 'Please enter a valid description',
            'price1.*' => 'Please enter a valid price1',
            'price1.*' => 'Please enter a valid price2',
            'price1.*' => 'Please enter a valid price3',
            'price1.*' => 'Please enter a valid price4',
            'adults.min' => 'Value cannot be less than 1',
            'adults.*' => 'Please enter valid number of adults',
            'children.min' => 'Value cannot be less than 1',
            'children.*' => 'Please enter valid number of children',
            'image.mimes' => 'Only jpg or png images accepted',
            'image.max' => 'Image size too large',
            'enabled.*' => 'Please select valid value for enabled, possible value on',
        ];
    }
}
