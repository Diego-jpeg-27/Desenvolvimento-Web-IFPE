<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    // Campos que podem ser preenchidos
    protected $fillable = ['user_id', 'book_id', 'borrowed_at', 'returned_at'];

    // Define que essas colunas devem ser tratadas como Datas (Carbon)
    protected $casts = [
        'borrowed_at' => 'datetime',
        'returned_at' => 'datetime',
    ];

    // --- Relacionamentos ---
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
    /**
     * Scope: active()
     * Filtra a query para retornar apenas empréstimos que ainda não foram devolvidos.
     * Exemplo de uso: Borrowing::active()->get();
     */
    public function scopeActive($query)
    {
        return $query->whereNull('returned_at');
    }


    /**
     * Method: isActive()
     * Verifica se esta instância específica de empréstimo está ativa (não devolvida).
     * Exemplo de uso: if ($borrowing->isActive()) 
     */
    public function isActive()
    {
        return is_null($this->returned_at);
    }


    /**
     * Verifica no banco se existe algum empréstimo ativo para o ID do livro informado.
     * Retorna true se estiver emprestado, false se estiver disponível.
     * Exemplo de uso: Borrowing::activeLoanForBook(5);
     */
    public static function activeLoanForBook($bookId)
    {
        // Usa o escopo active() definido acima para evitar repetição de código
        return self::where('book_id', $bookId)->active()->exists();
    }
}