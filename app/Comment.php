<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'title', 'body', 'user_id', 'book_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'id');
    }
}
