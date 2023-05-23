@extends('adminlte::page')


@section('title', 'Categorias')


@section('content')
<x-slot name="header">
</x-slot>
@if (session('success'))
<div class="alert alert-success" role="success">
    {{ session('success') }}
</div>
@endif  
    <div class="container"><br>
    <center><h2>Añadir Categorias</h2></center>
    <div class="d-grid gap-2 d-md-block">
    <a href="{{ route('categorias.create') }}" class="btn btn-sm btn-primary text-left">Añadir Categoria</a> <br></div><br>
<div class="table-reponsive">
    <table id="categoria" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%"> 
        <thead class="bg-primary  text-primary">
        <tr>
        <th scope="col" >Id</th>
        <th scope="col" >Nombre</th>
        <th scoope="col">Estado</th>
        <th scope="col" class="text-right">Acciones</th>
        </tr>
        </thead>
    <tbody>
        @foreach ($categorias as $categoria)
        <tr>
        <td scope="row">{{$categoria->id }}</td>
                    <td>{{$categoria->Nombre}}</td>
                    @if ($categoria->status == 'ACTIVE')
                <td>
                    <a class="jsgrid-button btn btn-success btn-xs" href="{{ route('categorias.change_status', $categoria) }}" title="Editar">
                    Activo<i class="fas fa-fw fa-check"></i>
                </a>
                </td>
                
            @else
                <td>
                    <a class="jsgrid-button btn btn-danger btn-xs" href="{{ route('categorias.change_status', $categoria) }}" title="Editar" >
                    Desactivado<i class="fas fa-fw fa-times"></i>
                </a>
                </td>
                @endif
                    
                    

            <td class=" td-actions text-right">
                
                <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-fw fa-pen"></i></a>
                <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display: inline-block;"  class="formulario-eliminar">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" type="submit">
                <i class="fas fa-fw fa-xmark"><h7>X</h7></i>
                </button> 
            </form>
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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>
    @if (session('crear') == 'Categoria registrada exitosamente')
        <script> 
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Categoria registrada exitosamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
@endif

@if (session('editar') == 'Categoria actualizada correctamente')
        <script>
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Categoria actualizada correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
@endif
@if (session('Eliminar') == 'Categoria eliminada correctamente')
            <script>
                Swal.fire(
                '¡Eliminado!',
                'Categoria eliminada correctamente',
                'success'
                )
            </script>
@endif
<script>
        $('.formulario-eliminar').submit(function(e){
            e.preventDefault();

            Swal.fire({
            title: '¿Estas seguro?',
            text: "Esta categoria se eliminara definitivamente!",
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
    $('#categoria').DataTable( {
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
    } );
} );
</script>

@stop