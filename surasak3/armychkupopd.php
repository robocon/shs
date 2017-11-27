<?
session_start();
if (isset($sIdname)){} else {die;} //for security
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
.style1 {font-weight: bold}
-->
#showMe{
    display:none;
}
.style2 {
	color: #FF0000;
	font-weight: bold;
}
</style>
<title>บันทึกผลตรวจสุขภาพทหารประจำปี</title><a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a>
<form action="armychkupopd.php" method="post">
<input name="act" type="hidden" value="show" />
<div align="center"><strong>บันทึกผลตรวจสุขภาพทหารประจำปี <?=$nPrefix;?></strong></div>
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
<input name="post_vn" type="hidden" value="1" />
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
		$sql="select * from  chkup_solider where hn='$_POST[p_hn]' and yearchkup='$nPrefix' order by row_id asc";
	}else if(!empty($_POST["p_id"])){
		$sql="select * from  chkup_solider where idcard='$_POST[p_id]' and yearchkup='$nPrefix' order by row_id asc";
	}else if(!empty($_POST["p_name"])){
		$sql="select * from  chkup_solider where ptname like '%$_POST[p_name]%' and yearchkup='$nPrefix' order by row_id asc";
	}else if(!empty($_POST["p_sname"])){
		$sql="select * from  chkup_solider where ptname like '%$_POST[p_sname]%' and yearchkup='$nPrefix' order by row_id asc";
	}else if(!empty($_POST["p_name"]) && !empty($_POST["p_sname"])){
		$sql="select * from  chkup_solider where (ptname like '%$_POST[p_name]%') || (ptname like '%$_POST[p_sname]%') and yearchkup='$nPrefix' order by row_id asc";
	}
	//echo $sql;
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	//echo $num;
	if($num<1){
		echo "<script>alert('!!!ไม่พบข้อมูล การลงทะเบียนตรวจสุขภาพทหารประจำปี $nPrefix');window.location='armychkupopd.php';</script>";
	}	
	$rows=mysql_fetch_array($query);
	
		$chksql="select hn, dbirth, congenital_disease, drugreact from opcard where hn='".$rows["hn"]."'";
		//echo $chksql;
		$chkquery=mysql_query($chksql);
		$chkrows=mysql_fetch_array($chkquery);
		list($yy,$mm,$dd)=explode("-",$chkrows["dbirth"]);
		$ys=$yy-543;
		$dbirth="$dd/$mm/$yy";
		$birthday="$ys-$mm-$dd";
		
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
<form name="vsform" action="armychkupopd.php" method="post">
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
        <td colspan="4" align="center" bgcolor="#FF6699"><strong>บันทึกผลตรวจสุขภาพทหารประจำปี <?=$nPrefix;?><input name="yearchkup" type="hidden" value="<?=$nPrefix?>"></strong></td>
      </tr>
      <tr>
        <td colspan="4" align="center" bgcolor="#FFFFFF">สังกัด          <?=$camp;?><input name="chkidcard" type="hidden" value="<?=$rows["idcard"];?>"><input name="camp" type="hidden" value="<?=$rows["camp"];?>"><input name="dxptright" type="hidden" value="<?=$rows["dxptright"];?>"></td>
      </tr>
      <tr>
        <td colspan="4" align="left" bgcolor="#FFCC99"><strong>ข้อมูลเบื้องต้น</strong></td>
        </tr>
      <tr>
        <td width="14%"><strong>HN</strong></td>
        <td width="2%" align="center">:</td>
        <td colspan="2"><?=$rows["hn"];?><input name="hn" type="hidden" value="<?=$rows["hn"];?>"></td>
      </tr>
      <tr>
        <td><strong>ชื่อ - นามสกุล</strong></td>
        <td align="center">:</td>
        <td colspan="2"><?=$rows["yot"]." ".$rows["ptname"];?><input name="yot" type="hidden" value="<?=$rows["yot"];?>"><input name="ptname" type="hidden" value="<?=$rows["ptname"];?>"></td>
      </tr>
      <tr>
        <td><strong>ชั้นยศ</strong></td>
        <td align="center">:</td>
        <td colspan="2"><?=$chunyot;?><input name="chunyot" type="hidden" value="<?=$rows["chunyot"];?>"></td>
      </tr>
      <tr>
        <td><strong>เพศ</strong></td>
        <td align="center">:</td>
        <td colspan="2"><?=$gender;?><input name="gender" type="hidden" value="<?=$rows["gender"];?>"></td>
      </tr>
      <tr>
        <td><strong>ตำแหน่ง</strong></td>
        <td align="center">:</td>
        <td colspan="2"><?=$rows["position"];?><input name="position" type="hidden" value="<?=$rows["position"];?>"></td>
      </tr>
      <tr>
        <td><strong>ช่วยราชการ (ถ้ามี)</strong></td>
        <td align="center">:</td>
        <td colspan="2"><?=$rows["ratchakarn"];?><input name="ratchakarn" type="hidden" value="<?=$rows["ratchakarn"];?>"></td>
      </tr>
      <tr>
        <td><strong>วัน/เดือน/ปี เกิด</strong></td>
        <td align="center">:</td>
        <td colspan="2"><?=$dbirth;?><input name="birthday" type="hidden" value="<?=$birthday;?>"></td>
      </tr>
      <tr>
        <td><strong>อายุ</strong></td>
        <td align="center">:</td>
        <td colspan="2"><?=$rows["age"];?><input name="age" type="hidden" value="<?=$rows["age"];?>"><input name="hospitalcongenital_disease" type="hidden" value="<?=$chkrows["congenital_disease"];?>"></td>
      </tr>
      <tr>
        <td><strong>แพ้ยา</strong></td>
        <td align="center">:</td>
        <td colspan="2" style="color:#FF0000;"><?=$chkrows["drugreact"];?><input name="hospitaldrugreact" type="hidden" value="<?=$chkrows["drugreact"];?>"></td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>การตรวจร่างกาย</strong></td>
        </tr>
      <tr>
        <td><strong>น้ำหนัก</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtweight" type="text" class="frmsaraban" id="txtweight" value="<?=$arr_view["weight"];?>" OnChange="fncSum();">
          &nbsp;กก.</td>
      </tr>
      <tr>
        <td><strong>ส่วนสูง</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtheight" type="text" class="frmsaraban" id="txtheight" value="<?=$arr_view["height"];?>" OnChange="fncSum();">
          &nbsp;ซม.</td>
      </tr>
      <tr>
        <td><strong>BMI</strong></td>
        <td align="center">:</td>
        <td colspan="2">
          <input name="txtbmi" type="text" class="frmsaraban" id="txtbmi" value="<?=$arr_view["bmi"];?>"></td>
      </tr>
      <tr>
        <td><strong>เส้นรอบเอว</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtwaist" type="text" class="frmsaraban" id="txtwaist" value="<?=$arr_view["waist"];?>">
          &nbsp;นิ้ว</td>
      </tr>
      <tr>
        <td><strong>อุณหภูมิ (T)</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txttemperature" type="text" class="frmsaraban" id="txttemperature" value="<?=$arr_view["temperature"];?>"> 
          &nbsp;C</td>
      </tr>
      <tr>
        <td><strong>ชีพจร (P)</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtpulse" type="text" class="frmsaraban" id="txtpulse" value="<?=$arr_view["pulse"];?>" onKeyUp="gettext( );">
&nbsp;ครั้ง/นาที</td>
      </tr>
      <tr>
        <td><strong>หายใจ (R)</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtrate" type="text" class="frmsaraban" id="txtrate" value="<? if(empty($arr_view["rate"])){ echo "20";}else{ echo $arr_view["rate"];}?>">
&nbsp;ครั้ง/นาที</td>
      </tr>
      <tr>
        <td><strong>ความดันโลหิต 1</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtbp1" type="text" class="frmsaraban" id="txtbp1" value="<?=$arr_view["bp1"];?>">
