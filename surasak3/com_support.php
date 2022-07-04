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
if($_SESSION["smenucode"]=="ADM" || $_SESSION["smenucode"]=="ADMCOM"){
print "<a target=_self  href='../nindex.htm' class='forntsarabun'>กลับหน้าเมนูหลัก</a>&nbsp;&nbsp;||&nbsp;&nbsp;<a  href='com_add.php'><font size='4' class='forntsarabun'>แจ้งซ่อม/ปรับปรุงโปรแกรม</font></a>&nbsp;&nbsp;||&nbsp;&nbsp;<a target=_self  href='com_month.php'><font size='4' class='forntsarabun'>รายงานประจำเดือน</font></a>&nbsp;&nbsp;||&nbsp;&nbsp;<a target=_blank  href='report_comsupport.php'><font size='4' class='forntsarabun'>รายงานผลการทำงาน</font></a>&nbsp;&nbsp;||&nbsp;&nbsp;<a target=_blank  href='ot_programmer.php'><font size='4' class='forntsarabun'>OT Programmer</font></a>";
}else{
print "<a target=_self  href='../nindex.htm' class='forntsarabun'>กลับหน้าเมนูหลัก</a>&nbsp;&nbsp;||&nbsp;&nbsp;<a  href='com_add.php'><font size='4' class='forntsarabun'>แจ้งซ่อม/ปรับปรุงโปรแกรม</font></a>&nbsp;&nbsp;||&nbsp;&nbsp;<a target=_self  href='com_month.php'><font size='4' class='forntsarabun'>รายงานประจำเดือน</font></a>&nbsp;&nbsp;||&nbsp;&nbsp;<a target=_blank  href='report_comsupport.php'><font size='4' class='forntsarabun'>รายงานผลการทำงาน</font></a>";	
}	
print "<hr>";

if($_SESSION['supportMessage'])
{
    ?><div style="border: 2px solid #bdbd00;background-color: #fdfd8c;padding: 4px;text-align:center;"><?=$_SESSION['supportMessage'];?></div><?php
    $_SESSION['supportMessage'] = NULL;
}

print"<br><div align='center' class='forntsarabun'><strong>ระบบบันทึกการแจ้งซ่อมอุปกรณ์คอมพิวเตอร์ และพัฒนาปรับปรุงโปรแกรมในระบบโรงพยาบาล<BR>ศูนย์บริการคอมพิวเตอร์ โรงพยาบาลค่ายสุรศักดิ์มนตรี</strong></div><BR>";
    print"<div align='center'><font class='forntsarabun'>ยินดีต้อนรับ คุณ <strong>$sOfficer</strong> เข้าสู่ระบบ</font></div>";
    echo "<div align='center'><font size='1' class='forntsarabun'><b>เจ้าหน้าที่โปรแกรมเมอร์....</b>ส.อ. เทวิน  ศรีแก้ว นายกฤษณะศักดิ์  กันธรส และนายชาญวิทย์  ตากาบุตร<b>....โทร. 8500</b></font></div>";
	echo "<div align='center'><font size='1' class='forntsarabun'><b>เจ้าหน้าที่ช่างคอมพิวเตอร์....</b>นายจักรพันธ์  รุ่งเรืองศรี และนายฐานพัฒน์  นิลคำ<b>....โทร. 6203</b></font></div><br>";
$Thaidate=date("d-m-").(date("Y")+543);
$n =0;
$num = "Y";

// งานค้างที่ยังไม่ได้รับผิดชอบ
/*if($_SESSION["smenucode"]=="ADM" || $_SESSION["smenucode"]=="ADMCOM"){
	$query = "SELECT row,depart,head,datetime,programmer,date,user1 
FROM com_support 
WHERE status ='$num'
ORDER BY row desc";
}else{*/
	$query = "SELECT row,jobtype,depart,head,datetime,programmer,date,user1 
