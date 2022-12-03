<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'firstName' => 'required|min:2|max:256',
            'middleName'=> 'min:2|max:256',
            'lastName'  => 'required|min:2|max:256',
            'positionId'=> 'required',
            'leaderId'  => 'required',
            'phone'     => 'required',
            'email'     => 'required',
            'salary'    => 'required',
        ];
    }
}
