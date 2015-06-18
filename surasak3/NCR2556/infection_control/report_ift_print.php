<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
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
<SCRIPT LANGUAGE="JavaScript">

	window.onload = function(){
		window.print();
		window.close();
	}

</SCRIPT>
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

$mysql="SELECT * FROM  `ic_infection` where row_id='".$_GET['row_id']."' ";
$myresult=mysql_query($mysql)or die(mysql_error());	
$myfetch=mysql_fetch_array($myresult);


?>
<br /><br />
<h2 class="h" align="center" style="line-height:1px;">แบบบันทึกการติดตามภาวะการติดเชื้อในโรงพยาบาลค่ายสุรศักดิ์มนตรี ของผู้ป่วยกลุ่มเสี่ยง</h2>
<h3 class="h" align="center" style="line-height:1px;">FR-ICC-001/1,00,1  พ.ย. 50</h3>
<p align="center" style="line-height:1px;">.............................................................................................</p>

<table border="0" cellpadding="0" cellspacing="0" align="center" width="100%">
  <tr>
    <td>
    
    <table  border="0" align="center" cellpadding="0" cellspacing="0" class="hfont" width="100%">
      <tr>
        <td colspan="8"><strong>ข้อมูลทั่วไปของผู้ป่วย</strong></td>
      </tr>
      <tr>
        <td><strong>ชื่อ-สกุล</strong></td>
        <td><?=$myfetch['ptname'];?></td>
        <td><strong>อายุ</strong></td>
        <td><?=$myfetch['age'];?></td>
        <td><strong>สิทธิการรักษา</strong></td>
        <td ><?=$myfetch['ptright'];?></td>
        <td><strong>เบอร์โทรศัพท์ </strong></td>
        <td><?=$myfetch['tel'];?></td>
      </tr>
      <tr>
        <td><strong>HN</strong></td>
        <td><?=$myfetch['hn'];?></td>
        <td><strong>AN</strong></td>
        <td><?=$myfetch['an'];?></td>
        <td><strong>รับใหม่ เมื่อ</strong></td>
        <td><?=$myfetch['addate'];?></td>
        <td><strong>จำหน่าย เมื่อ  </strong></td>
        <td><?=$myfetch['dcdate'];?></td>
      </tr>
      </table>
      <table width="100%" class="hfont">
      <tr>
        <td colspan="2"><strong>การวินิจฉัยโรค</strong></td>
        <td colspan="4">1. <?=$myfetch['diag1'];?></td>
        <td width="65%">2. <?=$myfetch['diag2'];?></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td colspan="4">3. <?=$myfetch['diag3'];?></td>
        <td>4. <?=$myfetch['diag4'];?></td>
      </tr>
      <tr>
        <td width="11%"><strong>โรคประจำตัว</strong></td>
        <td colspan="6"><?=$myfetch['disease'];?></td>
        </tr>
      <tr>
        <td colspan="6"><strong>สภาวะของผู้ป่วยเมื่อจำหน่าย</strong></td>
        <td><strong>
          <label>
            <input name="status_dc" type="radio" id="status_dc1"  value="1"  <? if($myfetch['status_dc']==1){ echo "checked='checked'";} ?>/>
          </label>
          </strong>สมบูรณ์</td>
      </tr>
      <tr>
        <td colspan="6">&nbsp;</td>
        <td><strong>
          <input type="radio" name="status_dc" id="status_dc2"  value="2" <? if($myfetch['status_dc']==2){ echo "checked='checked'";} ?>/>
          </strong>ต้องการการดูแลต่อเนื่องที่บ้าน</td>
      </tr>
      <tr>
        <td colspan="6">&nbsp;</td>
        <td><strong>
          <input type="radio" name="status_dc" id="status_dc3"  value="3" <? if($myfetch['status_dc']==3){ echo "checked='checked'";} ?>/>
        </strong>
          ส่งเข้ารับการรักษาต่อที่ ร.พ.
          <?=$myfetch['refer_host'];?></td>
      </tr>
    </table><br />
    <div class="hfont">ส่วนที่ 1 ปัจจัยเสี่ยงที่ทำให้เกิดการติดเชื่อในโรงพยาบาล ของผู้ป่วยรายนี้ คือ </div>
    <table width="100%" border="1" cellpadding="0" cellspacing="0" class="hfont" style="border-collapse:collapse" bordercolor="#000000">
  <tr>
    <td align="center">ลำดับ</td>
    <td align="center">ปัจจัยเสี่ยง</td>
    <td align="center">วัน เดือน ปี</td>
  </tr>
  <tr>
    <td align="center">1.</td>
    <td>การใส่สายสวนปัสสาวะ</td>
    <td align="center"><?=displaydate($myfetch['date2']);?></td>
  </tr>
  <tr>
    <td align="center">2.</td>
    <td>การใช้เครื่องช่วยหายใจ<strong>
