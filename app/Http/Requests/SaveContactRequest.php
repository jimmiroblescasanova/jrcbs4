<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveContactRequest extends FormRequest
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
            'lastname' => ['required', 'string', 'min:5'],
            'phone' => ['nullable', 'digits:10'],
            'email' => ['nullable', 'email'],
            'company_id' => ['nullable', 'exists:companies,id'],
            'comments' => ['nullable', 'string'],
        ];
    }
}
