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
$vn = $_GET['vn']; //get vn


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
/////////////////// เก็บ Log การพิมพ์ //////////////////////////////

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
    VALUES ( '','$officer','$Txt_Datetime $Txt_DateTime','".$_GET['hn']."','C','ใบรับรองแพทย์ + LAB','".$_GET['rowid'].'-'.$_GET['vn']."' )";
//echo $sql;exit();
$query = mysql_query($sql);  

if(!$query){
	echo "<h1 align='center'>Log Save Error : (Code : C)</h1>";echo "<br>".exit();
}//end if
 
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
    $Txt_Address2 = "ตำบล ".$rows["tambol"];
    $Txt_Address3 = "อำเภอ ".$rows["ampur"];
    $Txt_Address4 = "จังหวัด ".$rows["changwat"];
    // ไม่มีข้อมูลรหัสไปรษณีย์ ในระบบ รพ.
    $Txt_Phone = $rows["phone"];
    $Txt_Dbirth = $rows["dbirth"];

        //----->เริ่ม หาอายุ จากวันเกิด 
        $birthday = $Txt_Dbirth; 
        $birthday_y = substr($birthday,0,4)-543; 
        $birthday_m = substr($birthday,5,2); 
        $birthday_d = substr($birthday,8,2);   
        $birthday = $birthday_y."-".$birthday_m."-".$birthday_d;
        $today_y = date("Y"); 
        $today_m = date("m"); 
        $today_d = date("d"); 
        $today = $today_y."-".$today_m."-".$today_d;  
        list($byear, $bmonth, $bday)= explode("-",$birthday);       
        list($tyear, $tmonth, $tday)= explode("-",$today);                
        $mbirthday = mktime(0, 0, 0, $bmonth, $bday, $byear); 
        $mnow = mktime(0, 0, 0, $tmonth, $tday, $tyear );
        $mage = ($mnow - $mbirthday);
        $u_y=date("Y", $mage)-1970;
        $u_m=date("m",$mage)-1;
        $u_d=date("d",$mage)-1;
        $Txt_Dbirth = "$u_y ปี $u_m เดือน $u_d วัน";
        //echo $Txt_Dbirth;
        //----->จบ หาอายุ จากวันเกิด 


}//end while

/////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////
////////////// start ข้อมูลแพทย์ //////////////////////////////////
/////////////////////////////////////////////////////////////////


//.
//.
$sql = "SELECT doctor FROM `dxofyear_out` WHERE hn = '$hn' AND vn = '$vn' ORDER BY `row_id` DESC ";
//echo $sql;exit();
$query = mysql_query($sql); 
$num = mysql_num_rows($query);

if(empty($num)){
    echo "<h1 align='center'>ไม่พบข้อมูล แพทย์</h1>";echo "<br>".exit();
}//end if

while($rows = mysql_fetch_array($query)){
    $Result_Doctor = $rows["doctor"]; 
}//end while
//.
//.
if($Result_Doctor == "MD022 แพทย์เวชปฎิบัติ"){ //---> ถ้าเป็น MD022 แพทย์เวชปฎิบัติ

    //--> ค้นหาชื่อหมอที่ทำรายการตรวจ
    $sql = "SELECT doctor FROM `condxofyear_out` WHERE hn = '$hn' AND vn = '$vn' ORDER BY `row_id` DESC ";
    //echo $sql;exit();
    $query = mysql_query($sql); 
    $num = mysql_num_rows($query);

    if(empty($num)){
        echo "<h1 align='center'>ไม่พบข้อมูล MD022 แพทย์เวชปฎิบัติ </h1>";echo "<br>".exit();
    }//end if

    while($rows = mysql_fetch_array($query)){
        $Result_Doctor = $rows["doctor"]; 
    }//end while

}//end if
//.
//.

//-----> sql ข้อมูลแพทย์ > ยศ ชื่อ-นามสกุล
//.
//.
//.
$sql = "SELECT * FROM `doctor` WHERE name like '%$Result_Doctor%' ";
//$sql = "SELECT * FROM `doctor` WHERE row_id = '20' AND status = 'y' ";
//echo $sql;exit();
$query = mysql_query($sql); 
$num = mysql_num_rows($query);

if(empty($num)){
echo "<h1 align='center'>ไม่พบข้อมูลแพทย์ (Full)</h1>";echo "<br>".exit();
}//end if

while($rows = mysql_fetch_array($query)){

$Txt_DocTitle = $rows["yot"];
$Txt_DocName = substr($rows["name"],5);
$Txt_DocCode = $rows["doctorcode"];

}//end while

/////////////////////////////////////////////////////////////////
////////////// end ข้อมูลแพทย์ //////////////////////////////////
/////////////////////////////////////////////////////////////////


//-----> sql ข้อมูลซักประวัติ

