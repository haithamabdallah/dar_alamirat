<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainSliderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules =  [
            'is_dart' => 'boolean',
            'is_reversed' => 'boolean',
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'subtitle_en' => 'required|string|max:255',
            'subtitle_ar' => 'required|string|max:255',
            'button_text_en' => 'required|string|max:255',
            'button_text_ar' => 'required|string|max:255',
            'button_link' => 'required|url:http,https',
        ];

        if (request()->method() == 'POST') {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240';
            $rules['background_image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240';
        } else {
            if (request()->hasFile('image')) {
                $rules['image'] = 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240';
            }
            if (request()->hasFile('background_image')) {
                $rules['background_image'] = 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240';
            }
        }

        return $rules;
    }
}
