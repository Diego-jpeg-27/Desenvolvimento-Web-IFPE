<?php

namespace App\Models;

//Adicionado o trait HasFactory, Mesmo que as factories ainda não tenham sido criadas, o uso antecipado de HasFactory prepara o modelo.
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}