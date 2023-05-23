@extends('adminlte::page')

@section('title', 'DetalleU')

@section('content_header')
    <h1>Detalle del usuario</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header card-header-primary bg-primary">
                <p class="card-category">Vista detallada del usuario {{ $user->name }}</p>
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
                            <h5 class="title mt-3">{{ $user->name }}</h5>
                            </a>
                            <p class="description">
                            {{ $user->email }} <br>
                            {{ $user->created_at }}
                            </p>
                        </div>
                        </p>
                        <div class="card-description">
                        Usuario del restaurante comidas rapidas "Delicias Nan" con toda su informacion detalladamente...
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="button-container">
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-primary" title="Editar información">Editar</a>
                        <a href="/users" class="btn btn-secondary btn-sm" tabindex="5" title="Volver atras">Volver</a>
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