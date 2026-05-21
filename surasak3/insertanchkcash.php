<?php
session_start();
if ($_SESSION["sOfficer"] == "") {

	echo "<center><font color='#000000' >ขออภัยครับ การ Login ของท่านหมดอายุ </font><br />";
	echo "<a href=\"../sm3.php\" target=\"_top\">กลับหน้าแรก</a></center>";
	exit();
}
include("connect.php");

if($_GET['load']=='bed'){
	$code = $_GET['code'];
	$sql = "SELECT `bedcode`,CAST(`bedpri` AS UNSIGNED) AS `bedpri` FROM `bed` WHERE `bedcode` LIKE '$code%' AND `status` LIKE 'B01%' AND `hn` = '' ";
	$q = mysql_query($sql) or die("Query failed: ".mysql_error());
	?>
	<select name="" id="" onchange="selectBed(this)">
		<option value="">--- เลือกเตียง ---</option>
	<?php
	while($a = mysql_fetch_assoc($q)){
		?>
		<option value="<?=$a['bedcode'];?>" data-bedpri="<?=$a['bedpri'];?>"><?=$a['bedcode'];?></option>
		<?php
	}
	?>
	</select>
	<?php
	exit;
}
?>
<script language="JavaScript1.2">
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
</script>
<?php 
$ward = array("หอผู้ป่วยรวม"=>"42","หอผู้ป่วย ICU"=>"44","หอผู้ป่วยสูติ"=>"43","หอผู้ป่วยพิเศษ"=>"45","หอผู้ป่วย Cohort Ward"=>"46","หอผู้ป่วย Home Isolation"=>"47","หอผู้ป่วย รพ.สนาม"=>"48");
$room = array("ธรรมดา 300", "พิเศษ 600", "พิเศษ 800","พิเศษ 1200","พิเศษ 1800");
$book = array("มาแล้ว", "ยังไม่มา", "ออกด้วยคอมพิวเตอร์", "ไม่มี");

if(isset($_POST["add"]) && trim($_POST["add"]) =="บันทึกข้อมูล"){

	$sql = "UPDATE `ipcard` SET 
	`my_ward` = '".$_POST["ward"]."',
	`my_bedcode` = '".$_POST["room"]."',
	`my_earnest` = '".$_POST["earnest_money"]."',
	`my_confirmbk` = '".$_POST["confirm_book"]."',
	`my_food` = '".$_POST["food_money"]."',
	`my_cure` = '".$_POST["cure_money"]."',
	`my_etc` = '".$_POST["etc_money"]."',
	`my_blood` = '".$_POST["blood_money"]."',
	`adm_w` = '".$_POST["weight"]."',
	`my_office` = '".$_SESSION["sOfficer"]."',
	`hi_type` = '".$_POST["hi_type"]."',
	`ptright` = '".$_POST["ptright"]."'
	WHERE `date` = '".$_GET["Cdate"]."' AND `an` = '".$_GET["Can"]."' AND `hn` = '".$_GET["Chn"]."' LIMIT 1 ;";
	$result = mysql_query($sql);

	// เพิ่มการเก็บ log เมื่อ 28/4/65 เวลา 09:00 น. //
	$sqllog="insert into log_cashipcard set an='".$_GET["Can"]."',
	hn='".$_GET["Chn"]."',
	ptright='".$_POST["ptright"]."',
	bedcode='".$_POST["room"]."',
	ward='".$_POST["ward"]."',
	hi_type = '".$_POST["hi_type"]."',
	bedpri='".$_POST["food_money"]."',
	officer='".$_SESSION["sOfficer"]."',
	lastupdate='".date("Y-m-d H:i:s")."'";
	$querylog=mysql_query($sqllog);
	//----------------------//

	$my_ward=$_POST["ward"];
	$ptright=substr($_POST["ptright"],0,3);
	if($my_ward=="หอผู้ป่วย Home Isolation"){
		if(isset($_GET["Can"])){
			if($ptright=="R02" || $ptright=="R03" || $ptright=="R04" || $ptright=="R16" || $ptright=="R33"){  //เบิกจ่ายตรง จ่ายตรง อปท. ครูเอกชน ยืนยันจากพี่อึ่ง 22/03/65
				$sql = "update bed set ptright = '".$_POST["ptright"]."', bedpri = '".$_POST["food_money"]."' where an = '".$_GET["Can"]."' limit 1";
				$result = mysql_query($sql);
				//echo $sql;
			}else{
				$sql = "update bed set ptright = '".$_POST["ptright"]."', bedpri = '0.00' where an = '".$_GET["Can"]."' limit 1";
				$result = mysql_query($sql);
			}
		}
		
	}else if($my_ward=="หอผู้ป่วย รพ.สนาม"){
		if(isset($_GET["Can"])){
			if($ptright=="R07" || $ptright=="R50"){  //ประกันสังคม
				$sql = "update bed set ptright = '".$_POST["ptright"]."', bedpri = '".$_POST["food_money"]."' where an = '".$_GET["Can"]."' limit 1";
				$result = mysql_query($sql);
			}else{
				$sql = "update bed set ptright = '".$_POST["ptright"]."', bedpri = '1000.00' where an = '".$_GET["Can"]."' limit 1";
				$result = mysql_query($sql);
			}
		}
	}else{
		if(isset($_GET["Can"])){
			$sql = "update bed set ptright = '".$_POST["ptright"]."' where an = '".$_GET["Can"]."' limit 1";
			$result = mysql_query($sql);
		}
	}
		
	if($result){
		echo "<meta http-equiv=\"refresh\" content=\"0; URL=ancashdetail.php?Can=".$_GET["Can"]."&Chn=".$_GET["Chn"]."&Cdate=".$_GET["Cdate"]."&weight=".$_POST["weight"]."\">";
	}else{
		echo "ไม่สามารถบันทึกข้อมูลได้";
		echo "<p>Error: ".mysql_error()."</p>";
		echo "<meta http-equiv=\"refresh\" content=\"3; URL=",$_SERVER['PHP_SELF'],"?Can=".$_GET["Can"]."&Chn=".$_GET["Chn"]."&Cdate=".$_GET["Cdate"]."\">";
	}
	exit();
} // END บันทึกข้อมูล

