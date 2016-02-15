<?php 
session_start();
include '../connect.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis620" />
<title>ตรวจสอบข้อมูลการจอง</title>
</head>
<style type="text/css">
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.forntsarabun1 {
	font-family: "TH SarabunPSK";
	font-size: 16px;
}

</style>
<body>
<form name="f1" action="" method="post">
<table  border="0" cellpadding="3" cellspacing="3">
  <tr class="forntsarabun" >
    <td colspan="2"  align="center" bgcolor="#CCCCCC" class="forntsarabun">ตรวจสอบข้อมูลการจองเตียง</td>
    </tr>
  <tr class="forntsarabun">
    <td  align="right" class="forntsarabun">วันที่</td>
    <td ><select name="d_start">
	<?
	$d=date("d");
	for($i=0;$i<=31;$i++){
		if($i<=9){
			$i="0".$i;		
		}else{
			$i=$i;
		}
		if($i==$d){
		echo "<option value='$i' selected='selected'>$i</option>";
		}else{
		echo "<option value='$i' >$i</option>";
		}
	}
	
	?>
	</select>
	<? $m=date('m'); ?>
      <select name="m_start" >
        <option value="01" <? if($m=='01'){ echo "selected"; }?>>มกราคม</option>
        <option value="02" <? if($m=='02'){ echo "selected"; }?>>กุมภาพันธ์</option>
        <option value="03" <? if($m=='03'){ echo "selected"; }?>>มีนาคม</option>
        <option value="04" <? if($m=='04'){ echo "selected"; }?>>เมษายน</option>
        <option value="05" <? if($m=='05'){ echo "selected"; }?>>พฤษภาคม</option>
        <option value="06" <? if($m=='06'){ echo "selected"; }?>>มิถุนายน</option>
        <option value="07" <? if($m=='07'){ echo "selected"; }?>>กรกฎาคม</option>
        <option value="08" <? if($m=='08'){ echo "selected"; }?>>สิงหาคม</option>
        <option value="09" <? if($m=='09'){ echo "selected"; }?>>กันยายน</option>
        <option value="10" <? if($m=='10'){ echo "selected"; }?>>ตุลาคม</option>
        <option value="11" <? if($m=='11'){ echo "selected"; }?>>พฤศจิกายน</option>
        <option value="12" <? if($m=='12'){ echo "selected"; }?>>ธันวาคม</option>
        </select>
      <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' >";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?></td>
    </tr>
  <tr class="forntsarabun">
    <td  align="right" class="forntsarabun">&nbsp;</td>
    <td ><font style="font-size:18px">*ต้องการดูทั้งเดือนเลือก 00 คะ*</font></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="ค้นหา"/>&nbsp;&nbsp;<a href="../../nindex.htm" class="forntsarabun">กลับเมนูหลัก</a>&nbsp;&nbsp;
      </td>
  </tr>
</table>
</form>
<br />

