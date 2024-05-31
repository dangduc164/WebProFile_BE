<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformationUser extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'full_name',
        'birthday_inder',
        'day',
        'month',
        'year',
        'gender',
        'address',
        'email',
        'phone_number',
        'work_experience',
        'position_application',
    ];


    protected $casts = [
        'created_at'  => 'date:d-m-Y H:i:s',
        'updated_at' => 'date:d-m-Y H:i:s',
    ];
}
