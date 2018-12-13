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
    session_register("cNote");  
 	session_register("cIdcard");  
  	session_register("cIdguard");  

	// Reset new_vn
	$_SESSION['check_vn'] = null;

    include("connect.inc");
	
	if(isset($_GET["action"]) && $_GET["action"] == "hospcode"){
	
	$sql = "SELECT hospcode,hosptype,name  FROM hospcode WHERE  hospcode  like '".$_GET["search2"]."%' ";
	
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
		}
		echo "</TABLE></TD>
		</TR>
		</TABLE></Div>";
	}
		exit();
}
	
	
	
	if(isset($_GET["cHn"]) && $_GET["cHn"] != ""){
		$_SESSION["cHn"] = $_GET["cHn"];
	}
	


    $query = "SELECT * FROM opcard WHERE hn = '$cHn' limit 0,1";
    $result = mysql_query($query)or die("Query failed");
 
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
		$cPhone =$row->phone;
		$chPhone =$row->hphone;
		$cFather =$row->father;
		$cMother =$row->mother;
		$cCouple =$row->couple;
		$cNote=$row->note;
		$cSex =$row->sex;
		$cCamp =$row->camp;
		$cRace=$row->race;
		$cDrugreact=$row->drugreact;
		$cPtf=$row->ptf;
		$cPtfadd=$row->ptfadd;
		$cPtffone=$row->ptffone;

		$cPtfmon=$row->ptfmon;
		$cLastupdate=$row->lastupdate;
		$cBlood=$row->blood;
		$cPtright2 =$row->ptright2;
		$cHospcode=$row->hospcode;
		$typearea = $row->typearea;
		$vstatus = $row->vstatus;
		//echo substr($cPtright,1,3);
		if(substr($cPtright,0,3)=="R12"){  //ประกันสุขภาพถ้วนหน้า(ผู้พิการ)
			echo '<script>alert("ผู้ป่วยสิทธิประกันสุขภาพถ้วนหน้า(ผู้พิการ)\กรุณาตรวจสอบสิทธิการรักษา\r\nเพื่อทบทวนค่ารักษาพยาบาลหรือส่งต่อการรักษาไปต้นสังกัด");</script>';
		}			
		
					
		
		if($cPtright=="R09 ประกันสุขภาพถ้วนหน้า" && $cHospcode=="11512-โรงพยาบาล ค่ายสุรศักดิ์มนตรี"){
			echo "<script>alert('กรุณาตรวจสอบสิทธิการรักษาผู้ป่วยรายนี้ด้วยครับ');</script>";
		}
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
	} 
  	else {
      	echo "ไม่พบ HN : $cHn ";
	}  

//print "$cDbirth";

//print "<body bgcolor='#808080' text='#FFFFFF'>";

	if($cIdcard=="" || $cIdcard=="-"){
		$img=$cHn.'.jpg';
	}else{
		$img=$cIdcard.'.jpg';
	}

////////// ตรวจสอบว่า ผป.มียอดค้างชำระหรือไม่
	$strsql="select * from accrued where hn = '$cHn' and status_pay='n' ";
	$strresult = mysql_query($strsql);
	$strrow=mysql_num_rows($strresult);
	
	if($strrow>0){
		echo "<script>alert('ผู้ป่วยมียอดค้างชำระ  กรุณาติดต่อส่วนเก็บเงินรายได้') </script>";
		//echo "&nbsp;&nbsp;&nbsp<b><font style='font-weight:bold'><a target=BLANK  href='accrued_list.php?hn=$hnid'>ดูยอดค้างชำระ</a></b></font>";
	}
//////////////////////////////////////////
	
	$sql_chkname="SELECT  * FROM opcard where name='".$cName."' and surname='".$cSurname."' and hn !='". $cHn."' ";
	$result_chkname = mysql_query($sql_chkname);
	$rows=mysql_num_rows($result_chkname);
	$arr=mysql_fetch_array($result_chkname);

if($rows>0){	
?>
	<script>
		alert('ผู้ป่วยชื่อ <?=$arr[name];?> นามสกุล <?=$arr[surname];?> \n ซ้ำในระบบทะเบียน HN : <?=$arr[hn];?>');
    </script>
    <?
	echo"<span style=\"background-color: #FFFFCC\"><FONT SIZE='5' COLOR='red'>คำเตือน</FONT><br>";
	echo"<FONT SIZE='4' COLOR='red'>ผู้ป่วยชื่อ  $arr[name]  $arr[surname] ซ้ำในระบบทะเบียน  (HN :: $arr[hn])</FONT><br>";
	echo"<FONT SIZE='4' COLOR='red'>กรุณาตรวจสอบผู้ป่วย</FONT><span>";
	}
?>

<SCRIPT LANGUAGE='JavaScript'>
	function checkID(){
		var stat = true;
		var id13 = document.f1.idcard.value;
		var sum = 0;

		if(id13 != "" && id13 != "-"){
			if(id13.length != 13){
				alert("เลขบัตรประชาชน ขาดหรือเกิน 13 หลัก");
				stat = false;
			}
			if(stat == true){
				
				// https://goo.gl/yaX3FN
				for (i = 0; i < 12; i++){
					sum += parseFloat(id13.charAt(i))*(13-i);
				}

				var sum_mod = sum%11;
				var pre_digit = 1;
				if(sum_mod>1){
					pre_digit = 11;
				}
				var new_sum = pre_digit-sum_mod;
				if( new_sum != parseFloat(id13.charAt(12)) )
					if(confirm("ระบบตรวจสอบว่าคุณกรอกเลขบัตรประชาชนไม่ถูกต้อง \n คุณต้องการกลับไปแก้ไขหรือไม่?"))
						stat = false;
					else
						stat = true;
			}
		}
		
		return stat;
	}
	
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
			url = 'opedit.php?action=hospcode&search2=' + str+'&getto1=' + getto1

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list3").innerHTML = xmlhttp.responseText;
		}
}
	</SCRIPT>

<?php
function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

