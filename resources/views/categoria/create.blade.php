@extends('adminlte::page')

@section('title', 'Añadir Categoria')

@section('content_header')
    
@stop

@section('content')
<div class="card">
    <section class="get-in-touch">

   <h1 class="title">Añadir Categoria</h1>
   <form action="/categorias" method="POST" class="contact-form row" novalidate>
        @csrf
    
      <div class="form-field col-lg-12">

        <label for="" class=" is-required">Nombre Categoria:<FONT COLOR="red"> *</FONT></label>
      <input type="text" id="Nombre" name="Nombre" class="input-text js-input" tabindex="1">

       

            @if ($errors->has('Nombre'))
                    <span class="error text-danger" for="input-Nombre">{{$errors->first('Nombre') }}</span>
                @endif
      </div>
      <div class="form-field col-lg-12">
            <a href="/categorias" class="submit-btn2" tabindex="3">Cancelar</a>
              {{--<input class="submit-btn" type="submit" value="Guardar"> --}}
            <button class="submit-btn" tabindex="2">Guardar</button>
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
<script> Console.log('Hi!'); </script>
<script>
  .is-required:after {
  content: '*';
  margin-left: 3px;
  color: red;
  font-weight: bold;
}
</script>

@stop