<?
if(isset($_POST['submit'])){
	
	echo "<hr>";
	
	
	
	if($_POST['d_start']=="00") {$_POST['d_start']="";}
	
	$date1=$_POST['y_start'].'-'.$_POST['m_start'].'-'.$_POST['d_start'];
	
	/////////////////////////
	$sessiondate=$_POST['d_start'].'/'.$_POST['m_start'].'/'.$_POST['y_start'];
	$_SESSION['sessiondate']=$sessiondate;
	////////////////
	switch($_POST['m_start']){
		case "01": $printmonth = "มกราคม"; break;
		case "02": $printmonth = "กุมภาพันธ์"; break;
		case "03": $printmonth = "มีนาคม"; break;
		case "04": $printmonth = "เมษายน"; break;
		case "05": $printmonth = "พฤษภาคม"; break;
		case "06": $printmonth = "มิถุนายน"; break;
		case "07": $printmonth = "กรกฏาคม"; break;
		case "08": $printmonth = "สิงหาคม"; break;
		case "09": $printmonth = "กันยายน"; break;
		case "10": $printmonth = "ตุลาคม"; break;
		case "11": $printmonth = "พฤศจิกายน"; break;
		case "12": $printmonth = "ธันวาคม"; break;
	}
	if($_POST['d_start']==''){
	$day="เดือน";
	 $dateshow=$printmonth." ".$_POST['y_start'];
	}else{
	 $day="วันที่";
	 $dateshow=$_POST['d_start'].' '.$printmonth." ".$_POST['y_start'];
	}
	
	
	
	$sql="SELECT * FROM  booking  WHERE  date_in   like '".$date1."%' order by date_in asc ";
    $query = mysql_query($sql); 
	$row=mysql_num_rows($query);
	
	
	$i=1;
	if($row){
		echo "<div class=\"forntsarabun\">ข้อมูลการจองเตียง $day : $dateshow      <a href='booking.php' class='forntsarabun' >จองเตียงผู้ป่วยใน</a></div><hr>";
		
		
	echo "<table border='1' cellspacing='0' cellpadding='0' class='forntsarabun' style=\"border-collapse:collapse\" bordercolor=\"#000000\"> 
  <tr bgcolor=\"#CCCCCC\" align=\"center\">
    <td>#</td>
    <td>ว/ด/ป ที่จอง</td>
	<td>ว/ด/ป ที่นอน</td>
	<td>HN</td>
    <td>ชื่อ-สกุล</td>
    <td>แพทย์</td>
    <td>เตียง/ห้อง</td>
    <td>หอผู้ป่วย</td>
	<td>สถานะ</td>
	<td>หมายเลขเตียง</td>
	<td>ผู้อนุมัติ</td>
	<td>แก้ไข</td>
	<td>ลบ</td>
	<td>ใบจอง</td>
  </tr>";
  while($dbarr=mysql_fetch_array($query)){
	  
	  if($dbarr['status']==""){
		  $status1= "รอการอนุมัติ";
		  $color="";
	  }else if($dbarr['status']=="รับทราบ"){
		  $status1=$dbarr['status'];
		  $color="#84BC30";//เขียว
	  }else if($dbarr['status']=="ยกเลิก"){
		  	 $status1=$dbarr['status'];
			 $color= "#FF9393";//แดง
	 }else{
	  	  $color="";
		  $status1=$dbarr['status'];
	  }
	  $date_regis = substr($dbarr['date_regis'],8,2)."-".substr($dbarr['date_regis'],5,2)."-".substr($dbarr['date_regis'],0,4);
	  $date_in = substr($dbarr['date_in'],8,2)."-".substr($dbarr['date_in'],5,2)."-".substr($dbarr['date_in'],0,4);
echo"  <tr bgcolor='$color'>
    <td>$i</td>
    <td>$date_regis</td>
	<td>$date_in</td>
    <td>$dbarr[hn]</td>
    <td>$dbarr[ptname]</td>
    <td>$dbarr[doctor]</td>
    <td>$dbarr[bed]</td>
    <td>$dbarr[ward]</td>
	<td>$status1</td>
	<td>$dbarr[comment]</td>
	<td>$dbarr[officer_con]</td>
	<td><a href='booking_edit.php?row_id=$dbarr[row_id]'>แก้ไข</a></td>";
echo "<td>";
?>
<a href="JavaScript:if(confirm('คุณต้องการลบข้อมูลการจอง  HN :<?=$dbarr['hn']?> หรือไม่ ')==true){window.location='booking_del.php?id_del=<?=$dbarr['row_id'];?>';}">ลบ</a>
<?
echo  "</td>
<td align=\"center\"><a href='booking_print.php?row_id=$dbarr[row_id]'>พิมพ์</a></td>

</tr>";
  $i++;
    }// ปิด while
echo "</table>
";

  }else{
	echo "<font class='forntsarabun'>ไม่พบการจองเตียง   $dateshow </font><br>";
	echo "<a href='booking.php' class='forntsarabun'>จองเตียงผู้ป่วยใน</a><hr />";	
	}
	
}// ปิด$_POST['submit']

