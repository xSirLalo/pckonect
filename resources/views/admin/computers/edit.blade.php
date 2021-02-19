@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Modificar</h1>
@stop

@section('content')
    <div class="card border-warning">
        <div class="card-header bg-warning">
            <h3 class="text-white">Modificar computadora</h3>
            <p class="text-white">Modificar los campos correspondientes.</p>
        </div>
        <div class="card-body text-warning">
            <form action="{{ route('admin.computers.update', $computer->id) }}" method="POST">
                @method('PUT')
                @include('admin.computers._form', ['btnColor' => "warning"])
            </form>
        </div>
    </div>
@stop
