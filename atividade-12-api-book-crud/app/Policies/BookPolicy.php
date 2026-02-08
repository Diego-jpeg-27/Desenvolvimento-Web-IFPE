<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BookPolicy
{
   
    public function before(User $user, string $ability): bool|null
    {
        if ($user->isAdmin()) {
            return true;
        }

        return null; 
    }

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Book $book): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->isBibliotecario();
    }

    public function update(User $user, Book $book): bool
    {
        return $user->isBibliotecario();
    }

    public function delete(User $user, Book $book): bool
    {
        return $user->isBibliotecario();
    }

    public function borrow(User $user, Book $book): bool
    {
        return $user->role === 'admin' || $user->role === 'bibliotecario';
    }
}