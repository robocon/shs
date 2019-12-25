<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<?php

    print "รายการหัตถการห้อง LAB &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><< ไปเมนู</a>&nbsp;&nbsp;&nbsp;<a target=_self  href='lab_add.php'>เพิ่มข้อมูลรายการ LAB</a><br><br>";
    include("connect.inc");
	print "<form name='f1' method='post' action=''>";
	 print "<table>";
    print "<tr>";
	print "<td>";
	print "สถานะ";
	print "</td>";
	print "<td>";
	
	print "<select name='status'>";
	print "<option value=''>แสดงทั้งหมด</option> ";
	print "<option value='Y'>Y (เปิดการใช้งาน)</option> ";
	print "<option value='N'>N (ปิดการใช้งาน)</option> ";
	print "<option value='C'>เฉพาะ Chkup</option> ";
	print "</select>";
	print "<input type='submit' name='b1' value='ตกลง'>";
	
	print "</td>";
	print "</tr>";
	print "</table>";
	print "</form>";
	
if($_POST['status']=="Y"){
	$where="AND labstatus='Y' ";	
	$show="Y (เปิดการใช้งาน)";
}else if($_POST['status']=="N"){
	$where="AND labstatus='N' ";	
	$show="N (ปิดการใช้งาน)";
}else if($_POST['status']=="C"){
	$where="AND chkup<>'' ";
	$show="เฉพาะ Chkup";	
}else{
	$where='';
	$show="ทั้งหมด";	
}

    //$query = "SELECT  row_id,code,codex,detail,price,yprice,nprice,lablis,codex,depart,codelab,outlab_name,labpart,labtype,labstatus,chkup,reportlabno FROM labcare WHERE depart like '%patho%' and code not like '%@%' ".$where."  order by row_id desc ";
	//echo $query;
    $query = "SELECT  row_id,code,codex,detail,price,yprice,nprice,lablis,codex,depart,codelab,outlab_name,labpart,labtype,labstatus,chkup,reportlabno FROM labcare WHERE depart like '%patho%' ".$where."  order by row_id desc ";
	
    $result = mysql_query($query) or die("Query failed");
	$num = mysql_num_rows($result);
	
	echo "<div>ข้อมูล $show จำนวน $num รายการ</div>";	
    print "<table>";
    print "<tr>";
    print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>รหัสคิดเงิน</b></th>";
	print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>รหัสกรมบัญชีกลาง</b></th>";
	print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>รหัส Sticker</b></th>";
    print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>รายการ</b></th>";
    print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>แผนก</b></th>";
	print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>ราคาเต็ม</b></th>";
 	print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>ราคาเบิกได้</b></th>";
 	print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>ราคาเบิกไม่ได้</b></th>";
 	print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>code LAB</b></th>";
	print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>chkup</b></th>";
	print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>report Labno.</b></th>";
	print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>Part</b></th>";
	print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>บริษัท</b></th>";
	print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>ประเภท</b></th>";
	print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>สถานะ</b></th>";
    print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>แก้ไข</b></th>";
 // print "<th bgcolor=CD853F><font face='TH SarabunPSK'><b>........</b></th>";
//    print " <th bgcolor=CD853F><font face='TH SarabunPSK'><b>ลบรายการ</b></th>";
    print "</tr>";
	
    while (list ($rowid,$code,$codex,$detail,$price,$yprice,$nprice,$lablis,$codex,$depart,$codelab,$outlab_name,$labpart,$labtype,$labstatus,$chkup,$reportlabno) = mysql_fetch_row ($result)) {

		if($price<=1){$color='#FF6699';}else{$color='F5DEB3';};
        print ("<tr>\n".
           "  <td BGCOLOR=$color><font face='TH SarabunPSK'>$code</td>\n".
		    "  <td BGCOLOR=$color><font face='TH SarabunPSK'>$codex</td>\n".
			"  <td BGCOLOR=$color><font face='TH SarabunPSK'>$codelab</td>\n".
           "  <td BGCOLOR=$color><font face='TH SarabunPSK'><B>$detail</B></td>\n".
		   "  <td BGCOLOR=$color><font face='TH SarabunPSK'>$depart</td>\n".
           "  <td BGCOLOR=$color><font face='TH SarabunPSK'><B><a target=_BLANK href=\"labedit.php? code=$code\">$price</B></a></td>\n".
  		   "  <td BGCOLOR=$color><font face='TH SarabunPSK'>$yprice</td>\n".
      	   "  <td BGCOLOR=$color><font face='TH SarabunPSK'>$nprice</td>\n".
		 /*  "  <td BGCOLOR=$color><font face='TH SarabunPSK'>$lablis</td>\n".*/
		"  <td BGCOLOR=$color><font face='TH SarabunPSK'>$codelab</td>\n".
					"  <td BGCOLOR=$color><font face='TH SarabunPSK'>$chkup</td>\n".
					"  <td BGCOLOR=$color><font face='TH SarabunPSK'>$reportlabno</td>\n".
		   "  <td BGCOLOR=$color><font face='TH SarabunPSK'>$labpart</td>\n".
		   "  <td BGCOLOR=$color><font face='TH SarabunPSK'>$outlab_name</td>\n".
		   "  <td BGCOLOR=$color><font face='TH SarabunPSK'>$labtype</td>\n".
		  "  <td BGCOLOR=$color><font face='TH SarabunPSK'>$labstatus</td>\n".
		 "  <td BGCOLOR=$color><font face='TH SarabunPSK'><a href='labcareeditrow.php?rowid=$rowid' target=blank>แก้ไข</a></td>\n".
       
     //   "  <td BGCOLOR=F5DEB3><font face='TH SarabunPSK'></td>\n".
  //   "  <td bgcolor=F5DEB3><font face='TH SarabunPSK'><a target=_BLANK href=\"lebdele.php? code=$code\">ลบ</td>\n".
           " </tr>\n");
        }
    print "</table>";

    include("unconnect.inc");
?>

