<?php
    session_start();
    session_unregister("xRow_id");
//    session_unregister("nRow_id");
    $xRow_id=$nRow_id;
    session_register("xRow_id");
    include("connect.inc");

    $query = "SELECT * FROM pocompany WHERE row_id = '$nRow_id'";
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
    $cComcode=$row->comcode;
	$cComname=$row->comname;
	$cDepart=$row->depart;
    $cDepartno=$row->departno;
    $cDepartdate=$row->departdate;

	$cPrepono=$row->prepono;
	$cPrepodate=$row->prepodate;
	$cPono=$row->pono;
	$cPodate=$row->podate;
	$cBounddate=$row->bounddate;
	$cChkindate=$row->chkindate;
	$cSenddate=$row->senddate;
	$cBorrowdate=$row->borrowdate;
	$cPonoyear=$row->ponoyear;
	$cPobillno=$row->pobillno;
	$cPobilldate=$row->pobilldate;	
	$cFixdate=$row->fixdate;
                  }  
   else {
                echo "��辺 ���� : $cTdatehn";
           }    
include("unconnect.inc");

print "<body bgcolor='##669999' text='#FFFFFF'>";
print "<form method='POST' action='prepofilok.php' target='_BLANK'>";
print "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <b><font face='Angsana New'>����ʹͤ�����ͧ��èҡ �ͧ / Ἱ�</b>";
print "  <br>����Ѻ��� �ͧ / Ἱ� <input type='text' name='depart' size='30' value='$cDepart'>";
print "  <br>���  (�ͧ  �ͧ / Ἱ�)........ <input type='text' name='departno' size='30' value='$cDepartno'>";
print "  <br>ŧ�ѹ��� .............................<input type='text' name='departdate' size='30' value='$cDepartdate'><br>";
print " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "<hr>";
print "  <b>���觫��ͪ��Ǥ���</b>";
print "  <br>��� �� ���觫��ͪ��Ǥ��� <input type='text' name='prepono' size='30' value='$cPrepono'><br>";
print "  �ѹ������觫��ͪ��Ǥ���&nbsp;&nbsp;&nbsp;<input type='text' name='prepodate' size='30' value='$cPrepodate'><br>";
print " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "<hr>";
print "  <b> ���觫��ͨ�ԧ</b>";
print "  <br>";
print "  ��� �� ���觫��ͨ�ԧ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='pono' size='30' value='$cPono'>��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='ponoyear' size='5' value='$cPonoyear'><br>";
print "  �ѹ�����§ҹ�ͫ���&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input type='text' name='podate' size='30' value='$cPodate'><br>";
print "  �ѹ���͹��ѵ�&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input type='text' name='bounddate' size='30' value='$cBounddate'><br>";
print "  �ѹ����Ѻ�ͧ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input type='text' name='chkindate' size='30' value='$cChkindate'><br>";
print "  �ѹ�����觫���&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input type='text' name='senddate' size='30' value='$cSenddate'><br>";
print "  �ѹ����ԡ�Թ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input type='text' name='borrowdate' size='30' value='$cBorrowdate'><br>";
print "  �ѹ����˹����ͺ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input type='text' name='fixdate' size='30' value='$cFixdate'><br>";
print " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "<hr>";
print "  <b> ����ѷ�����觫�����/�Ǫ�ѳ��</b>";
print "  <br>";
print "����ѷ : ($cComcode) $cComname <br>";
print "��ʹ��Ҥ� �Ţ���&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "<input type='text' name='pobillno' size='30' value='$cPobillno'><br>";
print "��ʹ��Ҥ� ŧ�ѹ���&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "<input type='text' name='pobilldate' size='30' value='$cPobilldate'><br>";
print "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input type='submit' value='        &#3610;&#3633;&#3609;&#3607;&#3638;&#3585;        ' name='B1'></p>";
print "</form>";
print "</body>";
?>




    