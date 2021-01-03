<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class LoginRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $arr = [
            'password' => 'required|string|min:6'
        ];
        if (str_contains($request->meu,'@'))
            $arr['meu'] = 'required|email|unique:users,email';
        else
            $arr['meu'] = 'required|string|min:6';
        return $arr;
    }
}
