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

$_SESSION["cHn"] = trim($_GET["cHn"]);

include("connect.inc");

$query = "SELECT * FROM opcard WHERE hn = '$cHn'";
$result = mysql_query($query) or die("Query failed");

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
    if (!mysql_data_seek($result, $i)) {
        echo "Cannot seek to row $i\n";
        continue;
	}

	if(!($row = mysql_fetch_object($result)))
		continue;
}

if($result){
	//	$cRegisdate=$row->regisdate;
	$cIdcard =$row->idcard;
	$cMid=$row->mid;
	$cHn =$row->hn;
	$cYot=$row->yot;
	$cName=$row->name;
	$cSurname =$row->surname;
	$cEducation =$row->education;
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
	//echo "==>$cPtright - $cPtright1";
	$cPtrightdetail=$row->ptrightdetail;
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
	$cBlood=$row->blood;
	$cDrugreact=$row->drugreact;
	$cHospcode=$row->hospcode;
	$employee = $row->employee;

	$hcode=explode("/",$cHospcode);
	$hcode1=$hcode[0];
		
	//$cCase=$row->case;
	//  2494-05-28
	$cD=substr($cDbirth,8,2);
	$cM=substr($cDbirth,5,2); 
	$cY=substr($cDbirth,0,4); 
	$cD1=substr($cLastupdate,8,2);
	$cM1=substr($cLastupdate,5,2); 
	$cY1=substr($cLastupdate,0,4); 
	$cT1=substr($cLastupdate,11,8); 
 } else {
	echo "ไม่พบ HN : $cHn ";
}
		   
if(substr($cIdguard,0,4)=="MX07"){
	?>
	<script type="text/javascript">
		alert("HN: <?=$cHn;?> มีสถานะทำลายประวัติ");
	</script>
	<?php 
}else if(substr($cIdguard,0,4)=="MX05"){
	?>
	<script type="text/javascript">
		alert("HN: <?=$cHn;?> มีสถานะยุบประวัติ");
	</script>
	<?php 
}

//print "$cDbirth";
?>

