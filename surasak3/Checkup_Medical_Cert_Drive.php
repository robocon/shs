<?
session_start();
include("connect.inc");


$officer = $_SESSION["sOfficer"];
if($_SESSION["sOfficer"] == ""){
	
	echo "<center><font color='#000000' >ขออภัยครับ การ Login ของท่านหมดอายุ </font><br />";
	echo "<a href=\"../sm3.php\" target=\"_top\">กลับหน้าแรก</a></center>";
exit();
}//end if

$hn = $_GET['hn']; //get hn

//////////////////////////////////////////////////////////////////

date_default_timezone_set('Asia/Bangkok');
$Txt_DateTime = date("H:m:s");
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
/////////////////// à¡çº Log ¡ÒÃ¾ÔÁ¾ì //////////////////////////////

//-----> log
$sql = " INSERT INTO log_ecert (
    Id  ,
    UserPrint ,
    DatePrint ,
    HN ,
    Type ,
    Desc_Type , 
    Code_RowidVn 
    )
    VALUES ( '','$officer','$Txt_Datetime $Txt_DateTime','".$_GET['hn']."','B','ใบรับรองแพทย์ (สำหรับขับรถ)','".$_GET['rowid'].'-'.$_GET['vn']."' )";
//echo $sql;exit();
$query = mysql_query($sql);  

if(!$query){
	echo "<h1 align='center'>Log Save Error : (Code : C)</h1>";echo "<br>".exit();
}//end if
 
//////////////////////////////////////////////////////////////////


//-----> sql ¢éÍÁÙÅ«Ñ¡»ÃÐÇÑµÔ

//$sql = "SELECT * FROM `opd` WHERE hn = '$hn'  "; //AND thidate like '%$Txt_Datetime2%' ORDER BY row_id ASC 
$sql = "SELECT * FROM `dxofyear_out` WHERE hn = '$hn'  ";
//echo $sql;exit();
$query = mysql_query($sql); 
$num = mysql_num_rows($query);

if(empty($num)){
    echo "<h1 align='center'>äÁè¾º¢éÍÁÙÅ«Ñ¡»ÃÐÇÑµÔ</h1>";echo "<br>".exit();
}//end if

while($rows = mysql_fetch_array($query)){

    $Txt_Temp = $rows["temperature"];
    $Txt_Pause = $rows["pause"];
    $Txt_Rate = $rows["rate"];
    $Txt_Weight = $rows["weight"];
    $Txt_Height = $rows["height"];
    $Txt_Bp1 = $rows["bp1"];
    $Txt_Bp2 = $rows["bp2"];
    $Txt_Congenital_disease = $rows["congenital_disease"]; // âÃ¤»ÃÐ¨ÓµÑÇ
    $Txt_Accident_Surgery = $rows["accident_surgery"]; // ÍØºÑµÔàËµØáÅÐ¼èÒµÑ´
    $Txt_Treat_Hospital = $rows["treat_hospital"]; // à¤Âà¢éÒÃÑº¡ÒÃÃÑ¡ÉÒã¹âÃ§¾ÂÒºÒÅ
    $Txt_Epilepsy = $rows["epilepsy"]; // âÃ¤ÅÁªÑ¡
    $Txt_Treat_other = $rows["treat_other"]; // Í×è¹æ·ÕèÊÓ¤Ñ­
    //$Txt_Doctor_Ans= $rows["doctor_ans"]; // ÊÃØ»¤ÇÒÁ¤Ô´àËç¹áÅÐ¢éÍá¹Ð¹Ó¢Í§á¾·Âì
    $Txt_Flag_Address_Use = $rows["address_use"];


}//end while

/////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////

//-----> sql ¢éÍÁÙÅ¤¹ä¢é
$sql = "SELECT * FROM `opcard` WHERE hn = '$hn' ";
//echo $sql;exit();
$query = mysql_query($sql); 
$num = mysql_num_rows($query);

if(empty($num)){
	echo "<h1 align='center'>äÁè¾º¢éÍÁÙÅ¤¹ä¢é</h1>";echo "<br>".exit();
}//end if

