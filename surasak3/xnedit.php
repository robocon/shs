<?php
    session_start();
    include("connect.inc");

        $query ="UPDATE xrayno SET xn = '$xn'
                       WHERE hn= '$sHn' ";
        $result = mysql_query($query)
                       or die("แก้ไข xn ไม่ได้  อาจให้หมายเลข xn ซ้ำ !");

        print "HN $sHn  ชื่อ:$sName $sSurname<br>";
        print  "หมายเลข XN :$xn <br>";

    include("unconnect.inc");
    session_unregister("sHn");
    session_unregister("sName");
    session_unregister("sSurname");
?>


