<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{-- estilos --}}

<style>
    body {
        /*position: relative;*/
        /*width: 16cm;  */
        /*height: 29.7cm; */
        /*margin: 0 auto; */
        /*color: #555555;*/
        /*background: #FFFFFF; */
        font-family: Arial, sans-serif;
        font-size: 14px;
        /*font-family: SourceSansPro;*/
    }
    #datos {
        float: left;
        margin-top: 0%;
        margin-left: 2%;
        margin-right: 2%;
        /*text-align: justify;*/
    }
    #encabezado {
        text-align: center;
        margin-left: 35%;
        margin-right: 35%;
        font-size: 15px;
    }
    #fact {
        /*position: relative;*/
        float: right;
        margin-top: 2%;
        margin-left: 2%;
        margin-right: 2%;
        font-size: 20px;
        background: #D2691E;
    }
    section {
        clear: left;
    }
    #cliente {
        text-align: left;
    }
    #facliente {
        width: 40%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
    }
    #fac,
    #fv,
    #fa {
        color: #FFFFFF;
        font-size: 15px;
    }
    #facliente thead {
        padding: 20px;
        background: #D2691E;
        text-align: left;
        border-bottom: 1px solid #FFFFFF;
    }
    #facvendedor {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
    }
    #facvendedor thead {
        padding: 20px;
        background: #D2691E;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;
    }
    #facproducto {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
    }
    #facproducto thead {
        padding: 20px;
        background: #D2691E;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;
    }
</style>

{{-- fin estilos --}}

<header>
    {{--  <div id="logo">
        <img src="{{asset($company->logo)}}" alt="" id="imagen">
    </div>  --}}
    <div>
        <table id="datos">
            <thead>
                <tr>
                    <th id="">DATOS DEL VENDEDOR</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>
                        <p id="proveedor">
                            {{-- traer el nombre del empleado que estaba encargado de la venta con un foreach --}}
                            Nombre: 
                            @foreach ($empleados as $empleado)
                                @if($empleado->id == $venta->id_empleado)
                                    {{$empleado->Nombre}}
                                @endif
                            @endforeach
                            <br>
                            Documento:
                            @foreach ($empleados as $empleado)
                                @if($empleado->id == $venta->id_empleado)
                                    {{$empleado->Documento}}
                                @endif
                            @endforeach
                            
                        </p>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
</header>
<br>
<br>
<section>
    <div>
        <table id="facproducto">
            <thead>
                <tr id="fa">
                    <th>PRODUCTO</th>
                    <th>CANTIDAD</th>
                    <th>PRECIO VENTA(PEN)</th>
                    <th>SUBTOTAL(PEN)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detalleVenta as $detalle)
                    <tr>
                        <td>
                            {{-- traer el nombre del producto con un foreach --}}
                            @foreach ($productos as $producto)
                                @if($producto->id == $detalle->id_producto)
                                    {{$producto->NombreProducto}}
                                @endif
                            @endforeach
                        </td>
                        <td>{{$detalle->Cantidad}}</td>                        
                        <td>s/{{$detalle->Precio}}</td>
                        <td>s/{{number_format($detalle->Cantidad*$detalle->Precio)}}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4">
                        <p align="right">TOTAL PAGAR:</p>
                    </th>
                    <td>
                        <p align="right">s/ {{number_format($venta->total,2)}}</p>
                    </td>
                </tr>


            </tfoot>
        </table>
    </div>
</section>
<br>
<br>
</body>
</html>

