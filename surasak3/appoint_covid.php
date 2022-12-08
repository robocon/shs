<?php 

session_start();

$month["01"] ="มกราคม";
$month["02"] ="กุมภาพันธ์";
$month["03"] ="มีนาคม";
$month["04"] ="เมษายน";
$month["05"] ="พฤษภาคม";
$month["06"] ="มิถุนายน";
$month["07"] ="กรกฎาคม";
$month["08"] ="สิงหาคม";
$month["09"] ="กันยายน";
$month["10"] ="ตุลาคม";
$month["11"] ="พฤศจิกายน";
$month["12"] ="ธันวาคม";
session_register("cHn");

if($_SESSION["sOfficer"] == ""){
	
	echo "<center><font color='#000000' >ขออภัยครับ การ Login ของท่านหมดอายุ </font><br />";
	echo "<a href=\"../sm3.php\" target=\"_top\">กลับหน้าแรก</a></center>";
exit();
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ออกใบนัด ATK สำหรับกลุ่มเสี่ยง</title>
<style type="text/css">

.data_show{ 
	font-family:"TH SarabunPSK"; 
	font-size:18px; 
	color:#000000;
	}

.data_drugreact{ 
	font-family:"TH SarabunPSK"; 
	font-size:18px; 
	color:#FF0000;
	
	}
.data_title{ 
	font-family:"TH SarabunPSK"; 
	font-size:22px; 
	color:#FFFFFF;
	font-weight:bold;
	background-color:#339999;
	}
.txtsarabun{ 
	font-family: "TH SarabunPSK";
	font-size:16px; 
	font-weight:bold;
	}	
.headsarabun{ 
	font-family: "TH SarabunPSK";
	font-size:22px; 
	}
	
body{ font-family:"TH SarabunPSK"; 
font-size:18px;
}

.style1 {
	font-size: 28px;
	font-weight: bold;
}
.buttonred {
  background-color: #f44336; /* red */
  font-family:"TH SarabunPSK"; 
  border: none;
  border-radius: 12px;
  color: white;
  padding: 12px 28px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 22px;
  font-weight:bold;
}

.button-green {
	background-color: #4CAF50;
	font-family:"TH SarabunPSK"; 
	font-size: 18px;
	
}

.txt{
	font-family: TH SarabunPSK;
	font-size: 20px;
}
</style>

   <SCRIPT LANGUAGE="JavaScript">
function checkList(){
	if(document.getElementById("goup").value=="0"){
		alert("กรุณาเลือกประเภท");
		document.getElementById("goup").focus()
		return false;
	}else if(document.getElementById("typeservice").value=="0"){
		alert("กรุณาเลือกประเภทผู้มารับบริการ");
		document.getElementById("typeservice").focus()
		return false;
/*	}else if(document.getElementById("typediag").value=="0"){
		alert("กรุณาเลือกประเภทการตรวจ");
		document.getElementById("typediag").focus()
		return false;	*/	
	}else{
		return true;
	}
}


function checkForm(){
	if(document.f1.hn.value == ""){
		alert('กรุณากรอก HN ด้วยครับ');
		return false;
	}else if(document.f1.type1.checked == false && document.f1.type2.checked == false){
		alert('กรุณาเลือกประเภทกลุ่มเสี่ยงครับ');
		return false;	
	}else{
		return true;
	}
}

</script>
	 
<link type="text/css" href="epoch_styles.css" rel="stylesheet" />
</head>
<?php
include("connect.inc");   
?>
<body >
<div style="margin-left: 50px; margin-right: 50px;">
<p class="txtsarabun"><strong style="font-size:36px;">โปรแกรมออกใบนัด ATK สำหรับกลุ่มเสี่ยง</strong></p>
<form id="f1" name="f1" method="post" action="" Onsubmit="return checkForm();">
<div><strong>ประเภทกลุ่มเสี่ยง :</strong>
<input type="radio" name="type" id="type1" value="HRC"><label for="type1">เสี่ยงสูง (HRC)</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="type" id="type2" value="LRC"><label for="type2">เสี่ยงต่ำ (LRC)</label>
<div><strong>วันที่สัมผัสผู้ป่วย :</strong> 
   <input name="date1" type="text" id="date1" size="1" value="<?=date("d");?>" class="txt">
    <strong>เดือน : </strong><select size="1" name="month1" class="txt">
    <option selected>-------เลือก-------</option>
    <option value="01" <? if(date("m")=="01"){ echo "selected";}?>>มกราคม</option>
    <option value="02" <? if(date("m")=="02"){ echo "selected";}?>>กุมภาพันธ์</option>
    <option value="03" <? if(date("m")=="03"){ echo "selected";}?>>มีนาคม</option>
    <option value="04" <? if(date("m")=="04"){ echo "selected";}?>>เมษายน</option>
    <option value="05" <? if(date("m")=="05"){ echo "selected";}?>>พฤษภาคม</option>
    <option value="06" <? if(date("m")=="06"){ echo "selected";}?>>มิถุนายน</option>
    <option value="07" <? if(date("m")=="07"){ echo "selected";}?>>กรกฎาคม</option>
    <option value="08" <? if(date("m")=="08"){ echo "selected";}?>>สิงหาคม</option>
    <option value="09" <? if(date("m")=="09"){ echo "selected";}?>>กันยายน</option>
    <option value="10" <? if(date("m")=="10"){ echo "selected";}?>>ตุลาคม</option>
    <option value="11" <? if(date("m")=="11"){ echo "selected";}?>>พฤศจิกายน</option>
    <option value="12" <? if(date("m")=="12"){ echo "selected";}?>>ธันวาคม</option>

  </select><strong> ปี : </strong>
  <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='year1'  class='txt'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>
</div>

<div>&nbsp;</div>
    <strong>กรอก HN :</strong> 
  <input name="hn" type="text" class="txtsarabun" id="hn" size="20" maxlength="20" autofocus />&nbsp;&nbsp;
  <input name="Submit" type="submit" class="txtsarabun" value="   ตกลง   " />
  <BR>
</form>
 <p><span class="tb_font">
  <input type="button" name="button" id="button" value="กลับหน้าหลัก" onclick="window.location='../nindex.htm' " class="txtsarabun" />
 </span>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="button" id="button" value="ออกใบนัด Day5" onclick="window.open('print_appointday5.php?hn=<?php echo $hn;?>&type=<?=$_POST["type"];?>&date1=<?=$_POST["date1"];?>&month1=<?=$_POST["month1"];?>&year1=<?=$_POST["year1"];?>')" class="txtsarabun" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="button" id="button" value="ออกใบนัด Day7" onclick="window.open('print_appointday7.php?hn=<?php echo $hn;?>&type=<?=$_POST["type"];?>&date1=<?=$_POST["date1"];?>&month1=<?=$_POST["month1"];?>&year1=<?=$_POST["year1"];?>')" class="txtsarabun" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="button" id="button" value="ออกใบนัด Day10" onclick="window.open('print_appointday10.php?hn=<?php echo $hn;?>&type=<?=$_POST["type"];?>&date1=<?=$_POST["date1"];?>&month1=<?=$_POST["month1"];?>&year1=<?=$_POST["year1"];?>')" class="txtsarabun" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="button" id="button" value="ตรวจสอบการนัด" onclick="window.open('appdaycheck.php?hn=<?php echo $hn;?>')" class="txtsarabun" />  <span style="color:red; margin-left: 10px;">!! ข้อควรระวัง ตรวจสอบข้อมูลให้ถูกต้องทุกครั้งก่อนกดออกใบนัด</span></p>
<hr>
<hr>

<?
if(!empty($_POST["hn"])){
	
	$hn=$_POST["hn"];
	
	$sql = "Select * From opcard where hn = '".$hn."' limit 1";
	$query=mysql_query($sql);
	$arr = mysql_fetch_assoc($query);	

	$ptname=$arr["yot"]." ".$arr["name"]."  ".$arr["surname"];
	$ptright=$arr["ptright"];
	
	if($_POST["type"]=="HRC"){
		$type="เสี่ยงสูง (HRC)";
	}else if($_POST["type"]=="LRC"){ 
		$type="เสี่ยงต่ำ (LRC)";
	}else{
		$type="";
	}
	
	$chkdate1=($_POST["date1"])."/".$_POST["month1"]."/".$_POST["year1"];
	
	$today=($_POST["year1"]-543)."-".$_POST["month1"]."-".$_POST["date1"];
	
		
		$strStartDate=$today;
		$strNewDate5 = date ("Y-m-d", strtotime("+5 day", strtotime($strStartDate)));
		$strNewDate7 = date ("Y-m-d", strtotime("+7 day", strtotime($strStartDate)));
		$strNewDate10 = date ("Y-m-d", strtotime("+10 day", strtotime($strStartDate)));

		$d1=substr($strNewDate5,8,2);
		$m1=substr($strNewDate5,5,2); 
		$y1=substr($strNewDate5,0,4)+543; 
		$strNewDate5="$d1/$m1/$y1";

		$d2=substr($strNewDate7,8,2);
		$m2=substr($strNewDate7,5,2); 
		$y2=substr($strNewDate7,0,4)+543; 
		$strNewDate7="$d2/$m2/$y2";	
		
		$d3=substr($strNewDate10,8,2);
		$m3=substr($strNewDate10,5,2); 
		$y3=substr($strNewDate10,0,4)+543; 
		$strNewDate10="$d3/$m3/$y3";			
	
		$time="08:00 น. - 10.00 น.";
?>
<strong>
<div>HN : <?=$hn;?></div>
<div>ชื่อ - นามสกุล :  <?=$ptname;?></div>
<div>สิทธิการรักษา :  <?=$ptright;?></div>
<div>ประเภทกลุ่มเสี่ยง :  <?=$type;?></div>
<div>วันที่สัมผัสผู้ป่วย :  <?=$chkdate1;?></div>
<div>วันที่นัด Day5 :  <?=$strNewDate5;?></div>
<div>วันที่นัด Day7 :  <?=$strNewDate7;?></div>
<div>วันที่นัด Day10 :  <?=$strNewDate10;?></div>
<div>เวลาที่นัด :  <?=$time;?></div>
</strong>
<?
}
?>
</div>
</body>

</html>