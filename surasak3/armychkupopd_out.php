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
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
.frmsaraban{
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
.labfont {		
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
-->
#showMe{
    display:none;
}
.forntsarabun {	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.style1 {font-family: "TH SarabunPSK"; font-size: 18px; font-weight: bold; }
.frmsaraban1 {	font-family: TH SarabunPSK;
	font-size: 18px;
}
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

<?
if($_POST["act"]=="show"){
	if(!empty($_POST["p_hn"])){
		$sql="select * from  armychkup where hn='$_POST[p_hn]' and yearchkup='$nPrefix' order by row_id asc";
		
		$solsql="select * from chkup_solider where hn='$_POST[p_hn]' and yearchkup='$nPrefix'";
		//echo $solsql;
		$solquery=mysql_query($solsql);
		$solrows=mysql_fetch_array($solquery);	
				
	}else if(!empty($_POST["p_id"])){
		$sql="select * from  armychkup where idcard='$_POST[p_id]' and yearchkup='$nPrefix' order by row_id asc";
		
		$solsql="select * from chkup_solider where idcard='$_POST[p_id]' and yearchkup='$nPrefix'";
		//echo $solsql;
		$solquery=mysql_query($solsql);
		$solrows=mysql_fetch_array($solquery);		
		
	}else if(!empty($_POST["p_name"]) && empty($_POST["p_sname"])){
		$sql="select * from  armychkup where ptname like '%$_POST[p_name]%' and yearchkup='$nPrefix' order by row_id asc";
		
		$solsql="select * from chkup_solider where ptname like '%$_POST[p_name]%' and yearchkup='$nPrefix'";
		//echo $solsql;
		$solquery=mysql_query($solsql);
		$solrows=mysql_fetch_array($solquery);
				
	}else if(!empty($_POST["p_sname"]) && empty($_POST["p_name"])){
		$sql="select * from  armychkup where ptname like '%$_POST[p_sname]%' and yearchkup='$nPrefix' order by row_id asc";
		
		$solsql="select * from chkup_solider where ptname like '%$_POST[p_sname]%' and yearchkup='$nPrefix'";
		//echo $solsql;
		$solquery=mysql_query($solsql);
		$solrows=mysql_fetch_array($solquery);	
				
	}else if(!empty($_POST["p_name"]) && !empty($_POST["p_sname"])){
		$sql="select * from  armychkup where (ptname like '%$_POST[p_name]%') && (ptname like '%$_POST[p_sname]%') and yearchkup='$nPrefix' order by row_id asc";
		
		$solsql="select * from chkup_solider where (ptname like '%$_POST[p_name]%') && (ptname like '%$_POST[p_sname]%') and yearchkup='$nPrefix'";
		echo $solsql;
		$solquery=mysql_query($solsql);
		$solrows=mysql_fetch_array($solquery);			
	}
	// echo $sql;
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
		
	
			
	if(!empty($rows["camp"])){
		$camp=$rows["camp"];
	}else{
		$camp=$solrows["camp"];
	}
	
	if(!empty($rows["chunyot"])){
		$textchunyot=$rows["chunyot"];
		$chunyot=substr($rows["chunyot"],4);
	}else{
		$textchunyot=$solrows["chunyot"];
		$chunyot=substr($solrows["chunyot"],4);
	}
	
	if(!empty($rows["gender"])){
		$gender=$rows["gender"];
	}else{
		$gender=$solrows["gender"];
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

if($num1 > 0){
	$birthday=$arr_view["birthday"];
}

?>
<form name="vsform" action="armychkupopd_out.php" method="post">
<? if($num < 1){ ?>
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
            <option value="D34 กทพ.33" selected="selected">กทพ.33</option>
          </select>
          <input name="dxptright" type="hidden" value="1"></td>
      </tr>
      <tr>
        <td colspan="3" align="left" bgcolor="#FFCC99"><strong>ข้อมูลเบื้องต้น ( หากไม่มีข้อมูล ไม่ต้องใส่เครื่องหมายขีดกลาง (-) )</strong></td>
        </tr>
      <tr>
        <td width="14%"><strong>HN</strong></td>
        <td width="2%" align="center">:</td>
        <td width="84%"><input name="hn" type="text" class="frmsaraban" value="<? if(!empty($rows["hn"])){ echo $rows["hn"];}else{ echo $solrows["hn"];}?>"></td>
      </tr>
      <tr>
        <td><strong>ยศ</strong></td>
        <td align="center">:</td>
        <td><input name="yot" type="text" class="frmsaraban" value="<? if(!empty($rows["yot"])){ echo $rows["yot"];}else{ echo $solrows["yot"];}?>" size="10">
          &nbsp;&nbsp;
          <strong>ชื่อ-นามสกุล</strong> : 
          <input name="ptname" type="text" class="frmsaraban" value="<? if(!empty($rows["ptname"])){ echo $rows["ptname"];}else{ echo $solrows["ptname"];}?>"></td>
      </tr>
      <tr>
        <td><strong>เลขที่บัตรประชาชน</strong></td>
        <td align="center">:</td>
        <td><input name="chkidcard" type="text" class="frmsaraban" value="<? if(!empty($rows["idcard"])){ echo $rows["idcard"];}else{ echo $solrows["idcard"];}?>"></td>
      </tr>
      <tr>
        <td><strong>ชั้นยศ</strong></td>
        <td align="center">:</td>
        <td>
        
          <select name="chunyot" class="forntsarabun" id="chunyot">
            <option value="<?=$textchunyot;?>">
            <?=$chunyot;?>
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
          <input name="gender" type="radio" class="frmsaraban" id="gender1" value="1" <? if($gender==1){ echo "checked";}?>>
          ชาย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input name="gender" type="radio" class="frmsaraban" id="gender2" value="2" <? if($gender==2){ echo "checked";}?>>
          หญิง</td>
      </tr>
      <tr>
        <td><strong>ตำแหน่ง</strong></td>
        <td align="center">:</td>
        <td><input name="position" type="text" class="frmsaraban" value="<? if(!empty($rows["position"])){ echo $rows["position"];}else{ echo $solrows["position"];}?>"></td>
      </tr>
      <tr>
        <td><strong>ช่วยราชการ (ถ้ามี)</strong></td>
        <td align="center">:</td>
        <td><input name="ratchakarn" type="text" class="frmsaraban" value="<? if(!empty($rows["ratchakarn"])){ echo $rows["ratchakarn"];}else{ echo $solrows["ratchakarn"];}?>"></td>
      </tr>
      <tr>
        <td><strong>วัน/เดือน/ปี เกิด</strong></td>
        <td align="center">:</td>
        <td>
        <?
		if(!empty($solrows["birthday"])){
			list($dd1,$mm1,$yy1)=explode(" ",$solrows["birthday"]);
			if($mm1=="มกราคม"){
				$nmm="01";
			}else if($mm1=="กุมภาพันธ์"){
				$nmm="02";
			}else if($mm1=="มีนาคม"){
				$nmm="03";
			}else if($mm1=="เมษายน"){
				$nmm="04";
			}else if($mm1=="พฤษภาคม"){
				$nmm="05";
			}else if($mm1=="มิถุนายน"){
				$nmm="06";
			}else if($mm1=="กรกฎาคม"){
				$nmm="07";
			}else if($mm1=="สิงหาคม"){
				$nmm="08";
			}else if($mm1=="กันยายน"){
				$nmm="09";
			}else if($mm1=="ตุลาคม"){
				$nmm="10";
			}else if($mm1=="พฤศจิกายน"){
				$nmm="11";
			}else if($mm1=="ธันวาคม"){
				$nmm="12";
			}	
		$ndd=sprintf("%02d",$dd1);
		
		$birthday="$yy1-$nmm-$ndd";
		}        
        ?>
        <input name="birthday" type="text" class="frmsaraban" value="<?=$birthday;?>">
        (ตัวอย่าง 2017-01-01)</td>
      </tr>
      <tr>
        <td><strong>อายุ</strong></td>
        <td align="center">:</td>
        <td><input name="age" type="text" class="frmsaraban" value="<? if(!empty($rows["age"])){ echo $rows["age"];}else{ echo $solrows["age"];}?>"></td>
      </tr>
      <tr>
        <td><strong>แพ้ยา</strong></td>
        <td align="center">:</td>
        <td style="color:#FF0000;"><input name="hospitaldrugreact" type="text" class="frmsaraban" value="<?=$chkrows["drugreact"];?>"></td>
      </tr>
      <tr>
        <td colspan="3" bgcolor="#FFCC99"><strong>การตรวจร่างกายทั่วไป ( หากไม่มีข้อมูล ไม่ต้องใส่เครื่องหมายขีดกลาง (-) )</strong></td>
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
        <td><input name="txttemperature" type="text" class="frmsaraban" id="txttemperature" value="<? if(!empty($arr_view["temperature"])){ echo $arr_view["temperature"];}else{ echo "36.5";}?>"> 
          &nbsp;C</td>
      </tr>
      <tr>
        <td><strong>ชีพจร (P)</strong></td>
        <td align="center">:</td>
        <td><input name="txtpulse" type="text" class="frmsaraban" id="txtpulse" value="<? if(!empty($arr_view["pulse"])){ echo $arr_view["pulse"];}else{ echo "80";}?>" onKeyUp="gettext( );">
&nbsp;ครั้ง/นาที</td>
      </tr>
      <tr>
        <td><strong>หายใจ (R)</strong></td>
        <td align="center">:</td>
        <td><input name="txtrate" type="text" class="frmsaraban" id="txtrate" value="<? if(empty($arr_view["rate"])){ echo "20";}else{ echo $arr_view["rate"];}?>">
&nbsp;ครั้ง/นาที</td>
      </tr>
      <tr>
        <td><strong>ความดันโลหิต ครั้งที่ 1</strong></td>
        <td align="center">:</td>
        <td><input name="txtbp1" type="text" class="frmsaraban" id="txtbp1" value="<?=$arr_view["bp1"];?>">
&nbsp;มม. ปรอท</td>
      </tr>
      <tr>
        <td><strong>ความดันโลหิต ครั้งที่ 2</strong></td>
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
        <td><input name="drugreact" type="radio" class="frmsaraban" id="drugreact1" value="0" <? if($arr_view["drugreact"]=="0" || $arr_view["drugreact"]!="1"){ echo "checked='checked'";}?> />
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
      
      <tr>
        <td colspan="3" bgcolor="#FFCC99"><strong>ผล X-Ray</strong></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFCC"><strong>ผลการ X-Ray</strong></td>
        <td align="center" bgcolor="#FFFFCC">:</td>
        <td bgcolor="#FFFFCC"><input name='xray' type='radio' id="xray1" value='ปกติ' checked="checked" />
ปกติ
  <input name='xray' type='radio' value='ผิดปกติ' id="xray2"/>
ผิดปกติ
&nbsp;
<input name='xray' type='radio' value='ไม่มีผล' id="xray3"/>
ไม่มีผล</td>
      </tr>
      <tr>
        <td bgcolor="#FFFFCC"><strong>ค่าผิดปกติ ระบุ</strong></td>
        <td align="center" bgcolor="#FFFFCC">:</td>
        <td bgcolor="#FFFFCC"><input name="xraydetail" type="text" class="frmsaraban1" id="xraydetail" value="<?=$arr_view["xray_detail"];?>" size="50" /></td>
      </tr>
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
<? // if(!empty($rows["age"]) && $rows["age"] >=35 || !empty($solrows["age"]) && $solrows["age"] >=35)){ ?>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
	    <tr>
	      <td colspan="3" align="left" bgcolor="#FFFFCC" class="tb_font_2"><strong>ผล LAB เฉพาะผู้ที่มีอายุมากกว่า 35 ปี ( หากไม่มีข้อมูล ไม่ต้องใส่เครื่องหมายขีดกลาง (-) )</strong></td>
	      </tr>    
	    <tr>
	      <td align="center" valign="middle" bordercolor="#FFFFFF" bgcolor="#33CCCC" class="text3"><strong>LAB ที่ตรวจ</strong></td>
	      <td align="left" bgcolor="#33CCCC" class="labfontlab"><strong>ผลตรวจ</strong></td>
	      <td bgcolor="#33CCCC" class="style1">สรุปผล</td>
	      </tr>
	    <tr>
	      <td width="28%" align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>GLU(เบาหวาน) :</strong></td>
	      <td align="left" bgcolor="#FFFFFF" class="labfontlab"><input name="glu_result" type="text" class="frmsaraban" id="glu_result" value="<?=$rows["glu_result"];?>"></td>
	      <td bgcolor="#FFFFFF" class="labfont"><input name='glu_lab' type='radio' value='ปกติ' <?  if($rows["glu_lab"]=="ปกติ"){ echo "checked";}?>/>
ปกติ
  		<input name='glu_lab' type='radio' value='ผิดปกติ' <? if($rows["glu_lab"]=="ผิดปกติ"){ echo "checked";}?>/>
  		ผิดปกติ</td>
	    </tr>
	    <tr>
          <td align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>URIC(โรคเก๊าท์) :</strong></td>
	      <td align="left" bgcolor="#FFFFFF" class="labfontlab"><input name="uric_result2" type="text" class="frmsaraban" id="uric_result2" value="<?=$rows["uric_result"];?>" /></td>
	      <td bgcolor="#FFFFFF" class="labfont"><input name='uric_lab' type='radio' value='ปกติ' <?  if($rows["uric_lab"]=="ปกติ"){ echo "checked";}?>/>
	        ปกติ
	        <input name='uric_lab' type='radio' value='ผิดปกติ' <? if($rows["uric_lab"]=="ผิดปกติ"){ echo "checked";}?>/>
	        ผิดปกติ</td>
	      </tr>
          
	    <tr>
          <td align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>BUN(การทำงานของไต) :</strong></td>
	      <td align="left" bgcolor="#FFFFFF" class="labfontlab"><input name="bun_result2" type="text" class="frmsaraban" id="bun_result2" value="<?=$rows["bun_result"];?>" /></td>
	      <td bgcolor="#FFFFFF" class="labfont"><input name='bun_lab' type='radio' value='ปกติ' <?  if($rows["bun_lab"]=="ปกติ"){ echo "checked";}?>/>
	        ปกติ
	        <input name='bun_lab' type='radio' value='ผิดปกติ' <? if($rows["bun_lab"]=="ผิดปกติ"){ echo "checked";}?>/>
	        ผิดปกติ</td>
	      </tr>
	    <tr>
          <td align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>CREA(การทำงานของไต) :</strong></td>
	      <td align="left" bgcolor="#FFFFFF" class="labfontlab"><input name="crea_result2" type="text" class="frmsaraban" id="crea_result2" value="<?=$rows["crea_result"];?>" /></td>
	      <td bgcolor="#FFFFFF" class="labfont"><input name='crea_lab' type='radio' value='ปกติ' <?  if($rows["crea_lab"]=="ปกติ"){ echo "checked";}?>/>
	        ปกติ
	        <input name='crea_lab' type='radio' value='ผิดปกติ' <? if($rows["crea_lab"]=="ผิดปกติ"){ echo "checked";}?>/>
	        ผิดปกติ</td>
	      </tr>
	    
	    <tr>
	      <td align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>CHOL(การตรวจไขมัน) :</strong></td>
	      <td align="left" bgcolor="#FFFFFF" class="labfontlab"><input name="chol_result" type="text" class="frmsaraban" id="chol_result" value="<?=$rows["chol_result"];?>"></td>
	      <td bgcolor="#FFFFFF" class="labfont"><input name='chol_lab' type='radio' value='ปกติ' <?  if($rows["chol_lab"]=="ปกติ"){ echo "checked";}?>/>
ปกติ
  		<input name='chol_lab' type='radio' value='ผิดปกติ' <? if($rows["chol_lab"]=="ผิดปกติ"){ echo "checked";}?>/>
  		ผิดปกติ</td>
	    </tr>
   
	    <tr>
	      <td align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>TRIG(การตรวจไขมัน) :</strong></td>
	      <td align="left" bgcolor="#FFFFFF" class="labfontlab"><input name="trig_result" type="text" class="frmsaraban" id="trig_result" value="<?=$rows["trig_result"];?>"></td>
	      <td bgcolor="#FFFFFF" class="labfont"><input name='trig_lab' type='radio' value='ปกติ' <?  if($rows["trig_lab"]=="ปกติ"){ echo "checked";}?>/>
ปกติ
  		<input name='trig_lab' type='radio' value='ผิดปกติ' <? if($rows["trig_lab"]=="ผิดปกติ"){ echo "checked";}?>/>
  		ผิดปกติ</td>
	    </tr>
         
	  <tr>
	    <td align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>HDL(การตรวจไขมันดี) :</strong></td>
	      <td align="left" bgcolor="#FFFFFF" class="labfontlab"><input name="hdl_result" type="text" class="frmsaraban" id="hdl_result" value="<?=$rows["hdl_result"];?>"></td>
	      <td bgcolor="#FFFFFF" class="labfont"><input name='hdl_lab' type='radio' value='ปกติ' <?  if($rows["hdl_lab"]=="ปกติ"){ echo "checked";}?>/>
ปกติ
  		<input name='hdl_lab' type='radio' value='ผิดปกติ' <? if($rows["hdl_lab"]=="ผิดปกติ"){ echo "checked";}?>/>
  		ผิดปกติ</td>
	  </tr>

	  <tr>
	    <td align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>LDL(การตรวจไขมันเลว) :</strong></td>
	      <td align="left" bgcolor="#FFFFFF" class="labfontlab"><input name="ldl_result" type="text" class="frmsaraban" id="ldl_result" value="<?=$rows["ldl_result"];?>"></td>
	      <td bgcolor="#FFFFFF" class="labfont"><input name='ldl_lab' type='radio' value='ปกติ' <?  if($rows["ldl_lab"]=="ปกติ"){ echo "checked";}?>/>
ปกติ
  		<input name='ldl_lab' type='radio' value='ผิดปกติ' <? if($rows["ldl_lab"]=="ผิดปกติ"){ echo "checked";}?>/>
  		ผิดปกติ</td>
	  </tr>

	    <tr>
          <td align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>AST, SGOT(การทำงานของตับ) :</strong></td>
	      <td align="left" bgcolor="#FFFFFF" class="labfontlab"><input name="ast_result" type="text" class="frmsaraban" id="ast_result" value="<?=$rows["ast_result"];?>" /></td>
	      <td bgcolor="#FFFFFF" class="labfont"><input name='ast_lab' type='radio' value='ปกติ' <?  if($rows["ast_lab"]=="ปกติ"){ echo "checked";}?>/>
	        ปกติ
	        <input name='ast_lab' type='radio' value='ผิดปกติ' <? if($rows["ast_lab"]=="ผิดปกติ"){ echo "checked";}?>/>
	        ผิดปกติ</td>
	      </tr>
	    <tr>
          <td align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>ALT, SGPT(การทำงานของตับ) :</strong></td>
	      <td align="left" bgcolor="#FFFFFF" class="labfontlab"><input name="alt_result2" type="text" class="frmsaraban" id="alt_result2" value="<?=$rows["alt_result"];?>" /></td>
	      <td bgcolor="#FFFFFF" class="labfont"><input name='alt_lab' type='radio' value='ปกติ' <?  if($rows["alt_lab"]=="ปกติ"){ echo "checked";}?>/>
	        ปกติ
	        <input name='alt_lab' type='radio' value='ผิดปกติ' <? if($rows["alt_lab"]=="ผิดปกติ"){ echo "checked";}?>/>
	        ผิดปกติ</td>
	      </tr>
	    <tr>
	      <td align="right" valign="middle" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="text3"><strong>ALP, Alkaline phosphatase(ตับ,กระดูก) :</strong></td>
	      <td align="left" bgcolor="#FFFFFF" class="labfontlab"><input name="alp_result" type="text" class="frmsaraban" id="alp_result" value="<?=$rows["alp_result"];?>"></td>
	      <td bgcolor="#FFFFFF" class="labfont"><input name='alp_lab' type='radio' value='ปกติ' <?  if($rows["alp_lab"]=="ปกติ"){ echo "checked";}?>/>
ปกติ
  		<input name='alp_lab' type='radio' value='ผิดปกติ' <? if($rows["alp_lab"]=="ผิดปกติ"){ echo "checked";}?>/>
  		ผิดปกติ</td>
        </tr>
            </table>
<? //} ?>            
            
        </TD>
	</TR>
	</TABLE>
    <br>        </td>
        </tr>
      <!--จบ อายุมากกว่าหรือเท่ากับ 35 ปี-->   
<? //} //ปิดเช็ค thaywin?>
      <tr height="50">
        <td height="52" colspan="3" align="center" bgcolor="#FF6699">
<? if($num < 1){ ?>
<input name="Submit" type="submit" class="frmsaraban" value="กดบันทึกข้อมูลเข้าระบบ" onClick="return checkfrm()" />
<? }else{ ?>
<input name="Submit" type="submit" class="frmsaraban" value="กดเพื่อแก้ไขข้อมูลในระบบ" onClick="return checkfrm()" />
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