<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use Illuminate\Http\Request;

class UnidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unidades = Unidade::with('escolhas.militar')->orderBy('cidade')->get();
        return view('unidades.index', compact('unidades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('unidades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'quantidade_vagas' => 'required|integer|min:1',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        Unidade::create($request->all());

        return redirect()->route('unidades.index')
            ->with('success', 'Unidade cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Unidade $unidade)
    {
        $unidade->load('escolhas.militar');
        return view('unidades.show', compact('unidade'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unidade $unidade)
    {
        return view('unidades.edit', compact('unidade'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unidade $unidade)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'quantidade_vagas' => 'required|integer|min:' . $unidade->vagasOcupadas(),
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        $unidade->update($request->all());

        return redirect()->route('unidades.index')
            ->with('success', 'Unidade atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unidade $unidade)
    {
        if ($unidade->escolhas()->exists()) {
            return redirect()->route('unidades.index')
                ->withErrors(['error' => 'Não é possível excluir uma unidade que já possui escolhas registradas.']);
        }

        $unidade->delete();

        return redirect()->route('unidades.index')
            ->with('success', 'Unidade excluída com sucesso!');
    }
}
