<?php
 session_start();
    include("connect.inc");
    $query = "SELECT history FROM opcard WHERE hn = '$cHn'";
    $result = mysql_query($query)
        or die("Query failed,opcard");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

   $cPastHx=$row->history;
   include("unconnect.inc");
   print"<font face='Angsana New'><b>รายการตรวจรักษาผู้ป่วยนอก &nbsp;&nbsp;&nbsp;</b><br>";
   print "<font face='Angsana New'>HN :$cHn ชื่อ $cPtname  สิทธิ: $cPtright<br>";
print"<font face='Angsana New'><b>***************************&nbsp;&nbsp;&nbsp;</b><br>";
  
 // print"วันที่รักษา";
   $cNewHx=$history;
//   print"$cNewHx<br>";
   $cDiag=$diag;
   $completeHx=$cPastHx.'<br>'.$cNewHx.'<br>Dx:'.$cDiag.'  <br>นพ.'.$sOfficer;
   print"$completeHx <br>";
  // print "<textarea rows='8' name='report' cols='55'>$completeHx</textarea>";

   // include("connect.inc");
    //    $query ="UPDATE opcard SET  history = '$completeHx'
	//       WHERE hn= '$cHn' ";
      //  $result = mysql_query($query) or die("Query failed,update opcard");
   //include("unconnect.inc");
?>

