<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:2|max:255',
            'description' => 'max:1000',
            'images' => 'array|min:1',
            'images.*.url' => ['regex:/^(http)?s?:?(\/\/[^\']*\.(?:png|jpg|jpeg))/']
        ];
    }
}