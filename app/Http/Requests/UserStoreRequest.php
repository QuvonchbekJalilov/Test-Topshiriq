<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'photo' => 'nullable|file|max:4048',
        ];
    }
}
