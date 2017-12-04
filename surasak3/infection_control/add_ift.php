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

echo $_GET['row_id'];

$registerdate=(date("Y")+543).date("-m-d H:i:s");

$strsql="INSERT INTO  `ic_infection` (registerdate,`an` ,  `hn` ,  `ptname` ,  `age` ,  `ptright` ,  `addate` ,  `dcdate` ,  `tel` ,  `diag1` ,  `diag2` ,  `diag3` ,  `diag4` ,  `disease` ,  `status_dc` ,  `refer_host` ,  `date2` ,  `respirator` ,  `date3` ,  `date4` ,  `surgery` ,  `surgeryor` ,  `date5` ,  `birth` ,  `date6` ,  `procedure`,  `dateproc` ,  `date7` ,  `fever` ,  `date8` ,  `urine` ,  `date9` ,  `abdominal` ,  `date10` ,  `pubis` ,  `date11` ,  `cough` ,  `date12` ,  `wound` ,  `date13` ,  `episiotomy` ,  `date14` ,  `smell` ,`date15` ,`skin` ,`date16`,`initial_diag`)
VALUES ('".$registerdate."','".$_POST['an']."', '".$_POST['hn']."',  '".$_POST['ptname']."', '".$_POST['age']."',  '".$_POST['ptright']."',  '".$_POST['addate']."',  '".$_POST['dcdate']."', '".$_POST['tel']."',  '".$_POST['diag1']."', '".$_POST['diag2']."',  '".$_POST['diag3']."',  '".$_POST['diag4']."', '".$_POST['disease']."',  '".$_POST['status_dc']."', '".$_POST['refer_host']."',  '".$_POST['date2']."', '".$_POST['respirator']."', '".$_POST['date3']."',  '".$_POST['date4']."', '".$_POST['surgery']."',  '".$_POST['surgeryor']."',  '".$_POST['date5']."', '".$_POST['birth']."', '".$_POST['date6']."',  '".$_POST['procedure']."',  '".$_POST['dateproc']."',  '".$_POST['date7']."', '".$_POST['fever']."', '".$_POST['date8']."',  '".$_POST['urine']."',  '".$_POST['date9']."',  '".$_POST['abdominal']."', '".$_POST['date10']."',  '".$_POST['pubis']."',  '".$_POST['date11']."', '".$_POST['cough']."',  '".$_POST['date12']."',  '".$_POST['wound']."','".$_POST['date13']."',  '".$_POST['episiotomy']."', '".$_POST['date14']."', '".$_POST['smell']."',  '".$_POST['date15']."', '".$_POST['skin']."',  '".$_POST['date16']."',  '".$_POST['initial_diag']."')";
$strresult=mysql_query($strsql)or die(mysql_error());

