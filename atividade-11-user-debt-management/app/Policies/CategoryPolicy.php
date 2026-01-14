<?php
namespace App\Policies;
use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\Response;
class CategoryPolicy
{
    /** Admin Bypass: Garante que o Admin sempre tenha acesso.**/
    public function before(User $user, string $ability): bool|null
    {
        if ($user->isAdmin()) {
            return true;
        }
        return null;
    }


    /**
     * Apenas Bibliotecário pode ver a lista de categorias (viewAny).
     */
    public function viewAny(User $user): bool
    {
        return $user->isBibliotecario();
    }


    /**
     * Apenas Bibliotecário pode ver uma categoria específica.
     */
    public function view(User $user, Category $category): bool
    {
        return $user->isBibliotecario();
    }


    /**
     * Apenas Bibliotecário pode criar categorias.
     */
    public function create(User $user): bool
    {
        return $user->isBibliotecario();
    }


    /**
     * Apenas Bibliotecário pode atualizar categorias.
     */
    public function update(User $user, Category $category): bool
    {
        return $user->isBibliotecario();
    }


    /**
     * Apenas Bibliotecário pode deletar categorias.
     */
    public function delete(User $user, Category $category): bool
    {
        return $user->isBibliotecario();
    }
}