FROM com_support 
WHERE status ='$num' and date >= '2565-01-01 00:00:00'
ORDER BY row desc";
//}
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
    while (list ($row,$jobtype,$depart,$head,$datetime,$programmer,$date,$user1) = mysql_fetch_row ($result)) {
        $n++;

        $programmer = ( !empty($programmer) ) ? $programmer : 'รอการตอบรับ' ;

        if($_SESSION['smenucode']=='ADM' || $_SESSION['smenucode']=='ADMCOM'){
            $where="<a target=_TOP href=\"com_edit.php?row=$row\">$programmer</a>";
        } else {
            $where="$programmer";
        }
		
		$color="#F1948A";

	
        print (" <tr>\n".
        "  <td BGCOLOR=$color align='center'>$row</td>\n".
		"  <td BGCOLOR=$color>$depart</td>\n".
        "  <td BGCOLOR=$color><a target=_TOP href=\"comdetail.php? row=$row\">$head</a></td>\n".
        "  <td BGCOLOR=$color>$user1</td>\n".
        "  <td BGCOLOR=$color>$date</td>\n".
        "  <td BGCOLOR=$color>$where</td>\n".
        "  <td BGCOLOR=$color><a target='_blank' href=\"com_form.php?row=$row\">พิมพ์</a></td>\n".
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
        if($_SESSION['smenucode']=='ADM' OR $_SESSION['smenucode']=='ADMCOM'){
            print"  <th bgcolor=#FFCC00>เพิ่มรายละเอียด</th>";
        }
      
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
				  "  <td BGCOLOR=#FFFF99><a target='_blank' href=\"com_form.php?row=$row\">พิมพ์</a></td>\n");
				 // "  <td BGCOLOR=#FFFF99 align='center'>$add</td>\n".

            if($_SESSION['smenucode']=='ADM' OR $_SESSION['smenucode']=='ADMCOM'){
                print"  <td bgcolor=#FFFF99 align=\"center\"><a href=\"com_support_detail.php?id=$row\" target=\"_blank\">เพิ่ม</a></td>";
            }

            print " </tr>\n";
  						    }
        print"</table>";
			}
 include("unconnect.inc");  

echo "<hr />";
?>
<?php
 $Thaidate=date("d-m-").(date("Y")+543);
 
 $year=(date("Y")+543);

$num = n;
include("connect.inc");
$query = "SELECT row,depart,head,datetime,programmer,date,p_edit,dateend 
FROM com_support 
WHERE status ='$num' and date like '$year%'
ORDER BY dateend desc ";
$result_all = mysql_query($query) or die("Query failed111");
$all_rows = mysql_num_rows($result_all);

$limit = '1000';

$page = (empty($_GET['page'])) ? '0' : $_GET['page'] - 1 ;

$page_start = $page * $limit;

$total_pages = $all_rows / $limit;
$total_pages = (int) ceil($total_pages);

$query .= " LIMIT $page_start, $limit";
$result = mysql_query($query) or die("Query failed111");

   if($num3=mysql_num_rows($result)){
	    print"<div align='center' class='forntsarabun' id='work_done'><strong>งานที่ดำเนินการเสร็จแล้ว จำนวน $num3 รายการ</strong></div>";
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

        ?>
        <style>
            .chk_table{
                border-collapse: collapse;
            }
            .chk_table th{background-color: #ddd6ce;}
            .chk_table th,
            .chk_table td{
                padding: 4px 0;
                /* border: 1px solid black; */
                
            }
            .chk_table td a {
                padding: 0 6px;
                color: #000;
            }
        </style>
        <table class="chk_table">
            <tr>
                <td><a href="com_support.php?page=1#work_done">&lt;&lt;</a></td>
                <td>
                    <?php 
                    for ($i=1; $i <= $total_pages; $i++) { 
                        $bg_style = ($i==$_GET['page']) ? 'style="background-color: #bbb"' : '' ;
                        ?>
                        <td><a href="com_support.php?page=<?=$i;?>#work_done" <?=$bg_style;?> ><?=$i;?></a></td>
                        <?php 
                    }
                    ?>
                </td>
                <td><a href="com_support.php?page=<?=$total_pages;?>#work_done">&gt;&gt;</a></td>
            </tr>
        </table>
        <?php

        }
 include("unconnect.inc");  
?>