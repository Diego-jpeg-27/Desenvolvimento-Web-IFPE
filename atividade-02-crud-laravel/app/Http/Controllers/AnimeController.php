<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anime;

class AnimeController extends Controller
{
    public function index()
    {
        $animes = Anime::all();
        return view('animes.index', compact('animes'));
    }

    public function create()
    {
        $animes = Anime::all();
        return view('animes.create', compact('animes'));
    }

    public function store(Request $request)
    {
        Anime::create($request->all());
        return redirect('/')->with('success', 'Anime criado com sucesso!');
    }

    public function show(Anime $anime)
    {
        return view('animes.show', compact('anime'));
    }

    public function edit(Anime $anime)
    {
        return view('animes.edit', compact('anime'));
    }

    public function update(Request $request, Anime $anime)
    {
        $anime->update($request->all());
        return redirect('/')->with('success', 'Anime atualizado com sucesso!');
    }

    public function destroy(Anime $anime)
    {
        $anime->delete();
        return redirect('/')->with('success', 'Anime deletado com sucesso!');
    }

    public function lista()
    {
        $animes = Anime::all();
        return view('animes.lista', compact('animes'));
    }
}