<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residence extends Model
{
    use HasFactory;

    protected $fillable = [
        'city',
        'street',
        'rooms_number',
        'square_meters',
        'type',
        'description'
    ];
}
