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
<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('fha_date'));

};
function newXmlHttp(){
	var xmlhttp = false;

		try{
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
		try{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e){
				xmlhttp = false;
			}
		}

		if(!xmlhttp && document.createElement){
			xmlhttp = new XMLHttpRequest();
		}
	return xmlhttp;
}

function searchSuggest(str,len,getto1,getto2,getto3) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'fha_getfill.php?action=an&search=' + str+'&getto1=' + getto1+'&getto2=' + getto2+'&getto3=' + getto3;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list3").innerHTML = xmlhttp.responseText;
		}
}
	function searchSuggest2(str,len,getto1,getto2) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'fha_getfill.php?action=hn&search2=' + str+'&getto1=' + getto1+'&getto2=' + getto2;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list3").innerHTML = xmlhttp.responseText;
		}
}
</script>

<style>
.font1{
	font-family:"TH SarabunPSK";
	font-size:24px;
	font-weight:bold;
}
.font2{
	font-family:Tahoma, Geneva, sans-serif;
	font-size:14px;
}
.font22{
	font-family:"TH SarabunPSK";
	font-size:16pt;
	color:#00F;
}

/*a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:  MS Sans Serif;
	font-size: 14px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 14px;
	color: #FFFFFF;
	font-weight: bold;
}*/
</style>
<script language=Javascript>
function fncSubmit()
{
	var fn = document.f1;
	
	if(fn.ptname.value=="")
	{
		alert('กรุณาระบุ ชื่อ-นามสกุลผู้ป่วย');
		fn.ptname.focus();
		return false;
	}
	if(fn.hn.value=="")
	{
		alert('กรุณาระบุ HN ผู้ป่วย');
		fn.hn.focus();
		return false;
	}		

	if(fn.area.value=="")
	{
		alert('กรุณาระบุ สถานที่เกิดเหตุ');
		fn.area.focus();		
		return false;
	}	
	if(fn.fha_date.value=="")
	{
		alert('กรุณาระบุ วันเดือนปีที่เกิดความคลาดเคลื่อนทางยาขึ้น ');
		fn.fha_date.focus();		
		return false;
	}	
	if(fn.fha_time1.selectedIndex==0 && fn.fha_time2.selectedIndex==0){
		alert('กรุณาเลือกเวลาที่เกิดความคลาดเคลื่อนทางยาขึ้น');
		fn.fha_time1.focus();
		return false;
	}
	if(fn.order_name.value==""){
		alert('กรุณาระบุ ผู้สั่งยา');
		fn.order_name.focus();		
		return false;
	}
	if(fn.pay_name.value==""){
		alert('กรุณาระบุ ผู้จ่ายยา');
		fn.pay_name.focus();		
		return false;
	}
	if(fn.give_name.value==""){
		alert('กรุณาระบุ ผู้ให้ยา');
		fn.give_name.focus();		
		return false;
	}
	if(fn.report_name.value==""){
		alert('กรุณาระบุ ผู้รายงาน');
		fn.report_name.focus();		
		return false;
	}
	if(fn.depart.value==""){
		alert('กรุณาระบุ กอง/แผนก');
		fn.depart.focus();		
		return false;
	}
	
	fn.submit();
}

</script>

<link rel="stylesheet" type="text/css" href="epoch_styles.css"/>

<h1 class="font1" align="center">แบบรายงานความคลาดเคลื่อนทางยาของโรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง</h1>
<!--<a href="../sm3/nindex.htm"><-----ไปเมนู</a>-->
<script language="javascript">
/*function fncSubmit1(strPage)
{
	if(strPage == "page1")
	{
		document.f1.action="<?//=$_SERVER['PHP_SELF'];?>?do=select";
	}

	document.f1.submit();
}*/
</script>
<?




 $thidate=(date("Y")+543).'-'.date("m").'-'.date("d"); 

 if($_GET["edit"]=="true"){
include("connect.inc");		
		$sql = "Select * From drug_fail_2 where row_id = '".$_GET["row_id"]."' limit  1 ";
		$result = mysql_query($sql) or die(mysql_error());
		$arr_edit = mysql_fetch_assoc($result);
		
		//echo $sql;
		
		$hn=$arr_edit['hn'];
		$ptname=$arr_edit['ptname'];
		$file = "fha_edit.php";
		
		
		$hd = "<input name=\"row_id\" type=\"hidden\" value=\"".$arr_edit["row_id"]."\" />";
	}else{
		$file = "fha_add2.php";
	}
 
 
