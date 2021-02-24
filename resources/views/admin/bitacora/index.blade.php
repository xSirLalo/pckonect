@extends('adminlte::page')

@section('title', 'Bitacora')

@section('content_header')
    <h1>Bitacora</h1>
@stop

@section('content')
@include('layouts.partials.flash-message')
<div class="card">
    <div class="card-body">
        <p class="cart-text">Debajo esta la lista de entradas y salidas.</p>
        <div class="row">
            <div class="col">
                {{-- <a href="{{ route('admin.computers.create') }}" class="btn btn-primary">Agregar computadora</a> --}}
            </div>
        </div>
        <hr class="my-4">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Usuario</th>
                    <th>PC</th>
                    <th>Estatus</th>
                    <th>Inicio</th>
                    <th>Tiempo real</th>
                    <th>Termino</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cybercontrols as $cybercontrol)
                    <tr>
                        <td>{{ $cybercontrol->user->name .' '.  $cybercontrol->user->last_name }}</td>
                        <td>{{ $cybercontrol->computer->number }}</td>
                        <td>{{ $cybercontrol->status }}</td>
                        <td>{{ $cybercontrol->created_at }}</td>
                        <td id="realtime-{{ $cybercontrol->id }}">Cargando...</td>
                            <script>
                                // MySQL DATETIME
                                const dateTime{!!$cybercontrol->id!!} = '{!!$cybercontrol->created_at!!}';
                                // regular expression split that creates array with: year, month, day, hour, minutes, seconds values
                                let dateTime{!!$cybercontrol->id!!}Parts = dateTime{!!$cybercontrol->id!!}.split(/[- :]/);
                                // monthIndex begins with 0 for January and ends with 11 for December so we need to decrement by one
                                dateTime{!!$cybercontrol->id!!}Parts[1]--;
                                // var countDownDate = new Date("2021-02-22 00:33:44").getTime();
                                const countDownDate{!!$cybercontrol->id!!} = new Date(...dateTime{!!$cybercontrol->id!!}Parts); // our Date object

                                var x = setInterval(function() {
                                const status = 2;

                                var now = new Date().getTime();
                                var distance = now - countDownDate{!!$cybercontrol->id!!};

                                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                if (days<=9)
                                    days="0"+days
                                if (hours<=9)
                                    hours="0"+hours
                                if (minutes<=9)
                                    minutes="0"+minutes
                                if (seconds<=9)
                                    seconds="0"+seconds
                                document.getElementById("realtime-{!!$cybercontrol->id!!}").innerHTML ='<div class="text-info">' + days + "d " + hours + "h "  + minutes + "m " + seconds + "s" + '</div>';
                                if (status == {!!$cybercontrol->status!!}) {
                                    clearInterval(x + 1);
                                    document.getElementById("realtime-{!!$cybercontrol->id!!}").innerHTML = '<div class="text-success">' + "Finalizado" + '</div>';
                                }
                                }, 1000);
                            </script>
                        <td>{{ $cybercontrol->updated_at }}</td>
                        <td>
                            {{-- <div class="btn-group flex-wrap">
                                <a href="{{ route('admin.computers.show', $computer->id) }}" class="btn btn-info">Ver</a>
                                <a href="{{ route('admin.computers.edit', $computer->id) }}" class="btn btn-warning">Modificar</a>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{ $computer->id }}">Eliminar</button>
                            </div> --}}
                        </td>
                    </tr>
                @empty
                    <tr class="text-center">
                        <td colspan="7">No hay datos...</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $cybercontrols->links() }}
    </div>
</div>

@stop

@section('css')
@stop

@section('js')
@stop
