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
		$query = "SELECT runno, prefix  FROM runno WHERE title = 'y_chekup'";
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
		$showPrefix="25".$nPrefix;
?>
<form method="POST" action="report_dxofyeararmy.php">
<input name="act" type="hidden" value="show">
  <p><strong>ทหารที่ไม่มาตรวจสุขภาพประจำปี <?=$showPrefix;?>
  </strong>
  <p><strong>ระบุปีงบประมาณ :&nbsp;</strong>
    <input name="year" type="text" class="forntsarabun" id="aLink" size="12" value="<?=$nPrefix;?>">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <input name="B1" type="submit" class="forntsarabun" value="ค้นหาข้อมูล">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< เมนูหลัก</a></p>
  </form>
<?
if($_POST["act"]=="show"){
$showyear="25".$_POST["year"];
$appd=$appdate.' '.$appmo.' '.$thiyr;
$appd1=$thiyr.'-'.$appmo.'-'.$appdate;
    print "<font face='TH SarabunPSK'><b>รายชื่อหน่วยงานที่ตรวจสุขภาพประจำปี $showyear</b><br>";
  
//  print "<b>วันที่</b>  ";
   $query="SELECT  camp1,COUNT(*) AS duplicate FROM condxofyear_so  WHERE yearcheck = '$showyear' GROUP BY camp1 HAVING duplicate > 0 ORDER BY camp1";
   $result = mysql_query($query);
   $n=0;
 while (list ($camp,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='TH SarabunPSK'>$n)&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA><font face='TH SarabunPSK'><a target=_BLANK href=\"report_dxofyeararmy1.php?camp=$camp&year=$showyear\">$camp ($num)</a></td>\n".
               " </tr>\n<br>");
               }

}
?>