<?php
    session_start();
    session_unregister("sHn");
    session_unregister("sName");
    session_unregister("sSurname");

    $sHn="";
    $sName="";
    $sSurname=""; 

    session_register("sHn");
    session_register("sName");
    session_register("sSurname");
?>
<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>���������������Ţ  XN number </p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="hn" size="12"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="      ��ŧ      " name="B1"></p>
</form>

<?php
If (!empty($hn)){
    print "--------------------------------------- <br>";
    include("connect.inc");

    $query = "SELECT hn,xn,name,surname FROM xrayno WHERE hn = '$hn'";
    $result = mysql_query($query) or die("Query failed");
        for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

    if(!mysql_num_rows($result)){
       $query = "SELECT hn,yot,name,surname FROM opcard WHERE hn = '$hn'";
       $result = mysql_query($query) or die("Query failed");

        for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }
        if(!mysql_num_rows($result)){
                            print "����� HN $hn ��ç��Һ��<br>";
    		                   }
        else{
           $sHn=$row->hn;
           $sName=$row->name;
           $sSurname=$row->surname; 

           print "HN $hn $row->yot $row->name $row->surname<br>";
           print "�ѧ����������Ţ XN <br>";
           print "�ô��������Ţ XN ����<br>";

           print "<form method='POST' action='xnnew.php'>";
           print "<p>�����Ţ XN ����&nbsp; <input type='text' name='xn' size='15'></p>";
           print "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
           print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
           print "<input type='submit' value='      ��ŧ      ' name='B1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
//           print "<input type='reset' value='  ź���  ' name='B2'></p>";
           print "</form>";
	      }
	}
   else{
           $sHn=$row->hn;
           $sName=$row->name;
           $sSurname=$row->surname; 
           print "HN $hn  ���� $row->name $row->surname<br>";
           print "�������Ţ XN ���� ��� $row->xn<br>";
//           print "���� $row->name $row->surname<br>";

//��ͧ������ XN
           print "--------------------------------------- <br>";
           print "�óյ�ͧ������ XN !<br>";

           print "<form method='POST' action='xnedit.php'>";
           print "<p>���  XN &nbsp; <input type='text' name='xn' size='15' value=$row->xn></p>";
           print "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
           print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
           print "<input type='submit' value='      ��ŧ      ' name='B1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
//           print "<input type='reset' value='  ź���  ' name='B2'></p>";
           print "</form>";

           }
include("unconnect.inc");
       }
?>

