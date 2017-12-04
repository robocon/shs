<?php
    $today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  

    print "<form method='POST' action='wardlst.php'>";
    print "<p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              รายการใบเบิกยาจากหอผู้ป่วยของวันที่ ?&nbsp;&nbsp;</font></p>";
    print "<p><font face='Angsana New'>วันที่&nbsp;&nbsp; ";
    print "<input type='text' name='d' size='4' value=$d>&nbsp;&nbsp;";
    print "เดือน&nbsp; <input type='text' name='m' size='4' value=$m>&nbsp;&nbsp;&nbsp;";
    print "พ.ศ. <input type='text' name='yr' size='8' value=$yr></font></p>";

	$mward="41หอผู้ป่วยชาย";
	$fward="42หอผู้ป่วยหญิง";
	$gward="43หอผู้ป่วยสูตินรี";
	$icuward="44หอผู้ป่วย ICU";
	$vipward="45หอผู้ป่วยพิเศษ";

$all="";
print "  &nbsp;&nbsp;&nbsp;&nbsp;เลือกหอผู้ป่วย&nbsp;";
print " <select  name='ward'>";
//print " <option selected>**โปรดเลือกหอผู้ป่วย**</option>";
print " <option value='$mward'>หอผู้ป่วยชาย</option>";
print " <option value='$fward'>หอผู้ป่วยหญิง</option>";
print " <option value='$gward'>หอผู้ป่วยสูตินรี</option>";
print " <option value='$icuward'>หอผู้ป่วย ICU</option>";
print " <option value='$vipward'>หอผู้ป่วยพิเศษ</option>";
print " <option value='$all'>OR ER</option>";
print "   </select>";
////
    print "<p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    print "<input type='submit' value='     ตกลง     ' name='B1'>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
    print "<a target=_self  href='../nindex.htm'><<ไปเมนู</a></font></p>";
    print "</form>";
?>