&nbsp;มม. ปรอท</td>
      </tr>
      <tr>
        <td><strong>ความดันโลหิต 2</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtbp2" type="text" class="frmsaraban" id="txtbp2" value="<?=$arr_view["bp2"];?>">
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
        <td colspan="2"><select name="prawat" class="frmsaraban" id="prawat" onchange="showHide1(this)">
          <option value='<? echo $prawat;?>' >
            <? if($prawat=="0"){ echo "ไม่มีโรคประจำตัว";}else if($prawat=="1"){ echo "ความดันโลหิตสูง";}else if($prawat=="2"){ echo "เบาหวาน";}else if($prawat=="3"){ echo "โรคหัวใจและหลอดเลือด";}else if($prawat=="4"){ echo "ไขมันในเลือดสูง";}else if($prawat=="5"){ echo "โรคที่กำหนดไว้ตั้งแต่ 2 โรคขึ้นไป";}else if($prawat=="6"){ echo "โรคประจำตัวอื่นๆ";}else if($prawat=="7"){ echo "โรคเก๊าท์";}else if($prawat=="8"){ echo "โรคถุงลมโป่งพอง";}else if($prawat==""){ echo "----------- เลือก -----------";}?>
            </option>
          <option value="0">ไม่มีโรคประจำตัว</option>
          <option value="1">ความดันโลหิตสูง</option>
          <option value="2">เบาหวาน</option>
          <option value="3">โรคหัวใจและหลอดเลือด</option>
          <option value="4">ไขมันในเลือดสูง</option>
          <option value="5">โรคที่กำหนดไว้ตั้งแต่ 2 โรคขึ้นไป</option>
          <option value="6">โรคประจำตัวอื่นๆ</option>
          <option value="7">โรคเก๊าท์</option>
          <option value="8">โรคถุงลมโป่งพอง</option>
        </select>
          &nbsp;
          <strong>โรคอื่นระบุ</strong> :
            <input name="congenital_disease" type="text" class="frmsaraban" id="congenital_disease" value="<?=$arr_view["congenital_disease"];?>" />          </td>
      </tr>    
      <tr>
        <td colspan="4">
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
        <td colspan="4" bgcolor="#FFCC99"><strong>กรณีเป็นผู้ป่วยโรคความดันโลหิตสูง, เบาหวาน, ไขมันในเลือดสูง ให้ระบุโรงพยาบาลที่รักษา</strong></td>
        </tr>
      <tr>
        <td><strong>รับการรักษาที่</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="hospital" id="hospital1" type="checkbox" class="frmsaraban" <?php if($arr_view["hospital"]=="โรงพยาบาลค่ายสุรศักดิ์มนตรี"){ echo "checked"; } ?> value="โรงพยาบาลค่ายสุรศักดิ์มนตรี" />
          โรงพยาบาลค่ายสุรศักดิ์มนตรี
        <input name="hospital" id="hospital2" type="checkbox" class="frmsaraban" <?php if($arr_view["hospital"]=="โรงพยาบาลลำปาง"){ echo "checked"; } ?> value="โรงพยาบาลลำปาง" />
        โรงพยาบาลลำปาง&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;        <strong>โรงพยาบาลอื่นๆ ระบ</strong>ุ
        <input name="hospital_other" type="text" class="frmsaraban" id="hospital_other" value="<?php if(($arr_view["hospital"]!="โรงพยาบาลค่ายสุรศักดิ์มนตรี") && ($arr_view["hospital"]!="โรงพยาบาลลำปาง")){ echo $arr_view["hospital"]; } ?>"></td>
      </tr>
      <tr>
        <td><strong>สรุป</strong></td>
        <td align="center">&nbsp;</td>
        <td colspan="2"><input name="diagtype" id="diagtype1" type="checkbox" class="frmsaraban" value="control" <?php if($diagtype=="control"){ echo "checked"; } ?> /> 
          Control
&nbsp;&nbsp;&nbsp;
<input name="diagtype" id="diagtype2" type="checkbox" class="frmsaraban" value="uncontrol" <?php if($diagtype=="uncontrol"){ echo "checked"; } ?> />
Un Control
		    &nbsp;&nbsp;&nbsp;
            <input name="diagtype" id="diagtype3" type="checkbox" class="frmsaraban" value="newcase" <?php if($diagtype=="newcase"){ echo "checked"; } ?> /> 
            New Case</td>
      </tr>
      <tr>
        <td bgcolor="#FFFFCC">&nbsp;</td>
        <td align="center" bgcolor="#FFFFCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFFFCC">*** <strong>Control</strong> คือ มีประวัติป่วยเป็นโรคเรื้อรัง (HT, DM, DLP) รักษาตัวอยู่ และผลการรักษาอยู่ในระดับที่ควบคุมได้้ (ปกติ)</td>
      </tr>
      <tr>
        <td bgcolor="#FFFFCC">&nbsp;</td>
        <td align="center" bgcolor="#FFFFCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFFFCC">*** <strong>Un Control</strong> คือ มีประวัติป่วยเป็นโรคเรื้อรัง (HT, DM, DLP) รักษาตัวอยู่ แต่ผลการรักษาควบคุมไม่ได้ (ผิดปกติ)</td>
      </tr>
      <tr>
        <td bgcolor="#FFFFCC">&nbsp;</td>
        <td align="center" bgcolor="#FFFFCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFFFCC">*** <strong>New Case</strong> คือ ไม่มีประวัติป่วยเป็นโรคเรื้อรัง (HT, DM, DLP) แต่บอกว่าป่วย และผลออกมาผิดปกติ</td>
      </tr>
      <tr>
        <td><strong>ประวัติการแพ้ยา</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="drugreact" type="radio" class="frmsaraban" id="drugreact1" value="0" <? if($arr_view["drugreact"]=="0"){ echo "checked='checked'";}?> />
