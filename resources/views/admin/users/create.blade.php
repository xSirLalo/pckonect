@extends('adminlte::page')

@section('title', 'Agregar Usuario')

@section('content_header')
    <h1>Agregar</h1>
@stop

@section('content')
    <div class="card border-primary">
        <div class="card-header bg-primary">
            <h3 class="text-white">Agregar usuario</h3>
            <p class="text-white">Llenar los campos correspondientes.</p>
        </div>
        <div class="card-body text-primary">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @include('admin.users._form', ['btnColor' => "primary"])
            </form>
        </div>
    </div>
@stop
