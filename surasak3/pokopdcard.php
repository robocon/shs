<?
session_start();
include("connect.inc");
$_GET['hn']="47-1";
$sql="SELECT *, concat(yot,name,' ',surname) as ptname FROM `opcard` WHERE  hn = '".$_GET['hn']."'";
$query=mysql_query($sql) or die (mysql_error());
$rows=mysql_fetch_array($query);
explode("-",$rows["dbirth"])
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
#head1 {
  font-family:"TH SarabunPSK";
  font-size: 20px;
  font-weight:bold;
}
#head2 {
  font-family:"TH SarabunPSK";
  font-size: 18px;
  font-weight:bold;
}
#tdbottom {
  border-bottom:solid 1px #000;
}
#td-left {
  border-left:solid 1px #000;
}
#td-leftbottom {
  border-bottom:solid 1px #000;
  border-left:solid 1px #000;
}
#td-leftdashedbottom {
  border-bottom:dashed 1px #000;
  border-left:solid 1px #000;
}

-->
</style>
<div align="center">
<div align="center" id="head1">บัตรบันทึกผู้รับบริการ โรงพยาบาลค่ายกาวิละ</div>
<div align="center" id="head2">285 ถ.เชียงใหม่-ลำพูน ต.วัดเกต อ.เมืองเชียงใหม่ จ.เชียงใหม่ 50000 โทรศัพท์ 053-245784</div>
<div align="center">
<table width="100%" border="0" cellpadding="5" cellspacing="0" bordercolor="#000000" style="border-top:solid 1px #000; border-right: solid 1px #000; border-bottom: solid 1px #000; border-left: solid 1px #000;">
  <tr>
    <td colspan="3" id="tdbottom" ><strong>เลขที่บัตรทอง</strong><?=$rows[""];?></td>
    <td width="277" rowspan="2" align="left" valign="top" id="td-leftbottom"><strong>สิทธิการรักษา</strong> <?=$rows["ptright"];?></td>
    <td colspan="3" rowspan="2" align="left" valign="top" id="td-leftbottom"><strong>HN</strong> <?=$rows["hn"];?></td>
  </tr>
  <tr>
    <td colspan="3" id="tdbottom"><strong>เลขที่บัตรประชาชน</strong> <?=$rows["idcard"];?></td>
    </tr>
  <tr>
    <td colspan="4" id="tdbottom"><strong>ชื่อ-สกุล</strong> <?=$rows["ptname"];?></td>
    <td colspan="3" align="left" valign="top" id="td-leftbottom"><strong>วัน เดือน ปี เกิด</strong> <?=$rows["ptname"];?></td>
  </tr>
  <tr>
    <td width="180" id="tdbottom"><strong>เพศ 
      <? 
		if($rows["sex"]=="ช"){
			echo "ชาย";
		}else if($rows["sex"]=="ญ"){
			echo "หญิง";
		}else{
			echo "ไม่ได้ระบุ";
		}	  
	  ?>
    </strong></td>
    <td colspan="2" align="left" id="tdbottom"><strong>สังกัด 
      <?=$rows["camp"];?>
    </strong></td>
    <td id="tdbottom">&nbsp;</td>
    <td width="271" align="left" id="td-left"><strong>ตรวจครั้งแรกเมื่อ</strong></td>
    <td colspan="2" align="center" id="td-leftbottom"><strong>เลขที่ภายใน</strong></td>
    </tr>
  <tr>
    <td id="tdbottom"><strong>อายุ 
      <?=$rows["ptname"];?>
    </strong></td>
    <td colspan="2" align="left" id="tdbottom"><strong>อาชีพ 
      <?=$rows["career"];?>
    </strong></td>
    <td id="tdbottom">&nbsp;</td>
    <td align="left" id="td-leftbottom"><strong>ผู้บันทึก</strong></td>
    <td width="97" id="td-leftdashedbottom">&nbsp;</td>
    <td width="87" id="td-leftdashedbottom">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" width="180" id="tdbottom"><strong>ศาสนา 
      <?=$rows[" 	religion"];?>
    </strong></td>
    <td colspan="2" align="left" id="tdbottom"><strong>หมู่เลือด 
      <?=$rows["blood"];?>
    </strong></td>
    <td id="tdbottom">&nbsp;</td>
    <td id="td-left"><strong>X-ray</strong></td>
    <td id="td-leftdashedbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" id="tdbottom"><strong>บ้านเลขที่ 
      <?=$rows["address"];?>
    </strong></td>
    <td colspan="2" align="left" id="tdbottom"><strong>หมู่ที่
    </strong></td>
    <td align="left" width="277" id="tdbottom"><strong>ถนน
    </strong></td>
    <td id="td-leftdashedbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" id="tdbottom"><strong>ซอย
    </strong></td>
    <td colspan="2" align="left" id="tdbottom"><strong>ตำบล 
      <?=$rows["tambol"];?>
    </strong></td>
    <td align="left" id="tdbottom"><strong>อำเภอ 
      <?=$rows["ampur"];?>
    </strong></td>
    <td id="td-leftdashedbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" id="tdbottom"><strong>จังหวัด 
      <?=$rows["changwat"];?>
    </strong></td>
    <td colspan="2" align="left" id="tdbottom"><strong>สถานภาพสมรส 
      <?=$rows["ptname"];?>
    </strong></td>
    <td align="left" id="tdbottom"><strong>โทรศัพท์ 
      <?=$rows["ptname"];?>
    </strong></td>
    <td id="td-leftbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="left" id="tdbottom"><strong>บิดา 
      <?=$rows["ptname"];?>
    </strong></td>
    <td align="left" width="192" id="tdbottom"><strong>มารดา 
      <?=$rows["ptname"];?>
    </strong></td>
    <td id="tdbottom">&nbsp;</td>
    <td id="td-left"><strong>แพ้ยา</strong></td>
    <td id="td-leftdashedbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="left" id="tdbottom"><strong>สามี 
      <?=$rows["ptname"];?>
    </strong></td>
    <td align="left" id="tdbottom"><strong>ภรรยา 
      <?=$rows["ptname"];?>
    </strong></td>
    <td id="tdbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="left" id="tdbottom"><strong>ผู้ที่ติดต่อได</strong>้ <strong>
      <?=$rows["ptname"];?>
    </strong></td>
    <td align="left" id="tdbottom"><strong>เกี่ยวข้องเป็น 
      <?=$rows["ptname"];?>
    </strong></td>
    <td id="tdbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" id="tdbottom"><strong>โทรศัพท์ 
      <?=$rows["ptname"];?>
    </strong></td>
    <td colspan="2" id="tdbottom">&nbsp;</td>
    <td id="tdbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" align="center"><strong>(ห้ามนำออกภายนอกโรงพยาบาล)</strong></td>
    <td id="td-left">&nbsp;</td>
    <td id="td-left">&nbsp;</td>
    <td id="td-left">&nbsp;</td>
  </tr>
</table>

</div>
</div>