ไม่แพ้
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="drugreact" type="radio" class="frmsaraban" id="drugreact2" value="1" <? if($arr_view["drugreact"]=="1"){ echo "checked='checked'";}?> />
แพ้ <font color="#FF0000"><?php echo $chkrows["drugreact"];?></font></span></td>
      </tr>
      <tr>
        <td><strong>การสูบบุหรี่</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="cigarette" type="radio" class="frmsaraban" value="0" <?php if($cigarette==0){ echo "checked"; } ?> />
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
        <td colspan="2"><input name="alcohol" type="radio" class="frmsaraban" value="0" <?php if($alcohol==0){ echo "checked"; } ?> />
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
        <td colspan="2"><input name="exercise" type="radio" class="frmsaraban" value="0" <?php if($exercise==0){ echo "checked"; } ?> />
		    ไม่ออกกำลังกาย&nbsp;&nbsp;&nbsp;
		    <input name="exercise" type="radio" class="frmsaraban" value="1" <?php if($exercise==1){ echo "checked"; } ?> />
		    น้อยกว่า 3 ครั้งต่อ 1 สัปดาห์
		    &nbsp;&nbsp;&nbsp;
            <input name="exercise" type="radio" class="frmsaraban" value="2" <?php if($exercise==2){ echo "checked"; } ?> /> 
            3 ครั้งต่อ 1 สัปดาห์ขึ้นไป</td>
      </tr>
      
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>ค่าการวัด % ใต้ผิวหนัง</strong></td>
        </tr>
      <tr>
        <td><strong>BMI</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtbmi1" type="text" class="frmsaraban" id="txtbmi1" value="<?=$arr_view["bmi"];?>"></td>
      </tr>
      <tr>
        <td><strong>BMR</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtbmr" type="text" class="frmsaraban" id="txtbmr" value="<?=$arr_view["bmr"];?>"></td>
      </tr>
      <tr>
        <td><strong>%TBW</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txttbw" type="text" class="frmsaraban" id="txttbw" value="<?=$arr_view["tbw"];?>"></td>
      </tr>
      <tr>
        <td><strong>%FAT</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtfat" type="text" class="frmsaraban" id="txtfat" value="<?=$arr_view["fat"];?>"></td>
      </tr>
      <tr>
        <td><strong>Fat Mass</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtfatmass" type="text" class="frmsaraban" id="txtfatmass" value="<?=$arr_view["fat_mass"];?>">
          &nbsp;kg.</td>
      </tr>
      
      <tr>
        <td><strong>Visceral Fat</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtvisceralfat" type="text" class="frmsaraban" id="txtvisceralfat" value="<?=$arr_view["visceral_fat"];?>"></td>
      </tr>
      <tr>
        <td><strong>Muscle Mass</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtmusclemass" type="text" class="frmsaraban" id="txtmusclemass" value="<?=$arr_view["muscle_mass"];?>"></td>
      </tr>
      <tr>
        <td><strong>VFA level</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtvfalevel" type="text" class="frmsaraban" id="txtvfalevel" value="<?=$arr_view["vfa_level"];?>"></td>
      </tr>
      <tr>
        <td><strong>ผลการทดสอบ</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="resultfat" type="radio" class="frmsaraban" value="1" <?php if($arr_view["result_fat"]==1){ echo "checked"; } ?> />
          ผอม          &nbsp;&nbsp;
 &nbsp;
            <input name="resultfat" type="radio" class="frmsaraban" value="2" <?php if($arr_view["result_fat"]==2){ echo "checked"; } ?> />
          ค่อนข้างผอม          &nbsp;&nbsp;
 &nbsp;
 <input name="resultfat" type="radio" class="frmsaraban" value="3" <?php if($arr_view["result_fat"]==3){ echo "checked"; } ?> />
 สมส่วน          &nbsp;&nbsp;
 &nbsp;
 <input name="resultfat" type="radio" class="frmsaraban" value="4" <?php if($arr_view["result_fat"]==4){ echo "checked"; } ?> />
 ค่อนข้างอ้วน          &nbsp;&nbsp;
 &nbsp;
 <input name="resultfat" type="radio" class="frmsaraban" value="5" <?php if($arr_view["result_fat"]==5){ echo "checked"; } ?> /> 
 อ้วน</td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>การทดสอบความแข็งแรงของกล้ามเนื้อด้วยวัดแรงบีบมือ</strong></td>
        </tr>
      
      <tr>
        <td><strong>ผลการทดสอบ</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txthand1" type="text" class="frmsaraban" id="txthand1" value="<?=$arr_view["hand1"];?>"></td>
      </tr>
      <tr>
        <td><strong>ผลการทดสอบ/น้ำหนักตัว</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txthand2" type="text" class="frmsaraban" id="txthand2" value="<?=$arr_view["hand2"];?>"></td>
      </tr>
      <tr>
        <td><strong>ระดับสมรรถภาพ</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="resulthand" type="radio" class="frmsaraban" value="5" <?php if($arr_view["result_hand"]==5){ echo "checked"; } ?> />
        ดีมาก
        &nbsp;&nbsp;
          &nbsp;
          <input name="resulthand" type="radio" class="frmsaraban" value="4" <?php if($arr_view["result_hand"]==4){ echo "checked"; } ?> />
          ดี          &nbsp;&nbsp;
          &nbsp;
          <input name="resulthand" type="radio" class="frmsaraban" value="3" <?php if($arr_view["result_hand"]==3){ echo "checked"; } ?> />
          พอใช้          &nbsp;&nbsp;
          &nbsp;
          <input name="resulthand" type="radio" class="frmsaraban" value="2" <?php if($arr_view["result_hand"]==2){ echo "checked"; } ?> />
          ค่อนข้างต่ำ          &nbsp;&nbsp;
          &nbsp;
          <input name="resulthand" type="radio" class="frmsaraban" value="1" <?php if($arr_view["result_hand"]==1){ echo "checked"; } ?> />
          ต่ำ </td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>การทดสอบความแข็งแรงของกล้ามเนื้อด้วยแรงเหยียดขา</strong></td>
        </tr>
      <tr>
        <td><strong>ผลการทดสอบ</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtleg1" type="text" class="frmsaraban" id="txtleg" value="<?=$arr_view["leg1"];?>"></td>
      </tr>
      <tr>
        <td><strong>ผลการทดสอบ/น้ำหนักตัว</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtleg2" type="text" class="frmsaraban" id="txtleg2" value="<?=$arr_view["leg2"];?>"></td>
      </tr>
      <tr>
        <td><strong>ระดับสมรรถภาพ</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="resultleg" type="radio" class="frmsaraban" value="5" <?php if($arr_view["result_leg"]==5){ echo "checked"; } ?> />
          ดีมาก
          &nbsp;&nbsp;
          &nbsp;
              <input name="resultleg" type="radio" class="frmsaraban" value="4" <?php if($arr_view["result_leg"]==4){ echo "checked"; } ?> />
          ดี          &nbsp;&nbsp;
          &nbsp;
              <input name="resultleg" type="radio" class="frmsaraban" value="3" <?php if($arr_view["result_leg"]==3){ echo "checked"; } ?> />
          พอใช้          &nbsp;&nbsp;
          &nbsp;
              <input name="resultleg" type="radio" class="frmsaraban" value="2" <?php if($arr_view["result_leg"]==2){ echo "checked"; } ?> />
          ค่อนข้างต่ำ          &nbsp;&nbsp;
          &nbsp;
              <input name="resultleg" type="radio" class="frmsaraban" value="1" <?php if($arr_view["result_leg"]==1){ echo "checked"; } ?> />
          ต่ำ </td>
      </tr>
      
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>การทดสอบความแข็งแรงของระบบทางเดินหายใจและระบบไหลเวียนโลหิตด้วยการทดสอบก้าวขึ้น - ลง 3 นาที (3 minute step test)</strong></td>
        </tr>
      <tr>
        <td><strong>ชีพจรก่อนการทดสอบ</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtsteptest1" type="text" class="frmsaraban" id="txtsteptest1" value="<?=$arr_view["steptest1"];?>">
&nbsp;ครั้ง/นาที</td>
      </tr>
      <tr>
        <td><strong>ชีพจรหลังการพัก 1 นาที</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtsteptest2" type="text" class="frmsaraban" id="txtsteptest2" value="<?=$arr_view["steptest2"];?>">
&nbsp;ครั้ง/นาที</td>
      </tr>
      <tr>
        <td><strong>ชีพจรหลังการทดสอบ</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtsteptest3" type="text" class="frmsaraban" id="txtsteptest3" value="<?=$arr_view["steptest3"];?>">
&nbsp;ครั้ง/นาที</td>
      </tr>
      
      <tr>
        <td><strong>ระดับสมรรถภาพ</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="resultsteptest" type="radio" class="frmsaraban" value="5" <?php if($arr_view["result_steptest"]==5){ echo "checked"; } ?> />
ดีมาก
          &nbsp;&nbsp;
          &nbsp;
          <input name="resultsteptest" type="radio" class="frmsaraban" value="4" <?php if($arr_view["result_steptest"]==4){ echo "checked"; } ?> />
ดี          &nbsp;&nbsp;
          &nbsp;
          <input name="resultsteptest" type="radio" class="frmsaraban" value="3" <?php if($arr_view["result_steptest"]==3){ echo "checked"; } ?> />
ปานกลาง          &nbsp;&nbsp;
          &nbsp;
          <input name="resultsteptest" type="radio" class="frmsaraban" value="2" <?php if($arr_view["result_steptest"]==2){ echo "checked"; } ?> />
ต่ำ          &nbsp;&nbsp;
          &nbsp;
          <input name="resultsteptest" type="radio" class="frmsaraban" value="1" <?php if($arr_view["result_steptest"]==1){ echo "checked"; } ?> />
ต่ำมาก</td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>การทดสอบร่างกาย</strong></td>
        </tr>
      <tr>
        <td><strong>ดันพื้น</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtpressure" type="text" class="frmsaraban" id="txtpressure" value="<?=$arr_view["pressure_test"];?>" />
&nbsp;ครั้ง/2 นาที&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input name='pressure_result' type='radio' value='ผ่าน' id="pressure_result1" <?php if($arr_view["pressure_result"]=="ผ่าน"){ echo "checked"; } ?>/>
ผ่าน
<input name='pressure_result' type='radio' value='ไม่ผ่าน' id="pressure_result2" <?php if($arr_view["pressure_result"]=="ไม่ผ่าน"){ echo "checked"; } ?>/>
ไม่ผ่าน</td>
      </tr>
      <tr>
        <td><strong>ลุกนั่ง</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtsitup" type="text" class="frmsaraban" id="txtsitup" value="<?=$arr_view["situp_test"];?>" />
          &nbsp;ครั้ง/2 นาที&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input name='situp_result' type='radio' value='ผ่าน' id="situp_result1" <?php if($arr_view["situp_result"]=="ผ่าน"){ echo "checked"; } ?>/>
          ผ่าน
          <input name='situp_result' type='radio' value='ไม่ผ่าน' id="situp_result2" <?php if($arr_view["situp_result"]=="ไม่ผ่าน"){ echo "checked"; } ?>/>
          ไม่ผ่าน</td>
      </tr>
      <tr>
        <td><strong>วิ่ง 2 กิโลเมตร</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="txtrun" type="text" class="frmsaraban" id="txtrun" value="<?=$arr_view["run_test"];?>" />
          &nbsp;นาที<span style="margin-left:63px;"><input name='run_result' type='radio' value='ผ่าน' id="run_result1" <?php if($arr_view["run_result"]=="ผ่าน"){ echo "checked"; } ?>/>
          ผ่าน
          <input name='run_result' type='radio' value='ไม่ผ่าน' id="run_result2" <?php if($arr_view["run_result"]=="ไม่ผ่าน"){ echo "checked"; } ?>/>
          ไม่ผ่าน</span></td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>ผล X-Ray</strong></td>
        </tr>
      <tr>
        <td><strong>ผลการ X-Ray</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name='xray' type='radio' id="xray1" value='ปกติ' checked="checked" <?php if($arr_view["xray"]=="ปกติ"){ echo "checked"; } ?>/>
	      ปกติ
	        <input name='xray' type='radio' value='ผิดปกติ' id="xray2" <?php if($arr_view["xray"]=="ผิดปกติ"){ echo "checked"; } ?>/>
	      ผิดปกติเล็กน้อย
	        <input name='xray' type='radio' value='ผิดปกติ' id="xray3" <?php if($arr_view["xray"]=="ผิดปกติควรพบแพทย์"){ echo "checked"; } ?>/>
