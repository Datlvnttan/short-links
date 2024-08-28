<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FailedReturnJsonFormRequest
{
    // /**
    //  * Determine if the user is authorized to make this request.
    //  */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fieldvalue' => 'required|min:5',
            'password' => 'required|min:3',
        ];
    }
    public function messages(): array
    {
        return [
            'fieldvalue.required' => 'Cannot be left blankk',
            'fieldvalue.min' => 'Minimum 5 characters',
            'password.min' => 'Password minimum 3 characters',
            'password.required' => 'Password cannot be blank',
        ];
    }  
}
