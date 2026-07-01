<!-- listar lojas -->
@error('erro')
    <span>{{ $message }}</span>
@enderror

<a href="{{ route('loja/create') }}">Criar Loja</a>
    <a href="{{ route('dono/home') }}">Voltar</a>
    <ul>
        <div>
            @foreach ($lojas as $loja)
                <li>
                    <label for="name">Nome:</label>
                    <span name="name">{{ $loja->nome }}</span>
                    <br>
                    <label for="responsavel">Dono:</label>
                    <span name="responsavel">{{ $loja->dono->name }}</span>
                    <br>
                    <!-- Apenas dono pode: -->
                    <a href="{{ route('loja.show', ['loja' => $loja->id]) }}">Visualizar</a>
                    <a href="{{ route('loja.edit', ['loja' => $loja->id]) }}">Editar</a>
                    <form action="{{ 
                        route('loja.destroy', ['loja' => $loja->id]) 
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