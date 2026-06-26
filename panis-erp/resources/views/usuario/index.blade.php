<div>
    <h1>Listar usuários</h1>

    <ul>
        @foreach ($usuarios as $usuario)
            <li>
                <a href="">
                    <span>Nome: {{ $usuario->name }}</span>
                    <span>Categoria: {{ $usuario->perfil->descricao }}</span>
                </a>
            </li>
        @endforeach
    </ul>

    <a href="{{ url()->previous() }}">Voltar</a>
</div>