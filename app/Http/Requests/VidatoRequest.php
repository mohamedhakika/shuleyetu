<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VidatoRequest extends FormRequest
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
            'year' => 'required|numeric|digits:4|min:2015',
            'name_form' => 'required',
            'stream' => 'required',
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
            'year.min' => 'The year is to long ago.',
            'year.digits' => 'Enter valid year with 4 digits.',
            'year.required' => 'Year is required.',
            'year.numeric' => 'Enter valid year.',
            'name_form.required' => 'This field is required.',
            'name_form.required' => 'Form field is required',
        ];
    }
}
