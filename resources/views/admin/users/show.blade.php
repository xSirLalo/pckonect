@extends('adminlte::page')

@section('title', 'Detalle Usuario')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="col-sm-6">
    <div class="card">
        <div class="card-header">
            <h3>Detalle de Usuario</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered" width="100%">
                    <tr>
                        <th width="50%" scope="row" class="text-right">Nombre:</th>
                        <td>{{ $user->name }}</td>
                    </tr>

                    <tr>
                        <th width="50%" scope="row" class="text-right">Apellido:</th>
                        <td>{{ $user->last_name }}</td>
                    </tr>

                    <tr>
                        <th width="50%" scope="row" class="text-right">Correo Electronico:</th>
                        <td>{{ $user->email }}</td>
                    </tr>

                    <tr>
                        <th width="50%" scope="row" class="text-right">Cuenta creata:</th>
                        <td>{{ $user->created_at->diffForHumans() }}</td>
                    </tr>

                    <tr>
                        <th width="50%" scope="row" class="text-right">Rol:</th>
                        <td>
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                    <label class="badge badge-success">{{ $v }}</label>
                                @endforeach
                            @endif
                        </td>
                    </tr>
            </table>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-block"> Volver atrás</a>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
