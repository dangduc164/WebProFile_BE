<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilesSocial extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'facebook_url',
        'twitter_url',
        'github_url',
        'zalo_url',
        'instagram_url',
    ];


    protected $casts = [
        'created_at'  => 'date:d-m-Y H:i:s',
        'updated_at' => 'date:d-m-Y H:i:s',
    ];
}
