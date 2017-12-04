<style>
body {
	background-color:#CCE9FD;
}
fieldset { border:1px solid green }

legend {
  padding: 0.2em 0.5em;
  border:1px solid green;
  color:green;
  font-size:90%;
  text-align:right;
  }
  .fonttitle{
/*	 font-family:"Angsana New";
	 size:25PX;*/
	 color:#030;
 }
 .fonthead{
	 font-family:"Angsana New";
	 size:16PX;
	/* font-weight:bold;*/
 }
</style>
<script language="JavaScript1.2">
<!--
window.moveTo(0,0);
if (document.all) {
top.window.resizeTo(screen.availWidth,screen.availHeight);
}
else if (document.layers||document.getElementById) {
if (top.window.outerHeight<screen.availHeight||top.window.outerWidth<screen.availWidth){
top.window.outerHeight = screen.availHeight;
top.window.outerWidth = screen.availWidth;
}
}
//-->
</script>

<?php
   session_start();
    session_unregister("cHn");  
    session_unregister("cPtname");
    session_unregister("cPtright");
    session_unregister("cPtright1");
    session_unregister("nVn");  
    session_unregister("cAge");  
    session_unregister("cIdcard");  
    session_unregister("cNote");  
 session_unregister("cIdcard"); 
 session_unregister("cIdguard"); 
    $nRunno="";
    $vAN="";

    $cPtname="";
    $cPtright="";    
    $nVn="";
    $cAge="";
	$borow='';
    session_register("nRunno");  
    session_register("vAN");
    session_register("cHn");  
    session_register("cPtname");
    session_register("cPtright");
    session_register("cPtright1");
    session_register("nVn");  
    session_register("cAge");  
    session_register("cIdcard");   
    session_register("cNote");  
  session_register("cIdcard");  
  session_register("cIdguard");  
    include("connect.inc");

    $query = "SELECT * FROM opcard WHERE hn = '$cHn'";
    $result = mysql_query($query)
        or die("Query failed");
 
    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }
   If ($result){
//	$cRegisdate=$row->regisdate;
	$cIdcard =$row->idcard;
	$cHn =$row->hn;
	$cYot=$row->yot;
	$cName=$row->name;
	$cSurname =$row->surname;
	$cGoup =$row->goup;
	$cMarried =$row->married;
//	$cCbirth (วันเกิดข้อความเก็บไว้ดู)
	$cCbirth =$row->cbirth; // (วันเกิดข้อความเก็บไว้ดู)
	$cDbirth =$row->dbirth;
	$cGuardian=$row->guardian;
	$cIdguard=$row->idguard;
	$cNation =$row->nation;
	$cReligion =$row->religion;
	$cCareer =$row->career;
	$cPtright =$row->ptright;
	$cPtright1 =$row->ptright1;
	$cAddress =$row->address;
	$cTambol =$row->tambol;
	$cAmpur =$row->ampur;
	$cChangwat =$row->changwat;
	$chPhone =$row->hphone;
	$cPhone =$row->phone;
	$cFather =$row->father;
	$cMother =$row->mother;
	$cCouple =$row->couple;
	$cNote=$row->note;
	$cSex =$row->sex;
	$cCamp =$row->camp;
	$cRace=$row->race;
$cPtf=$row->ptf;
$cPtfadd=$row->ptfadd;
$cPtffone=$row->ptffone;

$cPtfmon=$row->ptfmon;
$cLastupdate=$row->lastupdate;
//$cCase=$row->case;
//  2494-05-28
    $cD=substr($cDbirth,8,2);
    $cM=substr($cDbirth,5,2); 
    $cY=substr($cDbirth,0,4); 
  $cD1=substr($cLastupdate,8,2);
    $cM1=substr($cLastupdate,5,2); 
    $cY1=substr($cLastupdate,0,4); 
    $cT1=substr($cLastupdate,11,8); 
                  }  
   else {
      echo "ไม่พบ HN : $cHn ";
           }    
