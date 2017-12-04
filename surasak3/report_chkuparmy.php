<style>
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
.font1{
	font-family: "TH SarabunPSK";
	font-size:20px;
}
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
</style>
<?
 include("connect.inc");
		$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
		$result = mysql_query($query) or die("Query failed");
		
		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}
				if(!($row = mysql_fetch_object($result)))
				continue;
		}
		$nPrefix=$row->prefix;
?>
<form method="POST" action="report_chkuparmy.php">
<input name="act" type="hidden" value="show">
  <p><strong>รายชื่อผู้ที่มารับการตรวจสุขภาพทหาร
  </strong>
  <p><strong>ระบุปีงบประมาณ :&nbsp;</strong>
    <input name="year" type="text" class="forntsarabun" id="aLink" size="12" value="<?=$nPrefix;?>">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <input name="B1" type="submit" class="forntsarabun" value="ค้นหาข้อมูล">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< เมนูหลัก</a></p>
  </form>
<?
if($_POST["act"]=="show"){
$year=$_POST["year"];
$appd=$appdate.' '.$appmo.' '.$thiyr;
$appd1=$thiyr.'-'.$appmo.'-'.$appdate;
    print "<font face='TH SarabunPSK'><b>รายชื่อผู้ที่มาตรวจสุขภาพประจำปี $year</b><br>";
  
//  print "<b>วันที่</b>  ";
  print "จำนวนรายการที่บันทึก/กดดู = รายชื่อผู้ป่วย<br> ";
   $query="SELECT  camp,COUNT(*) AS duplicate FROM chkup_solider  WHERE yearchkup = '$year'   GROUP BY camp HAVING duplicate > 0 ORDER BY camp";
   $result = mysql_query($query);
   $query1=mysql_query("SELECT  * FROM chkup_solider  WHERE yearchkup = '$year'");   
   $row=mysql_num_rows($query1);
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='TH SarabunPSK'>ดูรายงาน</td>\n".
               "  <td BGCOLOR=66CDAA><font face='TH SarabunPSK'><a target=_BLANK href=\"report_chkuparmy1.php?camp=all&year=$year\">ทั้งหมด</a></td>\n".
        	   "  <td BGCOLOR=66CDAA><font face='TH SarabunPSK'>จำนวน&nbsp; = &nbsp;$row &nbsp;&nbsp;รายการ</td>\n".
               " </tr>\n<br>");   
   $n=0;
 while (list ($camp,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='TH SarabunPSK'>$n)&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA><font face='TH SarabunPSK'><a target=_BLANK href=\"report_chkuparmy1.php?camp=$camp&year=$year\">$camp&nbsp;&nbsp;</a></td>\n".
         "  <td BGCOLOR=66CDAA><font face='TH SarabunPSK'>จำนวน&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;รายการ</td>\n".
               " </tr>\n<br>");
               }

}
?>