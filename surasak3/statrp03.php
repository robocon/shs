<?php
require("fpdf/fpdf.php");
require("fpdf/pdf.php");

require("connect.php");

$month_ = array(
	'01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', '05' => 'พฤษภาคม', '06' => 'มิถุนายน', 
	'07' => 'กรกฏาคม', '08' => 'สิงหาคม', '09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม'
);

$day = sprintf("%02d", $_GET["day"]);
$month = sprintf("%02d", $_GET["month"]);
$year = sprintf("%02d", $_GET["year"]);

$doctor = $_GET["doctor"];
$code = $_GET["code"];

// var_dump($day);
// var_dump($month);
// var_dump($year);

// exit;

// if($_GET["day"] != ""){
// 	$_GET["day"] = sprintf("%02d",$_GET["day"]);
// }
	


$time_zone = explode("-",$_GET["time"]);
	
if($code == "58001"){
	$where = " AND doctor like '".$doctor."%' AND (code like '".$code."%' OR code like '58020%') ";
}else{
	$where = " AND code like '".$code."%' ";
}

if($code == "58001" OR $code == "58000" ){ //ฝังเข็ม

	// $pdf = new PDF('P' ,'mm','A4');
	// $pdf->SetThaiFont();
	// $pdf->SetMargins(10, 10);
	// $pdf->AddPage();
	// $pdf->SetFont('AngsanaNew', '', 14);

	$sql = "SELECT hn, ptname, idno, date, detail 
	FROM patdata 
	WHERE hn != '' 
	AND ( date between '$year-$month-$day ".$time_zone[0]."' AND '$year-$month-$day ".$time_zone[1]."') 
	$where 
	Group by hn Having sum(amount) > 0 
	Order by date ASC 
	limit 70 ";

	// file_put_contents('logs/mysql-query.log', $sql, FILE_APPEND);
	
	$result2  = Mysql_Query($sql) or die( mysql_error() );
	
	$txt = "คลินิกนอกเวลาราชการ (ฝังเข็ม) เวลา ";
	switch($_GET["time"]){
		case "07:30:00-12:30:00" : $txt .= "08.00 - 12.00"; break;
		case "16:20:00-21:00:00" : $txt .= "16.30 - 20.30"; break;
		case "08.00:00-16:00:00" : $txt .= "08.00 - 16.00"; break;
		case "16:00:01-20:30:00" : $txt .= "16.00 - 20.00"; break;
	}

	// $pdf->Cell(0,7,$txt,0,0,'C');
	// $pdf->Ln();
	// $pdf->Cell(0,7,"วันที่ ".$_GET["day"]." ".$month_[$_GET["month"]]." ".$_GET["year"],0);
	// $pdf->Ln();
	// $pdf->Cell(10,7,"ลำดับ",1,0,'C');
	// $pdf->Cell(100,7,"ชื่อ - สกุล ผู้รับบริการ",1,0,'C');
	// $pdf->Cell(30,7,"HN",1,0,'C');
	// $pdf->Cell(30,7,"โรค",1,0,'C');
	// $pdf->Ln();
	?>
	<style type="text/css">
		body, th, td{
			font-family: 'TH SarabunPSK';
			font-size: 20px;
		}
		.main-contain{
			width: 80%;
		}
		@media screen and (max-width: 992px){
			.main-contain{
				width: 100%;
			}
		}
		@media print{
			.main-contain{
				width: 100%;
			}
			.fix-head, .fix-bottom{
				display: table-header-group;
			}
		}
	</style>
	<div class="main-contain">
		<div class="fix-head">
			<div style="text-align: center;">
				<p><?=$txt;?></p>
			</div>
			<div>
				<p><?php echo "วันที่ ".$_GET["day"]." ".$month_[$_GET["month"]]." ".$_GET["year"];?></p>
			</div>
		</div>
		<div>
			<table width="100%" border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
				<thead>
					<tr>
						<th>ลำดับ</th>
						<th>ชื่อ - สกุล ผู้รับบริการ</th>
						<th>HN</th>
						<th>โรค</th>
					</tr>
				</thead>
				<tbody>
					<?php
					
					$i=1;
					while(list($hn,$ptname,$idno,$date,$detail) = mysql_fetch_row($result2)){	
						
						$sql = "SELECT `diag` 
						FROM `depart` 
						WHERE `row_id` = '$idno'";
						$query = mysql_query($sql) or die( mysql_error() );
						$res = mysql_fetch_assoc($query);
					
					?>
					<tr>
						<td width="5%" align="center"><?=$i;?></td>
						<td><?=$ptname;?></td>
						<td align="center"><?=$hn;?></td>
						<td align="center"><?=$res['diag'];?></td>
					</tr>
					<?php
						$i++;
					}
					?>
				</tbody>
			</table>
		</div>
		<div style="padding: 0.5em;"></div>
		<div class="fix-bottom">
			<table width="100%" border="0" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
				<tbody>
					<tr>
						<td width="50%">ผู้บันทึก</td>
						<td width="50%">นาย</td>
					</tr>
					<tr>
						<td><span style="padding-left: 50px;"></span>(<span style="padding: 0 80px;"></span>)</td>
						<td><span style="padding-left: 50px;"></span>(<span style="padding: 0 80px;"></span>)</td>
					</tr>
					<tr>
						<td><span style="padding-left: 65px;"></span>เจ้าหน้าที่คลินิกฝังเข็ม</td>
						<td><span style="padding-left: 95px;"></span>แพทย์ผู้รักษา</td>
					</tr>
					<tr>
						<td><span style="padding-left: 65px;"></span>........../........../..........</td>
						<td><span style="padding-left: 80px;">........../........../..........</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<?php
	exit;
	$i=1;
	while(list($hn,$ptname,$idno) = mysql_fetch_row($result2)){	
		
		$sql = "SELECT `diag` 
		FROM `depart` 
		WHERE `row_id` = '$idno'";
		$query = mysql_query($sql) or die( mysql_error() );
		$res = mysql_fetch_assoc($query);
	
		// $pdf->Cell(10,7,$i,1,0,'C');
		// $pdf->Cell(100,7,$ptname,1,0);
		// $pdf->Cell(30,7,$hn,1,0,'C');
		
		// $pdf->Cell(30,7,$res['diag'],1,0,'C');
		// $pdf->Ln();
		$i++;
	}
	
	// $pdf->Ln();
	
	// $pdf->Cell(20,7,"ผู้บันทึก",0,0,'C');
	// if($doctor=="MD115"){
	// 	$pdf->Cell(100,7,"นาย",0,0,'R');
	// }else{
	// 	$pdf->Cell(100,7,"พ.อ.",0,0,'R');
	// }
	// $pdf->Ln();
	
	// $pdf->Cell(65,7,"(                                          )",0,0,'C');
	// $pdf->Cell(90,7,"(                                          )",0,0,'R');
	// $pdf->Ln();
	
	// $pdf->Cell(66,7,"เจ้าหน้าที่คลินิกฝังเข็ม",0,0,'C');
	// $pdf->Cell(140,7,"แพทย์ผู้รักษา",0,0,'C');
	// $pdf->Ln();
	
	// $pdf->Cell(65,7,"........../........../..........",0,0,'C');
	// $pdf->Cell(140,7,"........../........../..........",0,0,'C');
	// $pdf->Ln();
	//ฝังเข็ม
	
	
}else{
	
	
$pdf = new PDF('L' ,'mm','A4');

$pdf->SetThaiFont();

$pdf->SetMargins(10, 10);

$pdf->AddPage();

$pdf->SetFont('AngsanaNew', '', 14);

//นวดแผนไทย

/*$sql = "
	SELECT DISTINCT a.hn, a.ptname
	FROM (

	SELECT hn, ptname, date
	FROM patdata
	WHERE (
	date
	BETWEEN '".$_GET["year"]."-".$_GET["month"]."-".$_GET["day"]." ".$time_zone[0]."' AND '".$_GET["year"]."-".$_GET["month"]."-".$_GET["day"]." ".$time_zone[1]."'
	) ".$where."
	) AS a
	INNER JOIN (

	SELECT hn
	FROM opacc
	WHERE date
	LIKE '".$_GET["year"]."-".$_GET["month"]."-".$_GET["day"]."%' AND depart = 'PHYSI'
	) AS b ON a.hn = b.hn
	Order by a.date ASC limit 80 
";*/


 $sql = "SELECT date,hn, ptname,ptright  FROM patdata WHERE hn != '' AND ( date between '".$_GET["year"]."-".$_GET["month"]."-".$_GET["day"]." ".$time_zone[0]."' AND '".$_GET["year"]."-".$_GET["month"]."-".$_GET["day"]." ".$time_zone[1]."')   ".$where." Group by hn Having sum(amount)  > 0 Order by date ASC limit 80 "; 

	$result2  = Mysql_Query($sql);
	
	/////////////////////////
	$tempsql1="CREATE TEMPORARY TABLE  depart1  SELECT  *  FROM  depart  WHERE (date between '".$_GET["year"]."-".$_GET["month"]."-".$_GET["day"]." ".$time_zone[0]."' AND '".$_GET["year"]."-".$_GET["month"]."-".$_GET["day"]." ".$time_zone[1]."') ";
		$temquery1 = mysql_query($tempsql1);
		
		$tempsql="CREATE TEMPORARY TABLE  appoint1  SELECT  *  FROM  appoint  WHERE (date between '".$_GET["year"]."-".$_GET["month"]."-".$_GET["day"]." ".$time_zone[0]."' AND '".$_GET["year"]."-".$_GET["month"]."-".$_GET["day"]." ".$time_zone[1]."') ";
		$temquery = mysql_query($tempsql);
		///////////////////////////

$txt = "งานแพทย์แผนไทย ";
	switch($_GET["time"]){
	case "07:30:00-12:30:00" : $txt .= "08.00 - 12.00"; break;
	case "15:00:00-21:00:00" : $txt .= "16.30 - 20.30"; break;

	case "07:30:00-16:00:00" : $txt .= "08.00 - 16.00"; break;
	case "16:00:01-21:00:00" : $txt .= "16.00 - 20.00"; break;

	}
$pdf->Cell(0,7,$txt,0,0,'C');
$pdf->Ln();

$pdf->Cell(0,7,"วันที่ ".$_GET["day"]." ".$month_[$_GET["month"]]." ".$_GET["year"],0,0,'C');
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

$pdf->Cell(10,7,"ลำดับ",1,0,'C');

$pdf->Cell(50,7,"ชื่อ - สกุล ผู้รับบริการ",1,0,'C');

$pdf->Cell(15,7,"HN",1,0,'C');

$pdf->Cell(35,7,"ชื่อ-สกุล พนักงาน",1,0,'C');

$pdf->Cell(60,7,"การวินิจฉัยโรค",1,0,'C');
		
$pdf->Cell(50,7,"สิทธิการรักษา",1,0,'C');
		
$pdf->Cell(30,7,"นัดครั้งต่อไป",1,0,'C');

$pdf->Cell(20,7,"หมายเหตุ",1,0,'C');

$pdf->Ln();


$i=1;
while(list($date,$hn,$ptname,$ptright) = Mysql_fetch_row($result2)){	

				$subdate=explode(" ",$date);
				
				
				$strsql1="SELECT  diag ,staf_massage FROM  depart1   WHERE  hn='$hn'  and date='$date' ";
				$objquery1 = mysql_query($strsql1);
				list($diag,$staf_massage) = mysql_fetch_row($objquery1);
				
				$strsql2="SELECT  officer,appdate  FROM appoint1    WHERE  hn='$hn'  and date like'$subdate[0]%' ";
				$objquery2  = mysql_query($strsql2);
				list($officer,$appdate) = mysql_fetch_row($objquery2);


$pdf->Cell(10,7,$i,1,0,'C');

$pdf->Cell(50,7,$ptname,1,0);

$pdf->Cell(15,7,$hn,1,0,'L');

$pdf->Cell(35,7,$staf_massage,1,0,'C');

$pdf->Cell(60,7,$diag,1,0,'L');

$pdf->Cell(50,7,$ptright,1,0,'L');

$pdf->Cell(30,7,$appdate,1,0,'L');

$pdf->Cell(20,7,"",1,0,'C');
$pdf->Ln();
$i++;
}




$pdf->Ln();

$pdf->Cell(20,7,"ผู้บันทึก",0,0,'C');
$pdf->Cell(100,7,"          ",0,0,'R');
$pdf->Ln();

$pdf->Cell(70,7,"(                                         )",0,0,'C');
$pdf->Cell(88,7,"(                                         )",0,0,'R');
$pdf->Ln();

$pdf->Cell(66,7,"แพทย์แผนไทย",0,0,'C');
$pdf->Cell(140,7,"หน. แผนกแพทย์ทางเลือก",0,0,'C');
$pdf->Ln();

$pdf->Cell(65,7,"........../........../..........",0,0,'C');
$pdf->Cell(140,7,"........../........../..........",0,0,'C');
$pdf->Ln();
$pdf->Output();
}//นวดแผนไทย



require("unconnect.php");


?>