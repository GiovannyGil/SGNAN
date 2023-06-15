@extends('adminlte::page')

@section('title', 'Editar Producto')

@section('content_header')
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <form action="{{route('productos.update', $productos->id) }}" method="POST" class="contact-form row" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')
        <div class="col-md-6">
            <div class="card" title="Productos">
                <div class="get-in-touch">
                    <h1 class="title">Productos</h1>
                    <div class="table-responsive scrollable-table">
                    <div class="form-field col-md-12 ">
                        <label for="" class="input-text js-input" required >Nombre Producto:<FONT COLOR="red"> *</FONT>  </label>
                        <input type="text" id="NombreProducto" name="NombreProducto" class="input-text js-input" tabindex="1" value="{{ $productos->NombreProducto }}">
        
                        @error('NombreProducto')
                        <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="form-field col-md-12">
                        <label for="" class="input-text js-input">Descripción:</label>
                        <input type="text" id="Descripcion" name="Descripcion" class="input-text js-input" tabindex="2" value="{{ $productos->DescripcionProducto }}">
                    
                        @error('DescripcionProducto')
                        <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="form-field col-md-12 ">
                        <label for="" class="input-text js-input" required>Precio:<FONT COLOR="red"> *</FONT> </label>
                        <input type="integer" id="PrecioP" name="PrecioP" class="input-text js-input" tabindex="3" value="{{ $productos->PrecioP }}">
                    
                        @error('PrecioP')
                        <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="form-field col-lg-6">
                        <label class="">Subir Imagen<FONT COLOR="red"> *</FONT></label>
                        <input class="input-text js-input" type="file" id="imagen" name="imagen" tabindex="10" value="{{ old('imagen', $productos->imagen)}}">
                        @if ($errors->has('imagen'))
                            <span class="error text-danger" for="input-imagen">{{$errors->first('imagen') }}</span>
                        @endif
                    </div>
                    <div class="form-field col-lg-6">
                        <img src="/imagen/{{$productos->imagen}}" id="imagenSeleccionada" style="max-height: 100px;">
                        
                    </div>

    
                    <div class="form-field col-md-12">
                        <label class="input-text js-input" for="id_insumos">Insumos<FONT COLOR="red"> *</FONT></label>
                        <select id="id_insumos" tabindex="4" class="input-text js-input" type="text" required autocomplete="off" name="nuevos_detalles[0][id_insumos]" class="input-text js-input @error('id_insumos') is-invalid @enderror">
                            <option value="">Seleccione un insumo</option>
                            @foreach ($insumos as $insu)
                                <option value="{{ $insu->id }}">{{ $insu->Nombre_Insumo }}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="form-field col-md-12">
                        <label for="" class="input-text js-input">Cantidad:<FONT COLOR="red"> *</FONT> </label>
                        <input type="number" id="Cantidad" tabindex="5" name="nuevos_detalles[0][Cantidad]" class="input-text js-input @error('Cantidad') is-invalid @enderror" value="">
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
                        <div class="table-responsive">
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
                                    <tbody>
                                        @foreach ($detalleProductos as $index => $detalle)
                                            <tr class="selected" id="fila{{ $index }}">
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm btn-remove" onclick="eliminar({{ $index }});">X</button>
                                                </td>
                                                <td>
                                                    @foreach ($insumos as $insu)
                                                        @if($insu->id == $detalle->id_insumos)
                                                            {{ $insu->Nombre_Insumo }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <input type="number" name="cantidad[]" value="{{ $detalle->Cantidad }}">
                                                    <input type="hidden" name="detalle_ids[]" value="{{ $detalle->id }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
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
<link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/form.css') }}">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<style>
    .scrollable-table{
        max-height: 300px;
        overflow-y: auto;
    }
</style>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $('#agregar').click(function(){
            agregar();
        });
    });

    var cont = {{ count($detalleProductos) }};
    total = 0;

    function agregar(){
        id_insumos = $("#id_insumos").val();
        insumos = $("#id_insumos option:selected").text();
        cantidad = $("#Cantidad").val();

        if(id_insumos != "" && parseInt(cantidad) != "" && parseInt(cantidad) > 0){
            var fila = '<tr class="selected" id="fila' + cont + '"><td><button type="button" class="btn btn-danger btn-sm btn-remove" onclick="eliminar(' + cont + ');">X</button></td><td><input type="hidden" name="nuevos_detalles[' + cont + '][id_insumos]" value="' + id_insumos + '">' + insumos + '</td><td><input type="number" name="nuevos_detalles[' + cont + '][Cantidad]" value="' + cantidad + '"></td></tr>';
            $('#detalles').append(fila);
            cont++;

            limpiar();
        } else {
            alert("Error al ingresar el detalle del insumo, revise los datos.");
        }
       
        
    }

    function limpiar(){
        $("#Cantidad").val("");
        $("#id_insumos").val("");
    }

    function eliminar(index){
        var fila = $("#fila" + index);
        fila.remove();
    }
</script>
@endsection
@endsection