<?php
session_start();
$date_now = date("Y-m-d");
include("../connect.php");

function calcage($birth){

	$today=getdate();   
	$nY=$today['year']; 
	$nM=$today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

return $pAge;
}

$thaidate = (date("Y")+543).date("-m-d");

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>ทะเบียนผู้ป่วย HIV</title>
<style>
	.font_title{
		font-family:"TH SarabunPSK"; 
		font-size:25px;
		}
	.tb_font{
	font-family:"TH SarabunPSK";
	font-size:24px;
	color: #09F;
}
	.tb_font_1{
		font-family:"TH SarabunPSK"; 
		font-size:24px; 
	 color:#FFFFFF;
		 font-weight:bold;
		
		 }
	.tb_col{
		font-family:"TH SarabunPSK"; 
		font-size:24px;
		 background-color:#9FFF9F;
		 }
.tb_font_2 {
	font-family: "TH SarabunPSK";
	color: #B00000;
	font-size: 22px;
	font-weight: bold;
}
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
	color: red;
}
.forntsarabun1 {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
</style>
</head>

<body>

<div class="font_title" align="left">ลงทะเบียนผู้ป่วย HIV สิทธิประกันสังคม <a href ="../../nindex.htm"  class="forntsarabun1"><----- ไปหน้าแรกสุด</a> || <a href="hiv_index.php?do=add" class="forntsarabun1">&lt;-----เมนู</a></div>

<form action="" method="post">
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" >
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0">
	<TR>
		<TD align="center" bgcolor="#FFFF66" class="tb_font_2">กรอกหมายเลข HN</TD>
	</TR>
	<TR>
		<TD class="tb_font"><input name="p_hn" type="text" class="forntsarabun1"  value="<?php echo $_POST["p_hn"];?>"/>&nbsp;<input name="Submit" type="submit" class="forntsarabun" value="ตกลง" /></TD>
	</TR>
	<TR>
		<TD></TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
</form>


<?php 
$hn=trim($_POST["p_hn"]);
if(!empty($_POST["p_hn"]) != ""){
	
	  $sqlhiv="select * from opcard where hn='$hn' ";
	  $queryhiv=mysql_query($sqlhiv);
	  $row=mysql_num_rows($queryhiv);
	  
	  if(!$row){
		  
		  print "<br> <font class='forntsarabun1'>ไม่พบ  HN  <b>$hn</b>  ในระบบทะเบียน </font>";
		  
	  }else{
	
	
//ค้นหา hn จาก opday ****************************************************************************************
	$sql = "Select *, concat(yot,' ',name,' ',surname) as ptname,concat(address,' ',tambol,' ',ampur,' ',changwat)as address From opcard where  hn = '".$_POST["p_hn"]."' limit 0,1";
	//echo $sql;
	$result = mysql_query($sql) or die("".mysql_error()." -->");
	/*if(mysql_num_rows($result) <= 0){
		echo "<CENTER>ผู้ป่วยยังไม่ได้ทำการลงทะเบียน</CENTER>";
		exit();
	}*/
	$arr_view = mysql_fetch_assoc($result);

//ค้นหาวันเกิดจาก opcard ****************************************************************************************
	
	$arr_view["age"] = calcage($arr_view["dbirth"]);


////////////////////////////////////////

	$datenow=date("Y-m-d");


	  /*$sqlvp="select max(vp_id)as vp_id from hiv_vp ";
	  $queryvp=mysql_query($sqlvp);
	  $arrvo=mysql_fetch_array($queryvp);
	  $vp=$arrvp['vp_id']+1;
	  $vp_no=$vp;*/
	  
	 
?>
<script language=Javascript>
function fncSubmit()
{
	var fn = document.F1;
	
	if(fn.vp_no.value=="")
	{
		alert('กรุณาระบุ HIV NUMBER ');
		fn.vp_no.focus();
		return false;
	}
	fn.submit();
}

function chkSubmit()
	{
		 if(isNaN(document.F1.vp_no.value))
		 {
			alert('กรุณาใส่เป็นตัวเลขครับ');
			return false;
		 }
	}
	
	</script>
<!-- ข้อมูลเบื้องต้นของผู้ป่วย -->
<FORM METHOD="post" ACTION="hiv_vp_form.php?do=save" name="F1" onsubmit="return fncSubmit();"/>

<input name="age" type="hidden" id="age"  value="<?php echo $arr_view["age"];?>" />
<input name="hn" type="hidden" id="hn"  value="<?php echo $arr_view["hn"];?>" />
<br />
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" >
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0">
	<TR>
		<TD align="left" bgcolor="#FFFF66" class="tb_font_2">ข้อมูลผู้ป่วย</span></TD>
	</TR>
	<TR>
		<TD>
	<table border="0">
		<tr>
		  <td align="right" class="tb_font_2">วันที่ลงทะเบียน</td>
		  <td><span class="data_show">
		    <input name="thaidate" type="text" class="forntsarabun1" id="thaidate"  value="<?=date("Y-m-d");?>"/>
		  </span></td>
		  <td colspan="2" class="tb_font_2">// รูปแบบ ปี ค.ศ.-เดือน-วัน</td>
		  </tr>
		<tr>
		  <td align="right" class="tb_font_2">HIV number :</td>
		  <td><span class="data_show">
		    <input name="vp_no" type="text" class="forntsarabun1" id="vp_no" onkeyup='return chkSubmit();'/>
		  </span></td>
		  <td align="right"><span class="tb_font_2">HN :</span></td>
		  <td align="left" class="forntsarabun1"><?php echo $arr_view["hn"];?>
		    <input name="hn" type="hidden" id="hn" value="<?php echo $arr_view["hn"];?>"/></td>
		  </tr>
		<tr>
		  <td  align="right"><span class="tb_font_2">ชื่อ-สกุล : </span></td>
		  <td class="forntsarabun1"><?php echo $arr_view["ptname"];?><input name="ptname" type="hidden" id="ptname" value="<?php echo $arr_view["ptname"];?>"/></td>
		  <td  align="right" class="tb_font_2">อายุ :</td>
		  <td align="left" class="forntsarabun1"><?php echo $arr_view["age"];?><input name="dbirth" type="hidden" id="dbirth" value="<?php echo $arr_view["dbirth"];?>"/> </td>
		  </tr>
		<tr>
		  <td  align="right" class="tb_font_2">ที่อยู่</td>
		  <td colspan="3" class="forntsarabun1"><label for="phar"></label>
		    <textarea name="address" cols="45" rows="2" class="forntsarabun1" id="address"><?php echo $arr_view["address"];?></textarea></td>
		  </tr>
		<tr>
		  <td align="right" class="tb_font_2">แพทย์ :</td>
		  <td><select name="doctor" id="doctor" class="forntsarabun1">
		    <?php 
		echo "<option value='' >-- กรุณาเลือกแพทย์ --</option>";
		//echo "<option value='ห้องตรวจโรคทั่วไป' >ห้องตรวจโรคทั่วไป</option>";
		$sql = "Select name From doctor where status = 'y' ";
		$result = mysql_query($sql);
		while($dbarr2= mysql_fetch_array($result)){
			
			$sub1=substr($arr_dxofyear['doctor'],0,5);
			$sub2=substr($dbarr2['name'],0,5);
			
		
			if($dbarr2['name']==$arr_dxofyear['doctor']){
			
			echo "<option value='".$dbarr2['name']."'  selected>".$dbarr2['name']."</option>";	
			}else{
			echo "<option value='".$dbarr2['name']."' >".$dbarr2['name']."</option>";
			}
		}
		?>
		    </select> </td>
		  <td align="right" class="tb_font_2">สิทธิ :</td>
		  <td align="left" class="forntsarabun1"><?php echo $arr_view["ptright"];?><input name="ptright" type="hidden" id="ptright" value="<?php echo $arr_view["ptright"];?>"/> </td>
		  </tr>
		<tr>
		  <td align="right" class="tb_font_2">เริ่มยา ARV(วัน เดือน ปี)</td>
		  <td><label for="arv_date"></label>
		    <input name="arv_date" type="text" class="forntsarabun1" id="arv_date"></td>
		  <td align="right" class="tb_font_2">&nbsp;</td>
		  <td align="left" class="forntsarabun1">&nbsp;</td>
		  </tr>
		<tr>
		  <td colspan="2" class="tb_font_2">โรคติดเชื้อฉวยโอกาส/อาการของ/HIV ก่อนเริ่ม ARV</td>
		  <td colspan="2" class="tb_font_2"><input name="symp_hiv" type="text" class="forntsarabun1" id="symp_hiv"></td>
		  </tr>
		<tr>
		  <td align="right" class="tb_font_2">CD4 ก่อนเริ่ม ARV</td>
		  <td><span class="tb_font_2">
		    <input name="cd4_start" type="text" class="forntsarabun1" id="cd4_start">
		  </span></td>
		  <td align="right" class="tb_font_2">ว/ด/ป ที่บันทึก</td>
		  <td align="left" class="forntsarabun1"><span class="tb_font_2">
		    <input name="cd4_regis" type="text" class="forntsarabun1" id="cd4_regis">
		  </span></td>
		  </tr>
	</table>
	<hr />
     <table border="0" cellspacing="2" cellpadding="2">
  <tr class="tb_font_2">
    <td width="120" bgcolor="#FFFF33">พ.ศ. <?=date("Y")+543;?></td>
    <td width="45" align="center" bgcolor="#FFFF33">ม.ค.</td>
    <td width="45" align="center" bgcolor="#FFFF33">ก.พ.</td>
    <td width="45" align="center" bgcolor="#FFFF33">มี.ค.</td>
    <td width="45" align="center" bgcolor="#FFFF33">เม.ย.</td>
    <td width="45" align="center" bgcolor="#FFFF33">พ.ค.</td>
    <td width="45" align="center" bgcolor="#FFFF33">มิ.ย.</td>
    <td width="45" align="center" bgcolor="#FFFF33">ก.ค.</td>
    <td width="45" align="center" bgcolor="#FFFF33">ส.ค.</td>
    <td width="45" align="center" bgcolor="#FFFF66">ก.ย.</td>
    <td width="45" align="center" bgcolor="#FFFF33">ต.ค.</td>
    <td width="45" align="center" bgcolor="#FFFF33">พ.ย.</td>
    <td width="37" align="center" bgcolor="#FFFF33">ธ.ค.</td>
  </tr>
  <tr>
    <td class="tb_font_2">CD4</td>
    <?
//   $year=date("Y");
	$sql = "CREATE TEMPORARY TABLE lab01 SELECT  result,unit,orderdate,labcode,labname  FROM  resultdetail AS a, resulthead AS b WHERE  a.autonumber = b.autonumber AND b.hn='".$arr_view['hn']."'";
	$result = mysql_query($sql) or die (mysql_error());
	
	//echo $sql;
	
	$listlab1 = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		
		$laball="Select result,unit,orderdate from lab01  WHERE labname='CD4'  and orderdate like '".(date("Y"))."-".$m."%' Order by orderdate desc";
	  $result_laball=mysql_query($laball);
	  $arr1 = mysql_fetch_array($result_laball);
		array_push($listlab1,$arr1[0]);
	}
	
	
	// ALT
	
		$listlab4 = array();
		for($n=1;$n<=12;$n++){
		if($n<10){
		$m = "0".$n;
		}
		else $m = $n;
		$laball4="Select result,unit,orderdate from  lab01   WHERE  labcode like 'ALT%'  and orderdate like '".(date("Y"))."-".$m."%'";
	  $result_laball4=mysql_query($laball4);
	  $arr4 = mysql_fetch_array($result_laball4);
		array_push($listlab4,$arr4[0]);
		
	}
	
	//Creatinine
	
	$listlab5 = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		
		$laball5="Select result,unit,orderdate from lab01  WHERE labcode like '%CREA%'  and orderdate like '".(date("Y"))."-".$m."-%' Order by orderdate desc";
	  $result_laball5=mysql_query($laball5);
	  $arr5 = mysql_fetch_array($result_laball5);
		array_push($listlab5,$arr5[0]);

	}
	
	
		// lipid profile  1.chol 2.tg 3. hdl 4. ldl
	
	$listlab61 = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		
		$laball61="Select result,unit,orderdate from lab01  WHERE labcode like '%chol%'  and orderdate like '".(date("Y"))."-".$m."-%' Order by orderdate desc";
	  $result_laball61=mysql_query($laball61);
	  $arr61 = mysql_fetch_array($result_laball61);
		array_push($listlab61,$arr61[0]);

	}
	
	$listlab62 = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		
		$laball62="Select result,unit,orderdate from lab01  WHERE labcode like '%TRIG%'  and orderdate like '".(date("Y"))."-".$m."-%' Order by orderdate desc";
	  $result_laball62=mysql_query($laball62);
	  $arr62= mysql_fetch_array($result_laball62);
		array_push($listlab62,$arr62[0]);

	}
	
	$listlab63 = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		
		$laball63="Select result,unit,orderdate from lab01  WHERE labcode like '%HDL%'  and orderdate like '".(date("Y"))."-".$m."-%' Order by orderdate desc";
	  $result_laball63=mysql_query($laball63);
	  $arr63= mysql_fetch_array($result_laball63);
		array_push($listlab63,$arr63[0]);

	}
	
		$listlab64 = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		
		$laball64="Select result,unit,orderdate from lab01  WHERE labcode like '%10001%'  and orderdate like '".(date("Y"))."-".$m."-%' Order by orderdate desc";
	  $result_laball64=mysql_query($laball64);
	  $arr64= mysql_fetch_array($result_laball64);
		array_push($listlab64,$arr64[0]);

	}
	//
	
	// U/A
	
	//
	
	//CXR
	
	$listlab1 = array();
	for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		
		$laball="Select result,unit,orderdate from lab01  WHERE labcode like '%CD4%'  and orderdate like '".(date("Y"))."-".$m."-%' Order by orderdate desc";
	  $result_laball=mysql_query($laball);
	  $arr = mysql_fetch_array($result_laball);
		array_push($listlab1,$arr['result']);
		array_push($listlab1,$arr['result']);

	}
	
	//pap smear
	
	//
	?>
    <td>
      <input name="l11" type="text" class="forntsarabun1" id="l11" size="5" value="<?=$listlab1[0];?>">
    </td>
    <td><span class="forntsarabun1">
      <input name="l12" type="text" class="forntsarabun1" id="l12" size="5" value="<?=$listlab1[1];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l13" type="text" class="forntsarabun1" id="l13" size="5" value="<?=$listlab1[2];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l14" type="text" class="forntsarabun1" id="l14" size="5" value="<?=$listlab1[3];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l15" type="text" class="forntsarabun1" id="l15" size="5" value="<?=$listlab1[4];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l16" type="text" class="forntsarabun1" id="l16" size="5" value="<?=$listlab1[5];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l17" type="text" class="forntsarabun1" id="l17" size="5" value="<?=$listlab1[6];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l18" type="text" class="forntsarabun1" id="l18" size="5" value="<?=$listlab1[7];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l19" type="text" class="forntsarabun1" id="l19" size="5" value="<?=$listlab1[8];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l110" type="text" class="forntsarabun1" id="l110" size="5" value="<?=$listlab1[9];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l111" type="text" class="forntsarabun1" id="l111" size="5" value="<?=$listlab1[10];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l112" type="text" class="forntsarabun1" id="l112" size="5" value="<?=$listlab1[11];?>">
    </span></td>
  </tr>
  <tr>
    <td class="tb_font_2">Plasma VL</td>
    <td><span class="forntsarabun1">
      <input name="l21" type="text" class="forntsarabun1" id="l21" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l22" type="text" class="forntsarabun1" id="l22" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l23" type="text" class="forntsarabun1" id="l23" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l24" type="text" class="forntsarabun1" id="l24" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l25" type="text" class="forntsarabun1" id="l25" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l26" type="text" class="forntsarabun1" id="l26" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l27" type="text" class="forntsarabun1" id="l27" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l28" type="text" class="forntsarabun1" id="l28" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l29" type="text" class="forntsarabun1" id="l29" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l210" type="text" class="forntsarabun1" id="l210" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l211" type="text" class="forntsarabun1" id="l211" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l212" type="text" class="forntsarabun1" id="l212" size="5">
    </span></td>
    </tr>
  <tr>
    <td class="tb_font_2">FBS</td>
    <td><span class="forntsarabun1">
      <input name="l31" type="text" class="forntsarabun1" id="l31" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l32" type="text" class="forntsarabun1" id="l32" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l33" type="text" class="forntsarabun1" id="l33" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l34" type="text" class="forntsarabun1" id="l34" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l35" type="text" class="forntsarabun1" id="l35" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l36" type="text" class="forntsarabun1" id="l36" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l37" type="text" class="forntsarabun1" id="l37" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l38" type="text" class="forntsarabun1" id="l38" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l39" type="text" class="forntsarabun1" id="l39" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l310" type="text" class="forntsarabun1" id="l310" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l311" type="text" class="forntsarabun1" id="l311" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l312" type="text" class="forntsarabun1" id="l312" size="5">
    </span></td>
    </tr>
  <tr>
    <td class="tb_font_2">ALT</td>
    <td><span class="forntsarabun1">
      <input name="l41" type="text" class="forntsarabun1" id="l41" size="5" value="<?=$listlab4[0];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l42" type="text" class="forntsarabun1" id="l42" size="5" value="<?=$listlab4[1];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l43" type="text" class="forntsarabun1" id="l43" size="5" value="<?=$listlab4[2];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l44" type="text" class="forntsarabun1" id="l44" size="5" value="<?=$listlab4[3];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l45" type="text" class="forntsarabun1" id="l45" size="5" value="<?=$listlab4[4];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l46" type="text" class="forntsarabun1" id="l46" size="5" value="<?=$listlab4[5];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l47" type="text" class="forntsarabun1" id="l47" size="5" value="<?=$listlab4[6];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l48" type="text" class="forntsarabun1" id="l48" size="5" value="<?=$listlab4[7];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l49" type="text" class="forntsarabun1" id="l49" size="5" value="<?=$listlab4[8];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l410" type="text" class="forntsarabun1" id="l410" size="5" value="<?=$listlab4[9];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l411" type="text" class="forntsarabun1" id="l411" size="5" value="<?=$listlab4[10];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l412" type="text" class="forntsarabun1" id="l412" size="5" value="<?=$listlab4[11];?>">
    </span></td>
    </tr>
  <tr>
    <td class="tb_font_2">Creatinine</td>
    <td><span class="forntsarabun1">
      <input name="l51" type="text" class="forntsarabun1" id="l51" size="5" value="<?=$listlab5[0];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l52" type="text" class="forntsarabun1" id="l52" size="5"  value="<?=$listlab5[1];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l53" type="text" class="forntsarabun1" id="l53" size="5" value="<?=$listlab5[2];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l54" type="text" class="forntsarabun1" id="l54" size="5" value="<?=$listlab5[3];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l55" type="text" class="forntsarabun1" id="l55" size="5" value="<?=$listlab5[4];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l56" type="text" class="forntsarabun1" id="l56" size="5" value="<?=$listlab5[5];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l57" type="text" class="forntsarabun1" id="l57" size="5" value="<?=$listlab5[6];?>" >
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l58" type="text" class="forntsarabun1" id="l58" size="5" value="<?=$listlab5[7];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l59" type="text" class="forntsarabun1" id="l59" size="5" value="<?=$listlab5[8];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l510" type="text" class="forntsarabun1" id="l510" size="5" value="<?=$listlab5[9];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l511" type="text" class="forntsarabun1" id="l511" size="5" value="<?=$listlab5[10];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l512" type="text" class="forntsarabun1" id="l512" size="5" value="<?=$listlab5[11];?>">
    </span></td>
    </tr>
  <tr>
    <td class="tb_font_2">Lipid profile 1.Chol</td>
    <td><span class="forntsarabun1">
      <input name="lChol1" type="text" class="forntsarabun1" id="lChol1" size="5" value="<?=$listlab61[0];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lChol2" type="text" class="forntsarabun1" id="lChol2" size="5" value="<?=$listlab61[1];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lChol3" type="text" class="forntsarabun1" id="lChol3" size="5" value="<?=$listlab61[2];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lChol4" type="text" class="forntsarabun1" id="lChol4" size="5" value="<?=$listlab61[3];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lChol5" type="text" class="forntsarabun1" id="lChol5" size="5" value="<?=$listlab61[4];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lChol6" type="text" class="forntsarabun1" id="lChol6" size="5" value="<?=$listlab61[5];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lChol7" type="text" class="forntsarabun1" id="lChol7" size="5" value="<?=$listlab61[6];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lChol8" type="text" class="forntsarabun1" id="lChol8" size="5" value="<?=$listlab61[7];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lChol9" type="text" class="forntsarabun1" id="lChol9" size="5" value="<?=$listlab61[8];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lChol10" type="text" class="forntsarabun1" id="lChol10" size="5" value="<?=$listlab61[9];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lChol11" type="text" class="forntsarabun1" id="lChol11" size="5" value="<?=$listlab61[10];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lChol12" type="text" class="forntsarabun1" id="lChol12" size="5" value="<?=$listlab61[11];?>">
    </span></td>
    </tr>
  <tr>
    <td align="right" class="tb_font_2">2. TG</td>
    <td><span class="forntsarabun1">
      <input name="ltg1" type="text" class="forntsarabun1" id="ltg1" size="5" value="<?=$listlab62[0];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="ltg2" type="text" class="forntsarabun1" id="ltg2" size="5" value="<?=$listlab62[1];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="ltg3" type="text" class="forntsarabun1" id="ltg3" size="5" value="<?=$listlab62[2];?>" >
    </span></td>
    <td><span class="forntsarabun1">
      <input name="ltg4" type="text" class="forntsarabun1" id="ltg4" size="5" value="<?=$listlab62[3];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="ltg5" type="text" class="forntsarabun1" id="ltg5" size="5" value="<?=$listlab62[4];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="ltg6" type="text" class="forntsarabun1" id="ltg6" size="5"  value="<?=$listlab62[5];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="ltg7" type="text" class="forntsarabun1" id="ltg7" size="5" value="<?=$listlab62[6];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="ltg8" type="text" class="forntsarabun1" id="ltg8" size="5" value="<?=$listlab62[7];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="ltg9" type="text" class="forntsarabun1" id="ltg9" size="5" value="<?=$listlab62[8];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="ltg10" type="text" class="forntsarabun1" id="ltg10" size="5" value="<?=$listlab62[9];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="ltg11" type="text" class="forntsarabun1" id="ltg11" size="5" value="<?=$listlab62[10];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="ltg12" type="text" class="forntsarabun1" id="ltg12" size="5" value="<?=$listlab62[11];?>">
    </span></td>
    </tr>
  <tr>
    <td align="right" class="tb_font_2">3. HDL</td>
    <td><span class="forntsarabun1">
      <input name="lhdl1" type="text" class="forntsarabun1" id="lhdl1" size="5" value="<?=$listlab63[0];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lhdl2" type="text" class="forntsarabun1" id="lhdl2" size="5" value="<?=$listlab63[1];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lhdl3" type="text" class="forntsarabun1" id="lhdl3" size="5" value="<?=$listlab63[2];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lhdl4" type="text" class="forntsarabun1" id="lhdl4" size="5" value="<?=$listlab63[3];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lhdl5" type="text" class="forntsarabun1" id="lhdl5" size="5" value="<?=$listlab63[4];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lhdl6" type="text" class="forntsarabun1" id="lhdl6" size="5" value="<?=$listlab63[5];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lhdl7" type="text" class="forntsarabun1" id="lhdl7" size="5" value="<?=$listlab63[6];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lhdl8" type="text" class="forntsarabun1" id="lhdl8" size="5" value="<?=$listlab63[7];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lhdl9" type="text" class="forntsarabun1" id="lhdl9" size="5" value="<?=$listlab63[8];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lhdl10" type="text" class="forntsarabun1" id="lhdl10" size="5" value="<?=$listlab63[9];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lhdl11" type="text" class="forntsarabun1" id="lhdl11" size="5" value="<?=$listlab63[10];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lhdl12" type="text" class="forntsarabun1" id="lhdl12" size="5" value="<?=$listlab63[11];?>">
    </span></td>
    </tr>
  <tr>
    <td align="right" class="tb_font_2">4. LDL</td>
    <td><span class="forntsarabun1">
      <input name="lldl1" type="text" class="forntsarabun1" id="lldl1" size="5"  value="<?=$listlab64[0];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lldl2" type="text" class="forntsarabun1" id="lldl2" size="5" value="<?=$listlab64[1];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lldl3" type="text" class="forntsarabun1" id="lldl3" size="5" value="<?=$listlab64[2];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lldl4" type="text" class="forntsarabun1" id="lldl4" size="5" value="<?=$listlab64[3];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lldl5" type="text" class="forntsarabun1" id="lldl5" size="5" value="<?=$listlab64[4];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lldl6" type="text" class="forntsarabun1" id="lldl6" size="5" value="<?=$listlab64[5];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lldl7" type="text" class="forntsarabun1" id="lldl7" size="5" value="<?=$listlab64[6];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lldl8" type="text" class="forntsarabun1" id="lldl8" size="5" value="<?=$listlab64[7];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lldl9" type="text" class="forntsarabun1" id="lldl9" size="5" value="<?=$listlab64[8];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lldl10" type="text" class="forntsarabun1" id="lldl10" size="5" value="<?=$listlab64[9];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lldl11" type="text" class="forntsarabun1" id="lldl11" size="5" value="<?=$listlab64[10];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lldl12" type="text" class="forntsarabun1" id="lldl12" size="5" value="<?=$listlab64[11];?>">
    </span></td>
    </tr>
  <tr>
    <td class="tb_font_2">U/A (ถ้าใช้ยา TDF)</td>
    <td><span class="forntsarabun1">
      <input name="l71" type="text" class="forntsarabun1" id="l71" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l72" type="text" class="forntsarabun1" id="l72" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l73" type="text" class="forntsarabun1" id="l73" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l74" type="text" class="forntsarabun1" id="l74" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l75" type="text" class="forntsarabun1" id="l75" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l76" type="text" class="forntsarabun1" id="l76" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l77" type="text" class="forntsarabun1" id="l77" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l78" type="text" class="forntsarabun1" id="l78" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l79" type="text" class="forntsarabun1" id="l79" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l710" type="text" class="forntsarabun1" id="l710" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l711" type="text" class="forntsarabun1" id="l711" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l712" type="text" class="forntsarabun1" id="l712" size="5">
    </span></td>
    </tr>
  <tr>
    <td class="tb_font_2">CXR</td>
    <td><span class="forntsarabun1">
      <input name="l81" type="text" class="forntsarabun1" id="l81" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l82" type="text" class="forntsarabun1" id="l82" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l83" type="text" class="forntsarabun1" id="l83" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l84" type="text" class="forntsarabun1" id="l84" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l85" type="text" class="forntsarabun1" id="l85" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l86" type="text" class="forntsarabun1" id="l86" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l87" type="text" class="forntsarabun1" id="l87" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l88" type="text" class="forntsarabun1" id="l88" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l89" type="text" class="forntsarabun1" id="l89" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l810" type="text" class="forntsarabun1" id="l810" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l811" type="text" class="forntsarabun1" id="l811" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l812" type="text" class="forntsarabun1" id="l812" size="5">
    </span></td>
    </tr>
  <tr>
    <td class="tb_font_2">Pap smear</td>
    <td><span class="forntsarabun1">
      <input name="l91" type="text" class="forntsarabun1" id="l91" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l92" type="text" class="forntsarabun1" id="l92" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l93" type="text" class="forntsarabun1" id="l93" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l94" type="text" class="forntsarabun1" id="l94" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l95" type="text" class="forntsarabun1" id="l95" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l96" type="text" class="forntsarabun1" id="l96" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l97" type="text" class="forntsarabun1" id="l97" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l98" type="text" class="forntsarabun1" id="l98" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l99" type="text" class="forntsarabun1" id="l99" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l910" type="text" class="forntsarabun1" id="l910" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l911" type="text" class="forntsarabun1" id="l911" size="5">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l912" type="text" class="forntsarabun1" id="l912" size="5">
    </span></td>
    </tr>
    </table>
    <hr>
    <table border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td valign="top" class="tb_font_2">สูตรยาที่ใช้</td>
    <td><textarea name="phar" id="phar" cols="45" rows="5"></textarea></td>
  </tr>
  <tr>
    <td valign="top" class="tb_font_2">ผลข้างเคียง</td>
    <td><textarea name="sideefect" id="sideefect" cols="45" rows="5"></textarea></td>
  </tr>
