@extends('adminlte::page')

@section('title', 'Detalle Computadora')

@section('content_header')
    <h1>Detalle</h1>
@stop

@section('content')
<div class="card border-info">
    <div class="card-header bg-info">
        <h3 class="text-white">Detalle de computadora</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered" width="100%">
                <tr>
                    <th width="50%" scope="row" class="text-info text-right">Procesador:</th>
                    <td>{{ $computer->processor }}</td>
                </tr>

                <tr>
                    <th width="50%" scope="row" class="text-info text-right">RAM:</th>
                    <td>{{ $computer->ram }}</td>
                </tr>

                <tr>
                    <th width="50%" scope="row" class="text-info text-right">Almacenamiento:</th>
                    <td>{{ $computer->storage }}</td>
                </tr>

                <tr>
                    <th width="50%" scope="row" class="text-info text-right">Dirección ip:</th>
                    <td>{{ $computer->ip_address }}</td>
                </tr>

                <tr>
                    <th width="50%" scope="row" class="text-info text-right">Número computadora:</th>
                    <td>{{ $computer->number }}</td>
                </tr>
        </table>
        <a href="{{ route('admin.computers.index') }}" class="btn btn-info btn-block"> Volver atrás</a>
    </div>
</div>
@stop