ผิดปกติควรพบแพทย์</td>
      </tr>
      <tr>
        <td><strong>ค่าผิดปกติ ระบุ</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="xraydetail" type="text" class="frmsaraban" id="xraydetail" value="<?=$arr_view["xray_detail"];?>"></td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>การตรวจสุขภาพช่องปาก</strong></td>
        </tr>
      <tr>
        <td><strong>ผลสภาวะช่องปาก</strong></td>
        <td align="center">:</td>
        <td width="19%"><input name='resultdental' type='radio' value='ปกติ' id="dental1" <?php if($arr_view["result_dental"]=="ปกติ"){ echo "checked"; } ?>/>
ปกติ
  <input name='resultdental' type='radio' value='ผิดปกติ' id="dental2" <?php if($arr_view["result_dental"]=="ผิดปกติ"){ echo "checked"; } ?>/>
ผิดปกติ</td>
        <td width="65%"><strong>ระดับ : 
          <input name="level_dental" type="text" class="frmsaraban" id="level_dental" value="<?=$arr_view["level_dental"];?>" />
        </strong></td>
      </tr>
      <tr>
        <td><strong>โรคฟัน</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="dental_disease1" type="checkbox" class="frmsaraban" value="1" <?php if($arr_view["dental_disease1"]==1){ echo "checked"; } ?> />
          ฟันผุ (D,I)
          &nbsp;&nbsp;
          &nbsp;
          <input name="dental_disease2" type="checkbox" class="frmsaraban" value="1" <?php if($arr_view["dental_disease2"]==1){ echo "checked"; } ?> />
ฟันสึก (E,J)         &nbsp;&nbsp;
          &nbsp;
          <input name="dental_disease3" type="checkbox" class="frmsaraban" value="1" <?php if($arr_view["dental_disease3"]==1){ echo "checked"; } ?> />          
          โรคปริทันต์อักเสบ (F,K)</td>
      </tr>
      <tr>
        <td><strong>โรคเหงือก</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="gum_disease1" type="checkbox" class="frmsaraban" value="1" <?php if($arr_view["gum_disease1"]==1){ echo "checked"; } ?> />
โรคเหงือกอักเสบ (B)
          &nbsp;&nbsp;
          &nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;
          <input name="gum_disease2" type="checkbox" class="frmsaraban" value="1" <?php if($arr_view["gum_disease2"]==1){ echo "checked"; } ?> /> 
          ฟันคุด (L)</td>
      </tr>
      <tr>
        <td><strong>อื่นๆ</strong></td>
        <td align="center">:</td>
        <td colspan="2"><input name="other_disease1" type="checkbox" class="frmsaraban" id="other_disease1" value="1" <?php if($arr_view["other_disease1"]==1){ echo "checked"; } ?> />
        สูญเสียฟัน และควรใส่ฟันทดแทน (G)
        &nbsp;&nbsp;
          &nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;
              <input name="other_disease2" type="checkbox" class="frmsaraban" id="other_disease2" value="1" <?php if($arr_view["other_disease2"]==1){ echo "checked"; } ?> />
          ปวด บวม อื่นๆ/รอยโรคในช่องปาก (M)</td>
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
        <td colspan="4" bgcolor="#FFCC99"><strong>ผลการตรวจทางพยาธิ เมื่อวันที่ <?php echo $lab_date;?>
            <input name="rowlab2" type="hidden" id="rowlab2"  value="<?php echo $lab_date;?>" />
        </strong></td>
        </tr>
      <tr>
        <td colspan="4">
<!-- ผลการตรวจทางพยาธิ -->
<TABLE width="100%" border="1" align="center" cellpadding="1" cellspacing="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF" >
<TR>
	<TD>
	<TABLE width="100%" border="0" cellpadding="0" cellspacing="0">
	<TR>
		<TD align="left" bgcolor="#FFFFCC">&nbsp;&nbsp; <span class="style5"><strong>ผล UA :</strong></span> <span class="labfont">
        <input name='ua_lab' type='radio' value='ปกติ' <?php if($arr_view["ua_lab"]=="ปกติ"){ echo "checked"; } ?>/>
ปกติ
<input name='ua_lab' type='radio' value='ผิดปกติ' <?php if($arr_view["ua_lab"]=="ผิดปกติ"){ echo "checked"; } ?>/>
ผิดปกติ
		</span></TD>
	</TR>
	<TR>
	  <TD align="left" bgcolor="#FFFFFF"><span class="style2">- ต้องไม่มีค่า + และ Positive ถ้ามีถือว่า ผิดปกติ</span></TD>
	  </TR>
	<TR class="tb_font">
		<TD bgcolor="#FFCCCC"><table border="0">
	  <tr>
	  <?php
	  $i=1;
	  	while(list($labname,$labresult, $unit) = mysql_fetch_row($result_ua)){
		if($labname == "OTHERU"){
			$size="13";
		}else{
			$size="6";
		}

		//if(!empty($arr_dxofyear[$list_ua[$labname]]))
			//$labresult = $arr_dxofyear[$list_ua[$labname]];
	  ?>
          <td align="right" class="tb_font_2"><?php echo $labname;?> : </td>
          <td>&nbsp;<input name="<?php echo  $list_ua[$labname];?>" type="text" class="frmsaraban" value="<?php echo $labresult;?>"  size="<?php echo $size;?>" readonly />&nbsp;<?php //echo //$unit;?>&nbsp;</td>
	<?php 
	if($i%5==0) echo "<tr></tr>";
	$i++;
			}?>
		  </tr>
      </table>
	  <hr />
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#FFFFCC">&nbsp;&nbsp; <span class="style5"><strong>ผล CBC :</strong></span> <span class="labfont">
    <input name='cbc_lab' type='radio' value='ปกติ' <?php if($arr_view["cbc_lab"]=="ปกติ"){ echo "checked"; } ?>/>
ปกติ
<input name='cbc_lab' type='radio' value='ผิดปกติ' <?php if($arr_view["cbc_lab"]=="ผิดปกติ"){ echo "checked"; } ?>/>
ผิดปกติ </span></td>
  </tr>
</table>

	  <table border="0">
	  <tr>
	  <?php
	  $i=1;
	  	while(list($labname,$labresult, $unit,$normalrange,$flag) = mysql_fetch_row($result_cbc)){
		if($labname == "HB" || $labname == "HCT" || $labname == "WBC" || $labname == "PLTC"){
			$color="#FF0000";
			$rang=$normalrange;
		}else{
			$color="#000000";
		}
	  ?>
          <td align="right" class="tb_font_2"><strong style="color:<?=$color;?>"><?php echo $labname;?> : </strong></td>
          <td>&nbsp;<input name="<?php echo  $list_cbc[$labname];?>" type="text" value="<?php echo $labresult;?>" readonly size="5" /> <? if($labname == "HB" || $labname == "HCT" || $labname == "WBC" || $labname == "PLTC"){ echo "( $normalrange )";}?>
          <input type="hidden" name="<?=$labname?>range" value="<?=$normalrange?>" />
          <input type="hidden" name="<?=$labname?>flag" value="<?=$flag?>" />
	<?php 
	if($i%5==0) echo "<tr></tr>";
	$i++;
			}?>		  </tr>
      </table>      </TD>
	</TR>
    <tr>
      <td>HB คือ การตรวจวัดความเข้มข้นของฮีโมโกลบิน</td>
    </tr>
    <tr>
    <td>HCT คือ ระดับเม็ดเลือดแดง ค่าน้อยกว่า 37 บ่งบอกถึงภาวะซีด</td>
    </tr>
    <tr>
      <td>WBC คือ ระดับเม็ดเลือดขาว</td>
    </tr>
    <tr>
      <td>PLTC คือ ปริมาณเกร็ดเลือด</td>
    </tr>   
	</TABLE>	</TD>
