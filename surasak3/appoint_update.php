<?php 
session_start();
include("connect.inc");
$row_id=$_GET["row_id"];

$sql = "SELECT * FROM appoint WHERE row_id = '$row_id' ";
$query = mysql_query($sql)or die("Query failed appoint");
$result = mysql_fetch_array($query);


if($_POST["act"]=="edit"){
	$row_id=$_POST["row_id"];
	$detail=$_POST["detail"];
	$room=$_POST["room"];
	$capptime=$_POST["capptime"];
	$advice=$_POST["advice"];
	$depcode=$_POST["depcode"];
	$appdate_en=$_POST["appdate_en"];
	
	$chkdate=date("Y-m-d");
	if($chkdate >= $appdate_en){  //ถ้าวันที่ปัจจุบันเกินวันที่นัดไปแล้ว
		echo "<script>alert('ไม่สามารถแก้ไขนัดได้ เนื่องจากเลยวันที่นัดมาแล้ว');window.close();</script>";	
	}else{	
		$edit="UPDATE appoint SET detail='$detail',room='$room',capptime='$capptime',advice='$advice',depcode='$depcode',officer='".$_SESSION['sOfficer']."' WHERE row_id='$row_id'";
		if(mysql_query($edit)){
			echo "<script>alert('แก้ไขข้อมูลเรียบร้อย');window.close();</script>";
		}else{
			echo "<script>alert('ไม่สามารถแก้ไขข้อมูลได้ กรุณาลองใหม่อีกครั้ง');window.location='appoint_update?row_id=$row_id';</script>";
		}
	}
}
?>
<style type="text/css">
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 22px;
}
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}	
</style>
<SCRIPT LANGUAGE="JavaScript">
function checkList(){
	if(document.getElementById("depcode").value==""){
		alert("กรุณาเลือกแผนกที่นัด");
		document.getElementById("depcode").focus()
		return false;		
	}else{
		return true;
	}
}
</script>
<FORM name="f1" METHOD=POST ACTION="appoint_update.php" onsubmit="return checkList()">
<input name="act" type="hidden" value="edit"/>
<input name="row_id" type="hidden" value="<?php echo $row_id;?>" />
<input name="appdate_en" type="hidden" value="<?php echo $result["appdate_en"];?>" />
<TABLE bgcolor="#ABEBC6" width="80%" align="center" border="0" bordercolor="#1E8449" cellpadding="5" cellspacing="5">
<TR>
	<TD>
<TR>
	<TD colspan="2" align="center"><strong>แก้ไขข้อมูลการนัด</strong></TD>
</TR>
<TR>
	<TD width="24%" align="right">วันที่นัด : </TD>
	<TD width="56%"><?php echo $result["appdate"];?>	</TD>
</TR>
<TR>
	<TD width="24%" align="right">แพทย์ผู้นัด : </TD>
	<TD width="56%"><?php echo $result["doctor"];?>	</TD>
</TR>
<TR>
	<TD width="24%" align="right">HN : </TD>
	<TD width="56%"><?php echo $result["hn"];?>	</TD>
</TR>
<TR>
	<TD width="24%" align="right">ชื่อ - นามสกุล : </TD>
	<TD width="56%"><?php echo $result["ptname"];?>	</TD>
</TR>

<TR>
	<TD width="24%" align="right">นัดมาเพื่อ : </TD>
	<TD width="56%">
	<select name="detail" class="forntsarabun">
	<?
	$sql1="select * from applist where status='Y'";
	$query1=mysql_query($sql1);
	while($result1=mysql_fetch_array($query1)){
		if($result["detail"]==$result1["appvalue"]){
	?>
		<option value="<?=$result1['appvalue']?>" selected><?=$result1['applist']?></option>
	<?	
		}else{
	?>	
	<option value="<?=$result1['appvalue']?>"><?=$result1['applist']?></option>
	<?
		}
	}
	?>
	</select>
	</TD>
