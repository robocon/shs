


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

$ward = array("หอผู้ป่วยรวม"=>"42","หอผู้ป่วย ICU"=>"44","หอผู้ป่วยสูติ"=>"43","หอผู้ป่วยพิเศษ"=>"45");
$room = array("ธรรมดา 300", "พิเศษ 600", "พิเศษ 800", "พิเศษ 1,200");
$book = array("มาแล้ว", "ยังไม่มา", "ออกด้วยคอมพิวเตอร์", "ไม่มี");

include("connect.inc");

if(isset($_POST["add"]) && trim($_POST["add"]) =="ตกลง"){

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
`ptright` = '".$_POST["ptright"]."'
WHERE `date` = '".$_GET["Cdate"]."' AND `an` = '".$_GET["Can"]."' AND `hn` = '".$_GET["Chn"]."' LIMIT 1 ;";

$result = mysql_query($sql);

$sql = "update bed set ptright = '".$_POST["ptright"]."' where an = '".$_GET["Can"]."' limit 1";
$result = mysql_query($sql);

	if($result){
		echo "<meta http-equiv=\"refresh\" content=\"0; URL=ancashdetail.php?Can=".$_GET["Can"]."&Chn=".$_GET["Chn"]."&Cdate=".$_GET["Cdate"]."&weight=".$_POST["weight"]."\">";
	}else{
		echo "ไม่สามารถบันทึกข้อมูลได้";
		echo "<meta http-equiv=\"refresh\" content=\"3; URL=",$_SERVER['PHP_SELF'],"?Can=".$_GET["Can"]."&Chn=".$_GET["Chn"]."&Cdate=".$_GET["Cdate"]."\">";
	}
exit();
}

$sql = "SELECT an,hn,ptname,bedcode,my_ward, my_bedcode, my_earnest, my_confirmbk, my_food, my_cure, my_etc, my_blood,adm_w,ptright FROM ipcard  WHERE `date` = '".$_GET["Cdate"]."' AND `an` = '".$_GET["Can"]."' AND `hn` = '".$_GET["Chn"]."' limit 1 ";

$result = mysql_query($sql);

list($an,$hn,$ptname,$bedcode,$my_ward, $my_bedcode, $my_earnest, $my_confirmbk, $my_food, $my_cure, $my_etc, $my_blood,$adm_w,$ptright) = Mysql_fetch_row($result);

$sql = "SELECT note FROM opcard  WHERE `hn` = '".$_GET["Chn"]."' limit 1 ";

$result = mysql_query($sql);

list($note) = Mysql_fetch_row($result);
?>
<html>
<head>
<title>บันทึกข้อมูลสถานะผู้ป่วยใน</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 20px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }

-->
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
<TABLE bgcolor="#FFFFDD" width="500" align="center" border="1" bordercolor="#0046D7" cellpadding="0" cellspacing="0">
<TR>
	<TD>
<TABLE width="100%">
<TR class="tb_head">
	<TD colspan="2" align="center"> บันทึกข้อมูลสถานะผู้ป่วย </TD>
</TR>
<TR>
	<TD width="50%" align="right">HN : </TD>
	<TD><?php echo $hn;?>
	</TD>
</TR>
<TR>
	<TD align="right">AN : </TD>
	<TD><?php echo $an;?>
	</TD>
</TR>
<TR>
	<TD align="right">ชื่อ - สกุล : </TD>
	<TD><?php echo $ptname;?>
	</TD>
</TR>
<TR>
	<TD align="right">หมายเหตุ: </TD>
	<TD><?php echo $note;?>
	</TD>
</TR>
<TR>
	<TD align="right">หอผู้ป่วยรับ : </TD>
	<TD>
		<select name="ward">
			<?php

			$no_ward = substr($bedcode,0,2);
			foreach ($ward as $key => $value){
				echo "<Option value=\"".$key."\" ";
					if($no_ward == $value) echo " Selected ";
				echo ">".$key."</Option>";
			}			
			?>
		</select>
	</TD>
</TR>
<TR>
	<TD align="right">เตียง/ห้อง : </TD>
	<TD>
		<input name="room" type="text" size="5" value="<?php echo $bedcode;?>" />
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
					/*print " <option value='{$ptright_code}&nbsp;{$ptright_name}' ";
						if(substr($ptright_code,0,3) == substr($ptright,0,3)){ 
							print " Selected ";
						}
					print ">{$ptright_code}&nbsp;{$ptright_name}</option>";*/
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
				//echo "<Option value=\"".$ptright."\" ";			
				//echo ">".$ptright."</Option>";
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
	<TD align="right"><B>ค่าห้องค่าอาหารไม่เกินวันละ : </B></TD>
	<TD><input name="food_money" type="text" size="6" Onkeypress="check_number();" value="<?php echo $my_food;?>"/>&nbsp;บาท <B>(ตามสิทธิ์การรักษา)</B></TD>
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
	<TD colspan="2" align="center"> <INPUT TYPE="submit" name="add" value=" ตกลง ">&nbsp;<INPUT TYPE="reset" value=" ยกเลิก "> </TD>
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