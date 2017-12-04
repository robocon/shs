<?
$thyear=$_SESSION["thyear"];
$ksyear=$_SESSION["ksyear"];
$month=$_SESSION["month"];
$mon=$_SESSION["mon"];
?>

<body>
<div align="center">
  <p><strong>รายงานจำนวนผู้ป่วยในจำแนกตามสาเหตุตาย (รง.ผสต.4)<br>
หน่วย โรงพยาบาลค่ายสุรศักดิ์มนตรี <br>
  ประจำเดือน<?=$mon;?>&nbsp;ปี <?=$thyear;?></strong></p>
  <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="5%" align="center">ลำดับ</td>
      <td width="15%" align="center">ชื่อ-สกุล</td>
      <td width="8%" align="center">เลขที่ทั่วไป<br>
        (HN.No.)</td>
      <td width="8%" align="center">เลขที่ภายใน<br>
        (AN.No.)</td>
      <td width="15%" align="center">ประเภท<br>
      บุคคล</td>
      <td width="9%" align="center">สังกัด</td>
      <td width="10%" align="center">อายุ</td>
      <td width="10%" align="center">โรคที่เป็นสาเหตุการตาย</td>
      <td width="10%" align="center">รหัสโรคที่1</td>
      <td width="10%" align="center">รหัสโรคที่2</td>
      <td width="20%" align="center">วันที่ตาย</td>
    </tr>
    <?
	$sql1="select * from ipcard where dcdate between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59' and result like '%dead%'";
	//echo $sql1;
		
		$query=mysql_query($sql1);
	$i=0;
	while($rows=mysql_fetch_array($query)){
	$i++;

		?>   
    <tr>
      <td align="center"><? echo $i;?></td>
      <td  align="left"><?=$rows["ptname"];?></td>
      <td  align="center"><?=$rows["hn"];?></td>
      <td  align="center"><?=$rows["an"];?></td>
      <td  align="center"><?=$rows["goup"];?></td>
      <td  align="center"><?=$rows["camp"];?></td>
      <td  align="center"><?=$rows["age"];?></td>
      <? 
		 $an=$rows["an"];
     $sql = "Select diag,icd10 From diag where an ='$an' limit 1 ";
	 //echo $sql;
$result = Mysql_Query($sql);
list($diag,$icd10) = Mysql_fetch_row($result);

	?>   
      <td  align="center"><? echo $diag ;?></td>
      <td  align="center"><? echo $icd10;?></td>
      <td  align="center">&nbsp;</td>
      <td  align="center"><?=$rows["dcdate"];?></td>
    </tr>
    <?
	}  //close while
	?>
  </table>
  <p>&nbsp;</p>
  <p><strong>ตรวจถูกต้อง</strong></p>
</div>
</body>
</html>