</TR>
<TR>
	<TD width="24%" align="right">ยื่นใบนัดที่ : </TD>
	<TD width="56%">
      <select name="room" class="forntsarabun">
        <option value='NA' <? if($result["room"]=='NA'){ echo "selected"; } ?>>----------- เลือกข้อมูล -----------</option>
        <option value='จุดบริการนัดที่ 1' <? if($result["room"]=='จุดบริการนัดที่ 1'){ echo "selected"; } ?>>จุดบริการนัดที่ 1</option>
        <option value='อาคารเฉลิมพระเกียรติ' <? if($result["room"]=='อาคารเฉลิมพระเกียรติ'){ echo "selected"; } ?>>อาคารเฉลิมพระเกียรติ</option>
        <option value='แผนกทะเบียน' <? if($result["room"]=='แผนกทะเบียน'){ echo "selected"; } ?>>แผนกทะเบียน</option>
        <option value='ห้องฉุกเฉิน' <? if($result["room"]=='ห้องฉุกเฉิน'){ echo "selected"; } ?>>ห้องฉุกเฉิน</option>
        <option value='กองทันตกรรม' <? if($result["room"]=='กองทันตกรรม'){ echo "selected"; } ?>>กองทันตกรรม</option>
        <option value='แผนกพยาธิวิทยา' <? if($result["room"]=='แผนกพยาธิวิทยา'){ echo "selected"; } ?>>แผนกพยาธิวิทยา</option>
        <option value='แผนกเอกชเรย์' <? if($result["room"]=='แผนกเอกชเรย์'){ echo "selected"; } ?>>แผนกเอกชเรย์</option>
        <option value='กองสูติ-นารี' <? if($result["room"]=='กองสูติ-นารี'){ echo "selected"; } ?>>กองสูติ-นารี</option>
        <option value='กายภาพ' <? if($result["room"]=='กายภาพ'){ echo "selected"; } ?>>กายภาพ</option>
        <option value='คลีนิกฝังเข็ม' <? if($result["room"]=='คลีนิกฝังเข็ม'){ echo "selected"; } ?>>คลีนิกฝังเข็ม</option>
        <option value='นวดแผนไทย' <? if($result["room"]=='นวดแผนไทย'){ echo "selected"; } ?>>นวดแผนไทย</option>
        <option value='ห้องตรวจจักษุ(ตา)' <? if($result["room"]=='ห้องตรวจจักษุ(ตา)'){ echo "selected"; } ?>>ห้องตรวจจักษุ(ตา)</option>
        <option value='ห้องตรวจกายภาพบำบัด(ตึกกายภาพ)' <? if($result["room"]=='ห้องตรวจกายภาพบำบัด(ตึกกายภาพ)'){ echo "selected"; } ?>>ห้องตรวจกายภาพบำบัด(ตึกกายภาพ)</option>
        <option value='ตรวจตามนัด OPDเวชศาสตร์ฟื้นฟู' <? if($result["room"]=='ตรวจตามนัด OPDเวชศาสตร์ฟื้นฟู'){ echo "selected"; } ?>>ตรวจตามนัด OPDเวชศาสตร์ฟื้นฟู</option>
        <option value='คลีนิกโรคไต' <? if($result["room"]=='คลีนิกโรคไต'){ echo "selected"; } ?>>คลีนิกโรคไต</option>
		<option value='กายภาพบำบัดชั้น 2' <? if($result["room"]=='กายภาพบำบัดชั้น 2'){ echo "selected"; } ?>>กายภาพบำบัดชั้น 2</option>
        <option value='ห้อง CT SCAN' <? if($result["room"]=='ห้อง CT SCAN'){ echo "selected"; } ?>>ห้อง CT SCAN</option>  
        <option value='ห้องเก็บเงินรายได้ เบอร์4' <? if($result["room"]=='ห้องเก็บเงินรายได้ เบอร์4'){ echo "selected"; } ?>>ห้องเก็บเงินรายได้ เบอร์4</option>       
        <option value='ห้อง CT SCAN (ตรวจมวลกระดูก)' <? if($result["room"]=='ห้อง CT SCAN (ตรวจมวลกระดูก)'){ echo "selected"; } ?>>ห้อง CT SCAN (ตรวจมวลกระดูก)</option>
		<option value='ห้องตรวจเฉพาะโรค' <? if($result["room"]=='ห้องตรวจเฉพาะโรค'){ echo "selected"; } ?>>ห้องตรวจเฉพาะโรค</option>
		<option value='แผนกตรวจสุขภาพ' <? if($result["room"]=='แผนกตรวจสุขภาพ'){ echo "selected"; } ?>>แผนกตรวจสุขภาพ</option>
		<option value='คลินิก ARI (ติดเชื้อระบบทางเดินหายใจ)' <? if($result["room"]=='คลินิก ARI (ติดเชื้อระบบทางเดินหายใจ)'){ echo "selected"; } ?>>คลินิก ARI (ติดเชื้อระบบทางเดินหายใจ)</option>
		<option value='อาคารแพทย์ทางเลือก' <? if($result["room"]=='อาคารแพทย์ทางเลือก'){ echo "selected"; } ?>>อาคารแพทย์ทางเลือก</option>
        </select>
	</TD>
