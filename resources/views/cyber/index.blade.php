@extends('layouts.app')
<style>
    .contenedor {
        position: relative;
        display: inline-block;
        text-align: center;
    }

    .centrado {
        position: absolute;
        top: 42%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>
@section('content')

<div class="container">
    <div class="jumbotron jumbotron-fluid">
        {{-- <a href="{{ config('app.perl_url')}}?pc=1&acc=1">link text</a> --}}
        {{-- <a href="{{ config('app.perl_url')}}?pc=1&acc=0">link text</a> --}}
        <div class="container text-center">
            @forelse ($computers as $computer)
                <div class="contenedor">
                    <img src="{{ asset('img/pc.png') }}" alt="{{ $computer->number }}"  width="128" height="128" class="mx-5">
                    <div class="centrado">
                        <h1 class="display-4 @if ($computer->control == 0) text-primary @else text-danger @endif">
                            @if ($computer->control == 0)
                                @if ($checkstatus)
                                    {{-- No puedes seleccionanar ninguna libre. --}}
                                    {{ $computer->number }}
                                @else
                                    {{-- Puedes seleccionar cualquiera que este libre. --}}
                                    <a href="{{ route('cyber.select', $computer->id) }}" style="text-decoration: none">{{ $computer->number }}</a>
                                @endif
                            @else
                                @if ($checkstatus)
                                    @if ($checkstatus->computer_id == $computer->id)
                                        {{-- Solo puedes seleccionar la que estas ocupando. --}}
                                        <a href="{{ route('cyber.select', $computer->id) }}" style="text-decoration: none">
                                            <div class="text-success">
                                                {{ $computer->number }}
                                            </div>
                                        </a>
                                    @else
                                        {{ $computer->number }}
                                        {{-- Està siendo ocupada por otro usuario. --}}
                                    @endif
                                @else
                                    {{ $computer->number }}
                                    {{-- Ocupado. --}}
                                @endif
                            @endif
                        </h1>
                    </div>
                </div>
            @empty
                <p>No hay computadoras agregadas...</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
