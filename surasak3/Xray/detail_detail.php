<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
-->
</style>
<?
if($_GET['do']==view){

include("../Connections/connect.inc.php"); 


$date1=$_GET['ddate'];
$detail=$_GET['detail'];

/*$sql="SELECT DISTINCT a.doctor_detail, b.hn, b.ptname
FROM xray_doctor_detail AS a
INNER JOIN xray_stat AS b ON b.detail = a.detail_all
WHERE  b.date LIKE  '$date1%'  and a.doctor_detail like '%$detail%' ";*/

$sql="SELECT * FROM  `xray_doctor` 
WHERE  `date` 
LIKE  '$date1%' AND  detail_all like '%$detail%' ";


$result = mysql_query($sql);
$rows=mysql_num_rows($result);
$n=0;
//echo $sql;

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
<h1 class="forntsarabun">��ª��ͼ����µ�Ǩ��� <?=$detail;?> ��Ш���͹  <?=$dateshow;?><br />

</h1>
<table  border="2" cellpadding="0" cellspacing="0" class="forntsarabun" >
<tr bgcolor=#ffff99 onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
<td>�ӴѺ</td>
<td>�ѹ���</td>
<td>HN</td>
<td>����-ʡ��</td>
<td>��������´</td>
</tr>
<?
While($dbarr=mysql_fetch_array($result)) {
$n++;

//$ptname=$dbarr['yot'].' '.$dbarr['name'].' '.$dbarr['sname'];

?>
<tr  onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
	<td><?=$n;?></td>
	<td><?=$dbarr['date'];?></td>
	<td><?=$dbarr['hn'];?></td>
	<td><?=$dbarr['yot'].' '.$dbarr['name'].' '.$dbarr['sname'];?></td>
	<td><?=$dbarr['detail_all'];?></td>
  </tr>
<? } ?>
</table>
<?
}
?>
<input name="btnButton" type="button" value="��Ѻ˹�����" onClick="JavaScript:history.back();" class="forntsarabun" />