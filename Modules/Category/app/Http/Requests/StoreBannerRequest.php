<?php

namespace Modules\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBannerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'type' => 'required|in:category,brand',
            'priority' => 'nullable|numeric|min:0|max:9999999999',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
        ];
        if ($this->type == 'category') {
            $rules['bannerableId'] = 'required|exists:categories,id';
        } elseif ($this->type == 'brand') {
            $rules['bannerableId'] = 'required|exists:brands,id';
        }
        return $rules;  
    }

    public function messages()
    {
        return [
            'priority.required'  => __('validation.name_en_required'),
            'image.required'  => __('validation.name_en_required'),
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
