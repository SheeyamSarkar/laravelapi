<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable =['name','description','year'];

    public function author(){
    	return $this->hasManyThrough('\App\Models\Author','\App\Models\BookAuthor');
    }


}
