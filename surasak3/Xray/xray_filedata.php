<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>����¹������</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 16px;
}
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 16px;
}
.forntsarabun1 {	font-family: "TH SarabunPSK";
	font-size: 16px;
}
@media print{
#no_print{display:none;}
}
-->
</style>
</head>
<?
$d=date('d');
$m=date('m');
?>
<body>
<div align="center">
<div id="no_print" >
<? include('xray_menu.php'); ?>
<p align="center"><strong>����¹������</strong></p>
<form action="xray_filedata.php" method="post" name="form1">
<input name="act" type="hidden" value="show" />
�ѹ��� : <input name="d_start" type="text" class="forntsarabun" id="d_start" value="<?=$d;?>" size="3" />
��͹ : <select name="m_start" class="forntsarabun">
        <option value="01" <? if($m=='01'){ echo "selected"; }?>>���Ҥ�</option>
        <option value="02" <? if($m=='02'){ echo "selected"; }?>>����Ҿѹ��</option>
        <option value="03" <? if($m=='03'){ echo "selected"; }?>>�չҤ�</option>
        <option value="04" <? if($m=='04'){ echo "selected"; }?>>����¹</option>
        <option value="05" <? if($m=='05'){ echo "selected"; }?>>����Ҥ�</option>
        <option value="06" <? if($m=='06'){ echo "selected"; }?>>�Զع�¹</option>
        <option value="07" <? if($m=='07'){ echo "selected"; }?>>�á�Ҥ�</option>
        <option value="08" <? if($m=='08'){ echo "selected"; }?>>�ԧ�Ҥ�</option>
        <option value="09" <? if($m=='09'){ echo "selected"; }?>>�ѹ��¹</option>
        <option value="10" <? if($m=='10'){ echo "selected"; }?>>���Ҥ�</option>
        <option value="11" <? if($m=='11'){ echo "selected"; }?>>��Ȩԡ�¹</option>
        <option value="12" <? if($m=='12'){ echo "selected"; }?>>�ѹ�Ҥ�</option>
        </select> 
�� : <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' class='forntsarabun'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>
       <input name="submit" type="submit" class="forntsarabun" value="����"/>
       <a href="../../nindex.htm" class="forntsarabun">��Ѻ������ѡ</a>
</form>
<hr />
</div>
<?
if($_POST["act"]=="show"){
include("../Connections/connect.inc.php"); 
$date=$_POST["y_start"]."-".$_POST["m_start"]."-".$_POST["d_start"];
$showdate=$_POST["d_start"]."/".$_POST["m_start"]."/".$_POST["y_start"];
$sqltmp="CREATE TEMPORARY TABLE  tmpxray  SELECT * FROM xray_stat
WHERE (date  between '$date 00:00:00' and '$date 23:59:00') and cancle ='0'";
$querytmp = mysql_query($sqltmp); 
?>
<div align="center"><strong>����¹������</strong></div>
<div align="center">Ἱ��ѧ�ա��� �͡��������Ţ FR-XRA-001/4 ��䢤��駷�� 02 �ѹ����ռźѧ�Ѻ�� 20 �.�. 2554</div>
<br />
<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="6%" rowspan="2" align="center"><strong>�/�/�</strong></td>
    <td width="7%" rowspan="2" align="center"><strong>HN</strong></td>
    <td colspan="2" align="center"><strong>XN</strong></td>
    <td width="12%" rowspan="2" align="center"><strong>���� - ʡ��</strong></td>
    <td width="4%" rowspan="2" align="center"><strong>����</strong></td>
    <td width="14%" rowspan="2" align="center"><strong>�ѧ�Ѵ</strong></td>
    <td width="7%" rowspan="2" align="center"><strong>�������觨ҡ</strong></td>
    <td width="11%" rowspan="2" align="center"><strong>��Ǩ</strong></td>
    <td width="13%" rowspan="2" align="center"><strong>ᾷ�������</strong></td>
    <td colspan="3" align="center"><strong>�ӹǹ</strong></td>
    <td width="6%" rowspan="2" align="center"><strong>�����˵�</strong></td>
  </tr>
  <tr>
    <td width="6%" align="center"><strong>���</strong></td>
    <td width="3%" align="center"><strong>����</strong></td>
    <td width="3%" align="center"><strong>A4</strong></td>
    <td width="3%" align="center"><strong>CD</strong></td>
    <td width="5%" align="center"><strong>BLUE FILM</strong></td>
    </tr>
<?
	$tbsql=mysql_query("select  * from tmpxray");
	$tbnum=mysql_num_rows($tbsql);
	if($tbnum < 1){
		echo "<tr><td colspan='15'>------------------------ ����բ����� ------------------------</td></tr>";
	}else{
		$i=0;
		while($tbrows=mysql_fetch_array($tbsql)){
		$i++;
?>      
  <tr>
    <td align="left"><?=$showdate;?></td>
    <td align="left"><?=$tbrows["hn"];?></td>
    <td align="left"><?=$tbrows["xn"];?></td>
    <td align="left"><?=$tbrows["xn_new"];?></td>
    <td align="left"><?=$tbrows["ptname"];?></td>
    <td align="center"><?=$tbrows["age"];?></td>
    <td align="left"><?=$tbrows["ptright"];?></td>
    <td align="left"><?=$tbrows["patient_from"];?></td>
    <td align="left"><?=$tbrows["detail"];?></td>
    <td align="left"><?=$tbrows["doctor"];?></td>
    <td align="left">&nbsp;</td>
    <td align="left">&nbsp;</td>
    <td align="left">&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
  <?
	  	}
	}
  ?>
</table>
<?
}
?>
</div>
</div>
</body>
</html>
