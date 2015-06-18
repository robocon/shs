<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>บันทึกข้อมูลการติดตามภาวะการติดเชื้อ</title>
</head>
<link rel="stylesheet" type="text/css" href="../style.css" />
<style type="text/css">
<!--
.h {
	font-family: "TH SarabunPSK";
	font-size:16pt;
}
.hfont{
	font-family: "TH SarabunPSK";
	font-size:14pt;
}
-->
</style>
<style type="text/css">
table.sample {
	border-width: 2px;
	border-spacing: 1px;
	border-style: none;
	border-color: black;
	border-collapse: collapse;
	background-color: white;
}
table.sample th {
	border-width: 2px;
	padding: 2px;
	/*border-style: dashed; */
	border-color: black;
	background-color: rgb(255, 245, 238);
	-moz-border-radius: ;
}
table.sample td {
	border-width: 2px;
	padding: 2px;
	/* border-style: dashed; */
	border-color: black;
	background-color: rgb(255, 245, 238);
	-moz-border-radius: ;
}
.font22{
	font-family:"TH SarabunPSK";
	font-size:18px;
	color:#00F;
}

</style>
<body>
<?
function displaydate($datex) {
	$date_array=explode("-",$datex);
	$y=$date_array[0];
	$m=$date_array[1];
	$d=$date_array[2];
	$displaydate="$d-$m-$y";
	return $displaydate;
}
//include("../connect.inc");
include("connect.inc");

$sql="SELECT * FROM ic_accident  as a , departments as b WHERE a.depart=b.code and row_id='".$_GET['id']."' ";

$query=mysql_query($sql);
$arr=mysql_fetch_array($query);

?>
<script>

</script>
<h2 class="h" align="center" >โรงพยาบาลค่ายสุรศักดิ์มนตรี</h2>
<h2 class="h" align="center" ><u>รายงานอุบัติการณ์ ซึ่งอาจมีผลให้บุคลากรได้รับการติดเชื้อจากปฏิบัติงาน</u></h2>
<h2 class="h" align="center" >FR-ICC-001/1,01, 10  พ.ย. 49</h2>
<p align="center" style="line-height:1px;">.............................................................................................</p>

<table border="0" align="center" class="hfont">
    <tr>
      <td>1.</td>
      <td colspan="6">ชื่อหน่วยงาน......<?=$arr['name'];?>......</td>
    </tr>
    <tr>
      <td>2.</td>
      <td colspan="6" class="sample">ชื่อบุคลากร....<?=$arr['ptname'];?>.....&nbsp;&nbsp;&nbsp;&nbsp;อายุ
      <?=$arr['age'];?>      &nbsp;&nbsp;&nbsp;&nbsp;HN
      <?=$arr['hn'];?></td>
    </tr>
    <tr>
      <td>3.</td>
      <td colspan="6">ประเภทบุคลากร.....<? if($arr['staff']=="other" ||  $arr['staff']==""){ echo $arr['staff_other']; }else{ echo $arr['staff']; }?></td>
    </tr>
    <tr>
      <td>4.</td>
      <td colspan="6">เกิดอุบัติเหตุ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่
      <?=$arr['thidate'];?></td>
    </tr>
    <tr>
      <td>5.</td>
      <td colspan="6">ลักษณะอุบัติเหตุ</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><input type="checkbox" name="ac_type1" id="ac_type1" value="1"  disabled="disabled" <? if($arr['ac_type1']==1){ echo "checked='checked'"; }?>/>
    ของแหลมคมที่ปนเปื้อนเลือด หรือสารน้ำจากร่างกายผู้ป่วย ทิ่มตำ หรือบาด</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><input type="radio" name="ac_by" id="ac_by1"  disabled="disabled" value="มีด" checked="checked" <? if($arr['ac_by']=='มีด'){ echo "checked='checked'"; }?> />
        มีด 
          <input type="radio" name="ac_by" id="ac_by2" value="แก้ว"  <? if($arr['ac_by']=='แก้ว'){ echo "checked='checked'"; }?> disabled="disabled"/>
