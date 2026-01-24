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
        // SEGURANÇA (ACL): Verifica se o usuário pode emprestar (Admin/Bibliotecário)
        $this->authorize('borrow', $book);

        // VALIDAÇÃO DE DUPLICIDADE
        // Usa o método do Model para verificar se já existe empréstimo ativo
        if (Borrowing::activeLoanForBook($book->id)) {

            // Se já estiver emprestado, impede a criação e volta com erro
            return redirect()->back()->with('error', 'Este livro já possui um empréstimo ativo e não pode ser emprestado novamente.');
        }

        // VALIDAÇÃO DOS DADOS
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);
        // BUSCA O USUARIO SELECIONADO
        $user = User::find($request->user_id);
        
        // VERIFICA SE O LIMITE FOI ATINGIDO
        if ($user->hasReachedLoanLimit()) {
            return redirect()->back()->with('error', "O usuário {$user->name} já atingiu o limite máximo de 5 empréstimos simultâneos.");
        }

         // CRIAÇÃO DO EMPRÉSTIMO
        Borrowing::create([
            'user_id' => $request->user_id,
            'book_id' => $book->id,
            'borrowed_at' => now(),
        ]);

        return redirect()->route('books.show', $book)->with('success', 'Empréstimo registrado com sucesso.');
    }

    public function returnBook(Borrowing $borrowing)
    {
        // SEGURANÇA: Verifica permissão antes de devolver
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

    public function show(Book $book)
    {
        $book->load(['author', 'publisher', 'category']);
        $users = User::all();
        return view('books.show', compact('book', 'users'));
    }
}