</table>

    </td>
    </tr>
	  </table>
	<p>
   
	<input name="submit" type="submit" class="forntsarabun" value="บันทึกข้อมูล"  />
	&nbsp;
   <!-- <input name="submit2" type="submit" class="forntsarabun1" value="ตกลง&amp;สติกเกอร์ OPD" />-->
    <input type="hidden" value="<?php echo $arr_dxofyear["row_id"];?>" name="row_id" />
    </p></TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
<BR>
&nbsp;
</FORM>

<?php
	}
 } //ปิด ค้นหา hn ใน opcard	
include("../unconnect.inc");
 ?>
 
<?



if($_REQUEST['do']=='save'){
 if($_POST['submit']=='บันทึกข้อมูล'){
	 
	
 include("../connect.inc");
 

 

$dateN=date("Y-m-d");

$select="select hn from hiv_vp Where hn ='".$_POST["hn"]."' ";
$q=mysql_query($select);
$rows=mysql_num_rows($q);

if($rows){
	
	print "hn ".$_POST["hn"]." มีข้อมูลแล้ว";
	print "<META HTTP-EQUIV='Refresh' CONTENT='2;URL=hiv_vp_form.php'>";
}
else
{
	 	 
$strSQL = "INSERT INTO  hiv_vp (vp_id,hn,ptname,address,age,ptright,doctor,arv_date,symp_hiv,cd4_start,  cd4_regis,phar,sideefect,date_regis) VALUES ('".$_POST['vp_no']."','".$_POST['hn']."','".$_POST['ptname']."','".$_POST['address']."','".$_POST['dbirth']."','".$_POST['ptright']."','".$_POST['doctor']."','".$_POST['arv_date']."','".$_POST['symp_hiv']."','".$_POST['cd4_start']."','".$_POST['cd4_regis']."','".$_POST['phar']."','".$_POST['sideefect']."','".$_POST['thaidate']."')";
$objQuery = mysql_query($strSQL);


if($objQuery)
{
	echo "<br><font class='forntsarabun1'>บันทึกข้อมูลเรียบร้อยแล้ว</font>";
 	


$max="select max(row_id)as maxid from hiv_vp";
$query = mysql_query($max);
$ref=mysql_fetch_array($query);


 ///1 CD4  //
 $sqladd1="INSERT INTO  `hiv_lab_vp` (`row_id`,`ref_id`,`labname`,`m1` ,`m2`,`m3`,`m4` ,`m5`,`m6`,`m7`,`m8`,  `m9`,`m10`,`m11`,`m12`,register_date) VALUES ('','".$ref['maxid']."','cd4','".$_POST['l11']."',  '".$_POST['l12']."',  '".$_POST['l13']."',  '".$_POST['l14']."',  '".$_POST['l15']."',  '".$_POST['l16']."',  '".$_POST['l17']."',  '".$_POST['l18']."',  '".$_POST['l19']."',  '".$_POST['l110']."',  '".$_POST['l111']."','".$_POST['l112']."','".$dateN."')";
 $objadd1 = mysql_query($sqladd1);
 
 // 2 plasma VL  //
 $sqladd2="INSERT INTO  `hiv_lab_vp` (`row_id`,`ref_id`,`labname`,`m1` ,`m2`,`m3`,`m4` ,`m5`,`m6`,`m7`,`m8`,  `m9`,`m10`,`m11`,`m12`,register_date) VALUES ('','".$ref['maxid']."','Plasma VL','".$_POST['l21']."',  '".$_POST['l22']."',  '".$_POST['l23']."',  '".$_POST['l24']."',  '".$_POST['l25']."',  '".$_POST['l26']."',  '".$_POST['l27']."',  '".$_POST['l28']."',  '".$_POST['l29']."',  '".$_POST['l210']."',  '".$_POST['l211']."','".$_POST['l212']."','".$dateN."')";
 $objadd2 = mysql_query($sqladd2);

// ///  3 FBS  //
 $sqladd3="INSERT INTO  `hiv_lab_vp` (`row_id`,`ref_id`,`labname`,`m1` ,`m2`,`m3`,`m4` ,`m5`,`m6`,`m7`,`m8`,  `m9`,`m10`,`m11`,`m12`,register_date) VALUES ('','".$ref['maxid']."','FBS','".$_POST['l31']."',  '".$_POST['l32']."',  '".$_POST['l33']."',  '".$_POST['l34']."',  '".$_POST['l35']."',  '".$_POST['l36']."',  '".$_POST['l37']."',  '".$_POST['l38']."',  '".$_POST['l39']."',  '".$_POST['l310']."', '".$_POST['l311']."','".$_POST['l312']."','".$dateN."')";
 $objadd3 = mysql_query($sqladd3);
 
 // /// 4 ALT  //
 $sqladd4="INSERT INTO  `hiv_lab_vp` (`row_id`,`ref_id`,`labname`,`m1` ,`m2`,`m3`,`m4` ,`m5`,`m6`,`m7`,`m8`,  `m9`,`m10`,`m11`,`m12`,register_date) VALUES ('','".$ref['maxid']."','ALT','".$_POST['l41']."',  '".$_POST['l42']."',  '".$_POST['l43']."',  '".$_POST['l44']."',  '".$_POST['l45']."',  '".$_POST['l46']."',  '".$_POST['l47']."',  '".$_POST['l48']."',  '".$_POST['l49']."',  '".$_POST['l410']."', '".$_POST['l411']."','".$_POST['l412']."','".$dateN."')";
 $objadd4 = mysql_query($sqladd4);
 
  //  5 Creatinine  //
 $sqladd5="INSERT INTO  `hiv_lab_vp` (`row_id`,`ref_id`,`labname`,`m1` ,`m2`,`m3`,`m4` ,`m5`,`m6`,`m7`,`m8`,  `m9`,`m10`,`m11`,`m12`,register_date) VALUES ('','".$ref['maxid']."','CREA','".$_POST['l51']."',  '".$_POST['l52']."',  '".$_POST['l53']."',  '".$_POST['l54']."',  '".$_POST['l55']."',  '".$_POST['l56']."',  '".$_POST['l57']."',  '".$_POST['l58']."',  '".$_POST['l59']."',  '".$_POST['l510']."', '".$_POST['l511']."','".$_POST['l512']."','".$dateN."')";
 $objadd5 = mysql_query($sqladd5);
 
 
//  6 lipid profile  //
 $sqladd61="INSERT INTO  `hiv_lab_vp` (`row_id`,`ref_id`,`labname`,`m1` ,`m2`,`m3`,`m4` ,`m5`,`m6`,`m7`,`m8`,  `m9`,`m10`,`m11`,`m12`,register_date) VALUES ('','".$ref['maxid']."','CHOL','".$_POST['lChol1']."',  '".$_POST['lChol2']."',  '".$_POST['lChol3']."',  '".$_POST['lChol4']."',  '".$_POST['lChol5']."',  '".$_POST['lChol6']."',  '".$_POST['lChol7']."',  '".$_POST['lChol8']."',  '".$_POST['lChol9']."',  '".$_POST['lChol10']."', '".$_POST['lChol11']."','".$_POST['lChol12']."','".$dateN."')";
 $objadd61 = mysql_query($sqladd61);
 
 $sqladd62="INSERT INTO  `hiv_lab_vp` (`row_id`,`ref_id`,`labname`,`m1` ,`m2`,`m3`,`m4` ,`m5`,`m6`,`m7`,`m8`,  `m9`,`m10`,`m11`,`m12`,register_date) VALUES ('','".$ref['maxid']."','TRIG','".$_POST['ltg1']."',  '".$_POST['ltg2']."',  '".$_POST['ltg3']."',  '".$_POST['ltg4']."',  '".$_POST['ltg5']."',  '".$_POST['ltg6']."',  '".$_POST['ltg7']."',  '".$_POST['ltg8']."',  '".$_POST['ltg9']."',  '".$_POST['ltg10']."', '".$_POST['ltg11']."','".$_POST['ltg12']."','".$dateN."')";
 $objadd62 = mysql_query($sqladd62); 

 $sqladd63="INSERT INTO  `hiv_lab_vp` (`row_id`,`ref_id`,`labname`,`m1` ,`m2`,`m3`,`m4` ,`m5`,`m6`,`m7`,`m8`,  `m9`,`m10`,`m11`,`m12`,register_date) VALUES ('','".$ref['maxid']."','HDL','".$_POST['lhdl1']."',  '".$_POST['lhdl2']."',  '".$_POST['lhdl3']."',  '".$_POST['lhdl4']."',  '".$_POST['lhdl5']."',  '".$_POST['lhdl6']."',  '".$_POST['lhdl7']."',  '".$_POST['lhdl8']."',  '".$_POST['lhdl9']."',  '".$_POST['lhdl10']."', '".$_POST['lhdl11']."','".$_POST['lhdl12']."','".$dateN."')";
 $objadd63 = mysql_query($sqladd63); 
 
$sqladd64="INSERT INTO  `hiv_lab_vp` (`row_id`,`ref_id`,`labname`,`m1` ,`m2`,`m3`,`m4` ,`m5`,`m6`,`m7`,`m8`,  `m9`,`m10`,`m11`,`m12`,register_date) VALUES ('','".$ref['maxid']."','LDL','".$_POST['lldl1']."',  '".$_POST['lldl2']."',  '".$_POST['lldl3']."',  '".$_POST['lldl4']."',  '".$_POST['lldl5']."',  '".$_POST['lldl6']."',  '".$_POST['lldl7']."',  '".$_POST['lldl8']."',  '".$_POST['lldl9']."',  '".$_POST['lldl10']."', '".$_POST['lldl11']."','".$_POST['lldl12']."','".$dateN."')";
 $objadd64 = mysql_query($sqladd64); 
 
 /// UA  
$sqladd7="INSERT INTO  `hiv_lab_vp` (`row_id`,`ref_id`,`labname`,`m1` ,`m2`,`m3`,`m4` ,`m5`,`m6`,`m7`,`m8`,  `m9`,`m10`,`m11`,`m12`,register_date) VALUES ('','".$ref['maxid']."','UA','".$_POST['l71']."',  '".$_POST['l72']."',  '".$_POST['l73']."',  '".$_POST['l74']."',  '".$_POST['l75']."',  '".$_POST['l76']."',  '".$_POST['l77']."',  '".$_POST['l78']."',  '".$_POST['l79']."',  '".$_POST['l710']."', '".$_POST['l711']."','".$_POST['l712']."','".$dateN."')";
 $objadd7 = mysql_query($sqladd7); 
 
 
 // CXR
 $sqladd8="INSERT INTO  `hiv_lab_vp` (`row_id`,`ref_id`,`labname`,`m1` ,`m2`,`m3`,`m4` ,`m5`,`m6`,`m7`,`m8`,  `m9`,`m10`,`m11`,`m12`,register_date) VALUES ('','".$ref['maxid']."','CXR','".$_POST['l81']."',  '".$_POST['l82']."',  '".$_POST['l83']."',  '".$_POST['l84']."',  '".$_POST['l85']."',  '".$_POST['l86']."',  '".$_POST['l87']."',  '".$_POST['l88']."',  '".$_POST['l89']."',  '".$_POST['l810']."', '".$_POST['l811']."','".$_POST['l812']."','".$dateN."')";
 $objadd8 = mysql_query($sqladd8); 
 
  // Pap smear
 $sqladd9="INSERT INTO  `hiv_lab_vp` (`row_id`,`ref_id`,`labname`,`m1` ,`m2`,`m3`,`m4` ,`m5`,`m6`,`m7`,`m8`,  `m9`,`m10`,`m11`,`m12`,register_date) VALUES ('','".$ref['maxid']."','Pap smear','".$_POST['l91']."',  '".$_POST['l92']."',  '".$_POST['l93']."',  '".$_POST['l94']."',  '".$_POST['l95']."',  '".$_POST['l96']."',  '".$_POST['l97']."',  '".$_POST['l98']."',  '".$_POST['l99']."',  '".$_POST['l910']."', '".$_POST['l911']."','".$_POST['l912']."','".$dateN."')";
 $objadd9 = mysql_query($sqladd9); 
 
print "<META HTTP-EQUIV='Refresh' CONTENT='2;URL=hiv_vp_form.php'>";
}
else
{
	echo "<br><font class='forntsarabun1'>ไม่สามารถบันทึกได้ [".$strSQL."]</font>";
	//print "<META HTTP-EQUIV='Refresh' CONTENT='2;URL=hiv_vp_form.php'>";
}

	 
include("../unconnect.inc");	 
}
 
}
}

 ?>
</body>


</html>