return $pAge;
}

	if($cYot=="ด.ช."||$cYot=="ด.ญ."||$cYot=="เด็กชาย"||$cYot=="เด็กหญิง"){
		$agechk = substr(calcage($cDbirth),0,2);
		if($agechk>=15){
		?>
		<script>
        	alert("อายุครบ 15 ปี กรุณาเปลี่ยนคำนำหน้าชื่อด้วยคะ");
        </script>
		<?
		}
	}
	$cPtname=$cYot." ".$cName." ".$cSurname;
	
	if(substr($cPtright,0,3)=='R07'){
		$sql = "Select id From ssodata where id LIKE '$cIdcard%' limit 1 ";
		if(Mysql_num_rows(Mysql_Query($sql)) > 0){
			$color = "#339966";
		}else{
			$color = "#FF0033";
		}
	}else if(substr($cPtright,0,3)=='R03'){
		$sql = "Select hn, status From cscddata where hn = '$cHn' AND ( status like '%U%' OR status = '\r' OR status like '%V%' )  limit 1 ";
		if(Mysql_num_rows(Mysql_Query($sql)) > 0){
			$color = "#339966";
		}else{
			$color = "#FF0033";
		}
	}else{
		$color = "#339966";
	}
?>
<body bgcolor='<?=$color;?>' text='#3300FF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>
<h3 align="center" class="fonttitle">เวชระเบียน / MEDICAL RECORD</h3>
<h3 align="center" class="fonttitle">โรงพยาบาลค่ายสุรศักดิ์มนตรี  ลำปาง</h3>
<form name='f1' method='POST' action='opwork.php' onsubmit='return checkForm();' enctype="multipart/form-data">
<fieldset>
    <legend>ข้อมูลประวัติส่วนตัว :  HN : <a href="printpt.php" target="_blank"><font color="#FF0000"><?=$cHn;?></font></a></legend>
<table width="100%" border="0">
  <tr>
    <td width="15%" align="center">
