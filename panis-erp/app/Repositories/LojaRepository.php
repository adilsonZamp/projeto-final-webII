<?php

namespace App\Repositories;

use App\Models\Loja;

class LojaRepository {
    public function inserir(Loja $data) {
        $data->save();
    }

}