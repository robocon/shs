<?php
session_start();
$depart1 = array();
$depart2 = array();
$depart3 = array();
$depart4 = array();
$depart5 = array();
$depart6 = array();
$depart7 = array();
$depart8 = array();
$depart9 = array();
$depart10 = array();

include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>�ӹǹ������Ѻ��ԡ��</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style></head>
<? 
function displaydate($x) {
	$thai_m=array("���Ҥ�","����Ҿѹ��","�չҤ�","����¹","����Ҥ�","�Զع�¹","�á�Ҥ�","�ԧ�Ҥ�","�ѹ��¹","���Ҥ�","��Ȩԡ�¹","�ѹ�Ҥ�");
	$date_array=explode("-",$x);
	$y=$date_array[0];
	$m=$date_array[1]-1;
	$d=$date_array[2];

	$m=$thai_m[$m];
	$y=$y+543;

	$displaydate="$d $m $y";
	return $displaydate;
} // end function displaydate

?>
<?
$keydate =date('Y-m-d');
$keytime =date('H:i:s');
?>
<body>
<form action="report_serviceofyear.php" method="post">
<input name="act" type="hidden" value="search" />
  <table width="327" border="0" style="font-family:'TH SarabunPSK'; font-size:18px;">
    <tr>
      <td width="246"><span style="font-family:'TH SarabunPSK'; font-size:18;">�ӹǹ������Ѻ��ԡ�âͧ�� �.�. : &nbsp;</span><?
        $Y=date("Y")+543;
        $date=date("Y")+543+5;
                      
        $dates=range(2547,$date);
		?>
        <select name="year" style="font-family:'TH SarabunPSK'; font-size:18px;">
        <? foreach($dates as $i){
        ?>
		<option value='<?=$i; ?>' <? if($Y==$i){ echo "selected"; }?>>
            <?=$i;?>
        </option>
        <?
        }
		?>
        </select>
      </td>
      <td width="71"><input name="submit" type="submit" id="submit" style="font-family:'TH SarabunPSK'; font-size:18px;" value="��ŧ" /></td>
    </tr>
  </table>
</form>
<hr />
<? 
if($_POST["act"]=="search"){
$year =$_POST["year"];
	
?>
<p align="center">��ǹ���Թ�����¹͡: ��§ҹ����Ѻ���������<br />
��§ҹ�Թ����Ѻ�����¹͡ ��Шӻ� <?=$year?><br />
�͡��§ҹ � �ѹ��� <?=displaydate($keydate); ?></p>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="88%" align="center"><strong>�Է��</strong></td>
 <? for($i=1;$i<13;$i++){
 	if($i==1){ $mon="���Ҥ�";}else if($i==2){ $mon="����Ҿѹ��";}else if($i==3){ $mon="�չҤ�";}else if($i==4){ $mon="����¹";}else if($i==5){ $mon="����Ҥ�";}else if($i==6){ $mon="�Զع�¹";}else if($i==7){ $mon="�á�Ҥ�";}else if($i==8){ $mon="�ԧ�Ҥ�";}else if($i==9){ $mon="�ѹ��¹";}else if($i==10){ $mon="���Ҥ�";}else if($i==11){ $mon="��Ȩԡ�¹";}else if($i==12){ $mon="�ѹ�Ҥ�";}
 ?>
    <td width="12%" align="center"><strong>��͹<?=$mon;?>
    </strong></td>
 <? } ?>
  </tr>
<?
    $dbquery = "SELECT DISTINCT (
ptright
)
FROM `opday`
WHERE `thidate`
LIKE '2556%' 
GROUP BY substring( ptright, 1, 3 )";
	//echo $query;
    $dbresult = mysql_query($dbquery)or die("Query failed");
	while($dbrows=mysql_fetch_array($dbresult)){
?>  
  <tr>
    <td align="left"><? echo $dbrows["ptright"];?></td>
 <? for($i=1;$i<13;$i++){ 
 	$los = strlen($i);
	if($los=="1"){
		$n="0".$i;
	}else{
		$n=$i;
	}
 ?> 
    <td width="12%" align="right">1</td>
 <? }?>
  </tr>
<?
} // close while �Ҩӹǹ�Է���
?>
  <tr>
    <td align="center"><strong>���������</strong></td>
 <? 
 for($i=0;$i<12;$i++){ 
	$sumprice = $depart1[$i]+$depart2[$i]+$depart3[$i]+$depart4[$i]+$depart5[$i]+$depart6[$i]+$depart7[$i]+$depart8[$i]+$depart9[$i]+$depart10[$i];
 ?> 
    <td width="12%" align="right"><span style="font-weight:bold; color:#FF0000;"><?=number_format($sumprice,2);?></span></td>
<?
}
?>
  </tr>
</table>
<p>&nbsp;</p>
<p align="center">&nbsp;</p>
<?
}
?>
</body>
</html>
