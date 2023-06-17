@extends('adminlte::page')

    @section('title', 'Dashboard')

    @section('content_header')
    <h3>Página Principal</h3>
    @endsection

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
                            <a href="/productos/" class="small-box-footer" title="Más informacion de los Productos">
                                más Información  <i class="fas fa-arrow-circle-right"></i></a>
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
                            <a href="/ventas/" class="small-box-footer" title="Más informacion de las Ventas">
                                más Información  <i class="fas fa-arrow-circle-right"></i></a>
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
                            <a href="/empleados/" class="small-box-footer" title="Más informacion de los Empleados">
                                más Información  <i class="fas fa-arrow-circle-right"></i></a>
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
                            <a href="/compras/" class="small-box-footer" title="Más informacion de las Compras">
                                más Información  <i class="fas fa-arrow-circle-right"></i></a>
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
                            <a href="/productos/" class="small-box-footer" title="Más informacion de los Productos">
                                más Información  <i class="fas fa-arrow-circle-right"></i></a>
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
                            <a href="/ventas/" class="small-box-footer" title="Más informacion de las Ventas">
                                más Información  <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            

        <div class="row">
            <div hidden id="salesCountsData" data-sales-counts="{{ json_encode($salesCounts) }}"></div>
            <div hidden id="comprasCountsData" data-compras-counts="{{ json_encode($comprasCounts) }}"></div>

            <div class="col-lg-6" title="Gráfico de Barras de las Compras por cada mes">
                <div class="card">
                    <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                        <h3 class="card-title">
                        <i class="fas fa-th mr-1"></i>
                        Ventas por Días a la Semana
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            
                        </div>
                    </div>
                    <div class="card-body">
                        
                        <canvas id="ventasChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-6" title="Gráfico de Barras de las Compras por cada mes">
                <div class="card">
                    <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                        <h3 class="card-title">
                        <i class="fas fa-th mr-1"></i>
                        Compras por Días a la Semana
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            
                        </div>
                    </div>
                    <div class="card-body">
                        
                        <canvas id="comprasChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div hidden id="salesByMonthData" data-sales="{{ json_encode($salesByMonth) }}"></div>
            <div hidden id="purchasesByMonthData" data-purchases="{{ json_encode($purchasesByMonth) }}"></div>
        
            <div class="col-lg-6" title="Gráfico de Barras de las Compras por cada mes">
                <div class="card">
                    <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                        <h3 class="card-title">
                        <i class="fas fa-th mr-1"></i>
                        Ventas por Mes
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            
                        </div>
                    </div>
                    <div class="card-body">
                        
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-6" title="Gráfico de Barras de las Compras por cada mes">
                <div class="card">
                    <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                        <h3 class="card-title">
                        <i class="fas fa-th mr-1"></i>
                        Compras por Mes
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            
                        </div>
                    </div>
                    <div class="card-body">
                        
                        <canvas id="purchasesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

 

        {{-- <div class="row">
            <div class="col-lg-6" title="Gráfico del total de ventas por cada mes">
                <div class="card">
                    <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                        <h3 class="card-title">
                        <i class="fas fa-th mr-1"></i>
                        Total Ventas por Mes
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            
                        </div>
                    </div>
                    <div class="card-body">
                        
                        <canvas id="graficoVentasPorMes"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" title="Gráfico del total compras por cada mes">
                <div class="card">
                    <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                        <h3 class="card-title">
                        <i class="fas fa-th mr-1"></i>
                        Total Compras por Mes
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            
                        </div>
                    </div>
                    <div class="card-body">
                        
                        <canvas id="graficoComprasPorMes"></canvas>
                    </div>
                </div>
            </div>
        </div> --}}


        @section('css')
            <link rel="stylesheet" href="/css/admin_custom.css">
            <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            {{-- icons --}}
            <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">

        @endsection



        @section('js')
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
            <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>

            <script src="{{asset('vendor/adminlte/dist/js/dash/meses.js')}}"></script>
            <script src="{{asset('vendor/adminlte/dist/js/dash/semanas.js')}}"></script>
            <script src="{{asset('vendor/adminlte/dist/js/dash/total.js')}}"></script>
            <script src="{{asset('vendor/adminlte/dist/js/dash/alertaScasos.js')}}"></script>
            {{-- <script>
                function verificarInsumosAgotados() {
                    fetch('/verificar-insumos-agotados')
                        .then(response => response.json())
                        .then(data => {
                            if (data.message === '¡Hay insumos agotados!') {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'warning',
                                    title: '¡Alerta de insumos agotados!',
                                    text: 'Hay insumos agotados. Por favor, revisa la Cantidad de los insumos y adquirir más.',
                                    showConfirmButton: false,
                                    timer: 3600000 // 1 hora
                                });
                            }
                        });
                }

                setInterval(verificarInsumosAgotados, 5000); // Ejecutar cada 5 segundos

            
            </script> --}}
        @endsection
    @endsection
