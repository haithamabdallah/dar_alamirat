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
            'type' => 'required|in:default,banner',
            'name.*' => 'required_if:type,default',
            'icon' => 'required_if:type,default',
            'priority' => 'required',
            'banner_images' => 'required_if:type,banner',
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