//$sql = "SELECT * FROM `opd` WHERE hn = '$hn'  "; //AND thidate like '%$Txt_Datetime2%' ORDER BY row_id ASC 
$sql = "SELECT * FROM `dxofyear_out` WHERE hn = '$hn' AND vn = '$vn' ";
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
    $Txt_Bp21 = $rows["bp21"];
    $Txt_Bp22 = $rows["bp22"];
    
    // เพิ่มเงื่อนไขการวัด bp 2 ครั้ง 27/06/65
    if($Txt_Bp21 == "" AND $Txt_Bp22 == ""){
        $Txt_Bp1 = $rows["bp1"];
        $Txt_Bp2 = $rows["bp2"];
    }else{
        $Txt_Bp1 = $rows["bp21"];
        $Txt_Bp2 = $rows["bp22"];
    }//end if

    $Txt_Congenital_disease = $rows["congenital_disease"]; // โรคประจำตัว
    $Txt_Accident_Surgery = $rows["accident_surgery"]; // อุบัติเหตุและผ่าตัด
    $Txt_Treat_Hospital = $rows["treat_hospital"]; // เคยเข้ารับการรักษาในโรงพยาบาล
    $Txt_Epilepsy = $rows["epilepsy"]; // โรคลมชัก
    $Txt_Treat_other = $rows["treat_other"]; // อื่นๆที่สำคัญ
    //$Txt_Doctor_Ans= $rows["doctor_ans"]; // สรุปความคิดเห็นและข้อแนะนำของแพทย์
    

}//end while

/////////////////////////////////////////////////////////////////



//-----> ข้อมูล dx และ doctor_ans จากหมอ
 
$sql = "SELECT * FROM `condxofyear_out` WHERE hn = '$hn' AND vn = '$vn' ";
//echo $sql;exit();
$query = mysql_query($sql); 
$num = mysql_num_rows($query);

if(empty($num)){
	echo "<h1 align='center'>ไม่พบข้อมูล dx , doctor_ans </h1>";echo "<br>".exit();
}//end if

while($rows = mysql_fetch_array($query)){
 
    $Txt_Doctor_Ans= $rows["doctor_ans"]; // สรุปความคิดเห็นและข้อแนะนำของแพทย์
    $Txt_Doctor_Dx= $rows["dx"]; // dx จากแพทย์
    $Txt_Age = $rows["age"]; // อายุ


    ///////////// แสดง วันที่คนไข้มาตรวจ ////////////

    $Txt_PtDateTime = $rows["thidate"]; // วันที่มาตรวจ
    $Txt_PtDatetime_d = substr($Txt_PtDateTime,8,2);
    $Txt_PtDatetime_m = substr($Txt_PtDateTime,6,2);
    $Txt_PtDatetime_y = substr($Txt_PtDateTime,0,4);
    $Txt_PtDatetime_y = $Txt_PtDatetime_y + 543;

//----> Convert Month2
$selmon2 = $Txt_PtDatetime_m;
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


$Txt_PtDatetime = $Txt_PtDatetime_d." ".$mon2." ".$Txt_PtDatetime_y;

    ////////////////////////////////////////

}//end while

/////////////////////////////////////////////////////////////////

?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 15pt;
	margin-top: 1.3cm;
    margin-left: 1cm;
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
<div style='page-break-after: always'>
<table border=0>
    <tr> 
        <td width="480px"> 
            <h3 align="right" style="margin-bottom: 1px;margin-top: 1px;">
            <strong>ใบรับรองแพทย์&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
            </h3>
        </td>
        <td width="150px">
            <font size="3" align="right">เลขที่ <? echo $_GET['type'].$_GET['rowid']."-".$_GET['vn']; ?></font>
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
<span>ข้าพเจ้าขอใบรับรองสุขภาพโดยมีประวัติสุขภาพดังนี้</span>
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
        <td>4.ประวัติอื่นสำคัญ</td>
        <td><p><? echo $Txt_Treat_other;?></p></td>
    </tr>  
</table> 

<!-------------------------------------------------------------------------->
<div align="center" style="margin-top: 10px;">
<table>
    <tr>
        <td width="250px">ลงชื่อ .................................................................. </td>
        <td width="30px">วันที่ </td>
        <td align="center"><p><? echo $Txt_PtDatetime;?></p></td>
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
        <td width="120px" align="center"><p><? echo $Txt_PtDatetime;?></p></td>
    </tr>
