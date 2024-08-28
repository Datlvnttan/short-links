<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PremiumRequest extends FailedReturnJsonFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
            'premium_name' => 'required',
            'premium_title' => 'required',
            'billing_cycle' => 'required|numeric|min:1',
            'upgrade_costs' => 'required|numeric',
            'level' => 'required|numeric|min:1',
            'link_lifespan' => 'required|numeric',
            'limit_create_custom_link' => 'required|numeric',
            'limit_create_qrcode' => 'required|numeric',
            
        ];
    }
    public function messages(): array
    {
        return [
            'premium_name.required' => 'Cannot be left blank',
            'premium_title.required' => 'Cannot be left blank',
            'billing_cycle.required' => 'Cannot be left blank',
            'upgrade_costs.required' => 'Cannot be left blank',
            'level.required' => 'Cannot be left blank',
            'link_lifespan.required' => 'Cannot be left blank',
            'limit_create_custom_link.required' => 'Cannot be left blank',
            'limit_create_qrcode.required' => 'Cannot be left blank',     
            
            'billing_cycle.numeric' => 'Must be of integer type',
            'upgrade_costs.numeric' => 'Must be of integer type',
            'level.numeric' => 'Must be of integer type',            
            'link_lifespan.numeric' => 'Must be of integer type',
            'limit_create_custom_link.numeric' => 'Must be of integer type',
            'limit_create_qrcode.numeric' => 'Must be of integer type', 

            'billing_cycle.min' => 'Billing cycle has a minimum value of 1',
            'level.min' => 'Level has a minimum value of 1',
        ];
    }  
}
