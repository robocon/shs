<?php
include("../connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<?php
$y="Y";
$sql = "select * from condxofyear_so where yearcheck='2557' and (anemia='$y' or cardiomegaly='$y' or waistline='$y' or ihd='$y' or emphysema='$y' or cystitis='$y' or cardiac='$y' or degeneration='$y' or bph='$y' or tonsil='$y' or conanemia='$y' or cirrhosis='$y' or allergy='$y' or asthma='$y' or thyroid='$y' or herniated='$y' or epilepsy='$y' or spine='$y' or alcoholic='$y' or kidney='$y' or paralysis='$y' or hepatitis='$y' or gout='$y' or muscle='$y' or heart='$y' or conjunctivitis='$y' or fracture='$y' or dermatitis='$y' or copd='$y' or pterygium='$y' or blood='$y')";
$query=mysql_query($sql);
$num=mysql_num_rows($query);
//echo $num;
?>
<p align="center">บัญชีรายชื่อข้าราชการ</p>
<p>เข้ารับการตรวจร่างกายประจำปี &nbsp;2557<br>
หน่วย &nbsp;มทบ.32 </p>
<table width="100%" border="0">
  <tr>
    <td colspan="3">1. จำนวนข้าราชการที่บรรจุจริง</td>
    <td width="18%">&nbsp;</td>
    <td width="46%">&nbsp;</td>
  </tr>
  <tr>
    <td width="4%">&nbsp;</td>
    <td colspan="2">- นายทหาร</td>
    <td align="right">235</td>
    <td>คน</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">- นายสิบ</td>
    <td align="right">749</td>
    <td>คน</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">- พลอาสา, คนงาน, ลูกจ้าง</td>
    <td align="right">37</td>
    <td>คน</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="left">รวม</td>
    <td align="right">1021</td>
    <td>คน</td>
  </tr>
  <tr>
    <td colspan="3">2. จำนวนข้าราชการที่รับการตรวจ</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">- นายทหาร</td>
    <td align="right">217</td>
    <td>คน</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">- นายสิบ</td>
    <td align="right">734</td>
    <td>คน</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">- พลอาสา, คนงาน, ลูกจ้าง</td>
    <td align="right">35</td>
    <td>คน</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="15%" align="center">&nbsp;</td>
    <td width="17%" align="left">รวม</td>
    <td align="right">986</td>
    <td>คน</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="left">เข้ารับการตรวจ</td>
    <td align="right"> 96.57 เปอร์เซ็นต์</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="5%" align="center"><strong>ลำดับ</strong></td>
    <td width="19%" align="center"><strong>ยศ - ชื่อ</strong></td>
    <td width="11%" align="center"><strong>อายุ</strong></td>
    <td width="6%" align="center"><strong>น้ำหนัก</strong></td>
    <td width="6%" align="center"><strong>สูง</strong></td>
    <td width="7%" align="center"><strong>รอบเอว</strong></td>
    <td width="46%" align="center"><strong>อาการโรคที่ตรวจพบหรือสภาพความไม่สมบูรร์ของร่างกายคำแนะนำปฏิบัติของแพทย์</strong></td>
  </tr>
<?
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;
$camp = $rows["camp"];
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$rows["ptname"];?></td>
    <td><?=$rows["age"];?></td>
    <td><?=$rows["weight"];?></td>
    <td><?=$rows["height"];?></td>
    <td><?=$rows["round_"];?></td>
    <td>
	<?
    if($rows["anemia"]=="Y"){
		echo "โลหิตจาง, ";
	}
    if($rows["cardiomegaly"]=="Y"){
		echo "หัวใจโต, ";
	}
    if($rows["waistline"]=="Y"){
		echo "รอบเอวเกิน, ";
	}
    if($rows["ihd"]=="Y"){
		echo "โรคหัวใจขาดเลือดเรื้อรัง, ";
	}
    if($rows["emphysema"]=="Y"){
		echo "ถุงลมโป่งพอง, ";
	}
    if($rows["cystitis"]=="Y"){
		echo "กระเพาะปัสสาวะอักเสบ, ";
	}
    if($rows["cardiac"]=="Y"){
		echo "หัวใจเต้นผิดจังหวะ, ";
	}
    if($rows["degeneration"]=="Y"){
		echo "หัวเข่าเสื่อม, ";
	}
    if($rows["bph"]=="Y"){
		echo "BPH, ";
	}
    if($rows["tonsil"]=="Y"){
		echo "ต่อมทอนซิลโต, ";
	}
    if($rows["conanemia"]=="Y"){
		echo "ภาวะซีด, ";
	}
    if($rows["cirrhosis"]=="Y"){
		echo "ตับแข็ง, ";
	}
    if($rows["allergy"]=="Y"){
		echo "ภูมิแพ้, ";
	}
    if($rows["asthma"]=="Y"){
		echo "หอบหืด, ";
	}
    if($rows["thyroid"]=="Y"){
		echo "ไทรอยด์, ";
	}
    if($rows["herniated"]=="Y"){
		echo "หมอนรองกระดูกทับเส้นประสาท, ";
	}
    if($rows["epilepsy"]=="Y"){
		echo "ลมชัก, ";
	}
    if($rows["spine"]=="Y"){
		echo "กระดูกสันหลัง (อก) คด, ";
	}
    if($rows["alcoholic"]=="Y"){
		echo "ความผิดปกติจากแอลกอฮอล์, ";
	}
    if($rows["kidney"]=="Y"){
		echo "ไตผิดปกติ, ";
	}
    if($rows["paralysis"]=="Y"){
		echo "อัมพาตซีกซ้าย/ขวา, ";
	}
    if($rows["hepatitis"]=="Y"){
		echo "โรคตับอักเสบ, ";
	}
    if($rows["gout"]=="Y"){
		echo "โรคเก๊าท์, ";
	}
    if($rows["muscle"]=="Y"){
		echo "กล้ามเนื้ออักเสบ, ";
	}
    if($rows["heart"]=="Y"){
		echo "โรคหัวใจ, ";
	}
    if($rows["conjunctivitis"]=="Y"){
		echo "เยื่อบุตาอักเสบ, ";
	}
    if($rows["fracture"]=="Y"){
		echo "กระดูกหักเลื่อน, ";
	}
    if($rows["dermatitis"]=="Y"){
		echo "ผิวหนังอักเสบ, ";
	}
    if($rows["copd"]=="Y"){
		echo "COPD, ";
	}
    if($rows["pterygium"]=="Y"){
		echo "ต้อเนื้อ, ";
	}
    if($rows["blood"]=="Y"){
		echo "เม็ดเลือดผิดปกติ, ";
	}
													
	?>
    </td>
  </tr>
 <?
 }
 ?>
</table>
