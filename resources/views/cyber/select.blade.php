@extends('layouts.app')

@section('content')
<div class="container">
    @php
        if ($computer->control == 0) {
            $color = 'primary';
            $btnName = 'I n i c i a r';
        }else {
            $color = 'danger';
            $btnName = 'F i n a l i z a r';
        }
    @endphp
    <div class="card border-{{ $color }}">
        <div class="card-header bg-{{ $color }}">
            <h3 class="text-white">Selección de computadora</h3>
            <p class="text-white">Hola de nuevo pelaná.</p>
        </div>
        <div class="card-body text-{{ $color }}">
            <form action="{{ route('cyber.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="user_id">Id Usuario</label>
                    <input id="user_id" class="form-control" type="text" name="user_id" value="{{ Auth::user()->id }}" readonly>
                </div>
                <div class="form-group">
                    <label for="number_computer">Computadora Seleccionada</label>
                    <input id="number_computer" class="form-control" type="text" name="number_computer" value="{{ old('number', $computer->number) }}" readonly>
                </div>
                <button class="btn btn-lg btn-block btn-{{ $color }}" type="submit"> {{ $btnName }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
