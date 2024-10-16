<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'name' => 'required|string|min:1|max:31|unique:roles,name',
            'permission_ids' => 'required|array|min:1',
            'permission_ids.*' => 'required|exists:permissions,id',
        ];

        if ($this->method() == 'PUT') {
            $rules['name'] .=  ',' . $this->role->id;
        }
    
        return $rules;
    }
}
