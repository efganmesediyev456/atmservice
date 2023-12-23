<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserRequest extends FormRequest
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
        $id = $this->route('user');

        $rules=[
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.$id,
            'balance'=>'required|numeric',
            'password'=>[]
        ];

        if(is_null($id)){
            $rules['password']=['required','confirmed','digits:4'];
        }

        if(!is_null($id) and $this->password){
            $rules['password']=['confirmed','digits:4'];
        }

        return $rules;
    }
}
