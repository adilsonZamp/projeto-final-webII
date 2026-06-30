<!-- listar lojas -->
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
                    <a href="">Visualizar</a>
                    <a href="">Editar</a>
                </li>
                <br>
            @endforeach
        </div>
    </ul>