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
        <h1 class="text-xl font-semibold text-stone-800">Novo Usuário</h1>
        <p class="text-sm text-stone-500 mt-0.5">Cadastre um novo usuário no sistema.</p>
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
        <form id="a" action="{{ route('usuario.store') }}" method="POST" class="space-y-5">
            @csrf
            @method('POST')

            {{-- Nome --}}
            <div>
                <label for="name" class="block text-sm font-medium text-stone-700 mb-1.5">Nome</label>
                <input type="text" name="name" id="name"
                    value="{{ old('name') }}"
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
                    value="{{ old('email') }}"
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
                    <span class="font-normal text-stone-400 text-xs">(gerada automaticamente)</span>
                </label>
                <input type="password" name="password" id="password"
                    readonly value="senha"
                    class="w-full rounded-lg border border-stone-200 bg-stone-50 text-sm px-3 py-2.5 text-stone-400 cursor-not-allowed
                           {{ $errors->has('password') ? 'border-red-300' : '' }}">
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
                        <option value="{{ $perfil->id }}" @if (old('id_perfil') == $perfil->id) selected @endif>
                            {{ $perfil->descricao }}
                        </option>
                    @endforeach
                </select>
                @error('id_perfil')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Responsável (dinâmico) --}}
            <div id="select-responsavel" class="space-y-3">
                {{-- Gerente → responde a Dono --}}
                <div id="select-dono">
                    <label class="block text-sm font-medium text-stone-700 mb-1.5">Responsável (Dono)</label>
                    <select name="id_responsavel"
                        class="w-full rounded-lg border text-sm px-3 py-2.5 text-stone-800 bg-white outline-none transition border-stone-300 focus:border-amber-400 focus:ring-2 focus:ring-amber-50
                               {{ $errors->has('id_responsavel') ? 'border-red-300' : '' }}">
                        @foreach ($donos as $dono)
                            <option value="{{ $dono->id }}" @if (old('id_responsavel') == $dono->id) selected @endif>
                                {{ $dono->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Funcionário → responde a Gerente --}}
                <div id="select-gerente">
                    <label class="block text-sm font-medium text-stone-700 mb-1.5">Responsável (Gerente)</label>
                    <select name="id_responsavel"
                        class="w-full rounded-lg border text-sm px-3 py-2.5 text-stone-800 bg-white outline-none transition border-stone-300 focus:border-amber-400 focus:ring-2 focus:ring-amber-50
                               {{ $errors->has('id_responsavel') ? 'border-red-300' : '' }}">
                        @foreach ($gerentes as $gerente)
                            <option value="{{ $gerente->id }}" @if (old('id_responsavel') == $gerente->id) selected @endif>
                                {{ $gerente->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                @error('id_responsavel')
                    <p class="text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="pt-2">
                <button type="submit"
                    class="w-full flex justify-center items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-lg px-4 py-2.5 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Cadastrar Usuário
                </button>
            </div>

        </form>
    </div>

</div>
@endsection

@push('scripts')
<script>
    const selectPerfil  = document.getElementById('id_perfil');
    const campoResponsavel = document.getElementById('select-responsavel');
    const campoDono    = document.getElementById('select-dono');
    const campoGerente = document.getElementById('select-gerente');

    window.onload = function () {
        atualizarEstado(selectPerfil.value);
    };

    selectPerfil.addEventListener('change', function () {
        atualizarEstado(this.value);
    });

    function atualizarEstado(param) {
        if (param == 2) {
            mostrar(campoResponsavel);
            mostrar(campoDono);
            ocultar(campoGerente);
        } else if (param == 3) {
            mostrar(campoResponsavel);
            ocultar(campoDono);
            mostrar(campoGerente);
        } else {
            ocultar(campoResponsavel);
            ocultar(campoDono);
            ocultar(campoGerente);
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

<!-- 
<body>
    <div>
        @if(session('erro'))
            <div class="alert alert-danger">
                <span style="color: red;">{{ session('erro') }}</span>
            </div>
        @endif

        <form id="a" action="{{route('usuario.store')}}" method="POST">
            @csrf
            @method('POST')
            
            <label for="name">Nome</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
            value="{{ old('name') }}" >
            @if($errors->has('name'))
                <div style="color:red">
                    {{ $errors->first('name') }}
                </div>
            @endif

            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" >
            @if($errors->has('email'))
                <div style="color:red">
                    {{ $errors->first('email') }}
                </div>
            @endif

            <label for="password">Senha</label>
            <input type="password" name="password" id="password" readonly value="senha" class="form-control @error('password') is-invalid @enderror" > 
            @if($errors->has('password'))
                <div style="color:red">
                    {{ $errors->first('password') }}
                </div>
            @endif

            <select name="id_perfil" id="id_perfil" class="form-control @error('id_perfil') is-invalid @enderror">
                @foreach ($perfis as $perfil)
                    <option value="{{ $perfil->id }}"
                        @if (old('id_perfil') == $perfil->id) selected @endif
                    >
                        {{ $perfil->descricao }}
                    </option>
                @endforeach
            </select>
            @if($errors->has('id_perfil'))
                <div style="color:red">
                    {{ $errors->first('id_perfil') }}
                </div>
            @endif

            <div id="select-responsavel" style="display: none;">
                <div>
                    <select id="select-dono" style="display: none;" name="id_responsavel" id="id_responsavel" class="form-control @error('id_responsavel') is-invalid @enderror">
                        @foreach ($donos as $dono)
                            <option value="{{ $dono->id }}"
                                @if (old('id_responsavel') == $dono->id) selected @endif
                            >
                                {{ $dono->id }}
                                {{ $dono->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div> 
                    <select id="select-gerente" style="display: none;" name="id_responsavel" id="id_responsavel" class="form-control @error('id_responsavel') is-invalid @enderror">
                        @foreach ($gerentes as $gerente)
                            <option value="{{ $gerente->id }}"
                                @if (old('id_responsavel') == $dono->id) selected @endif
                            >
                                {{ $gerente->id }}
                                {{ $gerente->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                @if($errors->has('id_responsavel'))
                    <div style="color:red">
                        {{ $errors->first('id_responsavel') }}
                    </div>
                @endif
            </div>
            
            <button type="submit">Salvar</button>
        </form>
    </div> -->