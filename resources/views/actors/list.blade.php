@extends('layouts.master')

@section('header_title', $title)

@section('content')
    <h1>{{$title}}</h1>

    @if(empty($actors))
        <FONT COLOR="red">No se ha encontrado ninguna actor</FONT>
    @else
        <div align="center">
            <table border="1">
                <thead>
                    <tr style="background-color: #f2f2f2;">
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Alias</th>
                        <th>Fecha Nacimiento</th>
                        <th>País</th>
                        <th>Imagen</th>
                        <th>Fecha Alta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($actors as $actor)
                        <tr>
                            <td>{{ $actor->name }}</td>
                            <td>{{ $actor->surname }}</td>
                            <td>{{ $actor->alias }}</td>
                            <td>{{ $actor->birthdate }}</td> 
                            <td>{{ $actor->country }}</td>
                            <td>
                                <img src="{{ $actor->img_url }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;" alt="Actor">
                            </td>
                            <td>{{ $actor->created_at ? $actor->created_at->format('d/m/Y') : 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    
    <br>
    <a href="/">Volver a inicio</a>
@endsection