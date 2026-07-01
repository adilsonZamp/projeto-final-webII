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
        <h1 class="text-xl font-semibold text-stone-800">Registrar Venda</h1>
        <p class="text-sm text-stone-500 mt-0.5">Informe o valor, a data e a loja da venda.</p>
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
        <form action="{{ route('vendas/store') }}" method="POST" class="space-y-5">
            @csrf
            @method('POST')

            {{-- Valor --}}
            <div>
                <label for="valor" class="block text-sm font-medium text-stone-700 mb-1.5">Valor (R$)</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-stone-400 text-sm font-medium">R$</span>
                    <input type="number" name="valor" id="valor"
                        value="{{ old('valor') }}"
                        step="0.01" min="0"
                        class="w-full rounded-lg border text-sm pl-9 pr-3 py-2.5 text-stone-800 bg-white outline-none transition
                               {{ $errors->has('valor') ? 'border-red-300 focus:border-red-400 focus:ring-2 focus:ring-red-100' : 'border-stone-300 focus:border-amber-400 focus:ring-2 focus:ring-amber-50' }}"
                        placeholder="0,00">
                </div>
                @error('valor')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Data --}}
            <div>
                <label for="data_referencia" class="block text-sm font-medium text-stone-700 mb-1.5">Data de Referência</label>
                <input type="date" name="data_referencia" id="data_referencia"
                    value="{{ old('data_referencia') }}"
                    class="w-full rounded-lg border text-sm px-3 py-2.5 text-stone-800 bg-white outline-none transition
                           {{ $errors->has('data_referencia') ? 'border-red-300 focus:border-red-400 focus:ring-2 focus:ring-red-100' : 'border-stone-300 focus:border-amber-400 focus:ring-2 focus:ring-amber-50' }}">
                @error('data_referencia')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Loja --}}
            <div>
                <label for="id_loja" class="block text-sm font-medium text-stone-700 mb-1.5">Loja</label>
                <select name="id_loja" id="id_loja"
                    class="w-full rounded-lg border text-sm px-3 py-2.5 text-stone-800 bg-white outline-none transition
                           {{ $errors->has('id_loja') ? 'border-red-300 focus:border-red-400 focus:ring-2 focus:ring-red-100' : 'border-stone-300 focus:border-amber-400 focus:ring-2 focus:ring-amber-50' }}">
                    @foreach ($lojas as $loja)
                        <option value="{{ $loja->id }}" @if (old('id_loja') == $loja->id) selected @endif>
                            {{ $loja->nome }}
                        </option>
                    @endforeach
                </select>
                @error('id_loja')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="pt-2">
                <button type="submit"
                    class="w-full flex justify-center items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-lg px-4 py-2.5 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Registrar Venda
                </button>
            </div>

        </form>
    </div>

</div>
@endsection
