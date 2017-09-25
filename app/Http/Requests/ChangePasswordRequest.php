<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'old_password' => 'required',
            'password' => 'required|different:old_password|same:password_confirmation',
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
            'old_password.required' => 'This field is required',
            'password.required' => 'Password field is required',
            'password.same' => 'Password does not match',
            'password.different' => 'Current password matchs new password',
            'password_confirmation.required' => 'Confirm is required',
        ];
    }
}
