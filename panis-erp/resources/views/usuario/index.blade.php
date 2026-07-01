@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-xl font-semibold text-stone-800">Usuários</h1>
            <p class="text-sm text-stone-500 mt-0.5">Todos os usuários do sistema.</p>
        </div>
        <a href="{{ url()->previous() }}"
           class="inline-flex items-center gap-1.5 text-sm text-stone-600 border border-stone-200 bg-white hover:bg-stone-50 rounded-lg px-3 py-2 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Voltar
        </a>
    </div>

    {{-- List --}}
    @if($usuarios->isEmpty())
        <div class="bg-white border border-stone-200 rounded-2xl py-16 text-center">
            <p class="text-stone-500 text-sm">Nenhum usuário cadastrado.</p>
        </div>
    @else
        <div class="bg-white border border-stone-200 rounded-2xl overflow-hidden">
            <ul class="divide-y divide-stone-100">
                @foreach ($usuarios as $usuario)
                <li class="flex items-center gap-3 px-5 py-4 hover:bg-stone-50 transition-colors">
                    <div class="w-9 h-9 rounded-full bg-amber-100 flex items-center justify-center text-amber-700 font-semibold text-sm flex-shrink-0">
                        {{ strtoupper(substr($usuario->name, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-stone-800 truncate">{{ $usuario->name }}</p>
                        <span class="inline-block mt-0.5 text-xs bg-stone-100 text-stone-600 rounded-md px-2 py-0.5">
                            {{ $usuario->perfil->descricao }}
                        </span>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    @endif

</div>
@endsection
<!-- <div>
    <h1>Listar usuários</h1>

    <ul>
        @foreach ($usuarios as $usuario)
            <li>
                <a href="">
                    <span>Nome: {{ $usuario->name }}</span>
                    <span>Categoria: {{ $usuario->perfil->descricao }}</span>
                </a>
            </li>
        @endforeach
    </ul>

    <a href="{{ url()->previous() }}">Voltar</a>
</div> -->