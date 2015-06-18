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
	font-size:24px;
}
.hfont{
	font-family: "TH SarabunPSK";
	font-size:18px;
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
include("../connect.inc");


$d1=substr($_POST['date1'],0,10);
$d2=substr($_POST['date1'],11);
$datexp=explode("/",$d1);
$date=(($datexp[2])+543).'-'.$datexp[1].'-'.$datexp[0].' '.$d2;


$strsql="UPDATE  `ic_accident` SET  `thidate` =  '".$date."',
`depart` =  '".$_POST['depart']."',
`ptname` =   '".$_POST['ptname']."',
`age` =   '".$_POST['age']."',
`staff` =   '".$_POST['staff']."',
`staff_other` =   '".$_POST['staff_other']."',
`ac_type1` =   '".$_POST['ac_type1']."',
`ac_by` =   '".$_POST['ac_by']."',
`ac_by_detail` =   '".$_POST['ac_by_detail']."',
`ac_type2` =   '".$_POST['ac_type2']."',
`ac_type3` =   '".$_POST['ac_type3']."',
`ac_type4` =   '".$_POST['ac_type4']."',
`ac_type5` =   '".$_POST['ac_type5']."',
`ac_detail` =   '".$_POST['ac_detail']."',
`ac_organ` =   '".$_POST['ac_organ']."',
`first_aid` =   '".$_POST['first_aid']."',
`9hivab` =   '".$_POST['9hivab']."',
`9hivag` =   '".$_POST['9hivag']."',
`9hbsag` =   '".$_POST['9hbsag']."',
`9hbsab` =   '".$_POST['9hbsab']."',
`9history` =   '".$_POST['9history']."',
`ac101` =   '".$_POST['ac101']."',
`ac102` =   '".$_POST['ac102']."',
`ac103` =   '".$_POST['ac103']."',
`ac104` =   '".$_POST['ac104']."',
`11hivab` =  '".$_POST['11hivab']."',
`11hivag` =   '".$_POST['11hivag']."',
`11hbsag` =   '".$_POST['11hbsag']."',
`11hbsab` =  '".$_POST['11hbsab']."',
`11history` =   '".$_POST['11history']."',
`12detail` =   '".$_POST['12detail']."',
`19detail1` =   '".$_POST['19detail1']."',
`19detail2` =   '".$_POST['19detail2']."' WHERE  `row_id` =  '".$_POST['row_id']."' ";
$strresult=mysql_query($strsql)or die(mysql_error());

for($i=1;$i<=3;$i++)
{

$sql="UPDATE  `ic_accident_azt` SET  `hemoglobin` =  '".$_POST["hemoglobin$i"]."',
`hematocrit` =  '".$_POST["hematiocrit$i"]."',
`red_cell` =  '".$_POST["red_cell$i"]."',
`wbc` =  '".$_POST["wbc$i"]."',
`neutrophil` =  '".$_POST["neutrophil$i"]."',
`lymphocyte` = '".$_POST["lymphocyte$i"]."',
`monocytes` =  '".$_POST["monocytes$i"]."',
`basophil` = '".$_POST["basophil$i"]."',
`eosinophil` =  '".$_POST["eosinophil$i"]."',
`band` = '".$_POST["band$i"]."',
`platelet` =  '".$_POST["platelet$i"]."' WHERE  `ref_id` = '".$_POST['row_id']."' and start='".$_POST["day$i"]."' ";
$query=mysql_query($sql)or die(mysql_error());

}
//echo $sql."<br>";
$sql2="UPDATE  `ic_accident_pi` SET  `hiv_ab` =  '".$_POST['blood1']."',
`hiv_ag` =  '".$_POST['blood2']."',
`hbs_ag` =  '".$_POST['blood3']."',
`hbs_ab` =  '".$_POST['blood4']."' WHERE  `ref_id` =  '".$_POST['row_id']."' and after_cbc='สัปดาห์ที่ 6' ";
$query2=mysql_query($sql2)or die(mysql_error());

/////////////////////////

$sql3="UPDATE  `ic_accident_pi` SET  `hiv_ab` =  '".$_POST['blood5']."',
`hiv_ag` =  '".$_POST['blood6']."',
`hbs_ag` =  '".$_POST['blood7']."',
`hbs_ab` =  '".$_POST['blood8']."' WHERE  `ref_id` =  '".$_POST['row_id']."' and after_cbc='เดือนที่ 3' ";
$query3=mysql_query($sql3)or die(mysql_error());

////////////////////////

$sql3="UPDATE  `ic_accident_pi` SET  `hiv_ab` =  '".$_POST['blood9']."',
`hiv_ag` =  '".$_POST['blood10']."',
`hbs_ag` =  '".$_POST['blood11']."',
`hbs_ab` =  '".$_POST['blood12']."' WHERE  `ref_id` =  '".$_POST['row_id']."' and after_cbc='เดือนที่ 6' ";
$query3=mysql_query($sql3)or die(mysql_error());

/////////////////////

$sql3="UPDATE  `ic_accident_pi` SET  `hiv_ab` =  '".$_POST['blood13']."',
`hiv_ag` =  '".$_POST['blood14']."',
`hbs_ag` =  '".$_POST['blood15']."',
`hbs_ab` =  '".$_POST['blood16']."' WHERE  `ref_id` =  '".$_POST['row_id']."' and after_cbc='เดือนที่ 12' ";
$query3=mysql_query($sql3)or die(mysql_error());

//
if($strresult){
   		echo "<div id='no_print'>";
		echo "<BR><A HREF=\"report_accident.php\">บันทึกเพิ่ม</A><BR>";
		echo "<BR><A HREF=\"../../nindex.htm\">เมนู</A><BR>";
		echo "<BR>บันทึกข้อมูลเรียบร้อยแล้ว";
		echo "</div>";
		
		echo "<SCRIPT LANGUAGE='JavaScript'>
				window.onload = function(){
				window.print();
				window.close();
				}
				</SCRIPT>";			
}
?>
<br />
<br />
<h2 class="h" align="center" style="line-height:1px;">โรงพยาบาลค่ายสุรศักดิ์มนตรี</h2>
<h2 class="h" align="center" style="line-height:1px;"><u>แบบรายงานการได้รับอุบัติเหตุ ซึ่งอาจได้รับเชื้อที่ติดต่อทางเลือดของบุคลากร</u></h2>
<h2 class="h" align="center" style="line-height:1px;">FR-ICC-001/1,01, 10  พ.ย. 49</h2>
<p align="center" style="line-height:1px;">.............................................................................................</p>

<table border="0" align="center" class="hfont">
    <tr>
      <td>1.</td>
      <td colspan="6">ชื่อหน่วยงาน......<?=$_POST['depart'];?>......</td>
    </tr>
    <tr>
      <td>2.</td>
      <td colspan="2" class="sample">ชื่อบุคลากร....<?=$_POST['ptname'];?>.....</td>
      <td>อายุ</td>
      <td>
      <?=$_POST['age'];?></td>
      <td>HN</td>
      <td>
      <?=$_POST['hn'];?></td>
    </tr>
    <tr>
      <td>3.</td>
      <td colspan="6">ประเภทบุคลากร.....<? if($_POST['staff']=="other" ||  $_POST['staff']==""){ echo $_POST['staff_other']; }else{ echo $_POST['staff']; }?></td>
    </tr>
    <tr>
      <td>4.</td>
      <td>เกิดอุบัติเหตุ</td>
      <td>วันที่</td>
      <td>&nbsp;</td>
      <td><?=$_POST['date1'];?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>5.</td>
      <td colspan="6">ลักษณะอุบัติเหตุ</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><input type="checkbox" name="ac_type1" id="ac_type1" value="1"  <? if($_POST['ac_type1']==1){ echo "checked='checked'"; }?>/>
    ของแหลมคมที่ปนเปื้อนเลือด หรือสารน้ำจากร่างกายผู้ป่วย ทิ่มตำ หรือบาด</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><input type="radio" name="ac_by" id="ac_by1" value="มีด" checked="checked" <? if($_POST['ac_by']=='มีด'){ echo "checked='checked'"; }?> />
        มีด 
          <input type="radio" name="ac_by" id="ac_by2" value="แก้ว"  <? if($_POST['ac_by']=='แก้ว'){ echo "checked='checked'"; }?>/>
แก้ว
<input type="radio" name="ac_by" id="ac_by3" value="เข็ม" <? if($_POST['ac_by']=='เข็ม'){ echo "checked='checked'"; }?> />
เข็ม
<input type="radio" name="ac_by" id="ac_by4" value="อื่นๆ" <? if($_POST['ac_by']=='อื่นๆ'){ echo "checked='checked'"; }?> />
อื่นๆ
<?=$_POST['ac_by_detail'];?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><input type="checkbox" name="ac_type2" id="ac_type2" value="2"  <? if($_POST['ac_type2']==2){ echo "checked='checked'"; }?>/>ผิวหนังที่มีบาดแผล สัมผัสถูกเลือดหรือสารน้ำจากร่างกายผู้ป่วย
        </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><input type="checkbox" name="ac_type3" id="ac_type3" value="3"  <? if($_POST['ac_type3']==3){ echo "checked='checked'"; }?>/>เยื่อบุตา เนื้อเยื่ออ่อน สัมผัสถูกสารเลือดหรือสารน้ำจากร่างกายผู้ป่วย</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><input type="checkbox" name="ac_type4" id="ac_type4" value="4"  <? if($_POST['ac_type4']==4){ echo "checked='checked'"; }?>/>อื่นๆ ระบุ 
        <?=$_POST['ac_type5'];?></td>
    </tr>
    <tr>
      <td>6.</td>
      <td colspan="6">บรรยายลักษณะงานที่ปฏิบัติและอุบัติเหตุที่เกิดขึ้น</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6">
     <?=$_POST['ac_detail']?></td>
    </tr>
    <tr>
      <td>7.</td>
      <td colspan="6">ตำแหน่งอวัยวะทที่เกิดอุบัติเหตุ......<?=$_POST['ac_organ']?>.....</td>
    </tr>
    <tr>
      <td>8.</td>
      <td colspan="6">การปฐมพยาบาลที่ได้รับ คือ .....<?=$_POST['first_aid']?>.....
      </td>
    </tr>
    <tr>
      <td>9.</td>
      <td colspan="6">ผู้ป่วย หรือ ผู้ใช้บริการมีผลการตรวจเลือดและประวัติ</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>9.1 HIV Ab  </td>
      <td colspan="5"><input type="radio" name="9hivab" id="9hivab1" value="บวก" <? if($_POST['9hivab']=='บวก'){ echo "checked='checked'"; }?>/>
      บวก 
      <input type="radio" name="9hivab" id="9hivab1" value="ลบ" <? if($_POST['9hivab']=='ลบ'){ echo "checked='checked'"; }?>/>
      ลบ
      <input type="radio" name="9hivab" id="9hivab1" value="ไม่ทราบ" <? if($_POST['9hivab']=='ไม่ทราบ'){ echo "checked='checked'"; }?>/>
ไม่ทราบ 
<input type="radio" name="9hivab" id="9hivab1" value="ไม่ได้ตรวจ" <? if($_POST['9hivab']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?>/>
ไม่ได้ตรวจ
</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>9.2 HIV Ag</td>
      <td colspan="5"><input type="radio" name="9hivag" id="9hivag1" value="บวก"  <? if($_POST['9hivag']=='บวก'){ echo "checked='checked'"; }?>/>
บวก
<input type="radio" name="9hivag" id="9hivag1" value="ลบ" <? if($_POST['9hivag']=='ลบ'){ echo "checked='checked'"; }?>/>
ลบ
<input type="radio" name="9hivag" id="9hivag1" value="ไม่ทราบ" <? if($_POST['9hivag']=='ไม่ทราบ'){ echo "checked='checked'"; }?>/>
ไม่ทราบ
<input type="radio" name="9hivag" id="9hivag1" value="ไม่ได้ตรวจ" <? if($_POST['9hivag']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?>/>

ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>9.3 HBs Ag</td>
      <td colspan="5"><input type="radio" name="9hbsag" id="9hbsag1" value="บวก" <? if($_POST['9hbsag']=='บวก'){ echo "checked='checked'"; }?> />

บวก
<input type="radio" name="9hbsag" id="9hbsag1" value="ลบ"  <? if($_POST['9hbsag']=='ลบ'){ echo "checked='checked'"; }?> />

ลบ
<input type="radio" name="9hbsag" id="9hbsag1" value="ไม่ทราบ"<? if($_POST['9hbsag']=='ไม่ทราบ'){ echo "checked='checked'"; }?>  />

ไม่ทราบ
<input type="radio" name="9hbsag" id="9hbsag1" value="ไม่ได้ตรวจ" <? if($_POST['9hbsag']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?> />

ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>9.4 HBs Ab</td>
      <td colspan="5"><input type="radio" name="9hbsab" id="9hbsab1" value="บวก" <? if($_POST['9hbsag']=='บวก'){ echo "checked='checked'"; }?> />

บวก
<input type="radio" name="9hbsab" id="9hbsab1" value="ลบ"  <? if($_POST['9hbsab']=='ลบ'){ echo "checked='checked'"; }?>/>

ลบ
<input type="radio" name="9hbsab" id="9hbsab1" value="ไม่ทราบ" <? if($_POST['9hbsab']=='ไม่ทราบ'){ echo "checked='checked'"; }?>/>

ไม่ทราบ
<input type="radio" name="9hbsab" id="9hbsab1" value="ไม่ได้ตรวจ"<? if($_POST['9hbsab']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?> />

ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>9.5 ประวัติพฤติกรรมเสี่ยง</td>
      <td colspan="5"><input type="radio" name="9history" id="9history1" value="มี"  <? if($_POST['9history']=='มี'){ echo "checked='checked'"; }?>/>
มี
<input type="radio" name="9history" id="9history1" value="ไม่มี"  <? if($_POST['9history']=='ไม่มี'){ echo "checked='checked'"; }?>/>
ไม่มี
<input type="radio" name="9history" id="9history1" value="ไม่ทราบ" <? if($_POST['9history']=='ไม่ทราบ'){ echo "checked='checked'"; }?>/>
ไม่ทราบ
<input type="radio" name="9history" id="9history1" value="ไม่ได้ตรวจ" <? if($_POST['9history']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?>/>
ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>10.</td>
      <td>บุคลากร ทราบถึงข้อดี ข้อเสีย ของการตรวจเลือด        </td>
      <td colspan="5">
       <input type="radio" name="ac101" id="ac1011" value="ใช่" <? if($_POST['ac101']=='ใช่'){ echo "checked='checked'"; }?> />
        ใช่
        <input type="radio" name="ac101" id="ac1012" value="ไม่ใช่" <? if($_POST['ac101']=='ไม่ใช่'){ echo "checked='checked'"; }?>/>
        ไม่ใช่
        </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>บุคลากร ยินยอมที่จะให้ตรวจเลือด      </td>
      <td colspan="5">
       <input type="radio" name="ac102" id="ac1021" value="ใช่" <? if($_POST['ac102']=='ใช่'){ echo "checked='checked'"; }?>/>
        ใช่
        <input type="radio" name="ac102" id="ac1022" value="ไม่ใช่" <? if($_POST['ac102']=='ไม่ใช่'){ echo "checked='checked'"; }?> />
        ไม่ใช่ 
</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>บุคลากร ยินดีรักษาขั้นต้น เพื่อป้องกันการติดเชื้อ HIV 
</td>
      <td colspan="5">
      <input type="radio" name="ac103" id="ac1031" value="ใช่"  <? if($_POST['ac103']=='ใช่'){ echo "checked='checked'"; }?>/>
        ใช่
        <input type="radio" name="ac103" id="ac1032" value="ไม่ใช่"  <? if($_POST['ac103']=='ไม่ใช่'){ echo "checked='checked'"; }?>/>
        ไม่ใช่ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>บุคลากร ยินดีรักษาขั้นต้น เพื่อป้องกันการติดเชื้อ Hepatitis B</td>
      <td colspan="5">
    <input type="radio" name="ac104" id="ac1041" value="ใช่"  <? if($_POST['ac104']=='ใช่'){ echo "checked='checked'"; }?>/>
        ใช่
        <input type="radio" name="ac104" id="ac1042" value="ไม่ใช่"  <? if($_POST['ac104']=='ไม่ใช่'){ echo "checked='checked'"; }?>/>
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
      <td colspan="5">ลงชื่อ................................................( ผู้อำนวยการ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(.................................................) </td>
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
      <td>&nbsp;</td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td>11.</td>
      <td>บุคลากรที่มีผลการตรวจเลือดและประวัติ</td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>11.1 HIV Ab</td>
      <td colspan="5"><input type="radio" name="11hivab" id="11hivab1" value="บวก"   <? if($_POST['11hivab']=='บวก'){ echo "checked='checked'"; }?>/>
บวก
  <input type="radio" name="11hivab" id="11hivab2" value="ลบ"  <? if($_POST['11hivab']=='ลบ'){ echo "checked='checked'"; }?>/>
ลบ
<input type="radio" name="11hivab" id="11hivab3" value="ไม่ทราบ"  <? if($_POST['11hivab']=='ไม่ทราบ'){ echo "checked='checked'"; }?> />
ไม่ทราบ
<input type="radio" name="11hivab" id="11hivab4" value="ไม่ได้ตรวจ"   <? if($_POST['11hivab']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?>/>
ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>11.2 HIV Ag</td>
      <td colspan="5"><input type="radio" name="11hivag" id="11hivag1" value="บวก"  <? if($_POST['11hivag']=='บวก'){ echo "checked='checked'"; }?>/>
บวก
  <input type="radio" name="11hivag" id="11hivag2" value="ลบ" <? if($_POST['11hivag']=='ลบ'){ echo "checked='checked'"; }?>/>
ลบ
<input type="radio" name="11hivag" id="11hivag3" value="ไม่ทราบ"  <? if($_POST['11hivag']=='ไม่ทราบ'){ echo "checked='checked'"; }?>/>
ไม่ทราบ
<input type="radio" name="11hivag" id="11hivag4" value="ไม่ได้ตรวจ"  <? if($_POST['11hivag']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?>/>
ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>11.3 HBs Ag</td>
      <td colspan="5"><input type="radio" name="11hbsag" id="11hbsag1" value="บวก" <? if($_POST['11hbsag']=='บวก'){ echo "checked='checked'"; }?>/>
บวก
  <input type="radio" name="11hbsag" id="11hbsag2" value="ลบ" <? if($_POST['11hbsag']=='ลบ'){ echo "checked='checked'"; }?> />
ลบ
<input type="radio" name="11hbsag" id="11hbsag3" value="ไม่ทราบ"  <? if($_POST['11hbsag']=='ไม่ทราบ'){ echo "checked='checked'"; }?>/>
ไม่ทราบ
<input type="radio" name="11hbsag" id="11hbsag4" value="ไม่ได้ตรวจ"  <? if($_POST['11hbsag']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?>/>
ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>11.4 HBs Ab</td>
      <td colspan="5"><input type="radio" name="11hbsab" id="11hbsab1" value="บวก"  <? if($_POST['11hbsab']=='บวก'){ echo "checked='checked'"; }?>/>
บวก
  <input type="radio" name="11hbsab" id="11hbsab2" value="ลบ"  <? if($_POST['11hbsab']=='ลบ'){ echo "checked='checked'"; }?>/>
ลบ
<input type="radio" name="11hbsab" id="11hbsab3" value="ไม่ทราบ" <? if($_POST['11hbsab']=='ไม่ทราบ'){ echo "checked='checked'"; }?> />
ไม่ทราบ
<input type="radio" name="11hbsab" id="11hbsab4" value="ไม่ได้ตรวจ"  <? if($_POST['11hbsab']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?>/>
ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>11.5 ประวัติพฤติกรรมเสี่ยง</td>
      <td colspan="5"><input type="radio" name="11history" id="11history1" value="มี"  <? if($_POST['11history']=='มี'){ echo "checked='checked'"; }?>/>
มี
  <input type="radio" name="11history" id="11history2" value="ไม่มี"  <? if($_POST['11history']=='ไม่มี'){ echo "checked='checked'"; }?>/>
ไม่มี
<input type="radio" name="11history" id="11history3" value="ไม่ทราบ"  <? if($_POST['11history']=='ไม่ทราบ'){ echo "checked='checked'"; }?>/>
ไม่ทราบ
<input type="radio" name="11history" id="11history4" value="ไม่ได้ตรวจ" <? if($_POST['11history']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?>/>
ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>12.</td>
      <td>บุคลากรได้รับการรักษาเพื้อป้องกันการติดเชื้อ คือ</td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><?=$_POST['12detail'];?></td>
    </tr>
    <tr>
      <td>13.</td>
      <td colspan="6">ในกรณีใช้ยา AZT ผลการตรวจเลือด</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6">13.1 เมื่อเริ่มได้รับยา ( day 0 )</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>Hemoglobin</td>
          <td><?=$_POST['hemoglobin1']?>
            mg % </td>
          <td>Hematiocrit
            <?=$_POST['hematiocrit1']?>
            vol%</td>
          </tr>
        <tr>
          <td>Red cell morphology</td>
          <td colspan="2"><?=$_POST['red_cell1']?></td>
          </tr>
        <tr>
          <td>WBC Count</td>
          <td colspan="2"><?=$_POST['wbc1']?>
            per cu.mm.</td>
          </tr>
        <tr>
          <td>Neutrophil</td>
          <td><?=$_POST['neutrophil1']?>
            %</td>
          <td>Lymphocyte 
<?=$_POST['lymphocyte1']?>
            %</td>
        </tr>
        <tr>
          <td>Monocytes
            &nbsp; </td>
          <td><?=$_POST['monocytes1']?>
            %</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Basophil</td>
          <td><?=$_POST['basophil1']?>
            %</td>
          <td>Eosinophil 
            <?=$_POST['eosinophil1']?>
            %</td>
        </tr>
        <tr>
          <td>Band Form</td>
          <td><?=$_POST['band1']?>
            %</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Platelet Count</td>
          <td colspan="2"><?=$_POST['platelet1']?>
per cu.mm.</td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6">13.2 เมื่อได้รับยาแล้ว 14 วัน ( day 14 )</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>Hemoglobin</td>
          <td><?=$_POST['hemoglobin2']?>
            mg % </td>
          <td>Hematiocrit
            <?=$_POST['hematiocrit2']?>
            vol%</td>
        </tr>
        <tr>
          <td>Red cell morphology</td>
          <td colspan="2"><?=$_POST['red_cell2']?></td>
        </tr>
        <tr>
          <td>WBC Count</td>
          <td colspan="2"><?=$_POST['wbc2']?>
            per cu.mm.</td>
        </tr>
        <tr>
          <td>Neutrophil</td>
          <td><?=$_POST['neutrophil2']?>
            %</td>
          <td>Lymphocyte
            <?=$_POST['lymphocyte2']?>
            %</td>
        </tr>
        <tr>
          <td>Monocytes
            &nbsp; </td>
          <td><?=$_POST['monocytes2']?>
            %</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Basophil</td>
          <td><?=$_POST['basophil2']?>
            %</td>
          <td>Eosinophil
            <?=$_POST['eosinophil2']?>
            %</td>
        </tr>
        <tr>
          <td>Band Form</td>
          <td><?=$_POST['band2']?>
            %</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Platelet Count</td>
          <td colspan="2"><?=$_POST['platelet2']?>
            per cu.mm.</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6">13.3 เมื่อได้รับยาแล้ว 28 วัน ( day 14 )</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>Hemoglobin</td>
          <td><?=$_POST['hemoglobin3']?>
            mg % </td>
          <td>Hematiocrit
            <?=$_POST['hematiocrit3']?>
            vol%</td>
        </tr>
        <tr>
          <td>Red cell morphology</td>
          <td colspan="2"><?=$_POST['red_cell3']?></td>
        </tr>
        <tr>
          <td>WBC Count</td>
          <td colspan="2"><?=$_POST['wbc3']?>
            per cu.mm.</td>
        </tr>
        <tr>
          <td>Neutrophil</td>
          <td><?=$_POST['neutrophil3']?>
            %</td>
          <td>Lymphocyte
            <?=$_POST['lymphocyte3']?>
            %</td>
        </tr>
        <tr>
          <td>Monocytes
            &nbsp; </td>
          <td><?=$_POST['monocytes3']?>
            %</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Basophil</td>
          <td><?=$_POST['basophil3']?>
            %</td>
          <td>Eosinophil
            <?=$_POST['eosinophil3']?>
            %</td>
        </tr>
        <tr>
          <td>Band Form</td>
          <td><?=$_POST['band3']?>
            %</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Platelet Count</td>
          <td colspan="2"><?=$_POST['platelet3']?>
            per cu.mm.</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>14.</td>
      <td colspan="6">.ในกรณีที่ใช้ยา PI IDV ต้องตรวจ UA </td>
    </tr>
    <tr>
      <td>15.</td>
      <td colspan="6">ผลการตรวจเลือดบุคลากรในสัปดาห์ที่ 6 หลังเกิดอุบัติเหตุ</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>15.1 HIV Ab</td>
      <td colspan="5"><input type="radio" name="blood1" id="blood1" value="บวก" <? if($_POST['blood1']=='บวก'){ echo "checked='checked'"; }?>  />
        บวก
        <input type="radio" name="blood1" id="blood1" value="ลบ"  <? if($_POST['blood1']=='ลบ'){ echo "checked='checked'"; }?>/>
        ลบ
  <input type="radio" name="blood1" id="blood1" value="ไม่ทราบ" <? if($_POST['blood1']=='ไม่ทราบ'){ echo "checked='checked'"; }?> />
        ไม่ทราบ
  <input type="radio" name="blood1" id="blood1" value="ไม่ได้ตรวจ"  <? if($_POST['blood1']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?>/>
        ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>15.2 HIV Ag</td>
      <td colspan="5"><input type="radio" name="blood2" id="blood1" value="บวก"  <? if($_POST['blood2']=='บวก'){ echo "checked='checked'"; }?>/>
        บวก
        <input type="radio" name="blood2" id="blood1" value="ลบ"  <? if($_POST['blood2']=='ลบ'){ echo "checked='checked'"; }?>/>
        ลบ
  <input type="radio" name="blood2" id="blood1" value="ไม่ทราบ"  <? if($_POST['blood2']=='ไม่ทราบ'){ echo "checked='checked'"; }?>/>
        ไม่ทราบ
  <input type="radio" name="blood2" id="blood1" value="ไม่ได้ตรวจ" <? if($_POST['blood2']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?>/>
        ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>15.3 HBs Ag</td>
      <td colspan="5"><input type="radio" name="blood3" id="11hbsag1" value="บวก"  <? if($_POST['blood3']=='บวก'){ echo "checked='checked'"; }?>/>
        บวก
        <input type="radio" name="blood3" id="11hbsag2" value="ลบ"  <? if($_POST['blood3']=='ลบ'){ echo "checked='checked'"; }?>/>
        ลบ
  <input type="radio" name="blood3" id="11hbsag3" value="ไม่ทราบ"  <? if($_POST['blood3']=='ไม่ทราบ'){ echo "checked='checked'"; }?>/>
        ไม่ทราบ
  <input type="radio" name="blood3" id="11hbsag4" value="ไม่ได้ตรวจ" <? if($_POST['blood3']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?>/>
        ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>15.4 HBs Ab</td>
      <td colspan="5"><input type="radio" name="blood4" id="11hivab1" value="บวก"  <? if($_POST['blood4']=='บวก'){ echo "checked='checked'"; }?>/>
        บวก
        <input type="radio" name="blood4" id="11hivab2" value="ลบ" <? if($_POST['blood4']=='ลบ'){ echo "checked='checked'"; }?> />
        ลบ
  <input type="radio" name="blood4" id="11hivab3" value="ไม่ทราบ"  <? if($_POST['blood4']=='ไม่ทราบ'){ echo "checked='checked'"; }?>/>
        ไม่ทราบ
  <input type="radio" name="blood4" id="11hivab4" value="ไม่ได้ตรวจ"  <? if($_POST['blood4']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?>/>
        ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>16</td>
      <td>ผลการตรวจเลือดบุคลากรในเดือนที่ 3 หลังเกิดอุบัติเหตุ</td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>16.1 HIV Ab</td>
      <td colspan="5"><input type="radio" name="blood5" id="11hivab1" value="บวก" <? if($_POST['blood5']=='บวก'){ echo "checked='checked'"; }?>/>
        บวก
        <input type="radio" name="blood5" id="11hivab2" value="ลบ" <? if($_POST['blood5']=='ลบ'){ echo "checked='checked'"; }?>/>
        ลบ
  <input type="radio" name="blood5" id="11hivab3" value="ไม่ทราบ" <? if($_POST['blood5']=='ไม่ทราบ'){ echo "checked='checked'"; }?>/>
        ไม่ทราบ
  <input type="radio" name="blood5" id="11hivab4" value="ไม่ได้ตรวจ" <? if($_POST['blood5']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?>/>
        ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>16.2 HIV Ag</td>
      <td colspan="5"><input type="radio" name="blood6" id="11hivab1" value="บวก" <? if($_POST['blood6']=='บวก'){ echo "checked='checked'"; }?>/>
        บวก
        <input type="radio" name="blood6" id="11hivab2" value="ลบ" <? if($_POST['blood6']=='ลบ'){ echo "checked='checked'"; }?> />
        ลบ
  <input type="radio" name="blood6" id="11hivab3" value="ไม่ทราบ" <? if($_POST['blood6']=='ไม่ทราบ'){ echo "checked='checked'"; }?>/>
        ไม่ทราบ
  <input type="radio" name="blood6" id="11hivab4" value="ไม่ได้ตรวจ" <? if($_POST['blood6']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?>/>
        ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>16.3 HBs Ag</td>
      <td colspan="5"><input type="radio" name="blood7" id="11hivab1" value="บวก" <? if($_POST['blood7']=='บวก'){ echo "checked='checked'"; }?>/>
        บวก
        <input type="radio" name="blood7" id="11hivab2" value="ลบ"  <? if($_POST['blood7']=='ลบ'){ echo "checked='checked'"; }?>/>
        ลบ
  <input type="radio" name="blood7" id="11hivab3" value="ไม่ทราบ"  <? if($_POST['blood7']=='ไม่ทราบ'){ echo "checked='checked'"; }?>/>
        ไม่ทราบ
  <input type="radio" name="blood7" id="11hivab4" value="ไม่ได้ตรวจ" <? if($_POST['blood7']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?>/>
        ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>16.4 HBs Ab</td>
      <td colspan="5"><input type="radio" name="blood8" id="11hivab1" value="บวก" <? if($_POST['blood8']=='บวก'){ echo "checked='checked'"; }?>/>
        บวก
        <input type="radio" name="blood8" id="11hivab2" value="ลบ" <? if($_POST['blood8']=='ลบ'){ echo "checked='checked'"; }?> />
        ลบ
  <input type="radio" name="blood8" id="11hivab3" value="ไม่ทราบ" <? if($_POST['blood8']=='ไม่ทราบ'){ echo "checked='checked'"; }?>/>
        ไม่ทราบ
  <input type="radio" name="blood8" id="11hivab4" value="ไม่ได้ตรวจ"  <? if($_POST['blood8']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?>/>
        ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>17.</td>
      <td>ผลการตรวจเลือดบุคลากรในเดือนที่ 6 หลังเกิดอุบัติเหตุ</td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>17.1 HIV Ab</td>
      <td colspan="5"><input type="radio" name="blood9" id="11hivab1" value="บวก" <? if($_POST['blood9']=='บวก'){ echo "checked='checked'"; }?> />
        บวก
        <input type="radio" name="blood9" id="11hivab2" value="ลบ" <? if($_POST['blood9']=='ลบ'){ echo "checked='checked'"; }?>/>
        ลบ
  <input type="radio" name="blood9" id="11hivab3" value="ไม่ทราบ" <? if($_POST['blood9']=='ไม่ทราบ'){ echo "checked='checked'"; }?>/>
        ไม่ทราบ
  <input type="radio" name="blood9" id="11hivab4" value="ไม่ได้ตรวจ" <? if($_POST['blood9']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?>/>
        ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>17.2 HIV Ag</td>
      <td colspan="5"><input type="radio" name="blood10" id="11hivab1" value="บวก"  <? if($_POST['blood10']=='บวก'){ echo "checked='checked'"; }?>/>
        บวก
        <input type="radio" name="blood10" id="11hivab2" value="ลบ" <? if($_POST['blood10']=='ลบ'){ echo "checked='checked'"; }?> />
        ลบ
  <input type="radio" name="blood10" id="11hivab3" value="ไม่ทราบ"  <? if($_POST['blood10']=='ไม่ทราบ'){ echo "checked='checked'"; }?>/>
        ไม่ทราบ
  <input type="radio" name="blood10" id="11hivab4" value="ไม่ได้ตรวจ" <? if($_POST['blood10']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?>/>
        ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>17.3 HBs Ag</td>
      <td colspan="5"><input type="radio" name="blood11" id="11hivab1" value="บวก" <? if($_POST['blood11']=='บวก'){ echo "checked='checked'"; }?>/>
        บวก
        <input type="radio" name="blood11" id="11hivab2" value="ลบ" <? if($_POST['blood11']=='ลบ'){ echo "checked='checked'"; }?>/>
        ลบ
  <input type="radio" name="blood11" id="11hivab3" value="ไม่ทราบ" <? if($_POST['blood11']=='ไม่ทราบ'){ echo "checked='checked'"; }?>/>
        ไม่ทราบ
  <input type="radio" name="blood11" id="11hivab4" value="ไม่ได้ตรวจ" <? if($_POST['blood11']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?>/>
        ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>17.4 HBs Ab</td>
      <td colspan="5"><input type="radio" name="blood12" id="11hivab1" value="บวก" <? if($_POST['blood12']=='บวก'){ echo "checked='checked'"; }?>/>
        บวก
        <input type="radio" name="blood12" id="11hivab2" value="ลบ" <? if($_POST['blood12']=='ลบ'){ echo "checked='checked'"; }?>/>
        ลบ
  <input type="radio" name="blood12" id="11hivab3" value="ไม่ทราบ" <? if($_POST['blood12']=='ไม่ทราบ'){ echo "checked='checked'"; }?>/>
        ไม่ทราบ
  <input type="radio" name="blood12" id="11hivab4" value="ไม่ได้ตรวจ" <? if($_POST['blood12']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?>/>
        ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>18.</td>
      <td>ผลการตรวจเลือดบุคลากรในเดือนที่ 12 หลังเกิดอุบัติเหตุ</td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>18.1 HIV Ab</td>
      <td colspan="5"><input type="radio" name="blood13" id="11hivab17" value="บวก"  <? if($_POST['blood13']=='บวก'){ echo "checked='checked'"; }?>/>
        บวก
        <input type="radio" name="blood13" id="11hivab18" value="ลบ" <? if($_POST['blood13']=='ลบ'){ echo "checked='checked'"; }?>/>
        ลบ
        <input type="radio" name="blood13" id="11hivab19" value="ไม่ทราบ" <? if($_POST['blood13']=='ไม่ทราบ'){ echo "checked='checked'"; }?>/>
        ไม่ทราบ
        <input type="radio" name="blood13" id="11hivab20" value="ไม่ได้ตรวจ" <? if($_POST['blood13']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?>/>
        ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>18.2 HIV Ag</td>
      <td colspan="5"><input type="radio" name="blood14" id="11hivab13" value="บวก" <? if($_POST['blood14']=='บวก'){ echo "checked='checked'"; }?>/>
        บวก
        <input type="radio" name="blood14" id="11hivab14" value="ลบ" <? if($_POST['blood14']=='ลบ'){ echo "checked='checked'"; }?>/>
        ลบ
        <input type="radio" name="blood14" id="11hivab15" value="ไม่ทราบ" <? if($_POST['blood14']=='ไม่ทราบ'){ echo "checked='checked'"; }?>/>
        ไม่ทราบ
        <input type="radio" name="blood14" id="11hivab16" value="ไม่ได้ตรวจ" <? if($_POST['blood14']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?>/>
        ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>18.3 HBs Ag</td>
      <td colspan="5"><input type="radio" name="blood15" id="11hivab9" value="บวก" <? if($_POST['blood15']=='บวก'){ echo "checked='checked'"; }?>/>
        บวก
        <input type="radio" name="blood15" id="11hivab10" value="ลบ" <? if($_POST['blood15']=='ลบ'){ echo "checked='checked'"; }?>/>
        ลบ
        <input type="radio" name="blood15" id="11hivab11" value="ไม่ทราบ" <? if($_POST['blood15']=='ไม่ทราบ'){ echo "checked='checked'"; }?>/>
        ไม่ทราบ
        <input type="radio" name="blood15" id="11hivab12" value="ไม่ได้ตรวจ"<? if($_POST['blood15']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?>/>
        ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>18.4 HBs Ab</td>
      <td colspan="5"><input type="radio" name="blood16" id="11hivab5" value="บวก"  <? if($_POST['blood16']=='บวก'){ echo "checked='checked'"; }?>/>
        บวก
        <input type="radio" name="blood16" id="11hivab6" value="ลบ"<? if($_POST['blood16']=='ลบ'){ echo "checked='checked'"; }?>/>
        ลบ
        <input type="radio" name="blood16" id="11hivab7" value="ไม่ทราบ" <? if($_POST['blood16']=='ไม่ทราบ'){ echo "checked='checked'"; }?>/>
        ไม่ทราบ
        <input type="radio" name="blood16" id="11hivab8" value="ไม่ได้ตรวจ" <? if($_POST['blood16']=='ไม่ได้ตรวจ'){ echo "checked='checked'"; }?>/>
        ไม่ได้ตรวจ </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="6"><table border="0" cellspacing="2" cellpadding="0">
        <tr>
          <td><strong>หมายเหต</strong></td>
          <td>1.กรณีหยุดยาก่อนครบ 6 สัปดาห์ เพราะ </td>
          <td><?=$_POST['19detail1'];?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td valign="top">2. อื่นๆ</td>
          <td></textarea><?=$_POST['19detail2'];?></td>
        </tr>
      </table></td>
    </tr>
  </table>

</body>
</html>