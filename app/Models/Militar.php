<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Militar extends Model
{
    protected $table = 'militares';
    
    protected $fillable = ['id_func', 'nome', 'ordem_escolha'];

    public function escolhas(): HasMany
    {
        return $this->hasMany(Escolha::class);
    }

    public function jaEscolheu(): bool
    {
        return $this->escolhas()->exists();
    }
}
