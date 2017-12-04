<?
  include("connect.inc");
?>
<style type="text/css">
<!--
.font1 {
	font-family: AngsanaUPC;
}
-->
</style>
<center><span class="font1" style="font-size:22px">ยาที่ผิดปกติที่มีใช้ในร.พ.</span></center>
<table width="80%" border="0">
  <tr>
    <td width="5%" align="center" bgcolor="#AC8228"><span class="font1">#</span></td>
    <td width="34%" align="center" bgcolor="#AC8230"><span class="font1">ชื่อยา</span></td>
    <td width="15%" align="center" bgcolor="#AC8230"><span class="font1">ราคาทุน</span></td>
    <td width="17%" align="center" bgcolor="#AC8230"><span class="font1">ราคาขายปัจจุบัน</span></td>
    <td width="19%" align="center" bgcolor="#AC8230"><span class="font1">ราคาตามกรมบัญชีกลาง</span></td>
    <td width="10%" align="center" bgcolor="#AC8230"><span class="font1">ส่วนต่าง</span></td>
  </tr>
  <?
  $sql = "select * from druglst where unitpri!=0 and usercontrol!='' ";
  $row = mysql_query($sql);
  while($result = mysql_fetch_array($row)){
    $nUnitpri=$result['unitpri'];
	if ($nUnitpri >= .01 & $nUnitpri <= .20){
		$nSalepri = .50;
		}
	if ($nUnitpri >= .21 & $nUnitpri <= .50){
		$nSalepri = 1.00;
		}
	if ($nUnitpri >= .50 & $nUnitpri <= 1){
		$nSalepri = 1.50;
		}
	if ($nUnitpri >= 1.01 & $nUnitpri <= 10){
		$nSalepri = 1.50+1.25*($nUnitpri-1);
		}
	if ($nUnitpri >= 10.01 & $nUnitpri <= 100){
		$nSalepri = 13+1.20*($nUnitpri-10);
		}
	if ($nUnitpri >= 100.01 & $nUnitpri <= 1000){
		$nSalepri = 126+1.15*($nUnitpri-100);
		}
	if ($nUnitpri > 1000){
		$nSalepri = 1161+1.10*($nUnitpri-1000);
		}
	$nVArabic =$nSalepri;
    $nSalepri = number_format($nSalepri, 2, '.', ''); 
    $cTarget = Ltrim($nSalepri);
    $cLtnum="";
    $x=0;
    while (substr($cTarget,$x,1) <> "."){
            $cLtnum=$cLtnum.substr($cTarget,$x,1);
            $x++;
	}

   $cRtnum=substr($cTarget,$x+1);//ค่าเป็นตัวเลข ใช้คำนวลได้,2 ทศนิยม ปัดเศษ
   $nSalepri=intval($nSalepri)+$cRtnum/100;
	
	if ($nSalepri < 10){
		if ($cRtnum <= 12){
			$nSalepri=intval($nSalepri);
				}
		if ($cRtnum >12 & $cRtnum<37){
			$nSalepri=intval($nSalepri) + .25;
				}
		if ($cRtnum >=37 & $cRtnum<62){
			$nSalepri=intval($nSalepri) + .5;
				}
		if ($cRtnum >=62){
			$nSalepri=intval($nSalepri) + .75;
				}
	}
	
	if ($nSalepri  >= 10 & $nSalepri <= 100){
		if ($cRtnum < 37){
			$nSalepri=intval($nSalepri);
			}		
		if ($cRtnum >= 37 & $cRtnum < 72 ){
			$nSalepri=intval($nSalepri) + .5;
				}
		if ($cRtnum >= 72){
			$nSalepri=intval($nSalepri+1);
				}
	}
	///////////
	if ($nSalepri > 100){
		if ($cRtnum >= 50){
			$nSalepri=intval($nSalepri+1);
				}
		if($cRtnum>=0 & $cRtnum<50){
			$nSalepri=intval($nSalepri);
			}
	}
	$nSalepri = number_format($nSalepri, 2, '.', ''); 
	if(($result['salepri']-$nSalepri)!=0){
		 $i++;
  ?>
  <tr>
    <td align="center"><span class="font1">
      <?=$i?>
    </span></td>
    <td><span class="font1">
      <?=$result['tradname']?>
    </span></td>
    <td align="right"><span class="font1">
      <?=$result['unitpri']?>
    </span></td>
    <td align="right"><span class="font1">
      <?=$result['salepri']?>
    </span></td>
    <td align="right"><span class="font1">
      <?=$nSalepri?>
    </span></td>
    <td align="right"><span class="font1">
      <?=$result['salepri']-$nSalepri?>
    </span></td>
  </tr>
  <?
	}
  }
  ?>
</table>
