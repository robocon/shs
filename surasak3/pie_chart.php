<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>การใช้งาน Highcharts JS With PHP MySQL</title>

<link rel="stylesheet" href="armychart/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
  <body>
    <h1>Hello, world! ข้อมูลทดสอบ</h1>

		<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
		
	<script src="armychart/jquery-1.12.0.min.js"></script>
	<script src="armychart/highcharts.js"></script>
	<script src="armychart/data.js"></script>
	<script src="armychart/exporting.js"></script>
	
	<script>

		$(function () {
			
			$.getJSON("data.php",function(data){
				
				seriesData = data;
				
					$('#container').highcharts({
							chart: {
								plotBackgroundColor: null,
								plotBorderWidth: null,
								plotShadow: false,
								type: 'pie'
							},
							title: {
								text: 'สรุปประชากรทั้งหมด'
							},
							tooltip: {
								pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
							},
							plotOptions: {
								pie: {
									allowPointSelect: true,
									cursor: 'pointer',
									dataLabels: {
										enabled: true,
										//format: '<b>{point.name}</b>: {point.percentage:.1f} %',
										format: '<b>{point.name}</b>: {point.y} คน',
										style: {
											color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
										}
									}
								}
							},
							series: [{
								name: 'จำนวน',
								colorByPoint: true,
								data: seriesData

							}]
						});
			});
			
		});
	</script>
	
  </body>
</html>






