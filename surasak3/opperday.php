<script language="JavaScript">
function checksubmit() {
	if(document.form1.m.value=="") {
	alert("กรุณากรอกเดือน") ;
	document.form1.m.focus() ;
	return false ;
	}else if(document.form1.yr.value=="") {
	alert("กรุณากรอกปี") ;
	document.form1.yr.focus() ;
	return false ;
	}
}
</script>
<?php
    $today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  

    print "<form name='form1' method='POST' action='oplist.php'>";
    print "<p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              รายชื่อผู้ป่วยนอกเรียงตามเวลาของวันที่ ?&nbsp;&nbsp;</font></p>";
    print "<p><font face='Angsana New'>วันที่&nbsp;&nbsp; ";
    print "<input type='text' name='d' id='d' size='4' value=$d>&nbsp;&nbsp;";
    print "เดือน&nbsp; <input type='text' name='m' id='m' size='4' value=$m>&nbsp;&nbsp;&nbsp;";
    print "พ.ศ. <input type='text' name='yr' id='yr' size='8' value=$yr></font></p>";
    print "<p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    print "<input type='submit' value='     ตกลง     ' name='B1' onclick='JavaScript:return checksubmit();'>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
//    print "<input type='reset' value='ลบทิ้ง' name='B2'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;";
    print " <a target=_self  href='../nindex.htm'><<ไปเมนู</a></font></p>";
    print "</form>";
?>


