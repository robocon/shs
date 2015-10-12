<?php
session_start();
include("connect.inc");



if(isset($_POST["submit"]) && $_POST["submit"] == "เพิ่ม"){

$drugcode = $_POST["drugcode"];
	if($drugcode[0] != "0" && $drugcode[0] != "2"){
		$_POST["drug_inject_amount"]="";
		$_POST["drug_inject_slip"]="";
		$_POST["drug_inject_type"] = "";
		$_POST["drug_inject_etc"]="";

	}else if($drugcode[0] == "2"){
			if($drugcode[1] == "0" || $drugcode[1] == "1" || $drugcode[1] == "2" || $drugcode[1] == "3" || $drugcode[1] == "4" || $drugcode[1] == "5" || $drugcode[1] == "6" || $drugcode[1] == "7" || $drugcode[1] == "8" || $drugcode[1] == "9"){

				$_POST["drug_inject_amount"]="";
				$_POST["drug_inject_slip"]="";
				$_POST["drug_inject_type"] = "";
				$_POST["drug_inject_etc"]="";
			
			}

	}

$sql = "INSERT INTO `dr_drugsuit_detail` ( `for_id` , `drugcode` , `amount` , `slcode`, `drug_inject_amount` , `drug_inject_slip`,  `drug_inject_type`,  `drug_inject_etc`  ) VALUES ( '".$_GET["for_id"]."', '".$_POST["drugcode"]."', '".$_POST["amount"]."', '".$_POST["slcode"]."', '".$_POST["drug_inject_amount"]."', '".$_POST["drug_inject_slip"]."', '".$_POST["drug_inject_type"]."', '".$_POST["drug_inject_etc"]."'); ";

$result = Mysql_Query($sql) or die(Mysql_Error());


echo "<META HTTP-EQUIV=\"Refresh\"  CONTENT=\"0;URL=dt_drugsult_detail.php?for_id=".$_GET["for_id"]."\">";
exit();
}else if(isset($_POST["submit"]) && $_POST["submit"] == "แก้ไข"){

$drugcode = $_POST["drugcode"];

	if($drugcode[0] != "0" && $drugcode[0] != "2"){
		$_POST["drug_inject_amount"]="";
		$_POST["drug_inject_slip"]="";
		$_POST["drug_inject_type"] = "";
		$_POST["drug_inject_etc"]="";

	}else if($drugcode[0] == "2"){

			if($drugcode[1] == "0" || $drugcode[1] == "1" || $drugcode[1] == "2" || $drugcode[1] == "3" || $drugcode[1] == "4" || $drugcode[1] == "5" || $drugcode[1] == "6" || $drugcode[1] == "7" || $drugcode[1] == "8" || $drugcode[1] == "9"){

				$_POST["drug_inject_amount"]="";
				$_POST["drug_inject_slip"]="";
				$_POST["drug_inject_type"] = "";
				$_POST["drug_inject_etc"]="";

			}

	}

$sql = "UPDATE `dr_drugsuit_detail` SET `drugcode` = '".$_POST["drugcode"]."', `amount` = '".$_POST["amount"]."', `slcode` = '".$_POST["slcode"]."', `drug_inject_amount` = '".$_POST["drug_inject_amount"]."',
`drug_inject_slip` = '".$_POST["drug_inject_slip"]."',
`drug_inject_type` = '".$_POST["drug_inject_type"]."',
`drug_inject_etc` = '".$_POST["drug_inject_etc"]."'  WHERE `row_id` = '".$_POST["edit_row_id"]."' LIMIT 1 ;
";


$result = Mysql_Query($sql) ;


echo "<META HTTP-EQUIV=\"Refresh\"  CONTENT=\"0;URL=dt_drugsult_detail.php?for_id=".$_GET["for_id"]."\">";
exit();
}else if(isset($_GET["action"]) && $_GET["action"] == "del"){

$sql = "Delete From `dr_drugsuit_detail` where `row_id` = '".$_GET["row_id"]."' AND   `for_id` = '".$_GET["for_id"]."'";
$result = Mysql_Query($sql);


echo "<META HTTP-EQUIV=\"Refresh\"  CONTENT=\"0;URL=dt_drugsult_detail.php?for_id=".$_GET["for_id"]."\">";
exit();
}



?>
<html>
<head>
<style type="text/css">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 24px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_menu {background-color: #FFFFC1;  }
-->
</style>
<SCRIPT LANGUAGE="JavaScript">
<!--

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

function searchSuggest(action,str,len) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'dt_drug.php?action='+action+'&search=' + str;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}
window.onload = function(){

	document.getElementById("drug_code").focus();

}

function add_drug(drugcode){
	
	var returnstr;
	document.getElementById("drug_code").value = drugcode;
	document.getElementById('list').innerHTML='';
	document.getElementById("drug_amount").focus();
}

