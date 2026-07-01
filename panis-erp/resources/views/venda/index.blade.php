@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-xl font-semibold text-stone-800">Vendas</h1>
            <p class="text-sm text-stone-500 mt-0.5">Histórico de registros de venda.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route($userLogado->homeRoute()) }}"
               class="inline-flex items-center gap-1.5 text-sm text-stone-600 border border-stone-200 bg-white hover:bg-stone-50 rounded-lg px-3 py-2 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Voltar
            </a>
            <a href="{{ route('vendas/create') }}"
               class="inline-flex items-center gap-1.5 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-lg px-3 py-2 transition-colors font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Registrar Venda
            </a>
        </div>
    </div>

    {{-- List --}}
    @if($vendas->isEmpty())
        <div class="bg-white border border-stone-200 rounded-2xl py-16 text-center">
            <div class="w-12 h-12 rounded-full bg-stone-100 flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-stone-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
            </div>
            <p class="text-stone-500 text-sm">Nenhuma venda registrada.</p>
            <a href="{{ route('vendas/create') }}" class="mt-3 inline-block text-sm text-amber-600 hover:text-amber-700 font-medium">
                Registrar a primeira →
            </a>
        </div>
    @else
        <div class="bg-white border border-stone-200 rounded-2xl overflow-hidden">
            <ul class="divide-y divide-stone-100">
                @foreach ($vendas as $venda)
                <li class="flex items-center justify-between px-5 py-4 hover:bg-stone-50 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-green-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-stone-800">
                                R$ {{ number_format($venda->valor, 2, ',', '.') }}
                            </p>
                            <div class="flex items-center gap-2 mt-0.5">
                                <span class="text-xs text-stone-500">{{ $venda->loja->nome }}</span>
                                <span class="text-stone-300">·</span>
                                <span class="text-xs text-stone-400">Dono: {{ $venda->loja->dono->name }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href=""
                           class="inline-flex items-center gap-1 text-xs text-stone-500 hover:text-amber-600 border border-stone-200 hover:border-amber-300 rounded-lg px-3 py-1.5 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Ver
                        </a>
                        <a href=""
                           class="inline-flex items-center gap-1 text-xs text-stone-500 hover:text-amber-600 border border-stone-200 hover:border-amber-300 rounded-lg px-3 py-1.5 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Editar
                        </a>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    @endif

</div>
@endsection
