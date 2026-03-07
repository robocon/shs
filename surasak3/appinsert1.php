<?php
session_start();
if($_SESSION["sOfficer"] == ""){
	
	echo "<center><font color='#000000' >ขออภัยครับ การ Login ของท่านหมดอายุ </font><br />";
	echo "<a href=\"../sm3.php\" target=\"_top\">กลับหน้าแรก</a></center>";
	exit();
}	

if($_POST["chkhn"]!=$cHn){
	$cHn=$_POST["chkhn"];
}

$cPtname = $_POST['cPtname'];
$cAge = $_POST['cAge'];

if($cHn == "" || $cPtname=="" || $cAge==""){
	
	echo "<center><font color='#000000' >ข้อมูลไม่ครบถ้วน กรุณาลงข้อมูลใหม่อีกครั้งครับ</font><br />";
	echo "<a href=\"hnappoi1.php\" target=\"_top\">กลับหน้าออกใบนัด</a></center>";
	exit();
}
?>

<html>
<head>
<title>ใบนัดผู้ป่วย รพ.ค่ายสุรศักดิ์มนตรี</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">
<body>

<style type="text/css">
/* CSS Rest */
/* http://meyerweb.com/eric/tools/css/reset/
   v2.0 | 20110126
   License: none (public domain)
*/

html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed,
figure, figcaption, footer, header, hgroup,
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
	margin: 0;
	padding: 0;
	border: 0;
	font-size: 100%;
	font: inherit;
	vertical-align: baseline;
}
/* HTML5 display-role reset for older browsers */
article, aside, details, figcaption, figure,
footer, header, hgroup, menu, nav, section {
	display: block;
}
body {
	line-height: 1;
}
ol, ul {
	list-style: none;
}
blockquote, q {
	quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
	content: '';
	content: none;
}
table {
	border-collapse: collapse;
	border-spacing: 0;
}


/* Your CSS is below */
html{
    font-family: 'TH SarabunPSK'!important;
    font-size: 14pt;
}
u{
    border-bottom: 2px solid #000000;
    text-decoration: none;
}
b{ font-weight: bold; }
.size1{
    font-size: 6pt;
    line-height: 12pt;
}
.size2{
    font-size: 10pt;
    line-height: 16pt;
}
.size3{
    font-size: 14pt;
    line-height: 20pt;
}
.size4{
    font-size: 15pt;
    line-height: 21pt;
}
.size5{
    font-size: 22pt;
    line-height: 28pt;
}
.center{
    text-align: center;
}
</style>
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

	$sqltel = "update opcard SET phone='".$_POST['telp']."' where hn='".$cHn."'";
	$result = mysql_query($sqltel);

    $convert_m = array('มกราคม' => '01', 'กุมภาพันธ์' => '02', 'มีนาคม' => '03', 'เมษายน' => '04', 'พฤษภาคม' => '05', 'มิถุนายน' => '06', 'กรกฎาคม' => '07', 'สิงหาคม' => '08', 'กันยายน' => '09', 'ตุลาคม' => '10', 'พฤศจิกายน' => '11', 'ธันวาคม' => '12');
    $def_fullm_th = array('01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', '05' => 'พฤษภาคม', '06' => 'มิถุนายน', '07' => 'กรกฎาคม', '08' => 'สิงหาคม', '09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม');

    list($th_d, $th_m, $th_y) = explode(' ', $appd);
	$appdate_en = ($th_y-543).'-'.array_search($th_m, $def_fullm_th).'-'.$th_d;


    $detail2 = jschars($detail2);
    $other = jschars($other);
    $labm = jschars($labm);

    $pathoall = "";
    if(count($_SESSION["list_code"]) > 0)
    {
        $pathoall = implode(', ', $_SESSION["list_code"]);
    }

