@extends('adminlte::page')
@section('title', 'Añadir Compra')
@section('content_header')
@stop
@section('content')

<div class="container-fluid">
    <div class="row">
        <form action="/compras" method="POST" class="contact-form row" novalidate>
            @csrf
            <div class="col-md-4">
                <div class="card" title="Compras">
                    <div class="get-in-touch">
                        <h1 class="title">Compras</h1>
                        
                        <div class="form-group col-md-10" title="Referencia compra">
                            <label for="" class=" is-required">Referencia compra:<FONT COLOR="red"> *</FONT></label>
                            <input type="text" id="Referencia_compra" name="Referencia_compra" class="input-text js-input" tabindex="1">
                            @if ($errors->has('Referencia_compra'))
                            <span class="error text-danger" for="input-Referencia_compra">{{$errors->first('Referencia_compra') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-10" title="Proveedor">
                            <label for="" class="" tabindex="8">Proveedor:<FONT COLOR="red"> *</FONT></label>
                            <select name="id_proveedores" class="input-text js-input" type="text" required autocomplete="off" name="Estado">
                                <option value="">Seleccione un proveedor</option>
                                @foreach($Proveedor as $tpro)
                                <option value="{{$tpro->id}}">{{$tpro->Nombre}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('id_proveedores'))
                            <span class="error text-danger" for="input-id_proveedores">{{$errors->first('id_proveedores') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-10" title="Insumos">
                            <label class="" for="id_insumos">Insumos:<FONT COLOR="red"> *</FONT></label></label>
                            <select id="id_insumos" class="input-text js-input" type="text"  required autocomplete="off" name="id_insumos"
                            class="input-text js-input @error('id_insumos' )is-invalid @enderror">
                            <option value="" disabled selected> Seleccione un insumo</option>
                            
                            @foreach ($Insumos as $insu)
                            <option value="{{$insu->id}}">{{$insu->Nombre_Insumo}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-10" title="Cantidad unitarias">
                            <label for="" class="">Cantidad Unitarias:<FONT COLOR="red"> *</FONT></label>
                            <input type="number" id="Cantidad" name="Cantidad" class="input-text js-input tabindex=5">
                            
                            @if ($errors->has('Cantidad'))
                    
                            <span class="error text-danger" for="input-Cantidad">{{$errors->first('Cantidad') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-10" title="Precio paquete">
                            <label for="" class="">Precio Paquete:<FONT COLOR="red"> *</FONT></label>
                            <input type="number" id="Precio" name="Precio" class="input-text js-input tabindex=6">
                            
                            @if ($errors->has('Precio'))
                            <span class="error text-danger" for="input-Precio">{{$errors->first('Precio') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-10" title="Descripcion Compra">
                            <label for="" class="">Descripción compra:</label>
                            <input type="text" id="Descripcion_compra" name="Descripcion_compra" class="input-text js-input tabindex=3">
                            
                            @if ($errors->has('Descripcion_compra'))
                            <span class="error text-danger" for="input-Descripcion_compra">{{$errors->first('Descripcion_compra') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-11" >
                            <button id="agregar" type="button" class="btn btn-primary float-right" title="Agregar a la compra">Agregar Insumo</button>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="col-md-8">
                <div class="card" title="compras">
                    <div class="get-in-touch">
                        <div class="" title="Tabla de productos para la compra">
                            <h4 class="card-title">Detalles de la compra</h4>
                            <div class="table-responsive">
                            <form action="/compras" method="POST" class="contact-form row" novalidate>
                                @csrf
                                <table class="table" id="detalles">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th title="Eliminar el producto de la lista">X</th>
                                            <th title="Producto">Insumo</th>
                                            <th title="Precio del producto">Precio</th>
                                            <th title="Cantidad">Cantidad</th>
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
                                
                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="form-field col-lg-12">
                        <button type="submit" id="guardar" title="Guardar la compra" name="guardar" class="btn btn-primary">Guardar</button>
                        <a href="/compras" title="Cancelar la compra" class="btn btn-warning">Cancelar</a>
                    </div>
                </div>
            </div>
        </form>
    
    </div>
</div>

  
@section('css')
<link rel="stylesheet" href="{{asset('vendor/adminlte/dist/css/form.css')}}">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
@endsection


@section('js')

<script>
$(document).ready(function() {
$("#agregar").click(function() {
    agregar();
});
});

var insumosSeleccionados = {}; // Objeto para almacenar los insumos seleccionados

var cont = 0;
total = 0;
subtotal = [];
$("#guardar").hide();

function agregar(){
id_insumos = $("#id_insumos").val();
insumos = $("#id_insumos option:selected").text();
cantidad = $("#Cantidad").val();
precio = $("#Precio").val();

if (id_insumos != "" && parseInt(cantidad) != "" && parseInt(cantidad) > 0 && parseFloat(precio) != "") {
    subtotal[cont] = (parseInt(cantidad) * parseFloat(precio));
    total = total + subtotal[cont];

    if (insumosSeleccionados.hasOwnProperty(id_insumos)) {
        // Actualizar la cantidad y subtotal del insumo existente
        insumosSeleccionados[id_insumos].cantidad += parseInt(cantidad);
        insumosSeleccionados[id_insumos].subtotal += subtotal[cont];

        var filaExistente = insumosSeleccionados[id_insumos].fila;
        filaExistente.find("input[name='Cantidad[]']").val(insumosSeleccionados[id_insumos].cantidad);
        filaExistente.find("td:last").text(insumosSeleccionados[id_insumos].subtotal);
    } else {
        // Agregar el nuevo insumo al objeto insumosSeleccionados
        var fila = '<tr class="selected" id="fila' + cont + '"><td><button type="button" class="btn btn-warning" onclick="eliminar(' + cont + ');">X</button></td><td><input type="hidden" name="id_insumos[]" value="' + id_insumos + '">' + insumos + '</td><td><input type="number" class="precio form-control" id="Precio[]" name="Precio[]" value="' + precio + '" readonly></td><td><input type="number" class="cantidad form-control" name="Cantidad[]" value="' + cantidad + '" readonly></td><td>' + subtotal[cont] + '</td></tr>';
        var nuevaFila = $(fila);
        insumosSeleccionados[id_insumos] = {
            fila: nuevaFila,
            cantidad: parseInt(cantidad),
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
            title: 'Error al ingresar el detalle de la venta, revise los datos del producto',
            showConfirmButton: false,
            timer: 2000
        });
     }
 }


function limpiar(){
$("#Cantidad").val("");
$("#Precio").val("");
$("#id_insumos").val("");
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