<input type="radio" name="respirator" id="Respirator1"  value="ใส่ ET-Tube" <? if($myfetch['respirator']=='ใส่ ET-Tube'){ echo "checked='checked'";} ?>/>
</strong>ใส่ ET-Tube<strong>
<input type="radio" name="respirator" id="Respirator2" value="เจาะคอ" <? if($myfetch['respirator']=='เจาะคอ'){ echo "checked='checked'";} ?> />
</strong> เจาะคอ</td>
    <td align="center"><?=displaydate($myfetch['date3']);?></td>
  </tr>
  <tr>
    <td align="center">3.</td>
    <td>ประวัติการสำลักอาหาร,น้ำ</td>
    <td align="center"><?=displaydate($myfetch['date4']);?></td>
  </tr>
  <tr>
    <td align="center">4.</td>
    <td>การผ่าตัด....<?=$myfetch['surgery'];?>
<input type="radio" name="surgeryor" id="Surgeryor1" value="ใส่ Drain"  <? if($myfetch['surgeryor']=='ใส่ Drain'){ echo "checked='checked'";} ?>/>
ใส่ Drain 
<input type="radio" name="surgeryor" id="Surgeryor2" value="ไม่ใส่ Drain"  <? if($myfetch['surgeryor']=='ไม่ใส่ Drain'){ echo "checked='checked'";} ?>/>
ไม่ใส่ Drain</td>
    <td align="center"><?=displaydate($myfetch['date5']);?></td>
  </tr>
  <tr>
    <td align="center">5.</td>
    <td>การคลอด 
      <input type="radio" name="birth" id="Birth1"  value="C/S"  <? if($myfetch['birth']=='C/S'){ echo "checked='checked'";} ?>/>
C/S 
<input type="radio" name="Birth" id="Birth2"  value="N/L" <? if($myfetch['birth']=='N/L'){ echo "checked='checked'";} ?>/>
N/L 
<input type="radio" name="birth" id="Birth3"  value="หัตถการ" <? if($myfetch['birth']=='หัตถการ'){ echo "checked='checked'";} ?> />
หัตถการ</td>
    <td align="center"><?=displaydate($myfetch['date6']);?></td>
  </tr>
  <tr>
    <td align="center">6.</td>
    <td>การทำหัตถการต่างๆ...........................<?=$myfetch['procedure'];?></td>
    <td align="center"><?=displaydate($myfetch['dateproc']);?></td>
  </tr>
    </table>
