<script type="text/javascript">
document.getElementById('aLink').focus();
</script>
<?php
   session_start();
    session_unregister("cHn");  
    session_unregister("cPtname");
    session_unregister("cAge");
	session_unregister("cptright");
session_unregister("capptime");

session_unregister("cnote");

session_unregister("cidguard");

?>
<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�͡㺹Ѵ������</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN :&nbsp;
  <input type="text" name="hn" size="12" id="aLink">
<script type="text/javascript">
document.getElementById('aLink').focus();
</script>
</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="  ��ŧ  " name="B1">
    &nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< ����</a>&nbsp&nbsp;&nbsp<a target=_self  href='appoilst.php'>����ª��ͼ����¹Ѵ</a></p>
����͹  .....  ����͡㺹Ѵ ��س��������ѡ�÷�������� (  , "  '  �繵�)   �Ҩ�����������������ö�ѹ�֡ŧ㹤���������
</form>

<table>
 <tr>
  <th bgcolor=CD853F>�͡㺹Ѵ</th>
  <th bgcolor=CD853F>��</th>
  <th bgcolor=CD853F>��Ǩ�Ѵ</th>
  <th bgcolor=CD853F>ʡ��</th>
    <th bgcolor=CD853F>�Է��</th>
 <th bgcolor=CD853F>�����˵�</th>
 </tr>

<?php
If (!empty($hn)){
    include("connect.inc");
    global $hn;
    $query = "SELECT hn,yot,name,surname,dbirth,ptright,note,idguard FROM opcard WHERE hn = '$hn'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($hn,$yot,$name,$surname,$dbirth,$ptright,$note,$idguard) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3><a   href=\"preappoi1_test.php? cHn=$hn&cYot=$yot & cName=$name &cSurname=$surname&Age=$dbirth&ptright=$ptright&note=$note&idguard=$idguard\">$hn</a></td>\n".
           "  <td BGCOLOR=F5DEB3>$yot</td>\n".
           "  <td BGCOLOR=F5DEB3><a target= _BLANK href=\"appdaycheck.php?hn=$hn\">$name</td>\n".
           "  <td BGCOLOR=F5DEB3>$surname</td>\n".
			          "  <td BGCOLOR=F5DEB3>$ptright</td>\n".
    "  <td BGCOLOR=F5DEB3>$idguard</td>\n".

           " </tr>\n");
       }
include("unconnect.inc");
       }
?>
</table>
