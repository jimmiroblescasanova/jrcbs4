<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:5'],
            'email' => [
                'required', 'email',
                Rule::unique('users', 'email')->ignore($this->user)
            ],
            'password' => ['nullable', 'min:6', 'confirmed'],
            'group' => ['required', 'exists:roles,name'],
        ];
    }
}