แก้ว
<input type="radio" name="ac_by" id="ac_by3" value="เข็ม" <? if($arr['ac_by']=='เข็ม'){ echo "checked='checked'"; }?> disabled="disabled" />
เข็ม
<input type="radio" name="ac_by" id="ac_by4" value="อื่นๆ" <? if($arr['ac_by']=='อื่นๆ'){ echo "checked='checked'"; }?> disabled="disabled" />
อื่นๆ
<?=$arr['ac_by_detail'];?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><input type="checkbox" name="ac_type2" id="ac_type2" disabled="disabled" value="2"  <? if($arr['ac_type2']==2){ echo "checked='checked'"; }?>/>ผิวหนังที่มีบาดแผล สัมผัสถูกเลือดหรือสารน้ำจากร่างกายผู้ป่วย
        </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><input type="checkbox" name="ac_type3" id="ac_type3" value="3"  disabled="disabled" <? if($arr['ac_type3']==3){ echo "checked='checked'"; }?>/>เยื่อบุตา เนื้อเยื่ออ่อน สัมผัสถูกสารเลือดหรือสารน้ำจากร่างกายผู้ป่วย</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><input type="checkbox" name="ac_type4" id="ac_type4" value="4"  disabled="disabled" <? if($arr['ac_type4']==4){ echo "checked='checked'"; }?>/>อื่นๆ ระบุ 
        <?=$arr['ac_type5'];?></td>
    </tr>
    <tr>
      <td>6.</td>
      <td colspan="6">บรรยายลักษณะงานที่ปฏิบัติและอุบัติเหตุที่เกิดขึ้น</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6">
     <?=$arr['ac_detail']?></td>
    </tr>
    <tr>
      <td>7.</td>
      <td colspan="6">ตำแหน่งอวัยวะทที่เกิดอุบัติเหตุ......<?=$arr['ac_organ']?>.....</td>
    </tr>
    <tr>
      <td>8.</td>
      <td colspan="6">การปฐมพยาบาลที่ได้รับ คือ .....<?=$arr['first_aid']?>.....
      </td>
    </tr>
    <tr>
      <td>9.</td>
      <td colspan="6">ผู้ป่วย หรือ ผู้ใช้บริการมีผลการตรวจเลือดและประวัติ</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>9.1 HIV Ab  </td>
      <td colspan="5"><input type="radio" name="9hivab" id="9hivab1" value="บวก" <? if($arr['9hivab']=='บวก'){ echo "checked='checked'"; }?> disabled="disabled"/>
      บวก 
      <input type="radio" name="9hivab" id="9hivab1" value="ลบ" <? if($arr['9hivab']=='ลบ'){ echo "checked='checked'"; }?> disabled/>
      ลบ
      <input type="radio" name="9hivab" id="9hivab1" value="ไม่ทราบ" <? if($arr['9hivab']=='ไม่ทราบ'){ echo "checked='checked'"; }?> disabled/>
