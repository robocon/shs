<?
session_start();
//if (isset($sIdname)){} else {die;} //for security
include("connect.inc");

		$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
		$result = mysql_query($query) or die("Query failed");
		
		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}
				if(!($row = mysql_fetch_object($result)))
				continue;
		}
		$nPrefix=$row->prefix;
?>
<style type="text/css">
<!--
body,td,th {
	font-family: "cs ChatThai", "CS ChatThaiUI";
	font-size: 18px;
}
.frmsaraban{
	font-family: "cs ChatThai", "CS ChatThaiUI";
	font-size: 18px;
}
.labfont {		
	font-family: "cs ChatThai", "CS ChatThaiUI";
	font-size: 18px;
}
-->
#showMe{
    display:none;
}
.forntsarabun {	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.style1 {font-family: "cs ChatThai", "CS ChatThaiUI"; font-size: 18px; font-weight: bold; }
</style>
<title>บันทึกผลตรวจสุขภาพทหารประจำปี (ตรวจที่อื่น)</title><a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a>
<form action="armychkupopd_out.php" method="post">
<input name="act" type="hidden" value="show" />
<div align="center"><strong>บันทึกผลตรวจสุขภาพทหารประจำปี <?=$nPrefix;?></strong> (ตรวจที่อื่น)</div>
<br>
<TABLE width="357" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#393939" >
  <TR>
	<TD width="439" height="148">
	<TABLE width="451" height="142" border="0" cellpadding="2" cellspacing="0">
	<TR>
	  <TD height="30" colspan="2" align="center" bgcolor="#339999" class="tb_font_1"><strong>ค้นหา HN / ID</strong></TD>
		</TR>
	<TR>
	  <TD width="35" height="22" align="right" bgcolor="#66CC99" class="tb_font">HN :&nbsp;</TD>
		<TD width="416" bgcolor="#66CC99" class="tb_font"><input type="text" name="p_hn" />
		  &nbsp;(Hospital Number)</TD>
	</TR>
	<TR>
	  <TD align="right" bgcolor="#66CC99" class="tb_font">ID :&nbsp;</TD>
	  <TD height="35" bgcolor="#66CC99" class="tb_font"><input type="text" name="p_id"  />
	    &nbsp;(เลขที่บัตรประชาชน)</TD>
	  </TR>
	<tr>
	  <td height="31" align="right" bgcolor="#66CC99" class="tb_font">ชื่อ :&nbsp;</td>
      <td height="31" bgcolor="#66CC99" class="tb_font"><input type="text" name="p_name"  />
สกุล :
  <input type="text" name="p_sname" /></td>
	</tr>
	<TR>
	  <TD colspan="2" align="center" bgcolor="#66CC99" class="tb_font"><input name="Submit" type="submit" class="frmsaraban" value="ตกลง" /></TD>
	  </TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
<br />
</form>
<script language="JavaScript">
	function fncSum()
	{
		 if(isNaN(document.vsform.txtheight.value) || document.vsform.txtheight.value == "")
		 {
			//alert('(ส่วนสูง)Please input Number only.');
			document.vsform.txtNumberA.focus();
			return;
		 }

		 if(isNaN(document.vsform.txtweight.value) || document.vsform.txtweight.value == "")
		 {
			//alert('(น้ำหนัก)Please input Number only.');
			document.vsform.txtNumberB.focus();
			return;
		 }
		
		
		var high_m= parseFloat(document.vsform.txtheight.value)/100;
		var high_2=high_m*high_m;
		var bmi=parseFloat(document.vsform.txtweight.value)/high_2;
		//alert(bmi);
		var bmi=bmi.toFixed(2);
		document.vsform.txtbmi.value = bmi;
		document.vsform.txtbmi1.value = bmi;
	}
</script>
<script language="javascript">
function gettext( ){
	if(document.vsform.txtpulse.value ==""){ 
		document.vsform.txtsteptest1.value='';
	}else { 
		document.vsform.txtsteptest1.value=document.vsform.txtpulse.value;
	}
}
</script>

<script>
function checkfrm(){
	if(document.vsform.txtweight.value ==""){
		alert('กรุณากรอกข้อมูลน้ำหนัก');
		document.vsform.txtweight.focus();
		return false;
	}else if(document.vsform.txtheight.value ==""){
		alert('กรุณากรอกข้อมูลความสูง');
		document.vsform.txtheight.focus();
		return false;		
	}else if(document.vsform.txtwaist.value ==""){
		alert('กรุณากรอกข้อมูลรอบเอว');
		document.vsform.txtwaist.focus();
		return false;		
	}else if(document.vsform.txttemperature.value ==""){
		alert('กรุณากรอกข้อมูล TEMPERATURE');
		document.vsform.txttemperature.focus();
		return false;		
	}else if(document.vsform.txtpause.value ==""){
		alert('กรุณากรอกข้อมูล PAUSE');
		document.vsform.txtpause.focus();
		return false;		
	}else if(document.vsform.txtrate.value ==""){
		alert('กรุณากรอกข้อมูล RATE');
		document.vsform.txtrate.focus();
		return false;	
	}else if(document.vsform.txtbp1.value ==""){
		alert('กรุณากรอกข้อมูลความดันโลหิต BP1');
		document.vsform.txtbp1.focus();
		return false;
	}else if(document.vsform.txtbp2.value ==""){
		alert('กรุณากรอกข้อมูลความดันโลหิต BP1');
		document.vsform.txtbp2.focus();
		return false;		
	}else if(document.vsform.prawat.value ==""){
		alert('กรุณาเลือกข้อมูลประวัติโรคประจำตัว');
		document.vsform.prawat.focus();
		return false;						
	}else if(document.vsform.prawat.value =="6" && document.vsform.congenital_disease.value ==""){
		alert('กรุณากรอกข้อมูลโรคประจำตัว (โรคประจำตัวอื่นๆ)');
		document.vsform.congenital_disease.focus();
		return false;
	}else if(document.vsform.prawat.value !="0" && document.vsform.hospital.value ==""){
		alert('กรุณากรอกข้อมูลโรงพยาบาลที่รับการรักษา');
		document.vsform.congenital_disease.focus();
		return false;				
	}else if(document.vsform.drugreact1.checked == false && document.vsform.drugreact2.checked == false){
		alert('กรุณากรอกเลือกข้อมูลการแพ้ยา');
		document.vsform.drugreact1.focus();
		return false;																																		
	}else{
		return true;
	}
}
</script>
<?
if($_POST["act"]=="show"){
	if(!empty($_POST["p_hn"])){
		$sql="select * from  armychkup where hn='$_POST[p_hn]' and yearchkup='$nPrefix' order by row_id asc";
	}else if(!empty($_POST["p_id"])){
		$sql="select * from  armychkup where idcard='$_POST[p_id]' and yearchkup='$nPrefix' order by row_id asc";
	}else if(!empty($_POST["p_name"])){
		$sql="select * from  armychkup where ptname like '%$_POST[p_name]%' and yearchkup='$nPrefix' order by row_id asc";
	}else if(!empty($_POST["p_sname"])){
		$sql="select * from  armychkup where ptname like '%$_POST[p_sname]%' and yearchkup='$nPrefix' order by row_id asc";
	}else if(!empty($_POST["p_name"]) && !empty($_POST["p_sname"])){
		$sql="select * from  armychkup where (ptname like '%$_POST[p_name]%') || (ptname like '%$_POST[p_sname]%') and yearchkup='$nPrefix' order by row_id asc";
	}
	//echo $sql;
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	//echo $num;
	$rows=mysql_fetch_array($query);
	
		$chksql="select hn, dbirth, congenital_disease, drugreact from opcard where hn='".$rows["hn"]."'";
		//echo $chksql;
		$chkquery=mysql_query($chksql);
		$chknum=mysql_num_rows($chkquery);
		$chkrows=mysql_fetch_array($chkquery);
		if($chknum >0){
		list($yy,$mm,$dd)=explode("-",$chkrows["dbirth"]);
		$ys=$yy-543;
		$dbirth="$dd/$mm/$yy";
		$birthday="$ys-$mm-$dd";
		}
		
		$chksql1="select congenital_disease from opcard where hn='".$chkrows["hn"]."' and congenital_disease like '%HIV%'";
		//echo $chksql1;
		$chkquery1=mysql_query($chksql1);
		$num1=mysql_num_rows($chkquery1);
		if(!empty($num1)){
			$chkrows["congenital_disease"]=$chkrows["congenital_disease"]="ปฎิเสธ";
		}
		
		
			
	$camp=substr($rows["camp"],4);
	$chunyot=substr($rows["chunyot"],4);
	
	if($rows["gender"]=="1"){
		$gender="ชาย";
	}else if($rows["gender"]=="2"){
		$gender="หญิง";
	}else{
		$gender="ไม่ได้ระบุ";
	}

$sql1="select * from armychkup where hn='".$rows["hn"]."' and yearchkup='$nPrefix'";
//echo $sql1;
$query1=mysql_query($sql1);
$num1=mysql_num_rows($query1);
$arr_view=mysql_fetch_array($query1);
$prawat=$arr_view["prawat"];
$cigarette=$arr_view["cigarette"];
$alcohol=$arr_view["alcohol"];
$exercise=$arr_view["exercise"];
$diagtype=$arr_view["diagtype"];

?>
<form name="vsform" action="armychkupopd_out.php" method="post">
<? if($num1 < 1){ ?>
<input type="hidden" name="act" value="add">
<? }else{ ?>
<input type="hidden" name="act" value="edit">
<input name="row_id" type="hidden" value="<?=$arr_view["row_id"];?>">
<? } ?>
<table width="80%" border="1" align="center" cellpadding="3" cellspacing="0" bordercolor="#000000" bgcolor="#FFFFFF">
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" bgcolor="#FFCCCC">
      <tr>
        <td colspan="3" align="center" bgcolor="#FF6699"><strong>บันทึกผลตรวจสุขภาพทหารประจำปี <?=$nPrefix;?><input name="yearchkup" type="hidden" value="<?=$nPrefix?>"></strong></td>
      </tr>
      <tr>
        <td colspan="3" align="center" bgcolor="#FFFFFF">สังกัด
          <select name="camp" class="forntsarabun" id="camp">
            <option value="D01 รพ.ค่ายสุรศักดิ์มนตรี">รพ.ค่ายสุรศักดิ์มนตรี</option>
            <option value="D02 ศาล และ อก.ศาล มทบ.32">ศาล และ อก.ศาล มทบ.32</option>
            <option value="D03 ผปบ.มทบ.32">ผปบ.มทบ.32</option>
            <option value="D04 สง.สด.จว.ล.ป.">สง.สด.จว.ล.ป.</option>
            <option value="D05 กกบ.มทบ.32">กกบ.มทบ.32</option>
            <option value="D06 กยก.มทบ.32">กยก.มทบ.32</option>
            <option value="D07 กขว.มทบ.32">กขว.มทบ.32</option>
            <option value="D08 กกร.มทบ.32">กกร.มทบ.32</option>
            <option value="D09 ฝกง.มทบ.32">ฝกง.มทบ.32</option>
            <option value="D10 ฝสก.มทบ.32">ฝสก.มทบ.32</option>
            <option value="D11 ฝธน.มทบ.32">ฝธน.มทบ.32</option>
            <option value="D12 ฝสวส.มทบ.32">ฝสวส.มทบ.32</option>
            <option value="D13 บก.มทบ.32">บก.มทบ.32</option>
            <option value="D14 กกพ.มทบ.32">กกพ.มทบ.32</option>
            <option value="D15 ฝคง.มทบ.32">ฝคง.มทบ.32</option>
            <option value="D16 ฝอศจ.มทบ.32">ฝอศจ.มทบ.32</option>
            <option value="D17 ผพธ.มทบ.32">ผพธ.มทบ.32</option>
            <option value="D18 ฝสส.มทบ.32">ฝสส.มทบ.32</option>
            <option value="D19 มว.ส.มทบ.32">มว.ส.มทบ.32</option>
            <option value="D20 ผยย.มทบ.32">ผยย.มทบ.32</option>
            <option value="D21 กอง รจ.มทบ.32">กอง รจ.มทบ.32</option>
            <option value="D22 ร้อย.สห.มทบ.32">ร้อย.สห.มทบ.32</option>
            <option value="D23 ฝสห.มทบ.32">ฝสห.มทบ.32</option>
            <option value="D24 สขส.มทบ.32">สขส.มทบ.32</option>
            <option value="D25 สรรพกำลัง มทบ.32">สรรพกำลัง มทบ.32</option>
            <option value="D26 ร้อย.มทบ.32">ร้อย.มทบ.32</option>
            <option value="D27 ผสพ.มทบ.32">ผสพ.มทบ.32</option>
            <option value="D28 มว.ดย.มทบ.32">มว.ดย.มทบ.32</option>
            <option value="D29 ศฝ.นศท.มทบ.32">ศฝ.นศท.มทบ.32</option>
            <option value="D30 ร.17 พัน.2">ร.17 พัน.2</option>
            <option value="D31 ช.พัน.4 ร้อย4">ช.พัน.4 ร้อย4</option>
            <option value="D32 ร้อย.ฝรพ.3">ร้อย.ฝรพ.3</option>
            <option value="D34 กทพ.33">กทพ.33</option>
            <option value="D33 หน่วยทหารอื่นๆ">หน่วยทหารอื่นๆ</option>
          </select>
          <input name="dxptright" type="hidden" value="<?=$rows["dxptright"];?>"></td>
      </tr>
      <tr>
        <td colspan="3" align="left" bgcolor="#FFCC99"><strong>ข้อมูลเบื้องต้น</strong></td>
        </tr>
      <tr>
        <td width="14%"><strong>HN</strong></td>
        <td width="2%" align="center">:</td>
        <td width="84%"><input name="hn" type="text" value="<?=$_POST["p_hn"];?>"></td>
      </tr>
      <tr>
        <td><strong>ยศ-ชื่อ-นามสกุล</strong></td>
        <td align="center">:</td>
        <td><input name="yot" type="text" value="<?=$rows["yot"];?>" size="10">
          &nbsp;&nbsp;
          <input name="ptname" type="text" value="<?=$rows["ptname"];?>"></td>
      </tr>
      <tr>
        <td><strong>เลขที่บัตรประชาชน</strong></td>
        <td align="center">:</td>
        <td><input name="chkidcard" type="text" value="<?=$rows["idcard"];?>"></td>
      </tr>
      <tr>
        <td><strong>ชั้นยศ</strong></td>
        <td align="center">:</td>
        <td>
          <select name="chunyot" class="forntsarabun" id="chunyot">
            <option value="<?=$chunyot;?>">
            <?=substr($chunyot,5);?>
            </option>
            <option value="CH01 นายทหารชั้นสัญญาบัตร">นายทหารชั้นสัญญาบัตร</option>
            <option value="CH02 นายทหารชั้นประทวน">นายทหารชั้นประทวน</option>
            <option value="CH04 ลูกจ้างประจำ">ลูกจ้างประจำ</option>
          </select></td>
      </tr>
      <tr>
        <td><strong>เพศ</strong></td>
        <td align="center">:</td>
        <td>
          <input name="gender" type="radio" id="gender1" value="1" <? if($rows["gender"]==1){ echo "checked";}?>>
          ชาย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="radio" name="gender" id="gender2" value="2" <? if($rows["gender"]==2){ echo "checked";}?>>
          หญิง</td>
      </tr>
      <tr>
        <td><strong>ตำแหน่ง</strong></td>
        <td align="center">:</td>
        <td><input name="position" type="text" value="<?=$rows["position"];?>"></td>
      </tr>
      <tr>
        <td><strong>ช่วยราชการ (ถ้ามี)</strong></td>
        <td align="center">:</td>
        <td><input name="ratchakarn" type="text" value="<?=$rows["ratchakarn"];?>"></td>
      </tr>
      <tr>
        <td><strong>วัน/เดือน/ปี เกิด</strong></td>
        <td align="center">:</td>
        <td>
        <? if($num1 < 1){ ?>
        <input name="birthday" type="text" >
        <? }else{ ?>
        <input name="birthday" type="text" value="<?=$birthday;?>">
        <? } ?>
        (ตัวอย่าง 2017-01-01)</td>
      </tr>
      <tr>
        <td><strong>อายุ</strong></td>
        <td align="center">:</td>
        <td><input name="age" type="text" value="<?=$rows["age"];?>"></td>
      </tr>
      <tr>
        <td><strong>แพ้ยา</strong></td>
        <td align="center">:</td>
        <td style="color:#FF0000;"><input name="hospitaldrugreact" type="text" value="<?=$chkrows["drugreact"];?>"></td>
      </tr>
      <tr>
        <td colspan="3" bgcolor="#FFCC99"><strong>การตรวจร่างกาย</strong></td>
        </tr>
      <tr>
        <td><strong>น้ำหนัก</strong></td>
        <td align="center">:</td>
        <td><input name="txtweight" type="text" class="frmsaraban" id="txtweight" value="<?=$arr_view["weight"];?>" OnChange="fncSum();">
          &nbsp;กก.</td>
      </tr>
      <tr>
        <td><strong>ส่วนสูง</strong></td>
        <td align="center">:</td>
        <td><input name="txtheight" type="text" class="frmsaraban" id="txtheight" value="<?=$arr_view["height"];?>" OnChange="fncSum();">
          &nbsp;ซม.</td>
      </tr>
      <tr>
        <td><strong>BMI</strong></td>
        <td align="center">:</td>
        <td>
          <input name="txtbmi" type="text" class="frmsaraban" id="txtbmi" value="<?=$arr_view["bmi"];?>"></td>
      </tr>
      <tr>
        <td><strong>เส้นรอบเอว</strong></td>
        <td align="center">:</td>
        <td><input name="txtwaist" type="text" class="frmsaraban" id="txtwaist" value="<?=$arr_view["waist"];?>">
          &nbsp;นิ้ว</td>
      </tr>
      <tr>
        <td><strong>อุณหภูมิ (T)</strong></td>
        <td align="center">:</td>
        <td><input name="txttemperature" type="text" class="frmsaraban" id="txttemperature" value="<?=$arr_view["temperature"];?>"> 
          &nbsp;C</td>
      </tr>
      <tr>
        <td><strong>ชีพจร (P)</strong></td>
        <td align="center">:</td>
        <td><input name="txtpulse" type="text" class="frmsaraban" id="txtpulse" value="<?=$arr_view["pulse"];?>" onKeyUp="gettext( );">
&nbsp;ครั้ง/นาที</td>
      </tr>
      <tr>
        <td><strong>หายใจ (R)</strong></td>
        <td align="center">:</td>
        <td><input name="txtrate" type="text" class="frmsaraban" id="txtrate" value="<? if(empty($arr_view["rate"])){ echo "20";}else{ echo $arr_view["rate"];}?>">
&nbsp;ครั้ง/นาที</td>
      </tr>
      <tr>
        <td><strong>ความดันโลหิต 1</strong></td>
        <td align="center">:</td>
        <td><input name="txtbp1" type="text" class="frmsaraban" id="txtbp1" value="<?=$arr_view["bp1"];?>">
&nbsp;มม. ปรอท</td>
      </tr>
      <tr>
        <td><strong>ความดันโลหิต 2</strong></td>
        <td align="center">:</td>
        <td><input name="txtbp2" type="text" class="frmsaraban" id="txtbp2" value="<?=$arr_view["bp2"];?>">
&nbsp;มม. ปรอท</td>
      </tr>
<script type="text/javascript">
function showHide1(obj){
txt = obj.options[obj.selectedIndex].value;  //ค่าที่เลือก
var div = document.getElementById('prawat5').style;
	if(txt=='5'){
	div.visibility ='visible';
	div.display = 'block';
	}else{
	div.visibility ='hidden';
	div.display = 'none';
	}
}
</script>      
      <tr>
        <td><strong>ประวัติโรคประจำตัว</strong></td>
        <td align="center">:</td>
        <td><select name="prawat" class="frmsaraban" id="prawat" onChange="showHide1(this)">
          <option value='<? echo $prawat;?>' >
            <? if($prawat=="0"){ echo "ไม่มีโรคประจำตัว";}else if($prawat=="1"){ echo "ความดันโลหิตสูง";}else if($prawat=="2"){ echo "เบาหวาน";}else if($prawat=="3"){ echo "โรคหัวใจและหลอดเลือด";}else if($prawat=="4"){ echo "ไขมันในเลือดสูง";}else if($prawat=="5"){ echo "โรคที่กำหนดไว้ตั้งแต่ 2 โรคขึ้นไป";}else if($prawat=="6"){ echo "โรคประจำตัวอื่นๆ";}else if($prawat==""){ echo "----------- เลือก -----------";}?>
            </option>
          <option value="0">ไม่มีโรคประจำตัว</option>
          <option value="1">ความดันโลหิตสูง</option>
          <option value="2">เบาหวาน</option>
          <option value="3">โรคหัวใจและหลอดเลือด</option>
          <option value="4">ไขมันในเลือดสูง</option>
          <option value="5">โรคที่กำหนดไว้ตั้งแต่ 2 โรคขึ้นไป</option>
          <option value="6">โรคประจำตัวอื่นๆ</option>
        </select>
          &nbsp;
          <strong>โรคอื่นระบุ</strong> :
            <input name="congenital_disease" type="text" class="frmsaraban" id="congenital_disease" value="<?=$arr_view["congenital_disease"];?>" />          </td>
      </tr>    
      <tr>
        <td colspan="3">
          <div id="prawat5" <? if($prawat != "5"){ echo "style='display: none ;'"; } ?>>
          <strong>โรคที่กำหนดไว้ตั้งแต่ 2 โรคขึ้นไป</strong>&nbsp;&nbsp;&nbsp;
            <input name='prawat_ht' type='checkbox' class="frmsaraban" id="prawat_ht" value='1' <?php if($arr_view["prawat_ht"]==1){ echo "checked"; } ?> />
            ความดันโลหิตสูง
            <input name='prawat_dm' type='checkbox' class="frmsaraban" id="prawat_dm" value='1' <?php if($arr_view["prawat_dm"]==1){ echo "checked"; } ?> />
            เบาหวาน
  <input name='prawat_cad' type='checkbox' class="frmsaraban" id="prawat_cad" value='1' <?php if($arr_view["prawat_cad"]==1){ echo "checked"; } ?> />
            โรคหัวใจและหลอดเลือด
  <input name='prawat_dlp' type='checkbox' class="frmsaraban" id="prawat_dlp" value='1' <?php if($arr_view["prawat_dlp"]==1){ echo "checked"; } ?> />
            ไขมันในเลือดสูง		</div></td>
        </tr>
      <tr>
        <td><strong>ประวัติการแพ้ยา</strong></td>
        <td align="center">:</td>
        <td><input name="drugreact" type="radio" class="frmsaraban" id="drugreact1" value="0" <? if($arr_view["drugreact"]=="0"){ echo "checked='checked'";}?> />
ไม่แพ้
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="drugreact" type="radio" class="frmsaraban" id="drugreact2" value="1" <? if($arr_view["drugreact"]=="1"){ echo "checked='checked'";}?> />
แพ้ <font color="#FF0000"><?php echo $chkrows["drugreact"];?></font></span></td>
      </tr>
      <tr>
        <td><strong>การสูบบุหรี่</strong></td>
        <td align="center">:</td>
        <td><input name="cigarette" type="radio" class="frmsaraban" value="0" <?php if($cigarette==0){ echo "checked"; } ?> />
ไม่เคยสูบ&nbsp;&nbsp;&nbsp;
<input name="cigarette" type="radio" class="frmsaraban" value="1" <?php if($cigarette==1){ echo "checked"; } ?> />
เคยสูบ แต่เลิกแล้ว
&nbsp;&nbsp;&nbsp;
<input name="cigarette" type="radio" class="frmsaraban" value="2" <?php if($cigarette==2){ echo "checked"; } ?> />
		    สูบบุหรี่ เป็นครั้งคราว
&nbsp;&nbsp;&nbsp;
<input name="cigarette" type="radio" class="frmsaraban" value="3" <?php if($cigarette==3){ echo "checked"; } ?> />
สูบบุหรี่ เป็นประจำ</td>
      </tr>
      <tr>
        <td><strong>การดื่มสุรา</strong></td>
        <td align="center">:</td>
        <td><input name="alcohol" type="radio" class="frmsaraban" value="0" <?php if($alcohol==0){ echo "checked"; } ?> />
ไม่เคยดื่ม&nbsp;&nbsp;&nbsp;
<input name="alcohol" type="radio" class="frmsaraban" value="1" <?php if($alcohol==1){ echo "checked"; } ?> />
เคยดื่ม แต่เลิกแล้ว&nbsp;&nbsp;
 &nbsp;
 <input name="alcohol" type="radio" class="frmsaraban" value="2" <?php if($alcohol==2){ echo "checked"; } ?> />
		    ดื่ม เป็นครั้งคราว&nbsp;&nbsp;&nbsp;
 &nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <input name="alcohol" type="radio" class="frmsaraban" value="3" <?php if($alcohol==3){ echo "checked"; } ?> />
ดื่ม เป็นประจำ</td>
      </tr>
      <tr>
        <td><strong>การออกกำลังกาย</strong></td>
        <td align="center">:</td>
        <td><input name="exercise" type="radio" class="frmsaraban" value="0" <?php if($exercise==0){ echo "checked"; } ?> />
		    ไม่ออกกำลังกาย&nbsp;&nbsp;&nbsp;
		    <input name="exercise" type="radio" class="frmsaraban" value="1" <?php if($exercise==1){ echo "checked"; } ?> />
		    น้อยกว่า 3 ครั้งต่อ 1 สัปดาห์
		    &nbsp;&nbsp;&nbsp;
            <input name="exercise" type="radio" class="frmsaraban" value="2" <?php if($exercise==2){ echo "checked"; } ?> /> 
            3 ครั้งต่อ 1 สัปดาห์ขึ้นไป</td>
      </tr>
<?
//if($sIdname=="thaywin"){

	$sqllabdate = "Select date_format(a.orderdate,'%d/%m/%Y') From resulthead as a where a.hn='".$rows["hn"]."'  AND (clinicalinfo = 'ตรวจสุขภาพประจำปี$nPrefix')  Order by a.autonumber DESC limit 0,1";
	//echo $sqllabdate;
	list($lab_date) = mysql_fetch_row(mysql_query($sqllabdate));
	

	$sqlua = "Select labcode, result, unit,normalrange,flag  From resulthead as a , resultdetail as b  where a.hn='".$rows["hn"]."' AND a.autonumber = b.autonumber AND parentcode = 'UA' AND (clinicalinfo = 'ตรวจสุขภาพประจำปี$nPrefix' ) Order by labcode ASC ";
	//echo $sqlua;
	$result_ua = mysql_query($sqlua);

	$sqlcbc = "Select labcode, result, unit,normalrange,flag From resulthead as a , resultdetail as b  where a.hn='".$rows["hn"]."' AND a.autonumber = b.autonumber AND parentcode = 'CBC' AND (clinicalinfo = 'ตรวจสุขภาพประจำปี$nPrefix') Order by labcode ASC";
	//echo $sqlcbc;
	$result_cbc = mysql_query($sqlcbc);
?>      
      <tr>
        <td colspan="3" bgcolor="#FFCC99"><strong>ผลการตรวจทางพยาธิ</strong></td>
        </tr>
      <tr>
        <td colspan="3">
<!-- ผลการตรวจทางพยาธิ -->
<TABLE width="100%" border="1" align="center" cellpadding="1" cellspacing="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF" >
<TR>
	<TD>
	<TABLE width="100%" border="0" cellpadding="0" cellspacing="0">
	<TR>
      <TD align="right" bgcolor="#FFFFCC">&nbsp;&nbsp; <span class="style5"><strong>ผล CBC :</strong></span></TD>
	  <TD align="left" bgcolor="#FFFFCC"><span class="labfont">
        <input name='cbc_lab' type='radio' value='ปกติ' <?php if($arr_view["cbc_lab"]=="ปกติ"){ echo "checked"; } ?>/>
	    ปกติ
	    <input name='cbc_lab' type='radio' value='ผิดปกติ' <?php if($arr_view["cbc_lab"]=="ผิดปกติ"){ echo "checked"; } ?>/>
	    ผิดปกติ </span></TD>
	  </TR>
	<TR>
		<TD width="13%" align="right" bgcolor="#FFFFCC">&nbsp;&nbsp; <span class="style5"><strong>ผล UA :</strong></span></TD>
	    <TD width="87%" align="left" bgcolor="#FFFFCC"><span class="labfont">
	      <input name='ua_lab' type='radio' value='ปกติ' <?php if($arr_view["ua_lab"]=="ปกติ"){ echo "checked"; } ?>/>
ปกติ
<input name='ua_lab' type='radio' value='ผิดปกติ' <?php if($arr_view["ua_lab"]=="ผิดปกติ"){ echo "checked"; } ?>/>
ผิดปกติ </span></TD>
	</TR>
	<TR class="tb_font">
		<TD colspan="2" bgcolor="#FFCCCC"><table width="100%" border="0" cellpadding="0" cellspacing="0">
</table>	  </TD>
	</TR>   
	</TABLE>	</TD>
</TR>
</TABLE>        </td>
        </tr>
      <!--เริ่ม LAB อายุมากกว่าหรือเท่ากับ 35 ปี-->
      <tr>
        <td colspan="3">
<table border="1" cellpadding="1" cellspacing="0" bordercolor="#FFFFFF"  width="100%" bgcolor="#FFCCCC">
  <tr><td>
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">
	    <tr>
	      <td colspan="3" align="left" bgcolor="#FFFFCC" class="tb_font_2"><strong>ผล LAB เฉพาะผู้ที่มีอายุมากกว่า 35 ปี</strong></td>
	      </tr>    
	    <tr>
	      <td align="center" valign="middle" bordercolor="#FFFFFF" bgcolor="#33CCCC" class="text3"><strong>LAB ที่ตรวจ</strong></td>
	      <td align="left" bgcolor="#33CCCC" class="labfontlab"><strong>ผลตรวจ</strong></td>
	      <td bgcolor="#33CCCC" class="style1">สรุปผล</td>
	      </tr>
	    <tr>
	      <td width="28%" align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>GLU(เบาหวาน) :</strong></td>
	      <td align="left" bgcolor="#FFFFFF" class="labfontlab"><input type="text" name="glu_result" id="glu_result"></td>
	      <td bgcolor="#FFFFFF" class="labfont"><input name='glu_lab' type='radio' value='ปกติ' <?  if($resultlab >= 74 && $resultlab <= 106){ echo "checked";}?>/>
ปกติ
  		<input name='glu_lab' type='radio' value='ผิดปกติ' <? if(!empty($resultlab) && $resultlab < 74 || $resultlab > 106){ echo "checked";}?>/>
  		ผิดปกติ</td>
	    </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='CHOL' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='CHOL' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='CHOL' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];
?>          
	    <tr>
	      <td align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>CHOL(การตรวจไขมัน) :</strong></td>
	      <td align="left" bgcolor="#FFFFFF" class="labfontlab"><label>
	        <input type="text" name="chol_result" id="chol_result">
	      </label></td>
	      <td bgcolor="#FFFFFF" class="labfont"><input name='chol_lab' type='radio' value='ปกติ' <? if(!empty($resultlab) && $resultlab <= 200){ echo "checked";}?> />
ปกติ
  <input name='chol_lab' type='radio' value='ผิดปกติ' <? if($resultlab > 200){ echo "checked";}?>/>
  ผิดปกติ</td>
	    </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='TRIG' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='TRIG' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='TRIG' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];
