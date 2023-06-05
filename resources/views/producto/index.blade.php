@extends('adminlte::page')

@section('title', 'Productos')


    @section('css')
    <link rel="stylesheet"  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    @endsection

    @section('content')


    <div class="container">
        <h1>Productos</h1>

 
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
 
    <a href="productos\create" class="btn btn-primary mb-3">Añadir producto</a>
    <table id="productos" class=" table table-striped table-bordered shadow-lg mt-4" style="width:100%">
       
        <thead class="bg-primary text-while">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Insumos</th>
                <th scope="col">Imagen</th>
                <th scope="col">Precio</th>
                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                <tr>
                    <td>{{$producto->id}}</td>
                    <td>{{$producto->NombreProducto}}</td>
                    <td>{{$producto->DescripcionProducto}}</td>
                    <td>



                        @foreach ($detalleProducto as $detalle)
                            @if($producto->id == $detalle->productos_id)
                             {{$detalle->Cantidad}},
                                @foreach ($insumos as $insu)
                                    @if($detalle->id_insumos == $insu->id)
                                        {{$insu->Nombre_Insumo}},
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </td>
                   
                    <td>  
                        
                        <div class="col-md-4">
                        <img src="{{asset($producto->Imagen)}}" alt="Imagen" width="100">
                        {{-- <img width="300" height="300" src="/imagen/{{$productos->imagen}}" alt="productos" class="avatar" style="border-radius:1%"> --}}
                        </div>
                    </td>
                  
                    {{-- <td><img src="{{Storage::url($producto->Imagen)}}" alt="" width="100"></td> --}}

                    <td>{{$producto->PrecioP}}</td>
                    

                        @if ($producto->Estado == 'Activo')
                        <td>
                            <a class="jsgrid-button btn btn-success" href="{{route('producto.change_status', $producto)}}" title="Activo">
                                Activo
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning  btn-xs"><i class="fas fa-fw fa-pen"></i></a>
                
                            <a href="{{ route('productos.show', $producto) }}" class="btn btn-outline-info" title="Ver detalles"><i class="far fa-eye"> </i></a>
                    
                           </td>
                        @else
                            <td>
                                <a class="jsgrid-button btn btn-danger" href="{{route('producto.change_status', $producto)}}" title="Activo">
                                    Desactivado
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('productos.show', $producto) }}" class="btn btn-outline-info" title="Ver detalles"><i class="far fa-eye"> </i></a>
                             </td>
                        @endif





                  
                          
                        
                        {{-- <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display: inline-block;" class="formulario-eliminar">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">
                            <i class="fas fa-fw fa-xmark"><h7>X</h7></i>
                            </button> 
                        </form> --}}
                    </td>


                        {{-- @if($producto->deleted_at)
                        <form action="{{ route('productos.recover') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="{{$producto->id}}" name="id">
                            <button class="btn btn-success  btn-xs" type="submit">
                                <i class="fas fa-regular fa-arrow-rotate-right"></i>
                            </button> 
                        </form>
                        @else
                        <form action="{{ route ('productos.destroy', $producto->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            
                            <a href="{{ route('productos.edit', $producto) }}" class="btn btn-warning  btn-xs"><i class="fas fa-fw fa-pen"></i></a>
                        
                            <button class="btn btn-danger  btn-xs" type="submit">
                                    <i class="fas fa-fw fa-xmark"><h7>X</h7></i>
                            </button> 
                          
                        </form>
                        @endif --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>



    @section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script></script>
   
   


    <script>
        $(document).ready(function ()
        {
        $('#productos').DataTable({
            "language": {
            "lengthMenu": "Mostrar MENU  registros por página",
            "zeroRecords": "Busqueda no encontrada - disculpa",
            "info": "Mostrando la pagina PAGE de PAGES",
            "infoEmpty": "No records available",
            "infoFiltered": "(Filtrado de  MAX registros totales)",
            "search": 'Buscar:',
            "paginate": {
                'next': 'Siguiente',
                'previous': 'Anterior'
            }
        }
        });

        });
    </script>

    @endsection

@endsection