@extends('adminlte::page')


@section('content')
<div class="card">
    <section class="get-in-touch">
        <center><h2 class="title">Añadir Empleado</h2></center>
        <form action="/empleados" method="POST" enctype="multipart/form-data" class="contact-form row" novalidate>
            @csrf
            <div class="form-field col-lg-4">
                <input type="text" class="input-text js-input" name="Nombre"  tabindex="1" value="{{ old('Nombre') }}">
                <label for="Nombre" class="label">Nombre<FONT COLOR="red"> *</FONT></label>
                @if ($errors->has('Nombre'))
                    <span class="error text-danger" for="input-Nombre">{{$errors->first('Nombre') }}</span>
                @endif
            </div>
            <div class="form-field col-lg-4">
                <input type="text" class="input-text js-input" name="Apellidos" tabindex="2" value="{{ old('Apellidos') }}">
                <label for="Apellidos" class="label">Apellidos<FONT COLOR="red"> *</FONT></label>
                @if ($errors->has('Apellidos'))
                    <span class="error text-danger" for="input-Apellidos">{{$errors->first('Apellidos') }}</span>
                @endif
            </div>
            <div class="form-field col-lg-4">
                <input type="number" class="input-text js-input" name="Documento" tabindex="3" value="{{ old('Documento') }}">
                <label for="Documento" class="label">Documento<FONT COLOR="red"> *</FONT></label>
                @if ($errors->has('Documento'))
                    <span class="error text-danger" for="input-Documento">{{$errors->first('Documento') }}</span>
                @endif
            </div>
            <div class="form-field col-lg-4">
                <input type="date" class="input-text js-input" name="Fecha_Nacimiento" tabindex="4" value="{{ old('Fecha_Nacimiento') }}">
                <label for="Fecha Nacimiento" class="label">Fecha Nacimiento<FONT COLOR="red"> *</FONT></label>
                @if ($errors->has('Fecha_Nacimiento'))
                    <span class="error text-danger" for="input-Fecha_Nacimiento">{{$errors->first('Fecha_Nacimiento') }}</span>
                @endif
                
            </div>
            <div class="form-field col-lg-8">
                <input type="email" class="input-text js-input" name="Email" tabindex="5" value="{{ old('Email') }}">
                <label for="Email" class="label">Email<FONT COLOR="red"> *</FONT></label>
                @if ($errors->has('Email'))
                    <span class="error text-danger" for="input-Email">{{$errors->first('Email') }}</span>
                @endif
            </div>
            <div class="form-field col-lg-6">
                <input type="number" class="input-text js-input" name="Celular" tabindex="6" value="{{ old('Celular') }}">
                <label for="Celular" class="label">Celular<FONT COLOR="red"> *</FONT></label>
                @if ($errors->has('Celular'))
                    <span class="error text-danger" for="input-Celular">{{$errors->first('Celular') }}</span>
                @endif
            </div>
            <div class="form-field col-lg-6">
                <label for="Genero" class="label" tabindex="7">Genero<FONT COLOR="red"> *</FONT></label>
                <select class="input-text js-input" name="Genero" value="{{ old('Genero') }}">
                    <option value="">Generos</option>
                    <option value="Hombre" >Masculino</option>
                    <option value="Mujer" >Femenino</option>
                    <option value="No definido">Otro</option>
                </select>
                @if ($errors->has('Genero'))
                    <span class="error text-danger" for="input-Genero">{{$errors->first('Genero') }}</span>
                @endif
            </div> 
            <div class="form-field col-lg-6">
                <label for="Tipo Empleados" class="label" tabindex="8">Tipo empleado<FONT COLOR="red"> *</FONT></label>
                <select class="input-text js-input" name="id_tipoempleados" >
                <option value="">Tipos de empleados</option>
                    @foreach($tipoempleados as $Templeado)
                    <option value="{{ $Templeado->id}}">{{ $Templeado->descripcion}}</option>
                    @endforeach
                </select>
                @if ($errors->has('id_tipoempleados'))
                    <span class="error text-danger" for="input-id_tipoempleados">{{$errors->first('id_tipoempleados') }}</span>
                @endif
            </div>
            <div class="form-field col-lg-6">
                <input type="text" class="input-text js-input" name="Observaciones" tabindex="9" value="{{ old('Observaciones') }}">
                <label for="Observaciones" class="label">Observaciones</label>
                @if ($errors->has('Observaciones'))
                    <span class="error text-danger" for="input-Observaciones">{{$errors->first('Observaciones') }}</span>
                @endif
            </div>
            <div class="form-field col-lg-6">
                <label class="">Subir Imagen<FONT COLOR="red"> *</FONT></label>
                <input class="input-text js-input" type="file" id="imagen" name="imagen" tabindex="10" value="{{ old('imagen') }}">
                @if ($errors->has('imagen'))
                    <span class="error text-danger" for="input-imagen">{{$errors->first('imagen') }}</span>
                @endif
            </div>
            <div class="form-field col-lg-6">
                <img id="imagenSeleccionada" style="max-height: 200px;">
            </div>
            <div class="form-field col-lg-9">
                <button type="submit" class="btn btn-primary btn-sm submit-btn" tabindex="11" title="Guardar empleado">Guardar</button>
                <a href="/empleados" class="btn btn-secondary btn-sm submit-btn2" tabindex="12" title="Volver atras">Cancelar</a>
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function (e) {
            $('#imagen').change(function(){
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#imagenSeleccionada').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@stop
