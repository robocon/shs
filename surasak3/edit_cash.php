<?php
session_start();
include("connect.inc");

		$query = "SELECT runno, prefix  FROM runno WHERE title = 'y_chekup'";
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
		
		
 $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
$sql = "Select idname From opacc where row_id = '".$_GET["id"]."' ";
$result = Mysql_Query($sql);
$arr = Mysql_fetch_assoc($result);


$xxx = explode(" ",$_SESSION["sOfficer"]);
if($xxx[0] == "นาง"){
	$xxx1 = substr($_SESSION["sOfficer"],4);
}else if($xxx[0] == "นางสาว"){
	$xxx1 = substr($_SESSION["sOfficer"],7);
}else{
	$xxx1 = $_SESSION["sOfficer"];
}


$yyy = explode(" ",$arr["idname"]);
if($yyy[0] == "นาง"){
	$yyy1 = substr($arr["idname"],4);
}else if($yyy[0] == "นางสาว"){
	$yyy1 = substr($arr["idname"],7);
}else{
	$yyy1 = $arr["idname"];
}

if($xxx1 != $yyy1){
	if($_SESSION["sOfficer"] =="CSCD"){ //เงื่อนไข cscd พี่เพชร จัดเก็บรายได้ ให้เพิ่มเมื่อวันที่ 23/06/60
	
	}else{
		echo "ขออภัยครับ ข้อมูลนี้ มีเพียง ".$arr["idname"]." เท่านั้นที่เปลี่ยนได้";
		exit();
	}
}

if(isset($_POST["submit"])){
	

	
	$sql = "Update opacc set credit ='".$_POST["credit"]."', credit_detail = '".$_POST["detail_1"]."' ,idname='".$_SESSION["sOfficer"]."',lastupdate='$Thidate'where row_id = '".$_POST["idrow"]."'   ";

	Mysql_Query($sql);
	echo "แก้ไขข้อมูลเรียบร้อยแล้วครับ";
	echo "
		<SCRIPT LANGUAGE=\"JavaScript\">
		
		window.onload = function(){

			opener.location.href='opdate.php';

		}
		
		</SCRIPT>
	
	";
	exit();


}

include("unconnect.inc");
?>
<SCRIPT LANGUAGE="JavaScript">

	function checkformf1(){
		
		if(document.f1.credit[0].checked == false && document.f1.credit[1].checked == false && document.f1.credit[2].checked == false && document.f1.credit[3].checked == false && document.f1.credit[4].checked == false && document.f1.credit[5].checked == false && document.f1.credit[6].checked == false && document.f1.credit[7].checked == false && document.f1.credit[8].checked == false && document.f1.credit[9].checked == false && document.f1.credit[10].checked == false && document.f1.credit[11].checked == false){
			alert("กรุณาเลือกวิธี ชำระเงินด้วยครับ");
			return false;
		}else if((document.f1.credit[1].checked == true || document.f1.credit[2].checked == true) && document.f1.detail_1.value == ''){
			alert("กรณี ที่ชำระเงินด้วย บัตรเครดิต ให้กรอกข้อมูล หมายเลขเลขบัตรเครดิต ด้วยครับ");
			document.f1.detail_1.focus();
			return false;
		}else if(document.f1.credit[7].checked == true && document.f1.detail_1.value == ''){
			alert("กรณี ที่ชำระเงินแบบ เงินเชื่อ ให้กรอกข้อมูล เพิ่มเติม ด้วยครับ");
			document.f1.detail_1.focus();
			return false;
		}else if(document.f1.credit[8].checked == true && document.f1.detail_1.value == ''){
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
			<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='เงินสด' onclick="document.getElementById('detail1').innerHTML=''; detailhead1.style.display='none';document.f1.detail_1.value='';"></TD>
		 	<TD>เงินสด</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='กรุงเทพ' onclick="document.getElementById('detail1').innerHTML='หมายเลขบัตรเครดิต'; detailhead1.style.display='';document.f1.detail_1.focus();"></TD>
		 	<TD>บัตรเครดิด ธ.กรุงเทพ</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='ทหารไทย' onclick="document.getElementById('detail1').innerHTML='หมายเลขบัตรเครดิต'; detailhead1.style.display='';document.f1.detail_1.focus();"></TD>
		 	<TD>บัตรเครดิด ธ.ทหารไทย</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='จ่ายตรง' onclick="document.getElementById('detail1').innerHTML=''; detailhead1.style.display='none';document.f1.detail_1.value='';"></TD>
		 	<TD>จ่ายตรง</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='จ่ายตรง อปท.' onclick="document.getElementById('detail1').innerHTML=''; detailhead1.style.display='none';document.f1.detail_1.value='';"></TD>
		 	<TD>จ่ายตรง อปท.</TD>
		 </TR>
		 <TR>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='ประกันสังคม' onclick="document.getElementById('detail1').innerHTML=''; detailhead1.style.display='none';document.f1.detail_1.value='';"></TD>
		 	<TD>ประกันสังคม</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='30บาท' onclick="document.getElementById('detail1').innerHTML=''; detailhead1.style.display='none';document.f1.detail_1.value='';"></TD>
		 	<TD>30บาท</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='เงินเชื่อ' onclick="document.getElementById('detail1').innerHTML='ข้อมูลเพิ่มเติม'; detailhead1.style.display='';document.f1.detail_1.focus();"></TD>
		 	<TD>เงินเชื่อ</TD>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='อื่นๆ' onclick="document.getElementById('detail1').innerHTML='ข้อมูลเพิ่มเติม'; detailhead1.style.display='';document.f1.detail_1.focus();"></TD>
		 	<TD>อื่นๆ</TD>
		 </TR>
		 <TR>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='HD' onclick="document.getElementById('detail1').innerHTML=''; detailhead1.style.display='none';document.f1.detail_1.value='';"></TD>
		 	<TD>HD</TD>
		    <TD>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='CHKUP<?=$nPrefix;?>' onclick="document.getElementById('detail1').innerHTML=''; detailhead1.style.display='none';document.f1.detail_1.value='';"></TD>
		    <TD>CHKUP<?=$nPrefix;?></TD>
		    <TD>&nbsp;</TD>
		    <TD>&nbsp;</TD>
		    <TD>&nbsp;</TD>
		 </TR>
		 <TR>
		 	<TD align='right'>&nbsp;&nbsp;<INPUT TYPE='radio' NAME='credit' VALUE='ยกเลิก' onclick="document.getElementById('detail1').innerHTML=''; detailhead1.style.display='none';document.f1.detail_1.value='';"></TD>
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