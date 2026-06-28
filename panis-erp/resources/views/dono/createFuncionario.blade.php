@section('scripts')
    <script>
        const selectPerfil = document.getElementById('id_perfil');
        const campoResponsavel = document.getElementById('select-responsavel');
        const fieldResponsavel = document.getElementById('field-responsavel');
        

        window.onload = function() {
            // console.log(selectPerfil.value);
            atualizarEstado(selectPerfil.value);
        };

        selectPerfil.addEventListener('change', function () {
            atualizarEstado(this.value);
        });

        function atualizarEstado(param) {
            //perfil 2 -> gerente
            //perfil 3 -> funcionario
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
@endsection

<body>
    <h1>Criar Funcionário</h1>
    <a href="{{ route('dono/funcionarios') }}">Voltar</a>
    
    <div>
        @if(session('erro'))
            <div class="alert alert-danger">
                <span style="color: red;">{{ session('erro') }}</span>
            </div>
        @endif

        <form id="a" action="{{ route('usuario.store') }}" method="POST">
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
            <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" autocomplete="new-email">
            @if($errors->has('email'))
                <div style="color:red">
                    {{ $errors->first('email') }}
                </div>
            @endif

            <label for="password">Senha</label>
            <input type="password" name="password" id="password" placeholder="Senha" 
                class="form-control @error('password') is-invalid @enderror" autocomplete="new-password"
            > 
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

            <div>
                <label for="responsavel" id="label-responsavel">Responsável:</label>
                <span id="field-responsavel" display="">{{ $donologadoNome }}</span>
                <select name="id_responsavel" id="select-responsavel" style="display: none;" class="form-control @error('id_responsavel') is-invalid @enderror">
                    @foreach ($responsaveis as $responsavel)
                        <option value="{{ $responsavel->id }}"
                            @if (old('id_responsavel') == $responsavel->id) selected @endif
                        >
                            {{ $responsavel->id }}
                            {{ $responsavel->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @if($errors->has('id_responsavel'))
                <div style="color:red">
                    {{ $errors->first('id_responsavel') }}
                </div>
            @endif
            
            <button type="submit">Salvar</button>
        </form>
    </div>

    @yield('scripts')
</body>