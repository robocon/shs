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
?>
<form method="POST" action="chk_yearcamp1.php">
  <p><strong>รายชื่อผู้ที่มารับการตรวจสุขภาพทหาร
  </strong>
  <p><strong>ระบุปีงบประมาณ :&nbsp;</strong>
    <input name="year" type="text" class="forntsarabun" id="aLink" size="12" value="<?=$nPrefix;?>">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <input name="B1" type="submit" class="forntsarabun" value="ค้นหาข้อมูล">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< เมนูหลัก</a></p>
  </form>
