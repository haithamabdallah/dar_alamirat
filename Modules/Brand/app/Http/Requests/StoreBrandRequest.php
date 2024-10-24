<?php

namespace Modules\Brand\Http\Requests;

use Modules\Brand\Models\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

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
                function ($attribute, $value, $fail) {
                    $exists = DB::table('brands')
                        ->whereRaw('LOWER(JSON_UNQUOTE(JSON_EXTRACT(name, "$.en"))) = ?', [strtolower($value)])
                        ->exists();
                    if ($exists) {
                        $fail('The name in English is already taken.');
                    }
                },
            ],
            'name.ar' => [
                'nullable',
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
