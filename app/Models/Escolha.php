<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Escolha extends Model
{
    protected $fillable = ['militar_id', 'unidade_id'];

    public function militar(): BelongsTo
    {
        return $this->belongsTo(Militar::class);
    }

    public function unidade(): BelongsTo
    {
        return $this->belongsTo(Unidade::class);
    }
}