include("unconnect.inc");
//print "$cDbirth";

?>
<title>แสดงข้อมูลเวชระเบียนผู้ป่วย</title>
<body bgcolor='<?=$color;?>' text='#3300FF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>
<h3 align="center" class="fonttitle">เวชระเบียน / MEDICAL RECORD</h3>
<h3 align="center" class="fonttitle">โรงพยาบาลค่ายสุรศักดิ์มนตรี  ลำปาง</h3>
<form name='f1' method='POST' action='opdwork.php' onsubmit='return checkForm();'>

<fieldset>
    <legend>ข้อมูลประวัติส่วนตัว :  HN : <?=$cHn;?></legend>
    
    <table width="100%" border="0">
  <tr>
    <td width="15%" align="center">
<a href='Capture.php?id=<?=$cIdcard;?>&hn=<?=$cHn;?>&yot=<?=$cYot;?>&name1=<?=$cName;?>&name2=<?=$cSurname;?>' target=_blank>
    <IMG SRC='../image_patient/<?=$cIdcard;?>.jpg' WIDTH='100' HEIGHT='150' BORDER='0' ALT=''></a></td>
    <td width="85%" valign="top">
    <table border="0">
      <tr>
        <td align="right"  class="fonthead">คำนำหน้า:</td>
        <td> 
          <input name="yot" type="text" id="yot" value="<?=$cYot;?>" size="5" >
        </td>
        <td align="right" class="fonthead">ชื่อ:</td>
        <td> 
          <input name="name" type="text" id="name" value="<?=$cName;?>" size="15" >
        </td>
        <td align="right" class="fonthead">สกุล:</td>
        <td> 
          <input name="surname" type="text" id="surname" value="<?=$cSurname;?>" size="15">
        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td align="right" class="fonthead">เพศ:</td>
        <td> 
          <select size="1" name="sex" id="sex">
            <option>?</option>
            <option <? if($cSex=='ช'){ echo "selected"; }?> value="ช">ช</option>
            <option <? if($cSex=='ญ'){ echo "selected"; }?> value="ญ">ญ</option>
          </select>
        </td>
        <td colspan="3" align="right" class="fonthead">หมายเลขประจำตัวประชาชน:</td>
        <td> 
          <input name="idcard" type="text" id="idcard" value="<?=$cIdcard;?>" size="15" maxlength="13">
        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td align="right" class="fonthead">วันเกิด:</td>
        <td colspan="10" class="fonthead"> 
<input type='text' name='d' size='2' value='<?=$cD;?>' maxlength='2'>
<input type='text' name='m' size='2' value='<?=$cM;?>' maxlength='2'>
<input type='text' name='y' size='4' value='<?=$cY;?>' maxlength='4'>
          เชื้อชาติ: 
            <select size="1" name="race" id="race">
<option <? if($cRace=='ไทย'){ echo "selected";}?>value="ไทย">ไทย</option>
<option <? if($cRace=='จีน'){ echo "selected";}?> value="จีน">จีน</option>
<option <? if($cRace=='ลาว'){ echo "selected";}?>  value="ลาว">ลาว</option>
<option <? if($cRace=='พม่า'){ echo "selected";}?> value="พม่า">พม่า</option>
<option <? if($cRace=='กัมพูชา'){ echo "selected";}?> value="กัมพูชา">กัมพูชา</option>
<option <? if($cRace=='อินเดีย'){ echo "selected";}?> value="อินเดีย">อินเดีย</option>
<option <? if($cRace=='เวียดนาม'){ echo "selected";}?> value="เวียดนาม">เวียดนาม</option>
<option <? if($cRace=='อื่นๆ'){ echo "selected";}?> value="อื่นๆ">อื่นๆ</option>
              </select>
            สัญชาติ: 
              <select size="1" name="nation" id="nation">
