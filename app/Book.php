<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use Notifiable;

    protected $fillable = [
        'title',
    	'author_id',
    	'genre_id',
    	'description'
    ];

    public function author()
    {
    	return $this->belongsTo(Author::class, 'id');
    }

    public function genre()
    {
    	return $this->belongsTo(Genre::class);
    }

    public function comments() 
    {
    	return $this->hasMany(Comment::class, 'book_id');
    }
}