?>


<form name="f1" action="<?php echo $file;?>" method="post" onSubmit="return fncSubmit();">
<table align="center" border="1">
<tr>
<td>
 
<table border="0" align="center" cellpadding="2" cellspacing="0" class="font2">
  <tr>
    <td><input type="radio" name="type_opd" id="radio10" value="opd" <?php if($arr_edit["type_opd"]=="opd") echo " Checked "; ?> onClick="javaScript:if(this.checked){document.all.spHN.style.display='';document.all.spPANME.style.display='';document.all.spAN.style.display='none';document.all.hn.focus();document.all.an.value=''}"/>
      ผู้ป่วยนอก
      <input type="radio" name="type_opd" id="radio11" value="ipd" <?php if($arr_edit["type_opd"]=="ipd") echo " Checked "; ?> onClick="javaScript:if(this.checked){document.all.spHN.style.display='';document.all.spAN.style.display='';document.all.spPANME.style.display='';document.all.an.focus();}"/>  ผู้ป่วยใน</td>
    <td colspan="6">&nbsp;&nbsp;&nbsp;
    <span id="spHN" style="display:none;">
    HN <input type="text" name="hn"  class="font22" value="<?=$hn;?>"  id="hn" onKeyPress="searchSuggest2(this.value,3,'hn','ptname');"/>
      </span>
    <span id="spAN" style="display:none;">
      AN  <input type="text" name="an"  class="font22" value="<?=$arr_edit['an'];?>" id="an" onKeyPress="searchSuggest(this.value,3,'an','ptname','hn');"/>
     </span>
     <span id="spPANME" style="display:none;">
      ชื่อ-นามสกุลผู้ป่วย
      <input type="text" name="ptname"  class="font22" value="<?=$ptname;?>" id="ptname" />
      </span>
      
      
      </td>
    </tr>
  <tr>
    <td>สถานที่เกิดเหตุ<div id="list3" style="position: absolute;"></div></td>
    <td>
    <select name="area"  id="area" class="font2">
            <option value="">--------------</option>
             <?php
									include("connect.inc");
										$sql="SELECT * FROM `departments` where status='y' ";
										$query=mysql_query($sql);
										
										while($arr=mysql_fetch_array($query)){
											
											if($arr_edit["area"]==$arr['code']){
											echo "<option value='$arr[code]' selected>$arr[name]</option> ";
											}else{
											echo "<option value='$arr[code]'>$arr[name]</option> ";	
											}
										}
									?>
          </select>
    </td>
    <td>วันเดือนปี</td>
    <td><input name="fha_date" type="text" id="fha_date" size="10" maxlength="10" class="font2" value="<? if($arr_edit['fha_date']=="0000-00-00"){ echo $thidate; }else{ echo $arr_edit['fha_date']; }?>"/></td>
    <td>เวลา</td>
    <td><select name="fha_time1">
		  		<option value="0">--</option>
                <?php 
				list($fha_time1,$fha_time2,$fha_time3) = explode(":",$arr_edit["fha_time"]);
				for($i=0;$i<=23;$i++){ 
					echo "<Option value=\"".sprintf('%02d',$i)."\" ";
						if($fha_time1 == $i) echo " Selected ";
					echo ">".sprintf('%02d',$i)."</Option>";
				}?>
              </select>
          :
          <select name="fha_time2">
		  	<option value="0">--</option>
            <?php 
			for($i=0;$i<=59;$i=$i+5){ 
				echo "<Option value=\"".sprintf('%02d',$i)."\" ";
						if($fha_time2 == $i) echo " Selected ";
					echo ">".sprintf('%02d',$i)."</Option>";
			}?>
          </select>น.</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>ผู้สั่งยา</td>
    <td><input type="text" name="order_name"  class="font2" value="<?=$arr_edit['order_name'];?>"/></td>
    <td>ผู้จ่ายยา</td>
    <td><input type="text" name="pay_name"  class="font2" value="<?=$arr_edit['pay_name'];?>"/></td>
    <td>ผู้ให้ยา</td>
    <td><input type="text" name="give_name"  class="font2" id="give_name" value="<?=$arr_edit['give_name'];?>"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>ผู้รายงาน</td>
    <td> <input type="text" name="report_name"  class="font2" id="report_name" value="<?=$arr_edit['report_name'];?>"/></td>
    <td>กอง/แผนก</td>
    <td><select name="depart"  id="depart" class="font2">
            <option value="">--------------</option>
             <?php
										include("connect.inc");
										$sql="SELECT * FROM `departments` where status='y' ";
										$query=mysql_query($sql);
										
										while($arr=mysql_fetch_array($query)){
											
											if($arr_edit["depart"]==$arr['code']){
											echo "<option value='$arr[code]' selected>$arr[name]</option> ";
											}else{
											echo "<option value='$arr[code]'>$arr[name]</option> ";	
											}
										}
									?>
          </select></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table><br />
