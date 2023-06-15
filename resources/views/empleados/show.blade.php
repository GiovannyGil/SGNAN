@extends('adminlte::page')

@section('title', 'Detalle Empleado')

@section('content_header')
    <h1>Detalle del empleado</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header card-header-primary bg-primary">
                <p class="card-category">Vista detallada del empleado {{ $empleado->Nombre }}</p>
            </div>
            <!--body-->
            <div class="card-body">
                @if (session('success'))
                <div class="alert alert-success" role="success">
                {{ session('success') }}
                </div>
                @endif

                <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                <div class="col-md-4">
                <img width="200" height="350" src="/imagen/{{$empleado->imagen}}" alt="Empleado" class="avatar" style="border-radius:1%">
                </div>
                <div class="col-md-8">
                <div class="card-body">
                <h4 class="title mt-4 ">{{ $empleado->Nombre }}</h4>
                    <p class="card-text">
                            <b> Apellido: </b>{{ $empleado->Apellidos }} <br>
                            <b> Email: </b>{{ $empleado->Email }} <br>
                            <b> Documento: </b>{{ $empleado->Documento }} <br>
                            <b> Género: </b>{{ $empleado->Genero }} <br>
                            <b> Fecha Nacimiento: </b>{{ $empleado->Fecha_Nacimiento }} <br>
                            <b> Celular: </b>{{ $empleado->Celular }} <br>
                            <b> Tipo empleado: </b>{{$empleado->tipoempleados->descripcion}}<br>
                            <b> Fecha de Ingreso: </b>{{ $empleado->created_at }} <br>
                            <b> Estado: </b>{{ $empleado->status }} <br>
                            <b> Observación: </b>{{ $empleado->Observaciones }} <br>

                        </p>
                        <div class="card-description">
                        Empleado del restaurante comidas rapidas "Delicias Nan" con toda su informacion detalladamente...
                        </div>
                        <div class="card-footer">
                        <div class="button-container">
                        <a  href="{{ route('empleados.edit', $empleado) }}" class="btn btn-sm btn-primary" title="Editar Información">Editar</a>
                        <a href="/empleados" class="btn btn-secondary btn-sm" tabindex="5" title="Volver atras">Volver</a>
                        
                    </div>
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