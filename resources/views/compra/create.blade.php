@extends('adminlte::page')
@section('title', 'Añadir Compra')
@section('content_header')
@stop
@section('content')

<div class="container-fluid">
    <div class="row">
        <form action="/compras" method="POST" class="contact-form row" novalidate>
            @csrf
            <div class="col-md-5">
                <div class="card" title="Compras">
                    <div class="get-in-touch">
                        <h1 class="title">Compras</h1>
                        
                        <div class="form-group col-md-6" title="Referencia compra">
                            <label for="" class=" is-required">Referencia compra:<FONT COLOR="red"> *</FONT></label>
                            <input type="text" id="Referencia_compra" name="Referencia_compra" class="input-text js-input" tabindex="1">
                            @if ($errors->has('Referencia_compra'))
                            <span class="error text-danger" for="input-Referencia_compra">{{$errors->first('Referencia_compra') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-6" title="Proveedor">
                            <label for="" class="" tabindex="8">Proveedor:<FONT COLOR="red"> *</FONT></label>
                            <select name="id_proveedores" class="input-text js-input" type="text" required autocomplete="off" name="Estado" tabindex="2">
                                <option value="">Seleccione un proveedor</option>
                                @foreach($Proveedor as $tpro)
                                <option value="{{$tpro->id}}">{{$tpro->Nombre}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('id_proveedores'))
                            <span class="error text-danger" for="input-id_proveedores">{{$errors->first('id_proveedores') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-6" title="Insumos">
                            <label class="" for="id_insumos">Insumos:<FONT COLOR="red"> *</FONT></label></label>
                            <select id="id_insumos" type="text"  required autocomplete="off" name="id_insumos" tabindex="3"
                            class="input-text js-input @error('id_insumos' )is-invalid @enderror">
                            <option value="" disabled selected> Seleccione un insumo</option>
                            
                            @foreach ($Insumos as $insu)
                                <option value="{{$insu->id}}">{{$insu->Nombre_Insumo}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6" title="Paquetes">
                            <label for="" class="">Paquetes:<FONT COLOR="red"> *</FONT></label>
                            <input type="number" id="Paquetes" name="Paquetes" class="input-text js-input " tabindex="4">
                            
                            @if ($errors->has('Paquetes'))
                    
                                <span class="error text-danger" for="input-Paquetes">{{$errors->first('Paquetes') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-6" title="Cantidad unitarias">
                            <label for="" class="">Cantidad Unitarias:<FONT COLOR="red"> *</FONT></label>
                            <input type="number" id="Cantidad" name="Cantidad" class="input-text js-input " tabindex="5">
                            
                            @if ($errors->has('Cantidad'))
                    
                                <span class="error text-danger" for="input-Cantidad">{{$errors->first('Cantidad') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-6" title="Precio paquete">
                            <label for="" class="">Precio Paquete:<FONT COLOR="red"> *</FONT></label>
                            <input type="number" id="Precio_Paquete" name="Precio_Paquete" class="input-text js-input " tabindex="6">
                            
                            @if ($errors->has('Precio_Paquete'))
                                <span class="error text-danger" for="input-Precio_Paquete">{{$errors->first('Precio_Paquete') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-6" title="Descripcion Compra">
                            <label for="" class="">Descripción compra:</label>
                            {{-- <input type="text" id="Descripcion_compra" name="Descripcion_compra" class="input-text js-input"> --}}
                            <textarea class="obv" name="Descripcion_compra" id="Descripcion_compra" cols="30" rows="10" tabindex="7"></textarea>
                            {{-- <textarea name="" id="" cols="30" rows="10"></textarea> --}}
                            @if ($errors->has('Descripcion_compra'))
                                <span class="error text-danger" for="input-Descripcion_compra">{{$errors->first('Descripcion_compra') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-12" >
                            <button id="agregar" type="button" class="btn btn-primary" title="Agregar a la compra" tabindex="8">Agregar Insumo</button>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="col-md-7">
                <div class="card" title="compras">
                    <div class="get-in-touch">
                        <div class="" title="Tabla de productos para la compra">
                            <h4 class="card-title">Detalles de la compra</h4>
                            <div class="table-responsive">
                            <form action="/compras" method="POST" class="contact-form row" novalidate>
                                @csrf
                                <div class="table-responsive scrollable-table">
                                    <table class="table" id="detalles">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th title="Eliminar el producto de la lista">X</th>
                                                <th title="Producto">Insumo</th>
                                                <th title="Precio del producto">Precio P</th>
                                                <th title="Paquetes">Paquetes</th>
                                                <th title="Cantidad">Cantidad</th>
                                                {{-- <th title="Precio Unitario">Precio U</th> --}}
                                                <th title="Subtotal">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Aquí se mostrarán los productos agregados -->
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="4"><p aling="right" title="Valor Total">Total:</p></th>
                                                <th><p aling="right"><span id="total">0.00</span></p>
                                            </tr>
                                            <tr id="totalcompleto">
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
                                
                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="form-field col-lg-12">
                        <button type="submit" id="guardar" title="Guardar la compra"
                        name="guardar" class="btn btn-primary" tabindex="9">Guardar</button>
                        <a href="/compras" title="Cancelar la compra" class="btn btn-warning" tabindex="10">Cancelar</a>
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
            .scrollable-table {
            max-height: 300px; /* Ajusta la altura máxima según tus necesidades */
            overflow-y: auto;
        }
        </style>

    @endsection


@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
        $(document).ready(function() {
        $("#agregar").click(function() {
            agregar();
        });
        });

        var insumosSeleccionados = {}; // Objeto para almacenar los insumos seleccionados

        var cont = 0;
        total = 0;
        $("#totalcompleto").hide();
        subtotal = [];
        $("#guardar").hide();

        function agregar(){
        id_insumos = $("#id_insumos option:selected").val();  
        referencia_compra = $("#Referencia_compra").val();
        
        id_proveedores = $("#id_proveedores option:selected").val();
        insumos = $("#id_insumos option:selected").text();
        Paquetes = $("#Paquetes").val();
        Cantidad= $("#Cantidad").val();
        Precio_Paquete = $("#Precio_Paquete").val();
        // precioU = $("#resultado").val();
        
        
        if (referencia_compra != "" && id_proveedores != ""  &&  id_insumos != "" && parseInt(Paquetes) != "" && parseInt(Paquetes) > 0 && parseInt(Cantidad) != "" && parseInt(Cantidad) > 0 && parseFloat(Precio_Paquete) != "") {
            
            subtotal[cont] = (parseInt(Paquetes) * parseFloat(Precio_Paquete));
            total = total + subtotal[cont];
            // precioU = parseInt(Cantidad) / parseInt(precio);


            if (insumosSeleccionados.hasOwnProperty(id_insumos)) {
                // Actualizar la cantidad y subtotal del insumo existente
                insumosSeleccionados[id_insumos].Paquetes += parseInt(Paquetes);
                insumosSeleccionados[id_insumos].subtotal += subtotal[cont];

                var filaExistente = insumosSeleccionados[id_insumos].fila;
                filaExistente.find("input[name='Paquetes[]']").val(insumosSeleccionados[id_insumos].Paquetes);
                filaExistente.find("td:last").text(insumosSeleccionados[id_insumos].subtotal);
            } else {
                // Agregar el nuevo insumo al objeto insumosSeleccionados
                var fila = '<tr class="selected" id="fila' + cont + '">'+
                '<td><button type="button" class="btn btn-warning" onclick="eliminar(' + cont + ');">X</button></td>'+
                '<td><input type="hidden" name="id_insumos[]" value="' + id_insumos + '">' + insumos + '</td>'+
                '<td><input type="number" class="Precio_Paquete form-control" id="Precio_Paquete[]" name="Precio_Paquete[]" value="' + Precio_Paquete + '" readonly></td>'+
                '<td><input type="number" class="Paquetes form-control" name="Paquetes[]" value="' + Paquetes + '" readonly></td>'+
                '<td><input type="number" class="Cantidad form-control" name="Cantidad[]" value="' + Cantidad + '" readonly></td>'+
                
                '<td>' + subtotal[cont] + '</td></tr>';
                var nuevaFila = $(fila);
                insumosSeleccionados[id_insumos] = {
                    fila: nuevaFila,
                    Paquetes: parseInt(Paquetes),
                    subtotal: subtotal[cont]
                };
                $('#detalles').append(nuevaFila);
                cont++;
            }

            limpiar();
            totales();
            evaluar();
        } else {
                    Swal.fire({
                    position: 'top-center',
                    icon: 'error',
                    title: 'Error al ingresar el detalle de la compra, revise los datos del Insumo',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        }


        function limpiar(){
        $("#Cantidad").val("");
        $("#Precio_Paquete").val("");
        $("#id_insumos").val("");
        $("#Paquetes").val("");
        }

        function totales(){
        $("#total").html("" + total.toFixed(2));
        total_pagar = total;
        $("#total_pagar_html").html(" " + total_pagar.toFixed(2));
        $("#total_pagar").val(total_pagar.toFixed(2));
        }

        function evaluar(){
        if (total > 0) {
            $("#guardar").show();
        }else{
            $("#guardar").hide();
        }
        }

        function eliminar(index){
            var fila = $("#fila" + index);
            var id_insumos = fila.find("input[name='id_insumos[]']").val();
            total -= insumosSeleccionados[id_insumos].subtotal;

            fila.remove();
            delete insumosSeleccionados[id_insumos];

            totales();
            evaluar();
        }
       
        </script>

        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    @endsection
@endsection