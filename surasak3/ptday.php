<?php
    $today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  

    print "<form method='POST' action='ptlst.php'>";
    print "<p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              ต้องการดูรายการผ่าตัด  ของวันที่ ?&nbsp;&nbsp;</font></p>";
    print "<p><font face='Angsana New'>วันที่&nbsp;&nbsp; ";
    print "<input type='text' name='d' size='4' value=$d>&nbsp;&nbsp;";
    print "เดือน&nbsp; <input type='text' name='m' size='4' value=$m>&nbsp;&nbsp;&nbsp;";
    print "พ.ศ. <input type='text' name='yr' size='8' value=$yr></font></p>";
    print "<p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    print "<input type='submit' value='ตกลง' name='B1'>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
    print "<input type='reset' value='ลบทิ้ง' name='B2'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;";
    print "<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
    print "</form>";
?>


