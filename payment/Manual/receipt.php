
<script type="text/javascript">

function Show(sel){
	//alert(sel);
var obj=document.getElementById('type_rec').value;
if (obj==2){
if(document.getElementById('sel').style.display=='none'){
document.getElementById('sel').style.display='block';
document.getElementById('sel1').style.display='none';
} 
}else if (obj==1){
	
if (document.getElementById('sel').style.display=='block' || document.getElementById('sel1').style.display=='block'){
document.getElementById('sel').style.display='none';
document.getElementById('sel1').style.display='none';

}
}else if (obj==3){
if(document.getElementById('sel1').style.display=='none'){
document.getElementById('sel1').style.display='block';
document.getElementById('sel').style.display='none';
} 

}
}


</script>

<script>
function fncSubmit()
{
	var obj=document.getElementById('type_rec').value;
	if(obj==2){
	if(document.form1.idchk.value=='')
	{
		alert('กรุณาใส่เลขที่เช็ค');
		document.form1.idchk.focus();
		return false;
	}
	if(document.form1.bank2.value=='') {
		alert("กรุณาใส่ชื่อธนาคาร") ;
		document.form1.bank2.focus() ;
		return false ;
	}	
	}else if(obj==3){
	if(document.form1.bank3.value=='') {
		alert("กรุณาใส่ชื่อธนาคาร") ;
		document.form1.bank3.focus() ;
		return false ;	
	}
	document.form1.submit();
}
}

</script>
<style type="text/css">
.hd{
	font-family:"Angsana New";
	font-size: 30px;
}
.forntsarabun{
	font-family:"Angsana New";
	font-size: 22px;
}
</style>
<body>
<form name="f1" method="post" action="">
<select name="type" class="forntsarabun">
<option value="1">แบบกรอกข้อมูล</option>
<option value="2">แบบกรอกข้อมูลแยกประเภท</option>
<option value="3">แบบกรอกข้อมูลตรวจสุขภาพประจำปี</option>
</select>
<input type="submit" name="submit" value="เลือก" class="forntsarabun" />
<a href="../../../nindex.htm" class="forntsarabun">กลับเมนูหลัก</a>
</form>
<?php include("../../Connections/connect.inc.php");  ?>

