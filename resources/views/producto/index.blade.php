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
             
                <th scope="col">NombreProducto</th>
                <th scope="col">Observacionesss</th>

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
                    
                    <td>{{$producto->NombreProducto}}</td>
                    <td>{{$producto->DescripcionProducto}}</td>
                    <td>



                        @foreach ($detalleProducto as $detalle)
                            @if($producto->id == $detalle->productos_id)
                             {{$detalle->Cantidad}}
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
                            <img width="90" height="70" src="/imagen/{{$producto->imagen}}" alt="producto" class="avatar" style="border-radius:1%">
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
                      
                        @foreach ($productos as $producto)

                            @if ($producto->Estado == 'Activo')
                                <!-- Mostrar el producto activo -->
                                <p>{{ $producto->nombre }}</p>
                            @endif
                        @endforeach

                        @foreach ($productos as $producto)
                            @if ($producto->Estado == 'Inhactivo')
                                <!-- Mostrar el producto desactivado -->
                                <p>{{ $producto->nombre }}</p>
                            @endif
                        @endforeach

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    @section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    @if (session('crear') == 'Producto registrado exitosamente')
        <script>
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Producto registrado exitosamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif

@endsection

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