?>       
	    <tr>
	      <td align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>TRIG(การตรวจไขมัน) :</strong></td>
	      <td align="left" bgcolor="#FFFFFF" class="labfontlab"><label>
	        <input type="text" name="trig_result" id="trig_result">
	      </label></td>
	      <td bgcolor="#FFFFFF" class="labfont"><input name='trig_lab' type='radio' value='ปกติ' <? if(!empty($resultlab) && $resultlab <= 150){ echo "checked";}?> />
ปกติ
  <input name='trig_lab' type='radio' value='ผิดปกติ'  <? if($resultlab > 150){ echo "checked";}?>/>
  ผิดปกติ</td>
	    </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='HDL' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='HDL' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='HDL' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];

?>         
	  <tr>
	    <td align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>HDL(การตรวจไขมันดี) :</strong></td>
	    <td align="left" bgcolor="#FFFFFF" class="labfontlab"><label>
	      <input type="text" name="hdl_result" id="hdl_result">
	    </label></td>
	    <td bgcolor="#FFFFFF" class="labfont"><input name='hdl_lab' type='radio' value='ปกติ' <? if($resultlab >= 40 && $resultlab <= 60){ echo "checked";}?>/>
	      ปกติ
	      <input name='hdl_lab' type='radio' value='ผิดปกติ' <? if(!empty($resultlab) && $resultlab < 40 || $resultlab > 60){ echo "checked";}?>/>
	      ผิดปกติ</td>
	  </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='10001' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='10001' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='10001' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];

