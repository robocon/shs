<?php
session_start();
include("connect.inc");

?>
<style type="text/css">
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
body {
	background-color: #FFFFFF;
}
</style>
<?php
print "<a target=_self  href='../nindex.htm' class='forntsarabun'>กลับหน้าเมนูหลัก</a>&nbsp;&nbsp;||&nbsp;&nbsp;<a  href='com_add.php'><font size='4' class='forntsarabun'>แจ้งซ่อม/ปรับปรุงโปรแกรม</font></a>&nbsp;&nbsp;||&nbsp;&nbsp;<a target=_self  href='com_month.php'><font size='4' class='forntsarabun'>รายงานประจำเดือน</font></a>&nbsp;&nbsp;||&nbsp;&nbsp;<a target=_blank  href='report_comsupport.php'><font size='4' class='forntsarabun'>รายงานผลการทำงาน</font></a>";
print "<hr>";

if($_SESSION['supportMessage'])
{
    ?><div style="border: 2px solid #bdbd00;background-color: #fdfd8c;padding: 4px;text-align:center;"><?=$_SESSION['supportMessage'];?></div><?php
    $_SESSION['supportMessage'] = NULL;
}

print"<br><div align='center' class='forntsarabun'><strong>ระบบบันทึกการแจ้งซ่อมอุปกรณ์คอมพิวเตอร์ และพัฒนาปรับปรุงโปรแกรมในระบบโรงพยาบาล<BR>ศูนย์บริการคอมพิวเตอร์ โรงพยาบาลค่ายสุรศักดิ์มนตรี</strong></div><BR>";
    print"<div align='center'><font class='forntsarabun'>ยินดีต้อนรับ คุณ <strong>$sOfficer</strong> เข้าสู่ระบบ</font></div>";
    echo "<div align='center'><font size='1' class='forntsarabun'><b>เจ้าหน้าที่โปรแกรมเมอร์....</b>ส.ต. เทวิน  ศรีแก้ว และนายกฤษณะศักดิ์  กันธรส<b>....โทร. 8500</b></font></div>";
	echo "<div align='center'><font size='1' class='forntsarabun'><b>เจ้าหน้าที่ช่างคอมพิวเตอร์....</b>นายจักรพันธ์  รุ่งเรืองศรี และนายฐานพัฒน์  นิลคำ<b>....โทร. 6203</b></font></div><br>";
$Thaidate=date("d-m-").(date("Y")+543);
$n =0;
$num = "Y";

// งานค้างที่ยังไม่ได้รับผิดชอบ
$query = "SELECT row,depart,head,datetime,programmer,date,user1 
FROM com_support 
WHERE status ='$num' 
ORDER BY row desc";
$result = mysql_query($query) or die("Query failed111");
if($num1=mysql_num_rows($result)){
    print"<div align='center' class='forntsarabun'><strong>งานที่แจ้งเข้ามาใหม่ในระบบ จำนวน $num1 รายการ</strong></div>";
    print"<table class='forntsarabun'  align='center' width='98%'>";
    print" <tr>";
    print"  <th bgcolor=#FF0033>ลำดับแจ้ง</th>";
    print"  <th bgcolor=#FF0033>แผนก</th>";
    print"  <th bgcolor=#FF0033>หัวข้อ</th>";
    print"  <th bgcolor=#FF0033>ผู้ที่ร้องขอ</th>";
    print"  <th bgcolor=#FF0033>วันที่ร้องขอ</th>";
    print"  <th bgcolor=#FF0033>ผู้รับผิดชอบ</th>";
    print"  <th bgcolor=#FF0033>พิมพ์</th>";
    print" </tr>";
    while (list ($row,$depart,$head,$datetime,$programmer,$date,$user1) = mysql_fetch_row ($result)) {
        $n++;

        $programmer = ( !empty($programmer) ) ? $programmer : 'รอการตอบรับ' ;

        if($_SESSION['smenucode']=='ADM' || $_SESSION['smenucode']=='ADMCOM'){
            $where="<a target=_TOP href=\"com_edit.php?row=$row\">$programmer</a>";
        } else {
            $where="$programmer";
        }
	
        print (" <tr>\n".
        "  <td BGCOLOR=#FF8080 align='center'>$row</td>\n".
        "  <td BGCOLOR=#FF8080>$depart</td>\n".
        "  <td BGCOLOR=#FF8080><a target=_TOP href=\"comdetail.php? row=$row\">$head</a></td>\n".
        "  <td BGCOLOR=#FF8080>$user1</td>\n".
        "  <td BGCOLOR=#FF8080>$date</td>\n".
        "  <td BGCOLOR=#FF8080>$where</td>\n".
        "  <td BGCOLOR=#FF8080><a target='_blank' href=\"com_form.php?row=$row\">พิมพ์</a></td>\n".
        " </tr>\n");
		
    }
    print"</table>";
}

 include("unconnect.inc");  

/*print"<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='com_add.php'><font size='4'>บันทึกงานใหม่</a></font>";*/
echo "<hr />";
?>

