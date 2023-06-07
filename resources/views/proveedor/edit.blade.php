@extends('adminlte::page')

@section('title', 'Editar Proveedor')

@section('content_header')
    
@stop

@section('content')
<div class="card">
    <section class="get-in-touch">

    <h1 class="title">Editar proveedor</h1>
    <form action="/proveedores/{{$proveedor->id}}" method="POST" class="contact-form row" novalidate>
        @csrf
    @method('PUT')
    
      <div class="form-field col-lg-4">
        <label for="" class=" is-required">Nombre:*</label>
            <input type="text" id="Nombre" name="Nombre" class="input-text js-input" tabindex="1" value="{{$proveedor->Nombre}}">
            
            @if ($errors->has('Nombre'))
                    <span class="error text-danger" for="input-Nombre">{{$errors->first('Nombre') }}</span>
                @endif
      </div>
      <div class="form-field col-lg-4">
        <label for="" class=" is-required">Nombre del asesor:*</label>
            <input type="text" id="asesor" name="asesor" class="input-text js-input" tabindex="2" value="{{$proveedor->asesor}}">
           
            @if ($errors->has('asesor'))
                    <span class="error text-danger" for="input-asesor">{{$errors->first('asesor') }}</span>
                @endif
      </div>
      <div class="form-field col-lg-4">
        <label for="" class=" is-required">Correo:*</label>
            <input type="email" id="Correo" name="Correo" class="input-text js-input" tabindex="3" value="{{$proveedor->Correo}}">
           
            @if ($errors->has('Correo'))
                    <span class="error text-danger" for="input-Correo">{{$errors->first('Correo') }}</span>
                @endif
      </div>
       <div class="form-field col-lg-4">
        <label for="" class=" is-required">Dirección:*</label>
            <input type="text" id="Direccion" name="Direccion" class="input-text js-input" tabindex="4" value="{{$proveedor->Direccion}}">
           
            @if ($errors->has('Direccion'))
                    <span class="error text-danger" for="input-Direccion">{{$errors->first('Direccion') }}</span>
                @endif
      </div>
      <div class="form-field col-lg-4">
        <label for="" class=" is-required">Teléfono:</label>
            <input type="number" id="Telefono" name="Telefono" class="input-text js-input" tabindex="5" value="{{$proveedor->Telefono}}">
           
            @if ($errors->has('Telefonó'))
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