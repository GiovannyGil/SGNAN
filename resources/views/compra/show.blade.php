@extends('adminlte::page')

@section('title', 'Detalle Compra')

@section('content_header')
    
@stop

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Detalles de Compra</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dash">DASHBOARD</a></li>
                <li class="breadcrumb-item"><a href="/compras">Compras</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detalles de compra</li>
            </ol>
        </nav>

    <div class="form-group">
        
        <div class="table-responsive col-md-12">
            <table class="table" id="detalleVenta">
                <thead>
                    <tr>
                        <th>Referencia Compra</th>
                        <th>Descripcion</th>
                        <th>Proveedor</th>
                        <th>Insumos</th>
                        <th>Paquetes</th>
                        <th>Precio unitario</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="4"><p aria-label="right">TOTAL</p></th>
                        <th colspan="4"><p aria-label="right">s/{{number_format($compra->total,2)}}</p></th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($detallecompras as $detalle)
                        <tr>
                            <td>{{$compra->Referencia_compra}}</td>
                            <td>{{ $compra->Descripcion_compra }}</td>
                            {{-- llamar el nombre del producto  --}}
                            <td>
                                @foreach ($Proveedor as $proveedor)
                                    @if($proveedor->id == $compra->id_proveedores)
                                        {{$proveedor->Nombre}}
                                    @endif
                                @endforeach
                            <td>
                                @foreach ($Insumos as $insu)
                                    @if($insu->id == $detalle->id_insumos)
                                        {{$insu->Nombre_Insumo}}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{$detalle->Paquetes}}</td>
                            {{-- <td>{{$detalle->producto}}</td> --}}
                            <td>s/{{number_format($detalle->Precio,2)}}</td>
                            <td>{{$detalle->Cantidad}}</td>
                            <td>s/{{number_format($detalle->Cantidad*$detalle->Precio,2)}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer text-muted">
        <a href="/compras" class="btn btn-primary float-right">Cancelar</a>
    </div>
</div>
</div>
</div>
</div>
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

@endsection