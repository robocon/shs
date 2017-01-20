<?php
session_start();
?>
<body>
<html>
<head>
<title>ใบนัดผู้ป่วย รพ.ค่ายสุรศักดิ์มนตรี</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">
</head>
<?php
function jschars($str){
    $str = str_replace("\\\\", "\\\\", $str);
    $str = str_replace("\"", "\\\"", $str);
    $str = str_replace("'", "\\'", $str);
    $str = str_replace("\r\n", "\\n", $str);
    $str = str_replace("\r", "\\n", $str);
    $str = str_replace("\n", "\\n", $str);
    $str = str_replace("\t", "\\t", $str);
    $str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
    $str = str_replace(">", "\\x3E", $str);
    return $str;
}

if (isset($cHn )){ 

    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    
    include("connect.inc");
    
    if($detail=="FU13 ตรวจระบบทางเดินอาหาร"){
        $detail2=$detail_list;
    }

	if(!isset($appd) OR $appd == null){
		$appd = $_POST['appd'];
	}else{
		$appd = $appd;
	}
   
	$patho = "NA";

    $xray=$xray.' '.$xray2;
    $xrayall=$xray.' '.jschars($xray2);

	$count = count($_SESSION["list_code"]);

    if($count > 0){
    
        $sql = "INSERT INTO `appoint_lab` ( `id` , `code` )  VALUES ";
            
        $list = array();
        for ($n=0; $n<$count; $n++){
            If (!empty($_SESSION["list_code"][$n])){
                $q = "('".$idno."', '".$_SESSION["list_code"][$n]."')  ";
                array_push($list,$q);
            }
        }
            
        $sql .= implode(", ",$list);
        $result = Mysql_Query($sql) or die("Error appoint_lab ".Mysql_Error());
        $patho = implode(", ",$_SESSION["list_code"]);
    }

    $pathoall=$patho.' '.$patho2;

	$sqltel = "update opcard SET phone='".$_POST['telp']."' where hn='".$cHn."'";
	$result = mysql_query($sqltel);
	
	
    $sql = "INSERT INTO appoint(date,officer,hn,ptname,age,doctor,appdate,apptime,room,
detail,detail2,advice,patho,xray,other,depcode,labextra)
VALUES('$Thidate','$sOfficer','$cHn','$cPtname','$cAge','$cdoctor','$appd','$capptime',
'$room','$detail','".jschars($detail2)."','$advice','$pathoall','$xrayall','".jschars($other)."','$depcode','".jschars($labm)."');";

    $result = mysql_query($sql);
    $idno = mysql_insert_id();

    $count = count($_SESSION["list_code"]);

    if($count > 0){
    
        $sql = "INSERT INTO `appoint_lab` ( `id` , `code` )  VALUES ";
            
        $list = array();
        for ($n=0; $n<$count; $n++){
            If (!empty($_SESSION["list_code"][$n])){
                $q = "('".$idno."', '".$_SESSION["list_code"][$n]."')  ";
                array_push($list,$q);
                
            }
        }
            
        $sql .= implode(", ",$list);
    
        $result = Mysql_Query($sql) or die("Error appoint_lab ".Mysql_Error());
        $patho = implode(", ",$_SESSION["list_code"]);
    }

    $pathoall=$patho.' '.$patho2;

