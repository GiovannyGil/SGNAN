
    var totalesPorMesDataElement = document.getElementById('totalesPorMesData');
    var totalesPorMesComprasDataElement = document.getElementById('totalesPorMesComprasData');
    var mesesDataElement = document.getElementById('mesesData');
    var mesesComprasDataElement = document.getElementById('mesesComprasData');

    var totalesPorMes = JSON.parse(totalesPorMesDataElement.dataset.totales);
    var totalesPorMesCompras = JSON.parse(totalesPorMesComprasDataElement.dataset.totalesCompras);
    var meses = JSON.parse(mesesDataElement.dataset.meses);
    var mesesCompras = JSON.parse(mesesComprasDataElement.dataset.mesesCompras);

    var ctx1 = document.getElementById('graficoVentasPorMes').getContext('2d');
    var graficoVentasPorMes = new Chart(ctx1, {
        type: 'polarArea',
        data: {
            labels: meses,
            datasets: [{
                label: 'Total por mes',
                data: totalesPorMes,
                backgroundColor: [
                    'rgba(153, 102, 255, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                    'rgba(255, 159, 64, 0.8)'
                ],
                borderColor: [
                    'rgba(153, 102, 255)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var ctx2 = document.getElementById('graficoComprasPorMes').getContext('2d');
    var graficoComprasPorMes = new Chart(ctx2, {
        type: 'polarArea',
        data: {
            labels: mesesCompras,
            datasets: [{
                label: 'Total de compras por mes',
                data: totalesPorMesCompras,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                    'rgba(255, 159, 64, 0.8)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

