<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title.*' => 'required|string',
            'description.*' => 'required|string',
            'instructions.*' => 'string',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'thumbnail' => 'required|image',
            'images.*' => 'image',
            'variant.*.enabled' => 'required|in:on,off',
            'variant.*.size' => 'nullable|string',
            'variant.*.color' => 'nullable|string',
            'variant.*.price' => 'required|numeric|min:0',
            'variant.*.quantity' => 'required|integer|min:1',
//            'discount_value' => 'required_with:discount_type|numeric|min:0',
            'discount_type' => 'sometimes|in:flat,percent',
            'discount_value' => 'required_with:discount_type|min:0',
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
