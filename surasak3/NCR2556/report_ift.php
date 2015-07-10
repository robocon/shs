<? 
session_start();
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>ระบบรายงานเหตุการณ์สำคัญ/อุบัติการณ์/ความไม่สอดคล้อง</title>
    <!-- InstanceEndEditable -->
    <link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script>
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>
<body>

<style type="text/css">
* { margin:0;
    padding:0;
}
ody { /*background:rgb(74,81,85); */}
div#menu { margin:5px auto; }
div#copyright {
    font:11px 'Trebuchet MS';
    color:#fff;
    text-indent:30px;
    padding:40px 0 0 0;
}
td,th {
	font-family:"TH SarabunPSK";
	font-size: 16 pt;
}
.fontsara {
	font-family:"TH SarabunPSK";
	font-size: 16 pt;
}

@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 

/*div#copyright a { color:#00bfff; }
div#copyright a:hover { color:#fff; }*/
</style>
<div id="no_print">
<div id="menu">
  <ul class="menu">
 
  <!--http://10.0.1.4/sm3/nindex.htm-->
        <li><a href="http://192.168.1.2/sm3/nindex.htm" class="parent"><span>หน้าแรก</span></a></li>
        <li><a href="ncf2.php" class="parent"><span>บันทึกรายงานเหตุการณ์สำคัญ</span></a></li>
		<li><a href="fha_from.php" class="parent"><span>บันทึกรายงานความคลาดเคลื่อนทางยา</span></a></li>
        <li><a href="report_ift.php" class="parent"><span>แบบบันทึกการติดตามภาวะการติดเชื้อ</span></a></li>
        <li><a href="report_accident.php" class="parent"><span>แบบรายงานการได้รับอุบัติเหตุ</span></a></li>
      <?
		if($_SESSION["statusncr"]=='admin'){
	  ?>    
    
    	<li><a href="#"><span>ใบรายงานเหตุการณ์ฯ</span></a></li>
        <ul>
		<li class="last"><a href="ncf_list_clinic.php"><span>ใบรายงานที่ยังไม่ได้บันทึกระดับความรุนแรง</a></span></li>
        <li class="last"><a href="ncf_list_risk.php"><span>ใบรายงานที่ยังไม่ได้บันทึกความเสี่ยง</a></span></li>
        <li class="last"><a href="ncf_list_ic.php"><span>ใบรายงาน เฉพาะ IC และ MR </span></a></li>
    	<li class="last"><a href="ncf_listall.php"><span>ใบรายงานทั้งหมด</span></a></li>
        <li class="last"><a href="ncf_list_riskmore2.php"><span>ตรวจสอบใบรายงาน</span></a></li>
        </ul>
        <li><a href="#"><span>รายงานสรุป</span></a></li>
     	<ul>
        <li class="last"><a href="ncr_report_all.php"><span>รายงานสรุปอุบัติการณ์ รวมทั้งหมด</span></a></li>
	  	<li class="last"><a href="ncr_report_progarm.php"><span>รายงานสรุปอุบัติการณ์จำแนกตามโปรแกรม</span></a></li>
        <li class="last"><a href="ncr_report_event.php"><span>รายงานสรุปอุบัติการณ์จำแนกตามเหตุการณ์</span></a></li>
        <li class="last"><a href="ncf_report_departall.php"><span>รายงานสรุปอุบัติการณ์จำแนกตามแผนก</span></a></li>
        <li class="last"><a href="ncr_report_progarmdepart2.php"><span>รายงานสรุปความเสี่ยงแต่ละแผนก</span></a></li>
        <li class="last"><a href="ncr_report_clinic.php"><span>รายงานสรุประดับความรุนแรง</span></a></li>
	  	<li class="last"><a href="ncf_report_depart.php"><span>หน่วยงานที่รายงานอุบัติการณ์</a></span></li>
        <li class="last"><a href="fha_report_depart.php"><span>รายงานสรุป ความคลาดเคลื่อนทางยา</a></span></li>
        <li class="last"><a href="report_ic_accident.php"><span>รายงานอุบัติการณ์ IC</span></a></li>
        <li class="last"><a href="ic_report_depart.php"><span>สรุปอุบัติการณ์ IC  ประจำปี</span></a></li>
       	</ul>
        <li><a href="#"><span>รายงานความคลาดเคลื่อนทางยา</span></a></li>
     
     <ul>
	  	<li class="last"><a href="fha_data_old.php"><span>ข้อมูลเก่า หลังเดือน ม.ค.2555</span></a></li>
	  	<li class="last"><a href="report_fha.php"><span>ข้อมูลใหม่ ตั้งแต่ ม.ค.2555 ขึ้นไป</a></span></li>
       	</ul>
        <li><a href="ncf_member.php"><span>รายชื่อผู้ใช้ในระบบ</span></a></li>
        <li><a href="logout.php"><span>ออกจากระบบ</span></a></li>
        
       <? } if($_SESSION["statusncr"]=='staff'){?>
       <li><a href="ncf_list_depart.php"><span>ใบรายงานเหตุการณ์ฯ</span></a></li>
        <ul>
	  	<li class="last"><a href="ncf_list_depart.php"><span>ใบรายงานเหตุการณ์ฯ  (โปรแกรมใหม่ 2556)</span></a></li>
	  	<li class="last"><a href="ncf_list_old.php"><span>ใบรายงานเหตุการณ์ฯ (โปรแกรมเก่า < 2556)</a></span></li>
       	</ul>
       <li><a href="#"><span>สถิติ</span></a></li> 
       
       <ul>
	  	<li class="last"><a href="ncr_report_progarmdepart.php"><span>สถิติความเสี่ยงของแผนก</span></a></li> 
	  	<li class="last"><a href="ncr_report_all_depart.php"><span>สถิติอุบัติการณ์ </a></span></li>
       	</ul>
       <li><a href="ncf_member.php"><span>รายชื่อผู้ใช้ในระบบ</span></a></li>
        <li><a href="logout.php"><span>ออกจากระบบ</span></a></li>
        
     <? } if($_SESSION["statusncr"]=='phar'){?>
     
     <li><a href="#"><span>รายงานความคลาดเคลื่อนทางยา</span></a></li>
     
     <ul>
	  	<li class="last"><a href="fha_data_old.php"><span>ข้อมูลเก่า หลังเดือน ม.ค.2555</span></a></li>
	  	<li class="last"><a href="report_fha.php"><span>ข้อมูลใหม่ ตั้งแต่ ม.ค.2555 ขึ้นไป</a></span></li>
       	</ul>
       
        <li><a href="logout.php"><span>ออกจากระบบ</span></a></li>
        <? } if($_SESSION["statusncr"]!='admin' && $_SESSION["statusncr"]!='staff' && $_SESSION["statusncr"]!='phar'  && $_SESSION["Userncr"]!=""){ ?>
        <li><a href="ncf_list_depart.php"><span>ใบรายงานเหตุการณ์ฯ</span></a></li>
        <ul>
	  	<li class="last"><a href="ncf_list_depart.php"><span>ใบรายงานเหตุการณ์ฯ  (โปรแกรมใหม่ 2556)</span></a></li>
	  	<li class="last"><a href="ncf_list_old.php"><span>ใบรายงานเหตุการณ์ฯ (โปรแกรมเก่า < 2556)</a></span></li>
       	</ul>
        <li><a href="#"><span>รายงานสรุป</span></a></li>
     	<ul>
	  	<li class="last"><a href="ncr_report_progarm.php"><span>รายงานสรุปอุบัติการณ์จำแนกตามโปรแกรม</span></a></li>
        <? if($_SESSION["statusncr"]=='IC'){ ?>
        <li class="last"><a href="report_ic_accident.php"><span>รายงานอุบัติการณ์ IC</span></a></li>
        <li class="last"><a href="ic_report_depart.php"><span>สรุปอุบัติการณ์ IC  ประจำปี</span></a></li>
        <? } ?>
	  <!--	<li class="last"><a href="ncf_report_depart.php"><span>หน่วยงานที่รายงานอุบัติการณ์</a></span></li>-->
       	</ul>
        <!--<li><a href="ncf_member.php"><span>สถิติความเสี่ยง</span></a></li>--> 
        <li><a href="ncf_member.php"><span>รายชื่อผู้ใช้ในระบบ</span></a></li>
        <li><a href="logout.php"><span>ออกจากระบบ</span></a></li>
      <?  }   if(!$_SESSION["Userncr"]){?>
        <li class="last"><a href="login.php"><span>เข้าสู่ระบบ</span></a></li>
        <? } ?>
         
	

    </ul>
