<?php
session_start();
 include("connect.inc");

function displaydate($x) {
	$thai_m=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
	$date_array=explode("-",$x);
	$y=$date_array[0];
	$m=$date_array[1]-1;
	$d=$date_array[2];

	$m=$thai_m[$m];
	$y=$y+543;

	$displaydate="$d $m $y";
	return $displaydate;
} // end function displaydate

 
 		$query = "SELECT runno, prefix  FROM runno WHERE title = 'y_chekup'";
		$result = mysql_query($query) or die("Query failed");
		
		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}
				if(!($row = mysql_fetch_object($result)))
				continue;
		}
		$nPrefix=$row->prefix;
		$showPrefix="25".$nPrefix;

$total=234;
?>
<style type="text/css">
<!--
body,td,th {
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
<a href ="../nindex.htm" >&lt;&lt; กลับหน้าหลัก</a>
<p align="center"><strong>สรุปจำนวนลูกจ้างที่ตรวจสุขภาพประจำปี <?=$showPrefix;?></strong></p>
<div align="center">จำนวนลูกจ้างทั้งหมด <?=$total;?> คน</div>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="5%" align="center" bgcolor="#CCCCCC"><strong>ลำดับ</strong></td>
    <td width="70%" align="center" bgcolor="#CCCCCC"><strong>วันที่มาตรวจ ณ จุดซักประวัติ</strong></td>
    <td width="25%" align="center" bgcolor="#CCCCCC"><strong>มาตรวจ</strong></td>
  </tr>
<?
 $query="SELECT distinct(substring(thidate,1,10)) as chkdate FROM dxofyear_emp  WHERE yearchk='$nPrefix' order by thidate";
//echo $query;
  $result = mysql_query($query)or die("Query failed");
  $i=0;
  while($rows=mysql_fetch_array($result)){
  $i++;
  $sql1=mysql_query("select count(row_id) as numchkup from dxofyear_emp where yearchk='$nPrefix' and thidate like '$rows[chkdate]%'");
  $rows1=mysql_fetch_array($sql1);
  $totalchkup=$totalchkup+$rows1["numchkup"];
  
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=displaydate($rows["chkdate"]);?></td>
    <td align="center"><a href="reportlistchkupemp.php?chkdate=<?=$rows["chkdate"];?>&year=<?=$nPrefix;?>" target="_blank"><?=$rows1["numchkup"];?></a></td>
  </tr>
<?
}
$percen=($totalchkup*100)/$total;
$rentchkup=$total-$totalchkup;
?>  
  <tr>
    <td colspan="2" align="right" bgcolor="#CCCCCC"><strong>รวมทั้งสิ้น</strong></td>
    <td align="center" bgcolor="#CCCCCC"><strong>
      <?=$totalchkup;?>
    </strong></td>
  </tr>
  <tr>
    <td colspan="2" align="right" bgcolor="#CCCCCC"><strong>ค้างตรวจ</strong></td>
    <td align="center" bgcolor="#CCCCCC"><strong>
      <?=$rentchkup;?>
    </strong></td>
  </tr>
  <tr>
    <td colspan="2" align="right" bgcolor="#CCCCCC"><strong>คิดเป็นร้อยละ</strong></td>
    <td align="center" bgcolor="#CCCCCC"><strong><?=number_format($percen,2);?></strong></td>
  </tr>
</table>
