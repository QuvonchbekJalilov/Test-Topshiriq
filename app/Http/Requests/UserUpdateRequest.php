<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'first_name' => 'nullable|string', 
            'last_name' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ];
    }
}
