<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

   
    public function rules(): array
    {
        return [
            'phone_number' => 'required|unique:users,phone_number',
            'password' => 'required|min:8'
        ];
    }
}
