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
