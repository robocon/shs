<?
session_start();
include("connect.inc");

$hn = "65-874"; // hn test

//////////////////////////////////////////////////////////////////

date_default_timezone_set('Asia/Bangkok');
$Txt_Datetime_d = date("d");
$Txt_Datetime_m = date("m");
$Txt_Datetime_y = date("Y");
$Txt_Datetime_y = $Txt_Datetime_y + 543;

//----> Convert Month2
$selmon2 = $Txt_Datetime_m;
	if($selmon2=="01"){
		$mon2 ="มกราคม";
		$selmon2="01";
	}else if($selmon2=="02"){
		$mon2 ="กุมภาพันธ์";
		$selmon2="02";
	}else if($selmon2=="03"){
		$mon2 ="มีนาคม";
		$selmon2="03";
	}else if($selmon2=="04"){
		$mon2 ="เมษายน";
		$selmon2="04";
	}else if($selmon2=="05"){
		$mon2 ="พฤษภาคม";
		$selmon2="05";
	}else if($selmon2=="06"){
		$mon2 ="มิถุนายน";
		$selmon2="06";
	}else if($selmon2=="07"){
		$mon2 ="กรกฎาคม";
		$selmon2="07";
	}else if($selmon2=="08"){
		$mon2 ="สิงหาคม";
		$selmon2="08";
	}else if($selmon2=="09"){
		$mon2 ="กันยายน";
		$selmon2="09";
	}else if($selmon2=="10"){
		$mon2 ="ตุลาคม";
		$selmon2="10";
	}else if($selmon2=="11"){
		$mon2 ="พฤศจิกายน";
		$selmon2="11";
	}else if($selmon2=="12"){
		$mon2 ="ธันวาคม";
		$selmon2="12";
	}//end if


$Txt_Datetime = $Txt_Datetime_d." ".$mon2." ".$Txt_Datetime_y;
$Txt_Datetime2 = $Txt_Datetime_y."-".$selmon2."-".$Txt_Datetime_d;

//////////////////////////////////////////////////////////////////

//-----> sql ข้อมูลคนไข้
$sql = "SELECT * FROM `opcard` WHERE hn = '$hn' ";
//echo $sql;exit();
$query = mysql_query($sql); 
$num = mysql_num_rows($query);

if(empty($num)){
	echo "<h1 align='center'>ไม่พบข้อมูลคนไข้</h1>";echo "<br>".exit();
}//end if

while($rows = mysql_fetch_array($query)){

	$Txt_Title = $rows["yot"];
    $Txt_Name = $rows["name"];
    $Txt_Surname = $rows["surname"];
    $Txt_Idcard = $rows["idcard"];
    $Txt_Address1 = $rows["address"];
    $Txt_Address2 = $rows["tambol"];
    $Txt_Address3 = $rows["ampur"];
    $Txt_Address4 = $rows["changwat"];
    // ไม่มีข้อมูลรหัสไปรษณีย์ ในระบบ รพ.
}//end while

/////////////////////////////////////////////////////////////////


//-----> sql ข้อมูลแพทย์

$sql = "SELECT * FROM `doctor` WHERE row_id = '20' AND status = 'y' ";
//echo $sql;exit();
$query = mysql_query($sql); 
$num = mysql_num_rows($query);

if(empty($num)){
	echo "<h1 align='center'>ไม่พบข้อมูลแพทย์</h1>";echo "<br>".exit();
}//end if

while($rows = mysql_fetch_array($query)){

	$Txt_DocTitle = $rows["yot"];
    $Txt_DocName = substr($rows["name"],5);
    $Txt_DocCode = $rows["doctorcode"];

}//end while

/////////////////////////////////////////////////////////////////


//-----> sql ข้อมูลซักประวัติ

$sql = "SELECT * FROM `opd` WHERE hn = '$hn'  "; //AND thidate like '%$Txt_Datetime2%' ORDER BY row_id ASC 
//echo $sql;exit();
$query = mysql_query($sql); 
$num = mysql_num_rows($query);

