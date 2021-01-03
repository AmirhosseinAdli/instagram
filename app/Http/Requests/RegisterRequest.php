<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RegisterRequest extends FormRequest
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
            'full_name' => 'sometimes|nullable|string',
            'username' => 'required|string|min:6|unique:users,username',
            'password' => 'required|string|min:6',
            'birthdate' => 'sometimes|nullable|date',
        ];
        if (str_contains($request->moe,'@'))
            $arr['moe'] = 'required|email|unique:users,email';
        else
            $arr['moe'] = 'required|string|min:11';
        return $arr;
    }
}
