<? 
	session_start();
?>
<title>ตรวจสอบข้อมูลการจอง</title>
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
<form name="f1" action="" method="post">
<table  border="0" cellpadding="3" cellspacing="3">
  <tr class="forntsarabun">
    <td colspan="2"  align="center" bgcolor="#CCCCCC" class="forntsarabun">ตรวจสอบข้อมูลการจองเตียง</td>
    </tr>
  <tr class="forntsarabun">
    <td  align="right" class="forntsarabun">วันที่</td>
    <td ><select name="d_start">
	<?
	$d=date("d");
	for($i=1;$i<=31;$i++){
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
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="ค้นหา"/>&nbsp;&nbsp;<a href="../../nindex.htm" class="forntsarabun">กลับเมนูหลัก</a>&nbsp;&nbsp;
      </td>
  </tr>
</table>
</form>
<br />

<?
if($_POST['submit']){

	include("../Connections/connect.inc.php"); 
	
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
	

	if(isset($_GET['code'])&&substr($_GET['code'],0,2)=="42"){
		$where1 = "and ward='หอผู้ป่วยรวม' ";
	}elseif(isset($_GET['code'])&&substr($_GET['code'],0,2)=="43"){
		$where1 = "and ward='หอผู้ป่วยสูตินรี' ";
	}elseif(isset($_GET['code'])&&substr($_GET['code'],0,2)=="44"){
		$where1 = "and ward='หอผู้ป่วยหนัก(icu)' ";
	}elseif(isset($_GET['code'])&&substr($_GET['code'],0,2)=="45"){
		$where1 = "and ward='หอผู้ป่วยพิเศษ' ";
	}
	
	$sql="SELECT * FROM  booking  WHERE  date_in  like '".$date1."%' $where1";
    $query = mysql_query($sql)or die (mysql_error()); 
	$row=mysql_num_rows($query);
	//echo $sql;
	
	
	$i=1;
	if($row){
		echo "<div class=\"forntsarabun\">ข้อมูลการจองเตียง $day : $dateshow      </div>";
		
		
		echo "<table border='1' cellspacing='0' cellpadding='0' class='forntsarabun' style=\"border-collapse:collapse\" bordercolor=\"#000000\"> 
  <tr bgcolor=\"#CCCCCC\" align=\"center\">
    <td>ลำดับ</td>
    <td>ว/ด/ป ที่จอง</td>
    <td>ชื่อ-สกุล</td>
    <td>HN</td>
    <td>แพทย์</td>
    <td>เตียง/ห้อง</td>
    <td>หอผู้ป่วย</td>
    <td>ว/ด/ป รับป่วย</td>
	<td>สถานะ</td>
	<td>อนุมัติ</td>
	<td>ไม่อนุมัติ</td>
  </tr>";
	  while($dbarr=mysql_fetch_array($query)){
		  if($dbarr['status']==""){
			  $status1= "รอการตอบรับ";
			  $color="";
		  }else if($dbarr['status']=="รับทราบ"){
			  $status1=$dbarr['status'];
			  $color="#FFFF99";//เหลือง
		  }else if($dbarr['status']=="อนุมัติ"){
			  $status1=$dbarr['status'];
			  $color="#84BC30";//เขียว
		  }else if($dbarr['status']=="ไม่อนุมัติ"){
			  $status1=$dbarr['status'];
			  $color= "#FF9393";//แดง
		  }else{
		  	 $status1=$dbarr['status'];
			 $color= "#FF9393";//แดง
		  }
		  	$date_regis = substr($dbarr['date_regis'],8,2)."-".substr($dbarr['date_regis'],5,2)."-".substr($dbarr['date_regis'],0,4);
	  		$date_in = substr($dbarr['date_in'],8,2)."-".substr($dbarr['date_in'],5,2)."-".substr($dbarr['date_in'],0,4);
		echo "<tr bgcolor='$color'>
			<td align='center'>$i</td>
			<td>$date_regis</td>
			<td>$dbarr[ptname]</td>
			<td>$dbarr[hn]</td>
			<td>$dbarr[doctor]</td>
			<td>$dbarr[bed]</td>
			<td>$dbarr[ward]</td>
			<td>$date_in</td>
			<td>$status1</td>";
			if($dbarr['status']=="รับทราบ"){
			?>
				<td><a href='booking_ok.php?row_id=<?=$dbarr['row_id']?>&code=<?=$_GET['code']?>'>อนุมัติ</a></td>
				<td><a href='booking_confirm.php?confirm=0&row_id=<?=$dbarr['row_id']?>&code=<?=$_GET['code']?>' onclick='return confirm("ไม่อนุมัติการจองเตียง?")'>ไม่อนุมัติ</a></td>
            <?
			}
			elseif($dbarr['status']==""){
			?>
				<td><a href='booking_ok.php?row_id=<?=$dbarr['row_id']?>&code=<?=$_GET['code']?>'>อนุมัติ</a></td>
				<td><a href='booking_confirm.php?confirm=0&row_id=<?=$dbarr['row_id']?>&code=<?=$_GET['code']?>' onclick='return confirm("ไม่อนุมัติการจองเตียง?")'>ไม่อนุมัติ</a></td>
            <?
			}elseif($dbarr['status']=="อนุมัติ"){
				echo "<td colspan='2'>หมายเลขเตียง :$dbarr[comment]</td>";
			}
		echo  "</tr>";
		$i++;
	  }// ปิด while
	echo "</table>";
	
	}else{
		echo "<font class='forntsarabun'>ไม่พบการจองเตียง   $dateshow </font><br>";
		//echo "<a href='booking.php' class='forntsarabun'>จองเตียงผู้ป่วยใน</a><hr />";	
	}
	echo "<hr>";
}// ปิด$_POST['submit']

mysql_close();
?>
<br />
<?	
/////////////////////////การจองเตียงวันนี้///////////////////////////

include("../Connections/connect.inc.php"); 

	if(isset($_GET['code'])&&substr($_GET['code'],0,2)=="42"){
		$where1 = "and ward='หอผู้ป่วยรวม' ";
	}elseif(isset($_GET['code'])&&substr($_GET['code'],0,2)=="43"){
		$where1 = "and ward='หอผู้ป่วยสูตินรี' ";
	}elseif(isset($_GET['code'])&&substr($_GET['code'],0,2)=="44"){
		$where1 = "and ward='หอผู้ป่วยหนัก(icu)' ";
	}elseif(isset($_GET['code'])&&substr($_GET['code'],0,2)=="45"){
		$where1 = "and ward='หอผู้ป่วยพิเศษ' ";
	}
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
	 $dateshow5=$todayd1.' '.$printmonth." ".$todayy1;
	 

	$sql="SELECT * FROM  booking  WHERE  date_regis  like '".$today5."%' $where1";
    $query = mysql_query($sql); 
	$row=mysql_num_rows($query);
	
	
	$i=1;
	if($row){
		echo "<div class=\"forntsarabun\">ข้อมูลการจองเตียง $day : $dateshow5      </div>";
		
		
		echo "<table border='1' cellspacing='0' cellpadding='0' class='forntsarabun' style=\"border-collapse:collapse\" bordercolor=\"#000000\"> 
  <tr bgcolor=\"#CCCCCC\" align=\"center\">
    <td>ลำดับ</td>
    <td>ว/ด/ป ที่จอง</td>
    <td>ชื่อ-สกุล</td>
    <td>HN</td>
    <td>แพทย์</td>
    <td>เตียง/ห้อง</td>
    <td>หอผู้ป่วย</td>
    <td>ว/ด/ป รับป่วย</td>
	<td>สถานะ</td>
	<td>อนุมัติ</td>
	<td>ไม่อนุมัติ</td>
  </tr>";
	  while($dbarr=mysql_fetch_array($query)){
		  if($dbarr['status']==""){
			  $status1= "รอการตอบรับ";
			  $color="";
		  }else if($dbarr['status']=="รับทราบ"){
			  $status1=$dbarr['status'];
			  $color="#FFFF99";//เหลือง
		  }else if($dbarr['status']=="อนุมัติ"){
			  $status1=$dbarr['status'];
			  $color="#84BC30";//เขียว
		  }else if($dbarr['status']=="ไม่อนุมัติ"){
			  $status1=$dbarr['status'];
			  $color= "#FF9393";//แดง
		  }else{
		  	 $status1=$dbarr['status'];
			 $color= "#FF9393";//แดง
		  }
		  	$date_regis = substr($dbarr['date_regis'],8,2)."-".substr($dbarr['date_regis'],5,2)."-".substr($dbarr['date_regis'],0,4);
	  		$date_in = substr($dbarr['date_in'],8,2)."-".substr($dbarr['date_in'],5,2)."-".substr($dbarr['date_in'],0,4);
		echo "<tr bgcolor='$color'>
			<td align='center'>$i</td>
			<td>$date_regis</td>
			<td>$dbarr[ptname]</td>
			<td>$dbarr[hn]</td>
			<td>$dbarr[doctor]</td>
			<td>$dbarr[bed]</td>
			<td>$dbarr[ward]</td>
			<td>$date_in</td>
			<td>$status1</td>";
			if($dbarr['status']=="รับทราบ"){
			?>
				<td><a href='booking_ok.php?row_id=<?=$dbarr['row_id']?>&code=<?=$_GET['code']?>'>อนุมัติ</a></td>
				<td><a href='booking_confirm.php?confirm=0&row_id=<?=$dbarr['row_id']?>&code=<?=$_GET['code']?>' onclick='return confirm("ไม่อนุมัติการจองเตียง?")'>ไม่อนุมัติ</a></td>
            <?
			}
			elseif($dbarr['status']==""){
			?>
				<td><a href='booking_ok.php?row_id=<?=$dbarr['row_id']?>&code=<?=$_GET['code']?>'>อนุมัติ</a></td>
				<td><a href='booking_confirm.php?confirm=0&row_id=<?=$dbarr['row_id']?>&code=<?=$_GET['code']?>' onclick='return confirm("ไม่อนุมัติการจองเตียง?")'>ไม่อนุมัติ</a></td>
            <?
			}elseif($dbarr['status']=="อนุมัติ"){
				echo "<td colspan='2'>หมายเลขเตียง :$dbarr[comment]</td>";
			}
		echo  "</tr>";
		$i++;
	  }// ปิด while
	echo "</table>";
	
	}else{
		echo "<font class='forntsarabun'>ไม่พบการจองเตียง : $dateshow5 </font><br>";
		//echo "<a href='booking.php' class='forntsarabun'>จองเตียงผู้ป่วยใน</a><hr />";	
	}
echo "<hr>";
mysql_close();
//////////////////////////////////จองเตียงวันนี้/////////////////////////////////
?>
<br />
<?


include("../Connections/connect.inc.php"); 

//*******เตียงจองวันนี้**********//
$todayy=date("Y")+543;
$todayd=date("d");
$todaym=date("m");

$today=$todayy.'-'.$todaym.'-'.$todayd;


	switch($todaym){
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
	 $show_today=$todayd.' '.$printmonth.' '.$todayy;
	 
	if(isset($_GET['code'])&&substr($_GET['code'],0,2)=="42"){
		$where1 = "and ward='หอผู้ป่วยรวม' ";
	}elseif(isset($_GET['code'])&&substr($_GET['code'],0,2)=="43"){
		$where1 = "and ward='หอผู้ป่วยสูตินรี' ";
	}elseif(isset($_GET['code'])&&substr($_GET['code'],0,2)=="44"){
		$where1 = "and ward='หอผู้ป่วยหนัก(icu)' ";
	}elseif(isset($_GET['code'])&&substr($_GET['code'],0,2)=="45"){
		$where1 = "and ward='หอผู้ป่วยพิเศษ' ";
	}
	
	$sql1="SELECT * FROM  booking  WHERE  date_in  like '".$today."%' $where1";
    $query1 = mysql_query($sql1); 
	$row1=mysql_num_rows($query1);
	$i=1;
	
	if($row1){
		echo "<div class=\"forntsarabun\">เตียงจองวันนี้ : $show_today</div>";
		
	echo "<table border='1' cellspacing='0' cellpadding='0' class='forntsarabun' style=\"border-collapse:collapse\" bordercolor=\"#000000\"> 
  <tr bgcolor=\"#CCCCCC\" align=\"center\">
    <td>ลำดับ</td>
    <td>ว/ด/ป ที่จอง</td>
    <td>ชื่อ-สกุล</td>
    <td>HN</td>
    <td>แพทย์</td>
    <td>เตียง/ห้อง</td>
    <td>หอผู้ป่วย</td>
    <td>ว/ด/ป รับป่วย</td>
	<td>สถานะ</td>
	<td>อนุมัติ</td>
	<td>ไม่อนุมัติ</td>
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
	  }else{
		  	 $status1=$dbarr['status'];
			 $color= "#FF9393";//แดง
		  }
	  $date_regis1 = substr($dbarr1['date_regis'],8,2)."-".substr($dbarr1['date_regis'],5,2)."-".substr($dbarr1['date_regis'],0,4);
	  $date_in1 = substr($dbarr1['date_in'],8,2)."-".substr($dbarr1['date_in'],5,2)."-".substr($dbarr1['date_in'],0,4);
echo"  <tr bgcolor='$color'>
    <td align='center'>$i</td>
    <td>$date_regis1</td>
    <td>$dbarr1[ptname]</td>
    <td>$dbarr1[hn]</td>
    <td>$dbarr1[doctor]</td>
    <td>$dbarr1[bed]</td>
    <td>$dbarr1[ward]</td>
    <td>$date_in1</td>
	<td>$status2</td>";
	if($dbarr1['status']=="รับทราบ"){
		?>
			<td><a href='booking_ok.php?row_id=<?=$dbarr1['row_id']?>&code=<?=$_GET['code']?>'>อนุมัติ</a></td>
			<td><a href='booking_confirm.php?confirm=0&row_id=<?=$dbarr1['row_id']?>&code=<?=$_GET['code']?>' onclick='return confirm("ไม่อนุมัติการจองเตียง?")'>ไม่อนุมัติ</a></td>
		<?
	}
	elseif($dbarr1['status']==""){
		?>
			<td><a href='booking_ok.php?row_id=<?=$dbarr1['row_id']?>&code=<?=$_GET['code']?>'>อนุมัติ</a></td>
			<td><a href='booking_confirm.php?confirm=0&row_id=<?=$dbarr1['row_id']?>&code=<?=$_GET['code']?>' onclick='return confirm("ไม่อนุมัติการจองเตียง?")'>ไม่อนุมัติ</a></td>
		<?
        }elseif($dbarr1['status']=="ไม่อนุมัติ"){
		?>
			<td><a href='booking_ok.php?row_id=<?=$dbarr1['row_id']?>&code=<?=$_GET['code']?>'>อนุมัติ</a></td>
			<td><a href='booking_confirm.php?confirm=0&row_id=<?=$dbarr1['row_id']?>&code=<?=$_GET['code']?>' onclick='return confirm("ไม่อนุมัติการจองเตียง?")'>ไม่อนุมัติ</a></td>
		<?
	}elseif($dbarr1['status']=="อนุมัติ"){
		echo "<td>หมายเลขเตียง :$dbarr1[comment]</td>";
		?>
	<td><a href='booking_confirm.php?confirm=0&row_id=<?=$dbarr1['row_id']?>&code=<?=$_GET['code']?>' onclick='return confirm("ไม่อนุมัติการจองเตียง?")'>ไม่อนุมัติ</a></td>
		<?
	}
	echo  "</tr>";
  	$i++;
    }// ปิด while
echo "</table>";

  }else{
	echo "<font class='forntsarabun'>ไม่พบเตียงจองวันนี้ : $show_today</font><br>";
	}
