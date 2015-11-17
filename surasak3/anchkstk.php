<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;โปรแกรมพิมพ์สติกเกอร์หมายเลข  AN</p>
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
 
 </tr>

<?php
If (!empty($an)){
    include("connect.inc");
    global $hn;
    $query = "SELECT an,hn,ptname,ptright,date,dcdate,diag,doctor,bedcode,fname FROM ipcard WHERE an = '$an'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($an,$hn,$ptname,$ptright,$date,$dcdate,$diag,$doctor,$bedcode,$fname) = mysql_fetch_row ($result)) {

	
        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3><BR><a target=_BLANK  href=\"anchkstk1.php? Can=$an&Chn=$hn&Cdate=$date\">$an </a></td>\n".
           "  <td BGCOLOR=F5DEB3>$hn</td>\n".
           "  <td BGCOLOR=F5DEB3>$ptname</td>\n".
           "  <td BGCOLOR=F5DEB3>$ptright</a></td>\n".
           "  <td BGCOLOR=F5DEB3>$date</a></td>\n".
 " </tr>\n");
       }
}
?>

</table><br /><br />




	
	




