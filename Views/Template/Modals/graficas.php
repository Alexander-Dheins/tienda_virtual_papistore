<?php 
	
	if($grafica = "tipoPagoMes"){
		$pagosMes = $data;
 ?>
<script>
	Highcharts.chart('pagosMesAnio', {
	      chart: {
	          plotBackgroundColor: null,
	          plotBorderWidth: null,
	          plotShadow: false,
	          type: 'pie'
	      },
	      title: {
	          text: 'Ventas por tipo pago, <?= $pagosMes['mes'].' '.$pagosMes['anio'] ?>'
	      },
	      tooltip: {
	          pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
	      },
	      accessibility: {
	          point: {
	              valueSuffix: '%'
	          }
	      },
	      plotOptions: {
	          pie: {
	              allowPointSelect: true,
	              cursor: 'pointer',
	              dataLabels: {
	                  enabled: true,
	                  format: '<b>{point.name}</b>: {point.percentage:.1f} %'
	              }
	          }
	      },
	      series: [{
	          name: 'Brands',
	          colorByPoint: true,
	          data: [
	          <?php 
	            foreach ($pagosMes['tipospago'] as $pagos) {
	              echo "{name:'".$pagos['tipopago']."',y:".$pagos['total']."},";
	            }
	           ?>
	          ]
	      }]
	});

</script>
<?php } ?>
<?php 
	if($grafica = "ventasMes"){
		$ventasMes = $data;
 ?>
<script>
	  Highcharts.chart('graficaMes', {
	      chart: {
	          type: 'line'
	      },
	      title: {
	          text: 'Ventas de <?= $ventasMes['mes'].' del '.$ventasMes['anio'] ?>'
	      },
	      subtitle: {
	          text: 'Total Ventas <?= SMONEY.'. '.formatMoney($ventasMes['total']) ?> '
	      },
	      xAxis: {
	          categories: [
	            <?php 
	                foreach ($ventasMes['ventas'] as $dia) {
	                  echo $dia['dia'].",";
	                }
	            ?>
	          ]
	      },
	      yAxis: {
	          title: {
	              text: ''
	          }
	      },
	      plotOptions: {
	          line: {
	              dataLabels: {
	                  enabled: true
	              },
	              enableMouseTracking: false
	          }
	      },
	      series: [{
	          name: '',
	          data: [
	            <?php 
	                foreach ($ventasMes['ventas'] as $dia) {
	                  echo $dia['total'].",";
	                }
	            ?>
	          ]
	      }]
	  });
</script>
 <?php } ?>

 <?php 
	if($grafica = "ventasAnio"){
		$ventasAnio = $data;
 ?>
 <script>
 	Highcharts.chart('graficaAnio', {
      chart: {
          type: 'column'
      },
      title: {
          text: 'Ventas del año <?= $ventasAnio['anio'] ?> '
      },
      subtitle: {
          text: 'Esdística de ventas por mes'
      },
      xAxis: {
          type: 'category',
          labels: {
              rotation: -45,
              style: {
                  fontSize: '13px',
                  fontFamily: 'Verdana, sans-serif'
              }
          }
      },
      yAxis: {
          min: 0,
          title: {
              text: ''
          }
      },
      legend: {
          enabled: false
      },
      tooltip: {
          pointFormat: 'Population in 2017: <b>{point.y:.1f} millions</b>'
      },
      series: [{
          name: 'Population',
          data: [
            <?php 
              foreach ($ventasAnio['meses'] as $mes) {
                echo "['".$mes['mes']."',".$mes['venta']."],";
              }
             ?>                 
          ],
          dataLabels: {
              enabled: true,
              rotation: -90,
              color: '#FFFFFF',
              align: 'right',
              format: '{point.y:.1f}', // one decimal
              y: 10, // 10 pixels down from the top
              style: {
                  fontSize: '13px',
                  fontFamily: 'Verdana, sans-serif'
              }
          }
      }]
  });
 </script>

 <?php } ?>