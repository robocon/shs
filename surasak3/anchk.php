<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��Ǩ�ͺ�����Ţ  AN</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; AN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="an" size="12" id="aLink" ></p>
<script type="text/javascript">
document.getElementById('aLink').focus();
</script>

  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="      ��ŧ      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<�����</a></p>
</form>

<table>
 <tr>
  <th bgcolor=CD853F>AN</th>
  <th bgcolor=CD853F>HN</th>
  <th bgcolor=CD853F>����-ʡ��</th>
  <th bgcolor=CD853F>�Է��</th>
  <th bgcolor=CD853F>�Ѻ����</th>
  <th bgcolor=CD853F>��˹���</th>
  <th bgcolor=CD853F>�ä</th>
  <th bgcolor=CD853F>ᾷ��</th>
  <th bgcolor=CD853F>��§</th>
<!--  <th bgcolor=CD853F>D/C</th>
    <th bgcolor=CD853F>D/C����</th>
  <th bgcolor=CD853F>������</th>
  <th bgcolor=CD853F>�ҵ�</th>
  <th bgcolor=CD853F>�й�</th>
   <th bgcolor=CD853F>㺹͹</th>-->
   <th bgcolor=CD853F>�͡��õ�ҧ�</th>
    <th bgcolor=CD853F>�ѹ�֡����ѵ�</th>
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
/*   "  <td BGCOLOR=F5DEB3><a target=_BLANK  href=\"dcsum.php? Can=$an&Chn=$hn&Cdate=$date\">�����</td>\n".
"  <td BGCOLOR=F5DEB3><a target=_BLANK  href=\"dcsum.1.php? Can=$an&Chn=$hn&Cdate=$date\">�����</td>\n".
   "  <td BGCOLOR=F5DEB3><a target=_BLANK  href=\"dcsum2.php? Can=$an&Chn=$hn&Cdate=$date\">�����</td>\n".
   "  <td BGCOLOR=F5DEB3><a target=_BLANK  href=\"dcsum3.php? Can=$an&Chn=$hn&Cdate=$date\">�����</td>\n".
   "  <td BGCOLOR=F5DEB3><a target=_BLANK  href=\"dcsum4.php? Can=$an&Chn=$hn&Cdate=$date\">�����</td>\n".
   "  <td BGCOLOR=F5DEB3><a target=_BLANK  href=\"ancashdetail.php? Can=$an&Chn=$hn&Cdate=$date\">�����</td>\n".*/
   
   "  <td BGCOLOR='F5DEB3' align='center'><a target=_BLANK  href=\"opipcard2.php?Can=$an&Chn=$hn&Cdate=$date\">�����</td>\n".
   
	"  <td BGCOLOR=F5DEB3 align=\"center\">
    <FORM METHOD=POST ACTION=\"uploadfilean.php\" enctype=\"multipart/form-data\" >
        <INPUT TYPE=\"file\" NAME=\"upload_file\">
        <BR>
        <INPUT TYPE=\"submit\" value=\"��ŧ\">
        <INPUT TYPE=\"hidden\" name=\"an\" value=\"".$an."\">
        <BR>
        <A HREF=\"".$fname."\" target=\"_blank\">$fname �٢�����</A>
    </FORM>
    </td>\n"." 
    </tr>\n");
       }
?>

</table><br /><br />

<table>
 <tr>
  <th bgcolor=CD853F>�ѹ���</th>
    <th bgcolor=CD853F>AN</th>
  <th bgcolor=CD853F>ʶҹ�</th>
  <th bgcolor=CD853F>���ѹ�֡</th>
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
