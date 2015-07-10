<?php

    print "รายการหัถการห้อง LAB &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><< ไปเมนู</a><br><br>";
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
    print "<table>";
    print "<tr>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>CODE</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>รายการ</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>แผนก</b></th>";
	print "<th bgcolor=CD853F><font face='Angsana New'><b>ราคาเต็ม</b></th>";
 	print "<th bgcolor=CD853F><font face='Angsana New'><b>ราคาเบิกได้</b></th>";
 	print "<th bgcolor=CD853F><font face='Angsana New'><b>ราคาเบิกไม่ได้</b></th>";
 	print "<th bgcolor=CD853F><font face='Angsana New'><b>code LAB</b></th>";
	print "<th bgcolor=CD853F><font face='Angsana New'><b>chkup</b></th>";
	print "<th bgcolor=CD853F><font face='Angsana New'><b>report Labno.</b></th>";
	print "<th bgcolor=CD853F><font face='Angsana New'><b>Part</b></th>";
	print "<th bgcolor=CD853F><font face='Angsana New'><b>บริษัท</b></th>";
	print "<th bgcolor=CD853F><font face='Angsana New'><b>ประเภท</b></th>";
	print "<th bgcolor=CD853F><font face='Angsana New'><b>สถานะ</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>แก้ไข</b></th>";
 // print "<th bgcolor=CD853F><font face='Angsana New'><b>........</b></th>";
//    print " <th bgcolor=CD853F><font face='Angsana New'><b>ลบรายการ</b></th>";
    print "</tr>";


if($_POST['status']=="Y"){
	$where="AND labstatus='Y' ";	
}else if($_POST['status']=="N"){
	$where="AND labstatus='N' ";	
}else if($_POST['status']=="C"){
	$where="AND chkup<>'' ";	
}else{
	$where='';
}

    $query = "SELECT  row_id,code,detail,price,yprice,nprice,lablis,codex,depart,codelab,outlab_name,labpart,labtype,labstatus,chkup,reportlabno FROM labcare WHERE depart like '%patho%' and code not like '%@%' ".$where."  order by codex ";
    $result = mysql_query($query) or die("Query failed");
	
    while (list ($rowid,$code,$detail,$price,$yprice,$nprice,$lablis,$codex,$depart,$codelab,$outlab_name,$labpart,$labtype,$labstatus,$chkup,$reportlabno) = mysql_fetch_row ($result)) {

		if($price<=1){$color='#FF6699';}else{$color='F5DEB3';};
        print ("<tr>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'>$code</td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'><B>$detail</B></td>\n".
		   "  <td BGCOLOR=$color><font face='Angsana New'>$depart</td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'><B><a target=_BLANK href=\"labedit.php? code=$code\">$price</B></a></td>\n".
  		   "  <td BGCOLOR=$color><font face='Angsana New'>$yprice</td>\n".
      	   "  <td BGCOLOR=$color><font face='Angsana New'>$nprice</td>\n".
		 /*  "  <td BGCOLOR=$color><font face='Angsana New'>$lablis</td>\n".*/
		"  <td BGCOLOR=$color><font face='Angsana New'>$codelab</td>\n".
					"  <td BGCOLOR=$color><font face='Angsana New'>$chkup</td>\n".
					"  <td BGCOLOR=$color><font face='Angsana New'>$reportlabno</td>\n".
		   "  <td BGCOLOR=$color><font face='Angsana New'>$labpart</td>\n".
		   "  <td BGCOLOR=$color><font face='Angsana New'>$outlab_name</td>\n".
		   "  <td BGCOLOR=$color><font face='Angsana New'>$labtype</td>\n".
		  "  <td BGCOLOR=$color><font face='Angsana New'>$labstatus</td>\n".
		 "  <td BGCOLOR=$color><font face='Angsana New'><a href='labcareeditrow.php?rowid=$rowid' target=blank>แก้ไข</a></td>\n".
       
     //   "  <td BGCOLOR=F5DEB3><font face='Angsana New'></td>\n".
  //   "  <td bgcolor=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"lebdele.php? code=$code\">ลบ</td>\n".
           " </tr>\n");
        }
    print "</table>";

    include("unconnect.inc");
?>

