<?php
    print "<form method='POST' action='<?php echo $PHP_SELF ?>'>";
    print "<p>&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3627;
              &#3617;&#3634;&#3618;&#3648;&#3621;&#3586;VN</p>";
    print "<p>VN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type='text' name='vn' size='4'></p>";
    print "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type='submit' value='  &#3605;&#3585;&#3621;&#3591;  ' name='B1'>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    print "<input type='reset' value='   &#3621;&#3610;   ' name='B2'></p>";
    print "</form>";
///
If (!empty($vn)){
    include("connect.inc");

    $today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  
    $thdatevn=$d.'-'.$m.'-'.$yr.$vn;
// ตรวจดูว่าลงทะเบียนหรือยัง
    $query = "SELECT * FROM opday WHERE thdatevn = '$thdatevn'";
    $result = mysql_query($query)
        or die("Query failed,opday");
    echo mysql_errno() . ": " . mysql_error(). "\n";
    echo "<br>";

        for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }	
//กรณียังไม่ลงทะเบียน
    If (empty($row->hn)){
        print "ยังไม่ได้ลงทะเบียนตรวจวันนี้  โปรดขอหมายเลข VN จากห้องทะเบียน";
        print "<input type=button onclick='history.back()' value=<< กลับไปเมนู>";
		    }
//กรณีลงทะเบียนแล้ว
   else {
        $cHn=$row->hn;
        $cPtname=$row->ptname;
        print "$cHn<br>";
        print "$cPtname<br>";
//    <br><a href="labask.php">ถูกต้อง ทำรายการต่อไป</a>
       print "<br><a href=\'labask.php? HN=$cHn\'>ถูกต้อง ทำรายการต่อไป</a>";
           }
   include("unconnect.inc");
   }
?>

