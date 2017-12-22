<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>ออกใบเสร็จรับเงิน</title>
</head>
<style type="text/css">
<!--
.hd {
	font-family: "TH SarabunPSK";
	font-size: 30px;
}
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.hide {
display:none;
}
</style>
<script type="text/javascript">

function Show(sel){
	//alert(document.getElementById('money').value);
var obj=document.getElementById('type_rec').value;
if (obj==2){
if(document.getElementById('sel').style.display=='none'){
document.getElementById('sel').style.display='block';
} 
}else if (obj==1){
	
if (document.getElementById('sel').style.display=='block'){
document.getElementById('sel').style.display='none';
}

}
}

</script>
<body>
<form name="f1" method="post" action="">
<select name="type" class="forntsarabun">
<option value="1">แบบกรอกข้อมูล</option>
<option value="2">แบบกรอกข้อมูลแยกประเภท</option>
</select>
<input type="submit" name="submit" value="เลือก" class="forntsarabun" />
<a href="../../nindex.htm" class="forntsarabun">กลับเมนูหลัก</a>
</form>


<!-- receipt_action.php --->
<? if($_POST['type']==1){
	include("../Connections/connect.inc.php");
	
	$sql1="select * from  ipcard where an='".$_GET['an']."' ";
	$query=mysql_query($sql1);
	$dbarr=mysql_fetch_array($query);

	?>
<form name="form1" method="post" action="receipt_action.php?do=form1">
<table  border="0" class="forntsarabun">
  <tr>
    <td height="73" colspan="5" align="center" class="hd">ใบเสร็จรับเงิน <br /><hr /></td>
  </tr>
  <tr>
    <td width="54">ได้รับเงิน</td>
    <td><select name="type_rec" id="type_rec" class="forntsarabun" onchange="Show(this);">
    <option value="1">เงินสด</option>
    <option value="2">เช็ค</option>
    </select></td>
    <td colspan="3"><div id="sel" style="display:none">เลขที่เช็ค
      <input name="idchk" type="text" id="idchk"  class="forntsarabun"/>
</div></td>
    </tr>
  <tr>
    <td>จาก</td>
    <td colspan="4"><input type="text"  name="from" id="from" class="forntsarabun" size="30" value="<?=$dbarr['ptname']?>"/>
      <input name="hn" type="hidden" id="hn" value="<?=$dbarr['hn']?>" />
      <input name="an" type="hidden" id="an" value="<?=$dbarr['an']?>" />
      <input name="indate" type="hidden" id="indate" value="<?=$dbarr['date']?>" />
      <input name="dcdate" type="hidden" id="dcdate" value="<?=$dbarr['dcdate']?>" /></td>
  </tr>
  <tr>
    <td colspan="5"><hr /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="129">&nbsp;</td>
    <td width="185">&nbsp;</td>
    <td width="160">&nbsp;</td>
    <td width="160">&nbsp;</td>
  </tr>
  <tr>
    <td height="38" align="center" bgcolor="#00CCFF">ลำดับ</td>
    <td colspan="2" align="center" bgcolor="#00CCFF">รายการ</td>
    <td align="center" bgcolor="#00CCFF">เบิกได้</td>
    <td align="center" bgcolor="#00CCFF">เบิกไม่ได้</td>
  </tr>
  <? for($i=1;$i<=10;$i++){?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td colspan="2" align="center"><input name="detail_pay<?=$i;?>" type="text" id="textfield" size="40"  class="forntsarabun"/></td>
    <td align="center"><input name="cashy<?=$i;?>" type="text" id="cashy<?=$i;?>" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center"><input name="cashn<?=$i;?>" type="text" id="cashn<?=$i;?>" size="20"  class="forntsarabun" dir="rtl"/></td>
  </tr>
  <?
  }
  ?>
    <tr>
    <td align="center">&nbsp;</td>
    <td colspan="4" align="center">ลงชื่อ  
      <label for="sign_name"></label>
      <input name="sign_name" type="text" class="forntsarabun" id="sign_name" /></td>
    </tr>
    <tr>
      <td align="center">&nbsp;</td>
      <td colspan="4" align="center">
      <input name="button" type="submit" class="forntsarabun" id="button" value="บันทึก" />
      <input type="hidden" name="hdnLine" value="<?=$i;?>">
      </td>
    </tr>
</table>
</form>
<? }else if($_POST['type']==2){
	
	include("../Connections/connect.inc.php");
	
	  function DateDiff($strDate1,$strDate2)
	 {
	return (strtotime($strDate2) - strtotime($strDate1))/ ( 60 * 60 * 24 );  // 1 day = 60*60*24
	 }
	
	$sql1="select * from  ipcard where an='".$_GET['an']."' ";
	$query=mysql_query($sql1);
	$dbarr=mysql_fetch_array($query);
	
	$datey=substr($dbarr['date'],0,4);
	$datem=substr($dbarr['date'],5,2);
	$dated=substr($dbarr['date'],8,2);
	$dtime=substr($dbarr['date'],11,8);
	$indate=$dated.'-'.$datem.'-'.$datey.' '.$dtime;
	
	
	$datey1=substr($dbarr['dcdate'],0,4);
	$datem1=substr($dbarr['dcdate'],5,2);
	$dated1=substr($dbarr['dcdate'],8,2);
	$dtime1=substr($dbarr['dcdate'],11,8);
	$dcdate=$dated1.'-'.$datem1.'-'.$datey1.' '.$dtime1;
	
	
	$y=date('Y')+543;
	$m=date('m');
	$d=date('d');
	$datetime=$d.'-'.$m.'-'.$y;
	$time=date('H:i:s');
	
	
	/////////////////// นับวันนอน ////////////////////
	$y1=substr($dbarr['date'],0,4)-543;
	  $m1=substr($dbarr['date'],5,2);
	  $d1=substr($dbarr['date'],8,2);
	  $datediff1=$y1.'-'.$m1.'-'.$d1;
	  
	  
	  $y2=substr($dbarr['dcdate'],0,4)-543;
	  $m2=substr($dbarr['dcdate'],5,2);
	  $d2=substr($dbarr['dcdate'],8,2);
	  $datediff2=$y2.'-'.$m2.'-'.$d2;
	  
	 if($array['dcdate'] != '0000-00-00 00:00:00'){
	  $admit=DateDiff("$datediff1","$datediff2"); 
	 }else{
	  $admit="0";
	 }
	?>

<form name="form2" method="post" action="receipt_action.php?do=form2">
<table  border="0" class="forntsarabun">
  <tr>
    <td height="73" colspan="6" align="center" class="hd">ใบเสร็จรับเงิน <br /><hr /></td>
  </tr>
  <tr>
    <td colspan="6"><table  border="0">
      <tr>
        <td width="65" >วันที่</td>
        <td colspan="2"><input name="datenow" type="text" class="forntsarabun" id="datenow"  value="<?=$datetime;?>"/></td>
        <td width="10">&nbsp;</td>
        <td width="73">เวลา</td>
        <td width="240"><input name="time" type="text" class="forntsarabun" id="time" size="15"  value="<?=$time;?>" /></td>
        <td width="23">&nbsp;</td>
        <td width="120">&nbsp;</td>
        <td width="17">&nbsp;</td>
        <td width="120">&nbsp;</td>
      </tr>
      <tr>
        <td>ได้รับเงิน</td>
        <td width="76"><select name="type_rec" id="type_rec" class="forntsarabun" onchange="Show(this);">
          <option value="1">เงินสด</option>
          <option value="2">เช็ค</option>
        </select></td>
        <td width="201"><div id="sel" style="display:none">เลขที่เช็ค
            <input name="idchk" type="text" id="idchk"  class="forntsarabun"/>
          </div></td>
        <td></td>
        <td>จาก
          </td>
        <td><input type="text"  name="from" id="from" class="forntsarabun" size="30" value="<?=$dbarr['ptname']?>"/></td>
        <td>HN</td>
        <td><label for="hn"></label>
          <input name="hn" type="text" class="forntsarabun" id="hn" value="<?=$dbarr['hn']?>" size="15" /></td>
        <td>an</td>
        <td><input name="an" type="text" class="forntsarabun" id="an" value="<?=$dbarr['an']?>" size="15" /></td>
      </tr>
      <tr>
        <td>วันที่รับป่วย</td>
        <td colspan="2"><input type="text"  name="indate" id="indate" class="forntsarabun" size="30" value="<?=$indate?>"/></td>
        <td>&nbsp;</td>
        <td>วันที่จำหน่าย</td>
        <td><input type="text"  name="dcdate" id="dcdate" class="forntsarabun" size="30" value="<?=$dcdate?>"/></td>
        <td>รวม</td>
        <td><input name="sum" type="text" class="forntsarabun" id="sum" value="<?=$admit;?>" size="15" /></td>
        <td>วัน</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td colspan="6"><hr /></td>
  </tr>
  <tr>
    <td width="56">&nbsp;</td>
    <td width="278">&nbsp;</td>
    <td width="55">&nbsp;</td>
    <td width="163">&nbsp;</td>
    <td width="160">&nbsp;</td>
    <td width="208">&nbsp;</td>
  </tr>
  <tr>
    <td height="38" align="center" bgcolor="#00CCFF">ลำดับ</td>
    <td colspan="2" align="center" bgcolor="#00CCFF">รายการ</td>
    <td align="center" bgcolor="#00CCFF">เบิกไม่ได้ตามระเบียบ<br />
      กระทรวงการคลัง</td>
    <td align="center" bgcolor="#00CCFF">เบิกได้</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">1</td>
    <td colspan="2">ค่าห้อง/อาหาร</td>
    <td align="center"><input name="1n" type="text" id="1n" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center"><input name="1y" type="text" id="1y" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"></td>
    <td colspan="2">.........ค่าห้อง/ค่าอาหาร(ส่วนเกิน)</td>
    <td align="center"><input name="1sn" type="text" id="1sn" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center"><input name="1sy" type="text" id="1sy" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">2</td>
    <td colspan="2">อวัยวะเทียม/อุปกรณ์ในการบำบัดรักษา</td>
    <td align="center"><input name="2n" type="text" id="2n" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center"><input name="2y" type="text" id="2y" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">3</td>
    <td colspan="2">ยาและสารอาหารทางเส้นเลือดที่ใช้ในโรงพยาบาล</td>
    <td align="center"><input name="3n" type="text" id="3n" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center"><input name="3y" type="text" id="3y" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">4</td>
    <td colspan="2">ยาที่นำไปใช้ต่อที่บ้าน</td>
    <td align="center"><input name="4n" type="text" id="4n" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center"><input name="4y" type="text" id="4y" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">5</td>
    <td colspan="2">เวชภัณฑ์ที่ไม่ใช่ยา</td>
    <td align="center"><input name="5n" type="text" id="5n" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center"><input name="5y" type="text" id="5y" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">6</td>
    <td colspan="2">ค่าบริการโลหิตและส่วนประกอบของโลหิต</td>
    <td align="center"><input name="6n" type="text" id="6n" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center"><input name="6y" type="text" id="6y" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">7</td>
    <td colspan="2">ค่าตรวจวินิจฉัยทางเทคนิคการแพทย์และพยาธิวิทยา</td>
    <td align="center"><input name="7n" type="text" id="7n" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center"><input name="7y" type="text" id="7y" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">8</td>
    <td colspan="2">ค่าตรวจวินิจฉัยและรักษาทางรังสีวิทยา</td>
    <td align="center"><input name="8n" type="text" id="8n" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center"><input name="8y" type="text" id="8y" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">9</td>
    <td colspan="2">ค่าตรวจวินิจฉัยโดยวิธีพิเศษอื่นๆ</td>
    <td align="center"><input name="9n" type="text" id="9n" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center"><input name="9y" type="text" id="9y" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">10</td>
    <td colspan="2">ค่าอุปกรณ์ของใช้และเครื่องมือทางการแพทย์</td>
    <td align="center"><input name="10n" type="text" id="10n" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center"><input name="10y" type="text" id="10y" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">11</td>
    <td colspan="2">ค่าผ่าตัด  ทำคลอด  ทำหัตถการและบริการวิสัญญี</td>
    <td align="center"><input name="11n" type="text" id="11n" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center"><input name="11y" type="text" id="11y" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">12</td>
    <td colspan="2">ค่าบริการทางการพยาบาลทั่วไป</td>
    <td align="center"><input name="12n" type="text" id="12n" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center"><input name="12y" type="text" id="12y" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">13</td>
    <td colspan="2">ค่าบริการทางทันตกรรม</td>
    <td align="center"><input name="13n" type="text" id="13n" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center"><input name="13y" type="text" id="13y" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">14</td>
    <td colspan="2">ค่าบริการทางกายภาพบำบัดและเวชกรรมฟื้นฟู</td>
    <td align="center"><input name="14n" type="text" id="14n" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center"><input name="14y" type="text" id="14y" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">15</td>
    <td colspan="2">ค่าบริการฝังเข็ม/การบำบัดของผู้ประกอบโรคศิลปะอื่นๆ</td>
    <td align="center"><input name="15n" type="text" id="15n" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center"><input name="15y" type="text" id="15y" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">16</td>
    <td colspan="2">ค่าบริการอื่นที่ไม่เกี่ยวข้องกับการรักษา</td>
    <td align="center"><input name="16n" type="text" id="16n" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center"><input name="16y" type="text" id="16y" size="20"  class="forntsarabun" dir="rtl"/></td>
    <td align="center">&nbsp;</td>
  </tr>
    <tr>
    <td align="center">&nbsp;</td>
    <td colspan="5" align="center">ลงชื่อ  
      <label for="sign_name"></label>
      <input name="sign_name" type="text" class="forntsarabun" id="sign_name" /></td>
    </tr>
    <tr>
      <td align="center">&nbsp;</td>
      <td colspan="5" align="center">
      <input name="button" type="submit" class="forntsarabun" id="button" value="บันทึก" /></td>
    </tr>
</table>
</form>

<? } ?>
</body>
</html>