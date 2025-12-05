<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Lista todos os usuários (Apenas para Admin)
     */
    public function index()
    {
        // Segurança: Bloqueia quem não é admin
        if (auth()->user()->role !== 'admin') {
            abort(403, 'ACESSO NEGADO: Apenas administradores podem gerenciar usuários.');
        }

        // Paginação
        $users = User::orderBy('id', 'desc')->paginate(10);
        
        return view('users.index', compact('users'));
    }

    /**
     * Exibe o formulário de edição (Focado no Papel do usuário)
     */
    public function edit(User $user)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'ACESSO NEGADO.');
        }

        return view('users.edit', compact('user'));
    }

    /**
     * Atualiza o papel do usuário no banco
     */
    public function update(Request $request, User $user)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'ACESSO NEGADO.');
        }

        // Validação: Garante que o role enviado é válido
        $validated = $request->validate([
            'role' => ['required', Rule::in(['admin', 'bibliotecario', 'cliente'])],
        ]);

        // Atualiza apenas o role (conforme a View criada anteriormente)
        // permitir editar nome/email também, adicione-os na validação acima
        $user->update($validated);

        return redirect()->route('users.index')
            ->with('success', 'Permissões do usuário atualizadas com sucesso.');
    }
}