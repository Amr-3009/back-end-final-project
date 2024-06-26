<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'time',
        'date',
        'name',
        'phone',
        'Number_of_people',
        'user_id',
        'status'
    ];
}