<?php

namespace Modules\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name.*' => 'required',
            'icon' => 'sometimes',
            'priority' => 'required',
            'parent_id' => 'exists:categories,id',
        ];
    }

    public function messages()
    {
        return [
            'name.en.required'  => __('validation.name_en_required'),
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
