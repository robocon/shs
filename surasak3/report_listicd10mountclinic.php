<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>��§ҹ 10 �ѹ�Ѻ�ä��Ш���͹</title>
<style type="text/css">

body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
.forntsarabun1 {	font-family: "TH SarabunPSK";
	font-size: 18px;
}

</style>
</head>
<?
include("connect.inc");
$m=date('m');
?>
<body>
<div align="center">
<p align="center"><strong>��§ҹ 10 �ѹ�Ѻ�ä��Ш���͹</strong></p>
<form action="report_listicd10mountclinic.php" method="post" name="form1">
<input name="act" type="hidden" value="show" />
��չԡ : 
<select name="clinic" class="forntsarabun" id="clinic">
<option value="01 ����á���">����á���</option>  
<option value="02 ���¡���">���¡���</option>  
</select> 
��͹ : 
<select name="m_start" class="forntsarabun">
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
    <a href="../nindex.htm" class="forntsarabun">��Ѻ������ѡ</a>
</form>
</div>
<hr />
<?php
if($_POST["act"]=="show"){
$clinic=$_POST["clinic"];
$date=$_POST["y_start"]."-".$_POST["m_start"];
$showdate=$_POST["m_start"]."/".$_POST["y_start"];

if( $clinic == '01 ����á���' ){
  $where_clinic = " AND clinic LIKE '%����á���%' ";
}else{
  $where_clinic = " AND clinic LIKE '%���¡���%' ";
}

$sql="SELECT icd10, count( icd10 )  AS num
FROM  `opday` 
WHERE ( icd10 IS NOT NULL AND icd10 !='') 
AND `thidate` LIKE  '$date%' 
$where_clinic
GROUP  BY icd10
ORDER  BY count( icd10 )  DESC 
LIMIT 10";

$query= mysql_query($sql); 
$rows=mysql_num_rows($query);
?>
<p align="center"><strong>��§ҹ 10 �ѹ�Ѻ�ä<br />
��Ш���͹ <?=$showdate;?>  ��չԡ : <? echo $clinic;?></strong></p>
<table width="80%" border="1" align="center" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
<tr>
        <td width="8%" align="center" bgcolor="#66CC99"><strong>�ӴѺ</strong></td>
    <td width="14%" align="center" bgcolor="#66CC99"><strong>icd10</strong></td>
    <td width="33%" align="center" bgcolor="#66CC99"><strong>�����ä(��)</strong></td>
    <td width="35%" align="center" bgcolor="#66CC99"><strong>�����ä(�ѧ���)</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>�ӹǹ</strong></td>
  </tr>
<?  
if($rows){
$i=0;
while(list($icd10,$num) = mysql_fetch_array($query)){  
	$i++;
	$sql1=mysql_query("select detail, diag_thai from icd10 where code='$icd10'");
	list($detail,$diag_thai)=mysql_fetch_array($sql1);
?>
<td align="center" bgcolor="#CCFFCC"><?=$i;?></td>
<td bgcolor="#CCFFCC"><?=$icd10;?></td>
<td bgcolor="#CCFFCC"><?=$diag_thai;?></td>
<td bgcolor="#CCFFCC"><?=$detail;?></td>
<td align="center" bgcolor="#CCFFCC"><?=$num;?></td>
</tr>
<? 
}
}else{
 echo " <tr> <td colspan='5' class='forntsarabun' align='center'>--------- ��辺��¡�� ----------</td>
  </tr>";
}
?>
</table>
<?
}
?>
</body>
</html>
