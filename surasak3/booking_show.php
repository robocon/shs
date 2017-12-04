<? 
	session_start();
	include("../Connections/connect.inc.php"); 
?>
<title>รับทราบข้อมูลการจองเตียง</title>
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
<?
//*******จองเตียงใหม่**********//
	if(isset($_GET['code'])&&substr($_GET['code'],0,2)=="42"){
		$where1 = "and ward='หอผู้ป่วยรวม' ";
	}elseif(isset($_GET['code'])&&substr($_GET['code'],0,2)=="43"){
		$where1 = "and ward='หอผู้ป่วยสูตินรี' ";
	}elseif(isset($_GET['code'])&&substr($_GET['code'],0,2)=="44"){
		$where1 = "and ward='หอผู้ป่วยหนัก(icu)' ";
	}elseif(isset($_GET['code'])&&substr($_GET['code'],0,2)=="45"){
		$where1 = "and ward='หอผู้ป่วยพิเศษ' ";
	}
	
	$sql1="SELECT * FROM  booking  WHERE  status='' $where1";
    $query1 = mysql_query($sql1); 
	$row1=mysql_num_rows($query1);
	$i=1;
	
	if($row1){
		echo "<div class=\"forntsarabun\">การจองเตียงใหม่ทั้งหมด</div><hr>";
		
	echo "<table border='1' cellspacing='0' cellpadding='0' class='forntsarabun' style=\"border-collapse:collapse\" bordercolor=\"#000000\" width=\"100%\"> 
  <tr bgcolor=\"#CCCCCC\" align=\"center\">
    <td>ลำดับ</td>
    <td>ว/ด/ป ที่จอง</td>
	<td>HN</td>
    <td>ชื่อ-สกุล</td>
    <td>แพทย์</td>
    <td>เตียง/ห้อง</td>
    <td>หอผู้ป่วย</td>
    <td>ว/ด/ป รับป่วย</td>
	<td>สถานะ</td>
	<td>รับทราบ</td>
  </tr>";
  while($dbarr1=mysql_fetch_array($query1)){
	  
	  if($dbarr1['status']==""){
		  $status2= "รอการตอบรับ";
	  }else{
		  $status2=$dbarr1['status'];
	  }
	  $date_in = substr($dbarr1['date_in'],8,2)."-".substr($dbarr1['date_in'],5,2)."-".substr($dbarr1['date_in'],0,4);
	  $date_regis = substr($dbarr1['date_regis'],8,2)."-".substr($dbarr1['date_regis'],5,2)."-".substr($dbarr1['date_regis'],0,4);
echo"  <tr>
    <td align='center'>$i</td>
    <td>$date_regis</td>
    <td>$dbarr1[hn]</td>
    <td>$dbarr1[ptname]</td>
    <td>$dbarr1[doctor]</td>
    <td>$dbarr1[bed]</td>
    <td>$dbarr1[ward]</td>
    <td>$date_in</td>
	<td>$status2</td>";
	if($dbarr1['status']==""){
		echo "<td><a href='booking_show.php?confirm=2&row_id=$dbarr1[row_id]&code=$_GET[code]'>รับทราบ</a></td>";
	}
	echo  "</tr>";
  	$i++;
    }// ปิด while
echo "</table>";

  }else{
	echo "<font class='forntsarabun'>ไม่พบการจองเตียงเพิ่มเติม </font><br>";
	}
//*******จองเตียงใหม่**********//

if(isset($_GET['confirm'])){
	if($_GET['confirm']=="2"){
		$sql = "update booking set status='รับทราบ',officer_con='".$_SESSION['sOfficer']."' where row_id= '".$_GET['row_id']."'  ";
		mysql_query($sql);
		?>
		<script>
        	window.location.href="booking_show.php?code=<?=$_GET['code']?>";
        </script>
		<?
	}
}

mysql_close();
?>