</TR>
</TABLE>        </td>
        </tr>
      <!--เริ่ม LAB อายุมากกว่าหรือเท่ากับ 35 ปี-->
      <tr>
        <td colspan="4"><?
//echo "==>".substr($arr_view["age"],0,2);
if($rows["age"]>= 35){
////ผลlab ของปีที่แล้ว
////*runno ตรวจสุขภาพ*/////////
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
////*runno ตรวจสุขภาพ*/////////
?>
<table border="1" cellpadding="1" cellspacing="0" bordercolor="#FFFFFF"  width="100%" bgcolor="#FFCCCC">
  <tr><td>
	  <table width="100%" border="0">
	    <tr>
	      <td colspan="7" align="left" bgcolor="#FFFFCC" class="tb_font_2"><strong>ผล LAB เฉพาะผู้ที่มีอายุมากกว่า 35 ปี</strong></td>
	      </tr>
	    <tr>
	      <td align="right" class="tb_font_2">&nbsp;</td>
	      <td align="center" bgcolor="#339999" class="profilelab"><strong><?=($nPrefix-2)?></strong></td>
          <td align="center" bgcolor="#339999" class="profilelab"><strong><?=($nPrefix-1)?></strong></td>
	      <td align="center" bgcolor="#339999" class="profilelab"><strong><?=$nPrefix?></strong></td>
	      <td class="labfont">&nbsp;</td>
	      <td align="center" class="labfont">&nbsp;</td>
	      <td class="labfont">&nbsp;</td>
	      </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='GLU' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='GLU' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='GLU' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];
?>      
	    <tr>
	      <td width="29%" align="right" valign="middle" bordercolor="#FFFFFF" class="text3"><strong>GLU(เบาหวาน) :</strong></td>
	      <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	        <?=$resultlab2;?>
	      </span></td>
	      <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	        <?=$resultlab1;?>
	      </span></td>
	    <td align="center" bgcolor="#FFFFFF" class="profilehead">
            <? 
			if($resultlab < 74 || $resultlab > 106){
				echo "<span style='color:#F00'><strong>$resultlab</strong></span>";
			}else{
				echo "<span style='color:#00F'>$resultlab</span>";
			}
			?>        <input type="hidden" name="glu_result" id="glu_result" value="<?=$resultlab;?>"><input type="hidden" name="glu_flag" id="glu_flag" value="<?=$flaglab;?>"></td>
	    <td class="labfont">(<?=$ranglab;?>)</td>
	    <td align="center" class="labfont"><span <? if($flaglab!="N"){ echo "style='color:#F00;font-weight:bold;'";}?>><?=$flaglab;?></span></td>
	    <td class="labfont"><input name='glu_lab' type='radio' value='ปกติ' <?  if($resultlab >= 74 && $resultlab <= 106){ echo "checked";}?>/>
ปกติ
  		<input name='glu_lab' type='radio' value='ผิดปกติ' <? if(!empty($resultlab) && $resultlab < 74 || $resultlab > 106){ echo "checked";}?>/>
            <? 
			if(!empty($resultlab) && $resultlab < 74 || $resultlab > 106){
				echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			}else{
				echo "<span style='color:#000'>ผิดปกติ</span>";
			}
			?>  		</td>
	    </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='CHOL' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='CHOL' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='CHOL' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];
?>          
	    <tr>
	      <td align="right" valign="middle" bordercolor="#FFFFFF" class="text3"><strong>CHOL(การตรวจไขมัน) :</strong></td>
	      <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	        <?=$resultlab2;?>
	      </span></td>
	      <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	        <?=$resultlab1;?>
	      </span></td>
	    <td align="center" bgcolor="#FFFFFF" class="profilehead">
            <? 
			if($resultlab > 200){
				echo "<span style='color:#F00'><strong>$resultlab</strong></span>";
			}else{
				echo "<span style='color:#00F'>$resultlab</span>";
			}
			?>        <input type="hidden" name="chol_result" id="chol_result" value="<?=$resultlab;?>">
            <input type="hidden" name="chol_flag" id="chol_flag" value="<?=$flaglab;?>" /></td>
	    <td class="labfont">(<?=$ranglab;?>)</td>
	    <td align="center" class="labfont"><span <? if($flaglab!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>><?=$flaglab;?></span></td>
	    <td class="labfont"><input name='chol_lab' type='radio' value='ปกติ' <? if(!empty($resultlab) && $resultlab <= 200){ echo "checked";}?> />
ปกติ
  <input name='chol_lab' type='radio' value='ผิดปกติ' <? if($resultlab > 200){ echo "checked";}?>/>
            <? 
			if($resultlab > 200){
				echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			}else{
				echo "<span style='color:#000'>ผิดปกติ</span>";
			}
			?>        </td>
	    </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='TRIG' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='TRIG' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='TRIG' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];
?>       
	    <tr>
	      <td align="right" valign="middle" bordercolor="#FFFFFF" class="text3"><strong>TRIG(การตรวจไขมัน) :</strong></td>
	      <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	        <?=$resultlab2;?>
	      </span></td>
	      <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	        <?=$resultlab1;?>
	      </span></td>
	    <td align="center" bgcolor="#FFFFFF" class="profilehead">
            <? 
			if($resultlab > 150){
				echo "<span style='color:#F00'><strong>$resultlab</strong></span>";
			}else{
				echo "<span style='color:#00F'>$resultlab</span>";
			}
			?>		<input type="hidden" name="trig_result" id="trig_result" value="<?=$resultlab;?>"><input type="hidden" name="trig_flag" id="trig_flag" value="<?=$flaglab;?>" /></td>
	    <td class="labfont">(<?=$ranglab;?>)</td>
	    <td align="center" class="labfont"><span <? if($flaglab!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>><?=$flaglab;?></span></td>
	    <td class="labfont"><input name='trig_lab' type='radio' value='ปกติ' <? if(!empty($resultlab) && $resultlab <= 150){ echo "checked";}?> />
ปกติ
  <input name='trig_lab' type='radio' value='ผิดปกติ'  <? if($resultlab > 150){ echo "checked";}?>/>
            <? 
			if($resultlab > 150){
				echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			}else{
				echo "<span style='color:#000'>ผิดปกติ</span>";
			}
			?>        </td>
	    </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='HDL' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='HDL' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='HDL' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];

?>         
	  <tr>
	    <td align="right" valign="middle" bordercolor="#FFFFFF" class="text3"><strong>HDL(การตรวจไขมันดี) :</strong></td>
	    <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
          <?=$resultlab2;?>
        </span></td>
	    <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
          <?=$resultlab1;?>
        </span></td>
	    <td align="center" bgcolor="#FFFFFF" class="profilehead"><? 
			if($resultlab < 40 || $resultlab > 60){
				echo "<span style='color:#F00'><strong>$resultlab</strong></span>";
			}else{
				echo "<span style='color:#00F'>$resultlab</span>";
			}
			?>        <input type="hidden" name="hdl_result" id="hdl_result" value="<?=$resultlab;?>"><input type="hidden" name="hdl_flag" id="hdl_flag" value="<?=$flaglab;?>" /></td>
	    <td class="labfont">(
	        <?=$ranglab?>
	      )</td>
	    <td align="center" class="labfont"><span <? if($flaglab!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>>
	      <?=$flaglab?>
	      </span></td>
	    <td class="labfont"><input name='hdl_lab' type='radio' value='ปกติ' <? if($resultlab >= 40 && $resultlab <= 60){ echo "checked";}?>/>
	      ปกติ
	      <input name='hdl_lab' type='radio' value='ผิดปกติ' <? if(!empty($resultlab) && $resultlab < 40 || $resultlab > 60){ echo "checked";}?>/>
    <? 
			if(!empty($resultlab) && $resultlab < 40 || $resultlab > 60){
				echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			}else{
				echo "<span style='color:#000'>ผิดปกติ</span>";
			}
			?>        </td>
	  </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='10001' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='10001' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='10001' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];

