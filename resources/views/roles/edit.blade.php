@extends('adminlte::page')

@php
    use Collective\Html\FormFacade as Form;
@endphp

@section('title', 'Editar Roles')

@section('content')
<div class="card">
<section class="get-in-touch">
    <center><h2 class="title">Editar Roles</h2></center>
    <form action="{{ route('roles.update', $role->id) }}" method="POST" class="contact-form row" novalidate>
            @csrf
            @method('PUT')

            <div class="form-group">
            <label for="name">Nombre</label>
                <input type="text" id="name" class="input-text js-input" placeholder="Ingrese el nombre" name="name"  tabindex="1" value="{{ old('name', $role->name)}}">
                @if ($errors->has('name'))
                    <span class="error text-danger" for="input-name">{{$errors->first('name') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="Rol">Permisos para este rol:</label><br>
                @foreach($permission as $value)
                    {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                        {{ $value->description }}
                        <br/>
                @endforeach
                </label>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm submit-btn" tabindex="5" title="Guardar cambios">Guardar</button>
                <a href="/roles" class="btn btn-secondary btn-sm submit-btn2" tabindex="6" title="Volver atras">Cancelar</a>
            </div>
        </form>
    </section>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('vendor/adminlte/dist/css/formm.css')}}">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop