@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-10 px-4 sm:px-6">

    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('vinculos') }}"
           class="inline-flex items-center gap-1.5 text-sm text-stone-500 hover:text-stone-700 transition-colors mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Vínculos
        </a>
        <h1 class="text-xl font-semibold text-stone-800">Novo Vínculo</h1>
        <p class="text-sm text-stone-500 mt-0.5">Associe um funcionário a uma loja.</p>
    </div>

    {{-- Error --}}
    @error('duplicado')
        <div class="mb-6 flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm">
            <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            {{ $message }}
        </div>
    @enderror

    {{-- Form --}}
    <div class="bg-white border border-stone-200 rounded-2xl p-6">
        <form action="{{ route('vinculos/store') }}" method="POST" class="space-y-5">
            @csrf
            @method('POST')

            {{-- Funcionário --}}
            <div>
                <label for="user_id" class="block text-sm font-medium text-stone-700 mb-1.5">Funcionário</label>
                <select name="user_id" id="user_id"
                    class="w-full rounded-lg border border-stone-300 text-sm px-3 py-2.5 text-stone-800 bg-white outline-none transition focus:border-amber-400 focus:ring-2 focus:ring-amber-50">
                    @foreach ($funcionarios as $funcionario)
                        <option value="{{ $funcionario->id }}">{{ $funcionario->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Loja --}}
            <div>
                <label for="loja_id" class="block text-sm font-medium text-stone-700 mb-1.5">Loja</label>
                <select name="loja_id" id="loja_id"
                    class="w-full rounded-lg border border-stone-300 text-sm px-3 py-2.5 text-stone-800 bg-white outline-none transition focus:border-amber-400 focus:ring-2 focus:ring-amber-50">
                    @foreach ($lojas as $loja)
                        <option value="{{ $loja->id }}">{{ $loja->nome }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Submit --}}
            <div class="pt-2">
                <button type="submit"
                    class="w-full flex justify-center items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-lg px-4 py-2.5 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                    Criar Vínculo
                </button>
            </div>

        </form>
    </div>

</div>
@endsection