?>       
	  <tr>
	    <td align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>LDL(การตรวจไขมันเลว) :</strong></td>
	    <td align="left" bgcolor="#FFFFFF" class="labfontlab"><label>
	      <input type="text" name="ldl_result" id="ldl_result">
	    </label></td>
	    <td bgcolor="#FFFFFF" class="labfont"><input name='ldl_lab' type='radio' value='ปกติ' <? if(!empty($resultlab) && $resultlab <= 100){ echo "checked";}?> />
	      ปกติ
	      <input name='ldl_lab' type='radio' value='ผิดปกติ' <? if($resultlab > 100){ echo "checked";}?>/>
	      ผิดปกติ</td>
	  </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='BUN' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='BUN' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='BUN' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];
?>        
	    <tr>
	      <td align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>BUN(การทำงานของไต) :</strong></td>
	      <td align="left" bgcolor="#FFFFFF" class="labfontlab"><label>
	        <input type="text" name="bun_result" id="bun_result">
	      </label></td>
	      <td bgcolor="#FFFFFF" class="labfont"><input name='bun_lab' type='radio' value='ปกติ' <? if($resultlab >= 7 && $resultlab <= 18){ echo "checked";}?>/>
ปกติ
  <input name='bun_lab' type='radio' value='ผิดปกติ' <? if(!empty($resultlab) && $resultlab < 7 || $resultlab > 18){ echo "checked";}?>/>
  ผิดปกติ</td>
	    </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='CREA' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='CREA' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='CREA' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];