</div>
<?
if(isset($_SESSION["Userncr"])){
include("connect.inc");

$strSQL = "SELECT * FROM member WHERE  username = '".$_SESSION["Userncr"]."'";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
?>
<span class="fontsara">ผู้ใช้งานขณะนี้ ::  <strong><?=$objResult['name']?></strong> &nbsp;&nbsp;<strong><?=$_SESSION["Untilncr"]?></strong></span> <? } ?>
<div style="visibility: hidden">
 <br />
 <a href="http://apycom.com/">aaa</a><br />
</div>

</div>


<div><!-- InstanceBeginEditable name="detail" -->
<style type="text/css">
<!--
.h {
	font-family: "TH SarabunPSK";
	font-size:24px;
}
.hfont{
	font-family: "TH SarabunPSK";
	font-size:18px;
}
-->
</style>
<style type="text/css">
table.sample {
	border-width: 2px;
	border-spacing: 1px;
	border-style: none;
	border-color: black;
	border-collapse: collapse;
	background-color: white;
}
table.sample th {
	border-width: 2px;
	padding: 2px;
	/*border-style: dashed; */
	border-color: black;
	background-color: rgb(255, 245, 238);
	-moz-border-radius: ;
}
table.sample td {
	border-width: 2px;
	padding: 2px;
	/* border-style: dashed; */
	border-color: black;
	background-color: rgb(255, 245, 238);
	-moz-border-radius: ;
}
.font22{
	font-family:"TH SarabunPSK";
	font-size:18px;
	color:#00F;
}
</style>