//พิมพ์ใบนัด
////////////////////////

    $exm = explode(" ",$appd);
    
    $d1 = $exm[0]; 
    $m1 = trim($exm[1]); 
    $y1 = $exm[2]-543; 
    
    $arr1 = array("มกราคม" => "01" ,"กุมภาพันธ์" => "02", "มีนาคม" => "03" , "เมษายน" => "04" ,"พฤษภาคม" => "05" ,"มิถุนายน" => "06" , "กรกฎาคม" => "07" , "สิงหาคม" => "08" , "กันยายน" => "09" , "ตุลาคม"  => "10" , "พฤศจิกายน" => "11" ,  "ธันวาคม" => "12" );
    
    $appday = $y1.'-'.$arr1[$m1].'-'.$d1;
    
    $DayOfWeek = date("w", strtotime($appday));

	
    switch ($DayOfWeek) {
    case "0":
        $day="อาทิตย์";
        break;
    case "1":
        $day="จันทร์";
        break;
    case "2":
        $day="อังคาร";
        break;
    case "3":
        $day="พุธ";
        break;
    case "4":
        $day="พฤหัสบดี";
        break;
    case "5":
        $day="ศุกร์";
        break;
    case "6":
        $day="เสาร์";
        break;
    }
    
    if($detail=="FU05 ผ่าตัด"){
        $wardor=substr($depcode,4);//ward or
        $timeor= $_POST["time1"].":".$_POST["time2"].":00";//time or
        $sqlor = "INSERT INTO `set_or` ( `ward` , `hn` , `an` , `ptname` , `age` , `ptright` , `diag` , `surg` , `doctor` , `inhalation_type` , `date_surg` , `time` , `officer` , `comment` ) VALUES ('".$wardor."', '".$cHn."', '', '".$cPtname."', '".$cAge."', '".$cptright."', '".$ordetail1."', '".$ordetail2."', '".$cdoctor."', '".$ordetail3."', '".$date_surg."', '".$timeor."', '".$sOfficer."', '".$ordetail4."')";
        mysql_query($sqlor);
    }
