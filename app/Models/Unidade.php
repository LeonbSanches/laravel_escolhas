<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unidade extends Model
{
    protected $fillable = ['nome', 'cidade', 'quantidade_vagas', 'latitude', 'longitude'];

    public function escolhas(): HasMany
    {
        return $this->hasMany(Escolha::class);
    }

    public function vagasOcupadas(): int
    {
        // Não usar cache aqui para evitar inconsistências
        // O cache será limpo quando necessário
        return $this->escolhas()->count();
    }

    public function vagasDisponiveis(): int
    {
        return max(0, $this->quantidade_vagas - $this->vagasOcupadas());
    }

    public function temVagasDisponiveis(): bool
    {
        return $this->vagasDisponiveis() > 0;
    }
}
