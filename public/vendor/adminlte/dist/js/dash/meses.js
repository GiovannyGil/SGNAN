
function meses(id) {
    let nombreSeleccion;
    let mesesNombre = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    nombreSeleccion = mesesNombre[id - 1];
    return nombreSeleccion;
    }
    var colors = [
        'rgba(75, 192, 192, 0.8)',
        'rgba(255, 99, 132, 0.8)',
        'rgba(54, 162, 235, 0.8)',
        'rgba(255, 205, 86, 0.8)',
        'rgba(153, 102, 255, 0.8)',
        'rgba(255, 159, 64, 0.8)',
        'rgba(201, 203, 207, 0.8)',
    ];

    document.addEventListener('DOMContentLoaded', function () {
        var salesByMonthDataElement = document.getElementById('salesByMonthData');
        var purchasesByMonthDataElement = document.getElementById('purchasesByMonthData');
    
        var salesByMonth = JSON.parse(salesByMonthDataElement.dataset.sales);
        var purchasesByMonth = JSON.parse(purchasesByMonthDataElement.dataset.purchases);
    
       
        var salesData = [];
        var purchasesData = [];

        // Inicializar los arreglos con cero para los 12 meses
        for (let month = 1; month <= 12; month++) {
            salesData[month] = 0;
            purchasesData[month] = 0;
        }

        // Asignar los valores de ventas por mes al arreglo correspondiente
        salesByMonth.forEach(function (item) {
            salesData[item.month] = item.count;
        });

        // Asignar los valores de compras por mes al arreglo correspondiente
        purchasesByMonth.forEach(function (item) {
            purchasesData[item.month] = item.count;
        });

        var months = [];
        var salesCounts = [];
        var purchaseCounts = [];

        // Generar los datos ordenados para el gráfico de ventas
        for (let month = 1; month <= 12; month++) {
            months.push(meses(month));
            salesCounts.push(salesData[month]);
        }

        // Generar los datos ordenados para el gráfico de compras
        for (let month = 1; month <= 12; month++) {
            purchaseCounts.push(purchasesData[month]);
        }

        // Añadir diciembre al final de los meses
        months.push(meses(12));
        salesCounts.push(salesData[12]);
        purchaseCounts.push(purchasesData[12]);

        // Generar el gráfico de ventas
        var ctx = document.getElementById('salesChart').getContext('2d');
        var salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Ventas',
                    data: salesCounts,
                    backgroundColor: colors,
                    borderColor: colors,
                    borderWidth: 2
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

        // Generar el gráfico de compras
        var ctx2 = document.getElementById('purchasesChart').getContext('2d');
        var purchasesChart = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Compras',
                    data: purchaseCounts,
                    backgroundColor: colors,
                    borderColor: colors,
                    borderWidth: 2
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
});