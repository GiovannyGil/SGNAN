 // var salesByDayOfWeek = {!! json_encode($salesByDayOfWeek) !!};
 var diasSemana = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
 var colors = ['rgba(75, 192, 192, 0.8)', 'rgba(255, 99, 132, 0.8)', 'rgba(54, 162, 235, 0.8)', 'rgba(255, 205, 86, 0.8)', 'rgba(153, 102, 255, 0.8)', 'rgba(255, 159, 64, 0.8)', 'rgba(201, 203, 207, 0.8)'];
 

//  var salesCounts = {!! json_encode($salesCounts) !!};
//  var comprasCounts = {!! json_encode($comprasCounts) !!};

var salesCountsDataElement = document.getElementById('salesCountsData');
var comprasCountsDataElement = document.getElementById('comprasCountsData');

var salesCounts = JSON.parse(salesCountsDataElement.dataset.salesCounts);
var comprasCounts = JSON.parse(comprasCountsDataElement.dataset.comprasCounts);



 var ctx = document.getElementById('ventasChart').getContext('2d');
 var salesChart = new Chart(ctx, {
     type: 'bar',
     data: {
         labels: diasSemana,
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


 var ctx = document.getElementById('comprasChart').getContext('2d');
 var comprasChart = new Chart(ctx, {
     type: 'bar',
     data: {
         labels: diasSemana,
         datasets: [{
             label: 'Compras',
             data: comprasCounts,
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
