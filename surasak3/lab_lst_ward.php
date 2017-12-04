<?php
session_start();
set_time_limit(30);
if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=TIS-620");
}
include("connect.inc");

$month["01"] = "มกราคม";
$month["02"] = "กุมภาพันธ์";
$month["03"] = "มีนาคม";
$month["04"] = "เมษายน";
$month["05"] = "พฤษภาคม";
$month["06"] = "มิถุนายน";
$month["07"] = "กรกฏาคม";
$month["08"] = "สิงหาคม";
$month["09"] = "กันยายน";
$month["10"] = "ตุลาคม";
$month["11"] = "พฤศจิกายน";
$month["12"] = "ธันวาคม";

?>
<html>
<head>
<title>ผล LAB Online</title>

<style>
	body ,div {
		
		text-decoration:none;
		font-family: Angsana New;
	}

	.form_search{
		border:2px solid;
		border-radius:25px;
		border-color: #330000;
		font-family: Angsana New;
		font-size: 22px;
		background-color: #FFFFCC;
	}

	.form_search thead{
		font-family: Angsana New;
		font-size: 22px;
		font-weight:bold;
		color:#FFFFFF;
		text-align: center;
		background: #004080;
		
	}

	.form_detail{
		border:2px solid;
		border-radius:25px;
		border-color: #66CDAA;
		font-family: Angsana New;
		font-size: 22px;
		border-collapse: collapse;
	}

	.form_detail thead{
		font-family: Angsana New;
		font-size: 22px;
		font-weight:bold;
		color:#FFFFFF;
		text-align: center;
		background: #008000;
		
	}

	.form_detail a:link, a:visited{
		color:red;
		text-decoration:none;
	}


	
</style>
</head>
<body>

<div><FONT SIZE="6" COLOR="#FF0000"><CENTER>โปรแกรมดูผล LAB ผู้ป่วยใน</CENTER></FONT></div>
<?php
$sql = "Select patientname,sex,dob From resulthead where hn = '$search_hn'  limit 1";
$result2 = Mysql_Query($sql);
list($patientname,$sex,$dob) = Mysql_fetch_row($result2);
if($sex=='M'){$sex='ชาย';}else if($sex=='F'){$sex='หญิง';}else{$sex='ไม่ทราบเพศ';};

echo "<FONT SIZE='5' COLOR='#0000FF'><CENTER>ชื่อผู้ป่วย&nbsp;<B>$patientname</B>&nbsp;&nbsp;เพศ&nbsp;<B>$sex</B>&nbsp;&nbsp;วันเดือนปีเกิด&nbsp;<B>$dob</B></CENTER></FONT>" ;
?>

<TABLE align="center" width="800" class="form_detail">
<thead>

<tr></tr>
<tr align="center">
	<td >วันที่(เรียงครั้งล่าสุดมาก่อน)</td>
	<td>รายการ</td>
	<td>แผนก</td>
	<td>แพทย์</td>
	<td>ดูข้อมูล</td>
	<td>ใบรายงานผล</td>
</tr>
</thead>
<?php
$i=0;

	$sql = "Select distinct date_format(orderdate,'%Y-%m-%d') as dateresult, date_format(orderdate,'%d') as dateresult2, date_format(orderdate,'%m') as dateresult4, date_format(orderdate,'%Y') as dateresult3 From resulthead where hn = '$search_hn' order by orderdate DESC";

	$result = mysql_query($sql);
	while($arr = mysql_fetch_assoc($result)){
		$list_lab = array();
		$sql = "Select distinct profilecode From resulthead where hn = '$search_hn' AND orderdate like '".$arr["dateresult"]."%' ";
		
		$result2 = mysql_query($sql);
		while($arr2 = mysql_fetch_assoc($result2)){
			array_push($list_lab,$arr2["profilecode"]);
		}

		if($i%2 == 0){
			$bgcolor="bgcolor='#FFFFCA' ";
		}else{
			$bgcolor="bgcolor='#FFFFFF' ";
		}



		$i++;
$sql = "Select sourcename,clinicianname From resulthead where hn = '$search_hn'  limit 1";
$result2 = Mysql_Query($sql);
list($sourcename,$clinicianname) = Mysql_fetch_row($result2);
		
?>
<tr >
	<td align="center" ><?php echo $arr["dateresult2"];?>&nbsp;<?php echo $month[$arr["dateresult4"]];?>&nbsp;<?php echo $arr["dateresult3"]+543;?></td>
	<td><?php echo implode(", ",$list_lab);?></td>
	<td align="center" ><?php echo $sourcename;?></td>
	<td align="center" ><?php echo $clinicianname;?></td>
	<td align="center"><A HREF="lab_lst_view.php?hn=<?php echo urlencode($search_hn);?>&lab_date=<?php echo urlencode($arr["dateresult"]);?>" target="_blank" >ดูข้อมูล</A></td>
	<td align="center"><A HREF="lab_lst_print_opd.php?hn=<?php echo urlencode($search_hn);?>&lab_date=<?php echo urlencode($arr["dateresult"]);?>" target="_blank" >พิมพ์ใบรายงานผล</A></td>
</tr>
<?php
	}	
?>
</TABLE>


</body>
<?php include("unconnect.inc");?>
</html>