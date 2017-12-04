<?php
session_start();
include("connect.inc");
 $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
$sql = "Select idname From opacc where row_id = '".$_GET["id"]."' ";
$result = Mysql_Query($sql);
$arr = Mysql_fetch_assoc($result);

//if($_SESSION["sOfficer"] != $arr["idname"] ){

//echo "ขออภัยครับ ข้อมูลนี้ มีเพียง ".$arr["idname"]." เท่านั้นที่เปลี่ยนได้";

//exit();

//}


if(isset($_POST["submit"])){
	

	
	$sql = "Update opacc set credit ='".$_POST["credit"]."', credit_detail = '".$_POST["detail_1"]."',idname='".$_SESSION["sOfficer"]."',lastupdate='$Thidate' where row_id = '".$_POST["idrow"]."'   ";

	Mysql_Query($sql);
	echo "แก้ไขข้อมูลเรียบร้อยแล้วครับ";
	echo "
		<SCRIPT LANGUAGE=\"JavaScript\">
		
		window.onload = function(){

			opener.location.href='opdatecscd.php';

		}
		
		</SCRIPT>
	
	";
	exit();


}

include("unconnect.inc");
?>
<SCRIPT LANGUAGE="JavaScript">

	function checkformf1(){
		
		if(document.f1.credit[0].checked == false && document.f1.credit[1].checked == false && document.f1.credit[2].checked == false && document.f1.credit[3].checked == false && document.f1.credit[4].checked == false && document.f1.credit[5].checked == false && document.f1.credit[6].checked == false && document.f1.credit[7].checked == false && document.f1.credit[8].checked == false){
			alert("กรุณาเลือกวิธี ชำระเงินด้วยครับ");
			return false;
	
		}else if(document.f1.credit[2].checked == true && document.f1.detail_1.value == ''){
			alert("ให้กรอกเหตุผล");
			document.f1.detail_1.focus();
			return false;
		}else if(document.f1.credit[7].checked == true && document.f1.detail_1.value == ''){
			alert("กรณีที่เลือก อื่นๆ ให้กรอกข้อมูล เพิ่มเติม ด้วยครับ");
			document.f1.detail_1.focus();
			return false;
		}

	}


</SCRIPT>

แก้ไขข้อมูลการจ่ายเงิน

<FORM name="f1" METHOD=POST ACTION="" onsubmit="return checkformf1();">
<TABLE>
		 <TR>
		 <TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='ติดCอปท.' onclick="document.getElementById('detail1').innerHTML='รหัสที่ติด'; detailhead1.style.display='';document.f1.detail_1.focus();"></TD>
		 	<TD>ติดCอปท.</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='ยกเลิก' onclick="document.getElementById('detail1').innerHTML='ให้กรอกเหตุผล'; detailhead1.style.display='';document.f1.detail_1.focus();"></TD>
		 	<TD colspan="6">ยกเลิก</TD>
		 </TR>
		 <TR>
		 	<TD colspan="8"><span id='detailhead1' style='display:none'><span id='detail1'></span><INPUT TYPE='text' NAME='detail_1'></span></TD>
		 </TR>
		 <TR>
		 	<TD colspan="8"><INPUT TYPE="submit" name="submit" value="ตกลง"></TD>
		 </TR>
		 </TABLE>
		 <INPUT TYPE="hidden" name="idrow" value="<?php echo $_GET["id"];?>">
</FORM>