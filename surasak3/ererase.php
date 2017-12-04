<?php
//  ยกเลิกรายก ารแลบ  หรือ ส่งข้อมูลเข้าบัญชีผู้ป่วยในเมื่อรับป่วย 
//  laberase.php-->labselect.php-->labdetail.php-->labturn.php
//	แก้2files _erase,select: laberase,labselect,xr,er,or,pt,den
//	ส่วน labdetail.php,labturn.phpไไม่ต้องแก้

    $today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  

    print "<form method='POST' action='erselect.php'>";
    print "<p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	     ต้องการยกเลิกรายการ  หรือ ส่งข้อมูลเข้าบัญชีผู้ป่วยในเมื่อรับป่วย   &nbsp;&nbsp;</font></p>";
    print "<p><font face='Angsana New'>วันที่&nbsp;&nbsp; ";
    print "<input type='text' name='d' size='4' value=$d>&nbsp;&nbsp;";
    print "เดือน&nbsp; <input type='text' name='m' size='4' value=$m>&nbsp;&nbsp;&nbsp;";
    print "พ.ศ. <input type='text' name='yr' size='8' value=$yr></font></p>";
    print "<p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    print "<input type='submit' value='     ตกลง               ' name='B1'>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
    print "<a target=_self  href='../nindex.htm'><<ไปเมนู</a></font></p>";
    print "</form>";
?>



