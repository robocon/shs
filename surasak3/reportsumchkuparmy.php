<?php
session_start();
 include("connect.inc");
 		$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
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
<p align="center"><strong>สรุปยอดกำลังพลทหารที่เข้ารับการตรวจสุขภาพประจำปี <?=$showPrefix;?></strong></p>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="5%" align="center" bgcolor="#CCCCCC"><strong>ลำดับ</strong></td>
    <td width="50%" align="center" bgcolor="#CCCCCC"><strong>สังกัด</strong></td>
    <td width="15%" align="center" bgcolor="#CCCCCC"><strong>ยอดกำลังพล</strong></td>
    <td width="15%" align="center" bgcolor="#CCCCCC"><strong>มาตรวจ</strong></td>
    <td width="15%" align="center" bgcolor="#CCCCCC"><strong>ยังไม่ได้มาตรวจ</strong></td>
  </tr>
<?
 $query="SELECT distinct(camp) as camp FROM chkup_solider  WHERE yearchkup='$nPrefix' order by camp";
//echo $query;
  $result = mysql_query($query)or die("Query failed");
  $i=0;
  while($rows=mysql_fetch_array($result)){
  $i++;
  $sql1=mysql_query("select * from chkup_solider where yearchkup='$nPrefix' and camp='$rows[camp]'");
  $numcamp=mysql_num_rows($sql1);
  $totalcamp=$totalcamp+$numcamp;
  
  $sql2=mysql_query("select * from condxofyear_so where yearcheck='$showPrefix' and camp1='$rows[camp]' group by hn");
  $numchkup=mysql_num_rows($sql2);
  $totalchkup=$totalchkup+$numchkup;  
  
  $numnotchkup=$numcamp-$numchkup;
  $totalnotchkup=$totalcamp-$totalchkup;
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$rows["camp"];?></td>
    <td align="center"><a href="reportcampchkuparmy.php?camp=<?=$rows["camp"];?>&year=<?=$nPrefix;?>" target="_blank"><?=$numcamp;?></a></td>
    <td align="center"><a href="reportlistchkuparmy.php?camp=<?=$rows["camp"];?>&year=<?=$showPrefix;?>" target="_blank"><?=$numchkup;?></a></td>
    <td align="center"><a href="reportlistnotchkuparmy.php?camp=<?=$rows["camp"];?>&year=<?=$nPrefix;?>" target="_blank"><?=$numnotchkup;?></a></td>
  </tr>
<?
}
?>  
  <tr>
    <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>รวมทั้งสิ้น</strong></td>
    <td align="center" bgcolor="#CCCCCC"><strong>
      <?=$totalcamp;?>
    </strong></td>
    <td align="center" bgcolor="#CCCCCC"><strong>
      <?=$totalchkup;?>
    </strong></td>
    <td align="center" bgcolor="#CCCCCC"><strong>
      <?=$totalnotchkup;?>
    </strong></td>    
  </tr>
</table>
