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
	background-color: #339966;
}
</style>
<?php
print "<a target=_self  href='../nindex.htm' class='forntsarabun'>กลับหน้าเมนูหลัก</a>&nbsp;&nbsp;||&nbsp;&nbsp;<a target=_blank  href='com_add.php'><font size='4' class='forntsarabun'>แจ้งซ่อม/ปรับปรุงโปรแกรม</font></a>&nbsp;&nbsp;||&nbsp;&nbsp;<a target=_self  href='com_month.php'><font size='4' class='forntsarabun'>รายงานประจำเดือน</font></a>&nbsp;&nbsp;||&nbsp;&nbsp;<a target=_blank  href='report_comsupport.php'><font size='4' class='forntsarabun'>รายงานผลการทำงาน</font></a>";
print "<hr>";
print"<br><div align='center' class='forntsarabun'><strong>ระบบบันทึกการแจ้งซ่อมอุปกรณ์คอมพิวเตอร์ และพัฒนาปรับปรุงโปรแกรมในระบบโรงพยาบาล<BR>ศูนย์บริการคอมพิวเตอร์ โรงพยาบาลค่ายสุรศักดิ์มนตรี โทร. 054-839305 ต่อ 6203</strong></div><BR>";
    print"<div align='center'><font class='forntsarabun'>ยินดีต้อนรับ คุณ <strong>$sOfficer</strong> เข้าสู่ระบบ</font></div>";
    echo "<div align='center'><font size='1' class='forntsarabun'><b>ผู้รับผิดชอบงานแก้ไขปรับปรุงโปรแกรม....</b>ส.ต. เทวิน  ศรีแก้ว และนายกฤษณะศักดิ์  กันธรส</font></div>";
	echo "<div align='center'><font size='1' class='forntsarabun'><b>ผู้รับผิดชอบงานซ่อมอุปกรณ์ทางคอมพิวเตอร์....</b>นายจักรพันธ์  รุ่งเรืองศรี และนายฐานะพัฒน์  นิลคำ</font></div><br>";
$Thaidate=date("d-m-").(date("Y")+543);
$n =0;
$num = "Y";

