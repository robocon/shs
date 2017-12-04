<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<style type="text/css">
.forntsarabun11 {	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.forntsarabun11 {	font-family: "TH SarabunPSK";
	font-size: 22px;
}
</style>
</head>
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
<body>
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />

<style>
.f1{
	font-family:"Angsana New";
	font-size:16px;	
}
</style>
<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript">

var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date_hd'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('stage_date'));

};



function fncSubmit()
{
	
		if(document.frmMain.hn.value == "")
	{
		alert('กรุณาระบุ HN');
		document.frmMain.hn.focus();		
		return false;
	}	
			if(document.frmMain.ptname.value == "")
	{
		alert('กรุณาระบุ ชื่อ-สกุล ');
		document.frmMain.ptname.focus();		
		return false;
	}	
		if(document.frmMain.stage.value == "")
	{
		alert('กรุณาเลือก stage');
		document.frmMain.stage.focus();		
		return false;
	}	
	document.frmMain.submit();
}

</script>

<script language="JavaScript">
	   var HttPRequest = false;

	   function doCallAjax(fhn,fptname,fbp1,fbp2,fcigarette,fcigarette2) {
		  HttPRequest = false;
		  if (window.XMLHttpRequest) { // Mozilla, Safari,...
			 HttPRequest = new XMLHttpRequest();
			 if (HttPRequest.overrideMimeType) {
				HttPRequest.overrideMimeType('text/html');
			 }
		  } else if (window.ActiveXObject) { // IE
			 try {
				HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
				try {
				   HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {}
			 }
		  } 
		  
		  if (!HttPRequest) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
		  }

		  var url = 'hd_getfill.php';
		  var pmeters = "strhn=" + encodeURI( document.getElementById(fhn).value);
		  
		 

			HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
			
			
			HttPRequest.onreadystatechange = function()
			{

				//if(HttPRequest.readyState == 3)  // Loading Request
				//{
					//document.getElementById(fProductName).innerHTML = "..";
				//}

				if(HttPRequest.readyState == 4) // Return Request
				{
					var myProduct = HttPRequest.responseText;
					if(myProduct != "")
					{
						var myArr = myProduct.split("|");
						document.getElementById(fptname).value = myArr[0];
						document.getElementById(fbp1).value = myArr[1];
						document.getElementById(fbp2).value = myArr[2];
						document.getElementById(fcigarette).value = myArr[3];
						
if(myArr[3] == "1")
{
	document.getElementById(fcigarette).checked = true;
}
else if(myArr[3] == "0")
{
	document.getElementById(fcigarette2).checked = true;
}
			
					}
				}
				
			}

	   }
	   
	   </script>
       
       
          <script>
function select_sub(){
	var id =document.getElementById('hn').value;
	window.open("call_eGFR.php?cHn="+id,"win1","width=300,height=300,scrollbars=yes");
}

function turn_add(id_sub,description){
	//document.syllabus.id_subject.value=id_sub;
	document.getElementById("id_subject").value=id_sub;
	document.getElementById("description").innerHTML=description;
	
//	alert(document.getElementById("id_subject").value);
}
function reset_syllambus(){
	document.getElementById("description").innerHTML="<font color=\"red\">ยังไม่ได้คำนวณ eGFR</font>";
}


	function selectd_stage(){
		
		var gfr=document.getElementById("id_subject").value;
		
		if(gfr >90.00){
			document.getElementById("stage").selectedIndex=1;
		}else if (gfr >=60.00 && gfr <=89.99){
			document.getElementById("stage").selectedIndex=2;
		}else if (gfr >=30.00 && gfr <=59.99){
			document.getElementById("stage").selectedIndex=3;
		}else if (gfr >=15.00 && gfr <=29.99){
			document.getElementById("stage").selectedIndex=4;
		}else if (gfr <15.00){
			document.getElementById("stage").selectedIndex=5;
		}
		
	}

</script>   
 <?
  include("connect.inc");	
 
 	$strSQL1 = "SELECT  hn,dbirth   FROM opcard  WHERE hn = '".$_GET['cHn']."' ";
	$objQuery1 = mysql_query($strSQL1) or die ("Error Query [".$strSQL1."]");
	$objResult1 = mysql_fetch_array($objQuery1);
  ///////////// คำนวณอายุ /////////////////
	  
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

