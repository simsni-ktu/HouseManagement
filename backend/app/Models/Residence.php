<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Residence extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'city',
        'street',
        'rooms_number',
        'square_meters',
        'type',
        'description'
    ];

    public function listings(): hasMany
    {
        return  $this->hasMany(Listing::class);
    }
}
