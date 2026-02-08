<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookControllerApi extends Controller
{
    /**
     * Listar todos os livros com seus relacionamentos.
     */
    public function index()
    {
        // Eager Loading para performance 
        $books = Book::with(['author', 'publisher', 'category'])->get();
        return response()->json($books, 200);
    }

    /**
     * Criar um novo livro via API.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'pages' => 'required|integer|min:1',
            'publisher_id' => 'required|exists:publishers,id',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Lógica de Upload de Capa 
        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('books', 'public');
            $validatedData['cover_image'] = $path;
        }

        $book = Book::create($validatedData);

        return response()->json([
            'message' => 'Livro criado com sucesso via API',
            'data' => $book
        ], 201);
    }

    /**
     * Exibir os detalhes de um livro específico.
     */
    public function show($id)
    {
        $book = Book::with(['author', 'publisher', 'category'])->find($id);

        if (!$book) {
            return response()->json(['message' => 'Livro não encontrado'], 404);
        }

        return response()->json($book, 200);
    }

    /**
     * Atualizar um livro existente.
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Livro não encontrado'], 404);
        }

        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'pages' => 'sometimes|required|integer|min:1',
            'publisher_id' => 'sometimes|required|exists:publishers,id',
            'author_id' => 'sometimes|required|exists:authors,id',
            'category_id' => 'sometimes|required|exists:categories,id',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $path = $request->file('cover_image')->store('books', 'public');
            $validatedData['cover_image'] = $path;
        }

        $book->update($validatedData);

        return response()->json([
            'message' => 'Livro atualizado com sucesso',
            'data' => $book
        ], 200);
    }

    /**
     * Remover um livro do sistema.
     */
    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Livro não encontrado'], 404);
        }

        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }

        $book->delete();

        return response()->json(['message' => 'Livro removido com sucesso'], 200);
    }
}