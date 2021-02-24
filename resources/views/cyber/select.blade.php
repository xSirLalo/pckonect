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
            <h3 class="text-white">Computadora Seleccionada <strong>{{ $computer->number }}</strong></h3>
            <p class="text-white">Hola de nuevo pelaná.</p>
        </div>
        <div class="card-body text-{{ $color }}">
            <table class="table table-bordered">
                <thead class="text-center text-{{ $color }}">
                    <tr>
                        <th colspan="2">Caracteristicas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="50%" scope="row" class="text-{{ $color }} text-right">Procesador:</td>
                        <td>{{ $computer->processor }}</td>
                    </tr>
                    <tr>
                        <td width="50%" scope="row" class="text-{{ $color }} text-right">RAM:</td>
                        <td>{{ $computer->ram }}</td>
                    </tr>
                    <tr>
                        <td width="50%" scope="row" class="text-{{ $color }} text-right">Almacenamiento:</td>
                        <td>{{ $computer->storage }}</td>
                    </tr>
                </tbody>
            </table>
            <form action="{{ route('cyber.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input id="user_id" class="form-control" type="hidden" title="user_id" name="user_id" value="{{ Auth::user()->id }}" readonly>
                    <input id="computer_id" class="form-control" type="hidden" title="cumputer_id" name="computer_id" value="{{ old('id', $computer->id) }}" readonly>
                    <input id="number_computer" class="form-control" type="hidden" title="number_computer" name="number_computer" value="{{ old('number', $computer->number) }}" readonly>
                </div>
                <button class="btn btn-lg btn-block btn-{{ $color }}" type="submit"> {{ $btnName }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
