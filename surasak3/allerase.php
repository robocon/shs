<?php
session_start();
?>
<style type="text/css">

body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
.txt{
	font-family: TH SarabunPSK;
	font-size: 20px;
}

</style>
<?php
//  ยกเลิกรายก ารแลบ หรือ ส่งข้อมูลเข้า บ/ช ผป.ใน
//  laberase.php-->labselect.php-->labdetail.php-->labturn.php
//	แก้2files _erase,select: laberase,labselect,xr,er,or,pt,den
//	ส่วน labdetail.php,labturn.phpไไม่ต้องแก้

    $today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  

    print "<form method='POST' action='alldelselect.php' >";
    print "<p style='font-weight:bold;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	     ต้องการยกเลิกรายการ หรือ ส่งข้อมูลเข้าบัญชีผู้ป่วยในเมื่อรับป่วย   &nbsp;&nbsp;</p>";
    print "<p>วันที่&nbsp;&nbsp; ";
    print "<input class='txt' type='text' name='d' size='4' value=$d>&nbsp;&nbsp;";
    print "เดือน&nbsp; <input class='txt' type='text' name='m' size='4' value=$m>&nbsp;&nbsp;&nbsp;";
    print "พ.ศ. <input class='txt' type='text' name='yr' size='8' value=$yr>";
	 print "&nbsp;&nbsp;&nbsp;&nbsp;VN/AN:<input class='txt' type='text' name='vn' size='10' ></p>";
    print "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    print "<input class='txt' type='submit' value='   ตกลง   ' name='B1'>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
    print "<a target=_self  href='../nindex.htm'><<ไปเมนู</a></p>";
    print "</form>";
?>



