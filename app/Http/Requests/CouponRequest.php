<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'note' => 'nullable|string|max:255',
            'start_date' => 'required|date|date_format:Y-m-d',
            'end_date' => 'required|date|date_format:Y-m-d',
            'min_purchase_limit' => 'required|numeric|min:1',
            'limit_per_user' => 'required|numeric|min:1',
            'usage_limit' => 'required|numeric|min:1',
        ];
    
        if ( request()->method() != 'PUT') {
            $rules['code'] = 'required|string|max:30|unique:coupons,code';
            $rules['discount_type'] = 'required|string|in:flat,percent|max:30';
            $rules['discount_value'] = 'required|numeric|min:0';
        };

        return $rules;
    }
}
