<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilesSocail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'icon',
        'link_url',
        'title',
        'order_number',
    ];
}
