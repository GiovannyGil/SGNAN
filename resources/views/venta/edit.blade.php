@extends('adminlte::page')

@section('title', 'Editar Venta')

@section('content_header')
    <h1>Editar Venta</h1>
@stop

@section('content')
<div class="container">
    <div class="card p-1">
        <form action="/ventas/{{$venta->id}}" method="POST" class="g-3 needs-validation">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-5 ml-5 mr-5">
                    <div class="mb-3">
                        <label for="" class="form-label">NombreCliente*</label>
                        <input type="text" id="NombreCliente" name="NombreCliente" class="form-control" tabindex="1" value="{{$venta->NombreCliente}}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Observaciones*</label>
                        <input type="text" id="Observaciones" name="Observaciones" class="form-control" tabindex="5" value="{{$venta->Observaciones}}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Cantidad*</label>
                        <input type="number" id="Cantidad" name="Cantidad" class="form-control" tabindex="6" value="{{$venta->Cantidad}}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Estado*</label>
                        <select name="Estado" id="Estado" class="form-select form-select-lg mb-3 form-control" tabindex="7"">
                            <option value="{{$venta->Estado}}">Habilidato</option>
                            <option value="1">Habilidato</option>
                            <option value="2">InHabilidato</option>
                        </select>
                    </div>
                </div>
                <div class="col-5 ml-5 mr-4">
                    <div class="mb-3">
                        <label for="" class="form-label">Proceso Compra*</label>
                        <select name="ProcesoCompra" id="ProcesoCompra" class="form-select form-select-lg mb-3 form-control" tabindex="7"">
                            <option>{{$venta->ProcesoCompra}}</option>
                            <option value="1">En Proceso</option>
                            <option value="2">Completado</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Empleado ID*</label>
                        <input type="number" id="Empleado_ID" name="Empleado_ID" class="form-control" tabindex="8" readonly value="{{$venta->Empleado_ID}}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Producto ID*</label>
                        <input type="number" id="Producto_ID" name="Producto_ID" class="form-control" tabindex="8" readonly value="{{$venta->Producto_ID}}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Precio Unitario</label>
                        <input type="number" id="PrecioUnitario" name="PrecioUnitario" class="form-control" tabindex="9" value="{{$venta->PrecioUnitario}}">
                    </div>
                    <div class="mb-3">
                        <label for="" hidden class="form-label">Precio Total*</label>
                        <input type="number" hidden id="ValorTotal" name="ValorTotal" class="form-control" tabindex="10" value="{{$venta->ValorTotal}}">
                    </div>
                </div>
            </div>

            <div class="mb-3  ml-5 mr-5">

                <a href="/ventas" class="btn btn-dark" tabindex="11">Cancelar</a>
                <button class="btn btn-primary" tabindex="12">Guardar</button>
            </div>


        </form>
    </div>
</div>
@endsection

