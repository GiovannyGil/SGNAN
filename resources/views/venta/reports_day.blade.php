@extends('adminlte::page')

@section('title', 'Reportes por día')

@section('content_header')
@stop

@section('content')

@if (session('success'))
<div class="alert alert-success" role="success">
    {{ session('success') }}
</div>

@endif

<div>
    <h2>Reporte de Ventas</h2>
    <div class="row">
        <div class="col-12 col-md-3 text-center" title="Fecha Actual">
            <span>Fecha Consulta: <b></b></span>
            <div class="form-group">
                <strong>{{\Carbon\Carbon::now()->format('d/m/Y')}}</strong>
            </div>
        </div>
        <div class="col-12 col-md-3 text-center" title="Cantidad de Ventas">
            <span>Cantidad de Registros: <b></b></span>
            <div class="form-group">
                <strong>{{$ventas->count()}}</strong>
            </div>
        </div>
        <div class="col-12 col-md-3 text-center" title="Valor total Ventas">
            <span>Total Ingresos: <b></b></span>
            <div class="form-group">
                <strong>{{$total}}</strong>
            </div>
        </div>
        <div class="col-12 col-md-3  text-center">
            <div class="form-group">
                    <a href="/ventas" class="btn btn-primary float-right">Volver</a>
            </div>
        </div>
    </div>
        <div class="table-reponsive">

            <table id="ventas"  class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                <thead class="bg-primary text-white">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col" title="Fecha de la Venta">Fecha_Venta</th>
                        <th scope="col" title="Valor de la Venta">Total</th>
                        <th scope="col" title="Estado de la Venta">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ventas as $venta)
                        <tr>
                            <td>{{$venta->id}}</td>
                            {{-- llamar la fecha de la venta --}}
                            <td title="Fecha de la Venta">{{$venta->created_at}}</td>
                            <td title="Valor de la Venta">{{number_format($venta->total,2) }}</td>
                            @if ($venta->Estado == 'Pendiente')
                                <td>
                                    <a class="jsgrid-button btn btn-danger"
                                    href="#">
                                        Pendiente <i class="fas fa-times" title="Estado de la Venta"></i></a>
                                </td>
                            @else
                                <td  title="Estado de la Venta">
                                    <button type="button" disabled class="jsgrid-button btn btn-success"
                                    href="#"  title="Estado de la Venta">
                                    pagado <i class="fas fa-check"></i></button>

                                </td>
                            @endif
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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#ventas').DataTable({
                "lenghtMenu": [[5,10,50,-1], [5,10,50,"All"]]
            });
        });
    </script>
    @endsection
@endsection