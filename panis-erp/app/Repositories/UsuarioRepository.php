<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB; 

class UsuarioRepository {
    public function inserir(User $user) {
        $user->save();
    }

}