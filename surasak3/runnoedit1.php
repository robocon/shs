<?php
    include("connect.inc");

    $query = "SELECT  title,prefix,runno  FROM runno WHERE title = '$title'";
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
        $title=$row->title;
        $prefix=$row->prefix;
        $runno=$row->runno;
                  }  
   else {
      echo "ไม่พบ รหัส : $title ";
           }    
include("unconnect.inc");

print "<body bgcolor='#CCCCCC' text='#FFFFFF'>";
print "<form method='POST' action='runnoupdate.php' target='_BLANK'>";
print "<table border='0' width='100%' height='345'>";
print "<tr>";
print " <td width='7%' height='21'></td>";
print "  <td width='48%' height='21'>";
print "  <p align='center'><b>แก้ไขข้อมูล runno</b>&nbsp;&nbsp;</td>";
print "  <td width='45%' height='21'><b style='color:#CC3333;'>!!! โปรดทำด้วยความระมัดระวัง</b></td>";
print " </tr>";
print " <tr>";
print " รายการ ";
print "   <input type='text' name='title' size='20' tabindex='5'value=$title><br>";
print " ห้ามทำการเปลี่ยนรายการ";
print " <td width='7%' height='236'></td>";
print " fix";
print "   <input type='text' name='prefix' size='20' tabindex='5'value=$prefix><br>";

print " run";
print "   <input type='text' name='runno' size='20' tabindex='5'value=$runno><br>";
print "<br>";
print "  <input type='submit' value='   แก้ไขคิว   ' name='B1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "    <input type='reset' value='  ลบทิ้ง  ' name='B2'></td>";
print "     <td width='45%' height='76'></td>";
print "    </tr>";
print " </table>";
print "</form>";
print "</body>";

?>




    