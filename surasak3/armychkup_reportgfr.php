<?
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
		
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<div style="margin-left:30px;"><strong>ประเมิน GFR</strong></div>
<table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="7%" align="center" bgcolor="#009999"><strong>ลำดับ</strong></td>
    <td width="51%" align="center" bgcolor="#009999"><strong>ชื่อ-นามสกุล</strong></td>
    <td width="8%" align="center" bgcolor="#009999"><strong>เพศ (M/F)</strong></td>
    <td width="8%" align="center" bgcolor="#009999"><strong>อายุ (ปี)</strong></td>
    <td width="10%" align="center" bgcolor="#009999"><strong>Creatinine (mg/dL)</strong></td>
  </tr>
  
<?
		$sql2 = "select * from armychkup where camp !='' and yearchkup='$nPrefix' and crea_lab='ผิดปกติ'";
		//echo $sql;
		$query2 = mysql_query($sql2);  		
		$i=0;
		while($result2=mysql_fetch_array($query2)){
		$i++;
		$ptname=$result2["yot"]." ".$result2["ptname"];
		$age=$result2["age"];
		$result=$result2["crea_result"];
			if($result2['gender']=="1"){
				$gender="M";
			}else if($result2['gender']=="2"){
				$gender="F";
			}else{
				$gender="F";
			}
			
?>		  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$ptname;?></td>
    <td align="center"><?=$gender;?></td>
    <td align="center"><?=$age;?></td>
    <td align="center"><strong>
      <?=$result;?>
    </strong></td>
  </tr>
<?
}
?>  
</table>

