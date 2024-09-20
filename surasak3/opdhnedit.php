<?php
session_start();
require_once 'connect.php';

// session_unregister("cHn");
// session_unregister("cPtname");
// session_unregister("cPtright");
// session_unregister("nVn");
// session_unregister("cAge");
// session_unregister("nRunno");
// session_unregister("vAN");
// session_unregister("thdatehn");
// session_unregister("cNote");
//    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลผู้ป่วยจาก HN</title>
</head>
<body>
<style>
body {
background-color: #FFFFF0;
font-family: "TH SarabunPSK";
font-size: 18px;
}
.txtsarabun {
font-family:"TH SarabunPSK";
font-size:20px;
}	
.style2 {
font-family:"TH SarabunPSK";
font-size: 18;
}
table tr td,th{
    padding:6px;
}
</style>

<form method="POST" action="opdhnedit.php">
    <h3>แก้ไขข้อมูลผู้ป่วยจาก HN</h3>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="text" name="hn" size="12">
    </p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="submit" value="  ตกลง  " name="B1">&nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" value="  ลบทิ้ง  "name="B2">
    </p>
</form>

<table>
    <tr>
        <th bgcolor=6495ED>HN</th>
        <th bgcolor=6495ED>ยศ</th>
        <th bgcolor=6495ED>ชื่อ</th>
        <th bgcolor=6495ED>สกุล</th>
    </tr>
    <?php
    if (!empty($hn)) {
        
        $hn = sprintf("%s", $_POST['hn']);
        $query = "SELECT `hn`,`yot`,`name`,`surname` FROM `opcard` WHERE `hn` = '$hn'";
        $result = mysql_query($query) or die("Query failed ".mysql_error());
        while (list($hn, $yot, $name, $surname) = mysql_fetch_row($result)) {
            print (" <tr>\n" .
                "  <td BGCOLOR=66CDAA><a href='javascript:void(0);' oncontextmenu=\"return false;\" onclick=\"return doOnClick(this,event,'$hn');\" data-url=\"opdedit.php?cHn=$hn&cName=$name&cSurname=$surname\">$hn</a></td>\n" .
                "  <td BGCOLOR=66CDAA>$yot</td>\n" .
                "  <td BGCOLOR=66CDAA>$name</td>\n" .
                "  <td BGCOLOR=66CDAA>$surname</td>\n" .
                " </tr>\n");
        }
        include("unconnect.inc");
    }
    ?>
</table>
<script>
    function doOnClick(link,ev,hn){
        if (ev.ctrlKey) {
            return false;
        }else{
            const baseUrl = link.getAttribute('data-url');
            window.open(baseUrl, 'registerVn',"width="+screen.width+",height="+screen.height);
        }
        
    }

    async function onSendTab(hn) {
        const username = encodeURIComponent('<?=$sOfficer;?>');
        const tab = encodeURIComponent('ophn จะเปิด tab ใหม่');
        const response = await fetch('open_tab.php?username='+username+'&tab='+tab+'&hn='+hn);

        if (!response.ok) {
        }

        const body = await response.text();
    }
</script>
</body>
</html>