<option  value="ไทย"<? if($cNation=='ไทย'){ echo "selected";}?> >ไทย</option>
<option value="จีน"<? if($cNation=='จีน'){ echo "selected";}?> >จีน</option>
<option value="ลาว"<? if($cNation=='ลาว'){ echo "selected";}?> >ลาว</option>
<option value="พม่า"<? if($cNation=='พม่า'){ echo "selected";}?> >พม่า</option>
<option value="กัมพูชา"<? if($cNation=='กัมพูชา'){ echo "selected";}?> >กัมพูชา</option>
<option value="อินเดีย"<? if($cNation=='อินเดีย'){ echo "selected";}?> >อินเดีย</option>
<option value="เวียดนาม"<? if($cNation=='เวียดนาม'){ echo "selected";}?> >เวียดนาม</option>
<option value="อื่นๆ"<? if($cNation=='อื่นๆ'){ echo "selected";}?> >อื่นๆ</option>
</select>
              ศาสนา: 
                <select size="1" name="religion" id="religion">
<option value="พุทธ"<? if($cReligion=='พุทธ'){ echo "selected";}?>>พุทธ</option>
<option value="คริสต์"<? if($cReligion=='คริสต์'){ echo "selected";}?>>คริสต์</option>
<option value="อิสลาม"<? if($cReligion=='อิสลาม'){ echo "selected";}?>>อิสลาม</option>
<option value="อื่นๆ"<? if($cReligion=='อื่นๆ'){ echo "selected";}?>>อื่นๆ</option>
</select>
        </td>
        </tr>
      <tr>
        <td align="right" class="fonthead">สถานภาพ:</td>
        <td> 
          <select size="1" name="married" id="married">
<option value=""><-เลือก-></option>
<option value="โสด"<? if($cMarried=='โสด'){ echo "selected";}?>>โสด</option>
<option value="สมรส"<? if($cMarried=='สมรส'){ echo "selected";}?>>สมรส</option>
<option value="หม้าย/หย่า"<? if($cMarried=='หม้าย/หย่า'){ echo "selected";}?>>หม้าย/หย่า</option>
<option value="อื่นๆ"<? if($cMarried=='อื่นๆ'){ echo "selected";}?>>อื่นๆ</option>
</select>
        </td>
        <td class="fonthead">อาชีพ:</td>
        <td colspan="3"> 
          <select size="1" name="career" id="career">
            <option value=""><-เลือก-></option>
             <option value='<?=$cCareer;?>' selected><?=$cCareer;?></option>";
<option value="01 เกษตรกร"<? if($cCareer=='01 เกษตรกร'){ echo "selected";}?>>01 เกษตรกร</option>
<option value="02 รับจ้างทั่วไป"<? if($cCareer=='02 รับจ้างทั่วไป'){ echo "selected";}?>>02 รับจ้างทั่วไป</option>
<option value="03 ช่างฝีมือ" <? if($cCareer=='03 ช่างฝีมือ'){ echo "selected";}?>>03 ช่างฝีมือ</option>
<option value="04 ธุรกิจ"<? if($cCareer=='04 ธุรกิจ'){ echo "selected";}?>>04 ธุรกิจ</option>
<option value="05 ทหาร/ตำรวจ"<? if($cCareer=='05 ทหาร/ตำรวจ'){ echo "selected";}?>>05 ทหาร/ตำรวจ</option>
<option value="06 นักวิทยาศาตร์และนักเทคนิก"<? if($cCareer=='06 นักวิทยาศาตร์และนักเทคนิก'){ echo "selected";}?>>06 นักวิทยาศาตร์และนักเทคนิก</option>
<option value="07 บุคลากรด้านสาธารณสุข"<? if($cCareer=='07 บุคลากรด้านสาธารณสุข'){ echo "selected";}?>>07 บุคลากรด้านสาธารณสุข</option>
<option value="08 นักวิชาชีพ/นักวิชาการ"<? if($cCareer=='08 นักวิชาชีพ/นักวิชาการ'){ echo "selected";}?>>08 นักวิชาชีพ/นักวิชาการ</option>
<option value="09 ข้าราชการทั่วไป"<? if($cCareer=='09 ข้าราชการทั่วไป'){ echo "selected";}?>>09 ข้าราชการทั่วไป</option>
<option value="10 รัฐวิสาหกิจ"<? if($cCareer=='10 รัฐวิสาหกิจ'){ echo "selected";}?>>10 รัฐวิสาหกิจ</option>
<option value="11 ผู้เยาว์ไม่มีอาชีพ"<? if($cCareer=='11 ผู้เยาว์ไม่มีอาชีพ'){ echo "selected";}?>>11 ผู้เยาว์ไม่มีอาชีพ</option>
<option value="12 นักบวช/งานด้านศาสนา"<? if($cCareer=='12 นักบวช/งานด้านศาสนา'){ echo "selected";}?>>12 นักบวช/งานด้านศาสนา</option>
<option value="13 อื่นๆ"<? if($cCareer=='13 อื่นๆ'){ echo "selected";}?>>13 อื่นๆ</option>
          </select>
        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  </table>

