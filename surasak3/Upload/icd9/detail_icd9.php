<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
-->
</style>
<?
if($_GET['do']=='view'){
	
include("../connect.inc");


$date1=$_GET['ddate'];
$icd9=base64_decode($_GET['icd9']);



$sql="SELECT  *  FROM ipcard as a ,ipicd9cm  as b WHERE  a.an=b.an and b.icd9cm='".base64_decode($_GET['icd9'])."' and date LIKE  '$date1%'";
$result = mysql_query($sql);
$rows=mysql_num_rows($result);

$n=0;

$y=substr($date1,0,4);
$m=substr($date1,5,2);

switch($m){
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
	
   $dateshow=$printmonth." ".$y;

?>
<h1 class="forntsarabun">��ª��ͼ����� icd9  :: <?=$icd9;?>  ��Ш���͹  <?=$dateshow;?><br /><br />

<table  border="2" cellpadding="0" cellspacing="0" class="forntsarabun" >
<tr bgcolor=#ffff99 onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
<td>�ӴѺ</td>
<td>�ѹ���</td>
<td>HN</td>
<td>an</td>
<td>����-ʡ��</td>
<td>diag</td>
<td>�Է��</td>
</tr>
<?
while($dbarr=mysql_fetch_array($result)) {
$n++;


?>
	<tr  onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
	<td><?=$n;?></td>
	<td><?=$dbarr['date'];?></td>
    <td><?=$dbarr['hn'];?></td>
	<td><?=$dbarr['an'];?></td>
	<td><?=$dbarr['ptname'];?></td>
	<td><?=$dbarr['diag'];?></td>
	<td><?=$dbarr['ptright'];?></td>
</tr>
<? } ?>
</table>
<?
}
?>
<input name="btnButton" type="button" value="��Ѻ˹�����" onClick="JavaScript:history.back();" class="forntsarabun" />