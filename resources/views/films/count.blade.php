@extends('layouts.master')

@section('header_title', 'Total de Películas')

@section('content')
    <div class="mt-4">
        <h1>Total de Películas: <span class="badge badge-primary">{{ $number }}</span></h1>
        
        <div class="mt-4">
            <a href="/" class="btn btn-secondary">
                <i class="fas fa-home"></i> Volver a inicio
            </a>
        </div>
    </div>
@endsection