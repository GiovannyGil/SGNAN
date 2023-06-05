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
        <table id="compras"  class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
            <thead class="bg-primary text-white">
                <tr>
                    <th scope="col">Proveedor</th>
                    <th scope="col">Referencia</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Fecha_Compra</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($compras as $compra)
                    <tr>
                        <td scope="row">{{$compra->id_proveedores}}</td>
                        <td scope="row">{{$compra->Referencia_compra}}</td>
                        <td scope="row">{{$compra->Descripcion_compra}}</td>
                        <td scope="row">{{$compra->created_at}}</td>
                        <td scope="row">{{$compra->total}}</td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>