<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('addate'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('dcdate'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date1'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date2'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date3'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date4'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date5'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date6'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date7'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date8'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date9'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date10'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date11'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date12'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date13'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date14'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date15'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date16'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('dateproc'));
	
	
	
	
	
};
</script>
 <style>
		.forntsarabun{
			font-family:"TH SarabunPSK";
			font-size:18px;
		}
		</style>

<!--<a href="../../nindex.htm" class="forntsarabun">กลับเมนูหลัก </a>&nbsp;&nbsp;<a href="report_accident.php" class="forntsarabun">แบบรายงานการได้รับอุบัติเหตุ ฯ </a>-->
<h2 class="h" align="center">แบบบันทึกการติดตามภาวะการติดเชื้อในโรงพยาบาลค่ายสุรศักดิ์มนตรี ของผู้ป่วยกลุ่มเสี่ยง</h2>
<h3 class="h" align="center">FR-ICC-001/1,00,1  พ.ย. 50</h3>
<p align="center">.............................................................................................</p>


<script language="javascript">
function fncSubmit1(strPage)
{
	if(strPage == "page1")
	{
		document.f1.action="<?=$_SERVER['PHP_SELF'];?>?do=select";
	}
/*	if(document.f1.hn.value==''){
		alert('กรุณาระบุ HN และตรวจสอบด้วยครับ');
		document.f1.hn.focus();
	}*/
	
	
	document.f1.submit();
}
</script>

<?

include("connect2.php");

if($_REQUEST['do']=='select'){

$sql = "Select * From ipcard where an = '".$_POST["an"]."' ";

$result = mysql_query($sql)or die (mysql_error());
$row=mysql_num_rows($result);
if($row>0){
$dbarr=mysql_fetch_array($result);

$ptname=$dbarr['ptname'];
global  $ptname;
include("connect.inc");
$mysql="Select * From ic_infection where an = '".$_POST["an"]."' order by registerdate desc limit 1 ";
$myresult = mysql_query($mysql);

	$myrow=mysql_num_rows($myresult);
	if($myrow){
	$myarr=mysql_fetch_array($myresult);
	$action = "edit_ift.php";
	}else{
	$action = "add_ift.php";
	}
}else{
	echo "<script>alert('ไม่พบ AN $_POST[an]');</script>";
}

}

?>

