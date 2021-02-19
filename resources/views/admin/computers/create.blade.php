@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Agregar</h1>
@stop

@section('content')
    <div class="card border-primary">
        <div class="card-header bg-primary">
            <h3 class="text-white">Agregar computadora</h3>
            <p class="text-white">Llenar los campos correspondientes.</p>
        </div>
        <div class="card-body text-primary">
            <form action="{{ route('admin.computers.store') }}" method="POST">
                @include('admin.computers._form', ['btnColor' => "primary"])
            </form>
        </div>
    </div>
@stop
