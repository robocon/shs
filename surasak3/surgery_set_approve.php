<?php
session_start();
include 'connect.php';
include 'function.php';
?>
<title>รับทราบข้อมูลใบ SET ผ่าตัด</title>
<script src="sweetalert/jquery-3.6.0.js"></script>
<script src="sweetalert/sweetalert2@11.js"></script>
<style type="text/css">
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.forntsarabun1 {
	font-family: "TH SarabunPSK";
	font-size: 16px;
}
    tr:nth-child(even) { background-color:#FFFFFF; }
    tr:nth-child(odd) { background-color:#EBEDEF; }
    tr:first-child {background-color:#F5B7B1;}
</style>
<?	
	$sql1="SELECT * FROM  surgery_set  WHERE active='' order by date_surg, row_id";
    $query1 = mysql_query($sql1); 
	$row1=mysql_num_rows($query1);
	$i=1;

	if($row1){
		echo "<div class=\"forntsarabun\">ข้อมูลใบ SET ผ่าตัดใหม่ทั้งหมด</div><hr>";
		
	echo "<table border='1' cellspacing='0' cellpadding='0' class='forntsarabun' style=\"border-collapse:collapse\" bordercolor=\"#000000\" width=\"100%\"> 
  <tr bgcolor=\"#F5B7B1\" align=\"center\">
    <td>ลำดับ</td>
    <td>วัน/เดือน/ปี</td>
	<td>เวลา</td>
	<td>HN</td>
	<td>AN</td>
    <td>ชื่อ-สกุล</td>
	<td>อายุ</td>
	<td>สิทธิการรักษา</td>
    <td>แพทย์</td>	
    <td>Diag</td>
    <td>Operation</td>
	<td>หอผู้ป่วย</td>
	<td>สถานะ</td>
	<td width='6%'>เอกสาร</td>
	<td width='8%'>รับทราบ</td>
  </tr>";
  while($dbarr1=mysql_fetch_array($query1)){
	$surgery_date=date_th($dbarr1["date_surg"]);  
	if($dbarr1['status']=="Y"){
		$status="ใช้งาน";
	}else{
		$status="<div style='color:red;'>ยกเลิก</div>";
	}	
	
echo"  <tr>
    <td align='center'>$i</td>
    <td>$surgery_date</td>
	<td>$dbarr1[surgery_time]</td>
    <td>$dbarr1[hn]</td>
	<td>$dbarr1[an]</td>
    <td>$dbarr1[ptname]</td>
    <td>$dbarr1[age]</td>
    <td>$dbarr1[ptright]</td>
    <td>$dbarr1[doctor]</td>
    <td>$dbarr1[diage]</td>
	<td>$dbarr1[operation]</td>
    <td>$dbarr1[ward]</td>
	<td>$status</td>";
	echo "<td align='center'><a href='surgery_set_from_print.php?id=$dbarr1[row_id]' target='_blank'><img src='images/search-blue.png' height='32' width='32'></a></td>";
	if($dbarr1['active']==""){
		echo "<td align='center'><a href='surgery_set_approve.php?confirm=2&row_id=$dbarr1[row_id]'><img src='images/approve-green.png' height='32' width='32'></a></td>";
	}
	echo  "</tr>";
  	$i++;
    }// ปิด while
echo "</table>";

  }else{
	echo "<div align='center' class='forntsarabun' style='color:red;'><h1>ไม่พบข้อมูลใบ SET ผ่าตัด เพิ่มเติม </h1></div><br>
	<div align='center'><img src='images/close-shop.png' width='72' height='72' onclick='javascript:window.close()'><br><div style='font-size:14px; color:blue;'>ปิดหน้าต่างนี้</div></div>
	";
	}
//*******รับทราบ**********//

if(isset($_GET['confirm'])){
	if($_GET['confirm']=="2"){
		$sql = "update surgery_set set active='รับทราบ', officer_surgery='".$_SESSION['sOfficer']."',approve_date='".date("Y-m-d H:i:s")."' where row_id= '".$_GET['row_id']."'  ";
		$objQuery=mysql_query($sql);
		
		if($objQuery){
			echo "<script>
				$(document).ready(function() {
				Swal.fire({
					title: 'Success',
					text: 'รับทราบข้อมูลเรียบร้อย !',
					icon: 'success',
					timer: 5000,
					showConfirmButton: false
					});
				})
			</script>";
			header("refresh:1; url=surgery_set_approve.php");
		}else{
			echo "<script>
				$(document).ready(function() {
				Swal.fire({
					title: 'ผิดพลาด',
					text: 'ดำเนินการไม่สำเร็จ !',
					icon: 'error',
					timer: 5000,
					showConfirmButton: false
					});
				})
			</script>";
			header("refresh:1; url=surgery_set_approve.php");
		}
	}
}

mysql_close();
?>