<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserResetPassword extends FormRequest
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
             'password.required' => 'Password field is required',
             'password.same' => 'Passwords does not match',
             'password_confirmation.required' => 'Confirm password is required',
         ];
     }
}
