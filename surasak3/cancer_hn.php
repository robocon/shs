<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
@media print{
#no_print{
	display:none;
	}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
<form name="f1"  method="post" action="cancer_hn.php">
  <table  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse">
  <tr class="forntsarabun">
    <td colspan="2" bgcolor="#99CC99">�����������</td>
    </tr>
  <tr class="forntsarabun">
    <td  align="right"><span class="forntsarabun">�к� HN</span></td>
    <td ><input type="text" name="hn" class="forntsarabun"/></td>
    </tr>
  <tr>
    <td colspan="2" align="center"><input name="b1" type="submit" class="forntsarabun" value="����"/>&nbsp;&nbsp;
    <!--<input type="button" name="button" value="�������§ҹ"  onClick="JavaScript:window.print();" class="forntsarabun">-->
      <a href="../nindex.htm" class="forntsarabun">��Ѻ������ѡ</a>
      </td>
  </tr>
</table>
</form>
<HR>
<?php

if(isset($_POST['b1'])){

include("connect.inc"); 

/*if($_POST['d_start']!=''){
$date1=$_POST['y_start'].'-'.$_POST['m_start'].'-'.$_POST['d_start'];
$day="�ѹ���";
}else{
$date1=$_POST['y_start'].'-'.$_POST['m_start'];
$day="��͹";
}*/

/*switch($_POST['m_start']){
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
	  $dateshow=$_POST['d_start']." ".$printmonth." ".$_POST['y_start'];*/
	
	$sql1="SELECT * FROM cancer Where hn='".$_POST['hn']."'";
	$query1 = mysql_query($sql1);
	$row=mysql_num_rows($query1);
	if($row){
	$i=1;	
/*	 print "<div><font class='forntsarabun' >ʶԵ�   �����µ�Ǩ����Ѵ�Ǫ��ʵ���鹿� ��Ш�$day  $dateshow </font></div><br>";*/
	?>
   <table  border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun"> 
    <tr bgcolor="#0099FF">
    <td align="center">�ӴѺ</td>
    <td align="center">�ѹ���</td>
    <td align="center">HN</td>
    <td align="center">����-ʡ��</td>
    <td align="center">���ʺѵû�ЪҪ�</td>
    <td align="center">��������§ҹ</td>
    </tr>
    <?
	while($arr1=mysql_fetch_array($query1)){		
	
	$str="select yot,name,surname,idcard, date_format(dbirth,'%d-%m-%Y'), concat(address,' ', tambol,' ', ampur,' ', changwat) as address, nation, religion, sex, married, dbirth from opcard where hn='".$arr1["hn"]."'";

$strresult = mysql_query($str) or die(mysql_error());
$strarr = mysql_fetch_array($strresult);
$name1=$strarr['yot'].' '.$strarr['name'];
$name2=$strarr['surname'];
	?>
    <tr>
      <td align="center"><?=$i;?></td>
      <td><?=$arr1['thidate']?></td>
      <td><?=$arr1['hn']?></td>
      <td><?=$name1." ".$name2?></td>
      <td><?=$arr1['id']?></td>
      <td align="center"><a href="cancer_report.php?hn=<?=$arr1['hn'];?>"><img src="print.png" width="37" height="34"  border="0"/></a></td>
     </tr>
    <? $i++;
	}  
	?>
    </table>
<?

}else{
	echo "<font class=\"forntsarabun\">����բ����Ţͧ HN ::  $_POST[hn]</font>";
}
}
?>