<a href='Capture1.php?id=<?=$cIdcard;?>&hn=<?=$cHn;?>&yot=<?=$cYot;?>&name1=<?=$cName;?>&name2=<?=$cSurname;?>' target=_blank>
    <IMG SRC='../image_patient/<?=$img;?>' WIDTH='100' HEIGHT='150' BORDER='0' ALT=''></a></td>
    <td width="85%" valign="top">
    	<table border="0">
      	<tr>
        <td align="right"  class="fonthead">คำนำหน้า:</td>
        <td>
			<div style="position: relative;">
				<input name="yot" type="text" id="yot" value="<?=$cYot;?>" onkeyup="check_yot()" size="5" >
				<div id="res_yot" style="position: absolute; top: 0; right: 0;"></div>
			</div>
		</td>
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
            <option <? if($cSex=='ช' ||$cSex=='1' ){ echo "selected"; }?> value="ช">ชาย</option>
            <option <? if($cSex=='ญ' ||$cSex=='2' ){ echo "selected"; }?> value="ญ">หญิง</option>
          </select>        </td>
        <td colspan="3" align="right" class="fonthead">หมายเลขประจำตัวประชาชน:</td>
        <td> 
          <input name="idcard" type="text" id="idcard" value="<?=$cIdcard;?>" size="15" maxlength="13" <? if(!empty($cIdcard) && $cIdcard != '-'){ echo "readonly";}?>>        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td align="right" class="fonthead">วันเกิด:</td>
        <td colspan="10" class="fonthead"> 
            <input type='text' id="birth_d" name='d' size='2' value='<?=$cD;?>' maxlength='2'>
            <input type='text' id="birth_m" name='m' size='2' value='<?=$cM;?>' maxlength='2'>
            <input type='text' id="birth_y" name='y' size='4' value='<?=$cY;?>' maxlength='4'>
          เชื้อชาติ: <select size="1" name="race" id="race">
            <option value=""><-เลือก-></option>
            <option  value="ไทย"<? if($cRace=='ไทย'){ echo "selected";}?> >ไทย</option>
            <option value="จีน"<? if($cRace=='จีน'){ echo "selected";}?> >จีน</option>
            <option value="ลาว"<? if($cRace=='ลาว'){ echo "selected";}?>  >ลาว</option>
            <option value="พม่า"<? if($cRace=='พม่า'){ echo "selected";}?> >พม่า</option>
            <option  value="กัมพูชา"<? if($cRace=='กัมพูชา'){ echo "selected";}?>>กัมพูชา</option>
            <option  value="อินเดีย"<? if($cRace=='อินเดีย'){ echo "selected";}?>>อินเดีย</option>
            <option value="เวียดนาม"<? if($cRace=='เวียดนาม'){ echo "selected";}?> >เวียดนาม</option>
            <option value="อื่นๆ" <? if($cRace=='อื่นๆ'){ echo "selected";}?> >อื่นๆ</option>
            </select>
            สัญชาติ: 
            <select size="1" name="nation" id="nation">
            <option value=""><-เลือก-></option>
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
            <option value=""><-เลือก-></option>
            <option value="พุทธ"<? if($cReligion=='พุทธ'){ echo "selected";}?>>พุทธ</option>
            <option value="คริสต์"<? if($cReligion=='คริสต์'){ echo "selected";}?>>คริสต์</option>
            <option value="อิสลาม"<? if($cReligion=='อิสลาม'){ echo "selected";}?>>อิสลาม</option>
			<option value="พราหมณ์-ฮินดู"<? if($cReligion=='พราหมณ์-ฮินดู'){ echo "selected";}?>>พราหมณ์-ฮินดู</option>
			<option value="ซิกข์"<? if($cReligion=='ซิกข์'){ echo "selected";}?>>ซิกข์</option>
            <option value="อื่นๆ"<? if($cReligion=='อื่นๆ'){ echo "selected";}?>>อื่นๆ</option>
            </select>        </td>
        </tr>
      <tr>
        <td align="right" class="fonthead">สถานภาพ:</td>
        <td> 
		<select size="1" name="married" id="married">
			<option value=""><-เลือก-></option>
            <option value="โสด" <? if($cMarried=='โสด'){ echo "selected";}?>>โสด</option>
            <option value="สมรส" <? if($cMarried=='สมรส'){ echo "selected";}?>>สมรส</option>
            <option value="หม้าย" <? if($cMarried=='หม้าย'){ echo "selected";}?>>หม้าย</option>
            <option value="หย่า" <? if($cMarried=='หย่า'){ echo "selected";}?>>หย่า</option>
            <option value="แยก" <? if($cMarried=='แยก'){ echo "selected";}?>>แยก</option>
            <option value="สมณะ" <? if($cMarried=='สมณะ'){ echo "selected";}?>>สมณะ</option>
            <option value="อื่นๆ" <? if($cMarried=='อื่นๆ'){ echo "selected";}?>>อื่นๆ</option>
		</select>        </td>
        <td class="fonthead">อาชีพ:</td>
        <td colspan="3"> 
        <select size="1" name="career" id="career">
			<option value='<?=$cCareer;?>' selected><?=$cCareer;?></option>
			<option value=""><-เลือก-></option>
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
            <?
        $sql="select * from education order by row_id asc";
		$query=mysql_query($sql);
		while($rows=mysql_fetch_array($query)){
			if($cEducation==$rows["edu_code"]){
		?>
            <option value="<?=$rows["edu_code"];?>" selected="selected">
              <?=$rows["edu_code"]."-".$rows["edu_name"];?>
              </option>
            <?
			}else{
		?>
            <option value="<?=$rows["edu_code"];?>">
              <?=$rows["edu_code"]."-".$rows["edu_name"];?>
              </option>
            <?
			}
		}
		?>
          </select>
  &nbsp;<span style="color:#FF0000">***</span> </td>
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
    </table>
    <p><input type="file" name="filUpload"><!---style="display: none; -->
		  <!--<input name="tmpPath" type="text" value="D:\image_patient\<?//=$cIdcard;?>.jpg" size="50" readonly>
		  <strong><a href="#" onClick="filUpload.click();tmpPath.value=filUpload.value;" class="fonttitle">เลือกไฟล์</a></strong>-->
    </p>
      <input type="hidden" name="cIdcard" value="<?=$cIdcard;?>"></td>
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
  <?php /* ?>
  <tr>
    <td align="right" class="fonthead">เลขที่บัตรประชาชนบิดา:</td>
    <td> 
      <input type="text" name="idcard_father" size="13" value="">
    </td>
    <td align="right" class="fonthead">เลขที่บัตรประชาชนมารดา:</td>
    <td> 
      <input type="text" name="idcard_mother" size="13" value="" >
    </td>
    <td align="right" class="fonthead">เลขที่บัตรประชาชนคู่สมรส:</td>
    <td> 
      <input type="text" name="idcard_couple" size="13" value="">
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php */ ?>
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
  <tr>
	<td align="right" class="fonthead">สถานะบุคคล</td>
	<td colspan="5">
		<?php 
		$typearea_list = array(
			1 => 'มีชื่ออยู่ตามทะเบียนบ้านในเขตรับผิดชอบและอยู่จริง',
			2 => 'มีชื่ออยู่ตามทะเบียนบ้านในเขตรับผิดชอบแต่ตัวไม่อยู่จริง',
			3 => 'มาอาศัยอยู่ในเขตรับผิดชอบแต่ทะเบียนบ้านอยู่นอกเขตรับผิดชอบ',
			4 => 'ที่อาศัยอยู่นอกเขตรับผิดชอบและเข้ามารับบริการ',
			5 => 'มาอาศัยในเขตรับผิดชอบแต่ไม่ได้อยู่ตามทะเบียนบ้านในเขตรับผิดชอบ เช่น คนเร่ร่อน ไม่มีที่พักอาศัย เป็นต้น'
		);
		?>
		<select name="typearea" id="typearea">
			<option value="">-- เลือกข้อมูล สถานะบุคคล --</option>
			<?php
			foreach ($typearea_list as $key => $item) { 

				$type_selected = ( $key == $typearea ) ? 'selected="selected"' : '' ;
				?>
				<option value="<?=$key;?>" <?=$type_selected;?>><?=$item;?></option>
				<?php
			}
			?>
		</select>
	</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
  </tr>
</table>    
</fieldset>
<BR>
<fieldset>
    <legend>ข้อมูลสิทธิการรักษา:</legend>
    <table  border="0" align="center">
  <tr>
    <td align="right" class="fonthead">ประเภท:</td>
    <td><!--<select size="1" name="goup" id="goup">
