<?php
    include("connect.inc");

    $query = "SELECT  title,prefix,runno  FROM runno WHERE title = '$title'";
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

   If ($result){
        $title=$row->title;
        $prefix=$row->prefix;
        $runno=$row->runno;
                  }  
   else {
      echo "��辺 ���� : $title ";
           }    
include("unconnect.inc");

print "<body bgcolor='#808080' text='#FFFFFF'>";
print "<form method='POST' action='runnoupdate.php' target='_BLANK'>";
print "<table border='0' width='100%' height='345'>";
print "<tr>";
print " <td width='7%' height='21'></td>";
print "  <td width='48%' height='21'>";
print "  <p align='center'><b>'��䢢�����runno';</b>&nbsp;&nbsp;</td>";
print "  <td width='45%' height='21'><b>&#3650;&#3611;&#3619;&#3604;&#3607;&#3635;&#3604;&#3657;&#3623;&#3618;&#3588;&#3623;&#3634;&#3617;&#3619;&#3632;&#3617;&#3633;&#3604;&#3619;&#3632;&#3623;&#3633;&#3591;</b></td>";
print " </tr>";
print " <tr>";
print " ��¡�� ";
print "   <input type='text' name='title' size='20' tabindex='5'value=$title><br>";
print " �����ӡ������¹��¡��";
print " <td width='7%' height='236'></td>";
print " �������";
print "   <input type='text' name='prefix' size='20' tabindex='5'value=$prefix><br>";

print " �Ţ��� ���������� ������ 0 ���� ����Ţ��͹��ѧ��͹�� ";
print "   <input type='text' name='runno' size='20' tabindex='5'value=$runno><br>";

print "  <input type='submit' value='   &#3605;&#3585;&#3621;&#3591;   ' name='B1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "    <input type='reset' value='  &#3621;&#3610;&#3607;&#3636;&#3657;&#3591;  ' name='B2'></td>";
print "     <td width='45%' height='76'></td>";
print "    </tr>";
print " </table>";
print "</form>";
print "</body>";

?>




    