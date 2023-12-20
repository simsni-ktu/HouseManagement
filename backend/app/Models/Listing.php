<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'residence_id',
        'price',
        'fix_deadline',
        'issue_type',
        'description',
    ];

    public function comments(): HasMany
    {
        return  $this->hasMany(Comment::class);
    }
    public function residence() {
        return $this->belongsTo(Residence::class);
    }
}