<option value="<?//=$cGoup;?>" selected><?//=$cGoup;?></option>
<option value="G11 ก.1 นายทหารประจำการ">G11 ก.1 นายทหารประจำการ</option>
<option value="G12 ก.2 นายสิบ  พลทหารประจำการ">G12 ก.2 นายสิบ  พลทหารประจำการ</option>
<option value="G13 ก.3 ข้าราชการกลาโหมพลเรือน">G13 ก.3 ข้าราชการกลาโหมพลเรือน</option>
<option value="G14 ก.4 ลูกจ้างประจำ">G14 ก.4 ลูกจ้างประจำ</option>
<option value="G15 ก.5 ลูกจ้างชั่วคราว">G15 ก.5 ลูกจ้างชั่วคราว</option>
<option value="G21 ข.1 สิบตรี พลทหารกองประจำการ">G21 ข.1 สิบตรี พลทหารกองประจำการ</option>
<option value="G22 ข.2 นักเรียนทหาร">G22 ข.2 นักเรียนทหาร</option>
<option value="G23 ข.3 อาสาสมัครทหารพราน">G23 ข.3 อาสาสมัครทหารพราน</option>
<option value="G24 ข.4 นักโทษทหาร">G24 ข.4 นักโทษทหาร</option>
<option value="G31 ค.1 ครอบครัวทหาร">G31 ค.1 ครอบครัวทหาร</option>
<option value="G32 ค.2 ทหารนอกประจำการ">G32 ค.2 ทหารนอกประจำการ
<option value="G33 ค.3 นักศึกษาวิชาทหาร(รด)">G33 ค.3 นักศึกษาวิชาทหาร(รด)</option>
<option value="G34 ค.4 วิวัฒน์พลเมือง">G34 ค.4 วิวัฒน์พลเมือง</option>
<option value="G35 ค.5 บัตรประกันสังคม">G35 ค.5 บัตรประกันสังคม
<option value="G36 ค.6 บัตรทอง30บาท">G36 ค.6 บัตรทอง30บาท</option>
<option value="G37 ค.7 ข้าราชการพลเรือน(เบิกต้นสังกัด)">G37 ค.7 ข้าราชการพลเรือน(เบิกต้นสังกัด)</option>
<option value="G38 ค.8 พลเรือน(ไม่เบิกต้นสังกัด)">G38 ค.8 พลเรือน(ไม่เบิกต้นสังกัด)</option>
<option value="G39 ค.9 อื่นๆไม่ระบุ">G39 ค.9 อื่นๆไม่ระบุ
</select>-->

     <select name="goup" id="goup">
        <option  selected="selected" value="0" >-------------------------เลือก-------------------------</option>
        <?
						include("connect.inc");
						$query = "SELECT * 
						FROM `grouptype` 
						WHERE `status` = 'y'
						ORDER BY type ASC,`row_id` ASC";
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
      </select></td>
    <td align="right" class="fonthead">สังกัด:</td>
    <td><!--<select size="1" name="camp" id="camp">
      <option value="<?//=$cCamp;?>" selected><?//=$cCamp;?></option>
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
    </select>-->
		<SELECT NAME="camp" id="camp">
		<option value="<?=$cCamp;?>" selected><?=$cCamp;?></option>
		<option value=""><-เลือก-></option>
      <? 
		$sqlcamp="SELECT * FROM `camp` order by row_id";
		$querycamp=mysql_query($sqlcamp)or die (mysql_error());
		while($arrcamp=mysql_fetch_array($querycamp)){
			if($cCamp==$arrcamp['name']){
		  ?>
			<option value="<?=$arrcamp['name']?>" selected> <?=$arrcamp['name']?></option>
      <? }else{ ?>
			<option value="<?=$arrcamp['name']?>"><?=$arrcamp['name']?></option>
      <? 
	  		}
		}
	  ?>
		</select>    </td>
    </tr>
    <tr>
    <td align="right" class="fonthead">สิทธิการรักษา</td>
    <td>
	<select size="1" name="ptright1" id="ptright1">
    <?

	//////////////////////////////////การอัพเดทสิทธิปัจจุบัน//////////////////////////////////////
	/*
	if($cIdcard !="" || $cIdcard !="-"){
		if(substr($cPtright1,0,3)=='R03'||substr($cPtright1,0,3)=='R07'){
			$sql = "Select id From ssodata where id LIKE '$cIdcard%' limit 1 ";
			if(Mysql_num_rows(Mysql_Query($sql)) > 0){
			?>
				<option  value="R07 ประกันสังคม" selected>R07 ประกันสังคม</option>
			<?
			}else{
				$sql55 = "Select hn, status From cscddata where hn = '$cHn' AND ( status like '%U%' OR status = '\r' OR status like '%V%' )  limit 1 ";
				if(Mysql_num_rows(Mysql_Query($sql55)) > 0){
				?>
					<option  value="R03 โครงการเบิกจ่ายตรง" selected>R03 โครงการเบิกจ่ายตรง</option>
				<?
				}else{
				?>
					<option  value="0" selected>กรุณาเลือกสิทธิการรักษา</option>
				<?
				}
			}
		}else{
			$sql = "Select id From ssodata where id LIKE '$cIdcard%' limit 1 ";
			if(Mysql_num_rows(Mysql_Query($sql)) > 0){
			?>
				<option  value="R07 ประกันสังคม" selected>R07 ประกันสังคม</option>
			<?
			}else{
				$sql55 = "Select hn, status From cscddata where hn = '$cHn' AND ( status like '%U%' OR status = '\r' OR status like '%V%' )  limit 1 ";
				if(Mysql_num_rows(Mysql_Query($sql55)) > 0){
				?>
					<option  value="R03 โครงการเบิกจ่ายตรง" selected>R03 โครงการเบิกจ่ายตรง</option>
				<?
				}else{
				?>
					<option  value="<?=$cPtright1;?>" selected><?=$cPtright1;?></option>
				<?
				}
			}
		}
	}  // if check idcard
	?>
		<option  value="<?=$cPtright1;?>" selected><?=$cPtright1;?></option>
	<?
	*/
	/*******/////////////////////////////////////////////////////////////////////////////////**********/
	
	// รหัสหลักจาก ptright1
	$ptCode = substr($cPtright1, 0, 3);

	// ถ้ามีใน ssodata แสดงว่าเป็น ปกส
	$q = mysql_query("SELECT id FROM ssodata WHERE id LIKE '$cIdcard%' LIMIT 1 ");
	$sso_row = mysql_num_rows($q);
	if( $sso_row > 0 ){
		$ptCode = 'R07';
	
	}else{

		// ถ้าไม่ใช่ ปกส เช็กใน cscd (เบิกจ่ายตรง)
		$sql_cscd = "SELECT hn, status 
		FROM cscddata 
		WHERE hn = '$cHn' 
		AND ( status LIKE '%U%' OR status = '\r' OR status LIKE '%V%' )  
		LIMIT 1 ";
		$q = mysql_query($sql_cscd);
		$cscd_row = mysql_num_rows($q);
		if( $cscd_row > 0 ){
			$ptCode = 'R03';
		}
	}

	include("connect.inc");
	$sql = "Select * From ptright Order by code ASC ";
	$result = mysql_query($sql) or die(mysql_error());
	while(list($ptright_code, $ptright_name) = mysql_fetch_row($result)){

		$full_ptright = "$ptright_code $ptright_name";

		$select = ( $ptright_code == $ptCode ) ? 'selected="selected"' : '' ;

		?>
		<option value='<?=$full_ptright;?>' <?=$select;?>><?=$full_ptright;?></option>
		<?php
	}
	?>
    </select>    
	</td>
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
      <option value="<?=$cPtfmon;?>" selected><?=$cPtfmon;?></option>
      <option value="" ><-เลือก-></option>
      <option value="MO01 ตนเอง">MO01 ตนเอง</option>
      <option value="MO02 บิดา">MO02 บิดา</option>
      <option value="MO03 มารดา">MO03 มารดา</option>
      <option value="MO04 บุตร">MO04 บุตร</option>
      <option value="MO05 คู่สมรส">MO05 คู่สมรส</option>
    </select></td>
    <td class="fonthead">หน่วยงาน :</td>
    <td><input type='text' name="guardian" size='20'  value="<?=$cGuardian;?>" id="guardian"></td>
    <td align="right" class="fonthead"></td>
    <td>&nbsp;</td>
    </tr>
	<tr>
		<td class="fonthead"><label for="employee">ลูกจ้าง รพ.ค่ายฯ</label></td>
	  <td colspan="3"><?php
			$checked = ( $employee === 'y' ) ? 'checked="checked"' : '' ;
			?>
			<input type="checkbox" id="employee" name="employee" value="y" <?=$checked;?>>
			<span class="fonthead" style="color:#FF3366;">(ถ้าเป็นลูกจ้าง รพ.ค่ายฯ ให้เลือก check box ด้วย)</span>		</td>
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
     <option value="<?=$cBlood;?>"><?=$cBlood;?> </option>
      <option value="ไม่ทราบกรุ๊ปเลือด" <? if($cBlood=='ไม่ทราบกรุ๊ปเลือด'){ echo "selected";}?> >ไม่ทราบกรุ๊ปเลือด</option>
      <option value="ไม่เคยตรวจกรุ๊ปเลือด " <? if($cBlood=='ไม่เคยตรวจกรุ๊ปเลือด'){ echo "selected";}?> >ไม่เคยตรวจกรุ๊ปเลือด </option>
      <option value="เอ"<? if($cBlood=='เอ' || $cBlood=='A' ){ echo "selected";}?>>เอ</option>
      <option value="บี" <? if($cBlood=='บี' || $cBlood=='B' ){ echo "selected";}?>>บี</option>
      <option value="เอบี" <? if($cBlood=='เอบี' || $cBlood=='AB' ){ echo "selected";}?>>เอบี</option>
      <option value="โอ" <? if($cBlood=='โอ' || $cBlood=='O' ){ echo "selected";}?>>โอ</option>
    </SELECT></td>
    <td class="fonthead">แพ้ยา<div id="list3" style="position: absolute;"></div></td>
    <td class="fonthead"><INPUT TYPE="text" NAME="drugreact" id="drugreact" value="<?=$cDrugreact;?>">  
 
