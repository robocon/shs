<? 
session_start();
?>
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
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date_eye'));

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
<?
	
	include("connect.inc");	
	
	
	
	
	$strSQL = "SELECT * FROM `opd_eye`   WHERE row_id = '".$_GET['id']."' ";
	$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
	$objResult = mysql_fetch_array($objQuery);	
	
	

	
?>
<form action="" method="POST" name="frmMain">
<table  border="0" align="center" class="forntsarabun1">
  <tr>
    <td bgcolor="#FFFFCE" class="tb_font_2">hn</td>
    <td bgcolor="#FFFFCE"><!--OnChange="JavaScript:doCallAjax('hn','ptname','bp1','bp2','cigarette1','cigarette2','stage');"-->
      <input name="hn" type="text" class="forntsarabun1" id="hn"  value="<?=$objResult['hn'];?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFCE" class="tb_font_2">ชื่อ-สกุล</td>
    <td bgcolor="#FFFFCE"><input name="ptname" type="text" class="forntsarabun1" id="ptname" value="<?=$objResult['ptname'];?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFCE" class="tb_font_2">วันที่</td>
    <td bgcolor="#FFFFCE"><input name="date_eye" type="text" class="forntsarabun1" id="date_eye"  value="<?=date("Y-m-d");?>"/></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFCE" class="tb_font_2">FBS</td>
    <td bgcolor="#FFFFCE"><input  name="fbs"  type="text" class="forntsarabun1" id="fbs" value="<?=$objResult['fbs']?>"/>      
      mg% </td>
  </tr>
  <tr>
    <td bgcolor="#FFFFCE" class="tb_font_2">HBA1C</td>
    <td bgcolor="#FFFFCE"><input  name="hba1c"  type="text" class="forntsarabun1" id="hba1c" value="<?=$objResult['hba1c']?>"/>
      %</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFCE" class="tb_font_2">ผลDR</td>
    <td bgcolor="#FFFFCE">
      <select name="dr" id="dr" class="forntsarabun1">
       <option value="">--กรุณาเลือก DR--</option>
      <option value="NoDR"  <? if($objResult['dr']=="NoDR"){ echo "selected";} ?>>No DR</option>
      <option value="Mild" <? if($objResult['dr']=="Mild"){ echo "selected";} ?>>Mild NPDR </option>
      <option value="Moderate" <? if($objResult['dr']=="Moderate"){ echo "selected";} ?>>Moderate NPDR</option>
      <option value="Severe" <? if($objResult['dr']=="Severe"){ echo "selected";} ?>>Severe NPDR</option>
      <option value="PDR" <? if($objResult['dr']=="PDR"){ echo "selected";} ?>>PDR</option>
      </select></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFCE" class="tb_font_2">สิทธิ</td>
    <td bgcolor="#FFFFCE"><input  name="ptright"  type="text" class="forntsarabun11" id="ptright" value="<?=$objResult['ptright'];?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFCE" class="tb_font_2">หมายเหตุ</td>
    <td bgcolor="#FFFFCE">
      <textarea name="comment" cols="45" rows="5" class="forntsarabun1" id="comment" ><?=$objResult['comment'];?></textarea></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFCE">&nbsp;</td>
    <td bgcolor="#FFFFCE"><input type="hidden" name="row_id" value="<?=$objResult['row_id'];?>" /><input name="button" type="submit" class="forntsarabun1" id="button" value="บันทึกข้อมูล" />  </td>
  </tr>
</table>
</form>
<br />
<br />
<hr />
<br />

<?

if(isset($_POST['button']) && $_POST['button']!=''){
include("connect.inc");	
	$regis=date("Y-m-d H:i:s");
	
$sql="UPDATE `opd_eye` SET 
`date_eye` = '".$_POST['date_eye']."',
`hn` = '".$_POST['hn']."',
`ptname` = '".$_POST['ptname']."',
`ptright` ='".$_POST['ptright']."',
`fbs` ='".$_POST['fbs']."',
`hba1c` ='".$_POST['hba1c']."',
`dr` ='".$_POST['dr']."',
`comment` = '".$_POST['comment']."',
`officer` = '".$sOfficer."'  WHERE `row_id` = '".$_POST['row_id']."' ";
$query=mysql_query($sql) or die (mysql_error());

if($query)
{
	echo "Save Done.";
	
	if($_GET['frm1']==1){
	?>
    <script>
	window.opener.location.href = 'eye_from.php';
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
}else{
	echo "Error Save [".$sql."]";
}

}

//include('hd_list.php');
?>
</body>
</html>