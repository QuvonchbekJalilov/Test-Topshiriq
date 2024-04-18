<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'logo' => 'nullable|file|max:4048'
        ];
    }
}
