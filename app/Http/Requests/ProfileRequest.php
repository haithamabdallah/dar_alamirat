<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
        $userId = $this->route('user')->id;
        return [
            //
            'first_name' => 'string',
            'last_name' => 'string',
            'birthday' => ['required', 'date', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')],
            'gender' => 'required|in:male,female',
            'email' => 'required|email|unique:users,email,' . $userId,
            'phone_number'=>'string'


        ];
    }
    public function messages()
    {
        return [
            'birthday.before_or_equal' => 'You must be at least 18 years old.',
        ];
    }
}
