<?
session_start();
include("connect.inc");
$gethn = $_GET["hn"]; 
$getan = $_GET["an"];
$getid = $_GET["row_id"];  
$getdrugcode = $_GET["drugcode"];
$getact = $_GET["act"];
$drugcode = ereg_replace('[[:space:]]+', ' ', trim($_GET["drugcode"]));
	$sql2 = "SELECT drugcode, tradname, detail From drughad where drugcode = '$drugcode'";
	//echo $sql2;
	$query2 = mysql_query($sql2);
	$rowshad = mysql_num_rows($query2);
	$result2 = mysql_fetch_array($query2);
	if($rowshad > 0){ 
?>
	<script>window.open('ipd_drugorder_had.php?an=<?=$getan;?>&hn=<?=$gethn;?>&drugcode=<?=$drugcode;?>','mywin','width=1100,height=800');</script>
<?	
	}
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>ระบบบันทึกการจ่ายยาผู้ป่วยใน</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="">

<style type="text/css">
body{ 
	font-family: 'TH SarabunPSK';
	background-color:#e1f5fe;
	font-size: 28px;
 }	
.sarabun {	font-family: TH SarabunPSK;
	font-size: 28px;
} 
@media print{
	#no-print{ display: none; }
	#sticker-contain{ padding: 0; }
}
a:link, a:visited {
  background-color: white;
  color: black;
  border: 2px solid #2980B9;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-weight:bold;
}

