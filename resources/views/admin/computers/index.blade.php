@extends('adminlte::page')

@section('title', 'Computadoras')

@section('content_header')
    <h1>Computadoras</h1>
@stop

@section('content')
@include('layouts.partials.flash-message')
<div class="card">
    <div class="card-body">
        <p class="cart-text">Debajo esta la lista de computadoras.</p>
        <div class="row">
            <div class="col">
                <a href="{{ route('admin.computers.create') }}" class="btn btn-primary">Agregar computadora</a>
            </div>
        </div>
        <hr class="my-4">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Procesador</th>
                    <th>RAM</th>
                    <th>Almacenamiento</th>
                    <th>Dirección IP</th>
                    <th>Número PC</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($computers as $computer)
                    <tr>
                        <td>{{ $computer->id }}</td>
                        <td>{{ $computer->processor }}</td>
                        <td>{{ $computer->ram }}</td>
                        <td>{{ $computer->storage }}</td>
                        <td>{{ $computer->ip_address }}</td>
                        <td>{{ $computer->number }}</td>
                        <td>
                            <div class="btn-group flex-wrap">
                                <a href="{{ route('admin.computers.show', $computer->id) }}" class="btn btn-info">Ver</a>
                                <a href="{{ route('admin.computers.edit', $computer->id) }}" class="btn btn-warning">Modificar</a>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{ $computer->id }}">Eliminar</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="text-center">
                        <td colspan="7">No hay datos...</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $computers->links() }}
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Esta apunto de realizar una accion irreversible hasta para el administrador.</p>
                <p>¿Desea continuar?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <form id="formDelete" action="{{ route('admin.computers.destroy', 0) }}" data-action="{{ route('admin.computers.destroy', 0) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
    window.onload = function() {
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('id') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            action = $('#formDelete').attr('data-action').slice(0, -1)
            action += recipient

            console.log(action)

            $('#formDelete').attr('action', action)

            var modal = $(this)
            modal.find('.modal-title').text('Eliminar')
        })
    }
    </script>
@stop