?>       
	  <tr>
	    <td align="right" valign="middle" bordercolor="#FFFFFF" class="text3"><strong>LDL(การตรวจไขมันเลว) :</strong></td>
	    <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
          <?=$resultlab2;?>
        </span></td>
	    <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
          <?=$resultlab1;?>
        </span></td>
	    <td align="center" bgcolor="#FFFFFF" class="profilehead"><? 
			if($resultlab > 100){
				echo "<span style='color:#F00'><strong>$resultlab</strong></span>";
			}else{
				echo "<span style='color:#00F'>$resultlab</span>";
			}
			?>        <input type="hidden" name="ldl_result" id="ldl_result" value="<?=$resultlab;?>"><input type="hidden" name="ldl_flag" id="ldl_flag" value="<?=$flaglab;?>" /></td>
	    <td class="labfont">(
	        <?=$ranglab;?>
	      )</td>
	    <td align="center" class="labfont"><span <? if($flaglab!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>>
	      <?=$flaglab;?>
	      </span></td>
	    <td class="labfont"><input name='ldl_lab' type='radio' value='ปกติ' <? if(!empty($resultlab) && $resultlab <= 100){ echo "checked";}?> />
	      ปกติ
	      <input name='ldl_lab' type='radio' value='ผิดปกติ' <? if($resultlab > 100){ echo "checked";}?>/>
    <? 
			if($resultlab > 100){
				echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			}else{
				echo "<span style='color:#000'>ผิดปกติ</span>";
			}
			?>        </td>
	  </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='BUN' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='BUN' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='BUN' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];
?>        
	    <tr>
	      <td align="right" valign="middle" bordercolor="#FFFFFF" class="text3"><strong>BUN(การทำงานของไต) :</strong></td>
	      <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	        <?=$resultlab2;?>
	      </span></td>
	      <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	        <?=$resultlab1;?>
	      </span></td>
	    <td align="center" bgcolor="#FFFFFF" class="profilehead">
            <? 
			if($resultlab < 7 || $resultlab > 18){
				echo "<span style='color:#F00'><strong>$resultlab</strong></span>";
			}else{
				echo "<span style='color:#00F'>$resultlab</span>";
			}
			?>        <input type="hidden" name="bun_result" id="bun_result" value="<?=$resultlab;?>"><input type="hidden" name="bun_flag" id="bun_flag" value="<?=$flaglab;?>" /></td>
	    <td class="labfont">(<?=$ranglab?>)</td>
	    <td align="center" class="labfont"><span <? if($flaglab!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>><?=$flaglab?></span></td>
	    <td class="labfont"><input name='bun_lab' type='radio' value='ปกติ' <? if($resultlab >= 7 && $resultlab <= 18){ echo "checked";}?>/>
ปกติ
  <input name='bun_lab' type='radio' value='ผิดปกติ' <? if(!empty($resultlab) && $resultlab < 7 || $resultlab > 18){ echo "checked";}?>/>
            <? 
			if(!empty($resultlab) && $resultlab < 7 || $resultlab > 18){
				echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			}else{
				echo "<span style='color:#000'>ผิดปกติ</span>";
			}
			?>        </td>
	    </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='CREA' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='CREA' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='CREA' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];
?>        
	    <tr>
	      <td align="right" valign="middle" bordercolor="#FFFFFF" class="text3"><strong>CREA(การทำงานของไต) :</strong></td>
	      <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	        <?=$resultlab2;?>
	      </span></td>
	      <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	        <?=$resultlab1;?>
	      </span></td>
	    <td align="center" bgcolor="#FFFFFF" class="profilehead">
            <? 
			if($resultlab < 0.6 || $resultlab > 1.3){
				echo "<span style='color:#F00'><strong>$resultlab</strong></span>";
			}else{
				echo "<span style='color:#00F'>$resultlab</span>";
			}
			?>        <input type="hidden" name="crea_result" id="crea_result" value="<?=$resultlab;?>"><input type="hidden" name="crea_flag" id="crea_flag" value="<?=$flaglab;?>" /></td>
	    <td class="labfont">(<?=$ranglab;?>)</td>
	    <td align="center" class="labfont"><span <? if($flaglab!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>><?=$flaglab?></span></td>
	    <td class="labfont"><input name='crea_lab' type='radio' value='ปกติ' <? if($resultlab >= 0.6 && $resultlab <= 1.3){ echo "checked";}?> />
ปกติ
  <input name='crea_lab' type='radio' value='ผิดปกติ' <? if(!empty($result['cr']) && $resultlab < 0.6 || $resultlab > 1.3){ echo "checked";}?>/>
            <? 
			if(!empty($resultlab) && $resultlab < 0.6 || $resultlab > 1.3){
				echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			}else{
				echo "<span style='color:#000'>ผิดปกติ</span>";
			}
			?>		</td>
	    </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='ALP' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='ALP' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='ALP' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];

?>        
	    <tr>
	      <td align="right" valign="middle" bordercolor="#FFFFFF" class="text3"><strong>ALP(ตับ,กระดูก) :</strong></td>
          <td width="9%" align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
            <?=$resultlab2;?>
          </span></td>
          <td width="9%" align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
            <?=$resultlab1;?>
          </span></td>
          <td width="8%" align="center" bgcolor="#FFFFFF" class="profilehead">
            <? 
			if($resultlab < 46 || $resultlab > 116){
				echo "<span style='color:#F00'><strong>$resultlab</strong></span>";
			}else{
				echo "<span style='color:#00F'>$resultlab</span>";
			}
			?>          	<input type="hidden" name="alp_result" id="alp_result" value="<?=$resultlab;?>"><input type="hidden" name="alp_flag" id="alp_flag" value="<?=$flaglab;?>" /></td>
			<td width="12%" class="labfont">(<?=$ranglab?>)</td>
            <td width="8%" align="center" class="labfont"><span <? if($flaglab!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>><?=$flaglab?></span></td>
			<td width="25%" class="labfont"><input name='alp_lab' type='radio' value='ปกติ' <? if($resultlab >= 46 && $resultlab <= 116){ echo "checked";}?>/>
			ปกติ 
			  <input name='alp_lab' type='radio' value='ผิดปกติ' <? if(!empty($resultlab) && $resultlab < 46 || $resultlab > 116){ echo "checked";}?>/>
            <? 
			if(!empty($resultlab) && $resultlab < 46 || $resultlab > 116){
				echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			}else{
				echo "<span style='color:#000'>ผิดปกติ</span>";
			}
			?>            </td>
            </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='ALT' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='ALT' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='ALT' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];

?>            
	  <tr>
	    <td align="right" valign="middle" bordercolor="#FFFFFF" class="text3"><strong>ALT(การทำงานของตับ) :</strong></td>
	    <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	      <?=$resultlab2;?>
	    </span></td>
	    <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	      <?=$resultlab1;?>
	    </span></td>
	    <td align="center" bgcolor="#FFFFFF" class="profilehead">
            <? 
			if($resultlab > 50){
				echo "<span style='color:#F00'><strong>$resultlab</strong></span>";
			}else{
				echo "<span style='color:#00F'>$resultlab</span>";
			}
			?>        <input type="hidden" name="alt_result" id="alt_result" value="<?=$resultlab;?>"><input type="hidden" name="alt_flag" id="alt_flag" value="<?=$flaglab;?>" /></td>
	    <td class="labfont">(<?=$ranglab?>)</td>
	    <td align="center" class="labfont"><span <? if($flaglab!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>><?=$flaglab?></span></td>
	    <td class="labfont"><input name='alt_lab' type='radio' value='ปกติ' <? if($resultlab > 0 && $resultlab <= 50){ echo "checked";}?>/>
ปกติ
  <input name='alt_lab' type='radio' value='ผิดปกติ' <? if($resultlab > 50){ echo "checked";}?>/>
            <? 
			if($resultlab > 50){
				echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			}else{
				echo "<span style='color:#000'>ผิดปกติ</span>";
			}
			?>  		</td>
	    </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='AST' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='AST' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='AST' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];

