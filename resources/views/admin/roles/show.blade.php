@extends('adminlte::page')

@section('title', 'Detalle Rol')

@section('content_header')
    <h1>Detalle</h1>
@stop

@section('content')
<div class="col-sm-6">
    <div class="card">
        <div class="card-header">
            <h3>Detalle de Rol</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered" width="100%">
                    <tr>
                        <th width="50%" scope="row" class="text-right">Nombre:</th>
                        <td>{{ $role->name }}</td>
                    </tr>

                    <tr>
                        <th width="50%" scope="row" class="text-right">Permisos:</th>
                        <td>
                            @if(!empty($rolePermissions))
                                @foreach($rolePermissions as $v)
                                    <p>{{ $v->name }}</p>
                                @endforeach
                            @endif
                        </td>
                    </tr>
            </table>
            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary btn-block"> Volver atrás</a>
        </div>
    </div>
</div>
@stop
