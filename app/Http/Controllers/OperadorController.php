<?php

namespace App\Http\Controllers;

use App\Events\EscolhaRegistrada;
use App\Models\Escolha;
use App\Models\Militar;
use App\Models\Unidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OperadorController extends Controller
{
    public function index()
    {
        $militares = Militar::orderBy('ordem_escolha')->get();
        $unidades = Unidade::with('escolhas.militar')->orderBy('cidade')->get();
        
        $proximoMilitar = Militar::whereDoesntHave('escolhas')
            ->orderBy('ordem_escolha')
            ->first();

        // Buscar todas as escolhas ordenadas
        $escolhas = Escolha::with(['militar', 'unidade'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('operador.index', compact('militares', 'unidades', 'proximoMilitar', 'escolhas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'militar_id' => 'required|exists:militares,id',
            'unidade_id' => 'required|exists:unidades,id',
        ]);

        $militar = Militar::findOrFail($request->militar_id);
        $unidade = Unidade::findOrFail($request->unidade_id);

        // Verificar se o militar já escolheu
        if ($militar->jaEscolheu()) {
            return back()->withErrors(['error' => 'Este militar já fez sua escolha.']);
        }

        // Verificar se há vagas disponíveis
        if (!$unidade->temVagasDisponiveis()) {
            return back()->withErrors(['error' => 'Não há vagas disponíveis nesta unidade.']);
        }

        $escolha = DB::transaction(function () use ($militar, $unidade) {
            $escolha = Escolha::create([
                'militar_id' => $militar->id,
                'unidade_id' => $unidade->id,
            ]);
            // Carregar relacionamentos antes de broadcast
            $escolha->load(['militar', 'unidade']);
            return $escolha;
        });

        // Disparar evento para atualização em tempo real
        try {
            $escolhaFresh = $escolha->fresh(['militar', 'unidade']);
            broadcast(new EscolhaRegistrada($escolhaFresh));
        } catch (\Exception $e) {
            // Erro silencioso - não interrompe o fluxo
        }

        return redirect()->route('operador.index')
            ->with('success', 'Escolha registrada com sucesso!');
    }

    public function destroy(Escolha $escolha)
    {
        $unidade = $escolha->unidade;
        $escolha->delete();

        // Recarregar unidade para ter dados atualizados
        $unidade->refresh();
        // Criar uma escolha temporária apenas para broadcast (não salvar no banco)
        // Isso permite atualizar o dashboard com os dados atualizados da unidade
        $tempEscolha = new Escolha();
        $tempEscolha->id = 0;
        $tempEscolha->unidade_id = $unidade->id;
        $tempEscolha->setRelation('unidade', $unidade);
        $tempEscolha->setRelation('militar', (object)['nome' => '', 'ordem_escolha' => 0]);
        broadcast(new EscolhaRegistrada($tempEscolha));

        return redirect()->route('operador.index')
            ->with('success', 'Escolha removida com sucesso!');
    }
}
