<?
include("../connect.inc");

?>
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
<div id="no_print" >
<form name="f1" action="" method="post" onsubmit="JavaScript:return fncSubmit();">
<table width="402"  border="0" cellpadding="3" cellspacing="3">
  <tr class="forntsarabun">
    <td width="111"  align="right">���͡ ��͹ /��</td>
    <td width="270" >
      <? $m=date('m'); ?>
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
      <? 
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
				?></td>
    </tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="����"/>&nbsp;&nbsp;
      <input type="button" name="button" value="�������§ҹ"  onClick="JavaScript:window.print();" class="forntsarabun">
      <a href="../../nindex.htm" class="forntsarabun">��Ѻ������ѡ</a>
    </td>
    </tr>
</table>
</form>

<hr />
</div>
<?php
if(isset($_POST['submit'])){

$date1=$_POST['y_start'].'-'.$_POST['m_start'];

switch($_POST['m_start']){
		case "01": $printmonth = "���Ҥ�"; break;
		case "02": $printmonth = "����Ҿѹ��"; break;
		case "03": $printmonth = "�չҤ�"; break;
		case "04": $printmonth = "����¹"; break;
		case "05": $printmonth = "����Ҥ�"; break;
		case "06": $printmonth = "�Զع�¹"; break;
		case "07": $printmonth = "�á�Ҥ�"; break;
		case "08": $printmonth = "�ԧ�Ҥ�"; break;
		case "09": $printmonth = "�ѹ��¹"; break;
		case "10": $printmonth = "���Ҥ�"; break;
		case "11": $printmonth = "��Ȩԡ�¹"; break;
		case "12": $printmonth = "�ѹ�Ҥ�"; break;
	}

 $dateshow=$printmonth." ".$_POST['y_start'];
 
 print "<font class='forntsarabun' >Ẻ��§ҹ������� ��Ш���͹  $dateshow </font><br />
<br />";

$strsql="SELECT icd9cm, COUNT( * ) AS Cdetail
FROM ipicd9cm
WHERE admdate
LIKE  '$date1%'
GROUP BY icd9cm
ORDER BY Cdetail DESC";
$result=mysql_query($strsql);
$rows=mysql_num_rows($result);

?>
<table border="1" cellspacing="0" cellpadding="0" class="forntsarabun" style="border-collapse:collapse" bordercolor="#000000">
    <tr bgcolor=#ffff99 onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
    <td>�ӴѺ</td>
    <td align="center"><span class="forntsarabun1">icd9</span></td>
    <td>�ӹǹ</td>
  </tr>
  <?
if($rows>0){

while($dbarr=mysql_fetch_array ($result)) {
$n++;

$icd9cm=$dbarr['icd9cm'];
$Cdetail=$dbarr['Cdetail'];
  ?>
  <tr onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
    <td align="center"><?=$n;?></td>
    <td><a href='detail_icd9.php?do=view&ddate=<?=$date1;?>&icd9=<?=base64_encode($icd9cm);?>'><?=$icd9cm;?></a></td>
    <td align="center"><?=$dbarr['Cdetail'];?></td>
  </tr>
  <? 
  $sum+=$dbarr['Cdetail'];
  } ?>
  <tr>
    <td colspan="2" align="center" bgcolor="#99FFCC">���</td>
    <td align="center" bgcolor="#99FFCC"><?=$sum;?></td>
  </tr>
<?
}else{ 
echo "<tr><td colspan='3' align='center'>��辺��¡��</td></tr>";
}
?>
</table>
<?
} 
?>