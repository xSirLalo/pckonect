@extends('adminlte::page')

@section('title', 'Modificar Usuario')

@section('content_header')
    <h1>Modificar</h1>
@stop

@section('content')
<div class="col-sm-6">
    <div class="card border-warning">
        <div class="card-header bg-warning">
            <h3 class="text-white">Modificar usuario</h3>
            <p class="text-white">Modificar los campos correspondientes.</p>
        </div>
        <div class="card-body text-warning">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @method('PUT')
                @include('admin.users._form', ['btnColor' => "warning"])
            </form>
        </div>
    </div>
</div>
@stop