</table> 
<table>
    <tr>
        <td width="200px">(1) ข้าพเจ้า นายแพทย์/แพทย์หญิง</td>
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
        <td width="130px">ได้ตรวจร่างกาย </td>
        <td width="250px" align="center"><p><? echo "$Txt_Title $Txt_Name $Txt_Surname"; ?></p></td>
        <td width="130px">แล้วเมื่อ วันที่ </td>
        <td width="200px" align="center"><p><? echo $Txt_PtDatetime;?></p></td>
        <td width="150px">มีรายละเอียดดังนี้</td>
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
        <td width="450px">
        (2) สรุปความเห็นและข้อแนะนำของแพทย์ 
        </td>
        <td width="350px"><p ><font class="txt_dotted"><? echo $Txt_Doctor_Ans." ".$Txt_Doctor_Dx; ?></font></p></td>
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
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (3) คำรับรองนี้เป็นการตรวจวินิจฉัยเบื้องต้น <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; แบบฟอร์มนี้ได้รับการรับรองจากมติคณะกรรมการแพทย์สภาในการประชุมครั้งที่ 4/2561 วันที่ 19 เมษายน 2561
        </font></td>
    </tr>
</table>
</div>

</div> <!----------------- end page 1 ------------>

<!---------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------->
<!------------------------------  รายงาน LAB  -------------------------------------->
<!---------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------->




<h3 align="center">ใบรายงานผลตรวจทางห้องปฏิบัติการ โรงพยาบาลค่ายสุรศักดิ์มนตรี</h3>
<!--h3 align="center">โรงพยาบาลค่ายสุรศักดิ์มนตรี</h3-->
<h5 align="right">เลขที่ <? echo $_GET['type'].$_GET['rowid']."-".$_GET['vn']; ?>/2</h5>

<table border="0">
    <tr>
        <td>
            ชื่อ-นามสกุล 
        </td>
        <td width="250px">
           <p align="center"><? echo "$Txt_Title $Txt_Name $Txt_Surname"; ?></p>
        </td>
        <td>
              
        </td>
        <td>
           HN
        </td>
        <td width="80px">
           <p align="center"><? echo $hn; ?></p>
        </td>
        <td>
            อายุ 
        </td>
        <td width="80px">
           <p align="center"><? echo $Txt_Age; ?></p>
        </td>
    </tr> 
</table>

<table border="0"> 
    <tr>
        <td>
           วันที่เข้ารับบริการ
        </td>
        <td>
           <p><? echo $Txt_PtDatetime; ?></p>
        </td>
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
           <p><? echo "$Txt_Phone"; ?></p>
        </td>
    </tr>
</table>

<br>
<!--h3 align="center">ข้อมูลผลตรวจ</h3-->

<table border="1" style="border: 1px solid black;border-collapse: collapse;">
    <tr>
        <td width="400px" align="center" style="font-size:17px">
            <b>รายการตรวจ</b>
        </td>
        <td width="100px" align="center" style="font-size:17px">
            <b>ผลปกติ<br>NORMAL</b>
        </td>
        <td width="100px" align="center" style="font-size:17px">
            <b>ผิดปกติ<br>ABNORMAL</b>
        </td>
    </tr>
<?php
//-----> ข้อมูล LAB สรุป
$sql = "SELECT * FROM `condxofyear_out` WHERE hn = '$hn' AND row_id = '".$_GET['rowid']."'  "; //AND row_id = '".$_GET['rowid']."'
//echo $sql;exit();
$query = mysql_query($sql); 
$num = mysql_num_rows($query); 

if(empty($num)){
	echo "<h1 align='center'>ไม่พบสรุปข้อมูล LAB</h1>";echo "<br>".exit();
}//end if