ไม่ทราบ 
<input type="radio" name="9hivab" id="9hivab1" value="ไม่ได้ตรวจ" <? if($arr['9hivab']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?> disabled/>
ไม่ได้ตรวจ
</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>9.2 HIV Ag</td>
      <td colspan="5"><input type="radio" name="9hivag" id="9hivag1" value="บวก"  <? if($arr['9hivag']=='บวก'){ echo "checked='checked'"; }?> disabled/>
บวก
<input type="radio" name="9hivag" id="9hivag1" value="ลบ" <? if($arr['9hivag']=='ลบ'){ echo "checked='checked'"; }?> disabled/>
ลบ
<input type="radio" name="9hivag" id="9hivag1" value="ไม่ทราบ" <? if($arr['9hivag']=='ไม่ทราบ'){ echo "checked='checked'"; }?> disabled/>
ไม่ทราบ
<input type="radio" name="9hivag" id="9hivag1" value="ไม่ได้ตรวจ" <? if($arr['9hivag']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?> disabled/>

ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>9.3 HBs Ag</td>
      <td colspan="5"><input type="radio" name="9hbsag" id="9hbsag1" value="บวก" <? if($arr['9hbsag']=='บวก'){ echo "checked='checked'"; }?>disabled />

บวก
<input type="radio" name="9hbsag" id="9hbsag1" value="ลบ"  <? if($arr['9hbsag']=='ลบ'){ echo "checked='checked'"; }?>disabled />

ลบ
<input type="radio" name="9hbsag" id="9hbsag1" value="ไม่ทราบ"<? if($arr['9hbsag']=='ไม่ทราบ'){ echo "checked='checked'"; }?>disabled  />

ไม่ทราบ
<input type="radio" name="9hbsag" id="9hbsag1" value="ไม่ได้ตรวจ" <? if($arr['9hbsag']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?>disabled />

ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>9.4 HBs Ab</td>
      <td colspan="5"><input type="radio" name="9hbsab" id="9hbsab1" value="บวก" <? if($arr['9hbsag']=='บวก'){ echo "checked='checked'"; }?>disabled />

บวก
<input type="radio" name="9hbsab" id="9hbsab1" value="ลบ"  <? if($arr['9hbsab']=='ลบ'){ echo "checked='checked'"; }?> disabled/>

ลบ
<input type="radio" name="9hbsab" id="9hbsab1" value="ไม่ทราบ" <? if($arr['9hbsab']=='ไม่ทราบ'){ echo "checked='checked'"; }?> disabled/>

ไม่ทราบ
<input type="radio" name="9hbsab" id="9hbsab1" value="ไม่ได้ตรวจ"<? if($arr['9hbsab']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?> disabled />

ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>9.5 ประวัติพฤติกรรมเสี่ยง</td>
      <td colspan="5"><input type="radio" name="9history" id="9history1" value="มี"  <? if($arr['9history']=='มี'){ echo "checked='checked'"; }?> disabled/>
มี
<input type="radio" name="9history" id="9history1" value="ไม่มี"  <? if($arr['9history']=='ไม่มี'){ echo "checked='checked'"; }?> disabled/>
ไม่มี
<input type="radio" name="9history" id="9history1" value="ไม่ทราบ" <? if($arr['9history']=='ไม่ทราบ'){ echo "checked='checked'"; }?> disabled/>
ไม่ทราบ
<input type="radio" name="9history" id="9history1" value="ไม่ได้ตรวจ" <? if($arr['9history']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?> disabled/>
ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>10.</td>
      <td>บุคลากร ทราบถึงข้อดี ข้อเสีย ของการตรวจเลือด        </td>
      <td colspan="5">
       <input type="radio" name="ac101" id="ac1011" value="ใช่" <? if($arr['ac101']=='ใช่'){ echo "checked='checked'"; }?> disabled />
        ใช่
        <input type="radio" name="ac101" id="ac1012" value="ไม่ใช่" <? if($arr['ac101']=='ไม่ใช่'){ echo "checked='checked'"; }?> disabled/>
        ไม่ใช่
        </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>บุคลากร ยินยอมที่จะให้ตรวจเลือด      </td>
      <td colspan="5">
       <input type="radio" name="ac102" id="ac1021" value="ใช่" <? if($arr['ac102']=='ใช่'){ echo "checked='checked'"; }?> disabled/>
        ใช่
        <input type="radio" name="ac102" id="ac1022" value="ไม่ใช่" <? if($arr['ac102']=='ไม่ใช่'){ echo "checked='checked'"; }?> disabled />
        ไม่ใช่ 
</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>บุคลากร ยินดีรักษาขั้นต้น เพื่อป้องกันการติดเชื้อ HIV 
</td>
      <td colspan="5">
      <input type="radio" name="ac103" id="ac1031" value="ใช่"  <? if($arr['ac103']=='ใช่'){ echo "checked='checked'"; }?> disabled/>
        ใช่
        <input type="radio" name="ac103" id="ac1032" value="ไม่ใช่"  <? if($arr['ac103']=='ไม่ใช่'){ echo "checked='checked'"; }?> disabled/>
        ไม่ใช่ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>บุคลากร ยินดีรักษาขั้นต้น เพื่อป้องกันการติดเชื้อ Hepatitis B</td>
      <td colspan="5">
    <input type="radio" name="ac104" id="ac1041" value="ใช่"  <? if($arr['ac104']=='ใช่'){ echo "checked='checked'"; }?> disabled/>
        ใช่
        <input type="radio" name="ac104" id="ac1042" value="ไม่ใช่"  <? if($arr['ac104']=='ไม่ใช่'){ echo "checked='checked'"; }?> disabled/>
        ไม่ใช่ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>ลงชื่อ.....................................................( บุคลากร )</td>
      <td colspan="5">ลงชื่อ..................................................( แพทย์ผู้ดูแล )</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(.................................................) </td>
      <td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(.................................................) </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="5">ลงชื่อ................................................( ผู้อำนวยการ ) </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(.................................................) </td>
    </tr>
   </table>
   <div align="center" style="page-break-after:always;"></div>
  <table border="0" align="center" class="hfont">
    <tr>
      <td>11.</td>
      <td>บุคลากรที่มีผลการตรวจเลือดและประวัติ</td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>11.1 HIV Ab</td>
      <td colspan="5"><input type="radio" name="11hivab" id="11hivab1" value="บวก"   <? if($arr['11hivab']=='บวก'){ echo "checked='checked'"; }?> disabled/>
บวก
  <input type="radio" name="11hivab" id="11hivab2" value="ลบ"  <? if($arr['11hivab']=='ลบ'){ echo "checked='checked'"; }?>disabled/>
ลบ
<input type="radio" name="11hivab" id="11hivab3" value="ไม่ทราบ"  <? if($arr['11hivab']=='ไม่ทราบ'){ echo "checked='checked'"; }?>  disabled/>
ไม่ทราบ
<input type="radio" name="11hivab" id="11hivab4" value="ไม่ได้ตรวจ"   <? if($arr['11hivab']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?> disabled/>
ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>11.2 HIV Ag</td>
      <td colspan="5"><input type="radio" name="11hivag" id="11hivag1" value="บวก"  <? if($arr['11hivag']=='บวก'){ echo "checked='checked'"; }?> disabled/>
บวก
  <input type="radio" name="11hivag" id="11hivag2" value="ลบ" <? if($arr['11hivag']=='ลบ'){ echo "checked='checked'"; }?> disabled/>
ลบ
<input type="radio" name="11hivag" id="11hivag3" value="ไม่ทราบ"  <? if($arr['11hivag']=='ไม่ทราบ'){ echo "checked='checked'"; }?> disabled/>
ไม่ทราบ
<input type="radio" name="11hivag" id="11hivag4" value="ไม่ได้ตรวจ"  <? if($arr['11hivag']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?> disabled/>
ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>11.3 HBs Ag</td>
      <td colspan="5"><input type="radio" name="11hbsag" id="11hbsag1" value="บวก" <? if($arr['11hbsag']=='บวก'){ echo "checked='checked'"; }?> disabled/>
บวก
  <input type="radio" name="11hbsag" id="11hbsag2" value="ลบ" <? if($arr['11hbsag']=='ลบ'){ echo "checked='checked'"; }?> disabled />
ลบ
<input type="radio" name="11hbsag" id="11hbsag3" value="ไม่ทราบ"  <? if($arr['11hbsag']=='ไม่ทราบ'){ echo "checked='checked'"; }?> disabled/>
ไม่ทราบ
<input type="radio" name="11hbsag" id="11hbsag4" value="ไม่ได้ตรวจ"  <? if($arr['11hbsag']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?> disabled/>
ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>11.4 HBs Ab</td>
      <td colspan="5"><input type="radio" name="11hbsab" id="11hbsab1" value="บวก"  <? if($arr['11hbsab']=='บวก'){ echo "checked='checked'"; }?> disabled/>
บวก
  <input type="radio" name="11hbsab" id="11hbsab2" value="ลบ"  <? if($arr['11hbsab']=='ลบ'){ echo "checked='checked'"; }?> disabled/>
ลบ
<input type="radio" name="11hbsab" id="11hbsab3" value="ไม่ทราบ" <? if($arr['11hbsab']=='ไม่ทราบ'){ echo "checked='checked'"; }?> disabled/>
ไม่ทราบ
<input type="radio" name="11hbsab" id="11hbsab4" value="ไม่ได้ตรวจ"  <? if($arr['11hbsab']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?> disabled/>
ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>11.5 ประวัติพฤติกรรมเสี่ยง</td>
      <td colspan="5"><input type="radio" name="11history" id="11history1" value="มี"  <? if($arr['11history']=='มี'){ echo "checked='checked'"; }?> disabled/>
มี
  <input type="radio" name="11history" id="11history2" value="ไม่มี"  <? if($arr['11history']=='ไม่มี'){ echo "checked='checked'"; }?> disabled/>
ไม่มี
<input type="radio" name="11history" id="11history3" value="ไม่ทราบ"  <? if($arr['11history']=='ไม่ทราบ'){ echo "checked='checked'"; }?> disabled/>
ไม่ทราบ
<input type="radio" name="11history" id="11history4" value="ไม่ได้ตรวจ" <? if($arr['11history']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?>disabled/>
ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>12.</td>
      <td>บุคลากรได้รับการรักษาเพื้อป้องกันการติดเชื้อ คือ</td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><?=$arr['12detail'];?></td>
    </tr>
    <tr>
      <td>13.</td>
      <td colspan="6">ในกรณีใช้ยา AZT ผลการตรวจเลือด</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6">13.1 เมื่อเริ่มได้รับยา ( day 0 )</td>
    </tr>
    <?  $sql1="select * from ic_accident_azt where ref_id='".$arr['row_id']."' and start='day 0' ";
	  		 $result1=mysql_query($sql1);
	 		 $arr1=mysql_fetch_array($result1);

	  ?>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>Hemoglobin</td>
          <td><?=$arr1['hemoglobin1']?>
            mg % </td>
          <td>Hematiocrit
            <?=$arr1['hematiocrit1']?>
            vol%</td>
          </tr>
        <tr>
          <td>Red cell morphology</td>
          <td colspan="2"><?=$arr1['red_cell1']?></td>
          </tr>
        <tr>
          <td>WBC Count</td>
          <td colspan="2"><?=$arr1['wbc1']?>
            per cu.mm.</td>
          </tr>
        <tr>
          <td>Neutrophil</td>
          <td><?=$arr1['neutrophil1']?>
            %</td>
          <td>Lymphocyte 
<?=$arr1['lymphocyte1']?>
            %</td>
        </tr>
        <tr>
          <td>Monocytes
            &nbsp; </td>
          <td><?=$arr1['monocytes1']?>
            %</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Basophil</td>
          <td><?=$arr1['basophil1']?>
            %</td>
          <td>Eosinophil 
            <?=$arr1['eosinophil1']?>
            %</td>
        </tr>
        <tr>
          <td>Band Form</td>
          <td><?=$arr1['band1']?>
            %</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Platelet Count</td>
          <td colspan="2"><?=$arr1['platelet1']?>
per cu.mm.</td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6">13.2 เมื่อได้รับยาแล้ว 14 วัน ( day 14 )</td>
    </tr>
    <?
	  		$sql2="select * from ic_accident_azt where ref_id='".$arr['row_id']."' and start='day 14' ";
	  		 $result2=mysql_query($sql2);
	 		 $arr2=mysql_fetch_array($result2);
	  ?>

    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>Hemoglobin</td>
          <td><?=$arr2['hemoglobin2']?>
            mg % </td>
          <td>Hematiocrit
            <?=$arr2['hematiocrit2']?>
            vol%</td>
        </tr>
        <tr>
          <td>Red cell morphology</td>
          <td colspan="2"><?=$arr2['red_cell2']?></td>
        </tr>
        <tr>
          <td>WBC Count</td>
          <td colspan="2"><?=$arr2['wbc2']?>
            per cu.mm.</td>
        </tr>
        <tr>
          <td>Neutrophil</td>
          <td><?=$arr2['neutrophil2']?>
            %</td>
          <td>Lymphocyte
            <?=$arr2['lymphocyte2']?>
            %</td>
        </tr>
        <tr>
          <td>Monocytes
            &nbsp; </td>
          <td><?=$arr2['monocytes2']?>
            %</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Basophil</td>
          <td><?=$arr2['basophil2']?>
            %</td>
          <td>Eosinophil
            <?=$arr2['eosinophil2']?>
            %</td>
        </tr>
        <tr>
          <td>Band Form</td>
          <td><?=$arr2['band2']?>
            %</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Platelet Count</td>
          <td colspan="2"><?=$arr2['platelet2']?>
            per cu.mm.</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6">13.3 เมื่อได้รับยาแล้ว 28 วัน ( day 14 )</td>
    </tr>
    <?
	         $sql3="select * from ic_accident_azt where ref_id='".$arr['row_id']."' and start='day 28' ";
	  		 $result3=mysql_query($sql3);
	 		 $arr3=mysql_fetch_array($result3);

	  ?>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>Hemoglobin</td>
          <td><?=$arr3['hemoglobin3']?>
            mg % </td>
          <td>Hematiocrit
            <?=$arr3['hematiocrit3']?>
            vol%</td>
        </tr>
        <tr>
          <td>Red cell morphology</td>
          <td colspan="2"><?=$arr3['red_cell3']?></td>
        </tr>
        <tr>
          <td>WBC Count</td>
          <td colspan="2"><?=$arr3['wbc3']?>
            per cu.mm.</td>
        </tr>
        <tr>
          <td>Neutrophil</td>
          <td><?=$arr3['neutrophil3']?>
            %</td>
          <td>Lymphocyte
            <?=$arr3['lymphocyte3']?>
            %</td>
        </tr>
        <tr>
          <td>Monocytes
            &nbsp; </td>
          <td><?=$arr3['monocytes3']?>
            %</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Basophil</td>
          <td><?=$arr3['basophil3']?>
            %</td>
          <td>Eosinophil
            <?=$arr3['eosinophil3']?>
            %</td>
        </tr>
        <tr>
          <td>Band Form</td>
          <td><?=$arr3['band3']?>
            %</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Platelet Count</td>
          <td colspan="2"><?=$arr3['platelet3']?>
            per cu.mm.</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>14.</td>
      <td colspan="4">.ในกรณีที่ใช้ยา PI IDV ต้องตรวจ UA </td>
    </tr>
    <tr>
      <td>15.</td>
      <td colspan="4">ผลการตรวจเลือดบุคลากรในสัปดาห์ที่ 6 หลังเกิดอุบัติเหตุ</td>
      <?
	         $sql4="select * from ic_accident_pi where ref_id='".$arr['row_id']."' and after_cbc='สัปดาห์ที่ 6' ";
	  		 $result4=mysql_query($sql4);
	 		 $arr4=mysql_fetch_array($result4);

	  ?>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>15.1 HIV Ab</td>
      <td colspan="3"><input type="radio" name="blood1" id="hivab151" value="บวก" <? if($arr4['hiv_ab']=='บวก'){ echo "checked='checked'"; }?> disabled/>
        บวก
        <input type="radio" name="blood1" id="hivab151" value="ลบ"  <? if($arr4['hiv_ab']=='ลบ'){ echo "checked='checked'"; }?> disabled/>
        ลบ
  <input type="radio" name="blood1" id="hivab151" value="ไม่ทราบ" <? if($arr4['hiv_ab']=='ไม่ทราบ'){ echo "checked='checked'"; }?> disabled/>
        ไม่ทราบ
  <input type="radio" name="blood1" id="hivab151" value="ไม่ได้ตรวจ" <? if($arr4['hiv_ab']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?>disabled/>
        ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>15.2 HIV Ag</td>
      <td colspan="3"><input type="radio" name="blood2" id="hivag152" value="บวก"  <? if($arr4['hiv_ag']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?>disabled/>
        บวก
        <input type="radio" name="blood2" id="hivag152" value="ลบ" <? if($arr4['hiv_ag']=='บวก'){ echo "checked='checked'"; }?> disabled/>
        ลบ
  <input type="radio" name="blood2" id="hivag152" value="ไม่ทราบ" <? if($arr4['hiv_ag']=='ไม่ทราบ'){ echo "checked='checked'"; }?> disabled/>
        ไม่ทราบ
  <input type="radio" name="blood2" id="hivag152" value="ไม่ได้ตรวจ" <? if($arr4['hiv_ag']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?> disabled/>
        ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>15.3 HBs Ag</td>
      <td colspan="3"><input type="radio" name="blood3" id="hbsag153" value="บวก" <? if($arr4['hbs_ag']=='บวก'){ echo "checked='checked'"; }?>  disabled/>
        บวก
        <input type="radio" name="blood3" id="hbsag153" value="ลบ" <? if($arr4['hbs_ag']=='ลบ'){ echo "checked='checked'"; }?>disabled/>
        ลบ
  <input type="radio" name="blood3" id="hbsag153" value="ไม่ทราบ" <? if($arr4['hbs_ag']=='ไม่ทราบ'){ echo "checked='checked'"; }?> disabled/>
        ไม่ทราบ
  <input type="radio" name="blood3" id="hbsag153" value="ไม่ได้ตรวจ" <? if($arr4['hbs_ag']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?> disabled/>
        ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>15.4 HBs Ab</td>
      <td colspan="3"><input type="radio" name="blood4" id="hbsab154" value="บวก" <? if($arr4['hbs_ab']=='บวก'){ echo "checked='checked'"; }?> disabled/>
        บวก
        <input type="radio" name="blood4" id="hbsab154" value="ลบ" <? if($arr4['hbs_ab']=='ลบ'){ echo "checked='checked'"; }?> disabled/>
        ลบ
  <input type="radio" name="blood4" id="hbsab154" value="ไม่ทราบ" <? if($arr4['hbs_ab']=='ไม่ทราบ'){ echo "checked='checked'"; }?>disabled/>
        ไม่ทราบ
  <input type="radio" name="blood4" id="hbsab154" value="ไม่ได้ตรวจ"  <? if($arr4['hbs_ab']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?> disabled/>
        ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>16</td>
      <td>ผลการตรวจเลือดบุคลากรในเดือนที่ 3 หลังเกิดอุบัติเหตุ</td>
      <?
	         $sql5="select * from ic_accident_pi where ref_id='".$arr['row_id']."' and after_cbc='เดือนที่ 3' ";
	  		 $result5=mysql_query($sql5);
	 		 $arr5=mysql_fetch_array($result5);

	  ?>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>16.1 HIV Ab</td>
      <td colspan="3"><input type="radio" name="blood5" id="hivab161" value="บวก" <? if($arr5['hiv_ab']=='บวก'){ echo "checked='checked'"; }?> disabled/>
        บวก
        <input type="radio" name="blood5" id="hivab161" value="ลบ" <? if($arr5['hiv_ab']=='ลบ'){ echo "checked='checked'"; }?> disabled/>
        ลบ
  <input type="radio" name="blood5" id="hivab161" value="ไม่ทราบ" <? if($arr5['hiv_ab']=='ไม่ทราบ'){ echo "checked='checked'"; }?>disabled/>
        ไม่ทราบ
  <input type="radio" name="blood5" id="hivab161" value="ไม่ได้ตรวจ" <? if($arr5['hiv_ab']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?> disabled/>
        ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>16.2 HIV Ag</td>
      <td colspan="3"><input type="radio" name="blood6" id="hivag162" value="บวก" <? if($arr5['hiv_ag']=='บวก'){ echo "checked='checked'"; }?> disabled/>
        บวก
        <input type="radio" name="blood6" id="hivag162" value="ลบ" <? if($arr5['hiv_ag']=='ลบ'){ echo "checked='checked'"; }?>disabled/>
        ลบ
  <input type="radio" name="blood6" id="hivag162" value="ไม่ทราบ" <? if($arr5['hiv_ag']=='ไม่ทราบ'){ echo "checked='checked'"; }?> disabled/>
        ไม่ทราบ
  <input type="radio" name="blood6" id="hivag162" value="ไม่ได้ตรวจ" <? if($arr5['hiv_ag']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?> disabled/>
        ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>16.3 HBs Ag</td>
      <td colspan="3"><input type="radio" name="blood7" id="hbsag163" value="บวก" <? if($arr5['hbs_ag']=='บวก'){ echo "checked='checked'"; }?> disabled/>
        บวก
        <input type="radio" name="blood7" id="hbsag163" value="ลบ"  <? if($arr5['hbs_ag']=='ลบ'){ echo "checked='checked'"; }?>disabled/>
        ลบ
  <input type="radio" name="blood7" id="hbsag163" value="ไม่ทราบ" <? if($arr5['hbs_ag']=='ไม่ทราบ'){ echo "checked='checked'"; }?>disabled/>
        ไม่ทราบ
  <input type="radio" name="blood7" id="hbsag33" value="ไม่ได้ตรวจ" <? if($arr5['hbs_ag']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?>disabled/>
        ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>16.4 HBs Ab</td>
      <td colspan="3"><input type="radio" name="blood8" id="hbsab164" value="บวก"  <? if($arr5['hbs_ab']=='บวก'){ echo "checked='checked'"; }?>disabled/>
        บวก
        <input type="radio" name="blood8" id="hbsab164" value="ลบ" <? if($arr5['hbs_ab']=='ลบ'){ echo "checked='checked'"; }?>disabled/>
        ลบ
  <input type="radio" name="blood8" id="hbsab164" value="ไม่ทราบ" <? if($arr5['hbs_ab']=='ไม่ทราบ'){ echo "checked='checked'"; }?>disabled/>
        ไม่ทราบ
  <input type="radio" name="blood8" id="hbsab164" value="ไม่ได้ตรวจ" <? if($arr5['hbs_ab']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?>disabled/>
        ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>17.</td>
      <td>ผลการตรวจเลือดบุคลากรในเดือนที่ 6 หลังเกิดอุบัติเหตุ</td>
      <?
	         $sql6="select * from ic_accident_pi where ref_id='".$arr['row_id']."' and after_cbc='เดือนที่ 6' ";
	  		 $result6=mysql_query($sql6);
	 		 $arr6=mysql_fetch_array($result6);

	  ?>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>17.1 HIV Ab</td>
      <td colspan="3"><input type="radio" name="blood9" id="hivab171" value="บวก"  <? if($arr6['hiv_ab']=='บวก'){ echo "checked='checked'"; }?>disabled/>
        บวก
        <input type="radio" name="blood9" id="hivab171" value="ลบ"  <? if($arr6['hiv_ab']=='ลบ'){ echo "checked='checked'"; }?>disabled/>
        ลบ
  <input type="radio" name="blood9" id="hivab171" value="ไม่ทราบ"  <? if($arr6['hiv_ab']=='ไม่ทราบ'){ echo "checked='checked'"; }?>disabled/>
        ไม่ทราบ
  <input type="radio" name="blood9" id="hivab171" value="ไม่ได้ตรวจ" <? if($arr6['hiv_ab']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?> disabled/>
        ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>17.2 HIV Ag</td>
      <td colspan="3"><input type="radio" name="blood10" id="hivag172" value="บวก" <? if($arr6['hiv_ag']=='บวก'){ echo "checked='checked'"; }?> disabled/>
        บวก
        <input type="radio" name="blood10" id="hivag172" value="ลบ"  <? if($arr6['hiv_ag']=='ลบ'){ echo "checked='checked'"; }?> disabled/>
        ลบ
  <input type="radio" name="blood10" id="hivag172" value="ไม่ทราบ" <? if($arr6['hiv_ag']=='ไม่ทราบ'){ echo "checked='checked'"; }?> disabled/>
        ไม่ทราบ
  <input type="radio" name="blood10" id="hivag172" value="ไม่ได้ตรวจ"  <? if($arr6['hiv_ag']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?> disabled/>
        ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>17.3 HBs Ag</td>
      <td colspan="3"><input type="radio" name="blood11" id="hbsag173" value="บวก" <? if($arr6['hbs_ag']=='บวก'){ echo "checked='checked'"; }?> disabled/>
        บวก
        <input type="radio" name="blood11" id="hbsag173" value="ลบ" <? if($arr6['hbs_ag']=='ลบ'){ echo "checked='checked'"; }?> disabled/>
        ลบ
  <input type="radio" name="blood11" id="hbsag173" value="ไม่ทราบ"  <? if($arr6['hbs_ag']=='ไม่ทราบ'){ echo "checked='checked'"; }?> disabled/>
        ไม่ทราบ
  <input type="radio" name="blood11" id="hbsag173" value="ไม่ได้ตรวจ" <? if($arr6['hbs_ag']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?> disabled/>
        ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>17.4 HBs Ab</td>
      <td colspan="3"><input type="radio" name="blood12" id="hbsab174" value="บวก" <? if($arr6['hbs_ab']=='บวก'){ echo "checked='checked'"; }?> disabled/>
        บวก
        <input type="radio" name="blood12" id="hbsab174" value="ลบ" <? if($arr6['hbs_ab']=='ลบ'){ echo "checked='checked'"; }?> disabled/>
        ลบ
  <input type="radio" name="blood12" id="hbsab174" value="ไม่ทราบ"  <? if($arr6['hbs_ab']=='ไม่ทราบ'){ echo "checked='checked'"; }?> disabled/>
        ไม่ทราบ
  <input type="radio" name="blood12" id="hbsab174" value="ไม่ได้ตรวจ"  <? if($arr6['hbs_ab']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?> disabled/>
        ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>18.</td>
      <td>ผลการตรวจเลือดบุคลากรในเดือนที่ 12 หลังเกิดอุบัติเหตุ</td>
      <?
	         $sql7="select * from ic_accident_pi where ref_id='".$arr['row_id']."' and after_cbc='เดือนที่ 12' ";
	  		 $result7=mysql_query($sql7);
	 		 $arr7=mysql_fetch_array($result7);

	  ?>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>18.1 HIV Ab</td>
      <td colspan="3"><input type="radio" name="blood13" id="hivab181" value="บวก"  <? if($arr7['hiv_ab']=='บวก'){ echo "checked='checked'"; }?> disabled/>
        บวก
        <input type="radio" name="blood13" id="hivab181" value="ลบ" <? if($arr7['hiv_ab']=='ลบ'){ echo "checked='checked'"; }?>  disabled/>
        ลบ
  <input type="radio" name="blood13" id="hivab181" value="ไม่ทราบ" <? if($arr7['hiv_ab']=='ไม่ทราบ'){ echo "checked='checked'"; }?> disabled/>
        ไม่ทราบ
  <input type="radio" name="blood13" id="hivab181" value="ไม่ได้ตรวจ"  <? if($arr7['hiv_ab']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?> disabled/>
        ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>18.2 HIV Ag</td>
      <td colspan="3"><input type="radio" name="blood14" id="hivag182" value="บวก" <? if($arr7['hiv_ag']=='บวก'){ echo "checked='checked'"; }?> disabled/>
        บวก
        <input type="radio" name="blood14" id="hivag182" value="ลบ" <? if($arr7['hiv_ag']=='ลบ'){ echo "checked='checked'"; }?> disabled/>
        ลบ
  <input type="radio" name="blood14" id="hivag182" value="ไม่ทราบ" <? if($arr7['hiv_ag']=='ไม่ทราบ'){ echo "checked='checked'"; }?> disabled />
        ไม่ทราบ
  <input type="radio" name="blood14" id="hivag182" value="ไม่ได้ตรวจ" <? if($arr7['hiv_ag']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?>  disabled/>
        ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>18.3 HBs Ag</td>
      <td colspan="3"><input type="radio" name="blood15" id="hbsag183" value="บวก"  <? if($arr7['hbs_ag']=='บวก'){ echo "checked='checked'"; }?> disabled/>
        บวก
        <input type="radio" name="blood15" id="hbsag183" value="ลบ"  <? if($arr7['hbs_ag']=='ลบ'){ echo "checked='checked'"; }?> disabled/>
        ลบ
  <input type="radio" name="blood15" id="hbsag183" value="ไม่ทราบ"  <? if($arr7['hbs_ag']=='ไม่ทราบ'){ echo "checked='checked'"; }?> disabled/>
        ไม่ทราบ
  <input type="radio" name="blood15" id="hbsag183" value="ไม่ได้ตรวจ"  <? if($arr7['hbs_ag']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?> disabled/>
        ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>18.4 HBs Ab</td>
      <td colspan="3"><input type="radio" name="blood16" id="hbsab184" value="บวก" <? if($arr7['hbs_ab']=='บวก'){ echo "checked='checked'"; }?> disabled/>
        บวก
        <input type="radio" name="blood16" id="hbsab184" value="ลบ"  <? if($arr7['hbs_ab']=='ลบ'){ echo "checked='checked'"; }?> disabled/>
        ลบ
  <input type="radio" name="blood16" id="hbsab184" value="ไม่ทราบ"  <? if($arr7['hbs_ab']=='ไม่ทราบ'){ echo "checked='checked'"; }?> disabled/>
        ไม่ทราบ
  <input type="radio" name="blood16" id="hbsab184" value="ไม่ได้ตรวจ"  <? if($arr7['hbs_ab']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?> disabled/>
        ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="4"><table border="0" cellspacing="2" cellpadding="0">
        <tr>
          <td><strong>หมายเหต</strong></td>
          <td>1.กรณีหยุดยาก่อนครบ 6 สัปดาห์ เพราะ </td>
          <td><?=$arr['19detail1'];?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td valign="top">2. อื่นๆ</td>
          <td></textarea><?=$arr['19detail2'];?></td>
        </tr>
      </table></td>
    </tr>
  </table>

</body>
</html>