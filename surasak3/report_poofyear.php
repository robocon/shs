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
    <td rowspan="3" align="center"> �ӴѺ</td>
    <td colspan="2" rowspan="3" align="center">������ �ѹ/��͹/��<br>�ͧ�ѭ���������觫���</td>
    <td rowspan="3" align="center">�����/����Ѻ��ҧ</td>
    <td rowspan="3" align="center">�������ͧ<br>
      ��ʴط��Ѵ��</td>
    <td colspan="2" align="center">ǧ�Թ</td>
    <td rowspan="3" align="center">�š�èѴ�Ңͧ˹���</td>
    <td rowspan="3" align="center">�����˵�</td>
  </tr>
  <tr>
    <td align="center">���Ἱ�Ѵ��</td>
    <td align="center">����ѭ��</td>
  </tr>
  <tr>
    <td align="center">�ҷ/ʵ.</td>
    <td align="center">�ҷ/ʵ.</td>
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
    <td align="center">��,�Ǫ�ѳ��</td>
    <td align="right"><?=number_format($nPriadvat,2);?></td>
    <td align="right"><?=number_format($nPriadvat,2);?></td>
    <td>����Թ������º��������</td>
    <td>&nbsp;</td>
  </tr>
  <? 
  $n++;
  } ?>
</table>