@extends('adminlte::page')


@section('title', 'Usuarios')


@section('content')

    <div class="container">
    <center><h2>Usuarios</h2></center>
    <div class="d-grid gap-2 d-md-block">
        <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary" title="Añadir usuario">Añadir usuario</a>
    </div><br>
<div class="table-reponsive">
    <table id="usuarios" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%"> 
        <thead class="bg-primary  text-primary">
        <tr>
        <th scope="col" >ID</th>
        <th scope="col" >Nombre</th>
        <th scope="col" >Email</th>
        <th scope="col" >Rol</th>
        <th scope="col" >Fecha de ingreso</td>
        <th scope="col" >Estado</td>
        <th scope="col" class="text-right">Acciones</th>
        </tr>
        </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td scope="row">{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @if(!empty($user->getRoleNames()))
                    @foreach($user->getRoleNames() as $rolNombre)                                       
                        <h5><span class="badge badge-primary">{{ $rolNombre }}</span></h5>
                    @endforeach
                @endif
            </td>
            <td>{{ $user->created_at }}</td>
            @if ($user->status == 'ACTIVE')
            <td>
                    <a class="jsgrid-button btn btn-success btn-xs" href="{{ route('users.change_status', $user) }}" title="Desactivar usuario">
                    Activo<i class="fas fa-fw fa-check"></i>
                </a>
                </td>
            @else
            <td>
                    <a class="jsgrid-button btn btn-danger btn-xs" href="{{ route('users.change_status', $user) }}" title="Activar usuario" >
                    Desactivado<i class="fas fa-fw fa-times"></i>
                </a>
                </td>     
            @endif

            @if($user->status == 'ACTIVE')
                <td class=" td-actions text-right">
                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-outline-dark btn-sm"><i class="fas fa-fw fa-user" title="Ver información detalladamente del usuario"></i></a>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-dark btn-sm"><i class="fas fa-fw fa-pen" title="Editar usuario"></i></a>
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

    @if (session('Active') == 'Se desactivar el usuario')
        <script>
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Usuario desactivado correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif

    @if (session('inhabilitar') == 'Se activara el usuario')
        <script>
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Usuario activado correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif

    @if (session('Crear') == 'Usuario registrado exitosamente')
        <script>
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Usuario registrado correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif

    @if (session('Editar') == 'Usuario actualizado exitosamente')
        <script>
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Usuario modificado correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif

    @if (session('Eliminar') == 'Usuario eliminado exitosamente')
            <script>
                Swal.fire(
                '¡Eliminado!',
                'Usuario eliminado correctamente.',
                'success'
                )
            </script>
        @endif

    <script>
        $('.formulario-eliminar').submit(function(e){
            e.preventDefault();

            Swal.fire({
            title: '¿Estas seguro?',
            text: "Este usuario se eliminara definitivamente!",
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
    $('#usuarios').DataTable( {
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