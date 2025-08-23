<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ContactUs extends Model
{
    protected $table="contact_us";
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'datetime',
    ];
}
