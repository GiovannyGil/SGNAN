@extends('adminlte::page')

@section('title', 'Editar Producto')

@section('content_header')
@stop

@section('content')
<div class="contenido">
    <div class="card"> 
        <section class="get-in-touch">
            <h1 class="title">Editar producto</h1>
            <form action="{{ route('productos.update', $productos->id) }}" method="POST" class="contact-form row" novalidate>
                @csrf
                @method('PUT')

                <div class="form-field col-lg-4">
                    <label for="" class="form-label">Nombre Producto: </label>
                    <input type="text" id="NombreProducto" name="NombreProducto" class="form-control" tabindex="1" value="{{ $productos->NombreProducto }}">

                    @error('NombreProducto')
                    <span class="invalid-feedback">
                        <strong class="message">{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-field col-lg-4">
                    <label for="" class="form-label">Descripcion del producto: </label>
                    <input type="text" id="Descripcion" name="Descripcion" class="form-control" tabindex="2" value="{{ $productos->DescripcionProducto }}">

                    @error('DescripcionProducto')
                    <span class="invalid-feedback">
                        <strong class="message">{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-field col-lg-4">
                    <label for="" class="form-label">Precio: </label>
                    <input type="integer" id="PrecioP" name="PrecioP" class="form-control" tabindex="3" value="{{ $productos->PrecioP }}">

                    @error('PrecioP')
                    <span class="invalid-feedback">
                        <strong class="message">{{ $message }}</strong> 
                    </span>
                    @enderror
                </div>

                <div class="form-field col-lg-4">
                    <select id="id_insumos" tabindex="4" class="input-text js-input" type="text" required autocomplete="off" name="nuevos_detalles[0][id_insumos]" class="input-text js-input @error('id_insumos') is-invalid @enderror">
                        <option value="">Seleccione un insumo</option>
                        @foreach ($insumos as $insu)
                            <option value="{{ $insu->id }}">{{ $insu->Nombre_Insumo }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-field col-lg-4">
                    <label for="" class="input-text js-input">Cantidad: </label>
                    <input type="number" id="Cantidad" tabindex="5" name="nuevos_detalles[0][Cantidad]" class="form-control @error('Cantidad') is-invalid @enderror" value="">
                </div>

                <div class="form-field col-lg-4">
                    <button type="button" id="agregar" tabindex="6" name="agregar" class="submit-btn">Agregar</button>
                </div>

                <div class="">
                    <div class="table-responsive col-md-12">
                        <table id="detalles" class="table table-striped">
                            <thead>
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
                </div>

                <div class="form-field col-lg-12">
                    <button type="submit" id="guardar" tabindex="7" name="guardar" class="submit-btn">Actualizar</button>
                    <a href="/productos" tabindex="8" class="submit-btn2">Cancelar</a>
                </div>
            </form>
        </section>    
    </div>
</div>

@section('css')
<link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/form.css') }}">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
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
