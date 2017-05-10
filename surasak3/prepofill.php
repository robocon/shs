<?php
    session_start();
    session_unregister("xRow_id");
//    session_unregister("nRow_id");
    $xRow_id=$nRow_id;
    session_register("xRow_id");
    include("connect.inc");

    $query = "SELECT * FROM pocompany WHERE row_id = '$nRow_id'";
    $result = mysql_query($query)
        or die("Query failed");
 
    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

   If ($result){
    $cDepart=$row->depart;
    $cDepartno=$row->departno;
    $cDepartdate=$row->departdate;

	$cPrepono=$row->prepono;
	$cPrepodate=$row->prepodate;
	$cPono=$row->pono;
	$cPodate=$row->podate;
	$cBounddate=$row->bounddate;
	$cChkindate=$row->chkindate;
	$cSenddate=$row->senddate;
	$cPonoyear=$row->ponoyear;
                  }  
   else {
                echo "ไม่พบ รหัส : $cTdatehn";
           }    
include("unconnect.inc");

print "<body bgcolor='##669999' text='#FFFFFF'>";
print "<form method='POST' action='prepofilok.php' target='_BLANK'>";
print "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <b><font face='Angsana New'>การเสนอความต้องการจาก กอง / แผนก</b>";
print "  <br>สำหรับใช้ใน กอง / แผนก <input type='text' name='depart' size='30' value='$cDepart'>";
print "  <br>ที่  (ของ  กอง / แผนก)......... <input type='text' name='departno' size='30' value='$cDepartno'>";
print "  <br>ลงวันที่ .................................<input type='text' name='departdate' size='30' value='$cDepartdate'><br>";
print " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

print "  <b>ใบสั่งซื้อชั่วคราว</b>";
print "  <br>ที่ กห ใบสั่งซื้อชั่วคราว <input type='text' name='prepono' size='30' value='$cPrepono'><br>";
print "  วันที่ใบสั่งซื้อชั่วคราว&nbsp;&nbsp;&nbsp;<input type='text' name='prepodate' size='30' value='$cPrepodate'><br>";

print " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <b> ใบสั่งซื้อจริง</b>";
print "  <br>";
print "  ที่ กห ใบสั่งซื้อจริง&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='pono' size='30' value='$cPono'>ปี&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='ponoyear' size='5' value='$cPonoyear'><br>";
print "  วันที่ใบสั่งซื้อจริง&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input type='text' name='podate' size='30' value='$cPodate'><br>";
print "  วันที่กำหนดส่งของ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input type='text' name='bounddate' size='30' value='$cBounddate'><br>";
print "  วันที่รับมอบของ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input type='text' name='chkindate' size='30' value='$cChkindate'><br>";
print "  ส่งของเมื่อ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input type='text' name='senddate' size='30' value='$cSenddate'><br>";
print "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input type='submit' value='        &#3610;&#3633;&#3609;&#3607;&#3638;&#3585;        ' name='B1'></p>";
print "</form>";
print "</body>";
?>




    