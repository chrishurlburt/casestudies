<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsersPasswordRequest extends Request
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
            'password' => 'required|confirmed|min:6',
            'password_confirmation'  => 'required'
        ];
    }

    /**
     * Custom error messages.
     *
     * @return array
     */
    public function  messages()
    {
        return [
            'password.required'         => 'The password field is required.',
            'password.confirmed'        => 'The passwords do not match.',
            'password_confirm.required' => 'You must confirm the new password.'
        ];
    }
}
