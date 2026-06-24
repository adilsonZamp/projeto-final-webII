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
                    'id_perfil' => 0,
                    'descricao' => 'Administrador'
                ],
                [
                    'id_perfil' => 1,
                    'descricao' => 'Dono'
                ],
                [
                    'id_perfil' => 2,
                    'descricao' => 'Gerente'
                ],
                [
                    'id_perfil' => 3,
                    'descricao' => 'Funcionario'
                ],
            ]
        );
    }
}
