<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MyProductsCat extends Model
{
    use HasFactory;
    protected $table = 'my_products_cat';

    protected $fillable = [
        'name_en', 'name_ar', 'name_krd', 'url', 'created_at', 'updated_at'
    ];

    public function subcategories()
    {
        return $this->hasMany(MySubProductsCat::class, 'product_id');
    }
}
