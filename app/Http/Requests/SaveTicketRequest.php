<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveTicketRequest extends FormRequest
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
            'company_id' => ['required', 'exists:companies,id'],
            'contact_id' => ['required', 'exists:contacts,id'],
            'activity_id' => ['required', 'exists:activities,id'],
            'tag_id' => ['required', 'exists:tags,id'],
            'note' => ['nullable', 'string'],
            'created_by' => ['required', 'exists:users,id'],
            'assigned_to' => ['required', 'exists:users,id'],
            'attachment' => ['file', 'mimes:png,jpg,pdf,xls,xlsx'],
        ];
    }
}
