<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<? 
include("connect.inc");
$sql1="SELECT *
FROM `condxofyear_so`
WHERE `dxptright` = '1' AND `organ` = 'ตรวจสุขภาพประจำปี' AND `yearcheck` = '2558' ORDER BY camp ASC, hn ASC";
$query1=mysql_query($sql1)or die (mysql_error());
?>
<h1 class="pdx" align="center">รายชื่อกำลังพล ทบ. ที่ตรวจสุขภาพประจำปี 2558</h1>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#339966" class="pdxpro">
  <tr>
    <td width="4%" align="center" bgcolor="#66CC99">#</td>
    <td width="6%" align="center" bgcolor="#66CC99">HN</td>
    <td width="5%" align="center" bgcolor="#66CC99">ยศ</td>
    <td width="7%" align="center" bgcolor="#66CC99">ชื่อ</td>
    <td width="7%" align="center" bgcolor="#66CC99">นามสกุล</td>
    <td width="7%" align="center" bgcolor="#66CC99">อายุ</td>
    <td width="7%" align="center" bgcolor="#66CC99">ชั้นยศ</td>
    <td width="7%" align="center" bgcolor="#66CC99">ตำแหน่ง</td>
    <td width="7%" align="center" bgcolor="#66CC99">สังกัด/หน่วย</td>
    <td width="7%" align="center" bgcolor="#66CC99">สิทธิเบิก</td>
    <td width="7%" align="center" bgcolor="#66CC99">ช่วยราชการ (ถ้ามี)</td>
    <td width="8%" align="center" bgcolor="#66CC99">ประวัติโรคประจำตัว</td>
    <td width="6%" align="center" bgcolor="#66CC99">น้ำหนัก</td>
    <td width="7%" align="center" bgcolor="#66CC99">ส่วนสูง</td>
    <td width="15%" align="center" bgcolor="#66CC99">BP</td>
  </tr>
  <?
  $i=0;
  while($arr1=mysql_fetch_array($query1)){
  $i++;
  if($arr1['chunyot']=="CH01"){
  		$chunyot="นายทหารชั้นสัญญาบัตร";
  }else if($arr1['chunyot']=="CH02"){
  		$chunyot="นายทหารชั้นประทวน";
  }else if($arr1['chunyot']=="CH03"){
  		$chunyot="ลูกจ้างประจำ";
  }else if($arr1['chunyot']=="CH04"){
  		$chunyot="พนักงานราชการ";
  }else{
  		$chunyot="&nbsp;";
  }
  
  if($arr1['prawat']=="0"){
  		$prawat="ไม่มีโรคประจำตัว";
  }else if($arr1['prawat']=="1"){
  		$prawat="โรคความดันโลหิตสูง";
  }else if($arr1['prawat']=="2"){
  		$prawat="โรคเบาหวาน";
  }else if($arr1['prawat']=="3"){
  		$prawat="โรคหัวใจหรือโรคหลอดเลือด";
  }else if($arr1['prawat']=="4"){
  		$prawat="โรคไขมันในเลือดสูง";
  }else if($arr1['prawat']=="5"){
  		$prawat="โรคประจำตัว 4 โรคที่กำหนดไว้ร่วมกัน ตั้งแต่ 2 โรคขึ้นไป ($arr1[congenital_disease])";
  }else if($arr1['prawat']=="6"){
  		$prawat="โรคประจำตัวนอกเหนือจาก 4 โรคที่กำหนดไว้  ($arr1[congenital_disease])";
  }else{
  		$prawat="&nbsp;";
  }
   ?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td><? if(!empty($arr1['hn'])){ echo $arr1['hn'];}else{ echo "&nbsp;";}?></td>
    <td><? if(!empty($arr1['yot'])){ echo $arr1['yot'];}else{ echo "&nbsp;";}?></td>
    <td><? if(!empty($arr1['name'])){ echo $arr1['name'];}else{ echo "&nbsp;";}?></td>
    <td><? if(!empty($arr1['surname'])){ echo $arr1['surname'];}else{ echo "&nbsp;";}?></td>
    <td><? if(!empty($arr1['age'])){ echo $arr1['age'];}else{ echo "&nbsp;";}?></td>
    <td><?=$chunyot;?></td>
    <td><? if(!empty($arr1['position'])){ echo $arr1['position'];}else{ echo "&nbsp;";}?></td>
    <td><? if(!empty($arr1['camp'])){ echo $arr1['camp'];}else{ echo "&nbsp;";}?></td>
    <td><? if($arr1['dxptright']==1){ echo "สิทธิข้าราชการ";}else{ echo "&nbsp;";}?></td>
    <td align="center"><? if(!empty($arr1['ratchakarn'])){ echo $arr1['ratchakarn'];}else{ echo "-";}?></td>
    <td><?=$prawat;?></td>
    <td><?=$arr1['weight'];?></td>
    <td><?=$arr1['height'];?></td>
    <td><?=$arr1['bp1'].'/'.$arr1['bp2'];?></td>
  </tr>
  <? } ?>
</table>
