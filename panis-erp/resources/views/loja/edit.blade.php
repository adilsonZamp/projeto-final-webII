@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-10 px-4 sm:px-6">

    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ url()->previous() }}"
           class="inline-flex items-center gap-1.5 text-sm text-stone-500 hover:text-stone-700 transition-colors mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Voltar
        </a>
        <h1 class="text-xl font-semibold text-stone-800">Editar Loja</h1>
        <p class="text-sm text-stone-500 mt-0.5">Atualize as informações de <span class="font-medium text-stone-700">{{ $loja->nome }}</span>.</p>
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

    {{-- Form --}}
    <div class="bg-white border border-stone-200 rounded-2xl p-6">
        <form action="{{ route('loja/update', ['id_loja' => $loja->id]) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Nome --}}
            <div>
                <label for="nome" class="block text-sm font-medium text-stone-700 mb-1.5">Nome da Loja</label>
                <input type="text" name="nome" id="nome"
                    value="{{ old('nome', $loja->nome) }}"
                    class="w-full rounded-lg border text-sm px-3 py-2.5 text-stone-800 bg-white outline-none transition
                           {{ $errors->has('nome') ? 'border-red-300 focus:border-red-400 focus:ring-2 focus:ring-red-100' : 'border-stone-300 focus:border-amber-400 focus:ring-2 focus:ring-amber-50' }}"
                    placeholder="Nome da loja">
                @error('nome')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Dono (readonly) --}}
            <div>
                <label class="block text-sm font-medium text-stone-700 mb-1.5">Dono</label>
                <div class="w-full rounded-lg border border-stone-200 bg-stone-50 text-sm px-3 py-2.5 text-stone-600">
                    {{ $userLogado->name }}
                </div>
            </div>

            {{-- Submit --}}
            <div class="pt-2">
                <button type="submit"
                    class="w-full flex justify-center items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-lg px-4 py-2.5 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Salvar Alterações
                </button>
            </div>

        </form>
    </div>

</div>
@endsection
