<?php
    $cHn="";
    $cPtname="";
    $cPtright="";
	    $cPtright1="";
    $nRunno="";
	$nPrintXray="";
    session_register("nRunno");
    session_register("cHn");
    session_register("cPtname");
    session_register("cPtright");
	    session_register("cPtright1");
	session_register("nPrintXray");

?>
<? if($_SESSION["sOfficer"]!="ศุภรัตน์ มิ่งเชื้อ"){?>
<form method="POST" action="<?php echo $PHP_SELF ?>">
  <p>ผู้ป่วยนอก  VN (ได้จากเวชระเบียน)</p>
  <p>&nbsp;&nbsp;VN&nbsp;&nbsp;<input type="text" name="vn" size="8" id="aLink"> <script type="text/javascript">
document.getElementById('aLink').focus();
</script></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="   ตกลง   " name="B1"></p>
    <p>แจ้ง กอง/แผนก ให้เริ่มทดลองการไม่พิมพ์ใบแจ้งหนี้ลดการใช้งานกระดาษ ในกรณีที่มีใบตรวจโรค ให้เขียนราคาในใบตรวจโรค แล้วนำใบตรวจโรคมาชำระเงินหรือมารับยา ในกรณีที่ไม่ได้ชำระเงิน ระบบคอมจะให้เวลาในการแก้ไขข้อมูล 2 ชั่วโมง จากการคีข้อมูลแล้วจะนำเอาข้อมูลเข้าระบบ ในกรณีที่ไม่มีใบตรวจโรคและต้องชำระเงิน ให้พิมพ์ใบแจ้งหนี้ในระยะแรกก่อนถ้าไม่ชำระไม่ต้องพิมพ์ ในกรณีที่มีใบรับรองแพทย์บนใบแจ้งหนี้ ให้พิมพ์เหมือนเดิม</p>
</form>
<? } ?>
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
        print "<FONT SIZE=\"4\"  COLOR=\"#0033CC\"><strong>ยังไม่ได้ลงทะเบียนตรวจวันนี้  โปรดขอ VN ใหม่จากห้องทะเบียน</strong></FONT><br>";
    
	
	//กรณีลงทะเบียนแล้ว
	}else { 
        $cHn=$row->hn;
        $cPtname=$row->ptname;
        $cPtright=$row->ptright;
		
        $ipsql="select * from ipcard where hn='".$cHn."' and dcdate='0000-00-00 00:00:00' AND my_ward IS NOT NULL";
$ipquery=mysql_query($ipsql);
$iprows=mysql_fetch_array($ipquery);
$my_ward=$iprows["my_ward"];
if(mysql_num_rows($ipquery) > 0){
	echo "<script>alert('ผู้ป่วยรายนี้ Admit อยู่ที่ $my_ward กรุณาคิดค่าใช้จ่ายเป็นผู้ป่วยใน');</script>";
}

        //print "VN  :$vn<br>";
        //print "HN :$cHn<br>";
        //print "$cPtname<br>";
        //print "สิทธิการรักษา :$cPtright";
        //print "<br><a href='labask.php'>ชื่อถูกต้อง ทำรายการต่อไป</a>";
//runno  for chktranx
		print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=labask.php\">";
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

