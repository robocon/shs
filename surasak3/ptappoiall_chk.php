<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style>
.font1{
	font-family:"TH SarabunPSK";
	font-size:16pt;
}
.font2{
	font-family:"TH SarabunPSK";
	font-size:16pt;
}
</style>
</head>

<body>
<?
include("connect.inc");
$appd=$_GET['appd'];

$query="CREATE TEMPORARY TABLE appoint1 SELECT *, left( `doctor` , 5 ) AS codedoctor FROM appoint WHERE appdate = '$appd' ";
$result = mysql_query($query) or die("Query failed,app");

$query = "SELECT hn,ptname,apptime,came,row_id,age,doctor,depcode,officer,date FROM appoint WHERE appdate = '$appd' ORDER BY row_id ASC    ";
$result = mysql_query($query)or die("Query failed");
?>

<h1 align="center" class="font2">ใบตรวจสอบสิทธิผู้ป่วยนัด วันที่ <?=$appd;?></h1>
<table border="1" cellspacing="0" cellpadding="0" style="border-collapse:collapse;"  bordercolor="#000000" class="font1">
  <tr>
    <td align="center">ลำดับ</td>
    <td align="center">HN</td>
    <td align="center">IDCARD</td>
    <td align="center">ชื่อ-สกุล</td>
    <td align="center">สิทธิ์หลัก</td>
    <td align="center">สิทธิ์รอง</td>
    <td align="center">หมายเหตุ</td>
  </tr>
  <? 
  $i=1;
  while($arr=mysql_fetch_array($result)){
	  
	$sql = "Select ptright,ptright1,idcard,concat(yot,name,' ',surname)as ptname, hospcode
  From opcard 
  where hn = '".$arr['hn']."' 
  limit 1 ";
	$result1 = mysql_query($sql);
	list($ptright,$ptright1,$idcard,$ptname, $hospcode) =mysql_fetch_row($result1);
	
  $test_match = preg_match('/^(\d+)/', $hospcode, $matchs);
	
	if(substr($ptright1,0,3)!='R03' & substr($ptright1,0,3)!='R07' & substr($ptright,0,3)!='R04' & substr($ptright1,0,3)!='R02'){
	  ?>
    <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$arr['hn'];?></td>
    <td><?=$idcard;?></td>
    <td><?=$ptname;?></td>
    <td><?=$ptright1;?></td>
    <td><?=$ptright;?></td>
    <td><?php echo ( $test_match > 0 ) ? $matchs['0'] : '' ; ?></td>
  </tr>
  <? 
  	$i++;
	}
  
  } 
  ?>
</table>
<p align="right" class="font1">ผู้ตรวจสอบ.............................................................................</p>
<p align="right" class="font1">&nbsp;</p>

</body>
</html>