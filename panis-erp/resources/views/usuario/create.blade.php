@section('scripts')
    <script>
        const selectPerfil = document.getElementById('id_perfil');
        const campoResponsavel = document.getElementById('select-responsavel');
        const campoDono = document.getElementById('select-dono');
        const campoGerente = document.getElementById('select-gerente');

        
        window.onload = function() {
            // console.log(selectPerfil.value);
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
            
            // campo.value = '';
            campo.disabled = true;
        }

        function mostrar(campo) {
            campo.style.display = '';

            campo.disabled = false;
        }
    </script>
@endsection

<body>
    <div>
        <!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->
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
            <input type="password" name="password" id="password" readonly value="senha" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" > 
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
                <div> <!-- gerente responde a dono -->
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

                <div> <!-- funcionario responde a gerente -->
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
    </div>

    @yield('scripts')
</body>