@extends('adminlte::page')

@section('content')
<div class="card">
    <section class="get-in-touch">

    <h1 class="title">Añadir proveedor</h1>
    <form action="/proveedores" method="POST" class="contact-form row" novalidate>
        @csrf
  
      <div class="form-field col-lg-4">
            <input type="text" id="Nombre" name="Nombre" class="input-text js-input"  tabindex="1" value="{{ old('Nombre') }}">
            <label for="" class="label is-required">Nombre</label>
            @if ($errors->has('Nombre'))
                    <span class="error text-danger" for="input-Nombre">{{$errors->first('Nombre') }}</span>
                @endif
      </div>
      <div class="form-field col-lg-4">
            <input type="text" id="asesor" name="asesor" class="input-text js-input"  tabindex="2" value="{{ old('asesor') }}">
            <label for="" class="label is-required">Nombre del asesor</label>
            @if ($errors->has('asesor'))
                    <span class="error text-danger" for="input-asesor">{{$errors->first('asesor') }}</span>
                @endif
      </div>
      <div class="form-field col-lg-4">
            <input type="email" id="Correo" name="Correo" class="input-text js-input"  tabindex="3" value="{{ old('Correo') }}">
            <label for="" class="label is-required">Correo</label>
            @if ($errors->has('Correo'))
                    <span class="error text-danger" for="input-Correo">{{$errors->first('Correo') }}</span>
                @endif
      </div>
       <div class="form-field col-lg-4">
            <input type="text" id="Direccion" name="Direccion" class="input-text js-input"  tabindex="4" value="{{ old('Correo') }}">
            <label for="" class="label is-required">Dirección</label>
            @if ($errors->has('Direccion'))
                    <span class="error text-danger" for="input-Direccion">{{$errors->first('Direccion') }}</span>
                @endif
      </div>
      <div class="form-field col-lg-4">
            <input type="number" id="Telefono" name="Telefono" class="input-text js-input"  tabindex="5" value="{{ old('Telefono') }}">
            <label for="" class="label is-required">Teléfono</label>   
            @if ($errors->has('Telefono'))
                    <span class="error text-danger" for="input-Telefonó">{{$errors->first('Telefonó') }}</span>
                @endif
      </div>
      <div class="form-field col-lg-12">
            <a href="/proveedores" class="submit-btn2">Cancelar</a>
              {{--<input class="submit-btn" type="submit" value="Guardar"> --}}
            <button class="submit-btn">Guardar</button>
           </div>

           </form>
     </section>
</div>
@stop
@section('css')
        <link rel="stylesheet" href="{{asset('vendor/adminlte/dist/css/form.css')}}">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
@endsection

@section('js')
    <script> console.log('Hi!'); </script>

@stop