// mysql_close();
?>

<br />
<?

// include("../Connections/connect.inc.php"); 
//////จองเตียงวันนี้//////
$todayy1=date("Y")+543;
$todaym1=date("m");
$todayd1=date("d");

$today5=$todayy1.'-'.$todaym1.'-'.$todayd1;

	switch($todaym1){
		case "01": $printmonth = "มกราคม"; break;
		case "02": $printmonth = "กุมภาพันธ์"; break;
		case "03": $printmonth = "มีนาคม"; break;
		case "04": $printmonth = "เมษายน"; break;
		case "05": $printmonth = "พฤษภาคม"; break;
		case "06": $printmonth = "มิถุนายน"; break;
		case "07": $printmonth = "กรกฏาคม"; break;
		case "08": $printmonth = "สิงหาคม"; break;
		case "09": $printmonth = "กันยายน"; break;
		case "10": $printmonth = "ตุลาคม"; break;
		case "11": $printmonth = "พฤศจิกายน"; break;
		case "12": $printmonth = "ธันวาคม"; break;
	}

	 $day="วันที่";
	 $dateshow4=$todayd1.' '.$printmonth." ".$todayy1;

	
	
	
	$sql="SELECT * FROM  booking  WHERE  date_regis   like '".$today5."%' ";
    $query = mysql_query($sql); 
	$row=mysql_num_rows($query);
	
	
	$i=1;
	if($row){
		echo "<div class=\"forntsarabun\">ข้อมูลการจองเตียง $day : $dateshow4   </div><hr>";
		
		
	echo "<table border='1' cellspacing='0' cellpadding='0' class='forntsarabun' style=\"border-collapse:collapse\" bordercolor=\"#000000\"> 
  <tr bgcolor=\"#CCCCCC\" align=\"center\">
    <td>#</td>
    <td>ว/ด/ป ที่จอง</td>
	<td>HN</td>
    <td>ชื่อ-สกุล</td>
    <td>แพทย์</td>
    <td>เตียง/ห้อง</td>
    <td>หอผู้ป่วย</td>
	<td>สถานะ</td>
	<td>หมายเลขเตียง</td>
	<td>ผู้อนุมัติ</td>
	<td>แก้ไข</td>
	<td>ลบ</td>
	<td>ใบจอง</td>
  </tr>";
  while($dbarr=mysql_fetch_array($query)){
	  
	  if($dbarr['status']==""){
		  $status1= "รอการอนุมัติ";
		  $color="";
	  }else if($dbarr['status']=="รับทราบ"){
		  $status1=$dbarr['status'];
		  $color="#84BC30";//เขียว
	  }else if($dbarr['status']=="ยกเลิก"){
		  	 $status1=$dbarr['status'];
			 $color= "#FF9393";//แดง
	 }else{
	  	  $color="";
		  $status1=$dbarr['status'];
	  }
	  $date_regis = substr($dbarr['date_regis'],8,2)."-".substr($dbarr['date_regis'],5,2)."-".substr($dbarr['date_regis'],0,4);
	  $date_in = substr($dbarr['date_in'],8,2)."-".substr($dbarr['date_in'],5,2)."-".substr($dbarr['date_in'],0,4);
echo"  <tr bgcolor='$color'>
    <td>$i</td>
    <td>$date_regis</td>
    <td>$dbarr[hn]</td>
    <td>$dbarr[ptname]</td>
    <td>$dbarr[doctor]</td>
    <td>$dbarr[bed]</td>
    <td>$dbarr[ward]</td>
	<td>$status1</td>
	<td>$dbarr[comment]</td>
	<td>$dbarr[officer_con]</td>
	<td><a href='booking_edit.php?row_id=$dbarr[row_id]'>แก้ไข</a></td>";
echo "<td>";
?>
<a href="JavaScript:if(confirm('คุณต้องการลบข้อมูลการจอง  HN :<?=$dbarr['hn']?> หรือไม่ ')==true){window.location='booking_del.php?id_del=<?=$dbarr['row_id'];?>';}">ลบ</a>
<?
echo  "</td>
<td align=\"center\"><a href='booking_print.php?row_id=$dbarr[row_id]'>พิมพ์</a></td>

</tr>";
  $i++;
    }// ปิด while
echo "</table>
";

  }else{
	echo "<font class='forntsarabun'>ไม่พบการจองเตียง $day $dateshow4 </font><br>";
	
	}
	//////////////////////////////////////จองเตียงวันนี้////
