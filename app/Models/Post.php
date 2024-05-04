<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;  
    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];

    public function getUserById()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