while($rows = mysql_fetch_array($query)){

	$Txt_Title = $rows["yot"];
    $Txt_Name = $rows["name"];
    $Txt_Surname = $rows["surname"];
    $Txt_Idcard = $rows["idcard"]; 

    if($Txt_Flag_Address_Use == "hospital"){
        
        $Txt_Address1 = $rows["address"];
        $Txt_Address2 = "ตำบล ".$rows["tambol"];
        $Txt_Address3 = "อำเภอ ".$rows["ampur"];
        $Txt_Address4 = "จังหวัด ".$rows["changwat"];
        // ไม่มีข้อมูลรหัสไปรษณีย์ ในระบบ รพ.

    }else if($Txt_Flag_Address_Use == "card"){

        $Txt_Address1 = $rows["card_address"]." ".$rows["card_moo"];
        $Txt_Address2 = "ตำบล ".$rows["card_tambol"];
        $Txt_Address3 = "อำเภอ ".$rows["card_amphur"];
        $Txt_Address4 = "จังหวัด ".$rows["card_province"];
        // ไม่มีข้อมูลรหัสไปรษณีย์ ในระบบ รพ.

    }else{

        $Txt_Address1 = $rows["address"];
        $Txt_Address2 = "ตำบล ".$rows["tambol"];
        $Txt_Address3 = "อำเภอ ".$rows["ampur"];
        $Txt_Address4 = "จังหวัด ".$rows["changwat"];
        // ไม่มีข้อมูลรหัสไปรษณีย์ ในระบบ รพ.

    }//end if

}//end while

/////////////////////////////////////////////////////////////////


//-----> sql ¢éÍÁÙÅá¾·Âì

$sql = "SELECT * FROM `doctor` WHERE row_id = '20' AND status = 'y' ";
//echo $sql;exit();
$query = mysql_query($sql); 
$num = mysql_num_rows($query);

if(empty($num)){
	echo "<h1 align='center'>äÁè¾º¢éÍÁÙÅá¾·Âì</h1>";echo "<br>".exit();
}//end if

while($rows = mysql_fetch_array($query)){

	$Txt_DocTitle = $rows["yot"];
    $Txt_DocName = substr($rows["name"],5);
    $Txt_DocCode = $rows["doctorcode"];

}//end while

/////////////////////////////////////////////////////////////////


//-----> ¢éÍÁÙÅ dx áÅÐ doctor_ans ¨Ò¡ËÁÍ
 
$sql = "SELECT * FROM `condxofyear_out` WHERE hn = '$hn'  ";
//echo $sql;exit();
$query = mysql_query($sql); 
$num = mysql_num_rows($query);

if(empty($num)){
	echo "<h1 align='center'>äÁè¾º¢éÍÁÙÅ dx , doctor_ans </h1>";echo "<br>".exit();
}//end if

while($rows = mysql_fetch_array($query)){
 
    $Txt_Doctor_Ans= $rows["doctor_ans"]; // ÊÃØ»¤ÇÒÁ¤Ô´àËç¹áÅÐ¢éÍá¹Ð¹Ó¢Í§á¾·Âì
    $Txt_Doctor_Dx= $rows["dx"]; // dx ¨Ò¡á¾·Âì

}//end while

///////////////////////////////////////////////////////////////// 

?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 15pt;
	margin-top: 0.1cm;
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
<title>ใบรับรองแพทย์ (สำหรับใบอนุญาตขับรถ)</title>

<table border=0>
    <tr> 
        <td width="480px"> 
            <h3 align="center" style="margin-bottom: 1px;margin-top: 1px;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ใบรับรองแพทย์ (สำหรับใบอนุญาตขับรถ)</strong>
            </h3>
        </td>
        <td width="100px">
        <font size="3" align="right">เลขที่ <? echo $_GET['type'].$_GET['rowid']."-".$_GET['vn']; ?></font>
        </td>
    </tr>
</table>

<div align="left" id="topic_box" style="padding-bottom: 5px;padding-top: 5px;padding-left: 5px;padding-right: 5px;">
<b>ส่วนที่ 1 ของผู้ขอรับใบรับของสุขภาพ</b>
</div>
<!--br-->
<table>
    <tr>
        <td width="50px">ข้าพเจ้า</td>
        <td width="270px" align="center" style="margin-top: 1px;margin-bottom: 1px;"><p><? echo "$Txt_Title $Txt_Name $Txt_Surname"; ?></p></td>
        <td width="180px">หมายเลขบัตรประชาชน</td>
        <td width="110px" align="center" style="margin-top: 1px;margin-bottom: 1px;"><p><? echo "$Txt_Idcard"; ?></p></td>
    </tr> 
</table> 
<table>
    <tr>
        <td width="200px">สถานที่อยู่ (ที่สามารถติดต่อได้)</td>
        <td width="500px" style="margin-top: 1px;margin-bottom: 1px;"><p><? echo "$Txt_Address1 $Txt_Address2 $Txt_Address3 $Txt_Address4"; ?></p></td>
    </tr>