$sql = "SELECT an,hn,ptname,bedcode,my_ward, my_bedcode, my_earnest, my_confirmbk, my_food, my_cure, my_etc, my_blood,adm_w,ptright,hi_type FROM ipcard 
WHERE `date` = '".$_GET["Cdate"]."' 
AND `an` = '".$_GET["Can"]."' 
AND `hn` = '".$_GET["Chn"]."' limit 1 ";

$result = mysql_query($sql);
list($an,$hn,$ptname,$bedcode,$my_ward, $my_bedcode, $my_earnest, $my_confirmbk, $my_food, $my_cure, $my_etc, $my_blood,$adm_w,$ptright,$hi_type) = Mysql_fetch_row($result);

$sql = "SELECT note FROM opcard  WHERE `hn` = '".$_GET["Chn"]."' limit 1 ";
$result = mysql_query($sql);
list($note) = Mysql_fetch_row($result);

$sql1 = "SELECT bedpri FROM bed  WHERE `an` = '".$an."' limit 1 ";
$result1 = mysql_query($sql1);
list($mybedpri) = Mysql_fetch_row($result1);

if(empty($ptname)){
	$sql = "SELECT `ptname`,`ptright` FROM `opday` WHERE `an` = '$an' LIMIT 1";
	$q = mysql_query($sql) or die("Query failed: ".mysql_error());
	list($ptname,$ptright) = mysql_fetch_row($q);
}
?>
<html>
<html>
<head>
<title>บันทึกข้อมูลสถานะผู้ป่วยใน</title>
<style type="text/css">
body,td,th {
	font-family: Angsana New;
	font-size: 20px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
</style>
<SCRIPT LANGUAGE="JavaScript">

function check_number() {
e_k=event.keyCode
	if (e_k != 47 && e_k != 46 && (e_k < 48) || (e_k > 57)) {
		event.returnValue = false;
		alert("กรุณากรอกเป็นตัวเลขเท่านั้นค่ะ");
		return false;
	}else{
		return true;
	}
}

</SCRIPT>
</head>
<body>

<SCRIPT LANGUAGE="JavaScript">

function checkForm(){

var txt ;
var stat;
 txt = "";
 stat = true;
	if(document.f1.weight.value==""){
		txt = txt + " กรุณากรอกข้อมูล น้ำหนักตัว ด้วยครับ \n";
		stat = false;
	}

	if(document.f1.food_money.value=="" ){
		txt = txt + " กรุณากรอกข้อมูล ค่าห้องที่เบิกได้ ด้วยครับ \n";
		stat = false;
	
	}
	if(document.f1.food_money.value=="0" ){
		txt = txt + " กรุณากรอกข้อมูล ค่าห้องที่เบิกได้ ด้วยครับ \n";
		stat = false;
	}

	if(document.f1.confirm_book.value==""){
		txt = txt + " กรุณากรอกข้อมูล หนังสือรับรองสิทธิ์ ด้วยครับ \n";
		stat = false;
	}

if(stat == false)
	alert(txt);

return stat;

}

</SCRIPT>
<FORM name="f1" METHOD=POST ACTION="" Onsubmit="return checkForm();">
<TABLE bgcolor="#FFFFDD" width="713" align="center" border="1" bordercolor="#0046D7" cellpadding="0" cellspacing="0">
<TR>
	<TD>
<TABLE width="138%">
<TR class="tb_head">
	<TD colspan="2" align="center"> บันทึกข้อมูลสถานะผู้ป่วย </TD>
</TR>
<TR>
	<TD width="34%" align="right">HN : </TD>
	<TD width="66%"><?php echo $hn;?>	</TD>
</TR>
<TR>
	<TD align="right">AN : </TD>
	<TD><?php echo $an;?>	</TD>
</TR>
<TR>
	<TD align="right">ชื่อ - สกุล : </TD>
	<TD><?php echo $ptname;?>	</TD>
</TR>
<TR>
	<TD align="right">หมายเหตุ: </TD>
	<TD><?php echo $note;?>	</TD>
</TR>
<TR>
	<TD align="right">หอผู้ป่วยรับ : </TD>
	<TD>
		<select name="ward" onchange="showBed(this)">
			<option value="">==&gt; เลือกหอผู้ป่วย &lt;==</option>
			<?php
			$no_ward = substr($bedcode,0,2);
			foreach ($ward as $key => $value){
				$selected = ( $no_ward == $value ) ? 'Selected' : '';
				?>
				<option value="<?=$key?>" <?=$selected?> data-code="<?= $value; ?>"><?=$key?></option>
				<?php
			}
			?>
		</select>
		<script>
			async function showBed(b){
				let code = b.options[b.selectedIndex].getAttribute('data-code');
				const response = await fetch('insertanchkcash.php?load=bed&code='+code);
				const body = await response.text();

				document.getElementById('bedData').innerHTML = body;
			}

			function selectBed(bv){

				let bedpri = bv.options[bv.selectedIndex].getAttribute('data-bedpri');
				// let val = bv.options[bv.selectedIndex].value;
				console.log(bv.value);
				
				document.getElementById('room').value = bv.value;
				document.getElementById('food_money').value = bedpri;
			}
		</script>
	</TD>
</TR>
<TR>
	<TD align="right">เตียง/ห้อง : </TD>
	<TD>
		<input name="room" id="room" type="text" size="5" value="<?php echo $bedcode;?>" />
		<span id="bedData"></span>
	</TD>
</TR>
<TR>
	<TD align="right">น้ำหนักตัว (กก.): </TD>
	<TD><input name="weight" type="text" size="3" maxlength="3" value="<?php echo $adm_w;?>" /></TD>
</TR>
<TR>
	<TD align="right">วางค่ามัดจำ : </TD>
	<TD><input name="earnest_money" type="text" size="6" Onkeypress="check_number();" value="<?php echo $my_earnest;?>" />&nbsp;บาท</TD>
</TR>
<TR>
	<TD align="right">สิทธิ : </TD>
	<TD>
    <?
	$sql = "Select ptright,ptright1 From opcard where hn = '$hn' ";
	$result = mysql_query($sql) or die(mysql_error());
	list($pt1,$pt2) = mysql_fetch_row($result);
	?>
		<select name="ptright">
			<?php
			$sql = "Select * From ptright Order by code ASC ";
			$result = mysql_query($sql) or die(mysql_error());
			while(list($ptright_code, $ptright_name) = mysql_fetch_row($result)){
				$str= "";
				if(substr($ptright,0,3)==$ptright_code){
					$str= "selected";
				}
				elseif(substr($pt1,0,3)==$ptright_code){
					$str= "selected";
				}
				?>
				<option value='<?=$ptright_code?>&nbsp;<?=$ptright_name?>' <?=$str?>><?=$ptright_code?>&nbsp;<?=$ptright_name?></option>
				<?
			}
			?>
		</select>
	</TD>
</TR>
<TR>
	<TD align="right" valign="top">หนังสือรับรองสิทธิ์ : </TD>
	<TD>
		<select name="confirm_book" size="4" multiple>
		<?php
			foreach ($book as $key => $value){
				echo "<Option value=\"".$value."\" ";
				if($value == $my_confirmbk) echo " Selected ";
				echo ">".$value."</Option>";
			}
		?>
		</select>
	</TD>
</TR>
<TR>
	<TD align="right"><B>ราคาเตียง ณ ปัจจุบัน : </B></TD>
	<TD><strong style="color:red; font-size: 28px;"><?php echo $mybedpri;?>&nbsp;บาท </strong><B>(อ้างอิงจากข้อมูลเตียงล่าสุด)</B></TD>
</TR>
<TR>
	<TD align="right"><B>ค่าห้องค่าอาหารไม่เกินวันละ : </B></TD>
	<TD><input name="food_money" id="food_money" type="text" size="10" Onkeypress="check_number();" value="<?php echo $my_food;?>"/>&nbsp;บาท <B>(ตามสิทธิ์การรักษา)</B></TD>
</TR>
<TR>
	<TD align="right"><B>ประเภทผู้ป่วย HI : </B></TD>
	<TD><select size="1" name="hi_type">
	<option value="">-------------- เลือกข้อมูล --------------</option>
	<option value="in" <?php if($hi_type=="in"){ echo "selected='selected'";} ?>>ผู้ป่วย  HI รักษาเรือนรับรอง (ใน)</option>
	<option value="out" <?php if($hi_type=="out"){ echo "selected='selected'";} ?>>ผู้ป่วย  HI รักษาที่บ้าน (นอก)</option>
	
        <?php while($item = mysql_fetch_assoc($q)){ ?>
        <option value="<?php echo $item['name'];?>"><?php echo $item['name'];?></option>
        <?php } ?>
    </select></TD>
</TR>
<TR>
  <TD align="right">&nbsp;</TD>
  <TD><div style="font-size:14px;"><div><strong>1. ผู้ป่วย Home Isolation </strong></div>
  <div style="margin-left:5px;"><strong>สิทธิจ่ายตรง</strong></div>
    <div style="margin-left:10px;">- เบิกค่าห้องได้ 1000 บาท  ไม่เกิน 10 วัน </div>
  <div><strong>2. ผู้ป่วย รพ.สนาม</strong></div>
  <div style="margin-left:5px;"><strong>สิทธิประกันสังคม</strong></div>
  <div style="margin-left:10px;">- เบิกค่าห้องได้ 1500 บาท </div>
  <div style="margin-left:5px;"><strong>สิทธิอื่นๆ</strong></div>
  <div style="margin-left:10px;">- เบิกค่าห้องได้ 1000 บาท </div>
  <div><strong>3. ผู้ป่วย Cohort Ward</strong></div>
  <div style="margin-left:5px;"><strong>สิทธิประกันสังคม</strong></div>
  <div style="margin-left:10px;">- อาการเล็กน้อย (สีเขียว) เบิกค่าห้องได้ 1500 บาท </div>
  <div style="margin-left:10px;">- อาการปานกลาง (สีเหลือง) เบิกค่าห้องได้ 3000 บาท </div>
  <div style="margin-left:10px;">- อาการรุนแรง (สีแดง) เบิกค่าห้องได้ 7500 บาท </div>
  <div style="margin-left:5px;"><strong>สิทธิอื่นๆ</strong></div>
  <div style="margin-left:10px;">- อาการเล็กน้อย (สีเขียว) เบิกค่าห้องได้ 1000 บาท </div>
  <div style="margin-left:10px;">- อาการปานกลาง (สีเหลือง) เบิกค่าห้องได้ 3000 บาท </div>
  <div style="margin-left:10px;">- อาการรุนแรง (สีแดง) เบิกค่าห้องได้ 7500 บาท </div>
  <div><strong>*** ข้อมูลอ้างอิงจากพี่อึ่ง เมื่อ 18/02/65 ***</strong></div></div>  </TD>
</TR>
<TR>
	<TD align="right">ค่ารักษาพยาบาลไม่เกินครั้งละ : </TD>
	<TD><input name="cure_money" type="text" size="6"  value="<?php echo $my_cure;?>" Onkeypress="check_number();"/>&nbsp;บาท (ตามสิทธิ์การรักษา)</TD>
</TR>
<TR>
	<TD align="right">ค่าใช้จ่ายอื่นๆไม่เกินครั้งละ : </TD>
	<TD><input name="etc_money" type="text" size="6"  value="<?php echo $my_etc;?>" Onkeypress="check_number();"/>&nbsp;บาท (ตามสิทธิ์การรักษา)</TD>
</TR>
<TR>
	<TD align="right">ฟอกโลหิตด้วยเครื่องไตเทียม : </TD>
	<TD><input name="blood_money" type="text" size="6"  value="<?php echo $my_blood;?>" Onkeypress="check_number();" />&nbsp;ครั้ง</TD>
</TR>
<TR>
	<TD align="right">ผู้บันทึกข้อมูล : </TD>
	<TD><?php echo $_SESSION["sOfficer"];?></TD>
</TR>
<TR>
	<TD align="center"></TD>
    <TD align="left"><INPUT TYPE="submit" name="add" value="บันทึกข้อมูล">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE="reset" value="  ยกเลิก  "> </TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
</FORM>


</body>
</html>
<?php
include("unconnect.inc");
?>