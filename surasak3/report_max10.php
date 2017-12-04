<?
$thyear=$_SESSION["thyear"];
$ksyear=$_SESSION["ksyear"];
$month=$_SESSION["month"];
$mon=$_SESSION["mon"];
$thmonth=$thyear."-".$month;
?>
<div align="center">
<p><strong>แบบรายงานสถิติการเจ็บป่วย 10 อันดับสูงสุด<br>
  ของผู้เข้ารับการตรวจรักษาใน รพ. ค่ายสุรศักดิ์มนตรี<br>
  ประจำเดือน  <?=$mon;?>&nbsp;ปี <?=$thyear;?></strong></p>
      <?
	  $sql="select * from pstmax where yrmonth= '$thmonth' order by sumcase desc limit 0,10";
	  $query=mysql_query($sql);
	  $num=mysql_num_rows($query);
	  if(empty($num)){
	  	echo "<script>alert('ยังไม่มีข้อมูลในระบบ กรุณารอสักครู่ ระบบจะพาท่านเข้าดูรายงาน ผสต.5 ก่อน จากนั้นให้ท่านเลือกดูรายงานเวชกรรมอีกครั้งครับ');window.location='menupst.php?page=pst5';</script>";
	  }
	  ?>   
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr>
      <td width="4%" rowspan="2" align="center"><strong>อันดับ</strong></td>
      <td width="47%" rowspan="2" align="center"><strong>ชื่อโรค</strong></td>
      <td colspan="4" align="center"><strong>ประเภทผู้ป่วย</strong></td>
      <td width="13%" rowspan="2" align="center"><strong>หมายเหตุ</strong></td>
    </tr>
    <tr>
      <td width="9%" align="center"><strong>ก</strong></td>
      <td width="9%" align="center"><strong>ข</strong></td>
      <td width="9%" align="center"><strong>ค</strong></td>
      <td width="9%" align="center"><strong>รวม</strong></td>
    </tr> 
    <?
	$i=0;
	while($rows=mysql_fetch_array($query)){
	$i++;
	?>  
    <tr>
      <td align="center"><?=$i;?></td>
      <td align="left"><?=$rows["diag"];?></td>
      <td align="center"><?=$rows["case1"];?></td>
      <td align="center"><?=$rows["case2"];?></td>
      <td align="center"><?=$rows["case3"];?></td>
      <td align="center"><?=$rows["sumcase"];?></td>
      <td align="center">&nbsp;</td>
    </tr>
    <?
	}
	?>
    <tr>
      <td>&nbsp;</td>
      <td align="center"><strong>รวม</strong></td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
    </tr>
  </table>
  <p>หมายเหตุ	ก. = กำลังพล ข. = ครอบครัว ค. = พลเรือน</p>
<p style="margin-left:100px;"><strong>ตรวจถูกต้อง</strong></p>
</div>
