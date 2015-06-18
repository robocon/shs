<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
-->
</style>
<?php
print "<a target=_self  href='../nindex.htm' class='forntsarabun'><------ ไปเมนู</a>&nbsp;&nbsp;<a target=_blank  href='com_add.php'><font size='4' class='forntsarabun'>บันทึกแจ้งงานใหม่</font></a>&nbsp;&nbsp;<a target=_self  href='com_month.php'><font size='4' class='forntsarabun'>รายงานประจำเดือน</font></a>&nbsp;&nbsp;<a target=_blank  href='report_comsupport.php'><font size='4' class='forntsarabun'>รายงานผลการทำงาน</font></a>";
print"<br><div align='center' class='forntsarabun'>ระบบบันทึกการขอแก้ไข/เพิ่มเติมโปรแกรมในระบบเครือข่าย<BR>โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง</div><BR>";
$Thaidate=date("d-m-").(date("Y")+543);
$n =0;
$num = Y;
session_start();
    include("connect.inc");
    $query = "SELECT  row,depart,head,datetime,programmer,date,user1 FROM com_support   WHERE status ='$num' ORDER BY row  ";
    $result = mysql_query($query)
        or die("Query failed111");

   if(mysql_num_rows($result)){
 print"<font class='forntsarabun'>$sOfficer</font><BR>";
       print"<div align='center' class='forntsarabun'>งานค้างที่ยังไม่ได้รับผิดชอบ</div>";
        print"<table class='forntsarabun'  align='center'>";
        print" <tr>";
		print"  <th bgcolor=CD853F>ลำดับ</th>";
        print"  <th bgcolor=CD853F>ลำดับแจ้ง</th>";
        print"  <th bgcolor=CD853F>แผนก</th>";
        print"  <th bgcolor=CD853F>หัวข้อ</th>";
		print"  <th bgcolor=CD853F>ผู้ที่ร้องขอ</th>";
        print"  <th bgcolor=CD853F>วันที่ร้องขอ</th>";
		print"  <th bgcolor=CD853F>ผู้รับผิดชอบ</th>";
		print"  <th bgcolor=CD853F>พิมพ์</th>";
      
        print" </tr>";
        while (list ($row,$depart,$head,$datetime,$programmer,$date,$user1) = mysql_fetch_row ($result)) {
$n++;
$head=substr($head,0,40);
if($_SESSION['smenucode']=='ADM'){$where="<a target=_TOP href=\"com_edit.php?row=$row\">$programmer</a>";} else {$where="$programmer";};
	
            print (" <tr>\n".
				  "  <td BGCOLOR=F5DEB3 align='center'>$n</td>\n".
                "  <td BGCOLOR=F5DEB3 align='center'>$row</td>\n".
                "  <td BGCOLOR=F5DEB3>$depart</td>\n".
                "  <td BGCOLOR=F5DEB3><a target=_TOP href=\"comdetail.php? row=$row\">$head</a></td>\n".
					          "  <td BGCOLOR=F5DEB3>$user1</td>\n".
                "  <td BGCOLOR=F5DEB3>$date</td>\n".
				  "  <td BGCOLOR=F5DEB3>$where</td>\n".
				  "  <td BGCOLOR=F5DEB3><a target='_blank' href=\"com_form.php?row=$row\">พิมพ์</a></td>\n".
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
    $query = "SELECT  row,depart,head,datetime,programmer,date,user FROM com_support   WHERE status ='$num' ORDER BY row  ";
    $result = mysql_query($query)
        or die("Query failed111");

   if(mysql_num_rows($result)){
        print"<div align='center' class='forntsarabun'>งานที่กำลังดำเนินการอยู่</div>";
        print"<table class='forntsarabun'  align='center'>";
        print" <tr>";
		        print"  <th bgcolor=#009900>ลำดับ</th>";
        print"  <th bgcolor=#009900>ลำดับแจ้ง</th>";
        print"  <th bgcolor=#009900>แผนก</th>";
        print"  <th bgcolor=#009900>หัวข้อ</th>";
        print"  <th bgcolor=#009900>วันที่ร้องขอ</th>";
		print"  <th bgcolor=#009900>ผู้รับผิดชอบ</th>";
		print"  <th bgcolor=#009900>พิมพ์</th>";
		print"  <th bgcolor=#009900>การทำงาน</th>";
      
        print" </tr>";
        while (list ($row,$depart,$head,$datetime,$programmer,$date,$user) = mysql_fetch_row ($result)) {
			$n++;
			$head=substr($head,0,40);
			if($_SESSION['smenucode']=='ADM'){$where="<a target=_TOP href=\"comsucces.php?row=$row\">$programmer</a>";} else {$where="$programmer";};
			if($_SESSION['smenucode']=='ADM'){$add="<a target='_blank' href=\"comservice.php?row=$row&act=win\">บันทึก</a>";} else {$add="บันทึก";};
			
            print (" <tr>\n".
				      "  <td BGCOLOR=#00FF99 align='center'>$n</td>\n".
                "  <td BGCOLOR=#00FF99 align='center'>$row</td>\n".
                "  <td BGCOLOR=#00FF99>$depart</td>\n".
                "  <td BGCOLOR=#00FF99><a target=_TOP href=\"comdetail.php? row=$row\">$head</a></td>\n".
                "  <td BGCOLOR=#00FF99>$date</td>\n".
				  "  <td BGCOLOR=#00FF99>$where</td>\n".
				  "  <td BGCOLOR=#00FF99><a target='_blank' href=\"com_form.php?row=$row\">พิมพ์</a></td>\n".
				  "  <td BGCOLOR=#00FF99 align='center'>$add</td>\n".
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
    $query = "SELECT  row,depart,head,datetime,programmer,date,p_edit,dateend FROM com_support   WHERE status ='$num' ORDER BY dateend desc  ";
    $result = mysql_query($query)
        or die("Query failed111");

   if(mysql_num_rows($result)){
	    print"<div align='center' class='forntsarabun'>งานที่ดำเนินการเสร็จแล้ว</div>";
        print"<table class='forntsarabun'  align='center'>";
        print" <tr>";
        print"  <th bgcolor=#0033FF>ลำดับแจ้ง</th>";
        print"  <th bgcolor=#0033FF>แผนก</th>";
        print"  <th bgcolor=#0033FF>หัวข้อ</th>";
        print"  <th bgcolor=#0033FF>วันเวลาที่ร้องขอ</th>";
		print"  <th bgcolor=#0033FF>ผู้รับผิดชอบ</th>";
		print"  <th bgcolor=#0033FF>การดำเนิการ</th>";
		print"  <th bgcolor=#0033FF>วันเวลาที่ดำเนินการ</th>";
		print"  <th bgcolor=#0033FF>พิมพ์</th>";
      
        print" </tr>";
        while (list ($row,$depart,$head,$datetime,$programmer,$date,$p_edit,$dateend) = mysql_fetch_row ($result)) {
			$head=substr($head,0,40);
            print (" <tr>\n".
                "  <td BGCOLOR=#00CCFF  align='center'>$row</td>\n".
                "  <td BGCOLOR=#00CCFF>$depart</td>\n".
                "  <td BGCOLOR=#00CCFF><a target=_TOP href=\"comdetail.php? row=$row\">$head</a></td>\n".
                "  <td BGCOLOR=#00CCFF>$date</td>\n".
				"  <td BGCOLOR=#00CCFF>$programmer</td>\n".
				"  <td BGCOLOR=#00CCFF>$p_edit</td>\n".
				"  <td BGCOLOR=#00CCFF>$dateend</td>\n".
				"  <td BGCOLOR=#00CCFF><a target='_blank' href=\"com_form.php?row=$row\">พิมพ์</a></td>\n".
                " </tr>\n");
  				}
        print "</table>";
			}
 include("unconnect.inc");  
?>