$count = 1;
while($rows = mysql_fetch_array($query)){

   /* 
    $stat_glu = $rows["ua_gluu"]; // ผลสรุป glu
        if($stat_glu == "Negative"){$nomal_glu = "/";$abnomal_glu = "";}else if($stat_glu == "Positive"){$nomal_glu = "";$abnomal_glu = "/";}else{$nomal_glu = "No Result";$abnomal_glu = "No Result";}
        if($stat_glu){ 
            $txt_glu = $count++.".ผลตรวจน้ำตาลในเลือด (GLU)";
            echo "
            <tr>
                <td width='400px' align='left' style='font-size:17px'>
                ".$txt_glu."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$nomal_glu."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$abnomal_glu."
                </td>
            </tr>";
        }//end if
*/

    $stat_trig = $rows["stat_tg"]; // ผลสรุป trig
        if($stat_trig == "ปกติ"){$nomal_trig = "/";$abnomal_trig = "";}else if($stat_trig == "ผิดปกติ"){$nomal_trig = "";$abnomal_trig = "/";}else{$nomal_trig = "No Result";$abnomal_trig = "No Result";}
    
        if($stat_trig){
            $txt_trig = $count++.".ผลตรวจไขมันไตรกลีเซอไรด์ (TRIG)";
            echo "
            <tr>
                <td width='400px' align='left' style='font-size:17px'>
                ".$txt_trig."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$nomal_trig."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$abnomal_trig."
                </td>
            </tr>";
        }//end if

    $stat_chol = $rows["stat_chol"]; // ผลสรุป chol
        if($stat_chol == "ปกติ"){$nomal_chol = "/";$abnomal_chol = "";}else if($stat_chol == "ผิดปกติ"){$nomal_chol = "";$abnomal_chol = "/";}else{$nomal_chol = "No Result";$abnomal_chol = "No Result";}
        
        if($stat_chol){
            $txt_chol = $count++.".ผลตรวจไขมันคอเลสเตอรอล (CHOL)";
            echo "
            <tr>
                <td width='400px' align='left' style='font-size:17px'>
                ".$txt_chol."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$nomal_chol."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$abnomal_chol."
                </td>
            </tr>";
        }//end if

    $stat_alk = $rows["stat_alk"]; // ผลสรุป AST
        if($stat_alk == "ปกติ"){$nomal_alk = "/";$abnomal_alk = "";}else if($stat_alk == "ผิดปกติ"){$nomal_alk = "";$abnomal_alk = "/";}else{$nomal_alk = "No Result";$abnomal_alk = "No Result";}
       
        if($stat_alk){
            $txt_alk = $count++.".ตรวจการทำงานของตับ (AST)";
            echo "
            <tr>
                <td width='400px' align='left' style='font-size:17px'>
                ".$txt_alk."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$nomal_alk."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$abnomal_alk."
                </td>
            </tr>";
        }//end if

    $stat_sgpt = $rows["stat_sgpt"]; // ผลสรุป alt
        if($stat_sgpt == "ปกติ"){$nomal_sgpt = "/";$abnomal_sgpt = "";}else if($stat_sgpt == "ผิดปกติ"){$nomal_sgpt = "";$abnomal_sgpt = "/";}else{$nomal_sgpt = "No Result";$abnomal_sgpt = "No Result";}
        
        if($stat_sgpt){
            $txt_sgpt = $count++.".ตรวจการทำงานของตับ (ALT)";
            echo "
            <tr>
                <td width='400px' align='left' style='font-size:17px'>
                ".$txt_sgpt."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$nomal_sgpt."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$abnomal_sgpt."
                </td>
            </tr>";
        }//end if

    $stat_sgot = $rows["stat_sgot"]; // ผลสรุป ALP
        if($stat_sgot == "ปกติ"){$nomal_sgot = "/";$abnomal_sgot = "";}else if($stat_sgot == "ผิดปกติ"){$nomal_sgot = "";$abnomal_sgot = "/";}else{$nomal_sgot = "No Result";$abnomal_sgot = "No Result";}
        
        if($stat_sgot){
            $txt_sgot = $count++.".ตรวจการทำงานของตับ (ALP)";
            echo "
            <tr>
                <td width='400px' align='left' style='font-size:17px'>
                ".$txt_sgot."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$nomal_sgot."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$abnomal_sgot."
                </td>
            </tr>";
        }//end if

    $stat_bun = $rows["stat_bun"]; // ผลสรุป BUN
        if($stat_bun == "ปกติ"){$nomal_bun = "/";$abnomal_bun = "";}else if($stat_bun == "ผิดปกติ"){$nomal_bun = "";$abnomal_bun = "/";}else{$nomal_bun = "No Result";$abnomal_bun = "No Result";}
        
        if($stat_bun){
            $txt_bun = $count++.".ตรวจการทำงานของไต (BUN)";
            echo "
            <tr>
                <td width='400px' align='left' style='font-size:17px'>
                ".$txt_bun."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$nomal_bun."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$abnomal_bun."
                </td>
            </tr>";
        }//end if

    $stat_cr = $rows["stat_cr"]; // ผลสรุป CREA
        if($stat_cr == "ปกติ"){$nomal_cr = "/";$abnomal_cr = "";}else if($stat_cr == "ผิดปกติ"){$nomal_cr = "";$abnomal_cr = "/";}else{$nomal_cr = "No Result";$abnomal_cr = "No Result";}
        
        if($stat_cr){
            $txt_cr = $count++.".ตรวจการทำงานของไต (CREA)";
            echo "
            <tr>
                <td width='400px' align='left' style='font-size:17px'>
                ".$txt_cr."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$nomal_cr."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$abnomal_cr."
                </td>
            </tr>";
        }//end if
    
    $stat_uric = $rows["stat_uric"]; // ผลสรุป URIC
        if($stat_uric == "ปกติ"){$nomal_uric = "/";$abnomal_uric = "";}else if($stat_uric == "ผิดปกติ"){$nomal_uric = "";$abnomal_uric = "/";}else{$nomal_uric = "No Result";$abnomal_uric = "No Result";}
        
        if($stat_uric){
            $txt_uric = $count++.".ตรวจกรดยูริคในเลือด (URIC)";
            echo "
            <tr>
                <td width='400px' align='left' style='font-size:17px'>
                ".$txt_uric."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$nomal_uric."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$abnomal_uric."
                </td>
            </tr>";
        }//end if
    
    $stat_hdl = $rows["stat_hdl"]; // ผลสรุป HDL
        if($stat_hdl == "ปกติ"){$nomal_hdl = "/";$abnomal_hdl = "";}else if($stat_hdl == "ผิดปกติ"){$nomal_hdl = "";$abnomal_hdl = "/";}else{$nomal_hdl = "No Result";$abnomal_hdl = "No Result";}
        
        if($stat_hdl){
            $txt_hdl = $count++.".ตรวจไขมันความหนาแน่นสูง (HDL)";
            echo "
            <tr>
                <td width='400px' align='left' style='font-size:17px'>
                ".$txt_hdl."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$nomal_hdl."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$abnomal_hdl."
                </td>
            </tr>";
        }//end if
        
    $stat_ldl = $rows["stat_ldl"]; // ผลสรุป LDL
        if($stat_ldl == "ปกติ"){$nomal_ldl = "/";$abnomal_ldl = "";}else if($stat_ldl == "ผิดปกติ"){$nomal_ldl = "";$abnomal_ldl = "/";}else{$nomal_ldl = "No Result";$abnomal_ldl = "No Result";}
        
        if($stat_ldl){
            $txt_ldl = $count++.".ตรวจไขมันความหนาแน่นต่ำ (LDL)";
            echo "
            <tr>
                <td width='400px' align='left' style='font-size:17px'>
                ".$txt_ldl."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$nomal_ldl."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$abnomal_ldl."
                </td>
            </tr>";
        }//end if
            
 

    $stat_malari = $rows["stat_malari"]; // ผลสรุป MALARI
        if($stat_malari == "ปกติ"){$nomal_malari = "/";$abnomal_malari = "";}else if($stat_malari == "ผิดปกติ"){$nomal_malari = "";$abnomal_malari = "/";}else{$nomal_malari = "No Result";$abnomal_malari = "No Result";}
        
        if($stat_malari){
            $txt_malari = $count++.".ตรวจหาเชื้อมาลาเรีย (Malaria)";
            echo "
            <tr>
                <td width='400px' align='left' style='font-size:17px'>
                ".$txt_malari."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$nomal_malari."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$abnomal_malari."
                </td>
            </tr>";
        }//end if
    
    $stat_metamp = $rows["stat_metamp"]; // ผลสรุป METAMP
        if($stat_metamp == "ปกติ"){$nomal_metamp = "/";$abnomal_metamp = "";}else if($stat_metamp == "ผิดปกติ"){$nomal_metamp = "";$abnomal_metamp = "/";}else{$nomal_metamp = "No Result";$abnomal_metamp = "No Result";}
        
        if($stat_metamp){
            $txt_metamp = $count++.".ตรวจสารเสพติดในปัสสาวะ (Amphetamine in urine)";
            echo "
            <tr>
                <td width='400px' align='left' style='font-size:17px'>
                ".$txt_metamp."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$nomal_metamp."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$abnomal_metamp."
                </td>
            </tr>";
        }//end if
    
    $stat_hbsag = $rows["stat_hbsag"]; // ผลสรุป HBsAg
        if($stat_hbsag == "ปกติ"){$nomal_hbsag = "/";$abnomal_hbsag = "";}else if($stat_hbsag == "ผิดปกติ"){$nomal_hbsag = "";$abnomal_hbsag = "/";}else{$nomal_hbsag = "No Result";$abnomal_hbsag = "No Result";}
        
        if($stat_hbsag){
            $txt_hbsag = $count++.".ตรวจหาเชื้อไวรัสตับอักเสบบี (HBsAg)";
            echo "
            <tr>
                <td width='400px' align='left' style='font-size:17px'>
                ".$txt_hbsag."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$nomal_hbsag."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$abnomal_hbsag."
                </td>
            </tr>";
        }//end if
        
    $stat_hcvab = $rows["stat_hcvab"]; // ผลสรุป HCVAB
        if($stat_hcvab == "ปกติ"){$nomal_hcvab = "/";$abnomal_hcvab = "";}else if($stat_hcvab == "ผิดปกติ"){$nomal_hcvab = "";$abnomal_hcvab = "/";}else{$nomal_hcvab = "No Result";$abnomal_hcvab = "No Result";}
        
        if($stat_hcvab){
            $txt_hcvab = $count++.".ตรวจภูมิคุ้มกันไวรัสตับอักเสบซี (Anti HCV)";
            echo "
            <tr>
                <td width='400px' align='left' style='font-size:17px'>
                ".$txt_hcvab."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$nomal_hcvab."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$abnomal_hcvab."
                </td>
            </tr>";
        }//end if
    
    $stat_vdrl = $rows["stat_vdrl"]; // ผลสรุป VDRL
        if($stat_vdrl == "ปกติ"){$nomal_vdrl = "/";$abnomal_vdrl = "";}else if($stat_vdrl == "ผิดปกติ"){$nomal_vdrl = "";$abnomal_vdrl = "/";}else{$nomal_vdrl = "No Result";$abnomal_vdrl = "No Result";}
        
        if($stat_vdrl){
            $txt_vdrl = $count++.".ตรวจหาโรคซิฟิลิส (VDRL)";
            echo "
            <tr>
                <td width='400px' align='left' style='font-size:17px'>
                ".$txt_vdrl."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$nomal_vdrl."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$abnomal_vdrl."
                </td>
            </tr>";
        }//end if
        
    $stat_parasi = $rows["stat_parasi"]; // ผลสรุป PARASI
        if($stat_parasi == "ปกติ"){$nomal_parasi = "/";$abnomal_parasi = "";}else if($stat_parasi == "ผิดปกติ"){$nomal_parasi = "";$abnomal_parasi = "/";}else{$nomal_parasi = "No Result";$abnomal_parasi = "No Result";}
        
        if($stat_parasi){
            $txt_parasi = $count++.".ตรวจอุจจาระ (Stool exam)";
            echo "
            <tr>
                <td width='400px' align='left' style='font-size:17px'>
                ".$txt_parasi."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$nomal_parasi."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$abnomal_parasi."
                </td>
            </tr>";
        }//end if
            
//-->$stat_groupt = $rows["stat_groupt"]; // ผลสรุป GROUPT  ---> แสดงผลเป็น Group A,B,O ---> ต้องย้ายไปอยู่ตรวจอื่นๆ
//        if($stat_groupt == "ปกติ"){$nomal_groupt = "/";$abnomal_groupt = "";}else if($stat_groupt == "ผิดปกติ"){$nomal_groupt = "";$abnomal_groupt = "/";}else{$nomal_groupt = "No Result";$abnomal_groupt = "No Result";}
//        $txt_groupt = $count++."ตรวจหาหมู่เลือดเอ บี โอ (ABO blood group)";
            
    
  /*              
    $stat_upt = $rows["stat_upt"]; // ผลสรุป UPT 
        if($stat_upt == "Negative"){$nomal_upt = "/";$abnomal_upt = "";}else if($stat_upt == "Positive"){$nomal_upt = "";$abnomal_upt = "/";}else{$nomal_upt = "No Result";$abnomal_upt = "No Result";}
        
        if($stat_upt){
            $txt_upt = $count++.".ตรวจการตั้งครรภ์ (Pregnancy test)";
            echo "
            <tr>
                <td width='400px' align='left' style='font-size:17px'>
                ".$txt_upt."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$nomal_upt."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$abnomal_upt."
                </td>
            </tr>";
        }//end if
     */               
//-->$stat_upt = $rows["stat_upt"]; // ผลสรุป ANTIHB 
//        if($stat_upt == "Negative"){$nomal_upt = "/";$abnomal_upt = "";}else if($stat_upt == "Positive"){$nomal_upt = "";$abnomal_upt = "/";}else{$nomal_upt = "No Result";$abnomal_upt = "No Result";}
//        $txt_upt = $count++."ตรวจ ... (..)";
 
	$stat_cbc = $rows["stat_cbc"]; // ผลสรุป cbc
        if($stat_cbc == "ปกติ"){$nomal_cbc = "/";$abnomal_cbc = "";}else if($stat_cbc == "ผิดปกติ"){$nomal_cbc = "";$abnomal_cbc = "/";}else{$nomal_cbc = "No Result";$abnomal_cbc = "No Result";}
        
        if($stat_cbc){
            $txt_cbc = $count++.".ความสมบูรณ์ของเม็ดเลือด (CBC)";
            echo "
            <tr>
                <td width='400px' align='left' style='font-size:17px'>
                ".$txt_cbc."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$nomal_cbc."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$abnomal_cbc."
                </td>
            </tr>";
        }//end if

    $stat_ua = $rows["stat_ua"]; // ผลสรุป ua
        if($stat_ua == "ปกติ"){$nomal_ua = "/";$abnomal_ua = "";}else if($stat_ua == "ผิดปกติ"){$nomal_ua = "";$abnomal_ua = "/";}else{$nomal_ua = "No Result";$abnomal_ua = "No Result";}
        
        if($stat_ua){
            $txt_ua = $count++.".ตรวจปัสสาวะสมบูรณ์แบบ (Urine Examination)";
            echo "
            <tr>
                <td width='400px' align='left' style='font-size:17px'>
                ".$txt_ua."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$nomal_ua."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$abnomal_ua."
                </td>
            </tr>";
        }//end if
 

    $stat_hiv = $rows["stat_hiv"]; // ผลสรุป HIV
        if($stat_hiv == "ปกติ"){$nomal_hiv = "/";$abnomal_hiv = "";}else if($stat_hiv == "ผิดปกติ"){$nomal_hiv = "";$abnomal_hiv = "/";}else{$nomal_hiv = "No Result";$abnomal_hiv = "No Result";}
        
        if($stat_hiv){
            $txt_hiv = $count++.".ตรวจการติดเชื้อไวรัส เอช ไอ วี (Anti HIV)";
            echo "
            <tr>
                <td width='400px' align='left' style='font-size:17px'>
                ".$txt_hiv."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$nomal_hiv."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$abnomal_hiv."
                </td>
            </tr>";
        }//end if

    $stat_upt = $rows["stat_upt"]; // ผลสรุป upt
        if($stat_upt == "ปกติ"){$nomal_upt = "/";$abnomal_upt = "";}else if($stat_upt == "ผิดปกติ"){$nomal_upt = "";$abnomal_upt = "/";}else{$nomal_upt = "No Result";$abnomal_upt = "No Result";}
        
        if($stat_upt){
            $txt_upt = $count++.".ตรวจการตั้งครรภ์ (Pregnancy test)";
            echo "
            <tr>
                <td width='400px' align='left' style='font-size:17px'>
                ".$txt_upt."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$nomal_upt."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$abnomal_upt."
                </td>
            </tr>";
        }//end if

        /*
    $stat_vdrl = $rows["stat_vdrl"]; // ผลสรุป vdrl
        if($stat_vdrl == "ปกติ"){$nomal_vdrl = "/";$abnomal_vdrl = "";}else if($stat_vdrl == "ผิดปกติ"){$nomal_vdrl = "";$abnomal_vdrl = "/";}else{$nomal_vdrl = "No Result";$abnomal_vdrl = "No Result";}
        
        if($stat_vdrl){
            $txt_vdrl = $count++.".ตรวจหาโรคซิฟิลิส (VDRL)";
            echo "
            <tr>
                <td width='400px' align='left' style='font-size:17px'>
                ".$txt_vdrl."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$nomal_vdrl."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$abnomal_vdrl."
                </td>
            </tr>";
        }//end if
*/
    
    $stat_ldlc = $rows["stat_ldlc"]; // ผลสรุป ldlc / 10001
        if($stat_ldlc == "ปกติ"){$nomal_ldlc = "/";$abnomal_ldlc = "";}else if($stat_ldlc == "ผิดปกติ"){$nomal_ldlc = "";$abnomal_ldlc = "/";}else{$nomal_ldlc = "No Result";$abnomal_ldlc = "No Result";}
        
        if($stat_ldlc){
            $txt_ldlc = $count++.".ตรวจหาไขมันความหนาแน่นต่ำ (LDLC)";
            echo "
            <tr>
                <td width='400px' align='left' style='font-size:17px'>
                ".$txt_ldlc."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$nomal_ldlc."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$abnomal_ldlc."
                </td>
            </tr>";
        }//end if

        $stat_cxr = $rows["cxr"]; // ผลสรุป cxr
        if($stat_cxr == "ปกติ"){$nomal_cxr = "/";$abnomal_cxr = "";}else if($stat_cxr == "ผิดปกติ"){$nomal_cxr = "";$abnomal_cxr = "/";}else{$nomal_cxr = "No Result";$abnomal_cxr = "No Result";}
        
        if($stat_cxr){
            $txt_cxr = $count++.".ผลเอกซเรย์ทรวงอก (CXR)";
            echo "
            <tr>
                <td width='400px' align='left' style='font-size:17px'>
                ".$txt_cxr."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$nomal_cxr."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$abnomal_cxr."
                </td>
            </tr>";
        }//end if

        $stat_bs = $rows["stat_bs"]; // ผลสรุป bs
        if($stat_bs == "ปกติ"){$nomal_bs = "/";$abnomal_bs = "";}else if($stat_bs == "ผิดปกติ"){$nomal_bs = "";$abnomal_bs = "/";}else{$nomal_bs = "No Result";$abnomal_bs = "No Result";}
        
        if($stat_bs){
            $txt_bs = $count++.".ผลน้ำตาลในเลือด  (BS)";
            echo "
            <tr>
                <td width='400px' align='left' style='font-size:17px'>
                ".$txt_bs."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$nomal_bs."
                </td>
                <td width='100px' align='center' style='font-size:17px'>
                ".$abnomal_bs."
                </td>
            </tr>";
        }//end if


    //-----> ตรวจอื่นๆ
    $stat_ekg = $rows["ekg"]; // ผลสรุป ekg
    $stat_color_blind = $rows["color_blind"]; // ผลสรุป ตา color_blind (va)
    $stat_audiogram = $rows["audiogram"]; // การได้ยิน
    $stat_dental = $rows["dental_exam"]; // ฟัน

    $stat_rh = $rows["rh"]; // Rh blood group(ตรวจหมู่เลือดอาร์เอช)
    $stat_groupt = $rows["groupt"]; //   GROUPT  - ABO blood group(ตรวจหาหมู่เลือดเอ บี โอ)
    $stat_antihb = $rows["antihb"]; //   ภูมิคุ้มกัน HB
    if($stat_antihb == "Positive"){
        $stat_antihb = "มีภูมิคุ้มกัน";
    }else if($stat_antihb == "Negative"){
        $stat_antihb = "ยังไม่มีภูมิคุ้มกัน";
    }else{
        $stat_antihb = "";
    } //end if

    
    //----> ตรวจพิเศษแบบพิมพ์เองจากหน้าหมอ 2 ช่อง
    $stat_other1 = $rows["other1"]; // ตรวจพิเศษอื่นๆ 1
    $stat_stat_other1 = $rows["stat_other1"]; // ผลตรวจพิเศษอื่นๆ 1
    $reason_other1 = $rows["reason_other1"]; // เหตุผล 1
    $stat_other2 = $rows["other2"]; // ตรวจพิเศษอื่นๆ 2
    $stat_stat_other2 = $rows["stat_other2"]; // ผลตรวจพิเศษอื่นๆ 2
    $reason_other2 = $rows["reason_other2"]; // เหตุผล 2    
    //--------------//


}//end while

    //////////////////////////

    //-----> ข้อมูลการตรวจ PFT (ปอด)
    $sql = "SELECT * FROM `dxofyear_out` WHERE hn = '$hn' ";
    //echo $sql;exit();
    $query = mysql_query($sql); 
    $num = mysql_num_rows($query); 

    if(empty($num)){
        echo "<h1 align='center'>ไม่พบข้อมูลการตรวจ PFT (ปอด)</h1>";echo "<br>".exit();
    }//end if

    $count = 0;
    while($rows = mysql_fetch_array($query)){

        $stat_pft = $rows["pft"]; // ปอด

        //--- ถ้าหน้าหมอไม่มีผลตรวจ ให้ดึงข้อมูลจากหน้าพยาบาล
        if($stat_ekg == ""){$stat_ekg = $rows["ekg"];}
        if($stat_color_blind == ""){$stat_color_blind = $rows["color_blind"];}
        if($stat_audiogram == ""){$stat_audiogram = $rows["audiogram"];}
        if($stat_dental == ""){$stat_dental = $rows["dental_exam"];}

    }//end while

    ///////////////////////
 
    ?>
