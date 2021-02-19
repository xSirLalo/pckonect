@csrf
<div class="form-row">
    <div class="form-group col">
        <label for="processor">Procesador</label>
        <input id="processor" class="form-control @error('processor') is-invalid @enderror" type="text" name="processor"
            value="{{ old('processor', $computer->processor) }}">
        @error('processor')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group col">
        <label for="ram">RAM</label>
        <input id="ram" class="form-control @error('ram') is-invalid @enderror" type="text" name="ram" value="{{ old('ram', $computer->ram) }}">
        @error('ram')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group col">
        <label for="storage">Almacenamiento</label>
        <input id="storage" class="form-control @error('storage') is-invalid @enderror" type="text" name="storage" value="{{ old('storage', $computer->storage) }}">
        @error('storage')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="form-row">
    <div class="form-group col">
        <label for="number">Número computadora</label>
        <input id="number" class="form-control @error('number') is-invalid @enderror" type="text" name="number" value="{{ old('number', $computer->number) }}">
        @error('number')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group col">
        <label for="ip_address">Dirección ip</label>
        <input id="ip_address" class="form-control @error('ip_address') is-invalid @enderror" type="text" name="ip_address" value="{{ old('ip_address', $computer->ip_address) }}" placeholder="127.0.0.1">
        @error('ip_address')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
<a href="{{ route('admin.computers.index') }}" class="btn btn-secondary"> Cancelar</a>
<button class="btn btn-{{ $btnColor }}" type="submit"> Guardar</button>
