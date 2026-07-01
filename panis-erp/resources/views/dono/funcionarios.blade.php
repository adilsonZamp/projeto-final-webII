<a href="{{ route('dono/funcionario/create') }}">Novo Funcionário</a>
<a href="{{ route('vinculos') }}">Vinculos dos Funcionário</a>
<a href="{{ route('dono/home') }}">Voltar</a>

<div>
    @if(session('erro'))
        <div class="alert alert-danger">
            <span style="color: red;">{{ session('erro') }}</span>
        </div>
    @endif
    <ul>
        <div>
            @foreach ($usuarios as $usuario)
                <li>
                    <label for="name">Nome:</label>
                    <span name="name">{{ $usuario->name }}</span>
                    <br>
                    <label for="categoria">Categoria:</label>
                    <span name="categoria">{{ $usuario->perfil->descricao }}</span>
                    <br>
                    <label for="responsavel">Responsável:</label>
                    <span name="responsavel">{{ $usuario->responsavel->name }}</span>
                    <br>
                    <a href="{{ route('dono/funcionario/edit', ['id' => $usuario->id]) }}">Editar</a>
                    <form action="{{ 
                        route('usuario.destroy', ['usuario' => $usuario->id]) 
                    }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Excluir</button>
                    </form>
                </li>
                <br>
            @endforeach
        </div>
    </ul>
</div>