<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<link href="sm3_style.css" rel="stylesheet" type="text/css" />
</head>

<body onload="window.print();">
<? 

include("connect.inc");

$sql="SELECT  * FROM  `ddrugrx` WHERE `hn` =  '".$_GET['hn']."' and date like '".$_GET['date']."%'  and  amount  >0  group by drugcode  order by  amount DESC";
$query=mysql_query($sql) or die (mysql_error());

	$Row=mysql_num_rows($query);

	$namesql="SELECT concat(yot,name,' ',surname)as ptname ,dbirth  FROM `opcard` WHERE hn='".$_GET['hn']."'";
	$namequery=mysql_query($namesql) or die (mysql_error());
	$namearr=mysql_fetch_array($namequery);
	
	
	Function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

return $pAge;
}


?>
<table  width="61%" border="0" class="fontsara2">
  <tr>
    <td colspan="5" align="center">ประวัติการับยากลับบ้าน HN : <strong><?=$_GET['hn'];?></strong> วันที่ <?=$_GET['date'];?></td>
  </tr>
  <tr>
    <td colspan="5" align="center">ชื่อ <strong><?=$namearr['ptname'];?></strong> อายุ <?=calcage($namearr['dbirth']);?></td>
  </tr>
  <tr>
    <td width="5%"  align="center" bgcolor="#CCCCCC">#</td>
    <td   width="40%"align="center" bgcolor="#CCCCCC">ชื่อยา (การค้า)</td>
    <td width="11%"  align="center" bgcolor="#CCCCCC">วิธีใช้</td>
    <td width="17%"  align="center" bgcolor="#CCCCCC">จำนวนจ่าย</td>
    <td width="37%"   align="center" bgcolor="#CCCCCC">จำนวนคงเหลือ</td>
  </tr>
<?
if($Row ==0){
?>
<tr>
    <td colspan="5" align="center">ไม่มีรายการจ่ายยา</td>
 </tr>     
        <?
	}else{
 $i=1; 
while($arr=mysql_fetch_array($query)){
	
/*	$strdr="SELECT * FROM `druglst` WHERE `drugcode` = '".$arr['drugcode']."' ";
	$strq=mysql_query($sql) or die (mysql_error());
	$arr2=mysql_fetch_array($strq);*/
	
	//$strslip="SELECT * FROM `drugslip` WHERE slcode";
	

?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td>&nbsp;&nbsp;<?=$arr['tradname'];?></td>
    <td align="center"><?=$arr['slcode'];?></td>
    <td align="center"><?=$arr['amount'];?></td>
    <td align="center">................................</td>
  </tr>
  <? 
  $i++;
  }
   ?>
</table>

<? } ?>
</body>
</html>