</table>
<br>
<b>รายการตรวจอื่นๆ</b> <br>
<font size="4">
<? 
    if($stat_dental != "" OR $stat_dental != null){
        echo "- ผลตรวจสุขภาพช่องปากและฟัน (Dental Examination) : <b>".$stat_dental."</b><br>"; //dental_exam
    }//end if

    if($stat_color_blind != "" OR $stat_color_blind != null){
        echo "- ผลตรวจสายตาและตาบอดสี (Auto-R & color blindness) : <b>".$stat_color_blind."</b><br>";
    }//end if

    if($stat_audiogram != "" OR $stat_audiogram != null){
        echo "- ผลตรวจการได้ยิน (Audiogram) : <b>".$stat_audiogram."</b><br>";
    }//end if

    if($stat_ekg != "" OR $stat_ekg != null){
        echo "- ผลตรวจคลื่นไฟฟ้าหัวใจ (EKG) : <b>".$stat_ekg."</b><br>";
    }//end if

    if($stat_pft != "" OR $stat_pft != null){
        echo "- ผลตรวจสมรรถภาพปอด (PFT) : <b>".$stat_pft."</b><br>"; //dental_exam
    }//end if

    if($stat_rh != "" OR $stat_rh != null){
        echo "- ตรวจหมู่เลือดอาร์เอช (Rh blood group) : <b>".$stat_rh."</b><br>"; //Rh blood group
    }//end if

    if($stat_groupt != "" OR $stat_groupt != null){
        echo "- ตรวจหมู่เลือดเอ บี โอ (ABO blood group) : <b>".$stat_groupt."</b><br>"; //ABO blood group
    }//end if

    if($stat_other1 != "" OR $stat_other1 != null){
        echo "- ".$stat_other1." <b>".$stat_stat_other1." ".$reason_other1."</b><br>"; //ตรวจพิเศษอื่นๆ 1
    }//end if

    if($stat_other2 != "" OR $stat_other2 != null){
        echo "- ".$stat_other2." <b>".$stat_stat_other2." ".$reason_other2."</b><br>"; //ตรวจพิเศษอื่นๆ 2
    }//end if

    if($stat_antihb != "" OR $stat_antihb != null){
        echo "- ตรวจภูมิคุ้มกันไวรัสตับอักเสบบี (Anti HB) : <b>".$stat_antihb."</b><br>"; //ตรวจ ภูมิคุ้มกัน HB
    }//end if
?>

</font>

<br>
<br>
<br>
<br>
<div align="right">ลงชื่อ ................................................................... แพทย์ผู้ตรวจร่างกาย</div>
<div align="right">(<? echo "$Txt_DocTitle $Txt_DocName";?>)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>

<script language="javascript">
		window.print();
        
</script>