</fieldset>
<BR>
<fieldset>
    <legend>ข้อมูลการติดต่อ:</legend>
        
<table border="0" align="center">
  <tr>
    <td align="right" class="fonthead"> บ้านเลขที่:</td>
    <td><input type="text" name="address" size="10" value="<?=$cAddress;?>"></td>
    <td align="right" class="fonthead">ตำบล:</td>
    <td><input type="text" name="tambol" size="10" value="<?=$cTambol;?>"></td>
    <td align="right" class="fonthead">อำเภอ:</td>
    <td><input type="text" name="ampur" size="10"  value="<?=$cAmpur;?>"></td>
    <td class="fonthead">จังหวัด:</td>
    <td><input type="text" name="changwat" size="10" value="<?=$cChangwat;?>"></td>
  </tr>
  <tr>
    <td align="right" class="fonthead">โทรศัพท์บ้าน:</td>
    <td><input type="text" name="hphone" size="10" value="<?=$chPhone;?>" id="hphone"></td>
    <td align="right" class="fonthead">มือถือ:</td>
    <td><input type="text" name="phone" size="10" value="<?=$cPhone;?>"></td>
    <td align="right" class="fonthead">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="fonthead">บิดา:</td>
    <td> 
      <input type="text" name="father" size="15" value="<?=$cFather;?>">
    </td>
    <td align="right" class="fonthead">มารดา:</td>
    <td> 
      <input type="text" name="mother" size="15" value="<?=$cMother;?>" >
    </td>
    <td align="right" class="fonthead">คู่สมรส:</td>
    <td> 
      <input type="text" name="couple" size="15" value="<?=$cCouple;?>">
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="fonthead">ผู้ที่สามารถติดต่อได้:</td>
    <td>
      <input type='text' name="ptf" size='15'  value="<?=$cPtf;?>">
    </td>
    <td align="right" class="fonthead">เกี่ยวข้องเป็น:</td>
    <td><input type='text' name="ptfadd" size='10'  value="<?=$cPtfadd;?>"></td>
    <td align="right" class="fonthead">โทรศัพท์:</td>
    <td>
      <input type='text' name="ptffone" size='10'  value="<?=$cPtffone;?>">
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>    
</fieldset>
<BR>
<fieldset>
    <legend>ข้อมูลสิทธิการรักษา:</legend>
    
    
    <table  border="0" align="center">
  <tr>
    <td align="right" class="fonthead">ประเภท:</td>
    <td>
    <select size="1" name="goup" id="goup">
        <option  selected="selected" value="0" >-------------------------เลือก-------------------------</option>
        <?
						include("connect.inc");
						$query = "SELECT * from grouptype order by row_id asc";
						$result = mysql_query($query);
						while($tbrows=mysql_fetch_assoc($result)){
						$code = substr($cGoup,0,3);
							if($tbrows['code'] == $code){
		?>
                        <option value="<?=$tbrows['name'];?>" selected="selected">
                        <?=$tbrows['name']?>
                        </option>
                        <?
								}else{
					     ?>
                        <option value="<?=$tbrows['name'];?>" >
                        <?=$tbrows['name']?>
                        </option>
    					<?
                                 }
						  }
						?>
      </select>
      </td>
    <td align="right" class="fonthead">สังกัด:</td>
    <td><select size="1" name="camp" id="camp">
      <option value="<?=$cCamp;?>" selected><?=$cCamp;?></option>
      <option value="M01 พลเรือน">พลเรือน</option>
      <option value="M02 ร.17 พัน2">ร.17 พัน2</option>
      <option value="M03 มณฑลทหารบกที่32">มณฑลทหารบกที่32</option>
      <option value="M04 ร.พ.ค่ายสุรศักดิ์มนตรี">ร.พ.ค่ายสุรศักดิ์มนตรี</option>
      <option value="M05 ช.พัน4">ช.พัน4</option>
      <option value="M06 ร้อยฝึกรบพิเศษประตูผา">ร้อยฝึกรบพิเศษประตูผา</option>
      <option value="M0301 บก.มทบ.32">บก.มทบ.32</option>
      <option value="M0302 กกพ.มทบ.32">กกพ.มทบ.32</option>
      <option value="M0303 กขว.,ฝผท.มทบ.32">กขว.,ฝผท.มทบ.32</option>
      <option value="M0304 กยก.มทบ.32">กยก.มทบ.32</option>
      <option value="M0305 กกบ.มทบ.32">กกบ.มทบ.32</option>
      <option value="M0306 กกร.มทบ.32">กกร.มทบ.32</option>
      <option value="M0307 ฝคง.มทบ.32">ฝคง.มทบ.32</option>
      <option value="M0308 ฝกง.มทบ.32">ฝกง.มทบ.32</option>
      <option value="M0309 ฝสก.มทบ.32">ฝสก.มทบ.32</option>
      <option value="M0310 ฝปบฝ.มทบ.32">ฝปบฝ.มทบ.32</option>
      <option value="M0311 ผพธ.มทบ.32">ผพธ.มทบ.32</option>
      <option value="M0312 อก.ศาล มทบ.32">อก.ศาล มทบ.32</option>
      <option value="M0313 ฝสวส.มทบ.32">ฝสวส.มทบ.32</option>
      <option value="M0314 ฝธน.มทบ.32">ฝธน.มทบ.32</option>
      <option value="M0315 อศจ.มทบ.32">อศจ.มทบ.32</option>
      <option value="M0316 ร้อย.มทบ.32">ร้อย.มทบ.32</option>
      <option value="M0317 สขส.มทบ.32">สขส.มทบ.32</option>
      <option value="M0313 รจ.มทบ.32">รจ.มทบ.32</option>
      <option value="M0318 ผยย.มทบ.32">ผยย.มทบ.32</option>
      <option value="M0319 สส.มทบ.32">สส.มทบ.32</option>
      <option value="M0320 ฝสห.มทบ.32">ฝสห.มทบ.32</option>
      <option value="M0321 ร้อย.สห.มทบ.32">ร้อย.สห.มทบ.32</option>
      <option value="M0322 มว.ดย.มทบ.32">มว.ดย.มทบ.32</option>
      <option value="M0323 ผสพ.มทบ.32">ผสพ.มทบ.32</option>
      <option value="M0324 สรรพกำลัง มทบ.32">สรรพกำลัง มทบ.32</option>
      <option value="M0325 ศฝ.นศท.มทบ.32">ศฝ.นศท.มทบ.32</option>
      <option value="M0326 ศาล.มทบ.32">ศาล.มทบ.32</option>
      <option value="M0327 ศูนย์โทรศัพท์ มทบ.32">ศูนย์โทรศัพท์ มทบ.32</option>
      <option value="M0328 ผปบ.มทบ.32">ผปบ.มทบ.32</option>
      <option value="M08 สัสดีจังหวัดลำปาง">สัสดีจังหวัดลำปาง</option>
      <option value="M09 มว.คลัง สป.๓ฯ">มว.คลัง สป.๓ฯ</option>
      <option value="M10 กรม ทพ.33">กรม ทพ.33</option>
      <option value="M07 หน่วยทหารอื่นๆ">หน่วยทหารอื่นๆ</option>
    </select></td>
    </tr>
  <tr>
    <td align="right" class="fonthead">สิทธิการรักษา:</td>
    <td><select size="1" name="ptright1" id="ptright1">
      <option  value="<?=$cPtright1;?>"><?=$cPtright1;?></option>
      <?php
