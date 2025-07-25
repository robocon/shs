<?php
session_start();
$until_login = "xray";
session_register("until_login");

?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="GENERATOR" content="Microsoft FrontPage 4.0">
    <meta name="ProgId" content="FrontPage.Editor.Document">
    <title></title>
</head>

<body>
    <? if ($_SESSION["sOfficer"] == "ศุภรัตน์ มิ่งเชื้อ") { ?>
        &nbsp;&nbsp;<font size="2">&nbsp;&nbsp;<b>คิดค่าใช้จ่ายตรวจมวลกระดูก (BMD)</b>&nbsp;(ผู้ป่วยนอก)
            &nbsp;&nbsp;&nbsp;&nbsp
            <a target=_top href="xrayhn.php">สั่งรายการคนใหม่ HN</a>
            &nbsp;&nbsp&nbsp;
            <a target=_top href="../nindex.htm">ไปหน้าจอหลัก</a>
        </font>
    <?
    } else {
        ?>
        &nbsp;&nbsp;<font size="2">&nbsp;&nbsp;<b>เอกซ์เรย์</b>&nbsp;(ผู้ป่วยนอก)
            &nbsp;&nbsp;&nbsp;
            
            <a target=_top href="xraypage.php">สั่งรายการคนใหม่VN</a>
            &nbsp;|&nbsp;
            <a target=_top href="xrayhn.php">สั่งรายการคนใหม่HN</a>
            &nbsp;|&nbsp;
            <a target="left" href="xraydoctor.php" onClick="parent.frames[2].location='connect.php';">X-Rayจากแพทย์</a>
            &nbsp;|&nbsp;
            <a target=_top href="xray_one.php">ตรวจสุขภาพแบบไม่คิดค่าใช้จ่าย</a>
            <!-- &nbsp;|&nbsp;
            <a target=_blank href="orderlabsso.php">ตรวจสุขภาพลูกจ้าง<span style="color:red;font-weight:bold;">ปี67<span></a> -->
            &nbsp;|&nbsp;
            <a target=_top href="../nindex.htm">ไปหน้าจอหลัก</a>
        </font>

        <? if ($_SESSION["smenucode"] == "ADMXRAY" || $_SESSION["smenucode"] == "ADM") { ?>
            <br><a href="orderlabsso.php" target="_blank"><b>&gt;&gt;&nbsp;ตรวจสุขภาพลูกจ้างประจำปี68&nbsp;&lt;&lt;&lt;</b></a>
        <? } ?>

    <?
    }
    ?>
</body>

</html>