?>        
	    <tr>
	      <td align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>CREA(การทำงานของไต) :</strong></td>
	      <td align="left" bgcolor="#FFFFFF" class="labfontlab"><label>
	        <input type="text" name="crea_result" id="crea_result">
	      </label></td>
	      <td bgcolor="#FFFFFF" class="labfont"><input name='crea_lab' type='radio' value='ปกติ' <? if($resultlab >= 0.6 && $resultlab <= 1.3){ echo "checked";}?> />
ปกติ
  <input name='crea_lab' type='radio' value='ผิดปกติ' <? if(!empty($result['cr']) && $resultlab < 0.6 || $resultlab > 1.3){ echo "checked";}?>/>
  ผิดปกติ</td>
	    </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='ALP' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='ALP' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='ALP' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];

?>        
	    <tr>
	      <td align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>ALP(ตับ,กระดูก) :</strong></td>
          <td width="22%" align="left" bgcolor="#FFFFFF" class="labfontlab"><label>
            <input type="text" name="alp_result" id="alp_result">
          </label></td>
          <td width="50%" bgcolor="#FFFFFF" class="labfont"><input name='alp_lab' type='radio' value='ปกติ' <? if($resultlab >= 46 && $resultlab <= 116){ echo "checked";}?>/>
			ปกติ 
			  <input name='alp_lab' type='radio' value='ผิดปกติ' <? if(!empty($resultlab) && $resultlab < 46 || $resultlab > 116){ echo "checked";}?>/>
			  ผิดปกติ</td>
            </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='ALT' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='ALT' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='ALT' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];

