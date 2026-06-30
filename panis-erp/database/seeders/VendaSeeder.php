<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vendas')->insert([
            [
                'valor' => 1500,
                'id_loja' => 1,
                'data_referencia' => '30-06-2026',
            ],
            [
                'valor' => 2500,
                'id_loja' => 1,
                'data_referencia' => '29-06-2026',
            ],
            [
                'valor' => 3500,
                'id_loja' => 1,
                'data_referencia' => '28-06-2026',
            ],
        ]);
    }
}
