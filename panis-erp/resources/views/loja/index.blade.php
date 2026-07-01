@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-xl font-semibold text-stone-800">Lojas</h1>
            <p class="text-sm text-stone-500 mt-0.5">Todas as unidades cadastradas.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('dono/home') }}"
               class="inline-flex items-center gap-1.5 text-sm text-stone-600 border border-stone-200 bg-white hover:bg-stone-50 rounded-lg px-3 py-2 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Voltar
            </a>
            <a href="{{ route('loja/create') }}"
               class="inline-flex items-center gap-1.5 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-lg px-3 py-2 transition-colors font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Criar Loja
            </a>
        </div>
    </div>

    {{-- Error --}}
    @error('erro')
        <div class="mb-6 flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm">
            <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            {{ $message }}
        </div>
    @enderror

    {{-- List --}}
    @if($lojas->isEmpty())
        <div class="bg-white border border-stone-200 rounded-2xl py-16 text-center">
            <div class="w-12 h-12 rounded-full bg-stone-100 flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-stone-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <p class="text-stone-500 text-sm">Nenhuma loja cadastrada.</p>
            <a href="{{ route('loja/create') }}" class="mt-3 inline-block text-sm text-amber-600 hover:text-amber-700 font-medium">
                Cadastrar a primeira →
            </a>
        </div>
    @else
        <div class="bg-white border border-stone-200 rounded-2xl overflow-hidden">
            <ul class="divide-y divide-stone-100">
                @foreach ($lojas as $loja)
                <li class="flex items-center justify-between px-5 py-4 hover:bg-stone-50 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-amber-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-stone-800">{{ $loja->nome }}</p>
                            <p class="text-xs text-stone-400 mt-0.5">Dono: {{ $loja->dono->name }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('loja.show', ['loja' => $loja->id]) }}"
                           class="inline-flex items-center gap-1 text-xs text-stone-500 hover:text-amber-600 border border-stone-200 hover:border-amber-300 rounded-lg px-3 py-1.5 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Ver
                        </a>
                        <a href="{{ route('loja.edit', ['loja' => $loja->id]) }}"
                           class="inline-flex items-center gap-1 text-xs text-stone-500 hover:text-amber-600 border border-stone-200 hover:border-amber-300 rounded-lg px-3 py-1.5 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Editar
                        </a>
                        <form action="{{ route('loja.destroy', ['loja' => $loja->id]) }}" method="POST"
                              onsubmit="return confirm('Deseja excluir a loja {{ $loja->nome }}?')">
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
