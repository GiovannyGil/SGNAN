@extends('adminlte::page')


@section('title', 'Roles')

@section('content')

    <div class="container">
        <center> <h2>Roles</h2></center>
    <div class="d-grid gap-2 d-md-block">
        <a href="{{ route('roles.create') }}" class="btn btn-sm btn-primary text-left" title="Añadir un rol">Añadir Rol</a> 
    </div><br>
<div class="table-reponsive">
    <table id="rol" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-primary text-primary">
        <tr>
        <th scope="col" >ID</th>
        <th scope="col" >Rol</th>
        <th scope="col" >Estado</th>
        <th scope="col" class="text-right">Acciones</th>
        </tr>
        </thead>
    <tbody>
        @foreach ($roles as $role)
        <tr>
            <td>{{ $role->id }}</td>
            <td>{{ $role->name }}</td>
            @if ($role->name === 'Administrador')
            <td>

            </td>
            @elseif ($role->status == 'ACTIVE')
                <td>
                    <a class="jsgrid-button btn btn-success btn-xs" href="{{ route('roles.change_status', $role) }}" title="Desactivar rol">
                    Activo<i class="fas fa-fw fa-check"></i>
                </a>
                </td>
            @else
                <td>
                    <a class="jsgrid-button btn btn-danger btn-xs" href="{{ route('roles.change_status', $role) }}" title="Activar rol" >
                    Desactivado<i class="fas fa-fw fa-times"></i>
                </a>
                </td>
            @endif

            @if($role->status == 'ACTIVE' and $role->name <> 'Administrador')
                    <td class=" td-actions text-right">
                            <a href="{{ route('roles.edit', $role) }}" class="btn btn-warning  btn-sm"><i class="fas fa-fw fa-pen" title="Editar rol"></i></a>
                            
                    </td>
                </tr>
            @else
                    <td>

                    </td>
            @endif

        @endforeach
    </tbody>
    </table>
</div>

@stop


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    @if (session('Active') == 'Se desactivar el rol')
        <script>
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Rol desactivado correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif

    @if (session('inhabilitar') == 'Se activara el rol')
        <script>
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Rol activado correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif

    @if (session('Crear') == 'El rol se creo con correctamente')
        <script>
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Rol registrado correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif

    @if (session('Editar') == 'El rol se actualizo con éxito')
        <script>
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Rol modificado correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif

    @if (session('Eliminar') == 'El rol se eliminó con éxito')
            <script>
                Swal.fire(
                '¡Eliminado!',
                'Rol eliminado correctamente.',
                'success'
                )
            </script>
        @endif

    <script>
        $('.formulario-eliminar').submit(function(e){
            e.preventDefault();

            Swal.fire({
            title: '¿Estas seguro?',
            text: "Este rol se eliminara definitivamente!",
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
    $('#rol').DataTable( {
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