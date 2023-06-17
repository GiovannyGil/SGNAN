@extends('adminlte::page')


@section('title', 'Insumos')


@section('content')
<x-slot name="header">
</x-slot>
@if (session('success'))
<div class="alert alert-success" role="success">
    {{ session('success') }}
</div>
@endif  
    <div class="container"><br>
    <center><h2>Añadir Insumos</h2></center>
    <div class="d-grid gap-2 d-md-block">
    <a href="{{ route('insumos.create') }}" class="btn btn-sm btn-primary text-left">Añadir Insumos</a> <br></div><br>
<div class="table-reponsive">
    <table id="insumo" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%""> 
        <thead class="bg-primary  text-primary">
        <tr>
        <th scope="col">id</th>
        <th scope="col">Nombre del insumo</th>
        <th scope="col">Stock</th>
        <th scope="col">cantidad</th>
        <th scope="col">Precio U</th>
        <th scope="col">Categorias</th>
        <th scoope="col">Estado</th>
        <th scope="col" class="text-right">Acciones</th>
        </tr>
        </thead>
    <tbody>
        @foreach ($insumos as $insumo)
        <tr>
            <td scope="row">{{$insumo->id }}</td>
            <td>{{$insumo->Nombre_Insumo}}</td>
            <td>{{$insumo->Stock}}</td>
            <td>{{$insumo->Cantidad}}</td>
            <td>{{$insumo->PrecioU}}</td>
            <td>{{$insumo->categorias->Nombre}}</td>   
            @if($insumo->status == 'ACTIVE')
                <td>
                    <a class="jsgrid-button btn btn-success btn-xs" href="#" title="Activo" onclick="cambiarEstado({{ $insumo->id }})">
                        Activo<i class="fas fa-fw fa-check"></i>
                    </a>
                </td> 
            @else
                <td>
                    <a class="jsgrid-button btn btn-danger btn-xs" href="#" title="Desactivo" onclick="cambiarEstado({{ $insumo->id }})">
                        Desactivado<i class="fas fa-fw fa-times"></i>
                    </a>
                </td>
            @endif

            <td class=" td-actions text-right">
                
                <a href="{{ route('insumos.edit', $insumo->id) }}" class="btn btn-outline-dark btn-sm"><i class="fas fa-fw fa-pen"></i></a>
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@stop


@section('css') 
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>
    @if (session('crear') == 'Insumo registrado exitosamente')
        <script>
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Insumo registrado exitosamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
@endif

@if (session('editar') == 'Insumo actualizado exitosamente')
        <script>
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Insumo actualizado exitosamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
@endif

@if (session('Eliminar') == 'Insumo eliminado exitosamente')
            <script>
                Swal.fire(
                '¡Eliminado!',
                'Insumo eliminado exitosamente',
                'success'
                )
            </script>
@endif
<script>
        $('.formulario-eliminar').submit(function(e){
            e.preventDefault();

            Swal.fire({
            title: '¿Estas seguro?',
            text: "Este Insumo se eliminara definitivamente!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Si, Eliminar!',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
                this.submit();
            }
            })
        });

        // Agregar el siguiente código JavaScript en tu archivo de scripts o en la sección <script> de tu vista

        // Función para cambiar el estado del insumo con confirmación Swal.fire
        function cambiarEstado(insumoId) {
            Swal.fire({
                icon: 'question',
                title: 'Confirmación',
                text: '¿Deseas cambiar el estado del insumo?',
                showCancelButton: true,
                confirmButtonText: 'Sí',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Realizar la solicitud AJAX para cambiar el estado
                    axios.get(`/insumos/${insumoId}/change_status`)
                        .then(response => {
                            // Actualizar la vista o realizar cualquier acción adicional si es necesario
                            // Por ejemplo, recargar la página: location.reload();
                            // o actualizar el estado del insumo en la interfaz de usuario
                            Swal.fire('Éxito', response.data.success, 'success');
                            location.reload(); // Recarga la página para reflejar el cambio de estado
                        })
                        .catch(error => {
                            console.error(error);
                            // Manejar errores si es necesario
                            Swal.fire('Cancelado', 'El cambio de estado ha sido cancelado', 'info');
                        });
                }
            });
        }

    </script>


<script>
    $(document).ready(function() {
    $('#insumo').DataTable( {
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


@stop