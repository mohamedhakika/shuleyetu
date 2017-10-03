<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTeacherRequest extends FormRequest
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
             'first_name' => 'required',
             'last_name' => 'required',
             'gender' => 'required',
             'email' => 'required|email|unique:users,email',
             'address' => 'required',
             'mobile' => 'required',
             'password' => 'required|same:password_confirmation',
             'password_confirmation' => 'required',
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
             'first_name.required' => 'Name field is required',
             'last_name.required' => 'Name field is required',
             'email.required' => 'E-Mail field is required',
             'email.email' => 'Enter valid E-Mail address',
             'email.unique' => 'This email is taken',
             'gender.required' => 'Gender field is required',
             'address.required' => 'Address is required',
             'mobile.required' => 'Mobile number is required',
             'password.required' => 'Password field is required',
             'password.same' => 'Password does not match',
             'password_confirmation.required' => 'Confirm is required',
         ];
     }
}