<table border="1" align="center" cellpadding="0" cellspacing="0" class="font2" style="border-collapse:collapse" bordercolor="#000000">
  <tr>
    <td colspan="4" align="center">ชนิดความคลาดเคลื่อนทางยา</td>
    </tr>
  <tr>
    <td colspan="2" align="center">การสั่งยา (Prescribing error)</td>
    <td colspan="2" align="center">การจ่ายยา(Dispensing error)</td>
    </tr>
  <tr>
    <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input name="p1" type="checkbox" id="p1" value="1" <?php if($arr_edit["p1"]=="1") echo " Checked "; ?>/>
          สั่งยาโดยไม่มีข้อบ่งใช้</td>
        </tr>
      <tr>
        <td><input name="p2" type="checkbox" id="p2" value="1" <?php if($arr_edit["p2"]=="1") echo " Checked "; ?>/>
สั่งยาโดยไม่มีข้อห้ามใช้</td>
      </tr>
      <tr>
        <td><input name="p3" type="checkbox" id="p3" value="1" <?php if($arr_edit["p3"]=="1") echo " Checked "; ?>/>
สั่งยาที่ผู้ป่วยมีประวัติแพ้</td>
      </tr>
      <tr>
        <td><input name="p4" type="checkbox" id="p4" value="1" <?php if($arr_edit["p4"]=="1") echo " Checked "; ?>/>
สั่งยาที่เกิดปฏิกิริยาต่อกัน</td>
      </tr>
      <tr>
        <td><input name="p5" type="checkbox" id="p5" value="1" <?php if($arr_edit["p5"]=="1") echo " Checked "; ?>/>
สั่งยาในขนาดสูงเกินไป</td>
      </tr>
      <tr>
        <td><input name="p6" type="checkbox" id="p6" value="1"  <?php if($arr_edit["p6"]=="1") echo " Checked "; ?>/>
          สั่งยาในขนาดต่ำเกินไป</td>
      </tr>
      <tr>
        <td><input name="p7" type="checkbox" id="p7" value="1"  <?php if($arr_edit["p7"]=="1") echo " Checked "; ?>/> 
          อื่นๆ
</td>
      </tr>
      <tr>
        <td><input name="p_detail" type="text" class="font2" id="p_detail" value="<?=$arr_edit['p_detail'];?>"/></td>
      </tr>
    </table>
      </td>
    <td><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input name="p8" type="checkbox" id="p8" value="1" <?php if($arr_edit["p8"]=="1") echo " Checked "; ?>/>
          ไม่ระบุความแรง/วิธีใช้/จำนวน</td>
      </tr>
      <tr>
        <td><input name="p9" type="checkbox" id="checkbox9" value="1" <?php if($arr_edit["p9"]=="1") echo " Checked "; ?>/>
        ผิดชื่อยา/ชนิดยา</td>
      </tr>
      <tr>
        <td><input name="p10" type="checkbox" id="checkbox10" value="1" <?php if($arr_edit["p10"]=="1") echo " Checked "; ?>/>
          ผิดความแรง</td>
      </tr>
      <tr>
        <td><input name="p11" type="checkbox" id="checkbox11" value="1" <?php if($arr_edit["p11"]=="1") echo " Checked "; ?>/>
          ผิดรูปแบบยา</td>
      </tr>
      <tr>
        <td><input name="p12" type="checkbox" id="checkbox12" value="1" <?php if($arr_edit["p12"]=="1") echo " Checked "; ?>/>
          ผิดวิธีใช้</td>
      </tr>
      <tr>
        <td><input name="p13" type="checkbox" id="checkbox13" value="1" <?php if($arr_edit["p13"]=="1") echo " Checked "; ?>/>
          ผิดปริมาณ/จำนวนยา</td>
      </tr>
      <tr>
        <td><input name="p14" type="checkbox" id="checkbox14" value="1" <?php if($arr_edit["p14"]=="1") echo " Checked "; ?>/>
        สั่งยาซ้ำซ้อน</td>
      </tr>
      <tr>
        <td><input name="p15" type="checkbox" id="checkbox29" value="1" <?php if($arr_edit["p15"]=="1") echo " Checked "; ?>/> 
          สั่งจ่ายยาไม่ตรงกับผู้ป่วย