<?php
$Thaidate=date("d-m-").(date("Y")+543);
$n=0;
$num = A;
include("connect.inc");
$query = "SELECT  row,depart,head,datetime,programmer,date,user 
FROM com_support 
WHERE status ='$num' 
ORDER BY programmer asc, row desc";
$result = mysql_query($query) or die("Query failed111");

   if($num2=mysql_num_rows($result)){
        print"<div align='center' class='forntsarabun'><strong>งานที่กำลังดำเนินการ จำนวน $num2 รายการ</strong></div>";
        print"<table class='forntsarabun'  align='center' width='98%'>";
        print" <tr>";
        print"  <th bgcolor=#FFCC00>ลำดับแจ้ง</th>";
        print"  <th bgcolor=#FFCC00>แผนก</th>";
        print"  <th bgcolor=#FFCC00>หัวข้อ</th>";
        print"  <th bgcolor=#FFCC00>วันที่ร้องขอ</th>";
		print"  <th bgcolor=#FFCC00>ผู้รับผิดชอบ</th>";
		print"  <th bgcolor=#FFCC00>พิมพ์</th>";
		//print"  <th bgcolor=#FFCC00>การทำงาน</th>";
      
        print" </tr>";
        while (list ($row,$depart,$head,$datetime,$programmer,$date,$user) = mysql_fetch_row ($result)) {
			$n++;
			if($_SESSION['smenucode']=='ADM' || $_SESSION['smenucode']=='ADMCOM'){$where="<a target=_TOP href=\"comsucces.php?row=$row\">$programmer</a>";} else {$where="$programmer";};
			if($_SESSION['smenucode']=='ADM'){$add="<a target='_blank' href=\"comservice.php?row=$row&act=win\">บันทึก</a>";} else {$add="บันทึก";};
			
            print (" <tr>\n".
                "  <td BGCOLOR=#FFFF99 align='center'>$row</td>\n".
                "  <td BGCOLOR=#FFFF99>$depart</td>\n".
                "  <td BGCOLOR=#FFFF99><a target=_TOP href=\"comdetail.php? row=$row\">$head</a></td>\n".
                "  <td BGCOLOR=#FFFF99>$date</td>\n".
				  "  <td BGCOLOR=#FFFF99>$where</td>\n".
				  "  <td BGCOLOR=#FFFF99><a target='_blank' href=\"com_form.php?row=$row\">พิมพ์</a></td>\n".
				 // "  <td BGCOLOR=#FFFF99 align='center'>$add</td>\n".
                " </tr>\n");
  						    }
        print"</table>";
			}
 include("unconnect.inc");  

echo "<hr />";
?>
<?php
 $Thaidate=date("d-m-").(date("Y")+543);

$num = n;
include("connect.inc");
$query = "SELECT row,depart,head,datetime,programmer,date,p_edit,dateend 
FROM com_support 
WHERE status ='$num' 
ORDER BY dateend desc, programmer asc";
$result = mysql_query($query) or die("Query failed111");

   if($num3=mysql_num_rows($result)){
	    print"<div align='center' class='forntsarabun'><strong>งานที่ดำเนินการเสร็จแล้ว จำนวน $num3 รายการ</strong></div>";
        print"<table class='forntsarabun'  align='center' width='98%'>";
        print" <tr>";
        print"  <th bgcolor=#339966>ลำดับแจ้ง</th>";
        print"  <th bgcolor=#339966>แผนก</th>";
        print"  <th bgcolor=#339966>หัวข้อ</th>";
        print"  <th bgcolor=#339966>วันเวลาที่ร้องขอ</th>";
		print"  <th bgcolor=#339966>ผู้รับผิดชอบ</th>";
		print"  <th bgcolor=#339966>การดำเนิการ</th>";
		print"  <th bgcolor=#339966>วันเวลาที่ดำเนินการ</th>";
		print"  <th bgcolor=#339966>พิมพ์</th>";
      
        print" </tr>";
        while (list ($row,$depart,$head,$datetime,$programmer,$date,$p_edit,$dateend) = mysql_fetch_row ($result)) {
            print (" <tr>\n".
                "  <td BGCOLOR=#33CC99  align='center'>$row</td>\n".
                "  <td BGCOLOR=#33CC99>$depart</td>\n".
                "  <td BGCOLOR=#33CC99><a target=_TOP href=\"comdetail.php? row=$row\">$head</a></td>\n".
                "  <td BGCOLOR=#33CC99>$date</td>\n".
				"  <td BGCOLOR=#33CC99>$programmer</td>\n".
				"  <td BGCOLOR=#33CC99>$p_edit</td>\n".
				"  <td BGCOLOR=#33CC99>$dateend</td>\n".
				"  <td BGCOLOR=#33CC99><a target='_blank' href=\"com_form.php?row=$row\">พิมพ์</a></td>\n".
                " </tr>\n");
  				}
        print "</table>";
			}
 include("unconnect.inc");  
?>