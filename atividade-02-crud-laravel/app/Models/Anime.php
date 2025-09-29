<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    protected $fillable = ['title', 'description', 'genre', 'creator', 'release_year'];
}