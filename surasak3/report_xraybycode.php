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
    <td colspan="2" bgcolor="#99CC99">ʶԵ�</td>
    </tr>
  <tr class="forntsarabun">
    <td  align="right"><span class="forntsarabun">�ѹ/��͹/��</span></td>
    <td >
    <? $d=date("d");?>
    <input type="text" name="d_start" value="<?=$d;?>" class="forntsarabun"  size="5"/>
	
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
  <tr class="forntsarabun">
    <td  align="right">���ʡ�äԴ�Թ</td>
    <td><select name="code" class="forntsarabun">
    <option value="41002">(41002)Mobile X-Rays</option>
    <option value="41003">(41003)�Ҿ������硫����ԨԵ��</option>
    <option value="42601">(42601)IVP (Ionic contrast)</option>
    <option value="42702">(42702)Bone density: X-rays 1 part</option>
    <option value="42703">(42703)Bone density: X-Rays whole body</option>
    <option value="43001">(43001)US Portable</option>
    <option value="43004">(43004)US Small part</option>
    <option value="43501">(43501)US Upper/lower abdomen</option>
    <option value="43502">(43502)US Whole abdomen</option>
	<option value="11251">(43502)Echo-Transthoracic + color + Doppler</option>
 </select>
    </td>
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
	


/*
$tsql1="CREATE TEMPORARY TABLE   xray1  SELECT *  FROM `patdata` AS a, depart AS b WHERE b.row_id = a.idno AND a.code  ='".$_POST['code']."' and b.date like '".$date1."%' ";
$tquery1 = mysql_query($tsql1);

echo $tsql1;
/*$tsql2="CREATE TEMPORARY TABLE  depart1  Select * from  depart   WHERE date
LIKE  '$date1%'";
$tquery2 = mysql_query($tsql2);
*/
	$i=1;
	print "<div><font class='forntsarabun' >ʶԵ�   ��Ш�$day  $dateshow </font></div><br>";
	
	?>
	<table  border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun"> 
    <tr bgcolor="#0099FF">
    <td align="center">�ӴѺ</td>
	<td align="center">�ѹ���</td>
	<td align="center">HN</td>
    <td align="center">����-ʡ��</td>
    <td align="center">�Է�ԡ���ѡ��</td>
    <td align="center">ᾷ��</td>
    <!--<td align="center">���ʡ�äԴ�Թ</td>
-->    <td align="center">��Һ�ԡ��</td>
    </tr>
	
    <?
	$sql1="SELECT Distinct(idno) FROM  patdata WHERE code  ='".$_POST['code']."' and date like '".$date1."%'";
	$query1 = mysql_query($sql1);
	echo $sql1;
	while($arr1=mysql_fetch_array($query1)){
		
	$sql2="SELECT * FROM  depart  WHERE row_id  ='".$arr1['idno']."' and status='Y' and price >'0' ";
	$query2 = mysql_query($sql2);
	

		while($arr2=mysql_fetch_array($query2)){
			
			$subdate=explode(" ",$arr2['date']);
	

	?>
    <tr>
      <td align="center"><?=$i;?></td>
      <td><?=$arr2['date']?></td>
      <td><?=$arr2['hn']?></td>
      <td><?=$arr2['ptname']?></td>
      <td><?=$arr2['ptright']?></td>
      <td><?=$arr2['doctor']?></td>
      <td align="right"><?=$arr2['price']?></td>
    </tr>
        <? 
	$sumprice+=	$arr1['price'];
		
		$i++;

	}
	}
	
	
	?>
    <tr>
      <td colspan="6" align="center">���</td>
      <td align="right"><?=number_format($sumprice);?></td>
    </tr>

    </table>
<?

/*}else{
	echo "<font class=\"forntsarabun\">����բ����Ţͧ$day  $dateshow</font>";
}*/

}
?>