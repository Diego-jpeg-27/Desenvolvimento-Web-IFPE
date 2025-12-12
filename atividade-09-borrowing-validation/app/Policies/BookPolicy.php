<?php


namespace App\Policies;


use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\Response;
class BookPolicy
{
    /**
     * O método 'before' é executado antes de qualquer outra regra.
     * Se for Admin, libera tudo imediatamente.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->isAdmin()) {
            return true;
        }
        return null; // Se não for admin, continua para as regras abaixo
    }
    /**
     * Quem pode ver a lista de livros?
     * Todos os usuários logados.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }
    /**
     * Quem pode ver um livro específico?
     * Todos os usuários logados.
     */
    public function view(User $user, Book $book): bool
    {
        return true;
    }
    /**
     * Quem pode criar livros?
     * Apenas Bibliotecários (Admin já foi liberado no before).
     */
    public function create(User $user): bool
    {
        return $user->isBibliotecario();
    }
    /**
     * Quem pode atualizar livros?
     * Apenas Bibliotecários.
     */
    public function update(User $user, Book $book): bool
    {
        return $user->isBibliotecario();
    }
    /**
     * Quem pode deletar livros?
     * Apenas Bibliotecários.
     */
    public function delete(User $user, Book $book): bool
    {
        return $user->isBibliotecario();
    }
}