<?php
    session_start();
    include("connect.inc");

        $query ="UPDATE xrayno SET xn = '$xn'
                       WHERE hn= '$sHn' ";
        $result = mysql_query($query)
                       or die("��� xn �����  �Ҩ��������Ţ xn ��� !");

        print "HN $sHn  ����:$sName $sSurname<br>";
        print  "�����Ţ XN :$xn <br>";

    include("unconnect.inc");
    session_unregister("sHn");
    session_unregister("sName");
    session_unregister("sSurname");
?>


