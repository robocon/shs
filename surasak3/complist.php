<?php
    print  "�٢����ź���ѷ<br> ";
?>
  <form method="post" action="<?php echo $PHP_SELF ?>">
<font face="Angsana New"><a target=_BLANK href="comcode.php">���ʺ���ѷ ?</a>
&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="comcode" size="10"></font>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="     ��ŧ     " name="B1">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< �����</a></font></p>
</form>

<table>
 <tr>
  <th bgcolor=CC9900><font face='Angsana New'>����</th>
  <th bgcolor=CC9900><font face='Angsana New'>���ͺ���ѷ</th>
  <th bgcolor=CC9900><font face='Angsana New'>�������</th>
  <th bgcolor=CC9900><font face='Angsana New'>������</th>
  <th bgcolor="CC9900"><font face='Angsana New'>�Ţ�����ʹ��Ҥ�</th>
  <th bgcolor="CC9900"><font face='Angsana New'>ŧ�ѹ���</th>
  <th bgcolor="CC9900"><font face='Angsana New'>�Ţ�����ʹ��Ҥ�2</th>
  <th bgcolor="CC9900"><font face='Angsana New'>ŧ�ѹ���2</th>
  <th bgcolor="CC9900"><font face='Angsana New'>�Ţ�����ʹ��Ҥ�3</th>
  <th bgcolor="CC9900"><font face='Angsana New'>ŧ�ѹ���3</th>
  <th bgcolor=CC9900><font face='Angsana New'>�����ź���ѷ</th>
  <th bgcolor=CC9900><font face='Angsana New'>���</th>
 </tr>
<?php
If (!empty($comcode)){
    include("connect.inc");
    $query = "SELECT comcode,comname, comaddr, tel, pobillno, pobilldate, pobillno2, pobilldate2, pobillno3, pobilldate3 FROM company WHERE comcode LIKE '$comcode%' ";
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
           "  <td BGCOLOR=#FFCC99><a target=_BLANK  href=\"compdata.php? Compcode=$comcode\"><font face='Angsana New'>�����ź���ѷ</a></td>\n".
           "  <td BGCOLOR=#FFCC99><a target=_BLANK  href=\"compedit.php? Compcode=$comcode\"><font face='Angsana New'>���</a></td>\n".
           " </tr>\n");
         }

   include("unconnect.inc");
          }

?>
</table>


