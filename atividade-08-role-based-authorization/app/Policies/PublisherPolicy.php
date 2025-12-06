<?php

namespace App\Policies;

use App\Models\Publisher;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PublisherPolicy
{
    /**
     * Admin Bypass: Garante que o Admin sempre tenha acesso.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->isAdmin()) {
            return true;
        }
        return null;
    }

    /**
     * Apenas Bibliotecário pode ver a lista de editoras (viewAny).
     */
    public function viewAny(User $user): bool
    {
        return $user->isBibliotecario();
    }

    /**
     * Apenas Bibliotecário pode ver uma editora específica.
     */
    public function view(User $user, Publisher $publisher): bool
    {
        return $user->isBibliotecario();
    }

    /**
     * Apenas Bibliotecário pode criar editoras.
     */
    public function create(User $user): bool
    {
        return $user->isBibliotecario();
    }

    /**
     * Apenas Bibliotecário pode atualizar editoras.
     */
    public function update(User $user, Publisher $publisher): bool
    {
        return $user->isBibliotecario();
    }

    /**
     * Apenas Bibliotecário pode deletar editoras.
     */
    public function delete(User $user, Publisher $publisher): bool
    {
        return $user->isBibliotecario();
    }
}