<input name="rdo1" type="checkbox"  id="rdo1" value="30 บาท" <? if($cPtright=="R09 ประกันสุขภาพถ้วนหน้า"){ echo "checked"; }?>> 
30 บาท
<input name="rdo1" type="checkbox" id="rdo2" value="ปส." <? if($cPtright=="R07 ประกันสังคม"){ echo "checked"; }?>> 
ประกันสังคม  
      รพ.ต้นสังกัด
<INPUT NAME="hospcode" TYPE="text" id="hospcode" onKeyPress="searchSuggest2(this.value,3,'hospcode');" size="40" value="<?=$cHospcode;?>">
    </td>
    </tr>
  <tr>
    <td align="right" class="fonthead">หมายเหตุ</td>
    <td><select size="1" name="idguard" id="idguard">
            <option  selected="selected" value="0" >--------------------เลือก--------------------</option>
            <?
						include("connect.inc");
						$query = "SELECT * from guardtype order by guard_id asc";
						$result = mysql_query($query);
						while($tbrows=mysql_fetch_assoc($result)){
						$cIdguard = substr($cIdguard,0,4);
							if($tbrows['guard_code'] == $cIdguard){
		?>
            <option value="<?=$tbrows['guard_name'];?>" selected="selected">
            <?=$tbrows['guard_name']?>
            </option>
            <?
								}else{
					     ?>
            <option value="<?=$tbrows['guard_name'];?>" >
            <?=$tbrows['guard_name']?>
            </option>
            <?
                                 }
						  }
						?>
          </select></td>
    <td class="fonthead">หมายเหตุ</td>
    <td><input type="text" name="note" size="50" value="<?=$cNote;?>" id="note"></td>
    </tr>
	<?php /* ?>
	<tr>
		<td align="right" class="fonthead">สถานะในชุมชน</td>
		<td>
		<?php 
		$vstatus_list = array(
			'1' => 'กำนัน ผู้ใหญ่บ้าน',
			'2' => 'อสม.',
			'3' => 'แพทย์ประจำตำบล',
			'4' => 'สมาชิกอบต. / เทศบาล',
			'5' => 'อื่นๆ'
		);
		?>
		<select name="vstatus" id="">
			<option value="">-- เลือกข้อมูล --</option>
			<?php
			foreach ($vstatus_list as $key => $vitem) {
				$selected = ( $key == $vstatus ) ? 'selected="selected"' : '' ;
				?><option value="<?=$key;?>" <?=$selected;?> ><?=$vitem;?></option><?php 
			}
			?>
		</select>
		</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<?php */ ?>
    </table>

</fieldset>
<BR>
<fieldset>
<legend>กรุณาเลือกรายการ เพื่อที่จะเก็บสถิติผู้ป่วย และเลือกสิทธิของผู้ป่วยในการรักษา</legend>
<?
////////////////  ตรวจสอบว่าเป็นเวลาราชการหรือไม่
$time=date("H:i:s");

if($time >='16:00:00'){
	$cktime='selected';
}
?>
<table width="100%" border="0">
  <tr>
    <td align="right" class="fonthead">ออก OPD CARD </td>
    <td colspan="2" class="fonthead"><!--<?//=$time;?>--> <select  id='case1' name='case'>