<br/>
    <div class="hfont">ส่วนที่ 2 ผลการติดตามผู้ป่วย วันที่ติดตาม......<?=displaydate($myfetch['date7']);?></div>
    <table width="100%" border="1" cellpadding="0" cellspacing="0" class="hfont" style="border-collapse:collapse;" bordercolor="#000000">
  <tr>
    <td width="7%" align="center">ลำดับ</td>
    <td width="63%" align="center">อาการ</td>
    <td width="5%" align="center">มี</td>
    <td width="5%" align="center">ไม่มี</td>
    <td width="20%" align="center">วันที่เริ่มมีอาการ</td>
  </tr>
  <tr>
    <td align="center">1.</td>
    <td>ไข้ มากกว่า 38 องศาเซลเซียส</td>
    <td align="center"><input type="radio" name="fever" id="fever1"  value="1" <? if($myfetch['fever']==1){ echo "checked='checked'";} ?>/></td>
    <td align="center"><input type="radio" name="fever" id="fever2"  value="2" <? if($myfetch['fever']==2){ echo "checked='checked'";} ?>/></td>
    <td align="center"><?=displaydate($myfetch['date8']);?></td>
  </tr>
  <tr>
    <td align="center" valign="top">2.</td>
    <td>ปัสสาวะกะปิดกะปรอย<br />ปวดท้องน้อย<br />กดเจ็บบริเวณหัวเหน่า</td>
    <td align="center"><input type="radio" name="urine" id="Urine1"  value="1"  <? if($myfetch['urine']==1){ echo "checked='checked'";} ?>/><br /><input type="radio" name="abdominal" id="abdominal1"  value="1" <? if($myfetch['abdominal']==1){ echo "checked='checked'";} ?>/><br /><input type="radio" name="pubis" id="pubis1"  value="1" <? if($myfetch['pubis']==1){ echo "checked='checked'";} ?>/></td>
    <td align="center"><input type="radio" name="urine" id="Urine2"  value="2" <? if($myfetch['urine']==2){ echo "checked='checked'";} ?>/><br /><input type="radio" name="abdominal" id="abdominal2"  value="2" <? if($myfetch['abdominal']==2){ echo "checked='checked'";} ?>/><br /><input type="radio" name="pubis" id="pubis2"  value="2" <? if($myfetch['pubis']==2){ echo "checked='checked'";} ?>/></td>
    <td align="center"><?=displaydate($myfetch['date9']);?><br /><?=displaydate($myfetch['date10']);?><br /><?=displaydate($myfetch['date11']);?></td>
  </tr>
  <tr>
    <td align="center">3.</td>
    <td>ไอ มีเสมหะ สีเขียว / เหลือ</td>
    <td align="center"><input type="radio" name="cough" id="cough1"  value="1"  <? if($myfetch['cough']==1){ echo "checked='checked'";} ?>/></td>
        <td align="center"><input type="radio" name="cough" id="cough2"  value="2" <? if($myfetch['cough']==2){ echo "checked='checked'";} ?>/></td>
    <td align="center"><?=displaydate($myfetch['date12']);?></td>
  </tr>
  <tr>
    <td align="center" valign="top">4.</td>
    <td>แผลผ่าตัด อักเสบ บวม มีหนอง<br />ฝีเย็บบวม / แดง /แยก /มีหนอง<br />
    น้ำคาวปลามีกลิ่นเหม็น</td>
 <td align="center">
 <input type="radio" name="wound" id="wound1"  value="1" <? if($myfetch['wound']==1){ echo "checked='checked'";} ?>/><br />
 <input type="radio" name="episiotomy" id="episiotomy1"  value="1" <? if($myfetch['episiotomy']==1){ echo "checked='checked'";} ?>/><br />
 <input type="radio" name="smell" id="smell1"  value="1"/ <? if($myfetch['smell']==1){ echo "checked='checked'";} ?>></td>
    <td align="center">
<input type="radio" name="wound" id="wound2"  value="2" <? if($myfetch['wound']==2){ echo "checked='checked'";} ?>/><br />
<input type="radio" name="episiotomy" id="episiotomy2"  value="2" <? if($myfetch['episiotomy']==2){ echo "checked='checked'";} ?>/><br />
<input type="radio" name="smell" id="smell2"  value="2" <? if($myfetch['smell']==2){ echo "checked='checked'";} ?>/></td>
    <td align="center"><?=displaydate($myfetch['date13']);?><br /><?=displaydate($myfetch['date14']);?><br /><?=displaydate($myfetch['date15']);?></td>
  </tr>
  <tr>
    <td align="center" valign="top">5.</td>
    <td>ผิวหนังบริเวณที่ทำหัตถการ บวม แดง อักเสบ มีหนอง</td>
    <td align="center"><input type="radio" name="skin" id="skin1"  value="1" <? if($myfetch['skin']==1){ echo "checked='checked'";} ?>/></td>
        <td align="center"><input type="radio" name="skin" id="skin2"  value="2" <? if($myfetch['skin']==2){ echo "checked='checked'";} ?>/></td>
    <td align="center"><?=displaydate($myfetch['date16']);?></td>
  </tr>
    </table>
<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
          <tr class="hfont">
            <td><strong>การวินิจฉัยเบื้องต้น</strong></td>
            <td><label>
              <input type="radio" name="initial_diag" id="initial_diag1"  value="1" <? if($myfetch['initial_diag']==1){ echo "checked='checked'";} ?>/>
            </label>
              คาดว่าน่าจะมีการติดเชื้อจากโรงพยาบาล</td>
        </tr>
          <tr class="hfont">
            <td>&nbsp;</td>
            <td><label>
              <input type="radio" name="initial_diag" id="initial_diag2"  value="0" <? if($myfetch['initial_diag']==0){ echo "checked='checked'";} ?>/>
            </label>              ไม่พบภาวะการติดเชื้อจากการติดตามเผ้าระวัง </td>
        </tr>
      </table>
    
    
    
    </td>
   </tr>
    </table>  
    
    </body>
</html>