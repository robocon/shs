<?php
session_start();
include("connect.inc");

// --- ดึงปีล่าสุดจาก runno ---
$query = "SELECT runno, prefix FROM runno WHERE title = 's_chekup'";
$result = mysql_query($query) or die("Query failed");

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
    if (!mysql_data_seek($result, $i)) continue;
    if(!($row = mysql_fetch_object($result))) continue;
}
$nPrefix = $row->prefix;
$chknPrefix = "25".$nPrefix;
?>
<form method="POST" action="">
<input name="act" type="hidden" value="show">
  <p><strong>ลูกหนี้ตรวจสุขภาพทหาร</strong>  
  ปรับปรุงล่าสุด 29/9/2568 By sgpt.แอมป์</p>
  <p><strong>ระบุปีงบประมาณ :&nbsp;</strong>
    <input name="year" type="text" size="12" value="<?=$nPrefix;?>">
    &nbsp;&nbsp;<input name="B1" type="submit" value="ค้นหาข้อมูล">
    &nbsp;&nbsp;<a target=_top href="../nindex.htm">&lt;&lt; เมนูหลัก</a>
  </p>
</form>

<?php
if($_POST["act"]=="show"){
    $year = $_POST["year"];

    echo "<h3>รายชื่อผู้ที่ลงทะเบียนตรวจสุขภาพประจำปี $year และเรียกเก็บจากหน่วยต้นสังกัด</h3>";
    echo "จำนวนรายการที่บันทึก/กดดู = รายชื่อผู้ป่วย<br>";

    // รวมทั้งหมด
    $query1 = mysql_query("SELECT * FROM condxofyear_so WHERE yearcheck = '$chknPrefix'");  
    $row = mysql_num_rows($query1);

    echo "<table border='1' cellpadding='5' cellspacing='0' width='80%'>";
    echo "<tr bgcolor='#66CDAA'>
            <td><b>ลำดับ</b></td>
            <td><b>ชื่อสังกัด</b></td>
            <td><b>จำนวน</b></td>
          </tr>";

    // --- JOIN โดยใช้ hn เป็นตัวเชื่อม ---
    $query = "	
		SELECT 
			r.camp AS camp_name, 
			COUNT(DISTINCT r.hn) AS duplicate
		FROM register_chkup_soldier r
		INNER JOIN opacc o ON r.hn = o.hn
		WHERE r.yearcheck = '$chknPrefix'
		  AND o.credit = 'CHKUP$year'
		GROUP BY r.camp
		HAVING duplicate > 0
		ORDER BY r.camp;		
    ";
	//echo $query;
    $result = mysql_query($query);
    $n=0;

    while ($data = mysql_fetch_assoc($result)) {
        $n++;
        $camp_name = $data['camp_name'];
        $duplicate = $data['duplicate'];

        echo "<tr bgcolor='".($n%2==0?"#f1f8e9":"#ffffff")."'>
                <td>$n)</td>
                <td><a target='_blank' href=\"report_financearmychkup1.php?camp=".urlencode($camp_name)."&year=$year\">$camp_name</a></td>
                <td>จำนวน = $duplicate รายการ</td>
              </tr>";
    }
    echo "</table>";
}
?>
