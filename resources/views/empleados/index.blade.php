@extends('adminlte::page')


@section('title', 'Empleados')


@section('content')

    <div class="container">
        <center> <h2>Empleados</h2></center>
    <div class="d-grid gap-2 d-md-block">
        <a href="{{ route('empleados.create') }}" class="btn btn-sm btn-primary text-left" title="Anadir un empleado">Añadir empleado</a>
    </div><br>
<div class="table-reponsive">
    <table id="empleado" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-primary text-primary">
        <tr>
        <th scope="col" >ID</th>
        <th scope="col" >Nombre</th>
        <th scope="col" >Apellidos</th>
        <th scope="col" >Email</td>
        <th scope="col" >Documento</td>
        <th scope="col" >Tipo empleado</td>   
        <th scope="col" >Fecha de ingreso</td>
        <th scope="col" >Estado</td>
        <th scope="col" class="text-right">Acciones</th>
        </tr>
        </thead>
    <tbody>
        @foreach ($empleados as $empleado)
        <tr>
            <td scope="row">{{ $empleado->id }}</td>
            <td>{{ $empleado->Nombre }}</td>
            <td>{{ $empleado->Apellidos }}</td>
            <td>{{ $empleado->Email }}</td>
            <td>{{ $empleado->Documento }}</td>
            <td>{{ $empleado->tipoempleados->descripcion}}</td>    <!-- <td>{{ $empleado->id_tipoempleados}}</td>  -->
            <td>{{ $empleado->created_at }}</td>

            @if ($empleado->status == 'ACTIVE')
            <form action="{{ route('empleados.change_status', $empleado) }}" class="desactivar">    
                <td>
                        <button class="jsgrid-button btn btn-success btn-xs" href="{{ route('empleados.change_status', $empleado) }}" title="Desactivar empleado" type="submit">
                        Activo<i class="fas fa-fw fa-check"></i>
                    </button>
                    </td>
            </form>   
            @else
            <form action="{{ route('empleados.change_status', $empleado) }}" class="activar">    
                <td>
                    <button class="jsgrid-button btn btn-danger btn-xs" href="{{ route('empleados.change_status', $empleado) }}" title="Activar Empleado" type="submit">

                    Desacti<i class="fas fa-fw fa-times"></i>
                </button>
                </td>
            </form>
            @endif

            @if($empleado->status == 'ACTIVE')
                <td class=" td-actions text-right">
                        <a href="{{ route('empleados.show', $empleado) }}" class="btn btn-outline-dark btn-sm" title="Ver informacion detalladamente del empleado"><i class="fas fa-fw fa-user"></i></a>
                        <a href="{{ route('empleados.edit', $empleado) }}" class="btn btn-outline-dark btn-sm" title="Editar empleado"><i class="fas fa-fw fa-pen"></i></a>
                        
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>

    @if (session('Desactivar') == 'Empleado desactivado exitosamente')
            <script>
                Swal.fire(
                '¡Desactivado!',
                'Empleado desactivado correctamente.',
                'success'
                )
            </script>
        @endif

    <script>
        $('.desactivar').submit(function(e){
            e.preventDefault();

            Swal.fire({
                icon: 'question',
                title: '¿Estas segur@?',
                text: '¿Deseas cambiar el estado del empleado?',
                showCancelButton: true,
                confirmButtonText: 'Sí',
                cancelButtonText: 'Cancelar', 
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

@if (session('activar') == 'Empleado activado exitosamente')
            <script>
                Swal.fire(
                '¡Activado!',
                'Empleado activado correctamente.',
                'success'
                )
            </script>
        @endif

    <script>
        $('.activar').submit(function(e){
            e.preventDefault();

            Swal.fire({
                icon: 'question',
                title: '¿Estas segur@?',
                text: '¿Deseas cambiar el estado del empleado?',
                showCancelButton: true,
                confirmButtonText: 'Sí',
                cancelButtonText: 'Cancelar', 
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


    @if (session('Crear') == 'Empleado registrado exitosamente')
        <script>
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Empleado registrado correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif

    @if (session('Editar') == 'Empleado actualizado correctamente')
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Empleado modificado correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif

        @if (session('Eliminar') == 'Empleado eliminado correctamente')
            <script>
                Swal.fire(
                '¡Eliminado!',
                'Empleado eliminado correctamente.',
                'success'
                )
            </script>
        @endif

    <script>
        $('.formulario-eliminar').submit(function(e){
            e.preventDefault();

            Swal.fire({
            title: '¿Estas seguro?',
            text: "Este empleado se eliminara definitivamente!",
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
    $('#empleado').DataTable( {
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
