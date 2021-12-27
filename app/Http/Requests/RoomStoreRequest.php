<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomStoreRequest extends FormRequest
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
            'category_id' => 'required|exists:room_categories,id',
            'room_number' => 'nullable|numeric|min:0|unique:rooms,room_number,' . $this->id,
            'floor' => 'nullable|numeric|min:0',
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
            'category_id.exists' => 'Room category should exist',
            'category_id.*' => 'Please choose a valid category',
            'room_number.unique' => 'Room number should be unique',
            'room_number.*' => 'Please enter a valid room number',
            'floor.*' => 'Please enter a valid floor number',
        ];
    }
}
