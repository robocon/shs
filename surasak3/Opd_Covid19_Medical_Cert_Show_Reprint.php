<? 
session_start();
include("connect.inc");
$officer = $_SESSION["sOfficer"];
if($_SESSION["sOfficer"] == ""){
	
	echo "<center><font color='#000000' >ขออภัยครับ การ Login ของท่านหมดอายุ </font><br />";
	echo "<a href=\"../sm3.php\" target=\"_top\">กลับหน้าแรก</a></center>";
exit();
}//end if


$hn = $_GET["hn"];
$vn = $_GET["vn"];
$runno = $_GET["doc_no"];
//echo "$hn | $vn | $rowid";
//$day = $_GET["day1"];
//$month = $_GET["month1"];
//$year_th = $_GET["year1"];
$Txt_DateTime = date("H:m:s");
//$year_eng = $year_th-543;



date_default_timezone_set('Asia/Bangkok');
$Txt_Datetime_d = date("d");
$Txt_Datetime_m = date("m");
$Txt_Datetime_y = date("Y");
$Txt_Datetime_y = $Txt_Datetime_y + 543;

//-----> sql OPSI
$sql = "SELECT * FROM opselfisolation_detail WHERE hn = '".$hn."' AND vn = '".$vn."' ";
//echo $sql;
$query = mysql_query($sql); 
$num = mysql_num_rows($query);

if(empty($num)){
  echo "<h1 align='center'>ไม่พบข้อมูล</h1>";echo "<br>".exit();
}//end if

while($rows = mysql_fetch_array($query)){
	$doctor_code = substr($rows["doctor"],0,5);
	$doctor = substr($rows["doctor"],5); 
	$doctor_licenses = $rows["doctor_licenses"]; 
	$ptname = $rows["ptname"]; 
	$symptom_date_y = substr($rows["symptom_date"],0,4)+543;
  	$symptom_date_m = substr($rows["symptom_date"],5,2);
  	$symptom_date_d = substr($rows["symptom_date"],8,2);
    	$symptom_date = $symptom_date_d."/".$symptom_date_m."/".$symptom_date_y; 

	$dcdate_y = substr($rows["dcdate"],0,4)+543;
	$dcdate_m = substr($rows["dcdate"],5,2);
	$dcdate_d = substr($rows["dcdate"],8,2);
		$dcdate = $dcdate_d."/".$dcdate_m."/".$dcdate_y;
 
	$registerdate_y = substr($rows["registerdate"],0,4)+543;
	$registerdate_m = substr($rows["registerdate"],5,2);
	$registerdate_d = substr($rows["registerdate"],8,2);
		//$Temp_Date = $registerdate_d."/".$registerdate_m."/".$registerdate_y;

  }//end while



//----> Convert Month
//$selmon = $month;
$selmon = $registerdate_m;
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
	//$Temp_Date = $day." ".$mon." ".$year_th;
	//$Temp_Date = $Txt_Datetime_d." ".$mon." ".$Txt_Datetime_y;
	$Temp_Date = $registerdate_d." ".$mon." ".$registerdate_y;
 

////////////////////////////////////////////////////////////////////

//-----> sql หมอ
$sql = "SELECT * FROM doctor WHERE status = 'y' AND name like '%$doctor_code%' ";

$query = mysql_query($sql); 
$num = mysql_num_rows($query);

if(empty($num)){
  echo "<h1 align='center'>ไม่พบข้อมูล</h1>";echo "<br>".exit();
}//end if

while($rows = mysql_fetch_array($query)){

	$Doctor_Rowid = $rows["row_id"];
	$Doctor_Yot = $rows["yot"];
	$Doctor_Name = substr($rows["name"],5);
	$Doctor_Code = $rows["doctorcode"];

  }//end while

//////////////////////////////////////////////////////////////////

/////////////////// เก็บ Log การพิมพ์ //////////////////////////////

//-----> log
$sql = " INSERT INTO log_ecert (
    Id  ,
    UserPrint ,
    DatePrint ,
    HN ,
    Type ,
    Desc_Type , 
    Code_RowidVn ,
	Flag_Reprint
    )
    VALUES ( '','$officer','$Txt_Datetime $Txt_DateTime','".$_GET['hn']."','CO','ใบรับรองแพทย์ Covid-19','".$_GET['doc_no']."','Y' )";
