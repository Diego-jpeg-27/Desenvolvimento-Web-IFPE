<?php

namespace App\Http\Controllers;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    // Exibe uma lista de autores
    public function index()
    {
        // Bloqueia o acesso se não tiver permissão 'viewAny' (Cliente, Biblio, Admin)
        $this->authorize('viewAny', Author::class);


        $authors = Author::all();
        return view('authors.index', compact('authors'));
    }


    // Mostra o formulário para criar um novo autor
    public function create()
    {
        // Bloqueia o acesso se não tiver permissão 'create' (Apenas Admin ou Bibliotecário)
        $this->authorize('create', Author::class);


        return view('authors.create');
    }


    // Armazena um novo autor no banco de dados
    public function store(Request $request)
    {
        // Bloqueia a ação se não tiver permissão 'create'
        $this->authorize('create', Author::class);


        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:authors,email',
            'birth_date' => 'nullable|date',
        ]);


        Author::create($request->only(['name', 'email', 'birth_date']));


        return redirect()->route('authors.index')->with('success', 'Autor criado com sucesso.');
    }


    // Exibe um autor específico
    public function show(Author $author)
    {
        // Bloqueia o acesso se não tiver permissão 'view' (Todos devem ter)
        $this->authorize('view', $author);


        return view('authors.show', compact('author'));
    }


    // Mostra o formulário para editar um autor existente
    public function edit(Author $author)
    {
        // Bloqueia o acesso se não tiver permissão 'update'
        $this->authorize('update', $author);


        return view('authors.edit', compact('author'));
    }


    // Atualiza um autor no banco de dados
    public function update(Request $request, Author $author)
    {
        // Bloqueia a ação se não tiver permissão 'update'
        $this->authorize('update', $author);


        $request->validate([
            'name' => 'required|string|unique:authors,name,' . $author->id . '|max:255',
            'email' => 'nullable|email|unique:authors,email,' . $author->id,
            'birth_date' => 'nullable|date',
        ]);


        $author->update($request->only(['name', 'email', 'birth_date']));


        return redirect()->route('authors.index')->with('success', 'Autor atualizado!');
    }


    // Remove um autor do banco de dados
    public function destroy(Author $author)
    {
        // Bloqueia a ação se não tiver permissão 'delete'
        $this->authorize('delete', $author);


        $author->delete();


        return redirect()->route('authors.index')->with('success', 'Autor excluído com sucesso.');
    }
}