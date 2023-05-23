@extends('adminlte::page')

@section('title', 'Detalle Proveedor')

@section('content_header')
    <h1>Detalle Proveedor</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header card-header-primary bg-primary">
                <p class="card-category">Vista detallada del perfil del proveedor {{ $proveedor->Nombre }}</p>
            </div>
            <!--body-->
            <div class="card-body">
                @if (session('success'))
                <div class="alert alert-success" role="success">
                {{ session('success') }}
                </div>
                @endif
                <div class="row">
                <div class="col-md-4">
                    <div class="card card-user">
                    <div class="card-body">
                        <p class="card-text">
                        <div class="author">
                            <a href="#">
                            <img width="80" height="80" src="{{ asset('vendor/adminlte/dist/img/user.png') }}" alt="image" class="avatar">
                            <h5 class="title mt-3">{{ $proveedor->Nombre }}</h5>
                            </a>
                            <p class="description">
                            <b> Nombre: </b>{{ $proveedor->Nombre }} <br>
                            <b> Asesor: </b>{{ $proveedor->asesor }} <br>
                            <b> Correo: </b>{{ $proveedor->Correo }} <br>
                            <b> Direccion: </b>{{ $proveedor->Direccion }} <br>
                            <b> Telefono: </b>{{ $proveedor->Telefono }} <br>
                            </p>
                        </div>
                        </p>
                        <div class="card-description">
                        El detalle del proveedor 
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="button-container">
                        <a  href="{{ route('proveedores.edit', $proveedor) }}" class="btn btn-sm btn-primary">Editar</a>
                        <a href="/proveedores" class="btn btn-success btn-sm" tabindex="5">Volver</a>
                        
                    </div>
                    </div>
                    </div>
                </div>
                </div>
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