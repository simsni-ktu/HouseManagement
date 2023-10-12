<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'listing_id',
        'user_id',
        'comment_text'
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}
