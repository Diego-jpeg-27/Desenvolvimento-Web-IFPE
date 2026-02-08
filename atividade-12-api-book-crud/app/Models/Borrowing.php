<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    // Define os campos que podem ser preenchidos (Mass Assignment)
    protected $fillable = [
        'user_id',
        'book_id',
        'borrowed_at',
        'returned_at',
    ];

    // Define que essas colunas devem ser tratadas como Datas 
    protected $casts = [
        'borrowed_at' => 'datetime',
        'returned_at' => 'datetime',
    ];

    // Um empréstimo pertence a um Usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Um empréstimo pertence a um Livro
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    public function scopeActive($query)
    {
        return $query->whereNull('returned_at');
    }
    public function isActive()
    {
        return is_null($this->returned_at);
    }

    public static function activeLoanForBook($bookId)
    {
        // Usa o escopo active() definido acima para evitar repetição de código
        return self::where('book_id', $bookId)->active()->exists();
    }
}