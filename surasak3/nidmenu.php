<?php
session_start();
?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="GENERATOR" content="Microsoft FrontPage 4.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<title>???????&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
???????&nbsp;&nbsp;&nbsp;
???????</title>
</head>

<body>
&nbsp;&nbsp;<font size="2">&nbsp;&nbsp; <b>ฝังเข็ม&nbsp;</b>&nbsp;(ผู้ป่วยนอก)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp <a target=_top href="nidpage.php">สั่งรายการคนใหม่ VN</a>    &nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;
<?php
//if( $_SESSION['smenucode'] != 'ADMNID' ){  //ทำไมถึง Lock ไม่ให้ ADMNID คิดค่าใช้จ่ายจาก HN ? 21/07/59 แอมป์
?>
&nbsp <a target=_top href="nidhn.php">สั่งรายการคนใหม่ HN</a>    &nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;
<?php
//}
?>
<a target=_top  href="../nindex.htm">ไปหน้าจอหลัก</a>
</font>
</body>

</html>
