@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
    <h1>Categorias</h1>
@stop

@section('content')
@include('layouts.partials.flash-message')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <a href="{{ route('admin.categories.create') }}" class="btn btn-secondary btn-sm float-right">Agregar categoria</a>
            </div>
        </div>
        <p class="cart-text">Debajo esta la lista de categoria.</p>
        <hr class="my-4">
        <table class="table table-striped table-bordered nowrap" id="categorias">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Slug</th>
                    <th width="280px">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-info">Ver</a>
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning">Modificar</a>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{ $category->id }}">Eliminar</button>
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
        <div class="float-right" id="lv-links">
            {{ $categories->links() }}
        </div>
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
                <form id="formDelete" action="{{ route('admin.categories.destroy', 0) }}" data-action="{{ route('admin.categories.destroy', 0) }}" method="POST">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css">
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#categorias').DataTable({
                order: [ 0, 'desc' ],
                // responsive: true,
                scrollX: true,
                autoWidth: false,
                processing: true,
                serverSide: true,
                ajax: '{{ route("admin.categories.index") }}',
                initComplete: function () {
                    $('#lv-links').hide();
                    if ($(this).find('tbody tr').length<=1) {
                        $(this).parent().show();
                    }
                },
                lengthMenu: [
                    [10, 20, 30],
                    [10, 20, 30]
                ],
                columns: [
                    {data: 'id', orderable: true, searchable: false,},
                    {data: 'name'},
                    {data: 'slug'},
                    {data: 'action', orderable: false, searchable: false },
                ],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.6/i18n/Spanish.json"
                },
            });
        });
    </script>

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

    <script>
        $(document).ready(function() {
            // show the alert
            setTimeout(function() {
                $(".alert").alert('close');
            }, 5000);
        });
    </script>

@stop
