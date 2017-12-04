<?php
session_start();
$date_now = date("Y-m-d");
include("connect.php");

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
<title></title>
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
</head>

<body></center>

<form action="" method="post">
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" >
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0">
	<TR>
		<TD align="center" bgcolor="#0000CC" class="forntsarabun">กรอกหมายเลข เลขบัตรประชาชน</TD>
	</TR>
	<TR>
		<TD class="tb_font"><input name="idcard" type="text" class="forntsarabun1"  value="<?php echo $_POST["idcard "];?>"/>&nbsp;<input name="Submit" type="submit" class="forntsarabun1" value="ตกลง" /></TD>
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

$hn=trim($_POST["idcard"]);
if(!empty($_POST["idcard"]) != ""){
	
	  $sqldm="select * from opcard where idcard ='$idcard' ";
	  $querydm=mysql_query($sqldm);
	  $row=mysql_num_rows($querydm);
	  
	  if(!$row){
		  
		  print "<br> <font class='forntsarabun1'>ไม่พบ  เลขบัตรประชาชน  <b>$hn</b>  ในระบบทะเบียน </font>";
		  
	  }else{
	
	
//ค้นหา hn จาก opday ****************************************************************************************
	$sql = "Select *, concat(yot,' ',name,' ',surname) as ptname From opcard where  idcard  = '".$_POST["idcard"]."' limit 0,1";
	//echo $sql;
	$result = mysql_query($sql) or die("".mysql_error()." -->");
	/*if(mysql_num_rows($result) <= 0){
		echo "<CENTER>ผู้ป่วยยังไม่ได้ทำการลงทะเบียน</CENTER>";
		exit();
	}*/
	$arr_view = mysql_fetch_assoc($result);

$sql = "Select vn From opday where thidate like '".$thaidate."%' and hn = '".$arr_view["hn"]."' limit 0,1";
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
	
	
	//thidate  like '$date1%' AND
	$opd = "Select * From  opd where  hn='".$arr_view["hn"]."' order by thidate desc limit 0,1 ";
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
  
	/*  $sqldm="select max(dm_no)as dmnumber from diabetes_clinic";
	  $querydm=mysql_query($sqldm);
	  $arrdm=mysql_fetch_array($querydm);
	  $dm=$arrdm['dmnumber']+1;
	  $dm_no=$dm;
	  */
	 
?>

<!-- ข้อมูลเบื้องต้นของผู้ป่วย -->
<FORM METHOD="post" ACTION="" name="F1">

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
		  <td align="right" class="tb_font_2">HN :</td>
		  <td><span class="forntsarabun1"><?php echo $arr_view["hn"];?>
		    <input name="hn2" type="hidden" id="hn2" value="<?php echo $arr_view["hn"];?>"/>
		  </span></td>
		  <td align="right">&nbsp;</td>
		  <td align="left" class="forntsarabun1">&nbsp;</td>
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
			
			$sub1=substr($arr_opd['doctor'],0,5);
			$sub2=substr($dbarr2['name'],0,5);
			
		
			if($dbarr2['name']==$arr_opd['doctor']){
			
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
	    <td><input name="height" type="text" class="forntsarabun1" value="<?php echo $height; ?>" size="1" maxlength="3" onBlur="calbmi(this.value,document.F1.weight.value)"/>
	      ซม.</td>
	    <td width="70" align="right" class="tb_font_2">น้ำหนัก : </td>
	    <td ><input name="weight" type="text" class="forntsarabun1" value="<?php echo $weight; ?>" size="1" maxlength="3" onBlur="calbmi(document.F1.height.value,this.value)"/>
	      กก. </td>
	    <td width="70" align="right" class="tb_font_2">รอบเอว : </td>
	    <td><input name="round" type="text" class="forntsarabun1" id="round" value="<?php echo $arr_dxofyear["round_"]; ?>" size="1" maxlength="3" />
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
       
	    <td><input name="bmi" type="text" size="3" maxlength="3" value="<?php echo $bmi; ?>"class="forntsarabun1" /></td>
	    <td align="right" class="tb_font_2">BP : </td>
	    <td><input name="bp1" type="text" size="1" maxlength="3" value="<?php echo $arr_opd["bp1"]; ?>"class="forntsarabun1" />
	      /
	      <input name="bp2" type="text" size="1" maxlength="3" value="<?php echo $arr_opd["bp2"]; ?>"class="forntsarabun1" />
	      mmHg</td>
	    </tr>
	  <tr>
	    <td align="right" class="tb_font_2">บุหรี่ : </td>
	    <td colspan="9"><INPUT TYPE="radio" NAME="cigarette" value="1" <?php echo $cigarette1;?> >สูบ&nbsp;&nbsp;&nbsp;
			<INPUT TYPE="radio" NAME="cigarette" value="0" <?php echo $cigarette0;?>
			>ไม่สูบ&nbsp;&nbsp;&nbsp;
			<INPUT TYPE="radio" NAME="cigarette" value="2" <?php echo $cigarette2;?>
			>เคยสูบ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="tb_font_2">สุรา :</span>
			<INPUT TYPE="radio" NAME="alcohol" value="1" <?php echo $alcohol1;?> >
			ดื่ม&nbsp;&nbsp;&nbsp;<INPUT TYPE="radio" NAME="alcohol" value="0" <?php echo $alcohol0;?> >ไม่ดื่ม&nbsp;&nbsp;&nbsp;<INPUT TYPE="radio" NAME="alcohol" value="2" <?php echo $alcohol2;?> >เคยดื่ม</td>
	    </tr>
	  </table>
      <hr /></td>
	        </tr>
	      </table></td>
    </tr>
	  </table>
	<p>
   
	<!--<input name="submit" type="submit" class="forntsarabun1" value="บันทึกข้อมูล"  />-->
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
include("unconnect.inc");
 ?>

</body>


</html>
