<?php
session_start();
include("../connect.inc");

$date_now = date("Y-m-d H:i:s");


function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style>
	.font_title{font-family:"TH SarabunPSK"; font-size:36px}
	.tb_font{font-family:"TH SarabunPSK"; font-size:24px;}
	.tb_font_1{font-family:"TH SarabunPSK"; font-size:24px; color:#FFFFFF; font-weight:bold;}
	.tb_col{font-family:"TH SarabunPSK"; font-size:24px; background-color:#9FFF9F}

.tb_font_2 {
	font-family: "TH SarabunPSK";
	color: #B00000;
	font-size: 22px;
	font-weight: bold;
}
.style5 {color: #000099; font-weight: bold; }
</style>
<style type="text/css">
<!--
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

<body>
<a href ="../../nindex.htm"  class="forntsarabun1"><----- เมนู</a>
<center>
  <div class="font_title" align="left">คลินิคเบาหวาน</div></center>

<form action="" method="post">
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" >
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0">
	<TR>
		<TD align="center" bgcolor="#0000CC" class="forntsarabun">กรอกหมายเลข HN</TD>
	</TR>
	<TR>
		<TD class="tb_font"><input name="p_hn" type="text" class="forntsarabun1"  value="<?php echo $_POST["p_hn"]?>"/>&nbsp;<input name="Submit" type="submit" class="forntsarabun1" value="ตกลง" /></TD>
	</TR>
	<TR>
		<TD></TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
</form>

<?php if(!empty($_POST["p_hn"]) != ""){

//ค้นหา hn จาก opday ****************************************************************************************
	$sql = "Select *, concat(yot,' ',name,' ',surname) as ptname From opcard where  hn = '".$_POST["p_hn"]."' limit 0,1";
	//echo $sql;
	$result = mysql_query($sql) or die("Error line 117 \n <!-- ".$sql." --> \n <!-- ".mysql_error()." -->");
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
	
//ค้นหาข้อมูลเดิม
	
	$times = mktime(0,0,0,date("m"),date("d")-3,date("Y"));
	$date_after= date("Y-m-d H:i:s",$times);
	$sql = "Select * From  `dxofyear` where `thdatehn` > '{$date_after}' AND hn='".$arr_view["hn"]."' limit 0,1 ";
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
	 
	 $sqltemp="CREATE TEMPORARY TABLE  lab1  Select * from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND a.authorisedate LIKE  '$datenow%' AND b.hn='".$arr_view["hn"]."' ";
	 $querytemp= mysql_query($sqltemp); 
	 
	  $sqllab1="Select * from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.orderdate LIKE  '$datenow%' AND b.hn='".$arr_view["hn"]."' and  a.labname='Blood Sugar' ";
	  $result_lab1=mysql_query($sqllab1);
	  $dbarrlab1=mysql_fetch_array($result_lab1);
	  
	  echo $sqllab1;
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

	  $sqlla6="Select * from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.orderdate LIKE  '$datenow%' AND b.hn='".$arr_view["hn"]."' and  a.labname='Urine Microalbumin' ";
	  $result_lab6=mysql_query($sqllab6);
	  $dbarrlab6=mysql_fetch_array($result_lab6);
?>

<!-- ข้อมูลเบื้องต้นของผู้ป่วย -->
<FORM METHOD="post" ACTION="?do=save">

<input name="age" type="hidden" id="age"  value="<?php echo $arr_view["age"];?>" />
<input name="hn" type="hidden" id="hn"  value="<?php echo $arr_view["hn"];?>" />

<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" >
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0">
	<TR>
		<TD align="left" bgcolor="#0000CC" class="tb_font_1">&nbsp;<span class="forntsarabun">&nbsp;&nbsp;ข้อมูลผู้ป่วย</span></TD>
	</TR>
	<TR>
		<TD>
	<table border="0"  class="forntsarabun1">
		<tr>
		  <td align="right" class="tb_font_2">DM number :</td>
		  <td><span class="data_show">
		    <input name="dm_no" type="text" class="forntsarabun1" id="dm_no" />
		  </span></td>
		  <td align="right"><span class="tb_font_2">HN :</span></td>
		  <td align="left"><?php echo $arr_view["hn"];?>
		    <input name="hn" type="hidden" id="hn" value="<?php echo $arr_view["hn"];?>"/></td>
		  </tr>
		<tr>
		  <td  align="right"><span class="tb_font_2">ชื่อ-สกุล : </span></td>
		  <td><?php echo $arr_view["ptname"];?><input name="ptname" type="hidden" id="ptname" value="<?php echo $arr_view["ptname"];?>"/></td>
		  <td  align="right" class="tb_font_2">อายุ :</td>
		  <td align="left"><?php echo $arr_view["age"];?><input name="dbirth" type="hidden" id="dbirth" value="<?php echo $arr_view["dbirth"];?>"/> </td>
		  </tr>
		<tr>
		  <td  align="right" class="tb_font_2">เพศ :</td>
		  <td><span class="data_show">
          <? if($arr_view['sex']=='ช'){ $sex1="checked"; }elseif($arr_view['sex']=='ญ'){ $sex2="checked"; } ?>
		    <input name="sex" type="radio" value="0" <?=$sex1;?>/>
		    ชาย
		    <input name="sex" type="radio" value="1" <?=$sex2;?>/> 
		    หญิง
</span></td>
		  <td  align="right" class="tb_font_2">&nbsp;</td>
		  <td align="left">&nbsp;</td>
		  </tr>
		<tr>
		  <td align="right" class="tb_font_2">แพทย์ :</td>
		  <td><select name="doctor" id="doctor" class="forntsarabun1">
            <?php 
	//	echo "<option value='' >-- กรุณาเลือกแพทย์ --</option>";
		//echo "<option value='ห้องตรวจโรคทั่วไป' >ห้องตรวจโรคทั่วไป</option>";
		$sql = "Select name From doctor where status = 'y' ";
		$result = mysql_query($sql);
		while($dbarr2= mysql_fetch_array($result)){
			
			$sub1=substr($arr_view['doctor'],0,5);
			$sub2=substr($dbarr2['name'],0,5);
			
		
			if($dbarr2['name']==$arr_view['doctor']){
				echo $arr_view['doctor'];
				
			echo "<option value='".$dbarr2['name']."'  selected>".$dbarr2['name']."</option>";	
			}else{
			echo "<option value='".$dbarr2['name']."' >".$dbarr2['name']."</option>";
			}
		}
		?>
            </select> </td>
		  <td align="right" class="tb_font_2">สิทธิ :</td>
		  <td align="left"><?php echo $arr_view["ptright"];?><input name="ptright" type="hidden" id="ptright" value="<?php echo $arr_view["ptright"];?>"/> </td>
		  </tr>
	</table>
	<hr />
	<TABLE class="forntsarabun1">
	  <tr>
           <td align="right" class="tb_font_2">การวินิจฉัย : </td>
           <td colspan="5" align="left" class="data_show"><input name="dia1" type="radio" value="0" />
           DM type1
             <input name="dia1" type="radio" value="1" />
             DM type1 
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
	    <td><input name="height" type="text" class="forntsarabun1" value="<?php echo $height; ?>" size="1" maxlength="3" />
	      ซม.</td>
	    <td width="70" align="right" class="tb_font_2">น้ำหนัก : </td>
	    <td ><input name="weight" type="text" class="forntsarabun1" value="<?php echo $weight; ?>" size="1" maxlength="3" />
	      กก. </td>
	    <td width="70" align="right" class="tb_font_2">รอบเอว : </td>
	    <td><input name="round" type="text" class="forntsarabun1" id="round" value="<?php echo $arr_dxofyear["round_"]; ?>" size="1" maxlength="3" />
	      ซม.</td>
	    <td>&nbsp;</td>
	    <td colspan="3">&nbsp;</td>
	    </tr>
	  <tr>
	    <td align="right" class="tb_font_2">T : </td>
	    <td><input name="temperature" type="text" size="1" maxlength="5" value="<?php echo $arr_dxofyear["temperature"]; ?>"  class="forntsarabun1"/>
C&deg;</td>
	    <td align="right" class="tb_font_2">P : </td>
	    <td ><input name="pause" type="text" size="1" maxlength="3" value="<?php echo $arr_dxofyear["pause"]; ?>" class="forntsarabun1"/>
ครั้ง/นาที</td>
	    <td align="right" class="tb_font_2">R :</td>
	    <td><input name="rate" type="text" size="1" maxlength="3" value="<?php echo $arr_dxofyear["rate"]; ?>"  class="forntsarabun1"/>
	      ครั้ง/นาที</td>
	    <td align="right" class="tb_font_2">BMI : </td>
       
	    <td><input name="bmi" type="text" size="3" maxlength="3" value="<?php echo $bmi; ?>"class="forntsarabun1" /></td>
	    <td align="right" class="tb_font_2">BP : </td>
	    <td><input name="bp1" type="text" size="1" maxlength="3" value="<?php echo $arr_dxofyear["bp1"]; ?>"class="forntsarabun1" />
	      /
	      <input name="bp2" type="text" size="1" maxlength="3" value="<?php echo $arr_dxofyear["bp2"]; ?>"class="forntsarabun1" />
	      mmHg</td>
	    </tr>
	  <tr>
	    <td align="right" class="tb_font_2">BW :</td>
	    <td><input name="bw" type="text"class="forntsarabun1" id="bw" size="3" /></td>
	    <td align="right" class="tb_font_2">Retinal:</td>
	    <td ><input name="retinal" type="text"class="forntsarabun1" id="retinal" size="3" /></td>
	    <td colspan="2" align="right" class="tb_font_2">Foot Exam:</td>
	    <td colspan="2" class="tb_font_2"><input name="foot" type="text"class="forntsarabun1" id="foot" size="3" /></td>
	    <td align="right" class="tb_font_2">&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  </table>
      <hr />

	<table  width="100%"border="0" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" >
 <tr>
	        <td colspan="2" align="left" bgcolor="#0000CC" class="forntsarabun">ผลการตรวจทางพยาธิ</td>
	        </tr>
 <tr>
   <td width="21%"  align="right" class="tb_font_2">BS:</td>
   <td width="79%" align="left" class="forntsarabun"><span class="forntsarabun1">
     <input name="bs" type="text" class="forntsarabun1" id="bs" size="5"  value="<?=$dbarrlab1['result'];?>"/>
   </span></td>
 </tr>
 <tr>
   <td align="right" class="tb_font_2">HbA1c:</td>
   <td align="left" class="forntsarabun1">
     <input name="HbA1c" type="text" class="forntsarabun1" id="HbA1c" size="5" value="<?=$dbarrlab2['result'];?>"/>
     <span class="tb_font_2">% </span></td>
 </tr>
 <tr>
   <td align="right" class="tb_font_2">LDL:</td>
   <td align="left" class="forntsarabun"><span class="forntsarabun1">
     <input name="ldl" type="text" class="forntsarabun1" id="ldl" size="5" value="<?=$dbarrlab3['result'];?>"/>
     </span><span class="tb_font_2">mg% </span></td>
 </tr>
 <tr>
   <td align="right" class="tb_font_2">Creatinine:</td>
   <td align="left" class="forntsarabun"><span class="forntsarabun1">
     <input name="Creatinine" type="text" class="forntsarabun1" id="Creatinine" size="5" value="<?=$dbarrlab4['result'];?>"/>
     <span class="tb_font_2">mg%</span></span></td>
 </tr>
 <tr>
   <td align="right" class="tb_font_2">Urine protein:</td>
   <td align="left" class="forntsarabun"><span class="forntsarabun1">
     <input name="Urine" type="text" class="forntsarabun1" id="Urine" size="5" value="<?=$dbarrlab5['result'];?>"/>
   </span></td>
 </tr>
 <tr>
   <td align="right" class="tb_font_2">Microalbuminuria:</td>
   <td align="left" class="forntsarabun"><span class="forntsarabun1">
     <input name="Micro" type="text" class="forntsarabun1" id="Micro" size="5" value="<?=$dbarrlab6['result'];?>" />
     </span><span class="tb_font_2">mg/L </span></td>
 </tr>
              </table>
	          <hr />
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

include("../unconnect.inc");
 ?>
 
 <?
 if($_REQUEST['do']=='save'){
 if($_POST['submit']=='บันทึกข้อมูล'){
	 
include("../connect.inc");	 

$dateN=date("Y-m-d");
	 	 
$strSQL = "INSERT INTO diabetes_clinic ";
$strSQL .="(dm_no,dateN,hn,doctor,ptname,ptright,dbbirt,sex,diagnosis,diagdetail,ht,htdetail,smork,bw,bmi,retinal,foot ,l_bs,l_hbalc,l_ldl,l_creatinine,l_urine,l_microal,foot_care,nutrition,exercise,smoking,admit_dia,dt_heart,dt_brain,height,weight,round,temperature,pause,rate,bp1,bp2) ";
$strSQL .="VALUES ";
$strSQL .="('".$_POST["dm_no"]."','".$dateN."','".$_POST["hn"]."','".$_POST["doctor"]."','".$_POST["ptname"]."','".$_POST["ptright"]."','".$_POST["dbirth"]."','".$_POST["sex"]."','".$_POST["dia1"]."','".$_POST["nosis_d"]."','".$_POST["ht"]."','".$_POST["ht_d"]."','".$_POST["cigarette"]."','".$_POST["bw"]."','".$_POST["bmi"]."','".$_POST["retinal"]."','".$_POST["foot"]."','".$_POST["bs"]."','".$_POST["HbA1c"]."','".$_POST["ldl"]."','".$_POST["Creatinine"]."','".$_POST["Urine"]."','".$_POST["Micro"]."','".$_POST["foot_care"]."','".$_POST["Nutrition"]."','".$_POST["Exercise"]."','".$_POST["Smoking"]."','".$_POST["admit_dia"]."','".$_POST["dt_heart"]."','".$_POST["dt_brain"]."','".$_POST["height"]."','".$_POST["weight"]."','".$_POST["round"]."','".$_POST["temperature"]."','".$_POST["pause"]."','".$_POST["rate"]."','".$_POST["bp1"]."','".$_POST["bp2"]."')";
$objQuery = mysql_query($strSQL);
if($objQuery)
{
	echo "Save Done.";
}
else
{
	echo "Error Save [".$strSQL."]";
}

	 
include("../unconnect.inc");	 
 }
 }
 ?>
</body>


</html>