<!-- receipt_action.php --->
<? if($_POST['type']==1){
/*	include("../Connections/connect.inc.php");
	
	$sql1="select * from  ipcard where an='".$_GET['an']."' ";
	$query=mysql_query($sql1);
	$dbarr=mysql_fetch_array($query);*/

	?>
    <!--action="receipt_action.php?do=form1"-->
    
<form name="form1" method="post" action="receipt_action.php?do=form1" onSubmit="JavaScript:return fncSubmit();">
<table  border="0" class="forntsarabun">
  <tr>
    <td height="73" colspan="5" align="center" class="hd">ใบเสร็จรับเงิน <br /><hr /></td>
  </tr>
  <tr>
    <td>ประเภท</td>
    <td><select name="ref_type" id="ref_type" class="forntsarabun">
      <option value="ค่ารักษาพยาบาล" >ค่ารักษาพยาบาล</option>
      <option value="ค่ารักษาพยาบาลผู้ป่วยใน">ค่ารักษาพยาบาลผู้ป่วยใน</option>
      <option value="ค่ารักษาพยาบาลผู้ป่วยนอก">ค่ารักษาพยาบาลผู้ป่วยนอก</option>
    </select></td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td>ใบเสร็จเล่มที่</td>
    <td><input name="billno" type="text" id="billno"  class="forntsarabun" size="10"/></td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td>ได้รับ</td>
    <td><select name="type_rec" id="type_rec" class="forntsarabun" onChange="Show(this);">
    <option value="1" >เงินสด</option>
    <option value="2">เช็ค</option>
    <option value="3">เงินโอน</option>
    </select></td>
    <td colspan="3"><div id="sel" style="display:none">เลขที่เช็ค
      <input name="idchk" type="text" id="idchk"  class="forntsarabun"/>&nbsp;&nbsp;ธนาคาร
      <input name="bank2" type="text" class="forntsarabun"/>
</div>
<div id="sel1" style="display:none">ธนาคาร
      <input name="bank3" type="text"  class="forntsarabun"/>
</div></td>
    </tr>
  <tr>
    <td>จาก</td>
    <td colspan="4"><input type="text"  name="from" id="from" class="forntsarabun" size="30"/>
      <input name="hn" type="hidden" id="hn" value="<?=$dbarr['hn']?>" />
      <input name="an" type="hidden" id="an" value="<?=$dbarr['an']?>" />
      <input name="indate" type="hidden" id="indate" value="<?=$dbarr['date']?>" />
      <input name="dcdate" type="hidden" id="dcdate" value="<?=$dbarr['dcdate']?>" /></td>
  </tr>
  <tr>
    <td>โรค</td>
    <td colspan="4"><input name="diag" type="text" class="forntsarabun" id="diag" size="50"></td>
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
  <? for($i=1;$i<=15;$i++){?>
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
      <select name="sign_name" class="forntsarabun">
      <?php
	 
	  $sql_1="select name from inputm where menucode='ADMMON' ";
	  $query_1=mysql_query($sql_1);
	  while($arr_1=mysql_fetch_array($query_1)){
		  echo "<option value='".$arr_1['name']."'>$arr_1[name]</option>";  
	  } 
	   ?>
       </select>
      </td>
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
	
	/*include("../Connections/connect.inc.php");
	
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
	 }*/
	 
	 $y=date('Y')+543;
	$m=date('m');
	$d=date('d');
	$datetime=$d.'-'.$m.'-'.$y;
	$time=date('H:i:s');
	?>

<form name="form2" method="post" action="receipt_action.php?do=form2">
<table  border="0" class="forntsarabun">
  <tr>
    <td height="73" colspan="6" align="center" class="hd">ใบเสร็จรับเงิน <br /><hr /></td>
  </tr>
  <tr>
    <td colspan="6"><table  border="0">
      <tr>
        <td>ประเภท</td>
        <td colspan="2"><select name="ref_type" id="ref_type" class="forntsarabun">
          <option value="ค่ารักษาพยาบาล" >ค่ารักษาพยาบาล</option>
          <option value="ค่ารักษาพยาบาลผู้ป่วยใน">ค่ารักษาพยาบาลผู้ป่วยใน</option>
          <option value="ค่ารักษาพยาบาลผู้ป่วยนอก">ค่ารักษาพยาบาลผู้ป่วยนอก</option>
        </select></td>
      </tr>
      <tr>
        <td>ใบเสร็จเล่มที่</td>
        <td colspan="2"><input name="billno" type="text" id="billno"  class="forntsarabun" size="10"/></td>
        </tr>
      <tr>
        <td >ได้รับ</td>
        <td ><select name="type_rec" id="type_rec" class="forntsarabun" onChange="Show(this);">
          <option value="1">เงินสด</option>
          <option value="2">เช็ค</option>
          <option value="3">เงินโอน</option>
          </select></td>
        <td ><div id="sel" style="display:none">เลขที่เช็ค
          <input name="idchk" type="text" id="idchk"  class="forntsarabun"/>&nbsp;&nbsp;ธนาคาร
          <input name="bank2" type="text" id="bank2"  class="forntsarabun"/>
          </div>
          <div id="sel1" style="display:none">ธนาคาร
            <input name="bank3" type="text" id="bank3"  class="forntsarabun"/>
          </div></td>
        </tr>
      <tr>
        <td>จาก</td>
        <td colspan="2"><input type="text"  name="from" id="from" class="forntsarabun" size="30"/></td>
        </tr>
      <tr>
        <td>โรค</td>
        <td colspan="2"><input name="diag" type="text" class="forntsarabun" id="diag" size="50"></td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td colspan="6"><hr /></td>
  </tr>
  <tr>
    <td width="56">&nbsp;</td>
    <td width="281">&nbsp;</td>
    <td width="55">&nbsp;</td>
    <td width="165">&nbsp;</td>
    <td width="165">&nbsp;</td>
    <td width="321">&nbsp;</td>
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
      
      <select name="sign_name" class="forntsarabun">
      <?php
	 
	  $sql_1="select name from inputm where menucode='ADMMON' ";
	  $query_1=mysql_query($sql_1);
	  while($arr_1=mysql_fetch_array($query_1)){
		  echo "<option value='".$arr_1['name']."'>$arr_1[name]</option>";  
	  } 
	   ?>
       </select></td>
    </tr>
    <tr>
      <td align="center">&nbsp;</td>
      <td colspan="5" align="center">
      <input name="button" type="submit" class="forntsarabun" id="button" value="บันทึก" /></td>
    </tr>
</table>
</form>

<? }else if($_POST['type']==3){ ?>

<form name="formhn" method="post" action="">
 <table>
 <tr>
 <td colspan="2" align="center" bgcolor="#0099FF">กรุณาใส่ HN</td>
 </tr>
  <tr>
  <td>HN</td>
  <td><input type="text" name="hn" class="forntsarabun" value="<?=trim($_POST['hn']);?>"></td>
  </tr>
   <tr>
 <td colspan="2" align="center"><input type="submit" name="posthn" value="ตกลง" class="forntsarabun"></td>
 </tr>
 </table>
</form>   
<?
}
 if($_POST['posthn']){
	include("../../Connections/connect.inc.php"); 
	$hn=trim($_POST['hn']);
	
	$sql="select * from opcard where hn='".$hn."' ";
	$q=mysql_query($sql);
	$arr=mysql_fetch_array($q);
	
	$ptname=$arr['yot'].''.$arr['name'].' '.$arr['surname'];
	
	
	?>	
	
<form name="form3" method="post" action="receipt_action.php?do=form3">
<table  border="0" class="forntsarabun">
  <tr>
    <td height="73" colspan="6" align="center" class="hd">ใบเสร็จรับเงิน <br /><hr /></td>
  </tr>
  <tr>
    <td colspan="6"><table  border="0">
      <tr>
        <td width="70" class="forntsarabun">ประเภท</td>
        <td colspan="4"><select name="ref_type" id="ref_type" class="forntsarabun">
        <option value="ค่าตรวจสุขภาพประจำปี" selected>ค่าตรวจสุขภาพประจำปี</option>
          <!--<option value="ค่ารักษาพยาบาล" >ค่ารักษาพยาบาล</option>
          <option value="ค่ารักษาพยาบาลผู้ป่วยใน">ค่ารักษาพยาบาลผู้ป่วยใน</option>
          <option value="ค่ารักษาพยาบาลผู้ป่วยนอก">ค่ารักษาพยาบาลผู้ป่วยนอก</option>-->
        </select></td>
      </tr>
      <tr>
        <td class="forntsarabun">ใบเสร็จเล่มที่</td>
        <td colspan="4"><input name="billno" type="text" id="billno"  class="forntsarabun" size="10"/></td>
        </tr>
      <tr>
        <td class="forntsarabun" >ได้รับ</td>
        <td width="179" ><select name="type_rec" id="type_rec" class="forntsarabun" onChange="Show(this);">
          <option value="1">เงินสด</option>
          <option value="2">เช็ค</option>
          <option value="3">เงินโอน</option>
          </select></td>
        <td colspan="3" ><div id="sel" style="display:none">เลขที่เช็ค
          <input name="idchk" type="text" id="idchk"  class="forntsarabun"/>&nbsp;&nbsp;ธนาคาร
          <input name="bank2" type="text" id="bank2"  class="forntsarabun"/>
          </div>
          <div id="sel1" style="display:none">ธนาคาร
            <input name="bank3" type="text" id="bank3"  class="forntsarabun"/>
          </div></td>
        </tr>
      <tr>
        <td class="forntsarabun">จาก</td>
        <td colspan="2"><input type="text"  name="from" id="from" class="forntsarabun" size="30" value="<?=$ptname;?>"/></td>
        <td width="21">HN</td>
        <td width="316"><input type="text"  name="hn" id="hn" class="forntsarabun" size="30" value="<?=$arr['hn'];?>"/></td>
        </tr>
      <tr>
        <td class="forntsarabun">หน่วยงาน</td>
        <td colspan="4"><select name="company" id="company" class="forntsarabun">
          <option value="บริษัท ธนาคารกสิกรไทย จำกัด (มหาชน)">บริษัท ธนาคารกสิกรไทย จำกัด (มหาชน)</option>
        </select></td>
        </tr>
    </table></td>
    </tr>
  <tr>
    <td colspan="6"><hr /></td>
  </tr>
  <tr>
    <td width="56">&nbsp;</td>
    <td width="281">&nbsp;</td>
    <td width="55">&nbsp;</td>
    <td width="165">&nbsp;</td>
    <td width="165">&nbsp;</td>
    <td width="321">&nbsp;</td>
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
    <td colspan="2"> (30101)CBC (+ diff. + RBC morphology + plt count) by automation </td>
    <td align="center"><input name="1n" type="text" id="1n" size="20"  class="forntsarabun" dir="rtl" value="0.00"/></td>
    <td align="center"><input name="1y" type="text" id="1y" size="20"  class="forntsarabun" dir="rtl" value="90.00"></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">2</td>
    <td colspan="2"> (31001)Urine Analysis </td>
    <td align="center"><input name="2n" type="text" id="2n" size="20"  class="forntsarabun" dir="rtl" value="0.00"/></td>
    <td align="center"><input name="2y" type="text" id="2y" size="20"  class="forntsarabun" dir="rtl" value="50.00"/></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">3</td>
    <td colspan="2"> (32203)Glucose </td>
    <td align="center"><input name="3n" type="text" id="3n" size="20"  class="forntsarabun" dir="rtl" value="0.00"/></td>
    <td align="center"><input name="3y" type="text" id="3y" size="20"  class="forntsarabun" dir="rtl" value="40.00"/></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">4</td>
    <td colspan="2"> (32501)Lipid - Cholesterol </td>
    <td align="center"><input name="4n" type="text" id="4n" size="20"  class="forntsarabun" dir="rtl" value="0.00"/></td>
    <td align="center"><input name="4y" type="text" id="4y" size="20"  class="forntsarabun" dir="rtl" value="60.00"/></td>

    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">5</td>
    <td colspan="2"> (32502)Lipid - TG (Triglyceride) </td>
    <td align="center"><input name="5n" type="text" id="5n" size="20"  class="forntsarabun" dir="rtl" value="0.00"/></td>
    <td align="center"><input name="5y" type="text" id="5y" size="20"  class="forntsarabun" dir="rtl" value="60.00"/></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">6</td>
    <td colspan="2"> (32205)Uric acid </td>
    <td align="center"><input name="6n" type="text" id="6n" size="20"  class="forntsarabun" dir="rtl" value="0.00"/></td>
    <td align="center"><input name="6y" type="text" id="6y" size="20"  class="forntsarabun" dir="rtl" value="60.00"></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">7</td>
    <td colspan="2"> (32202)Creatinine </td>
    <td align="center"><input name="7n" type="text" id="7n" size="20"  class="forntsarabun" dir="rtl" value="0.00"/></td>
    <td align="center"><input name="7y" type="text" id="7y" size="20"  class="forntsarabun" dir="rtl" value="50.00"/></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">8</td>
    <td colspan="2"> (32310)SGOT (AST) </td>
    <td align="center"><input name="8n" type="text" id="8n" size="20"  class="forntsarabun" dir="rtl" value="0.00"/></td>
    <td align="center"><input name="8y" type="text" id="8y" size="20"  class="forntsarabun" dir="rtl" value="50.00"/></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">9</td>
    <td colspan="2"> (32311)SGPT (ALT) </td>
    <td align="center"><input name="9n" type="text" id="9n" size="20"  class="forntsarabun" dir="rtl" value="0.00"/></td>
    <td align="center"><input name="9y" type="text" id="9y" size="20"  class="forntsarabun" dir="rtl" value="50.00"/></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">10</td>
    <td colspan="2"> (41001 )ภาพถ่ายเอ็กซเรย์ทั่วไป </td>
    <td align="center"><input name="10n" type="text" id="10n" size="20"  class="forntsarabun" dir="rtl" value="0.00"/></td>
    <td align="center"><input name="10y" type="text" id="10y" size="20"  class="forntsarabun" dir="rtl" value="170.00"/></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">11</td>
    <td colspan="2">ค่าบริการทางการแพทย์</td>
    <td align="center"><input name="11n" type="text" id="11n" size="20"  class="forntsarabun" dir="rtl" value="0.00"/></td>
    <td align="center"><input name="11y" type="text"  class="forntsarabun" id="11y" dir="rtl" size="20" value="50.00"/></td>
    <td align="center">&nbsp;</td>
  </tr>
    <tr>
      <td align="center">&nbsp;</td>
      <td colspan="5" align="center">ลงชื่อ  
        
        <select name="sign_name" class="forntsarabun">
          <?php
	 
	  $sql_1="select name from inputm where menucode='ADMMON' ";
	  $query_1=mysql_query($sql_1);
	  while($arr_1=mysql_fetch_array($query_1)){
		  echo "<option value='".$arr_1['name']."'>$arr_1[name]</option>";  
	  } 
	   ?>
       </select></td>
    </tr>
    <tr>
      <td align="center">&nbsp;</td>
      <td colspan="5" align="center">
      <input name="button" type="submit" class="forntsarabun" id="button" value="บันทึก" /></td>
    </tr>
</table>
</form>

<?
}
 ?>


</body>
</html>