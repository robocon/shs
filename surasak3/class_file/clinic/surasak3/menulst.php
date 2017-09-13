<?php
    session_start();
    $sOfficer="";
	$smenucode = "";
	$sRowid="";
    session_register("sOfficer");
	session_register("smenucode");
	session_register("sRowid");
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
		$sRowid=$row->row_id;
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

	if(isset($_POST["search"]) && trim($_POST["search"]) <> ""){
		$xxx = explode(" ",$_POST["search"]);
		//$search_where_arr = array();
		//foreach($){
		//	$search_where .= " menu ";
		//}

		$yyy = implode("%' AND menu like '%",$xxx);
		$where_search = " AND (menu like '%".$yyy."%')";
		//echo $yyy;
	//}
}

	/*//echo "<script>alert('ทดสอบ') </script>";*/
 //print (" <tr>\n".
 // "  <td BGCOLOR='#008400'><font face='THSarabunPSK' size='3' color='#FFFFFF' >   $sOfficer </font></td>\n".
			//	" </tr>\n");
         print "<body bgcolor='#008080' text='#00FFFF' link='#FFFFFF' vlink='#FFFFFF' alink='#FFFFFF'>";
         print "<table>";
		
         print "<tr>";
         print "<th bgcolor=#005555><font face='THSarabunPSK' size='4'>เมนู</th>";
         print "</tr>";
if($menucode=='ADM' ){
	$sort = "ORDER BY menu ASC";
}elseif($menucode=='ADMPHA' ){
	$sort = "ORDER BY menu_sort2 ASC ,menu ASC";
}else{
	$sort = "ORDER BY menu_sort ASC ,menu ASC";
}

 		
				
		 print (" <tr>\n".
                "  <td BGCOLOR='#008400'><a target='_top' href=\"../sm3.php\"><font face='THSarabunPSK' size='4'  >::Logout($sOfficer)</font></a></td>\n".
				" </tr>\n");
					
		 
	  
 $query = "SELECT menu,script,target FROM menulst WHERE menucode like '$menucode%' AND status='Y' ".$where_search." ".$sort;
 $result = mysql_query($query) or die("Query failed");

        while (list ($menu,$script,$target) = mysql_fetch_row ($result)) {
               print (" <tr>\n".
                  "  <td BGCOLOR='#008484'><a target='$target' href=\"$script?\"><font face='THSarabunPSK' size='4'  COLOR='#ffffff'>$menu</font></a></td>\n".
                  " </tr>\n");

}
 //สารบัญทั่วไป ทุกคนดูได้
      
		 print (" <tr>\n".
                "  <td BGCOLOR='#008400'><a target='_top' href=\"../sm3.php\"><font face='THSarabunPSK' size='4' >::Logout- ออกจากระบบ</font></a></td>\n".
                " </tr>\n");
   

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
	   session_unregister("sRowid");
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