if(empty($num)){
	echo "<h1 align='center'>ไม่พบข้อมูลซักประวัติ</h1>";echo "<br>".exit();
}//end if

while($rows = mysql_fetch_array($query)){

	$Txt_Temp = $rows["temperature"];
    $Txt_Pause = $rows["pause"];
    $Txt_Rate = $rows["rate"];
    $Txt_Weight = $rows["weight"];
    $Txt_Height = $rows["height"];
    $Txt_Bp1 = $rows["bp1"];
    $Txt_Bp2 = $rows["bp2"];
    $Txt_Congenital_disease = $rows["congenital_disease"]; // โรคประจำตัว
    
    // ค้าง
    // 2.ซักประวัติ อุบัติเหตุและผ่าตัด
    // 3.ซักประวัติ เคยเข้ารับการรักษาในโรงพยาบาล
    // 4.ซักประวัติ โรคลมชัก
    // 5.ซักประวัติ อื่นๆที่สำคัญ
    // สภาพร่างกาย ปกติ/ไม่ปกติ

}//end while

/////////////////////////////////////////////////////////////////

?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 15pt;
	margin-top: 1.3cm;
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
	font-size: 15pt;
}
.txt1 {	font-family: TH SarabunPSK;
	font-size: 15pt;
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

#topic_box {
  border: 1px solid;
  padding: 10px;
  box-shadow: 2px 5px #888888;
  width: 230px;
}
-->


</style>
<title>ใบรับรองแพทย์ + ใบรายงานผลทางห้องปฏิบัติการ</title>

<table border=0>
    <tr> 
        <td width="480px"> 
            <h3 align="center" style="margin-bottom: 1px;margin-top: 1px;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ใบรับรองแพทย์</strong>
            </h3>
        </td>
        <td width="100px">
            <font size="3" align="right">เลขที่ C6504-0001</font>
        </td>
    </tr>
</table>

<div align="left" id="topic_box" style="padding-bottom: 5px;padding-top: 5px;padding-left: 5px;padding-right: 5px;">
<b>ส่วนที่ 1 : ของผู้ขอรับใบรับรองสุขภาพ</b>
</div>
<!--br-->
<table>
    <tr>
        <td width="50px">ข้าพเจ้า</td>
        <td width="270px" align="center" style="margin-top: 1px;margin-bottom: 1px;"><p><? echo "$Txt_Title $Txt_Name $Txt_Surname"; ?></p></td>
        <td width="180px">เลขบัตรประจำตัวประชาชน</td>
        <td width="110px" align="center" style="margin-top: 1px;margin-bottom: 1px;"><p><? echo "$Txt_Idcard"; ?></p></td>
    </tr> 
</table> 
<table>
    <tr>
        <td width="200px">สถานที่อยู่ (ที่สามารถติดต่อได้)</td>
        <td width="500px" style="margin-top: 1px;margin-bottom: 1px;"><p><? echo "$Txt_Address1 $Txt_Address2 $Txt_Address3 $Txt_Address4"; ?></p></td>
    </tr>
</table>
<span>ข้าพเจ้าขอใบรับรองสุภาพโดยมีประวัติสุขภาพดังนี้</span>
<table>
    <tr>
        <td width="300px">1.โรคประจำตัว</td>
        <td width="500px" align="left" style="margin-top: 1px;margin-bottom: 1px;"><p><? echo $Txt_Congenital_disease;?></p></td>
    </tr>
    <tr>
        <td>2.อุบัติเหตุ และ ผ่าตัด</td>
        <td><p>ปฏิเสธ</p></td>
    </tr>
    <tr>
        <td>3.เคยเข้ารับการรักษาใบโรงพยาบาล</td>
        <td><p>ปฏิเสธ</p></td>
    </tr>
    <tr>
        <td>4.ประวัติอื่นสำคัญ</td>
        <td><p>ไม่ระบุ</p></td>
    </tr> 
</table> 

<!-------------------------------------------------------------------------->
<div align="center" style="margin-top: 10px;">
<table>
    <tr>
        <td width="250px">ลงชื่อ .................................................................. </td>
        <td width="30px">วันที่ </td>
        <td align="center"><p><? echo $Txt_Datetime;?></p></td>
    </tr>
