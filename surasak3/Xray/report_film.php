<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>��§ҹ��Ш���͹</title>
</head>
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
-->
</style>
<body>
<? @include('xray_menu.php'); ?><br />

<h1 class="forntsarabun">��§ҹ�����������Ш���͹ �¡��������� �����</h1>
<form name="f1" action="" method="post">
<table  border="0" cellpadding="3" cellspacing="3">
  <tr class="forntsarabun">
    <td  align="right"><span class="forntsarabun">��ǧ��͹</span></td>
    <td ><? $m=date('m'); ?>
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
    <td ><select name="film" class="forntsarabun">
    <option value="" selected="selected">==���͡������==</option>
    <option value="digital">digital</option>
    <option value="10_12">10_12</option>
    <option value="14_14">14_14</option>
    <option value="NONE">NONE</option> 
   </select>
    </td>
    </tr>
  <tr>
    <td colspan="3" align="center"><input name="submit" type="submit" class="forntsarabun" value="����"/>&nbsp;&nbsp;
      <a href="../../nindex.htm" class="forntsarabun">��Ѻ������ѡ</a><!--&nbsp;&nbsp; 
      <a href="xray_menu.php" class="forntsarabun">������§ҹ</a>-->
      </td>
  </tr>
</table>
</form>
<br/>

<? 
if($_POST['submit']=="����"){

include("../Connections/connect.inc.php"); 

$date1=$_POST['y_start'].'-'.$_POST['m_start'];

$film=$_POST['film'];

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

print "��§ҹ��Ш� ��͹ $dateshow <br/><br/> ";


print "��Դ����� $film <br> ";

if($film==''){
//// �Ҩӹǹ����
$query="SELECT * FROM  xray_stat  WHERE  date
LIKE  '$date1%'
ORDER BY date desc";
//// �Ҩӹǹ��
$query1="SELECT  Distinct hn FROM  xray_stat WHERE  date
LIKE  '$date1%'
ORDER BY date desc";
}else{
//// �Ҩӹǹ����
$query="SELECT * FROM  xray_stat  WHERE   date 
LIKE  '$date1%' and $film='1'
ORDER BY date desc";
//// �Ҩӹǹ��
$query1="SELECT  Distinct hn FROM  xray_stat WHERE  date
LIKE  '$date1%'  and $film='1'
ORDER BY date desc";
}

$result = mysql_query($query);  
$rows=mysql_num_rows($result);


$result1= mysql_query($query1);   
$rows1=mysql_num_rows($result1);
//echo $query;
?>
<br />
<table  border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" class="forntsarabun" style="border-collapse:collapse">
<tr bgcolor=#ffff99 onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
<td rowspan="2">�ӴѺ</td>
<td rowspan="2">�ѹ���</td>
<td rowspan="2" align="center">HN</td>
<td rowspan="2" align="center">����-ʡ��</td>
<td rowspan="2" align="center">��������´</td>
<td colspan="5" align="center">�����</td>
<td rowspan="2"  align="center">�Է��</td>
</tr>
<tr bgcolor=#ffff99 onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
  <td>digital</td>
  <td>10_12</td>
  <td>14_14</td>
  <td>NONE</td>
   <td>���������</td>
  </tr>

<?
while($dbarr=mysql_fetch_array($result)) {
	

?>
<tr  onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
	<td><?=++$n;?></td>
	<td><?=$dbarr['date'];?></td>
	<td><?=$dbarr['hn'];?></td>
	<td><?=$dbarr['ptname'];?></td>
	<td><?=$dbarr['detail'];?></td>
	<td><? if($dbarr['digital']=='1'){ echo "digital";  $c1++; }else{ echo ""; }?></td>
	<td><? if($dbarr['10_12']=='1'){ echo "10_12"; $c2++; }else{ echo ""; }?></td>
	<td><? if($dbarr['14_14']=='1'){ echo "14_14"; $c3++; }else{ echo ""; }?></td>
	<td><? if($dbarr['NONE']=='1'){ echo "NONE"; $c4++;   }else{ echo ""; }?></td>
    <td><? if($dbarr['filmbk']=='1'){ echo "����"; $c5++;   }else{ echo ""; }?></td>
	<td><?=$dbarr['ptright'];?></td>
  </tr>
<? } 


if($c1==''){
	$c1=0; 
}
if($c2==''){
	$c2=0;
}
if($c3==''){
	$c3=0;
}
if($c4==''){
	$c4=0;
}
if($c5==''){
	$c5=0;
}


if($film=='digital'){
	echo "<span class='forntsarabun'>$film �ӹǹ: ".$c1."&nbsp; </span><br/><br/>";
}elseif($film=='10_12'){
	echo "<span class='forntsarabun'>$film �ӹǹ: ".$c2."&nbsp;  </span><br/><br/>";
}elseif($film=='14_14'){
	echo "<span class='forntsarabun'>$film �ӹǹ: ".$c3."&nbsp; </span><br/><br/>";
}elseif($film=='NONE'){
	echo "<span class='forntsarabun'>$film �ӹǹ:  ".$c4." </span><br/><br/>";
}elseif($film=='����'){
	echo "<span class='forntsarabun'>$film �ӹǹ:  ".$c5." </span><br/><br/>";
}else{
	echo "<span class='forntsarabun'>digital �ӹǹ: ".$c1."&nbsp;  </span><br/><br/>";
	echo "<span class='forntsarabun'>10_12 �ӹǹ: ".$c2."&nbsp;  </span><br/><br/>";
	echo "<span class='forntsarabun'>14_14 �ӹǹ: ".$c3."&nbsp;  </span><br/><br/>";
	echo "<span class='forntsarabun'>NONE  �ӹǹ: ".$c4."&nbsp;  </span><br/><br/>";
	echo "<span class='forntsarabun'>���������  �ӹǹ: ".$c5."&nbsp;  </span><br/><br/>";
}

echo "<span class='forntsarabun'>�ʹ���: ".$rows."&nbsp;����  �ӹǹ $rows1 ��</span><br/><br/>";

?>
</table>


<?
}
?>
</body>
</html>
