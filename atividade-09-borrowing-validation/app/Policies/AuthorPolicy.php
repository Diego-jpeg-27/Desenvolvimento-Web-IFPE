<?php

namespace App\Policies;

use App\Models\Author;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AuthorPolicy
{
    /**
     * O método 'before' é executado antes de qualquer outra regra.
     * Se for Admin, libera tudo imediatamente.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->isAdmin()) {
            return true; // Admin tem acesso irrestrito
        }

        return null; // Se não for admin, continua para as regras abaixo
    }

    // ------------------------------------------------------------------
    // RESTRIÇÕES DE ACESSO PARA CLIENTES A PARTIR DAQUI
    // ------------------------------------------------------------------

    /**
     * Apenas Bibliotecários podem ver a lista de autores (index).
     * O Cliente será bloqueado com 403.
     */
    public function viewAny(User $user): bool
    {
        return $user->isBibliotecario();
    }

    /**
     * Quem pode ver um autor específico?
     * Manter como true se o Cliente puder ver o detalhe (ex: link em um livro).
     * Se o Cliente não pode ver nem a lista, provavelmente também não precisa ver o detalhe.
     */
    public function view(User $user, Author $author): bool
    {
        return $user->isBibliotecario(); // Altere para 'return true;' se o Cliente PUDER ver o detalhe.
    }

    /**
     * Apenas Bibliotecários podem criar autores.
     */
    public function create(User $user): bool
    {
        return $user->isBibliotecario();
    }

    /**
     * Apenas Bibliotecários podem atualizar autores.
     */
    public function update(User $user, Author $author): bool
    {
        return $user->isBibliotecario();
    }

    /**
     * Apenas Bibliotecários podem deletar autores.
     */
    public function delete(User $user, Author $author): bool
    {
        return $user->isBibliotecario();
    }
}