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
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date_hd'));

};


function fncSubmit()
{
	
		if(document.frmMain.hn.value == "")
	{
		alert('��س��к� HN');
		document.frmMain.hn.focus();		
		return false;
	}	
			if(document.frmMain.ptname.value == "")
	{
		alert('��س��к� ����-ʡ�� ');
		document.frmMain.ptname.focus();		
		return false;
	}	
		if(document.frmMain.stage.value == "")
	{
		alert('��س����͡ stage');
		document.frmMain.stage.focus();		
		return false;
	}	
	document.frmMain.submit();
}

</script>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
  <form action="" method="POST" name="frmMain1">
<!--  <table  border="0" align="center" bordercolor="#393939" bgcolor="#FFFFCE">
  <tr>
     <td align="center" bgcolor="#0000CC" class="forntsarabun">��͡�����Ţ HN</td>
    <td><input  type="text"  name="pHn"/></td>
  </tr>
  <tr>
    <td>�ѹ���</td>
    <td><input type="text" name="date_eye" id="date_eye"  value="<?//=date("Y-m-d");?>"/></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="button2" id="button2" value="��ŧ" /></td>
    </tr>
  <tr>
    <td colspan="2" align="center"><a  class="font2" target="_top" href="../nindex.htm">&lt;&lt;�����</a> &nbsp;&nbsp; <a href="hd_list.php" target="_blank">��ª��� opd ��</a></td>
  </tr>
  </table>-->
  <table  border="0" align="center" bordercolor="#393939" bgcolor="#FFFFCE">
  <tr>
    <td align="center" bgcolor="#9900CC" class="forntsarabun">��͡�����Ţ HN</td>
    </tr>
  <tr>
    <td class="forntsarabun"><input  name="pHn"  type="text" class="forntsarabun1"/></td>
    </tr>
  <tr>
    <td align="center"><input name="button2" type="submit" class="forntsarabun1" id="button2" value="��ŧ" /></td>
    </tr>
  <tr>
    <td align="center"><a  class="forntsarabun1" target="_top" href="nindex.htm">&lt;&lt;�����</a> &nbsp;&nbsp; <a href="eye_list.php" target="_blank" class="forntsarabun1">��ª��� opd ��</a></td>
  </tr>
  <tr>
      <td><a class="forntsarabun1" href="report_opdeye.php">opd����ػ�ʹ�����</a></td>
  </tr>
  </table>
