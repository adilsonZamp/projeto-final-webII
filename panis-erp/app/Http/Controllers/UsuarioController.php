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
        // Gate::authorize('create', Aluno::class);
        //chamar service de perfil
        $userLogado = Auth::user()->load('perfil');

        $perfis = $this->service->getAllPerfisVisiveis($userLogado);
        $usuarios = $this->service->getAllUsuariosVisiveis($userLogado);
        
        $donos = $usuarios->where('id_perfil', '=', 1);
        $gerentes = $usuarios->where('id_perfil', '=', 2);
        $funcionarios = $usuarios->where('id_perfil', '=', 3);

        if ($userLogado->perfil->descricao == 'Administrador') {
            return view('usuario.create', compact(['perfis', 'donos', 'gerentes']));
        } else {
            $responsaveis = $gerentes->where('id_responsavel', '=', $userLogado->id);
            $donologadoNome = $userLogado->name;

            return view('dono.createFuncionario', compact(['responsaveis', 'perfis', 'donologadoNome']));
        }
    }

    //criar funcionarios. Revisar pois ainda são usuários, talvez deva ir pro método create acima
    // public function createFuncionario()
    // {
    //     // Gate::authorize('create', Aluno::class);
    //     // $cursos = Curso::all();
    //     
    // }
    // public function listFuncionarios()
    // {
    //     // Gate::authorize('viewAny', Aluno::class);
    //     // $data = Aluno::all();
    //     $funcionarios = $this->service->listarFuncionarios(Auth::user());

    //     return view('dono.funcionarios', compact(['funcionarios']));
    // }
    // public function storeFuncionario(UserRequest $request)
    // {
    //     $validacao = $request->validated();
    //     // Gate::authorize('create', Aluno::class);
    //     // $validacao = $request->validated();
    //     // Aluno::create($validacao);
    //     // $this->service->inserir(new Loja($validacao));

    //     //chama service para validar e mandar request para inserir na base
    //     try {
    //         $this->serviceUsuario->inserir(new User($validacao));
    //     } catch (\Throwable $th) {
    //         $erro = 'Ocorreu um erro ao salvar, tente novamente.';
    //         return redirect()->route('dono/funcionarios')->with('erro', $erro)->withInput();
    //     }

    //     return redirect()->route('dono/funcionarios');
    // }

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
    public function update(UserRequest $request, string $id)
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
