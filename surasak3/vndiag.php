<?php
    $cHn="";
    $cPtname="";
    $cPtright="";
    $nRunno="";
    session_register("nRunno");
    session_register("cHn");
    session_register("cPtname");
    session_register("cPtright");
?>
<form method="POST" action="<?php echo $PHP_SELF ?>">
  <p>ผู้ป่วยนอก  หมายเลข VN (ได้จากแผนกเวชระเบียน)</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;VN&nbsp;&nbsp;<input type="text" name="vn" size="8"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="   ตกลง   " name="B1"></p>
    <p><B>แจ้ง กอง/แผนก ให้เริ่มทดลองการไม่พิมพ์ใบแจ้งหนี้ลดการใช้งานกระดาษ</B> <B>ในกรณีที่มีใบตรวจโรค</B> ให้เขียนราคาในใบตรวจโรค แล้วนำใบตรวจโรคมาชำระเงินหรือมารับยา <B>ในกรณีที่ไม่ได้ชำระเงิน</B> ระบบคอมจะให้เวลาในการแก้ไขข้อมูล 2 ชั่วโมง จากการคีข้อมูลแล้วจะนำเอาข้อมูลเข้าระบบ <B>ในกรณีที่ไม่มีใบตรวจโรคและต้องชำระเงิน</B> ให้พิมพ์ใบแจ้งหนี้ในระยะแรกก่อนถ้าไม่ชำระไม่ต้องพิมพ์ <B>ในกรณีที่มีใบรับรองแพทย์บนใบแจ้งหนี้ </B>ให้พิมพ์เหมือนเดิม</p>
</form>

<?php
   $tvn="$vn";
    session_register("tvn");
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
/*
    echo mysql_errno() . ": " . mysql_error(). "\n";
    echo "<br>";
*/
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
        print "VN :$vn<br>";
        print "ยังไม่ได้ลงทะเบียนตรวจวันนี้  โปรดขอ VN ใหม่จากห้องทะเบียน<br>";
                                    }
//กรณีลงทะเบียนแล้ว
   else { 
        $cHn=$row->hn;
        $cPtname=$row->ptname;
        $cPtright=$row->ptright;
        //print "VN  :$vn<br>";
        //print "HN :$cHn<br>";
        //print "$cPtname<br>";
        //print "สิทธิการรักษา :$cPtright";
       // print "<br><a href='erask.php'>ชื่อถูกต้อง ทำรายการต่อไป</a>";
	   print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=erask.php\">";
//runno  for chktranx
    $query = "SELECT title,prefix,runno FROM runno WHERE title = 'depart'";
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

    $nRunno=$row->runno;
    $nRunno++;

    $query ="UPDATE runno SET runno = $nRunno WHERE title='depart'";
    $result = mysql_query($query)
        or die("Query failed");
//end  runno  for chktranx
           }
   include("unconnect.inc");
   }
?>

