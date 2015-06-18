<?php 
session_start();

$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
 include("connect.inc");
?>
<!-- <body Onload="window.print();"> -->
<body >
<html>
<head>
<title>add_user</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">
<!-- <meta http-equiv="refresh" content="3;URL=1hnappoi1.php"> -->
</head>
<?php

if(isset($cHn )){ 

  $appd=$cappdate.' '.$cappmo.' '.$cthiyr;
  $sql = "INSERT INTO appoint(date,officer,hn,ptname,age,doctor,appdate,apptime,room,
	detail,detail2,advice,patho,xray,other,depcode)
	VALUES('$Thidate','$sOfficer','$cHn','$cPtname','$cAge','$cdoctor','$appd','$capptime',
	'$room','$detail','$detail2','$advice','$patho','$xray','$other','$depcode');";
	//$result = mysql_query($sql);
}

?>


<TABLE border="0"  bordercolor="#000000" cellspacing="0" cellpadding="0" width="650" >
<TR>
	<TD>
	<CENTER><B><FONT style="font-family: Angsana New; font-size: 22px;">ใบนัดผู้ป่วย&nbsp;&nbsp;โรงพยาบาลค่ายสุรศักดิ์มนตรี</FONT></B></CENTER>
<TABLE border="1" bordercolor="#000000" cellspacing="0" cellpadding="0" width="650">
<TR>
	<TD valign="top" rowspan="2">
	
	<TABLE border="0" style="font-family: Angsana New; font-size: 18px;" cellspacing="0" cellpadding="0"  width="100%" height="350">
	<TR>
		<TD>&nbsp;&nbsp;<FONT style="font-family: Angsana New; font-size: 25px;" >HN<U>&nbsp;<?php echo $cHn;?></FONT></U></TD>
		<TD><FONT style="font-family: Angsana New; font-size: 25px;" >ID<U>&nbsp;<?php echo $idcard;?></U></FONT></TD>
	</TR>
	<TR>
		<TD colspan="2">&nbsp;&nbsp;ชื่อ<U>&nbsp;<?php echo $cPtname;?></U></TD>
	</TR>
	<TR>
		<TD colspan="2">&nbsp;&nbsp;อายุ<U>&nbsp;<?php echo $cAge;?></U></TD>
	</TR>
	<TR>
		<TD colspan="2">&nbsp;&nbsp;สิทธิ์<U>&nbsp;<?php echo $cptright,"&nbsp;:",$cidguard;?></U></TD>
	</TR>
			<TR bgcolor="#000000" height="2">
		<TD colspan="2"></TD>
	</TR>
	<TR>
		<TD colspan="2">&nbsp;&nbsp;นัดมาวันที่<U>&nbsp;<?php echo $appd,"</U>&nbsp;&nbsp;&nbsp;เวลา<U>&nbsp;",$capptime;?></U></TD>
	</TR>
	<TR>
		<TD colspan="2">&nbsp;&nbsp;ยื่นใบนัดที่<U>&nbsp;<?php echo $room;?></U></TD>
	</TR>
	<TR>
		<TD colspan="2">&nbsp;&nbsp;เพื่อ<U>&nbsp;<?php echo $detail," ",$detail2;?></U></TD>
	</TR>
	<TR>
		<TD colspan="2">&nbsp;&nbsp;แพทย์ผู้นัด<U>&nbsp;<?php echo $cdoctor;?></U></TD>
	</TR>
	</TR>
			<TR bgcolor="#000000" height="2">
		<TD colspan="2"></TD>
	</TR>
	<?php

   if($advice != 'NA') {

       echo "
	   <TR>
		<TD colspan=\"2\">
			&nbsp;&nbsp;ข้อแนะนำ&nbsp;",$advice,"
		</TD>
	</TR>";

    }



   if($patho != 'NA') {

         echo "<TR>
		<TD colspan=\"2\">
			&nbsp;&nbsp;ตรวจพยาธิ&nbsp;",$patho,"
		</TD>
	</TR>";

    }



   if($xray != 'NA') {

        echo "<TD colspan=\"2\">
			&nbsp;&nbsp;ตรวจเอกซเรย์&nbsp;",$xray,"
		</TD>
	</TR>";

    }



   if(!empty($other)) { 

        echo "<TD colspan=\"2\">
			&nbsp;&nbsp;ตรวจ&nbsp;",$other,"
		</TD>
	</TR>";

    }

	?>
	
	<TR>
		<TD colspan="2">&nbsp;&nbsp;วันและเวลาที่ออกใบนัด&nbsp;<?php echo $Thaidate;?>
		</TD>
	</TR>
	</TABLE>
	
	
	</TD>
	<TD valign="top">

	<CENTER>
	<B>
	<FONT style="font-family: Angsana New; font-size: 22px;">
	ข้อควรปฏิบัติสำหรับผู้ป่วย
	</FONT></B><BR>
	</CENTER>

