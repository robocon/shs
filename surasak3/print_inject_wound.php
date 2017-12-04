<?php
session_start();
include("connect.inc");

Function calcage($birth){
	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
	$ageY=$ageY-1;
	$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

	return $pAge;
}

?>
<body Onload="window.print();">
<html>
<head>
<title>add_user</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="3;URL=inject_wound.php"> 
</head>
<?php



 
if (isset($_POST["hn"])){ 

	$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
	$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
	
	$sql = "Select yot, name, surname, dbirth, ptright From opcard where hn = '".$_POST["hn"]."' limit 0,1 ";
	$result = Mysql_Query($sql);
	list($Yot, $Name, $Surname, $dbirth, $ptright) = Mysql_fetch_row($result);

	$Ptname=$Yot.' '.$Name.' '.$Surname;
	$age = calcage($dbirth);

	 for($i=1;$i<=5;$i++){
		if(isset($_POST["number_inject".$i]) && trim($_POST["number_inject".$i]) != "" ){
			$sql = "INSERT INTO appoint(date,officer,hn,ptname,age,doctor,appdate,apptime,room, detail,detail2,advice,patho,xray,other,depcode) VALUES('".$Thidate."','".$sOfficer."','".$_POST["hn"]."','".$Ptname."','".$age."','".$_POST["doctor"]."','".$_POST["calendar_date".$i]."','".$_POST["capptime".$i]."', 'จุดบริการนัดที่ 1','FU01 ตรวจตามนัด','ฉีด ".$_POST["type"]." เข็มที่ ".$_POST["number_inject".$i]." เข่า ".$_POST["knee"]." ".$_POST["detail".$i]."','NA','NA','NA','','U16  ห้องฉุกเฉิน');";

			$result = mysql_query($sql);
		}
	 }

//พิมพ์ใบนัด

$inhaler = "ห้องฉุกเฉิน";

?>
<TABLE border="1"  bordercolor="#000000" cellspacing="0" cellpadding="0">
<TR>
	<TD>
<TABLE border="0"  bordercolor="#000000" cellspacing="0" cellpadding="0">
<TR>
	<TD width="40%">
<TABLE border="0">
<TR>
	<TD valign="top">
	
	<TABLE border="0" style="font-family: Angsana New; font-size: 18px;">
	<TR>
		<TD colspan="2" align="center"><FONT style="font-family: Angsana New; font-size: 24px;"><B>ใบนัดฉีดเข่าห้องฉุกเฉิน<BR>รพ.ค่ายสุรศักดิ์มนตรี</B></FONT></TD>
	</TR>
	<TR>
		<TD colspan="2"><FONT style="font-family: Angsana New; font-size: 22px;">HN<U>&nbsp;<?php echo $hn;?></U></FONT></TD>
	</TR>
	<TR>
		<TD colspan="2"><FONT style="font-family: Angsana New; font-size: 22px;">ชื่อ<U><B>&nbsp;<?php echo $Ptname;?></B></U></TD>
	</TR>
	<TR>
		<TD colspan="2"><FONT style="font-family: Angsana New; font-size: 22px;">ฉีดยา&nbsp;:&nbsp;<B><?php echo $_POST["type"];?></B>&nbsp;&nbsp;&nbsp;&nbsp;
			เข่าข้าง&nbsp;:&nbsp;<B><?php echo $_POST["knee"];?></B>
		</TD>
	</TR>
	
	<TR>
		<TD colspan="2">ผู้นัด&nbsp;:&nbsp;<?php echo $inhaler;?></U></TD>
	</TR>
	<TR>
		<TD colspan="2">สิทธิ์&nbsp;:&nbsp;<?php echo $ptright;?></U></TD>
	</TR>

	</TABLE>
	
	
	</TD>
	<TD>&nbsp;&nbsp;</TD>
	<TD valign="top" width="60%">
	
	
	<CENTER>
	<B>
	<FONT style="font-family: Angsana New; font-size: 22px;">
	ข้อควรปฏิบัติสำหรับผู้ป่วย
	</FONT></B><BR>
	</CENTER>

	<FONT style="font-family: Angsana New; font-size: 18px;">
	- ยาควรเก็บไว้ในตู้เย็นช่องธรรมดา *ห้ามแช่ช่องแช่แข็ง* <BR>
	&nbsp;&nbsp;เมื่อนำมาฉีดไม่ต้องแช่เย็น<BR>
	- กรุณามาให้ตรงตามนัดทุกครั้ง ยืนใบนัดที่จุดบริการนัดทุกครั้ง<BR>
	- กรุณานำยาฉีดเข่ามาทุกครั้ง<BR>
	- <?php echo $_POST["remark"];?>
	</FONT>
	</TD>
</TR>

</TABLE>
</TD>
</TR>
<TR>
	<TD colspan="3">
		<TABLE border="1" align="center" width="600" bordercolor="#000000" cellspacing="0" cellpadding="0" style="font-family: Angsana New; font-size: 20px;">
<TR align="center">
	<TD>เข็มที่</TD>
	<TD>วันที่นัด</TD>
	<TD>เวลา</TD>
	<TD>หมายเหตุ</TD>
</TR>
<?php for($i=1;$i<=5;$i++){
	if(trim($_POST["calendar_date".$i]) != "" && trim($_POST["number_inject".$i]) != "")
		echo "<TR>
						<TD align='center'>",$_POST["number_inject".$i],"</TD>
						<TD>&nbsp;",$_POST["calendar_date".$i],"</TD>
						<TD align='center'>",$_POST["capptime".$i],"</TD>
						<TD>&nbsp;",$_POST["detail".$i],"</TD>
					</TR>";
	}
	?>
</TABLE><BR>
<CENTER>* กรุณาอย่าลืมนำยาฉีดของท่านมาด้วย *</CENTER>
	</TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
<?php }?>













