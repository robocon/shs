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
<form name="f1" action="" method="post">
  <table  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse">
  <tr class="forntsarabun">
    <td colspan="2" bgcolor="#99CC99">��§ҹ������������   EX01&nbsp;�ѡ���ä�����������Ҫ��� ��� EX02&nbsp;�����©ء�Թ </td>
    </tr>
  <tr class="forntsarabun">
    <td  align="right"><span class="forntsarabun">�ѹ/��͹/��</span></td>
    <td >
    <? $d=date("d");?>
    <input type="text" name="d_start" value="<?=$_POST['d'];?>" class="forntsarabun"  size="5"/>
	
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
        </select><? 
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
    <!--<input type="button" name="button" value="�������§ҹ"  onClick="JavaScript:window.print();" class="forntsarabun">-->
      <a href="../nindex.htm" class="forntsarabun">��Ѻ������ѡ</a>
      </td>
  </tr>
</table>
</form>
<HR>
<?php

if($_POST['submit']){

include("connect.inc"); 

if($_POST['d_start']!=''){
$date1=$_POST['y_start'].'-'.$_POST['m_start'].'-'.$_POST['d_start'];
$day="�ѹ���";
}else{
$date1=$_POST['y_start'].'-'.$_POST['m_start'];
$day="��͹";
}

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
	  $dateshow=$_POST['d_start']." ".$printmonth." ".$_POST['y_start'];
	
print "<div><font class='forntsarabun' >�ʹ�����¹͡ ��ô֡  $day   $dateshow</font></div><br>";

$tsql1="CREATE TEMPORARY TABLE   opday1  Select * from   opday   WHERE thidate
LIKE  '$date1%' and substr( toborow, 1, 4 ) =  'EX01' AND ( date_format( `thidate` , '%H:%i:%s' )  BETWEEN '00:00:00' AND '07:59:59' )";
$tquery1 = mysql_query($tsql1);
$tsql2="CREATE TEMPORARY TABLE   opday2  Select * from   opday   WHERE thidate
LIKE  '$date1%' and substr( toborow, 1, 4 ) =  'EX02' AND ( date_format( `thidate` , '%H:%i:%s' )  BETWEEN '00:00:00' AND '07:59:59' )";
$tquery2 = mysql_query($tsql2);

/*echo $tsql1."<br>";
echo $tsql2;*/


	
	$sql1="SELECT  count(*)as ex01 FROM opday1";
	$query1 = mysql_query($sql1);
	$arr1=mysql_fetch_array($query1);
	
	$sql2="SELECT  count(*)as ex02 FROM opday2";
	$query2 = mysql_query($sql2);
	$arr2=mysql_fetch_array($query2);

	?>
   <table  border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun"> 
    <tr bgcolor="#0099FF">
    <td align="center">�ӴѺ</td>
    <td align="center">��¡��</td>
    <td align="center">�ӹǹ</td>
    </tr>
    <tr>
      <td align="center">1</td>
      <td><a href="report_exdetail.php?thidate=<?=$date1;?>&toborow=EX01" target="_blank">EX01 �ѡ���ä�����������Ҫ���</a></td>
      <td align="right"><?=$arr1['ex01']?></td>
     </tr>
    <tr>
      <td align="center">2</td>
      <td><a href="report_exdetail.php?thidate=<?=$date1;?>&toborow=EX02" target="_blank">EX02 �����©ء�Թ</a></td>
      <td align="right"><?=$arr2['ex02']?></td>
    </tr>
    <tr>
      <td colspan="2" align="center">����ʹ</td>
      <td align="right"><?=$arr1['ex01']+$arr2['ex02'];?></td>
    </tr>

    </table>
<?
}
?>