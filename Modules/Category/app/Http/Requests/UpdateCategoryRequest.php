<?php

namespace Modules\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name.*'    =>'required',
            'icon'      => 'sometimes',
            'priority'  => 'sometimes',
        ];
    }

    public function messages()
    {
        return [
            'name.en.required'  => __('validation.name_en_required'),
            'icon.required'     => __('validation.icon_required'),
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
