<?php

namespace App\Events;

use App\Models\Escolha;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EscolhaRegistrada implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $escolha;
    
    /**
     * Determina se o evento deve ser transmitido imediatamente.
     */
    public $broadcastQueue = 'default';
    
    /**
     * Determina se o evento deve ser transmitido de forma síncrona.
     */
    public function shouldBroadcastNow(): bool
    {
        return true; // Transmitir imediatamente, sem fila
    }

    /**
     * Create a new event instance.
     */
    public function __construct(Escolha $escolha)
    {
        // Carregar relacionamentos se existirem
        if ($escolha->exists && $escolha->militar_id) {
            $this->escolha = $escolha->load(['militar', 'unidade']);
        } else {
            // Para escolhas temporárias (quando removidas)
            $this->escolha = $escolha;
            if (!$escolha->relationLoaded('unidade')) {
                $escolha->load('unidade');
            }
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('escolhas'),
        ];
    }

    /**
     * The event's broadcast name.
     */
    public function broadcastAs(): string
    {
        return 'escolha.registrada';
    }

    /**
     * Get the data to broadcast.
     */
    public function broadcastWith(): array
    {
        $militar = $this->escolha->militar ?? (object)['nome' => '', 'ordem_escolha' => 0];
        $createdAt = $this->escolha->created_at ?? now();
        
        return [
            'escolha' => [
                'id' => $this->escolha->id ?? 0,
                'militar' => [
                    'nome' => $militar->nome ?? '',
                    'ordem_escolha' => $militar->ordem_escolha ?? 0,
                ],
                'unidade' => [
                    'id' => $this->escolha->unidade->id,
                    'nome' => $this->escolha->unidade->nome,
                    'cidade' => $this->escolha->unidade->cidade,
                    'vagas_disponiveis' => $this->escolha->unidade->vagasDisponiveis(),
                    'vagas_ocupadas' => $this->escolha->unidade->vagasOcupadas(),
                    'quantidade_vagas' => $this->escolha->unidade->quantidade_vagas,
                ],
                'created_at' => $createdAt instanceof \DateTime ? $createdAt->toIso8601String() : now()->toIso8601String(),
            ],
        ];
    }
}
