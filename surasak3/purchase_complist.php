<p><strong>ดูข้อมูลบริษัท</strong></p>
<form method="post" action="<?php echo $PHP_SELF ?>">
<font face="Angsana New"><a target=_BLANK href="purchase_comcode.php">รหัสบริษัท ?</a>
&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="comcode" size="10"></font>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="     ตกลง     " name="B1">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< ไปเมนู</a></font></p>
</form>

<table>
 <tr>
  <th bgcolor=#66CC99><font face='Angsana New'>รหัส</th>
  <th bgcolor=#66CC99><font face='Angsana New'>ชื่อบริษัท</th>
  <th bgcolor=#66CC99><font face='Angsana New'>ที่อยู่</th>
  <th bgcolor=#66CC99><font face='Angsana New'>เบอร์โทร</th>
  <th bgcolor="#66CC99"><font face='Angsana New'>เลขที่ใบเสนอราคา</th>
  <th bgcolor="#66CC99"><font face='Angsana New'>ลงวันที่</th>
  <th bgcolor="#66CC99"><font face='Angsana New'>เลขที่ใบเสนอราคา2</th>
  <th bgcolor="#66CC99"><font face='Angsana New'>ลงวันที่2</th>
  <th bgcolor="#66CC99"><font face='Angsana New'>เลขที่ใบเสนอราคา3</th>
  <th bgcolor="#66CC99"><font face='Angsana New'>ลงวันที่3</th>
  <th bgcolor=#66CC99><font face='Angsana New'>ข้อมูลบริษัท</th>
  <th bgcolor=#66CC99><font face='Angsana New'>แก้ไข</th>
 </tr>
<?php
If (!empty($comcode)){
    include("connect.inc");
    $query = "SELECT comcode,comname, comaddr, tel, pobillno, pobilldate, pobillno2, pobilldate2, pobillno3, pobilldate3 FROM company WHERE comtype='pc' AND comcode LIKE '$comcode%' ";
    $result = mysql_query($query) or die("Query failed");

    while (list ($comcode, $comname, $comaddr, $tel, $pobillno, $pobilldate, $pobillno2, $pobilldate2, $pobillno3, $pobilldate3) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=#FFCC99><font face='Angsana New'>$comcode</td>\n".
           "  <td BGCOLOR=#FFCC99><font face='Angsana New'>$comname</td>\n".
			"  <td BGCOLOR=#FFCC99><font face='Angsana New'>$comaddr</td>\n".
			"  <td BGCOLOR=#FFCC99><font face='Angsana New'>$tel</td>\n".
			"  <td BGCOLOR=#FFCC99><font face='Angsana New'>$pobillno</td>\n".
		   "  <td BGCOLOR=#FFCC99><font face='Angsana New'>$pobilldate</td>\n".
			"  <td BGCOLOR=#FFCC99><font face='Angsana New'>$pobillno2</td>\n".
		   "  <td BGCOLOR=#FFCC99><font face='Angsana New'>$pobilldate2</td>\n".
			"  <td BGCOLOR=#FFCC99><font face='Angsana New'>$pobillno3</td>\n".
		   "  <td BGCOLOR=#FFCC99><font face='Angsana New'>$pobilldate3</td>\n".		   		   
           "  <td BGCOLOR=#FFCC99><a target=_BLANK  href=\"compdata.php? Compcode=$comcode\"><font face='Angsana New'>ข้อมูลบริษัท</a></td>\n".
           "  <td BGCOLOR=#FFCC99><a target=_BLANK  href=\"compedit.php? Compcode=$comcode\"><font face='Angsana New'>แก้ไข</a></td>\n".
           " </tr>\n");
         }

   include("unconnect.inc");
          }

?>
</table>


