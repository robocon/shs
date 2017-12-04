<?php
		
		include("connect.inc");
		$sql="SELECT * FROM armychkup limit 0,10";
		$query=mysql_query($sql);
		while($data = mysql_fetch_array($query)){
			
			$result[] = $data;
		}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="windows-874">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>การใช้งาน Highcharts JS With PHP MySQL</title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="armychart/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <meta http-equiv="Content-Type" content="text/html; charset=windows-874"></head>
  <body>
    <h1>Hello, world! ข้อมูลทดสอบ</h1>

		<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
		
		<table class="table" id="datatable">
			<thead>
				<tr>
					<th></th>
					<th>ประชากรหญิง</th>
					<th>ประชากรชาย</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($result as $result_tb){
						echo"<tr>";
							echo "<td>".$result_tb['ptname']."</td>";
							echo "<td>".$result_tb['weight']."</td>";
							echo "<td>".$result_tb['height']."</td>";
							
						echo"</tr>";
					}
				?>
			
			</tbody>
		</table>

		
	<script src="armychart/jquery-1.12.0.min.js"></script>
	<script src="armychart/highcharts.js"></script>
	<script src="armychart/data.js"></script>
	<script src="armychart/exporting.js"></script>
	
	<script>
	
	$(function () {
				
		$('#container').highcharts({
			data: {
				//กำหนดให้ ตรงกับ id ของ table ที่จะแสดงข้อมูล
				table: 'datatable'
			},
			chart: {
				type: 'column'
			},
			title: {
				text: 'ข้อมูลจำนวนประชากรของแต่ละจังหวัด'
			},
			yAxis: {
				allowDecimals: false,
				title: {
					text: 'Units'
				}
			},
			
			tooltip: {
				formatter: function () {
					return '<b>' + this.series.name + '</b><br/>' +
						this.point.y; + ' ' + this.point.name.toLowerCase();
				}
			}
		});
	});
	
	</script>
	
  </body>
</html>






