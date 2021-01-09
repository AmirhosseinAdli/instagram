<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class UpdateRequest extends FormRequest
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
        $id = ',' . auth()->id() . ',id';
        return [
            'email' => 'sometimes|nullable|required_without_all:mobile|email|unique:users,email' . $id,
            'mobile' => 'sometimes|nullable|required_without_all:email|string|starts_with:09|min:11',
            'full_name' => 'required|string',
            'username' => 'sometimes|required|string|min:6|unique:users,username' . $id,
            'bio' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'password' => 'required|string|min:6',
            'gender' => 'nullable|sometimes|in:male,female',
            'is_private' => 'required|in:0,1',
            'media' => 'nullable|sometimes|file',
        ];
    }
}
