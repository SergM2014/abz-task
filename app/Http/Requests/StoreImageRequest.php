<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreImageRequest extends FormRequest
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
            // 'image' => 'required|image|mimes:jpg,png,jpeg|max:500|dimensions:min_width=300,min_height=300',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:1024',
        ];
    }


}
