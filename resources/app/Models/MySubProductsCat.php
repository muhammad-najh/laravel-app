<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MySubProductsCat extends Model
{
    use HasFactory;
    protected $table = 'my_sub_products_cat';

    public function subcategories()
    {
        return $this->belongsTo(MyProductsCat::class, 'product_id');
    }
}
