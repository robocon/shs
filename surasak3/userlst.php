<?php
?>
  <form method="post" action="<?php echo $PHP_SELF ?>">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< �����</a></font></p>
</form>
��ª��ͼ����ҹ��к�
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>����-���ʡ��</th>
  <th bgcolor=6495ED><font face='Angsana New'>���ͼ����</th>
 <th bgcolor=6495ED><font face='Angsana New'>���ʼ�ҹ</th>
  <th bgcolor=6495ED><font face='Angsana New'>Ἱ�</th>

  <th bgcolor=CD853F><font face='Angsana New'>ź?</th>
 </tr>

<?php
  $n=0;
    include("connect.inc");
    $query = "SELECT name,idname,menucode,pword FROM inputm";  
    $result = mysql_query($query) or die("Query failed");
        while (list ($name,$idname,$menucode,$pword) = mysql_fetch_row ($result)) {
            $n++;
            print (" <tr>\n".
               "  <td bgcolor=6495ED>$n</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$name</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$idname</td>\n".
          
     "  <td BGCOLOR=66CDAA><font face='Angsana New'>$menucode</td>\n".
     "  <td BGCOLOR=66CDAA><font face='Angsana New'>$pword</td>\n".
          
               " </tr>\n");
                }

   include("unconnect.inc");

?>

</table>


 