</td>
      </tr>
    </table></td>
    <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input name="d1" type="checkbox" id="checkbox15" value="1" <?php if($arr_edit["d1"]=="1") echo " Checked "; ?>/>
          จ่ายยาไม่ตรงกับผู้ป่วย </td>
      </tr>
      <tr>
        <td><input name="d2" type="checkbox" id="checkbox16" value="1" <?php if($arr_edit["d2"]=="1") echo " Checked "; ?>/>
        จ่ายยาผิดชนิด/ชื่อยา</td>
      </tr>
      <tr>
        <td><input name="d3" type="checkbox" id="checkbox17" value="1" <?php if($arr_edit["d3"]=="1") echo " Checked "; ?>/>
          ผิดขนาด</td>
      </tr>
      <tr>
        <td><input name="d4" type="checkbox" id="checkbox18" value="1" <?php if($arr_edit["d4"]=="1") echo " Checked "; ?>/>
          ผิดความแรง</td>
      </tr>
      <tr>
        <td><input name="d5" type="checkbox" id="checkbox19" value="1" <?php if($arr_edit["d5"]=="1") echo " Checked "; ?>/>
          ผิดจำนวน/ปริมาณ</td>
      </tr>
      <tr>
        <td><input name="d6" type="checkbox" id="checkbox20" value="1" <?php if($arr_edit["d6"]=="1") echo " Checked "; ?>/>
          ผิดรูปแบบ</td>
      </tr>
    </table></td>
    <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input name="d7" type="checkbox" id="checkbox22" value="1" <?php if($arr_edit["d7"]=="1") echo " Checked "; ?>/>
          จ่ายยาหมดอายุ/เสื่อมสภาพโดยสภาพเก็บไม่เหมาะสม</td>
      </tr>
      <tr>
        <td><input name="d8" type="checkbox" id="checkbox23" value="1" <?php if($arr_edit["d8"]=="1") echo " Checked "; ?>/>
          ยาขาด Stock ไม่สามารถจัดยาได้ตามใบสั่งขณะนั้น</td>
      </tr>
      <tr>
        <td><input name="d9" type="checkbox" id="checkbox28" value="1" <?php if($arr_edit["d9"]=="1") echo " Checked "; ?>/>
          อื่นๆ </td>
      </tr>
      <tr>
        <td><input name="d_detail" type="text" class="font2" id="d_detail"  value="<?=$arr_edit['d_detail']?>"/></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="center">การคัดลอกคำสั่ง (Transcribing error)</td>
    <td colspan="2" align="center">การบริหารยา (Administration error)</td>
    </tr>
  <tr>
    <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input name="t1" type="checkbox" id="checkbox21" value="1" <?php if($arr_edit["t1"]=="1") echo " Checked "; ?>/>
          ผิดชื่อยา/ชนิดยา</td>
      </tr>
      <tr>
        <td><input name="t2" type="checkbox" id="checkbox24" value="1" <?php if($arr_edit["t2"]=="1") echo " Checked "; ?>/>
        ผิดความแรง</td>
      </tr>
      <tr>
        <td><input name="t3" type="checkbox" id="checkbox25" value="1" <?php if($arr_edit["t3"]=="1") echo " Checked "; ?>/>
          ผิดรูปแบบยา</td>
      </tr>
      <tr>
        <td><input name="t4" type="checkbox" id="checkbox26" value="1" <?php if($arr_edit["t4"]=="1") echo " Checked "; ?>/>
          ผิดวิธีใช้</td>
      </tr>
      <tr>
        <td><input name="t5" type="checkbox" id="checkbox27" value="1" <?php if($arr_edit["t5"]=="1") echo " Checked "; ?>/>
          ผิดปริมาณ/จำนวนยาซ้ำซ้อน</td>
      </tr>
    </table></td>
    <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input name="t6" type="checkbox" id="checkbox32" value="1" <?php if($arr_edit["t6"]=="1") echo " Checked "; ?>/>
          ยาไม่ตรงกับชื่อผู้ใช้</td>
      </tr>
      <tr>
        <td><input name="t7" type="checkbox" id="checkbox33" value="1" <?php if($arr_edit["t7"]=="1") echo " Checked "; ?>/>
          ยาที่แพทย์ไม่ได้สั่ง</td>
      </tr>
      <tr>
        <td><input name="t8" type="checkbox" id="checkbox34" value="1" <?php if($arr_edit["t8"]=="1") echo " Checked "; ?>/>
          อื่นๆ</td>
      </tr>
      <tr>
        <td><input name="t_detail" type="text" class="font2" id="t_detail"  value="<?=$arr_edit['t_detail'];?>"/></td>
      </tr>
    </table></td>
    <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input name="a1" type="checkbox" id="checkbox39" value="1" <?php if($arr_edit["a1"]=="1") echo " Checked "; ?>/>
          ไม่จ่ายยาในเวลาที่กำหนด/ลืมให้ยา</td>
      </tr>
      <tr>
        <td><input name="a2" type="checkbox" id="checkbox40" value="1" <?php if($arr_edit["a2"]=="1") echo " Checked "; ?>/>
          ผิดขนาด/ความแรง</td>
      </tr>
      <tr>
        <td><input name="a3" type="checkbox" id="checkbox41" value="1" <?php if($arr_edit["a3"]=="1") echo " Checked "; ?>/>
          ผิดชื่อยา/ชนิดยา</td>
      </tr>
      <tr>
        <td><p>
          <input name="a4" type="checkbox" id="checkbox42" value="1" <?php if($arr_edit["a4"]=="1") echo " Checked "; ?>/>
          ผิดอัตราการให้ยา/สารละลาย</p></td>
      </tr>
      <tr>
        <td><input name="a5" type="checkbox" id="checkbox43" value="1" <?php if($arr_edit["a5"]=="1") echo " Checked "; ?>/>
          ผิดตำแหน่ง/วิถีทาง/รูปแบบ</td>
      </tr>
      <tr>
        <td><input name="a6" type="checkbox" id="checkbox44" value="1" <?php if($arr_edit["a6"]=="1") echo " Checked "; ?>/>
          ผิดคน</td>
      </tr>
      <tr>
        <td><input name="a7" type="checkbox" id="checkbox45" value="1" <?php if($arr_edit["a7"]=="1") echo " Checked "; ?>/>
          อื่นๆ </td>
      </tr>
      <tr>
        <td><input name="a_detail" type="text" class="font2" id="textfield4"  value="<?=$arr_edit['a_detail'];?>"/></td>
      </tr>
    </table></td>
    <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input name="a8" type="checkbox" id="checkbox46" value="1" <?php if($arr_edit["a8"]=="1") echo " Checked "; ?>/>
          ให้ยาไม่ครบรายการ(ขาด/เกิน)</td>
      </tr>
      <tr>
        <td><input name="a9" type="checkbox" id="checkbox47" value="1" <?php if($arr_edit["a9"]=="1") echo " Checked "; ?>/>
          ให้ยามากกว่า/น้อยกว่าจำนวนครั้งที่สั่ง</td>
      </tr>
      <tr>
        <td><input name="a10" type="checkbox" id="checkbox48" value="1" <?php if($arr_edit["a10"]=="1") echo " Checked "; ?>/>
          เตรียม/ผสมยาผิด</td>
      </tr>
      <tr>
        <td><p>
          <input name="a11" type="checkbox" id="checkbox49" value="1" <?php if($arr_edit["a11"]=="1") echo " Checked "; ?>/>
          เก็บรักษายาผิด(ยาค้าง stock/<br />
          เก็บยาอันตรายในรถฉุกเฉิน <br />
          เก็บยาไม่เหมาะสม เช่นนอกตู้เย็น ไม่ป้องกันแสง)</p></td>
      </tr>
      <tr>
        <td><input name="a12" type="checkbox" id="checkbox50" value="1" <?php if($arr_edit["a12"]=="1") echo " Checked "; ?>/>
          ให้ยาหมดอายุ/เสื่อมสภาพ</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="4" align="center" valign="top">Compliance Error (การใช้ยาของผู้ป่วย)</td>
    </tr>
  <tr>
    <td colspan="4" valign="top"><input name="c1" type="checkbox" id="c1" value="1" <?php if($arr_edit["c1"]=="1") echo " Checked "; ?>/>
      ผู้ป่วยไม่ได้รับประทานยาตามแพทย์สั่ง
      <input name="c2" type="checkbox" id="checkbox31" value="1" <?php if($arr_edit["c2"]=="1") echo " Checked "; ?>/>
      อื่นๆ 
      <input name="c_detail" type="text" class="font2" id="c_detail"  value="<?=$arr_edit['c_detail'];?>"/></td>
    </tr>
