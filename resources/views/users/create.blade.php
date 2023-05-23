@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content')
<div class="card">
    <section class="get-in-touch">
    <center><h2 class="title">Añadir Usuario</h2></center>
        <form action="{{ route('users.store') }}" method="POST" class="contact-form row" novalidate >
            @csrf

            <div class="form-field col-lg-6">
            <input autocomplete="off" type="text" id="name"  name="name"  tabindex="1" class="input-text js-input" value="{{ old('name') }}">
                <label for="name" class="label">Nombre<FONT COLOR="red"> *</FONT></label>
                @if ($errors->has('name'))
                    <span class="error text-danger" for="input-name">{{$errors->first('name') }}</span>
                @endif
            </div> 
            
            <div class="form-field col-lg-6">
            <input autocomplete="off" type="email" id="email"  name="email" tabindex="2" class="input-text js-input" value="{{ old('email') }}">
                <label for="email" class="label">Email<FONT COLOR="red"> *</FONT></label>
                @if ($errors->has('email'))
                    <span class="error text-danger" for="input-email">{{$errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-field col-lg-6">
            <input type="password" id="password" class="input-text js-input" name="password" tabindex="3" autocomplete="new-password" >
                <label for="password" class="label">Contraseña<FONT COLOR="red"> *</FONT></label>
                @if ($errors->has('password'))
                    <span class="error text-danger" for="input-password">{{$errors->first('password') }}</span>
                @endif
            </div>
            <div class="form-field col-lg-6">
            <input type="password" id="password_confirmation" class="input-text js-input"  name="password_confirmation" tabindex="4" autocomplete="new-password"  >
                <label for="password_confirmation" class="label">Confirmar Contraseña<FONT COLOR="red"> *</FONT></label>
                @if ($errors->has('password_confirmation'))
                    <span class="error text-danger" for="input-password_confirmation">{{$errors->first('password_confirmation') }}</span>
                @endif
            </div>
                <div class="form-field col-lg-4">
                    <label for="" class="label">Roles<FONT COLOR="red"> *</FONT></label>
                        {!! Form::select('roles[]', $roles,[], array('class' => 'input-text js-input')) !!}
                </div>
            <div class="form-field col-lg-9">
                <button type="submit" class="btn btn-primary btn-sm submit-btn" tabindex="5" title="Guardar usuario">Guardar</button>
                <a href="/users" class="btn btn-secondary btn-sm submit-btn2" tabindex="6" title="Volver atras">Cancelar</a>
            </div>
        </form>
    </section>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('vendor/adminlte/dist/css/form.css')}}">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

