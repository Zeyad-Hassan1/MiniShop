<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class registerrequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|string|min:4|max:255',
            'username'=>'required|string|min:3|max:12',
            'email'=>'required|email|unique:users,email',
            'mobile_phone'=>'required|string|min:11|max:20|unique:users,mobile_phone',
            'password'=>'required|min:8|confirmed',
        ];
    }
    public function messages(){
        return [
            'mobile_phone.unique'=> 'this mobile phone is already taken',
        ];
    }
}
