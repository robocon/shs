<?php
  $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
  print "<font face='Angsana New' size='3'>��Ǩ�Ѻ���Ǫ�ѳ��㹤�ѧ�� ���ͧ������ <br>";
  print "<font face='Angsana New'>�ѹ�����§ҹ : $Thaidate";
?>
<form method="post" action="<?php echo $PHP_SELF ?>">
<font face="Angsana New"><a target=_BLANK href="drugcode.php">������ ?</a>&nbsp;&nbsp;
<input type="text" name="drugcode" size="10">&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" value="  ��ŧ  " name="B1">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<�����</a></font></p>
</form>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>����</th>
  <th bgcolor=6495ED><font face='Angsana New'>���͡�ä��</th>
  <th bgcolor=6495ED><font face='Angsana New'>�������ѭ</th>
  <th bgcolor=6495ED><font face='Angsana New'>˹���</th>
  <th bgcolor=6495ED><font face='Angsana New'>��ͧ����</th>
  <th bgcolor=6495ED><font face='Angsana New'>㹤�ѧ</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ط��</th>
  <th bgcolor=6495ED><font face='Angsana New'>�����˵�</th>

 </tr>

<?php
If (!empty($drugcode)){
    include("connect.inc");

    $query = "SELECT drugcode,tradname,genname,unit,stock,mainstk,totalstk FROM druglst WHERE drugcode LIKE '$drugcode%' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($drugcode, $tradname,$genname,$unit,$stock,$mainstk,$totalstk) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$genname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$unit</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$stock</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$mainstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$totalstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'></td>\n".

           " </tr>\n");
          }
   include("unconnect.inc");
          }
?>

</table>


