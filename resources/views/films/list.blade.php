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
                        @foreach(array_keys(is_array($film) ? $film : $film->toArray()) as $key)
                            @if($key !== 'id')
                                <th>{{$key}}</th>
                            @endif
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
                        <td><img src="{{ $film['img_url'] }}" style="width: 100px; height: 120px;" alt="Poster"></td>
                        <td>{{$film['created_at']}}</td>
                        <td>{{$film['updated_at']}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endif
    
    <br>
    <a href="/">Volver a inicio</a>
@endsection