?>
	<br>
<?



$todayy=date("Y")+543;
$todayd=date("d");
$todaym=date("m");

$today=$todayy.'-'.$todaym.'-'.$todayd;

$show_today=$todayd.'-'.$todaym.'-'.$todayy;
	$sql1="SELECT * FROM  booking  WHERE  date_in  like '".$today."%' ";
    $query1 = mysql_query($sql1); 
	$row1=mysql_num_rows($query1);
	$i=1;
	
	if($row1){
		echo "<div class=\"forntsarabun\">เตียงจองวันนี้ : $show_today</div><hr>";
		
	echo "<table border='1' cellspacing='0' cellpadding='0' class='forntsarabun' style=\"border-collapse:collapse\" bordercolor=\"#000000\" width=\"100%\"> 
  <tr bgcolor=\"#CCCCCC\" align=\"center\">
    <td>#</td>
    <td>ว/ด/ป ที่จอง</td>
	<td>HN</td>
    <td>ชื่อ-สกุล</td>
    <td>แพทย์</td>
    <td>เตียง/ห้อง</td>
    <td>หอผู้ป่วย</td>
	<td>สถานะ</td>
	<td>หมายเลขเตียง</td>
	<td>ผู้อนุมัติ</td>
	<td>แก้ไข</td>
	<td>ลบ</td>
	<td>ใบจอง</td>
  </tr>";
  while($dbarr1=mysql_fetch_array($query1)){
	  
	  if($dbarr1['status']==""){
		  $status2= "รอการตอบรับ";
		  $color="";
	  }else if($dbarr1['status']=="รับทราบ"){
		  $status2=$dbarr1['status'];
		  $color="#FFFF99";//เหลือง
	  }else if($dbarr1['status']=="อนุมัติ"){
		  $status2=$dbarr1['status'];
		  $color="#84BC30";//เขียว
	  }else if($dbarr1['status']=="ไม่อนุมัติ"){
		  $status2=$dbarr1['status'];
		  $color= "#FF9393";//แดง
	  }else if($dbarr['status']=="ยกเลิก"){
		  $status2=$dbarr1['status'];
		  $color= "#FF9393";//แดง
	 }
	  $date_regis1 = substr($dbarr1['date_regis'],8,2)."-".substr($dbarr1['date_regis'],5,2)."-".substr($dbarr1['date_regis'],0,4);

echo"  <tr bgcolor='$color'>
    <td>$i</td>
    <td>$date_regis1</td>
    <td>$dbarr1[hn]</td>
    <td>$dbarr1[ptname]</td>
    <td>$dbarr1[doctor]</td>
    <td>$dbarr1[bed]</td>
    <td>$dbarr1[ward]</td>
	<td>$status2</td>
	<td>$dbarr1[comment]</td>
	<td>$dbarr1[officer_con]</td>
	<td><a href='booking_edit.php?row_id=$dbarr1[row_id]'>แก้ไข</a></td>";
echo "<td>";
?>
<a href="JavaScript:if(confirm('คุณต้องการลบข้อมูลการจอง  HN :<?=$dbarr1['hn']?> หรือไม่ ')==true){window.location='booking_del.php?id_del=<?=$dbarr1['row_id'];?>';}">ลบ</a>
<?
echo  "</td>
<td align=\"center\"><a href='booking_print.php?row_id=$dbarr1[row_id]'>พิมพ์</a></td>

</tr>";
  $i++;
    }// ปิด while
echo "</table>";

  }else{
	echo "<font class='forntsarabun'>ไม่พบเตียงจองวันนี้ : $show_today</font><br>";
	}

