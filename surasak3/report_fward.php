<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.fornbody {
	font-family: "TH SarabunPSK";
	font-size: 18px;
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
<div id="no_print">
<form name="f1" action="" method="post">
  <table  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse">
  <tr class="forntsarabun">
    <td colspan="2" bgcolor="#99CC99">��§ҹʶԵ� �ͼ�����</td>
    </tr>
  <tr class="forntsarabun">
    <td  align="right"><span class="forntsarabun">��͹/��</span></td>
    <td >
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
      <a href="nindex.htm" class="forntsarabun">��Ѻ������ѡ</a>
      </td>
  </tr>
</table>
</form>
<HR>
</div>
<?php
if($_POST['submit']){
	
	
include("connect.inc"); 
$month=$_POST['m_start'];

$year1=$_POST['y_start'];
$year2=$_POST['y_start']-543;

$date1=$year1.'-'.$month;

$date2=$year2.'-'.$month.'-01';
$daysleep=0;

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

/////  ward ��� //










$w='42';

$tsql1="CREATE TEMPORARY TABLE   fward  Select * from   ipcard  WHERE bedcode  like '$w%' AND (dcdate = '0000-00-00 00:00:00' OR dcdate
LIKE '$date1%') ";
$tquery1 = mysql_query($tsql1);

$tsql2="CREATE TEMPORARY TABLE   fward2  Select * from   ipcard  WHERE bedcode  like '$w%' ";
$tquery2 = mysql_query($tsql2);
	
	$sql1="SELECT  substring(date,1,7)as  subdate FROM  fward  order by date ASC limit 1 ";
	$query1 = mysql_query($sql1);
	$arr1=mysql_fetch_array($query1);
	
	
	$lastmonth =date('Y-m-d', strtotime("-1 month",strtotime($date2)));

	$sublastmounth=substr($lastmonth,0,7);
	
	$mounth1=explode("-",$sublastmounth);
	
	$datemounth=($mounth1[0]+543).'-'.$mounth1[1];
	
	$sql2="SELECT * FROM fward  WHERE  date between  '$arr1[subdate]' and '$datemounth' ";
	echo $sql2;
	$query2 = mysql_query($sql2);
	
	$row2=mysql_num_rows($query2);
	
	$sql3="SELECT * FROM fward2  WHERE  date like '$date1%' ";
	$query3 = mysql_query($sql3);
	$row3=mysql_num_rows($query3);
	
	
	$total1=$row2+$row3;
	$calday = cal_days_in_month(CAL_GREGORIAN , $month, $year1);

	$sql4="SELECT * FROM fward  WHERE dcdate like '$date1%' and date between  '$arr1[subdate]' and '$datemounth'";
	$query4 = mysql_query($sql4);
	while($row4=mysql_fetch_array($query4)){
		$daysleep+=substr($row4['dcdate'],8,2);	
	}

	$sql5="SELECT * FROM fward  WHERE dcdate not like '$date1%' and date between  '$arr1[subdate]' and '$datemounth'";
	$query5 = mysql_query($sql5);
	while($row5=mysql_fetch_array($query5)){
		$daysleep+=$calday;
	}
	
	$sql4="SELECT * FROM fward2  WHERE  date like '$date1%' and dcdate like '$date1%' ";
	$query4 = mysql_query($sql4);
	while($row4=mysql_fetch_array($query4)){
		$daysleep2+=substr($row4['dcdate'],8,2);
	}
	
	$sql5="SELECT * FROM fward2  WHERE  date like '$date1%' and dcdate not like '$date1%' ";
	$query5 = mysql_query($sql5);
	while($row5=mysql_fetch_array($query5)){
		$daysleep2+=$calday;
	}



	?>
<table width="100%" border="0" class="forntsarabun">
  <tr>
    <td align="center">Ẻ��§ҹʶԵ� �ͼ�������� ��Ш���͹  <?=$dateshow;?></td>
  </tr>
  <tr>
    <td align="center">�ç��Һ�Ť�������ѡ�������� �.�ӻҧ</td>
  </tr>
</table>

<table width="100%" border="0" class="fornbody">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>1.�ӹǹ������㹷�����   <?=$total1;?></td>
  </tr>
  <tr>
    <td>1.1 ������㹷���ҧ�ҡ��͹��͹  <?=$row2;?></td>
  </tr>
  <tr>
    <td>1.2 �Ѻ�������͹���      <?=$row3;?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>2. �ӹǹ�ѹ�͹�ç��Һ��</td>
  </tr>
  <tr>
    <td>2.1 �ӹǹ�ѹ�͹ �.�. �ͧ������㹷���ҧ�ҡ��͹��͹ <?=$daysleep;?></td>
  </tr>
  <tr>
    <td>2.2 �ӹǹ�ѹ�͹ �.�. �ͧ������㹷���Ѻ�������͹��� <?=$daysleep2;?></td>
  </tr>
  <tr>
    <td>(�ѹ�͹ �.�. ��ѹ����˹���ź�����ѹ����Ѻ �� �Ѻ�ѹ��� 8 ��˹����ѹ��� 12 �ӹǹ�ѹ�͹ �.�. ��� 4 ������ͧ�ӹ֧�֧���ҷ���Ѻ���ͨ�˹��� ��ùѺ�ѹ�����ѹ ���������§�׹ ���������ѹ����)</td>
  </tr>
  <tr>
    <td>3. �ѵ�Ҥ�ͧ��§ %</td>
  </tr>
  <tr>
    <td>4.�ӹǹ��§�ͧ�ͼ�����  ��§</td>
  </tr>
  <tr>
    <td>5.�ӹǹ������ Refer ���</td>
  </tr>
  <tr>
    <td>6.�ӹǹ�����¨�˹���  ���</td>
  </tr>
  <tr>
    <td>7. �����·�����ª��Ե������͹��� ( ��������ôҷ�����ª��Ե�ҡ��ä�ʹ , ��á�á�Դ������ª��Ե�ҹ� 7 �ѹ�ѹ�á , �����·�����ª��Ե�����ҧ��ü�ҵѴ )</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>

<? } ?>