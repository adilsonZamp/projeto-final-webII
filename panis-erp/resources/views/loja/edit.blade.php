<a href="{{ url()->previous() }}">Voltar</a>

@if(session('erro'))
    <div class="alert alert-danger">
        <span style="color: red;">{{ session('erro') }}</span>
    </div>
@endif

<form action="{{ route('loja/update', ['id_loja' => $loja->id]) }}" method="post">
    @csrf
    @method('PUT')
    
    <label for="nome">Nome</label>
    <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror" 
    value="{{ old('nome', $loja->nome) }}" >
    @if($errors->has('nome'))
        <div style="color:red">
            {{ $errors->first('nome') }}
        </div>
    @endif

    <label for="dono">Dono:</label>
    <span name="dono">{{ $userLogado->name }}</span>
    
    <button type="submit">Criar</button>
</form>    