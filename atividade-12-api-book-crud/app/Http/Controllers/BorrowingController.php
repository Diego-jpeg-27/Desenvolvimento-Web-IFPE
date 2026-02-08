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
        $this->authorize('borrow', $book);

        if (Borrowing::activeLoanForBook($book->id)) {
            return redirect()->back()->with('error', 'Este livro já possui um empréstimo ativo e não pode ser emprestado novamente.');
            return redirect()->back()->with('error', 'Este livro já possui um empréstimo ativo.');
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::find($request->user_id);

        // Pedágio 1 : Limite de quantidade
        if ($user->hasReachedLoanLimit()) {
            return redirect()->back()->with('error', "O usuário {$user->name} já atingiu o limite de 5 livros.");
        }

        //  Pedágio 2 : Bloqueio por DÉBITO (Adicione estas linhas abaixo)
        if ($user->hasDebits()) {
            return redirect()->back()->with('error', "Empréstimo NEGADO: O usuário {$user->name} possui um débito pendente de R$ " . number_format($user->debit, 2, ',', '.') . ".");
        }

        // Se passou pelos dois, cria o empréstimo
        Borrowing::create([
            'user_id' => $request->user_id,
            'book_id' => $book->id,
            'borrowed_at' => now(),
        ]);

        return redirect()->route('books.show', $book)->with('success', 'Empréstimo realizado!');
    }

    public function returnBook(Borrowing $borrowing)
    {
        $this->authorize('borrow', $borrowing->book);

        $hoje = now();
        // Seu cálculo de dias 
        $diasEmprestado = $borrowing->borrowed_at->diffInDays($hoje);
        $prazoMaximo = 15;

        // A Lógica da Multa
        if ($diasEmprestado > $prazoMaximo) {
            $diasAtraso = $diasEmprestado - $prazoMaximo;
            $valorMulta = $diasAtraso * 0.50;

            // Acessamos o usuário dono do empréstimo e somamos o débito
            $user = $borrowing->user;
            $user->debit += $valorMulta;
            $user->save();

           $mensagemSucesso = "Devolução registrada com atraso de " . intval($diasAtraso) . " dias. Multa de R$ " . number_format($valorMulta, 2, ',', '.') . " adicionada ao débito.";
        } else {
            $mensagemSucesso = 'Devolução registrada com sucesso.';
        }

        // Atualiza o registro do empréstimo
        $borrowing->update([
            'returned_at' => $hoje,
        ]);

        return redirect()->route('books.show', $borrowing->book_id)->with('success', $mensagemSucesso);
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