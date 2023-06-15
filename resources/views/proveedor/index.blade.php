@extends('adminlte::page')


@section('title', 'Proveedores')


@section('content')
<x-slot name="header">
</x-slot>
@if (session('success'))
<div class="alert alert-success" role="success">
    {{ session('success') }}
</div>
@endif  
    <div class="container"><br>
    <center><h2>Añadir Proveedor</h2></center>
    <div class="d-grid gap-2 d-md-block">
    <a href="{{ route('proveedores.create') }}" class="btn btn-sm btn-primary text-left" >Añadir Proveedor</a> <br></div><br>
<div class="table-reponsive">
    <table id="proveedor" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%"> 
        <thead class="bg-primary  text-primary">
        <tr>
        <th scope="col">id</th>
                <th scope="col">Nombre de la empresa</th>
                <th scope="col">Nombre del Asesor</th>
                <th scope="col">Correo</th>
                <th scope="col">Dirección</th>
                <th scope="col">Teléfono</th>
                <th scoope="col">Estado</th>
        <th scope="col" class="text-right">Acciones</th>
        </tr>
        </thead>
    <tbody> 
        @foreach ($proveedores as $proveedor)
        <tr>
            <td scope="row">{{ $proveedor->id }}</td>
            <td>{{$proveedor->Nombre}}</td>
            <td>{{$proveedor->asesor}}</td>
            <td>{{$proveedor->Correo}}</td>
            <td>{{$proveedor->Direccion}}</td>
            <td>{{$proveedor->Telefono}}</td>
            @if ($proveedor->status == 'ACTIVE')
                <td>
                    <button class="jsgrid-button btn btn-success" title="Editar" onclick="cambiarEstadoProveedor({{ $proveedor->id }})">
                        Activo<i class="fas fa-fw fa-check"></i>
                    </button>
                </td>
            @else
                <td>
                    <button class="jsgrid-button btn btn-danger" title="Editar" onclick="cambiarEstadoProveedor({{ $proveedor->id }})">
                        Desactivado<i class="fas fa-fw fa-times"></i>
                    </button>
                </td>
            @endif


            <td class=" td-actions text-right" >
                <a href="{{ route('proveedores.show', $proveedor->id) }}" class="btn btn-outline-dark btn-sm" ><i class="fas fa-fw fa-user"></i></a>
                <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="btn btn-outline-dark btn-sm"><i class="fas fa-fw fa-pen"></i></a>
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
    @if (session('crear') == 'Proveedor registrado exitosamente')
        <script>
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Proveedor registrado correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
@endif

@if (session('editar') == 'Proveedor actualizado correctamente')
        <script>
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Proveedor actualizado correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
@endif
@if (session('Eliminar') == 'Proveedor eliminado correctamente')
            <script>
                Swal.fire(
                '¡Eliminado!',
                'Proveedor eliminado correctamente',
                'success'
                )
            </script>
@endif
<script>
        $('.formulario-eliminar').submit(function(e){
            e.preventDefault();

            Swal.fire({
            title: '¿Estas seguro?',
            text: "Este proveedor se eliminara definitivamente!",
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
        // Función para cambiar el estado del proveedor con confirmación Swal.fire
        function cambiarEstadoProveedor(proveedorId) {
            Swal.fire({
                icon: 'question',
                title: 'Confirmación',
                text: '¿Deseas cambiar el estado del proveedor?',
                showCancelButton: true,
                confirmButtonText: 'Sí',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Realizar la solicitud AJAX para cambiar el estado
                    axios.get(`/proveedores/${proveedorId}/change_status`)
                        .then(response => {
                            // Actualizar la vista o realizar cualquier acción adicional si es necesario
                            // Por ejemplo, recargar la página: location.reload();
                            // o actualizar el estado del proveedor en la interfaz de usuario
                            location.reload(); // Ejemplo de recargar la página después del cambio de estado
                        })
                        .catch(error => {
                            console.error(error);
                            // Manejar errores si es necesario
                        });
                }
            });
        }

</script>

<script>
    $(document).ready(function() {
    $('#proveedor').DataTable( {
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