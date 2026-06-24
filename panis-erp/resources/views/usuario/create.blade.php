<div>
    <!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->

    <form action="{{route('usuario.store')}}" method="POST">
        @csrf
        @method('POST')
        
        <label for="name">Nome</label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
        @if($errors->has('name'))
            <div style="color:red">
                {{ $errors->first('name') }}
            </div>
        @endif

        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror">
        @if($errors->has('email'))
            <div style="color:red">
                {{ $errors->first('email') }}
            </div>
        @endif

        <label for="password">Senha</label>
        <input type="password" name="password" id="password" readonly value="senha" class="form-control @error('password') is-invalid @enderror">
        @if($errors->has('password'))
            <div style="color:red">
                {{ $errors->first('password') }}
            </div>
        @endif

        <select name="id_perfil" id="id_perfil" class="form-control @error('id_perfil') is-invalid @enderror">
            <option value="1">Dono</option>
            <option value="2">Gerente</option>
            <option value="3">Funcionário</option>
        </select>
        @if($errors->has('id_perfil'))
            <div style="color:red">
                {{ $errors->first('id_perfil') }}
            </div>
        @endif
        
        <button type="submit">Salvar</button>
    </form>
</div>