<?

$today = date("d-m-Y");
$d=substr($today,0,2);
$m=substr($today,3,2);
$yr=substr($today,6,4) +543;  
//  $thdatevn=$d.'-'.$m.'-'.$yr.$nVn;
$thdatehn=$d.'-'.$m.'-'.$yr.$_SESSION["cHn"]; 

$sql = "Select toborow From opday where thdatehn = '".$thdatehn."' and  hn = '".trim($_GET["cHn"])."' order by thidate DESC limit 1 ";
$result = Mysql_Query($sql);
list($toborow) = Mysql_fetch_row($result);
	
$querytype = "select * from typeopcard where status != 'z' ";
$rows = mysql_query($querytype) or die (mysql_error());
while(list($rid,$typename,$typestatus)= mysql_fetch_array($rows)){
	?>
	<option value='<?=$typename?>' <? if($toborow==$typename) echo "selected";?>><?=$typename?></option>
    <?
}

?>
</select></td>
    <td class="fonthead">สิทธิการรักษาปัจจุบัน</td>
    <td class="fonthead">
    <input type="checkbox" value="lock" name="lockptright5" <? if($cPtright2!="") echo "checked";?>> (LOCK)&nbsp;
    <select  name='ptright' id="ptright">
    <?
	//////////////////////////////////การอัพเดทสิทธิปัจจุบัน//////////////////////////////////////
if($cPtright2==""){
	if($cIdcard !="" || $cIdcard !="-"){
	if(substr($cPtright1,0,3)=='R03'||substr($cPtright1,0,3)=='R07'){
		$sql = "Select id From ssodata where id LIKE '$cIdcard%' limit 1 ";
		if(Mysql_num_rows(Mysql_Query($sql)) > 0){
		?>
			<option  value="R07 ประกันสังคม" selected>R07 ประกันสังคม</option>
		<?
		}else{
			$sql55 = "Select hn, status From cscddata where hn = '$cHn' AND ( status like '%U%' OR status = '\r' OR status like '%V%' )  limit 1 ";
			if(Mysql_num_rows(Mysql_Query($sql55)) > 0){
			?>
				<option  value="R03 โครงการเบิกจ่ายตรง" selected>R03 โครงการเบิกจ่ายตรง</option>
			<?
			}else{
			?>
				<option  value="0" selected>กรุณาเลือกสิทธิการรักษา</option>
				<script>alert('ผู้ป่วยมีการเปลี่ยนแปลงสิทธิ์ \nกรุณาเลือกสิทธิ์ใหม่และเปลี่ยนแปลงข้อมูลใน OPD CARD ด้วยคะ');</script>
			<?
			}
		}
	}else{
		$sql = "Select id From ssodata where id LIKE '$cIdcard%' limit 1 ";
		if(Mysql_num_rows(Mysql_Query($sql)) > 0){
		?>
			<option  value="R07 ประกันสังคม" selected>R07 ประกันสังคม</option>
		<?
		}else{
			$sql55 = "Select hn, status From cscddata where hn = '$cHn' AND ( status like '%U%' OR status = '\r' OR status like '%V%' )  limit 1 ";
			if(Mysql_num_rows(Mysql_Query($sql55)) > 0){
			?>
				<option  value="R03 โครงการเบิกจ่ายตรง" selected>R03 โครงการเบิกจ่ายตรง</option>
			<?
			}else{
			?>
				<option  value="<?=$cPtright;?>" selected><?=$cPtright;?></option>
			<?
			}
		}
	}
	}else{
	?>
	<option value='<?=$cPtright1;?>' selected><?=$cPtright1;?></option>
	<?	
	}
}else{
	?>
	<option value='<?=$cPtright2;?>' selected><?=$cPtright2;?></option>
	<?
}
	/*******/////////////////////////////////////////////////////////////////////////////////**********/
?>
<!-- <option value='<?=$cPtright;?>' selected><?=$cPtright;?></option>
 <option value='0' ><-เลือกสิทธิการรักษา-></option>-->
<?
$sql = "Select * From ptright where status !='n' Order by code ASC ";
$result = mysql_query($sql);
while(list($ptright_code, $ptright_name) = mysql_fetch_row($result)){
	print " <option value='{$ptright_code}&nbsp;{$ptright_name}' >{$ptright_code}&nbsp;{$ptright_name}</option>";
}
?>
</select></td>
  </tr>
  <tr>
    <td align="right" class="fonthead">ชื่อผู้ยืม :</td>
    <td><input type='text' name='borow' size='30' value='<?=$borow;?>'></td>
    <td colspan="3" class="fonthead">**มาครั้งสุดท้าย <?=$cD1;?>-<?=$cM1;?>-<?=$cY1;?> <?=$cT1;?> **</td>
    </tr>
</table>

</fieldset>

<?php
// เช็กว่าใน opday มี thdatehn นี้แล้วรึยัง
$sql = "SELECT COUNT(`row_id`) AS `crow_id` 
FROM `opday` 
WHERE `thdatehn` = '".$thdatehn."' 
LIMIT 0,1 ";
$result = Mysql_Query($sql);
list($rows) = Mysql_fetch_row($result);
if($rows > 0){ // ถ้ามีแสดงว่าเคยลงทะเบียนในวันนี้แล้ว

	print "<BR><span style=\"background-color: #FFFFCC\"><FONT SIZE=\"3\" COLOR=\"red\">ผู้ป่วยเคยลงทะเบียนในวันนี้แล้ว ให้ออก VN ใหม่ในกรณีที่มารักษาครั้งใหม่ทุกครั้ง
	<SELECT NAME=\"new_vn\">
		<Option value=\"\">----------------</Option>
		<Option value=\"0\">ใช้ VN เดิม</Option>
		<Option value=\"1\">ออก VN ใหม่</Option>
	</SELECT>";
	
	$sql = "Select date_format(thidate,'%d-%m-%Y %H:%i:%s'),toborow,kew,vn From opday where hn = '".trim($_GET["cHn"])."' ORder by thidate DESC limit 1 ";
	$result = Mysql_Query($sql);
	list($thidate,$toborow,$kew,$vn) = Mysql_fetch_row($result);
	echo "<BR>&nbsp;&nbsp;&nbsp;**มาครั้งสุดท้ายเมื่อ&nbsp; ".$thidate."&nbsp;VN&nbsp;".$vn."&nbsp;โดย&nbsp;".$toborow."&nbsp;&nbsp;ได้คิวที่&nbsp;".$kew."</FONT></span>";

}else{
	print "<INPUT TYPE=\"hidden\" name=\"new_vn\" value=\"1\">";
}
//////////////////////////////