//echo $sql;exit();
$query = mysql_query($sql);  

if(!$query){
	echo "<h1 align='center'>Log Save Error : (Code : C)</h1>";echo "<br>".exit();
}//end if
 
//////////////////////////////////////////////////////////////////


 

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
        <td ><center><img src="/sm3/surasak3/Img_Meddical_Cert/logo.jpg" width="50" height="70"></center></td> 
    </tr>  
</table>
<table align="center">
    <tr align="center"> 
        <td style="padding-top: 20px;"><h3 align="center"><b>ใบรับรองแพทย์โรงพยาบาลค่ายสุรศักดิ์มนตรี</b></h3></td>
    </tr>  
</table>
<table align="left">
	<tr align="left">
		<td width="200px">ที่ กห 0483.63.4</td>  
    </tr> 
</table>
<table align="right"> 
	<tr align="right">
	<td width="80px">เลขที่เอกสาร</td>
        <td width="200px" align="center"><p><? echo $runno; ?></p></td>
    </tr>   
</table>
<br><br>
<table align="right"> 
    <tr align="right"> 
		<td align="right">1 หมู่ 1 ตำบล พิชัย อำเภอเมืองลำปาง ลำปาง 52000</td> 
    </tr>  
</table>
<br><br>  
<table align="right" width="270">
    <tr align="right">
        <td width="30px" align="left" >วันที่</td>
        <td width="150px" align="center"><p><? echo $Temp_Date; ?></p></td>
    </tr>  
</table>
<br> 

<table align="left">
    <tr align="left">
        <td width="40px">ข้าพเจ้า</td>
        <td width="400px" align="center"><p><? echo $Doctor_Yot." ".$doctor; ?></p></td>
		<td width="200px" align="center"> ใบประกอบวิชาชีพ </td>
        <td width="100px" align="center"><p><? echo "ว.".substr($doctor_licenses,4); ?></p></td>
    </tr>  
</table>
<br> 
<table align="left">
    <tr align="left">
        <td width="150px">แพทย์ประจำห้องตรวจ </td>
        <td width="500px" align="center"><p><? echo "คลินิก ARI (ติดเชื้อระบบทางเดินหายใจ)"; ?></p></td> 
    </tr>  
</table>

<br> 

<table align="left">
    <tr align="left">
        <td width="180px">ได้ทำการตรวจร่างกายของ </td>
        <td width="350px" align="center"><p><? echo $ptname; ?></p></td>
		<td width="20px">HN </td>
        <td width="100px" align="center"><p><? echo $hn; ?></p></td> 
    </tr>  
</table>

<br><br><br>

<table align="left">
    <tr align="left">
        <td width="100px">ด้วยโรค </td> 
    </tr>  
	<tr align="left"> 
        <td width="800px" height="20px" align="left" ><p ><font class="txt_dotted">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo "ติดเชื้อเข้าข่ายโควิด - 19 (ATK positive)"; ?></font></p></td> 
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

<br> 

<table align="left">
    <tr align="left">
        <td width="120px">มีความเห็นว่า </td> 
    </tr> 
	<tr align="left"> 
	<td width="800px" height="20px" align="left" ><p><font class="txt_dotted">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo "ได้มาตรวจจริง ให้รักษาแบบผู้ป่วยนอกและแยกกักตัว 5 วัน ($symptom_date ถึง $dcdate)"; ?></font></p></td>
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
	<tr align="center"> 
        <td width="300px">( <? echo $Doctor_Yot." ".$doctor; ?> )</td> 
    </tr> 
</table>
<table align="left">
    <tr align="left"> 
        <td  style=" clear: both;
    position: relative;
    height: 1px;
    margin-top: -200px;"><font size="1px">ผู้พิมพ์รายงาน : <? echo $officer; ?><br>เอกสาร Re-Print</font></td> 
    </tr>  
</table>
 
<? exit(); ?>
 
</center>
</div>

