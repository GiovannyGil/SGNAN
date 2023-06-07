@extends('adminlte::page')

@section('title', 'Añadir Venta')

@section('content_header')
@stop

@section('content')
    {{-- {{$errors}} --}}

<div class="card" title="Ventas">
    <section class="get-in-touch">
        <h1 class="title">Ventas</h1>
        <form action="/ventas" method="POST" class="contact-form row" novalidate>
            @csrf
         <div class="form-field col-lg-4 " title="Elegir Empleado">
            <abel class="label" for="id_empleado">Empleado*</abel>
            <select id="id_empleado" class="input-text js-input" type="text" required autocomplete="off" name="id_empleado"
            class="input-text js-input   @error('id_empleado') is-invalid @enderror">
                <option value="{{old('id_empleado')}}"></option>
                @foreach ($empleados as $empleado)
                <option value="{{$empleado->id}}">{{$empleado->Nombre}}</option>
                @endforeach
            </select>
            
            {{-- @error('id_empleado')
              <span class="error text-danger" role="alert">
                      <strong>{{$message}}</strong>
                  </span>
              @enderror --}}
         </div>

         <div class="form-field col-lg-4 " title="Usuario">
            {{-- tomar automaticamente el user logeado en el sistema --}}
            <select id="id_user" class="input-text js-input" type="text" required autocomplete="off" name="id_user"
            class="input-text js-input   @error('id_user') is-invalid @enderror">
                {{-- <option value="{{old('id_user')}}"></option> --}}
                @foreach ($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
            <label class="label" for="id_empleado">Usuario*</label>
            {{-- @error('id_user')
              <span class="error text-danger" role="alert">
                      <strong>{{$message}}</strong>
                  </span>
              @enderror --}}
         </div>

         <div class="form-fiel col-lg-4"></div>


         <div class="form-field col-lg-4 " title="Producto a vender">
            <label class="" for="id_producto">Producto*</label>

            <select id="id_producto" class="input-text js-input" type="text" required autocomplete="off" name="id_producto"
            class="input-text js-input   @error('id_producto') is-invalid @enderror">
                <option value="" disabled selected>Selecione un Producto</option>
                <option value="{{old('id_producto')}}"></option>
                @foreach ($productos as $producto)
                <option value="{{$producto->id}}_{{$producto->Cantidad}}_{{$producto->PrecioP}}">{{$producto->NombreProducto}}</option>
                @endforeach
            </select>
            {{-- @error('id_producto')
              <span class="error text-danger" role="alert">
                      <strong>{{$message}}</strong>
                  </span>
              @enderror --}}
         </div>

         
         <div class="form-field col-lg-4 " title="Ingrese la Cantidad">
            <label class="" for="Cantidad">Cantidad*</label>

            <input id="Cantidad" type="number" required autocomplete="off" name="Cantidad"
            class="input-text js-input @error('Cantidad') is-invalid @enderror" value="{{old('Cantidad')}}">


            {{-- @error('Cantidad')
                <span class="error text-danger" role="alert">
                    <strong>{{$message}}</strong>
                </span>
            @enderror --}}
         </div>

         {{-- <div class="form-field col-lg-4 ">
            <input id="Stock" type="number" required autocomplete="off" name="Stock" disabled
            class="input-text js-input">
            <label class="label" for="">Stock Actual</label>
         </div> --}}



         <div class="form-field col-lg-4 " title="Precio del Producto">
            <label class="" for="Precio">Precio de Venta</label>
            <input id="Precio" type="number" required autocomplete="off" name="Precio" disabled
            class="input-text js-input">

            <p id="cantidaduu" name="cantidaduu"></p>

            {{-- @error('Precio')
                <span class="error text-danger" role="alert">
                    <strong>{{$message}}</strong>
                </span>
            @enderror --}}
            </div>

           <div class="form-field col-lg-12">
            {{-- <a href="/ventas" class="submit-btn2">Cancelar</a> --}}
            <button type="button" id="agregar" title="Agregar el producto a la lista de la venta" name="agregar" class="submit-btn">Agregar</button>
           </div>

        <div class="" title="Tabla de productos para la venta">
            <h4 class="card-title">Detalles De Venta</h4>
            <div class="table-responsive col-md-12">
                <table id="detalles" class="table table-striped">
                    <thead>
                        <tr>
                            <th title="Eliminar el producto de la lista">Eliminar</th>
                            <th title="Producto">Producto</th>
                            <th title="Precio del producto">Precio(PEN)</th>
                            <th title="Cantidad">Cantidad</th>
                            <th title="Subtotal">Subtotal(PEN)</th>
                        </tr>
                    </thead>
                    
                    <tfoot>
                        <tr>
                            <th colspan="4"><p aling="right" title="Valor Total">Total:</p></th>
                            <th><p aling="right"><span id="total">0.00</span></p>
                        </tr>
                        <tr>
                            <th colspan="4"><p aling="right" title="Valor Total">Total Pagar</p></th>
                            <th><p aling="right">
                                <span aling="right" id="total_pagar_html">0.00</span>
                                <input type="hidden" name="total" id="total_pagar">
                            </p>
                            </th>
                        </tr>
                    </tfoot>
                </table>

            </div>

        </div>

        
        <div class="form-field col-lg-12">
            <button type="submit" id="guardar" title="Guardar la Venta" name="guardar" class="submit-btn">Guardar</button>
            <a href="/ventas" title="Cancelar la Venta" class="submit-btn2">Cancelar</a>
        </div>
        </form>
     </section>
</div>

    @section('css')
        <link rel="stylesheet" href="{{asset('vendor/adminlte/dist/css/form.css')}}">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    @endsection
    @section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function(){
            $('#agregar').click(function(){
                agregar();
            });
        });
    
        var total = 0;
        var productosSeleccionados = {};
    
        $("#guardar").hide();
        $("#id_producto").change(mostrarValores);

        $("#id_insumos").change(mostrarValores2);

        function mostrarValoresInsu(){
            datosProductos2 = document.getElementById("id_insumos").value.split('_');
            $("#cantidaduu").val(datosProductos2[0]);
        }
    
        function mostrarValores(){
            datosProducto = document.getElementById('id_producto').value.split('_');
            $("#Precio").val(datosProducto[2]);
        }




    
        function agregar(){
            datosProducto = document.getElementById('id_producto').value.split('_');
            id_producto = datosProducto[0];
            producto = $("#id_producto option:selected").text();
            cantidad = $("#Cantidad").val();
            precio = $("#Precio").val();
            empleado = $("#id_empleado").val();

            // Obtener la cantidad disponible del producto
            //cantidadDisponible = $("#id_producto option:selected").data('cantidad');

    
            if (id_producto != "" && parseInt(cantidad) != "" && parseInt(cantidad) > 0 && parseFloat(precio) != "" && empleado != ""){
                subtotal = parseInt(cantidad) * parseFloat(precio);
    
                // Verificar si el producto ya ha sido seleccionado
                if (productosSeleccionados.hasOwnProperty(id_producto)) {
                    // Actualizar la cantidad y subtotal del producto existente
                    productosSeleccionados[id_producto].cantidad += parseInt(cantidad);
                    productosSeleccionados[id_producto].subtotal += subtotal;
                    var filaExistente = productosSeleccionados[id_producto].fila;
                    filaExistente.find('.cantidad').val(productosSeleccionados[id_producto].cantidad);
                    filaExistente.find('.subtotal').val(productosSeleccionados[id_producto].subtotal);
                } else {
                    // Agregar el nuevo producto al objeto de productos seleccionados
                    var fila = '<tr class="selected"><td><button type="button" class="btn btn-warning" onclick="eliminar(this);">X</button></td><td><input type="hidden" name="id_producto[]" value="' + id_producto + '">' + producto + '</td><td><input type="number" class="precio" name="Precio[]" value="' + precio + '" readonly></td><td><input type="number" class="cantidad" name="Cantidad[]" value="' + cantidad + '" readonly></td><td><input type="number" class="subtotal" value="' + subtotal + '" readonly></td></tr>';
                    var nuevaFila = $(fila);
                    productosSeleccionados[id_producto] = {
                        fila: nuevaFila,
                        cantidad: parseInt(cantidad),
                        subtotal: subtotal
                    };
                    $('#detalles').append(nuevaFila);
                }
    
                total += subtotal;
                totales();
                evaluar();
            } else {
                Swal.fire({
                    position: 'top-center',
                    icon: 'error',
                    title: 'Error al ingresar el detalle de la venta, revise los datos del producto',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        }
    
        function totales(){
            $("#total").html("PEN " + total.toFixed(2));
            total_pagar = total;
            $("#total_pagar_html").html("PEN " + total_pagar.toFixed(2));
            $("#total_pagar").val(total_pagar.toFixed(2));
        }
    
        function evaluar(){
            if (total > 0){
                $("#guardar").show();
            } else {
                $("#guardar").hide();
            }
        }
    
        function eliminar(btn){
            var fila = $(btn).closest('tr');
            var id_producto = fila.find("input[name='id_producto[]']").val();
            var subtotal = parseFloat(fila.find('.subtotal').val());

            fila.remove();

            total -= subtotal;
            delete productosSeleccionados[id_producto];

            totales();
            evaluar();
        }
    </script>



        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    @endsection
@endsection
