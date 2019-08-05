<?php
    session_start();
    $sOfficer="";
	$smenucode = "";
    session_register("sOfficer");
	session_register("smenucode");
//error_reporting (E_ALL ^ E_NOTICE);

    include("connect.inc");
//    print "$username<br>";
//    print "$password<br>";
    $query = "SELECT * FROM inputm WHERE idname = '$sIdname' and pword='$sPword' and status ='Y' ";
    $result = mysql_query($query) or die("Query failed");
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

$where_search= "";
if($_SESSION["smenucode"] == "ADM"){

echo "
<FORM METHOD=POST ACTION=\"\">
	<INPUT TYPE=\"text\" NAME=\"search\" size=\"5\">&nbsp;<INPUT TYPE=\"submit\" value=\"ค้นหา\">
</FORM>
";

	if(isset($_POST["search"]) && trim($_POST["search"]) <> ""){
		$xxx = explode(" ",$_POST["search"]);
		//$search_where_arr = array();
		//foreach($){
		//	$search_where .= " menu ";
		//}

		$yyy = implode("%' AND menu like '%",$xxx);
		$where_search = " AND (menu like '%".$yyy."%')";
		//echo $yyy;
	}
}
         print "<body bgcolor='#008080' text='#00FFFF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>";
         print "<table>";
         print "<tr>";
         print "<th bgcolor=6495ED><font face='THSarabunPSK' size='4'>สารบัญ</th>";
         print "</tr>";
if($menucode=='ADM' ){
	$sort = "ORDER BY menu ASC";
}else{
	$sort = "ORDER BY menu_sort ASC ,menu ASC";
}

 print (" <tr>\n".
                "  <td BGCOLOR='#009933'><a target='_top' href=\"../sm3.php\"><font face='THSarabunPSK' size='4' >::Logout- ออกจากระบบ</font></a></td>\n".
				" </tr>\n");
 print (" <tr>\n".
                "  <td BGCOLOR='#009933'><a target='_top' href=\"document_Search2.php\"><font face='THSarabunPSK' size='4' >::Edocument- จัดเก็บเอกสาร</font></a></td>\n".
				" </tr>\n");					 
					 
if($menucode=='ADMCT' || $menucode=='ADMFINANCE'){
 $query = "SELECT menu,script,target FROM menulst WHERE menucode LIKE '$menucode%' AND status='Y'  ".$sort;
        $result = mysql_query($query) or die("Query failed");

        while (list ($menu,$script,$target) = mysql_fetch_row ($result)) {
               print (" <tr>\n".
                  "  <td BGCOLOR='#669999'><a target='$target' href=\"$script?\"><font face='THSarabunPSK' size='4'>$menu</font></a></td>\n".
                  " </tr>\n");
                  };
} else{

 $query = "SELECT menu,script,target FROM menulst WHERE menucode LIKE '$menucode%' AND status='Y' ".$where_search." ".$sort;
 $result = mysql_query($query) or die("Query failed");

        while (list ($menu,$script,$target) = mysql_fetch_row ($result)) {
               print (" <tr>\n".
                  "  <td BGCOLOR='#669999'><a target='$target' href=\"$script?\"><font face='THSarabunPSK' size='4'>$menu</font></a></td>\n".
                  " </tr>\n");
                  }

}
 //สารบัญทั่วไป ทุกคนดูได้
        $query = "SELECT menu,script,target FROM menulst WHERE status='Y' and menucode = 'ALL' ";
        $result = mysql_query($query) or die("Query failed");

        while (list ($menu,$script,$target) = mysql_fetch_row ($result)) {
              print (" <tr>\n".
                "  <td BGCOLOR='#009933'><a target='$target' href=\"$script?\"><font face='THSarabunPSK' size='4' >$menu</font></a></td>\n".
                " </tr>\n");
                     };
		 print (" <tr>\n".
                "  <td BGCOLOR='#009933'><a target='_top' href=\"../sm3.php\"><font face='THSarabunPSK' size='4' >::Logout- ออกจากระบบ</font></a></td>\n".
                " </tr>\n");
        include("unconnect.inc");

        print "</table>";
        print "</body>";
                   }
   else {
        print "<body bgcolor='#669999' text='#00FFFF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>";
        print "...<br>";
        print "...<br>";
        print "...<br>";
        print "...<br>";
        print "<font face='THSarabunPSK' size='5'>...ไม่ผ่าน !... <a href='login.php' >เข้าระบบใหม่</a></font>";
        print "</body>";
       session_unregister("sIdname");
       session_unregister("sPword");
       session_unregister("sOfficer");
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