$list_month["01"] ="มกราคม";
$list_month["02"] ="กุมภาพันธ์";
$list_month["03"] ="มีนาคม";
$list_month["04"] ="เมษายน";
$list_month["05"] ="พฤษภาคม";
$list_month["06"] ="มิถุนายน";
$list_month["07"] ="กรกฎาคม";
$list_month["08"] ="สิงหาคม";
$list_month["09"] ="กันยายน";
$list_month["10"] ="ตุลาคม";
$list_month["11"] ="พฤศจิกายน";
$list_month["12"] ="ธันวาคม";

$today2 = date("d")." ".$list_month[date("m")]." ".(date("Y")+543); 

$sql = "SELECT a.*
FROM `appoint` AS a
RIGHT JOIN (
	SELECT MAX(`row_id`) AS `row_id` 
	FROM `appoint` 
	WHERE `hn` = '$cHn' 
	AND `appdate` = '$today2' 
	GROUP BY `doctor` 
) AS b ON b.`row_id` = a.`row_id` 
WHERE a.`apptime` != 'ยกเลิกการนัด'";

$query = mysql_query($sql);
$appoint_num = mysql_num_rows($query);
if( $appoint_num > 0){
	echo "<span style=\"background-color: #FF0000\">
	<B>
	<FONT SIZE=\"5\"  COLOR=\"#CCFFFF\">
	<BR>&nbsp;&nbsp;&nbsp;ผู้ป่วยมีนัดวันนี้ครับ&nbsp;&nbsp;&nbsp;
	</FONT>
	</B>
	</span>";
}

if(substr($cPtright,0,3)=='R07'){
			$sql = "Select id From ssodata where id LIKE '$cIdcard%' limit 1 ";

			if(Mysql_num_rows(Mysql_Query($sql)) > 0){
			echo "<span style=\"background-color: #0033CC\"><B><FONT SIZE=\"5\"  COLOR=\"#FFFF00\"><BR>&nbsp;&nbsp;&nbsp;ตรวจสอบจากสิทธิผู้ป่วยมีสิทธิประกันสังคม&nbsp;&nbsp;&nbsp;</FONT></B></span>";
			}else{
				echo "<span style=\"background-color: #FF0000\"><B><FONT SIZE=\"5\"  COLOR=\"#0033CC\"><BR>&nbsp;&nbsp;&nbsp;ตรวจสอบจากสิทธิผู้ป่วยหมดสิทธิประกันสังคม&nbsp;&nbsp;&nbsp;</FONT></B></span>";
			}
		}else if(substr($cPtright,0,3)=='R03'){
			$sql = "Select hn, status From cscddata where hn = '$cHn' AND ( status like '%U%' OR status = '\r' OR status like '%V%' )  limit 1 ";

			if(Mysql_num_rows(Mysql_Query($sql)) > 0){
			echo "<span style=\"background-color: #0033CC\"><B><FONT SIZE=\"5\"  COLOR=\"#FFFF00\"><BR>&nbsp;&nbsp;&nbsp;ตรวจสอบจากสิทธิผู้ป่วยมีสิทธจ่ายตรง&nbsp;&nbsp;&nbsp;</FONT></B></span>";
			}else{
				echo "<span style=\"background-color: #FF0000\"><B><FONT SIZE=\"5\"  COLOR=\"#0033CC\"><BR>&nbsp;&nbsp;&nbsp;ตรวจสอบจากสิทธิผู้ป่วยหมดสิทธิจ่ายตรง&nbsp;&nbsp;&nbsp;</FONT></B></span>";
			}
		}else{
			$color = "66CDAA";
		}


if(!empty($cIdcard)){
$sql = "Select id From ssodata where id LIKE '$cIdcard%' limit 1 ";
			if(Mysql_num_rows(Mysql_Query($sql)) > 0){
				echo"<FONT SIZE='5' COLOR='#0000FF'><BR>&nbsp;&nbsp;ตรวจสอบฐานข้อมูลผู้ป่วยมีสิทธิประกันสังคม</FONT>";
			}else{
				echo"<FONT SIZE='5' COLOR='#0000FF'><BR>&nbsp;&nbsp;ตรวจสอบฐานข้อมูลผู้ป่วยไม่มีสิทธิประกันสังคม</FONT>";
			}
	}else{
			echo"<FONT SIZE='5' COLOR='#0000FF'><BR>&nbsp;&nbsp;ตรวจสอบฐานข้อมูลผู้ป่วยไม่มีเลขประจำตัวประชาชน</FONT>";
		}


if(!empty($cHn)){
$sql = "Select hn, status From cscddata where hn = '$cHn' AND ( status like '%U%' OR status = '\r' OR status like '%V%')  limit 1 ";			
if(Mysql_num_rows(Mysql_Query($sql)) > 0){
				echo"<FONT SIZE='5' COLOR='#0000FF'><BR>&nbsp;&nbsp;ตรวจสอบฐานข้อมูลผู้ป่วยมีสิทธิจ่ายตรง</FONT><br>";
			}else{
				echo"<FONT SIZE='5' COLOR='#0000FF'><BR>&nbsp;&nbsp;ตรวจสอบฐานข้อมูลผู้ป่วยไม่มีสิทธิจ่ายตรง</FONT><br>";
			}
	}else{
			echo"<FONT SIZE='5' COLOR='#0000FF'>&nbsp;&nbsp;ตรวจสอบฐานข้อมูลผู้ป่วยไม่มี HN</FONT><br>";
		}

