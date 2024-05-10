<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name'      => 'required|string',
            'email'     => 'required|email|unique:admins,email,'.$this->admin->id,
            'userName'  => 'required|string|unique:admins,userName,'.$this->admin->id,
            'password'  => 'nullable|min:6|max:30',
//            'image'     => 'required|image|max:4048', // 4MB Max
            'phone'     => 'nullable|max:11',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