?>            
	  <tr>
	    <td align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>ALT(การทำงานของตับ) :</strong></td>
	    <td align="left" bgcolor="#FFFFFF" class="labfontlab"><label>
	      <input type="text" name="alt_result" id="alt_result">
	    </label></td>
	    <td bgcolor="#FFFFFF" class="labfont"><input name='alt_lab' type='radio' value='ปกติ' <? if($resultlab > 0 && $resultlab <= 50){ echo "checked";}?>/>
ปกติ
  <input name='alt_lab' type='radio' value='ผิดปกติ' <? if($resultlab > 50){ echo "checked";}?>/>
  ผิดปกติ</td>
	    </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='AST' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='AST' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='AST' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];

?>          
	  <tr>
	    <td align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>AST(การทำงานของตับ) :</strong></td>
	    <td align="left" bgcolor="#FFFFFF" class="labfontlab"><label>
	      <input type="text" name="ast_result" id="ast_result">
	    </label></td>
	    <td bgcolor="#FFFFFF" class="labfont"><input name='ast_lab' type='radio' value='ปกติ' <? if($resultlab >= 15 && $resultlab <= 37){ echo "checked";}?>/>
ปกติ
  <input name='ast_lab' type='radio' value='ผิดปกติ' <? if(!empty($resultlab) && ($resultlab < 15 || $resultlab > 37)){ echo "checked";}?>/>
  ผิดปกติ</td>
	    </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='URIC' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='URIC' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.profilecode='URIC' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];

