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
}
