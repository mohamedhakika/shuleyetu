<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTeacherSubjectRequest extends FormRequest
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
            'subject_id' => "required|unique_with:teacher_subjects,form_id, year",
            'form_id' => 'required',
        ];
    }

    /**
     * Format validation displayed message that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'subject_id.required' => 'Name field is required',
            'subject_id.unique_with' => 'This subject assigned to another teacher',
            'form_id.required' => 'Form field is required',
        ];
    }
}