?>        
	  <tr>
	    <td align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>URIC(โรคเก๊าท์) :</strong></td>
	    <td align="left" bgcolor="#FFFFFF" class="labfontlab"><label>
	      <input type="text" name="uric_result" id="uric_result">
	    </label></td>
	    <td bgcolor="#FFFFFF" class="labfont"><input name='uric_lab' type='radio' value='ปกติ' <? if($resultlab >= 2.6 && $resultlab <= 7.2){ echo "checked";}?>/>
ปกติ
  <input name='uric_lab' type='radio' value='ผิดปกติ' <? if(!empty($resultlab) && ($resultlab < 2.6 || $resultlab > 7.2)){ echo "checked";}?>/>
  ผิดปกติ</td>
	    </tr>
            </table>
        </TD>
	</TR>
	</TABLE>
    <br>
        </td>
        </tr>
      <!--จบ อายุมากกว่าหรือเท่ากับ 35 ปี-->   
<? //} //ปิดเช็ค thaywin?>
      <tr>
        <td colspan="3" bgcolor="#FFCC99"><strong>สรุปเบื้องต้น</strong> <? if($result['bmi'] >=35.0 && $result['bmi'] <=39.9){
			echo "อ้วนมาก";}else if($arr_view['bmi'] >=40.0){
			echo "โรคอ้วน";
		} ?></td>
        </tr>
      <tr>
        <td colspan="3"><input name='resultdiagnormal' type='checkbox' value='1' id="resultdiagnormal" <?php if($arr_view["resultdiag_normal"]==1){ echo "checked"; } ?>/>        
          ไม่พบความเสี่ยงต่อโรค NCDs</td>
        </tr>
      <tr>
        <td colspan="3"><input name='resultdiagrisk' type='checkbox' value='1' id="resultdiagrisk" <?php if($arr_view["resultdiag_risk"]==1){ echo "checked"; } ?>/>
  พบความเสี่ยงเบื้องต้นต่อโรค&nbsp;&nbsp;
&nbsp;&nbsp;
<input name='risk_dm' type='checkbox' class="frmsaraban" id="risk_dm" value='1' <?php if($arr_view["risk_dm"]==1){ echo "checked"; } ?> />
DM(เบาหวาน)
<input name='risk_ht' type='checkbox' class="frmsaraban" id="risk_ht" value='1' <?php if($arr_view["risk_ht"]==1){ echo "checked"; } ?> />
HT(ความดันโลหิตสูง)
<input name='risk_dlp' type='checkbox' class="frmsaraban" id="risk_dlp" value='1' <?php if($arr_view["risk_dlp"]==1){ echo "checked"; } ?> />
DLP(ไขมันในเลือดสูง)
<input name='risk_storke' type='checkbox' class="frmsaraban" id="risk_storke" value='1' <?php if($arr_view["risk_storke"]==1){ echo "checked"; } ?> />
Stroke

<input name='risk_obesity' type='checkbox' class="frmsaraban" id="risk_obesity" value='1' <?php if($arr_view["risk_obesity"]==1){ echo "checked"; } ?> />
Obesity</td>
        </tr>
      <tr>
        <td colspan="3"><input name='resultdiagdiseases' type='checkbox' value='1' id="resultdiagdiseases" <?php if($arr_view["resultdiag_diseases"]==1){ echo "checked"; } ?>/>
  ป่วยด้วยโรคเรื้อรัง&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;
          <input name='diseases_dm' type='checkbox' class="frmsaraban" id="diseases_dm" value='1' <?php if($arr_view["diseases_dm"]==1){ echo "checked"; } ?> />
          DM(เบาหวาน)
          <input name='diseases_ht' type='checkbox' class="frmsaraban" id="diseases_ht" value='1' <?php if($arr_view["diseases_ht"]==1){ echo "checked"; } ?> />
          HT(ความดันโลหิตสูง)
          <input name='diseases_dlp' type='checkbox' class="frmsaraban" id="diseases_dlp" value='1' <?php if($arr_view["diseases_dlp"]==1){ echo "checked"; } ?> />
          DLP(ไขมันในเลือดสูง)
          <input name='diseases_stroke' type='checkbox' class="frmsaraban" id="diseases_stroke" value='1' <?php if($arr_view["diseases_stroke"]==1){ echo "checked"; } ?> />
          Stroke
          <input name='diseases_obesity' type='checkbox' class="frmsaraban" id="diseases_obesity" value='1' <?php if($arr_view["diseases_obesity"]==1){ echo "checked"; } ?> />
Obesity</td>
        </tr>
      <tr height="50">
        <td height="52" colspan="3" align="center" bgcolor="#FF6699">
<? if($num1 < 1){ ?>
<input name="Submit" type="submit" class="frmsaraban" value="บันทึกข้อมูล" onClick="return checkfrm()" />
<? }else{ ?>
<input name="Submit" type="submit" class="frmsaraban" value="แก้ไขข้อมูล" onClick="return checkfrm()" />
<? } ?>        </td>
        </tr>
      
    </table></td>
  </tr>