</table> 
<font size="3">ในกรณีเด็กที่ไม่สามารถรับรองตนเองได้ให้ผู้ปกครองลงนามรับรองแทนได้</font>
</div>
<!-------------------------------------------------------------------------->
<div align="left" id="topic_box" style="padding-bottom: 5px;padding-top: 5px;padding-left: 5px;padding-right: 5px;">
<b>ส่วนที่ 2 : ของแพทย์</b>
</div>
<!--br-->
<table>
    <tr>
        <td width="80px">สถานที่ตรวจ</td>
        <td width="350px" align="center"><p>โรงพยาบาลค่ายสุรศักดิ์มนตรี จ.ลำปาง</p></td>
        <td width="30px">วันที่ </td>
        <td width="120px" align="center"><p><? echo $Txt_Datetime;?></p></td>
    </tr>
</table> 
<table>
    <tr>
        <td width="180px">ข้าพเจ้า นายแพทย์/แพทย์หญิง</td>
        <td width="220px" align="center"><p><? echo "$Txt_DocTitle $Txt_DocName";?></p></td>
        <td width="100px">ใบประกอบวิชาชีพ </td>
        <td width="100px" align="center"><p><? echo "$Txt_DocCode";?></p></td>
        <!--td width="100px">สถานพยาบาล</td>
        <td width="150px" align="center"><p>โรงพยาบาลค่ายสุรศักดิ์มนตรี</p></td--!>
    </tr>
</table>
<table>
    <tr>
        <td width="50px">ที่อยู่ </td>
        <td width="550px" align="center"><p>เลขที่ 1 หมู่ 1 ถนนพหลโยธิน ตำบลพิชัย อำเภอเมืองลำปาง จังหวัดลำปาง 52000 </p></td>
    </tr> 
</table> 
<table> 
    <tr>
        <td width="100px">ได้ตรวจร่างกาย </td>
        <td width="200px" align="center"><p><? echo "$Txt_Title $Txt_Name $Txt_Surname"; ?></p></td>
        <!--td width="100px">แล้วเมื่อ วันที่ </td>
        <td width="100px" align="center"><p><? echo $Txt_Datetime;?></p></td--!>
        <td width="100px">มีรายละเอียดดังนี้</td>
        <td width="100px"> </td>
    </tr>
</table>
<table> 
    <tr>
        <td width="60px"> น้ำหนักตัว </td>
        <td width="30px" align="center"><p><? echo $Txt_Weight; ?></p></td>
        <td width="20px"> กก.</td>
        <td width="50px"> ความสูง </td>
        <td width="20px" align="center"><p><? echo $Txt_Height; ?></p></td>
        <td width="20px"> ซม.</td>
        <td width="90px"> ความดันโลหิต </td>
        <td width="20px" align="center"><p><? echo "$Txt_Bp1/$Txt_Bp2"; ?></p></td>
        <td width="20px"> มม.ปรอท </td>
        <td width="30px"> ชีพจร </td>
        <td width="20px" align="center"><p><? echo $Txt_Pause; ?></p></td>
        <td width="50px"> ครั้ง/นาที </td>
    </tr>
</table>
<table> 
    <tr>
        <td width="200px"> สภาพร่างกายทั่วไปอยู่ในเกณฑ์ </td>
        <td width="500px" align="center"><p> ปกติ </p></td>
    </tr>
</table> 
<table> 
    <tr>
        <td>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ขอรับรองว่า บุคคลดังกล่าว ไม่เป็นผู้มีร่างกายทุพพลภาพจนไม่สามารถปฏิบัติหน้าที่ได้ ไม่ปรากฏอาการของโรคจิต
