<?php
session_start();
include("connect.inc");
?>
<body Onload="window.print();">
<html>
<head>
<title>โปรแกรมนัด 3</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">
</head>
<body>
<!--<meta http-equiv="refresh" content="3;URL=appoint3.php">-->

 <?php 
 $def_fullm_th = array('01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', 
 '05' => 'พฤษภาคม', '06' => 'มิถุนายน', '07' => 'กรกฎาคม', '08' => 'สิงหาคม', 
 '09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม');

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

$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
$appd = $_POST["appdate"].' '.$_POST["appmo"].' '.$_POST["thiyr"];
$count = count($_POST["list_hn"]);
	
for($i=0;$i<$count;$i++){
	
	for($n=1;$n<=$_POST["hdnLine"];$n++)
	{
		$appd = $_POST["appdate$n"].' '.$_POST["appmo$n"].' '.$_POST["thiyr$n"];
		
		$appdate_en = ($_POST["thiyr$n"]-543).'-'.array_search($_POST["appmo$n"], $def_fullm_th).'-'.$_POST["appdate$n"];
		$sql = "Select CONCAT( `yot` , ' ', `name` , ' ', `surname` ) AS `full_name`, dbirth, ptright, idguard From opcard where hn = '".$_POST["list_hn"][$i]."' limit 1 ";
		$result = Mysql_Query($sql);
		list($fullname, $dbirth, $ptright, $idguard) = Mysql_fetch_row($result);

		$age = calcage($dbirth);
		
		if($_POST["list_hn"][$i] == "")
			continue;
			
		$sql = "INSERT INTO appoint(date,officer,hn,ptname,age,doctor,appdate,apptime,room,detail,detail2,advice,patho,xray,other,depcode,appdate_en)VALUES('".$Thidate."','".$_SESSION["sOfficer"]."','".$_POST["list_hn"][$i]."','".$fullname."','".$age."','".$_POST["doctor"]."','".$appd."','".$_POST["capptime"]."','".$_POST["room"]."','".$_POST["detail"]."','".$_POST["detail2"]."','".$_POST["advice"]."','".$_POST["patho"]."','".$_POST["xray"]."','".$_POST["other"]."','".$_POST["depcode"]."','$appdate_en');";
		$result = Mysql_Query($sql);
		
	}
	/************************ ออก ใบนัด ***************************/
	$y=date("Y")+543;
	$d=date("-m-d");
	$date=$y.$d;
	$sql="select appdate from appoint where date like '$date%' and  hn='".$_POST["list_hn"][$i]."'  order by appdate asc";
	$query=mysql_query($sql);

	?>
    <div style="position: absolute;top: 0;right: 0;"><img src="printQrCode.php?hn=<?=$_POST["list_hn"][$i];?>&margin=1"></div>
    <?php
	print "<font face='Angsana New' size='3'><center><b>ใบนัดผู้ป่วย";
	print "&nbsp;&nbsp;&nbsp;&nbsp;โรงพยาบาลค่ายสุรศักดิ์มนตรี  ลำปาง </b> </center>";
	print "<font face='Angsana New' size='1'><center>FR-OPD-004/1,03, 08 ก.ย. 51 </center>";
	print "<b><font face='Angsana New' size='3'>ชื่อ: ".$fullname."  </b>&nbsp;&nbsp;&nbsp;<b>HN:</b> ".$_POST["list_hn"][$i]." &nbsp;<b>อายุ:</b> ".$age."&nbsp;<B>สิทธิ:".$ptright."&nbsp;:<u>".$idguard."</u></font></B><br>";
	while($arr=mysql_fetch_row($query)){
	print "<b><font face='Angsana New' size='2'><U>นัดมาวันที่: ".$arr[0]." &nbsp;&nbsp;&nbsp; </b><b> เวลา:</b> ".$_POST["capptime"]."</U></FONT><br>";
	}
	print "<font face='Angsana New' size='3'><b><U>ยื่นใบนัดที่:&nbsp; ".$_POST["room"]."</U></b><font face='Angsana New' size='2'>&nbsp;&nbsp;&nbsp;";

	if($_POST["detail"] !='NA') { 
		print "<font face='Angsana New' size='2'><b>เพื่อ:</b>&nbsp; ".$_POST["detail"]."&nbsp;&nbsp;<font face='Angsana New' size='2'><b>แพทย์ผู้นัด:</b>&nbsp; ".$_POST["doctor"]."</b><br>";
	}

	if(!empty($_POST["detail2"])) { 
		print "<b>:</b>&nbsp; ".$_POST["detail2"]."<br>";
	}

	if($_POST["advice"] != 'NA') {
		print "<b>ข้อแนะนำ:</b> &nbsp;".$_POST["advice"]."&nbsp;&nbsp;,&nbsp;";
	}

	if($_POST["patho"] != 'NA') {
		print "<b>ตรวจพยาธิ:</b>&nbsp; ".$_POST["patho"]."&nbsp;&nbsp;,&nbsp;";
	}

	if($_POST["xray"] != 'NA') {
		print "<b>ตรวจเอกซเรย์:</b>&nbsp; ".$_POST["xray"]."<br>";
	}

	if(!empty($_POST["other"])) { 
		print "<b>ตรวจ:</b>&nbsp; ".$_POST["other"]."<br>";
	}

	print "<b>ผู้ออกใบนัด:</b>&nbsp; ".$_SESSION["sOfficer"].",&nbsp; ".$_POST["depcode"]." "; 
	print "&nbsp;&nbsp;<b>วันและเวลาที่ออกใบนัด&nbsp;:</b>".$Thaidate."<br>"; 

	if($_POST["detail"] =='FU01 ตรวจตามนัด' ){ 
		print "<font face='Angsana New' size='2'><b>หมายเหตุ:<u>".$idguard."</u></b><br>กรุณามาตรงตามวันและเวลานัด&nbsp;<b>ถ้าผิดนัด </b>ให้ยื่นใบนัดที่แผนกทะเบียน &nbsp; <br><b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br> ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1100 , 1125</b>"; 
	} 
	else  if ($_POST["detail"] =='FU02 ตามผลตรวจ' ){ 
		print "<b>หมายเหตุ:<u>".$idguard."</u></b><BR>กรุณามาตรงตามวันและเวลานัด&nbsp;<b>ถ้าผิดนัด </b>ให้ใบนัดยื่นแผนกทะเบียน &nbsp; </B><br><b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br> ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1100 , 1125</b>"; 
	} 
	else  if ($_POST["detail"] =='FU03 นอนโรงพยาบาล') { 
		print "<b>หมายเหตุ:<u>".$idguard."</u></b><br>ผู้ป่วยนัดนอนโรงพยาบาลให้ยื่นใบนัดที่แผนกทะเบียน  &nbsp;&nbsp; กรุณามาตรงตามวันและเวลานัด <br>  เตรียมเอกสารที่ต้องใช้ในโรงพยาบาล เช่น สำเนาบัตรประจำตัว , หนังสือรับรองสิทธิต่างๆ  &nbsp;<b> </B><br><b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br> ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1100 , 1125</b>";  
	}
	else if($_POST["detail"] =='FU04 ทันตกรรม') { 
		print "<font face='Angsana New' size='2'><b>หมายเหตุ:<u>".$idguard."</u></b><BR>1.ผู้ป่วยนัดทันตกรรม ให้ยื่นใบนัดที่แผนกทันตกรรม &nbsp;&nbsp; 2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b>ถ้าผิดนัด </b>ให้ใบนัดยื่นแผนกทะเบียน &nbsp; </B> <br><b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br> ในวันเวลาราชการ โทร 054-839305-6 ต่อ 1230</b>"; 
	} 
	else if ($_POST["detail"] =='FU05 ผ่าตัด') { 
		print "<font face='Angsana New' size='2'><b>หมายเหตุ:<u>".$idguard."</u></b><BR>1.ผู้ป่วยนัดตรวจผ่าตัดให้ยื่นใบนัดที่แผนกทะเบียน &nbsp;&nbsp; 2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b> </B><br><b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br> ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1100 , 1125</b> "; 
	} 
	else if ($_POST["detail"] =='FU06 สูติ') { 
		print "<font face='Angsana New' size='2'><b>หมายเหตุ:<u>".$idguard."</u></b><BR>1.ผู้ป่วยนัดตรวจสูติให้ยื่นใบนัดที่แผนกทะเบียน &nbsp;&nbsp; 2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b> </B><br><b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br> ในวันเวลาราชการ โทร 054-839305-6 ต่อ 5111 </b>";  
	} 
	else  if($_POST["detail"] =='FU07 คลีนิกฝังเข็ม'){ 
		print "<font face='Angsana New' size='2'>
		1.ทำความสะอาดร่างกายให้เรียบร้อย&nbsp;&nbsp;
		2.รับประทานอาหารได้ตามปกติ <br> 
		3.สวมเสื้อผ้าที่ไม่รัดแน่น ควรเป็นเสื้อแขนสั้นหรือกางเกงที่สามารถรูดขึ้นเหนือเข่าได้สะดวก<br> 
		4.เข้าห้องน้ำ ปัสสาวะให้เรียบร้อยก่อนเพื่อไม่ให้เกิดอาการปวดปัสสาวะขณะฝังเข็ม<br>
		5.ดื่มน้ำ 1 แก้วหลังฝังเข็มเสร็จ ถ้ามีการกระหายน้ำ&nbsp;&nbsp;
		6.กรุณามาตรงตามวันและเวลานัด&nbsp;<br>  <b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ ในวันเวลาราชการ  โทร 054-839305-6 ต่อ  2111</b>";
		
			
			
				
				
	}
	else  if($_POST["detail"] =='FU08 Echo'){ 
		print "<font face='Angsana New' size='2'>1.ผู้ป่วยนัดตรวจ Echo ให้ยื่นใบนัดที่จุดนัด &nbsp;&nbsp; 2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b>ถ้าผิดนัด </b>ให้ใบนัดยื่นแผนกทะเบียน &nbsp; </B><br><b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br> ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1100 , 1125</b>";  
	}
	else  if($_POST["detail"] =='FU09 มวลกระดูก'){ 
		print "<font face='Angsana New' size='2'>1.ผู้ป่วยนัดตรวจมวลกระดูกให้ยื่นใบนัดที่จุดนัด&nbsp;&nbsp; 2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b>ถ้าผิดนัด </b>ให้ใบนัดยื่นแผนกทะเบียน &nbsp; </B><br><b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br> ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1100 , 1125</b>";  
	}
	else  if($_POST["detail"] =='FU12 นวดแผนไทย'){ 

		print "<font face='Angsana New' size='2'> 1.ผู้ป่วยนัดนวดแผนไทยให้ยื่นใบนัดที่แผนกกายภาพบำบัด(นวดแผนไทย)&nbsp;&nbsp;<BR> 2.หากผู้ป่วยมาไม่ตรงเวลาที่นัดเกิน 10 นาที ทางโรงพยาบาลจะถือว่าท่านสละสิทธิ์และทำการนัดครั้งต่อไป<br> หมายเลขโทรศัพท์ 054-839305-6 ต่อ 8002, 8001 </b>";  

	} 
	else  if ($_POST["detail"] =='FU31 OPD PM&R'){ 
		
		print "<b>หมายเหตุ:<u>$cidguard</u></b><BR>1.ผู้ป่วยนัดตรวจให้ยื่นใบนัดที่กายภาพบำบัด ชั้น2 &nbsp;&nbsp;
	2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b> </B> <BR>
		3.<b>ถ้าผิดนัด </b>ให้ใบนัดยื่นแผนกทะเบียน &nbsp; </B><br><b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 1 วันทำการ<br> ในวันเวลาราชการ เวลา 09.00 น. - 15.00 น. โทร 054-839305-6 ต่อ 8002</b>"; 

	}
	else  { 
		print "<b>หมายเหตุ:<u>".$idguard."</u></b><BR>1.ผู้ป่วยนัดตรวจให้ยื่นใบนัดที่แผนกทะเบียน &nbsp;&nbsp; 2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b> </B> ";  
	}


	/********************************************************* ออกใบนัด ********************************************************/
	if($n>0)
		echo "<DIV style=\"page-break-after:always\"></DIV>";
}
 
	/*******************************************************************************************************************************************/


include("unconnect.inc");

?>
</body>
</html>