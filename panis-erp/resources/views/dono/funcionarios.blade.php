<div>
    <a href="{{ route('dono/funcionario/create') }}">Novo Funcionário</a>
    <a href="{{ route('vinculos') }}">Vinculos dos Funcionário</a>
    <a href="{{ route('dono/home') }}">Voltar</a>
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
                    <a href="">Visualizar</a>
                    <a href="">Editar</a>
                </li>
                <br>
            @endforeach
        </div>
    </ul>
</div>