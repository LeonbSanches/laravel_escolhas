<?php

namespace Database\Seeders;

use App\Models\Militar;
use Illuminate\Database\Seeder;

class MilitarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $militares = [
            ['id_func' => '2684420', 'nome' => '1º Sgt PM IVONEI MAZZARO', 'ordem_escolha' => 1],
            ['id_func' => '2691302', 'nome' => '1º Sgt PM JULIANO CARLO HAUBERT LOPES', 'ordem_escolha' => 2],
            ['id_func' => '2692228', 'nome' => '1º Sgt PM JULIO CRISTIANO CARLINI', 'ordem_escolha' => 3],
            ['id_func' => '2519682', 'nome' => '1º Sgt PM UBIRATAN LUNARDI OURIQUE PEREIRA', 'ordem_escolha' => 4],
            ['id_func' => '2694131', 'nome' => '1º Sgt PM ADILSON SILVA TRINDADE', 'ordem_escolha' => 5],
            ['id_func' => '2681587', 'nome' => '1º Sgt PM ROMARIO VARGAS TRINDADE', 'ordem_escolha' => 6],
            ['id_func' => '2687763', 'nome' => '1º Sgt PM ANDERSON CLEITON DOS SANTOS', 'ordem_escolha' => 7],
            ['id_func' => '2694433', 'nome' => '1º Sgt PM PAULO RICARDO DE SOUZA', 'ordem_escolha' => 8],
            ['id_func' => '2682052', 'nome' => '1º Sgt PM RODRIGO DO NASCIMENTO', 'ordem_escolha' => 9],
            ['id_func' => '2523566', 'nome' => '1º Sgt PM PERSON KAISER SANTIAGO', 'ordem_escolha' => 10],
            ['id_func' => '2830736', 'nome' => '1º Sgt PM DANILO BARCELOS SOARES', 'ordem_escolha' => 11],
            ['id_func' => '3161307', 'nome' => '1º Sgt PM SANDRO CORREA DE CAMPOS', 'ordem_escolha' => 12],
            ['id_func' => '2887959', 'nome' => '1º Sgt PM GILMAR DE ARAUJO ZACHER', 'ordem_escolha' => 13],
            ['id_func' => '2691043', 'nome' => '1º Sgt PM OSNI JUSTINO APESTEGUY BARRETO', 'ordem_escolha' => 14],
            ['id_func' => '2329816', 'nome' => '1º Sgt PM JOSE MAURICIO OLIVEIRA WEBSTER', 'ordem_escolha' => 15],
            ['id_func' => '2685779', 'nome' => '1º Sgt PM ALEXANDRE MAGNO GONÇALVES DE ALMEIDA', 'ordem_escolha' => 16],
            ['id_func' => '2684659', 'nome' => '1º Sgt PM VOLNEI MILANI', 'ordem_escolha' => 17],
            ['id_func' => '2685485', 'nome' => '1º Sgt PM DAIANE AREND ARCARO', 'ordem_escolha' => 18],
            ['id_func' => '2810840', 'nome' => '1º Sgt PM GILNEI GRANDO DOS SANTOS', 'ordem_escolha' => 19],
            ['id_func' => '2884801', 'nome' => '1º Sgt PM ANDREI LAUSCHNER', 'ordem_escolha' => 20],
            ['id_func' => '2880164', 'nome' => '1º Sgt PM ANDREW COSTA OSORIO', 'ordem_escolha' => 21],
            ['id_func' => '2885077', 'nome' => '1º Sgt PM FERNANDO DOS SANTOS CAMARGO', 'ordem_escolha' => 22],
            ['id_func' => '2889927', 'nome' => '1º Sgt PM DIEGO DE SOUZA PEREIRA', 'ordem_escolha' => 23],
            ['id_func' => '2878780', 'nome' => '1º Sgt PM IGOR FELIPE DO NASCIMENTO', 'ordem_escolha' => 24],
            ['id_func' => '2879409', 'nome' => '1º Sgt PM NELSON LUIS DIAS PEREIRA', 'ordem_escolha' => 25],
            ['id_func' => '2916622', 'nome' => '1º Sgt PM JOSIANE DAITX GOMES', 'ordem_escolha' => 26],
            ['id_func' => '2417596', 'nome' => '1º Sgt PM JOCEMAR MACHADO PAIM', 'ordem_escolha' => 27],
            ['id_func' => '2686538', 'nome' => '1º Sgt PM ALEX NEIMAR PEREIRA DE MOURA', 'ordem_escolha' => 28],
            ['id_func' => '2885670', 'nome' => '1º Sgt PM ANDRE SIDNEI BACKES DE LIMA', 'ordem_escolha' => 29],
            ['id_func' => '2887886', 'nome' => '1º Sgt PM GIOVANIR OVIDIO FORTUNA BORREA', 'ordem_escolha' => 30],
            ['id_func' => '2889676', 'nome' => '1º Sgt PM CLEONES DALLAPORTA', 'ordem_escolha' => 31],
            ['id_func' => '2883988', 'nome' => '1º Sgt PM ALESANDRO DO AMARANTE', 'ordem_escolha' => 32],
            ['id_func' => '2887754', 'nome' => '1º Sgt PM ILTON RODRIGO ZUCCHI', 'ordem_escolha' => 33],
            ['id_func' => '2734435', 'nome' => '1º Sgt PM MARIS ANGELO SENIW RIBEIRO', 'ordem_escolha' => 34],
            ['id_func' => '2915146', 'nome' => '1º Sgt PM VAGNER ROBERTO MOREIRA PEREIRA', 'ordem_escolha' => 35],
            ['id_func' => '2917262', 'nome' => '1º Sgt PM FAGNER ROGERIO DOS SANTOS DA SILVA', 'ordem_escolha' => 36],
            ['id_func' => '2918781', 'nome' => '1º Sgt PM WILSON LUIS MADRUGA PEREIRA', 'ordem_escolha' => 37],
            ['id_func' => '3144690', 'nome' => '1º Sgt PM JONAS TIAGO DE ALMEIDA', 'ordem_escolha' => 38],
            ['id_func' => '3163318', 'nome' => '1º Sgt PM WILLIAN PERETI', 'ordem_escolha' => 39],
            ['id_func' => '2877007', 'nome' => '1º Sgt PM VANIUS MORAIS DE SOUZA', 'ordem_escolha' => 40],
            ['id_func' => '3165825', 'nome' => '1º Sgt PM FABIO NERI ROZEK', 'ordem_escolha' => 41],
            ['id_func' => '3701255', 'nome' => '1º Sgt PM CARLOS R CAMARGO BATISTA HOLOSBACK', 'ordem_escolha' => 42],
        ];

        foreach ($militares as $militar) {
            Militar::firstOrCreate(
                ['id_func' => $militar['id_func']],
                $militar
            );
        }
    }
}