echo "<hr>";
echo "<br>";	
//*******จองเตียงวันนี้**********//

//*******จองเตียงพรุ่งนี้**********//

$todayy1=date("Y")+543;
$todaym1=date("m");
$todayd1=date("d")+1;

if($todayd1<=9){
	$todayd1="0".$todayd1;		
}else{
	$todayd1=$todayd1;
}

$today1=$todayy1.'-'.$todaym1.'-'.$todayd1;


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
	$show_today2=$todayd1.' '.$printmonth.' '.$todayy1;
	
	$sql2="SELECT * FROM  booking  WHERE  date_in  like '".$today1."%' $where1";
    $query2 = mysql_query($sql2); 
	$row2=mysql_num_rows($query2);
	$ii=1;
	
	
	
	if($row2){
	echo "<div class=\"forntsarabun\">เตียงจองพรุ่งนี้ : $show_today2</div>";
	
	echo "<table border='1' cellspacing='0' cellpadding='0' class='forntsarabun' style=\"border-collapse:collapse\" bordercolor=\"#000000\"> 
  <tr bgcolor=\"#CCCCCC\" align=\"center\">
    <td>ลำดับ</td>
    <td>ว/ด/ป ที่จอง</td>
    <td>ชื่อ-สกุล</td>
    <td>HN</td>
    <td>แพทย์</td>
    <td>เตียง/ห้อง</td>
    <td>หอผู้ป่วย</td>
    <td>ว/ด/ป รับป่วย</td>
	<td>สถานะ</td>
	<td>อนุมัติ</td>
	<td>ไม่อนุมัติ</td>
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
	  }else{
		  	 $status1=$dbarr['status'];
			 $color= "#FF9393";//แดง
		  }
	  $date_regis2 = substr($dbarr2['date_regis'],8,2)."-".substr($dbarr2['date_regis'],5,2)."-".substr($dbarr2['date_regis'],0,4);
	  $date_in2 = substr($dbarr2['date_in'],8,2)."-".substr($dbarr2['date_in'],5,2)."-".substr($dbarr2['date_in'],0,4);
