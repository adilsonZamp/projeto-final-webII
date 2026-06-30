<a href="{{ url()->previous() }}">Voltar</a>

@if(session('erro'))
    <div class="alert alert-danger">
        <span style="color: red;">{{ session('erro') }}</span>
    </div>
@endif

<form action="{{ route('vendas/store') }}" method="post">
    @csrf
    @method('POST')

    <label for="valor">Valor:</label>
    <input type="number" name="valor" id="valor" class="form-control @error('valor') is-invalid @enderror" 
    value="{{ old('valor') }}" >
    @if($errors->has('valor'))
        <div style="color:red">
            {{ $errors->first('valor') }}
        </div>
    @endif

    <label for="data_referencia">Data:</label>
    <input type="date" name="data_referencia" id="data_referencia" class="form-control @error('data_referencia') is-invalid @enderror" 
    value="{{ old('data_referencia') }}" >
    @if($errors->has('data_referencia'))
        <div style="color:red">
            {{ $errors->first('data_referencia') }}
        </div>
    @endif

    <label for="id_loja">Loja:</label>
    <select name="id_loja" id="id_loja">
        @foreach ($lojas as $loja)
            <option value="{{ $loja->id }}" 
                @if (old('id_loja') == $loja->id)
                    selected
                @endif
            >
                {{ $loja->nome }}
            </option>
        @endforeach
    </select>
    @if($errors->has('id_loja'))
        <div style="color:red">
            {{ $errors->first('id_loja') }}
        </div>
    @endif
    
    <button type="submit">Registrar</button>
</form>    