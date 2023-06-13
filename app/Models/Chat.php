<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversation_id',
        'user_id',
        'content',
    ];

    public function talk()
    {
        return $this->belongsTo(Talk::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
