<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('perfil')->insert(
            [
                [
                    'id' => 0,
                    'descricao' => 'Administrador'
                ],
                [
                    'id' => 1,
                    'descricao' => 'Dono'
                ],
                [
                    'id' => 2,
                    'descricao' => 'Gerente'
                ],
                [
                    'id' => 3,
                    'descricao' => 'Funcionario'
                ],
            ]
        );
    }
}
