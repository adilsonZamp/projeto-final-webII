@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-stone-50">
    <div class="max-w-4xl mx-auto py-10 px-4 sm:px-6">

        {{-- Header --}}
        <div class="mb-10">
            <div class="flex items-center gap-3 mb-1">
                <div class="w-9 h-9 rounded-xl bg-amber-500 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-semibold text-stone-800">Painel Principal</h1>
            </div>
            <p class="text-sm text-stone-500 ml-12">Gerencie suas lojas, equipe e vendas.</p>
        </div>

        {{-- Nav Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-10">

            <a href="{{ route('dono/funcionarios') }}"
               class="group flex items-start gap-4 bg-white border border-stone-200 rounded-2xl p-5 hover:border-amber-300 hover:shadow-sm transition-all">
                <div class="mt-0.5 w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center group-hover:bg-amber-100 transition-colors flex-shrink-0">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-stone-800 group-hover:text-amber-700 transition-colors">Funcionários</p>
                    <p class="text-xs text-stone-500 mt-0.5">Gerenciar equipe e cargos</p>
                </div>
            </a>

            <a href="{{ route('dono/lojas') }}"
               class="group flex items-start gap-4 bg-white border border-stone-200 rounded-2xl p-5 hover:border-amber-300 hover:shadow-sm transition-all">
                <div class="mt-0.5 w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center group-hover:bg-amber-100 transition-colors flex-shrink-0">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-stone-800 group-hover:text-amber-700 transition-colors">Lojas</p>
                    <p class="text-xs text-stone-500 mt-0.5">Cadastros e detalhes</p>
                </div>
            </a>

            <a href="{{ route('vendas') }}"
               class="group flex items-start gap-4 bg-white border border-stone-200 rounded-2xl p-5 hover:border-amber-300 hover:shadow-sm transition-all">
                <div class="mt-0.5 w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center group-hover:bg-amber-100 transition-colors flex-shrink-0">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-stone-800 group-hover:text-amber-700 transition-colors">Vendas</p>
                    <p class="text-xs text-stone-500 mt-0.5">Registros e relatórios</p>
                </div>
            </a>

        </div>

        {{-- Logout --}}
        <div class="border-t border-stone-200 pt-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="inline-flex items-center gap-2 text-sm text-stone-500 hover:text-red-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Sair da conta
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
