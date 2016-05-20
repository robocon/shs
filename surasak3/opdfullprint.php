<body Onload="window.print();">
<Script Language="JavaScript">
</Script>
<?php
session_start();
    include("connect.inc");
    
    $sql = "SELECT * FROM opcard WHERE hn = '$cHn'";
    $rs= mysql_query($sql);

	

function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

return $pAge;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<title>MEDIACAL RECORD</title>
<style type="text/css">
.a {
	text-align: center;
}
.s {
	color: #000;
}
.style2 {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.style9 {font-family: "TH SarabunPSK"; font-size: 16pt}
.style11 {font-family: "TH SarabunPSK"; text-align: center;}
.style13 {font-family: "TH SarabunPSK"; font-size: 20pt}

</style>

<? $show=mysql_fetch_assoc($rs);  ?>
<style type="text/css">
@media print
{
#non-printable { display:none; }
#printable { display:none; }
}
.style14 {
	font-size: 30pt;
	font-weight: bold;
}
.style18 {font-size: smaller; }
.style19 {font-size: 24px}
</style>

<body>
<div align="left" class="style2">
  <table width="1143" border="0">
    <tr>
      <td width="132" rowspan="3"><div align="right"><img src="images/logoopdcardfull.jpg" width="128" height="128" /></div></td>
      <td width="535"><div align="center" class="style14">โรงพยาบาลค่ายสุรศักดิ์มนตรี</div></td>
      <td width="462" rowspan="3">
        <div align="center">
          <table width="300" border="1">
            <tr><center>
                <td width="450" height="22"><div align="center" style="font-size:100px">
                  <?=$show['hn'];?>
                </font></div></td>
            </center> </tr>
                    </table>
        </div></td></tr>
    <tr>
      <td><div align="center" class="style18">มทบ.32 จ.ลำปาง โทร (054)839305 </div></td>
    </tr>
    <tr>
      <td><div align="center" class="style18">เวชระเบียน / <font style="font-size: 18px;">MEDICAL RECORD </font></div></td>
    </tr>
  </table>
</div>
  <table width="1141" border="1" cellspacing="0">
  <tr>
    <td width="1141" class="style13">
  <table width="1141" border="1" cellspacing="0">
  <tr>
    <td colspan="4" class="style9"  style="border-right-style:none; border-left-style:none"><strong>เลขที่บัตรประชาชน</strong><span class="style13" style="border-right-style:none; border-left-style:none">
      <strong><?=$show['idcard'];?>
   </strong> </span></td>
    <td width="174" class="style9" style="border-right-style:none; border-left-style:none"><strong>วันลงทะเบียน</strong></td>
    <td colspan="3" class="style9" style="border-right-style:none; border-left-style:none"><div align="center">
      <?=$show['regisdate'];?>
    </div></td>
  </tr>
  <tr>
    <td width="157" height="67" class="style9"style="border-right-style:none; border-left-style:none; border-bottom-style:none; "><strong>ชื่อ-สกุล</strong></td>
    <td colspan="5" class="style9"style="border-right-style:none; border-left-style:none; border-bottom-style:none"><strong><font style="font-size: 16px;"><?=$show['yot'];?>
      <?=$show['name'];?>    
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$show['surname'];?>
   </strong></td>
    <td width="96" class="style11"><strong>AN</strong></td>
    <td width="95" class="style11"><strong>XN</strong></td>
  </tr>
  <tr>
    <td class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><strong>วัน เดือน ปีเกิด</strong></td>
    <td width="141" class="style13" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><? $a1 = array( "","มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม" );?> <?=substr($show['dbirth'],8,2)."&nbsp;".$a1[substr($show['dbirth'],5,2)+0]."&nbsp;".substr($show['dbirth'],0,4);?></td>
    <td width="160" class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><strong>เพศ</strong></td>
 <td width="107" class="style13" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none">
 <? if($show['sex'] != "ญ") { echo "ชาย";  }else{   echo "หญิง"; } ?> </td>
    <td class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><strong>อายุ</strong></td>
    <td width="177" class="style13" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><?=calcage($show['dbirth'])?></td>
    <td class="style9">&nbsp;</td>
    <td class="style9">&nbsp;</td>
  </tr>
  <tr>
    <td class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><strong>ศาสนา</strong></td>
    <td class="style13" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><?=$show['religion'];?></td>
    <td class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><strong>เชื้อชาติ</strong></td>
    <td class="style13" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><?=$show['race'];?></td>
    <td class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><strong>สัญชาติ</strong></td>
    <td class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><?=$show['nation'];?></td>
    <td class="style9">&nbsp;</td>
    <td class="style9">&nbsp;</td>
  </tr>
  <tr>
    <td class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><strong>บิดา</strong></td>
    <td class="style13" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><?=$show['father'];?></td>
    <td class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><strong>มารดา</strong></td>
    <td class="style13" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><?=$show['mother'];?></td>
    <td class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><strong>คู่สมรส</strong></td>
    <td class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><?=$show['couple'];?></td>
    <td class="style9">&nbsp;</td>
    <td class="style9">&nbsp;</td>
  </tr>
  <tr>
    <td class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><strong>อาชีพ</strong></td>
    <td class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><span class="style13" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><span class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><?=$show['career'];?>
    </span></span></td>
    <td class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><strong>การศึกษา</strong></td>
    <td colspan="3" class="style13" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><? if($show['education'] ==0) { echo"ไม่ได้ศึกษา/ไม่มีวุฒิการศึกษา"; } elseif   ($show['education'] ==1)  { echo "ก่อนประถมศึกษา" ; } elseif  ($show['education'] ==2) { echo "ประถมศึกษา" ;} elseif ($show['education'] ==3) { echo "มัธยมศึกษา"; } elseif($show['education'] ==4) { echo "อนุปริญญา"; } elseif($show['education'] ==5) { echo "ปริญญาตรี"; } elseif($show['education'] ==6) { echo "สูงกว่าปริญญาตรี";} else { echo "ไม่ระบุ/ไม่ทราบ";}?></td>
    <td class="style9">&nbsp;</td>
    <td class="style9">&nbsp;</td>
  </tr>
  <tr>
    <td class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><strong>ที่อยู่ปัจจุบัน</strong></td>
    <td class="style13" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><?=$show['address'];?> &nbsp;</td>
    <td class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><strong>ตำบล</strong></td>
    <td class="style13" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><?=$show['tambol'];?></td>
    <td class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><strong>อำเภอ</strong></td>
    <td class="style13" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><?=$show['ampur'];?></td>
    <td class="style9">&nbsp;</td>
    <td class="style9">&nbsp;</td>
  </tr>
  <tr>
    <td class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><strong>จังหวัด</strong></td>
    <td class="style13" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><?=$show['changwat'];?></td>
    <td class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><strong><span class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none">โทรศัพท</span>์</strong></td>
    <td colspan="3" class="style13" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><?=$show['phone'];?>&nbsp;</td>
    <td class="style9">&nbsp;</td>
    <td class="style9">&nbsp;</td>
  </tr>
  <tr>
    <td class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><strong>ชื่อผู้ติดต่อ</strong></td>
    <td class="style13" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><?=$show['ptf'];?></td>
    <td class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><strong>เกี่ยวข้องเป็น</strong></td>
    <td class="style13" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><?=$show['ptfadd'];?></td>
    <td class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><strong>โทรศัพท์ผู้ติดต่อ</strong></td>
    <td class="style13" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><?=$show['ptffone'];?></td>
    <td class="style9">&nbsp;</td>
    <td class="style9">&nbsp;</td>
  </tr>
  <tr>
    <td class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none"><strong>สิทธิการรักษา</strong></td>
    <td colspan="5" class="style13" style="border-right-style:none; border-left-style:none; border-bottom-style:none"><?=$show['ptright'];?></td>
    <td class="style9">&nbsp;</td>
    <td class="style9">&nbsp;</td>
  </tr>
  <tr>
    <td class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><strong>ประเภท</strong></td>
    <td colspan="5" class="style13" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><?=$show['goup'];?></td>
    <td class="style9">&nbsp;</td>
    <td class="style9">&nbsp;</td>
  </tr>
  <tr>
    <td class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><strong>สังกัด</strong></td>
    <td colspan="5" class="style13" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><?=$show['camp'];?>&nbsp;</td>
    <td class="style9">&nbsp;</td>
    <td class="style9">&nbsp;</td>
  </tr>
  <tr>
    <td class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><strong>เบิกจาก</strong></td>
    <td colspan="5" class="style13" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><?=$show['ptfmon'];?></td>
    <td class="style9">&nbsp;</td>
    <td class="style9">&nbsp;</td>
  </tr>
  <tr>
    <td class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><strong>หน่วยงาน</strong></td>
    <td colspan="5" class="style13" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><?=$show['guardian'];?></td>
    <td class="style9">&nbsp;</td>
    <td class="style9">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none; font-weight: bold;">*หมายเหตุ</td>
    <td class="style9">&nbsp;</td>
    <td class="style9">&nbsp;</td>
  </tr>
  <tr>
    <td class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><strong>กรุ๊ปเลือด</strong></td>
    <td class="style13" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><?=$show['blood'];?></td>
    <td class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><strong>แพ้ยา</strong></td>
    <td colspan="3" class="style13" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><?=$show['drugreact'];?></td>
    <td class="style9">&nbsp;</td>
    <td class="style9">&nbsp;</td>
  </tr>
  <tr>
    <td class="style9" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><strong>หมายเหตุ</strong></td>
    <td colspan="5" class="style13" style="border-right-style:none; border-left-style:none; border-bottom-style:none; border-top-style:none"><?=$show['idguard2'];?> </td>
    <td class="style9">&nbsp;</td>
    <td class="style9">&nbsp;</td>
  </tr>
  </table></td></tr></table>
<p class="style2">&nbsp;</p>
</body>


</html>
