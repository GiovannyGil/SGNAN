@extends('adminlte::page')

@section('title', 'Detalles de la venta')

@section('content_header')
@stop

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Detalles de Venta</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dash" title="Ir al Dashboard">DASHBOARD</a></li>
                <li class="breadcrumb-item"><a href="/ventas" tabindex="Ir a Ventas">Ventas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detalles de Venta</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6 text-center"  title="Nombre del empleado">
                            <label for="" class="form-control-label">Empleado</label>
                            {{-- llamar el nombre del empleado asignado a la venta --}}
                            <p>
                                @foreach ($empleados as $empleado)
                                    @if($empleado->id == $venta->id_empleado)
                                        {{$empleado->Nombre}}
                                    @endif
                                @endforeach
                            </p>
                        </div>
                        <div class="col-md-6 text-center"  title="Identificador de la Venta">
                            <label for="" class="form-control-label">Numero de venta
                                {{-- numero de la venta --}}
                                <p>{{$venta->id}}</p>
                            </label>

                        </div>
                </div>

                <br><br>
                <div class="form-group">
                    <h4 class="card-title">Detalles de Venta</h4>
                    <div class="table-responsive col-md-12">
                        <table class="table" id="detalleVenta">
                            <thead>
                                <tr>
                                    <th>Numero de Venta</th>
                                    <th>Producto</th>
                                    <th>Precio Venta</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr title="Precio total de la Venta">
                                    <th colspan="4"><p aria-label="right">TOTAL</p></th>
                                    <th colspan="4"><p aria-label="right">s/{{number_format($venta->total,2)}}</p></th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($detalleVenta as $detalle)
                                    <tr>
                                        <td>{{$detalle->id}}</td>
                                        {{-- llamar el nombre del producto  --}}
                                        <td title="Nombre del Producto">
                                            @foreach ($productos as $producto)
                                                @if($producto->id == $detalle->id_producto)
                                                    {{$producto->NombreProducto}}
                                                @endif
                                            @endforeach
                                        </td>
                                        {{-- <td>{{$detalle->producto}}</td> --}}
                                        <td title="Precio del Producto">s/{{number_format($detalle->Precio,2)}}</td>
                                        <td title="Cantidad de Productos">{{$detalle->Cantidad}}</td>
                                        <td title="Precio de la Venta">s/{{number_format($detalle->Cantidad*$detalle->Precio,2)}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer text-muted" title="Volver a las Ventas">
                    <a href="/ventas" class="btn btn-primary float-right">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
