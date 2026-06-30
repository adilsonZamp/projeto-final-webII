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
        // $aluno = Aluno::find($id);
        
        // Gate::authorize('view', $aluno);

        // if (isset($aluno)) {
        //     return view('aluno.show', compact(['aluno']));
        // }

        return "<h1>Aluno não encontrado</h1>";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $aluno = Aluno::find($id);
        // $cursos = Curso::all();

        // Gate::authorize('update', $aluno);

        // if (isset($aluno) && isset($cursos)) {
        //     return view('aluno.edit', compact(['aluno', 'cursos']));
        // }

        return "<h1>Aluno não encontrado</h1>";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LojaRequest $request, string $id)
    {
        // $aluno = Aluno::find($id);

        // Gate::authorize('update', $aluno);

        // if (isset($aluno)) {
        //     $aluno->update($request->validated());
        //     return redirect()->route('aluno.index');
        // }

        return "<h1>Aluno não encontrado</h1>";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $aluno = Aluno::find($id);

        // Gate::authorize('delete', $aluno);

        // if (isset($aluno)) {
        //     try {
        //         $aluno->delete();
        //     } catch (\Throwable $th) {
        //         return redirect()->route('aluno.index')->with('erro', 'Existem matrículas que dependem desse aluno, para desinscrever ele é necessário revogar as matrículas');
        //     }
        //     return redirect()->route('aluno.index');
        // }

        return "<h1>Aluno não encontrado</h1>";
    }
}
