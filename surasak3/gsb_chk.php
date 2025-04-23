<?php 
session_start();
//include("connect.inc");
if(empty($_SESSION['sOfficer']))
{
    echo 'หมดอายุการใช้งาน กรุณา<a href="../nindex.htm">Login</a>อีกครั้ง';
    exit;
}
include 'bootstrap.php';
$db = Mysql::load();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตรวจสอบสิทธิการรักษาพยาบาล</title>

    <link rel="stylesheet" href="w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><style type="text/css">
<!--
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
-->
</style></head>
<style>
body {
	background-color: #60c4b8;
    font-family: "TH SarabunPSK";
        font-size: 24px;
    }
.chk_table{
    border-collapse: collapse;
}
.chk_table th,
.chk_table td{
    padding: 3px;
    border: 1px solid black;
}
</style>
<body>
<div align="center" style="margin-top:20px;"><a href="../nindex.htm" class="w3-button w3-blue"><i class="fa fa-home" aria-hidden="true">&nbsp;หน้าหลัก ร.พ.</i></a> || <a href="opdcard.php" class="w3-button w3-blue">ลงทะเบียนผู้ป่วยใหม่</a>  || <a href="ophn.php" class="w3-button w3-blue">ลงทะเบียนด้วย HN</a> || <a href="opidno.php" class="w3-button w3-blue">ลงทะเบียนด้วยเลขที่บัตรประชาชน</a>
</div>
<div align="center">
<p style="font-size:36px;"><b>ตรวจสอบสิทธิการรักษาพยาบาลเจ้าหน้าที่ธนาคารออมสิน (V.5.5.64)</b></p>
<form action="gsb_chk.php" method="post">
<table width="90%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <td width="34%" align="right"><label><strong>เลขที่บัตรประชาชน</strong></label></td>
    <td width="33%"><input class="w3-input w3-border w3-light-grey" type="text" id="idcard" name="idcard" autofocus></td>
    <td width="33%"><button type="submit" class="w3-btn w3-yellow"><strong> ตรวจสอบข้อมูล </strong></button></td>
  </tr>
</table>   
    <div><strong>ตัวอย่างเช่น 1529900000001 (ไม่ต้องใส่เครื่อง -)</strong></div>
    <div>
        <input type="hidden" name="action" value="search">
    </div>
</form>
</div>
<?php 
$action = $_REQUEST['action'];
if ($action==='search'){

    $idcard = $_REQUEST['idcard'];
    
    $sql = "SELECT * FROM gsbdata WHERE Idcard = '$idcard' ";
	//echo $sql;
    $result = mysql_query($sql) or die("ไม่สามารถค้นหาข้อมูลได้");
    $num = mysql_num_rows($result);
	$rows = mysql_fetch_array($result);
	$ptname = $rows["Title"]." ".$rows["Name"]."&nbsp;&nbsp;".$rows["Lname"];
	$position = $rows["Group_Name"];
	$idcard = $rows["Idcard"];
        if(empty($num)){
          echo "<h3 class='w3-pink' align='center' style='color:red; height: 50px;'>ไม่พบสิทธิ์! ในรายชื่อเจ้าหน้าที่ธนาคารออมสิน</h3>";
        }else{
	  echo "<h3 class='w3-green' align='center' style='color:green; height: 50px;'>พบสิทธิ์! ในรายชื่อเจ้าหน้าที่ธนาคารออมสิน</h3>";
	  echo "<h4 align='center' style='color:black'>เลขที่บัตรประชาชน : $idcard</h4>";
	  echo "<h4 align='center' style='color:black'>ชื่อ - นามสกุล : $ptname</h4>";
	   echo "<h4 align='center' style='color:black'>หน่วยงาน/สาขา : $position</h4>";
	}//end if result

}//end if action search
?>
</body>
</html>
      