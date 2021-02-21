@csrf
<div class="form-row">
    <div class="form-group col">
        <label for="name">Nombre: </label>
        <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name"
            value="{{ old('name', $user->name) }}">
        @error('name')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group col">
        <label for="last_name">Apellido: </label>
        <input id="last_name" class="form-control @error('last_name') is-invalid @enderror" type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}">
        @error('last_name')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="form-row">
    <div class="form-group col">
        <label for="email">Email: </label>
        <input id="email" class="form-control @error('email') is-invalid @enderror" type="text" name="email" value="{{ old('email', $user->email) }}">
        @error('email')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="form-row">
    <div class="form-group col">
        <label for="password">Contraseña: </label>
        <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password">
        @error('password')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group col">
        <label for="password-confirm">Confirmar Contraseña: </label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
    </div>
</div>
<div class="form-row">
    <div class="form-group col">
        <label for="roles">Rol: </label>
            <select id="roles[]" class="form-control @error('roles') is-invalid @enderror" multiple="multiple" name="roles[]">
                @foreach ($roles as $key => $value)
                    <option {{ $userRole == $value ? 'selected="selected"' : '' }} value="{{ $key }}">
                        {{ $value }}
                    </option>
                @endforeach
                {{-- @foreach( $roles as $key => $value )
                <option value="{{ $key }}">{{ $value }}</option>
                @endforeach --}}
            </select>
        @error('roles')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
<a href="{{ route('admin.users.index') }}" class="btn btn-secondary"> Cancelar</a>
<button class="btn btn-{{ $btnColor }}" type="submit"> Guardar</button>
