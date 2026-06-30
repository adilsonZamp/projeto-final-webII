<a href="{{ route('vendas/create') }}">Registrar Venda</a>
<a href="{{ route($userLogado->homeRoute()) }}">Voltar</a>
<ul>
    <div>
        @foreach ($vendas as $venda)
            <li>
                <span name="valor">R$ {{ $venda->valor }}</span>
                <label for="nome-loja">Loja:</label>
                <span name="nome-loja">{{ $venda->loja->nome }}</span>
                <br>
                <label for="responsavel">Dono:</label>
                <span name="responsavel">{{ $venda->loja->dono->name }}</span>
                <br>
                <a href="">Visualizar</a>
                <a href="">Editar</a>
            </li>
            <br>
        @endforeach
    </div>
</ul>