</table>
</form>
<? } ?>
<?
if($_POST["act"]=="add"){
$datekey=date("Y-m-d H:i:s");
$officer=$_SESSION["sOfficer"];
if($_POST["hospital"]==""){
$_POST["hospital"]=$_POST["hospital_other"];
}
	$add="insert into armychkup set registerdate='$datekey',
													 hn='$_POST[hn]',
													 yot='$_POST[yot]',
													 ptname='$_POST[ptname]',
													 idcard='$_POST[chkidcard]',
													 camp='$_POST[camp]',
													 position='$_POST[position]',
													 ratchakarn='$_POST[ratchakarn]',
													 chunyot='$_POST[chunyot]',
													 gender='$_POST[gender]',
													 birthday='$_POST[birthday]',
													 age='$_POST[age]',
													 dxptright='$_POST[dxptright]',
													 hospitalcongenital_disease='$_POST[hospitalcongenital_disease]',
													 hospitaldrugreact='$_POST[hospitaldrugreact]',
													 weight='$_POST[txtweight]',
													 height='$_POST[txtheight]',
													 bmi='$_POST[txtbmi]',
													 waist='$_POST[txtwaist]',
													 temperature='$_POST[txttemperature]',
													 pulse='$_POST[txtpulse]',
													 rate='$_POST[txtrate]',
													 bp1='$_POST[txtbp1]',
													 bp2='$_POST[txtbp2]',
													 prawat='$_POST[prawat]',
													 prawat_ht='$_POST[prawat_ht]',
													 prawat_dm='$_POST[prawat_dm]',
													 prawat_cad='$_POST[prawat_cad]',
													 prawat_dlp='$_POST[prawat_dlp]',
													 congenital_disease='$_POST[congenital_disease]',
													 hospital='$_POST[hospital]',
													 diagtype='$_POST[diagtype]',
													 drugreact='$_POST[drugreact]',
													 cigarette='$_POST[cigarette]',
													 alcohol='$_POST[alcohol]',
													 exercise='$_POST[exercise]',
													 bmr='$_POST[txtbmr]',
													 tbw='$_POST[txttbw]',
													 fat='$_POST[txtfat]',
													 fat_mass='$_POST[txtfatmass]',
													 visceral_fat='$_POST[txtvisceralfat]',
													 muscle_mass='$_POST[txtmusclemass]',
													 vfa_level='$_POST[txtvfalevel]',
													 result_fat='$_POST[resultfat]',
													 hand1='$_POST[txthand1]',
													 hand2='$_POST[txthand2]',
													 result_hand='$_POST[resulthand]',
													 leg1='$_POST[txtleg1]',
													 leg2='$_POST[txtleg2]',
													 result_leg='$_POST[resultleg]',	
													 steptest1='$_POST[txtsteptest1]',
													 steptest2='$_POST[txtsteptest2]',
													 steptest3='$_POST[txtsteptest3]',
													 result_steptest='$_POST[resultsteptest]',
													 
													 pressure_test='$_POST[txtpressure]',
													 pressure_result='$_POST[pressure_result]',
													 situp_test='$_POST[txtsitup]',
													 situp_result='$_POST[situp_result]',
													 run_test='$_POST[txtrun]',
													 run_result='$_POST[run_result]',
													 
													 xray='$_POST[xray]',
													 xray_detail='$_POST[xraydetail]',														 												 													 result_dental='$_POST[resultdental]',
													 dental_disease1='$_POST[dental_disease1]',
													 dental_disease2='$_POST[dental_disease2]',
													 dental_disease3='$_POST[dental_disease3]',	
													 gum_disease1='$_POST[gum_disease1]',
													 gum_disease2='$_POST[gum_disease2]',
													 ua_lab='$_POST[ua_lab]',
													 cbc_lab='$_POST[cbc_lab]',
													 glu_result='$_POST[glu_result]',
													 glu_flag='$_POST[glu_flag]',
													 glu_lab='$_POST[glu_lab]',
													 chol_result='$_POST[chol_result]',
													 chol_flag='$_POST[chol_flag]',
													 chol_lab='$_POST[chol_lab]',
													 trig_result='$_POST[trig_result]',
													 trig_flag='$_POST[trig_flag]',
													 trig_lab='$_POST[trig_lab]',
													 hdl_result='$_POST[hdl_result]',
													 hdl_flag='$_POST[hdl_flag]',
													 hdl_lab='$_POST[hdl_lab]',
													 ldl_result='$_POST[ldl_result]',
													 ldl_flag='$_POST[ldl_flag]',
													 ldl_lab='$_POST[ldl_lab]',
													 bun_result='$_POST[bun_result]',
													 bun_flag='$_POST[bun_flag]',
													 bun_lab='$_POST[bun_lab]',
													 crea_result='$_POST[crea_result]',
													 crea_flag='$_POST[crea_flag]',
													 crea_lab='$_POST[crea_lab]',
													 alp_result='$_POST[alp_result]',
													 alp_flag='$_POST[alp_flag]',
													 alp_lab='$_POST[alp_lab]',
													 alt_result='$_POST[alt_result]',
													 alt_flag='$_POST[alt_flag]',
													 alt_lab='$_POST[alt_lab]',
													 ast_result='$_POST[ast_result]',
													 ast_flag='$_POST[ast_flag]',
													 ast_lab='$_POST[ast_lab]',
													 uric_result='$_POST[uric_result]',
													 uric_flag='$_POST[uric_flag]',
													 uric_lab='$_POST[uric_lab]',
													 health_risk='$_POST[health_risk]',
													 accident_risk='$_POST[accident_risk]',
													 addictive_risk='$_POST[addictive_risk]',
													 score_stress='$_POST[score_stress]',
													 result_stress='$_POST[result_stress]',											 
													 diabetes_risk='$_POST[diabetes_risk]',
													 kidney_risk='$_POST[kidney_risk]',
													 tb_risk='$_POST[tb_risk]',
													 heart_risk='$_POST[heart_risk]',
													 cancer_risk='$_POST[cancer_risk]',
													 hiv_risk='$_POST[hiv_risk]',
													 liver_risk='$_POST[liver_risk]',
													 stroke_risk='$_POST[stroke_risk]',
													 gout_risk='$_POST[gout_risk]',
													 knee_risk='$_POST[knee_risk]',
													 bone_risk='$_POST[bone_risk]',														 													
													 resultdiag_normal='$_POST[resultdiagnormal]',
													 resultdiag_risk='$_POST[resultdiagrisk]',
													 risk_dm='$_POST[risk_dm]',
													 risk_ht='$_POST[risk_ht]',
													 risk_dlp='$_POST[risk_dlp]',
													 risk_stroke='$_POST[risk_stroke]',
													 risk_obesity='$_POST[risk_obesity]',
													 resultdiag_diseases='$_POST[resultdiagdiseases]',
													 diseases_dm='$_POST[diseases_dm]',
													 diseases_ht='$_POST[diseases_ht]',
													 diseases_dlp='$_POST[diseases_dlp]',
													 diseases_stroke='$_POST[diseases_stroke]',
													 diseases_obesity='$_POST[diseases_obesity]',
													 register_officer='$officer',
													 yearchkup='$_POST[yearchkup]',
													 typechkup='out'";
													//echo $add;
	if(mysql_query($add)){
		echo "<script>alert('บันทึกข้อมูลเรียบร้อย');window.location='armychkupopd_out.php';</script>";
	}else{
		echo "<script>alert('ผิดพลาด บันทึกข้อมูลไม่สำเร็จ');window.location='armychkupopd_out.php';</script>";
	}													 
}