<form name="f1" action="<?php echo $action;?>" method="post">
<table  class="sample" align="center">
  <tr class="hfont">
    <td height="33" colspan="5" bgcolor="#CCCCCC"><b class="h">ข้อมูลทั่วไปของผู้ป่วย</b></td>
  </tr>
  <tr class="hfont">
    <td><strong>AN</strong></td>
    <td><strong>
      <input name="an" type="text"  class="hfont" id="an" value="<?=$dbarr['an']; ?>"/>
      <input name="b1" type="button" class="font22"  value="ตรวจสอบ" onClick="JavaScript:fncSubmit1('page1')"/>
    </strong></td>
    <td ><strong>HN</strong></td>
    <td><strong>
      <input name="hn" type="text"  class="hfont" id="hn" value="<?=$dbarr['hn']; ?>"/>
    </strong></td>
    <td>&nbsp;</td>
    </tr>
  <tr class="hfont">
    <td><strong>ชื่อ - สกุล</strong></td>
    <td><strong>
      <input name="ptname" type="text"  class="hfont" id="ptname" value="<?=$dbarr['ptname']; ?>"/>
    </strong></td>
    <td><strong>อายุ</strong></td>
    <td><strong>
      <input name="age" type="text"  class="hfont" id="age" value="<?=$dbarr['age']; ?>"/>
    </strong></td>
    <td><strong>สิทธิการรักษา
      <input name="ptright" type="text"  class="hfont" id="ptright" value="<?=$dbarr['ptright']; ?>"/>
    </strong></td>
    </tr>
  <tr class="hfont">
    <td><strong>รับใหม่เมื่อ</strong></td>
    <td><strong>
      <input name="addate" type="text"  class="hfont" id="addate" value="<?=$dbarr['date']; ?>"/>
    </strong></td>
    <td><strong>จำหน่ายเมื่อ</strong></td>
    <td><strong>
      <input name="dcdate" type="text"  class="hfont" id="dcdate" value="<?=$dbarr['dcdate']; ?>"/>
    </strong></td>
    <td>&nbsp;</td>
    </tr>
  <tr class="hfont">
    <td><strong>เบอร์โทรศัพท์ติดต่อ</strong></td>
    <td><strong>
      <input name="tel" type="text"  class="hfont" id="tel" value="<?=$myarr['tel'];?>"/>
    </strong></td>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
    </tr>
  <tr class="hfont">
    <td align="right"><strong>การวินิจฉัยโรค 1.</strong></td>
    <td><strong>
      <input name="diag1" type="text"  class="hfont" id="diag1" value="<?=$myarr['diag1'];?>"/>
      </strong></td>
    <td colspan="2"><strong>2.
      <input name="diag2" type="text"  class="hfont" id="diag2" value="<?=$myarr['diag2'];?>"/>
      </strong></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr class="hfont">
    <td align="right"><strong>3.</strong></td>
    <td><strong>
      <input name="diag3" type="text"  class="hfont" id="diag3" value="<?=$myarr['diag3'];?>"/>
    </strong></td>
    <td colspan="2"><strong>4.
      <input name="diag4" type="text"  class="hfont" id="diag4" value="<?=$myarr['diag4'];?>"/>
    </strong></td>
    <td align="center">&nbsp;</td>
    </tr>
  <tr class="hfont">
    <td><strong>โรคประจำตัว</strong></td>
    <td colspan="4"><strong>
      <input name="disease" type="text"  class="hfont" id="disease" value="<?=$myarr['disease'];?>"/>
    </strong></td>
    </tr>
  <tr class="hfont">
    <td colspan="2"><strong>สถานะของผู้ป่วยเมื่อจำหน่าย</strong></td>
    <td colspan="3"><strong>
      <label>
        <input type="radio" name="status_dc" id="status_dc1"   value="1" <? if($myarr['status_dc']==1){ echo "checked='checked'";} ?>/>
      </label>      
      สมบูรณ์</strong></td>
    </tr>
  <tr class="hfont">
    <td colspan="2">&nbsp;</td>
    <td colspan="3"><strong>
      <input type="radio" name="status_dc" id="status_dc2"  value="2" <? if($myarr['status_dc']==2){ echo "checked='checked'";} ?>/>      
      ต้องการการดูแลต่อเนื่องที่บ้าน</strong></td>
    </tr>
  <tr class="hfont">
    <td colspan="2">&nbsp;</td>
    <td colspan="3"><strong>
      <input type="radio" name="status_dc" id="status_dc3"  value="3" <? if($myarr['status_dc']==3){ echo "checked='checked'";} ?>/>      
      ส่งเข้ารับการรักษาต่อที่ ร.พ.
      <input name="refer_host" type="text"  class="hfont" size="50" value="<?=$myarr['refer_host'];?>"/>
    </strong></td>
    </tr>
  <tr class="hfont">
    <td height="53" colspan="5" bgcolor="#CCCCCC"><b class="h">ส่วนที่ 1 ปัจจัยเสี่ยงที่ทำให้เกิดการติดเชื่อในโรงพยาบาล ของผู้ป่วยรายนี้ คือ </b></td>
    </tr>
  <tr class="hfont">
    <td colspan="5">
    <table border="1" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse" bgcolor="#000000">
      <tr>
        <td width="34" ><strong>ลำดับ</strong></td>
        <td colspan="7" align="center"><strong>ปัจจัยเสี่ยง</strong></td>
        <td width="287" align="center"><strong>วัน เดือน ปี </strong></td>
      </tr>
      <tr>
        <td align="center"><strong>1</strong></td>
        <td colspan="7"><strong>การใส่สายสวนปัสสาวะ</strong></td>
        <td><strong>
          <input name="date2" type="text"  class="hfont" id="date2" value="<?=$myarr['date2'];?>"/>
        </strong></td>
      </tr>
      <tr>
        <td align="center"><strong>2</strong></td>
        <td colspan="3"><strong>การใช้เครื่องช่วยหายใจ</strong></td>
        <td colspan="2"><strong>
          <input type="radio" name="respirator" id="Respirator1"  value="ใส่ ET-Tube" <? if($myarr['respirator']=='ใส่ ET-Tube'){ echo "checked='checked'";}?>/>          
          ใส่ ET-Tube</strong></td>
        <td colspan="2"><strong>
          <input type="radio" name="respirator" id="Respirator2" value="เจาะคอ" <? if($myarr['respirator']=='เจาะคอ'){ echo "checked='checked'";}?>/>          
          เจาะคอ</strong></td>
        <td><strong>
          <input name="date3" type="text"  class="hfont" id="date3" value="<?=$myarr['date3'];?>"/>
        </strong></td>
      </tr>
      <tr>
        <td align="center"><strong>3</strong></td>
        <td colspan="7"><strong>ประวัติการสำลักอาหาร,น้ำ</strong></td>
        <td><strong>
          <input name="date4" type="text"  class="hfont" id="date4" value="<?=$myarr['date4'];?>"/>
        </strong></td>
      </tr>
      <tr>
        <td align="center"><strong>4</strong></td>
        <td colspan="3"><strong>การผ่าตัด          
          <input name="surgery" type="text"  class="hfont" id="surgery" value="<?=$myarr['surgery'];?>"/>
        </strong></td>
        <td colspan="2"><strong>
          <input type="radio" name="surgeryor" id="Surgeryor1" value="ใส่ Drain" <? if($myarr['surgeryor']=='ใส่ Drain'){ echo "checked='checked'";}?> />          
          ใส่ Drain</strong></td>
        <td colspan="2"><strong>
          <input type="radio" name="surgeryor" id="Surgeryor2" value="ไม่ใส่ Drain"  <? if($myarr['surgeryor']=='ไม่ใส่ Drain'){ echo "checked='checked'";}?>/>          
          ไม่ใส่ Drain</strong></td>
        <td><strong>
          <input name="date5" type="text"  class="hfont" id="date5" value="<?=$myarr['date5'];?>"/>
        </strong></td>
      </tr>
      <tr>
        <td align="center"><strong>5</strong></td>
        <td colspan="2"><strong>การคลอด</strong></td>
        <td width="83"><strong>
          <input type="radio" name="birth" id="Birth1"  value="C/S"  <? if($myarr['birth']=='C/S'){ echo "checked='checked'";}?>/> 
          C/S </strong></td>
        <td colspan="2"><strong>
          <input type="radio" name="birth" id="Birth2"  value="N/L" <? if($myarr['birth']=='N/L'){ echo "checked='checked'";}?>/>
          N/L</strong></td>
        <td colspan="2"><strong>
          <input type="radio" name="birth" id="Birth3"  value="หัตถการ" <? if($myarr['birth']=='หัตถการ'){ echo "checked='checked'";}?>/> 
          หัตถการ</strong></td>
        <td><strong>
          <input name="date6" type="text"  class="hfont" id="date6" value="<?=$myarr['date6'];?>"/>
        </strong></td>
      </tr>
      <tr>
        <td align="center" valign="top"><strong>6</strong></td>
        <td width="129" valign="top"><strong>การทำหัตถการต่างๆ</strong></td>
        <td colspan="6"><strong>
          <label>
            <input name="procedure" type="text" class="hfont" id="procedure" value="<?=$myarr['procedure'];?>" size="40">
          </label>
        </strong></td>
        <td><strong>
          <input name="dateproc" type="text"  class="hfont" id="dateproc" value="<?=$myarr['dateproc'];?>">
        </strong></td>
      </tr>
    </table>

    </td>
    </tr>
  <tr class="hfont">
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr class="h">
    <td colspan="5"><strong>ส่วนที่ 2 ผลการติดตาม ผู้ป่วย เมื่อ ( วัน เดือน ปี )
      
        <input name="date7" type="text"  class="hfont" id="date7" value="<?=$myarr['date7'];?>"/>
