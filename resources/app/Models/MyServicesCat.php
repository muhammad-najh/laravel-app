<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MyServicesCat extends Model
{
    protected $table = 'my_services_cat';
    use HasFactory;

    public function subcategories()
    {
        return $this->hasMany(MySubServicesCat::class, 'service_id');
    }
   
}
