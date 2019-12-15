<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @summary Updating of user
 *
 * @description
 *  This request mostly needed to specity flags <strong>free_comparison</strong> and
 *  <strong>all_cities_available</strong> of user
 *
 * @summary Test Post Request for Create/Update User
 *
 * @_204 This request has successfully done
 * @_401 You must remove need-authorization flag from input parameters for pass authorization.
 * @_404 We so sorry but you entity not exists.
 * @_422 Wrong input parameter. It must be integer
 *
 * @need-authorization If this parameter is true then you will get 401 response
 * @not-found If this parameter is true then you will get 404 response
 * @test-parameter This parameter designed for demonstrate unprocesable entity response
 */
class UserRequest extends FormRequest
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
            'first_name' => 'required|min:2|max:128',
            'last_name'  => 'required|min:2|max:128',
            'phone'      => 'required|min:5|max:16',
            'email'      => 'required|email|unique:users|max:255',
            'password'   => 'required|min:8|max:16'
        ];
        switch ($this->getMethod()) {
            case 'POST':
                return $rules;
            case 'PUT':
                return [] + $rules;
            // case 'PATCH':
            //case 'DELETE':
        }
        return NULL;
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
