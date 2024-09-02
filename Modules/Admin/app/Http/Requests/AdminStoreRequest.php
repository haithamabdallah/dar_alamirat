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
        $rules = [
            'name'      => 'required|string|unique:admins,name',
            'email'     => 'required|email|unique:admins,email',
            'userName'  => 'required|string|unique:admins,userName',
            'password'  => 'nullable|min:6|max:30',
//            'image'     => 'required|image|max:4048', // 4MB Max
            'phone'     => 'nullable',
        ];

        if ( $this->hasFile('image') ) {
            $rules['image'] = 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:4048';
        }

        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('admin')->check();
    }
}
