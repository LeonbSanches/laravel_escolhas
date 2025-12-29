<?php

namespace App\Http\Controllers;

use App\Models\Militar;
use App\Models\Unidade;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $unidades = Unidade::with('escolhas.militar')
            ->orderBy('cidade')
            ->get()
            ->map(function ($unidade) {
                return [
                    'id' => $unidade->id,
                    'nome' => $unidade->nome,
                    'cidade' => $unidade->cidade,
                    'quantidade_vagas' => $unidade->quantidade_vagas,
                    'vagas_ocupadas' => $unidade->vagasOcupadas(),
                    'vagas_disponiveis' => $unidade->vagasDisponiveis(),
                    'tem_vagas' => $unidade->temVagasDisponiveis(),
                    'latitude' => $unidade->latitude,
                    'longitude' => $unidade->longitude,
                    'escolhas' => $unidade->escolhas->map(function ($escolha) {
                        return [
                            'militar' => $escolha->militar->nome,
                            'ordem' => $escolha->militar->ordem_escolha,
                            'data' => $escolha->created_at->format('d/m/Y H:i'),
                        ];
                    }),
                ];
            });

        $proximoMilitar = Militar::whereDoesntHave('escolhas')
            ->orderBy('ordem_escolha')
            ->first();

        // Variáveis para WebSocket/Reverb
        $broadcastConfig = [
            'driver' => config('broadcasting.default', 'null'),
            'reverb_key' => config('broadcasting.connections.reverb.key', 'local'),
            'reverb_host' => config('broadcasting.connections.reverb.options.host') ?: 'localhost',
            'reverb_port' => config('broadcasting.connections.reverb.options.port', 8080),
            'reverb_scheme' => config('broadcasting.connections.reverb.options.scheme', 'http'),
        ];

        return view('dashboard', compact('unidades', 'proximoMilitar', 'broadcastConfig'));
    }

    public function getData()
    {
        $unidades = Unidade::with('escolhas.militar')
            ->orderBy('cidade')
            ->get()
            ->map(function ($unidade) {
                return [
                    'id' => $unidade->id,
                    'nome' => $unidade->nome,
                    'cidade' => $unidade->cidade,
                    'quantidade_vagas' => $unidade->quantidade_vagas,
                    'vagas_ocupadas' => $unidade->vagasOcupadas(),
                    'vagas_disponiveis' => $unidade->vagasDisponiveis(),
                    'tem_vagas' => $unidade->temVagasDisponiveis(),
                    'latitude' => $unidade->latitude,
                    'longitude' => $unidade->longitude,
                    'escolhas' => $unidade->escolhas->map(function ($escolha) {
                        return [
                            'militar' => $escolha->militar->nome,
                            'ordem' => $escolha->militar->ordem_escolha,
                            'data' => $escolha->created_at->format('d/m/Y H:i'),
                        ];
                    }),
                ];
            });

        $proximoMilitar = Militar::whereDoesntHave('escolhas')
            ->orderBy('ordem_escolha')
            ->first();

        return response()->json([
            'unidades' => $unidades,
            'proximoMilitar' => $proximoMilitar ? [
                'nome' => $proximoMilitar->nome,
                'ordem_escolha' => $proximoMilitar->ordem_escolha,
            ] : null,
        ]);
    }
}
