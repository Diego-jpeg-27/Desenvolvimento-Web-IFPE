<?php

namespace App\Http\Controllers;
use App\Models\Publisher;
use Illuminate\Http\Request;
class PublisherController extends Controller
{
    public function index()
    {
        // Regra: viewAny. Permite Cliente/Biblio/Admin verem a lista
        $this->authorize('viewAny', Publisher::class);

        $publishers = Publisher::all();
        return view('publishers.index', compact('publishers'));
    }

    public function create()
    {
        // Regra: create. Bloqueia Clientes
        $this->authorize('create', Publisher::class);

        return view('publishers.create');
    }

    public function store(Request $request)
    {
        // Regra: create. Bloqueia Clientes
        $this->authorize('create', Publisher::class);

        $request->validate([
            'name' => 'required|string|unique:publishers|max:255',
        ]);


        Publisher::create($request->only('name'));


        return redirect()->route('publishers.index')->with('success', 'Editora criada com sucesso.');
    }


    public function show(Publisher $publisher)
    {
        // Regra: view. Permite todos verem os detalhes
        $this->authorize('view', $publisher);

        return view('publishers.show', compact('publisher'));
    }


    public function edit(Publisher $publisher)
    {
        // Regra: update. Bloqueia Clientes
        $this->authorize('update', $publisher);

        return view('publishers.edit', compact('publisher'));
    }


    public function update(Request $request, Publisher $publisher)
    {
        // Regra: update. Bloqueia Clientes
        $this->authorize('update', $publisher);

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
        ]);


        $publisher->update($request->only(['name', 'address']));


        return redirect()->route('publishers.index')->with('success', 'Editora atualizada!');
    }


    public function destroy(Publisher $publisher)
    {
        // Regra: delete. Bloqueia Clientes
        $this->authorize('delete', $publisher);

        $publisher->delete();


        return redirect()->route('publishers.index')->with('success', 'Editora excluída com sucesso.');
    }
}