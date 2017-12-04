<?
session_start();
//if (isset($sIdname)){} else {die;} //for security
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
		$newPrefix="25".$nPrefix;
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
-->
</style>
<table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="5%" align="center" bgcolor="#FF9999"><strong>ลำดับ</strong></td>
    <td width="45%" align="center" bgcolor="#FF9999"><strong>HN</strong></td>
    <td width="45%" align="center" bgcolor="#FF9999"><strong>ชื่อ-นามสกุล</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>สังกัด</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>อายุ</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>CBC</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>UA</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>BS</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>CHOL</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>TR</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>HDL</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>LDL</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>BUN</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>CR</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>SGOT</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>SGPT</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>ALK</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>XRAY</strong></td>
  </tr>
<?
		$sql = "select * from armychkup where status_print ='1' and typechkup!='out' and yearchkup='$nPrefix' and camp !='' and camp !='D34 กทพ.33' group by hn order by camp asc,chunyot asc, age desc";
		//echo $sql;
		$query = mysql_query($sql);  		
		$i=0;
		while($result=mysql_fetch_array($query)){
		$i++;
		$ptname=$result["yot"]." ".$result["ptname"];
		$age=$result["age"];
?>		  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$result["hn"];?></td>
    <td><?=$ptname;?></td>
    <td align="center"><?=substr($result["camp"],4);?></td>
    <td align="center"><?=$age;?></td>
    <td align="center">90</td>
    <td align="center">50</td>
    <td align="center">40</td>
    <td align="center">60</td>
    <td align="center">60</td>
    <td align="center">100</td>
    <td align="center">150</td>
    <td align="center">50</td>
    <td align="center">50</td>
    <td align="center">50</td>
    <td align="center">50</td>
    <td align="center">50</td>
    <td align="center">170</td>
  </tr>
<?
}
?>  
</table>
<br>
<p align="center">กลุ่มตรวจก่อนและหลังขึ้นดอย</p>
<table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="5%" align="center" bgcolor="#66CC99"><strong>ลำดับ</strong></td>
    <td width="45%" align="center" bgcolor="#66CC99"><strong>HN</strong></td>
    <td width="45%" align="center" bgcolor="#66CC99"><strong>ชื่อ-นามสกุล</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>สังกัด</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>อายุ</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>CBC</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>UA</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>BS</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>CHOL</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>TR</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>HDL</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>LDL</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>BUN</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>CR</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>SGOT</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>SGPT</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>ALK</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>XRAY</strong></td>
  </tr>
<?
		$sql = "select * from condxofyear_so where yearcheck='$newPrefix' and camp1 !='' and camp1 !='D34 กทพ.33' and camp1!='D33 หน่วยทหารอื่นๆ' group by hn order by camp1 asc,chunyot1 asc, age desc";
		//echo $sql;
		$query = mysql_query($sql);  		
		$i=0;
		while($result=mysql_fetch_array($query)){
		$i++;
		$ptname=$result["ptname"];
		$age=$result["age"];
		$waist=$result["round_"]*0.393700787;
?>		  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$result["hn"];?></td>
    <td><?=$ptname;?></td>
    <td align="center"><?=substr($result["camp1"],4);?></td>
    <td align="center"><?=$age;?></td>
    <td align="center">90</td>
    <td align="center">50</td>
    <td align="center">40</td>
    <td align="center">60</td>
    <td align="center">60</td>
    <td align="center">100</td>
    <td align="center">150</td>
    <td align="center">50</td>
    <td align="center">50</td>
    <td align="center">50</td>
    <td align="center">50</td>
    <td align="center">50</td>
    <td align="center">170</td>
  </tr>
<?
}
?>  
</table>
