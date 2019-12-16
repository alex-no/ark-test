<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
     * Get the validation rules that apply to the request about User.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'email'    => 'required|email|max:255',
            'password' => 'required|min:8|max:16'
        ];
        return $rules;
    }

    /**
     * Determine if the request is sending JSON.
     *
     * @return bool
     */
    public function isJson()
    {
        return true;
    }
}
