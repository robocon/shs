<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��Ǩ�ͺ��ª��ͼ����·����� </p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <input type="text" name="hn1" size="12"></p>

&nbsp;&nbsp;&nbsp;�����������������ӹǹ��  �ӹǹ 1000 ��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="      ��ŧ      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<�����</a></p>
</form>

<table>
 <tr>
 

  <th bgcolor=CD853F>HN</th>
  <th bgcolor=CD853F>AN</th>
  <th bgcolor=CD853F>����</th>
  <th bgcolor=CD853F>ICD10</th>
  <th bgcolor=CD853F>�ѹ���</th>



 </tr>

<?php
{

    include("connect.inc");
    $query = "SELECT hn,an,ptname,icd10,date FROM ipcard WHERE icd10 like 'R%' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($hn,$an,$ptname,$icd10,$thidate) = mysql_fetch_row ($result)) {


        print (" <tr>\n".
		

           "  <td BGCOLOR=F5DEB3>$hn</a></td>\n".
       "  <td BGCOLOR=F5DEB3>$an</a></td>\n".
           "  <td BGCOLOR=F5DEB3>$ptname</td>\n".
      "  <td BGCOLOR=F5DEB3>$icd10</td>\n".
           "  <td BGCOLOR=F5DEB3>$thidate</td>\n".
   



           " </tr>\n");
       }
include("unconnect.inc");
       }
?>
</table>