</form>  
<hr />
<? if(isset($_POST['pHn'])){
	
	include("connect.inc");	
	
	$sqlchk="SELECT * FROM `opd_eye` WHERE hn = '".$_POST['pHn']."' ";
	$querychk=mysql_query($sqlchk)or die ("Error Query [".$sqlchk."]");
	$rowchk=mysql_num_rows($querychk);
	$arr=mysql_fetch_assoc($querychk);
	if($rowchk >0){
		
		
		echo "<div align='center' class='forntsarabun1'>HN : ".$_POST['pHn']." &nbsp;��������к�����¹�������ä��<br>";
		?>
<a href="javascript:MM_openBrWindow('eye_from_edit.php?id=<?=$arr['row_id'];?>&frm1=1','','toolbar=no,location=no,status=n o,menubar=no,scrollbars=yes,resizable=yes,width=800, height=600')">��ͧ�����䢢�����</a>
        <?
		//echo "��ͧ�����䢢�����  <a href='hd_from_edit.php?cHn=$_POST[pHn]' target='_blank'>����</a> </div>";
		
	
	}else{
	
	
	$strSQL = "SELECT  hn,concat(yot,name,' ',surname)as ptname,ptright FROM opcard  WHERE hn = '".$_POST['pHn']."' ";
	$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
	$objResult = mysql_fetch_array($objQuery);	
	
	
	$laball="Select result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$objResult["hn"]."' and  a.labcode='GLU'   Order by b.orderdate desc limit 1";
	  $result_laball=mysql_query($laball);
	  $dall=mysql_fetch_array($result_laball);
	
	
	 $laball1="Select result,unit,orderdate from  resultdetail AS a, resulthead AS b   WHERE  a.autonumber = b.autonumber AND b.hn='".$objResult["hn"]."' and  a.labcode='HBA1C'  Order by b.orderdate desc limit 1";
	  $result_laball1=mysql_query($laball1);
	  $dall1=mysql_fetch_array($result_laball1);
	
?>
<form action="" method="POST" name="frmMain">
<table  border="0" align="center" class="forntsarabun1">
  <tr>
    <td bgcolor="#FFFFCE" class="tb_font_2">hn</td>
    <td bgcolor="#FFFFCE"><!--OnChange="JavaScript:doCallAjax('hn','ptname','bp1','bp2','cigarette1','cigarette2','stage');"-->
      <input name="hn" type="text" class="forntsarabun1" id="hn"  value="<?=$objResult['hn'];?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFCE" class="tb_font_2">����-ʡ��</td>
    <td bgcolor="#FFFFCE"><input name="ptname" type="text" class="forntsarabun1" id="ptname" value="<?=$objResult['ptname'];?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFCE" class="tb_font_2">�ѹ���</td>
    <td bgcolor="#FFFFCE"><input name="date_eye" type="text" class="forntsarabun1" id="date_eye"  value="<?=date("Y-m-d");?>"/></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFCE" class="tb_font_2">FBS</td>
    <td bgcolor="#FFFFCE"><input  name="fbs"  type="text" class="forntsarabun1" id="fbs" value="<?=$dall['result']?>"/>      
       mg% </td>
  </tr>
  <tr>
    <td bgcolor="#FFFFCE" class="tb_font_2">HBA1C</td>
    <td bgcolor="#FFFFCE"><input  name="hba1c"  type="text" class="forntsarabun1" id="hba1c" value="<?=$dall1['result']?>"/>
      %</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFCE" class="tb_font_2">��DR</td>
    <td bgcolor="#FFFFCE">
      <select name="dr" id="dr" class="forntsarabun1">
       <option value="">--��س����͡ DR--</option>
      <option value="NoDR">No DR</option>
      <option value="Mild">Mild NPDR </option>
      <option value="Moderate">Moderate NPDR</option>
      <option value="Severe">Severe NPDR</option>
      <option value="PDR">PDR</option>
      </select></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFCE" class="tb_font_2">�Է��</td>
    <td bgcolor="#FFFFCE"><input  name="ptright"  type="text" class="forntsarabun11" id="ptright" value="<?=$objResult['ptright'];?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFCE" class="tb_font_2">�����˵�</td>
    <td bgcolor="#FFFFCE">
      <textarea name="comment" cols="45" rows="5" class="forntsarabun1" id="comment"></textarea></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFCE">&nbsp;</td>
    <td bgcolor="#FFFFCE"><input name="button" type="submit" class="forntsarabun1" id="button" value="�ѹ�֡������" />  </td>
  </tr>
</table>
</form>
<br />
<br />
<hr />
<br />


<?
}// end if row--- opd_eye
}

if(isset($_POST['button']) && $_POST['button']!=''){
include("connect.inc");	
	$regis=date("Y-m-d H:i:s");
	


$sql="INSERT INTO `opd_eye` ( `register` , `date_eye` , `hn` , `ptname` , `ptright` , `fbs` , `hba1c` , `dr` , `comment` , `officer` )
VALUES ( '".$regis."', '".$_POST['date_eye']."', '".$_POST['hn']."', '".$_POST['ptname']."', '".$_POST['ptright']."', '".$_POST['fbs']."', '".$_POST['hba1c']."', '".$_POST['dr']."', '".$_POST['comment']."','".$sOfficer."');";
$query=mysql_query($sql) or die (mysql_error());

if($query){
echo "�ѹ�֡���������º��������";
echo"<meta http-equiv='refresh' content='1;url=eye_from.php'>";
}
}

?>
</body>
</html>