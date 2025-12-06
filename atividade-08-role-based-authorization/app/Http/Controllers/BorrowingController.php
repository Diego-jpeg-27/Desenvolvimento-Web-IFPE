<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Borrowing; 

class BorrowingController extends Controller
{
    public function store(Request $request, Book $book)
    {
        // Verifica se o usuário tem permissão para emprestar
        // Isso bloqueia Clientes e permite apenas Admin/Bibliotecário
        $this->authorize('borrow', $book);

        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        Borrowing::create([
            'user_id' => $request->user_id,
            'book_id' => $book->id,
            'borrowed_at' => now(),
        ]);

        return redirect()->route('books.show', $book)->with('success', 'Empréstimo registrado com sucesso.');
    }

    public function returnBook(Borrowing $borrowing)
    {
        $this->authorize('borrow', $borrowing->book);

        $borrowing->update([
            'returned_at' => now(),
        ]);

        return redirect()->route('books.show', $borrowing->book_id)->with('success', 'Devolução registrada com sucesso.');
    }

    public function userBorrowings(User $user)
    {
        $borrowings = $user->books()->withPivot('borrowed_at', 'returned_at')->get();

        return view('users.borrowings', compact('user', 'borrowings'));
    }
}