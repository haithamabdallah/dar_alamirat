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
            'description.*' => 'sometimes',
            'instructions.*' => 'sometimes',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'thumbnail' => 'required|image',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'variant.*.enabled' => 'required|in:on,off',
            'variant.*.size' => 'nullable|string',
            'variant.*.color' => 'nullable|string',
            'variant.*.price' => 'required|numeric|min:0',
            'variant.*.quantity' => 'required|numeric|min:1',
            'variant.*.sku' => 'required|string|max:255|unique:variants,sku',
            'variant.*.images' => 'nullable|array',
            'variant.*.images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
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