$cAge=calcage($objResult1['dbirth']);
 
 

 
 $sql1="SELECT * FROM `opd_hd` WHERE row_id='".$_GET['row_id']."' ";
 
 $query1=mysql_query($sql1) or die (mysql_error());
 $arr=mysql_fetch_array($query1);
 ?>      
       
<form action="" method="POST" name="frmMain">
<table  border="0" align="center" bgcolor="#FFFFCE" class="forntsarabun1">
  <tr>
    <td colspan="4" bgcolor="#0000CC"><span class="forntsarabun">แก้ไข ข้อมูลผู้ป่วย</span></td>
    </tr>
  <tr>
    <td  class="tb_font_2">hn</td>
    <td ><!--OnChange="JavaScript:doCallAjax('hn','ptname','bp1','bp2','cigarette1','cigarette2','stage');"-->
      <?=$arr['hn'];?><input name="hn" type="hidden" class="forntsarabun1" id="hn"  value="<?=$arr['hn'];?>" /></td>
    <td ><span class="tb_font_2">ชื่อ-สกุล</span></td>
    <td><?=$arr['ptname'];?><input name="ptname" type="hidden" class="forntsarabun1" id="ptname" value="<?=$arr['ptname'];?>"/></td>
  </tr>
  <tr>
    <td class="tb_font_2"><span class="tb_font_21">วันที่</span></td>
    <td><input name="date_hd" type="text" class="forntsarabun1" id="date_hd"  value="<?=$arr['date_hd'];?>"/></td>
    <td class="tb_font_2">อายุ</td>
    <td><?=$cAge;?></td>
  </tr>
  <tr>
    <td class="tb_font_2"><span class="tb_font_21">eGFR</span></td>
    <td><input name="id_subject" class="forntsarabun1"  id="id_subject" onclick="select_sub()"  onblur="selectd_stage()" size="20"  value="<?=$arr['gfr'];?>"/>
      <span class="forntsarabun1">ml/min</span>
      <!--	  <a href="javascript:select_sub()" class="sh">คำนวณ </a>-->
      <div id="description" style="display:none;"></div></td>
    <td><span class="tb_font_2">stage</span></td>
    <td><? 
/* $sql1="SELECT * FROM `opd_hd` WHERE hn='".$objResult['hn']."' ORDER BY `row_id` DESC limit 1";
 $query1=mysql_query($sql1) or die (mysql_error());
 $arr=mysql_fetch_array($query1);*/

			?>
      <select name="stage" class="forntsarabun1" id="stage">
        <option value="">--กรุณาเลือก stage--</option>
        <option value="stage1" <? if($arr['stage']=='stage1'){ echo "selected"; }?>>stage1</option>
        <option value="stage2" <? if($arr['stage']=='stage2'){ echo "selected";}?>>stage2</option>
        <option value="stage3" <? if($arr['stage']=='stage3'){ echo "selected"; }?>>stage3</option>
        <option value="stage4" <? if($arr['stage']=='stage4'){ echo "selected"; }?>>stage4</option>
        <option value="stage5" <? if($arr['stage']=='stage5'){ echo "selected"; }?>>stage5</option>
        <option value="ESRD" <? if($arr['stage']=='ESRD'){ echo "selected"; }?>>ESRD</option>
      </select> <span class="tb_font_2">
      วันที่เปลี่ยน stage</span>
      <input name="stage_date" type="text" class="forntsarabun1" id="stage_date"  value="<?=date("Y-m-d");?>"/></td>
  </tr>
  <tr>
    <td class="tb_font_2">bp</td>
    <td><input name="bp1" type="text" class="forntsarabun11" id="bp1"  value="<?=$arr['bp1'];?>" size="10" />
/
  <input name="bp2" type="text" class="forntsarabun11" id="bp2" value="<?=$arr['bp2'];?>" size="10" /></td>
    <td><span class="tb_font_2">bs</span></td>
    <td class="forntsarabun1"><input name="bs" type="text" class="forntsarabun1" id="bs" value="<?=$arr['bs'];?>" />
      <span class="forntsarabun1">mg%</span></td>
  </tr>
  <tr>
    <td class="tb_font_2">HbA1C</td>
    <td><span class="tb_font_2">
      <input name="hba1c" type="text" class="forntsarabun1" id="hba1c" value="<?=$arr['hba1c'];?>"/>
    </span><span class="forntsarabun1">%</span></td>
    <td><span class="tb_font_2">LDL</span></td>
    <td class="forntsarabun1"><span class="tb_font_2">
      <input name="ldl" type="text" class="forntsarabun1" id="ldl"  value="<?=$arr['ldl'];?>"/>
