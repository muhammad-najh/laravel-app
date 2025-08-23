<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MySubServicesCat extends Model
{
    protected $table = 'my_sub_services_cat';
    use HasFactory;
    public function category()
    {
        return $this->belongsTo(MyServicesCat::class, 'services_id');
    }
}
