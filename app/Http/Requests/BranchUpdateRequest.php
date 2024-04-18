<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BranchUpdateRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            'brand_id' => 'required',
            'name' => 'required',
            'region_id' => 'required',
            'district_id' => 'required',
            'images' => 'image|mimes:png,jpg,jpeg|max:2048'
        ];
    }
}
