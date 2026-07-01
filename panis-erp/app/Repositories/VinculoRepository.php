<?php

namespace App\Repositories;

use App\Models\Vinculo;

class VinculoRepository {
    public function inserir(Vinculo $data) {
        $data->save();
    }

}