</span>mg%</td>
  </tr>
  <tr>
    <td class="tb_font_2">ca x p</td>
    <td><span class="tb_font_2">
      <input name="ca_p" type="text" class="forntsarabun1" id="ca_p"  value="<?=$arr['ca_p'];?>"/>
    </span></td>
    <td><span class="tb_font_2">Hct</span></td>
    <td><span class="tb_font_2">
      <input name="hct" type="text" class="forntsarabun1" id="hct" value="<?=$arr['hct'];?>" />
    </span><span class="forntsarabun1">mg/dl</span></td>
  </tr>
  <tr>
    <td class="tb_font_2">Hb</td>
    <td class="forntsarabun1"><input name="hb" type="text" class="forntsarabun1" id="hb" value="<?=$arr['hb'];?>" />
g/dl</td>
    <td class="forntsarabun1">&nbsp;</td>
    <td class="forntsarabun1">&nbsp;</td>
  </tr>
  <tr>
    <td class="tb_font_2">serum phosephate</td>
    <td class="forntsarabun1"><input name="serum_phose" type="text" class="forntsarabun1" id="serum_phose" value="<?=$arr['serum_phose'];?>"/>
      mg/dl</td>
    <td class="tb_font_2">&nbsp;</td>
    <td class="forntsarabun1">&nbsp;</td>
  </tr>
  <tr>
    <td class="tb_font_2">serum bicarbonate</td>
    <td class="forntsarabun1"><span class="tb_font_2">
      <input name="serum_bio" type="text" class="forntsarabun1" id="serum_bio"   value="<?=$arr['serum_bio'];?>"/>
    </span>meq/L</td>
    <td class="tb_font_2">&nbsp;</td>
    <td class="tb_font_2">&nbsp;</td>
  </tr>
  <tr>
    <td class="tb_font_2">PTH</td>
    <td class="forntsarabun1"><input name="pth" type="text" class="forntsarabun1" id="pth" value="<?=$arr['pth'];?>" />
      pg/dl</td>
    <td class="tb_font_2">&nbsp;</td>
    <td class="tb_font_2">&nbsp;</td>
  </tr>
  <tr>
    <td class="tb_font_2">Vascular Access</td>
    <td class="forntsarabun1"><span class="tb_font_2">
      <select name="vascular" class="forntsarabun1" id="vascular">
       <option value="">--กรุณาเลือก --</option>
        <option value="avf" <? if($arr['vascular']=='avf'){ echo "selected"; }?>>AVF</option>
        <option value="avg" <? if($arr['vascular']=='avg'){ echo "selected"; }?>>AVG</option>
        <option value="catheter" <? if($arr['vascular']=='catheter'){ echo "selected"; }?>>Catheter</option>
        <option value="no" <? if($arr['vascular']=='no'){ echo "selected"; }?>>ยังไม่ได้ทำ</option>
      </select>
    </span></td>
    <td class="tb_font_2">&nbsp;</td>
    <td class="tb_font_2">&nbsp;</td>
  </tr>
  <tr>
    <td class="tb_font_2">การฉีดวัคซีนตับอักเสบบี <br />
      และไข้หวัดใหญ่</td>
    <td><input type="radio" name="hepatitis" id="hepatitis1" value="1" <? if($arr["hepatitis"]==1) { echo "checked" ; } ?>/>
      ฉีด
      <input type="radio" name="hepatitis" id="hepatitis2" value="0"  <? if($arr["hepatitis"]==0) { echo "checked" ; } ?>/>
      ไม่ได้ฉีด
      </label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="tb_font_2">บุหรี่</td>
    <td><input type="radio" name="cigarette" id="cigarette1" value="1" <? if($arr["cigarette"]==1) { echo "checked" ; } ?>/>
      สูบ
      <input type="radio" name="cigarette" id="cigarette2" value="0"  <? if($arr["cigarette"]==0) { echo "checked" ; } ?>/>
      ไม่สูบ</label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="tb_font_2">โภชนาการ</td>
    <td><input type="radio" name="diet" id="diet" value="1"  <? if($arr["diet"]==1) { echo "checked" ; } ?>/>
      ให้คำแนะนำ 
       
          <input type="radio" name="diet" id="diet" value="0"  <? if($arr["diet"]==0) { echo "checked" ; } ?>/> 
          ไม่ได้ให้คำแนะนำ
