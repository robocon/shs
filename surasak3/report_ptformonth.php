<?php
session_start();
include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 22px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
.txt{
	font-family: TH SarabunPSK;
	font-size: 16px;
}
.txt1 {	font-family: TH SarabunPSK;
	font-size: 20px;
}
#printable { display: block; }
@media print { 
	#non-printable { display: none; } 
	/*#printable { page-break-after:always; } */
	thead{
		display: table-header-group;
	}
} 
-->
</style>
<?php
function dump($str){
	echo "<pre>";
	var_dump($str);
	echo "</pre>";
}

$thaimonthFull = array("���Ҥ�","����Ҿѹ��","�չҤ�","����¹","����Ҥ�","�Զع�¹","�á�Ҥ�","�ԧ�Ҥ�","�ѹ��¹","���Ҥ�", "��Ȩԡ�¹","�ѹ�Ҥ�");

// ���ҧ�ѹ���
$days = array();
for ($i=1; $i <= 31 ; $i++) { 
	$days[] = sprintf('%02d', $i);
}

// ��͹
$months = array(
	'01' => '���Ҥ�', 
	'02' => '����Ҿѹ��', 
	'03' => '�չҤ�', 
	'04' => '����¹', 
	'05' => '����Ҥ�', 
	'06' => '�Զع�¹', 
	'07' => '�á�Ҥ�', 
	'08' => '�ԧ�Ҥ�', 
	'09' => '�ѹ��¹', 
	'10' => '���Ҥ�', 
	'11' => '��Ȩԡ�¹', 
	'12' => '�ѹ�Ҥ�'
);

// ���ҧ��
$date = date("Y") + 543 + 5;
$�years = range(2547, $date);

?>
<div id="non-printable">
	<form id="form1" name="form1" method="post" action="report_ptformonth.php">
		<input name="act" type="hidden" value="show" />
		
		<table width="100%" border="0" cellspacing="0" cellpadding="2">
			<tr>
				<td align="center">

					�ѹ ��͹ �� ����������
					<select class="txt" name="date_start" id="">
						<?php
						foreach( $days as $key => $day ){
							?>
							<option value="<?=$day;?>"><?=$day;?></option>
							<?php
						}
						?>
					</select>
					<select class="txt" name="month_start" id="">
						<?php
						foreach( $months as $key => $month ){
							?>
							<option value="<?=$key;?>"><?=$month;?></option>
							<?php
						}
						?>
					</select>
					<select class="txt" name="year_start" id="">
						<?php
						foreach( $�years as $key => $year ){
							?>
							<option value="<?=$year;?>"><?=$year;?></option>
							<?php
						}
						?>
					</select>
					&nbsp;&nbsp;
					�ѹ ��͹ �� �������ش
					<select class="txt" name="date_end" id="">
						<?php
						foreach( $days as $key => $day ){
							?>
							<option value="<?=$day;?>"><?=$day;?></option>
							<?php
						}
						?>
					</select>
					<select class="txt" name="month_end" id="">
						<?php
						foreach( $months as $key => $month ){
							?>
							<option value="<?=$key;?>"><?=$month;?></option>
							<?php
						}
						?>
					</select>
					<select class="txt" name="year_end" id="">
						<?php
						foreach( $�years as $key => $year ){
							?>
							<option value="<?=$year;?>"><?=$year;?></option>
							<?php
						}
						?>
					</select>
					
					<span style="margin-left: 65px;">
						<input type="submit" value="���Ң�����" name="B1"  class="txt" />
					</span>
			  </td>
		  </tr>
			<tr>
				<td align="center">
					<a href="../nindex.htm">��Ѻ������ѡ</a> || <a href="report_ptmonth.php">��§ҹ�ǴἹ�µ����ǧ����</a></a>
				</td>
			</tr>
		</table>
	</form>
