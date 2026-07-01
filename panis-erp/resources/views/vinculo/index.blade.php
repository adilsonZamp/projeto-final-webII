<!-- listar todos os vinculos visíveis -->
<a href="{{ route('vinculos/create') }}">Criar Vínculo</a>
<a href="{{ $userLogado->homeRoute() }}">Voltar</a>
<br>
@if ($vinculos->count() > 0)
    <ul>
        @foreach ($vinculos as $vinculo)
            <li>
                <span>Funcionario: {{ $vinculo->funcionario->name }}</span>
                <span>Loja: {{ $vinculo->loja->nome }}</span>
            </li>
        @endforeach
    </ul>
@endif