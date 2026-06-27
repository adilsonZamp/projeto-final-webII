<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UsuarioRepository;

class UsuarioService 
{
    public function __construct(
        private UsuarioRepository $repository
    ) {}
    //regras de negócio sem depender de coisas externas
    //chamar repository para salvar
    public function inserir(User $usuario) {
        return $this->repository->inserir($usuario);
    }

    public function getAllUsuarios() {
        return $this->repository->getAllUsuarios();
    }

    public function validarHierarquiaGerente(int $id_responsavel) {
        $responsavel = $this->repository->getUsuarioPorId($id_responsavel);
        // dd($responsavel);
        $validacao = $responsavel->id_perfil == 1;

        return $validacao;
    }
    public function validarHierarquiaFuncionario(int $id_responsavel) {
        $responsavel = $this->repository->getUsuarioPorId($id_responsavel);
        $validacao = $responsavel->id_perfil == 2;
        
        return $validacao;
    }

    //pedaço de PerfilService
    public function getAllPerfis() {
        return $this->repository->getAllPerfis();
    }
}
