@extends('adminlte::page')

@section('title', 'Compras')
 
@section('content')
<x-slot name="header">
</x-slot>
@if (session('success'))
<div class="alert alert-success" role="success">
    {{ session('success') }}
</div>
@endif  
    <div class="container"><br>
    <center><h2>Añadir Compras</h2></center>
    <div class="d-grid gap-2 d-md-block">
    <a href="{{ route('compras.create') }}" class="btn btn-sm btn-primary text-left">Añadir Compra</a>
    <a href="{{ route('compras.pdfAll') }}" title="Reporte"  class="btn btn-sm btn-warning">Ver Reporte <i class="far fa-file-pdf"></i></a>

    </div><br>
<div class="table-reponsive">
    <table id="compras" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%"> 
        <thead class="bg-primary  text-primary">
        <tr>
        <th scope="col" >Id</th>
        {{-- <th scope="col" >ID proveedor</th> --}}
        <th scope="col" >Referencia compra</th>
        <th scope="col" >Descripción compra</th>
        <th scope="col" >total</td>
        <th scope="col" >Estado</th>
        <th scope="col" class="text-right">Acciones</th>
        </tr>
        </thead>
    <tbody>
        @foreach ($compras as $compra)
        <tr>
        <td scope="row">{{ $compra->id }}</td>
                {{-- <td>{{$compra->TProveedor->Nombre}}</td> --}}
                <td>{{$compra->Referencia_compra}}</td>
                <td>{{$compra->Descripcion_compra}}</td>
                <td>{{$compra->total}}</td>
                @if ($compra->status == 'ACTIVE')
                    <td>
                        <a class="jsgrid-button btn btn-success" href="{{ route('compras.change_status', $compra) }}" title="Activo">
                        Activo<i class="fas fa-fw fa-check"></i>
                        </a>
                    </td>
                    
                @else
                    <td>
                        <p class="jsgrid-button btn btn-danger none"  title="Anulado" @readonly(true) >
                        Anulado<i class="fas fa-fw fa-times"></i>
                        </p>
                    </td>
                @endif
                    
                    

            <td class=" td-actions text-right">
            {{-- {{ route('ventas.show',$venta) }} --}}
            <a href="{{ route('compras.show', $compra) }}" class="btn btn-outline-dark btn-sm"
            title="Ver detalles"><i class="far fa-eye"></i></a>
                
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>


    @section('css') 
        <link rel="stylesheet" href="/css/admin_custom.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">

        <style>
            .none{
                cursor: default;
            }
        </style>

    @stop

    @section('js')
        <script> console.log('Hi!'); </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>
        @if (session('crear') == 'Compra registrada exitosamente')
            <script>
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: 'Compra registrado exitosamente',
                    showConfirmButton: false,
                    timer: 2000
                })
            </script>
        @endif

        @if (session('editar') == 'Compra actualizada correctamente')
            <script>
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: 'Compra actualizada correctamente',
                    showConfirmButton: false,
                    timer: 2000
                })
            </script>
        @endif

        @if (session('Eliminar') == 'Compra eliminada correctamente')
                <script>
                    Swal.fire(
                    '¡Eliminado!',
                    'Compra eliminada correctamente',
                    'success'
                    )
                </script>
        @endif
        <script>
            $('.formulario-eliminar').submit(function(e){
                e.preventDefault();

                Swal.fire({
                title: '¿Estas seguro?',
                text: "Esta compra se eliminara definitivamente!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Si, Eliminar!',
                cancelButtonText: 'Cancelar'
                }).then((result) => {
                if (result.isConfirmed) {
                    // Swal.fire(
                    // 'Deleted!',
                    // 'Your file has been deleted.',
                    // 'success'
                    // )
                    this.submit();
                }
                })
            });
        </script>

<script>
    $(document).ready(function() {
    $('#compras').DataTable( {
        "language": {
            "lengthMenu": "Mostrar _MENU_  registros por página",
            "zeroRecords": "Busqueda no encontrada - disculpa",
            "info": "Mostrando la pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(Filtrado de  _MAX_ registros totales)",
            "search": 'Buscar:',
            "paginate": {
                'next': 'Siguiente',
                'previous': 'Anterior'
            }
        }
    } );
} );
    </script>
    @endsection

@endsection