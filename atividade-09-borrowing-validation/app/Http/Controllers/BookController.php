<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Publisher;
use App\Models\Author;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function show(Book $book)
    {
        $this->authorize('view', $book);

        $book->load(['author', 'publisher', 'category']);
        $users = User::all();

        return view('books.show', compact('book', 'users'));
    }

    public function index()
    {
        $this->authorize('viewAny', Book::class);

        $books = Book::with('author')->paginate(20);
        return view('books.index', compact('books'));
    }

    public function edit(Book $book)
    {
        $this->authorize('update', $book);

        $publishers = Publisher::all();
        $authors = Author::all();
        $categories = Category::all();

        return view('books.edit', compact('book', 'publishers', 'authors', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $this->authorize('update', $book);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'publisher_id' => 'required|exists:publishers,id',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            // Remove capa antiga antes de salvar a nova
            if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
                Storage::disk('public')->delete($book->cover_image);
            }
            // Salva o caminho do arquivo no array validado
            $validatedData['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        // Requer que 'cover_image' e outros campos estejam no $fillable do Model Book.
        $book->update($validatedData);

        return redirect()->route('books.index')->with('success', 'Livro atualizado com sucesso.');
    }

    public function createWithId()
    {
        $this->authorize('create', Book::class);

        $publishers = Publisher::all();
        $authors = Author::all();
        $categories = Category::all();

        return view('books.create-id', compact('publishers', 'authors', 'categories'));
    }

    public function storeWithId(Request $request)
    {
        $this->authorize('create', Book::class);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'pages' => 'required|integer|min:1',
            'publisher_id' => 'required|exists:publishers,id',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            $validatedData['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        // array completo $validatedData, que contém 'cover_image' se houver.
        Book::create($validatedData);

        return redirect()->route('books.index')->with('success', 'Livro criado com sucesso.');
    }

    public function createWithSelect()
    {
        $this->authorize('create', Book::class);

        $publishers = Publisher::all();
        $authors = Author::all();
        $categories = Category::all();

        return view('books.create-select', compact('publishers', 'authors', 'categories'));
    }

    public function storeWithSelect(Request $request)
    {
        $this->authorize('create', Book::class);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'pages' => 'required|integer|min:1',
            'publisher_id' => 'required|exists:publishers,id',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            $validatedData['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        Book::create($validatedData);

        return redirect()->route('books.index')->with('success', 'Livro criado com sucesso.');
    }

    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);

        if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
            Storage::disk('public')->delete($book->cover_image);
        }

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Livro removido com sucesso.');
    }
}