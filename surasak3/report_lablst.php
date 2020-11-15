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
		font-size: 18px;
		background-color: #FFFFCC;
	}

	.form_search thead{
		font-family: Angsana New;
		font-size: 18px;
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
		font-size: 18px;
		border-collapse: collapse;
	}

	.form_detail thead{
		font-family: Angsana New;
		font-size: 18px;
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

<FORM METHOD=POST ACTION="">

		<TABLE class="form_search" width="300">
		<thead>
		<tr>
			<td colspan="2" >ค้นหา ด้วย HN</td>
		</tr>
		</thead>
		<tr>
			<td align="right">
		HN : </td><td><? if($_GET["close"]=="true"){
		?>
		<INPUT TYPE="text" NAME="search_hn" size="10" value="<?php echo $_GET["hn"];?>">
        <? }else{ ?>
		<INPUT TYPE="text" NAME="search_hn" size="10" value="<?php echo $_REQUEST["search_hn"];?>">
        <? } ?>
        </td>
		</tr>
		<tr>
			<td colspan="2">
		<CENTER><INPUT TYPE="submit" value="ค้นหา"></CENTER>
		</td>
		</tr>
		</TABLE>
</FORM>
<div><A HREF="..\nindex.htm">&lt;&lt; ไปเมนู</A> | 
<?php
// 
if ( $_SESSION['smenucode'] != 'ADMFOD' ) {
	?>
	<a href="druginr.php" target="_blank">รายชื่อผู้ป่วยที่ INR > 6</a>
	<?php
}
?>
</div>
<?php
if(empty($_POST["search_hn"])){
	 include("unconnect.inc");
	exit();
}

$sql = "Select yot,name,surname,sex,dbirth From opcard where hn = '".$_POST["search_hn"]."'  limit 1";
$result2 = Mysql_Query($sql);
list($yot,$name,$surname,$sex,$dob) = Mysql_fetch_row($result2);
if($sex=='ช'){$sex='ชาย';}else if($sex=='ญ'){$sex='หญิง';}else{$sex='ไม่ทราบเพศ';};

$patientname=$yot.''.$name.''.$surname;
echo "<FONT SIZE='5' COLOR='#0000FF'><CENTER>ชื่อผู้ป่วย&nbsp;<B>$patientname</B>&nbsp;&nbsp;เพศ&nbsp;<B>$sex</B>&nbsp;&nbsp;วันเดือนปีเกิด&nbsp;<B>$dob</B></CENTER></FONT>" ;
?>

<TABLE align="center" width="100%" class="form_detail">
<thead>

<tr></tr>
<tr align="center">
	<td >วันที่(เรียงครั้งล่าสุดมาก่อน)</td>
    <td >Labnumber</td>
	<td>รายการ</td>
	<td>แผนก</td>
	<td>แพทย์</td>
	<!--<td>ดูข้อมูล</td>-->
	<td>ใบรายงานผล</td>
</tr>
</thead>
<?php
$i=0;

	$sql = "Select autonumber,date_format(orderdate,'%Y-%m-%d') as dateresult, date_format(orderdate,'%d') as dateresult2, date_format(orderdate,'%m') as dateresult4, date_format(orderdate,'%Y') as dateresult3,labnumber,sourcename,clinicianname From resulthead where hn = '".$_POST["search_hn"]."' Group by labnumber order by orderdate DESC";

	$result = mysql_query($sql);
	while($arr = mysql_fetch_assoc($result)){
		$list_lab = array();
		
		//$sql = "Select distinct profilecode From resulthead where hn = '".$_POST["search_hn"]."' AND orderdate like '".$arr["dateresult"]."%' ";
		$sql = "Select distinct profilecode From resulthead where hn = '".$_POST["search_hn"]."' AND labnumber='".$arr['labnumber']."' ";
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
// $sql = "Select sourcename,clinicianname From resulthead where hn = '".$_POST["search_hn"]."'  limit 1";
// $result2 = Mysql_Query($sql);
// list($sourcename,$clinicianname) = Mysql_fetch_row($result2);
		$sourcename = $arr['sourcename'];
		$clinicianname = $arr['clinicianname'];
		
?>
<tr >
	<td align="center" ><?php echo $arr["dateresult2"];?>&nbsp;<?php echo $month[$arr["dateresult4"]];?>&nbsp;<?php echo $arr["dateresult3"]+543;?></td>
	<td align="center" ><?=$arr['labnumber'];?></td>
	<td><?php echo implode(", ",$list_lab);?></td>
	<td align="center" ><?php echo $sourcename;?></td>
	<td align="center" ><?php echo $clinicianname;?></td>
<!--	<td align="center"><A HREF="report_lablst_detail.php?hn=<?//php echo urlencode($_POST["search_hn"]);?>&lab_date=<?//php echo urlencode($arr["dateresult"]);?>&labnumber=<?//=$arr['labnumber'];?>" target="_blank" >ดูข้อมูล</A></td>-->
	<td align="center">
		<A HREF="lab_lst_print_opd1new.php?hn=<?php echo urlencode($_POST["search_hn"]);?>&lab_date=<?php echo urlencode($arr["dateresult"]);?>&labnumber=<?=$arr['labnumber'];?>&listlab=<?php echo implode(", ",$list_lab);?>&depart=<?php echo $sourcename;?>&doctor=<?php echo $clinicianname;?>" target="_blank" >พิมพ์ใบรายงานผล</A> || 
		<A HREF="lab_lst_print_opd1new2.php?hn=<?php echo urlencode($_POST["search_hn"]);?>&lab_date=<?php echo urlencode($arr["dateresult"]);?>&labnumber=<?=$arr['labnumber'];?>&listlab=<?php echo implode(", ",$list_lab);?>&depart=<?php echo $sourcename;?>&doctor=<?php echo $clinicianname;?>" target="_blank" >ใบรายงานใหม่</A>
	</td>
</tr>
<?php
	}	
?>
</TABLE>


</body>
<?php include("unconnect.inc");?>
</html>