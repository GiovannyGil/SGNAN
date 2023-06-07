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
                <a href="{{ route('ventas.create') }}" title="Nueva Venta" class="btn btn-sm btn-primary">Añadir Venta</a> <br>
                <a href="{{ route('ventas.reports_day') }}" title="Ventas Hoy" class="btn btn-sm btn-success">Ver Reporte por dia</i></a>
                <a href="{{ route('ventas.reports_date') }}" title="Ventas por Rango de Fechas"  class="btn btn-sm btn-success">Ver Reporte por Rango</i></a>
                <a href="{{ route('ventas.pdfAll') }}" title="Reporte"  class="btn btn-sm btn-warning">Ver Reporte <i class="far fa-file-pdf"></i></a>
            </div><br>
            <div class="table-reponsive">
                <table id="ventas"  class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                    <thead class="bg-primary text-white">
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
                                <td scope="row">{{$venta->id}}</td>
                                {{-- llamar la fecha de la venta --}}
                                <td title="Fecha de registro de la venta">{{$venta->created_at}}</td>
                                <td title="Total de la Venta">{{$venta->total}}</td>
                                @if ($venta->Estado == 'Pendiente')
                                    <td>
                                        <a class="jsgrid-button btn btn-danger" href="{{route('Cambiar.Estado.ventas', $venta)}}" title="Pendiente">
                                            Pendiente <i class="fas fa-times"></i></a>
                                    </td>
                                @else
                                    <td>
                                        <button type="button" class="jsgrid-button btn btn-success" href="#" title="Pago">
                                        pagado <i class="fas fa-check"></i></button>

                                    </td>
                                @endif

                                <td title="Tiempo que demoró la venta">{{ $venta->created_at->diffForHumans($venta->updated_at) }}</td> <!-- Tiempo transcurrido -->
                                <td>
                                        <div class="form-check form-switch">
                                                <a href="{{ route('ventas.show',$venta) }}" class="btn btn-outline-info"
                                                title="Ver detalles"><i class="far fa-eye"></i></a>
                                                <a href="{{ route('ventas.pdf',$venta) }}" title="Ver PDF" class="jsgrid-button jsgrid-edit-button">
                                                <i class="far fa-file-pdf"></i></a>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    @endsection

    @section('js')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

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

    @endsection
@endsection
