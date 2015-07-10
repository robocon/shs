<? 
session_start();
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>Clinic diabetes</title>
    <!-- InstanceEndEditable -->
    <link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script> 
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>
<style>
.font1{
	font-family:"TH SarabunPSK";
	font-size:20pt;
}
.table_font1{
	font-family:"TH SarabunPSK";
	font-size:18pt;
	font-weight:bold;
	color:#600;	
}
.table_font2{
	font-family:"TH SarabunPSK";
	font-size:18pt;
}
legend{
	
font-family:"TH SarabunPSK";
font-size: 18pt;
font-weight: bold;
color:#600;	
padding:0px 3px;
}
fieldset{
display:inline;
background-color:#FEFDDE;
/*width:300px;*/
border-color:#000;

}
</style>

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
	font-size: 20 px;
}
.fontsara {
	font-family:"TH SarabunPSK";
	font-size: 18 px;
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
<body>


<div id="no_print">
<div id="menu">
  <ul class="menu">
        <li><a href="http://192.168.1.2/sm3/nindex.htm" class="parent"><span>โปรแกรมโรงพยาบาล</span></a></li>
         <li><a href="#"><span>ลงทะเบียน</span></a></li>
          <ul>
		 <li class="last"><a href="diabetes.php"><span>ลงทะเบียน DM</span></a></li>
         <li class="last"><a href="hypertension.php"><span>ลงทะเบียน HT</span></a></li>
       	</ul>
     	  <li><a href="diabetes_edit.php"><span>แก้ไขข้อมูล</span></a></li>
           <ul>
		 <li class="last"><a href="diabetes_edit.php"><span>แก้ไขข้อมูล DM</span></a></li>
         <li class="last"><a href="hypertension_edit.php"><span>แก้ไขข้อมูล HT</span></a></li>
       	</ul>
         <li><a href="#"><span>รายชื่อผู้ป่วย DM</span></a></li>
         <ul>
		 <li class="last"><a href="diabetes_list.php"><span>รายชื่อทั้งหมด</span></a></li>
         <li class="last"><a href="diabetes_list_so.php"><span>รายชื่อ ทหาร/ครอบครัว</span></a></li>
       	</ul>
       <li><a href="#"><span>รายชื่อผู้ป่วย HT</span></a></li>
         <ul>
		 <li class="last"><a href="hypertension_list.php"><span>รายชื่อทั้งหมด</span></a></li>
         <li class="last"><a href="hypertension_list_so.php"><span>รายชื่อ ทหาร/ครอบครัว</span></a></li>
       	</ul>
     <li><a href="report_diabetes.php"><span>สถิติ</span></a></li>
 		<ul>
		 <li class="last"><a href="report_diabetes.php"><span>สถิติ DM</span></a></li>
         <li class="last"><a href="report_hypertension.php"><span>สถิติ HT</span></a></li>
       	</ul>
     <li><a href="#"><span>รายงาน</span></a></li>
 		<ul>
		 <li class="last"><a href="report_diabetesofyear.php"><span>รายงาน DM</span></a></li>
         <li class="last"><a href="report_hypertensionofyear.php"><span>รายงาน HT</span></a></li>
       	</ul>        
    </ul>
</div>

<div style="visibility: hidden">
 <br />
 <a href="http://apycom.com/">a</a><br />
</div>

</div>


<div><!-- InstanceBeginEditable name="detail" -->

<?php
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
		 font-weight:bold;}
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
	color: #FFF;
}
.forntsarabun1 {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
</style>


<h1 class="forntsarabun1">คลินิกเบาหวาน</h1>


<form action="" method="post">
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" >
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0">
	<TR>
		<TD align="center" bgcolor="#0000CC" class="forntsarabun">กรอกหมายเลข HN</TD>
	</TR>
	<TR>
		<TD class="tb_font"><input name="p_hn" type="text" class="forntsarabun1" id="p_hn"  value="<?php echo $_POST["p_hn"];?>"/>&nbsp;<input name="Submit" type="submit" class="forntsarabun1" value="ตกลง" /></TD>
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
	
	  $sqldm="select * from opcard where hn='$hn' ";
	  $querydm=mysql_query($sqldm);
	  $row=mysql_num_rows($querydm);
	  
	  if(!$row){
		  
		  print "<br> <font class='forntsarabun1'>ไม่พบ  HN  <b>$hn</b>  ในระบบทะเบียน </font>";
		  
	  }else{
	
	
//ค้นหา hn จาก opday ****************************************************************************************
	$sql = "Select *, concat(yot,' ',name,' ',surname) as ptname From opcard where  hn = '".$_POST["p_hn"]."' limit 0,1";
	//echo $sql;
	$result = mysql_query($sql) or die("".mysql_error()." -->");
	/*if(mysql_num_rows($result) <= 0){
		echo "<CENTER>ผู้ป่วยยังไม่ได้ทำการลงทะเบียน</CENTER>";
		exit();
	}*/
	$arr_view = mysql_fetch_assoc($result);

$sql = "Select vn From opday where thidate like '".$thaidate."%' and hn = '".$_POST["p_hn"]."' limit 0,1";
list($arr_view["vn"]) = mysql_fetch_row(mysql_query($sql));

$date_hn = date("Y-m-d").$arr_view["hn"];
$date_vn = date("Y-m-d").$arr_view["vn"];

$sql = "Select  weight, height From opd where hn = '".$arr_view["hn"]."' AND type <> 'ญาติ' Order by row_id DESC limit 1";
$result = Mysql_Query($sql);
list($weight, $height) = Mysql_fetch_row($result);

//ค้นหาวันเกิดจาก opcard ****************************************************************************************
	//$sql = "Select dbirth From opcard where hn = '".$arr_view["hn"]."' limit  0,1";
	//$result = mysql_query($sql) or die("Error line 122 \n <!-- ".$sql." --> \n <!-- ".mysql_error()." -->");
	//list($arr_view["dbirth"]) = mysql_fetch_row($result);
	$arr_view["age"] = calcage($arr_view["dbirth"]);

//ค้นหาผลการตรวจทางพยาธิ ****************************************************************************************
	
	$y=date("Y")+543;
	$d=date("d");
	$m=date("m");
	$date1=$y.'-'.$m.'-'.$d;
	
	$opd = "Select * From  opd where thidate  like '$date1%' AND hn='".$arr_view["hn"]."' limit 0,1 ";
	$result_opd = mysql_query($opd);
	$arr_opd = mysql_fetch_array($result_opd);
	
//ค้นหาข้อมูลเดิม
	
	$times = mktime(0,0,0,date("m"),date("d")-3,date("Y"));
	$date_after= date("Y-m-d H:i:s",$times);
	$sql = "Select * From  opd where `thdatehn` > '{ $date_after }' AND hn='".$arr_view["hn"]."' limit 0,1 ";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	
	if($count > 0){
		$arr_dxofyear = mysql_fetch_assoc($result);
		$height = $arr_dxofyear["height"];
		$weight = $arr_dxofyear["weight"];
		
		
		 
		if($arr_dxofyear["cigarette"] == '1'){ $cigarette1 = "Checked";}else if($arr_dxofyear["cigarette"] == '0'){$cigarette0 = "Checked";}
		if($arr_dxofyear["alcohol"] == '1'){ $alcohol1 = "Checked";}else if($arr_dxofyear["alcohol"] == '0'){$alcohol0 = "Checked";}
		if($arr_dxofyear["congenital_disease"] != ''){ $congenital_disease = $arr_dxofyear["congenital_disease"];}else{$congenital_disease = "ปฎิเสธโรคประจำตัว";}
		
		
	}else{
		$sql = "Select congenital_disease, weight, height, (CASE WHEN cigarette = '1' THEN 'Checked' ELSE '' END ), (CASE WHEN alcohol = '1'THEN 'Checked' ELSE '' END ), (CASE WHEN cigarette = '0'THEN 'Checked' ELSE '' END ), (CASE WHEN alcohol = '0'THEN 'Checked' ELSE '' END )   From opd where hn = '".$arr_view["hn"]."' AND type <> 'ญาติ' Order by row_id DESC limit 1";

		$result = Mysql_Query($sql);
		list($congenital_disease, $weight, $height, $cigarette1, $alcohol1, $cigarette0, $alcohol0) = Mysql_fetch_row($result);
			if($congenital_disease == "")
				$congenital_disease = "ปฎิเสธโรคประจำตัว";
	}
	
	if($arr_dxofyear["rate"] == ""){
		$arr_dxofyear["rate"] = 20;
	}

////////////////////////////////////////

$datenow=date("Y-m-d");
	 
	/* $sqltemp="CREATE TEMPORARY TABLE  lab1  Select * from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND a.authorisedate LIKE  '$datenow%' AND b.hn='".$arr_view["hn"]."' ";
	 $querytemp= mysql_query($sqltemp); 
	 
	  $sqllab1="Select * from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.orderdate LIKE  '$datenow%' AND b.hn='".$arr_view["hn"]."' and  a.labname='Blood Sugar' ";
	  $result_lab1=mysql_query($sqllab1);
	  $dbarrlab1=mysql_fetch_array($result_lab1);
	  
	 // echo $sqllab1;
	  
/////////////////////////////////	 

	  $sqllab2="Select * from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.orderdate  LIKE  '$datenow%' AND b.hn='".$arr_view["hn"]."' and  a.labname='HBA1C' ";
	  $result_lab2=mysql_query($sqllab2);
	  $dbarrlab2=mysql_fetch_array($result_lab2);
	  
	  /////////////////////////////////	 

	  $sqllab3="Select * from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.orderdate LIKE  '$datenow%' AND b.hn='".$arr_view["hn"]."' and a.labname='LDL' ";
	  $result_lab3=mysql_query($sqllab3);
	  $dbarrlab3=mysql_fetch_array($result_lab3);
	  /////////////////////////////////	 

	  $sqllab4="Select * from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.orderdate LIKE  '$datenow%' AND b.hn='".$arr_view["hn"]."' and  a.labname='Creatinine' ";
	  $result_lab4=mysql_query($sqllab4);
	  $dbarrlab4=mysql_fetch_array($result_lab4);
	  /////////////////////////////////	 

	  $sqllab5="Select * from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.orderdate LIKE  '$datenow%' AND b.hn='".$arr_view["hn"]."' and  a.labname='Urine protein' ";
	  $result_lab5=mysql_query($sqllab5);
	  $dbarrlab5=mysql_fetch_array($result_lab5);
	  
	  /////////////////////////////////	 

	  $sqllab6="Select  *  from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.orderdate LIKE  '$datenow%' AND b.hn='".$arr_view["hn"]."' and  a.labname='Urine Microalbumin' ";
	  $result_lab6=mysql_query($sqllab6);
	  $dbarrlab6=mysql_fetch_array($result_lab6);
	  
	  //////////////////////*/
  
	  $sqldm="select max(dm_no)as dmnumber from diabetes_clinic";
	  $querydm=mysql_query($sqldm);
	  $arrdm=mysql_fetch_array($querydm);
	  $dm=$arrdm['dmnumber']+1;
	  $dm_no=$dm;
	  
	 
?>

<!-- ข้อมูลเบื้องต้นของผู้ป่วย -->
<FORM METHOD="post" ACTION="diabetes.php?do=save" name="F1">

<input name="age" type="hidden" id="age"  value="<?php echo $arr_view["age"];?>" />
<input name="hn" type="hidden" id="hn"  value="<?php echo $arr_view["hn"];?>" />
<br />
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" >
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0">
	<TR>
		<TD align="left" bgcolor="#0000CC" class="tb_font_1">&nbsp;<span class="forntsarabun">&nbsp;&nbsp;ข้อมูลผู้ป่วย</span></TD>
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
		  <td align="right" class="tb_font_2">DM number :</td>
		  <td><span class="data_show">
		    <input name="dm_no" type="text" class="forntsarabun1" id="dm_no"  value="<?=$dm_no;?>" readonly/>
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
		<tr class="forntsarabun1">
		  <td  align="right" class="tb_font_2">เพศ :</td>
		  <td >
          <? if($arr_view['sex']=='ช'){ $sex1="checked"; }elseif($arr_view['sex']=='ญ'){ $sex2="checked"; } ?>
		    <input name="sex" type="radio" value="0" <?=$sex1;?>/>
		    ชาย
		    <input name="sex" type="radio" value="1" <?=$sex2;?>/> 
		    หญิง
</td>
		  <td  align="right" class="tb_font_2">&nbsp;</td>
		  <td align="left">&nbsp;</td>
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
	</table>
	<hr />
	<TABLE class="forntsarabun1">
	  <tr>
           <td align="right" class="tb_font_2">การวินิจฉัย : </td>
           <td colspan="5" align="left" class="forntsarabun1"><input name="dia1" type="radio" value="0" />
           DM type1
             <input name="dia1" type="radio" value="1" />
             DM type2 
             <input name="dia1" type="radio" value="2" /> 
             Uncertain type
</td>
          </tr>
	  <tr>
	    <td align="right" class="forntsarabun1">&nbsp;</td>
	    <td colspan="5" align="left" class="forntsarabun1">การวินิจฉัยครั้งแรก ประมาณ พ.ศ. 
	      <input name="nosis_d" type="text" class="forntsarabun1" id="nosis_d" /> </td>
	    </tr>
	  <tr>
	    <td align="right" class="tb_font_2">โรคร่วม HT :</td>
	    <td colspan="5" align="left" class="forntsarabun1"><input name="ht" type="radio" value="0" />
No
  <input name="ht" type="radio" value="1" />
Essential HT
<input name="ht" type="radio" value="3" />
Secondary HT 
<input name="ht" type="radio" value="2" />
Uncertain type</td>
	    </tr>
	  <tr>
	    <td align="right" class="forntsarabun1">&nbsp;</td>
	    <td colspan="5" align="left" class="forntsarabun1">การวินิจฉัยครั้งแรก ประมาณ พ.ศ.
          <input name="ht_d" type="text" class="forntsarabun1" id="ht_d" /></td>
	    </tr>
		  <tr>
           <td align="right"  class="tb_font_2">ประวัติบุหรี่ : </td>
		   <td colspan="5">
			<INPUT TYPE="radio" NAME="cigarette" value="0" <?php echo $cigarette0;?> >
			ไม่สูบบุหรี่&nbsp;&nbsp;&nbsp;
			<INPUT TYPE="radio" NAME="cigarette" value="1" <?php echo $cigarette1;?> >
			สูบบุหรี่
			<input type="radio" name="cigarette" value="2" <?php echo $cigarette2;?> />
			NA</td>
          </tr>
	</TABLE>
    <hr />
    <script>
	function calbmi(a,b){
		//alert(a);
		var h=a/100;
		var bmi=b/(h*h);
		document.F1.bmi.value=bmi.toFixed(2);
	}
	</script>
     <? 
		 $ht = $height/100;
		 $bmi=number_format($weight /($ht*$ht),2);
		 ?>
	<table border="0" class="forntsarabun1">
    <TR>
		<TD align="left" bgcolor="#0000CC" class="forntsarabun" colspan="10">การตรวจร่างกาย</TD>
	</TR>
	  <tr>
	    <td width="70" align="right" class="tb_font_2">ส่วนสูง : </td>
	    <td><input name="height" type="text" class="forntsarabun1" value="<?php echo $height; ?>" size="1" maxlength="5" onBlur="calbmi(this.value,document.F1.weight.value)"/>
	      ซม.</td>
	    <td width="70" align="right" class="tb_font_2">น้ำหนัก : </td>
	    <td ><input name="weight" type="text" class="forntsarabun1" value="<?php echo $weight; ?>" size="1" maxlength="5" onBlur="calbmi(document.F1.height.value,this.value)"/>
	      กก. </td>
	    <td width="70" align="right" class="tb_font_2">รอบเอว : </td>
	    <td><input name="round" type="text" class="forntsarabun1" id="round" value="<?php echo $arr_dxofyear["round_"]; ?>" size="1" maxlength="5" />
	      ซม.</td>
	    <td>&nbsp;</td>
	    <td colspan="3">&nbsp;</td>
	    </tr>
	  <tr>
	    <td align="right" class="tb_font_2">T : </td>
	    <td><input name="temperature" type="text" size="1" maxlength="5" value="<?php echo $arr_opd["temperature"]; ?>"  class="forntsarabun1"/>
C&deg;</td>
	    <td align="right" class="tb_font_2">P : </td>
	    <td ><input name="pause" type="text" size="1" maxlength="3" value="<?php echo $arr_opd["pause"]; ?>" class="forntsarabun1"/>
ครั้ง/นาที</td>
	    <td align="right" class="tb_font_2">R :</td>
	    <td><input name="rate" type="text" size="1" maxlength="3" value="<?php echo $arr_opd["rate"]; ?>"  class="forntsarabun1"/>
	      ครั้ง/นาที</td>
	    <td align="right" class="tb_font_2">BMI : </td>
       
	    <td><input name="bmi" type="text" size="3" value="<?php echo $bmi; ?>"class="forntsarabun1" /></td>
	    <td align="right" class="tb_font_2">BP : </td>
	    <td><input name="bp1" type="text" size="1" maxlength="3" value="<?php echo $arr_opd["bp1"]; ?>"class="forntsarabun1" />
	      /
	      <input name="bp2" type="text" size="1" maxlength="3" value="<?php echo $arr_opd["bp2"]; ?>"class="forntsarabun1" />
	      mmHg</td>
	    </tr>
	  <tr>
	    <td align="right" class="tb_font_2">BW :</td>
	    <td><input name="bw" type="text"class="forntsarabun1" id="bw" size="3" /></td>
	    <td colspan="2" align="right" class="tb_font_2">Retinal Exam:</td>
	    <td colspan="2" class="tb_font_2"><input name="retinal" type="text"class="forntsarabun1" id="retinal" size="10" /></td>
	    <td colspan="2" class="tb_font_2">Foot Exam:</td>
	    <td align="right" class="tb_font_2"><input name="foot" type="text"class="forntsarabun1" id="foot" size="10" /></td>
	    <td>&nbsp;</td>
	    </tr>
	  </table>
      <hr />

	<table  width="100%"border="0" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" >
 <tr>
	        <td align="left" bgcolor="#0000CC" class="forntsarabun">ผลการตรวจทางพยาธิ</td>
	        </tr>
   <?
   $year=date("Y");
   
      $laball="Select result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$arr_view["hn"]."' and  a.labname='Blood Sugar'  and b.orderdate like '$year%' Order by b.orderdate desc";
	  $result_laball=mysql_query($laball);
	  $rowall=mysql_num_rows($result_laball);
	  			
	?>
     <tr>
       <td class="forntsarabun1">
         
         <table border="0">
           <tr>
             <td colspan="3" ><div class="tb_font_2"><span class="tb_font">BS</span></div></td>
             </tr>
           <?  
		   $listbs = array();
		   $listbs1 = array();
		  
		   $i1=0;
		   if($rowall){
		   while($dall=mysql_fetch_array($result_laball)){
			   
			   $orderdate=explode(" ",$dall['orderdate']);
			   $orderdate=$orderdate[0];
			   
			   array_push($listbs,$dall[0]);
			   array_push($listbs1,$dall[2]);
			   ?>
           <tr>
             <td class="forntsarabun"><div class='tb_font_2'>
			 <?
			  echo $dall['result']; ?>   <?=$dall['unit'];?>  <?="วันที่  ".$dall['orderdate'];   if($orderdate==$datenow){ 
			  echo "   lab วันนี้";
			  
			  }
			  ?></div>
             </td>
             </tr>  
             <input type='hidden' name='bs'  value='<?=$listbs[0];?>'> 
             <input type='hidden' name='bs<?=$i1?>'  value='<?=$dall['result'];?>'>
             <input type='hidden' name='datebs<?=$i1?>'  value='<?=$dall['orderdate'];?>'>
             
      <?
	  $i1++;
	  }
	  }else{
	 echo "<tr><td><font class=\"tb_font_2\">ยังไม่เคยตรวจ</font></td></tr>";
	 }
	
   ?>
           
         </table>
         <hr />
         </td>
       </tr>
  <?
      $laball1="Select result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$arr_view["hn"]."' and  a.labname='HBA1C' and b.orderdate like '$year%' Order by b.orderdate desc";
	  $result_laball1=mysql_query($laball1);
	  $rowall1=mysql_num_rows($result_laball1);
	?>

 <tr>
   <td class="tb_font_2"><table border="0">
     <tr>
       <td colspan="3" ><div class="tb_font_2"><span class="font_title"><span class="tb_font">HbA1c</span></span></div></td>
       </tr>
     <?  
	 $listh1=array();
	 $listh2=array();
	 $i2=0;
	 if($rowall1){
	 while($dall1=mysql_fetch_array($result_laball1)){ 
	 
	 $orderdate1=explode(" ",$dall1['orderdate']);
	 $orderdate1=$orderdate1[0];
	 
	 array_push($listh1,$dall1[0]);
	 array_push($listh2,$dall1[2]);

	 ?>
     <tr>
       <td><div class="tb_font_2">
        <?
			  echo $dall1['result']; ?>  <?=$dall1['unit'];?>  <?="วันที่  ".$dall1['orderdate']; if($orderdate1==$datenow){ 
			  echo "   lab วันนี้";
			  
			  }
			  ?> </div>
              </td>
       </tr>
       <input type='hidden' name='hba'  value='<?=$listh1[0];?>'> 
       <input type='hidden' name='hba<?=$i2?>'  value='<?=$dall1['result'];?>'>
       <input type='hidden' name='datehba<?=$i2?>'  value='<?=$dall1['orderdate'];?>'>
     <?	
	 $i2++;  
	 	 }
	 }else{
	  echo "<tr><td><font class=\"forntsarabun1\">ยังไม่เคยตรวจ</font></td></tr>";
	 }
   ?>
   </table>
   <hr />
   </td>
   </tr>
   
     <?
      $laball2="Select  result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$arr_view["hn"]."' and  a.labname='LDL'  and b.orderdate like '$year%' Order by b.orderdate desc";
	  $result_laball2=mysql_query($laball2);
	  $rowall2=mysql_num_rows($result_laball2);
	  
	?>
 <tr>
   <td class="tb_font_2"><table border="0">
     <tr>
       <td colspan="3" ><div class="tb_font_2"><span class="tb_font">LDL</span></div></td>
       </tr>
     <?  
	 $listldl1=array();
	 $listldl2=array();
	 $i3=0;
	 if($rowall2){
	 while($dall2=mysql_fetch_array($result_laball2)){ 
	
				$orderdate2=explode(" ",$dall2['orderdate']);
			   $orderdate2=$orderdate2[0];
			   
			   array_push($listldl1,$dall2[0]);
			   array_push($listldl2,$dall2[2]);
			   
	 ?>
     <tr>
       <td><div class="tb_font_2">
       <?
           	echo $dall2['result']; ?>  <?=$dall2['unit'];?>  <?="วันที่  ".$dall2['orderdate']; if($orderdate2==$datenow){ 
			echo "   lab วันนี้";
		 }?>
         </div></td>
       </tr>
       <input type='hidden' name='ldl'  value='<?=$listldl1[0];?>'>
       <input type='hidden' name='ldl<?=$i3?>'  value='<?=$dall2['result'];?>'>
       <input type='hidden' name='dateldl<?=$i3?>'  value='<?=$dall2['orderdate'];?>'>
     <?	 
	 $i3++; 
	  }
	}else{
	 echo "<tr><td><font class=\"forntsarabun1\">ยังไม่เคยตรวจ</font></td></tr>";
	 }
   ?>
   </table>
   <hr />
   </td>
   </tr>
    <?
      $laball3="Select   result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$arr_view["hn"]."' and  a.labname='Creatinine' and b.orderdate like '$year%' Order by b.orderdate desc";
	  $result_laball3=mysql_query($laball3);
	  $rowall3=mysql_num_rows($result_laball3);
	?> 
   
 <tr>
   <td class="tb_font_2"><table border="0">
     <tr>
       <td colspan="3" ><div class="tb_font_2"><span class="tb_font">Creatinine</span></div></td>
       </tr>
     <?  
	 $listcr1=array();
	 $listcr2=array();
	 $i4=0;
	 if($rowall3){
		 while($dall3=mysql_fetch_array($result_laball3)){ 
	
			   $orderdate3=explode(" ",$dall3['orderdate']);
			   $orderdate3=$orderdate3[0];
			   
			   array_push($listcr1,$dall3[0]);
			   array_push($listcr2,$dall3[2]);

		 ?>
     <tr>
       <td><div class="tb_font_2">
        <?
           	echo $dall3['result']; ?>  <?=$dall3['unit'];?>  <?="วันที่  ".$dall3['orderdate']; if($orderdate3==$datenow){ 
			echo "   lab วันนี้";
		 }?>
         </div></td>
       </tr>
       <input type='hidden' name='cr'  value='<?=$listcr1[0];?>'>
       <input type='hidden' name='cr<?=$i4?>'  value='<?=$dall3['result'];?>'>
       <input type='hidden' name='datecr<?=$i4?>'  value='<?=$dall3['orderdate'];?>'>
     <?	
	 $i4++;  
	  }
	}else{
	  echo "<tr><td><font class=\"forntsarabun1\">ยังไม่เคยตรวจ</font></td></tr>";
	 }
   ?>
   </table>
   <hr />
   </td>
   </tr>
    <?
      $laball4="Select result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$arr_view["hn"]."' and  a.labname='Urine protein' and b.orderdate like '$year%' Order by b.orderdate desc";
	  $result_laball4=mysql_query($laball4);
	  $rowall4=mysql_num_rows($result_laball4);
	?>  
 <tr>
   <td class="tb_font_2"><table border="0">
     <tr>
       <td colspan="3" ><div class="tb_font_2"><span class="tb_font">Urine protein</span></div></td>
       </tr>
     <?  
	 $listur1=array();
	 $listur2=array();
	
	 $i5=0;
	 if($rowall4){
	 while($dall4=mysql_fetch_array($result_laball4)){ 
	
	 $orderdate4=explode(" ",$dall4['orderdate']);
	 $orderdate4=$orderdate4[0];
	 
	 array_push($listur1,$dall4[0]);
	  array_push($listur2,$dall4[2]);
	  
	 ?>
     <tr>
       <td><div class="tb_font_2">
         <?
           	echo $dall4['result']; ?>  <?=$dall4['unit'];?>  <?="วันที่  ".$dall4['orderdate']; if($orderdate4==$datenow){ 
			echo "   lab วันนี้";
		 }?>
         </div></td>
       </tr>
       <input type='hidden' name='ur'  value='<?=$listur1[0];?>'>
       <input type='hidden' name='ur<?=$i5?>'  value='<?=$dall4['result'];?>'>
       <input type='hidden' name='dateur<?=$i5?>'  value='<?=$dall4['orderdate'];?>' />
     <?
	 $i5++;	  
	  }
	}else{
	  echo "<tr><td><font class=\"forntsarabun1\">ยังไม่เคยตรวจ</font></td></tr>";
	 }
   ?>
   </table>
   <hr />
   </td>
   </tr>
   <?
      $laball5="Select result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$arr_view["hn"]."' and  a.labname='Urine Microalbumin'  and b.orderdate like '$year%' Order by b.orderdate desc";
	  $result_laball5=mysql_query($laball5);
	  $rowall5=mysql_num_rows($result_laball5);
	  
	?> 
   
 <tr>
   <td class="tb_font_2"><table border="0">
     <tr>
       <td colspan="3" ><div class="tb_font_2"><span class="tb_font">Microalbuminuria</span></div></td>
       </tr>
       
     <? 
	 $listm1=array();
	 $listm2=array();
	
	 $i6=0;
	 if($rowall5){
	 while($dall5=mysql_fetch_array($result_laball5)){

		 
	$orderdate5=explode(" ",$dall5['orderdate']);
	$orderdate5=$orderdate5[0]; 
	
	 array_push($listm1,$dall5[0]);
	  array_push($listm2,$dall5[2]);
	?>
     <tr>
       <td><div class="tb_font_2">
       <?
           	echo $dall5['result']; ?>  <?=$dall5['unit'];?>  <?="วันที่  ".$dall5['orderdate']; if($orderdate5==$datenow){ 
			echo "   lab วันนี้";
		 }?>
         </div></td>
       </tr>
       <input type='hidden' name='micro'  value='<?=$listm1[0];?>'>
       <input type='hidden' name='micro<?=$i6?>'  value='<?=$dall5['result'];?>'>
       <input type='hidden' name='datemicro<?=$i6?>'  value='<?=$dall5['orderdate'];?>' />
     <?	 
	 $i6++; 
	  }
	}else{
	 echo "<tr><td><font class=\"forntsarabun1\">ยังไม่เคยตรวจ</font></td></tr>";
	 }
   ?>
   </table>
   <hr />
   </td>
   </tr>
              </table>
	          <table width="100%" border="0">
	            <tr>
	              <td bgcolor="#0000CC" class="forntsarabun">การให้ความรู้ / คำแนะนำ</td>
                </tr>
	            <tr>
	              <td><table border="0" class="forntsarabun1">
	                <tr>
	                  <td class="tb_font_2">Foot care</td>
	                  <td><input type="radio" name="foot_care" id="radio" value="1" />
	                  ให้ความรู้
	                   
	                        <input type="radio" name="foot_care" id="radio" value="0" />
	                        ไม่ได้ให้ความรู้
					</td>
	                  </tr>
	                <tr>
	                  <td class="tb_font_2">Nutrition</td>
	                  <td><input type="radio" name="Nutrition" id="radio1" value="1" />
	                    ให้ความรู้
    <input type="radio" name="Nutrition" id="radio1" value="0" />
    ไม่ได้ให้ความรู้</td>
	                  </tr>
	                <tr>
	                  <td class="tb_font_2">Exercise</td>
	                  <td><input type="radio" name="Exercise" id="radio2" value="1" />
	                    ให้ความรู้
	                   
    <input type="radio" name="Exercise" id="radio2" value="0" />
    ไม่ได้ให้ความรู้</td>
	                  </tr>
	                <tr>
	                  <td class="tb_font_2">Smoking</td>
	                  <td><input type="radio" name="Smoking" id="radio3" value="1" />
	                    ให้ความรู้
    <input type="radio" name="Smoking" id="radio3" value="0" />
    ไม่ได้ให้ความรู้</td>
	                  </tr>
                  </table></td>
                </tr>
              </table>
	          <hr />
              
              <table class="forntsarabun1">
  <tr>
    <td>Admit ด้วยปัญหาเบาหวาน</td>
    <td><input type="radio" name="admit_dia" id="radio4" value="1" />
มี
    <input type="radio" name="admit_dia" id="radio4" value="0" />
    ไม่มี</td>
  </tr>
  <tr>
    <td>โรคแทรกซ้อนด้านหัวใจ</td>
    <td><input type="radio" name="dt_heart" id="radio5" value="1" />
มี
    <input type="radio" name="dt_heart" id="radio5" value="0" />
    ไม่มี</td>
  </tr>
  <tr>
    <td>โรคแทรกซ้อนด้านสมอง</td>
    <td><input type="radio" name="dt_brain" id="radio6" value="1" />
มี
    <input type="radio" name="dt_brain" id="radio6" value="0" />
    ไม่มี</td>
  </tr>
</table>

            </td>
	        </tr>
	      </table></td>
    </tr>
	  </table>
	<p>
    <input type='hidden' name='total1' value='<?=$i1?>'>
    <input type='hidden' name='total2' value='<?=$i2?>'>
    <input type='hidden' name='total3' value='<?=$i3?>'>
    <input type='hidden' name='total4' value='<?=$i4?>'>
    <input type='hidden' name='total5' value='<?=$i5?>'>
    <input type='hidden' name='total6' value='<?=$i6?>'>
	<input name="submit" type="submit" class="forntsarabun1" value="บันทึกข้อมูล"  />
	&nbsp;
   <!-- <input name="submit2" type="submit" class="forntsarabun1" value="ตกลง&amp;สติกเกอร์ OPD" />-->
    <input type="hidden" value="<?php echo $arr_dxofyear["row_id"];?>" name="row_id" />
    </p></TD>
	</TR>
	<TR>
		<TD></TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
<BR>&nbsp;
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
$register=date("Y-m-d H:i:s");

$select="select hn from diabetes_clinic Where hn ='".$_POST["hn"]."' ";
$q=mysql_query($select);
$rows=mysql_num_rows($q);

if($rows){
	
	print "hn ".$_POST["hn"]." มีข้อมูลแล้ว";
	print "<META HTTP-EQUIV='Refresh' CONTENT='2;URL=diabetes.php'>";
}
else
{

/* BS */
for($i1=0;$i1<$_POST["total1"];$i1++){
	
	if($_POST["total1"]!=0){
	
			$labname="BS";
			$strSQL1  = "INSERT INTO diabetes_lab ";
			$strSQL1 .="(dm_no,labname,dateY,result_lab) ";
			$strSQL1 .="VALUES ";
			$strSQL1 .="('".$_POST["dm_no"]."','".$labname."','".$_POST["datebs$i1"]."','".$_POST["bs$i1"]."')";
			$objQuery1 = mysql_query($strSQL1);
			
	//	    echo $strSQL1."<br>";		
}
 }

/* hba */
for($i2=0;$i2<$_POST["total2"];$i2++){
	
	if($_POST["total2"]!=0){
		
			$labname="HbA1c";
			$strSQL2  = "INSERT INTO diabetes_lab ";
			$strSQL2 .="(dm_no,labname,dateY,result_lab) ";
			$strSQL2 .="VALUES ";
			$strSQL2 .="('".$_POST["dm_no"]."','".$labname."','".$_POST["datehba$i2"]."','".$_POST["hba$i2"]."')";
			$objQuery2 = mysql_query($strSQL2);
			
		//    echo $strSQL2."<br>";	
	}
}
/* ldl */
for($i3=0;$i3<$_POST["total3"];$i3++){
	
if($_POST["total3"]!=0){
		
			$labname="LDL";
			$strSQL3  = "INSERT INTO diabetes_lab ";
			$strSQL3 .="(dm_no,labname,dateY,result_lab) ";
			$strSQL3 .="VALUES ";
			$strSQL3 .="('".$_POST["dm_no"]."','".$labname."','".$_POST["dateldl$i3"]."','".$_POST["ldl$i3"]."')";
			$objQuery3 = mysql_query($strSQL3);
			
		  //  echo $strSQL3."<br>";		
}
 }
/* cr */
for($i4=0;$i4<$_POST["total4"];$i4++){
	
	if($_POST["total4"]!=0){
	
			$labname="Creatinine";
			$strSQL4  = "INSERT INTO diabetes_lab ";
			$strSQL4 .="(dm_no,labname,dateY,result_lab) ";
			$strSQL4 .="VALUES ";
			$strSQL4 .="('".$_POST["dm_no"]."','".$labname."','".$_POST["datecr$i4"]."','".$_POST["cr$i4"]."')";
			$objQuery4 = mysql_query($strSQL4);
			
		//    echo $strSQL4."<br>";		
}
 }
/* ur */
for($i5=0;$i5<$_POST["total5"];$i5++){
	
	if($_POST["total5"]!=0){
		
			$labname="Urine protein";
			$strSQL5  = "INSERT INTO diabetes_lab ";
			$strSQL5 .="(dm_no,labname,dateY,result_lab) ";
			$strSQL5 .="VALUES ";
			$strSQL5 .="('".$_POST["dm_no"]."','".$labname."','".$_POST["dateur$i5"]."','".$_POST["ur$i5"]."')";
			$objQuery5 = mysql_query($strSQL5);
			
		//    echo $strSQL5."<br>";	
	}
}
/* ur */
for($i6=0;$i6<$_POST["total6"];$i6++){
	
	if($_POST["total6"]!=0){
		
			$labname="Urine Microalbumin";
			$strSQL6  = "INSERT INTO diabetes_lab ";
			$strSQL6 .="(dm_no,labname,dateY,result_lab) ";
			$strSQL6 .="VALUES ";
			$strSQL6 .="('".$_POST["dm_no"]."','".$labname."','".$_POST["datemicro$i6"]."','".$_POST["micro$i6"]."')";
			$objQuery6 = mysql_query($strSQL6);
			
		  //  echo $strSQL6."<br>";		
	}
}
	 	 
$strSQL = "INSERT INTO diabetes_clinic ";
$strSQL .="(dm_no,thidate,dateN,hn,doctor,ptname,ptright,dbbirt,sex,diagnosis,diagdetail,ht,htdetail,smork,bw,bmi,retinal,foot ,l_bs,l_hbalc,l_ldl,l_creatinine,l_urine,l_microal,foot_care,nutrition,exercise,smoking,admit_dia,dt_heart,dt_brain,height,weight,round,temperature,pause,rate,bp1,bp2,officer,register_date) ";
$strSQL .="VALUES ";
$strSQL .="('".$_POST["dm_no"]."','".$_POST["thaidate"]."','".$dateN."','".$_POST["hn"]."','".$_POST["doctor"]."','".$_POST["ptname"]."','".$_POST["ptright"]."','".$_POST["dbirth"]."','".$_POST["sex"]."','".$_POST["dia1"]."','".$_POST["nosis_d"]."','".$_POST["ht"]."','".$_POST["ht_d"]."','".$_POST["cigarette"]."','".$_POST["bw"]."','".$_POST["bmi"]."','".$_POST["retinal"]."','".$_POST["foot"]."','".$_POST["bs"]."','".$_POST["hba"]."','".$_POST["ldl"]."','".$_POST["cr"]."','".$_POST["ur"]."','".$_POST["micro"]."','".$_POST["foot_care"]."','".$_POST["Nutrition"]."','".$_POST["Exercise"]."','".$_POST["Smoking"]."','".$_POST["admit_dia"]."','".$_POST["dt_heart"]."','".$_POST["dt_brain"]."','".$_POST["height"]."','".$_POST["weight"]."','".$_POST["round"]."','".$_POST["temperature"]."','".$_POST["pause"]."','".$_POST["rate"]."','".$_POST["bp1"]."','".$_POST["bp2"]."','".$sOfficer."','".$register."')";
$objQuery = mysql_query($strSQL);
if($objQuery)
{
	echo "<br><font class='forntsarabun1'>บันทึกข้อมูลเรียบร้อยแล้ว</font>";
	print "<META HTTP-EQUIV='Refresh' CONTENT='2;URL=diabetes.php'>";
}
else
{
	echo "<br><font class='forntsarabun1'>ไม่สามารถบันทึกได้ [".$strSQL."]</font>";
print "<META HTTP-EQUIV='Refresh' CONTENT='2;URL=diabetes.php'>";
}

	 
include("../unconnect.inc");	 
 }
 }
}

 ?>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>