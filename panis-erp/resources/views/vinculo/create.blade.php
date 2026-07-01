<!-- criar vinculo entre user (gerente ou funcionario) e loja -->
<!-- apenas o dono e admin pode acessar e fazer a operação -->
<a href="{{ url()->previous() }}">Voltar</a><br>

@error('duplicado')
    <span style="color:red;">{{ $message  }}</span>
@enderror

<form action="{{ route('vinculos/store') }}" method="post">
    @csrf
    @method('POST')

    <label for="user_id">Funcionario</label>
    <select name="user_id">
        @foreach ($funcionarios as $funcionario)
            <option value="{{ $funcionario->id }}">
                {{ $funcionario->name }}
            </option>
        @endforeach
    </select>
    <br>
    <label for="loja_id">Loja</label>
    <select name="loja_id">
        @foreach ($lojas as $loja)
            <option value="{{ $loja->id }}">
                {{ $loja->nome }}
            </option>
        @endforeach
    </select>    
    <br><br>
    <button type="submit">Salvar</button>
</form>