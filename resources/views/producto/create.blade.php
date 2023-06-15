@extends('adminlte::page')

@section('title', 'Añadir Producto')

@section('content_header')
@stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <form action="/productos" method="POST" class="contact-form row" novalidate  enctype="multipart/form-data">
            @csrf
            
            <div class="col-md-6">
                <div class="card" title="Productos">
                    <div class="get-in-touch">
                        <h1 class="title">Productos</h1>
                        <div class="table-responsive scrollable-table">
                        <div class="form-field col-md-12 ">
                            <label for="" class="input-text js-input" required >Nombre Producto:<FONT COLOR="red"> *</FONT>  </label>
                            <input type="text" id="NombreProducto" name="NombreProducto" class="input-text js-input" @error ('NombreProducto') is-invalid @enderror value="{{ old('productos') }}"tabindex="1"  placeholder="Ingrese nombre">
            
                            @error('NombreProducto')
                            <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                        </div>

                        <div class="form-field col-md-12">
                            <label for="" class="input-text js-input">Descripción:</label>
                            <input  class="input-text js-input" type="text" id="DescripcionProducto" name="DescripcionProducto" class="form-control @error ('DescripcionProducto') is-invalid @enderror" value="{{ old('DescripcionProducto') }}"    tabindex="2" placeholder="Ingrese Descripcion" >
                        
                            @error('DescripcionProducto')
                            <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                        </div>

                        <div class="form-field col-md-12 ">
                            <label for="" class="input-text js-input" required>Precio:<FONT COLOR="red"> *</FONT> </label>
                            <input  class="input-text js-input" type="number" id="PrecioP" name="PrecioP" class="form-control @error ('PrecioP') is-invalid @enderror" value="{{ old('PrecioP') }}"    tabindex="2" placeholder="Ingrese precio" >
                        
                            @error('PrecioP')
                            <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
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

        
                        <div class="form-field col-md-12">
                            <label class="input-text js-input" for="id_insumos">Insumos<FONT COLOR="red"> *</FONT></label>
                            <select id="id_insumos" class="input-text js-input" type="text"  required autocomplete="off" name="id_insumos"
                            class="input-text js-input @error('id_insumos' )is-invalid @enderror">
                            <option  value="" id="id_insumos"> Seleccione un insumo</option>
                            @foreach ($insumos as $insu)
                            <option value="{{$insu->id}}">{{$insu->Nombre_Insumo}}</option>
                                @endforeach
                            </select>
                        
                        </div>

                        <div class="form-field col-md-12 ">
                            <label for="" class="input-text js-input">Cantidad:<FONT COLOR="red"> *</FONT> </label>
                            <input  class="input-text js-input" type="number" id="Cantidad" name="Cantidad" tabindex="2" placeholder="Ingrese Cantidad" >
                        </div>
                        </div>

                        <div class="form-field col-lg-12">
                            <button type="button" id="agregar" title="Agrega insumo" name="agregar" class="btn btn-primary">Agregar</button>
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="col-md-6">
                <div class="card" title="Productos">
                    <div class="get-in-touch">
                        <div class="" title="Tabla de productos">
                            <h4 class="card-title">Detalles del producto</h4>
                            <div class="table-responsive ">
                                <form action="/productos" method="POST" class="contact-form row" novalidate>
                                    @csrf
                                    <div class="table-responsive scrollable-table">
                                    <table class="table" id="detalles">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Eliminar</th>
                                                <th>Insumo</th>
                                                <th>Cantidad</th>
                                            </tr>
                                        </thead>
                                     </table>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <div class="form-field col-lg-12">
                    <button type="submit" id="guardar" title="Guardar el producto" name="guardar" class="btn btn-primary">Guardar</button>
                    <a href="/productos" title="Cancelar el producto" class="btn btn-warning">Cancelar</a>
                </div>
                </div>
            </div>
        </form>
        </div>
    </div>

    
    @section('css')
    <link rel="stylesheet" href="{{asset('vendor/adminlte/dist/css/form.css')}}">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <style>
        .scrollable-table{
            max-height: 300px;
            overflow-y: auto;
        }
    </style>
    @endsection
    
    @section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                Swal.fire({
                    position: 'top-center',
                    icon: 'error',
                    title: 'Error al ingresar el detalle del producto, revise los datos del producto',
                    showConfirmButton: false,
                    timer: 2000
                });
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
    

    @endsection
@endsection