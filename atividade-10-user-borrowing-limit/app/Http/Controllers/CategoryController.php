<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Exibe uma lista de categorias
    public function index()
    {
        // Regra: viewAny. Permite Cliente/Biblio/Admin verem a lista (conforme a Policy)
        $this->authorize('viewAny', Category::class);


        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }


    // Mostra o formulário para criar uma nova categoria
    public function create()
    {
        // Regra: create. Apenas Admin e Bibliotecário
        $this->authorize('create', Category::class);


        return view('categories.create');
    }


    // Armazena uma nova categoria no banco de dados
    public function store(Request $request)
    {
        // Regra: create. Apenas Admin e Bibliotecário
        $this->authorize('create', Category::class);


        $request->validate([
            'name' => 'required|string|unique:categories|max:255',
        ]);


        Category::create($request->all());


        return redirect()->route('categories.index')->with('success', 'Categoria criada com sucesso.');
    }


    // Exibe uma categoria específica
    public function show(Category $category)
    {
        // Regra: view. Permite todos verem os detalhes
        $this->authorize('view', $category);


        return view('categories.show', compact('category'));
    }


    // Mostra o formulário para editar uma categoria existente
    public function edit(Category $category)
    {
        // Regra: update. Apenas Admin e Bibliotecário
        $this->authorize('update', $category);


        return view('categories.edit', compact('category'));
    }


    // Atualiza uma categoria no banco de dados
    public function update(Request $request, Category $category)
    {
        // Regra: update. Apenas Admin e Bibliotecário
        $this->authorize('update', $category);


        $request->validate([
            'name' => 'required|string|unique:categories,name,' . $category->id . '|max:255',
        ]);


        $category->update($request->all());


        return redirect()->route('categories.index')->with('success', 'Categoria atualizada com sucesso.');
    }


    // Remove uma categoria do banco de dados
    public function destroy(Category $category)
    {
        // Regra: delete. Apenas Admin e Bibliotecário
        $this->authorize('delete', $category);


        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Categoria excluída com sucesso.');
    }
}
