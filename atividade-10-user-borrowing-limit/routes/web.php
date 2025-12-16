<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

/*
Rotas Protegidas (Requer Login)
*/
Route::middleware(['auth'])->group(function () {

    // --- Gestão de Livros e Recursos ---
    Route::resource('publishers', PublisherController::class);
    Route::resource('authors', AuthorController::class);
    Route::resource('categories', CategoryController::class);


    // Rotas customizadas de criação (antes do resource books)
    Route::get('/books/create-id-number', [BookController::class, 'createWithId'])->name('books.create.id');
    Route::post('/books/create-id-number', [BookController::class, 'storeWithId'])->name('books.store.id');
    Route::get('/books/create-select', [BookController::class, 'createWithSelect'])->name('books.create.select');
    Route::post('/books/create-select', [BookController::class, 'storeWithSelect'])->name('books.store.select');


    // Resource Books (excluindo create/store pois já foram definidos acima)
    Route::resource('books', BookController::class)->except(['create', 'store']);


    // --- Funcionalidades de Empréstimo ---
    Route::post('/books/{book}/borrow', [BorrowingController::class, 'store'])->name('books.borrow');
    Route::get('/users/{user}/borrowings', [BorrowingController::class, 'userBorrowings'])->name('users.borrowings');
    Route::patch('/borrowings/{borrowing}/return', [BorrowingController::class, 'returnBook'])->name('borrowings.return');


    // --- ADMINISTRAÇÃO DE USUÁRIOS ---
    // (Substitui o antigo Route::resource('users'))
    // Estas rotas usam o UserController protegido que criamos
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('users.update');

});