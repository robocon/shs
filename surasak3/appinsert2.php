<?php
session_start();
?>
<body>
<html>
<head>
<title>ใบนัดผู้ป่วย รพ.ค่ายสุรศักดิ์มนตรี</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">

<script type="text/javascript">
window.onload = function(){
	window.print();
	// opener.location.href='hnappoi1.php';
	// window.close();
}
</script>
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
    font-size: 16pt;
}
u{
    border-bottom: 2px solid #000000;
    text-decoration: none;
}
b{ font-weight: bold; }
.size1{
    font-size: 8pt;
    line-height: 12pt;
}
.size2{
    font-size: 12pt;
    line-height: 16pt;
}
.size3{
    font-size: 16pt;
    line-height: 20pt;
}
.size4{
    font-size: 17pt;
    line-height: 21pt;
}
.size5{
    font-size: 24pt;
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

include("connect.inc");

$sql = " Select a.row_id, a.date, a.officer, a.hn, a.ptname, a.age, a.doctor, a.appdate, a.apptime, a.room, a.detail, a.detail2, a.advice, a.patho, a.xray, a.other, a.depcode, b.idguard, b.ptright, a.labextra From appoint as a INNER JOIN opcard as b ON a.hn=b.hn where a.row_id = '".$_GET["row_id"]."'  limit 1 ";
list($row_id, $date, $officer1, $cHn, $cPtname, $cAge, $cdoctor, $appd, $capptime, $room, $detail, $detail2, $advice, $patho, $xray, $other, $depcode,$cidguard,$cptright,$labextra) = Mysql_fetch_row(Mysql_Query($sql));

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

if (isset($cHn )){

    $Thaidate = date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 

//พิมพ์ใบนัด
    $doctor=substr($doctor,5);
    $depcode=substr($depcode,4);
    ?>
    <p class="size5 center"><b>ใบนัดผู้ป่วย โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง</b></p>
    <p class="size2 center">FR-NUR-003/2,04, 25 ธ.ค. 54</p>
    <p class="size4"><b>ชื่อ:</b> <?=$cPtname;?> <b>HN:</b> <?=$cHn;?> <b>อายุ:</b> <?=$cAge;?> <b>สิทธิ:</b> <?=$cptright;?></p>
    <p class="size3"><b>หมายเหตุ: <u><?=$cidguard;?></u></b></p>
    <p class="size5" style="line-height: 36px;"><b><u>นัดมา: วัน<?=$day;?> ที่ <?=$appd;?> เวลา: <?=$capptime;?></u></b></p>
    <p class="size4"><b><u>ยื่นใบนัดที่: <?=$room;?></u></b>&nbsp;<b>เพื่อ:</b> <?=$detail;?><?=( $detail2 != "" ? "($detail2)" : "" );?></p>
    <?php
    if ($detail != 'NA') { 
        ?><p class="size3"><b>แพทย์ผู้นัด:</b> <?=$cdoctor;?></p><?php
    }

    if ($advice != 'NA') {
        print "<p><b>ข้อแนะนำ:</b> $advice</p>";
    }
    
    if (trim($patho) != 'NA') {
        print "<p><b>ตรวจพยาธิ:</b> $patho</p>";
    }
    
    if (!empty($labextra)) { 
        print "<p><b>คำสั่งพิเศษ:</b> $labextra</p>";
    }
    
    if (trim($xray) != 'NA') {
        print "<p><b>ตรวจเอกซเรย์:</b> $xray</p>";
    }
    
    if (!empty($other)) { 
        print "<p><b>อื่นๆ:</b> $other</p>";
    }

    print "<p><b>ผู้ออกใบนัด:</b> $officer1, $depcode <b>วันและเวลาที่ออกใบนัด:</b> $Thaidate</p>";
    
    if ($detail =='FU01 ตรวจตามนัด' ){ 
        print "1. กรุณามาตรงตามวันและเวลานัด&nbsp;<b>ถ้าผิดนัด</b> ให้ยื่นใบนัดที่แผนกทะเบียน &nbsp; <br>
        <b>กรณีเลื่อนนัด</b> ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1100 , 1125"; 
        
    } else  if  ($detail =='FU02 ตามผลตรวจ' ){ 
        print "1. กรุณามาตรงตามวันและเวลานัด&nbsp;<b>ถ้าผิดนัด</b> ให้ใบนัดยื่นแผนกทะเบียน &nbsp; <br>
        <b>กรณีเลื่อนนัด</b> ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1100 , 1125"; 
    
    } else  if  ($detail =='FU03 นอนโรงพยาบาล') { 
        print "1. ผู้ป่วยนัดนอนโรงพยาบาลให้ยื่นใบนัดที่แผนกทะเบียน กรุณามาตรงตามวันและเวลานัด<br>
        2. เตรียมเอกสารที่ต้องใช้ในโรงพยาบาล เช่น สำเนาบัตรประจำตัว , หนังสือรับรองสิทธิต่างๆ<br>
        <b>กรณีเลื่อนนัด</b> ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1100 , 1125";  
    
    } else if ($detail =='FU04 ทันตกรรม') { 
        print "1. ผู้ป่วยนัดทันตกรรม ให้ยื่นใบนัดที่แผนกทันตกรรม <br>
        2. กรุณามาตรงตามวันและเวลานัด <b>ถ้าผิดนัด</b> ให้ใบนัดยื่นแผนกทะเบียน<br>
        <b>กรณีเลื่อนนัด</b> ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ ในวันเวลาราชการ โทร 054-839305-6 ต่อ 1230"; 
    
    } else if  ($detail =='FU05 ผ่าตัด') { 
        print "1. ผู้ป่วยนัดตรวจผ่าตัดให้ยื่นใบนัดที่แผนกทะเบียน<br>
        2. กรุณามาตรงตามวันและเวลานัด<br>
        <b>กรณีเลื่อนนัด</b> ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1100, 1125"; 
    
    } else if  ($detail =='FU06 สูติ') { 
        print "1. ผู้ป่วยนัดตรวจสูติให้ยื่นใบนัดที่แผนกทะเบียน<br>
        2. กรุณามาตรงตามวันและเวลานัด<br>
        <b>กรณีเลื่อนนัด</b> ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ ในวันเวลาราชการ โทร 054-839305-6 ต่อ 5111"; 
    
    } else  if ($detail =='FU07 คลีนิกฝังเข็ม'){ 
        print "1. ผู้ป่วยนัดตรวจคลีนิกฝังเข็มให้ยื่นใบนัดที่แผนกทะเบียน<br>
        2. กรุณามาตรงตามวันและเวลานัด<br>
        3. ทำความสะอาดร่างกายให้เรียบร้อย<br>
        4. รับประทานอาหารได้ตามปกติ <br>
        5. สวมเสื้อผ้าที่ไม่รัดแน่น ควรเป็นเสื้อแขนสั้นหรือกางเกงที่สามารถรูดขึ้นเหนือเข่าได้สะดวก<br>
        6. เข้าห้องน้ำ ปัสสาวะให้เรียบร้อยก่อนเพื่อไม่ให้เกิดอาการปวดปัสสาวะขณะฝังเข็ม<br>
        <b>กรณีเลื่อนนัด</b> ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ ในวันเวลาราชการ  โทร 054-839305-6 ต่อ 2111";  
    
    } else  if ($detail =='FU08 Echo'){ 
        print "1. ผู้ป่วยนัดตรวจ Echo ให้ยื่นใบนัดที่จุดนัด<br>
        2. กรุณามาตรงตามวันและเวลานัด <b>ถ้าผิดนัด</b> ให้ใบนัดยื่นแผนกทะเบียน<br>
        <b>กรณีเลื่อนนัด</b> ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1100 , 1125";  
    
    } else  if ($detail =='FU09 มวลกระดูก'){ 
        print "1. ผู้ป่วยนัดตรวจมวลกระดูกให้ยื่นใบนัดที่จุดนัด<br>
        2. กรุณามาตรงตามวันและเวลานัด <b>ถ้าผิดนัด</b> ให้ใบนัดยื่นแผนกทะเบียน<br>
        <b>กรณีเลื่อนนัด</b> ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1100 , 1125";  
    
    } else  if ($detail =='FU12 นวดแผนไทย'){ 
        print "1. กรณีนัดหมาย หากมาช้าเกิน 10 นาที โดยมิได้โทรแจ้งขอสงวนสิทธิ์ให้ผู้รับบริการท่านอื่นได้รับบริการก่อน<br>
        2. หากท่านมีอาการ ไอ เจ็บคอ ไข้ อ่อนเพลีย ให้งดการนวด<br>
        3. ทางโรงพยาบาลไม่สามารถรับผิดชอบสิ่งของมีค่าของท่านได้<br>
        <b>กรณีเลื่อนนัด</b> โทรหมายเลขโทรศัพท์ 054-839305-6 ต่อ 8002
        ";  
    
    } else  { 
        print "1. ผู้ป่วยนัดตรวจให้ยื่นใบนัดที่แผนกทะเบียน <br>
        2. กรุณามาตรงตามวันและเวลานัด <b>ถ้าผิดนัด</b> ให้ใบนัดยื่นแผนกทะเบียน<br>
        <b>กรณีเลื่อนนัด</b> ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305 ต่อ 1100 , 1125
        ";
    
    }

    session_unregister("cHn");  
    session_unregister("cPtname");
    session_unregister("cAge");

} else {
    
    $doctor = substr($doctor,5);
    $depcode = substr($depcode,4);
    print "&nbsp;&nbsp;<b>>>>>>>>>ใบนัดผู้ป่วย<<<<<<<<</b><br>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;********FR-OPD-004/1,02, 23 ม.ค. 49 ********<br>";
    print ">>>>โรงพยาบาลค่ายสุรศักดิ์มนตรี  ลำปาง  โทร 054 - 839305 - 6 <<<<<br>";
    print "<b>ชื่อ:</b> $cPtname  &nbsp;&nbsp;&nbsp;<b>HN:</b> $cHn &nbsp;<b>อายุ:</b> $cAge&nbsp;<b>สิทธิ:$cptright<u>$cidguard</u></font></b><br>";
    print "<b><FONT SIZE=4><U>นัดมา: วัน$day ที่ $appd&nbsp;&nbsp;&nbsp;</U> </FONT></b><b> เวลา:</b> $capptime<br>";
    print "<b>นัดมาที่ห้อง:</b>&nbsp; $room";
    print "&nbsp;&nbsp;&nbsp;<b>แพทย์ผู้นัด:</b>&nbsp; $cdoctor<br>";
    
    if($detail !='NA') { 
        print "<b>เพื่อ:</b>&nbsp; $detail";
    }
    
    if(!empty($detail2)) { 
        print "<b>:</b>&nbsp; $detail2<br>";
    }
    
    if($advice != 'NA') {
        print "<b>ข้อแนะนำ:</b> &nbsp;$advice<br>";
    }
    
    if($patho != 'NA') {
        print "<b>ตรวจพยาธิ:</b>&nbsp; $patho<br>";
    }
    
    if($xray != 'NA') {
        print "<b>ตรวจเอกซเรย์:</b>&nbsp; $xray<br>";
    }
    
    if(!empty($other)) { 
        print "<b>ตรวจ:</b>&nbsp; $other<br>";
    }
    
    print "<b>ผู้ออกใบนัด:</b>&nbsp; $sOfficer,&nbsp; $depcode "; 
    print "&nbsp;&nbsp;<b>วันและเวลาที่ออกใบนัด&nbsp;:</b>$Thaidate<br>"; 
    print "1.ผู้ป่วยนัดตรวจยื่นใบนัดที่จุดบริการนัด &nbsp;&nbsp;2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b>ถ้าผิดนัด</b> ให้ยื่นแผนกทะเบียน &nbsp; </b><br>3.ผู้ป่วยนัดผ่าตัด นอน และสูติ ให้ยื่นใบนัดที่แผนกทะเบียน  &nbsp;&nbsp;4.ผู้ป่วยนัดทันตกรรม ให้ยื่นใบนัดที่แผนกทันตกรรม<br>5.5.กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1100 , 1125 "; 

}
include("unconnect.inc");
?>