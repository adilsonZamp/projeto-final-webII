<a href="{{ route('dono/home') }}">Voltar</a>

<h2>{{ $loja->nome }}</h2>
<span>Criada em: {{ $loja->created_at }}</span>
<br>
<h3>Empregados Cadastrados:</h3>
<ul>
    <div>
        @foreach ($empregados as $empregado)
            <li>
                <label for="name">Nome:</label>
                <span name="name">{{ $empregado->name }}</span>
                <br>
                <label for="responsavel">Dono:</label>
                <span name="responsavel">{{ $loja->dono->name }}</span>
                <br>
                <a href="{{ route('usuario.edit', ['usuario' => $empregado->id]) }}">Editar</a>
                <form action="{{ 
                    route('usuario.destroy', ['usuario' => $empregado->id]) 
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