มีอาการดังนี้ </strong></td>
  </tr>
  <tr class="hfont">
    <td colspan="5"><table border="1" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse" bgcolor="#000000">
      <tr>
        <td align="center"><strong>ลำดับ</strong></td>
        <td align="center"><strong>อาการ</strong></td>
        <td align="center">มี</td>
        <td align="center">ไม่มี</td>
        <td align="center"><strong>เริ่มวันที่ </strong></td>
      </tr>
      <tr>
        <td align="center"><strong>1</strong></td>
        <td><strong>ไข้ มากกว่า 38 องศาเซลเซียส</strong></td>
        <td align="center"><input type="radio" name="fever" id="fever1"  value="1" <? if($myarr['fever']==1){ echo "checked='checked'";}?>/></td>
        <td align="center"><input type="radio" name="fever" id="fever2"  value="2" <? if($myarr['fever']==2){ echo "checked='checked'";}?>/></td>
        <td><strong>
          <input name="date8" type="text"  class="hfont" id="date8" value="<?=$myarr['date8'];?>"/>
        </strong></td>
      </tr>
      <tr>
        <td align="center"><strong>2</strong></td>
        <td><strong> - ปัสสาวะกะปิดกะปรอย</strong></td>
        <td align="center"><input type="radio" name="urine" id="Urine1"  value="1" <? if($myarr['urine']==1){ echo "checked='checked'";}?>/></td>
        <td align="center"><input type="radio" name="urine" id="Urine2"  value="2" <? if($myarr['urine']==2){ echo "checked='checked'";}?>/></td>
        <td><strong>
          <input name="date9" type="text"  class="hfont" id="date9" value="<?=$myarr['date9'];?>"/>
        </strong></td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
        <td><strong>- ปวดท้องน้อย</strong></td>
        <td align="center"><input type="radio" name="abdominal" id="abdominal1"  value="1" <? if($myarr['abdominal']==1){ echo "checked='checked'";}?>/></td>
        <td align="center"><input type="radio" name="abdominal" id="abdominal2"  value="2" <? if($myarr['abdominal']==2){ echo "checked='checked'";}?> /></td>
        <td><strong>
          <input name="date10" type="text"  class="hfont" id="date10" value="<?=$myarr['date10'];?>"/>
        </strong></td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
        <td><strong>- กดเจ็บบริเวณหัวเหน่า</strong></td>
        <td align="center"><input type="radio" name="pubis" id="pubis1"  value="1" <? if($myarr['pubis']==1){ echo "checked='checked'";}?>/></td>
        <td align="center"><input type="radio" name="pubis" id="pubis2"  value="2" <? if($myarr['pubis']==2){ echo "checked='checked'";}?>/></td>
        <td><strong>
          <input name="date11" type="text"  class="hfont" id="date11" value="<?=$myarr['date11'];?>"/>
        </strong></td>
      </tr>
      <tr>
        <td align="center"><strong>3</strong></td>
        <td><strong>ไอ มีเสมหะ สีเขียว / เหลือง</strong></td>
        <td align="center"><input type="radio" name="cough" id="cough1"  value="1" <? if($myarr['cough']==1){ echo "checked='checked'";}?>/></td>
        <td align="center"><input type="radio" name="cough" id="cough2"  value="2" <? if($myarr['cough']==2){ echo "checked='checked'";}?>/></td>
        <td><strong>
          <input name="date12" type="text"  class="hfont" id="date12" value="<?=$myarr['date12'];?>"/>
        </strong></td>
      </tr>
      <tr>
        <td align="center"><strong>4</strong></td>
        <td><strong>- แผลผ่าตัด อักเสบ บวม มีหนอง</strong></td>
        <td align="center"><input type="radio" name="wound" id="wound1"  value="1" <? if($myarr['wound']==1){ echo "checked='checked'";}?>/></td>
        <td align="center"><input type="radio" name="wound" id="wound2"  value="2" <? if($myarr['wound']==2){ echo "checked='checked'";}?>/></td>
        <td><strong>
          <input name="date13" type="text"  class="hfont" id="date13" value="<?=$myarr['date13'];?>"/>
        </strong></td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
        <td><strong>- ฝีเย็บบวม / แดง /แยก /มีหนอง</strong></td>
        <td align="center"><input type="radio" name="episiotomy" id="episiotomy1"  value="1" <? if($myarr['episiotomy']==1){ echo "checked='checked'";}?>/></td>
        <td align="center"><input type="radio" name="episiotomy" id="episiotomy2"  value="2" <? if($myarr['episiotomy']==2){ echo "checked='checked'";}?>/></td>
        <td><strong>
          <input name="date14" type="text"  class="hfont" id="date14"  value="<?=$myarr['date14'];?>"/>
        </strong></td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
        <td><strong>- น้ำคาวปลามีกลิ่นเหม็น</strong></td>
        <td align="center"><input type="radio" name="smell" id="smell1"  value="1" <? if($myarr['smell']==1){ echo "checked='checked'";}?>/></td>
        <td align="center"><input type="radio" name="smell" id="smell2"  value="2" <? if($myarr['smell']==2){ echo "checked='checked'";}?>/></td>
        <td><strong>
          <input name="date15" type="text"  class="hfont" id="date15" value="<?=$myarr['date15'];?>"/>
        </strong></td>
      </tr>
      <tr>
        <td align="center"><strong>5</strong></td>
        <td><strong>- ผิวหนังบริเวณที่ทำหัตถการ บวม แดง อักเสบ มีหนอง</strong></td>
        <td align="center"><input type="radio" name="skin" id="skin1"  value="1" <? if($myarr['skin']==1){ echo "checked='checked'";}?>/></td>
        <td align="center"><input type="radio" name="skin" id="skin2"  value="2" <? if($myarr['skin']==2){ echo "checked='checked'";}?>/></td>
        <td><strong>
          <input name="date16" type="text"  class="hfont" id="date16" value="<?=$myarr['date16'];?>"/>
        </strong></td>
      </tr>
      <tr>
        <td colspan="5" align="left" valign="top"><table width="0%" border="0" align="left" cellpadding="0" cellspacing="0" bordercolorlight="#FFFFFF" bordercolordark="#000000">
          <tr class="hfont">
            <td width="118"><strong>การวินิจฉัยเบื้องต้น</strong></td>
            <td width="756"><strong>
              <label>
                <input type="radio" name="initial_diag" id="initial_diag1"  value="1" <? if($myarr['initial_diag']==1){ echo "checked='checked'";}?> />
                </label>
              คาดว่าน่าจะมีการติดเชื้อจากโรงพยาบาล</strong></td>
            </tr>
          <tr class="hfont">
            <td>&nbsp;</td>
            <td><strong>
              <label>
                <input type="radio" name="initial_diag" id="initial_diag2"  value="0" <? if($myarr['initial_diag']=='0'){ echo "checked='checked'";}?>/>
                </label>
              </strong>
              <label>              </label>
              <strong>
                ไม่พบภาวะการติดเชื้อจากการติดตามเผ้าระวัง </strong></td>
            </tr>
          <tr class="hfont">
            <td colspan="2" align="center"><input type="hidden" name="row_id" value="<?=$myarr['row_id'];?>" /><input name="b1" type="submit" class="font22" id="b1" value="บันทึกข้อมูล" /></td>
            </tr>
          </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>