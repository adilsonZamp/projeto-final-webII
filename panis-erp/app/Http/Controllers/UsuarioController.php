<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Perfil;
use App\Models\User;
use App\Services\UsuarioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function __construct(
        private UsuarioService $service,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Gate::authorize('viewAny', Aluno::class);
        $userLogadado = Auth::user();

        $usuarios = $this->service->getAllUsuariosVisiveis($userLogadado);

        if ($userLogadado->id_perfil == 0) {//admin
            return view('usuario.index', compact(['usuarios']));
        } else if ($userLogadado->id_perfil == 1) {//dono
            return view('dono/funcionarios', compact(['usuarios']));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $storeOrUpdate = 'usuario.store';
        // Gate::authorize('create', Aluno::class);
        //chamar service de perfil
        $userLogado = Auth::user()->load('perfil');

        $perfis = $this->service->getAllPerfisVisiveis($userLogado);
        $usuarios = $this->service->getAllUsuariosVisiveis($userLogado);
        
        $donos = $usuarios->where('id_perfil', '=', 1);
        $gerentes = $usuarios->where('id_perfil', '=', 2);
        $funcionarios = $usuarios->where('id_perfil', '=', 3);

        if ($userLogado->perfil->descricao == 'Administrador') {
            return view('usuario.create', compact(['perfis', 'donos', 'gerentes', 'storeOrUpdate']));
        } else {
            $responsaveis = $gerentes->where('id_responsavel', '=', $userLogado->id);
            $donologadoNome = $userLogado->name;

            return view('dono.createFuncionario', compact(['responsaveis', 'perfis', 'donologadoNome', 'storeOrUpdate']));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $validacao = $request->validated();
        // Gate::authorize('create', Aluno::class);
        // $validacao = $request->validated();
        // Aluno::create($validacao);
        try {
            $this->service->inserir(new User($validacao), Auth::user()->load(['perfil']));
        } catch (\Throwable $th) {
            $erro = 'Ocorreu um erro ao salvar, tente novamente.';
            return redirect()->route('usuario.create')->with('erro', $erro)->withInput();
        }

        return redirect()->route(Auth::user()->homeRoute());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "<h1>Não utilizado</h1>";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $storeOrUpdate = 'dono/funcionario/update';
        $userLogado = Auth::user()->load(['perfil']);

        //apenas dono pode
        // Gate::authorize('update', $aluno);

        $perfis = $this->service->getAllPerfisVisiveis($userLogado);
        $usuarios = $this->service->getAllUsuariosVisiveis($userLogado);
        
        $prevUser = $this->service->getUser($id);

        if ($prevUser->id != null) {
            $donos = $usuarios->where('id_perfil', '=', 1);
            $gerentes = $usuarios->where('id_perfil', '=', 2);
            $funcionarios = $usuarios->where('id_perfil', '=', 3);

            if ($userLogado->perfil->descricao == 'Administrador') {
                return view('usuario.create', compact(['perfis', 'donos', 'gerentes', 'storeOrUpdate', 'prevUser']));
            } else {
                $responsaveis = $gerentes->where('id_responsavel', '=', $userLogado->id);
                $donologadoNome = $userLogado->name;

                return view('dono.createFuncionario', compact(['responsaveis', 'perfis', 'donologadoNome', 'storeOrUpdate', 'prevUser']));
            }
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $userLogado = auth()->user();
        $validado = $request->validated();
    
        //apenas dono pode
        // Gate::authorize('update', $aluno);
        
        try {
            $this->service->update($validado, $id, $userLogado);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors([
                'erro' => 'Erro ao salvar mudanças.',
            ]);
        }
        return redirect()->route('dono/funcionarios');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userLogado = auth()->user();

        // apenas dono e admin pode excluir
        // Gate::authorize('delete', $aluno);

        try {
            $this->service->delete($userLogado, $id);
        } catch (\Throwable $th) {
            return redirect()->route('usuario.index')->with('erro', 'Erro ao tentar excluir loja, provavelemte existem registros que dependem dela.');
        }
        return redirect()->route('usuario.index');
    }
}
