<? 
session_start();
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>�к���§ҹ�˵ء�ó��Ӥѭ/�غѵԡ�ó�/��������ʹ���ͧ</title>
    <!-- InstanceEndEditable -->
    <link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script>
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>
<body>

<style type="text/css">
* { margin:0;
    padding:0;
}
ody { /*background:rgb(74,81,85); */}
div#menu { margin:5px auto; }
div#copyright {
    font:11px 'Trebuchet MS';
    color:#fff;
    text-indent:30px;
    padding:40px 0 0 0;
}
td,th {
	font-family:"TH SarabunPSK";
	font-size: 20 px;
}
.fontsara {
	font-family:"TH SarabunPSK";
	font-size: 18 px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 

/*div#copyright a { color:#00bfff; }
div#copyright a:hover { color:#fff; }*/
</style>
<div id="no_print">
<div id="menu">
<ul class="menu">
  <li><a href="http://192.168.1.2/sm3/nindex.htm" class="parent"><span>˹���á</span></a></li>
  <li><a href="gward_report_doctor.php" class="parent"><span>��§ҹ������㹵��ᾷ��</span></a></li>
  <li><a href="report_wardlog.php" class="parent"><span>��§ҹ�������¹�����ż�����</span></a></li>

  <li>
    <a href="#"><span>ʶԵ��ͼ����»�Ш���͹</span></a>
    <ul>
      <li class="last"><a href="report_fward.php"><span>�ͼ��������</span></a></li>
      <li class="last"><a href="report_gward.php"><span>�ͼ������ٵ�</span></a></li>
      <li class="last"><a href="report_icuward.php"><span>�ͼ�����˹ѡ</span></a></li>
      <li class="last"><a href="report_vipward.php"><span>�ͼ����¾����</span></a></li>
    </ul>
  </li>
     
  <li>
    <a href="#"><span>Diagnosis ��Шӻ�</span></a>
    <ul>
      <li class="last"><a href="report_icd10_ofyear.php?code=42"><span>�ͼ��������</span></a></li>
      <li class="last"><a href="report_icd10_ofyear.php?code=43"><span>�ͼ������ٵ�</span></a></li>
      <li class="last"><a href="report_icd10_ofyear.php?code=44"><span>�ͼ�����˹ѡ</span></a></li>
      <li class="last"><a href="report_icd10_ofyear.php?code=45"><span>�ͼ����¾����</span></a></li>
    </ul>
  </li>

  <li>
    <a href="#"><span>Diagnosis Top5 ��Шӻ�</span></a>
    <ul>
      <li class="last"><a href="report_icd10_top5.php?code=42"><span>�ͼ��������</span></a></li>
      <li class="last"><a href="report_icd10_top5.php?code=43"><span>�ͼ������ٵ�</span></a></li>
      <li class="last"><a href="report_icd10_top5.php?code=44"><span>�ͼ�����˹ѡ</span></a></li>
      <li class="last"><a href="report_icd10_top5.php?code=45"><span>�ͼ����¾����</span></a></li>
    </ul>
  </li>
     
  <li>
    <a href="#"><span>��§ҹ���������ª��Ե</span></a>
    <ul>
      <li class="last"><a href="report_dead.php?code=42"><span>�ͼ��������</span></a></li>
      <li class="last"><a href="report_dead.php?code=43"><span>�ͼ������ٵ�</span></a></li>
      <li class="last"><a href="report_dead.php?code=44"><span>�ͼ�����˹ѡ</span></a></li>
      <li class="last"><a href="report_dead.php?code=45"><span>�ͼ����¾����</span></a></li>
    </ul>
  </li>
  <li><a href="report_age15.php" class="parent"><span>��ª��������ص�ӡ��� 15��</span></a></li>
  </ul>
</div>

<div style="visibility: hidden">
 <br />
 <a href="http://apycom.com/">a</a><br />
</div>

</div>


<div><!-- InstanceBeginEditable name="detail" -->
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
      <!--<input type="button" name="button" value="�������§ҹ"  onClick="JavaScript:window.print();" class="forntsarabun">--></td>
  </tr>
</table>
</form>
<HR>
</div>
<?php
if($_POST['submit']){
	
?>
<script>
window.print() ;
</script>
<?	
	
include("../connect.inc"); 
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

/////  ward �ٵ� //










$w='43';

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
	$query2 = mysql_query($sql2);
	
	$row2=mysql_num_rows($query2);
	
	$sql3="SELECT * FROM fward2  WHERE  date like '$date1%' ";
	$query3 = mysql_query($sql3);
	$row3=mysql_num_rows($query3);
	
	
	$total1=$row2+$row3;
	$calday = cal_days_in_month(CAL_GREGORIAN , $month, $year1);
	
	
	$sql4="SELECT * FROM fward  WHERE  date like '$date1%' and dctype like '%transfer%' ";
	$query4 = mysql_query($sql4);
	$row4=mysql_num_rows($query4);
	
	$sql5="SELECT * FROM fward  WHERE  dcdate != '0000-00-00 00:00:00'  ";
	$query5 = mysql_query($sql5);
	$row5=mysql_num_rows($query5);

/*	$sql4="SELECT * FROM fward  WHERE dcdate like '$date1%' and date between  '$arr1[subdate]' and '$datemounth'";
	$query4 = mysql_query($sql4);
	echo $sql;
	while($row4=mysql_fetch_array($query4)){
		
		
		$daysleep1+=substr($row4['dcdate'],8,2);
		
	
	}*/

/*	$sql5="SELECT * FROM fward  WHERE dcdate not like '$date1%' and date between  '$arr1[subdate]' and '$datemounth'";
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
*/
	?>
<table width="100%" border="0" class="forntsarabun">
  <tr>
    <td align="center">Ẻ��§ҹʶԵ� �ͼ������ٵ� ��Ш���͹  <?=$dateshow;?></td>
  </tr>
  <tr>
    <td align="center">�ç��Һ�Ť�������ѡ�������� �.�ӻҧ</td>
  </tr>
</table>

<table width="100%" border="0" class="fornbody">
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6">1.�ӹǹ������㹷�����..........<?=$total1;?>........��</td>
  </tr>
  <tr>
    <td colspan="6">1.1 ������㹷���ҧ�ҡ��͹��͹ ..........<?=$row2;?>........��</td>
  </tr>
  <tr>
    <td colspan="6">1.2 �Ѻ�������͹���..........<?=$row3;?>........��</td>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6">2. �ӹǹ�ѹ�͹�ç��Һ��...........................................�ѹ</td>
  </tr>
  <tr>
    <td colspan="6">2.1 �ӹǹ�ѹ�͹ �.�. �ͧ������㹷���ҧ�ҡ��͹��͹............<!--<?//=$daysleep1;?>-->...................................�ѹ.</td>
  </tr>
  <tr>
    <td colspan="6">2.2 �ӹǹ�ѹ�͹ �.�. �ͧ������㹷���Ѻ�������͹���............<!--<?//=$daysleep2;?>-->...........................................�ѹ</td>
  </tr>
  <tr>
    <td colspan="6">(�ѹ�͹ �.�. ��ѹ����˹���ź�����ѹ����Ѻ �� �Ѻ�ѹ��� 8 ��˹����ѹ��� 12 �ӹǹ�ѹ�͹ �.�. ��� 4 ������ͧ�ӹ֧�֧���ҷ���Ѻ���ͨ�˹��� ��ùѺ�ѹ�����ѹ ���������§�׹ ���������ѹ����)</td>
  </tr>
  <tr>
    <td colspan="6">3. �ѵ�Ҥ�ͧ��§................................................... %</td>
  </tr>
  <tr>
    <td colspan="6">4.�ӹǹ��§�ͧ�ͼ�����...........................................��§</td>
  </tr>
  <tr>
    <td colspan="6">5.�ӹǹ������ Refer ......................<?=$row4;?>........................���</td>
  </tr>
  <tr>
    <td colspan="6">6.�ӹǹ�����¨�˹���  .................<?=$row5;?>.......................���</td>
  </tr>
  <tr>
    <td colspan="6">7. �����·�����ª��Ե������͹��� ( ��������ôҷ�����ª��Ե�ҡ��ä�ʹ , ��á�á�Դ������ª��Ե�ҹ� 7 �ѹ�ѹ�á , �����·�����ª��Ե�����ҧ��ü�ҵѴ )</td>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
  <? 	$sql6="SELECT * FROM fward  WHERE  dctype like '%Dead%'";
		$query6 = mysql_query($sql6);
$no=1;
	while($row6=mysql_fetch_array($query6)){
		
		
		
 ?>
  <tr>
    <td align="center"> 7.<?=$no;?>  &nbsp;����-ʡ��</td>
    <td><?=$row6['ptname'];?></td>
    <td align="center">HN</td>
    <td><?=$row6['hn'];?></td>
    <td align="center">AN</td>
    <td><?=$row6['an'];?></td>
  </tr>
  <? 
  $no++;
  } ?>
</table>

<? } ?>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>