/**
ALTER TABLE `appoint` ADD `date_edit` DATETIME NULL ,
ADD `officer_edit` VARCHAR( 255 ) NULL ;
*/
    $appoint_id = $_POST['appoint_id'];
    if(!empty($appoint_id))
    {
        $sql = "UPDATE `appoint` SET 
        `doctor`='$cdoctor', 
        `appdate`='$appd', 
        `apptime`='$capptime', 
        `room`='$room', 
        `detail`='$detail', 
        `detail2`='$detail2', 
        `advice`='$advice', 
        `patho`='$pathoall', 
        `xray`='$xrayall', 
        `other`='$other', 
        `depcode`='$depcode', 
        `labextra`='$labm', 
        `appdate_en`='$appdate_en',
        `date_edit` = NOW(),
        `officer_edit` = '$sOfficer'
        WHERE `row_id`='$appoint_id';";
    }
    else
    {
        $sql = "INSERT INTO appoint(
            date,officer,hn,ptname,age,doctor,
            appdate,apptime,room,detail,detail2,advice,
            patho,xray,other,depcode,labextra,appdate_en
        )VALUES(
            '$Thidate','$sOfficer','$cHn','$cPtname','$cAge','$cdoctor',
            '$appd','$capptime','$room','$detail','$detail2','$advice',
            '$pathoall','$xrayall','$other','$depcode','$labm','$appdate_en'
        );";
    }
    $result = mysql_query($sql);
    if($result==false)
    {
        echo '<p>Table appoint Error : '.mysql_error().'</p>';
    }
    $idno = mysql_insert_id();
    
    // เปลี่ยน format เป็น yyyy-mm-dd จะได้เหมือนกับนัดฉีดยา
    list($pre_d, $pre_m, $pre_y) = explode(' ', $appd);
    $appdate_en = $pre_y.'-'.$convert_m[$pre_m].'-'.$pre_d;


    /**
     * ลบของเก่าออกไปก่อนแล้วให้สคริปด้านล่างเพิ่มไปเอง
     */
    if(!empty($appoint_id))
    { 
        $sql = "DELETE FROM `appoint_lab` WHERE `id` = '$appoint_id'";
        $result = mysql_query($sql);
        if($result==false)
        {
            echo '<p>DEL appoint_lab Error : '.mysql_error().'</p>';
        }
        $idno = $appoint_id;
    }

	$count = count($_SESSION["list_code"]);
    if($count > 0){
    
        $sql = "INSERT INTO `appoint_lab` ( `id` , `code` )  VALUES ";
        $labin = $labout = array();
        $list = array();
        for ($n=0; $n<$count; $n++){
            If (!empty($_SESSION["list_code"][$n])){

                $labCode = $_SESSION["list_code"][$n];

                $sqlLabcare = "SELECT `labtype` FROM `labcare` WHERE `code` = '$labCode' ";
                $qLabcare = mysql_query($sqlLabcare);
                if(mysql_num_rows($qLabcare)>0){
                    $lc = mysql_fetch_assoc($qLabcare);
                    if($lc['labtype']=='OUT'){
                        $labout[] = $labCode;
                    }elseif ($lc['labtype']=='IN') {
                        $labin[] = $labCode;
                    }
                }
                $q = "('$idno', '".$_SESSION["list_code"][$n]."')  ";
                array_push($list,$q);
            }
        }
            
        $sql .= implode(", ",$list);
        $result = Mysql_Query($sql) or die("Error appoint_lab ".Mysql_Error());

        // ตัวเดิมเป็น $_SESSION["list_code"] ปรับใหม่คือแยก IN กับ OUT
        $patho = implode(", ",$labin);
        $pathoOut = implode(", ",$labout);
    }
    
    // $pathoall=$patho.' '.$patho2;

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

        $or_id = $_POST['or_id'];
        if(!empty($or_id))
        {
            $sqlor = "UPDATE `set_or` SET 
            `ward` = '$wardor', 
            `hn` = '$cHn', 
            `ptname` = '$cPtname', 
            `age` = '$cAge', 
            `ptright` = '$cptright', 
            `diag` = '$ordetail1', 
            `surg` = '$ordetail2', 
            `doctor` = '$cdoctor', 
            `inhalation_type` = '$ordetail3', 
            `date_surg` = '$date_surg', 
            `time` = '$timeor', 
            `officer` = '$sOfficer', 
            `comment` = '$ordetail4' 
            WHERE `row_id` = '$or_id';";
        }
        else
        {
            $sqlor = "INSERT INTO `set_or` ( 
                `ward` , `hn` , `an` , `ptname` , `age` , `ptright` , `diag` , `surg` , 
                `doctor` , `inhalation_type` , `date_surg` , `time` , `officer` , `comment` 
            ) VALUES (
                '$wardor', '$cHn', '', '$cPtname', '$cAge', '$cptright', '$ordetail1', '$ordetail2', 
                '$cdoctor', '$ordetail3', '$date_surg', '$timeor', '$sOfficer', '$ordetail4'
            )";
        }
        $result = mysql_query($sqlor);
        if($result==false)
        {
            echo '<p>Table set_or Error : '.mysql_error().'</p>';
        }

    }
