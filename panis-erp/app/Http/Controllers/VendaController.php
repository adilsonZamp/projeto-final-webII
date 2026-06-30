<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendaRequest;
use App\Models\Venda;
use App\Services\LojaService;
use App\Services\VendaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class VendaController extends Controller
{
    public function __construct(
        private VendaService $vendaService,
        private LojaService $lojaService,
        // private UsuarioService $usuarioService,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userLogado = auth()->user();

        $vendas = $this->vendaService->getAllVendasUser($userLogado);

        return view('venda.index', compact(['vendas', 'userLogado']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userLogado = auth()->user();
        $lojas = $this->lojaService->getAllLojasVisiveis($userLogado);

        return view('venda.create', compact(['lojas', 'userLogado']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VendaRequest $request)
    {
        // route name for vendas index: vendas
        $userLogado = auth()->user();
        $validado = $request->validated();

        if (!$this->vendaService->inserir(new Venda($validado), $userLogado)) {
            // se o inserir der erro (retornar null) lança essa e volta para o anterior
            throw ValidationException::withMessages([
                'sem_acesso_loja' => 'O usuário logado não tem acesso a essa loja.'
            ]);
        }
        
        return redirect()->route($userLogado->homeRoute());
    }

    /**
     * Display the specified resource.
     */
    public function show(Venda $venda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venda $venda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venda $venda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venda $venda)
    {
        //
    }
}
