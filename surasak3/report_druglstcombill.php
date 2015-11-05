<?php
session_start();
include("connect.inc");
?>    
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<p align="center"><strong>แบบสำรวจข้อมูลราคาจัดซื้อยาของหน่วยงานภาครัฐเพื่อประกอบการพิจารณาจัดทำราคากลางยา</strong></p>
<div style="margin-left:5%;"><strong>ชื่อหน่วยงาน : โรงพยาบาลค่ายสุรศักดิ์มนตรี</strong></div>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="4%" rowspan="2" align="center"><strong>ลำดับ</strong></td>
        <td width="17%" rowspan="2" align="center"><strong>รหัส</strong></td>
    <td width="17%" rowspan="2" align="center"><strong>ชื่อการค้า</strong></td>
    <td width="11%" rowspan="2" align="center"><strong>ชื่อสามัญทางยา</strong></td>
    <td width="8%" rowspan="2" align="center"><strong>ความแรง</strong></td>
    <td width="8%" rowspan="2" align="center"><strong>รูปแบบ</strong></td>
    <td width="7%" rowspan="2" align="center"><strong>ขนาดบรรจุ</strong></td>
    <td width="15%" rowspan="2" align="center"><strong>ราคายาที่จัดซื้อได้ต่อขนาดบรรจุ<br>
      (เป็นราคาสุทธิที่รวม VAT และ<br>
    คำนวณส่วนลด/ของแถมแล้ว)</strong></td>
    <td width="8%" rowspan="2" align="center"><strong>วันเดือนปี<br>
    ที่จัดซื้อล่าสุด</strong></td>
    <td colspan="2" align="center"><strong>บริษัทผู้จำหน่าย</strong></td>
  </tr>
  <tr>
    <td align="center"><strong>รหัสบริษัท</strong></td>
    <td align="center"><strong>ชื่อบริษัท</strong></td>
  </tr>
  <?
  $sql="select * from druglst where part='DDL' || part='DDY' || part='DDN' order by drugcode";
  $query=mysql_query($sql);
  $i=0;
  while($rows=mysql_fetch_array($query)){
  $i++;
  ?>
  <tr>
    <td align="center"><?=$i;?></td>
     <td><?=$rows["drugcode"];?></td>
    <td><?=$rows["tradname"];?></td>
    <td><?=$rows["genname"];?></td>
    <td><? if(empty($rows["strength"])){ echo "&nbsp;";}else{ echo $rows["strength"];}?></td>
    <td><? if(empty($rows["unit"])){ echo "&nbsp;";}else{ echo $rows["unit"];}?></td>
    <td><? if(empty($rows["packing"])){ echo "&nbsp;";}else{ echo $rows["packing"];}?></td>
    <td align="right"><?=number_format($rows["packpri_vat"],2);?></td>
    <?
	  $strquery="select * from combill where drugcode='".$rows["drugcode"]."' order by billdate desc limit 0,1";
	  //echo $strquery;
	  $result=mysql_query($strquery);
	  $strrows=mysql_fetch_array($result);
	?>
    <td align="center"><? if(empty($strrows["billdate"])){ echo "&nbsp;";}else{ echo $strrows["billdate"];}?></td>
    <td width="5%" align="center"><? if(empty($strrows["comcode"])){ echo "&nbsp;";}else{ echo $strrows["comcode"];}?></td>
    <td width="17%"><? if(empty($strrows["comname"])){ echo "&nbsp;";}else{ echo $strrows["comname"];}?></td>
  </tr>
  <?
  }
  ?>
</table>

