<?php
    $Thaidate=date("d/m/").(date("Y")+543);
    print  "�Ҥ��� �Ǫ�ѳ�� ����ػ�ó���ᾷ�� $Thaidate<br> ";
    print "<font face='Angsana New'>�ٵ������<br>";
?>
  <form method="post" action="<?php echo $PHP_SELF ?>">
<font face="Angsana New"><a target=_BLANK href="drugcode.php">������ ?</a>
&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="drugcode" size="10"></font>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="     ��ŧ     " name="B1">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< �����</a></font></p>
&nbsp;&nbsp;&nbsp;<a target=_BLANK href="dgprigp.php">���Ǫ�ѳ�� ����ػ�ó���ᾷ�������</a>
</form>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>����</th>
  <th bgcolor=6495ED><font face='Angsana New'>���͡�ä��</th>
  <th bgcolor=6495ED><font face='Angsana New'>�������ѭ</th>
  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�</th>
  <th bgcolor=6495ED><font face='Angsana New'>˹���</th>    
  <th bgcolor=6495ED><font face='Angsana New'>������ط��</th>
  <th bgcolor=6495ED><font face='Angsana New'>��/��͹</th>
  <th bgcolor=6495ED><font face='Angsana New'>������</th>
 </tr>

<?php
If (!empty($drugcode)){
    include("connect.inc");
    //runno  to find date established
    $query = "SELECT title,startday FROM runno WHERE title = 'RX1D'";
    $result = mysql_query($query)
        or die("Query failed");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

    $dStartday=$row->startday;

    $query = "SELECT drugcode,tradname,genname,salepri,unit,totalstk,rxrate,part FROM druglst  WHERE drugcode LIKE '$drugcode%' ";
     $result = mysql_query($query)
        or die("Query failed");

//    print "�������Ǫ�ѳ������ػ�ó�<br> ";
    print "<font face='Angsana New'>DDL =   ��㹺ѭ������ѡ��觪ҵ� �ԡ��<br> ";
    print "<font face='Angsana New'>DDY =   �ҹ͡�ѭ������ѡ��觪ҵ� �ԡ��<br> ";
    print "<font face='Angsana New'>DDN =   �ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�����<br> ";
    print "<font face='Angsana New'>DPY =   �ػ�ó� ����ԡ��(�ԡ����������ͺҧ��ǹ)<br> ";
    print "<font face='Angsana New'>DPN =   �ػ�ó� ����ԡ����� <br>  ";
    print "<font face='Angsana New'>DSY =   �Ǫ�ѳ�� ����ԡ��(�ԡ����������ͺҧ��ǹ)<br> ";
    print "<font face='Angsana New'>DSN =   �Ǫ�ѳ�� ����ԡ����� ";

    $num=0;
    while (list ($drugcode,$tradname,$genname,$salepri,$unit,$totalstk,$rxrate,$part) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$genname</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$salepri</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$unit</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$totalstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$rxrate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
          }
   include("unconnect.inc");
          }
?>

</table>

 