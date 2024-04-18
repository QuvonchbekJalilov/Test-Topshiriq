<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandUpdateRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        
        return [
            'name' => 'nullable',
            'logo' => 'nullable|file|max:4048'
        ];
    }
}
