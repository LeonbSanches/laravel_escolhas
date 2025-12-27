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
            // CRPOVRS
            [
                'nome' => 'CRPOVRS-25°BPM/São Leopoldo',
                'cidade' => 'São Leopoldo',
                'quantidade_vagas' => 1,
                'latitude' => -29.7603,
                'longitude' => -51.1472,
            ],
            [
                'nome' => 'CRPOVRS-3°BPM/Novo Hamburgo',
                'cidade' => 'Novo Hamburgo',
                'quantidade_vagas' => 1,
                'latitude' => -29.6906,
                'longitude' => -51.1308,
            ],
            // CRPOSerra
            [
                'nome' => 'CRPOSerra-36°BPM/Farroupilha',
                'cidade' => 'Farroupilha',
                'quantidade_vagas' => 1,
                'latitude' => -29.2250,
                'longitude' => -51.3478,
            ],
            [
                'nome' => 'CRPOSerra-12ºBPM/Caxias do Sul',
                'cidade' => 'Caxias do Sul',
                'quantidade_vagas' => 3,
                'latitude' => -29.1680,
                'longitude' => -51.1794,
            ],
            [
                'nome' => 'CRPOSerra-3°BPAT/Bento Gonçalves',
                'cidade' => 'Bento Gonçalves',
                'quantidade_vagas' => 1,
                'latitude' => -29.1719,
                'longitude' => -51.5192,
            ],
            // CRPODJ
            [
                'nome' => 'CRPODJ-26°BPM /Cachoeirinha',
                'cidade' => 'Cachoeirinha',
                'quantidade_vagas' => 1,
                'latitude' => -29.9506,
                'longitude' => -51.0939,
            ],
            [
                'nome' => 'CRPODJ-24ºBPM/Alvorada',
                'cidade' => 'Alvorada',
                'quantidade_vagas' => 3,
                'latitude' => -29.9897,
                'longitude' => -51.0831,
            ],
            [
                'nome' => 'CRPODJ-18ºBPM/Viamão',
                'cidade' => 'Viamão',
                'quantidade_vagas' => 3,
                'latitude' => -30.0811,
                'longitude' => -51.0233,
            ],
            [
                'nome' => 'CRPODJ-17°BPM/Gravataí',
                'cidade' => 'Gravataí',
                'quantidade_vagas' => 1,
                'latitude' => -29.9444,
                'longitude' => -50.9919,
            ],
            // CPM
            [
                'nome' => 'CPM-34°BPM/Esteio',
                'cidade' => 'Esteio',
                'quantidade_vagas' => 1,
                'latitude' => -29.8517,
                'longitude' => -51.1792,
            ],
            [
                'nome' => 'CPM-33°BPM /Sapucaia do Sul',
                'cidade' => 'Sapucaia do Sul',
                'quantidade_vagas' => 1,
                'latitude' => -29.8331,
                'longitude' => -51.1461,
            ],
            [
                'nome' => 'CPM-15°BPM /Canoas',
                'cidade' => 'Canoas',
                'quantidade_vagas' => 3,
                'latitude' => -29.9178,
                'longitude' => -51.1836,
            ],
            // CPC - Porto Alegre (distribuídas em diferentes regiões)
            [
                'nome' => 'CPC-21° BPM/Porto Alegre',
                'cidade' => 'Porto Alegre',
                'quantidade_vagas' => 1,
                'latitude' => -30.0150,
                'longitude' => -51.1780,
            ],
            [
                'nome' => 'CPC-20°BPM/Porto Alegre',
                'cidade' => 'Porto Alegre',
                'quantidade_vagas' => 4,
                'latitude' => -30.0500,
                'longitude' => -51.2400,
            ],
            [
                'nome' => 'CPC-19°BPM/Porto Alegre',
                'cidade' => 'Porto Alegre',
                'quantidade_vagas' => 4,
                'latitude' => -30.0400,
                'longitude' => -51.2000,
            ],
            [
                'nome' => 'CPC-11°BPM/Porto Alegre',
                'cidade' => 'Porto Alegre',
                'quantidade_vagas' => 4,
                'latitude' => -30.0346,
                'longitude' => -51.2177,
            ],
            [
                'nome' => 'CPC-9°BPM/Porto Alegre',
                'cidade' => 'Porto Alegre',
                'quantidade_vagas' => 5,
                'latitude' => -30.0600,
                'longitude' => -51.1900,
            ],
            [
                'nome' => 'CPC-1°BPM /Porto Alegre',
                'cidade' => 'Porto Alegre',
                'quantidade_vagas' => 4,
                'latitude' => -30.0100,
                'longitude' => -51.2200,
            ],
        ];

        foreach ($unidades as $unidade) {
            Unidade::firstOrCreate(
                ['nome' => $unidade['nome']],
                $unidade
            );
        }
    }
}