</TR>
<TR>
	<TD width="24%" align="right">เวลานัด : </TD>
	<TD width="56%">
      <select name="capptime" class="forntsarabun">
        <option value='' <? if($result["apptime"]==''){ echo "selected"; } ?>>-------- เลือกข้อมูล --------</option>
		<option value='08:00 น. - 10.00 น.' <? if($result["apptime"]=='08:00 น. - 10.00 น.'){ echo "selected"; } ?>>08:00 น. - 10.00 น.</option>
		<option value='08:00 น. - 11.00 น.' <? if($result["apptime"]=='08:00 น. - 11.00 น.'){ echo "selected"; } ?>>08:00 น. - 11.00 น.</option>
		<option value='07:00 น.' <? if($result["apptime"]=='07:00 น.'){ echo "selected"; } ?>>07:00 น.</option>
		<option value='07:30 น.' <? if($result["apptime"]=='07:30 น.'){ echo "selected"; } ?>>07:30 น.</option>
		<option value='08:00 น.' <? if($result["apptime"]=='08:00 น.'){ echo "selected"; } ?>>08:00 น.</option>
		<option value='08:30 น.' <? if($result["apptime"]=='08:30 น.'){ echo "selected"; } ?>>08:30 น.</option>
		<option value='09:00 น.' <? if($result["apptime"]=='09:00 น.'){ echo "selected"; } ?>>09:00 น.</option>
		<option value='09:30 น.' <? if($result["apptime"]=='09:30 น.'){ echo "selected"; } ?>>09:30 น.</option>
		<option value='10:00 น.' <? if($result["apptime"]=='10:00 น.'){ echo "selected"; } ?>>10:00 น.</option>
		<option value='10:30 น.' <? if($result["apptime"]=='10:30 น.'){ echo "selected"; } ?>>10:30 น.</option>
		<option value='11:00 น.' <? if($result["apptime"]=='11:00 น.'){ echo "selected"; } ?>>11:00 น.</option>
		<option value='11:30 น.' <? if($result["apptime"]=='11:30 น.'){ echo "selected"; } ?>>11:30 น.</option>
		<option value='12:00 น.' <? if($result["apptime"]=='12:00 น.'){ echo "selected"; } ?>>12:00 น.</option>
		<option value='12:30 น.' <? if($result["apptime"]=='12:30 น.'){ echo "selected"; } ?>>12:30 น.</option>
		<option value='13:00 น.' <? if($result["apptime"]=='13:00 น.'){ echo "selected"; } ?>>13:00 น.</option>
		<option value='13:30 น.' <? if($result["apptime"]=='13:30 น.'){ echo "selected"; } ?>>13:30 น.</option>
		<option value='14:00 น.' <? if($result["apptime"]=='14:00 น.'){ echo "selected"; } ?>>14:00 น.</option>
		<option value='14:30 น.' <? if($result["apptime"]=='14:30 น.'){ echo "selected"; } ?>>14:30 น.</option>
		<option value='15:00 น.' <? if($result["apptime"]=='15:00 น.'){ echo "selected"; } ?>>15:00 น.</option>
		<option value='15:30 น.' <? if($result["apptime"]=='15:30 น.'){ echo "selected"; } ?>>15:30 น.</option>
		<option value='16:00 น.' <? if($result["apptime"]=='16:00 น.'){ echo "selected"; } ?>>16:00 น.</option>
		<option value='16:30 น.' <? if($result["apptime"]=='16:30 น.'){ echo "selected"; } ?>>16:30 น.</option>
		<option value='17:00 น.' <? if($result["apptime"]=='17:00 น.'){ echo "selected"; } ?>>17:00 น.</option>
		<option value='17:30 น.' <? if($result["apptime"]=='17:30 น.'){ echo "selected"; } ?>>17:30 น.</option>
		<option value='18:00 น.' <? if($result["apptime"]=='18:00 น.'){ echo "selected"; } ?>>18:00 น.</option>
		<option value='18:30 น.' <? if($result["apptime"]=='18:30 น.'){ echo "selected"; } ?>>18:30 น.</option>
		<option value='19:00 น.' <? if($result["apptime"]=='19:00 น.'){ echo "selected"; } ?>>19:00 น.</option>
		<option value='19:30 น.' <? if($result["apptime"]=='19:30 น.'){ echo "selected"; } ?>>19:30 น.</option>
		<option value='20:00 น.' <? if($result["apptime"]=='20:00 น.'){ echo "selected"; } ?>>20:00 น.</option>
		<option value='20:30 น.' <? if($result["apptime"]=='20:30 น.'){ echo "selected"; } ?>>20:30 น.</option>
		<option value='21:00 น.' <? if($result["apptime"]=='21:00 น.'){ echo "selected"; } ?>>21:00 น.</option>
		
        </select>
	</TD>
