<!-- listar lojas -->
<a href="{{ url()->previous() }}">Voltar</a>

@if(session('erro'))
    <div class="alert alert-danger">
        <span style="color: red;">{{ session('erro') }}</span>
    </div>
@endif

<form action="{{ route('loja/store') }}" method="post">
    @csrf
    @method('POST')
    
    <label for="nome">Nome</label>
    <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror" 
    value="{{ old('nome') }}" >
    @if($errors->has('nome'))
        <div style="color:red">
            {{ $errors->first('nome') }}
        </div>
    @endif

    <label for="dono">Dono:</label>
    @if ($userLogado->perfil->descricao == 'Administrador')
        <select name="id_dono" id="id_dono" class="form-control @error('id_dono') is-invalid @enderror">
        @foreach ($donos as $dono)
            <option value="{{ $dono->id }}"
                @if (old('id_dono') == $dono->id) selected @endif
            >
                {{ $dono->id }}
                {{ $dono->name }}
            </option>
        @endforeach
    </select> 
    @endif
    
    @if ($userLogado->perfil->descricao == 'Dono')
        <span>{{ $userLogado->name }}</span>
    @endif
    
    <button type="submit">Criar</button>
</form>    