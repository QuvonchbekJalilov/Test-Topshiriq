<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BranchStoreRequest extends FormRequest
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
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ];
    }
}