</TR>
<TR>
	<TD width="24%" align="right">ข้อควรปฏิบัติก่อนพบแพทย์ : </TD>
	<TD width="56%">
      <select name="advice" class="forntsarabun">
        <option value='ไม่มี' <? if($result["advice"]=='' || $result["advice"]=='NA' || $result["advice"]=='ไม่มี'){ echo "selected"; } ?>>ไม่มี</option>
		<option value='ไม่ต้องงดน้ำหรืออาหาร' <? if($result["advice"]=='ไม่ต้องงดน้ำหรืออาหาร'){ echo "selected"; } ?>>ไม่ต้องงดน้ำหรืออาหาร</option>
		<option value='งดน้ำหวานและอาหารหลังเวลา 20:00 น.(ให้ดื่มน้ำเปล่าได้)' <? if($result["advice"]=='งดน้ำหวานและอาหารหลังเวลา 20:00 น.(ให้ดื่มน้ำเปล่าได้)'){ echo "selected"; } ?>>งดน้ำหวานและอาหารหลังเวลา 20:00 น.(ให้ดื่มน้ำเปล่าได้)</option>
		<option value='งดน้ำหวานและอาหารหลังเวลา 24:00 น.(ให้ดื่มน้ำเปล่าได้)' <? if($result["advice"]=='งดน้ำหวานและอาหารหลังเวลา 24:00 น.(ให้ดื่มน้ำเปล่าได้)'){ echo "selected"; } ?>>งดน้ำหวานและอาหารหลังเวลา 24:00 น.(ให้ดื่มน้ำเปล่าได้)</option>
		<option value='งดน้ำและอาหารหลังเวลา 20:00 น.' <? if($result["advice"]=='งดน้ำและอาหารหลังเวลา 20:00 น.'){ echo "selected"; } ?>>งดน้ำและอาหารหลังเวลา 20:00 น.</option>
		<option value='งดน้ำและอาหารหลังเวลา 20:00 น. ดื่มน้ำเปล่าได้' <? if($result["advice"]=='งดน้ำและอาหารหลังเวลา 20:00 น. ดื่มน้ำเปล่าได้'){ echo "selected"; } ?>>งดน้ำและอาหารหลังเวลา 20:00 น. ดื่มน้ำเปล่าได้</option>
		<option value='งดน้ำและอาหารหลังเวลา .............. น.' <? if($result["advice"]=='งดน้ำและอาหารหลังเวลา .............. น.'){ echo "selected"; } ?>>งดน้ำและอาหารหลังเวลา .............. น.</option>
		<option value='เอกซเรย์ ก่อนพบแพทย์' <? if($result["advice"]=='เอกซเรย์ ก่อนพบแพทย์'){ echo "selected"; } ?>>เอกซเรย์ ก่อนพบแพทย์</option>
		<option value='งดสวมใส่เครื่องประดับทุกชนิด งดทาโลชั่น แป้งบริเวณต้นคอ แขน และขา' <? if($result["advice"]=='งดสวมใส่เครื่องประดับทุกชนิด งดทาโลชั่น แป้งบริเวณต้นคอ แขน และขา'){ echo "selected"; } ?>>งดสวมใส่เครื่องประดับทุกชนิด งดทาโลชั่น แป้งบริเวณต้นคอ แขน และขา</option>
		<option value='เก็บปัสสาวะส่งตรวจก่อนพบแพทย์' <? if($result["advice"]=='เก็บปัสสาวะส่งตรวจก่อนพบแพทย์'){ echo "selected"; } ?>>เก็บปัสสาวะส่งตรวจก่อนพบแพทย์</option>
		<option value='งดน้ำ อาหารตั้งแต่เวลา...............วันที่......................' <? if($result["advice"]=='งดน้ำ อาหารตั้งแต่เวลา...............วันที่......................'){ echo "selected"; } ?>>งดน้ำ อาหารตั้งแต่เวลา...............วันที่......................</option>
		<option value='ดื่มน้ำเปล่ามากๆ ก่อนเวลานัดตรวจ ประมาณครึ่งชั่วโมง แล้วกลั้นปัสสาวะไว้จนกว่าจำทำการตรวจเสร็จ' <? if($result["advice"]=='ดื่มน้ำเปล่ามากๆ ก่อนเวลานัดตรวจ ประมาณครึ่งชั่วโมง แล้วกลั้นปัสสาวะไว้จนกว่าจำทำการตรวจเสร็จ'){ echo "selected"; } ?>>ดื่มน้ำเปล่ามากๆ ก่อนเวลานัดตรวจ ประมาณครึ่งชั่วโมง แล้วกลั้นปัสสาวะไว้จนกว่าจำทำการตรวจเสร็จ</option>
		<option value='วันที่......................มื้อเย็น รับประทานอาหารอ่อน เช่น ข้าวต้ม โจ๊ก เวลา 20.00 น. ทานยาระบาย 3 เม็ด' <? if($result["advice"]=='วันที่......................มื้อเย็น รับประทานอาหารอ่อน เช่น ข้าวต้ม โจ๊ก เวลา 20.00 น. ทานยาระบาย 3 เม็ด'){ echo "selected"; } ?>>วันที่......................มื้อเย็น รับประทานอาหารอ่อน เช่น ข้าวต้ม โจ๊ก เวลา 20.00 น. ทานยาระบาย 3 เม็ด</option>
		<option value='หลังเที่ยงคืน งดอาหารและน้ำ จนกว่าจะทำการตรวจเสร็จ' <? if($result["advice"]=='หลังเที่ยงคืน งดอาหารและน้ำ จนกว่าจะทำการตรวจเสร็จ'){ echo "selected"; } ?>>หลังเที่ยงคืน งดอาหารและน้ำ จนกว่าจะทำการตรวจเสร็จ</option>
		<option value='เช้าวันที่......................สวนอุจจาระก่อนมาโรงพยาบาล' <? if($result["advice"]=='เช้าวันที่......................สวนอุจจาระก่อนมาโรงพยาบาล'){ echo "selected"; } ?>>เช้าวันที่......................สวนอุจจาระก่อนมาโรงพยาบาล</option>
		<option value='งดน้ำและอาหารหลังเวลา 24:00 น.' <? if($result["advice"]=='งดน้ำและอาหารหลังเวลา 24:00 น.'){ echo "selected"; } ?>>งดน้ำและอาหารหลังเวลา 24:00 น.</option>
		<option value='งดน้ำและอาหารหลังเวลา 24:00 น. หลังเวลา 08:00 น. เริ่มกลั้นปัสสาวะ' <? if($result["advice"]=='งดน้ำและอาหารหลังเวลา 24:00 น. หลังเวลา 08:00 น. เริ่มกลั้นปัสสาวะ'){ echo "selected"; } ?>>งดน้ำและอาหารหลังเวลา 24:00 น. หลังเวลา 08:00 น. เริ่มกลั้นปัสสาวะ</option>
		<option value='ดื่มน้ำมากๆ แล้วกลั้นปัสสาวะจนกว่าจะตรวจเสร็จ' <? if($result["advice"]=='ดื่มน้ำมากๆ แล้วกลั้นปัสสาวะจนกว่าจะตรวจเสร็จ'){ echo "selected"; } ?>>ดื่มน้ำมากๆ แล้วกลั้นปัสสาวะจนกว่าจะตรวจเสร็จ</option>
		<option value='นำผลเก่ามาด้วยทุกครั้ง' <? if($result["advice"]=='นำผลเก่ามาด้วยทุกครั้ง'){ echo "selected"; } ?>>นำผลเก่ามาด้วยทุกครั้ง</option>
        </select>
	</TD>