?>          
	  <tr>
	    <td align="right" valign="middle" bordercolor="#FFFFFF" class="text3"><strong>AST(การทำงานของตับ) :</strong></td>
	    <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	      <?=$resultlab2;?>
	    </span></td>
	    <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	      <?=$resultlab1;?>
	    </span></td>
	    <td align="center" bgcolor="#FFFFFF" class="profilehead">
            <? 
			if($resultlab < 15 || $resultlab > 37){
				echo "<span style='color:#F00'><strong>$resultlab</strong></span>";
			}else{
				echo "<span style='color:#00F'>$resultlab</span>";
			}
			?>       <input type="hidden" name="ast_result" id="ast_result" value="<?=$resultlab;?>"><input type="hidden" name="ast_flag" id="ast_flag" value="<?=$flaglab;?>" /></td>
	    <td class="labfont">(<?=$ranglab?>)</td>
	    <td align="center" class="labfont"><span <? if($flaglab!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>><?=$flaglab?></span></td>
	    <td class="labfont"><input name='ast_lab' type='radio' value='ปกติ' <? if($resultlab >= 15 && $resultlab <= 37){ echo "checked";}?>/>
ปกติ
  <input name='ast_lab' type='radio' value='ผิดปกติ' <? if(!empty($resultlab) && ($resultlab < 15 || $resultlab > 37)){ echo "checked";}?>/>
            <? 
			if(!empty($resultlab) && ($resultlab < 15 || $resultlab > 37)){
				echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			}else{
				echo "<span style='color:#000'>ผิดปกติ</span>";
			}
			?>		</td>
	    </tr>
<?
$bsquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='URIC' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-2)."'";
//echo $bsquery;
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);
$resultlab2=$bssult["result"];

$bquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='URIC' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix-1)."'";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
$resultlab1=$bsult["result"];

$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='URIC' AND a.hn ='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี".($nPrefix)."'";
//echo $labquery;
$row = mysql_query($labquery);
$sult = mysql_fetch_array($row);
$resultlab=$sult["result"];
$unitlab=$sult["unit"];
$ranglab=$sult["normalrange"];
$flaglab=$sult["flag"];

?>        
	  <tr>
	    <td align="right" valign="middle" bordercolor="#FFFFFF" class="text3"><strong>URIC(โรคเก๊าท์) :</strong></td>
	    <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	      <?=$resultlab2;?>
	    </span></td>
	    <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	      <?=$resultlab1;?>
	    </span></td>
	    <td align="center" bgcolor="#FFFFFF" class="profilehead">
            <? 
			if($resultlab < 2.6 || $resultlab > 7.2){
				echo "<span style='color:#F00'><strong>$resultlab</strong></span>";
			}else{
				echo "<span style='color:#00F'>$resultlab</span>";
			}
			?>        <input type="hidden" name="uric_result" id="uric_result" value="<?=$resultlab;?>"><input type="hidden" name="uric_flag" id="uric_flag" value="<?=$flaglab;?>" /></td>
	    <td class="labfont">(<?=$ranglab?>)</td>
	    <td align="center" class="labfont"><span <? if($flaglab!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>><?=$flaglab?></span></td>
	    <td class="labfont"><input name='uric_lab' type='radio' value='ปกติ' <? if($resultlab >= 2.6 && $resultlab <= 7.2){ echo "checked";}?>/>
ปกติ
  <input name='uric_lab' type='radio' value='ผิดปกติ' <? if(!empty($resultlab) && ($resultlab < 2.6 || $resultlab > 7.2)){ echo "checked";}?>/>
            <? 
			if(!empty($resultlab) && ($resultlab < 2.6 || $resultlab > 7.2)){
				echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			}else{
				echo "<span style='color:#000'>ผิดปกติ</span>";
			}
			?>		</td>
	    </tr>
            </table>
        </TD>
	</TR>
	</TABLE>
    <br>
<?
} // close if age
?>        </td>
        </tr>
      <!--จบ อายุมากกว่าหรือเท่ากับ 35 ปี-->   
<? //} //ปิดเช็ค thaywin?>           
      <tr>
        <td colspan="4" align="center" bgcolor="#0099FF"><span class="style1">ประเมินสภาวะความเสี่ยง</span></td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>อาชีวอนามัย</strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFCCCC">ผลสรุป</td>
        <td align="center">:</td>
        <td colspan="2"><input name='health_risk' type='radio' value='มี' id="health_risk1" <?php if($arr_view["health_risk"]=="มี"){ echo "checked"; } ?>/>
          มี
          <input name='health_risk' type='radio' value='ไม่มี' id="health_risk2" <?php if($arr_view["health_risk"]=="ไม่มี" || empty($arr_view["health_risk"])){ echo "checked"; } ?>/>
          ไม่มี</td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>อุบัติเหตุจราจร</strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFCCCC">ผลสรุป</td>
        <td bgcolor="#FFCCCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFCCCC"><input name='accident_risk' type='radio' value='มี' id="accident_risk1" <?php if($arr_view["accident_risk"]=="มี"){ echo "checked"; } ?>/>
มี
  <input name='accident_risk' type='radio' value='ไม่มี' id="accident_risk2" <?php if($arr_view["accident_risk"]=="ไม่มี" || empty($arr_view["accident_risk"])){ echo "checked"; } ?>/> 
  ไม่มี</td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>ยาเสพติด/อบายมุข</strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFCCCC">ผลสรุป</td>
        <td bgcolor="#FFCCCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFCCCC"><input name='addictive_risk' type='radio' value='มี' id="addictive_risk1" <?php if($arr_view["addictive_risk"]=="มี"){ echo "checked"; } ?>/>
มี
  <input name='addictive_risk' type='radio' value='ไม่มี' id="addictive_risk2" <?php if($arr_view["addictive_risk"]=="ไม่มี"  || empty($arr_view["addictive_risk"])){ echo "checked"; } ?>/> 
  ไม่มี</td>
      </tr>
      
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>สุขภาพจิต</strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFCCCC">ระดับคะแนน</td>
        <td bgcolor="#FFCCCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFCCCC"><input name="score_stress" type="text" id="score_stress" value="<?=$arr_view["score_stress"];?>" /></td>
      </tr>
      <tr>
        <td bgcolor="#FFCCCC">ภาวะเครียด</td>
        <td bgcolor="#FFCCCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFCCCC"><input name="result_stress" type="radio" class="frmsaraban" id="result_stress1" value="เครียดน้อย" checked="checked" <?php if($arr_view["result_stress"]=="เครียดน้อย"){ echo "checked"; } ?> />
