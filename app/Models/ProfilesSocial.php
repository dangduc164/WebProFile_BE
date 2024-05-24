<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilesSocial extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'icon',
        'link_url',
        'title',
        'order_number',
    ];


    protected $casts = [
        'created_at'  => 'date:d-m-Y H:i:s',
        'updated_at' => 'date:d-m-Y H:i:s',
    ];
}
