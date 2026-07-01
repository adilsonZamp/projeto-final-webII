<?php

namespace App\Services;

use App\Models\Loja;
use App\Models\User;
use App\Repositories\LojaRepository;

class LojaService 
{
    public function __construct(
        private LojaRepository $repository
    ) {}
    //regras de negócio sem depender de coisas externas
    //chamar repository para salvar
    public function inserir(Loja $data, User $userLogado) {
        if ($userLogado->perfil->descricao == 'Dono') {
            if ($data->id_dono == $userLogado->id) {
                //criar vinculo mesmo para dono
                return $this->repository->inserir($data);
            } else {
                $data->id_dono = $userLogado->id;
                return $this->repository->inserir($data);
            }
        } else if ($userLogado->perfil->descricao == 'Administrador') {
            return $this->repository->inserir($data);
        }
    }
    public function delete(Loja $loja, User $userLogado) {
        if ($userLogado->id == $loja->id_dono) {
            return $this->repository->delete($loja);
        }
    }

    public function update(Loja $novaLoja, User $userLogado, int $id) {
        $loja = $this->getLoja($id, $userLogado);
        $loja->fill($novaLoja->toArray());
        
        if ($userLogado->id == $loja->id_dono) {
            return $this->repository->update($loja);
        }
    }

    public function getLoja(int $id, User $userLogado) {
        $loja = $this->repository->getLoja($id);
        if ($userLogado->id == $loja->id_dono) {
            return $loja;
        }
    }

    public function getAllLojasVisiveis(User $userLogado) {
        $lojas = $this->repository->getAllLojas();

        // dd($lojas->toArray()); //testar retorno das lojas

        if ($userLogado->perfil->descricao == 'Dono') {
            # pega todas as lojas que tem id_dono == id do user logado
            return $lojas->where('id_dono', '=', $userLogado->id);
        } else if ($userLogado->perfil->descricao == 'Gerente') {
            # pega todas as lojas que tem vinculo
            return $this->repository->getAllLojasVinculadas($userLogado);
        } else if ($userLogado->perfil->descricao == 'Funcionario') {
            return null;
        }
        return $lojas;
    }
}