เครียดน้อย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="result_stress" id="result_stress2" type="radio" class="frmsaraban" value="เครียดปานกลาง" <?php if($arr_view["result_stress"]=="เครียดปานกลาง"){ echo "checked"; } ?> />
เครียดปานกลาง&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="result_stress" id="result_stress3" type="radio" class="frmsaraban" value="เครียดมาก" <?php if($arr_view["result_stress"]=="เครียดมาก"){ echo "checked"; } ?> />
เครียดมาก&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="result_stress" id="result_stress4" type="radio" class="frmsaraban" value="เครียดมากที่สุด" <?php if($arr_view["result_stress"]=="เครียดมากที่สุด"){ echo "checked"; } ?> />
เครียดมากที่สุด</td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>เบาหวาน</strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFCCCC">ผลสรุป</td>
        <td bgcolor="#FFCCCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFCCCC"><input name='diabetes_risk' type='radio' value='มี' id="diabetes_risk1" <?php if($arr_view["diabetes_risk"]=="มี"){ echo "checked"; } ?>/>
          มี
          <input name='diabetes_risk' type='radio' value='ไม่มี' id="diabetes_risk2" <?php if($arr_view["diabetes_risk"]=="ไม่มี" || empty($arr_view["diabetes_risk"])){ echo "checked"; } ?>/>
          ไม่มี</td>
      </tr>
      
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>ไต</strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFCCCC">ผลสรุป</td>
        <td bgcolor="#FFCCCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFCCCC"><input name='kidney_risk' type='radio' value='มี' id="kidney_risk1" <?php if($arr_view["kidney_risk"]=="มี"){ echo "checked"; } ?>/>
          มี
          <input name='kidney_risk' type='radio' value='ไม่มี' id="kidney_risk2" <?php if($arr_view["kidney_risk"]=="ไม่มี" || empty($arr_view["kidney_risk"])){ echo "checked"; } ?>/>
          ไม่มี</td>
      </tr>
      
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>วัณโรค</strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFCCCC">ผลสรุป</td>
        <td bgcolor="#FFCCCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFCCCC"><input name='tb_risk' type='radio' value='มี' id="tb_risk1" <?php if($arr_view["tb_risk"]=="มี"){ echo "checked"; } ?>/>
          มี
          <input name='tb_risk' type='radio' value='ไม่มี' id="tb_risk2" <?php if($arr_view["tb_risk"]=="ไม่มี" || empty($arr_view["tb_risk"])){ echo "checked"; } ?>/>
          ไม่มี</td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>หัวใจ</strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFCCCC">ผลสรุป</td>
        <td bgcolor="#FFCCCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFCCCC"><input name='heart_risk' type='radio' value='มี' id="heart_risk1" <?php if($arr_view["heart_risk"]=="มี"){ echo "checked"; } ?>/>
          มี
          <input name='heart_risk' type='radio' value='ไม่มี' id="heart_risk2" <?php if($arr_view["heart_risk"]=="ไม่มี" || empty($arr_view["heart_risk"])){ echo "checked"; } ?>/>
          ไม่มี</td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>มะเร็ง</strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFCCCC">ผลสรุป</td>
        <td bgcolor="#FFCCCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFCCCC"><input name='cancer_risk' type='radio' value='มี' id="cancer_risk1" <?php if($arr_view["cancer_risk"]=="มี"){ echo "checked"; } ?>/>
          มี
          <input name='cancer_risk' type='radio' value='ไม่มี' id="cancer_risk2" <?php if($arr_view["cancer_risk"]=="ไม่มี" || empty($arr_view["cancer_risk"])){ echo "checked"; } ?>/>
          ไม่มี</td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>HIV</strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFCCCC">ผลสรุป</td>
        <td bgcolor="#FFCCCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFCCCC"><input name='hiv_risk' type='radio' value='มี' id="hiv_risk1" <?php if($arr_view["hiv_risk"]=="มี"){ echo "checked"; } ?>/>
          มี
          <input name='hiv_risk' type='radio' value='ไม่มี' id="hiv_risk2" <?php if($arr_view["hiv_risk"]=="ไม่มี" || empty($arr_view["hiv_risk"])){ echo "checked"; } ?>/>
          ไม่มี</td>
      </tr>
      

      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>ตับ</strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFCCCC">ผลสรุป</td>
        <td bgcolor="#FFCCCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFCCCC"><input name='liver_risk' type='radio' value='มี' id="liver_risk1" <?php if($arr_view["liver_risk"]=="มี"){ echo "checked"; } ?>/>
          มี
          <input name='liver_risk' type='radio' value='ไม่มี' id="liver_risk2" <?php if($arr_view["liver_risk"]=="ไม่มี" || empty($arr_view["liver_risk"])){ echo "checked"; } ?>/>
          ไม่มี</td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>หลอดเลือดสมอง</strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFCCCC">ผลสรุป</td>
        <td bgcolor="#FFCCCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFCCCC"><input name='stroke_risk' type='radio' value='มี' id="stroke_risk1" <?php if($arr_view["stroke_risk"]=="มี"){ echo "checked"; } ?>/>
          มี
          <input name='stroke_risk' type='radio' value='ไม่มี' id="stroke_risk2" <?php if($arr_view["stroke_risk"]=="ไม่มี" || empty($arr_view["stroke_risk"])){ echo "checked"; } ?>/>
          ไม่มี</td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>เก๊าท์</strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFCCCC">ผลสรุป</td>
        <td bgcolor="#FFCCCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFCCCC"><input name='gout_risk' type='radio' value='มี' id="gout_risk1" <?php if($arr_view["gout_risk"]=="มี"){ echo "checked"; } ?>/>
          มี
          <input name='gout_risk' type='radio' value='ไม่มี' id="gout_risk2" <?php if($arr_view["gout_risk"]=="ไม่มี" || empty($arr_view["gout_risk"])){ echo "checked"; } ?>/>
          ไม่มี</td>
      </tr>
      
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>ข้อเข่าเสื่อม</strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFCCCC">ผลสรุป</td>
        <td bgcolor="#FFCCCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFCCCC"><input name='knee_risk' type='radio' value='มี' id="knee_risk1" <?php if($arr_view["knee_risk"]=="มี"){ echo "checked"; } ?>/>
          มี
          <input name='knee_risk' type='radio' value='ไม่มี' id="knee_risk2" <?php if($arr_view["knee_risk"]=="ไม่มี" || empty($arr_view["knee_risk"])){ echo "checked"; } ?>/>
          ไม่มี</td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>กระดูกทับเส้น</strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFCCCC">ผลสรุป</td>
        <td bgcolor="#FFCCCC">&nbsp;</td>
        <td colspan="2" bgcolor="#FFCCCC"><input name='bone_risk' type='radio' value='มี' id="bone_risk1" <?php if($arr_view["bone_risk"]=="มี"){ echo "checked"; } ?>/>
          มี
          <input name='bone_risk' type='radio' value='ไม่มี' id="bone_risk2" <?php if($arr_view["bone_risk"]=="ไม่มี" || empty($arr_view["bone_risk"])){ echo "checked"; } ?>/>
          ไม่มี</td>
      </tr>
      

      
      <tr>
        <td colspan="4" bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#FFCC99"><strong>สรุปเบื้องต้น</strong> <? if($result['bmi'] >=35.0 && $result['bmi'] <=39.9){
			echo "อ้วนมาก";}else if($arr_view['bmi'] >=40.0){
			echo "โรคอ้วน";
		} ?></td>
        </tr>
      <tr>
        <td colspan="4"><input name='resultdiagnormal' type='checkbox' value='1' id="resultdiagnormal" <?php if($arr_view["resultdiag_normal"]==1){ echo "checked"; } ?>/>        
          ไม่พบความเสี่ยงต่อโรค NCDs</td>
        </tr>
      <tr>
        <td colspan="4"><input name='resultdiagrisk' type='checkbox' value='1' id="resultdiagrisk" <?php if($arr_view["resultdiag_risk"]==1){ echo "checked"; } ?>/>
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
        <td colspan="4"><input name='resultdiagdiseases' type='checkbox' value='1' id="resultdiagdiseases" <?php if($arr_view["resultdiag_diseases"]==1){ echo "checked"; } ?>/>
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
        <td height="52" colspan="4" align="center" bgcolor="#FF6699">
<? if($num1 < 1){ ?>
<input name="Submit" type="submit" class="frmsaraban" value="บันทึกข้อมูล" onclick="return checkfrm()" />
<? }else{ ?>
<input name="Submit" type="submit" class="frmsaraban" value="แก้ไขข้อมูล" onclick="return checkfrm()" />
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
													 xray_detail='$_POST[xraydetail]',
													 result_dental='$_POST[resultdental]',
													 dental_disease1='$_POST[dental_disease1]',
													 dental_disease2='$_POST[dental_disease2]',
													 dental_disease3='$_POST[dental_disease3]',	
													 gum_disease1='$_POST[gum_disease1]',
													 gum_disease2='$_POST[gum_disease2]',
													 level_dental='$_POST[level_dental]',
													 other_disease1='$_POST[other_disease1]',
													 other_disease2='$_POST[other_disease2]',													 
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
													 yearchkup='$_POST[yearchkup]'";
													//echo $add;
	if(mysql_query($add)){
		echo "<script>alert('บันทึกข้อมูลเรียบร้อย');window.location='armychkupopd.php';</script>";
	}else{
		echo "<script>alert('ผิดพลาด บันทึกข้อมูลไม่สำเร็จ');window.location='armychkupopd.php';</script>";
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
													 level_dental='$_POST[level_dental]',
													 other_disease1='$_POST[other_disease1]',
													 other_disease2='$_POST[other_disease2]',														 
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
													 lastupdate_officer='$officer' where row_id='$_POST[row_id]'";
													 //echo $edit;
	if(mysql_query($edit)){
		echo "<script>alert('แก้ไขข้อมูลเรียบร้อย');window.location='armychkupopd.php';</script>";
	}else{
		echo "<script>alert('ผิดพลาด แก้ไขข้อมูลไม่สำเร็จ');window.location='armychkupopd.php';</script>";
	}													 
}
?>