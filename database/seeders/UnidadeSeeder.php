<?php

namespace Database\Seeders;

use App\Models\Unidade;
use Illuminate\Database\Seeder;

class UnidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unidades = [
            [
                'nome' => 'CRPOSerra-3°BPAT/Bento Gonçalves',
                'cidade' => 'Bento Gonçalves',
                'quantidade_vagas' => 1,
                'latitude' => -29.1719,
                'longitude' => -51.5192,
            ],
            [
                'nome' => 'CRPOSerra-12°BPM/ Caxias do Sul',
                'cidade' => 'Caxias do Sul',
                'quantidade_vagas' => 3,
                'latitude' => -29.1680,
                'longitude' => -51.1794,
            ],
            [
                'nome' => 'CRPOSerra-36°BPM/ Farroupilha',
                'cidade' => 'Farroupilha',
                'quantidade_vagas' => 1,
                'latitude' => -29.2250,
                'longitude' => -51.3478,
            ],
            [
                'nome' => 'CRPOVRS-3°BPM/Novo Hamburgo',
                'cidade' => 'Novo Hamburgo',
                'quantidade_vagas' => 1,
                'latitude' => -29.6906,
                'longitude' => -51.1308,
            ],
            [
                'nome' => 'CRPOVRS-25°BPM/São Leopoldo',
                'cidade' => 'São Leopoldo',
                'quantidade_vagas' => 1,
                'latitude' => -29.7603,
                'longitude' => -51.1472,
            ],
        ];

        foreach ($unidades as $unidade) {
            Unidade::create($unidade);
        }
    }
}
