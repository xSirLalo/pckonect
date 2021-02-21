@csrf
<div class="form-row">
    <div class="form-group col">
        <label for="name">Nombre: </label>
        <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name"
            value="{{ old('name', $role->name) }}">
        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="form-row">
    <div class="form-group col">
        <label for="permission">Permisos: </label>
            <select id="permission[]" class="form-control @error('permission') is-invalid @enderror" multiple="multiple" name="permission[]" size="15">
                @foreach ($permission as $value)
                        <option
                            @if (isset($rolePermissions))
                                @foreach ($rolePermissions as $key => $value2)
                                    @if ($key == $value->id)
                                        selected="selected"
                                    @endif
                                @endforeach
                            @endif
                        value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
            </select>
        @error('permission')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
<a href="{{ route('admin.roles.index') }}" class="btn btn-secondary"> Cancelar</a>
<button class="btn btn-{{ $btnColor }}" type="submit"> Guardar</button>
