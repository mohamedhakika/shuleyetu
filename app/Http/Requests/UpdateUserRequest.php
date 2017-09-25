<?php

namespace App\Http\Requests;

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
        $id=$this->route('id');
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'roles' => 'required'
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
            'name.required' => 'Name field is required',
            'email.required' => 'E-Mail field is required',
            'email.email' => 'Enter valid E-Mail address',
            'email.unique' => 'This email is taken',
            'role_id.required' => 'Role field is required',
            'gender.required' => 'Gender field is required',
        ];
    }
}
