@extends('adminlte::page')

@section('title', 'Detalles del producto')

@section('content_header')
@stop

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Detalles del producto</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/productos">Productos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detalles del producto</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6 text-center">
                            <label for="" class="form-control-label">Producto</label>
                            {{-- llamar el nombre del empleado asignado a la venta --}}
                            <p>
                                {{$productos->NombreProducto}}
                                {{-- @foreach ($productos as $producto)
                                    @if($producto->id == $insumo->id_empleado)
                                        {{$empleado->Nombre}}
                                    @endif
                                @endforeach --}}
                            </p>
                        </div>
                        <div class="col-md-4">
                            <img width="195" height="459" src="imagen/{{$productos->Imagen}}" alt="producto" class="avatar" style="border-radius:1%">
                            </div>
                        <div class="col-md-6 text-center">
                            <label for="" class="form-control-label">Numero del producto
                                
                                <p>{{$productos->id}}</p>
                            </label>

                        </div>
                </div>

                <br><br>
                <div class="form-group">
                    <h4 class="card-title">Detalles del producto</h4>
                    <br><br><br>
                    <div class="table-responsive col-md-12">
                        <table class="table" id="detalleProducto">
                            <thead>
                                <tr>
                                    <th>Numero de producto</th>
                                    <th>Insumos</th>
                                    <th>Cantidad</th>
                                    
                                </tr>
                            </thead>
                          
                            <tbody>
                                @foreach ($detalleProducto as $detalle)
                                    <tr>
                                        <td>{{$detalle->id_insumos}}</td>
                                        {{-- llamar el nombre del producto  --}}
                                        <td>
                                            @foreach ($insumos as $insu)
                                                @if($insu->id == $detalle->id_insumos)
                                                    {{$insu->Nombre_Insumo}}
                                                @endif
                                            @endforeach
                                        </td>
                                        {{-- <td>{{$detalle->producto}}</td> --}}
                                        
                                        <td>{{$detalle->Cantidad}}</td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer text-muted">
                    <a href="/productos" class="btn btn-primary float-right">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection