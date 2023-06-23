<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<style>
body {
  position: relative;
  width: 16cm; 
  height: 29.7cm;
  margin: 0 auto;
  color: #555555;
  background: #FFFFFF;
  font-family: Arial, sans-serif;
  font-size: 14px;
  font-family: SourceSansPro;
}
#datos {
  float: left;
  margin-top: 0%;
  margin-left: 2%;
  margin-right: 2%;
  text-align: justify;
}
#encabezado {
  text-align: center;
  margin-left: 35%;
  margin-right: 35%;
  font-size: 15px;
}
#fact {
  position: relative;
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
.bb{
   width: 25%;
   text-align: left;
   vertical-align: top;
   border: 1px solid #000;
   text-align: center;
}
</style>
<body>
<header>
    <div>
        <table id="datos">
            <thead>
                <tr>
                    <th id="">DATOS DE LA EMPRESA</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>
                        <p id="proveedor">
                            {{-- traer el nombre del empleado que estaba encargado de la venta con un foreach --}}
                            Nombre: <b>DECLICIAS NAN </b>
                            <br>
                            Reporte: <b>Todas la ventas existente</b>
                        </p>
                          <p><b>TOTAL: s/ {{number_format($SumaVentas)}}</b></p>
                    
                    </th>
                    
                </tr>
                
              
            </tbody>
        </table>
    </div>
</header>
<br><br>
<section>
    <div>
        <table  id="facproducto">
            <thead>
                <tr>
                    <th id="campo">ID</th>
                    <th id="campo">Fecha_Venta</th>
                    <th id="campo">Total</th>
                    <th id="campo">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $venta)
                    <tr class="bb">
                        <td class="bb">{{$venta->id}}</td>
                        {{-- llamar la fecha de la venta --}}
                        <td class="bb">{{$venta->created_at}}</td>
                        <td class="bb">{{$venta->total}}</td>
                        @if ($venta->Estado == 'Pendiente')
                            <td class="bb">
                                <a class=""
                                href="#" title="Editar">
                                    Pendiente <i class="fas fa-times"></i></a>
                            </td>
                        @else
                            <td class="bb">
                                <button type="button" disabled class=""
                                href="#" title="Editar">
                                pagado <i class="fas fa-check"></i></button>

                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th id="campo" colspan="4">
                        <p>TOTAL:</p>
                    </th>
                    <td>
                        <p>s/ {{number_format($SumaVentas,2)}}</p>
                    </td>
                </tr>


            </tfoot>
        </table>
    </div>
</section>

</body>
</html>


