<?php

namespace Modules\Brand\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Brand\Models\Brand;

class StoreBrandRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name.en' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    // Retrieve all existing brand names in English
                    $existingNames = Brand::pluck('name')->toArray();

                    // Check if the current name is unique
                    if (in_array($value, $existingNames)) {
                        $fail("The English name must be unique.");
                    }
                },
            ],
            'image' => 'sometimes',
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
