<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAssessmentRequest extends FormRequest
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
            'assessID' => 'required|unique:assessments,assessID',
            'name' => 'required',
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
            'assessID.required' => 'This field is required',
            'assessID.unique' => 'This ID exists (should be unique)',
            'name.required' => 'Assessment field is required',
        ];
    }
}

