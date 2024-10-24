<?php

namespace Modules\Category\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name.en' => [
                'required',
                function ($attribute, $value, $fail) {
                    // Check if the 'en' value exists in the 'name' JSON column of the 'categories' table
                    $exists = DB::table('categories')
                        ->whereRaw('LOWER(JSON_UNQUOTE(JSON_EXTRACT(name, "$.en"))) = ?', [strtolower($value)])
                        ->whereNot('id', $this->category->id)
                        ->exists();

                    if ($exists) {
                        $fail('The name in English is already taken.');
                    }
                },
            ],
            'name.ar' => [
                'required',
                function ($attribute, $value, $fail) {
                    // Check if the 'ar' value exists in the 'name' JSON column of the 'categories' table
                    $exists = DB::table('categories')
                        ->whereRaw('LOWER(JSON_UNQUOTE(JSON_EXTRACT(name, "$.ar"))) = ?', [strtolower($value)])
                        ->whereNot('id', $this->category->id)
                        ->exists();

                    if ($exists) {
                        $fail('The name in Arabic is already taken.');
                    }
                },
            ],
            'icon'      => 'sometimes',
            'priority'  => 'nullable',
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
