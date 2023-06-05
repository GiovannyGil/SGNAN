@extends('adminlte::page')


@section('title', 'Dashboard')

@section('content_header')
<h3>Página Principal</h3>

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                {{-- PRODUCTOS --}}
                <div class="col-lg-2">
                    <div class="small-box bg-info" title="Productos registrados">
                        <div class="inner" title="Productos Registrados">
                            <h4 id="totalProductos">{{ $productsCount }}</h4>
                            <p>Productos Registrados</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i> 
                        </div>
                        <a href="/productos/" class="small-box-footer" title="Más informacion de los Productos">más Información  <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                {{-- VENTAS --}}
                <div class="col-lg-2">
                    <div class="small-box bg-warning" title="Total Ventas">
                        <div class="inner">
                            <h4 id="totalVentas">{{$SumaVentas}}</h4>
                            <p>Total Ventas</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-cash"></i>
                        </div>
                        <a href="/ventas/" class="small-box-footer" title="Más informacion de las Ventas">más Información  <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                {{-- COMPRAS --}}
                <div class="col-lg-2">
                    <div class="small-box bg-success" title="Empleados Registrados">
                        <div class="inner">
                            <h4 id="totalEmpleados">{{$employeesCount}}</h4>
                            <p>Empleados</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="/empleados/" class="small-box-footer" title="Más informacion de los Empleados">más Información  <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                {{-- TOTAL GANACIAS --}}
                <div class="col-lg-2">
                    <div class="small-box bg-danger" title="Cantidad Proveedores">
                        <div class="inner">
                            <h4 id="totalGanancias">{{ $provideersCount }}</h4>
                            <p>Cantidad Proveedores</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="/compras/" class="small-box-footer" title="Más informacion de las Compras">más Información  <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                {{-- PRODUCTOS CON POCO STOCK --}}
                <div class="col-lg-2">
                    <div class="small-box bg-primary" title="Insumos">
                        <div class="inner">
                            <h4 id="totalProductosMinSstock">{{ $suppliesCount }}</h4>
                            <p>Cantidad Insumos</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-clipboard"></i>
                        </div>
                        <a href="/productos/" class="small-box-footer" title="Más informacion de los Productos">más Información  <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                {{-- VENTAS DEL DÍA --}}
                <div class="col-lg-2">
                    <div class="small-box bg-dark" title="Total de las Ventas de Hoy">
                        <div class="inner">
                            <h4 id="totalVentasHoy">{{ $categoryCount }}</h4>
                            <p>Cantidad Categorías</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-clipboard"></i>
                            {{-- <i class="ion ion-clipboard"></i> --}}
                        </div>
                        <a href="/ventas/" class="small-box-footer" title="Más informacion de las Ventas">más Información  <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

    <div class="row">
        <div class="col-lg-6" title="Gráfico de Barras de las ventas por cada mes">
            <div class="card">
                <div class="card-body">
                    <h3>Ventas por Mes</h3>
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6" title="Gráfico de Barras de las Compras por cada mes">
            <div class="card">
                <div class="card-body">
                    <h3>Compras por Mes</h3>
                    <canvas id="purchasesChart"></canvas>
                </div>
            </div>
        </div>
        {{-- <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h3>Ventas/Compras</h3>
                    <canvas id="grafico"></canvas>
                </div>
            </div>
        </div> --}}
    </div>


    @section('css')
        <link rel="stylesheet" href="/css/admin_custom.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        {{-- icons --}}
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    @stop



    @section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

        function meses(id){
            let nombreSeleccion;
            let mesesNombre = ['Enero', 'Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
            for(let i = 0; i < mesesNombre.length; i++) {
                if(id == i){
                    nombreSeleccion = mesesNombre[i-1];
                }
            }

            return nombreSeleccion;
        }


    document.addEventListener('DOMContentLoaded', function () {
    var salesByMonth = {!! json_encode($salesByMonth) !!};
    var purchasesByMonth = {!! json_encode($purchasesByMonth) !!};
    var ventas = [{{ $totalSales }}];
    var compras = [{{ $totalPurchases }}];

    var months = [];
    var monthsOtra = [];
    var salesCounts = [];
    var purchaseCounts = [];



    salesByMonth.forEach(function (item) {
        months.push(meses(item.month));
        salesCounts.push(item.count);
    });

    purchasesByMonth.forEach(function (item) {
        monthsOtra.push(meses(item.month));
        purchaseCounts.push(item.count);
    });

    // compras y ventas por mes juntas
    

    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Ventas',
                data: salesCounts,
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        }
    });

        var ctx2 = document.getElementById('purchasesChart').getContext('2d');
        var purchasesChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: monthsOtra,
                datasets: [{
                    label: 'Compras',
                    data: purchaseCounts,
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }
                }
            }
        });

        var ctx = document.getElementById('grafico').getContext('2d');



    });
   
</script>


    @stop
@endsection