@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-10 px-4 sm:px-6">

    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('dono/funcionarios') }}"
           class="inline-flex items-center gap-1.5 text-sm text-stone-500 hover:text-stone-700 transition-colors mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Funcionários
        </a>
        <h1 class="text-xl font-semibold text-stone-800">
            {{ $storeOrUpdate == 'usuario.store' ? 'Novo Funcionário' : 'Editar Funcionário' }}
        </h1>
        <p class="text-sm text-stone-500 mt-0.5">
            {{ $storeOrUpdate == 'usuario.store' ? 'Preencha os dados do novo membro da equipe.' : 'Atualize as informações do funcionário.' }}
        </p>
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

    {{-- Form Card --}}
    <div class="bg-white border border-stone-200 rounded-2xl p-6">
        <form id="a" action="{{ $storeOrUpdate == 'usuario.store'
                                    ? route('usuario.store')
                                    : route('dono/funcionario/update', $prevUser->id)
        }}" method="POST" class="space-y-5">
            @csrf
            @if ($storeOrUpdate == 'usuario.store')
                @method('POST')
            @elseif ($storeOrUpdate == 'dono/funcionario/update')
                @method('PUT')
            @endif

            {{-- Nome --}}
            <div>
                <label for="name" class="block text-sm font-medium text-stone-700 mb-1.5">Nome</label>
                <input type="text" name="name" id="name"
                    value="{{ old('name', $prevUser->name ?? null) }}"
                    class="w-full rounded-lg border text-sm px-3 py-2.5 text-stone-800 bg-white outline-none transition
                           {{ $errors->has('name') ? 'border-red-300 focus:border-red-400 focus:ring-2 focus:ring-red-100' : 'border-stone-300 focus:border-amber-400 focus:ring-2 focus:ring-amber-50' }}"
                    placeholder="Nome completo">
                @error('name')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-stone-700 mb-1.5">E-mail</label>
                <input type="text" name="email" id="email"
                    value="{{ old('email', $prevUser->email ?? null) }}"
                    autocomplete="new-email"
                    class="w-full rounded-lg border text-sm px-3 py-2.5 text-stone-800 bg-white outline-none transition
                           {{ $errors->has('email') ? 'border-red-300 focus:border-red-400 focus:ring-2 focus:ring-red-100' : 'border-stone-300 focus:border-amber-400 focus:ring-2 focus:ring-amber-50' }}"
                    placeholder="email@exemplo.com">
                @error('email')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Senha --}}
            <div>
                <label for="password" class="block text-sm font-medium text-stone-700 mb-1.5">
                    Senha
                    @if($storeOrUpdate == 'dono/funcionario/update')
                        <span class="font-normal text-stone-400">(deixe em branco para não alterar)</span>
                    @endif
                </label>
                <input type="password" name="password" id="password"
                    autocomplete="new-password"
                    class="w-full rounded-lg border text-sm px-3 py-2.5 text-stone-800 bg-white outline-none transition
                           {{ $errors->has('password') ? 'border-red-300 focus:border-red-400 focus:ring-2 focus:ring-red-100' : 'border-stone-300 focus:border-amber-400 focus:ring-2 focus:ring-amber-50' }}"
                    placeholder="••••••••">
                @error('password')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Perfil --}}
            <div>
                <label for="id_perfil" class="block text-sm font-medium text-stone-700 mb-1.5">Perfil</label>
                <select name="id_perfil" id="id_perfil"
                    class="w-full rounded-lg border text-sm px-3 py-2.5 text-stone-800 bg-white outline-none transition
                           {{ $errors->has('id_perfil') ? 'border-red-300 focus:border-red-400 focus:ring-2 focus:ring-red-100' : 'border-stone-300 focus:border-amber-400 focus:ring-2 focus:ring-amber-50' }}">
                    @foreach ($perfis as $perfil)
                        <option value="{{ $perfil->id }}"
                            @if (old('id_perfil', $prevUser->id_perfil ?? null) == $perfil->id) selected @endif>
                            {{ $perfil->descricao }}
                        </option>
                    @endforeach
                </select>
                @error('id_perfil')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Responsável --}}
            <div>
                <label for="responsavel" class="block text-sm font-medium text-stone-700 mb-1.5">Responsável</label>

                {{-- Exibição estática para gerente (perfil 2) --}}
                <div id="field-responsavel"
                    class="w-full rounded-lg border border-stone-200 bg-stone-50 text-sm px-3 py-2.5 text-stone-600">
                    {{ $donologadoNome }}
                </div>

                {{-- Seleção de responsável para funcionário (perfil 3) --}}
                <select name="id_responsavel" id="select-responsavel"
                    class="w-full rounded-lg border text-sm px-3 py-2.5 text-stone-800 bg-white outline-none transition
                           {{ $errors->has('id_responsavel') ? 'border-red-300 focus:border-red-400 focus:ring-2 focus:ring-red-100' : 'border-stone-300 focus:border-amber-400 focus:ring-2 focus:ring-amber-50' }}">
                    @foreach ($responsaveis as $responsavel)
                        <option value="{{ $responsavel->id }}"
                            @if (old('id_responsavel', $prevUser->id_responsavel ?? null) == $responsavel->id) selected @endif>
                            {{ $responsavel->name }}
                        </option>
                    @endforeach
                </select>

                @error('id_responsavel')
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
                    {{ $storeOrUpdate == 'usuario.store' ? 'Cadastrar Funcionário' : 'Salvar Alterações' }}
                </button>
            </div>

        </form>
    </div>

</div>
@endsection

@push('scripts')
<script>
    const selectPerfil = document.getElementById('id_perfil');
    const campoResponsavel  = document.getElementById('select-responsavel');
    const fieldResponsavel  = document.getElementById('field-responsavel');

    window.onload = function () {
        atualizarEstado(selectPerfil.value);
    };

    selectPerfil.addEventListener('change', function () {
        atualizarEstado(this.value);
    });

    function atualizarEstado(param) {
        // perfil 2 -> gerente | perfil 3 -> funcionario
        if (param == 2) {
            ocultar(campoResponsavel);
            mostrar(fieldResponsavel);
        } else {
            mostrar(campoResponsavel);
            ocultar(fieldResponsavel);
        }
    }

    function ocultar(campo) {
        campo.style.display = 'none';
        campo.disabled = true;
    }

    function mostrar(campo) {
        campo.style.display = '';
        campo.disabled = false;
    }
</script>
@endpush
