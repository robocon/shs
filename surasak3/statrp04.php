<?php
require("fpdf/fpdf.php");
require("fpdf/pdf.php");

require("connect.php");

	$month_["01"] = "���Ҥ�";
	$month_["02"] = "����Ҿѹ��";
	$month_["03"] = "�չҤ�";
	$month_["04"] = "����¹";
	$month_["05"] = "����Ҥ�";
	$month_["06"] = "�Զع�¹";
	$month_["07"] = "�á�Ҥ�";
	$month_["08"] = "�ԧ�Ҥ�";
	$month_["09"] = "�ѹ��¹";
	$month_["10"] = "���Ҥ�";
	$month_["11"] = "��Ȩԡ�¹";
	$month_["12"] = "�ѹ�Ҥ�";

if($_GET["day"] != ""){
	$_GET["day"] = sprintf("%02d",$_GET["day"]);
}else{
	$_GET["day"]="";
}
$time_zone = explode("-",$_GET["time"]);
	
if($_GET["code"] == "����Ҿ"){
	$where = " AND code not like '58%' and depart = 'PHYSI' ";
}else{
	$where = "  AND code not like '58%' and depart = 'PHYSI' ";
}
if($_GET["doctor"]!=''){
			
	$subcode=substr($_GET["doctor"],0,5);
	$where .="AND doctor like '%$subcode%'";
}else{
	$where .="";
}