function addslip(drugslip){
	
	document.getElementById("drug_slip").value = drugslip;
	document.getElementById('list').innerHTML='';
	document.getElementById("form_submit").focus();
}

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

function ajaxcheck(action,str){
	
	xmlhttp = newXmlHttp();
	url = 'dt_drug.php?action='+action+'&search=' + str;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	return xmlhttp.responseText;
}

function checkForm(){

	var stat = true;
	var txt ;
	var txt2 ;
	txt = ajaxcheck("checkdrugcode",document.getElementById('drug_code').value);
	txt = txt.substr(4);

	txt2 = ajaxcheck("checkdrugslip",document.getElementById('drug_slip').value);
	txt2 = txt2.substr(4);

	if(document.getElementById('drug_code').value == ""){
		document.getElementById('drug_code').focus();
		alert("กรุณา กรอก รหัสยา ด้วยครับ");

		stat = false;
	}else if(document.getElementById('drug_amount').value == ""){
		document.getElementById('drug_amount').focus();
		alert("กรุณา กรอก จำนวน ด้วยครับ");
		stat = false;
	}else if(document.getElementById('drug_slip').value == ""){
		document.getElementById('drug_slip').focus();
		alert("กรุณา กรอก รหัสวิธีใช้ยา ด้วยครับ");
		stat = false;
	}else if(txt == "0"){
		alert("รหัสยาไม่ถูกต้องกรุณาลองกรอกใหม่ครับ");
		stat = false;
	}else if(txt2 == "0"){
		alert("รหัสวิธีใช้ยาไม่ถูกต้องกรุณาลองกรอกใหม่ครับ");
		stat = false;
	}
	
	return stat;
}


//-->
</SCRIPT>
</head>
<body>
<?php include("dt_menu.php");?>
<BR>
<TABLE align="center" width="80%">
<TR class="tb_head">
	<TD width="30">No.</TD>
	<TD>ชื่อยา</TD>
	<TD width='100'>จำนวน</TD>
	<TD width='100'>วิธีใช้</TD>
	<TD width="30">แก้ไข</TD>
	<TD width="30">ลบ</TD>
</TR>
<?php
$sql = "Select a.row_id, a.drugcode, b.tradname, a.amount, a.slcode From dr_drugsuit_detail as a, druglst as b where a.drugcode = b.drugcode AND a.for_id = '".$_GET["for_id"]."' ORDER BY a.row_id ASC ";
$result = Mysql_Query($sql) or die(Mysql_error());

$i=1;
while(list($row_id, $drugcode, $tradname, $amount, $slcode) = Mysql_fetch_row($result)){
	if($i%2 == 0)
		$class = "";
	else
		$class = "class='tb_detail'";

echo "<TR ".$class." >";
	echo "<TD  width='30'>".$i.".</TD>";
	echo "<TD>".$tradname."</TD>";
	echo "<TD align='right' width='100'>".$amount."&nbsp;&nbsp;</TD>";
	echo "<TD align='center' width='100'>".$slcode."</TD>";
	echo "<TD  width='30' align='center'><A HREF=\"dt_drugsult_detail.php?action=edit&row_id=".$row_id."&for_id=".$_GET["for_id"]."\">แก้ไข</A></TD>";
	echo "<TD  width='30' align='center'><A HREF=\"dt_drugsult_detail.php?action=del&row_id=".$row_id."&for_id=".$_GET["for_id"]."\">ลบ</A></TD>";
echo "</TR>";
$i++;
}	
?>
</TABLE>

<BR>

<?php

if(isset($_GET["action"]) && $_GET["action"] =="edit"){

	$sql = "Select drugcode,  amount,  slcode, drug_inject_amount, drug_inject_slip, drug_inject_type, drug_inject_etc  From dr_drugsuit_detail where  for_id = '".$_GET["for_id"]."' AND row_id = '".$_GET["row_id"]."' limit 1";
	$result = Mysql_Query($sql);
	list($drugcode,  $amount,  $slcode,$drug_inject_amount, $drug_inject_slip, $drug_inject_type, $drug_inject_etc ) = Mysql_fetch_row($result);

	$hidden = "<INPUT TYPE=\"hidden\" name=\"edit_row_id\" value=\"".$_GET["row_id"]."\">";
	$button="แก้ไข";

}else{
	$hidden = "";
	$button="เพิ่ม";
	$drug_inject_amount='1';
	$drug_inject_slip='ฉีดวิธี:M';
	$drug_inject_type = '(1 DOSE)';
	$drug_inject_etc="";

}

?>
<FORM name="" METHOD=POST ACTION="" Onsubmit="return checkForm();";>
<TABLE border="1" bordercolor="#0046D7"  >
<TR>
	<TD>
<TABLE cellpadding="0" cellspacing="0">
<TR>
	<TD colspan="2" class="tb_head"><?php echo $button;?>ยา</TD>
