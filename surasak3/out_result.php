<?php
    session_start();
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>บันทึกข้อมูลซักประวัตินอกหน่วย 2560</title>
<style type="text/css">
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 16px;
}
.pdxhead {
	font-family: "TH SarabunPSK";
	font-size: 24px;
}
.pdxpro {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.pdx {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.stricker {
	font-family: "TH SarabunPSK";
	font-size: 16px;
}
.stricker1 {
	font-family: "TH SarabunPSK";
	font-size: 14px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
.style1 {color: #FF0000}
.help{ cursor: pointer; }
</style>
<script type="text/javascript">
function showDiv(){
	 if(document.getElementById('pt').value == "ปอดจำกัดการขยายตัว"){
		document.getElementById('hidden_div').style.display = "block";
	}else if(document.getElementById('pt').value == "ปอดอุดกั้น"){
		document.getElementById('hidden_div').style.display = "block";
	}else{
		document.getElementById('hidden_div').style.display = "none";
	}
}


function showDiveye(){
	 if(document.getElementById('eye2').value == "ผิดปกติ"){
		document.getElementById('hidden_div1').style.display = "block";
	}else{
		document.getElementById('hidden_div1').style.display = "none";
	}
}

function showDiveye1(){
	 if(document.getElementById('eye1').value == "ปกติ"){
		document.getElementById('hidden_div1').style.display = "none";
	}else{
		document.getElementById('hidden_div1').style.display = "none";
	}
}
</script>
</head>

<body>
<div id="no_print">
<form action="" method="post" name="f1">
	<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#339933" class="pdxhead">
		<tr>
			<td height="40" align="center" bgcolor="#66CC99">
				<strong>กรอกข้อมูล HN </strong>
			</td>
		</tr>
		<tr>
			<td align="left">
				HN: <input name="hn" type="text" size="20" class="pdxhead"  /> 
				<input type="submit"  value="   ตกลง   " name="okhn" class="pdxhead"/>
			</td>
		</tr>
	</table>
</form>
<br />
<?
//echo $sOfficer;
if(isset($_POST['hn'])){
				
	include("connect.inc");		
	
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
	$part=$_GET["part"];
		
	$sql1="SELECT * ,CONCAT(`yot`,`name`,' ',`surname`) AS `ptname` 
	FROM `opcardchk` 
	WHERE `HN` = '".(trim($_POST['hn']))."' and part='$part' ";	
	//echo "-->".$sql1;
	
	$query=mysql_query($sql1) or die (mysql_error());
	$Row=mysql_num_rows($query);

	$arr=mysql_fetch_array($query);   // list ข้อมูลจาก opcardchk
	$hn = $arr['HN'];
	$age= $arr['agey'];
	$ptname = $arr['yot'].$arr['name'].' '.$arr['surname'];			

	$sqlchk="SELECT * FROM `out_result_chkup` WHERE hn='".$hn."' and year_chk ='$nPrefix' ";
	//echo $sqlchk;
	$querychk=mysql_query($sqlchk) or die (mysql_error());
	$Rowchk=mysql_num_rows($querychk);

	if($Rowchk>0){
		
		$arrchk=mysql_fetch_array($querychk);	// list ข้อมูลจาก out_result_chkup
		if(empty($age)){
			$age=$arrchk["age"];
		}
		$data1 = "update";
		$button = "<input type='submit'  value='   แก้ไขข้อมูล   ' name='okhn2' class='pdxhead'/>";
		$button .= '<input type="hidden" name="form_status" value="update">';

	}else{
		$data1 = "insert";
		$button = "<input type='submit'  value='   บันทึกข้อมูล   ' name='okhn2' class='pdxhead'/>";
		$button .= '<input type="hidden" name="form_status" value="insert">';
	}
				
	if(!$Row){	
	
		$sql2="SELECT hn as HN ,concat(yot,name,' ',surname)as ptname FROM `opcard` WHERE hn='".$_POST['hn']."' ";	
		//echo "-->".$sql2;
		echo "<div class='pdx'><strong>แจ้งเตือน...</strong>บุคคลนี้ไม่ได้ลงทะเบียนตรวจสุขภาพแบบกลุ่มของหน่วย : <strong>$part</strong><br><span class='style1'>กรุณาเช็ครายชื่อบุคคลให้ตรงกับหน่วยงานที่มาตรวจสุขภาพ...!!!</span></div>";
		$query=mysql_query($sql2) or die (mysql_error());
		$Row2=mysql_num_rows($query);	
		if(empty($Row2)){
			echo "<div align='center' class='fontsara'>!!! ไม่พบ HN  $_POST[hn]!! </div>";	
		}else{
			$arr=mysql_fetch_array($query);
			$hn=$arr['HN'];
			$ptname=$arr['ptname'];
			
			$sqlchk="SELECT * FROM `out_result_chkup` WHERE hn='".$hn."' and year_chk ='$nPrefix' ";
			//echo $sqlchk;
			$querychk=mysql_query($sqlchk) or die (mysql_error());
			$Rowchk=mysql_num_rows($querychk);
	
			if($Rowchk>0){
				
				$arrchk=mysql_fetch_array($querychk);	
				$data1="update";
				$button="<input type='submit'  value='   แก้ไขข้อมูล   ' name='okhn2' class='pdxhead'/>";
				$button .= '<input type="hidden" name="form_status" value="update">';
			}else{
				$data1="insert";
				$button="<input type='submit'  value='   บันทึกข้อมูล   ' name='okhn2' class='pdxhead'/>";
				$button .= '<input type="hidden" name="form_status" value="insert">';
			}
		}
	}
?>
<form action="" method="post" name="f2">
 <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#FF9900">
    <tr><td>
      <table width="100%">
    <tr>
      <td class="pdxpro">HN :
        <strong>
        <?=$hn?>
        </strong>       ชื่อ-สกุล : 
      <strong><input name="newname" type="text" class="pdxhead" value="<?=$ptname?>" /></strong>  &nbsp;&nbsp; หน่วย:    <strong><?=$part;?></strong>&nbsp;&nbsp; อายุ: <input name="age" type="text" size="5" class="pdxhead" value="<?=$age;?>" /></td>
      </tr>
    <tr>
      <td class="pdx">น้ำหนัก  <input name="weight" type="text" size="5" class="pdxhead" value="<?=$arrchk['weight']?>" />  กก. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ส่วนสูง <input name="height" type="text" size="5" class="pdxhead"   value="<?=$arrchk['height']?>"  /> 
        ซม. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BP  
        <input name="bp1" type="text" size="5" class="pdxhead"  value="<?=$arrchk['bp1']?>"/> / <input name="bp2" type="text" size="5" class="pdxhead"  value="<?=$arrchk['bp2']?>"/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Repeat-BP
<input name="bp3" type="text" size="5" class="pdxhead"  value="<?=$arrchk['bp3']?>"/>
/
<input name="bp4" type="text" class="pdxhead" id="bp4"  value="<?=$arrchk['bp4']?>" size="5"/></td>
    </tr>
    <tr>
      <td class="pdx"> T
        <input name="temp" type="text" size="5" class="pdxhead" id="temp" value="<?=$arrchk['temp']?>" />
        &nbsp;&nbsp;&nbsp;&nbsp;P  
        <input name="p" type="text" size="5" class="pdxhead" value="<?=$arrchk['p']?>" /> ครั้ง/นาที&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R <input name="rate" type="text" size="5" class="pdxhead"   value="<?=$arrchk['rate']?>"  /> 
        ครั้ง/นาที&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;โรคประจำตัว  
        <input name="prawat" type="text" size="22" class="pdxhead"  value="<?=$arrchk['prawat']?>"/></td>
      </tr>	  
    <tr>
      <td class="pdx">สูบบุหรี่  <input name="cigga" type="text" size="5" class="pdxhead" value="<?=$arrchk['cigga']?>" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ดื่มสุรา <input name="alcohol" type="text" size="5" class="pdxhead"   value="<?=$arrchk['alcohol']?>"  />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ออกกำลังกาย  <input name="exercise" type="text" size="5" class="pdxhead"  value="<?=$arrchk['exercise']?>"/>&nbsp;&nbsp;&nbsp;&nbsp;แพ้ยา  <input name="allergic" type="text" size="13" class="pdxhead"  value="<?=$arrchk['allergic']?>"/></td>
      </tr>	    
		<tr>
			<td>
				<table width="924">
					<tr>
					  <td width="188" class="pdx">หมายเหตุ</td>
					  <td width="464"><input name="comment" type="text" class="pdxhead" size="50" id="comment" value="<?=$arrchk['comment']?>" /></td>
				      <td width="256">&nbsp;</td>
				  </tr>
					<tr>
                      <td class="pdx">ผลตรวจ สมรรถภาพปอด</td>
					  <td colspan="2"><select name="pt" class="pdxhead" id="pt" onchange="showDiv()">
                        <option value="" >---------- เลือก ----------</option>
                        <option value="ปกติ" <? if($arrchk['pt']=="ปกติ"){ echo "selected='selected'";} ?>>ปกติ</option>
                        <option value="ปอดจำกัดการขยายตัว" <? if($arrchk['pt']=="ปอดจำกัดการขยายตัว"){ echo "selected='selected'";} ?> >ปอดจำกัดการขยายตัว</option>
                        <option value="ปอดอุดกั้น" <? if($arrchk['pt']=="ปอดอุดกั้น"){ echo "selected='selected'";} ?>>ปอดอุดกั้น</option>
                      </select>
				      &nbsp;&nbsp;&nbsp;
					  <? if($arrchk['pt']=="ปอดจำกัดการขยายตัว" || $arrchk['pt']=="ปอดอุดกั้น"){ echo "<span class='pdx'>".$arrchk['pt_detail']."</span>";} ?>
                      <div id="hidden_div" style="display: none;" class="pdx">ระบุ : <input type="radio" name="pt_detail"  value="ผิดปกติเล็กน้อย" class="pdxhead" <? if($arrchk['pt_detail']=="ผิดปกติเล็กน้อย"){ echo "checked='checked'";} ?> /> 
					    ผิดปกติเล็กน้อย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					    <input type="radio" name="pt_detail" value="ผิดปกติปานกลาง" class="pdxhead" <? if($arrchk['pt_detail']=="ผิดปกติปานกลาง"){ echo "checked='checked'";} ?> /> 
					    ผิดปกติปานกลาง&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					    <input type="radio" name="pt_detail" value="ผิดปกติมาก" class="pdxhead" <? if($arrchk['pt_detail']=="ผิดปกติมาก"){ echo "checked='checked'";} ?> /> ผิดปกติมาก</div></td>
				  </tr>
					<tr>
						<td class="pdx">
							ผล X-RAY						</td>
						<td>
							<input name="cxr" type="text" class="pdxhead" size="50" id="cxr" value="<?=$arrchk['cxr']?>" />						</td>
					    <td><span class="style1">กรณี ตั้งครรภ์ หรือไม่ได้ Xray ให้กรอกข้อมูลช่องนี้</span></td>
					</tr>
					<tr>
                      <td class="pdx"> ผล V/A</td>
					  <td><label>
					    <select name="va" class="pdxhead" id="va">
                          <option value="" >---------- เลือก ----------</option>
					      <option value="ไม่พบตาบอดสี" <? if($arrchk['va']=="ไม่พบตาบอดสี"){ echo "selected='selected'";} ?>>ไม่พบตาบอดสี</option>
					      <option value="พบตาบอดสี" <? if($arrchk['va']=="พบตาบอดสี"){ echo "selected='selected'";} ?>>พบตาบอดสี</option>
				        </select>
					    </label></td>
				      <td>&nbsp;</td>
				  </tr>
					<tr>
					  <td class="pdx">ผลตรวจ วัดสายตา</td>
					  <td colspan="2" class="pdx"><input type="radio" name="eye" id="eye1"  value="ปกติ" class="pdxhead" <? if($arrchk['eye']=="ปกติ"){ echo "checked='checked'";} ?> onclick="showDiveye1()" />
					    ปกติ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					    <input type="radio" name="eye" id="eye2" value="ผิดปกติ" class="pdxhead" <? if($arrchk['eye']=="ผิดปกติ"){ echo "checked='checked'";} ?> onclick="showDiveye()" /> 
					    ผิดปกติ&nbsp;&nbsp;&nbsp;<? if($arrchk['eye']=="ผิดปกติ"){ echo "<span class='pdx'>".$arrchk['eye_detail']."</span>";} ?>
                        <div id="hidden_div1" style="display: none;" class="pdx">ระบุความผิดปกติ : 
					    <input name="eye_detail" type="text" class="pdxhead" size="50" id="eye_detail" value="<?=$arrchk['eye_detail']?>" /></div></td>
				  </tr>
					<tr>
						<td class="pdx">
							ผล EKG						</td>
						<td>
							<input name="ekg" type="text" class="pdxhead" size="50" id="ekg" value="<?=$arrchk['ekg']?>" />						</td>
					    <td>&nbsp;</td>
					</tr>
					<tr>
						<td class="pdx">
							ผลตรวจ BMD						</td>
						<td>
							<input name="42702" type="text" class="pdxhead" size="50" id="42702" value="<?=$arrchk['42702']?>" />						</td>
					    <td>&nbsp;</td>
					</tr>
					<tr>
					  <td class="pdx">อัลตร้าซาวด์</td>
					  <td><input name="altra" type="text" class="pdxhead" size="50" id="altra" value="<?=$arrchk['altra']?>" /></td>
					  <td>&nbsp;</td>
				  </tr>
					<tr>
					  <td class="pdx">ต่อมลูกหมาก</td>
					  <td><input name="psa" type="text" class="pdxhead" size="50" id="psa" value="<?=$arrchk['psa']?>" /></td>
					  <td>&nbsp;</td>
				  </tr>
					<tr>
					  <td class="pdx">มะเร็งปากมดลูก</td>
					  <td><input name="hpv" type="text" class="pdxhead" size="50" id="hpv" value="<?=$arrchk['hpv']?>" /></td>
					  <td>&nbsp;</td>
				  </tr>
					<tr>
					  <td class="pdx">แมมโมแกรม</td>
					  <td><input name="mammogram" type="text" class="pdxhead" size="50" id="mammogram" value="<?=$arrchk['mammogram']?>" /></td>
					  <td>&nbsp;</td>
				  </tr>
					<tr>
					  <td class="pdx">ลำดับ</td>
					  <td><input name="seq" type="text" class="pdxhead" size="10" id="seq" value="<?=$arrchk['seq']?>" /></td>
					  <td>&nbsp;</td>
				  </tr>
					<!--
					<tr>
						<td class="pdx">
							ผลการตรวจมะเร็งปากมดลูก (Pap Smear)
						</td>
						<td>
							<input name="hpv" type="text" class="pdxhead" size="50" id="hpv" value="<?=$arrchk['hpv']?>" />
							[<span class="help" onclick="help('hpv','ปกติ')">ปกติ</span> | <span class="help" onclick="help('hpv','ผิดปกติ')">ผิดปกติ</span>]
						</td>
					</tr>
					-->
				</table>
				<script type="text/javascript">
					function help(id_name, status){
						document.getElementById(id_name).value = status;
					}
				</script>
			</td>
		</tr>

    <tr>
      <td align="left" class="pdx">
        <input type="hidden" name="ptname" value="<?=$ptname?>" />
        <input type="hidden" name="hn" value="<?=$hn?>" />
        <input type="hidden" name="part" value="<?=$part;?>" />
        <input type="hidden" name="row_id" value="<?=$arrchk['row_id']?>" />
        <?=$button;?></td>
      </tr>
      </table>
   </td></tr>
  </table>
</form>
<p>
<?
}
if(isset($_POST['okhn2'])){
	
	include("connect.inc");
	$data1 = $_POST['form_status'];

	$hpv = ( trim($_POST['hpv']) != '' ) ? trim($_POST['hpv']) : NULL ;
	$bone = ( trim($_POST['42702']) != '' ) ? trim($_POST['42702']) : NULL ;

	if( $data1 == "update" ){
		if($_POST['eye']=="ปกติ"){
			$_POST['eye_detail']="";
		}
		if($_POST['pt']=="ปกติ"){
			$_POST['pt_detail']="";
		}
		$ptname = $_POST['ptname'];
		$update="UPDATE `out_result_chkup` SET 
		`ptname` = '".$_POST['newname']."',
		`age` = '".$_POST['age']."',
		`weight` = '".$_POST['weight']."',
		`height` = '".$_POST['height']."',
		`bp1` = '".$_POST['bp1']."',
		`bp2` ='".$_POST['bp2']."',
		`p` = '".$_POST['p']."' ,
		`ekg` = '".$_POST['ekg']."',
		`va` = '".$_POST['va']."',
		`stool` = '".$_POST['stool']."',
		`cxr` = '".$_POST['cxr']."',
		`doctor_result` = '".$_POST['doctor_result']."',
		`year_chk` = '".$nPrefix."',
		`part` = '".$_POST['part']."',
		`42702` = '$bone',
		`hpv` = '$hpv',
		`altra` = '".$_POST['altra']."',
		`psa` = '".$_POST['psa']."',
		`mammogram` = '".$_POST['mammogram']."',
		`temp` = '".$_POST['temp']."',
		`rate` ='".$_POST['rate']."',
		`prawat` = '".$_POST['prawat']."' ,
		`cigga` = '".$_POST['cigga']."',
		`alcohol` = '".$_POST['alcohol']."',
		`exercise` = '".$_POST['exercise']."',
		`allergic` = '".$_POST['allergic']."',
		`comment` = '".$_POST['comment']."'	,
		`bp3` = '".$_POST['bp3']."',
		`bp4` ='".$_POST['bp4']."',
		`eye` ='".$_POST['eye']."',
		`eye_detail` ='".$_POST['eye_detail']."',
		`pt` ='".$_POST['pt']."',
		`pt_detail` ='".$_POST['pt_detail']."',
		`last_officer` = '$sOfficer',
		`last_update` = '".date("Y-m-d H:i:s")."', 
		`seq` = '".$_POST['seq']."' 
		WHERE `row_id` ='".$_POST['row_id']."';";
	}else if( $data1=="insert" ){
		$active = "y";
		if($_POST['eye']=="ปกติ"){
			$_POST['eye_detail']="";
		}
		if($_POST['pt']=="ปกติ"){
			$_POST['pt_detail']="";
		}		
		$update = "INSERT INTO `out_result_chkup` SET 
			`hn` = '".$_POST['hn']."',
			`ptname` = '".$_POST['ptname']."',
			`age` = '".$_POST['age']."',
			`weight` = '".$_POST['weight']."',
			`height` = '".$_POST['height']."',
			`bp1` =  '".$_POST['bp1']."',
			`bp2` = '".$_POST['bp2']."',
			`p` = '".$_POST['p']."',
			`ekg` = '".$_POST['ekg']."',
			`va` = '".$_POST['va']."',
			`cxr` = '".$_POST['cxr']."',
			`year_chk` =  '$nPrefix',
			`part` = '".$_POST['part']."',
			`officer` = '$sOfficer',
			`register` = '".date("Y-m-d H:i:s")."',
			`42702` = '$bone',
			`hpv` = '$hpv',
			`altra` = '".$_POST['altra']."',
			`psa` = '".$_POST['psa']."',
			`mammogram` = '".$_POST['mammogram']."',			
			`temp` = '".$_POST['temp']."',
			`rate` = '".$_POST['rate']."',
			`prawat` =  '".$_POST['prawat']."',
			`cigga` = '".$_POST['cigga']."',
			`alcohol` = '".$_POST['alcohol']."',
			`exercise` = '".$_POST['exercise']."',
			`allergic` = '".$_POST['allergic']."',
			`comment` = '".$_POST['comment']."',
			`bp3` = '".$_POST['bp3']."',
			`bp4` = '".$_POST['bp4']."',
			`eye` = '".$_POST['eye']."',
			`eye_detail` =  '".$_POST['eye_detail']."',
			`pt` = '".$_POST['pt']."',
			`pt_detail` = '".$_POST['pt_detail']."', 
			`seq` = '".$_POST['seq']."' ";
	}
	
	//echo $update;
	$upquery = mysql_query($update) or die (mysql_error());
	if($upquery){ //บันทึกสำเร็จ
		if($_POST["form_status"]=="insert"){
			$save="บันทึกข้อมูลเรียบร้อยแล้ว";
		}else{
			$edit="update opcardchk set name='".$_POST['newname']."',`agey` = '".$_POST['age']."' where HN='".$_POST['hn']."' and part='".$_POST['part']."';";
			//echo $edit;
			$querey=mysql_query($edit);
			$save="แก้ไขข้อมูลเรียบร้อยแล้ว";
		}
		echo "<script>alert('$save');window.location='out_result.php?hn=$_POST[hn]&part=$_POST[part]&act=print';</script>" ;
	}
}
?>
<br />
<? 
include("connect.inc");			
$showpart=$_GET["part"];

$sql1="SELECT * FROM  out_result_chkup where part='$showpart' ORDER BY row_id asc";
//echo $sql1;
$query1=mysql_query($sql1)or die (mysql_error());
$num1=mysql_num_rows($query1);


$sqlchk1="SELECT * FROM  opcardchk where part='$showpart' and active='y'";
//echo $sqlchk1;
$querychk1=mysql_query($sqlchk1)or die (mysql_error());
$numchk1=mysql_num_rows($querychk1);
?>
<h1 class="pdx" align="center">รายชื่อผู้ตรวจสุขภาพ <?=$showpart;?></h1>

<div class="pdx" align="center">ลงทะเบียนตรวจสุขภาพทั้งหมด <?=$numchk1;?> คน ลงซักประวัติจำนวน <?=$num1;?> คน</div>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="pdxpro">
  <tr>
    <td width="3%" align="center" bgcolor="#FF99CC">#</td>
    <td width="7%" height="31" align="left" bgcolor="#FF99CC"><strong>HN</strong></td>
    <td width="26%" align="left" bgcolor="#FF99CC"><strong>ชื่อ-สกุล</strong></td>
    <td width="10%" align="left" bgcolor="#FF99CC"><strong>น้ำหนัก</strong></td>
    <td width="9%" align="left" bgcolor="#FF99CC"><strong>ส่วนสูง</strong></td>
    <td width="5%" align="left" bgcolor="#FF99CC"><strong>BP</strong></td>
    <td width="22%" align="left" bgcolor="#FF99CC"><strong>P</strong></td>
		<td width="3%" align="left" bgcolor="#FF99CC"><strong>Seq</strong></td>
    <td width="9%" align="center" bgcolor="#FF99CC"><strong>สติ๊กเกอร์</strong></td>
	<td width="9%" align="center" bgcolor="#FF99CC"><strong>ลบข้อมูล</strong></td>
  </tr>
  <?
  $i=0;
  while($arr1=mysql_fetch_array($query1)){
  $i++;
  ?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$arr1['hn'];?></td>
    <td><?=$arr1['ptname'];?></td>
    <td align="left"><?=$arr1['weight'];?></td>
    <td align="left"><?=$arr1['height'];?></td>
    <td align="left"><? if(empty($arr1['bp3']) || empty($arr1['bp4'])){ echo $arr1['bp1'].'/'.$arr1['bp2'];}else{ echo $arr1['bp3'].'/'.$arr1['bp4'];}?></td>
    <td align="left"><?=$arr1['p'];?></td>
		<td align="left"><?=$arr1['seq'];?></td>
    <td align="center"><a href="out_result_print.php?hn=<?=$arr1['hn'];?>&part=<?=$showpart;?>&act=print" target="_blank">พิมพ์</a></td>
	<td align="center"><a href="out_result.php?getid=<?=$arr1['row_id'];?>&act=del&part=<?=$showpart;?>" onclick="return confirm('คุณต้องการลบข้อมูลรายการนี้ใช่หรือไม่');">ลบ</a></td>
  </tr>
  <? } ?>
</table>
</div>
</body>
<?
if($_GET["act"]=="del"){
	$del="delete from out_result_chkup where row_id='$_GET[getid]'";
	if(mysql_query($del)){
		echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว');window.location='out_result.php?part=$_GET[part]';</script>";									
	}else{
		echo "<script>alert('ผิดพลาด ไม่สามารถลบข้อมูลได้');window.location='out_result.php?part=$_GET[part]';</script>";
	}
}

if($_GET["act"]=="print"){
include("connect.inc");	
$showpart=$_GET["part"];
$sql1="SELECT * FROM  out_result_chkup where hn='$_GET[hn]' and part='$showpart'";
//echo $sql1;
$query1=mysql_query($sql1)or die (mysql_error());
$arr1=mysql_fetch_array($query1);
$d=date("d");
$m=date("m");
$y=date("Y")+543;
$time=date("H:i:s");

$thidate="$d/$m/$y $time";
?>
<? if($_SESSION["smenucode"]=="ADMMAINOPD"){ ?>
<script type="text/javascript">
window.print();
</script>
<? } ?>
<table cellpadding="0" cellspacing="0" border="0" style="font-family:'TH SarabunPSK'; font-size:16px">
<tr>
    <td>HN : <?=$arr1['hn'];?>&nbsp;&nbsp;(<?php echo $thidate;?>)</td>
  </tr>
<tr>
    <td>ชื่อ-นามสกุล : <?=$arr1['ptname'];?></td>
  </tr>
<tr>
    <td>ตรวจสุขภาพประจำปี (<?=$arr1['part'];?>)</td>
  </tr>  
  <tr>
    <td>โรคประจำตัว : <?=$arr1["prawat"];?>, แพ้ยา : <?=$arr1["allergic"];?>, นน : <?php echo $arr1["weight"];?> กก., สส : <?php echo $arr1["height"];?> ซม.</td>
  </tr>  
  <tr>
    <td>BP : <? echo $arr1["bp1"]."/".$arr1["bp2"];?> mmHg, <? if(!empty($arr1["bp3"]) || !empty($arr1["bp4"])){ ?>RE-BP : <? echo $arr1["bp3"]."/".$arr1["bp4"];?> mmHg, <? } ?> T : <?php echo $arr1["temp"];?> C, P : <?php echo $arr1["p"];?> ครั้ง/นาที</td>
  </tr>
  <tr>
    <td>R : <?php echo $arr1["rate"];?> ครั้ง/นาที, บุหรี่ : <?php echo $arr1["cigga"];?>, สุรา : <?php echo $arr1["alcohol"];?>, ออกกำลังกาย : <?php echo $arr1["exercise"];?></td>
  </tr>
<? if(!empty($arr1["comment"])){  ?>
  <tr>
    <td>หมายเหตุ : <?php echo $arr1["comment"];?></td>
  </tr>  
<? } ?>  
</table>
<?
echo "<meta http-equiv='refresh' content='1; url=out_result.php?part=$arr1[part]'>" ;
}
?>
</html>