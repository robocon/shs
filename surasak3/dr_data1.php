<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
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
<div id="no_print">
<form name="f1" action="" method="post">
  <table  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse">
  <tr class="forntsarabun">
    <td colspan="2" bgcolor="#99CC99">��§ҹ�������������է�����ҳ</td>
    </tr>
  <tr class="forntsarabun">
    <td  align="right"><span class="forntsarabun">����� - ��͹/��</span></td>
    <td >
    		<input name="d_start1" type="text"  class="forntsarabun" id="d_start1" value="01" size="5"/>
   
	<? $m=date('m'); ?>
      <select name="m_start1" class="forntsarabun" id="m_start1">
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
				echo "<select name='y_start1' class='forntsarabun'>";
				foreach($dates as $i){
				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?></td>
    </tr>
  <tr class="forntsarabun">
    <td  align="right">�֧  - ��͹/��</td>
    <td > 
      <input name="d_start2" type="text"  class="forntsarabun" id="d_start2" value="30" size="5"/>
      <? $m=date('m'); ?>
      <select name="m_start2" class="forntsarabun" id="m_start2">
        <option value="01" <? if($m=='01'){ echo "selected"; }?>>���Ҥ�</option>
        <option value="02" <? if($m=='02'){ echo "selected"; }?>>����Ҿѹ��</option>
        <option value="03" <? if($m=='03'){ echo "selected"; }?>>�չҤ�</option>
        <option value="04" <? if($m=='04'){ echo "selected"; }?>>����¹</option>
        <option value="05" <? if($m=='05'){ echo "selected"; }?>>����Ҥ�</option>
        <option value="06" <? if($m=='06'){ echo "selected"; }?>>�Զع�¹</option>
        <option value="07" <? if($m=='07'){ echo "selected"; }?>>�á�Ҥ�</option>
        <option value="08" <? if($m=='08'){ echo "selected"; }?>>�ԧ�Ҥ�</option>
        <option value="09" <? if($m=='09'){ echo "selected"; }?>>�ѹ��¹</option>
        <option value="10" <? if($m=='10'){ echo "selected"; }?> >���Ҥ�</option>
        <option value="11" <? if($m=='11'){ echo "selected"; }?>>��Ȩԡ�¹</option>
        <option value="12" <? if($m=='12'){ echo "selected"; }?>>�ѹ�Ҥ�</option>
        </select><? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start2' class='forntsarabun'>";
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
</div>

<?
if($_POST['submit']){
include("connect.inc");


$y1=$_POST['y_start1'];
$y2=$_POST['y_start2'];
/*$date1=$y1.'-'.$_POST['m_start1'];
$date2=$y2.'-'.$_POST['m_start2'];*/


$date1=$y1.'-'.$_POST['m_start1'].'-'.$_POST['d_start1']." 00:00:00";
$date2=$y2.'-'.$_POST['m_start2'].'-'.$_POST['d_start2']." 23:59:59";




$sql="SELECT drugcode, tradname, genname FROM `druglst` WHERE  bcode = 'D0212' ";
//echo $sql."<br>";
$result = mysql_query($sql)or die(mysql_error());

?>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse;">
  <tr>
    <td align="center">�ӴѺ</td>
    <td align="center">�������</td>
    <td align="center">�������ѭ</td>
    <td align="center">���͡�ä��</td>
    <td align="center">��Ť�ҡ������</td>
    <td align="center">����ҳ�������</td>
  </tr>
  <?
 $i=1; 
  while($arr=mysql_fetch_array($result)){
	  $sql2="SELECT drugcode, SUM( amount )as sum1 , SUM( price ) as sum2 FROM `drugrx` WHERE drugcode = '".trim($arr['drugcode'])."' AND date BETWEEN '$date1' AND '$date2' GROUP BY drugcode  ";
	
/*$sql2="SELECT SUM( amount ) as sum1, SUM( price )as sum2, drugcode FROM `drugrx` WHERE date BETWEEN '$date1' AND '$date2' and drugcode ='".trim($arr['drugcode'])."' Order by sum1 asc";*/
$result2= mysql_query($sql2)or die(mysql_error());
$arr2=mysql_fetch_array($result2);

  ?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td>�������Ŵ��ѹ����ʹ (Statin)<!--<?//=$arr['drugcode'];?>--></td>
    
    <td><?=$arr['genname'];?></td>
    <td><?=$arr['tradname'];?></td>
    <td align="center"><?=number_format($arr2['sum2'],2);?></td>
    <td align="center"><?=number_format($arr2['sum1']);?></td>
  
  </tr>

<?




$i++;
}
?>
</table>
<br />
<div style="page-break-after:always;"></div>
<br />
<?
$sql="SELECT drugcode, tradname, genname FROM `druglst` WHERE  bcode = 'D013' ";
//echo $sql."<br>";
$result = mysql_query($sql)or die(mysql_error());

?>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse;">
  <tr>
    <td align="center">�ӴѺ</td>
    <td align="center">�������</td>
    <td align="center">�������ѭ</td>
    <td align="center">���͡�ä��</td>
    <td align="center">��Ť�ҡ������</td>
    <td align="center">����ҳ�������</td>
  </tr>
  <?
 $i=1; 
  while($arr=mysql_fetch_array($result)){
	
	$sql2="SELECT drugcode, SUM( amount )as sum1 , SUM( price ) as sum2 FROM `drugrx` WHERE drugcode = '".trim($arr['drugcode'])."' AND date BETWEEN '$date1' AND '$date2' GROUP BY drugcode  ";
	$result2= mysql_query($sql2)or die(mysql_error());
	$arr2=mysql_fetch_array($result2);

  ?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td>�������Ŵ�������������ʹ�͡㹡���������� (Proton-pump inhibitor)<!--<?//=$arr['drugcode'];?>--></td>
    
    <td><?=$arr['genname'];?></td>
    <td><?=$arr['tradname'];?></td>
    <td align="center"><?=number_format($arr2['sum2'],2);?></td>
    <td align="center"><?=number_format($arr2['sum1']);?></td>
  
  </tr>

<?




$i++;
}
?>
</table>


<br />
<div style="page-break-after:always;"></div>
<br />
<?
$sql="SELECT drugcode, tradname, genname FROM `druglst` WHERE  bcode = 'D1011' ";
//echo $sql."<br>";
$result = mysql_query($sql)or die(mysql_error());

?>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse;">
  <tr>
    <td align="center">�ӴѺ</td>
    <td align="center">�������</td>
    <td align="center">�������ѭ</td>
    <td align="center">���͡�ä��</td>
    <td align="center">��Ť�ҡ������</td>
    <td align="center">����ҳ�������</td>
  </tr>
  <?
 $i=1; 
  while($arr=mysql_fetch_array($result)){
	$sql2="SELECT drugcode, SUM( amount )as sum1 , SUM( price ) as sum2 FROM `drugrx` WHERE drugcode = '".trim($arr['drugcode'])."' AND date BETWEEN '$date1' AND '$date2' GROUP BY drugcode  ";
	$result2= mysql_query($sql2)or die(mysql_error());
	$arr2=mysql_fetch_array($result2);

  ?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td>������ҵ�ҹ�ѡ�ʺ��������������´� (NSAIDS)<!--<?//=$arr['drugcode'];?>--></td>
    
    <td><?=$arr['genname'];?></td>
    <td><?=$arr['tradname'];?></td>
    <td align="center"><?=number_format($arr2['sum2'],2);?></td>
    <td align="center"><?=number_format($arr2['sum1']);?></td>
  
  </tr>

<?




$i++;
}
?>
</table>

<br />
<div style="page-break-after:always;"></div>
<br />
<?
$sql="SELECT drugcode, tradname, genname FROM `druglst` WHERE  bcode = 'D0254' ";
//echo $sql."<br>";
$result = mysql_query($sql)or die(mysql_error());

?>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse;">
  <tr>
    <td align="center">�ӴѺ</td>
    <td align="center">�������</td>
    <td align="center">�������ѭ</td>
    <td align="center">���͡�ä��</td>
    <td align="center">��Ť�ҡ������</td>
    <td align="center">����ҳ�������</td>
  </tr>
  <?
 $i=1; 
  while($arr=mysql_fetch_array($result)){
	
	$sql2="SELECT drugcode, SUM( amount )as sum1 , SUM( price ) as sum2 FROM `drugrx` WHERE drugcode = '".trim($arr['drugcode'])."' AND date BETWEEN '$date1' AND '$date2' GROUP BY drugcode  ";
	$result2= mysql_query($sql2)or die(mysql_error());
	$arr2=mysql_fetch_array($result2);
  ?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td>����������ͧ��㹡���ѡ�Ҥ����ѹ���Ե�٧��������������Ẻ���ʹ��� (ACE-Inhibitor)<!--<?//=$arr['drugcode'];?>--></td>
    
    <td><?=$arr['genname'];?></td>
    <td><?=$arr['tradname'];?></td>
    <td align="center"><?=number_format($arr2['sum2'],2);?></td>
    <td align="center"><?=number_format($arr2['sum1']);?></td>
  
  </tr>

<?




$i++;
}
?>
</table>

<br />
<div style="page-break-after:always;"></div>
<br />
<?

$sql="SELECT drugcode, tradname, genname FROM `druglst` WHERE  bcode = 'D0255' ";
//echo $sql."<br>";
$result = mysql_query($sql)or die(mysql_error());

?>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse;">
  <tr>
    <td align="center">�ӴѺ</td>
    <td align="center">�������</td>
    <td align="center">�������ѭ</td>
    <td align="center">���͡�ä��</td>
    <td align="center">��Ť�ҡ������</td>
    <td align="center">����ҳ�������</td>
  </tr>
  <?
 $i=1; 
  while($arr=mysql_fetch_array($result)){
	$sql2="SELECT drugcode, SUM( amount )as sum1 , SUM( price ) as sum2 FROM `drugrx` WHERE drugcode = '".trim($arr['drugcode'])."' AND date BETWEEN '$date1' AND '$date2' GROUP BY drugcode  ";
	$result2= mysql_query($sql2)or die(mysql_error());
	$arr2=mysql_fetch_array($result2);

  ?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td>�������Ŵ�����ѹ���Ե Angiotensin Receptor Blockers (ARB)<!--<?//=$arr['drugcode'];?>--></td>
    
    <td><?=$arr['genname'];?></td>
    <td><?=$arr['tradname'];?></td>
    <td align="center"><?=number_format($arr2['sum2'],2);?></td>
    <td align="center"><?=number_format($arr2['sum1']);?></td>
  
  </tr>

<?

$i++;
}
?>
</table>

<br />
<div style="page-break-after:always;"></div>
<br />
<?

$sql="SELECT drugcode, tradname, genname FROM `druglst` WHERE  bcode = 'D029' ";
//echo $sql."<br>";
$result = mysql_query($sql)or die(mysql_error());

?>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse;">
  <tr>
    <td align="center">�ӴѺ</td>
    <td align="center">�������</td>
    <td align="center">�������ѭ</td>
    <td align="center">���͡�ä��</td>
    <td align="center">��Ť�ҡ������</td>
    <td align="center">����ҳ�������</td>
  </tr>
  <?
  $i=1; 
  while($arr=mysql_fetch_array($result)){
	
	$sql2="SELECT drugcode, SUM( amount )as sum1 , SUM( price ) as sum2 FROM `drugrx` WHERE drugcode = '".trim($arr['drugcode'])."' AND date BETWEEN '$date1' AND '$date2' GROUP BY drugcode  ";
	$result2= mysql_query($sql2)or die(mysql_error());
	$arr2=mysql_fetch_array($result2);

  ?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td>������һ�ͧ�ѹ�����е�Ǣͧ������ʹ (antiplatelet drug prasugrel ���� clopidogrel)<!--<?//=$arr['drugcode'];?>--></td>
    
    <td><?=$arr['genname'];?></td>
    <td><?=$arr['tradname'];?></td>
    <td align="center"><?=number_format($arr2['sum2'],2);?></td>
    <td align="center"><?=number_format($arr2['sum1']);?></td>
  
  </tr>

<?




$i++;
}
?>
</table>

<br />
<div style="page-break-after:always;"></div>
<br />
<?

$sql="SELECT drugcode, tradname, genname FROM `druglst` WHERE  bcode = 'D066' ";
//echo $sql."<br>";
$result = mysql_query($sql)or die(mysql_error());

?>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse;">
  <tr>
    <td align="center">�ӴѺ</td>
    <td align="center">�������</td>
    <td align="center">�������ѭ</td>
    <td align="center">���͡�ä��</td>
    <td align="center">��Ť�ҡ������</td>
    <td align="center">����ҳ�������</td>
  </tr>
  <?
 $i=1; 
  while($arr=mysql_fetch_array($result)){
	
$sql2="SELECT drugcode, SUM( amount )as sum1 , SUM( price ) as sum2 FROM `drugrx` WHERE drugcode = '".trim($arr['drugcode'])."' AND date BETWEEN '$date1' AND '$date2' GROUP BY drugcode  ";
	$result2= mysql_query($sql2)or die(mysql_error());
	$arr2=mysql_fetch_array($result2);

  ?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td>������һ�ͧ�ѹ��д١��ع (Osteoporosis Preventive drug)<!--<?//=$arr['drugcode'];?>--></td>
    <td><?=$arr['genname'];?></td>
    <td><?=$arr['tradname'];?></td>
    <td align="center"><?=number_format($arr2['sum2'],2);?></td>
    <td align="center"><?=number_format($arr2['sum1']);?></td>
  
  </tr>

<?

$i++;
}
?>
</table>

<br />
<div style="page-break-after:always;"></div>
<br />
<?

$sql="SELECT drugcode, tradname, genname FROM `druglst` WHERE  (bcode = 'D0811' or bcode = 'D0813')";
//echo $sql."<br>";
$result= mysql_query($sql)or die(mysql_error());

?>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse;">
  <tr>
    <td align="center">�ӴѺ</td>
    <td align="center">�������</td>
    <td align="center">�������ѭ</td>
    <td align="center">���͡�ä��</td>
    <td align="center">��Ť�ҡ������</td>
    <td align="center">����ҳ�������</td>
  </tr>
  <?
 $i=1; 
  while($arr=mysql_fetch_array($result)){
	
	$sql2="SELECT drugcode, SUM( amount )as sum1 , SUM( price ) as sum2 FROM `drugrx` WHERE drugcode = '".trim($arr['drugcode'])."' AND date BETWEEN '$date1' AND '$date2' GROUP BY drugcode  ";
	$result2= mysql_query($sql2)or die(mysql_error());
	$arr2=mysql_fetch_array($result2);

  ?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td>��������ѡ�������(Chemotherapeutic drug)<!--<?//=$arr['drugcode'];?>--></td>
    <td><?=$arr['genname'];?></td>
    <td><?=$arr['tradname'];?></td>
    <td align="center"><?=number_format($arr2['sum2'],2);?></td>
    <td align="center"><?=number_format($arr2['sum1']);?></td>
  
  </tr>

<?

$i++;
}
?>
</table>
<br />
<div style="page-break-after:always;"></div>
<br />
<?

$sql="SELECT drugcode, tradname, genname FROM `druglst` WHERE  bcode = 'D1012' ";
//echo $sql."<br>";
$result= mysql_query($sql)or die(mysql_error());

?>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse;">
  <tr>
    <td align="center">�ӴѺ</td>
    <td align="center">�������</td>
    <td align="center">�������ѭ</td>
    <td align="center">���͡�ä��</td>
    <td align="center">��Ť�ҡ������</td>
    <td align="center">����ҳ�������</td>
  </tr>
  <?
 $i=1; 
  while($arr=mysql_fetch_array($result)){
	
	$sql2="SELECT drugcode, SUM( amount )as sum1 , SUM( price ) as sum2 FROM `drugrx` WHERE drugcode = '".trim($arr['drugcode'])."' AND date BETWEEN '$date1' AND '$date2' GROUP BY drugcode  ";
	$result2= mysql_query($sql2)or die(mysql_error());
	$arr2=mysql_fetch_array($result2);

  ?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td>��������ѡ�Ң����������� (glucosamine)<!--<?//=$arr['drugcode'];?>--></td>
    <td><?=$arr['genname'];?></td>
    <td><?=$arr['tradname'];?></td>
    <td align="center"><?=number_format($arr2['sum2'],2);?></td>
    <td align="center"><?=number_format($arr2['sum1']);?></td>
  
  </tr>

<?

$i++;
}
?>
</table>
<?


}
?>
</body>
</html>