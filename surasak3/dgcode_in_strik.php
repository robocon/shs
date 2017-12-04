<?php
    echo "<CENTER>รหัสยาเวชภัณฑ์</CENTER><BR>";
?>

<FORM METHOD=GET ACTION="">
	<INPUT TYPE="text" NAME="dgcode" value="<?php echo $_GET["ENGERI"];?>">&nbsp;&nbsp;<INPUT TYPE="submit" value="ค้นหา">
</FORM>

<table align="center" width="90%">
 <tr>
  <th bgcolor="#CC9900" width="150"><font face='MS Sans Serif'>รหัส</th>
  <th bgcolor="#CC9900"><font face='MS Sans Serif'>ชื่อการค้า</th>
<!--   <th bgcolor="#CC9900"><font face='MS Sans Serif'>ทุน</th>
  <th bgcolor="#CC9900"><font face='MS Sans Serif'>ขาย</th>
  <th bgcolor="#CC9900"><font face='MS Sans Serif'>กำไร(%)</th>
  <th bgcolor="#CC9900"><font face='MS Sans Serif'>เบิกได้?</th> -->
 </tr>
<?php
    include("connect.inc");

	if($_GET["dgcode"] != ""){
		$Where = " Where drugcode like '%".$_GET["dgcode"]."%' OR tradname like '%".$_GET["dgcode"]."%' AND drugcode <> '' "; 
	}else{
		$Where = " Where drugcode <> '' "; 
	}
	
	if(isset($_GET["edit"])){
		
		$link = "&edit=true&id=".$_GET["id"];

	}


    $query = "SELECT drugcode,tradname,unitpri,salepri,part FROM druglst $Where ORDER BY drugcode ASC";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($drugcode, $tradname,$unitpri,$salepri,$part) = mysql_fetch_row ($result)) {
        if ($unitpri <>0 and $salepri <> 0 ){
            $profit=($salepri - $unitpri)*100/$unitpri;
            $profit=number_format($profit,1);
		}
        else {
	$xUnitpri =0;
	$xSalepri=0;
	$profit=0;
	}
        print (" <tr>\n".
           "  <td BGCOLOR=99CCFF><font face='MS Sans Serif'>&nbsp;&nbsp;<a target='left'  href=\"".$_GET["page"].".php?dcode=$drugcode$link\">$drugcode</a></td>\n".
           "  <td BGCOLOR=99CCFF><font face='MS Sans Serif'>&nbsp;&nbsp;$tradname</td>\n".
           //"  <td BGCOLOR=99CCFF align=\"right\"><font face='MS Sans Serif'>$unitpri&nbsp;&nbsp;</td>\n".
           //"  <td BGCOLOR=99CCFF align=\"right\"><font face='MS Sans Serif'>$salepri&nbsp;&nbsp;</td>\n".
           //"  <td BGCOLOR=99CCFF align=\"right\"><font face='MS Sans Serif'>$profit&nbsp;&nbsp;</td>\n".
           //"  <td BGCOLOR=99CCFF><font face='MS Sans Serif'>$part</td>\n".
           " </tr>\n");
         }
    include("unconnect.inc");
?>
</table>

