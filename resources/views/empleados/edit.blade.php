@extends('adminlte::page')


@section('title', 'Editar empleado')


@section('content')
<div class="card">
    <section class="get-in-touch">
        <Center><h2 class="title">Editar Empleado</h2></Center>
        <form action="/empleados/{{$empleado->id, }}" method="POST" enctype="multipart/form-data" class="contact-form row" novalidate>
        @csrf
        @method('PUT')
        
            <div class="form-field col-lg-4">
                <label for="Nombre">Nombre<FONT COLOR="red"> *</FONT></label>
                <input type="text" class="input-text js-input" name="Nombre" type="text" class="form-control" tabindex="1" value="{{ old('Nombre', $empleado->Nombre)}}">
                @if ($errors->has('Nombre'))
                    <span class="error text-danger" for="input-name">{{$errors->first('Nombre') }}</span>
                @endif
            </div>
            <div class="form-field col-lg-4">
                <label for="Apellidos">Apellidos<FONT COLOR="red"> *</FONT></label>
                <input type="text" class="input-text js-input" name="Apellidos" type="text" class="form-control" tabindex="2" value="{{ old('Apellidos', $empleado->Apellidos)}}">
                @if ($errors->has('Apellidos'))
                    <span class="error text-danger" for="input-Apellidos">{{$errors->first('Apellidos') }}</span>
                @endif
            </div>
            <div class="form-field col-lg-4">
                <label for="Documento">Documento<FONT COLOR="red"> *</FONT></label>
                <input type="text" class="input-text js-input" name="Documento" type="number" class="form-control" tabindex="4" value="{{ old('Documento', $empleado->Documento)}}">
                @if ($errors->has('Documento'))
                    <span class="error text-danger" for="input-Documento">{{$errors->first('Documento') }}</span>
                @endif
            </div>
            <div class="form-field col-lg-4">
                <label for="Fecha Nacimiento">Fecha Nacimiento<FONT COLOR="red"> *</FONT></label>
                <input type="date" class="input-text js-input" name="Fecha_Nacimiento" type="date" class="form-control" tabindex="5" value="{{ old('Fecha_Nacimiento', $empleado->Fecha_Nacimiento)}}">
                @if ($errors->has('Fecha_Nacimiento'))
                    <span class="error text-danger" for="input-Fecha_Nacimiento">{{$errors->first('Fecha_Nacimiento') }}</span>
                @endif
            </div>
            <div class="form-field col-lg-8">
                <label for="Email">Email<FONT COLOR="red"> *</FONT></label>
                <input type="email" class="input-text js-input" name="Email" type="email" class="form-control" tabindex="3" value="{{ old('Email', $empleado->Email)}}">
                @if ($errors->has('Email'))
                    <span class="error text-danger" for="input-Email">{{$errors->first('Email') }}</span>
                @endif
            </div>
            <div class="form-field col-lg-4">
                <label for="Celular">Celular<FONT COLOR="red"> *</FONT></label>
                <input type="text" class="input-text js-input" name="Celular" type="number" tabindex="6" value="{{ old('Celular', $empleado->Celular)}}">
                @if ($errors->has('Celular'))
                    <span class="error text-danger" for="input-Celular">{{$errors->first('Celular') }}</span>
                @endif
            </div>
            <div class="form-field col-lg-4">
                <label for="Genero" class="form-label" tabindex="7">Género<FONT COLOR="red"> *</FONT></label>
                <select class="input-text js-input" name="Genero" value="{{ old('Genero', $empleado->Genero)}}">
                    <option value="Hombre" name="Genero" >Masculino</option>
                    <option value="Mujer" name="Genero" >Femenino</option>
                    <option value="No definido" name="Genero" >Otro</option>
                </select>
                @if ($errors->has('Genero'))
                    <span class="error text-danger" for="input-Genero">{{$errors->first('Genero') }}</span>
                @endif
            </div> 
            <div class="form-field col-lg-4">
                <label for="Genero" class="form-label" tabindex="8">Tipo empleado<FONT COLOR="red"> *</FONT></label>
                <select class="input-text js-input" name="id_tipoempleados" >
                <option value="">Tipos de empleados</option>
                    @foreach($tipoempleados as $Templeado)
                        @if ($Templeado->id == $empleado->id_tipoempleados ) 
                            <option selected value="{{ $Templeado->id}}">{{ $Templeado->descripcion}}</option>
                        @else
                            <option value="{{ $Templeado->id}}">{{ $Templeado->descripcion}}</option>
                        @endif
                    @endforeach
                </select>
                @if ($errors->has('id_tipoempleados'))
                    <span class="error text-danger" for="input-id_tipoempleados">{{$errors->first('id_tipoempleados') }}</span>
                @endif
            </div>
            <div class="form-field col-lg-4">
                <label for="Observaciones">Observación</label>
                <textarea name="Observaciones" rows="3" cols="27" value="{{old('Observaciones', $empleado->Observaciones)}}" tabindex="9" class="" placeholder="{{old('Observaciones', $empleado->Observaciones)}}">{{old('Observaciones', $empleado->Observaciones)}}</textarea>
                @if ($errors->has('Observaciones'))
                    <span class="error text-danger" for="input-Observaciones">{{$errors->first('Observaciones') }}</span>
                @endif
            </div>
            <div class="form-field col-lg-4">
                <label class="form-label" class="label">Subir Imagen</label>
                <input class="input-text js-input" type="file" id="imagen" name="imagen" tabindex="10" value="{{ old('imagen', $empleado->imagen)}}">
                @if ($errors->has('imagen'))
                    <span class="error text-danger" for="input-imagen">{{$errors->first('imagen') }}</span>
                @endif
            </div>
            <div class="form-field col-lg-4">
                <img src="/imagen/{{$empleado->imagen}}" id="imagenSeleccionada" style="max-height: 130px;">
                
            </div>
            <div class="form-field col-lg-9">
            <button type="submit" class="btn btn-primary btn-sm submit-btn" tabindex="9" title="Guardar Cambios">Guardar</button>
            <a href="/empleados" class="btn btn-secondary btn-sm submit-btn2" tabindex="10" title="Volver atras">Cancelar</a>
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
