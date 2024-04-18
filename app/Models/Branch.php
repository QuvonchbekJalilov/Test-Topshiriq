<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = ['brand_id','name', 'region_id', 'district_id', 'images'];


    protected $casts = [
        'images' => 'array',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
