@extends('adminlte::page')

@section('title', 'Añadir Compra')

@section('content_header')

@stop
@section('content')

<div class="card">
    <section class="get-in-touch">

        <h1 class="title">Añadir Compra</h1>
        <form action="/compras" method="POST" class="contact-form row" novalidate>
            @csrf

            <div class="form-field col-lg-4">
                <label for="" class=" is-required">Referencia compra:*</label>
                <input type="text" id="Referencia_compra" name="Referencia_compra" class="input-text js-input" tabindex="1">
                @if ($errors->has('Referencia_compra'))
                <span class="error text-danger" for="input-Referencia_compra">{{$errors->first('Referencia_compra') }}</span>
                @endif
            </div>

            <div class="form-field col-lg-4">
                <label for="" class=" is-required">Descripción compra:</label>
                <input type="text" id="Descripcion_compra" name="Descripcion_compra" class="input-text js-input tabindex=3">
            
                @if ($errors->has('Descripcion_compra'))
                <span class="error text-danger" for="input-Descripcion_compra">{{$errors->first('Descripcion_compra') }}</span>
                @endif
            </div>

            <div class="form-field col-lg-4">
                <label for="" class=" is-required" tabindex="8">Proveedor:*</label>
                <select name="id_proveedores" class="input-text js-input" type="text" required autocomplete="off" name="Estado">
                    <option value=""> </option>
                    @foreach($Proveedor as $tpro)
                    <option value="{{$tpro->id}}">{{$tpro->Nombre}}</option>
                    @endforeach
                </select>
                @if ($errors->has('id_proveedores'))
                <span class="error text-danger" for="input-id_proveedores">{{$errors->first('id_proveedores') }}</span>
                @endif
            </div>
            <div class="form-field col-lg-4 ">
                <label class="" for="id_empleado">Usuario*</label>
                {{-- tomar automaticamente el user logeado en el sistema --}}
                <select id="id_user" class="input-text js-input " type="text" required autocomplete="off" name="id_user"
                
                class="input-text js-input   @error('id_user') is-invalid @enderror">}
                    <option value="{{old('id_user')}}"></option>
                    @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
                
                
                {{-- @error('id_user')
                  <span class="error text-danger" role="alert">
                          <strong>{{$message}}</strong>
                      </span>
                  @enderror --}}
             </div>

            <div class="form-field col-lg-4">
                <label class="" for="id_insumos">Insumos*</label>
                <select id="id_insumos" class="input-text js-input is-required" type="text"  required autocomplete="off" name="id_insumos"
                class="input-text js-input @error('id_insumos' )is-invalid @enderror">
                <option value="" disabled selected> Seleccione un insumo</option>
                <option value="{{old('id_insumos')}}"></option>
                @foreach ($Insumos as $insu)
                <option value="{{$insu->id}}">{{$insu->Nombre_Insumo}}</option>
                    @endforeach
                </select>
               
            </div>

            <div class="form-field col-lg-4">
                <label for="" class=" is-required">Cantidad:*</label>
                <input type="number" id="Cantidad" name="Cantidad" class="input-text js-input tabindex=5">
               
                @if ($errors->has('Cantidad'))

                <span class="error text-danger" for="input-Cantidad">{{$errors->first('Cantidad') }}</span>
                @endif
            </div>

            <div class="form-field col-lg-4">
                <label for="" class=" is-required">Precio:*</label>
                <input type="number" id="Precio" name="Precio" class="input-text js-input tabindex=6">
                
                @if ($errors->has('Precio'))
                <span class="error text-danger" for="input-Precio">{{$errors->first('Precio') }}</span>
                @endif
            </div>
{{-- 
            <div class="form-field col-lg-4">
                <input type="number" id="total" name="total" class="input-text js-input tabindex=6">
                <label for="" class="label is-required">Total:</label>
                @if ($errors->has('total'))
                <span class="error text-danger" for="input-total">{{$errors->first('total') }}</span>
                @endif
            </div> --}}

            
            <div class="form-field col-lg-12">
                <button id="agregar" type="button" class="btn btn-primary float-right" >Agregar Insumo</button>
            </div>

            <div class="">

                <h4 class="card-title"><center>Detalle de compras</center></h4>
                <div class="table-responsive col-md-50">
                    <table id="detalles" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Eliminar</th>
                                <th>Insumo</th>
                                <th>Precio(PEN)</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th colspan="4">
                                    <p align="right">Total:</p>
                                </th>
                                <th>
                                    <p align="right"><span id="total">PEN 0.00</span></p>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="4">
                                    <p align="right">Total a pagar</p>
                                </th>
                                <th>
                                    <p align="right"><span align="right" id="total_pagar_html">PEN 0.00</span>
                                        <input type="hidden" name="total" id="total_pagar">
                                    </p>
                                </th>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>

            <div class="form-field col-lg-12">
                <a href="/compras" class="submit-btn2">Cancelar</a>
                {{--<input class="submit-btn" type="submit" value="Guardar"> --}}
                <button type="submit" id="guardar" name="guardar" class="submit-btn">Guardar</button>
            </div>

        </form>
    </section>
</div>
</div>
@endsection

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
                var fila = '<tr class="selected" id="fila' + cont + '"><td><button type="button" class="btn btn-warning" onclick="eliminar(' + cont + ');">X</button></td><td><input type="hidden" name="id_insumos[]" value="' + id_insumos + '">' + insumos + '</td><td><input type="number" id="Precio[]" name="Precio[]" value="' + precio + '" readonly></td><td><input type="number" name="Cantidad[]" value="' + cantidad + '" readonly></td><td>' + subtotal[cont] + '</td></tr>';
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
                    title: 'Error al ingresar el detalle de la compra, revise los datos del Insumo',
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
        $("#total").html("PEN " + total.toFixed(2));
        total_pagar = total;
        $("#total_pagar_html").html("PEN " + total_pagar.toFixed(2));
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
<script>
       .is-required:after {
    content: '*';
    margin-left: 3px;
    color: red;
    font-weight: bold;
  }
</script>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

@endsection