</TR>
<TR>
	<TD width="24%" align="right">แผนกที่นัด : </TD>
	<TD width="56%">
      <select name="depcode" id="depcode" class="forntsarabun">
		<option value='' <? if($result["depcode"]=='NA' || $result["depcode"]=='' || $result["<เลือกแผนกที่นัด>"]){ echo "selected"; } ?>>-------- เลือกข้อมูล --------</option>
		<option value='U03 หอผู้ป่วยสูตินรี' <? if($result["depcode"]=='U03 หอผู้ป่วยสูตินรี'){ echo "selected"; } ?>>U03 หอผู้ป่วยสูตินรี</option>
		<option value='U04 หอผู้ป่วยหนักICU' <? if($result["depcode"]=='U04 หอผู้ป่วยหนักICU'){ echo "selected"; } ?>>U04 หอผู้ป่วยหนักICU</option>
		<option value='U05 ห้องผ่าตัด' <? if($result["depcode"]=='U05 ห้องผ่าตัด'){ echo "selected"; } ?>>U05 ห้องผ่าตัด</option>
		<option value='U06 วิสัญญี' <? if($result["depcode"]=='U06 วิสัญญี'){ echo "selected"; } ?>>U06 วิสัญญี</option>
		<option value='U07 หอผู้ป่วยพิเศษ3' <? if($result["depcode"]=='U07 หอผู้ป่วยพิเศษ3'){ echo "selected"; } ?>>U07 หอผู้ป่วยพิเศษ3</option>
		<option value='U08 หอผู้ป่วยรวม' <? if($result["depcode"]=='U08 หอผู้ป่วยรวม'){ echo "selected"; } ?>>U08 หอผู้ป่วยรวม</option>
		<option value='U09 ห้องตรวจโรค' <? if($result["depcode"]=='U09 ห้องตรวจโรค'){ echo "selected"; } ?>>U09 ห้องตรวจโรค</option>
		<option value='U10 แผนกพยาธิ' <? if($result["depcode"]=='U10 แผนกพยาธิ'){ echo "selected"; } ?>>U10 แผนกพยาธิ</option>
		<option value='U11 แผนกเอกซ์เรย์' <? if($result["depcode"]=='U11 แผนกเอกซ์เรย์'){ echo "selected"; } ?>>U11 แผนกเอกซ์เรย์</option>
		<option value='U12 แผนกไตเทียม' <? if($result["depcode"]=='U12 แผนกไตเทียม'){ echo "selected"; } ?>>U12 แผนกไตเทียม</option>
		<option value='U13 กองทันตกรรม' <? if($result["depcode"]=='U13 กองทันตกรรม'){ echo "selected"; } ?>>U13 กองทันตกรรม</option>
		<option value='U16 ห้องฉุกเฉิน' <? if($result["depcode"]=='U16 ห้องฉุกเฉิน'){ echo "selected"; } ?>>U16 ห้องฉุกเฉิน</option>
		<option value='U19 กองตรวจโรคผู้ป่วยสูติ' <? if($result["depcode"]=='U19 กองตรวจโรคผู้ป่วยสูติ'){ echo "selected"; } ?>>U19 กองตรวจโรคผู้ป่วยสูติ</option>
		<option value='U20 กายภาพ' <? if($result["depcode"]=='U20 กายภาพ'){ echo "selected"; } ?>>U20 กายภาพ</option>
		<option value='U21 นวดแผนไทย' <? if($result["depcode"]=='U21 นวดแผนไทย'){ echo "selected"; } ?>>U21 นวดแผนไทย</option>
		<option value='U22 ห้องตรวจจักษุ(ตา)' <? if($result["depcode"]=='U22 ห้องตรวจจักษุ(ตา)'){ echo "selected"; } ?>>U22 ห้องตรวจจักษุ(ตา)</option>
		<option value='U23 ห้องตรวจเวชศาสตร์ฯ' <? if($result["depcode"]=='U23 ห้องตรวจเวชศาสตร์ฯ'){ echo "selected"; } ?>>U23 ห้องตรวจเวชศาสตร์ฯ</option>
		<option value='U24 คลินิกฝังเข็ม' <? if($result["depcode"]=='U24 คลินิกฝังเข็ม'){ echo "selected"; } ?>>U24 คลินิกฝังเข็ม</option>
		<option value='U25 CT Scan' <? if($result["depcode"]=='U25 CT Scan'){ echo "selected"; } ?>>U25 CT Scan</option>
		<option value='U26 คลินิกโรคไต' <? if($result["depcode"]=='U26 คลินิกโรคไต'){ echo "selected"; } ?>>U26 คลินิกโรคไต</option>
		<option value='U27 OPD PM&R' <? if($result["depcode"]=='U27 OPD PM&R'){ echo "selected"; } ?>>U27 OPD PM&R</option>
		<option value='U28 ตรวจมวลกระดูก' <? if($result["depcode"]=='U28 ตรวจมวลกระดูก'){ echo "selected"; } ?>>U28 ตรวจมวลกระดูก</option>
		<option value='U29 แผนกตรวจสุขภาพ' <? if($result["depcode"]=='U29 แผนกตรวจสุขภาพ'){ echo "selected"; } ?>>U29 แผนกตรวจสุขภาพ</option>
		<option value='U30 ไตเทียม 2' <? if($result["depcode"]=='U30 ไตเทียม 2'){ echo "selected"; } ?>>U30 ไตเทียม 2</option>
		<option value='U31 คลินิกโรคทางเดินหายใจ' <? if($result["depcode"]=='U31 คลินิกโรคทางเดินหายใจ'){ echo "selected"; } ?>>U31 คลินิกโรคทางเดินหายใจ</option>
        </select>
	</TD>
</TR>
<TR>
	<TD colspan="2" align="center"><INPUT TYPE="submit" name="submit"  value="แก้ไขข้อมูล" class="forntsarabun"></TD>
</TR>
</TABLE>
</FORM>