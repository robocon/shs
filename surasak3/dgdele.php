<?php
    session_start();
    session_unregister("cDgrow");
    session_unregister("cDgcode");
    session_unregister("cDgtrad");  
    $cDgrow = $Delrow;
    $cDgcode=$Dgcode;
    $cDgtrad=$Dgtrad;
    session_register("cDgrow");
    session_register("cDgcode");
    session_register("cDgtrad");
    print "$Dgcode,$Dgtrad<br>";
    print "��ͧ���ź��¡�ù�� �͡�ҡ�ѭ�����Ǫ�ѳ�� !<br><br>";
    print "<br><a target=_self href='dgdeleok.php'>�׹�ѹ���ź</a>";
?>

