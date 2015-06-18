<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<style>
.font1{
	font-family:"TH SarabunPSK";
	font-size:16pt;
}
</style>
<body>

<? 
include("connect.inc");

function calcage($birth){

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

$sql1="SELECT * FROM `ssodata` ";
$query=mysql_query($sql1);

?>
<h1 align="center" class="font1">รายชื่อผู้ป่วย สิทธิประกันสังคม ทั้งหมด</h1>
<table border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="font1">
  <tr>

    <td align="center" bgcolor="#CCCCCC">ลำดับ</td>
    <td align="center" bgcolor="#CCCCCC">IDCARD</td>
    <td align="center" bgcolor="#CCCCCC">HN</td>
    <td align="center" bgcolor="#CCCCCC">ชื่อ-สกุล</td>
    <td align="center" bgcolor="#CCCCCC">อายุ</td>
    <td align="center" bgcolor="#CCCCCC">เพศ</td>
  </tr>
<?
$i=1;
while($arr=mysql_fetch_array($query)){
	
	$id=substr($arr['id'],0,13);
	
	$sql2="SELECT * FROM `opcard` WHERE idcard ='".$id."' ";
	$query2=mysql_query($sql2);
	
	while($arr2=mysql_fetch_array($query2)){
	
?>
<tr>
    <td align="center"><?=$i;?></td>
    <td>&nbsp;&nbsp;<?=$arr2['idcard'];?></td>
    <td>&nbsp;&nbsp;<?=$arr2['hn'];?></td>
    <td>&nbsp;&nbsp;<?=$arr2['yot'].$arr2['name'].' '.$arr2['surname'];?></td>
    <td>&nbsp;&nbsp;<?=calcage($arr2['dbirth']);?></td>
    <td align="center"><?=$arr2['sex'];?></td>
  </tr>

<?
$i++;
	}

}


?>
</table>
</body>
</html>