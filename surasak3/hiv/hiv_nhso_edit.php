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


<div class="font_title" align="left">แก้ไขข้อมูล ผู้ป่วย HIV สิทธิ สปสช. <a href ="../../nindex.htm"  class="forntsarabun1"><----- ไปหน้าแรกสุด</a> || <a href="hiv_index.php?do=edit" class="forntsarabun1">&lt;-----เมนู</a></div>

<form action="" method="post">
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" >
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0">
	<TR>
		<TD align="center" bgcolor="#0099FF" class="tb_font_2">กรอกหมายเลข HN</TD>
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
	
	  $sqlhiv="select * from hiv_nhso where hn='$hn' ";
	  $queryhiv=mysql_query($sqlhiv);
	  $row=mysql_num_rows($queryhiv);
	  
	  if(!$row){
		  
		  print "<br> <font class='forntsarabun1'>ไม่พบ  HN  <b>$hn</b>  ในทะเบียนผู้ป่วย HIV </font>";
		  print "<br> <font class='forntsarabun1'>ผู้ป่วยยังไม่ได้ลงทะเบียน ผู้ป่วย HIV</font>";
		  
	  }else{
	
	
//ค้นหา hn จาก hiv_nhso ****************************************************************************************
	$sql = "Select  * From hiv_nhso where  hn = '".$_POST["p_hn"]."' limit 0,1";
	$result = mysql_query($sql) or die("".mysql_error()." -->");
	//echo $sql;
	/*if(mysql_num_rows($result) <= 0){
		echo "<CENTER>ผู้ป่วยยังไม่ได้ทำการลงทะเบียน</CENTER>";
		exit();
	}*/
	$arr_view = mysql_fetch_array($result);

//ค้นหาวันเกิดจาก opcard ****************************************************************************************
	
	$arr_view["age"] = calcage($arr_view["age"]);


////////////////////////////////////////

	$datenow=date("Y-m-d");


	  /*$sqlnhso="select max(nhso_id )as nhso_id from hiv_nhso ";
	  $querynhso=mysql_query($sqlnhso);
	  $arrnhso=mysql_fetch_array($querynhso);
	  $nhso=$arrvo['nhso_id']+1;
	  $nhso_no=$vo;*/
	  
	 
?>

<!-- ข้อมูลเบื้องต้นของผู้ป่วย -->
<FORM METHOD="post" ACTION="hiv_nhso_edit.php?do=save" name="F1">

<input name="age" type="hidden" id="age"  value="<?php echo $arr_view["age"];?>" />
<input name="hn" type="hidden" id="hn"  value="<?php echo $arr_view["hn"];?>" />
<input name="row_id" type="hidden" id="row_id"  value="<?php echo $arr_view["row_id"];?>" />
<br />
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" >
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0">
	<TR>
		<TD align="left" bgcolor="#0099FF" class="tb_font_2">ข้อมูลผู้ป่วย</span></TD>
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
		    <input name="nhso_no" type="text" class="forntsarabun1" id="nhso_no"  value="<?=$arr_view['nhso_id'];?>" readonly="readonly"/>
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
			
			$sub1=substr($arr_view['doctor'],0,5);
			$sub2=substr($dbarr2['name'],0,5);
			
		
			if($dbarr2['name']==$arr_view['doctor']){	
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
		    <input name="arv_date" type="text" class="forntsarabun1" id="arv_date" value="<?php echo $arr_view["arv_date"];?>"></td>
		  <td align="right" class="tb_font_2">&nbsp;</td>
		  <td align="left" class="forntsarabun1">&nbsp;</td>
		  </tr>
		<tr>
		  <td colspan="2" class="tb_font_2">โรคติดเชื้อฉวยโอกาส/อาการของ/HIV ก่อนเริ่ม ARV</td>
		  <td colspan="2" class="tb_font_2"><input name="symp_hiv" type="text" class="forntsarabun1" id="symp_hiv" value="<?php echo $arr_view["symp_hiv"];?>"></td>
		  </tr>
		<tr>
		  <td align="right" class="tb_font_2">CD4 ก่อนเริ่ม ARV</td>
		  <td><span class="tb_font_2">
		    <input name="cd4_start" type="text" class="forntsarabun1" id="cd4_start" value="<?php echo $arr_view["cd4_start"];?>">
		  </span></td>
		  <td align="right" class="tb_font_2">ว/ด/ป ที่บันทึก</td>
		  <td align="left" class="forntsarabun1"><span class="tb_font_2">
		    <input name="cd4_regis" type="text" class="forntsarabun1" id="cd4_regis"  value="<?php echo $arr_view["cd4_regis"];?>">
		  </span></td>
		  </tr>
	</table>
	<hr />
     <table border="0" cellspacing="2" cellpadding="2">
  <tr class="tb_font_2">
    <td width="120" bgcolor="#0099FF">พ.ศ. <?=date("Y")+543;?></td>
    <td width="45" align="center" bgcolor="#0099FF">ม.ค.</td>
    <td width="45" align="center" bgcolor="#0099FF">ก.พ.</td>
    <td width="45" align="center" bgcolor="#0099FF">มี.ค.</td>
    <td width="45" align="center" bgcolor="#0099FF">เม.ย.</td>
    <td width="45" align="center" bgcolor="#0099FF">พ.ค.</td>
    <td width="45" align="center" bgcolor="#0099FF">มิ.ย.</td>
    <td width="45" align="center" bgcolor="#0099FF">ก.ค.</td>
    <td width="45" align="center" bgcolor="#0099FF">ส.ค.</td>
    <td width="45" align="center" bgcolor="#0099FF">ก.ย.</td>
    <td width="45" align="center" bgcolor="#0099FF">ต.ค.</td>
    <td width="45" align="center" bgcolor="#0099FF">พ.ย.</td>
    <td width="37" align="center" bgcolor="#0099FF">ธ.ค.</td>
  </tr>
  <tr>
    <td class="tb_font_2">CD4</td>
    <?
//   $year=date("Y");
	$sql = "CREATE TEMPORARY TABLE lab01 SELECT  *  FROM  hiv_lab_nhso  WHERE  ref_id='".$arr_view['row_id']."' ";
	$result = mysql_query($sql) or die (mysql_error());
	

	//////////// ดึงข้อมูล lab ///

	// cd4
		
	  $laball="SELECT * FROM lab01  WHERE labname like '%cd4%' ";
	  $result_laball=mysql_query($laball);
	  $arr1 = mysql_fetch_array($result_laball);

	//plasma VL
		
	  $laball2="SELECT * FROM lab01  WHERE labname like '%Plasma VL%' ";
	  $result_laball2=mysql_query($laball2);
	  $arr2 = mysql_fetch_array($result_laball2);
	  
	  // FBS
		
	  $laball3="SELECT * FROM lab01  WHERE labname like '%FBS%' ";
	  $result_laball3=mysql_query($laball3);
	  $arr3 = mysql_fetch_array($result_laball3);
	
	 // ALT
	
	  $laball4="SELECT  * FROM lab01  WHERE  labname like 'ALT%' ";
	  $result_laball4=mysql_query($laball4);
	  $arr4 = mysql_fetch_array($result_laball4);
	
	//Creatinine

	  $laball5="SELECT  * FROM lab01  WHERE labname like '%CREA%' ";
	  $result_laball5=mysql_query($laball5);
	  $arr5 = mysql_fetch_array($result_laball5);

	// lipid profile  1.chol 2.tg 3. hdl 4. ldl
	
		
	  $laball61="SELECT  * FROM lab01  WHERE labname like '%CHOL%'";
	  $result_laball61=mysql_query($laball61);
	  $arr61 = mysql_fetch_array($result_laball61);


	  $laball62="SELECT  * FROM lab01  WHERE labname like '%TRIG%' ";
	  $result_laball62=mysql_query($laball62);
	  $arr62= mysql_fetch_array($result_laball62);

		
	  $laball63="SELECT  * FROM lab01  WHERE labname  like '%HDL%' ";
	  $result_laball63=mysql_query($laball63);
	  $arr63= mysql_fetch_array($result_laball63);


	  $laball64="SELECT  * FROM lab01  WHERE labname like '%LDL%' ";
	  $result_laball64=mysql_query($laball64);
	  $arr64= mysql_fetch_array($result_laball64);

	
	// U/A
	$laball7="SELECT  * FROM lab01  WHERE labname like '%UA%'";
	  $result_laball7=mysql_query($laball7);
	  $arr7 = mysql_fetch_array($result_laball7);

	
	//CXR
	
	  $laball8="SELECT  * FROM lab01  WHERE labname like '%CXR%'";
	  $result_laball8=mysql_query($laball8);
	  $arr8 = mysql_fetch_array($result_laball8);
	
	//pap smear
	
	 $laball9="SELECT  * FROM lab01  WHERE labname like '%Pap smear%'";
	  $result_laball9=mysql_query($laball9);
	  $arr9 = mysql_fetch_array($result_laball9);

	?>
    <td>
      <input name="l11" type="text" class="forntsarabun1" id="l11" size="5" value="<?=$arr1['m1'];?>">
    </td>
    <td><span class="forntsarabun1">
      <input name="l12" type="text" class="forntsarabun1" id="l12" size="5" value="<?=$arr1['m2'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l13" type="text" class="forntsarabun1" id="l13" size="5" value="<?=$arr1['m3'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l14" type="text" class="forntsarabun1" id="l14" size="5" value="<?=$arr1['m4'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l15" type="text" class="forntsarabun1" id="l15" size="5" value="<?=$arr1['m5'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l16" type="text" class="forntsarabun1" id="l16" size="5" value="<?=$arr1['m6'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l17" type="text" class="forntsarabun1" id="l17" size="5" value="<?=$arr1['m7'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l18" type="text" class="forntsarabun1" id="l18" size="5" value="<?=$arr1['m8'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l19" type="text" class="forntsarabun1" id="l19" size="5" value="<?=$arr1['m9'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l110" type="text" class="forntsarabun1" id="l110" size="5" value="<?=$arr1['m10'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l111" type="text" class="forntsarabun1" id="l111" size="5" value="<?=$arr1['m11'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l112" type="text" class="forntsarabun1" id="l112" size="5" value="<?=$arr1['m12'];?>">
    </span></td>
  </tr>
  <tr>
    <td class="tb_font_2">Plasma VL</td>
    <td><span class="forntsarabun1">
      <input name="l21" type="text" class="forntsarabun1" id="l21" size="5" value="<?=$arr2['m1'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l22" type="text" class="forntsarabun1" id="l22" size="5" value="<?=$arr2['m2'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l23" type="text" class="forntsarabun1" id="l23" size="5" value="<?=$arr2['m3'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l24" type="text" class="forntsarabun1" id="l24" size="5" value="<?=$arr2['m4'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l25" type="text" class="forntsarabun1" id="l25" size="5" value="<?=$arr2['m5'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l26" type="text" class="forntsarabun1" id="l26" size="5" value="<?=$arr2['m6'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l27" type="text" class="forntsarabun1" id="l27" size="5" value="<?=$arr2['m7'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l28" type="text" class="forntsarabun1" id="l28" size="5" value="<?=$arr2['m8'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l29" type="text" class="forntsarabun1" id="l29" size="5" value="<?=$arr2['m9'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l210" type="text" class="forntsarabun1" id="l210" size="5" value="<?=$arr2['m10'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l211" type="text" class="forntsarabun1" id="l211" size="5" value="<?=$arr2['m11'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l212" type="text" class="forntsarabun1" id="l212" size="5" value="<?=$arr2['m12'];?>">
    </span></td>
    </tr>
  <tr>
    <td class="tb_font_2">FBS</td>
    <td><span class="forntsarabun1">
      <input name="l31" type="text" class="forntsarabun1" id="l31" size="5" value="<?=$arr3['m1'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l32" type="text" class="forntsarabun1" id="l32" size="5" value="<?=$arr3['m2'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l33" type="text" class="forntsarabun1" id="l33" size="5" value="<?=$arr3['m3'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l34" type="text" class="forntsarabun1" id="l34" size="5" value="<?=$arr3['m4'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l35" type="text" class="forntsarabun1" id="l35" size="5" value="<?=$arr3['m5'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l36" type="text" class="forntsarabun1" id="l36" size="5" value="<?=$arr3['m6'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l37" type="text" class="forntsarabun1" id="l37" size="5" value="<?=$arr3['m7'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l38" type="text" class="forntsarabun1" id="l38" size="5" value="<?=$arr3['m8'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l39" type="text" class="forntsarabun1" id="l39" size="5" value="<?=$arr3['m9'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l310" type="text" class="forntsarabun1" id="l310" size="5" value="<?=$arr3['m10'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l311" type="text" class="forntsarabun1" id="l311" size="5" value="<?=$arr3['m11'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l312" type="text" class="forntsarabun1" id="l312" size="5" value="<?=$arr3['m12'];?>">
    </span></td>
    </tr>
  <tr>
    <td class="tb_font_2">ALT</td>
    <td><span class="forntsarabun1">
      <input name="l41" type="text" class="forntsarabun1" id="l41" size="5" value="<?=$arr4['m1'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l42" type="text" class="forntsarabun1" id="l42" size="5" value="<?=$arr4['m2'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l43" type="text" class="forntsarabun1" id="l43" size="5" value="<?=$arr4['m3'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l44" type="text" class="forntsarabun1" id="l44" size="5" value="<?=$arr4['m4'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l45" type="text" class="forntsarabun1" id="l45" size="5" value="<?=$arr4['m5'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l46" type="text" class="forntsarabun1" id="l46" size="5" value="<?=$arr4['m6'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l47" type="text" class="forntsarabun1" id="l47" size="5" value="<?=$arr4['m7'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l48" type="text" class="forntsarabun1" id="l48" size="5" value="<?=$arr4['m8'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l49" type="text" class="forntsarabun1" id="l49" size="5" value="<?=$arr4['m9'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l410" type="text" class="forntsarabun1" id="l410" size="5" value="<?=$arr4['m10'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l411" type="text" class="forntsarabun1" id="l411" size="5" value="<?=$arr4['m11'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l412" type="text" class="forntsarabun1" id="l412" size="5" value="<?=$arr4['m12'];?>">
    </span></td>
    </tr>
  <tr>
    <td class="tb_font_2">Creatinine</td>
    <td><span class="forntsarabun1">
      <input name="l51" type="text" class="forntsarabun1" id="l51" size="5" value="<?=$arr5['m1'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l52" type="text" class="forntsarabun1" id="l52" size="5"  value="<?=$arr5['m2'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l53" type="text" class="forntsarabun1" id="l53" size="5" value="<?=$arr5['m3'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l54" type="text" class="forntsarabun1" id="l54" size="5" value="<?=$arr5['m4'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l55" type="text" class="forntsarabun1" id="l55" size="5" value="<?=$arr5['m5'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l56" type="text" class="forntsarabun1" id="l56" size="5" value="<?=$arr5['m6'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l57" type="text" class="forntsarabun1" id="l57" size="5" value="<?=$arr5['m7'];?>" >
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l58" type="text" class="forntsarabun1" id="l58" size="5" value="<?=$arr5['m8'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l59" type="text" class="forntsarabun1" id="l59" size="5" value="<?=$arr5['m9'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l510" type="text" class="forntsarabun1" id="l510" size="5" value="<?=$arr5['m10'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l511" type="text" class="forntsarabun1" id="l511" size="5" value="<?=$arr5['m11'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l512" type="text" class="forntsarabun1" id="l512" size="5" value="<?=$arr5['m12'];?>">
    </span></td>
    </tr>
  <tr>
    <td class="tb_font_2">Lipid profile 1.Chol</td>
    <td><span class="forntsarabun1">
      <input name="lChol1" type="text" class="forntsarabun1" id="lChol1" size="5" value="<?=$arr61['m1'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lChol2" type="text" class="forntsarabun1" id="lChol2" size="5" value="<?=$arr61['m2'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lChol3" type="text" class="forntsarabun1" id="lChol3" size="5" value="<?=$arr61['m3'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lChol4" type="text" class="forntsarabun1" id="lChol4" size="5" value="<?=$arr61['m4'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lChol5" type="text" class="forntsarabun1" id="lChol5" size="5" value="<?=$arr61['m5'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lChol6" type="text" class="forntsarabun1" id="lChol6" size="5" value="<?=$arr61['m6'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lChol7" type="text" class="forntsarabun1" id="lChol7" size="5" value="<?=$arr61['m7'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lChol8" type="text" class="forntsarabun1" id="lChol8" size="5" value="<?=$arr61['m8'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lChol9" type="text" class="forntsarabun1" id="lChol9" size="5" value="<?=$arr61['m9'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lChol10" type="text" class="forntsarabun1" id="lChol10" size="5" value="<?=$arr61['m10'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lChol11" type="text" class="forntsarabun1" id="lChol11" size="5" value="<?=$arr61['m11'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lChol12" type="text" class="forntsarabun1" id="lChol12" size="5" value="<?=$arr61['m12'];?>">
    </span></td>
    </tr>
  <tr>
    <td align="right" class="tb_font_2">2. TG</td>
    <td><span class="forntsarabun1">
      <input name="ltg1" type="text" class="forntsarabun1" id="ltg1" size="5" value="<?=$arr62['m1'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="ltg2" type="text" class="forntsarabun1" id="ltg2" size="5" value="<?=$arr62['m2'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="ltg3" type="text" class="forntsarabun1" id="ltg3" size="5" value="<?=$arr62['m3'];?>" >
    </span></td>
    <td><span class="forntsarabun1">
      <input name="ltg4" type="text" class="forntsarabun1" id="ltg4" size="5" value="<?=$arr62['m4'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="ltg5" type="text" class="forntsarabun1" id="ltg5" size="5" value="<?=$arr62['m5'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="ltg6" type="text" class="forntsarabun1" id="ltg6" size="5"  value="<?=$arr62['m6'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="ltg7" type="text" class="forntsarabun1" id="ltg7" size="5" value="<?=$arr62['m7'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="ltg8" type="text" class="forntsarabun1" id="ltg8" size="5" value="<?=$arr62['m8'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="ltg9" type="text" class="forntsarabun1" id="ltg9" size="5" value="<?=$arr62['m9'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="ltg10" type="text" class="forntsarabun1" id="ltg10" size="5" value="<?=$arr62['m10'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="ltg11" type="text" class="forntsarabun1" id="ltg11" size="5" value="<?=$arr62['m11'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="ltg12" type="text" class="forntsarabun1" id="ltg12" size="5" value="<?=$arr62['m12'];?>">
    </span></td>
    </tr>
  <tr>
    <td align="right" class="tb_font_2">3. HDL</td>
    <td><span class="forntsarabun1">
      <input name="lhdl1" type="text" class="forntsarabun1" id="lhdl1" size="5" value="<?=$arr63['m1'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lhdl2" type="text" class="forntsarabun1" id="lhdl2" size="5" value="<?=$arr63['m2'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lhdl3" type="text" class="forntsarabun1" id="lhdl3" size="5" value="<?=$arr63['m3'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lhdl4" type="text" class="forntsarabun1" id="lhdl4" size="5" value="<?=$arr63['m4'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lhdl5" type="text" class="forntsarabun1" id="lhdl5" size="5" value="<?=$arr63['m5'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lhdl6" type="text" class="forntsarabun1" id="lhdl6" size="5" value="<?=$arr63['m6'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lhdl7" type="text" class="forntsarabun1" id="lhdl7" size="5" value="<?=$arr63['m7'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lhdl8" type="text" class="forntsarabun1" id="lhdl8" size="5" value="<?=$arr63['m8'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lhdl9" type="text" class="forntsarabun1" id="lhdl9" size="5" value="<?=$arr63['m9'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lhdl10" type="text" class="forntsarabun1" id="lhdl10" size="5" value="<?=$arr63['m10'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lhdl11" type="text" class="forntsarabun1" id="lhdl11" size="5" value="<?=$arr63['m11'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lhdl12" type="text" class="forntsarabun1" id="lhdl12" size="5" value="<?=$arr63['m12'];?>">
    </span></td>
    </tr>
  <tr>
    <td align="right" class="tb_font_2">4. LDL</td>
    <td><span class="forntsarabun1">
      <input name="lldl1" type="text" class="forntsarabun1" id="lldl1" size="5"  value="<?=$arr64['m1'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lldl2" type="text" class="forntsarabun1" id="lldl2" size="5" value="<?=$arr64['m2'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lldl3" type="text" class="forntsarabun1" id="lldl3" size="5" value="<?=$arr64['m3'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lldl4" type="text" class="forntsarabun1" id="lldl4" size="5" value="<?=$arr64['m4'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lldl5" type="text" class="forntsarabun1" id="lldl5" size="5" value="<?=$arr64['m5'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lldl6" type="text" class="forntsarabun1" id="lldl6" size="5" value="<?=$arr64['m6'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lldl7" type="text" class="forntsarabun1" id="lldl7" size="5" value="<?=$arr64['m7'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lldl8" type="text" class="forntsarabun1" id="lldl8" size="5" value="<?=$arr64['m8'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lldl9" type="text" class="forntsarabun1" id="lldl9" size="5" value="<?=$arr64['m9'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lldl10" type="text" class="forntsarabun1" id="lldl10" size="5" value="<?=$arr64['m10'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lldl11" type="text" class="forntsarabun1" id="lldl11" size="5" value="<?=$arr64['m11'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="lldl12" type="text" class="forntsarabun1" id="lldl12" size="5" value="<?=$arr64['m12'];?>">
    </span></td>
    </tr>
  <tr>
    <td class="tb_font_2">U/A (ถ้าใช้ยา TDF)</td>
    <td><span class="forntsarabun1">
      <input name="l71" type="text" class="forntsarabun1" id="l71" size="5" value="<?=$arr7['m1'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l72" type="text" class="forntsarabun1" id="l72" size="5" value="<?=$arr7['m2'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l73" type="text" class="forntsarabun1" id="l73" size="5" value="<?=$arr7['m3'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l74" type="text" class="forntsarabun1" id="l74" size="5" value="<?=$arr7['m4'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l75" type="text" class="forntsarabun1" id="l75" size="5" value="<?=$arr7['m5'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l76" type="text" class="forntsarabun1" id="l76" size="5" value="<?=$arr7['m6'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l77" type="text" class="forntsarabun1" id="l77" size="5" value="<?=$arr7['m7'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l78" type="text" class="forntsarabun1" id="l78" size="5" value="<?=$arr7['m8'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l79" type="text" class="forntsarabun1" id="l79" size="5" value="<?=$arr7['m9'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l710" type="text" class="forntsarabun1" id="l710" size="5" value="<?=$arr7['m10'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l711" type="text" class="forntsarabun1" id="l711" size="5" value="<?=$arr7['m11'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l712" type="text" class="forntsarabun1" id="l712" size="5" value="<?=$arr7['m12'];?>">
    </span></td>
    </tr>
  <tr>
    <td class="tb_font_2">CXR</td>
    <td><span class="forntsarabun1">
      <input name="l81" type="text" class="forntsarabun1" id="l81" size="5" value="<?=$arr8['m1'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l82" type="text" class="forntsarabun1" id="l82" size="5" value="<?=$arr8['m2'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l83" type="text" class="forntsarabun1" id="l83" size="5" value="<?=$arr8['m3'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l84" type="text" class="forntsarabun1" id="l84" size="5" value="<?=$arr8['m4'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l85" type="text" class="forntsarabun1" id="l85" size="5" value="<?=$arr8['m5'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l86" type="text" class="forntsarabun1" id="l86" size="5" value="<?=$arr8['m6'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l87" type="text" class="forntsarabun1" id="l87" size="5" value="<?=$arr8['m7'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l88" type="text" class="forntsarabun1" id="l88" size="5" value="<?=$arr8['m8'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l89" type="text" class="forntsarabun1" id="l89" size="5" value="<?=$arr8['m9'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l810" type="text" class="forntsarabun1" id="l810" size="5" value="<?=$arr8['m10'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l811" type="text" class="forntsarabun1" id="l811" size="5" value="<?=$arr8['m11'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l812" type="text" class="forntsarabun1" id="l812" size="5" value="<?=$arr8['m12'];?>">
    </span></td>
    </tr>
  <tr>
    <td class="tb_font_2">Pap smear</td>
    <td><span class="forntsarabun1">
      <input name="l91" type="text" class="forntsarabun1" id="l91" size="5" value="<?=$arr9['m1'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l92" type="text" class="forntsarabun1" id="l92" size="5" value="<?=$arr9['m2'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l93" type="text" class="forntsarabun1" id="l93" size="5" value="<?=$arr9['m3'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l94" type="text" class="forntsarabun1" id="l94" size="5" value="<?=$arr9['m4'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l95" type="text" class="forntsarabun1" id="l95" size="5"value="<?=$arr9['m5'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l96" type="text" class="forntsarabun1" id="l96" size="5" value="<?=$arr9['m6'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l97" type="text" class="forntsarabun1" id="l97" size="5" value="<?=$arr9['m7'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l98" type="text" class="forntsarabun1" id="l98" size="5" value="<?=$arr9['m8'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l99" type="text" class="forntsarabun1" id="l99" size="5" value="<?=$arr9['m9'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l910" type="text" class="forntsarabun1" id="l910" size="5" value="<?=$arr9['m10'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l911" type="text" class="forntsarabun1" id="l911" size="5" value="<?=$arr9['m11'];?>">
    </span></td>
    <td><span class="forntsarabun1">
      <input name="l912" type="text" class="forntsarabun1" id="l912" size="5" value="<?=$arr9['m12'];?>">
    </span></td>
    </tr>
    </table>
    <hr>
    <table border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td valign="top" class="tb_font_2">สูตรยาที่ใช้</td>
    <td><textarea name="phar" id="phar" cols="45" rows="5"><?php echo $arr_view["phar"];?></textarea></td>
  </tr>
  <tr>
    <td valign="top" class="tb_font_2">ผลข้างเคียง</td>
    <td><textarea name="sideefect" id="sideefect" cols="45" rows="5"><?php echo $arr_view["sideefect"];?></textarea></td>
  </tr>
</table>

    </td>
    </tr>
	  </table>
	<p>
	<input name="submit" type="submit" class="forntsarabun" value="บันทึกข้อมูล"  />
	&nbsp;
   <!-- <input name="submit2" type="submit" class="forntsarabun1" value="ตกลง&amp;สติกเกอร์ OPD" />-->
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

/*$select="select hn from hiv_nhso Where hn ='".$_POST["hn"]."' ";
$q=mysql_query($select);
$rows=mysql_num_rows($q);

if($rows){
	
	print "hn ".$_POST["hn"]." มีข้อมูลแล้ว";
//	print "<META HTTP-EQUIV='Refresh' CONTENT='2;URL=hiv_index.php'>";
}
else
{*/
	 	 
$strSQL = "UPDATE hiv_nhso  SET ";
$strSQL .="hn = '".$_POST["hn"]."' ";
$strSQL .=",ptname = '".$_POST["ptname"]."' ";
$strSQL .=",address = '".$_POST["address"]."' ";
$strSQL .=",age = '".$_POST["age"]."' ";
$strSQL .=",ptright = '".$_POST["ptright"]."' ";
$strSQL .=",doctor = '".$_POST["doctor"]."' ";
$strSQL .=",arv_date = '".$_POST["arv_date"]."' ";
$strSQL .=",symp_hiv = '".$_POST["symp_hiv"]."' ";
$strSQL .=",cd4_start = '".$_POST["cd4_start"]."' ";
$strSQL .=",cd4_regis = '".$_POST["cd4_regis"]."' ";
$strSQL .=",phar = '".$_POST["phar"]."' ";
$strSQL .=",sideefect = '".$_POST["sideefect"]."' ";
$strSQL .="WHERE row_id = '".$_POST['row_id']."' ";
$objQuery = mysql_query($strSQL);
//
if($objQuery)
{
	echo "<br><font class='forntsarabun1'>บันทึกข้อมูลเรียบร้อยแล้ว</font>";

 
$max="select max(row_id)as maxid from hiv_nhso";
$query = mysql_query($max);
$ref=mysql_fetch_array($query);

 ///1 CD4  //

$strSQL1 = "UPDATE hiv_lab_nhso  SET ";
$strSQL1 .="m1 = '".$_POST["l11"]."' ";
$strSQL1 .=",m2 = '".$_POST["l12"]."' ";
$strSQL1 .=",m3 = '".$_POST["l13"]."' ";
$strSQL1 .=",m4 = '".$_POST["l14"]."' ";
$strSQL1 .=",m5 = '".$_POST["l15"]."' ";
$strSQL1 .=",m6 = '".$_POST["l16"]."' ";
$strSQL1 .=",m7 = '".$_POST["l17"]."' ";
$strSQL1 .=",m8 = '".$_POST["l18"]."' ";
$strSQL1 .=",m9 = '".$_POST["l19"]."' ";
$strSQL1 .=",m10 = '".$_POST["l110"]."' ";
$strSQL1 .=",m11 = '".$_POST["l111"]."' ";
$strSQL1 .=",m12 = '".$_POST["l112"]."' ";
$strSQL1 .="WHERE ref_id = '".$_POST["row_id"]."' AND labname='CD4' ";
$objQuery1 = mysql_query($strSQL1);

 // 2 plasma VL  //
$strSQL2 = "UPDATE hiv_lab_nhso  SET ";
$strSQL2 .="m1 = '".$_POST["l21"]."' ";
$strSQL2 .=",m2 = '".$_POST["l22"]."' ";
$strSQL2 .=",m3 = '".$_POST["l23"]."' ";
$strSQL2 .=",m4 = '".$_POST["l24"]."' ";
$strSQL2 .=",m5 = '".$_POST["l25"]."' ";
$strSQL2 .=",m6 = '".$_POST["l26"]."' ";
$strSQL2 .=",m7 = '".$_POST["l27"]."' ";
$strSQL2 .=",m8 = '".$_POST["l28"]."' ";
$strSQL2 .=",m9 = '".$_POST["l29"]."' ";
$strSQL2 .=",m10 = '".$_POST["l210"]."' ";
$strSQL2 .=",m11 = '".$_POST["l211"]."' ";
$strSQL2 .=",m12 = '".$_POST["l212"]."' ";
$strSQL2 .="WHERE ref_id = '".$_POST["row_id"]."' AND labname='Plasma VL' ";
$objQuery2 = mysql_query($strSQL2);

// ///  3 FBS  //

$sqladd3 = "UPDATE hiv_lab_nhso  SET ";
$sqladd3 .="m1 = '".$_POST["l31"]."' ";
$sqladd3 .=",m2 = '".$_POST["l32"]."' ";
$sqladd3 .=",m3 = '".$_POST["l33"]."' ";
$sqladd3 .=",m4 = '".$_POST["l34"]."' ";
$sqladd3 .=",m5 = '".$_POST["l35"]."' ";
$sqladd3 .=",m6 = '".$_POST["l36"]."' ";
$sqladd3 .=",m7 = '".$_POST["l37"]."' ";
$sqladd3 .=",m8 = '".$_POST["l38"]."' ";
$sqladd3 .=",m9 = '".$_POST["l39"]."' ";
$sqladd3 .=",m10 = '".$_POST["l310"]."' ";
$sqladd3 .=",m11 = '".$_POST["l311"]."' ";
$sqladd3 .=",m12 = '".$_POST["l312"]."' ";
$sqladd3 .="WHERE ref_id = '".$_POST["row_id"]."' AND labname='FBS' ";
$objadd3 = mysql_query($sqladd3);
 
 

 // /// 4 ALT  //
$sqladd4 = "UPDATE hiv_lab_nhso  SET ";
$sqladd4 .="m1 = '".$_POST["l41"]."' ";
$sqladd4 .=",m2 = '".$_POST["l42"]."' ";
$sqladd4 .=",m3 = '".$_POST["l43"]."' ";
$sqladd4 .=",m4 = '".$_POST["l44"]."' ";
$sqladd4 .=",m5 = '".$_POST["l45"]."' ";
$sqladd4 .=",m6 = '".$_POST["l46"]."' ";
$sqladd4 .=",m7 = '".$_POST["l47"]."' ";
$sqladd4 .=",m8 = '".$_POST["l48"]."' ";
$sqladd4 .=",m9 = '".$_POST["l49"]."' ";
$sqladd4 .=",m10 = '".$_POST["l410"]."' ";
$sqladd4 .=",m11 = '".$_POST["l411"]."' ";
$sqladd4 .=",m12 = '".$_POST["l412"]."' ";
$sqladd4 .="WHERE ref_id = '".$_POST["row_id"]."' AND labname='ALT'";
$objadd4 = mysql_query($sqladd4);
 
  //  5 Creatinine  //
  $sqladd5 = "UPDATE hiv_lab_nhso  SET ";
$sqladd5 .="m1 = '".$_POST["l51"]."' ";
$sqladd5 .=",m2 = '".$_POST["l52"]."' ";
$sqladd5 .=",m3 = '".$_POST["l53"]."' ";
$sqladd5 .=",m4 = '".$_POST["l54"]."' ";
$sqladd5 .=",m5 = '".$_POST["l55"]."' ";
$sqladd5 .=",m6 = '".$_POST["l56"]."' ";
$sqladd5 .=",m7 = '".$_POST["l57"]."' ";
$sqladd5 .=",m8 = '".$_POST["l58"]."' ";
$sqladd5 .=",m9 = '".$_POST["l59"]."' ";
$sqladd5 .=",m10 = '".$_POST["l510"]."' ";
$sqladd5 .=",m11 = '".$_POST["l511"]."' ";
$sqladd5 .=",m12 = '".$_POST["l512"]."' ";
$sqladd5 .="WHERE ref_id = '".$_POST["row_id"]."' AND labname='CREA' ";
$objadd5 = mysql_query($sqladd5);


 
 
//  6 lipid profile  //
$sqladd61 = "UPDATE hiv_lab_nhso  SET ";
$sqladd61 .="m1 = '".$_POST["lChol1"]."' ";
$sqladd61 .=",m2 = '".$_POST["lChol2"]."' ";
$sqladd61 .=",m3 = '".$_POST["lChol3"]."' ";
$sqladd61 .=",m4 = '".$_POST["lChol4"]."' ";
$sqladd61 .=",m5 = '".$_POST["lChol5"]."' ";
$sqladd61 .=",m6 = '".$_POST["lChol6"]."' ";
$sqladd61 .=",m7 = '".$_POST["lChol7"]."' ";
$sqladd61 .=",m8 = '".$_POST["lChol8"]."' ";
$sqladd61 .=",m9 = '".$_POST["lChol9"]."' ";
$sqladd61 .=",m10 = '".$_POST["lChol10"]."' ";
$sqladd61 .=",m11 = '".$_POST["lChol11"]."' ";
$sqladd61 .=",m12 = '".$_POST["lChol12"]."' ";
$sqladd61 .="WHERE ref_id = '".$_POST["row_id"]."' AND labname='CHOL' ";
$objadd61 = mysql_query($sqladd61);

 
$sqladd62 = "UPDATE hiv_lab_nhso  SET ";
$sqladd62 .="m1 = '".$_POST["ltg1"]."' ";
$sqladd62 .=",m2 = '".$_POST["ltg2"]."' ";
$sqladd62 .=",m3 = '".$_POST["ltg3"]."' ";
$sqladd62 .=",m4 = '".$_POST["ltg4"]."' ";
$sqladd62 .=",m5 = '".$_POST["ltg5"]."' ";
$sqladd62 .=",m6 = '".$_POST["ltg6"]."' ";
$sqladd62 .=",m7 = '".$_POST["ltg7"]."' ";
$sqladd62 .=",m8 = '".$_POST["ltg8"]."' ";
$sqladd62 .=",m9 = '".$_POST["ltg9"]."' ";
$sqladd62 .=",m10 = '".$_POST["ltg10"]."' ";
$sqladd62 .=",m11 = '".$_POST["ltg11"]."' ";
$sqladd62 .=",m12 = '".$_POST["ltg12"]."' ";
$sqladd62 .="WHERE ref_id = '".$_POST["row_id"]."' AND labname='TRIG'";
$objadd62 = mysql_query($sqladd62);
 
 
$sqladd63 = "UPDATE hiv_lab_nhso  SET ";
$sqladd63 .="m1 = '".$_POST["lhdl1"]."' ";
$sqladd63 .=",m2 = '".$_POST["lhdl2"]."' ";
$sqladd63 .=",m3 = '".$_POST["lhdl3"]."' ";
$sqladd63 .=",m4 = '".$_POST["lhdl4"]."' ";
$sqladd63 .=",m5 = '".$_POST["lhdl5"]."' ";
$sqladd63 .=",m6 = '".$_POST["lhdl6"]."' ";
$sqladd63 .=",m7 = '".$_POST["lhdl7"]."' ";
$sqladd63 .=",m8 = '".$_POST["lhdl8"]."' ";
$sqladd63 .=",m9 = '".$_POST["lhdl9"]."' ";
$sqladd63 .=",m10 = '".$_POST["lhdl10"]."' ";
$sqladd63 .=",m11 = '".$_POST["lhdl11"]."' ";
$sqladd63 .=",m12 = '".$_POST["lhdl12"]."' ";
$sqladd63 .="WHERE ref_id = '".$_POST["row_id"]."' AND labname='HDL' ";
$objadd63 = mysql_query($sqladd63);

 
$sqladd64 = "UPDATE hiv_lab_nhso  SET ";
$sqladd64 .="m1 = '".$_POST["lldl1"]."' ";
$sqladd64 .=",m2 = '".$_POST["lldl2"]."' ";
$sqladd64 .=",m3 = '".$_POST["lldl3"]."' ";
$sqladd64 .=",m4 = '".$_POST["lldl4"]."' ";
$sqladd64 .=",m5 = '".$_POST["lldl5"]."' ";
$sqladd64 .=",m6 = '".$_POST["lldl6"]."' ";
$sqladd64 .=",m7 = '".$_POST["lldl7"]."' ";
$sqladd64 .=",m8 = '".$_POST["lldl8"]."' ";
$sqladd64 .=",m9 = '".$_POST["lldl9"]."' ";
$sqladd64 .=",m10 = '".$_POST["lldl10"]."' ";
$sqladd64 .=",m11 = '".$_POST["lldl11"]."' ";
$sqladd64 .=",m12 = '".$_POST["lldl12"]."' ";
$sqladd64 .="WHERE ref_id = '".$_POST["row_id"]."' AND labname='LDL' ";
$objadd64 = mysql_query($sqladd64);
 
 /// UA  
   $sqladd7 = "UPDATE hiv_lab_nhso  SET ";
$sqladd7 .="m1 = '".$_POST["l71"]."' ";
$sqladd7 .=",m2 = '".$_POST["l72"]."' ";
$sqladd7 .=",m3 = '".$_POST["l73"]."' ";
$sqladd7 .=",m4 = '".$_POST["l74"]."' ";
$sqladd7 .=",m5 = '".$_POST["l75"]."' ";
$sqladd7 .=",m6 = '".$_POST["l76"]."' ";
$sqladd7 .=",m7 = '".$_POST["l77"]."' ";
$sqladd7 .=",m8 = '".$_POST["l78"]."' ";
$sqladd7 .=",m9 = '".$_POST["l79"]."' ";
$sqladd7 .=",m10 = '".$_POST["l710"]."' ";
$sqladd7 .=",m11 = '".$_POST["l711"]."' ";
$sqladd7 .=",m12 = '".$_POST["l712"]."' ";
$sqladd7 .="WHERE ref_id = '".$_POST["row_id"]."' AND labname='UA' ";
$objadd7 = mysql_query($sqladd7);


 // CXR
$sqladd8 = "UPDATE hiv_lab_nhso  SET ";
$sqladd8 .="m1 = '".$_POST["l81"]."' ";
$sqladd8 .=",m2 = '".$_POST["l82"]."' ";
$sqladd8 .=",m3 = '".$_POST["l83"]."' ";
$sqladd8 .=",m4 = '".$_POST["l84"]."' ";
$sqladd8 .=",m5 = '".$_POST["l85"]."' ";
$sqladd8 .=",m6 = '".$_POST["l86"]."' ";
$sqladd8 .=",m7 = '".$_POST["l87"]."' ";
$sqladd8 .=",m8 = '".$_POST["l88"]."' ";
$sqladd8 .=",m9 = '".$_POST["l89"]."' ";
$sqladd8 .=",m10 = '".$_POST["l810"]."' ";
$sqladd8 .=",m11 = '".$_POST["l811"]."' ";
$sqladd8 .=",m12 = '".$_POST["l812"]."' ";
$sqladd8 .="WHERE ref_id = '".$_POST["row_id"]."' AND labname='CXR' ";
$objadd8 = mysql_query($sqladd8);

  // Pap smear
 $sqladd9 = "UPDATE hiv_lab_nhso  SET ";
$sqladd9 .="m1 = '".$_POST["l91"]."' ";
$sqladd9 .=",m2 = '".$_POST["l92"]."' ";
$sqladd9 .=",m3 = '".$_POST["l93"]."' ";
$sqladd9 .=",m4 = '".$_POST["l94"]."' ";
$sqladd9 .=",m5 = '".$_POST["l95"]."' ";
$sqladd9 .=",m6 = '".$_POST["l96"]."' ";
$sqladd9 .=",m7 = '".$_POST["l97"]."' ";
$sqladd9 .=",m8 = '".$_POST["l98"]."' ";
$sqladd9 .=",m9 = '".$_POST["l99"]."' ";
$sqladd9 .=",m10 = '".$_POST["l910"]."' ";
$sqladd9 .=",m11 = '".$_POST["l911"]."' ";
$sqladd9 .=",m12 = '".$_POST["l912"]."' ";
$sqladd9 .="WHERE ref_id = '".$_POST["row_id"]."'  AND labname='Pap smear'";
$objadd9 = mysql_query($sqladd9);
 
	print "<META HTTP-EQUIV='Refresh' CONTENT='2;URL=hiv_nhso_edit.php'>";
}
else
{
	echo "<br><font class='forntsarabun1'>ไม่สามารถบันทึกได้ [".$strSQL."]</font>";
	print "<META HTTP-EQUIV='Refresh' CONTENT='2;URL=hiv_nhso_edit.php'>";
}

	 
include("../unconnect.inc");	 
}
 
}
//}

 ?>
</body>


</html>