หรือจิตฟั่นเฟือน หรือปัญญาอ่อน ไม่ปรากฏอาการของการติดยาเสพติดให้โทษ และอาการของโรคพิษสุราเรื้อรัง และไม่ปรากฏอาการและอาการแสดงของโรคต่อไปนี้ <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (1) โรคเรื้อนในระยะติดต่อ หรือในระยะที่ปรากฏอาการเป็นที่รังเกียจแก่สังคม <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (2) วัณโรคในระยะอันตราย <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (3) โรคเท้าช้างในระยะที่ปรากฏอาการเป็นที่รังเกียจแก่สังคม 
        </td>
    </tr>
</table> 
<table> 
    <tr>
        <td width="160px">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (4) อื่น ๆ (ถ้ามี)
        </td>
        <td width="550px"><p>  </p></td>
    </tr>
    <tr>
        <td width="200px">
        สรุปความเห็น<br>และข้อแนะนำของแพทย์ 
        </td>
        <td width="650px"><p ><font class="txt_dotted"> สุขภาพแข็งแรงสมบูรณ์</font></p></td>
    </tr>
    <!--tr>
        <td width="160px">  
        </td>
        <td width="550px"><p> </p></td>
    </tr--> 
</table>

<!--br-->
<div align="right" style="border-top-width: 5px;margin-top: 20px;">
ลงชื่อ ................................................................... แพทย์ผู้ตรวจร่างกาย
</div>

<div align="center">
<table> 
    <tr>
        <td><font size="3">
หมายเหตุ (1) ต้องเป็นแพทย์ซึ่งได้ขึ้นทะเบียนรับใบอนุญาตประกอบวิชาชีพเวชกรรม <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (2) ให้แสดงว่าเป็นผู้มีร่างกายสมบูรณ์เพียงใด ใบรับรองแพทย์ฉบับนี้ให้ใช้ได้1 เดือนนับแต่วันที่ตรวจร่างกาย <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (3) คำรับรองนี้เป็นการตรวจวินิจฉัยเบื้องต้น
        </font></td>
    </tr>
</table>
</div>



<!---------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------->
<!------------------------------  รายงาน LAB  -------------------------------------->
<!---------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------->




<h3 align="center">ใบรายงานผลตรวจทางห้องปฏิบัติการ</h3>
<h3 align="center">โรงพยาบาลค่ายสุรศักดิ์มนตรี</h3>
<h5 align="right">เลขที่ C6504-0001</h5>

<table border="0">
    <tr>
        <td>
            ชื่อ-นามสกุล 
        </td>
        <td>
           <p><? echo "$Txt_Title $Txt_Name $Txt_Surname"; ?></p>
        </td>
        <td>
            HN  
        </td>
        <td>
           <p><? echo "00-0000"; ?></p>
        </td>
        <td>
            อายุ 
        </td>
        <td>
           <p>00</p>
        </td>
        <td>
           ปี
        </td>
        <td>
           วันที่เข้ารับบริการ
        </td>
        <td>
           <p><? echo $Txt_Datetime; ?></p>
        </td>
    </tr>

    <tr>
        <td>
        เลขบัตรประชาชน   
        </td>
        <td>
           <p><? echo "$Txt_Idcard"; ?></p>
        </td>
        <td>
        โทรศัพท์    
        </td>
        <td>
           <p><? echo "000-0000000"; ?></p>
        </td>
    </tr>
</table>


<h3 align="center">ข้อมูลผลตรวจ</h3>

<table border="1">
    <tr>
        <td width="400px" align="center">
            รายการตรวจ
        </td>
        <td width="100px" align="center">
            ผลปกติ<br>NORMAL
        </td>
        <td width="100px" align="center">
            ผิดปกติ<br>ABNORMAL
        </td>
    </tr>
    <tr>
        <td width="400px" align="left">
        ความสมบูรณ์ทางเม็ดเลือด CBC
        </td>
        <td width="100px" align="center">
        /
        </td>
        <td width="100px" align="center">
        
        </td>
    </tr>
    <tr>
        <td width="400px" align="left">
        ความสมบูรณ์ทางเม็ดเลือด CBC
        </td>
        <td width="100px" align="center">
        /
        </td>
        <td width="100px" align="center">
        
        </td>
    </tr>
</table>

รายการตรวจอื่นๆ : <font size="5">ไม่มี</font>