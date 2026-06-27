<div>
    <ul>
        <div>
            @foreach ($funcionarios as $funcionario)
                <li>
                    <label for="name">Nome:</label>
                    <span name="name">{{ $funcionario->name }}</span>
                    <br>
                    <label for="categoria">Categoria:</label>
                    <span name="categoria">{{ $funcionario->perfil->descricao }}</span>
                    <br>
                    <label for="responsavel">Responsavel:</label>
                    <span name="responsavel">{{ $funcionario->responsavel->name }}</span>
                    <br>
                    <a href="">Visualizar</a>
                    <a href="">Editar</a>
                </li>
                <br>
            @endforeach
        </div>
    </ul>
</div>