<!-- listar todos os vinculos visíveis -->
<a href="{{ route('vinculos/create') }}">Criar Vínculo</a>
<a href="{{ route('dono/funcionarios') }}">Voltar</a>
<br>
@if ($vinculos->count() > 0)
    <ul>
        @foreach ($vinculos as $vinculo)
            <li>
                <span>Funcionario: {{ $vinculo->funcionario->name }}</span>
                <span>Loja: {{ $vinculo->loja->nome }}</span>
                <!-- apenas dono pode apagar vínculos -->
                <form action="{{ 
                    route('vinculos/delete', ['userId' => $vinculo->user_id, 'lojaId' => $vinculo->loja_id]) 
                }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Excluir</button>
                </form>
            </li>
        @endforeach
    </ul>
@endif