</div> 
<?php
if($_POST["act"]=="show"){
	
	$selmon = $_POST["selmon"];
	if($selmon=="01"){
		$mon ="���Ҥ�";
		$selmon="01";
	}else if($selmon=="02"){
		$mon ="����Ҿѹ��";
		$selmon="02";
	}else if($selmon=="03"){
		$mon ="�չҤ�";
		$selmon="03";
	}else if($selmon=="04"){
		$mon ="����¹";
		$selmon="04";
	}else if($selmon=="05"){
		$mon ="����Ҥ�";
		$selmon="05";
	}else if($selmon=="06"){
		$mon ="�Զع�¹";
		$selmon="06";
	}else if($selmon=="07"){
		$mon ="�á�Ҥ�";
		$selmon="07";
	}else if($selmon=="08"){
		$mon ="�ԧ�Ҥ�";
		$selmon="08";
	}else if($selmon=="09"){
		$mon ="�ѹ��¹";
		$selmon="09";
	}else if($selmon=="10"){
		$mon ="���Ҥ�";
		$selmon="10";
	}else if($selmon=="11"){
		$mon ="��Ȩԡ�¹";
		$selmon="11";
	}else if($selmon=="12"){
		$mon ="�ѹ�Ҥ�";
		$selmon="12";
	}

	$thyear = $_POST["selyear"];
	$ksyear = $_POST["selyear"]-543;
	
	// $end_date = date("t", mktime(0,0,0,$selmon,1,$ksyear));

	// $prev_month = ( intval($selmon) - 1 );
	// $prev_month = ( $prev_month === 0 ) ? "12" : sprintf('%02d', $prev_month) ;

	$date_start = $_POST['date_start'];
	$month_start = $_POST['month_start'];
	$year_start = $_POST['year_start'];

	$date_end = $_POST['date_end'];
	$month_end = $_POST['month_end'];
	$year_end = $_POST['year_end'];



	
	// ��ǧ����
	// ��ª��ͼ��Ǵ
	$sql = "SELECT distinct(staf_massage) 
	FROM depart 
	WHERE staf_massage !='' 
	AND date BETWEEN 
		'$year_start-$month_start-$date_start 00:00:00' 
		AND 
		'$year_end-$month_end-$date_end 23:59:59'";
	
	$query = mysql_query($sql);
	$num = mysql_num_rows($query);
	while($row = mysql_fetch_array($query)){
		
		$staf_massage=$row["staf_massage"];
		?>
		<div id="printable"> 
			<p align="center"><strong>��ª��ͼ�����Ѻ��ԡ�ùǴἹ��</strong></p>
			<div style="margin-left: 5%;"><strong>���;�ѡ�ҹ�Ǵ : </strong><?=$staf_massage;?></div>
			<div style="margin-left: 5%;"><strong>��Ш���͹ : </strong><?=$mon;?> �.�. <?=$thyear;?></div>
			<table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
				<thead>
					<tr bgcolor="#FFCCCC">
						<th width="8%" align="center"><strong>�ӴѺ</strong></th>
						<th align="center" bgcolor="#FFCCCC"><strong>�ѹ/��͹/��</strong></th>
						<th align="center"><strong>HN</strong></th>
						<th align="center"><strong>���� - ���ʡ��</strong></th>
						<th align="center" bgcolor="#FFCCCC"><strong>��è�����</strong></th>
					</tr>
				</thead>
				<tbody>
				<?php
					$sql1 = "SELECT b.date, b.ptname, b.hn, b.an, b.depart, b.detail, b.price, b.paid, b.row_id, b.accno, b.tvn ,b.staf_massage,b.diag,b.ptright,b.idname 
					FROM `patdata` AS a, 
					depart AS b 
					WHERE b.row_id = a.idno 
					AND ( a.code IN ('58002' , '58003' ,'58004' ,'58002a','58002b','58002c','58005','58006','58007','58008','58101','58102','58130','58131','58201','58301','58301a')) 
					AND (
						b.date BETWEEN 
						'$year_start-$month_start-$date_start 00:00:00' 
						AND 
						'$year_end-$month_end-$date_end 23:59:59'
					) 
					AND  a.status = 'Y' 
					AND a.price > 0 
					AND staf_massage = '$staf_massage' 
					GROUP BY b.date ,b.hn,a.code";	
				$result = mysql_query($sql1) or die("Query failed ".$sql1.""); 
				$i=0;
				while($rows=mysql_fetch_array($result)){
					$i++;
					$showdate=substr($rows["date"],0,10);
					list($yy,$mm,$dd)=explode("-",$showdate);
					$dateshow="$dd/$mm/$yy";
					$showtime=substr($rows["date"],11,8);
					?>
					<tr>
						<td align="center"><?=$i;?></td>
						<td align="center"><?=$dateshow;?></td>
						<td><?=$rows["hn"];?></td>
						<td align="left"><?=$rows["ptname"];?></td>
						<?php
						$sql3="select * from drugrx where date like '$showdate%' and hn='".$rows["hn"]."'";
						$query3=mysql_query($sql3);
						$num3=mysql_num_rows($query3);
						if(empty($num3)){
							$showdrug="";
						}else{
							$showdrug="";
						}
						?>
						<td align="center"><?=$showdrug;?></td>
					</tr>
					<?php
					/*
					if( $i % 32 === 0 ){
						?> <tr><td><div style="page-break-after:always;"></div></td></tr> <?php
					}
					*/
				}
				?>
				</tbody>
			</table>
			<br />
			<table width="100%" border="0" cellspacing="0" cellpadding="2">
				<tr>
					<td width="15%" align="right"><strong>���ѹ�֡</strong></td>
					<td width="32%" valign="bottom"><div style="width:150px;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></div></td>
					<td width="18%" align="right"><strong>��Ǩ�١��ͧ</strong></td>
					<td width="35%" align="right">&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td valign="bottom"><div style="width:150px;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></div></td>
					<td align="right">�.�.</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="left"><div style="margin-left:10px;">(���Ծ�&nbsp;&nbsp;&nbsp;&nbsp; �Թ�ѹ)</div></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="left"><div style="margin-left:25px;">ᾷ��Ἱ��</div></td>
				</tr>
			</table>
		</div>
		<div style="page-break-after:always;"></div>
	<?php
	} // while
} // end if act show
?>

