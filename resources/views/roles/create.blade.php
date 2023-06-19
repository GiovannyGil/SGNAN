@extends('adminlte::page')

@section('title', 'Roles')

@section('content')
<div class="card">
    <section class="get-in-touch">
    <center><h2 class="title">Crear Nuevo Rol</h2></center>
        <form action="{{ route('roles.store') }}" method="POST" class="contact-form row" novalidate>
            @csrf
            <div class="form-field col-lg-6">
                <label for="name">Nombre<FONT COLOR="red"> *</FONT></label>
                <input autocomplete="off" type="text" id="name" class="input-text js-input" placeholder="Ingrese el nombre" name="name"  tabindex="1" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <span class="error text-danger" for="input-name">{{$errors->first('name') }}</span>
                @endif
            </div>

            <div class="form-field col-lg-6">
                <label for="Rol">Permisos para este rol:<FONT COLOR="red"> *</FONT></label><br>
                @foreach($permission as $value)
                    {{ Form::checkbox('permission[]', $value->id, null, array('class' => 'mr-1')) }}
                        {{ $value->description }}
                        <br/>
                @endforeach
                </label>
            </div>

            <div class="form-field col-lg-7">
                <button type="submit" class="btn btn-primary btn-sm submit-btn" tabindex="5" title="Guardar rol">Guardar</button>
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
