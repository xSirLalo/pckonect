@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        Header
    </div>
    <div class="card-body">
        <h5 class="card-title">Title</h5>
        <p class="card-text">Welcome to this beautiful admin panel.</p>
    </div>
    <div class="card-footer">
        Footer
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
