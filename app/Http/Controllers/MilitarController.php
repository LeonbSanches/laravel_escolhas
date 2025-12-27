<?php

namespace App\Http\Controllers;

use App\Models\Militar;
use Illuminate\Http\Request;

class MilitarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $militares = Militar::orderBy('ordem_escolha')->get();
        return view('militares.index', compact('militares'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('militares.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_func' => 'required|string|unique:militares,id_func',
            'nome' => 'required|string|max:255',
            'ordem_escolha' => 'required|integer|unique:militares,ordem_escolha|min:1',
        ]);

        Militar::create($request->all());

        return redirect()->route('militares.index')
            ->with('success', 'Militar cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Militar $militar)
    {
        $militar->load('escolhas.unidade');
        return view('militares.show', compact('militar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Militar $militar)
    {
        return view('militares.edit', compact('militar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Militar $militar)
    {
        $request->validate([
            'id_func' => 'required|string|unique:militares,id_func,' . $militar->id,
            'nome' => 'required|string|max:255',
            'ordem_escolha' => 'required|integer|unique:militares,ordem_escolha,' . $militar->id . '|min:1',
        ]);

        $militar->update($request->all());

        return redirect()->route('militares.index')
            ->with('success', 'Militar atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Militar $militar)
    {
        if ($militar->escolhas()->exists()) {
            return redirect()->route('militares.index')
                ->withErrors(['error' => 'Não é possível excluir um militar que já fez uma escolha.']);
        }

        $militar->delete();

        return redirect()->route('militares.index')
            ->with('success', 'Militar excluído com sucesso!');
    }
}
