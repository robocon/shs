<?php
    include 'bootstrap.php';
    DB::load();
    
//     var_dump($_SESSION);
    
    $sOfficer = isset($_SESSION['sOfficer']) ? $_SESSION['sOfficer'] : false ;
	$smenucode = isset($_SESSION['smenucode']) ? $_SESSION['smenucode'] : false ;
	$sRowid = isset($_SESSION['sRowid']) ? $_SESSION['sRowid'] : false ;
	$sLevel = isset($_SESSION['sLevel']) ? $_SESSION['sLevel'] : false ;
	$sIdname = isset($_SESSION['sIdname']) ? $_SESSION['sIdname'] : false ;
	$sPword = isset($_SESSION['sPword']) ? $_SESSION['sPword'] : false ;
    
    
//     $query = "SELECT * FROM inputm WHERE idname = '$sIdname' and pword='$sPword' and status ='Y' ";
    
    $sql = "SELECT * FROM `inputm` WHERE `idname` = :username AND `pword` = :password AND `status` = 'y'";
    $item = DB::select($sql, array(':username' => $sIdname, ':password' => $sPword), true);
    
         
    if( DB::$rows > 0 ){
		$sOfficer = $item['name'];
		$menucode = $item['menucode'];
		$sRowid = $item['row_id'];
		$sLevel = $item['level'];
		$where_search= "";

///////แบบสอบถาม//////

////////////////////////////////
echo "
<FORM METHOD=POST ACTION=\"\">
	<INPUT TYPE=\"text\" NAME=\"search\" size=\"10\">&nbsp;<INPUT TYPE=\"submit\" value=\"ค้นหา\">
</FORM>
";
	
	if (isset ( $_POST ["search"] ) && trim ( $_POST ["search"] ) != "") {
		$xxx = explode ( " ", $_POST ["search"] );
		$yyy = implode ( "%' AND menu like '%", $xxx );
		$where_search = " AND (menu like '%" . $yyy . "%')";
	}
	
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
	
// 	$query = "SELECT menu,link ,sort,target FROM menu_user WHERE member_code='" . $sRowid . "' and sort !=0 ORDER BY `sort` ASC"; // ถ้าเป็น 0 ไม่แสดง
// 	$result = mysql_query ( $query ) or die ( mysql_error ( $Conn ) );
		
// 	while ( list ( $menu, $link, $sort, $target ) = mysql_fetch_row ( $result ) ) {
// 		print (" <tr>\n" . "  <td BGCOLOR='#008484'><a target='$target' href=\"$link?\"><font face='THSarabunPSK' size='4'>$menu</font></a></td>\n" . " </tr>\n") ;
// 	}

	if( isset($_POST['search']) ){
		$where = " AND `menu` LIKE '%".$_POST['search']."%' ";
	}

	$query = "SELECT `menu`,`link`,`sort`,`target`
			FROM `menu_user` 
			WHERE `sort` !=0 
			$where
			GROUP BY `link` 
			ORDER BY `sort` ASC";
	$items = DB::select($query, array(':userid' => $sRowid),false);
	foreach( $items as $key => $item ){
	?>
		<tr>
			<td><a target="<?php echo $item['target']?>" href="<?php echo $item['link']?>"><?php echo $item['menu'];?></a></td>
		</tr>
		<?php 
	}
	
	// สารบัญทั่วไป ทุกคนดูได้
	$query = "SELECT menu,script,target FROM menulst WHERE status='Y' and menucode = 'ALL' ORDER BY menu_sort ASC ";
// 	$result = mysql_query ( $query ) or die ( mysql_error ( $Conn ) );
	
	$items = DB::select($query);
	foreach( $items as $key => $item ){
		?>
		<tr>
			<td><a target="<?php echo $item['target']?>" href="<?php echo $item['script']?>"><?php echo $item['menu'];?></a></td>
		</tr>
		<?php 
	}
	
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
	
	unset($_SESSION['sIdname']);
	unset($_SESSION['sPword']);
	unset($_SESSION['sOfficer']);
	unset($_SESSION['sRowid']);
	unset($_SESSION['sLevel']);

}
?>
<style type="text/css" media="screen">
@font-face {
	font-family: THSarabunPSK;
	src: url("/sm3/surasak3/THSarabun.eot") /* EOT file for IE */
}

@font-face {
	font-family: THSarabunPSK;
	src: url("/sm3/surasak3/THSarabun.ttf") /* TTF file for CSS3 browsers */
}
</style>