include("connect.inc");
	$sql = "Select * From ptright Order by code ASC ";
$result = mysql_query($sql) or die(mysql_error());
while(list($ptright_code, $ptright_name) = mysql_fetch_row($result)){
	print " <option value='$ptright_code&nbsp;$ptright_name'>$ptright_code&nbsp;$ptright_name</option>";
}
	//include("unconnect.inc");
	?>
    </select></td>
    <td class="fonthead">เบิกจาก:</td>
    <td><select   size="1" name="ptfmon" id="ptfmon">
      <option value="<?=$cPtfmon;?>"><?=$cPtfmon;?></option>
      <option value="MO01 ตนเอง">MO01 ตนเอง</option>
      <option value="MO02 บิดา">MO02 บิดา</option>
      <option value="MO03 มารดา">MO03 มารดา</option>
      <option value="MO04 บุตร">MO04 บุตร</option>
      <option value="MO05 คู่สมรส">MO05 คู่สมรส</option>
    </select></td>
    <td align="right" class="fonthead">หน่วยงาน:</td>
    <td><input type='text' name="guardian" size='20'  value="<?=$cGuardian;?>" id="guardian"></td>
    </tr>
    </table>

</fieldset>
<BR>
<fieldset>
    <legend>ข้อมูล อื่นๆ:</legend>
    
    
    <table  border="0" align="center" width="100%">
  <tr>
    <td align="right" class="fonthead">กลุ่มเลือด</td>
    <td><SELECT NAME="blood" id="blood">
     <option value="<?=$cBlood;?>"><?=$cBlood;?></option>
      <option value="ไม่ทราบกรุ๊ปเลือด">ไม่ทราบกรุ๊ปเลือด</option>
      <option value="ไม่เคยตรวจกรุ๊ปเลือด ">ไม่เคยตรวจกรุ๊ปเลือด </option>
      <option value="เอ">เอ</option>
      <option value="บี">บี</option>
      <option value="เอบี">เอบี</option>
      <option value="โอ">โอ</option>
    </SELECT></td>
    <td class="fonthead">แพ้ยา</td>
    <td><INPUT TYPE="text" NAME="drugreact" id="drugreact" value="<?=$cDrugreact;?>"></td>
    </tr>
  <tr>
    <td align="right" class="fonthead">หมายเหตุ</td>
    <td><select size="1" name="idguard" id="idguard">
      <option value="<?=$cIdguard;?>"><?=$cIdguard;?></option>
      <option >MX01 ทหาร/ครอบครัว</option>
      <option >MX02 มีปัญหาเรื่องสิทธิ</option>
      <option >MX03 VIP</option>
    </select></td>
    <td class="fonthead">หมายเหตุ</td>
    <td><input type="text" name="note" size="50" value="<?=$cNote;?>" id="note"></td>
    </tr>
    </table>

</fieldset>
<BR>
<?
print "  <font face='Angsana New' size='4' color =#oooooo>&nbsp;&nbsp;&nbsp; **มาครั้งสุดท้าย&nbsp;&nbsp;&nbsp; $cD1-$cM1-$cY1&nbsp;$cT1 **</font>";
?>
<!--<p align="center"><input type='submit' value='บันทึก/ลงทะเบียน' name='B1'>&nbsp;&nbsp;
</p>-->
</form>

</body>