///////////////////////
 
    $doctor=substr($doctor,5);
    $depcode=substr($depcode,4);
    
    print "<p class='size5 center'><b>ใบนัดผู้ป่วย โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง</b></p>";
    print "<p class='size2 center'>FR-NUR-003/2,04, 25 ธ.ค. 54</p>";
    
    print "<p class='size4'><b>ชื่อ:</b> $cPtname <b>HN:</b> $cHn <b>อายุ:</b> $cAge <b>สิทธิ:</b> $cptright</p>";
    print "<p class='size3'><b>หมายเหตุ: <u>$cidguard</u></b></p>";
    print "<p class='size5' style=\"line-height: 36px;\"><b><u>นัดมา: วัน$day ที่ $appd<br>เวลา: $capptime</u></b></p>";
    print "<p class='size4'><b><u>ยื่นใบนัดที่: $room</u></b>&nbsp;<b>เพื่อ:</b> $detail".( $detail2 != "" ? "($detail2)" : "" )."</p>";
    
    if ($detail != 'NA') { 
        // print "&nbsp;<p class='size4'><b>เพื่อ:</b> $detail".( $detail2 != "" ? "($detail2)" : "" )."</p>";
        print "<p class='size3'><b>แพทย์ผู้นัด:</b> $cdoctor</p>";
    }
    
    if ($advice != 'NA') {
        print "<p><b>ข้อแนะนำ:</b> $advice</p>";
    }
    
    if (trim($pathoall) != 'NA') {
        print "<p><b>ตรวจพยาธิ:</b> $pathoall</p>";
    }
    
    if (!empty($labm)) { 
        print "<p><b>คำสั่งพิเศษ:</b> $labm</p>";
    }
    
    if (trim($xray) != 'NA') {
        print "<p><b>ตรวจเอกซเรย์:</b> $xray</p>";
    }
    
    if (!empty($other)) { 
        print "<p><b>อื่นๆ:</b> $other</p>";
    }
    
    print "<p><b>ผู้ออกใบนัด:</b> $sOfficer, $depcode <b>วันและเวลาที่ออกใบนัด:</b> $Thaidate</p>"; 
    
    if ($detail =='FU01 ตรวจตามนัด' OR $detail == 'FU11 ตรวจตามนัดพร้อมประวัติผู้ป่วยใน' OR $detail == 'FU14 เจาะเลือดไม่พบแพทย์' ){
        // print "<br>";
        print "กรุณามาตรงตามวันและเวลานัด <b>ถ้าผิดนัด</b> ให้ยื่นใบนัดที่แผนกทะเบียน<br>";
        print "<b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br>";
        print "ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1100, 1125</b></p>"; 
    }else if ($detail =='FU02 ตามผลตรวจ' ){
        print "กรุณามาตรงตามวันและเวลานัด&nbsp;<b>ถ้าผิดนัด </b>ให้ใบนัดยื่นแผนกทะเบียน &nbsp; </B><br><b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br> ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1100 , 1125</b>"; 
    }else if ($detail =='FU03 นอนโรงพยาบาล') { 
        print "ผู้ป่วยนัดนอนโรงพยาบาลให้ยื่นใบนัดที่แผนกทะเบียน  &nbsp;&nbsp;
    กรุณามาตรงตามวันและเวลานัด <br>  เตรียมเอกสารที่ต้องใช้ในโรงพยาบาล เช่น สำเนาบัตรประจำตัว , หนังสือรับรองสิทธิต่างๆ  &nbsp;<b> </B><br><b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br> ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1100 , 1125</b>";  
    }else if ($detail =='FU04 ทันตกรรม') { 
        print "1.ผู้ป่วยนัดทันตกรรม ให้ยื่นใบนัดที่แผนกทันตกรรม &nbsp;&nbsp;
    2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b>ถ้าผิดนัด </b>ให้ใบนัดยื่นแผนกทะเบียน &nbsp; </B> <br>
    <b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br> 
    ในวันเวลาราชการ โทร 054-839305-6 ต่อ 1230</b>"; 
    }else if ($detail =='FU05 ผ่าตัด') { 
        print "1.ผู้ป่วยนัดตรวจผ่าตัดให้ยื่นใบนัดที่แผนกทะเบียน &nbsp;&nbsp;
    2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b> </B><br><b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br> ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1100 , 1125</b> "; 
    }else if ($detail =='FU06 สูติ') { 
        print "1.ผู้ป่วยนัดตรวจสูติให้ยื่นใบนัดที่แผนกทะเบียน &nbsp;&nbsp;
    2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b> </B><br><b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br> ในวันเวลาราชการ โทร 054-839305-6 ต่อ 5111 </b>";  
    }else if ($detail =='FU07 คลีนิกฝังเข็ม'){ 
        print "
        1.ทำความสะอาดร่างกายให้เรียบร้อย&nbsp;&nbsp;
        2.รับประทานอาหารได้ตามปกติ <br> 
        3.สวมเสื้อผ้าที่ไม่รัดแน่น ควรเป็นเสื้อแขนสั้นหรือกางเกงที่สามารถรูดขึ้นเหนือเข่าได้สะดวก<br> 
        4.เข้าห้องน้ำ ปัสสาวะให้เรียบร้อยก่อนเพื่อไม่ให้เกิดอาการปวดปัสสาวะขณะฝังเข็ม<br>
        5.ดื่มน้ำ 1 แก้วหลังฝังเข็มเสร็จ ถ้ามีการกระหายน้ำ&nbsp;&nbsp;
        6.กรุณามาตรงตามวันและเวลานัด&nbsp;<br>  <b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br> ในวันเวลาราชการ  โทร 054-839305-6 ต่อ 8004 ,7253</b>";
        }else if ($detail =='FU08 Echo'){ 
        print "1.ผู้ป่วยนัดตรวจ Echo ให้ยื่นใบนัดที่จุดนัด &nbsp;&nbsp;
    2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b>ถ้าผิดนัด </b>ให้ใบนัดยื่นแผนกทะเบียน &nbsp; </B><br><b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br> ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1100 , 1125</b>";  
    }else if ($detail =='FU09 มวลกระดูก'){ 
        print "1.ผู้ป่วยนัดตรวจมวลกระดูกให้ยื่นใบนัดที่จุดนัด&nbsp;&nbsp;
    2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b>ถ้าผิดนัด </b>ให้ใบนัดยื่นแผนกทะเบียน &nbsp; </B><br><b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br> ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1100 , 1125</b>"; 
    }else if ($detail =='FU12 นวดแผนไทย'){ 
        
        print "
        1. กรณีนัดหมาย หากมาช้าเกิน 10 นาที โดยมิได้โทรแจ้งขอสงวนสิทธิ์ให้ผู้รับบริการท่านอื่นได้รับบริการก่อน<BR>
        2. หากท่านมีอาการ ไอ เจ็บคอ ไข้ อ่อนเพลีย ให้งดการนวด<br>
        3. ทางโรงพยาบาลไม่สามารถรับผิดชอบสิ่งของมีค่าของท่านได้<BR>
        <B>หมายเลขโทรศัพท์ 054-839305-6 ต่อ 8002</B>
        ";  
    
    }else if ($detail =='FU10 กายภาพ'){ 
        print "
    1.ผู้ป่วยนัดตรวจให้ยื่นใบนัดที่กายภาพบำบัด &nbsp;&nbsp;<BR>
    2.กรุณามาตรงตามวันและเวลานัด&nbsp;<BR>
    3.<b>ถ้าผิดนัด </b>ให้โทรแจ้งทางแผนกกายภาพบำบัด &nbsp;<br><b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 1 วันทำการ<br> ในวันเวลาราชการ เวลา 09.00 น. - 15.00 น. โทร 054-839305-6 ต่อ 8000</b>"; 
    }else if ($detail =='FU22 ตรวจตามนัดOPD เวชศาสตร์ฟื้นฟู'){ 
        print "
    1.ผู้ป่วยนัดตรวจให้ยื่นใบนัดที่กายภาพบำบัด &nbsp;&nbsp;<BR>
    2.กรุณามาตรงตามวันและเวลานัด&nbsp;<BR>
    3.<b>ถ้าผิดนัด </b>ให้ใบนัดยื่นแผนกทะเบียน &nbsp;<br>
    <b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 1 วันทำการ<br> ในวันเวลาราชการ เวลา 09.00 น. - 15.00 น. โทร 054-839305-6 ต่อ 8001 หรือ 8000 </b>"; 
    }else if ($detail =='FU24 ตรวจตามนัด OPD จักษุ(ตา)'){ 
        print "
    1.กรุณามาตรงตามวันและเวลานัด&nbsp;<BR>
    2.<b>ถ้าผิดนัด </b>ให้ใบนัดยื่นแผนกทะเบียน &nbsp;<br>
    <b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 1 วันทำการ<br> ในวันเวลาราชการ เวลา 09.00 น. - 15.00 น. โทร 054-839305-6 ต่อ 2111</b>"; 
    }else if ($detail =='FU25 CT Scan'){ 
        print "
        1.กรุณามาตรงตามวันและเวลานัด&nbsp;<BR>
        2.ติดต่อจุดนัด ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305 ต่อ 1100 , 1125<BR>
        * ผู้ป่วยได้ทำการตรวจเลือดแล้ว ";
    }else if ($detail =='FU31 OPD PM&R'){ 
        print "
    1.ผู้ป่วยนัดตรวจให้ยื่นใบนัดที่กายภาพบำบัด ชั้น2 &nbsp;&nbsp;<BR>
    2.กรุณามาตรงตามวันและเวลานัด&nbsp;<BR>
    3.<b>ถ้าผิดนัด </b>ให้ใบนัดยื่นแผนกทะเบียน &nbsp; <br>
    <b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 1 วันทำการ<br> ในวันเวลาราชการ เวลา 09.00 น. - 15.00 น. โทร 054-839305-6 ต่อ 8002</b>"; 
    }else if($detail =='FU32 นัดตรวจBMD'){ 
        print "
    1.ผู้ป่วยนัดตรวจให้ยื่นใบนัดที่ห้องเอกซเรย์ &nbsp;&nbsp;<BR>
    2.กรุณามาตรงตามวันและเวลานัด&nbsp;<BR>
    3.<b>ถ้าผิดนัด </b>ให้ใบนัดยื่นแผนกทะเบียน &nbsp; <br>
    <b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 1 วันทำการ<br> ในวันเวลาราชการ เวลา 09.00 น. - 15.00 น. โทร 054-839305-6 ต่อ 8002</b>"; 
    }else if($detail =='FU19 อัลตร้าซาวด์'){ 
        print "
    1.ผู้ป่วยนัดตรวจให้ยื่นใบนัดที่ห้องเอ็กเรย์ &nbsp;&nbsp;<BR>
    2.กรุณามาตรงตามวันและเวลานัด&nbsp;<BR>
    3.<b>ถ้าผิดนัด </b>ให้ใบนัดยื่นแผนกทะเบียน &nbsp; <br>
    <b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 1 วันทำการ<br> ในวันเวลาราชการ เวลา 09.00 น. - 15.00 น. โทร 054-839305-6 ต่อ 1140</b>";
    }else if($detail =='FU37 ตรวจ IVP'){ 
        print "
    1.ผู้ป่วยนัดตรวจให้ยื่นใบนัดที่ห้องเอ็กเรย์ &nbsp;&nbsp;<BR>
    2.กรุณามาตรงตามวันและเวลานัด&nbsp;<BR>
    3.<b>ถ้าผิดนัด </b>ให้ใบนัดยื่นแผนกทะเบียน &nbsp; <br>
	4.<b>ผู้ป่วยที่แพ้ยา อาหารทะเล </b>กรุณาแจ้งเจ้าหน้าที่รังสีกรรมก่อน &nbsp; <br>
    <b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 1 วันทำการ<br> ในวันเวลาราชการ เวลา 09.00 น. - 15.00 น. โทร 054-839305-6 ต่อ 1140</b>";     	     
	}else{ 
        print "
    1.กรุณามาตรงตามวันและเวลานัด&nbsp;<BR>
    2.ติดต่อจุดนัด ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305 ต่อ 1100 , 1125"; 
    }

    // include("unconnect.inc");
    // session_unregister("cHn");  
    // session_unregister("cPtname");
    // session_unregister("cAge");
    
} else { // If not HN
        
    $doctor=substr($doctor,5);
    $depcode=substr($depcode,4);
    
    print "<p class='size5'>&nbsp;&nbsp;<b>>>>>>>>>ใบนัดผู้ป่วย<<<<<<<<</b><br>";
    print "<p class='size1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;********FR-OPD-004/1,02, 23 ม.ค. 49 ********<br>";
    print "<p class='size3'&nbsp;&nbsp;>>>>>โรงพยาบาลค่ายสุรศักดิ์มนตรี  ลำปาง  โทร 054 - 839305 - 6 <<<<<br>";
    print "<b><p class='size3'>ชื่อ:</b> $cPtname  &nbsp;&nbsp;&nbsp;<b>HN:</b> $cHn &nbsp;<b>อายุ:</b> $cAge&nbsp;<B>สิทธิ:$cptright<u>$cidguard</u></p></B><br>";
    print "<b><p SIZE=4><U>นัดมา: วัน$day ที่ $appd &nbsp;&nbsp;&nbsp;</U> </p></b><b> เวลา:</b> $capptime<br>";
    print "<b>นัดมาที่ห้อง:</b>&nbsp; $room";
    print "&nbsp;&nbsp;&nbsp;<b>แพทย์ผู้นัด:</b>&nbsp; $cdoctor<br>";
    
    if ($detail !='NA') { 
    print "<b>เพื่อ:</b>&nbsp; $detail";
    }
    
    if (!empty($detail2)) { 
    print "<b>:</b>&nbsp; $detail2<br>";
    }
    
    if ($advice != 'NA') {
    print "<b>ข้อแนะนำ:</b> &nbsp;$advice<br>";
    }
    
    if ($patho != 'NA') {
    print "<b>ตรวจพยาธิ:</b>&nbsp; $patho<br>";
    }
    
    if ($xray != 'NA') {
    print "<b>ตรวจเอกซเรย์:</b>&nbsp; $xray<br>";
    }
    
    if (!empty($other)) { 
    print "<b>ตรวจ:</b>&nbsp; $other<br>";
    }
    
    print "<b>ผู้ออกใบนัด:</b>&nbsp; $sOfficer,&nbsp; $depcode "; 
    print "&nbsp;&nbsp;<b>วันและเวลาที่ออกใบนัด&nbsp;:</b>$Thaidate<br>"; 
    print "<b>หมายเหตุ: <u>$cidguard</u></b><BR>1.ผู้ป่วยนัดตรวจยื่นใบนัดที่จุดบริการนัด &nbsp;&nbsp;2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b>ถ้าผิดนัด </b>ให้ยื่นแผนกทะเบียน &nbsp; </B><br>3.ผู้ป่วยนัดผ่าตัด นอน และสูติ ให้ยื่นใบนัดที่แผนกทะเบียน  &nbsp;&nbsp;4.ผู้ป่วยนัดทันตกรรม ให้ยื่นใบนัดที่แผนกทันตกรรม<br>5.5.กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1100 , 1125 "; 
    die("");
} // End else
?>