</table>
<span>ข้าพเจ้าขอใบรับรองสุขภาพ โดยมีประวัติดังนี้</span>
<table>
    <tr>
        <td width="300px">1.โรคประจำตัว</td>
        <td width="500px" align="left" style="margin-top: 1px;margin-bottom: 1px;"><p><? echo $Txt_Congenital_disease;?></p></td>
    </tr>
    <tr>
        <td>2.อุบัติเหตุ และ ผ่าตัด</td>
        <td><p><? echo $Txt_Accident_Surgery;?></p></td>
    </tr>
    <tr>
        <td>3.เคยเข้ารับการรักษาในโรงพยาบาล</td>
        <td><p><? echo $Txt_Treat_Hospital;?></p></td>
    </tr>
    <tr>
        <td>4.โรคลมชัก*</td>
        <td><p><? echo $Txt_Epilepsy;?></p></td>
    </tr> 
    <tr>
        <td>5.ประวัติอื่นที่สำคัญ</td>
        <td><p><? echo $Txt_Treat_other;?></p></td>
    </tr> 
</table> 

<font size="3">* ในกรณีโรคลมชัก ให้แนบประวัติการรักษาจากแพทย์ผู้รักษาว่าท่านปลอดภัยจากอาการชักมากกว่า ๑ ปี เพิ่ออนุญาตให้ขับรถได้</font>

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
<b>ส่วนที่ 2 ของแพทย์</b>
</div>
<!--br-->
<table>
    <tr>
        <td width="80px">สถานที่ตรวจ</td>
        <td width="350px" align="center"><p>โรงพยาบาลค่ายสุรศักดิ์มนตรี</p></td>
        <td width="30px">วันที่</td>
        <td width="120px" align="center"><p><? echo $Txt_Datetime;?></p></td>
    </tr>
</table> 
<table>
    <tr>
        <td width="180px">(1) ข้าพเจ้านายแพทย์/แพทย์หญิง</td>
        <td width="220px" align="center"><p><? echo "$Txt_DocTitle $Txt_DocName";?></p></td>
        <td width="100px">ใบประกอบวิชาชีพ </td>
        <td width="100px" align="center"><p><? echo "$Txt_DocCode";?></p></td>
        <!--td width="100px">Ê¶Ò¹¾ÂÒºÒÅ</td>
        <td width="150px" align="center"><p>âÃ§¾ÂÒºÒÅ¤èÒÂÊØÃÈÑ¡´ÔìÁ¹µÃÕ</p></td--!>
    </tr>
</table>
<table>
    <tr>
        <td width="50px">ที่อยู่ </td>
        <td width="550px" align="center"><p> เลขที่ 1 หมู่ 1 ถนนพหลโยธิน ตำบลพิชัย อำเภอเมืองลำปาง จังหวัดลำปาง 52000 </p></td>
    </tr> 
</table> 
<table> 
    <tr>
        <td width="100px">ได้ตรวจร่างกาย </td>
        <td width="200px" align="center"><p><? echo "$Txt_Title $Txt_Name $Txt_Surname"; ?></p></td>
        <!--td width="100px">เมื่อวันที่ </td>
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
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ขอรับรองว่า บุคคลดังกล่าว ไม่เป็นผู้มีร่างกายทุพพลภาพจนไม่สามารถปฏิบัติหน้าที่ได้ ไม่ปรากฏอาการของโรคจิต หรือจิตฟั่นเฟือน หรือปัญญาอ่อน ไม่ปรากฏอาการของการติดยาเสพติดให้โทษ และอาการของโรคพิษสุราเรื้อรัง และไม่ปรากฏอาการและอาการแสดงของโรคต่อไปนี้ <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (1)  โรคเรื้อนในระยะติดต่อ หรือในระยะที่ปรากฏอาการเป็นที่รังเกียจแก่สังคม <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (2) วัณโรคในระยะอันตราย <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (3) โรคเท้าช้างในระยะที่ปรากฏอาการเป็นที่รังเกียจแก่สังคม
        </td>
    </tr>
</table> 
<table> 
    <tr>
        <td width="160px">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (4) อื่นๆ (ถ้ามี)
        </td>
        <td width="550px"><p>  </p></td>
    </tr>
    <tr>
        <td width="350px">
        (2) สรุปความเห็นและข้อแนะนำของแพทย์ 
        </td>
        <td width="450px"><p ><font class="txt_dotted"><? echo $Txt_Doctor_Ans." ".$Txt_Doctor_Dx; ?></font></p></td>
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
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 3) คำรับรองนี้เป็นการตรวจวินิจฉัยเบื้องต้น<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  แบบฟอร์มนี้ได้รับการรับรองจากมติคณะกรรมการแพทย์สภาในการประชุมครั้งที่ 4/2561 วันที่ 19 เมษายน 2561
        </font></td>
    </tr>
</table>
</div>
