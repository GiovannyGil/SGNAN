@extends('adminlte::page')

@section('title', 'Añadir Venta')

@section('content_header')
@stop

@section('content')

<div class="container-fluid">
    <div class="row">
        <form action="/ventas" method="POST" class="contact-form row" novalidate>
            @csrf
            <div class="col-md-4">
                <div class="card" title="Ventas">
                    <div class="get-in-touch">
                        <h1 class="title">Ventas</h1>
                        
                            <div class="form-group col-md-10" title="Elegir Empleado">
                                <label class="" for="id_empleado">Empleado:<FONT COLOR="red"> *</FONT></label>
                                <select id="id_empleado" class="input-text js-input" required autocomplete="off" name="id_empleado" tabindex="1">
                                    <option value="{{old('id_empleado')}}"></option>
                                    @foreach ($empleados as $empleado)
                                    <option value="{{$empleado->id}}">{{$empleado->Nombre}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-10" title="Producto a vender">
                                <label class="" for="id_producto">Producto:<FONT COLOR="red"> *</FONT></label>
                                <select id="id_producto" class="input-text js-input" required autocomplete="off" name="id_producto" tabindex="2">
                                    <option value="{{old('id_producto')}}" disabled selected>Seleccione un Producto</option>
                                    @foreach ($productos as $producto)
                                    <option value="{{$producto->id}}_{{$producto->Cantidad}}_{{$producto->PrecioP}}">{{$producto->NombreProducto}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-10" title="Ingrese la Cantidad">
                                <label class="" for="Cantidad">Cantidad:<FONT COLOR="red"> *</FONT></label>
                                <input id="Cantidad" type="number" required autocomplete="off" name="Cantidad" class="input-text js-input" tabindex="3">
                            </div>

                            <div class="form-group col-md-10" title="Precio del Producto">
                                <label class="" for="Precio">Precio de Venta:<FONT COLOR="red"> *</FONT></label>
                                <input id="Precio" type="number" required autocomplete="off" name="Precio" disabled class="input-text js-input" tabindex="4">
                            </div>
                            <div class="form-group col-md-12">
                                <button type="button" id="agregar" title="Agregar el producto a la lista de la venta" name="agregar" class="btn btn-primary" tabindex="5">Agregar</button>
                            </div>
                        
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card" title="Ventas">
                    <div class="get-in-touch">
                        <div class="" title="Tabla de productos para la venta">
                            <h4 class="card-title">Detalles de Venta</h4>
                            <div class="table-responsive">
                            <form action="/ventas" method="POST" class="contact-form row" novalidate>
                                @csrf
                                <div class="table-responsive scrollable-table">
                                    <table class="table" id="detalles"> <!-- tabla de detalles de las ventas -->
                                        <thead class="thead-dark">
                                            <tr>
                                                <th title="Eliminar el producto de la lista">X</th>
                                                <th title="Producto">Producto</th>
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
                                                <th><p aling="right"><span id="total">0</span></p></th>
                                            </tr>
                                            <tr id="totalcompleto">
                                                <th id="campo" colspan="4"><p aling="right" title="Valor Total">
                                                    Total Pagar</p></th>
                                                <th id="totalcompleto"><p aling="right">
                                                    <span aling="right" id="total_pagar_html">0</span>
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
                        <button type="submit" id="boton-generar-venta" title="Guardar la Venta" name="boton-generar-venta" class="btn btn-primary" tabindex="6">Guardar</button>
                        <a href="/ventas" title="Cancelar la Venta" class="btn btn-warning" tabindex="7">Cancelar</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

    @section('css')
        <link rel="stylesheet" href="{{asset('vendor/adminlte/dist/css/form.css')}}">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">

    
        <style>
            .scrollable-table {
            max-height: 300px; /* Ajusta la altura máxima según tus necesidades */
            overflow-y: auto;
        }
        </style>
    
    @endsection
    @section('js')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
        {{-- <script src="{{asset('vendor/adminlte/dist/js/dash/alertaScasos.js')}}"></script> --}}
        <script src="{{asset('vendor/adminlte/dist/js/ventas/desactivado.js')}}"></script>
        <script src="{{asset('vendor/adminlte/dist/js/ventas/add.js')}}"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    @endsection
@endsection