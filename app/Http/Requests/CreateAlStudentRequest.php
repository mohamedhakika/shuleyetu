<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAlStudentRequest extends FormRequest
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
        $mwaka=date('Y');
        return [
            'name' => 'required',  
            'reg_no' => 'required|unique:students,reg_no',  
            'form_id' => 'required',  
            'combination' => 'required|numeric',  
            'gender' => 'required',  
            'day' => 'required|numeric|min:1|max:31',  
            'month' => 'required|numeric|min:1|max:12',  
            'year' => "required|numeric|min:1900|max:$mwaka",  
            'year_admitted' => "required|numeric|max:$mwaka",  
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
            'name.required' => 'Name field is required',
            'email.required' => 'E-Mail field is required',
            'email.email' => 'Enter valid E-Mail address',
            'email.unique' => 'This email is taken',
            'gender.required' => 'Gender field is required',
            'reg_no.required' => 'Regstration number required',  
            'reg_no.unique' => 'This Reg number is taken',  
            'form_id.required' => 'Form is required',   
            'combination.required' => 'Combination required',   
            'combination.numeric' => 'This should be numeric',   
            'day.required' => 'Date is required',  
            'day.numeric' => 'Date should be numeric value',  
            'month.required' => 'Month is required',  
            'year.required' => 'Year is required',  
            'year_admitted.required' => 'Year admitted is required', 
            'year_admitted.numeric' => 'This should be numeric', 
            'year_admitted.max' => 'This can\'t be above current year ', 
            'address.required' => 'Address is required',  
            'mobile.required' => 'Mobile number is required',
            'password.required' => 'Password field is required',
            'password.same' => 'Password does not match',
            'password_confirmation.required' => 'Confirm is required',
        ];
    }
}
