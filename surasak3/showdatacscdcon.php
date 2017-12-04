<?php
session_start();
include("connect.inc");

    $today = date("d-m-Y");   
    $dd=substr($today,0,2);
    $mm=substr($today,3,2);
    $yr=substr($today,6,4) +543;  
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.btt{
	font-family: TH SarabunPSK;
	font-size: 18px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style>
<form name="form1" method="post" action="showdatacscdcon.php">
<input name="act" type="hidden" value="show">
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td height="35" align="center"><strong>เลือก วัน/เดือน/ปี ที่ต้องการ</strong></td>
    </tr>
    <tr>
      <td align="center">วันที่ : 
      <input name="dd" type="text" class="btt"  size="5"  value="<?=$dd;?>">
     &nbsp;เดือน : 
     <input name="mm" type="text" class="btt"  value="<?=$mm;?>" size="5">
     &nbsp; ปี พ.ศ. : 
     <input name="yr" type="text" class="btt"  size="5" value="<?=$yr;?>">
     &nbsp; 
     <input type="submit" name="button" class="btt"  value="ค้นหาข้อมูล">      </td>
    </tr>
    <tr>
      <td align="center"><a href="../nindex.htm">&lt;&lt; เมนูหลัก</a></td>
    </tr>
  </table>
</form>
<?
if($_POST["act"]=="show"){
$dd=$_POST["dd"];
$mm=$_POST["mm"];
$yr=$_POST["yr"];
$newdate="$yr-$mm-$dd";


$sql = "SELECT hn, txdate, depart, detail, credit, ptright, paidcscd FROM opacc WHERE txdate like '$newdate%' && credit = 'จ่ายตรง'"; 
$query = mysql_query($sql) or die("Query failed");
$num=mysql_num_rows($query);
?>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="5%" align="center" bgcolor="#0099CC"><strong>ลำดับ</strong></td>
    <td width="10%" align="center" bgcolor="#0099CC"><strong>วัน/เดือน/ปี</strong></td>
    <td width="10%" align="center" bgcolor="#0099CC"><strong>HN</strong></td>
    <td width="26%" align="center" bgcolor="#0099CC"><strong>สิทธิ</strong></td>
    <td width="10%" align="center" bgcolor="#0099CC"><strong>Depart</strong></td>
    <td width="29%" align="center" bgcolor="#0099CC"><strong>Detail</strong></td>
    <td width="10%" align="center" bgcolor="#0099CC"><strong>ราคา</strong></td>
  </tr>
<?	
	$i=0;
	while($rows=mysql_fetch_array($query)){
	$i++;
		$chkhn=$rows["hn"];
		$chkprice=$rows["paidcscd"];
		$sumprice=$sumprice+$chkprice;
		$ptright=$rows["ptright"];
		$detail=$rows["detail"];
		$depart=$rows["depart"];
		$price=$rows["paidcscd"];
		$txdate=substr($rows["txdate"],0,10);
		list($yy,$mm,$dd)=explode("-",$txdate);
		$yy=substr($yy,2,2);
		$chkdate="$dd/$mm/$yy";
		
		$result="SELECT hn, date, price FROM datacscdcon WHERE hn='$chkhn' && date like '$chkdate%' && price='$chkprice'";
		$tbquery=mysql_query($result);
		$num1=mysql_num_rows($tbquery);		
		$rows1=mysql_fetch_array($tbquery);
		$cscdhn=$rows1["hn"];
		$cscdprice=$rows1["price"];
		$sumcscdprice=$sumcscdprice+$cscdprice;
if($chkhn==$cscdhn){
	echo " <tr bgcolor=\"#33FF99\">";
}else{
	echo " <tr bgcolor=\"#DF626B\">";
}
?>
    <td align="center"><?=$i;?></td>
    <td align="center"><?=$txdate;?></td>
    <td><?=$chkhn;?></td>
    <td><?=$ptright;?></td>
    <td><?=$depart;?></td>
    <td><?=$detail;?></td>
    <td align="right"><?=number_format($price,2);?></td>
  </tr>
<?
}
$total=$sumprice-$sumcscdprice;
?>
</table>
<br />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="42%" align="right"><strong>สรุป</strong></td>
    <td width="2%" align="left">&nbsp;</td>
    <td width="9%" align="left">ยอดเงินที่ได้รับ</td>
    <td width="7%" align="right"><?=number_format($sumcscdprice,2);?></td>
    <td width="1%">&nbsp;</td>
    <td width="39%"><strong>บาท</strong></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="left">&nbsp;</td>
    <td align="left">ยอดเงินที่ค้างรับ</td>
    <td align="right"><a href="showdatacscdcon1.php?newdate=<?=$newdate;?>" target="_blank"><?=number_format($total,2);?></a></td>
    <td>&nbsp;</td>
    <td><strong>บาท</strong></td>
  </tr>
  <tr>
    <td align="right"><strong>รวม</strong> </td>
    <td align="left">&nbsp;</td>
    <td align="left">เป็นเงินทั้งสิน</td>
    <td align="right"><?=number_format($sumprice,2);?></td>
    <td>&nbsp;</td>
    <td><strong>บาท</strong></td>
  </tr>
</table>
<?    	
}  //close if show
?>