if($_POST["act"]=="edit"){
$lastupdate=date("Y-m-d H:i:s");
$officer=$_SESSION["sOfficer"];
if($_POST["hospital"]==""){
$_POST["hospital"]=$_POST["hospital_other"];
}
	$edit="update armychkup set yot='$_POST[yot]',
													 ptname='$_POST[ptname]',
													 idcard='$_POST[chkidcard]',
													 camp='$_POST[camp]',
													 position='$_POST[position]',
													 ratchakarn='$_POST[ratchakarn]',
													 chunyot='$_POST[chunyot]',
													 gender='$_POST[gender]',
													 birthday='$_POST[birthday]',
													 age='$_POST[age]',
													 dxptright='$_POST[dxptright]',
													hospitalcongenital_disease='$_POST[hospitalcongenital_disease]',
													 hospitaldrugreact='$_POST[hospitaldrugreact]',
													 weight='$_POST[txtweight]',
													 height='$_POST[txtheight]',
													 bmi='$_POST[txtbmi]',
													 waist='$_POST[txtwaist]',
													 temperature='$_POST[txttemperature]',
													 pulse='$_POST[txtpulse]',
													 rate='$_POST[txtrate]',
													 bp1='$_POST[txtbp1]',
													 bp2='$_POST[txtbp2]',
													 prawat='$_POST[prawat]',
													 prawat_ht='$_POST[prawat_ht]',
													 prawat_dm='$_POST[prawat_dm]',
													 prawat_cad='$_POST[prawat_cad]',
													 prawat_dlp='$_POST[prawat_dlp]',													 
													 congenital_disease='$_POST[congenital_disease]',
													 hospital='$_POST[hospital]',
													 diagtype='$_POST[diagtype]',
													 drugreact='$_POST[drugreact]',
													 cigarette='$_POST[cigarette]',
													 alcohol='$_POST[alcohol]',
													 exercise='$_POST[exercise]',
													 bmr='$_POST[txtbmr]',
													 tbw='$_POST[txttbw]',
													 fat='$_POST[txtfat]',
													 fat_mass='$_POST[txtfatmass]',
													 visceral_fat='$_POST[txtvisceralfat]',
													 muscle_mass='$_POST[txtmusclemass]',
													 vfa_level='$_POST[txtvfalevel]',
													 result_fat='$_POST[resultfat]',
													 hand1='$_POST[txthand1]',
													 hand2='$_POST[txthand2]',
													 result_hand='$_POST[resulthand]',
													 leg1='$_POST[txtleg1]',
													 leg2='$_POST[txtleg2]',
													 result_leg='$_POST[resultleg]',	
													 steptest1='$_POST[txtsteptest1]',
													 steptest2='$_POST[txtsteptest2]',
													 steptest3='$_POST[txtsteptest3]',
													 result_steptest='$_POST[resultsteptest]',
													 
													 pressure_test='$_POST[txtpressure]',
													 pressure_result='$_POST[pressure_result]',
													 situp_test='$_POST[txtsitup]',
													 situp_result='$_POST[situp_result]',
													 run_test='$_POST[txtrun]',
													 run_result='$_POST[run_result]',													 
													 
													 xray='$_POST[xray]',
													 xray_detail='$_POST[xraydetail]',
													 result_dental='$_POST[resultdental]',																				
													 dental_disease1='$_POST[dental_disease1]',
													 dental_disease2='$_POST[dental_disease2]',
													 dental_disease3='$_POST[dental_disease3]',	
													 gum_disease1='$_POST[gum_disease1]',
													 gum_disease2='$_POST[gum_disease2]',
													 ua_lab='$_POST[ua_lab]',
													 cbc_lab='$_POST[cbc_lab]',
													 glu_result='$_POST[glu_result]',
													 glu_flag='$_POST[glu_flag]',
													 glu_lab='$_POST[glu_lab]',
													 chol_result='$_POST[chol_result]',
													 chol_flag='$_POST[chol_flag]',
													 chol_lab='$_POST[chol_lab]',
													 trig_result='$_POST[trig_result]',
													 trig_flag='$_POST[trig_flag]',
													 trig_lab='$_POST[trig_lab]',
													 hdl_result='$_POST[hdl_result]',
													 hdl_flag='$_POST[hdl_flag]',
													 hdl_lab='$_POST[hdl_lab]',
													 ldl_result='$_POST[ldl_result]',
													 ldl_flag='$_POST[ldl_flag]',
													 ldl_lab='$_POST[ldl_lab]',
													 bun_result='$_POST[bun_result]',
													 bun_flag='$_POST[bun_flag]',
													 bun_lab='$_POST[bun_lab]',
													 crea_result='$_POST[crea_result]',
													 crea_flag='$_POST[crea_flag]',
													 crea_lab='$_POST[crea_lab]',
													 alp_result='$_POST[alp_result]',
													 alp_flag='$_POST[alp_flag]',
													 alp_lab='$_POST[alp_lab]',
													 alt_result='$_POST[alt_result]',
													 alt_flag='$_POST[alt_flag]',
													 alt_lab='$_POST[alt_lab]',
													 ast_result='$_POST[ast_result]',
													 ast_flag='$_POST[ast_flag]',
													 ast_lab='$_POST[ast_lab]',
													 uric_result='$_POST[uric_result]',
													 uric_flag='$_POST[uric_flag]',
													 uric_lab='$_POST[uric_lab]',
													 health_risk='$_POST[health_risk]',
													 accident_risk='$_POST[accident_risk]',
													 addictive_risk='$_POST[addictive_risk]',
													 score_stress='$_POST[score_stress]',
													 result_stress='$_POST[result_stress]',	
													 diabetes_risk='$_POST[diabetes_risk]',
													 kidney_risk='$_POST[kidney_risk]',
													 tb_risk='$_POST[tb_risk]',
													 heart_risk='$_POST[heart_risk]',
													 cancer_risk='$_POST[cancer_risk]',
													 hiv_risk='$_POST[hiv_risk]',
													 liver_risk='$_POST[liver_risk]',
													 stroke_risk='$_POST[stroke_risk]',
													 gout_risk='$_POST[gout_risk]',
													 knee_risk='$_POST[knee_risk]',
													 bone_risk='$_POST[bone_risk]',															 												 
													 resultdiag_normal='$_POST[resultdiagnormal]',
													 resultdiag_risk='$_POST[resultdiagrisk]',
													 risk_dm='$_POST[risk_dm]',
													 risk_ht='$_POST[risk_ht]',
													 risk_dlp='$_POST[risk_dlp]',
													 risk_stroke='$_POST[risk_stroke]',
													 risk_obesity='$_POST[risk_obesity]',
													 resultdiag_diseases='$_POST[resultdiagdiseases]',
													 diseases_dm='$_POST[diseases_dm]',
													 diseases_ht='$_POST[diseases_ht]',
													 diseases_dlp='$_POST[diseases_dlp]',
													 diseases_stroke='$_POST[diseases_stroke]',
													 diseases_obesity='$_POST[diseases_obesity]',
													 lastupdate='$lastupdate',
													 lastupdate_officer='$officer',
													 typechkup='out' where row_id='$_POST[row_id]'";
													 //echo $edit;
	if(mysql_query($edit)){
		echo "<script>alert('แก้ไขข้อมูลเรียบร้อย');window.location='armychkupopd_out.php';</script>";
	}else{
		echo "<script>alert('ผิดพลาด แก้ไขข้อมูลไม่สำเร็จ');window.location='armychkupopd_out.php';</script>";
	}													 
}
?>