if($strresult){
	echo "<div id='no_print'>";
		echo "<BR><A HREF=\"report_ift.php\">บันทึกเพิ่ม</A><BR>";
		echo "<BR><A HREF=\"../../nindex.htm\">เมนู</A><BR>";
		echo "<BR>บันทึกข้อมูลเรียบร้อยแล้ว";
		echo "</div>";
		
		echo "<SCRIPT LANGUAGE='JavaScript'>
				window.onload = function(){
				window.print();
				window.close();
				}
				</SCRIPT>";
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
        <td><?=$_POST['ptname'];?></td>
        <td><strong>อายุ</strong></td>
        <td><?=$_POST['age'];?></td>
        <td><strong>สิทธิการรักษา</strong></td>
        <td ><?=$_POST['ptright'];?></td>
        <td><strong>เบอร์โทรศัพท์ </strong></td>
        <td><?=$_POST['tel'];?></td>
      </tr>
      <tr>
        <td><strong>HN</strong></td>
        <td><?=$_POST['hn'];?></td>
        <td><strong>AN</strong></td>
        <td><?=$_POST['an'];?></td>
        <td><strong>รับใหม่ เมื่อ</strong></td>
        <td><?=$_POST['addate'];?></td>
        <td><strong>จำหน่าย เมื่อ  </strong></td>
        <td><?=$_POST['dcdate'];?></td>
      </tr>
      </table>
      <table width="100%" class="hfont">
      <tr>
        <td colspan="2"><strong>การวินิจฉัยโรค</strong></td>
        <td colspan="4">1. <?=$_POST['diag1'];?></td>
        <td width="65%">2. <?=$_POST['diag2'];?></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td colspan="4">3. <?=$_POST['diag3'];?></td>
        <td>4. <?=$_POST['diag4'];?></td>
      </tr>
      <tr>
        <td width="11%"><strong>โรคประจำตัว</strong></td>
        <td colspan="6"><?=$_POST['disease'];?></td>
        </tr>
      <tr>
        <td colspan="6"><strong>สภาวะของผู้ป่วยเมื่อจำหน่าย</strong></td>
        <td><strong>
          <label>
            <input name="status_dc" type="radio" id="status_dc1"  value="1"  <? if($_POST['status_dc']==1){ echo "checked='checked'";} ?>/>
          </label>
          </strong>สมบูรณ์</td>
      </tr>
      <tr>
        <td colspan="6">&nbsp;</td>
        <td><strong>
          <input type="radio" name="status_dc" id="status_dc2"  value="2" <? if($_POST['status_dc']==2){ echo "checked='checked'";} ?>/>
          </strong>ต้องการการดูแลต่อเนื่องที่บ้าน</td>
      </tr>
      <tr>
        <td colspan="6">&nbsp;</td>
        <td><strong>
          <input type="radio" name="status_dc" id="status_dc3"  value="3" <? if($_POST['status_dc']==3){ echo "checked='checked'";} ?>/>
        </strong>
          ส่งเข้ารับการรักษาต่อที่ ร.พ.
          <?=$_POST['refer_host'];?></td>
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
    <td align="center"><?=displaydate($_POST['date2']);?></td>
  </tr>
  <tr>
    <td align="center">2.</td>
    <td>การใช้เครื่องช่วยหายใจ<strong>
<input type="radio" name="respirator" id="Respirator1"  value="ใส่ ET-Tube" <? if($_POST['respirator']=='ใส่ ET-Tube'){ echo "checked='checked'";} ?>/>
</strong>ใส่ ET-Tube<strong>
<input type="radio" name="respirator" id="Respirator2" value="เจาะคอ" <? if($_POST['respirator']=='เจาะคอ'){ echo "checked='checked'";} ?> />
</strong> เจาะคอ</td>
    <td align="center"><?=displaydate($_POST['date3']);?></td>
  </tr>
  <tr>
    <td align="center">3.</td>
    <td>ประวัติการสำลักอาหาร,น้ำ</td>
    <td align="center"><?=displaydate($_POST['date4']);?></td>
  </tr>
  <tr>
    <td align="center">4.</td>
    <td>การผ่าตัด....<?=$_POST['surgery'];?>
<input type="radio" name="surgeryor" id="Surgeryor1" value="ใส่ Drain"  <? if($_POST['surgeryor']=='ใส่ Drain'){ echo "checked='checked'";} ?>/>
ใส่ Drain 
<input type="radio" name="surgeryor" id="Surgeryor2" value="ไม่ใส่ Drain"  <? if($_POST['surgeryor']=='ไม่ใส่ Drain'){ echo "checked='checked'";} ?>/>
ไม่ใส่ Drain</td>
    <td align="center"><?=displaydate($_POST['date5']);?></td>
  </tr>
  <tr>
    <td align="center">5.</td>
    <td>การคลอด 
      <input type="radio" name="birth" id="Birth1"  value="C/S"  <? if($_POST['birth']=='C/S'){ echo "checked='checked'";} ?>/>
C/S 
<input type="radio" name="Birth" id="Birth2"  value="N/L" <? if($_POST['birth']=='N/L'){ echo "checked='checked'";} ?>/>
N/L 
<input type="radio" name="birth" id="Birth3"  value="หัตถการ" <? if($_POST['birth']=='หัตถการ'){ echo "checked='checked'";} ?> />
หัตถการ</td>
    <td align="center"><?=displaydate($_POST['date6']);?></td>
  </tr>
  <tr>
    <td align="center">6.</td>
    <td>การทำหัตถการต่างๆ...........................<?=$_POST['procedure'];?></td>
    <td align="center"><?=displaydate($_POST['dateproc']);?></td>
  </tr>
    </table>
<br/>
    <div class="hfont">ส่วนที่ 2 ผลการติดตามผู้ป่วย วันที่ติดตาม......<?=displaydate($_POST['date7']);?></div>
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
    <td align="center"><input type="radio" name="fever" id="fever1"  value="1" <? if($_POST['fever']==1){ echo "checked='checked'";} ?>/></td>
    <td align="center"><input type="radio" name="fever" id="fever2"  value="2" <? if($_POST['fever']==2){ echo "checked='checked'";} ?>/></td>
    <td align="center"><?=displaydate($_POST['date8']);?></td>
  </tr>
  <tr>
    <td align="center" valign="top">2.</td>
    <td>ปัสสาวะกะปิดกะปรอย<br />ปวดท้องน้อย<br />กดเจ็บบริเวณหัวเหน่า</td>
    <td align="center">
    <input type="radio" name="urine" id="Urine1"  value="1"  <? if($_POST['urine']==1){ echo "checked='checked'";} ?>/><br />
    <input type="radio" name="abdominal" id="abdominal1"  value="1" <? if($_POST['abdominal']==1){ echo "checked='checked'";} ?>/><br />
    <input type="radio" name="pubis" id="pubis1"  value="1" <? if($_POST['pubis']==1){ echo "checked='checked'";} ?>/></td>
    <td align="center">
    <input type="radio" name="urine" id="Urine2"  value="2" <? if($_POST['urine']==2){ echo "checked='checked'";} ?>/><br />
    <input type="radio" name="abdominal" id="abdominal2"  value="2" <? if($_POST['abdominal']==2){ echo "checked='checked'";} ?>/><br />
    <input type="radio" name="pubis" id="pubis2"  value="2" <? if($_POST['pubis']==2){ echo "checked='checked'";} ?>/></td>
    <td align="center"><?=displaydate($_POST['date9']);?><br /><?=displaydate($_POST['date10']);?><br /><?=displaydate($_POST['date11']);?></td>
  </tr>
  <tr>
    <td align="center">3.</td>
    <td>ไอ มีเสมหะ สีเขียว / เหลือ</td>
    <td align="center"><input type="radio" name="cough" id="cough1"  value="1"  <? if($_POST['cough']==1){ echo "checked='checked'";} ?>/></td>
        <td align="center"><input type="radio" name="cough" id="cough2"  value="2" <? if($_POST['cough']==2){ echo "checked='checked'";} ?>/></td>
    <td align="center"><?=displaydate($_POST['date12']);?></td>
  </tr>
  <tr>
    <td align="center" valign="top">4.</td>
    <td>แผลผ่าตัด อักเสบ บวม มีหนอง<br />ฝีเย็บบวม / แดง /แยก /มีหนอง<br />
    น้ำคาวปลามีกลิ่นเหม็น</td>
 <td align="center">
 <input type="radio" name="wound" id="wound1"  value="1" <? if($_POST['wound']==1){ echo "checked='checked'";} ?>/><br />
 <input type="radio" name="episiotomy" id="episiotomy1"  value="1" <? if($_POST['episiotomy']==1){ echo "checked='checked'";} ?>/><br />
 <input type="radio" name="smell" id="smell1"  value="1"/ <? if($_POST['smell']==1){ echo "checked='checked'";} ?>></td>
    <td align="center">
<input type="radio" name="wound" id="wound2"  value="2" <? if($_POST['wound']==2){ echo "checked='checked'";} ?>/><br />
<input type="radio" name="episiotomy" id="episiotomy2"  value="2" <? if($_POST['episiotomy']==2){ echo "checked='checked'";} ?>/><br />
<input type="radio" name="smell" id="smell2"  value="2" <? if($_POST['smell']==2){ echo "checked='checked'";} ?>/></td>
    <td align="center"><?=displaydate($_POST['date13']);?><br /><?=displaydate($_POST['date14']);?><br /><?=displaydate($_POST['date15']);?></td>
  </tr>
  <tr>
    <td align="center" valign="top">5.</td>
    <td>ผิวหนังบริเวณที่ทำหัตถการ บวม แดง อักเสบ มีหนอง</td>
    <td align="center"><input type="radio" name="skin" id="skin1"  value="1" <? if($_POST['skin']==1){ echo "checked='checked'";} ?>/></td>
        <td align="center"><input type="radio" name="skin" id="skin2"  value="2" <? if($_POST['skin']==2){ echo "checked='checked'";} ?>/></td>
    <td align="center"><?=displaydate($_POST['date16']);?></td>
  </tr>
    </table>
<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
          <tr class="hfont">
            <td><strong>การวินิจฉัยเบื้องต้น</strong></td>
            <td><label>
              <input type="radio" name="initial_diag" id="initial_diag1"  value="1" <? if($_POST['initial_diag']==1){ echo "checked='checked'";} ?>/>
            </label>
              คาดว่าน่าจะมีการติดเชื้อจากโรงพยาบาล</td>
        </tr>
          <tr class="hfont">
            <td>&nbsp;</td>
            <td><label>
              <input type="radio" name="initial_diag" id="initial_diag2"  value="0" <? if($_POST['initial_diag']==0){ echo "checked='checked'";} ?>/>
            </label>              ไม่พบภาวะการติดเชื้อจากการติดตามเผ้าระวัง </td>
        </tr>
      </table>
    
    
    
    </td>
   </tr>
    </table>  
    
	<?
	}else{
		echo "ไม่สามารถบันทึกข้อมูลได้";
	}
	
	
	echo "</div>";

?>
</body>
</html>