if(substr($cPtright,0,3)=="R12" || substr($cPtright,0,3)=="R13" || substr($cPtright,0,3)=="R14" || substr($cPtright,0,3)=="R36"){
	echo"<FONT SIZE='5' COLOR='#FF0000'>&nbsp;&nbsp;กรุณาตรวจสอบสิทธิการรักษา เพื่อทบทวนค่ารักษาพยาบาลหรือส่งต่อการรักษาไปต้นสังกัด</FONT><br>";
}





/*
if(substr($cPtright,0,3)=='R07'){
$sql = "Select id From ssodata where id LIKE '$cIdcard%' ";
if(Mysql_num_rows(Mysql_Query($sql)) > 0){
echo "<span style=\"background-color: #0033CC\"><B><FONT SIZE=\"5\"  COLOR=\"#FFFF00\">&nbsp;&nbsp;&nbsp;ผู้ป่วยมีสิทธิประกันสังคม&nbsp;&nbsp;&nbsp;</FONT></B></span>";
}else{echo "<span style=\"background-color: #FF0000\"><B><FONT SIZE=\"5\"  COLOR=\"#0033CC\">&nbsp;&nbsp;&nbsp;ผู้ป่วยไม่มีสิทธิประกันสังคม&nbsp;&nbsp;&nbsp;</FONT></B></span>";
}
}
*/
		$sqlg3="SELECT * FROM `admit` where hn='$cHn' and D_UPDATE like '".date("Y-m-d")."%' order by row_id desc limit 1";

		$queryg3=mysql_query($sqlg3) or die (mysql_error());
		$arrg3=mysql_num_rows($queryg3);

		if($arrg3>0){
			$arrg4=mysql_fetch_array($queryg3);
			?>
			<script>
			window.open('admit_print.php?row_id=<?=$arrg4['row_id']?>','','');
            </script>
			<?
		}

?>
<p align="center"><input type='submit' value='บันทึก/ลงทะเบียน' name='B1'>
</p>

</td>
 </tr>
</table>
</form>
<?
//substr($cPtright,0,3)=='R07';

if(substr($cPtright,0,3)!=substr($cPtright1,0,3)){
	?>
	<script>alert('ผู้ป่วยมีสิทธิ์หลักกับสิทธิ์รองไม่ตรงกัน\nกรุณาตรวจสอบสิทธิ์การรักษาของผู้ป่วย');</script>
    <?
}
?>
<SCRIPT LANGUAGE="JavaScript">



function checkForm(){
		
		var stat = true;
		var stat2 = true;


		var birth_d = document.getElementById('birth_d');
		var birth_m = document.getElementById('birth_m');
		var birth_y = document.getElementById('birth_y');

		stat2 = checkID();
		if(document.f1.new_vn.value == ''){
			
			alert("ผู้ป่วยเคยลงทะเบียนแล้ว กรุณาเลือกว่าต้องการใช้ VN เดิม หรือ ออก VN ใหม่ ด้วยครับ");
			return false;

		} else if( birth_d.value.length < 2 ){

			alert("รูปแบบวันที่ไม่ถูกต้อง กรุณาตรวจสอบอีกครั้ง \nตัวอย่างรูปแบบวันที่ เช่น 05 เป็นต้น");
			birth_d.focus();
			return false;
		
		} else if( birth_m.value.length < 2 ){

			alert("รูปแบบเดือนไม่ถูกต้อง กรุณาตรวจสอบอีกครั้ง \nตัวอย่างรูปแบบเดือน เช่น 02 เป็นต้น");
			birth_m.focus();
			return false;

		} else if( birth_y.value.length < 4 ){

			alert("รูปแบบปีไม่ถูกต้อง กรุณาตรวจสอบอีกครั้ง \nตัวอย่างรูปแบบปี เช่น 2561 เป็นต้น");
			birth_y.focus();
			return false;

		}else if(document.f1.ptright1.value == '0'||document.f1.ptright.value == '0'){
			
			alert("กรุณาเลือกสิทธิการรักษาด้วยครับ");
			if(document.f1.ptright1.value == '0') {document.f1.ptright1.focus();}
			else if(document.f1.ptright.value == '0') {document.f1.ptright.focus();}
			return false;
		}else if(document.f1.education.value == ''){		
			alert("กรุณาเลือกระดับการศึกษาด้วยครับ เพื่อความสมบูรณ์ของ 43 แฟ้ม");			
			document.f1.education.focus();
			return false;
		}else if(document.f1.typearea.value == ''){		
			alert("กรุณาเลือกสถานะบุคคลด้วยครับ เพื่อความสมบูรณ์ของ 43 แฟ้ม");			
			document.f1.typearea.focus();
			return false;
		}else{	
			if(stat2 == true){
				var ex = document.getElementById('case1').value;
				ex = ex.substr(0,4);
				<?php 
				$sql = "Select distinct part From doctor_off  where date_off = '".(date("Y")+543).date("-m-d")."' ";
				$result = Mysql_Query($sql);
				while($arr = Mysql_fetch_assoc($result)){
					
					echo "if(ex == '".$arr["part"]."' ) stat = false; \n";
				}
				?>
				if(stat == false)
					alert(document.getElementById('case1').value+" ไม่มีตรวจวันนี้ครับ");
					return stat;
				}else{
					return stat2;
				}
		}
		
}
</SCRIPT>

<?php
include 'includes/ajax.php';
?>
<script type="text/javascript">
function check_yot(){
	var newSm = new SmHttp();
	var input_yot = document.getElementById('yot');
	newSm.ajax(
		'pername_getfill.php', 
		{ 'action': 'yot', 'search2': input_yot.value, 'getto1' : 'yot' }, 
		function(res){
			document.getElementById('res_yot').innerHTML = res;
		}
	);
}
</script>
<?php
print "</body>";
include("unconnect.inc");
?>