echo "<br><br>";	
	//////////////จองพรุ่งนี้///////////////////

$todayy1=date("Y")+543;
$todaym1=date("m");
$todayd1=date("d")+1;

	if($todayd1<=9){
		$todayd1="0".$todayd1;		
	}else{
		$todayd1=$todayd1;
	}

$today1=$todayy1.'-'.$todaym1.'-'.$todayd1;
$show_today1=$todayd1.'-'.$todaym1.'-'.$todayy1;

	$sql2="SELECT * FROM  booking  WHERE  date_in  like '".$today1."%' ";
    $query2 = mysql_query($sql2); 
	$row2=mysql_num_rows($query2);
	$ii=1;
	
	
	
	if($row2){
	echo "<div class=\"forntsarabun\">เตียงจองพรุ่งนี้ : $show_today1</div><hr>";
	
	echo "<table border='1' cellspacing='0' cellpadding='0' class='forntsarabun' style=\"border-collapse:collapse\" bordercolor=\"#000000\" width=\"100%\" > 
  <tr bgcolor=\"#CCCCCC\" align=\"center\">
    <td>#</td>
	<td>ว/ด/ป ที่จอง</td>
	<td>HN</td>
    <td>ชื่อ-สกุล</td>
    <td>แพทย์</td>
    <td>เตียง/ห้อง</td>
    <td>หอผู้ป่วย</td>
	<td>สถานะ</td>
	<td>หมายเลขเตียง</td>
	<td>ผู้อนุมัติ</td>
	<td>แก้ไข</td>
	<td>ลบ</td>
	<td>ใบจอง</td>
  </tr>";
  while($dbarr2=mysql_fetch_array($query2)){
	  
	  if($dbarr2['status']==""){
		  $status3= "รอการตอบรับ";
		  $color="";
	  }else if($dbarr2['status']=="รับทราบ"){
		  $status3=$dbarr2['status'];
		  $color="#FFFF99";//เหลือง
	  }else if($dbarr2['status']=="อนุมัติ"){
		  $status3=$dbarr2['status'];
		  $color="#84BC30";//เขียว
	  }else if($dbarr2['status']=="ไม่อนุมัติ"){
		  $status3=$dbarr2['status'];
		  $color= "#FF9393";//แดง
	  }else if($dbarr2['status']=="ยกเลิก"){
		  	 $status3=$dbarr2['status'];
			 $color= "#FF9393";//แดง
	 }
	  $date_regis2 = substr($dbarr2['date_regis'],8,2)."-".substr($dbarr2['date_regis'],5,2)."-".substr($dbarr2['date_regis'],0,4);
echo"  <tr bgcolor='$color'>
    <td>$ii</td>
    <td>$date_regis2</td>
    <td>$dbarr2[hn]</td>
    <td>$dbarr2[ptname]</td>
    <td>$dbarr2[doctor]</td>
    <td>$dbarr2[bed]</td>
    <td>$dbarr2[ward]</td>
	<td>$status3</td>
	<td>$dbarr2[comment]</td>
	<td>$dbarr2[officer_con]</td>
	<td><a href='booking_edit.php?row_id=$dbarr2[row_id]'>แก้ไข</a></td>";
echo "<td>";
?>
<a href="JavaScript:if(confirm('คุณต้องการลบข้อมูลการจอง  HN :<?=$dbarr2['hn']?> หรือไม่ ')==true){window.location='booking_del.php?id_del=<?=$dbarr2['row_id'];?>';}">ลบ</a>
<?
echo  "</td>
<td align=\"center\"><a href='booking_print.php?row_id=$dbarr2[row_id]'>พิมพ์</a></td>
</tr>";
  $ii++;
    }// ปิด while
echo "</table>
";

  }else{
	echo "<font class='forntsarabun'>ไม่พบเตียงจองพรุ่งนี้ : $show_today1</font><br>";
	}
	
	mysql_close();
?>
</body>
</html>