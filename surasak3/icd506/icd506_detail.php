<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
-->
</style>
<?
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
<h1 class="forntsarabun">��§ҹ��Ш� ��͹ <?= $dateshow;?> <a target=_self  href='../nindex.htm'><-----�����</a></h1>
<table border="1" cellspacing="0" cellpadding="0" class="forntsarabun" bordercolor="#000000" style="border-collapse:collapse">
 <tr bgcolor=#ffff99 onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
  <th>�ӴѺ</th>
  <th>icd10</th>
  <th>�ѹ-����</th>
  <th>����-ʡ��</th>
  <th>HN</th>
  <th>diag</th>
  <th>ᾷ��</th>
 </tr>
 <?php
if (!empty($icd10)){
    include("Connections/connect.inc.php");
 /* $query="CREATE TEMPORARY TABLE patdata1 SELECT * FROM patdata WHERE date LIKE '$yrmonth%' and depart = 'xray' ";
    $result = mysql_query($query) or die("Query failed,opday");*/

    $query = "SELECT ref_icd10,thidate,ptname,hn,diag,doctor FROM opday WHERE ref_icd10='$icd10' and thidate LIKE '$date1%'";
    $result = mysql_query($query) or die("query failed,opcard");
 	$n=0;
    while (list ($icd10,$thidate,$ptname,$hn,$diag,$doctor) = mysql_fetch_row ($result)) {
  $n++;
      
?>
 <tr onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
   <th><?=$n;?></th>
   <th><?=$icd10;?></th>
   <th align="left"><?=$thidate;?></th>
   <th align="left"><a href='icd506_detail2.php?hn=<?=$hn;?>'><?=$ptname;?></a></th>
   <th><?=$hn;?></th>
   <th><?=$diag;?></th>
   <th align="left"><?=$doctor;?></th>
 </tr>
<? 
	}
}
?>

</table>