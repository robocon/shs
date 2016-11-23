<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตรวจสอบหมายเลข  AN</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; AN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="an" size="12" id="aLink" ></p>
<script type="text/javascript">
document.getElementById('aLink').focus();
</script>

  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="      ตกลง      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<ไปเมนู</a></p>
</form>

<table>
 <tr>
  <th bgcolor=CD853F>AN</th>
  <th bgcolor=CD853F>HN</th>
  <th bgcolor=CD853F>ชื่อ-สกุล</th>
  <th bgcolor=CD853F>สิทธิ</th>
  <th bgcolor=CD853F>รับป่วย</th>
  <th bgcolor=CD853F>จำหน่าย</th>
  <th bgcolor=CD853F>โรค</th>
  <th bgcolor=CD853F>แพทย์</th>
  <th bgcolor=CD853F>เตียง</th>
<!--  <th bgcolor=CD853F>D/C</th>
    <th bgcolor=CD853F>D/Cใหม่</th>
  <th bgcolor=CD853F>ผู้ป่วย</th>
  <th bgcolor=CD853F>ญาติ</th>
  <th bgcolor=CD853F>แนะนำ</th>
   <th bgcolor=CD853F>ใบนอน</th>-->
   <th bgcolor=CD853F>เอกสารต่างๆ</th>
    <th bgcolor=CD853F>บันทึกประวัติ</th>
 </tr>

<?php
If (!empty($an)){
    include("connect.inc");
    global $hn;
    $query = "SELECT an,hn,ptname,ptright,date,dcdate,diag,doctor,bedcode,fname FROM ipcard WHERE an = '$an'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($an,$hn,$ptname,$ptright,$date,$dcdate,$diag,$doctor,$bedcode,$fname) = mysql_fetch_row ($result)) {

	// ($fname) 
        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3><A HREF=\"".$fname
."\" target=\"_blank\">$an</a></td>\n".
           "  <td BGCOLOR=F5DEB3>$hn</td>\n".
           "  <td BGCOLOR=F5DEB3>$ptname</td>\n".
           "  <td BGCOLOR=F5DEB3>$ptright</a></td>\n".
           "  <td BGCOLOR=F5DEB3>$date</a></td>\n".
           "  <td BGCOLOR=F5DEB3>$dcdate</td>\n".
           "  <td BGCOLOR=F5DEB3>$diag</td>\n".
           "  <td BGCOLOR=F5DEB3>$doctor</td>\n".
           "  <td BGCOLOR=F5DEB3>$bedcode</td>\n".
/*   "  <td BGCOLOR=F5DEB3><a target=_BLANK  href=\"dcsum.php? Can=$an&Chn=$hn&Cdate=$date\">พิมพ์</td>\n".
"  <td BGCOLOR=F5DEB3><a target=_BLANK  href=\"dcsum.1.php? Can=$an&Chn=$hn&Cdate=$date\">พิมพ์</td>\n".
   "  <td BGCOLOR=F5DEB3><a target=_BLANK  href=\"dcsum2.php? Can=$an&Chn=$hn&Cdate=$date\">พิมพ์</td>\n".
   "  <td BGCOLOR=F5DEB3><a target=_BLANK  href=\"dcsum3.php? Can=$an&Chn=$hn&Cdate=$date\">พิมพ์</td>\n".
   "  <td BGCOLOR=F5DEB3><a target=_BLANK  href=\"dcsum4.php? Can=$an&Chn=$hn&Cdate=$date\">พิมพ์</td>\n".
   "  <td BGCOLOR=F5DEB3><a target=_BLANK  href=\"ancashdetail.php? Can=$an&Chn=$hn&Cdate=$date\">พิมพ์</td>\n".*/
   
   "  <td BGCOLOR='F5DEB3' align='center'><a target=_BLANK  href=\"opipcard2.php?Can=$an&Chn=$hn&Cdate=$date\">พิมพ์</td>\n".
   
	"  <td BGCOLOR=F5DEB3 align=\"center\">
    <FORM METHOD=POST ACTION=\"uploadfilean.php\" enctype=\"multipart/form-data\" >
        <INPUT TYPE=\"file\" NAME=\"upload_file\">
        <BR>
        <INPUT TYPE=\"submit\" value=\"ตกลง\">
        <INPUT TYPE=\"hidden\" name=\"an\" value=\"".$an."\">
        <BR>
        <A HREF=\"".$fname."\" target=\"_blank\">$fname ดูข้อมูล</A>
    </FORM>
    </td>\n"." 
    </tr>\n");
       }
?>

</table><br /><br />

<table>
 <tr>
  <th bgcolor=CD853F>วันที่</th>
    <th bgcolor=CD853F>AN</th>
  <th bgcolor=CD853F>สถานะ</th>
  <th bgcolor=CD853F>ผู้บันทึก</th>
 </tr>

<?php
	
	   $query = "SELECT date,status,office,an FROM dcstatus WHERE an = '$an'";
    $result = mysql_query($query)
        or die("Query failed");
    while (list ($date,$status,$office,$an) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3>$date</a></td>\n".
			           "  <td BGCOLOR=F5DEB3>$an</a></td>\n".
           "  <td BGCOLOR=F5DEB3>$status</td>\n".
           "  <td BGCOLOR=F5DEB3>$office</td>\n".
           " </tr>\n");
       }
	   include("unconnect.inc");
}
?>



</table>
