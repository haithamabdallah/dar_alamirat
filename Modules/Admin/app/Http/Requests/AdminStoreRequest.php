<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name'      => 'required|string',
            'userName'  => 'required|string|unique:admins,userName',
            'email'     => 'required|email|unique:admins,email',
            'image'     => 'required|image|max:4048', // 4MB Max
            'phone'     => 'nullable|max:11',
            'password'  => 'required|min:6|max:30'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('admin')->check();
    }
}
