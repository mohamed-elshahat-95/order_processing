<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'avatar' => 'nullable|string', 
            'type' => 'in:normal,silver,gold'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'A name is required.',
            'username.required' => 'A username is required.',
            'username.unique' => 'This username has already been taken.',
            'password.required' => 'A password is required.',
            'type.in' => 'The type must be one of the following: normal, silver, gold.',
        ];
    }
}
