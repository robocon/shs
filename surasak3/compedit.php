<?php
   session_start();
    session_unregister("cComcode");  
    $cComcode=$Compcode;
    session_register("cComcode");  
////////
    include("connect.inc");
    $query = "SELECT * FROM company WHERE comcode = '$cComcode' ";
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

      $cComname=$row->comname;
      $cComaddr=$row->comaddr;
      $cAmpur=$row->ampur;
      $cChangwat=$row->changwat;
      $cTel      =$row->tel;
	   $cfax    =$row->fax;
	   $cpobillno    =$row->pobillno;
	   $cpobilldate    =$row->pobilldate;
	   $cpobillno2    =$row->pobillno2;
	   $cpobilldate2    =$row->pobilldate2;
	   $cpobillno3    =$row->pobillno3;
	   $cpobilldate3    =$row->pobilldate3;	   	   
   include("unconnect.inc");
///////
print "<body bgcolor='#339966' text='#00FFFF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>";
//print "<body bgcolor='#808080' text='#FFFFFF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>";
print "<form method='POST' action='comeditok.php'>";
print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>แก้ไขข้อมูลบริษัท</b><br><br>";
print "ชื่อบริษัท&nbsp;&nbsp;&nbsp;<input type='text' name='comname' size=40' value='$cComname'><br> ";
print "ที่อยู่&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='comaddr' size=40' value='$cComaddr'><br> ";
print "อำเภอ/เขต&nbsp;<input type='text' name='ampur' size=40' value='$cAmpur'><br> ";
print "จังหวัด&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='changwat' size=40' value='$cChangwat'><br> ";
print "โทรศัพท์.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='tel' size=40' value='$cTel'><br><br> ";
print "โทรสาร&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='fax' size=40' value='$cfax'><br><br> ";
print "เลขที่ใบเสนอราคา&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='pobillno' size=40' value='$cpobillno'><br><br> ";
print "ลงวันที่&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='pobilldate' size=40' value='$cpobilldate'><br><br> ";

print "เลขที่ใบเสนอราคา&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='pobillno2' size=40' value='$cpobillno2'><br><br> ";
print "ลงวันที่&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='pobilldate2' size=40' value='$cpobilldate2'><br><br> ";

print "เลขที่ใบเสนอราคา&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='pobillno3' size=40' value='$cpobillno3'><br><br> ";
print "ลงวันที่&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='pobilldate3' size=40' value='$cpobilldate3'><br><br> ";

print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' value='       บันทึก       ' name='B1'>&nbsp;&nbsp;";
print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='reset' value='    ลบทิ้ง    ' name='B2'>&nbsp;";
print "</body>";
?>

