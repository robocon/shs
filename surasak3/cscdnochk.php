<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��Ǩ�ͺ��ª��ͼ����� CSCD  ����ջѭ�� </p>
  <a target=_self  href='../nindex.htm'><<�����</a>


</form>

<table>
 <tr>
   <th bgcolor=CD853F>#</th>

  <th bgcolor=CD853F>HN</th>
  <th bgcolor=CD853F>��</th>
  <th bgcolor=CD853F>����</th>
  <th bgcolor=CD853F>ʡ��</th>
  <th bgcolor=CD853F>�Ţ��ЪҪ�</th>
  <th bgcolor=CD853F>�Է��</th>
  <th bgcolor=CD853F>��¡��</th>


 </tr>

<?php
{
    include("connect.inc");
    $query = "SELECT row_id,hn,yot,name,surname,idcard,dbirth,ptright,note,idguard FROM opcard WHERE idguard LIKE '�ջѭ%'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($row_id,$hn,$yot,$name,$surname,$idcard,$dbirth,$ptright,$note,$idguard) = mysql_fetch_row ($result)) {
		 $num++;
        print (" <tr>\n".
		     "  <td BGCOLOR=F5DEB3>$num</a></td>\n".

           "  <td BGCOLOR=F5DEB3>$hn</a></td>\n".
           "  <td BGCOLOR=F5DEB3>$yot</td>\n".
           "  <td BGCOLOR=F5DEB3>$name</td>\n".
           "  <td BGCOLOR=F5DEB3>$surname</td>\n".
           "  <td BGCOLOR=F5DEB3>$idcard</a></td>\n".
			              "  <td BGCOLOR=F5DEB3>$ptright</a></td>\n".
     "  <td BGCOLOR=F5DEB3>$idguard</a></td>\n".



           " </tr>\n");
       }
include("unconnect.inc");
       }
?>
</table>