</TR>
<TR class="tb_detail">
	<TD>&nbsp;&nbsp;รหัสยา : </TD>
	<TD><INPUT ID="drug_code" TYPE="text" NAME="drugcode"value="<?php echo $drugcode;?>" onkeypress="searchSuggest('drug',this.value,3); " onkeydown="if(event.keyCode == 40 && document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }else if(event.keyCode == 40){document.getElementById('drug_amount').focus();}">&nbsp;&nbsp;</TD>
</TR>
<TR class="tb_detail">
	<TD>&nbsp;&nbsp;จำนวน : </TD>
	<TD><INPUT ID="drug_amount" TYPE="text" NAME="amount"value="<?php echo $amount;?>" onkeypress = "if(event.keyCode != 13){ check_number();}" onkeydown="if(event.keyCode == 40){document.getElementById('drug_slip').focus();} if(event.keyCode == 38){document.getElementById('drug_code').focus();}">&nbsp;&nbsp;</TD>
</TR>
<TR class="tb_detail">
	<TD>&nbsp;&nbsp;วิธีใช้ : </TD>
	<TD><INPUT ID="drug_slip" TYPE="text" NAME="slcode"value="<?php echo $slcode;?>" onkeypress="if(event.keyCode == 13){ checkForm1(); return false; }else{ searchSuggest('slip',this.value,2);} " onkeydown="if(event.keyCode == 40 && document.getElementById('list').innerHTML != ''){document.getElementById('choice').focus();document.getElementById('choice').checked=true;return false; }else  if(event.keyCode == 40){document.getElementById('form_submit').focus();} if(event.keyCode == 38){document.getElementById('drug_amount').focus();}">&nbsp;&nbsp;</TD>
</TR>
<TR class="tb_detail" ID="drug_inject_amount"  >
	<TD align="right" class="tb_detail" >จำนวนที่ฉีด : </TD>
	<TD><INPUT TYPE="text" NAME="drug_inject_amount" onkeypress = "if(event.keyCode == 13){ checkForm1(); return false; }"  size="15" value="<?php echo $drug_inject_amount;?>" ></TD>
</TR>
<TR class="tb_detail" ID="drug_inject_slip">
	<TD align="right" class="tb_detail" id="">วิธีฉีด : </TD>
	<TD>
		<SELECT NAME="drug_inject_slip">
		<Option value="ฉีดวิธี:M" <?php if($drug_inject_slip == "ฉีดวิธี:M") echo " Selected ";?> >M</Option>
		<Option value="ฉีดวิธี:V" <?php if($drug_inject_slip == "ฉีดวิธี:V") echo " Selected ";?> >V</Option>	
			<Option value="ฉีดวิธี:SC" <?php if($drug_inject_slip == "ฉีดวิธี:SC") echo " Selected ";?> >SC</Option>
			<Option value="ฉีดวิธี:A" <?php if($drug_inject_slip == "ฉีดวิธี:A") echo " Selected ";?> >A</Option>
			<Option value="">----</Option>
			
		</SELECT>
	</TD>
</TR>
<TR class="tb_detail" ID="drug_inject_type">
	<TD align="right" class="tb_detail">แบบ : </TD>
	<TD>
		<SELECT NAME="drug_inject_type">
			<Option value="">----</Option>
			<Option value="(1 DOSE)" <?php if($drug_inject_type == "(1 DOSE)") echo " Selected ";?>  >1 DOSE</Option>
			<Option value="(1 COURSE)" <?php if($drug_inject_type == "(1 COURSE)") echo " Selected ";?> >1 COURSE</Option>
			<Option value="(3 DOSE)" <?php if($drug_inject_type == "(3 DOSE)") echo " Selected ";?> >3 DOSE</Option>
		</SELECT>
	</TD>
</TR>
<TR class="tb_detail" ID="drug_inject_etc">
	<TD align="right" class="tb_detail">คำสั่งอื่นๆ : </TD>
	<TD><INPUT  TYPE="text" NAME="drug_inject_etc" onkeypress="if(event.keyCode == 13){ checkForm1(); return false; } " size="18" value="<?php echo $drug_inject_etc;?>"></TD>
</TR>
<TR class="tb_detail">
	<TD colspan="2" align="center"><INPUT ID="form_submit" TYPE="submit" name="submit" value="<?php echo $button;?>"   onkeydown="if(event.keyCode == 38){document.getElementById('drug_slip').focus();}">&nbsp;&nbsp;<INPUT TYPE="reset" value="ยกเลิก"><BR><A HREF="dt_drugsult.php">สิ้นสุดการ เพิ่ม/แก้ไข/ลบ รายการยา</A></TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
<Div id="list" style="left:240PX;top:80PX;position:absolute;"></Div>

<?php echo $hidden;?>
</FORM>

</body>
<?php include("unconnect.inc");?>
</html>