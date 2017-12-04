<?php
   session_start();
    session_unregister("sSlcode");  
    $sSlcode="";
    session_register("sSlcode"); 

    include("connect.inc");
    $query = "SELECT * FROM drugslip WHERE row_id = '$vRow' ";
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
      $sSlcode=$row->slcode;
      $cDetail1=$row->detail1;
      $cDetail2=$row->detail2;
      $cDetail3=$row->detail3;
      $cDetail4=$row->detail4;

   include("unconnect.inc");
///////
print "<body bgcolor='#339966' text='#00FFFF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>";
//print "<body bgcolor='#808080' text='#FFFFFF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>";
print "<form method='POST' action='slipeditok.php'>";
print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>แก้ไขวิธีใช้ยา</b><br><br>";
print "รหัสวิธีใช้ :&nbsp;&nbsp;&nbsp; $sSlcode <br>";
print "แถวที่ 1:&nbsp;&nbsp;&nbsp;<input type='text' name='rxdetail1' size=40' value='$cDetail1'><br> ";
print "แถวที่ 2:&nbsp;&nbsp;&nbsp;<input type='text' name='rxdetail2' size=40' value='$cDetail2'><br> ";
print "แถวที่ 3:&nbsp;&nbsp;&nbsp;<input type='text' name='rxdetail3' size=40' value='$cDetail3'><br> ";
print "แถวที่ 4:&nbsp;&nbsp;&nbsp;<input type='text' name='rxdetail4' size=40' value='$cDetail4'><br><br> ";
print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' value='       บันทึก       ' name='B1'>&nbsp;&nbsp;";
print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='reset' value='    ลบทิ้ง    ' name='B2'>&nbsp;";
print "</body>";
?>

