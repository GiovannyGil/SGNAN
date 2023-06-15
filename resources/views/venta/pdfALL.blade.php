<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <div class="table-reponsive">
        <table id="ventas" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
            <thead class="bg-primary text-white">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Fecha_Venta</th>
                    <th scope="col">Total</th>
                    <th scope="col">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $venta)
                    <tr>
                        <td>{{$venta->id}}</td>
                        {{-- llamar la fecha de la venta --}}
                        <td>{{$venta->created_at}}</td>
                        <td>{{$venta->total}}</td>
                        @if ($venta->Estado == 'Pendiente')
                            <td>
                                <a class="jsgrid-button btn btn-danger"
                                href="{{route('Cambiar.Estado.ventas', $venta)}}" title="Editar">
                                    Pendiente <i class="fas fa-times"></i></a>
                            </td>
                        @else
                            <td>
                                <button type="button" disabled class="jsgrid-button btn btn-success"
                                href="{{route('Cambiar.Estado.ventas', $venta)}}" title="Editar">
                                pagado <i class="fas fa-check"></i></button>

                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>