echo"  <tr bgcolor='$color'>
    <td align='center'>$ii</td>
    <td>$date_regis2</td>
    <td>$dbarr2[ptname]</td>
    <td>$dbarr2[hn]</td>
    <td>$dbarr2[doctor]</td>
    <td>$dbarr2[bed]</td>
    <td>$dbarr2[ward]</td>
    <td>$date_in2</td>
	<td>$status3</td>";
	if($dbarr2['status']=="รับทราบ"){
		?>
			<td><a href='booking_ok.php?row_id=<?=$dbarr2['row_id']?>&code=<?=$_GET['code']?>'>อนุมัติ</a></td>
			<td><a href='booking_confirm.php?confirm=0&row_id=<?=$dbarr2['row_id']?>&code=<?=$_GET['code']?>' onclick='return confirm("ไม่อนุมัติการจองเตียง?")'>ไม่อนุมัติ</a></td>
		<?
	}elseif($dbarr2['status']==""){
		?>
			<td><a href='booking_ok.php?row_id=<?=$dbarr2['row_id']?>&code=<?=$_GET['code']?>'>อนุมัติ</a></td>
			<td><a href='booking_confirm.php?confirm=0&row_id=<?=$dbarr2['row_id']?>&code=<?=$_GET['code']?>' onclick='return confirm("ไม่อนุมัติการจองเตียง?")'>ไม่อนุมัติ</a></td>
		<?
	}elseif($dbarr2['status']=="ไม่อนุมัติ"){
		?>
			<td><a href='booking_ok.php?row_id=<?=$dbarr2['row_id']?>&code=<?=$_GET['code']?>'>อนุมัติ</a></td>
			<td><a href='booking_confirm.php?confirm=0&row_id=<?=$dbarr2['row_id']?>&code=<?=$_GET['code']?>' onclick='return confirm("ไม่อนุมัติการจองเตียง?")'>ไม่อนุมัติ</a></td>
		<?
	}elseif($dbarr2['status']=="อนุมัติ"){
		echo "<td >หมายเลขเตียง :$dbarr2[comment]</td>";
		?>
	<td><a href='booking_confirm.php?confirm=0&row_id=<?=$dbarr2['row_id']?>&code=<?=$_GET['code']?>' onclick='return confirm("ไม่อนุมัติการจองเตียง?")'>ไม่อนุมัติ</a></td>
		<?
	}
	echo  "</tr>";
  	$ii++;
    }// ปิด while
echo "</table>
";

  }else{
	echo "<font class='forntsarabun'>ไม่พบเตียงจองพรุ่งนี้ : $show_today2</font><br>";
	}
echo "<hr>";
echo "<br>";	
//*******จองเตียงพรุ่งนี้**********//

if(isset($_GET['confirm'])){
	if($_GET['confirm']=="0"){
		$sql = "update booking set status='ไม่อนุมัติ' ,officer_con='".$_SESSION['sOfficer']."' where row_id= '".$_GET['row_id']."'  ";
		mysql_query($sql);
		?>
		<script>
        	window.location.href="booking_confirm.php?code=<?=$_GET['code']?>";
        </script>
		<?
	}
}

mysql_close();
?>