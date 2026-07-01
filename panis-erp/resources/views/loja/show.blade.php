@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6">

    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('dono/home') }}"
           class="inline-flex items-center gap-1.5 text-sm text-stone-500 hover:text-stone-700 transition-colors mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Voltar
        </a>

        <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <div>
                <h1 class="text-xl font-semibold text-stone-800">{{ $loja->nome }}</h1>
                <div class="flex items-center gap-3 mt-1">
                    <span class="text-xs text-stone-400">Dono: {{ $loja->dono->name }}</span>
                    <span class="text-stone-300">·</span>
                    <span class="text-xs text-stone-400">Criada em {{ $loja->created_at ?? '' }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Employees section --}}
    <div class="mb-3 flex items-center justify-between">
        <h2 class="text-sm font-semibold text-stone-700 uppercase tracking-wider">
            Equipe
            <span class="ml-2 text-xs font-normal text-stone-400 normal-case tracking-normal">{{ count($empregados) }} cadastrado(s)</span>
        </h2>
    </div>

    @if(empty($empregados) || count($empregados) == 0)
        <div class="bg-white border border-stone-200 rounded-2xl py-12 text-center">
            <div class="w-10 h-10 rounded-full bg-stone-100 flex items-center justify-center mx-auto mb-3">
                <svg class="w-5 h-5 text-stone-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <p class="text-stone-500 text-sm">Nenhum funcionário vinculado a esta loja.</p>
        </div>
    @else
        <div class="bg-white border border-stone-200 rounded-2xl overflow-hidden">
            <ul class="divide-y divide-stone-100">
                @foreach ($empregados as $empregado)
                <li class="flex items-center justify-between px-5 py-4 hover:bg-stone-50 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-amber-100 flex items-center justify-center text-amber-700 font-semibold text-sm flex-shrink-0">
                            {{ strtoupper(substr($empregado->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-medium text-stone-800">{{ $empregado->name }}</p>
                            <p class="text-xs text-stone-400 mt-0.5">Dono: {{ $loja->dono->name }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('usuario.edit', ['usuario' => $empregado->id]) }}"
                           class="inline-flex items-center gap-1 text-xs text-stone-500 hover:text-amber-600 border border-stone-200 hover:border-amber-300 rounded-lg px-3 py-1.5 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Editar
                        </a>
                        <form action="{{ route('usuario.destroy', ['usuario' => $empregado->id]) }}" method="POST"
                              onsubmit="return confirm('Deseja excluir {{ $empregado->name }}?')">
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