// งานค้างที่ยังไม่ได้รับผิดชอบ
$query = "SELECT row,depart,head,datetime,programmer,date,user1 
FROM com_support 
WHERE status ='$num' 
ORDER BY row desc";
$result = mysql_query($query) or die("Query failed111");
if(mysql_num_rows($result)){
    print"<div align='center' class='forntsarabun'><strong>งานที่แจ้งเข้ามาใหม่ในระบบ</strong></div>";
    print"<table class='forntsarabun'  align='center' width='98%'>";
    print" <tr>";
    print"  <th bgcolor=#FF9966>ลำดับ</th>";
    print"  <th bgcolor=#FF9966>ลำดับแจ้ง</th>";
    print"  <th bgcolor=#FF9966>แผนก</th>";
    print"  <th bgcolor=#FF9966>หัวข้อ</th>";
    print"  <th bgcolor=#FF9966>ผู้ที่ร้องขอ</th>";
    print"  <th bgcolor=#FF9966>วันที่ร้องขอ</th>";
    print"  <th bgcolor=#FF9966>ผู้รับผิดชอบ</th>";
    print"  <th bgcolor=#FF9966>พิมพ์</th>";
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
        "  <td BGCOLOR=#FFCC99 align='center'>$n</td>\n".
        "  <td BGCOLOR=#FFCC99 align='center'>$row</td>\n".
        "  <td BGCOLOR=#FFCC99>$depart</td>\n".
        "  <td BGCOLOR=#FFCC99><a target=_TOP href=\"comdetail.php? row=$row\">$head</a></td>\n".
        "  <td BGCOLOR=#FFCC99>$user1</td>\n".
        "  <td BGCOLOR=#FFCC99>$date</td>\n".
        "  <td BGCOLOR=#FFCC99>$where</td>\n".
        "  <td BGCOLOR=#FFCC99><a target='_blank' href=\"com_form.php?row=$row\">พิมพ์</a></td>\n".
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
ORDER BY row desc";
$result = mysql_query($query) or die("Query failed111");

   if(mysql_num_rows($result)){
        print"<div align='center' class='forntsarabun'><strong>งานที่กำลังดำเนินการอยู่</strong></div>";
        print"<table class='forntsarabun'  align='center' width='98%'>";
        print" <tr>";
		        print"  <th bgcolor=#FF99CC>ลำดับ</th>";
        print"  <th bgcolor=#FF99CC>ลำดับแจ้ง</th>";
        print"  <th bgcolor=#FF99CC>แผนก</th>";
        print"  <th bgcolor=#FF99CC>หัวข้อ</th>";
        print"  <th bgcolor=#FF99CC>วันที่ร้องขอ</th>";
		print"  <th bgcolor=#FF99CC>ผู้รับผิดชอบ</th>";
		print"  <th bgcolor=#FF99CC>พิมพ์</th>";
		//print"  <th bgcolor=#FF99CC>การทำงาน</th>";
      
        print" </tr>";
        while (list ($row,$depart,$head,$datetime,$programmer,$date,$user) = mysql_fetch_row ($result)) {
			$n++;
			if($_SESSION['smenucode']=='ADM' || $_SESSION['smenucode']=='ADMCOM'){$where="<a target=_TOP href=\"comsucces.php?row=$row\">$programmer</a>";} else {$where="$programmer";};
			if($_SESSION['smenucode']=='ADM'){$add="<a target='_blank' href=\"comservice.php?row=$row&act=win\">บันทึก</a>";} else {$add="บันทึก";};
			
            print (" <tr>\n".
				      "  <td BGCOLOR=#FFCCCC align='center'>$n</td>\n".
                "  <td BGCOLOR=#FFCCCC align='center'>$row</td>\n".
                "  <td BGCOLOR=#FFCCCC>$depart</td>\n".
                "  <td BGCOLOR=#FFCCCC><a target=_TOP href=\"comdetail.php? row=$row\">$head</a></td>\n".
                "  <td BGCOLOR=#FFCCCC>$date</td>\n".
				  "  <td BGCOLOR=#FFCCCC>$where</td>\n".
				  "  <td BGCOLOR=#FFCCCC><a target='_blank' href=\"com_form.php?row=$row\">พิมพ์</a></td>\n".
				 // "  <td BGCOLOR=#FFCCCC align='center'>$add</td>\n".
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
ORDER BY dateend desc 
LIMIT 40 ";
$result = mysql_query($query) or die("Query failed111");

   if(mysql_num_rows($result)){
	    print"<div align='center' class='forntsarabun'><strong>งานที่ดำเนินการเสร็จแล้ว</strong></div>";
        print"<table class='forntsarabun'  align='center' width='98%'>";
        print" <tr>";
        print"  <th bgcolor=#0099CC>ลำดับแจ้ง</th>";
        print"  <th bgcolor=#0099CC>แผนก</th>";
        print"  <th bgcolor=#0099CC>หัวข้อ</th>";
        print"  <th bgcolor=#0099CC>วันเวลาที่ร้องขอ</th>";
		print"  <th bgcolor=#0099CC>ผู้รับผิดชอบ</th>";
		print"  <th bgcolor=#0099CC>การดำเนิการ</th>";
		print"  <th bgcolor=#0099CC>วันเวลาที่ดำเนินการ</th>";
		print"  <th bgcolor=#0099CC>พิมพ์</th>";
      
        print" </tr>";
        while (list ($row,$depart,$head,$datetime,$programmer,$date,$p_edit,$dateend) = mysql_fetch_row ($result)) {
            print (" <tr>\n".
                "  <td BGCOLOR=#66CCFF  align='center'>$row</td>\n".
                "  <td BGCOLOR=#66CCFF>$depart</td>\n".
                "  <td BGCOLOR=#66CCFF><a target=_TOP href=\"comdetail.php? row=$row\">$head</a></td>\n".
                "  <td BGCOLOR=#66CCFF>$date</td>\n".
				"  <td BGCOLOR=#66CCFF>$programmer</td>\n".
				"  <td BGCOLOR=#66CCFF>$p_edit</td>\n".
				"  <td BGCOLOR=#66CCFF>$dateend</td>\n".
				"  <td BGCOLOR=#66CCFF><a target='_blank' href=\"com_form.php?row=$row\">พิมพ์</a></td>\n".
                " </tr>\n");
  				}
        print "</table>";
			}
 include("unconnect.inc");  
?>