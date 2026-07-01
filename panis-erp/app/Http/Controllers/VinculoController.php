<?php

namespace App\Http\Controllers;

use App\Http\Requests\VinculoRequest;
use App\Models\Vinculo;
use App\Services\LojaService;
use App\Services\UsuarioService;
use App\Services\VinculoService;

class VinculoController extends Controller
{
    public function __construct(
        private VinculoService $service,
        private LojaService $lojaService,
        private UsuarioService $usuarioService,
    ) {}
    public function index() {
        //donos e gerentes podem usar essa função
        $userLogado = auth()->user();
        $vinculos = $this->service->getAllVinculosVisiveis($userLogado);

        $vinculos->load(['funcionario', 'loja']);

        // dd($vinculos);

        return view('vinculo.index', compact(['vinculos', 'userLogado']));
    }

    public function create() {
        //donos e gerentes podem usar essa função
        // enviar lojas e funcionarios
        $userlogado = auth()->user()->load(['perfil']);

        if ($userlogado->perfil->descricao == 'Dono') {
            //todas as lojas e funcionarios
            $lojas = $userlogado->load(['lojasDono'])->lojasDono;
            $funcionarios = $this->usuarioService->getAllUsuariosVisiveis($userlogado);

            // dd($lojas, $funcionarios);
        } else if ($userlogado->perfil->descricao == 'Gerente') {
            //todas as lojas vinculadas e todos os funcionarios abaixo
            $lojas = $this->lojaService->getAllLojasVisiveis($userlogado);
            $funcionarios = $this->usuarioService->getAllUsuariosVisiveis($userlogado);
            // dd($lojas, $funcionarios);
        }

        return view('vinculo.create', compact(['lojas', 'funcionarios']));
    }

    public function store(VinculoRequest $request) {
        //donos e gerentes podem usar essa função
        $validado = $request->validated();
        try {
            $this->service->inserir(new Vinculo($validado));
        } catch (\Throwable $th) {
            return back()->withErrors([
                'duplicado' => 'Ocorreu um erro ao salvar, verifique os dados.',
            ]);
        }

        return redirect()->route('vinculos');
    }

    public function delete() {

    }

}
