<?php
session_start();
include_once dirname(__FILE__) . '/connect.php';

$sqlAppointLab = sprintf("SELECT * FROM `appoint_lab` WHERE `id` = '%s' ", mysql_real_escape_string($_GET["row_id"]));
$qAppLab = mysql_query($sqlAppointLab);
$appLabRows = mysql_num_rows($qAppLab);
$labin = $labout = array();
if ($appLabRows > 0) {
    while ($a = mysql_fetch_assoc($qAppLab)) {

        $labCode = $a['code'];

        $sqlLabcare = "SELECT `labtype` FROM `labcare` WHERE `code` = '$labCode' ";
        $qLabcare = mysql_query($sqlLabcare);
        if (mysql_num_rows($qLabcare) > 0) {
            $lc = mysql_fetch_assoc($qLabcare);
            if ($lc['labtype'] == 'OUT') {
                $labout[] = $labCode;
            } elseif ($lc['labtype'] == 'IN') {
                $labin[] = $labCode;
            }
        }
    }
}
?>

<body Onload="window.print();">
    <html>

    <head>
        <title>add_user</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/backoffice.css" rel="stylesheet" type="text/css">
    </head>
    <?php
    $sql = " Select a.row_id, a.date, a.officer, a.hn, a.ptname, a.age, a.doctor, a.appdate, a.apptime, a.room, a.detail, a.detail2, a.advice, a.patho, a.xray, a.other, a.depcode, b.idguard, b.ptright, a.labextra From appoint as a INNER JOIN opcard as b ON a.hn=b.hn where a.row_id = '" . $_GET["row_id"] . "'  limit 1 ";
    list($row_id, $date, $officer1, $cHn, $cPtname, $cAge, $cdoctor, $appd, $capptime, $room, $detail, $detail2, $advice, $patho, $xray, $other, $depcode, $cidguard, $cptright, $labextra) = Mysql_fetch_row(Mysql_Query($sql));
    $exm = explode(" ", $appd);

    $d1 = $exm[0];
    $m1 = trim($exm[1]);
    $y1 = $exm[2] - 543;

    $arr1 = array("มกราคม" => "01", "กุมภาพันธ์" => "02", "มีนาคม" => "03", "เมษายน" => "04", "พฤษภาคม" => "05", "มิถุนายน" => "06", "กรกฎาคม" => "07", "สิงหาคม" => "08", "กันยายน" => "09", "ตุลาคม"  => "10", "พฤศจิกายน" => "11",  "ธันวาคม" => "12");

    $appday = $y1 . '-' . $arr1[$m1] . '-' . $d1;

    $DayOfWeek = date("w", strtotime($appday));

    switch ($DayOfWeek) {
        case "0":
            $day = "อาทิตย์";
            break;
        case "1":
            $day = "จันทร์";
            break;
        case "2":
            $day = "อังคาร";
            break;
        case "3":
            $day = "พุธ";
            break;
        case "4":
            $day = "พฤหัสบดี";
            break;
        case "5":
            $day = "ศุกร์";
            break;
        case "6":
            $day = "เสาร์";
            break;
    }

    if (isset($cHn)) {

        $Thaidate = date("d-m-") . (date("Y") + 543) . "  " . date("H:i:s");
        $Thidate = (date("Y") + 543) . date("-m-d H:i:s");

        //พิมพ์ใบนัด
        $doctor = substr($doctor, 5);
        $depcode = iconv_substr($depcode, 4, 'UTF-8');

    ?>
        <? if ($_SESSION["smenucode"] == "ADMEYE") { ?>
            <div style="margin-top:60px; margin-left:60px;">
                <table width="100%">
                    <tr>
                        <td width="50%">
                            <div><img src="printQrCode.php?hn=<?= $cHn; ?>"></div>
                        </td>
                        <td width="50%" align="right">
                            <div style="margin-right:50px;"><img src="printbcpha.php?cHn=<? echo $cHn; ?>"></div>
                        </td>
                    </tr>
                </table>
            <? } else { ?>
                <div style="margin-top:10px; margin-left:30px;">
                    <table width="100%">
                        <tr>
                            <td width="50%">
                                <div><img src="printQrCode.php?hn=<?= $cHn; ?>"></div>
                            </td>
                            <td width="50%" align="right">
                                <div style="margin-right:50px;"><img src="printbcpha.php?cHn=<? echo $cHn; ?>"></div>
                            </td>
                        </tr>
                    </table>
                <? } ?>
            <?php
            print "<font face='Angsana New' size='6'><center><b>ใบนัดผู้ป่วย";
            print "&nbsp;&nbsp;&nbsp;&nbsp;โรงพยาบาลค่ายสุรศักดิ์มนตรี  ลำปาง </b> </center>";
            print "  <font face='Angsana New' size='2'><center>FR-NUR-003/2,04, 25 ธ.ค. 54 </center>";
            print "<b><font face='Angsana New' size='5'>ชื่อ: $cPtname  </b>&nbsp;&nbsp;&nbsp;<b>HN:</b> $cHn &nbsp;<b>อายุ:</b> $cAge</font><br>";
            print "<b><font face='Angsana New' size='4'><B>สิทธิการรักษา:$cptright&nbsp;&nbsp;ประเภท:<u>$cidguard</u></font></B><br>";
            print "<b><font face='Angsana New' size='5'><U>นัดมา: วัน$day ที่ $appd &nbsp;&nbsp;&nbsp; </b><b> เวลา:</b> $capptime</U></FONT><br>";
            print "<font face='Angsana New' size='4'><b><U>ยื่นใบนัดที่:&nbsp; $room</U></b><font face='Angsana New' size='3'>&nbsp;&nbsp;&nbsp;";

            if ($detail != 'NA') {

                echo "<font face='Angsana New' size='4'><b>เพื่อ:</b>&nbsp; $detail";
                if (!empty($detail2)) {
                    print "(&nbsp; $detail2)";
                }
                echo "<br><font face='Angsana New' size='3'><b>แพทย์ผู้นัด:</b>&nbsp; $cdoctor</b><br>";
            }

            if ($advice != 'NA') {
                print "<b>ข้อแนะนำ:</b> &nbsp;$advice<br>";
            }

            if (trim($patho) != 'NA') {
                $labinTxt = implode(', ', $labin);
                print "<b>ตรวจพยาธิ:</b>&nbsp; $labinTxt&nbsp; $labextra<br>";
            }
            if (!empty($labout)) {
                $laboutTxt = implode(', ', $labout);
                print "<b>แลปนอก:</b>&nbsp; $laboutTxt<br>";
            }

            if (trim($xray) != 'NA') {
                print "<b>ตรวจเอกซเรย์:</b>&nbsp; $xray<br>";
            }

            if (!empty($other)) {
                print "<b>ตรวจ:</b>&nbsp; $other<br>";
            }
            print "<b>ผู้ออกใบนัด:</b>&nbsp; $officer1 &nbsp; $depcode ";
            print "&nbsp;&nbsp;<b>วันและเวลาที่ออกใบนัด&nbsp;:</b>$date<br>";

            if ($detail == 'FU01 ตรวจตามนัด') {
                print "<font face='Angsana New' size='3'><b>หมายเหตุ:<u>$cidguard</u></b><br>กรุณามาตรงตามวันและเวลานัด&nbsp;<b>ถ้าผิดนัด </b>ให้ยื่นใบนัดที่แผนกทะเบียน &nbsp; <br><b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br> ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1125 , 1100</b>";
            } else  if ($detail == 'FU02 ตามผลตรวจ') {
                print "<b>หมายเหตุ:<u>$cidguard</u></b><BR>กรุณามาตรงตามวันและเวลานัด&nbsp;<b>ถ้าผิดนัด </b>ให้ใบนัดยื่นแผนกทะเบียน &nbsp; </B><br><b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br> ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1125 , 1100</b>";
            } else  if ($detail == 'FU03 นอนโรงพยาบาล') {
                print "<b>หมายเหตุ:<u>$cidguard</u></b><br>ผู้ป่วยนัดนอนโรงพยาบาลให้ยื่นใบนัดที่แผนกทะเบียน  &nbsp;&nbsp;
กรุณามาตรงตามวันและเวลานัด <br>  เตรียมเอกสารที่ต้องใช้ในโรงพยาบาล เช่น สำเนาบัตรประจำตัว , หนังสือรับรองสิทธิต่างๆ  &nbsp;<b> </B><br><b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br> ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1125 , 1100</b>";
            } else if ($detail == 'FU04 ทันตกรรม') {
                print "<font face='Angsana New' size='2'><b>หมายเหตุ:<u>$cidguard</u></b><BR>1.ผู้ป่วยนัดทันตกรรม ให้ยื่นใบนัดที่แผนกทันตกรรม &nbsp;&nbsp;
2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b>ถ้าผิดนัด </b>ให้ใบนัดยื่นแผนกทะเบียน &nbsp; </B> <br><b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br> ในวันเวลาราชการ โทร 054-839305-6 ต่อ 1230</b>";
            } else if ($detail == 'FU05 ผ่าตัด') {
                print "<font face='Angsana New' size='3'><b>หมายเหตุ:<u>$cidguard</u></b><BR>1.ผู้ป่วยนัดตรวจผ่าตัดให้ยื่นใบนัดที่แผนกทะเบียน &nbsp;&nbsp;
2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b> </B><br><b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br> ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1125 , 1100</b> ";
            } else if ($detail == 'FU06 สูติ') {
                print "<font face='Angsana New' size='3'><b>หมายเหตุ:<u>$cidguard</u></b><BR>1.ผู้ป่วยนัดตรวจสูติให้ยื่นใบนัดที่แผนกทะเบียน &nbsp;&nbsp;
2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b> </B><br><b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br> ในวันเวลาราชการ โทร 054-839305-6 ต่อ 5111 </b>";
            } else  if ($detail == 'FU07 คลีนิกฝังเข็ม') {
                print "<font face='Angsana New' size='3'>1.ผู้ป่วยนัดตรวจคลีนิกฝังเข็มให้ยื่นใบนัดที่แผนกทะเบียน &nbsp;&nbsp;
2.กรุณามาตรงตามวันและเวลานัด&nbsp;<br>3.ทำความสะอาดร่างกายให้เรียบร้อย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.รับประทานอาหารได้ตามปกติ <br> 5.สวมเสื้อผ้าที่ไม่รัดแน่น ควรเป็นเสื้อแขนสั้นหรือกางเกงที่สามารถรูดขึ้นเหนือเข่าได้สะดวก<br> 6.เข้าห้องน้ำ ปัสสาวะให้เรียบร้อยก่อนเพื่อไม่ให้เกิดอาการปวดปัสสาวะขณะฝังเข็ม<br><b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br> ในวันเวลาราชการ  โทร 054-839305-6 ต่อ  2111</b>";
            } else  if ($detail == 'FU08 Echo') {
                print "<font face='Angsana New' size='3'>1.ผู้ป่วยนัดตรวจ Echo ให้ยื่นใบนัดที่จุดนัด &nbsp;&nbsp;
2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b>ถ้าผิดนัด </b>ให้ใบนัดยื่นแผนกทะเบียน &nbsp; </B><br><b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br> ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1125 , 1100</b>";
            } else  if ($detail == 'FU09 มวลกระดูก') {
                print "<font face='Angsana New' size='3'>1.ผู้ป่วยนัดตรวจมวลกระดูกให้ยื่นใบนัดที่จุดนัด&nbsp;&nbsp;
2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b>ถ้าผิดนัด </b>ให้ใบนัดยื่นแผนกทะเบียน &nbsp; </B><br><b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ<br> ในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1125 , 1100</b>";
            } else  if ($detail == 'FU12 นวดแผนไทย') {

                print "<font face='Angsana New' size='3'>
	1. กรณีนัดหมาย หากมาช้าเกิน 10 นาที โดยมิได้โทรแจ้งขอสงวนสิทธิ์ให้ผู้รับบริการท่านอื่นได้รับบริการก่อน<BR>
	2. หากท่านมีอาการ ไอ เจ็บคอ ไข้ อ่อนเพลีย ให้งดการนวด<br>
	3. ทางโรงพยาบาลไม่สามารถรับผิดชอบสิ่งของมีค่าของท่านได้<BR>
	<B>หมายเลขโทรศัพท์ 054-839305-6 ต่อ 8003, 8004</B>
	";
            } else  if ($detail == 'FU22 ตรวจตามนัดOPD เวชศาสตร์ฟื้นฟู') {

                $in_phone = "8002";
                if ($room == "อาคารแพทย์ทางเลือก") {
                    $in_phone = "8003, 8004";
                }
                print "
        1.ผู้ป่วยนัดตรวจให้ยื่นใบนัดที่$room &nbsp;&nbsp;<BR>
        2.กรุณามาตรงตามวันและเวลานัด&nbsp;<BR>
        3.<b>ถ้าผิดนัด </b>ให้ใบนัดยื่นแผนกทะเบียน &nbsp;<br>
        <b>กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 1 วันทำการ<br> ในวันเวลาราชการ เวลา 13.00 น. - 15.00 น. โทร 054-839305-6 ต่อ $in_phone </b>";
            } else {
                print "<b>หมายเหตุ:<u>$cidguard</u></b><BR>1.ผู้ป่วยนัดตรวจให้ยื่นใบนัดที่แผนกทะเบียน &nbsp;&nbsp;
    2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b> </B> ";
            }

            session_unregister("cHn");
            session_unregister("cPtname");
            session_unregister("cAge");
        } else {
            $doctor = substr($doctor, 5);
            $depcode = substr($depcode, 4);

            print "<font face='Angsana New' size='5'>&nbsp;&nbsp;<b>>>>>>>>>ใบนัดผู้ป่วย<<<<<<<<</b><br>";
            print "<font face='Angsana New' size='1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;********FR-OPD-004/1,02, 23 ม.ค. 49 ********<br>";
            print "<font face='Angsana New' size='3'&nbsp;&nbsp;>>>>>โรงพยาบาลค่ายสุรศักดิ์มนตรี  ลำปาง  โทร 054 - 839305 - 6 <<<<<br>";
            print "<b><font face='Angsana New' size='3'>ชื่อ:</b> $cPtname  &nbsp;&nbsp;&nbsp;<b>HN:</b> $cHn &nbsp;<b>อายุ:</b> $cAge&nbsp;<B>สิทธิ:$cptright<u>$cidguard</u></font></B><br>";
            print "<b><FONT SIZE=4><U>นัดมา: วัน$day ที่ $appd&nbsp;&nbsp;&nbsp;</U> </FONT></b><b> เวลา:</b> $capptime<br>";
            print "<b>นัดมาที่ห้อง:</b>&nbsp; $room";
            print "&nbsp;&nbsp;&nbsp;<b>แพทย์ผู้นัด:</b>&nbsp; $cdoctor<br>";
            if ($detail != 'NA') {
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
            print "<b>หมายเหตุ:<u>$cidguard</u></b><BR>1.ผู้ป่วยนัดตรวจยื่นใบนัดที่จุดบริการนัด &nbsp;&nbsp;2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b>ถ้าผิดนัด </b>ให้ยื่นแผนกทะเบียน &nbsp; </B><br>3.ผู้ป่วยนัดผ่าตัด นอน และสูติ ให้ยื่นใบนัดที่แผนกทะเบียน  &nbsp;&nbsp;4.ผู้ป่วยนัดทันตกรรม ให้ยื่นใบนัดที่แผนกทันตกรรม<br>5.5.กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการในวันเวลาราชการ เวลา 13.30 น. - 15.00 น. โทร 054-839305-6 ต่อ 1125 , 1100 ";
            die("");
        }
        ?>
    </div>
</div>