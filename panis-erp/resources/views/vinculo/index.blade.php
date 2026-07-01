@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-xl font-semibold text-stone-800">Vínculos</h1>
            <p class="text-sm text-stone-500 mt-0.5">Funcionários associados às lojas.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('dono/funcionarios') }}"
               class="inline-flex items-center gap-1.5 text-sm text-stone-600 border border-stone-200 bg-white hover:bg-stone-50 rounded-lg px-3 py-2 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Voltar
            </a>
            <a href="{{ route('vinculos/create') }}"
               class="inline-flex items-center gap-1.5 text-sm text-white bg-amber-500 hover:bg-amber-600 rounded-lg px-3 py-2 transition-colors font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Novo Vínculo
            </a>
        </div>
    </div>

    {{-- List --}}
    @if ($vinculos->count() === 0)
        <div class="bg-white border border-stone-200 rounded-2xl py-16 text-center">
            <div class="w-12 h-12 rounded-full bg-stone-100 flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-stone-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                </svg>
            </div>
            <p class="text-stone-500 text-sm">Nenhum vínculo cadastrado.</p>
            <a href="{{ route('vinculos/create') }}" class="mt-3 inline-block text-sm text-amber-600 hover:text-amber-700 font-medium">
                Criar o primeiro →
            </a>
        </div>
    @else
        <div class="bg-white border border-stone-200 rounded-2xl overflow-hidden">
            <ul class="divide-y divide-stone-100">
                @foreach ($vinculos as $vinculo)
                <li class="flex items-center justify-between px-5 py-4 hover:bg-stone-50 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-amber-100 flex items-center justify-center text-amber-700 font-semibold text-sm flex-shrink-0">
                            {{ strtoupper(substr($vinculo->funcionario->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-medium text-stone-800">{{ $vinculo->funcionario->name }}</p>
                            <div class="flex items-center gap-1.5 mt-0.5">
                                <svg class="w-3 h-3 text-stone-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                <span class="text-xs text-stone-500">{{ $vinculo->loja->nome }}</span>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('vinculos/delete', ['userId' => $vinculo->user_id, 'lojaId' => $vinculo->loja_id]) }}"
                          method="POST"
                          onsubmit="return confirm('Remover o vínculo de {{ $vinculo->funcionario->name }} com {{ $vinculo->loja->nome }}?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center gap-1 text-xs text-stone-500 hover:text-red-600 border border-stone-200 hover:border-red-200 rounded-lg px-3 py-1.5 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Remover
                        </button>
                    </form>
                </li>
                @endforeach
            </ul>
        </div>
    @endif

</div>
@endsection
