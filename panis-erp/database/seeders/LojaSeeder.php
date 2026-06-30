<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LojaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //#[Fillable(['nome', 'id_dono'])]
        DB::table('loja')->insert([
            [
                'nome' => 'Loja Padrão',
                'id_dono' => 2,//dono padrão
            ],
        ]);
    }
}
