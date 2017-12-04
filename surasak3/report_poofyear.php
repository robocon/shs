<?
include("connect.inc");

$sql="SELECT left( pono, 5 ) AS pono1, right( pono, 2 ) AS pono2, `comname`,podate ,netprice
FROM `pocompany`
WHERE date
BETWEEN '2554-10-01 00:00:00' AND '2555-09-30 23:59:59' AND pono != ''
ORDER BY `pono2` ASC , `pono1` ASC ";

$result = mysql_query($sql);





function vat($nVArabic){
    $nVArabic = number_format($nVArabic, 2, '.', ''); 
    $cTarget = Ltrim($nVArabic);
    $cLtnum="";
    $x=0;
    while (substr($cTarget,$x,1) <> "."){
            $cLtnum=$cLtnum.substr($cTarget,$x,1);
            $x++;
	}
   $cRtnum=substr($cTarget,$x+1);

$cRtnum=$cRtnum/100;
$cRtnum=intval($cRtnum);
$vat=$nVArabic+$cRtnum;
return $vat;
	}
	
	


?>
<style>
.th{
	font-family:"TH SarabunPSK";
	font-size:16pt;
}
</style>
<table  width="100%" border="1"  class="th" style="border-collapse:collapse;" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td rowspan="3" align="center"> ลำดับ</td>
    <td colspan="2" rowspan="3" align="center">ที่และ วัน/เดือน/ปี<br>ของสัญญาหรือใบสั่งซื้อ</td>
    <td rowspan="3" align="center">ผู้ขาย/ผู้รับจ้าง</td>
    <td rowspan="3" align="center">ประเภทของ<br>
      พัสดุที่จัดหา</td>
    <td colspan="2" align="center">วงเงิน</td>
    <td rowspan="3" align="center">ผลการจัดหาของหน่วย</td>
    <td rowspan="3" align="center">หมายเหตุ</td>
  </tr>
  <tr>
    <td align="center">ตามแผนจัดหา</td>
    <td align="center">ตามสัญญา</td>
  </tr>
  <tr>
    <td align="center">บาท/สต.</td>
    <td align="center">บาท/สต.</td>
  </tr>
  <?  
  $n=1;
 while($arr=mysql_fetch_array($result)){
	 $nNetprice=$arr['netprice'];
	 $nVat=$nNetprice*.07;
	 
	 $nVat=vat($nVat);
	 $nPriadvat=$nVat+$nNetprice;
  ?>
  <tr>
    <td align="center"><?=$n;?></td>
    <td><?=$arr['pono1'].'/'.$arr['pono2'];?></td>
    <td align="center"><?=$arr['podate'];?></td>
    <td><?=$arr['comname'];?></td>
    <td align="center">ยา,เวชภัณฑ์</td>
    <td align="right"><?=number_format($nPriadvat,2);?></td>
    <td align="right"><?=number_format($nPriadvat,2);?></td>
    <td>ได้ดำเนินการเรียบร้อยแล้ว</td>
    <td>&nbsp;</td>
  </tr>
  <? 
  $n++;
  } ?>
</table>