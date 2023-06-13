@extends('adminlte::page')

@section('title', 'Editar Categoria')

@section('content_header')
    
@stop
@section('content') 
<div class="card">
    <section class="get-in-touch">

   <h1 class="title">Editar Categoria</h1>
   <form action="/categorias/{{$categoria->id}}" method="POST" class="contact-form row" novalidate>
        @csrf
    @method('PUT')
      <div class="form-field col-lg-12">

        <label for="" class=" is-required">Nombre:<FONT COLOR="red"> *</FONT></label>
      <input type="text" id="Nombre" name="Nombre" class="input-text js-input tabindex=6" tabindex="5" tabindex="1" value="{{$categoria->Nombre}}">

        <label for="" class=" is-required">Nombre:*</label>
      <input type="text" id="Nombre" name="Nombre" class="input-text js-input tabindex=6" tabindex="5" tabindex="1" value="{{$categoria->Nombre}}">
      

            @if ($errors->has('Nombre'))
                    <span class="error text-danger" for="input-Nombre">{{$errors->first('Nombre') }}</span>
                @endif
      </div>
      <div class="form-field col-lg-12">
            <a href="/categorias" class="submit-btn2">Cancelar</a>
              {{--<input class="submit-btn" type="submit" value="Guardar"> --}}
            <button class="submit-btn">Guardar</button>
           </div>

           </form>
     </section>
</div>
@endsection

@section('css')
        <link rel="stylesheet" href="{{asset('vendor/adminlte/dist/css/form.css')}}">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
@endsection

@section('js')
    <script> console.log('Hi!'); </script>

@stop