///////////////////////

    $doctor=substr($doctor,5);
    $depcode=substr($depcode,4);
    print "<div align='right' style='margin-right: 10px;'><img src = \"printbcpha.php?cHn=".$cHn."\"></div>";
    ?>
    <div style="position: absolute;top: 0;left: 0;"><img src="printQrCode.php?hn=<?=$cHn;?>&margin=1"></div>
    <?php
    print "<p class='size6 center'><b>ใบนัดผู้ป่วย โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง</b></p>";
    print "<p class='size2 center'>FR-NUR-003/2,04, 25 ธ.ค. 54</p>";
    
    print "<p class='size5'><b>ชื่อ:</b> $cPtname <b>HN:</b> $cHn <b>อายุ:</b> $cAge <b>สิทธิ:</b> $cptright</p>";
    
    // ถ้าห้องที่ยื่นไม่ใช่ xray ค่อยแสดง
    if($room != "แผนกเอกชเรย์"){ 
        print "<p class='size3'><b>หมายเหตุ: <u>$cidguard</u></b></p>";
    }
    
    $timebr = '<br>';
    // ถ้ายื่นใบนัดที่แผนก xray ไม่ต้องขึ้นบรรทัดใหม่
    if($room == "แผนกเอกชเรย์"){ 
        $timebr = '';
    }

    print "<p class='size5' style=\"line-height: 36px;\"><b><u>นัดมา: วัน$day ที่ $appd $timebr เวลา: $capptime</u></b></p>";
    print "<p class='size4'><b><u>ยื่นใบนัดที่: $room</u></b>&nbsp;<b>เพื่อ:</b> $detail".( $detail2 != "" ? "($detail2)" : "" )."</p>";
    
    if ($detail != 'NA') { 
        // print "&nbsp;<p class='size4'><b>เพื่อ:</b> $detail".( $detail2 != "" ? "($detail2)" : "" )."</p>";
        print "<p class='size3'><b>แพทย์ผู้นัด:</b> $cdoctor</p>";
    }
    
    // ถ้ายื่นที่ xray ให้เพิ่มขนาดตัวหนังสือข้อแนะนำ
    $adviceSize = '';
    if($room == "แผนกเอกชเรย์"){ 
        $adviceSize = 'class="size5"';
    }
    
    if ($advice != 'NA') {
        print "<p $adviceSize><b>ข้อแนะนำ:</b> $advice</p>";
    }
    
    if (!empty($pathoall)) {
        print "<p><b>ตรวจพยาธิ:</b> $pathoall $outTxt</p>";
    }
    
    if(!empty($pathoOut)){
        ?>
        <p><strong>แลปนอก: </strong><?= $pathoOut ?></p>
        <?php
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
        print "ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ ";
        
        // 1125 , 1100
        $phone_part = '1125 , 1100';
        if( $room == 'ห้องตรวจจักษุ(ตา)' ){
            $phone_part = '2111, 2112';
        }
        
        print "$phone_part</b></p>"; 
        
    }else if ($detail =='FU02 ตามผลตรวจ' ){
        print "กรุณามาตรงตามวันและเวลานัด&nbsp;<b>ถ้าผิดนัด </b>ให้ใบนัดยื่นแผนกทะเบียน &nbsp; </B><br><b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br> ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1125 , 1100</b>"; 
    }else if ($detail =='FU03 นอนโรงพยาบาล') { 
        print "ผู้ป่วยนัดนอนโรงพยาบาลให้ยื่นใบนัดที่แผนกทะเบียน  &nbsp;&nbsp;
    กรุณามาตรงตามวันและเวลานัด <br>  เตรียมเอกสารที่ต้องใช้ในโรงพยาบาล เช่น สำเนาบัตรประจำตัว , หนังสือรับรองสิทธิต่างๆ  &nbsp;<b> </B><br><b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br> ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1125 , 1100</b>";  
    }else if ($detail =='FU04 ทันตกรรม') { 
        print "1.ผู้ป่วยนัดทันตกรรม ให้ยื่นใบนัดที่แผนกทันตกรรม &nbsp;&nbsp;
    2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b>ถ้าผิดนัด </b>ให้ใบนัดยื่นแผนกทะเบียน &nbsp; </B> <br>
    <b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br> 
    ในวันเวลาราชการ โทร 054-839305-6 ต่อ 1230</b>"; 
    }else if ($detail =='FU05 ผ่าตัด') { 
        print "1.ผู้ป่วยนัดตรวจผ่าตัดให้ยื่นใบนัดที่แผนกทะเบียน &nbsp;&nbsp;
    2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b> </B><br><b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br> ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1125 , 1100</b> "; 
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
        6.กรุณามาตรงตามวันและเวลานัด&nbsp;<br>  <b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br> ในวันเวลาราชการ  โทร 054-839305-6 ต่อ 8004</b>";
        }else if ($detail =='FU08 Echo'){ 
        print "1.ผู้ป่วยนัดตรวจ Echo ให้ยื่นใบนัดที่จุดนัด &nbsp;&nbsp;
    2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b>ถ้าผิดนัด </b>ให้ใบนัดยื่นแผนกทะเบียน &nbsp; </B><br><b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br> ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1125 , 1100</b>";  
    }else if ($detail =='FU09 มวลกระดูก'){ 
        print "1.ผู้ป่วยนัดตรวจมวลกระดูกให้ยื่นใบนัดที่จุดนัด&nbsp;&nbsp;
    2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b>ถ้าผิดนัด </b>ให้ใบนัดยื่นแผนกทะเบียน &nbsp; </B><br><b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br> ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1125 , 1100</b>"; 
    }else if ($detail =='FU12 นวดแผนไทย'){ 
        
        print "1. กรณีนัดหมาย หากมาช้าเกิน 10 นาที โดยมิได้โทรแจ้งขอสงวนสิทธิ์ให้ผู้รับบริการท่านอื่นได้รับบริการก่อน<BR>
        2. หากท่านมีอาการ ไอ เจ็บคอ ไข้ อ่อนเพลีย ให้งดการนวด<br>
        3. ทางโรงพยาบาลไม่สามารถรับผิดชอบสิ่งของมีค่าของท่านได้<BR>
        <B>หมายเลขโทรศัพท์ 054-839305-6 ต่อ 8003, 8004</B>
        ";  
    
    }else if ($detail =='FU10 กายภาพ'){ 
        print "1.ผู้ป่วยนัดตรวจให้ยื่นใบนัดที่กายภาพบำบัด &nbsp;&nbsp;<BR>
        2.กรุณามาตรงตามวันและเวลานัด&nbsp;<BR>
        3.<b>ถ้าผิดนัด </b>ให้โทรแจ้งทางแผนกกายภาพบำบัด &nbsp;<br><b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 1 วันทำการ<br> ในวันเวลาราชการ เวลา 13.00 น. - 15.00 น. โทร 054-839305-6 ต่อ 8002</b>"; 
    
    }else if ($detail =='FU22 ตรวจตามนัดOPD เวชศาสตร์ฟื้นฟู'){ 

        $in_phone = "8002";
        if($room=="อาคารแพทย์ทางเลือก"){
            $in_phone = "8003, 8004";
        }
        print "
        1.ผู้ป่วยนัดตรวจให้ยื่นใบนัดที่$room &nbsp;&nbsp;<BR>
        2.กรุณามาตรงตามวันและเวลานัด&nbsp;<BR>
        3.<b>ถ้าผิดนัด </b>ให้ใบนัดยื่นแผนกทะเบียน &nbsp;<br>
        <b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 1 วันทำการ<br> ในวันเวลาราชการ เวลา 13.00 น. - 15.00 น. โทร 054-839305-6 ต่อ $in_phone </b>"; 

    }else if ($detail =='FU24 ตรวจตามนัด OPD จักษุ(ตา)'){ 
        print "
    1.กรุณามาตรงตามวันและเวลานัด&nbsp;<BR>
    2.<b>ถ้าผิดนัด </b>ให้ใบนัดยื่นแผนกทะเบียน &nbsp;<br>
    <b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 1 วันทำการ<br> ในวันเวลาราชการ เวลา 09.00 น. - 15.00 น. โทร 054-839305-6 ต่อ 2111</b>"; 
    }else if ($detail =='FU25 CT Scan'){ 
        print "
        1.กรุณามาตรงตามวันและเวลานัด&nbsp;<BR>
        2.ติดต่อจุดนัด ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305 ต่อ 1125 , 1100<BR>
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
    3.<b>ถ้าผิดนัด </b>ให้ใบนัดยื่นแผนกเอกซ์เรย์ &nbsp; <br>
    <b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 1 วันทำการ<br> ในวันเวลาราชการ เวลา 09.00 น. - 15.00 น. โทร 054-839305-6 ต่อ 1140</b>";
    }else if($detail =='FU37 ตรวจ IVP'){ 
        print "
    1.ผู้ป่วยนัดตรวจให้ยื่นใบนัดที่ห้องเอ็กเรย์ &nbsp;&nbsp;<BR>
    2.กรุณามาตรงตามวันและเวลานัด&nbsp;<BR>
    3.<b>ถ้าผิดนัด </b>ให้ใบนัดยื่นแผนกทะเบียน &nbsp; <br>
	4.<b>ผู้ป่วยที่แพ้ยา อาหารทะเล </b>กรุณาแจ้งเจ้าหน้าที่รังสีกรรมก่อน &nbsp; <br>
    <b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 1 วันทำการ<br> ในวันเวลาราชการ เวลา 09.00 น. - 15.00 น. โทร 054-839305-6 ต่อ 1140</b>";     	     
	}else if($detail =='FU38 คลินิกWell Baby'){ 

    print "กรุณามาตรงตามวันและเวลานัด <b>ถ้าผิดนัด</b> ให้ยื่นใบนัดที่แผนกทะเบียน<br>
    คลินิกWell Baby ให้บริการ อังคารแรก และอังคารสุดท้ายของเดือน เวลา 13.00 น.<br>
    <b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ</b><br>
    ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1125 , 1100";

	}else{ 
        print "
    1.กรุณามาตรงตามวันและเวลานัด&nbsp;<BR>
    2.ติดต่อจุดนัด ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305 ต่อ 1125 , 1100"; 
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
        $outTxt = '';
        if(!empty($pathoOut)){
            $outTxt = '<b>แลปนอก: </b>'.$pathoOut;
        }
    print "<b>ตรวจพยาธิ:</b>&nbsp; $patho $outTxt<br>";
    }
    
    if ($xray != 'NA') {
    print "<b>ตรวจเอกซเรย์:</b>&nbsp; $xray<br>";
    }
    
    if (!empty($other)) { 
    print "<b>ตรวจ:</b>&nbsp; $other<br>";
    }
    
    print "<b>ผู้ออกใบนัด:</b>&nbsp; $sOfficer,&nbsp; $depcode "; 
    print "&nbsp;&nbsp;<b>วันและเวลาที่ออกใบนัด&nbsp;:</b>$Thaidate<br>"; 
    print "<b>หมายเหตุ: <u>$cidguard</u></b><BR>1.ผู้ป่วยนัดตรวจยื่นใบนัดที่จุดบริการนัด &nbsp;&nbsp;2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b>ถ้าผิดนัด </b>ให้ยื่นแผนกทะเบียน &nbsp; </B><br>3.ผู้ป่วยนัดผ่าตัด นอน และสูติ ให้ยื่นใบนัดที่แผนกทะเบียน  &nbsp;&nbsp;4.ผู้ป่วยนัดทันตกรรม ให้ยื่นใบนัดที่แผนกทันตกรรม<br>5.5.กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1125 , 1100 "; 
    die("");
} // End else
?>
<script type="text/javascript">
window.onload = function(){
	window.print();
    setTimeout(function () { 
        window.location.href = "hnappoi1.php";
    }, 1000);
};
</script>