a:hover, a:active {
  background-color: #2980B9;
  color: white;
}
</style>
<script language="javascript">
////// เช็คค่าว่าง
function checkForm(){
	
	if(document.form2.nurse2.value == 0){
		alert('กรุณาเลือกพยาบาลคนที่ 2 ด้วยครับ');
		return false;
	}else if(document.form2.ranktime.value == 0){
		alert('กรุณาเลือกช่วงเวลาที่ให้ยาด้วยครับ');
		return false;
	}else{
		return true;
	}
}
</script>
<body>
<?
if($_POST["act"]=="add"){
	$date=(date("Y")+543)."-".date("m-d");
	$an=$_POST["an"];
	$hn=$_POST["hn"];
	$getact = $_POST["getact"];
	$add="insert into dgprofile_mar set date='".$date."',
										an='".$_POST["an"]."',
										drugcode='".$_POST["drugcode"]."',
										tradname='".$_POST["tradname"]."',
										slcode='".$_POST["slcode"]."',
										idno='".$_POST["idno"]."',
										nurse1='".$_POST["nurse1"]."',
										nurse2='".$_POST["nurse2"]."',
										ranktime='".$_POST["ranktime"]."',
										register_time='".$_POST["register_time"]."',
										comment='".$_POST["comment"]."',
										lastupdate='".date("Y-m-d H:i:s")."'";
	if($query=mysql_query($add)){
		echo "<script>alert('บันทึกการให้ยาผู้ป่วย AN:$an ในระบบเรียบร้อย');window.location='med_record_print_2023.php?act=$getact&an=$an&hn=$hn';</script>";
	}else{
		echo "<script>alert('ผิดพลาด ไม่สามารถบันทึกการให้ยาผู้ป่วย AN:$an ในระบบได้');window.location='ipd_drugorder_form.php?an=$an&hn=$hn';</script>";
	}		
}else{	
?>
<?
$sql1 = "SELECT an,hn,ptname,ptright,bedcode,diag,doctor,my_ward,adm_w FROM ipcard  WHERE `an` = '".$getan."' and dcdate ='0000-00-00 00:00:00' limit 1 ";
//echo $sql1;
$result1 = mysql_query($sql1);
$num=mysql_num_rows($result1);
	if($num < 1){
		echo "<script>alert('ไม่พบข้อมูลผู้ป่วย AN:$an ในระบบผู้ป่วยใน  กรุณาตรวจสอบข้อมูลใหม่อีกครั้ง');</script>";
	}else{	
	list($an,$hn,$ptname,$ptright,$bedcode,$diag,$doctor,$my_ward,$adm_w) = Mysql_fetch_row($result1);

	$query = "SELECT idcard,bed,date,date_format(date,'%d-%m-%Y'),diagnos,food,price,paid,debt,caldate,bedname,chgdate,status,age,diag1,days FROM bed WHERE an = '$an' ORDER BY bedcode ASC ";
	//echo $query;
	$result = mysql_query($query)or die("Query failed");
	list ($idcard,$bed,$date1,$date,$diagnos,$food,$price,$paid,$debt,$caldate,$bedname,$chgdate,$status,$age,$diag1,$daysall) = mysql_fetch_row ($result);
	
	$subbedcode=substr($bedcode,0,2);
	$str = "month=".date('m')."&year=".(date('Y')+543)."&date=".date('dmy');
	
	//////// แพ้ยา ////////
	$list1 = array();
	$sql = "Select  tradname,advreact,sideeffects From drugreact  where hn = '".$hn."' and advreact !=''";
	$result = Mysql_Query($sql);
	$drugreact_rows = mysql_num_rows($result);
	if($drugreact_rows>0){
		while($arr = Mysql_fetch_assoc($result)){
			array_push($list1 ,$arr["tradname"]);
		}
		$list_drug1 = implode(", ",$list1);
		$drugreact_disease .= $list_drug1;
	}else{
		$drugreact_disease ="ปฎิเสธการแพ้ยา";
	}


	$sql3 = "Select drugcode,tradname,slcode,statcon From dgprofile where row_id = '$getid'";
	//echo $sql3;
	$query3 = mysql_query($sql3);
	$result3 = mysql_fetch_array($query3);
	$dgprofile_rows = mysql_num_rows($result3);
	if($dgprofile_rows < 1){
		
	}	
	$drugcode=$result3["drugcode"];
	$tradname=$result3["tradname"];
	$slcode=$result3["slcode"];
	$statcon=$result3["statcon"];
	
	$sql4 = "SELECT slcode,detail1,detail2,detail3,detail4 FROM drugslip WHERE slcode = '$slcode' ";
	$query4 = mysql_query($sql4);
	$result4 = mysql_fetch_array($query4);
	$textslcode=$result4["detail1"]." ".$result4["detail2"]." ".$result4["detail3"]." ".$result4["detail4"];
		
?>
<div style='margin-top:50px;'>
<FORM name="form2" METHOD="POST" ACTION="ipd_drugorder_form.php" Onsubmit="return checkForm();">
<input type="hidden" name="act" id="act" value="add">
<input type="hidden" name="idno" id="idno" value="<?=$getid;?>">
<input type="hidden" name="an" id="an" value="<?=$getan;?>">
<input type="hidden" name="hn" id="hn" value="<?=$gethn;?>">
<input type="hidden" name="getact" id="getact" value="<?=$getact;?>">
<input type="hidden" name="drugcode" id="drugcode" value="<?=$drugcode;?>">
<input type="hidden" name="tradname" id="tradname" value="<?=$tradname;?>">
<input type="hidden" name="slcode" id="slcode" value="<?=$slcode;?>">
<input type="hidden" name="nurse1" id="nurse1" value="<?=$sOfficer;?>">
<input type="hidden" name="register_time" id="register_time" value="<?=date("H:i:s");?>">
<TABLE bgcolor="#e0f2f1" width="80%" align="center" border="3" bordercolor="#009688" cellpadding="5" cellspacing="5" >
<TR>
	<TD>
<TABLE width="100%" cellpadding="3" cellspacing="3" style="font-size: 28px;">
<TR class="tb_head">
	<TD colspan="4" align="center"><strong>บันทึกการจ่ายยาให้ผู้ป่วย</strong></TD>
</TR>
<TR>
	<TD width="20%" align="right">วันที่รับป่วย : </TD>
	<TD ><?php echo $date." ".substr($date1,11);?></TD>
	<TD width="20%"align="right">AN : </TD>
	<TD><strong><?php echo $an;?></strong><span style="margin-left:20px;">HN : <?php echo $hn;?></span></TD>	
</TR>
<TR>
	<TD align="right">ชื่อ - สกุล : </TD>
	<TD><?php echo $ptname;?></TD>
	<TD align="right">อายุ : </TD>
	<TD><?php echo $age;?></TD>	
</TR>
<TR>
	<TD align="right">โรคประจำตัว : </TD>
	<TD><?php echo $diag1;?></TD>
	<TD align="right">แพ้ยา : </TD>
	<TD><?php echo $drugreact_disease;?></TD>	
</TR>
<TR>
	<TD align="right">สิทธิ : </TD>
	<TD><?php echo $ptright;?></TD>
	<TD align="right">หอผู้ป่วยรับ : </TD>
	<TD><?php echo $my_ward;?>	</TD>	
</TR>
<TR>
	<TD align="right">เตียง/ห้อง : </TD>
	<TD><?php echo $bedcode;?></TD>
	<TD align="right">อาหาร : </TD>
	<TD><?php echo $food;?></TD>	
</TR>
<TR>
	<TD align="right">โรค : </TD>
	<TD><?php echo $diag;?></TD>
	<TD align="right">แพทย์ : </TD>
	<TD><?php echo $doctor;?>	</TD>	
</TR>
<TR style="background-color:#EAFAF1;">
    <TD colspan="4" align="center">
	<hr style='border: 3px solid #009688; border-radius: 5px;'>
	<? if($rowshad > 0){ ?>
		<div align="center"><img src="images/warning.png" height="36px" width="36px"><span style='margin-left:10px;font-size:36px;color:red;font-weight:bold;'>ยาที่มีความเสี่ยงสูง (High Alert Drugs)</span></div>
	<? } ?>
	
<TABLE width="60%" cellpadding="3" cellspacing="3" style="font-size: 28px;">
<TR>
	<TD width="30%" align="right">รหัสยา : </TD>
	<TD ><?php echo $drugcode;?></TD>
</TR>
<TR>
	<TD width="30%" align="right">ชื่อยา : </TD>
	<TD ><?php echo $tradname;?></TD>
</TR>
<TR>
	<TD width="30%" align="right">วิธีใช้ยา : </TD>
	<TD ><?=$slcode." ($textslcode)";?></TD>
</TR>
<? if($rowshad > 0){ ?>
<TR>
	<TD width="30%" align="right">พยาบาลผู้ให้ยา 1 : </TD>
	<TD ><?php echo $sOfficer;?></TD>
</TR>
<TR>
	<TD width="30%" align="right">พยาบาลผู้ให้ยา 2 : </TD>
	<TD >
    <select name="nurse2" id="nurse2" class="sarabun" style="width:250px;">
	<option value="0">----- เลือกข้อมูล -----</option>	
	<?
	if($subbedcode=="42"){
		$where="menucode='ADMWF'";
	}else if($subbedcode=="43"){
		$where="menucode='ADMOBG'";
	}else if($subbedcode=="44"){
		$where="menucode='ADMICU'";
	}else if($subbedcode=="45"){
		$where="menucode='ADMVIP'";
	}

		$sql="select * from inputm where $where and status='Y'";
		$query = mysql_query($sql);
		while($result = mysql_fetch_array($query)){
		echo '<option value="'.$result['name'].'">'.$result['name'].' </option>';
		} 
	?>
	</select>	
	</TD>
</TR>
<? }else{ ?>
<TR>
	<TD width="30%" align="right">พยาบาลผู้ให้ยา: </TD>
	<TD ><?php echo $sOfficer;?></TD>
</TR>
<? } ?>
<TR>
	<TD width="30%" align="right">ช่วงเวลาที่ต้องให้ยา : </TD>
	<TD >
	<select name="ranktime" id="ranktime" class="sarabun" style="width:250px;">
      <option value="0" selected>----- เลือกข้อมูล -----</option>
      <option value="01:00">01.00 น.</option>
      <option value="02:00">02.00 น.</option>
      <option value="03:00">03.00 น.</option>
	  <option value="04:00">04.00 น.</option>
      <option value="05:00">05.00 น.</option>
      <option value="06:00">06.00 น.</option>
      <option value="07:00">07.00 น.</option>
      <option value="08:00">08.00 น.</option>
      <option value="09:00">09.00 น.</option>
      <option value="10:00">10.00 น.</option>
      <option value="11:00">11.00 น.</option>
      <option value="12:00">12.00 น.</option>
      <option value="13:00">13.00 น.</option>
      <option value="14:00">14.00 น.</option>
      <option value="15:00">15.00 น.</option>
      <option value="16:00">16.00 น.</option>
      <option value="17:00">17.00 น.</option>
      <option value="18:00">18.00 น.</option>
      <option value="19:00">19.00 น.</option>	  
      <option value="20:00">20.00 น.</option>
      <option value="21:00">21.00 น.</option>
      <option value="22:00">22.00 น.</option>
      <option value="23:00">23.00 น.</option>
      <option value="24:00">24.00 น.</option>	  
        </select>	
	</TD>
</TR>
<TR>
	<TD width="30%" align="right">วันที่่ให้ยา : </TD>
	<TD ><?=date("d/m/").(date("Y")+543);;?></TD>
</TR>
<TR>
	<TD width="30%" align="right">เวลาที่ให้ยา : </TD>
	<TD ><?=date("H:i:s");?></TD>
</TR>
<TR>
	<TD width="30%" align="right" valign="top">หมายเหตุ : </TD>
	<TD ><textarea id="comment" name="comment" rows="3" cols="50" class="sarabun"></textarea></TD>
</TR>
<TR>
	<TD width="30%" align="right"></TD>
	<TD ><input name="B1" type="submit" class="sarabun" value="    บันทึกข้อมูล    ">
&nbsp;&nbsp;&nbsp;&nbsp;<!--<input type="button" name="button" id="button" value="    ข้อมูลยาเพิ่มเติม    " onclick="window.open('ipd_drugorder_detail.php') " class="sarabun" />-->
	</TD>
</TR>



</TABLE>	
	<hr style='border: 3px solid #009688; border-radius: 5px;'>
	</TD>
</TR>
</TABLE>
<br>
</TD>
</TR>
</TABLE>
</FORM>
</div>
<? 
	}
}
?>	
</body>
</html>