@extends('adminlte::page')

@section('title', 'Editar Producto')

@section('content_header')
@stop

@section('content')
<div class="contenido">

 <div class="card"> 
    <section class="get-in-touch">
        <h1 class="title">Editar producto</h1>
        <form action="/productos" method="POST" class="contact-form row" novalidate>
            @csrf

           

                <div class="form-field col-lg-4 ">
                    <label for="" class="form-label">Nombre Producto: </label>
                     <input type="text" id="NombreProducto" name="NombreProducto" class="form-control" tabindex="1" value="{{$productos->NombreProducto}}">
    
                    @error('NombreProducto')
                    <span class="invalid-feedback">
                        <strong class="message">{{$message}}</strong>
                    </span>
                    @enderror
                </div>


    
            
                <div class="form-field col-lg-4 ">
                    <label for="" class="form-label">Descripcion del producto: </label>
        <input type="text" id="Descripcion" name="Descripcion" class="form-control" tabindex="2" value="{{$productos->DescripcionProducto}}">
                
                    @error('DescripcionProducto')
                    <span class="invalid-feedback">
                        <strong class="message">{{$message}}</strong>
                    </span>
                    @enderror
                </div>
                    
                <div class="form-field col-lg-4 ">
                    <label for="" class="form-label">Precio: </label>
                    <input type="integer" id="PrecioP" name="PrecioP" class="form-control" tabindex="3" value="{{$productos->PrecioP}}">
    
                    @error('PrecioP')
                    <span class="invalid-feedback">
                        <strong class="message">{{$message}}</strong> 
                    </span>
                    @enderror
                </div>

    
                <div class="form-field col-lg-4">
                    <select id="id_insumos" class="input-text js-input" type="text"  required autocomplete="off" name="id_insumos"
                    class="input-text js-input @error('id_insumos' )is-invalid @enderror">
                    <option value="" id="id_insumos"> Seleccione un insumo</option>
                    @foreach ($insumos as $insu)
                    <option value="{{$insu->id}}">{{$insu->Nombre_Insumo}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-field col-lg-4">
                    <label for="" class="input-text js-input">Cantidad: </label>
                    <input type="number" id="Cantidad" name="Cantidad" class="form-control @error ('Cantidad') is-invalid @enderror" value="">

                </div>

                <div class="row">
                   
                    <div class="col-md-6"> 
                        <label for="" class="form-label">Imagen: </label>
                        <img src="{{Storage::url($productos->Imagen)}}" alt="" width="100">
                    </div>

                    
                    <div class="col-md-6">
                        <input type="file" id="Imagen" name="Imagen" class="form-control" tabindex="4" >
                    </div>
                </div>
        
                <div class="form-field col-lg-12">
                    {{-- <a href="/ventas" class="submit-btn2">Cancelar</a> --}}
                    <button type="button" id="agregar" name="agregar" class="submit-btn">Agregar</button>
                   </div>
        
                <div class="">
                    <div class="table-responsive col-md-12">
                        <table id="detalles" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Eliminar</th>
                                    <th>Insumo</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                        </table>
        
                    </div>
        
                </div>
                
    
            <div class="form-field col-lg-12">
                <button type="submit" id="guardar" name="guardar" class="submit-btn">Guardar</button>
                <a href="/productos" class="submit-btn2">Cancelar</a>
            </div>
        </form>
    </section>    
 </div>
 </div>

    
    @section('css')
    <link rel="stylesheet" href="{{asset('vendor/adminlte/dist/css/form.css')}}">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    @endsection
    
    @section('js')
 

    <script>
        $(document).ready(function(){
            $('#agregar').click(function(){
                agregar();
            });
        });
    
        var productos_insumos = {}; // Objeto para almacenar los insumos por producto
    
        var cont = 1;
        total = 0;
        $("#guardar").hide();
    
        // Función para agregar insumos a la lista de un producto
        function agregar(){
            id_insumos = $("#id_insumos").val();
            insumos = $("#id_insumos option:selected").text();
            cantidad = $("#Cantidad").val();
    
            if(id_insumos != "" && parseInt(cantidad) != "" && parseInt(cantidad) > 0){
                // Verificar si el insumo ya ha sido agregado al producto
                if (productos_insumos.hasOwnProperty(id_insumos)) {
                    // Actualizar la cantidad del insumo existente
                    productos_insumos[id_insumos].cantidad += parseInt(cantidad);
                    var filaExistente = productos_insumos[id_insumos].fila;
                    filaExistente.find("input[name='Cantidad[]']").val(productos_insumos[id_insumos].cantidad);
                } else {
                    // Agregar el nuevo insumo al objeto de productos_insumos
                    var fila = '<tr class="selected" id="fila' + cont + '"><td><button type="button" class="btn btn-danger btn-sm btn-remove" onclick="eliminar(' + cont + ');">X</button></td><td><input type="hidden" name="id_insumos[]" value="' + id_insumos + '">' + insumos + '</td><td><input type="number" name="Cantidad[]" value="' + cantidad + '"></td></tr>';
                    var nuevaFila = $(fila);
                    productos_insumos[id_insumos] = {
                        fila: nuevaFila,
                        cantidad: parseInt(cantidad)
                    };
                    $('#detalles').append(nuevaFila);
                    cont++;
                }
    
                limpiar();
                evaluar();
            } else {
                alert("Error al ingresar el detalle del insumo, revise los datos.");
            }
        }
    
        function limpiar(){
            $("#Cantidad").val("");
            $("#id_insumos").val("");
        }
    
        function evaluar(){
            if(cont > 0){
                $("#guardar").show();
            } else {
                $("#guardar").hide();
            }
        }
    
        // Función para eliminar insumos de la lista de un producto
        function eliminar(index){
            var fila = $("#fila" + index);
            var id_insumos = fila.find("input[name='id_insumos[]']").val();
            fila.remove();
    
            delete productos_insumos[id_insumos];
    
            evaluar();
        }
    </script> 


    {{-- @endsection
@endsection