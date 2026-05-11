<?php
session_start();
if($_SESSION["sOfficer"] == ""){
	echo "<center><font color='#000000' >ขออภัยครับ การ Login ของท่านหมดอายุ </font><br />";
	echo "<a href=\"../sm3.php\" target=\"_top\">กลับหน้าแรก</a></center>";
	exit();
}
include("connect.php");
$ward_lists = array(
'42' => 'หอผู้ป่วยรวม',
'43' => 'หอผู้ป่วยสูติ',
'44' => 'หอผู้ป่วยICU',
'45' => 'หอผู้ป่วยพิเศษ',
'46' => 'หอผู้ป่วย Cohort Ward',
'47' => 'หอผู้ป่วย Home Isolation',
'48' => 'หอผู้ป่วย รพ.สนาม',
);
$ward = $_POST['ward'];
$cBedcode = $_POST['cBedcode'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ย้ายจาก <?= $ward_lists[$ward]; ?></title>
</head>
<body>
    <style>
        body{
            font-family: "TH SarabunPSK";
            font-size:18px;
        }
        table tr td{
            padding: 4px;
        }
        table tr td a{
            text-decoration: none;
        }
        table tr td a:hover{
            text-decoration: underline;
            text-shadow: 2px 1px 4px #555555;
        }
    </style>
    <input type="button" onclick="history.back();" value="       &lt;&lt;&nbsp;ย้อนกลับ      " /><br />
    <p>เลือกชื่อผู้ป่วยที่จะย้ายจาก <?= $ward_lists[$ward]; ?></p>
    <table>
        <tr>
            <th bgcolor="CD853F">เตียง</th>
            <th bgcolor="CD853F">AN</th>
            <th bgcolor="CD853F">ชื่อผู้ป่วย</th>
            <th bgcolor="CD853F">แพทย์เจ้าของ</th>
        </tr>
        <?php
        $query = "SELECT bed,an,ptname,bedcode,doctor FROM bed WHERE bedcode LIKE '$ward%' ORDER BY bed ASC ";
        $result = mysql_query($query) or die("Query failed");
        while (list($bed, $an, $ptname, $bedcode, $doctor) = mysql_fetch_row($result)) {
            print(" <tr>\n" .
            "  <td BGCOLOR='F5DEB3'>$bed</td>\n" .
            "  <td BGCOLOR='F5DEB3'>$an</td>\n" .
            "  <td BGCOLOR='F5DEB3'><a href=\"javascript:void(0);\" onclick=\"openOkchgwa('okchgwa.php?outbcode=$bedcode&cBedcode=$cBedcode')\">$ptname</a></td>\n" .
            "  <td BGCOLOR='F5DEB3'>$doctor</td>\n" .
            " </tr>\n");
        }
        ?>
    </table>
    <script>
        function openOkchgwa(url){
            let r = confirm('ยืนยันการย้ายเตียง');
            if(r===true){
                window.open(url,'okchgwaPage', 'height=700,width=800,scrollbars=yes');
            }
        }
    </script>
</body>
</html>