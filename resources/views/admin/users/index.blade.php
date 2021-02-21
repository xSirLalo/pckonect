@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm float-right">Agregar usuario</a>
            </div>
        </div>
        <p class="cart-text">Debajo esta la lista de usuarios.</p>
        <hr class="my-4">
        <table class="table table-striped table-bordered nowrap" id="usuarioss">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Incorporación</th>
                    <th>Rol</th>
                    <th width="280px">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->diffForHumans() }}</td>
                        <td>
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                    @if ($v == "Admin")
                                        <label class="badge badge-danger">{{ $v }}</label>
                                    @else
                                        <label class="badge badge-success">{{ $v }}</label>
                                    @endif
                                @endforeach
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-info">Ver</a>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Modificar</a>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{ $user->id }}">Eliminar</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No hay datos...</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
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
            $('#usuarios').DataTable({
                order: [ 1, 'desc' ],
                // responsive: true,
                scrollX: true,
                autoWidth: false,
                processing: true,
                serverSide: true,
                ajax: '{{ route("admin.users.datatable") }}',
                initComplete: function () {
                    if ($(this).find('tbody tr').length<=1) {
                        $(this).parent().show();
                    }
                },
                // lengthMenu: [
                //     [5, 10, 25],
                //     [5, 10, 25]
                // ],
                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: false,},
                    {data: 'name', name: 'name'},
                    {data: 'last_name', name: 'last_name'},
                    {data: 'email', name: 'email'},
                    // {data: 'created_at', name: 'created_at', orderable: false, searchable: false},
                    {
                        data: 'created_at', name: 'created_at', orderable: false, searchable: false,
                        render: function (data, type, patient) {
                            return `
                                <td>{{ $user->created_at->diffForHumans() }}</td>
                            `;
                        }
                    },
                    {
                        name: 'rol', orderable: false, searchable: false,
                        render: function () {
                            return `
                                @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $v)
                                        @if ($v == "Admin")
                                            <label class="badge badge-danger">{{ $v }}</label>
                                        @else
                                            <label class="badge badge-success">{{ $v }}</label>
                                        @endif
                                    @endforeach
                                @endif
                            `;
                        }
                    },
                    {
                        data: "id", name: 'id', orderable: false, searchable: false,
                        render: function (data, type, patient) {
                            return `
                                <td>
                                    <div class="btn-group flex-wrap">
                                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-info">Ver</a>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Modificar</a>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{ $user->id }}">Eliminar</button>
                                    </div>
                                </td>
                            `;
                        }
                    }
                ],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.6/i18n/Spanish.json"
                    // "lengthMenu": "Mostrar _MENU_ registros por página",
                    // "zeroRecords": "Nada encontrado - disculpa.",
                    // "info": "Mostrando la página _PAGE_ de _PAGES_",
                    // "infoEmpty": "No hay datos...",
                    // "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    // "search": "Buscar:",
                    // "processing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> ',
                    // "paginate":{
                    //     'next': 'Siguiente',
                    //     'previous': 'Anterior',
                    // },
                },
            });
        } );
    </script>
@stop
