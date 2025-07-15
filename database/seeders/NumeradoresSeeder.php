<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Numerador;

class NumeradoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $registros = [
            'recibo_caja',
            'vale_caja',
            'nota_credito',
            'talonario_manual',
        ];

        foreach ($registros as $nombre) {
            Numerador::firstOrCreate(
                ['nombre' => $nombre],
                ['ultimo_numero' => 0]
            );
        }

    }
}