</label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="tb_font_2">นักกายภาพ</td>
    <td><input type="radio" name="physical" id="physical" value="1"  <? if($arr["physical"]==1) { echo "checked" ; } ?>/>
ให้คำแนะนำ
  
    <input type="radio" name="physical" id="physical" value="0"  <? if($arr["physical"]==0) { echo "checked" ; } ?>/>
    ไม่ได้ให้คำแนะนำ</label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="tb_font_2">การบำบัดทดแทนไต </td>
    <td><input type="radio" name="guid_hd" id="guid_hd" value="1" <? if($arr["guid_hd"]==1) { echo "checked" ; } ?> />
      ให้คำแนะนำ
      <input type="radio" name="guid_hd" id="guid_hd" value="0"  <? if($arr["guid_hd"]==0) { echo "checked" ; } ?>/>
      ไม่ได้ให้คำแนะนำ
  </label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td valign="top" class="tb_font_2">หมายเหตุ</td>
    <td colspan="3">
      <textarea name="comment" cols="45" rows="5" class="forntsarabun1" id="comment"><?=$arr['comment'];?></textarea></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="button" type="submit" class="forntsarabun1" id="button" value="บันทึกข้อมูล" /><input type="hidden" name="row_id"  value="<?=$arr['row_id'];?>"/>  </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<br />
<br />
<hr />
<br />


<?

if($_POST['button']){
include("connect.inc");	


	if($_POST['id_subject']!=$arr['gfr']){
		
$sqlstage="INSERT INTO `opd_hd_stage` (`hn` ,gfr, `stage` , `start_date` )VALUES ('".$_POST['hn']."' ,'".$_POST['id_subject']."' , '".$_POST['stage']."', '".$_POST['stage_date']."');";
$querystage=mysql_query($sqlstage) or die (mysql_error());
}
	
$sql="UPDATE `opd_hd` SET `date_hd` = '".$_POST['date_hd']."',
`hn` = '".$_POST['hn']."',
`ptname` = '".$_POST['ptname']."',
`stage` = '".$_POST['stage']."',
`start_date` = '".$_POST['stage_date']."',
`bp1` = '".$_POST['bp1']."',
`bp2` = '".$_POST['bp2']."',
`bs` = '".$_POST['bs']."',
`hba1c` = '".$_POST['hba1c']."',
`ldl` = '".$_POST['ldl']."',
`ca_p` = '".$_POST['ca_p']."',
`hct` = '".$_POST['hct']."',
`hb` = '".$_POST['hb']."',
`serum_phose` = '".$_POST['serum_phose']."',
`serum_bio` = '".$_POST['serum_bio']."',
`pth` = '".$_POST['pth']."',
`hepatitis` = '".$_POST['hepatitis']."',
`vascular` = '".$_POST['vascular']."',
`guid_hd` = '".$_POST['guid_hd']."',
`gfr` = '".$_POST['id_subject']."',
`cigarette` = '".$_POST['cigarette']."',
`diet` = '".$_POST['diet']."',
`physical` = '".$_POST['physical']."',
`comment` = '".$_POST['comment']."'
WHERE `row_id` = '".$_POST['row_id']."' "	;

	
$query=mysql_query($sql) or die (mysql_error());

if($query)
{
	echo "Save Done.";
	
	if($_GET['frm1']==1){
	?>
    <script>
	window.opener.location.href = 'hd_from.php';
	window.open('','_self');
	setTimeout("self.close()",2000);
	</script>
    
    <?	
	//	echo"<meta http-equiv='refresh' content='1;url=hd_from.php'>";
	}else{
?>
<script>
window.opener.location.reload();
window.open('','_self');
setTimeout("self.close()",2000);
</script>	
<?
	}
}
else
{
	echo "Error Save [".$sql."]";
}


}




?>
</body>
</html>