<?php
   session_start();
    session_unregister("cHn");  
    session_unregister("cPtname");
    session_unregister("cPtright");
    session_unregister("nVn");
    session_unregister("nRunno");  
    session_unregister("vAN"); 
    session_unregister("thdatehn"); 
    session_unregister("cNote");    
//    session_destroy();
?>
<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>���Ҥ���ҡ&nbsp; ���ʡ��</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ���ʡ��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="surname" size="12"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="  ��ŧ  " name="B1">&nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" value="  ź���  " name="B2"></p>
</form>

<table>
 <tr>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>��</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>ʡ��</th>
  <th bgcolor=6495ED>�/�/�/�Դ</th>
  <th bgcolor=6495ED>�ѵ� ���.</th>
 </tr>

<?php
If (!empty($surname)){
    include("connect.inc");
    global $surname;
    $query = "SELECT hn,yot,name,surname,dbirth,idcard FROM opcard WHERE surname LIKE '$surname%' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($hn,$yot,$name,$surname,$dbirth,$idcard) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><a target=_BLANK  href=\"seopcard.php? cHn=$hn & cName=$name &cSurname=$surname\">$hn</a></td>\n".
           "  <td BGCOLOR=66CDAA>$yot</td>\n".
           "  <td BGCOLOR=66CDAA>$name</td>\n".
           "  <td BGCOLOR=66CDAA>$surname</td>\n".
      "  <td BGCOLOR=66CDAA>$dbirth</td>\n".
      "  <td BGCOLOR=66CDAA>$idcard</td>\n".
           " </tr>\n");
        }
include("unconnect.inc");
        }
?>
</table>
