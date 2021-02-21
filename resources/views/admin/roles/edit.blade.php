@extends('adminlte::page')

@section('title', 'Modificar Rol')

@section('content_header')
    <h1>Modificar</h1>
@stop

@section('content')
<div class="col-sm-6">
    <div class="card border-warning">
        <div class="card-header bg-warning">
            <h3 class="text-white">Modificar rol</h3>
            <p class="text-white">Modificar los campos correspondientes.</p>
        </div>
        <div class="card-body text-warning">
            <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                @method('PUT')
                @include('admin.roles._form', ['btnColor' => "warning"])
            </form>
        </div>
    </div>
</div>
@stop
