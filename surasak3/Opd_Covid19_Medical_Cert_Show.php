<? 
session_start();
include("connect.inc");
$officer = $_SESSION["sOfficer"];


date_default_timezone_set('Asia/Bangkok');
$Txt_Datetime_d = date("d");
$Txt_Datetime_m = date("m");
$Txt_Datetime_y = date("Y");
$Txt_Datetime_y = $Txt_Datetime_y + 543;

//----> Convert Month
$selmon = $Txt_Datetime_m;
	if($selmon=="01"){
		$mon ="มกราคม";
		$selmon="01";
	}else if($selmon=="02"){
		$mon ="กุมภาพันธ์";
		$selmon="02";
	}else if($selmon=="03"){
		$mon ="มีนาคม";
		$selmon="03";
	}else if($selmon=="04"){
		$mon ="เมษายน";
		$selmon="04";
	}else if($selmon=="05"){
		$mon ="พฤษภาคม";
		$selmon="05";
	}else if($selmon=="06"){
		$mon ="มิถุนายน";
		$selmon="06";
	}else if($selmon=="07"){
		$mon ="กรกฎาคม";
		$selmon="07";
	}else if($selmon=="08"){
		$mon ="สิงหาคม";
		$selmon="08";
	}else if($selmon=="09"){
		$mon ="กันยายน";
		$selmon="09";
	}else if($selmon=="10"){
		$mon ="ตุลาคม";
		$selmon="10";
	}else if($selmon=="11"){
		$mon ="พฤศจิกายน";
		$selmon="11";
	}else if($selmon=="12"){
		$mon ="ธันวาคม";
		$selmon="12";
	}//end if

////////////////////////////////////////////////////////////////////


//-----> sql หมอ
$sql = "SELECT row_id, yot , name , doctorcode FROM doctor WHERE status = 'y' AND row_id = '".$_POST['doctor']."' ";

$query = mysql_query($sql); 
$num = mysql_num_rows($query);

if(empty($num)){
  echo "<h1 align='center'>ไม่พบข้อมูล</h1>";echo "<br>".exit();
}//end if

while($rows = mysql_fetch_array($query)){

	$Doctor_Rowid = $rows["row_id"];
	$Doctor_Yot = $rows["yot"];
	$Doctor_Name = $rows["name"];
	$Doctor_Code = $rows["doctorcode"];

  }//end while


////////////////////////////////////////////////////////////////////
 
 
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 16pt;
	margin-top: 1.5cm;
    margin-left: 2cm;
    margin-right: 1cm;
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
	font-size: 16pt;
}
.txt1 {	font-family: TH SarabunPSK;
	font-size: 16pt;
}

p {
    text-decoration: none;
    border-bottom: 0.5px dotted black;
}

font.txt_dotted {
	 
    text-decoration: none;
    border-bottom: 0.5px dotted black;
}

#table1 {
  border-collapse: collapse;
}
#printable { display: block; }
@media print { 
     #non-printable { display: none; } 
     #printable { page-break-after:always; } 
} 
.style1 {font-weight: bold}


 
-->
</style>

<title>ใบรับรองแพทย์โรงพยาบาลค่ายสุรศักดิ์มนตรี</title>
<body onload="window.print()">
<div id="mybox">
<table align="center">
    <tr align="center">
        <td ><center><img src="http://www.surasakhospital.mi.th/egp/images/logo.jpg" width="50" height="70"></center></td>
        <td style="padding-top: 20px;"><h3 align="center"><b>ใบรับรองแพทย์โรงพยาบาลค่ายสุรศักดิ์มนตรี</b></h3></td>
    </tr>  
</table>
<br><br><br>
<table align="left">
    <tr align="left">
        <td width="80px">เลขที่เอกสาร</td>
        <td width="100px" align="center"><p><? echo $_POST['runno']; ?></p></td>
    </tr>  
</table> 
<table align="right">
    <tr align="left">
        <td width="30px">วันที่</td>
        <td width="150px" align="center"><p><? echo $Txt_Datetime_d." ".$mon." ".$Txt_Datetime_y; ?></p></td>
    </tr>  
</table>
<br><br><br>

<table align="left">
    <tr align="left">
        <td width="40px">ข้าพเจ้า</td>
        <td width="400px" align="center"><p><? echo $Doctor_Yot." ".$Doctor_Name; ?></p></td>
		<td width="200px" align="center"> ใบประกอบวิชาชีพ </td>
        <td width="100px" align="center"><p><? echo $Doctor_Code; ?></p></td>
    </tr>  
</table>
<br><br><br>
<table align="left">
    <tr align="left">
        <td width="150px">แพทย์ประจำห้องตรวจ </td>
        <td width="500px" align="center"><p><? echo "คลีนิค ARI (ติดเชื้อระบบทางเดินหายใจ)"; ?></p></td> 
    </tr>  
</table>

<br><br><br>

<table align="left">
    <tr align="left">
        <td width="180px">ได้ทำการตรวจร่างกายของ </td>
        <td width="350px" align="center"><p><? echo $_POST['ptname']; ?></p></td>
		<td width="20px">HN </td>
        <td width="100px" align="center"><p><? echo $_POST['hn']; ?></p></td> 
    </tr>  
</table>

<br><br><br> 

<table align="left">
    <tr align="left">
        <td width="100px">ด้วยโรค </td> 
    </tr>  
	<tr align="left"> 
        <td width="800px" height="20px" align="left" ><p ><font class="txt_dotted">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo $_POST['diagnosis']; ?></font></p></td> 
    </tr> 
	<tr align="left"> 
		<td width="800px" height="7px" align="left" ></td>
    </tr>
	<tr align="left"> 
		<td width="800px" height="20px" align="left" ><p></p></td>
    </tr>
	<tr align="left"> 
		<td width="800px" height="20px" align="left" ><p></p></td>
    </tr>
</table>

<br><br><br><br>  

<table align="left">
    <tr align="left">
        <td width="120px">มีความเห็นว่า </td> 
    </tr> 
	<tr align="left"> 
	<td width="800px" height="20px" align="left" ><p><font class="txt_dotted">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo $_POST['comment']; ?></font></p></td>
    </tr>
	<tr align="left"> 
		<td width="800px" height="7px" align="left" ></td>
    </tr>
	<tr align="left"> 
		<td width="800px" height="20px" align="left" ><p></p></td>
    </tr>
	<tr align="left"> 
		<td width="800px" height="20px" align="left" ><p></p></td>
    </tr>    
</table>
 
<br><br><br>
<br><br><br>
<br><br><br>
<br><br><br>
  

<table align="right">
    <tr align="center"> 
        <td width="300px">ลงนาม.............................. แพทย์ผู้ตรวจ</td> 
    </tr>  
</table>
<table align="left">
    <tr align="left"> 
        <td  style=" clear: both;
    position: relative;
    height: 1px;
    margin-top: -200px;"><font size="1px">ผู้พิมพ์รายงาน : <? echo $_POST['officer']; ?></font></td> 
    </tr>  
</table>
 
<? exit(); ?>
 
</center>
</div>

