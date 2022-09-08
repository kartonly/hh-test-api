<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255|string',
            'email' => 'required|email|unique:users|max:255|string',
            'password' => 'required|confirmed|min:8',
        ];
    }
}
