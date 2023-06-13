

@extends('adminlte::page')

@section('content')
<div class="card">
    <section class="get-in-touch">

    <h1 class="title">Añadir Insumo</h1>
   <form action="/insumos" method="POST" class="contact-form row" novalidate>
        @csrf

   
      <div class="form-field col-lg-4">
            <label for="" class="" >Nombre del Insumo:<FONT COLOR="red"> *</FONT> </label>
            <input type="text" id="Nombre_Insumo" name="Nombre_Insumo" title="Seleccion Insumo" class="input-text js-input"  tabindex="1" value="{{ old('Nombre_Insumo') }}" >
            
            @if ($errors->has('Nombre_Insumo'))
                    <span class="error text-danger" for="input-Nombre_Insumo">{{$errors->first('Nombre_Insumo') }}</span>
                @endif
                
      </div>
      <div class="form-field col-lg-4">
            <label for="" class="">Precio:<FONT COLOR="red"> *</FONT></label>  
            <input type="number" id="Precio" name="Precio"  class="input-text js-input"  tabindex="2" value="{{ old('Precio') }}" >
            
          @if ($errors->has('Precio'))
                    <span class="error text-danger" for="input-Precio">{{$errors->first('Precio') }}</span>
                @endif
      </div>
      <div class="form-field col-lg-4">
         
            <label for="" class="">Precio unitario:<FONT COLOR="red"> *</FONT></label>
            <input type="number" id="precio" name="precio"  class="input-text js-input"  tabindex="3" value="{{ old('precio') }}" >
              
          @if ($errors->has('precio'))
                    <span class="error text-danger" for="input-precio">{{$errors->first('precio') }}</span>
                @endif
      </div>
      <div class="form-field col-lg-4">
         <label for=""class="">Cantidad:<FONT COLOR="red"> *</FONT></label> 
        <input type="number" id="cantidad" name="cantidad"  class="input-text js-input"  tabindex="4" value="{{ old('cantidad') }}" >
        
           @if ($errors->has('cantidad'))
                    <span class="error text-danger" for="input-cantidad">{{$errors->first('cantidad') }}</span>
                @endif
      </div>
      <div class="form-field col-lg-4">
         <label for=""class="">Stock mínimo:<FONT COLOR="red"> *</FONT></label> 
        <input type="number" id="Stock" name="Stock"  class="input-text js-input"  tabindex="5" value="{{ old('Stock') }}" >
        
           @if ($errors->has('Stock'))
                    <span class="error text-danger" for="input-Stock">{{$errors->first('Stock') }}</span>
                @endif
      </div>
       <div class="form-field col-lg-4">
       <label for="categoria" class="" tabindex="4">Tipo Categoría:<FONT COLOR="red"> *</FONT></label>
            <select  class="input-text js-input"  name="id_categorias" >
                <option value="">Categorías</option>
                    @foreach($categorias as $Tcategoria)
                        <option value="{{$Tcategoria->id}}">{{$Tcategoria->Nombre}}</option>
                    @endforeach
            </select>
        </div>
        <div class="form-field col-lg-12">
            <a href="/insumos" class="submit-btn2">Cancelar</a>
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

