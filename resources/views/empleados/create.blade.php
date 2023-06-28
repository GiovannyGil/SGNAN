@extends('adminlte::page')


@section('content')
<div class="card">
    <section class="get-in-touch">
        <center><h2 class="title">Añadir Empleado</h2></center>
        <form action="/empleados" method="POST" enctype="multipart/form-data" class="contact-form row" novalidate>
            @csrf
            <div class="form-field col-lg-4">
            <label for="Nombre" class="">Nombre<FONT COLOR="red"> *</FONT></label>
                <input placeholder="Ingrese el nombre" type="text" class="input-text js-input" name="Nombre"  tabindex="1" value="{{ old('Nombre') }}">
                @if ($errors->has('Nombre'))
                    <span class="text-danger" for="input-Nombre">{{$errors->first('Nombre') }}</span>
                @endif
            </div>
            <div class="form-field col-lg-4">
            <label for="Apellidos" class="">Apellidos<FONT COLOR="red"> *</FONT></label>
                <input placeholder="Ingrese el apellido" type="text" class="input-text js-input" name="Apellidos" tabindex="2" value="{{ old('Apellidos') }}">
                @if ($errors->has('Apellidos'))
                    <span class="error text-danger" for="input-Apellidos">{{$errors->first('Apellidos') }}</span>
                @endif
            </div>
            <div class="form-field col-lg-4">
            <label for="Documento" class="">Documento<FONT COLOR="red"> *</FONT></label>
                <input placeholder="Ingrese el documento" type="number" class="input-text js-input" name="Documento" tabindex="3" value="{{ old('Documento') }}">
                @if ($errors->has('Documento'))
                    <span class="error text-danger" for="input-Documento">{{$errors->first('Documento') }}</span>
                @endif
            </div>
            <div class="form-field col-lg-4">
            <label for="Fecha Nacimiento" class="">Fecha Nacimiento<FONT COLOR="red"> *</FONT></label>
                <input type="date" class="input-text js-input" name="Fecha_Nacimiento" tabindex="4" value="{{ old('Fecha_Nacimiento') }}">
                @if ($errors->has('Fecha_Nacimiento'))
                    <span class="error text-danger" for="input-Fecha_Nacimiento">{{$errors->first('Fecha_Nacimiento') }}</span>
                @endif
                
            </div>
            <div class="form-field col-lg-8">
            <label for="Email" class="">Email<FONT COLOR="red"> *</FONT></label>
                <input placeholder="Ingrese el correo electronico" type="email" class="input-text js-input" name="Email" tabindex="5" value="{{ old('Email') }}">
                @if ($errors->has('Email'))
                    <span class="error text-danger" for="input-Email">{{$errors->first('Email') }}</span>
                @endif
            </div>
            <div class="form-field col-lg-4">
            <label for="Celular" class="">Celular<FONT COLOR="red"> *</FONT></label>
                <input placeholder="Ingrese el celular" type="number" class="input-text js-input" name="Celular" tabindex="6" value="{{ old('Celular') }}">
                @if ($errors->has('Celular'))
                    <span class="error text-danger" for="input-Celular">{{$errors->first('Celular') }}</span>
                @endif
            </div>
            <div class="form-field col-lg-4">
                <label for="Genero" class="" tabindex="7">Genero<FONT COLOR="red"> *</FONT></label>
                <select class="input-text js-input" name="Genero" value="{{ old('Genero') }}">
                    <option value="" >Generos</option>
                    <option value="Masculino" @if(old('Genero') == 'Masculino') selected @endif>Masculino</option>
                    <option value="Femenino" @if(old('Genero') == 'Femenino') selected @endif>Femenino</option>
                    <option value="Otro" @if(old('Genero') == 'Otro') selected @endif>Otro</option>
                </select>
                @if ($errors->has('Genero'))
                    <span class="error text-danger" for="input-Genero">{{$errors->first('Genero') }}</span>
                @endif
            </div> 
            <div class="form-field col-lg-4">
                <label for="Tipo Empleados" class="" tabindex="8">Tipo empleado<FONT COLOR="red"> *</FONT></label>
                <select class="input-text js-input" name="id_tipoempleados" >
                <option value="">Tipos de empleados</option>
                    @foreach($tipoempleados as $Templeado)
                    <option value="{{ $Templeado->id}}" @if (old('id_tipoempleados') == $Templeado->id) selected @endif>{{ $Templeado->descripcion}}</option>
                    @endforeach
                </select>
                @if ($errors->has('id_tipoempleados'))
                    <span class="error text-danger" for="input-id_tipoempleados">{{$errors->first('id_tipoempleados') }}</span>
                @endif
            </div>
            <div class="form-field col-lg-4">
            <label for="Observaciones" class="">Observaciones</label>
                <textarea name="Observaciones" rows="3" cols="27" tabindex="9" class="" placeholder="Ingrese las observaciones del empleado" >{{ old('Observaciones') }}</textarea>
                @if ($errors->has('Observaciones'))
                    <span class="error text-danger" for="input-Observaciones">{{$errors->first('Observaciones') }}</span>
                @endif
            </div>
            <div class="form-field col-lg-4">
                <label class="">Subir Imagen</label>
                <input class="input-text js-input" type="file" id="imagen" name="imagen" tabindex="10" value="{{ old('imagen') }}">
                @if ($errors->has('imagen'))
                    <span class="error text-danger" for="input-imagen">{{$errors->first('imagen') }}</span>
                @endif
            </div>
            <div class="form-field col-lg-4">
                <img id="imagenSeleccionada" style="max-height: 130px;" type="file" value="{{ old('imagen') }}">
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
    <link rel="stylesheet" href="{{asset('vendor/adminlte/dist/css/formm.css')}}">
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
