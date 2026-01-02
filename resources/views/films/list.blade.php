@extends('layouts.master')

@section('header_title', $title)

@section('content')
    <h1>{{$title}}</h1>

    @if(empty($films))
        <FONT COLOR="red">No se ha encontrado ninguna película</FONT>
    @else
        <div align="center">
            <table border="1">
                <tr>
                    @foreach($films as $film)
                        @foreach(array_keys($film) as $key)
                            <th>{{$key}}</th>
                        @endforeach
                        @break
                    @endforeach
                </tr>

                @foreach($films as $film)
                    <tr>
                        <td>{{$film['name']}}</td>
                        <td>{{$film['year']}}</td>
                        <td>{{$film['genre']}}</td>
                        <td>{{$film['duration']}}</td>
                        <td>{{$film['country']}}</td>
                        {{-- Mantenemos tu lógica de imagen pero con el arreglo de la variable --}}
                        <td><img src="{{$film['img_url'] ?? $film['imagen_url']}}" style="width: 100px; height: 120px;" /></td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endif
    
    <br>
    <a href="/">Volver a inicio</a>
@endsection