</table>
<br />
<table border="0" align="center" cellpadding="0" cellspacing="0" class="font2">
  <tr>
    <td colspan="3"><u>ระดับความรุนแรง</u></td>
    </tr>
  <tr>
    <td width="27"><input type="radio" name="level_vio" id="radio" value="A" <?php if($arr_edit["level_vio"]=="A") echo " Checked "; ?>/></td>
    <td width="17">A</td>
    <td width="718">เหตุการณ์ซึ่งมีโอกาสที่จะก่อให้เกิดความคลาดเคลื่อน</td>
  </tr>
  <tr>
    <td><input type="radio" name="level_vio" id="radio2" value="B"  <?php if($arr_edit["level_vio"]=="B") echo " Checked "; ?>/></td>
    <td>B</td>
    <td>เกิดความคลาดเคลื่อนขึ้นแต่ไม่ถึงผู้ป่วย</td>
  </tr>
  <tr>
    <td><input type="radio" name="level_vio" id="radio3" value="C"  <?php if($arr_edit["level_vio"]=="C") echo " Checked "; ?>/></td>
    <td>C</td>
    <td>เกิดความคลาดเคลื่อนกับผู้ป่วย แต่ไม่ทำให้ผู้ป่วยได้รับอันตราย</td>
  </tr>
  <tr>
    <td><input type="radio" name="level_vio" id="radio4" value="D" <?php if($arr_edit["level_vio"]=="D") echo " Checked "; ?>/></td>
    <td>D</td>
    <td>เกิดความคลาดเคลื่อนกับผู้ป่ว ต้องการเฝ้าระวังเพื่อให้มั่นใจว่าไม่เกิดอันตรายแก่ผู้ป่วยและหรือต้องมีบำบัดรักษา</td>
  </tr>
  <tr>
    <td><input type="radio" name="level_vio" id="radio5" value="E" <?php if($arr_edit["level_vio"]=="E") echo " Checked "; ?>/></td>
    <td>E</td>
    <td>เกิดความคลาดเคลื่อนกับผู้ป่วย ส่งผลให้เกิดอันตรายชั่วคราว และต้องมีการบำบัดรักษา</td>
  </tr>
  <tr>
    <td><input type="radio" name="level_vio" id="radio6" value="F" <?php if($arr_edit["level_vio"]=="F") echo " Checked "; ?>/></td>
    <td>F</td>
    <td>เกิดความคลาดเคลื่อนกับผู้ป่วย ส่งผลให้เกิดอันตรายชั่วคราว และต้องนอนในโรงพยาบาลหรืออยู่โรงพยาบาลนานขึ้น</td>
  </tr>
  <tr>
    <td><input type="radio" name="level_vio" id="radio7" value="G" <?php if($arr_edit["level_vio"]=="G") echo " Checked "; ?>/></td>
    <td>G</td>
    <td>เกิดความคลาดเคลื่อนกับผู้ป่วย ส่งผลให้เกิดอันตรายถาวรแก่ผู้ป่วย</td>
  </tr>
  <tr>
    <td><input type="radio" name="level_vio" id="radio8" value="H" <?php if($arr_edit["level_vio"]=="H") echo " Checked "; ?>/></td>
    <td>H</td>
    <td>เกิดความคลาดเคลื่อนกับผู้ป่วย ส่งผลทำให้ต้องทำการช่วยชีวิต</td>
  </tr>
  <tr>
    <td><input type="radio" name="level_vio" id="radio9" value="I" <?php if($arr_edit["level_vio"]=="I") echo " Checked "; ?>/></td>
    <td>I</td>
    <td>เกิดความคลาดเคลื่อนกับผู้ป่วย ซึ่งอาจจะเป็นสาเหตุของการเสียชีวิต</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="3">รายละเอียดอื่นๆ ของเหตุการณ์ </td>
  </tr>
  <tr>
    <td colspan="3"><textarea name="action_detail" cols="100" rows="10" class="font2" id="action_detail"><?=$arr_edit['action_detail'];?></textarea></td>
  </tr>
  <tr>
    <td colspan="3" align="center">
    <hr />
    <input type="hidden" name="row_id" id="row_id" value="<?=$arr_edit['row_id'];?>" />
    <input type="submit" name="submit" id="submit" value="บันทึกข้อมูล" class="font1"/></td>
  </tr>
</table>

</td>
</tr>

</table>

</form>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>