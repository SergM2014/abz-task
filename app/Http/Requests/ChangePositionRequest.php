<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePositionRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'siblingsPosition' => 'numeric'
        ];
    }

    public function messages()
{
    return [
        'siblingsPosition.numeric' => 'Position is not choosen!',
       
    ];
}
}
