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
    public function inserir(User $novoUsuario, User $userLogado) {
        // if (in_array($userLogado->perfil->descricao, ['Administrador', 'Dono', 'Gerente'])) {
            // dd($novoUsuario);
        return $this->repository->inserir($novoUsuario);
        // }
    }

    public function getAllUsuariosVisiveis(User $usuarioLogado) {
        $allUsers = $this->repository->getAllUsuarios()->where('id_perfil', '!=', 0);

        if ($usuarioLogado->perfil->descricao == 'Administrador') {
            return $allUsers;
        } else if ($usuarioLogado->perfil->descricao == 'Dono') {
            $gerentes = $allUsers->where('id_responsavel', '=', $usuarioLogado->id);
            $funcionarios = $allUsers->whereIn('id_responsavel', $gerentes->pluck('id')->toArray());

            return $funcionarios->concat($gerentes);
        }
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

    public function listarFuncionarios(User $donoLogado) {
        return $this->repository->listarFuncionarios($donoLogado);
    }
    public function listarGerentes(User $donoLogado) {
        return $this->repository->listarGerentes($donoLogado);
    }

    //pedaço de PerfilService
    public function getAllPerfisVisiveis(User $userLogadado) {
        if ($userLogadado->perfil->descricao == 'Administrador') {
            //retorna tudo
            return $this->repository->getPerfis()->where('id', '!=', 0);
        } else if ($userLogadado->perfil->descricao == 'Dono') {
            //retorna gerente e funcionario
            return $this->repository->getPerfis()->whereNotIn('id', [0, 1]);
        } else if ($userLogadado->perfil->descricao == 'Gerente') {
            //retorna funcionario
            return $this->repository->getPerfis()->whereNotIn('id', [0, 1, 2]);
        }
    }
    public function getAllPerfisCadastro() {
        return $this->repository->getAllPerfisCadastro();
    }
}
