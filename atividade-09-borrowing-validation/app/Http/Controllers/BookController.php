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
        $book->load(['author', 'publisher', 'category']);
        $users = User::all();


        return view('books.show', compact('book','users'));
    }


    public function index()
    {
        $books = Book::with('author')->paginate(20);
        return view('books.index', compact('books'));
    }


    public function edit(Book $book)
    {
        $publishers = Publisher::all();
        $authors = Author::all();
        $categories = Category::all();


        return view('books.edit', compact('book', 'publishers', 'authors', 'categories'));
    }


    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'publisher_id' => 'required|exists:publishers,id',
            'author_id'    => 'required|exists:authors,id',
            'category_id'  => 'required|exists:categories,id',
            'cover_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        // Upload de nova capa (se enviada)
        if ($request->hasFile('cover_image')) {


            // remover capa antiga (se existir)
            if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
                Storage::disk('public')->delete($book->cover_image);
            }


            // salvar nova capa
            $path = $request->file('cover_image')->store('covers', 'public');
            $book->cover_image = $path;
        }


        // outros campos
        $book->title        = $request->title;
        $book->publisher_id = $request->publisher_id;
        $book->author_id    = $request->author_id;
        $book->category_id  = $request->category_id;


        $book->save();


        return redirect()->route('books.index')->with('success', 'Livro atualizado com sucesso.');
    }


    // FORM ID
    public function createWithId()
    {
    $publishers = Publisher::all();
    $authors = Author::all();
    $categories = Category::all();


    return view('books.create-id', compact('publishers', 'authors', 'categories'));
    }


    public function storeWithId(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'pages'        => 'required|integer|min:1',
            'publisher_id' => 'required|exists:publishers,id',
            'author_id'    => 'required|exists:authors,id',
            'category_id'  => 'required|exists:categories,id',
            'cover_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        $data = $request->only('title','pages','publisher_id','author_id','category_id');


        // Upload de capa
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }


        Book::create($data);


        return redirect()->route('books.index')->with('success', 'Livro criado com sucesso.');
    }


    // FORM SELECT
    public function createWithSelect()
    {
        $publishers = Publisher::all();
        $authors = Author::all();
        $categories = Category::all();


        return view('books.create-select', compact('publishers','authors','categories'));
    }


    public function storeWithSelect(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'pages'        => 'required|integer|min:1',
            'publisher_id' => 'required|exists:publishers,id',
            'author_id'    => 'required|exists:authors,id',
            'category_id'  => 'required|exists:categories,id',
            'cover_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        $data = $request->only('title','pages','publisher_id','author_id','category_id');


        // Upload da capa
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }


        Book::create($data);


        return redirect()->route('books.index')->with('success', 'Livro criado com sucesso.');
    }


    //  REMOVER CAPA AO DELETAR LIVRO
    public function destroy(Book $book)
    {
        // remover arquivo de capa
        if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
            Storage::disk('public')->delete($book->cover_image);
        }


        $book->delete();


        return redirect()->route('books.index')->with('success', 'Livro removido com sucesso.');
    }
}