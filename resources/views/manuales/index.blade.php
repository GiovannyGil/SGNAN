@extends('adminlte::page')

@section('title', 'Manuales')

@section('content_header')
    <h1>Manuales</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header card-header-primary bg-primary">
                <p class="card-category"></p>
            </div><br><br>
            <!--body-->
            <div class="row">
            <div class="col-sm-6">
                <div class="card">
                <div class="card-body">
                <h3 class="title mt-3">Manual de usuario</h3>
                <img width="80" height="80" src="{{ asset('vendor/adminlte/dist/img/MANUALES-DE-USUARIO.png') }}" alt="image" class="avatar">
                    <p class="card-text">Este material tendra las intrucciones de como utilizar la aplicación web y te ayudara con cualquier tipo de problema.</p>
                    <a href='vendor/adminlte/dist/PDF/Manual_de_Usuario-SGNAN-V.1-Completo.pdf' target="_blank">Enlace al archivo PDF</a>

                </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                <div class="card-body">
                <h3 class="title mt-3">Manual de instalación</h3>
                <img width="80" height="80" src="{{ asset('vendor/adminlte/dist/img/manual-de-instalacion.png') }}" alt="image" class="avatar">
                    <p class="card-text">Este material te ayudara a instalar la aplicación en tu dispositivo.</p>
                    <a href='vendor/adminlte/dist/PDF/Manual Instalacion-Completo.pdf' target="_blank">Enlace al archivo PDF</a>
                </div>
                </div>
            </div>
            </div>
                    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop