<?php
    include("connect.inc");

    $query = "SELECT newpha  FROM newpha ";
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
        $newpha=$row->newpha;
       
                  }  
   else {
      echo "ไม่พบ รหัส : $title ";
           }    
include("unconnect.inc");

print "<body bgcolor='#808080' text='#FFFFFF'>";
print "<form method='POST' action='newphaupdate.php' target='_BLANK'>";
print "<table border='0' width='100%' height='345'>";
print "<tr>";
print " <td width='7%' height='21'></td>";
print "  <td width='48%' height='21'>";
print "  <p align='center'><b>'แก้ไขข้อมูล';</b>&nbsp;&nbsp;</td>";
print " </tr>";
print " <tr>";
print " ประกาศ ";
print "   <input type='text' name='newpha' size='100' tabindex='5'value='$newpha'><br>";
print "  <input type='submit' value='   &#3605;&#3585;&#3621;&#3591;   ' name='B1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "    <input type='reset' value='  &#3621;&#3610;&#3607;&#3636;&#3657;&#3591;  ' name='B2'></td>";
print "     <td width='45%' height='76'></td>";
print "    </tr>";
print " </table>";
print "</form>";
print "</body>";

?>




    