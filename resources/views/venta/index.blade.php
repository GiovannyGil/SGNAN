@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
@stop

@section('content')

    @if (session('success'))
    <div class="alert alert-success" role="success">
        {{ session('success') }}
    </div>
    @endif
    <div>
        <h2>Ventas</h2>
        <div class="d-grid gap-2 d-md-flex justify-content-md-first">
            <a href="{{ route('ventas.create') }}" title="Nueva Venta"
            class="btn btn-sm btn-primary">Añadir Venta</a> <br>
            <a href="{{ route('ventas.reports_day') }}" title="Ventas Hoy"
            class="btn btn-sm btn-success">Ver Reporte por día</a>
            <a href="{{ route('ventas.reports_date') }}" title="Ventas por Rango de Fechas"
            class="btn btn-sm btn-success">Ver Reporte por Rango</a>
            <a href="{{ route('ventas.pdfAll') }}" title="Reporte"
            class="btn btn-sm btn-warning">Ver Reporte <i class="far fa-file-pdf"></i></a>
        </div><br>
        <div class="table-responsive">
            <table name="ventas" id="ventas" 
            class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                <thead class="bg-primary text-white" >
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col" title="Fecha de registro de la venta">Fecha_Venta</th>
                        <th scope="col" title="Total de la Venta">Total</th>
                        <th scope="col" title="Estado de la Venta">Estado</th>
                        <th scope="col" title="Tiempo que demoró la venta">Tiempo transcurrido</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ventas as $venta)
                        <tr>
                            <td>{{ $venta->id }}</td>
                            {{-- llamar la fecha de la venta --}}
                            <td title="Fecha de registro de la venta">{{ $venta->created_at }}</td>
<<<<<<< Updated upstream
                            <td title="Total de la Venta">{{ $venta->total }}</td>
=======
                            <td title="Total de la Venta">{{number_format($venta->total) }}</td>
>>>>>>> Stashed changes
                            @if ($venta->Estado == 'Pendiente')
                                    <td>
                                        <a class="jsgrid-button btn btn-danger" href="#" title="Pendiente" onclick="cambiarEstado({{ $venta->id }})">
                                            Pendiente <i class="fas fa-times" ></i></a>
                                    </td>
                                @else
                                    <td>
                                        <button type="button" disabled class="jsgrid-button btn btn-success" href="#" title="Pago" onclick="cambiarEstado({{ $venta->id }})">
                                        pagado <i class="fas fa-check" ></i></button>

                                    </td>
                                @endif
                            {{-- <td title="Tiempo que demoró la venta">{{ $venta->created_at->
                                diffForHumans($venta->updated_at) }}</td> --}}
                            <td title="Tiempo que demoró la venta">
                                {{
                                    $venta->created_at->diff($venta->updated_at)->
                                    format('El tiempo Transcurrido fue: %h horas, %i minutos y %s segundos')
                                }}
                            </td>
                            
                            <td>
                                <div class="form-check form-switch">
                                    <a href="{{ route('ventas.show', $venta) }}"class="btn btn-outline-dark btn-sm"
                                    title="Ver detalles"><i class="fas fa-fw fa-eye"></i></a>
                                    <a href="{{ route('ventas.pdf', $venta) }}" title="Ver PDF"
                                    class="btn btn-outline-dark btn-sm"><i class="fas fa-fw fa-file-pdf"></i></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @section('css')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    @endsection

    @section('js')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        {{-- <script src="{{asset('vendor/adminlte/dist/js/dash/alertaScasos.js')}}"></script> --}}


        @if (session('Crear') == 'Venta registrada exitosamente')
            <script>
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: 'Venta registrada correctamente',
                    showConfirmButton: false,
                    timer: 2000
                })
            </script>
        @endif


        {{-- <script>
            document.addEventListener('DOMContentLoaded', function() {
                const buttons = document.querySelectorAll('.cambiar-estado-btn');
                
                buttons.forEach(button => {
                    button.addEventListener('click', (event) => {
                        event.preventDefault();
                
                        const ventaId = event.currentTarget.getAttribute('href').split('/').pop();
                        const estado = event.currentTarget.getAttribute('data-estado');
                
                        Swal.fire({
                            title: 'Cambiar Estado de Venta',
                            text: '¿Estás seguro de cambiar el estado de la venta?',
                            showCancelButton: true,
                            confirmButtonText: 'Aceptar',
                            cancelButtonText: 'Cancelar',
                            icon: 'warning'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                axios.get(`/Cambiar_Estado/ventas/${ventaId}`)
                                    .then((response) => {
                                        Swal.fire('Éxito', response.data.success, 'success');
                                        this.submit();
                                        location.reload(); // Recarga la página para reflejar el cambio de estado
                                    })
                                    .catch((error) => {
                                        Swal.fire('Error', 'Ocurrió un error', 'error');
                                        console.error(error);
                                    });
                            } else if (result.dismiss === Swal.DismissReason.cancel) {
                                Swal.fire('Cancelado', 'El cambio de estado ha sido cancelado', 'info');
                            }
                        });
                    });
                });
            });
        </script> --}}

        <script>
            $(document).ready(function() {
                $('#ventas').DataTable( {
                    "order": [[3, "asc"]],
                    "language": {
                        "lengthMenu": "Mostrar _MENU_ registros por página",
                        "zeroRecords": "Busqueda no encontrada - disculpa",
                        "info": "Mostrando la pagina _PAGE_ de _PAGES_",
                        "infoEmpty": "No hay registros disponibles",
                        "infoFiltered": "(Filtrado de _MAX_ registros totales)",
                        "search": 'Buscar:',
                        "paginate": {
                            'next': 'Siguiente',
                            'previous': 'Anterior'
                        }
                    }
                } );
            } );


            function cambiarEstado(ventaId) {
                Swal.fire({
                icon: 'question',
                title: 'Confirmación',
                text: '¿Deseas cambiar el estado de la venta?',
                showCancelButton: true,
                confirmButtonText: 'Sí',
                cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Realizar la solicitud AJAX para cambiar el estado
                        axios.get(`/ventas/${ventaId}/change_status`)
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
                            Swal.fire('Cancelado', 'No se puede realizar esta acción', 'error');
                        });
                }
            });
        }
        </script>
    @endsection
@endsection
