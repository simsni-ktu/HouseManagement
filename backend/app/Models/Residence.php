<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residence extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'rooms_number',
        'square_meters',
        'type',
        'description'
    ];
}
//$table->id();
//$table->string('address');
//$table->string('rooms_number');
//$table->string('square_meters');
//$table->enum('type', ['apartment', 'house', 'cottage']);
//$table->text('description');
//$table->timestamps();
