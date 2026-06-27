<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [//admin
                'name' => 'admin',
                'email' => 'admin@admin.admin',
                'id_perfil' => 0,
                'password' => Hash::make('admin'),
            ],
            [//dono
                'name' => 'Dono',
                'email' => 'dono@dono.dono',
                'id_perfil' => 1,
                'password' => Hash::make('dono'),
            ],
        ]);
        DB::table('users')->insert([
            [//gerente
                'name' => 'Gerente',
                'email' => 'gerente@gerente.gerente',
                'id_perfil' => 2,
                'id_responsavel' => 1,
                'password' => Hash::make('gerente'),
            ],
            [//funcionario
                'name' => 'Funcionario',
                'email' => 'funcionario@funcionario.funcionario',
                'id_perfil' => 3,
                'id_responsavel' => 2,
                'password' => Hash::make('funcionario'),
            ],
        ]);
    }
}