<FONT style="font-family: Angsana New; font-size: 18px;">
		&nbsp;&nbsp;
		<?php

		switch($detail){
			case "FU01 ตรวจตามนัด" : 
				echo "<b>หมายเหตุ:<u>$cidguard</u></b><br>&nbsp;&nbsp;กรุณามาตรงตามวันและเวลานัด&nbsp;<b>ถ้าผิดนัด </b>ให้ยื่นใบนัดที่แผนกทะเบียน &nbsp; "; 
			break;

			case "FU02 ตามผลตรวจ" : 
				echo "<b>หมายเหตุ:<u>$cidguard</u></b><br>&nbsp;&nbsp;กรุณามาตรงตามวันและเวลานัด&nbsp;<b>ถ้าผิดนัด </b>ให้ใบนัดยื่นแผนกทะเบียน &nbsp; </B>";
			break;

			case "FU03 นอนโรงพยาบาล" : 
				echo "<b>หมายเหตุ:<u>$cidguard</u></b><br>&nbsp;&nbsp;ผู้ป่วยนัดนอนโรงพยาบาลให้ยื่นใบนัดที่แผนกทะเบียน  &nbsp;&nbsp;กรุณามาตรงตามวันและเวลานัด <br>&nbsp;&nbsp;  เตรียมเอกสารที่ต้องใช้ในโรงพยาบาล เช่น สำเนาบัตรประจำตัว , หนังสือรับรองสิทธิต่างๆ  &nbsp;<b> </B>";
			break;

			case "FU04 ทันตกรรม" : 
				echo "<b>หมายเหตุ:<u>$cidguard</u></b><br>&nbsp;&nbsp;1.ผู้ป่วยนัดทันตกรรม ให้ยื่นใบนัดที่แผนกทันตกรรม &nbsp;&nbsp;<br>&nbsp;&nbsp;2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b>ถ้าผิดนัด </b>ให้ใบนัดยื่นแผนกทะเบียน &nbsp; </B> ";
			break;

			case "FU05 ผ่าตัด" : 
				echo "<b>หมายเหตุ:<u>$cidguard</u></b><br>&nbsp;&nbsp;1.ผู้ป่วยนัดตรวจผ่าตัดให้ยื่นใบนัดที่แผนกทะเบียน &nbsp;&nbsp;<br>&nbsp;&nbsp;2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b> </B> ";
			break;

			case "FU06 สูติ" : 
				echo "<b>หมายเหตุ:<u>$cidguard</u></b><br>&nbsp;&nbsp;1.ผู้ป่วยนัดตรวจสูติให้ยื่นใบนัดที่แผนกทะเบียน &nbsp;&nbsp;<br>&nbsp;&nbsp;2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b> </B>";
			break;

			case "FU07 คลีนิกฝังเข็ม" : 
				echo "1.ผู้ป่วยนัดตรวจคลีนิกฝังเข็มให้ยื่นใบนัดที่แผนกทะเบียน &nbsp;&nbsp;<br>&nbsp;&nbsp;2.กรุณามาตรงตามวันและเวลานัด&nbsp;<br>&nbsp;&nbsp;3.ทำความสะอาดร่างกายให้เรียบร้อย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.รับประทานอาหารได้ตามปกติ <br>&nbsp;&nbsp; 5.สวมเสื้อผ้าที่ไม่รัดแน่น ควรเป็นเสื้อแขนสั้นหรือกางเกงที่สามารถรูดขึ้นเหนือเข่าได้สะดวก<br>&nbsp;&nbsp; 6.เข้าห้องน้ำ ปัสสาวะให้เรียบร้อยก่อนเพื่อไม่ให้เกิดอาการปวดปัสสาวะขณะฝังเข็ม";
			break;

			case "FU08 Echo" : 
				echo "1.ผู้ป่วยนัดตรวจ Echo ให้ยื่นใบนัดที่จุดนัด &nbsp;&nbsp;<br>&nbsp;&nbsp;2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b>ถ้าผิดนัด </b>ให้ใบนัดยื่นแผนกทะเบียน &nbsp; </B>";
			break;

			case "FU09 มวลกระดูก" : 
				echo "1.ผู้ป่วยนัดตรวจมวลกระดูกให้ยื่นใบนัดที่จุดนัด&nbsp;&nbsp;<br>&nbsp;&nbsp;2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b>ถ้าผิดนัด </b>ให้ใบนัดยื่นแผนกทะเบียน &nbsp; </B>";
			break;

			default : 
				echo "<b><u>$cidguard</u></b><br>&nbsp;&nbsp;1.ผู้ป่วยนัดตรวจให้ยื่นใบนัดที่แผนกทะเบียน &nbsp;&nbsp;<br>&nbsp;&nbsp;2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b> </B> ";
			break;
		}
		?><BR>
		
		</FONT>
		<BR>
	
	</TD>
</TR>
<TR>
	<TD>
	<FONT style="font-family: Angsana New; font-size: 18px;">
		&nbsp;&nbsp;ผู้ออกใบนัด<U>&nbsp;<?php echo $sOfficer,"&nbsp;",$depcode;?></U><BR>
		
		&nbsp;&nbsp;กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br>&nbsp;&nbsp;ในวันเวลาราชการ เวลา 13.00 น. - 15.00 น.<BR>
		&nbsp;&nbsp;โทร 054-221874 ต่อ 1100 , 1125
		</FONT>
	</TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
<?php
 include("unconnect.inc");
session_unregister("cHn");  
session_unregister("cPtname");
session_unregister("cAge");
session_unregister("idcard");
?>