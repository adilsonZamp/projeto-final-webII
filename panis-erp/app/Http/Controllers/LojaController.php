<?php

namespace App\Http\Controllers;

use App\Http\Requests\LojaRequest;
use App\Models\Loja;
use App\Services\LojaService;
use App\Services\UsuarioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LojaController extends Controller
{
    public function __construct(
        private LojaService $lojaService,
        private UsuarioService $usuarioService,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Gate::authorize('viewAny', Aluno::class);
        // $data = Aluno::all();

        //pegar todas as lojas do usuário logado
        //dono pode ter mais de uma, funcionarios e gerentes tem a tabela vínculo

        $lojas = $this->lojaService->getAllLojasVisiveis(Auth::user()->load(['perfil']));

        return view('loja.index', compact(['lojas']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Gate::authorize('create', Aluno::class);
        // $cursos = Curso::all();
        $userLogado = Auth::user()->load(['perfil']);
        //apenas admin e dono podem criar lojas
        if ($userLogado->perfil->descricao == 'Administrador') {
            $donos = $this->usuarioService->getAllDonos();
            return view('loja.create', compact(['userLogado', 'donos']));
        } else {
            return view('loja.create', compact(['userLogado']));
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LojaRequest $request)
    {
        $validacao = $request->validated();
        // Gate::authorize('create', Aluno::class);
        // $validacao = $request->validated();
        // Aluno::create($validacao);
        $userLogado = Auth::user();

        $this->lojaService->inserir(new Loja($validacao), $userLogado);

        return redirect()->route($userLogado->homeRoute());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //tela que mostra funcionarios da loja
        $userLogado = auth()->user()->load(['perfil']);
        $loja = $this->lojaService->getLoja($id, $userLogado);

        $loja->load(['empregadosLoja']);
        $empregados = $loja->empregadosLoja;
        
        //dono e gerente podem acessar
        // Gate::authorize('view', $aluno);

        return view('loja.show', compact(['loja', 'empregados']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $userLogado = Auth::user()->load(['perfil']);
        $loja = $this->lojaService->getLoja($id, $userLogado);

        //apenas dono pode
        // Gate::authorize('update', $aluno);

        return view('loja.edit', compact(['userLogado', 'loja']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LojaRequest $request, string $id_loja)
    {
        $userLogado = auth()->user();
        $validado = $request->validated();
    
        //apenas dono pode
        // Gate::authorize('update', $aluno);

        try {
            $this->lojaService->update(new Loja($validado), $userLogado, $id_loja);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors([
                'erro' => 'Erro ao salvar mudanças.',
            ]);
        }
        return redirect()->route('dono/lojas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userLogado = auth()->user();
        $loja = Loja::find($id);

        // apenas dono pode excluir
        // Gate::authorize('delete', $aluno);

        if (isset($loja)) {
            try {
                $this->lojaService->delete($loja, $userLogado);
            } catch (\Throwable $th) {
                return redirect()->route('loja.index')->with('erro', 'Erro ao tentar excluir loja, provavelemte existem registros que dependem dela.');
            }
            return redirect()->route('loja.index');
        }
    }
}
