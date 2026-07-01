@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-xl font-semibold text-stone-800">Funcionários</h1>
            <p class="text-sm text-stone-500 mt-0.5">Gerencie a equipe cadastrada.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('vinculos') }}"
               class="inline-flex items-center gap-1.5 text-sm text-stone-600 border border-stone-200 bg-white hover:bg-stone-50 rounded-lg px-3 py-2 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                </svg>
                Vínculos
            </a>
            <a href="{{ route('dono/home') }}"
               class="inline-flex items-center gap-1.5 text-sm text-stone-600 border border-stone-200 bg-white hover:bg-stone-50 rounded-lg px-3 py-2 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Voltar
            </a>
            <a href="{{ route('dono/funcionario/create') }}"
               class="inline-flex items-center gap-1.5 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-lg px-3 py-2 transition-colors font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Novo Funcionário
            </a>
        </div>
    </div>

    {{-- Alert --}}
    @if(session('erro'))
        <div class="mb-6 flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm">
            <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            {{ session('erro') }}
        </div>
    @endif

    {{-- List --}}
    @if($usuarios->isEmpty())
        <div class="bg-white border border-stone-200 rounded-2xl py-16 text-center">
            <div class="w-12 h-12 rounded-full bg-stone-100 flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-stone-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <p class="text-stone-500 text-sm">Nenhum funcionário cadastrado.</p>
            <a href="{{ route('dono/funcionario/create') }}" class="mt-3 inline-block text-sm text-amber-600 hover:text-amber-700 font-medium">
                Cadastrar o primeiro →
            </a>
        </div>
    @else
        <div class="bg-white border border-stone-200 rounded-2xl overflow-hidden">
            <ul class="divide-y divide-stone-100">
                @foreach ($usuarios as $usuario)
                <li class="flex items-center justify-between px-5 py-4 hover:bg-stone-50 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-amber-100 flex items-center justify-center text-amber-700 font-semibold text-sm flex-shrink-0">
                            {{ strtoupper(substr($usuario->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-medium text-stone-800">{{ $usuario->name }}</p>
                            <div class="flex items-center gap-2 mt-0.5">
                                <span class="text-xs text-stone-500">{{ $usuario->perfil->descricao }}</span>
                                @if($usuario->responsavel)
                                    <span class="text-stone-300">·</span>
                                    <span class="text-xs text-stone-400">resp. {{ $usuario->responsavel->name }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('dono/funcionario/edit', ['id' => $usuario->id]) }}"
                           class="inline-flex items-center gap-1 text-xs text-stone-500 hover:text-amber-600 border border-stone-200 hover:border-amber-300 rounded-lg px-3 py-1.5 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Editar
                        </a>
                        <form action="{{ route('usuario.destroy', ['usuario' => $usuario->id]) }}" method="POST"
                              onsubmit="return confirm('Deseja realmente excluir {{ $usuario->name }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center gap-1 text-xs text-stone-500 hover:text-red-600 border border-stone-200 hover:border-red-200 rounded-lg px-3 py-1.5 transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Excluir
                            </button>
                        </form>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    @endif

</div>
@endsection
