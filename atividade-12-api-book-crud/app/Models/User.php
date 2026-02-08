<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function books()
    {
        return $this->belongsToMany(Book::class, 'borrowings')
            ->withPivot('id', 'borrowed_at', 'returned_at')
            ->withTimestamps();
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isBibliotecario(): bool
    {
        return $this->role === 'bibliotecario';
    }

    public function isCliente(): bool
    {
        return $this->role === 'cliente';
    }

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }
    public function activeLoansCount(): int
    {
        return $this->books()->wherePivot('returned_at', null)->count();
    }
    public function hasReachedLoanLimit(): bool
    {
        return $this->activeLoansCount() >= 5;
    }
}