<style>
body { background-color: #66CC99; }
fieldset { border:1px solid #0033FF; }
legend {
  padding: 0.2em 0.5em;
  border:1px solid #0033FF;
  color: #0033FF;
  font-size:90%;
  text-align:right;
}
.fonttitle{ color:#030; }
.fonthead{
  font-family:"Angsana New";
  size: 16px;
}
</style>
<script type="text/javascript">
window.moveTo(0,0);
if (document.all) {
  top.window.resizeTo(screen.availWidth,screen.availHeight);
} else if (document.layers||document.getElementById) {
  if (top.window.outerHeight<screen.availHeight||top.window.outerWidth<screen.availWidth){
    top.window.outerHeight = screen.availHeight;
    top.window.outerWidth = screen.availWidth;
  }
}
</script>

<script type="text/javascript">
	function newXmlHttp(){
	var xmlhttp = false;

	try{
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	}catch(e){
	try{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}catch(e){
			xmlhttp = false;
		}
	}

	if(!xmlhttp && document.createElement){
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function searchSuggest2(str,len,getto1) {
	
	str = str+String.fromCharCode(event.keyCode);

	if(str.length >= len){
		url = 'opdedit.php?action=hospcode&search2=' + str+'&getto1=' + getto1
		//alert(url);
		xmlhttp = newXmlHttp();
		xmlhttp.open("GET", url, false);
		xmlhttp.send(null);

		document.getElementById("list3").innerHTML = xmlhttp.responseText;
	}
}
</script>

<?php
if(isset($_GET["action"]) && $_GET["action"] == "hospcode"){
	$sql = "SELECT hospcode,hosptype,name  FROM hospcode WHERE  hospcode  like '".$_GET["search2"]."%' ";
	//echo "==>".$sql;
	
	$result = Mysql_Query($sql)or die(Mysql_error());


	if(Mysql_num_rows($result) > 0){
		echo "<br><Div style=\"position: absolute;text-align: left; width:650px; height:300px; overflow:auto; \">";
	
		echo "<TABLE border=\"1\" bordercolor=\"#336600\" cellpadding=\"0\" cellspacing=\"0\"width=\"100%\">
		<TR>
			<TD>
			<table bgcolor=\"#FFFFCC\" width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"0\">
			<tr align=\"center\" bgcolor=\"#336600\">
				<td ><font style=\"color: #FFFFFF\"><strong>รหัส รพ.</strong></font></td>
				<td ><font style=\"color: #FFFFFF\"><strong>ชื่อ รพ.</strong></font></td>
				<td width=\"50\" bgcolor=\"#FF0000\"><font style=\"color: #000000\"><strong><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('list3').innerHTML ='';\">ปิด</A></strong></font></td>
			</tr>";


		$i=1;
		while($arr = Mysql_fetch_assoc($result)){
				
				if($i%2==0)
					$bgcolor="#FFFFFF";
				else
					$bgcolor="#FFFFCC";

echo "<tr bgcolor=\"$bgcolor\" >
						<td  align=\"center\"><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto1"]."').value = '".$arr["hospcode"].'-'.$arr["hosptype"].' '.$arr["name"]."';document.getElementById('list3').innerHTML ='';\">",$arr["hospcode"],"</A></td>
					<td>".$arr["hosptype"].' '.$arr["name"]."</td>	
				</tr>
				<tr bgcolor=\"#A45200\">
					<td height=\"5\"></td>
					<td height=\"5\"></td>
					
				</tr>
			";

		$i++;
		}  //close while
		echo "</TABLE></TD>
		</TR>
		</TABLE></Div>";
	}  //close numrows
		exit();
}
?>
<title>แก้ไขข้อมูลเวชระเบียนผู้ป่วย</title>
<body bgcolor='<?=$color;?>' text='#3300FF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>
<h3 align="center" class="fonttitle">เวชระเบียน / MEDICAL RECORD</h3>
<h3 align="center" class="fonttitle">โรงพยาบาลค่ายสุรศักดิ์มนตรี  ลำปาง</h3>
<form name='f1' method='POST' action='opdwork.php' onsubmit='return checkForm();' >
<input name="hn" type="hidden" value="<?=$cHn;?>">
<fieldset>
    <legend>ข้อมูลประวัติส่วนตัว :  HN : <?=$cHn;?></legend>
    
    <table width="100%" border="0">
  <tr>
    <td width="15%" align="center">
<a href='Capture.php?id=<?=$cIdcard;?>&hn=<?=$cHn;?>&yot=<?=$cYot;?>&name1=<?=$cName;?>&name2=<?=$cSurname;?>' target=_blank>
    <IMG SRC='../image_patient/<?=$cIdcard;?>.jpg' WIDTH='100' HEIGHT='150' BORDER='0' ALT='' style="border: #FFFFFF solid 3px; padding: 2px 2px 2px 2px;"></a></td>
    <td width="85%" valign="top">
    <table border="0">
      <tr>
        <td align="right"  class="fonthead">คำนำหน้า:</td>
        <td> 
          <input name="yot" type="text" id="yot" value="<?=$cYot;?>" size="5" >        </td>
        <td align="right" class="fonthead">ชื่อ:</td>
        <td> 
          <input name="name" type="text" id="name" value="<?=$cName;?>" size="15" >        </td>
        <td align="right" class="fonthead">สกุล:</td>
        <td> 
          <input name="surname" type="text" id="surname" value="<?=$cSurname;?>" size="15">        </td>
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
            <option value="">เลือก</option>
            <option <?php if($cSex=='ช' ||$cSex=='1' ){ echo "selected"; }?> value="ช">ชาย</option>
            <option <?php if($cSex=='ญ' ||$cSex=='2' ){ echo "selected"; }?> value="ญ">หญิง</option>
          </select>        </td>
        <td colspan="3" align="right" class="fonthead">หมายเลขประจำตัวประชาชน:</td>
        <td> 
          <input name="idcard" type="text" id="idcard" value="<?=$cIdcard;?>" size="15" maxlength="13">        </td>
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
<option <?php if($cRace=='ไทย'){ echo "selected";}?>value="ไทย">ไทย</option>
<option <?php if($cRace=='จีน'){ echo "selected";}?> value="จีน">จีน</option>
<option <?php if($cRace=='ลาว'){ echo "selected";}?>  value="ลาว">ลาว</option>
<option <?php if($cRace=='พม่า'){ echo "selected";}?> value="พม่า">พม่า</option>
<option <?php if($cRace=='กัมพูชา'){ echo "selected";}?> value="กัมพูชา">กัมพูชา</option>
<option <?php if($cRace=='อินเดีย'){ echo "selected";}?> value="อินเดีย">อินเดีย</option>
<option <?php if($cRace=='เวียดนาม'){ echo "selected";}?> value="เวียดนาม">เวียดนาม</option>
<option <?php if($cRace=='อื่นๆ'){ echo "selected";}?> value="อื่นๆ">อื่นๆ</option>
              </select>
            สัญชาติ: 
              <select size="1" name="nation" id="nation">
<option  value="ไทย"<?php if($cNation=='ไทย'){ echo "selected";}?> >ไทย</option>
<option value="จีน"<?php if($cNation=='จีน'){ echo "selected";}?> >จีน</option>
<option value="ลาว"<?php if($cNation=='ลาว'){ echo "selected";}?> >ลาว</option>
<option value="พม่า"<?php if($cNation=='พม่า'){ echo "selected";}?> >พม่า</option>
<option value="กัมพูชา"<?php if($cNation=='กัมพูชา'){ echo "selected";}?> >กัมพูชา</option>
<option value="อินเดีย"<?php if($cNation=='อินเดีย'){ echo "selected";}?> >อินเดีย</option>
<option value="เวียดนาม"<?php if($cNation=='เวียดนาม'){ echo "selected";}?> >เวียดนาม</option>
<option value="อื่นๆ"<?php if($cNation=='อื่นๆ'){ echo "selected";}?> >อื่นๆ</option>
</select>
              ศาสนา: 
                <select size="1" name="religion" id="religion">
<option value="พุทธ"<?php if($cReligion=='พุทธ'){ echo "selected";}?>>พุทธ</option>
<option value="คริสต์"<?php if($cReligion=='คริสต์'){ echo "selected";}?>>คริสต์</option>
<option value="อิสลาม"<?php if($cReligion=='อิสลาม'){ echo "selected";}?>>อิสลาม</option>
<option value="อื่นๆ"<?php if($cReligion=='อื่นๆ'){ echo "selected";}?>>อื่นๆ</option>
</select>        </td>
        </tr>
      <tr>
        <td align="right" class="fonthead">สถานภาพ:</td>
        <td> 
<select size="1" name="married" id="married">
<option value=""><-เลือก-></option>
            <option value="โสด" <?php if($cMarried=='โสด'){ echo "selected";}?>>โสด</option>
            <option value="สมรส" <?php if($cMarried=='สมรส'){ echo "selected";}?>>สมรส</option>
            <option value="หม้าย" <?php if($cMarried=='หม้าย'){ echo "selected";}?>>หม้าย</option>
            <option value="หย่า" <?php if($cMarried=='หย่า'){ echo "selected";}?>>หย่า</option>
            <option value="แยก" <?php if($cMarried=='แยก'){ echo "selected";}?>>แยก</option>
            <option value="สมณะ" <?php if($cMarried=='สมณะ'){ echo "selected";}?>>สมณะ</option>
            <option value="อื่นๆ" <?php if($cMarried=='อื่นๆ'){ echo "selected";}?>>อื่นๆ</option>
</select>        </td>
        <td class="fonthead">อาชีพ:</td>
        <td colspan="3"> 
          <select size="1" name="career" id="career">
            <option value=""><-เลือก-></option>
             <option value='<?=$cCareer;?>' selected><?=$cCareer;?></option>";
<option value="01 เกษตรกร"<?php if($cCareer=='01 เกษตรกร'){ echo "selected";}?>>01 เกษตรกร</option>
<option value="02 รับจ้างทั่วไป"<?php if($cCareer=='02 รับจ้างทั่วไป'){ echo "selected";}?>>02 รับจ้างทั่วไป</option>
<option value="03 ช่างฝีมือ" <?php if($cCareer=='03 ช่างฝีมือ'){ echo "selected";}?>>03 ช่างฝีมือ</option>
<option value="04 ธุรกิจ"<?php if($cCareer=='04 ธุรกิจ'){ echo "selected";}?>>04 ธุรกิจ</option>
<option value="05 ทหาร/ตำรวจ"<?php if($cCareer=='05 ทหาร/ตำรวจ'){ echo "selected";}?>>05 ทหาร/ตำรวจ</option>
<option value="06 นักวิทยาศาตร์และนักเทคนิก"<?php if($cCareer=='06 นักวิทยาศาตร์และนักเทคนิก'){ echo "selected";}?>>06 นักวิทยาศาตร์และนักเทคนิก</option>
<option value="07 บุคลากรด้านสาธารณสุข"<?php if($cCareer=='07 บุคลากรด้านสาธารณสุข'){ echo "selected";}?>>07 บุคลากรด้านสาธารณสุข</option>
<option value="08 นักวิชาชีพ/นักวิชาการ"<?php if($cCareer=='08 นักวิชาชีพ/นักวิชาการ'){ echo "selected";}?>>08 นักวิชาชีพ/นักวิชาการ</option>
<option value="09 ข้าราชการทั่วไป"<?php if($cCareer=='09 ข้าราชการทั่วไป'){ echo "selected";}?>>09 ข้าราชการทั่วไป</option>
<option value="10 รัฐวิสาหกิจ"<?php if($cCareer=='10 รัฐวิสาหกิจ'){ echo "selected";}?>>10 รัฐวิสาหกิจ</option>
<option value="11 ผู้เยาว์ไม่มีอาชีพ"<?php if($cCareer=='11 ผู้เยาว์ไม่มีอาชีพ'){ echo "selected";}?>>11 ผู้เยาว์ไม่มีอาชีพ</option>
<option value="12 นักบวช/งานด้านศาสนา"<?php if($cCareer=='12 นักบวช/งานด้านศาสนา'){ echo "selected";}?>>12 นักบวช/งานด้านศาสนา</option>
<option value="13 อื่นๆ"<?php if($cCareer=='13 อื่นๆ'){ echo "selected";}?>>13 อื่นๆ</option>
          </select>        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="right" class="fonthead">ระดับการศึกษา</td>
        <td colspan="5"><select name="education" id="education">
        <option value="">----- กรุณาเลือกข้อมูล -----</option>
        <?php 
        $sql="select * from education order by row_id asc";
		$query=mysql_query($sql);
		while($rows=mysql_fetch_array($query)){
			if($cEducation==$rows["edu_code"]){
		?>
        	<option value="<?=$rows["edu_code"];?>" selected="selected"><?=$rows["edu_code"]."-".$rows["edu_name"];?></option>
        <?php 
			}else{
		?>
        	<option value="<?=$rows["edu_code"];?>"><?=$rows["edu_code"]."-".$rows["edu_name"];?></option>
        <?php 
			}
		}
		?>
        </select>
&nbsp;<span style="color:#FF0000">***</span>        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" align="right" class="fonthead">หมายเลขประจำตัวทหาร</td>
        <td colspan="4" class="fonthead"><input name="mid" type="text" id="mid" value="<?=$cMid;?>" size="15" maxlength="13"></td>
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
     <SELECT NAME="goup" id="goup">
     <option value="<?=$cGoup;?>" selected><?=$cGoup;?></option>
    <option value=""><-เลือก-></option>
      <?php
		  $sqlg="SELECT * FROM `goup` order by row_id";
		  $queryg=mysql_query($sqlg)or die (mysql_error());
		  while($arrg=mysql_fetch_array($queryg)){

		 if($arrg['name']==$cGoup){
 		  ?>
      <option value="<?=$arrg['name']?>" selected="selected"> <?=$arrg['name']?></option>
      <?php }else{ ?>

      <option value="<?=$arrg['name']?>"><?=$arrg['name']?></option>
      <?php
	  }
		  }
	  ?>
    </select></td>
    <td align="right" class="fonthead">สังกัด:</td>
    <td>
    <SELECT NAME="camp" id="camp">
        <option value="<?=$cCamp;?>" selected><?=$cCamp;?></option>
      <option value=""><-เลือก-></option>
      <?php
		  $sqlcamp="SELECT * FROM `camp` order by row_id";
		  $querycamp=mysql_query($sqlcamp)or die (mysql_error());
		  while($arrcamp=mysql_fetch_array($querycamp)){

			  if($cCamp==$arrcamp['name']){
		  ?>
      <option value="<?=$arrcamp['name']?>" selected> <?=$arrcamp['name']?></option>
      <?php }else{ ?>
      <option value="<?=$arrcamp['name']?>"><?=$arrcamp['name']?></option>
      <?php 
	  }
		  }
	  ?>
    </select>    </td>
    </tr>
  <tr>
    <td align="right" class="fonthead">สิทธิการรักษา:</td>
    <td><select size="1" name="ptright1" id="ptright1">
      <option  value="<?=$cPtright1;?>"> <?=$cPtright1;?></option>
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
    <td class="fonthead">ประเภทสิทธิ :</td>
    <td><select name="ptrightdetail" size="1" id="ptrightdetail">
      <option  value="<?=$cPtrightdetail;?>" selected><?=$cPtrightdetail;?></option>
      <option value="" ><-เลือก-></option>
      <?php
$sqlptr = "Select * From  ptrightdetail Order by code ASC ";
$resultptr = mysql_query($sqlptr) or die(mysql_error());
while(list($ptrcode, $ptrname) = mysql_fetch_row($resultptr)){
	
	if($cPtrightdetail==$ptrname){
	print " <option value='$ptrname' selected>$ptrname</option>";
}else{
	print " <option value='$ptrname'>$ptrname</option>";	
}
}
	?>
    </select></td>
    <td align="right" class="fonthead">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="fonthead">เบิกจาก:</td>
    <td><select   size="1" name="ptfmon" id="ptfmon">
      <option value="<?=$cPtfmon;?>">
        <?=$cPtfmon;?>
        </option>
      <option value="MO01 ตนเอง">MO01 ตนเอง</option>
      <option value="MO02 บิดา">MO02 บิดา</option>
      <option value="MO03 มารดา">MO03 มารดา</option>
      <option value="MO04 บุตร">MO04 บุตร</option>
      <option value="MO05 คู่สมรส">MO05 คู่สมรส</option>
    </select></td>
    <td class="fonthead">หน่วยงาน:</td>
    <td><input type='text' name="guardian" size='20'  value="<?=$cGuardian;?>" id="guardian"></td>
    <td align="right" class="fonthead">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
		<td class="fonthead"><label for="employee">ลูกจ้าง รพ.ค่ายฯ</label></td>
	  <td colspan="3"><?php
			$checked = ( $employee === 'y' ) ? 'checked="checked"' : '' ;
			?>
			<input type="checkbox" id="employee" name="employee" value="y" <?=$checked;?>>
			<span class="fonthead" style="color: #FF0033;">(ถ้าเป็นลูกจ้าง รพ.ค่ายฯ ให้เลือก check box ด้วย)</span>		</td>

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
    <td class="fonthead">แพ้ยา<div id="list3" style="position: absolute;"></div></td>
    <td><INPUT TYPE="text" NAME="drugreact" id="drugreact" value="<?=$cDrugreact;?>">
<input name="rdo1" type="radio"  id="rdo1" value="30 บาท" <?php if($hcode1=="30 บาท"){ echo "checked"; }?>> 
30 บาท 
<input name="rdo1" type="radio" id="rdo2" value="ปส." <?php if($hcode1=="ปส."){ echo "checked"; }?>> 
ประกันสังคม  
      รพ.ต้นสังกัด
<INPUT NAME="hospcode" TYPE="text" id="hospcode" onKeyPress="searchSuggest2(this.value,3,'hospcode');" size="40" value="<?=$cHospcode;?>">    
    </td>
    </tr>
  <tr>
    <td align="right" class="fonthead">หมายเหตุ</td>
    <td><select size="1" name="idguard" id="idguard">
      <option value="<?=$cIdguard;?>"><?=$cIdguard;?></option>
      <option value=''>-----เลือก-----</option>
      <option value='MX01 ทหาร/ครอบครัว'>MX01 ทหาร/ครอบครัว</option>
      <option value='MX02 มีปัญหาเรื่องสิทธิ'>MX02 มีปัญหาเรื่องสิทธิ</option>
      <option value='MX03 VIP'>MX03 VIP</option>
      <option value='MX04 เสียชีวิต'>MX04 เสียชีวิต</option>
	  <option value='MX04 เสียชีวิต(ใน)'>MX04 เสียชีวิต(ใน)</option>
	  <option value='MX05 ยุบประวัติ'>MX05 ยุบประวัติ</option>
	  <option value='MX06 บัตรทองคนพิการ'>MX06 บัตรทองคนพิการ</option>
	  <option value='MX07 ทำลายประวัติ'>MX07 ทำลายประวัติ</option>
      <option value='MX08 ทหาร/ครอบครัว(เสียชีวิต)'>MX08 ทหาร/ครอบครัว(เสียชีวิต)</option>
      <option value='MX09 ทหาร/ครอบครัว(ทุพพลภาพ)'>MX09 ทหาร/ครอบครัว(ทุพพลภาพ)</option>
      
    </select></td>
    <td class="fonthead">หมายเหตุ</td>
    <td><input type="text" name="note" size="50" value="<?=$cNote;?>" id="note"></td>
    </tr>
    </table>

</fieldset>
<BR>
<?php 
print "  <font face='Angsana New' size='4' color =red>&nbsp;&nbsp;&nbsp; **มาครั้งสุดท้าย&nbsp;&nbsp;&nbsp; $cD1-$cM1-$cY1&nbsp;$cT1 **</font>";
?>
<p align="center"><input type='submit' value='แก้ไข/ลงทะเบียน' name='B1'>&nbsp;&nbsp;
</p>
</form>

</body>