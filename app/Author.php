<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'name',
        'surname',
        'date_of_birth',
        'date_of_death',
        'biography'
    ];
    public function books() 
    {
    	return $this->hasMany(Book::class);
    }
}
