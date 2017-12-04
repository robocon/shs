<?
session_start();
include("connect.inc");		
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.pdxhead {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
.style1 {
	font-size: 18px;
	font-weight: bold;
}
.pdx {	font-family: "TH SarabunPSK";
	font-size: 18px;
}
.pdxhead1 {	font-family: "TH SarabunPSK";
	font-size: 22px;
}
-->
</style>
<div align="center">
<form action="" method="post" name="f1">
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#66CC99">
  <tr><td width="480" align="center" bgcolor="#66CC99"><strong>กรอกข้อมูล HN </strong></td>
  </tr>
  <tr><td align="center"><span class="style1">HN:</span> 
    <input name="hn" type="text" size="20" class="pdxhead"  /> 
  &nbsp;&nbsp;
  <input type="submit"  value="   ตกลง   " name="okhn" class="pdxhead"/></td>
  </tr>
</table>
</form>
</div>
<? 
if(isset($_POST['hn'])){
	
	////*runno ตรวจสุขภาพ*/////////
	$query = "SELECT runno, prefix  FROM runno WHERE title = 'y_chekup'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nPrefix=$row->prefix;
	$nPrefix2="25".$nPrefix;
////*runno ตรวจสุขภาพ*/////////
				
$sql1="SELECT * ,concat(yot,name,' ',surname)as ptname,part FROM `opcardchk` WHERE hn='".$_POST['hn']."' ";	
$query=mysql_query($sql1) or die (mysql_error());
$Row=mysql_num_rows($query);
if($Row < 1){
$sql1="SELECT hn, concat(yot,name,' ',surname)as ptname, note as part FROM `opcard` WHERE hn='".$_POST['hn']."' ";	
$query=mysql_query($sql1) or die (mysql_error());
$Row=mysql_num_rows($query);	
}

if(!$Row){
	echo "<div align='center' class='fontsara' style='color:red;'><strong>!!! ไม่พบ HN  $_POST[Chkhn]!! </strong></div>";	
}else{	
		$arr=mysql_fetch_array($query);
		if(!empty($arr['HN'])){
			$chkhn=$arr['HN'];
		}else{
			$chkhn=$arr['hn'];
		}		
		$sqlchk="SELECT * FROM `out_result_chkup` WHERE hn='".$chkhn."' and year_chk ='$nPrefix' ";
		$querychk=mysql_query($sqlchk) or die (mysql_error());
		$Rowchk=mysql_num_rows($querychk);
		
		if($Rowchk>0){
			$arrchk=mysql_fetch_array($querychk);	
			$data1="update";
			$button="<input type='submit'  value='   แก้ไขข้อมูล   ' name='okhn2' class='pdxhead'/>";
		}else{
			$data1="insert";
			$button="<input type='submit'  value='   บันทึกข้อมูล   ' name='okhn2' class='pdxhead'/>";
		}
	
?>
<div align="center">
<form action="" method="post" name="f2">
 <table width="80%" border="1" cellpadding="0" cellspacing="0" bordercolor="#FF6666" bgcolor="#FFCCCC">
      <tr><td align="center">
      <table width="100%">
    <tr align="center">
      <td colspan="2" class="pdxpro"><strong>HN :</strong>        
        <?=$chkhn?>
               <strong>ชื่อ-สกุล :</strong>      <?=$arr['ptname']?>  &nbsp;&nbsp;<strong> หน่วย :</strong>    <?=$arr['part']?>      </td>
      </tr>
    <tr>
      <td colspan="2" align="center" class="pdx"><strong>น้ำหนัก :</strong>  
        <input name="weight" type="text" size="3" class="pdxhead1" value="<?=$arrchk['weight']?>" />
         กก. &nbsp;&nbsp;&nbsp;<strong>ส่วนสูง : </strong>
         <input name="height" type="text" size="3" class="pdxhead1"   value="<?=$arrchk['height']?>"  />          
         ซม. &nbsp;&nbsp;&nbsp;<strong>BP :</strong>
          <input name="bp1" type="text" size="3" class="pdxhead1"  value="<?=$arrchk['bp1']?>"/>
/
<input name="bp2" type="text" size="3" class="pdxhead1"  value="<?=$arrchk['bp2']?>"/>
          <strong>&nbsp;&nbsp;&nbsp;P : </strong>
          <input name="p" type="text" size="3" class="pdxhead1" id="p" value="<?=$arrchk['p']?>" /> 
          ครั้ง/นาที
         <hr></td>
      </tr>
    <tr>
      <td width="34%" align="right" class="pdx"><strong>ผล CXR : </strong></td>
      <td width="66%" class="pdx"><input name="cxr" type="text" class="pdxhead" size="40" id="cxr" value="<?=$arrchk['cxr']?>" /></td>
    </tr>
    <tr>
      <td align="right" class="pdx"><strong>ผล STOOL : </strong></td>
      <td class="pdx"><input name="stool" type="text" class="pdxhead" size="40" id="stool" value="<?=$arrchk['stool']?>" /></td>
    </tr>
    <tr>
      <td align="right" class="pdx"><strong>สารชี้บ่งมะเร็งตับ (AFP) : </strong></td>
      <td class="pdx"><input name="afp" type="text" class="pdxhead" size="40" id="afp" value="<?=$arrchk['afp']?>" /></td>
    </tr>
    <tr>
      <td align="right" class="pdx"><strong>สารชี้บ่งมะเร็งลำไส้ (CEA) : </strong></td>
      <td class="pdx"><input name="cea" type="text" class="pdxhead" size="40" id="cea" value="<?=$arrchk['cea']?>" /></td>
    </tr>
    <tr>
      <td align="right" class="pdx"><strong>เชื้อไวรัสเอดส์ (HIV) : </strong></td>
      <td class="pdx"><input name="hiv" type="text" class="pdxhead" size="40" id="hiv" value="<?=$arrchk['hiv']?>" /></td>
    </tr>
    <tr>
      <td align="right" class="pdx"><strong>สารชี้บ่งมะเร็งต่อมลูกหมาก (PSA) : </strong></td>
      <td class="pdx"><input name="psa" type="text" class="pdxhead" size="40" id="psa" value="<?=$arrchk['psa']?>" /></td>
    </tr>
    <tr align="center">
      <td align="right" class="pdx"><strong>สารชี้บ่งมะเร็งรังไข่ (CA 125): </strong></td>
      <td align="left" class="pdx"><input name="ca125" type="text" class="pdxhead" size="40" id="ca125" value="<?=$arrchk['ca125']?>" /></td>
    </tr>
    <tr>
      <td align="right" class="pdx"><strong>ระดับฮอร์โมนเพศชาย (Testolerone) : </strong></td>
      <td class="pdx"><input name="testolerone" type="text" class="pdxhead" size="40" id="testolerone" value="<?=$arrchk['testolerone']?>" /></td>
    </tr>
    <tr>
      <td align="right" class="pdx"><strong>ระดับฮอร์โมนเพศหญิง (Estradiol) : </strong></td>
      <td class="pdx"><input name="estradiol" type="text" class="pdxhead" size="40" id="estradiol" value="<?=$arrchk['estradiol']?>" /></td>
    </tr>
    <tr>
      <td align="right" class="pdx"><strong>มะเร็งปากมดลูก (PAP SMEAR) : </strong></td>
      <td class="pdx"><input name="hpv" type="text" class="pdxhead" size="40" id="hpv" value="<?=$arrchk['hpv']?>" /></td>
    </tr>
    <tr>
      <td align="right" class="pdx"><strong>แมมโมแกรมและอัลตราซาวด์ (เต้านม) : </strong></td>
      <td class="pdx"><input name="mammogram" type="text" class="pdxhead" size="40" id="mammogram" value="<?=$arrchk['mammogram']?>" /></td>
    </tr>
    <tr>
      <td align="right" class="pdx"><strong>ตรวจคลื่นไฟฟ้าหัวใจ (EKG) : </strong></td>
      <td class="pdx"><input name="ekg" type="text" class="pdxhead" size="40" id="ekg" value="<?=$arrchk['ekg']?>" /></td>
    </tr>
    <tr>
      <td align="right" class="pdx"><strong>อัลตร้าซาวด์ช่องท้องส่วนบน : </strong></td>
      <td class="pdx"><input name="altra" type="text" class="pdxhead" size="40" id="mammogram4" value="<?=$arrchk['altra']?>" /></td>
    </tr>
    <tr>
      <td align="right" class="pdx"><strong>อัลตร้าซาวด์ช่องท้องส่วนล่าง : </strong></td>
      <td class="pdx"><input name="altradown" type="text" class="pdxhead" size="40" id="altradown" value="<?=$arrchk['altradown']?>" /></td>
    </tr>
    <tr>
      <td align="right" class="pdx"><strong>สรุปผลการตรวจ : </strong></td>
      <td class="pdx"><input name="doctor_result" type="text" class="pdxhead" size="55" id="doctor_result" value="<?=$arrchk['doctor_result']?>" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center" class="pdx">
        <input type="hidden" name="ptname" value="<?=$arr['ptname']?>" />
        <input type="hidden" name="hn" value="<?=$chkhn?>" />
        <input type="hidden" name="row_id" value="<?=$arrchk['row_id']?>" />
        <?=$button;?></td>
      </tr>
      </table>
   </td>
      </tr>
    </table>
</form>
</div>
<?				
	}
}
if(isset($_POST['okhn2'])){
	
if($data1=="update"){
	
$update="UPDATE `out_result_chkup` SET `weight` = '".$_POST['weight']."',
																 `height` = '".$_POST['height']."',
																 `bp1` = '".$_POST['bp1']."',
																 `bp2` ='".$_POST['bp2']."',
																 `p` ='".$_POST['p']."' ,
																 `cxr`='".$_POST['cxr']."',
																 `stool`='".$_POST['stool']."',
																 `afp`='".$_POST['afp']."',
																 `cea`='".$_POST['cea']."',
															  	 `hiv`='".$_POST['hiv']."',
																 `psa`='".$_POST['psa']."',
																 `testolerone`='".$_POST['testolerone']."',
																 `estradiol`='".$_POST['estradiol']."',
																 `hpv`='".$_POST['hpv']."',
																 `mammogram`='".$_POST['mammogram']."', 
																 `ca125`='".$_POST['ca125']."',
																 `ekg`='".$_POST['ekg']."', 		
																 `altra`='".$_POST['altra']."',
																 `altradown`='".$_POST['altradown']."',
																 `doctor_result`='".$_POST['doctor_result']."',
																 `year_chk`='".$nPrefix."',
																 `officer`='".$_SESSION["sOfficer"]."',
																 `register`='".date("Y-m-d H:i:s")."'
																 WHERE  `row_id` ='".$_POST['row_id']."' ";


}else if($data1=="insert"){

$update="insert into `out_result_chkup` SET `hn`='".$_POST['hn']."',
																 `ptname`='".$_POST['ptname']."',
																 `weight` = '".$_POST['weight']."',
																 `height` = '".$_POST['height']."',
																 `bp1` = '".$_POST['bp1']."',
																 `bp2` ='".$_POST['bp2']."',
																 `p` ='".$_POST['p']."' ,
																 `cxr`='".$_POST['cxr']."',
																 `stool`='".$_POST['stool']."',
																 `afp`='".$_POST['afp']."',
																 `cea`='".$_POST['cea']."',
															  	 `hiv`='".$_POST['hiv']."',
																 `psa`='".$_POST['psa']."',
																 `testolerone`='".$_POST['testolerone']."',
																 `estradiol`='".$_POST['estradiol']."',
																 `hpv`='".$_POST['hpv']."',
																 `mammogram`='".$_POST['mammogram']."', 
																 `ca125`='".$_POST['ca125']."',
																 `ekg`='".$_POST['ekg']."', 		
																 `altra`='".$_POST['altra']."',
																  `altradown`='".$_POST['altradown']."',															 													 
																 `doctor_result`='".$_POST['doctor_result']."',
																 `year_chk`='".$nPrefix."',
																 `officer`='".$_SESSION["sOfficer"]."',
																 `register`='".date("Y-m-d H:i:s")."'";
}
//echo $update;
$upquery=mysql_query($update)or die (mysql_error());

/*
$update2="UPDATE  opcardchk SET address='".$_POST['address']."', phone='".$_POST['phone']."' WHERE hn='".$_POST['hn']."' ";

$upquery2=mysql_query($update2)or die (mysql_error());*/

if($upquery){
	echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว');window.location='out_result_manual.php';</script>";	
}
	
	
}
?>