if($_GET["code"] == "����Ҿ"){//�ѧ���
		
	$_GET['day'] = !empty($_GET['day']) ? $_GET['day'] : '' ;
	$get_day = $_GET['day'];

	
/*
$sql = "
	SELECT DISTINCT a.hn, a.ptname
	FROM (

	SELECT hn, ptname, date
	FROM patdata
	WHERE (
	date
	BETWEEN '".$_GET["year"]."-".$_GET["month"]."-".$_GET["day"]." ".$time_zone[0]."' AND '".$_GET["year"]."-".$_GET["month"]."-".$_GET["day"]." ".$time_zone[1]."'
	) AND doctor = '".$_GET["doctor"]."' ".$where."
	) AS a
	INNER JOIN (

	SELECT hn
	FROM opacc
	WHERE date
	LIKE '".$_GET["year"]."-".$_GET["month"]."-".$_GET["day"]."%' AND depart = 'NID'
	) AS b ON a.hn = b.hn
	Order by a.date ASC limit 70 
";*/
	
	/**
	 * @readme 
	 * ��Ѻ���͹� ����������ѹ����������ö������͹��
	 */
	$normal_date_start = $_GET['year'].'-'.$_GET['month'].'-'.$_GET['day'].' '.$time_zone[0];
	$normal_date_end = $_GET['year'].'-'.$_GET['month'].'-'.$_GET['day'].' '.$time_zone[1];

	$like_month = $_GET['year'].'-'.$_GET['month'].'%';

	$time_start = $time_zone[0];
	$time_end = $time_zone[1];

	$where_date = "  date BETWEEN '$normal_date_start' AND '$normal_date_end' ";

	if ( $get_day == '' ) {
		$where_date = " `date` LIKE '$like_month' 
		AND ( 
			SUBSTRING(`date`,12,8) >= '$time_start' AND SUBSTRING(`date`,12,8) <= '$time_end' 
		)";
	}

	// 
	$sql = "SELECT date,hn, ptname,ptright   
	FROM patdata 
	WHERE $where_date 
	AND hn != '' 
	$where 
	Group by hn 
	Having sum(amount)  > 0  
	Order by date ASC  
	limit 70 ";
	$result2  = mysql_query($sql);
	

	$tempsql1="CREATE TEMPORARY TABLE  depart1  
	SELECT  *  
	FROM  depart  
	WHERE $where_date ";
	$temquery1 = mysql_query($tempsql1); 

	
	$tempsql="CREATE TEMPORARY TABLE  appoint1  
	SELECT  *  
	FROM  appoint 
	WHERE $where_date ";
	$temquery = mysql_query($tempsql);


	$txt = "����¹������Ѻ��ԡ�� ����  ";
	
	switch($_GET["time"]){
		case "07:30:00-16:00:00" : $txt .= "08.00 - 16.00"; break;
		case "16:00:00-21:00:00" : $txt .= "16.30 - 21.00"; break;
		case "07:30:00-21:00:00" : $txt .= "08.00 - 21.00"; break;
	}
	
	$def_day_txt = "�ѹ��� ".$_GET["day"];
	if( $_GET['day'] == '' ){
		$def_day_txt = "��͹ ";
	}

	$view_type = $_GET['view_type'];
	// view_type = table ������˹�ҧҹ��ҡ�ͺ��ҧ� excel ��
	if( $view_type == 'table' ){
		// 
		?>
		<style>
		*{
			font-family: "TH Sarabun New"," TH SarabunPSK";
			font-size: 14pt;
		}
		table.shsTb{
			border-collapse: collapse;
			width: 100%;
		}
		table.shsTb th,
		table.shsTb td{
			border: 1px solid black;
			vertical-align: top;
		}
		</style>
		<div>
			<div style="text-align:center;">����¹������Ѻ��ԡ�� ���� <?=$_GET["time"];?></div>
			<div style="text-align:center;"><?=$def_day_txt.' '.$month_[$_GET["month"]]." ".$_GET["year"];?></div>
			<div >
				<table class="shsTb">
					<thead>
						<tr>
							<th>�ӴѺ</th>
							<th>����-ʡ�� ������Ѻ��ԡ��</th>
							<th>HN</th>
							<th>����ԹԨ����ä</th>
							<th>�Է�ԡ���ѡ��</th>
							<th>�Ѵ���駵���</th>
							<th>�����˵�</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					$i = 1;
					while(list($date,$hn,$ptname,$ptright) = mysql_fetch_row($result2)){ 

						$subdate=explode(" ",$date);
			
						$strsql1="SELECT  diag  FROM  depart1   WHERE  date='$date' ";
						$objquery1 = mysql_query($strsql1);
						list($diag) = mysql_fetch_row($objquery1);
						
						$strsql2="SELECT  appdate  FROM appoint1    WHERE  hn='$hn'  and date like'$subdate[0]%' ";
						$objquery2  = mysql_query($strsql2);
						list($appdate) = mysql_fetch_row($objquery2);
						
						?>
						<tr>
							<td><?=$i;?></td>
							<td><?=$ptname;?></td>
							<td><?=$hn;?></td>
							<td><?=$diag;?></td>
							<td><?=$ptright;?></td>
							<td><?=$appdate;?></td>
							<td></td>
						</tr>
						<?php
						$i++;
					}
					?>
					</tbody>
				</table>
			</div>
			<br>
			<div>
				<table style="width: 50%">
					<tr>
						<td>���ѹ�֡</td>
						<td></td>
						<td></td>
						<td style="text-align:center;">.............................................</td>
					</tr>
					<tr>
						<td style="text-align:center;">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
						<td></td>
						<td></td>
						<td style="text-align:center;">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
					</tr>
					<tr>
						<td style="text-align:center;">.............................................</td>
						<td></td>
						<td></td>
						<td style="text-align:center;">ᾷ�����ѡ��</td>
					</tr>
					<tr>
						<td style="text-align:center;">........../........../..........</td>
						<td></td>
						<td></td>
						<td style="text-align:center;">........../........../..........</td>
					</tr>
				</table>
			</div>
		</div>
		<?php 

	}else{
		$pdf = new PDF('L' ,'mm','A4');
		$pdf->SetThaiFont();
		$pdf->SetMargins(10, 10);
		$pdf->AddPage();
		$pdf->SetFont('AngsanaNew', '', 14);
		$pdf->Cell(0,7,$txt,0,0,'C');
		$pdf->Ln();
		$pdf->Cell(0,7,$def_day_txt." ".$month_[$_GET["month"]]." ".$_GET["year"],0,0,'C');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell(10,7,"�ӴѺ",1,0,'C');
		$pdf->Cell(50,7,"���� - ʡ�� ����Ѻ��ԡ��",1,0,'C');
		$pdf->Cell(15,7,"HN",1,0,'C');
		$pdf->Cell(80,7,"����ԹԨ����ä",1,0,'C');
		$pdf->Cell(50,7,"�Է�ԡ���ѡ��",1,0,'C');
		$pdf->Cell(40,7,"�Ѵ���駵���",1,0,'C');
		$pdf->Cell(30,7,"�����˵�",1,0,'C');
		$pdf->Ln();

		$i=1;
		while(list($date,$hn,$ptname,$ptright) = mysql_fetch_row($result2)){	
		
			$subdate=explode(" ",$date);
			
			$strsql1="SELECT  diag  FROM  depart1   WHERE  date='$date' ";
			$objquery1 = mysql_query($strsql1);
			list($diag) = mysql_fetch_row($objquery1);
			
			$strsql2="SELECT  appdate  FROM appoint1    WHERE  hn='$hn'  and date like'$subdate[0]%' ";
			$objquery2  = mysql_query($strsql2);
			list($appdate) = mysql_fetch_row($objquery2);
			$pdf->Cell(10,7,$i,1,0,'C');
			$pdf->Cell(50,7,$ptname,1,0);
			$pdf->Cell(15,7,$hn,1,0,'L');
			$pdf->Cell(80,7,$diag,1,0,'L');
			$pdf->Cell(50,7,$ptright,1,0,'L');
			$pdf->Cell(40,7,$appdate,1,0,'L');
			$pdf->Cell(30,7,"",1,0,'C');
			$pdf->Ln();
			$i++;
		}

		$pdf->Ln();

		$pdf->Cell(20,7,"���ѹ�֡",0,0,'C');
		$pdf->Cell(135,7,"..........................................",0,0,'R');
		$pdf->Ln();

		$pdf->Cell(65,7,"(                                          )",0,0,'C');
		$pdf->Cell(90,7,"(                                          )",0,0,'R');
		$pdf->Ln();

		$pdf->Cell(66,7,"........................................",0,0,'C');
		$pdf->Cell(140,7,"ᾷ�����ѡ��",0,0,'C');
		$pdf->Ln();

		$pdf->Cell(65,7,"........../........../..........",0,0,'C');
		$pdf->Cell(140,7,"........../........../..........",0,0,'C');
		$pdf->Ln();
	}
		//�ѧ���
}else{

//�ǴἹ��

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


	$sql = "SELECT hn, ptname,sum(price)  
	FROM patdata 
	WHERE hn != '' 
	AND ( date between '".$_GET["year"]."-".$_GET["month"]."-".$_GET["day"]." ".$time_zone[0]."' 
	AND '".$_GET["year"]."-".$_GET["month"]."-".$_GET["day"]." ".$time_zone[1]."')  
	".$where." 
	Group by hn 
	Having sum(amount)  > 0 
	Order by date ASC  
	limit 70 ";


	$result2  = Mysql_Query($sql);

	$txt = "�ҹ����Ҿ ";
		switch($_GET["time"]){
		case "07:30:00-16:00:00" : $txt .= "08.00 - 16.00"; break;
		case "16:00:00-21:00:00" : $txt .= "16.30 - 21.00"; break;

		case "07:30:00-21:00:00" : $txt .= "08.00 - 21.00"; break;
		
	}

	$pdf->Cell(0,7,$txt,0,0,'C');
	$pdf->Ln();

	$pdf->Cell(0,7,"�ѹ��� ".$_GET["day"]." ".$month_[$_GET["month"]]." ".$_GET["year"],0);
	$pdf->Ln();

	$pdf->Cell(10,7,"�ӴѺ",1,0,'C');

	$pdf->Cell(60,7,"���� - ʡ�� ����Ѻ��ԡ��",1,0,'C');

	$pdf->Cell(30,7,"HN",1,0,'C');

	$pdf->Cell(60,7,"�Ҥ�",1,0,'C');

	$pdf->Cell(30,7,"�����˵�",1,0,'C');

	$pdf->Ln();


	$i=1;
	while(list($hn,$ptname,$price) = Mysql_fetch_row($result2)){	

		$pdf->Cell(10,7,$i,1,0,'C');

		$pdf->Cell(60,7,$ptname,1,0);

		$pdf->Cell(30,7,$hn,1,0,'C');

		$pdf->Cell(60,7,$price,1,0,'C');

		$pdf->Cell(30,7,"",1,0,'C');
		$pdf->Ln();
		$i++;
	}




	$pdf->Ln();

	$pdf->Cell(20,7,"���ѹ�֡",0,0,'C');
	$pdf->Cell(100,7,"          ",0,0,'R');
	$pdf->Ln();

	$pdf->Cell(70,7,"(                                         )",0,0,'C');
	$pdf->Cell(88,7,"(                                         )",0,0,'R');
	$pdf->Ln();

	$pdf->Cell(66,7,"",0,0,'C');
	$pdf->Cell(140,7,"",0,0,'C');
	$pdf->Ln();

	$pdf->Cell(65,7,"........../........../..........",0,0,'C');
	$pdf->Cell(140,7,"........../........../..........",0,0,'C');
	$pdf->Ln();

}//�ǴἹ��



require("unconnect.php");
$pdf->Output();

?>