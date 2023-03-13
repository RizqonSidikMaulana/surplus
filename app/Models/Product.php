<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'enable',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot',
    ];

    public function categories() {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function images() {
        return $this->belongsToMany(Image::class, 'product_image');
    }
}
