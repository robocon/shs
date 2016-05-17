<?php
session_start();
include("connect.inc");

$sOfficer = $_SESSION['sOfficer'];
$smenucode = $_SESSION['smenucode'];
$sRowid = $_SESSION['sRowid'];
$sLevel = $_SESSION['sLevel'];
$sIdname = $_SESSION['sIdname'];
$sPword = $_SESSION['sPword'];

$query = "SELECT * FROM inputm WHERE idname = '$sIdname' and pword='$sPword' and status ='Y' ";
$result = mysql_query($query) or die( mysql_error($Conn) );
for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	if (!mysql_data_seek($result, $i)) {
		echo "Cannot seek to row $i\n";
		continue;
	}

	if(!($row = mysql_fetch_object($result)))
		continue;
}

if(mysql_num_rows($result)){
	$sOfficer=$row->name;
	$menucode=$row->menucode;
	$_SESSION["smenucode"]=$row->menucode;
	$sRowid=$row->row_id;
	$sLevel=$row->level;
	$where_search= "";
//if($_SESSION["smenucode"] == "ADM"){
///////แบบสอบถาม//////
/*$query3 = "SELECT * FROM tb_assess WHERE row_id = '$sRowid' ";
$result3 = mysql_query($query3) or die("Query failed");
$nrow3 = mysql_num_rows($result3);
if($nrow3==0){
	?>
	<script>
    window.open("assess/question_com.php",null,'height=550,width=850,scrollbars=1');
    </script>
	<?
}*/
////////////////////////////////
	echo "
	<FORM METHOD=POST ACTION=\"\">
		<INPUT TYPE=\"text\" NAME=\"search\" size=\"10\">&nbsp;<INPUT TYPE=\"submit\" value=\"ค้นหา\">
	</FORM>
	";
	
	if (isset ( $_POST ["search"] ) && trim ( $_POST ["search"] ) != "") {
		$xxx = explode ( " ", $_POST ["search"] );
		// $search_where_arr = array();
		// foreach($){
		// $search_where .= " menu ";
		// }
		
		$yyy = implode ( "%' AND menu like '%", $xxx );
		$where_search = " AND (menu like '%" . $yyy . "%')";
		// echo $yyy;
		// }
	}
	
	/* //echo "<script>alert('ทดสอบ') </script>"; */
	// print (" <tr>\n".
	// " <td BGCOLOR='#008400'><font face='THSarabunPSK' size='3' color='#FFFFFF' > $sOfficer </font></td>\n".
	// " </tr>\n");
	print "<body bgcolor='#008080' text='#00FFFF' link='#FFFFFF' vlink='#FFFFFF' alink='#FFFFFF'>";
	print "<table>";
	
	print "<tr>";
	print "<th bgcolor=#005555><font face='THSarabunPSK' size='4'>เมนู</th>";
	print "</tr>";
	if ($menucode == 'ADM') {
		$sort = "ORDER BY menu ASC";
	} elseif ($menucode == 'ADMPHA') {
		$sort = "ORDER BY menu_sort2 ASC ,menu ASC";
	} else {
		$sort = "ORDER BY menu_sort ASC ,menu ASC";
	}
	
	if ($menucode == "ADM") {
		print (" <tr>\n" . "  <td BGCOLOR='#008400'><a target='_top' href=\"../sm3.php\"><font face='THSarabunPSK' size='4'  >::ออกจากระบบ($sOfficer)</font></a></td>\n" . " </tr>\n") ;
		
		print (" <tr>\n" . "  <td BGCOLOR='#008400'><a target='_top' href=\"com_support.php\"><font face='THSarabunPSK' size='3' >::แจ้งแก้ไข/ปรับปรุงโปรแกรม</font></a></td>\n" . " </tr>\n") ;
		
		print (" <tr>\n" . "  <td BGCOLOR='#008400'><a target='_top' href=\"showcomservice.php\"><font face='THSarabunPSK' size='3' >::บันทึกการปฏิบัติงาน</font></a></td>\n" . " </tr>\n") ;
		
		print (" <tr>\n" . "  <td BGCOLOR='#008400'><a target='_blank' href=\"showuser.php?menucode=$menucode\"><font face='THSarabunPSK' size='3' >::จัดการข้อมูลผู้ใช้งาน</font></a></td>\n" . " </tr>\n") ;
		
		print (" <tr>\n" . "  <td BGCOLOR='#008484'><a target='_top' href=\"document_list.php\"><font face='THSarabunPSK' size='3' >::Edocument- จัดเก็บเอกสาร</font></a></td>\n" . " </tr>\n") ;
		print (" <tr>\n" . "  <td BGCOLOR='#008484'><a target='_top' href=\"km_index.php?act=view\"><font face='THSarabunPSK' size='3' >::KM- Knowledge base</font></a></td>\n" . " </tr>\n") ;
	} else if ($sLevel == "admin") {
		print (" <tr>\n" . "  <td BGCOLOR='#008400'><a target='_top' href=\"../sm3.php\"><font face='THSarabunPSK' size='4'  >::ออกจากระบบ($sOfficer)</font></a></td>\n" . " </tr>\n") ;
		
		print (" <tr>\n" . "  <td BGCOLOR='#008400'><a target='_top' href=\"com_support.php\"><font face='THSarabunPSK' size='3' >::แจ้งแก้ไข/ปรับปรุงโปรแกรม</font></a></td>\n" . " </tr>\n") ;
		
		print (" <tr>\n" . "  <td BGCOLOR='#008400'><a target='_blank' href=\"showuser.php?menucode=$menucode\"><font face='THSarabunPSK' size='3' >::จัดการข้อมูลผู้ใช้งาน</font></a></td>\n" . " </tr>\n") ;
		
		print (" <tr>\n" . "  <td BGCOLOR='#008484'><a target='_top' href=\"document_list.php\"><font face='THSarabunPSK' size='3' >::Edocument- จัดเก็บเอกสาร</font></a></td>\n" . " </tr>\n") ;
		print (" <tr>\n" . "  <td BGCOLOR='#008484'><a target='_top' href=\"km_index.php?act=view\"><font face='THSarabunPSK' size='3' >::KM- Knowledge base</font></a></td>\n" . " </tr>\n") ;
	} else {
		print (" <tr>\n" . "  <td BGCOLOR='#008400'><a target='_top' href=\"../sm3.php\"><font face='THSarabunPSK' size='4'  >::ออกจากระบบ($sOfficer)</font></a></td>\n" . " </tr>\n") ;
		
		print (" <tr>\n" . "  <td BGCOLOR='#008400'><a target='_top' href=\"com_support.php\"><font face='THSarabunPSK' size='3' >::แจ้งแก้ไข/ปรับปรุงโปรแกรม</font></a></td>\n" . " </tr>\n") ;
		
		print (" <tr>\n" . "  <td BGCOLOR='#008484'><a target='_top' href=\"document_list.php\"><font face='THSarabunPSK' size='3' >::Edocument- จัดเก็บเอกสาร</font></a></td>\n" . " </tr>\n") ;
		print (" <tr>\n" . "  <td BGCOLOR='#008484'><a target='_top' href=\"km_index.php?act=view\"><font face='THSarabunPSK' size='3' >::KM- Knowledge base</font></a></td>\n" . " </tr>\n") ;
	}
	
	if ($menucode == 'ADMCT' || $menucode == 'ADMFINANCE') {
		$query = "SELECT menu,script,target FROM menulst WHERE menucode LIKE '$menucode%' AND status='Y'  " . $sort;
		$result = mysql_query ( $query ) or die ( mysql_error ( $Conn ) );
		
		while ( list ( $menu, $script, $target ) = mysql_fetch_row ( $result ) ) {
			print (" <tr>\n" . "  <td BGCOLOR='#005555'><a target='$target' href=\"$script?\"><font face='THSarabunPSK' size='4'>$menu</font></a></td>\n" . " </tr>\n") ;
		}
		;
	} elseif ($sOfficer == 'ภูภูมิ วุฒิธาดา (ว.33906)') {
		$query = "SELECT menu,script,target FROM menulst WHERE menucode = 'ADMDR1' OR  menucode = 'ADMXR' AND status='Y' " . $where_search . " " . $sort;
		$result = mysql_query ( $query ) or die ( mysql_error ( $Conn ) );
		
		while ( list ( $menu, $script, $target ) = mysql_fetch_row ( $result ) ) {
			print (" <tr>\n" . "  <td BGCOLOR='#005555'><a target='$target' href=\"$script?\"><font face='THSarabunPSK' size='4'>$menu</font></a></td>\n" . " </tr>\n") ;
		}
	} elseif ($sOfficer == 'วริทธิ์ พสุธาดล (ว.38228)') {
		$query = "SELECT menu,script,target FROM menulst WHERE menucode = 'ADMDR1' OR  menucode = 'ADMXR' AND status='Y' " . $where_search . " " . $sort;
		$result = mysql_query ( $query ) or die ( mysql_error ( $Conn ) );
		
		while ( list ( $menu, $script, $target ) = mysql_fetch_row ( $result ) ) {
			print (" <tr>\n" . "  <td BGCOLOR='#005555'><a target='$target' href=\"$script?\"><font face='THSarabunPSK' size='4'>$menu</font></a></td>\n" . " </tr>\n") ;
		}
	} elseif ($sOfficer == 'ธนบดินทร์ ผลศรีนาค (ว.19921)') {
		$query = "SELECT menu,script,target FROM menulst WHERE menucode = 'ADMDR1' OR  menucode = 'ADM19921' AND status='Y' " . $where_search . " " . $sort;
		$result = mysql_query ( $query ) or die ( mysql_error ( $Conn ) );
		
		while ( list ( $menu, $script, $target ) = mysql_fetch_row ( $result ) ) {
			print (" <tr>\n" . "  <td BGCOLOR='#005555'><a target='$target' href=\"$script?\"><font face='THSarabunPSK' size='4'>$menu</font></a></td>\n" . " </tr>\n") ;
		}
	} else {
		
		$sql2 = "select * from menu_user WHERE member_code='" . $sRowid . "'";
		$result2 = mysql_query ( $sql2 ) or die ( mysql_error ( $Conn ) );
		$rows = mysql_num_rows ( $result2 );
		
		if ($rows) { // / ถ้ามี rows
			
			$query = "SELECT menu,link ,sort,target FROM menu_user WHERE member_code='" . $sRowid . "' and sort !=0 ORDER BY `sort` ASC"; // ถ้าเป็น 0 ไม่แสดง
			$result = mysql_query ( $query ) or die ( mysql_error ( $Conn ) );
			
			while ( list ( $menu, $link, $sort, $target ) = mysql_fetch_row ( $result ) ) {
				print (" <tr>\n" . "  <td BGCOLOR='#008484'><a target='$target' href=\"$link?\"><font face='THSarabunPSK' size='4'>$menu</font></a></td>\n" . " </tr>\n") ;
			}
		} else {
			
			$query = "SELECT menu,script,target FROM menulst WHERE menucode like '$menucode%' AND status='Y' " . $where_search . " " . $sort;
			$result = mysql_query ( $query ) or die ( mysql_error ( $Conn ) );
			
			while ( list ( $menu, $script, $target ) = mysql_fetch_row ( $result ) ) {
				print (" <tr>\n" . "  <td BGCOLOR='#008484'><a target='$target' href=\"$script?\"><font face='THSarabunPSK' size='4'  COLOR='#ffffff'>$menu</font></a></td>\n" . " </tr>\n") ;
			}
		} // / ปิด if rows
	}
	// สารบัญทั่วไป ทุกคนดูได้
	$query = "SELECT menu,script,target FROM menulst WHERE status='Y' and menucode = 'ALL' ORDER BY menu_sort ASC ";
	$result = mysql_query ( $query ) or die ( mysql_error ( $Conn ) );
	
	while ( list ( $menu, $script, $target ) = mysql_fetch_row ( $result ) ) {
		print (" <tr>\n" . "  <td BGCOLOR='#008484'><a target='$target' href=\"$script?\"><font face='THSarabunPSK' size='3' >$menu</font></a></td>\n" . " </tr>\n") ;
	}
	;
	print (" <tr>\n" . "  <td BGCOLOR='#008400'><a target='_top' href=\"../sm3.php\"><font face='THSarabunPSK' size='4' >::Logout- ออกจากระบบ</font></a></td>\n" . " </tr>\n") ;
	include ("unconnect.inc");
	
	print "</table>";
	print "</body>";
} else {
	print "<body bgcolor='#669999' text='#00FFFF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>";
	print "...<br>";
	print "...<br>";
	print "...<br>";
	print "...<br>";
	print "<font face='THSarabunPSK' size='5'>...ไม่ผ่าน !... <a href='login.php' >เข้าระบบใหม่</a></font>";
	print "</body>";
	session_unregister ( "sIdname" );
	session_unregister ( "sPword" );
	session_unregister ( "sOfficer" );
	session_unregister ( "sRowid" );
	session_unregister ( "sLevel" );
}
?>
<style type="text/css" media="screen">
@font-face {
    font-family: 'THSarabunPSK';
    src: url('THSarabun.eot');
    src: url('THSarabun.eot?#iefix') format('embedded-opentype'),
         url('THSarabun.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;
}
</style>
