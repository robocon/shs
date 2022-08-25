<?php
// require("fpdf/fpdf.php");
// require("fpdf/pdf.php");

include 'fpdf_thai/fpdf_thai.php';
include 'includes/connect.php';

if(!function_exists('dump'))
{
	function dump($txt){
		echo "<pre>";
		var_dump($txt);
		echo "</pre>";
	}
}

$page = $_GET['page'];
if($page=='print')
{
	// header("Content-type:application/pdf;charset=Windows-874;");
	$date = $_GET['date'];
	$hn = $_GET['hn'];
	$ptname = urldecode($_GET['ptname']);
	$lab = urldecode($_GET['lab']);

	$pdf = new FPDF("L",'mm',array( 80,50 ));
	
	// $pdf->SetThaiFont();
	$pdf->AddFont('AngsanaNew','','angsa.php');
	$pdf->AddFont('AngsanaNew','B','angsab.php');
	$pdf->SetAutoPageBreak(true,0);
	$pdf->SetMargins(0, 0);
	$pdf->AddPage();
	$pdf->SetFont('AngsanaNew', '', 12);

	for ($i=0; $i < 2; $i++) { 
	
		// +1mm ก่อนขึ้นข้อความถัดไป
		if($i!=0)
		{
			$x_line = $pdf->GetX();
			$y_line = $pdf->GetY();
			$pdf->SetXY($x_line, $y_line+1);
		}

		$pdf->Cell(80,5,iconv('UTF8','TIS620',"วันที่ ".$date)."  Hn: ".$hn, 0);
		$pdf->Ln();
		$pdf->Cell(80,5,iconv('UTF8', 'TIS620', "ชื่อ: ".$ptname), 0); 
		$pdf->Ln();
		$pdf->MultiCell(80,5, "LAB: ".$lab, 0);
		

		// ขีดเส้นกั้นเมื่อจบชุดข้อความแรก
		if($i==0)
		{
			$get_x = $pdf->GetX();
			$get_y = $pdf->GetY();
			$pdf->Line($get_x, $get_y, $get_x+80, $get_y);
		}

	}
	$pdf->Output();


	exit;
}


$d = date("d");
$m = date("m");
$y = date("Y")+543;
$hn = trim($_REQUEST["hn"]);

$sql = "Select yot, name, surname, ptright From opcard where hn = '$hn' limit 1 ";
$result = Mysql_Query($sql);
list($yot, $name, $surname, $ptright) = Mysql_fetch_row($result);
$ptname = $yot." ".$name." ".$surname;

$where_date = "$y-$m-$d";
// $where_date = '2564-11-12';
$labdepart_sql = "Select row_id, doctor, price, sumnprice, date, ptname, hn From labdepart where hn ='$hn' AND date like '$where_date%' AND depart = 'PATHO' AND price > 0 Order by row_id ASC ";

$result_labdepart = Mysql_Query($labdepart_sql);
$rows_labdepart = Mysql_num_rows($result_labdepart);

if($rows_labdepart <= 0 ){
	echo "<CENTER>ขออภัยผู้ป่วยไม่มีรายการตรวจLabจากแพทย์ในวันนี้</CENTER>";
	exit();
}

?>
<style>
.chk_table{
	border-collapse: collapse;
}
.chk_table th,
.chk_table td{
	padding: 3px;
	border: 1px solid black;
}
</style>
<div>
	<a href="hdhn.php">&lt;&lt;&nbsp;เลือก HN</a>
</div>
<h3>เลือกรายการที่แพทย์สั่ง</h3>
<table class="chk_table">
	<tr style="background-color: #8bc34a">
		<th>วดป ที่แพทย์สั่ง</th>
		<th>HN</th>
		<th>ชื่อสกุล</th>
		<th>รายการ LAB</th>
		<th>พิมพ์</th>
	</tr>

<?php
while ($labdepart = mysql_fetch_assoc($result_labdepart)) {
	
	$rowid = $labdepart['row_id'];
	$doctor = $labdepart['doctor'];
	$price = $labdepart['price'];
	$sumnprice = $labdepart['sumnprice'];

	$sql = "Select code From labpatdata  where idno = '".$rowid."' ";
	$result = Mysql_Query($sql);
	$list_lab = array();
	while($arr = mysql_fetch_assoc($result)){
			array_push($list_lab,$arr["code"]);
	}
	$count2 = count($list_lab);
	$txt_list_lab = implode(", ",$list_lab);

	$data_url = "hd_sticker_item.php";
	$data_url .= "?page=print";
	$data_url .= "&date=".$labdepart['date'];
	$data_url .= "&hn=".$labdepart['hn'];
	$data_url .= "&ptname=".urlencode($labdepart['ptname']);
	$data_url .= "&lab=".urlencode($txt_list_lab);
	?>
	<tr>
		<td><?=$labdepart['date'];?></td>
		<td><?=$labdepart['hn'];?></td>
		<td><?=$labdepart['ptname'];?></td>
		<td><?=$txt_list_lab;?></td>
		<td><a href="<?=$data_url;?>" target="_blank">พิมพ์</a></td>
	</tr>
	<?php

}

?>
</table>