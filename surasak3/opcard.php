<?php
session_start();
// if(isset($_GET["action"])){
	// header("content-type: application/x-javascript; charset=TIS-620");
// }

include("connect.inc");
if(isset($_GET["action"]) && $_GET["action"] == "district"){
	
	$search_txt = iconv("UTF-8", "TIS-620", trim($_GET["search"]));
	$sql = "Select a.DISTRICT_NAME, b.AMPHUR_NAME, c.PROVINCE_NAME  From district_new as a, amphur_new as b ,province_new as c where DISTRICT_NAME  like '$search_txt%' AND a.PROVINCE_ID = c.PROVINCE_ID AND a.AMPHUR_ID = b.AMPHUR_ID ";
	
	$result = Mysql_Query($sql)or die(Mysql_error());

	if(Mysql_num_rows($result) > 0){
		echo "<br><Div style=\"position: absolute;text-align: left; width:650px; height:300px; overflow:auto; \">";
	
		echo "<TABLE border=\"1\" bordercolor=\"#336600\" cellpadding=\"0\" cellspacing=\"0\"width=\"100%\">
		<TR>
			<TD>
			<table bgcolor=\"#FFFFCC\" width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"0\">
			<tr align=\"center\" bgcolor=\"#336600\">
				<td ><font style=\"color: #FFFFFF\"><strong>ที่อยู่</strong></font></td>
				<td width=\"50\" bgcolor=\"#FF0000\"><font style=\"color: #000000\"><strong><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('list2').innerHTML ='';\">ปิด</A></strong></font></td>
			</tr>";


		$i=1;
		while($arr = Mysql_fetch_assoc($result)){
				

				if($i%2==0)
					$bgcolor="#FFFFFF";
				else
					$bgcolor="#FFFFCC";

echo "<tr bgcolor=\"$bgcolor\" >
					<td  align=\"center\"><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto1"]."').value = '",$arr["DISTRICT_NAME"],"';document.getElementById('".$_GET["getto2"]."').value = '",$arr["AMPHUR_NAME"],"';document.getElementById('".$_GET["getto3"]."').value = '",$arr["PROVINCE_NAME"],"';document.getElementById('list2').innerHTML ='';\">ต.",$arr["DISTRICT_NAME"],"&nbsp;อ.",$arr["AMPHUR_NAME"],"&nbsp;จ.",$arr["PROVINCE_NAME"],"</A></td>
					<td></td>
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
/////////////////////////

 if(isset($_GET["action"]) && $_GET["action"] == "hospcode"){
	
	$sql = "SELECT hospcode,hosptype,name  FROM hospcode WHERE  hospcode  like '".trim($_GET["search2"])."%' ";
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
?>
<body onLoad="document.f1.yot.focus();">
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

.icf_code{
	color: blue;
}
.icf_code:hover, #btn_show_icf:hover{
	text-decoration: underline;
	cursor: pointer;
}
.close-icf:hover, .close_icf_static{
	cursor: pointer;
}
#btn_show_icf{
	color: blue;
}
.notify43{
	border: 2px solid #f95506;
}
</style>
<SCRIPT LANGUAGE="JavaScript">

	function checkForm(){
		var stat = true;
		
		var idCard = document.getElementById('idcard');
		var id13 = idCard.value;
		var sum = 0;
		
		var validation = true;
		var msg = '';

    
    if(id13 != "" && id13 != "-"){
      
      if(id13.length != 13){
        alert("เลขบัตรประชาชนไม่ตรงกับเลข 13 หลักกรุณาใส่ข้อมูลให้ถูกต้อง");
        idCard.focus();
        return false;
      }else{
        
        var test = id13.match(/[0-9]{13}$/g);
        if(test == null){
          alert("ระบบตรวจสอบว่าคุณกรอกเลขบัตรประชาชนไม่ถูกต้อง \nกรุณาตรวจสอบอีกครั้ง");
          return false;
        }
        
        // TEST - 
        //https://jsfiddle.net/rrxf12rv/5/

        // คำนวณเลขบัตรใหม่ 
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
        if( new_sum != parseFloat(id13.charAt(12)) ){
          alert("ระบบตรวจสอบว่าคุณกรอกเลขบัตรประชาชนไม่ถูกต้อง \n กรุณาตรวจสอบอีกครั้ง");
          return false;
        }

      }
    }
    

		var yot = document.getElementById('yot');
		var name = document.getElementById('name');
		var surname = document.getElementById('surname');
		var education = document.getElementById('education');
		var address = document.getElementById('address');
		var tambol = document.getElementById('tambol');
		
		if(yot.value == ''){
			msg += "- กรุณาใส่คำนำหน้าชื่อ\n";
			validation = false;
		}
		if(name.value == ''){
			msg += "- กรุณาใส่ชื่อ\n";
			validation = false;
		}
		if(surname.value == ''){
			msg += "- กรุณาใส่นามสกุล\n";
			validation = false;
		}
		if(education.value == ''){
			msg += "- กรุณาเลือกระดับการศึกษา\n";
			validation = false;
		}		
		if(address.value == ''){
			msg += "- กรุณาใส่บ้านเลขที่\n";
			validation = false;
		}
		if(tambol.value == ''){
			msg += "- กรุณาใส่ตำบล\n";
			validation = false;
		}
		
		if(validation == false){
			msg += "\nถ้าไม่ทราบข้อมูลผู้ป่วยให้ใส่ ขีดกลาง(-)";
			alert(msg);
			return false;
		}
		
		var c = confirm("ยืนยันในการบันทึกข้อมูล");
		if(c == false){
			return false;
		}
		
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

function searchSuggest(str,len,getto1,getto2,getto3) {
	
	// str = str+String.fromCharCode(event.keyCode);
	
	if(str.length > 2){
		url = encodeURI('opcard.php?action=district&search=' + str+'&getto1=' + getto1+'&getto2=' + getto2+'&getto3=' + getto3);

		xmlhttp = newXmlHttp();
		xmlhttp.open("GET", url, false);
		xmlhttp.send(null);

		document.getElementById("list2").innerHTML = xmlhttp.responseText;
		
		
		
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","gethint.php?q="+str,true);
		xmlhttp.send();
		
		
		
		
	}
}
function searchSuggest2(str,len,getto1) {
	
		// str = str+String.fromCharCode(event.keyCode);
		
		if(str.length > 2){
			url = 'opcard.php?action=hospcode&search2=' + str+'&getto1=' + getto1

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list3").innerHTML = xmlhttp.responseText;
		}
}
</SCRIPT>
<?  include("connect.inc"); ?>
<script type="text/javascript" src="js/ptrightOnline.js"></script>
<h3 align="center" class="fonttitle">เวชระเบียน / MEDICAL RECORD</h3>
<h3 align="center" class="fonttitle">โรงพยาบาลค่ายสุรศักดิ์มนตรี  ลำปาง</h3>

<form name="f1" method="POST" action="opdadd.php">

<fieldset>
    <legend>ข้อมูลประวัติส่วนตัว:</legend>
    
    <table width="100%" border="0">
  <tr>
    <td width="15%" align="center"><IMG SRC='../image_patient/NoPicture.jpg' WIDTH='100' HEIGHT='150' BORDER='0' ALT=''></td>
    <td width="85%" valign="top">
    <table border="0">
      <tr valign="top">
        <td align="right"  class="fonthead">คำนำหน้า:</td>
          <td> 
            <div style="position: relative;">
              <input type="text" name="yot" size="5" id="yot" class="notify43">

              <div><a href="javascript:void(0);" class="fonthead" style="color:#a67a42;" onClick="check_yot()">รหัสนำหน้าชื่อ กระทรวงมหาดไทย</a></div>

              <div id="res_yot" style="position: absolute; top: 0; left: 0; background-color: #ffffff; z-index: 1; padding: 4px; display: none;">
                <div id="close_res_yot" style="text-align: center; background-color: #bbbbbb;" onClick="close_res_yot()">[ปิดหน้าต่าง]</div>
                
                <table style="width:600px;">
                  <tr>
                    <td colspan="4">ค้นหาคำนำหน้า : <input type="text" id="search_res_yot"></td>
                  </tr>
                  <tr>
                    <th>ตัวย่อ</th>
                    <th>รายละเอียด</th>
                    <th></th>
                  </tr>
                  <?php 
                  $sql_prefix = "SELECT * FROM `f43_person_1`";
                  $q = mysql_query($sql_prefix);
                  if($q!==false)
                  {
                    $pref_i = 0;
                    while ($pref = mysql_fetch_assoc($q)) {
                      $mod = ( ($pref_i % 2) == 0 ) ? 'style="background-color: #bbbbbb;"' : '';
                      ?>
                      <tr <?=$mod;?> class="find_my_prefix" data-prefix="<?=$pref['detail'];?>">
                        <td><?=$pref['abbreviations'];?></td>
                        <td><?=$pref['detail'];?></td>
                        <td><a href="javascript:void(0)" style="color: #a67a42;" data-prefix-selected="<?=$pref['abbreviations'];?>" class="prefix-selected">เลือก</a></td>
                      </tr>
                      <?php
                      $pref_i++;
                    }
                    
                  }
                  ?>
                </table>
              </div>
            </div>
          </td>
        <td align="right" class="fonthead">ชื่อ:</td>
        <td> 
          <input type="text" name="name" size="15" id="name" class="notify43">        </td>
        <td align="right" class="fonthead">สกุล:</td>
        <td> 
          <input type="text" name="surname" size="15" id="surname" class="notify43">        </td>
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
            <option value="" selected><-เลือก-></option>
            <option value="ช">ชาย</option>
            <option value="ญ">หญิง</option>
          </select>        </td>
        <td colspan="3" align="right" class="fonthead">หมายเลขประจำตัวประชาชน:</td>
        <td> 
          <input type="text" name="idcard" size="15" value="-" id="idcard" onBlur="check_idcard(this,event)" class="notify43">
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
          <input type="text" name="d" size="2" value="วว" maxlength="2" id="d" class="notify43">
          <input type="text" name="m" size="2" value="ดด" maxlength="2" id="m" class="notify43">
          <input type="text" name="y" size="4" value="พ.ศ." maxlength="4" id="y" class="notify43">
          เชื้อชาติ: 
        <select size="1" name="race" id="race">
               <option value="ไทย" selected>ไทย</option>
                <option value="จีน">จีน</option>
                <option value="ลาว">ลาว</option>
                <option value="พม่า">พม่า</option>
                <option value="กัมพูชา">กัมพูชา</option>
                <option value="อินเดีย">อินเดีย</option>
                <option value="เวียดนาม">เวียดนาม</option>
                <option value="อื่นๆ">อื่นๆ</option>
              </select>

            สัญชาติ: 
              <select size="1" name="nation" id="nation">
                <option value="ไทย" selected>ไทย</option>
                <option value="จีน">จีน</option>
                <option value="ลาว">ลาว</option>
                <option value="พม่า">พม่า</option>
                <option value="กัมพูชา">กัมพูชา</option>
                <option value="อินเดีย">อินเดีย</option>
                <option value="เวียดนาม">เวียดนาม</option>
                <option value="อื่นๆ">อื่นๆ</option>
                </select>              </td>
        </tr>
      <tr>
        <td align="right" class="fonthead">ศาสนา:</td>
        <td colspan="10" class="fonthead">
        <select size="1" name="religion" id="religion">
         <option><-เลือก-></option>
                  <option  value="พุทธ" selected>พุทธ</option>
                  <option value="คริสต์">คริสต์</option>
                  <option value="อิสลาม">อิสลาม</option>
                  <option value="อื่นๆ">อื่นๆ</option>
                </select>    </td>
      </tr>
      <tr>
        <td align="right" class="fonthead">สถานภาพ:</td>
        <td> 
          <select size="1" name="married" id="married">
            <option  value="" selected><-เลือก-></option>
            <option value="โสด">โสด</option>
            <option value="สมรส">สมรส</option>
            <option value="หม้าย">หม้าย</option>
            <option value="หย่า">หย่า</option>
            <option value="แยก">แยก</option>
            <option value="สมณะ">สมณะ</option>
            <option value="โสด">อื่นๆ</option>
          </select>        </td>
        <td class="fonthead">อาชีพ:</td>
        <td colspan="3"> 
        <select size="1" name="career" id="career">
  <option  value="" selected><-เลือก-></option>
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
        <td colspan="5"><select name="education" id="education" class="notify43">
          <option value="">----- กรุณาเลือกข้อมูล -----</option>
          <?
        $sql="select * from education order by row_id asc";
		$query=mysql_query($sql);
		while($rows=mysql_fetch_array($query)){
		?>
          <option value="<?=$rows["edu_code"];?>">
          <?=$rows["edu_code"]."-".$rows["edu_name"];?>
          </option>
          <?
		}
		?>
        </select></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td colspan="6" class="fonthead">หมายเลขประจำตัวทหาร: 
          <input name="mid" type="text" id="mid" value="-" size="15" maxlength="13"></td>
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
     <div id="list2" style="position: absolute;"></div>       
<table border="0" align="center">
  <tr>
    <td align="right" class="fonthead"> บ้านเลขที่:</td>
    <td><input type="text" id="address" name="address" size="10"></td>
    <td align="right" class="fonthead">ตำบล:</td>
    <td><input type="text" id="tambol" name="tambol" size="10" onKeyUp="searchSuggest(this.value,3,'tambol','ampur','changwat');"></td>
    <td align="right" class="fonthead">อำเภอ:</td>
    <td><input type="text" id="ampur" name="ampur" size="10" value="เมือง"></td>
    <td class="fonthead">จังหวัด:</td>
    <td><input type="text" id="changwat" name="changwat" size="10" value="ลำปาง"></td>
  </tr>
  <tr>
    <td align="right" class="fonthead">โทรศัพท์บ้าน:</td>
    <td><input type="text" name="hphone" size="10" value="-" id="hphone"></td>
    <td align="right" class="fonthead">มือถือ:</td>
    <td><input type="text" name="phone" size="10" value="-"></td>
    <td align="right" class="fonthead">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="fonthead">บิดา:</td>
    <td> 
      <input type="text" name="father" size="15" value="-">
    </td>
    <td align="right" class="fonthead">มารดา:</td>
    <td> 
      <input type="text" name="mother" size="15" value="-" >
    </td>
    <td align="right" class="fonthead">คู่สมรส:</td>
    <td> 
      <input type="text" name="couple" size="15" value="-">
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="fonthead">ผู้ที่สามารถติดต่อได้:</td>
    <td>
      <input type='text' name="ptf" size='15'  value="-">
    </td>
    <td align="right" class="fonthead">เกี่ยวข้องเป็น:</td>
    <td><input type='text' name="ptfadd" size='10'  value="-"></td>
    <td align="right" class="fonthead">โทรศัพท์:</td>
    <td>
      <input type='text' name="ptffone" size='10'  value="-">
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
      <select name="typearea" id="typearea" class="notify43">
        <option value="">-- เลือกข้อมูล สถานะบุคคล --</option>
        <?php
        foreach ($typearea_list as $key => $item) { 
          ?>
          <option value="<?=$key;?>"><?=$item;?></option>
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
    <td>
      <SELECT NAME="goup" id="goup">
      <option value="" selected><-----------------------เลือก-----------------------></option>
      <? 
		  $sqlg="SELECT * FROM `grouptype` order by row_id";
		  $queryg=mysql_query($sqlg)or die (mysql_error());
		  while($arrg=mysql_fetch_array($queryg)){
		  ?>
      <option value="<?=$arrg['name']?>"><?=$arrg['name']?></option>
      <?
		  }
	  ?>
    </select>      </td>
    <td align="right" class="fonthead">สังกัด:</td>
    <td>
     <SELECT NAME="camp" id="camp">
        <option value="" selected><---------------เลือก---------------></option>
        <? 
		  $sqlcamp="SELECT * FROM `camp` order by row_id";
		  $querycamp=mysql_query($sqlcamp)or die (mysql_error());
		  while($arrcamp=mysql_fetch_array($querycamp)){
		  ?>
        <option value="<?=$arrcamp['name']?>"> <?=$arrcamp['name']?></option>
        <? 
		  }
	  ?>
      </select>    </td>
    </tr>
  <tr>
    <td align="right" class="fonthead">สิทธิการรักษา:</td>
    <td><select size="1" name="ptright">
     <option value="" selected><-----------------------เลือก-----------------------></option>
      <?php

	$sql = "Select * From ptright Order by code ASC ";
$result = mysql_query($sql) or die(mysql_error());
while(list($ptright_code, $ptright_name) = mysql_fetch_row($result)){
	print " <option>{$ptright_code}&nbsp;{$ptright_name}</option>";
}

	?>
    </select></td>
    <td align="right" class="fonthead">ประเภทสิทธิ :</td>
    <td colspan="3"><select name="ptrightdetail" size="1" id="ptrightdetail">
      <option value="" selected><---------------------------------เลือก---------------------------------></option>
      <?php
$sqlptr = "Select * From  ptrightdetail Order by code ASC ";
$resultptr = mysql_query($sqlptr) or die(mysql_error());
while(list($ptrcode, $ptrname) = mysql_fetch_row($resultptr)){
	print " <option value='$ptrname'>$ptrname</option>";
}
	?>
    </select></td>
    </tr>
  <tr>
    <td align="right" class="fonthead">เบิกจาก:</td>
    <td><select   size="1" name="ptfmon" id="ptfmon">
     <option value="" selected><-----เลือก-----></option>
      <option value="MO01 ตนเอง">MO01 ตนเอง</option>
      <option value="MO02 บิดา">MO02 บิดา</option>
      <option value="MO03 มารดา">MO03 มารดา</option>
      <option value="MO04 บุตร">MO04 บุตร</option>
      <option  value="MO05 คู่สมรส">MO05 คู่สมรส</option>
    </select></td>
    <td class="fonthead">หน่วยงาน :</td>
    <td><input type='text' name="guardian" size='20'  value="-" id="guardian"></td>
    <td align="right" class="fonthead">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="fonthead">การรับบริการ:</td>
    <td><SELECT NAME="typeservice" id="typeservice">
      <option value="" selected><-----------เลือก-----------></option>
      <? 
		  $sqlts="SELECT * FROM `typeservice` order by ts_id";
		  $queryts=mysql_query($sqlts)or die (mysql_error());
		  while($arrts=mysql_fetch_array($queryts)){
		  ?>
      <option value="<?=$arrts['ts_name']?>">
      <?=$arrts['ts_name']?>
        </option>
      <? 
		  }
	  ?>
    </select></td>
    <td class="fonthead">&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right" class="fonthead">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    </table>

</fieldset>
<BR>
<?php 
$disabtype_list = array(
  1 => 'ความพิการทางการเห็น',
  2 => 'ความพิการทางการได้ยินหรือการสื่อความหมาย',
  3 => 'ความพิการการเคลื่อนไหวหรือทางร่างกาย',
  4 => 'ความพิการทางจิตใจหรือพฤติกรรมหรือออทิสติก',
  5 => 'ความพิการทางสติปัญญา',
  6 => 'ความพิการทางการเรียนรู้',
  7 => 'ความพิการทางออทิสติก'
);

$disabcause_list = array(
  1 => 'ความพิการแต่กาเนิด',
  2 => 'ความพิการจากการบาดเจ็บ',
  3 => 'ความพิการจากโรค'
);
?>
<fieldset>
  <legend>ข้อมูลผู้พิการ:</legend>
  <table>
      <tr>

        <td class="fonthead" width="25%" align="right">เลขทะเบียนผู้พิการ(DISABID):</td>
        <td width="25%">
          <input type="text" name="disabid" id="disabid" value="">
        </td>
        
        <td class="fonthead" width="25%" align="right">รหัสสภาวะสุขภาพ(ICF):</td>
        <td width="25%">
          <div>
						<input type="text" name="icf" id="icf" value="<?=$icf['icf'];?>">
					</div>
					<span class="fonthead" id="btn_show_icf">แสดงรายละเอียดทั้งหมด</span>
        </td>
      </tr>
      </tr>
        <td class="fonthead" align="right">ประเภทความพิการ(DISABTYPE):</td>
        <td>
          <select name="disabtype" id="">
          <?php
          foreach ($disabtype_list as $key => $dis) {
              ?>
              <option value="<?=$key;?>"><?=$key.'.'.$dis;?></option>
              <?php
          }
          ?>
          </select>
        </td>

        <td class="fonthead" align="right">สาเหตุความพิการ(DISABCAUSE):</td>
        <td>
          <select name="disabcause" id="">
          <?php
          foreach ($disabcause_list as $key => $dis) {
              ?>
              <option value="<?=$key;?>"><?=$key.'.'.$dis;?></option>
              <?php
          }
          ?>
          </select>
        </td>

      </tr>
  </table>
	<div id="icf_res" style="position:relative;"></div>
	<div id="icf_static" style="display: none;">
		<?php 
		$q = mysql_query("SELECT * FROM `icf_icf`");
		?>
		<div class="close_icf_static" style="text-align: center; background-color: #ffb3b3;"><b>[ปิด]</b></div>
		<div style="position: absolute; background-color: #ffffff; border: 1px solid #000000; width: 100%;">
			<table class="chk_table" style="width: 100%;">
			<tr>
				<th>รหัส</th>
				<th>รายละเอียด</th>
			</tr>
			<?php 
			while( $item = mysql_fetch_assoc($q) ){
					?>
					<tr valign="top">
						<td class="icf_code" item-data="<?=$item['id'];?>"><?=$item['id'];?></td>
						<td><?=$item['detail'];?></td>
					</tr>
					<?php
			}
			?>
			</table>
		</div>
	</div>
</fieldset>
<br>
<fieldset>
    <legend>ข้อมูล อื่นๆ:</legend>
    
    
    <table  border="0" align="center" width="100%">
  <tr>
    <td align="right" class="fonthead">กลุ่มเลือด</td>
    <td>
    <SELECT NAME="blood" id="blood">
      <option value="ไม่ทราบกรุ๊ปเลือด">ไม่ทราบกรุ๊ปเลือด</option>
      <option value="ไม่เคยตรวจกรุ๊ปเลือด ">ไม่เคยตรวจกรุ๊ปเลือด </option>
      <option value="เอ">เอ</option>
      <option value="บี">บี</option>
      <option value="เอบี">เอบี</option>
      <option value="โอ">โอ</option>
    </SELECT>    </td>
    <td class="fonthead">แพ้ยา <div id="list3" style="position: absolute;"></div></td>
    <td class="fonthead"><INPUT TYPE="text" NAME="drugreact" id="drugreact" value="-"> 
<input name="rdo1" type="radio"  id="rdo1" value="30 บาท"> 
30 บาท 
<input name="rdo1" type="radio" id="rdo2" value="ปส."> 
ประกันสังคม  
      รพ.ต้นสังกัด
      <INPUT NAME="hospcode" TYPE="text" id="hospcode" onKeyUp="searchSuggest2(this.value,3,'hospcode');" size="40" >  </td>
    </tr>
  <tr>
    <td align="right" class="fonthead">หมายเหตุ</td>
    <td><select size="1" name="idguard" id="idguard">
       <option value="" selected><-----------------------เลือก-----------------------></option>
      <? 
		  $sqlg="SELECT * FROM `guardtype` order by guard_id";
		  $queryg=mysql_query($sqlg)or die (mysql_error());
		  while($arrg=mysql_fetch_array($queryg)){
		  ?>
      <option value="<?=$arrg['guard_name']?>"><?=$arrg['guard_name']?></option>
      <?
		  }
	  ?>
    </select>    </td>
    <td class="fonthead">หมายเหตุ</td>
    <td><input type="text" name="note" size="50" value="-" id="note"></td>
    </tr>
  <tr>
    <td align="right" class="fonthead">Note VIP</td>
    <td><input type="text" name="note_vip" size="50" value="-" id="note_vip"></td>
    <td class="fonthead">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    </table>

</fieldset>
<BR>

<table border="0" align="center">
<tr>
<td>
<input type="submit" value="  บันทึกข้อมูล  " name="B1" Onclick="return checkForm();">&nbsp;&nbsp;
<a target=_self  href="../nindex.htm"><---ไปเมนู</a></CENTER>
    </td>
    </tr>
  </table>
</form>
</body>
<script type="text/javascript" src="templates/classic/main.js"></script>
<script type="text/javascript">

  function check_idcard(link, ev){

    var input_idcard = document.getElementById('idcard').value;
    if( input_idcard != '-' ){
    
      var newSm = new SmHttp();
      newSm.ajax(
        'check_idcard.php',
        { 'idcard': input_idcard },
        function(res){

          var txt = JSON.parse(res);
          if( txt.state === 400 ){
              alert('เลขบัตรประชาชนซ้ำซ้อนกับผู้ป่วย '+"\n"+'HN: '+txt.hn+' '+"\n"+'ชื่อ-สกุล: '+txt.name);
              SmPreventDefault(ev);
          }

        }
      );

    }
  }

function check_yot(){
	document.getElementById('res_yot').style.display = '';
}

function close_res_yot(){
	document.getElementById('res_yot').style.display = 'none';
}

</script>

<script src="js/vendor/jquery-1.11.2.min.js" type="text/javascript"></script>
<script type="text/javascript">
		jQuery.noConflict();
		(function( $ ) {
		$(function() {

				var icf_list = [];

				<?php 
				$q = mysql_query("SELECT * FROM `icf_icf`");
				$i = 0; 

				while( $item = mysql_fetch_assoc($q) ){
						?>
						var myObj = new Object();
						myObj.code = '<?=$item['id'];?>';
						myObj.detail = '<?=$item['detail'];?>';
						icf_list[<?=$i;?>] = myObj; 
						<?php
						$i++;
				}
				?>

				$(document).on('keyup', '#icf', function(){
						var search_txt = $(this).val();
						$('#icf_static').hide();
						if( search_txt.length > 3 ){

								var regex1 = new RegExp(search_txt,'g');

								var htm = '';
								htm += '<div class="close-icf" style="text-align: center; background-color: #ffb3b3;"><b>[ปิด]</b></div>';
								htm += '<div style="position: absolute; background-color: #ffffff; border: 1px solid #000000; width: 100%;">';
								htm += '<table class="chk_table" style="width: 100%;">';
								htm += '<tr>';
								htm += '<th>รหัส</th>';
								htm += '<th>รายละเอียด</th>';
								htm += '</tr>';

								for (let index = 0; index < icf_list.length; index++) {

										var icf_item = icf_list[index];
										const element = icf_item.detail;
										const icf_code = icf_item.code;

										if( regex1.test(element) == true ){
												htm += '<tr valign="top">';
												htm += '<td class="icf_code" item-data="'+icf_code+'">'+icf_code+'</td>';
												htm += '<td>'+element+'</td>';
												htm += '</tr>';
										}
								}

								htm += '</table>';
								htm += '</div>';
								
								$("#icf_res").html(htm);
								$('#icf_res').show();
						}

				});

				// ตัวที่เจนจาก js
				$(document).on('click', '.close-icf', function(){ 
						$('#icf_res').hide();
				});

				$(document).on('click', '.icf_code', function(){
						var code = $(this).attr('item-data');
						$('#icf').val(code);
						$('#icf_res').hide();
						$('#icf_static').hide();
				});


				// ตัวที่เจนจาก php
				$(document).on('click', '#btn_show_icf', function(){
					$('#icf_res').hide();
					$('#icf_static').toggle();
				})
				$(document).on('click', '.close_icf_static', function(){
					$('#icf_static').hide();
				});

        // input ค้นหาคำนำหน้าชื่อ
			$(document).on('keyup', '#search_res_yot', function(){
				var search_key = this.value;
				var patt = new RegExp("("+search_key+")");
				if(search_key.length < 3)
				{
					return;
				}

				for (var index = 0; index < $('.find_my_prefix').length; index++) {
					var find_item = $('.find_my_prefix')[index];
					var data_value = $(find_item).attr('data-prefix');
					if(patt.test(data_value)!==true)
					{
						$(find_item).hide();
					}
					else
					{
						$(find_item).show();
					}
				}

			});

			// คลิกเลือกคำนำหน้าชื่อ
			$(document).on('click', '.prefix-selected', function(){ 
				var prefix = $(this).attr('data-prefix-selected');
				document.getElementById('yot').value = prefix;
				document.getElementById('res_yot').style.display = 'none';
			});
				
		});
		})(jQuery);
</script>

<?php include("unconnect.inc"); ?>