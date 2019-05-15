<?
session_start();
if (isset($sIdname)){} else {die;} //for security
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
	font-size: 18px;
	font-family: TH SarabunPSK;
}

-->
</style>
<title>รายงานกำลังพลทหารตรวจสุขภาพประจำปี ที่มีค่า eGFR ผิดปกติ</title><form name="form1" method="post" action="<? $PHP_SELF;?>" >
<a href ="../nindex.htm" >&lt;&lt; กลับหน้าหลัก</a>
<p align="center"><strong>รายงานกำลังพลทหารตรวจสุขภาพประจำปี <?=$newPrefix;?> ที่มีค่า eGFR น้อยกว่า 90</strong></p>
<table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="3%" align="center"><strong>ลำดับ</strong></td>
    <td width="8%" align="center"><strong>HN</strong></td>
    <td width="25%" align="center"><strong>ชื่อ - นามสกุล</strong></td>
    <td width="23%" align="center"><strong>หน่วย</strong></td>
    <td width="9%" align="center"><strong>เพศ</strong></td>
    <td width="8%" align="center"><strong>อายุ</strong></td>
    <td width="10%" align="center"><strong>Creatinine (mg/dL)</strong></td>
    <td width="14%" align="center"><strong>eGFR</strong></td>
  </tr>
<?
$sql1 = "select * from condxofyear_so where yearcheck='$newPrefix' and age >=35 order by camp1 asc, chunyot1 asc, age desc";
//echo $sql1;
$query1 = mysql_query($sql1);
$num1 = mysql_num_rows($query1);
if(empty($num1)){
	echo "<tr><td colspan='3' align='center'>-------------------- ไม่มีข้อมูล --------------------</td></tr>";
}
$i=0;
while($result1=mysql_fetch_array($query1)){
$ptname=$result1["yot"]." ".$result1["ptname"];

//$sqlq="select a.autonumber, b.result from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.hn='".$result1["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี61' and a.profilecode='CREAG' and b.labcode='CREA' AND b.flag !='N'";
$sqlq="select a.autonumber, b.result from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.hn='".$result1["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี62' and a.profilecode='CREAG' and b.labcode='GFR' AND b.result <=89";
//echo $sqlq."<br>";
$queryq=mysql_query($sqlq);
$numq=mysql_num_rows($queryq);
$rows=mysql_fetch_array($queryq);
if($numq > 0){
$i++;

//$sqlq1="select result from resultdetail  where autonumber='".$rows["autonumber"]."' and labcode='GFR'";
$sqlq1="select result from resultdetail  where autonumber='".$rows["autonumber"]."' and labcode='CREA'";
//echo $sqlq1."<br>";
$queryq1=mysql_query($sqlq1);
$rows1=mysql_fetch_array($queryq1);
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$result1["hn"];?></td>
    <td><?=$ptname;?></td>
    <td><? if(empty($result1["camp1"])){ echo "&nbsp;";}else{ echo $result1["camp"];}?></td>
    <td align="center"><? if($result1["gender"]=="1"){ echo "M";}else{ echo "F";}?></td>
    <td align="center"><? if(empty($result1["age"])){ echo "&nbsp;";}else{ echo $result1["age"];}?></td>
    <td align="center"><? if(empty($rows1["result"])){ echo "&nbsp;";}else{ echo $rows1["result"];}?></td>
    <td align="center"><? echo $rows["result"];?></td>
  </tr>
<?
	}
}
?>
</table>
