<?php
  print " �ѧ�������¹��������";
/*
    include("connect.inc");

    $query = "SELECT * FROM opday WHERE thdatehn = '$cTdatehn'";
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
        //vn,ptname,hn,an,goup,diag,dxgroup
        $cPtname=$row->ptname;
        $cHn=$row->hn;
        $cDoctor=$row->doctor;
        $cDiag=$row->diag;
        $cOkopd=$row->okopd;
                  }  
   else {
      echo "��辺 ���� : $cTdatehn";
           }    
include("unconnect.inc");

print "<body bgcolor='##669999' text='#FFFFFF'>";
print "<form method='POST' action='okopd.php' target='_BLANK'>";
print "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "��Ǩ�ͺ��� ᾷ�����ѡ�� ����ԹԨ����ä</p>";
print "<div align='left'>";
print "<table border='0' cellpadding='0' cellspacing='0' width='76%'>";
print "<tr>";
print "<td width='15%'></td>";
print "<td width='32%' valign='middle'>HN";
print "<p>���ͼ�����</p>";
print "<p>ᾷ�����ѡ��</p>";
print "<p>�ԹԨ����ä</p>";
print "<p>�׹�ѵ� ?</td>";
print "<td width='42%' valign='top'><input type='text' name='hn' size='30' value='$cHn'>";
print "<p><input type='text' name='ptname' size='30' value='$cPtname'></p>";

print " <select  name='doctor'>";
print " <OPTION value='$cDoctor'>";
print " <option value='$cDoctor' selected>$cDoctor</option>";
print " <option value='0' ><-���͡-></option>";

print "<option value='MD022 (����Һᾷ��)'>(����Һᾷ��)</option>";
print "<option value='MD003 �ع�֡ �������'>�ع�֡ �������</option>";
print "<option value='MD006 ���͡ ��ҹ���ҧ'>���͡ ��ҹ���ҧ</option>";
print "<option value='MD007 �ç�� ��մ�͹ѹ��آ'>�ç�� ��մ�͹ѹ��آ</option>";
print "<option value='MD008 ��ó� �����ѡ���'>��ó� �����ѡ���</option>";
print "<option value='MD009 ����� �����ѡ���'>����� �����ѡ���</option>";
print "<option value='MD010 �ظ� �ѵ�Ҹ����Ѳ��'>�ظ� �ѵ�Ҹ����Ѳ��</option>";
print "<option value='MD011 ͹ؾ��� �ʹ���'>͹ؾ��� �ʹ���</option>";
print "<option value='MD012 �ح��� �ح�Ѳ��'>�ح��� �ح�Ѳ��</option>";
print "<option value='MD013 ����Թ��� ����չҤ'>����Թ��� ����չҤ</option>";
print "<option value='MD014 ��Ѫ�� ���¨���'>��Ѫ�� ���¨���</option>";
print "<option value='MD015 ������ ������ó'>������ ������ó</option>";
print "<option value='MD016 ����Թ ���๵�'>����Թ ���๵�</option>";
print "<option value='MD017 �Է�Ԫ�� �Ե���Թ��'>�Է�Ԫ�� �Ե���Թ��</option>";
print "<option value='MD018 ���ѵ� �ҹ��'>���ѵ� �ҹ��</option>";
print "<option value='MD019 ������ѵ� ������'>������ѵ� ������</option>";
print "<option value='MD020 ˹��ķ�� ����ȹѹ��'>˹��ķ�� ����ȹѹ��</option>";
print "<option value='MD021 ���Ѳ�� �ح�׹'>���Ѳ�� �ح�׹</option>";
print "<option value='MD023 �ѹ�ѡ��� �����ѵ��'>�ѹ�ѡ��� �����ѵ��</option>";
print "<option value='MD024 ��зջ ��������'>��зջ ��������</option>";
print "<option value='MD025 �ؾ���� ����Է�����è��'>�ؾ���� ����Է�����è��</option>";
print "<option value='MD026 ͪ�� ྪô�'>ͪ�� ྪô�</option>";
print "<option value='MD027 ���� ���§��'>���� ���§��</option>";
print "<option value='MD028 ���ô� ���§��'>���ô� ���§��</option>";
print "<option value='MD029 ���� �ʹ����ѡɳ�'>���� �ʹ����ѡɳ�</option>";
print "</select></font>";

print "<p><input type='text' name='diag' size='30' value='$cDiag'></p>";

print " <select  name='okopd'>";
print " <OPTION value='$cOkopd'>";
print " <option value='$cOkopd' selected>$cOkopd</option>";
//print " <option value='0' ><-���͡-></option>";
//print "<option value='N'>N</option>";
print "<option value='Y'>Y</option>";
print "</select></font>";

print "</tr>";
print "</table>";
print "</div>";
print "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "&nbsp;&nbsp;&nbsp;";
print "<input type='submit' value='       &#3605;&#3585;&#3621;&#3591;       ' name='B1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
//print "<input type='reset' value='  &#3621;&#3610;&#3607;&#3636;&#3657;&#3591;  ' name='B2'></p>";
print "</form>";
print "</body>";
*/


//���ѹ��� ���� ᾷ�� ��ͧ
/*
print "<form method='POST' action='appinsert.php' target='_BLANK'>";
print "  <p><font face='Angsana New'>&#3609;&#3633;&#3604;&#3617;&#3634;&#3623;&#3633;&#3609;&#3607;&#3637;&#3656;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input type='text' name='appdate' size='2'><select size='1' name='appmo'>";
print "    <option selected>--��͹--</option>";
print "    <option value='���Ҥ�'>���Ҥ�</option>";
print "    <option value='����Ҿѹ��'>����Ҿѹ��</option>";
print "    <option value='�չҤ�'>�չҤ�</option>";
print "    <option value='����¹'>����¹</option>";
print "    <option value='����Ҥ�'>����Ҥ�</option>";
print "    <option value='�Զع�¹'>�Զع�¹</option>";
print "    <option value='�á�Ҥ�'>�á�Ҥ�</option>";
print "    <option value='�ԧ�Ҥ�'>�ԧ�Ҥ�</option>";
print "    <option value='�ѹ��¹'>�ѹ��¹</option>";
print "    <option value='���Ҥ�'>���Ҥ�</option>";
print "    <option value='��Ȩԡ�¹'>��Ȩԡ�¹</option>";
print "    <option value='�ѹ�Ҥ�'>�ѹ�Ҥ�</option>";
print "  </select><select size='1' name='thiyr'>";
print "    <option selected>2547</option>";
print "    <option>2548</option>";
print "    <option>2549</option>";
print "    <option>2550</option>";
print "    <option>2551</option>";
print "    <option>2552</option>";
print "    <option>2553</option>";
print "  </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  &#3648;&#3623;&#3621;&#3634;&nbsp; <select size='1' name='apptime'>";
print "    <option selected>&lt;&#3648;&#3621;&#3639;&#3629;&#3585;&#3648;&#3623;&#3621;&#3634;&#3609;&#3633;&#3604;&gt;</option>";
print "    <option>07:00 &#3609;.</option>";
print "    <option>07:30 &#3609;.</option>";
print "    <option>08:00 &#3609;.</option>";
print "    <option>08:30 &#3609;.</option>";
print "    <option>09:00 &#3609;.</option>";
print "    <option>09:30 &#3609;.</option>";
print "    <option>10:00 &#3609;.</option>";
print "    <option>10:30 &#3609;.</option>";
print "   <option>11:00 &#3609;.</option>";
print "    <option>11:30 &#3609;.</option>";
print "    <option>13:00 &#3609;.</option>";
print "    <option>13:30 &#3609;.</option>";
print "    <option>14:00 &#3609;.</option>";
print "    <option>14:30 &#3609;.</option>";
print "    <option>15:00 &#3609;.</option>";
print "    <option>15:30 &#3609;.</option>";
print "    <option>16:00 &#3609;.</option>";
print "  </select></font></p>";

print "  <p><font face='Angsana New'>&#3649;&#3614;&#3607;&#3618;&#3660;&#3612;&#3641;&#3657;&#3609;&#3633;&#3604;&nbsp;&nbsp;&nbsp;&nbsp;";
print " <select  name='doctor'>";
print " <OPTION value='$cDoctor'>";
print " <option value='$cDoctor' selected>$cDoctor</option>";
print " <option value='0' ><-���͡-></option>";

print "<option value='MD022 (����Һᾷ��)'>(����Һᾷ��)</option>";
print "<option value='MD003 �ع�֡ �������'>�ع�֡ �������</option>";
print "<option value='MD006 ���͡ ��ҹ���ҧ'>���͡ ��ҹ���ҧ</option>";
print "<option value='MD007 �ç�� ��մ�͹ѹ��آ'>�ç�� ��մ�͹ѹ��آ</option>";
print "<option value='MD008 ��ó� �����ѡ���'>��ó� �����ѡ���</option>";
print "<option value='MD009 ����� �����ѡ���'>����� �����ѡ���</option>";
print "<option value='MD010 �ظ� �ѵ�Ҹ����Ѳ��'>�ظ� �ѵ�Ҹ����Ѳ��</option>";
print "<option value='MD011 ͹ؾ��� �ʹ���'>͹ؾ��� �ʹ���</option>";
print "<option value='MD012 �ح��� �ح�Ѳ��'>�ح��� �ح�Ѳ��</option>";
print "<option value='MD013 ����Թ��� ����չҤ'>����Թ��� ����չҤ</option>";
print "<option value='MD014 ��Ѫ�� ���¨���'>��Ѫ�� ���¨���</option>";
print "<option value='MD015 ������ ������ó'>������ ������ó</option>";
print "<option value='MD016 ����Թ ���๵�'>����Թ ���๵�</option>";
print "<option value='MD017 �Է�Ԫ�� �Ե���Թ��'>�Է�Ԫ�� �Ե���Թ��</option>";
print "<option value='MD018 ���ѵ� �ҹ��'>���ѵ� �ҹ��</option>";
print "<option value='MD019 ������ѵ� ������'>������ѵ� ������</option>";
print "<option value='MD020 ˹��ķ�� ����ȹѹ��'>˹��ķ�� ����ȹѹ��</option>";
print "<option value='MD021 ���Ѳ�� �ح�׹'>���Ѳ�� �ح�׹</option>";
print "<option value='MD023 �ѹ�ѡ��� �����ѵ��'>�ѹ�ѡ��� �����ѵ��</option>";
print "<option value='MD024 ��зջ ��������'>��зջ ��������</option>";
print "<option value='MD025 �ؾ���� ����Է�����è��'>�ؾ���� ����Է�����è��</option>";
print "<option value='MD026 ͪ�� ྪô�'>ͪ�� ྪô�</option>";
print "<option value='MD027 ���� ���§��'>���� ���§��</option>";
print "<option value='MD028 ���ô� ���§��'>���ô� ���§��</option>";
print "<option value='MD029 ���� �ʹ����ѡɳ�'>���� �ʹ����ѡɳ�</option>";
print "<option value='MD030 ���͡�� ������Ѿ��'>���͡�� ������Ѿ��</option>";
print "</select></font>";

print "    <font face='Angsana New'>";
print "    &nbsp;&nbsp;&nbsp;&nbsp; &#3609;&#3633;&#3604;&#3617;&#3634;&#3607;&#3637;&#3656;&nbsp;<select size='1' name='room'>";
print "    <option selected>&lt;&#3648;&#3621;&#3639;&#3629;&#3585;&#3627;&#3657;&#3629;&#3591;&#3605;&#3619;&#3623;&#3592;&gt;</option>";
print "    <option>&#3629;&#3634;&#3618;&#3640;&#3619;&#3585;&#3619;&#3619;&#3617; 1</option>";
print "    <option>&#3629;&#3634;&#3618;&#3640;&#3619;&#3585;&#3619;&#3619;&#3617; 2</option>";
print "    <option>&#3629;&#3634;&#3618;&#3640;&#3619;&#3585;&#3619;&#3619;&#3617; 3</option>";
print "    <option>&#3629;&#3634;&#3618;&#3640;&#3619;&#3585;&#3619;&#3619;&#3617; 4</option>";
print "    <option>&#3629;&#3634;&#3618;&#3640;&#3619;&#3585;&#3619;&#3619;&#3617; 5</option>";
print "    <option>&#3629;&#3634;&#3618;&#3640;&#3619;&#3585;&#3619;&#3619;&#3617; 6</option>";
print "    <option>&#3627;&#3641; &#3588;&#3629; &#3592;&#3617;&#3641;&#3585;</option>";
print "    <option>&#3585;&#3640;&#3617;&#3634;&#3619;</option>";
print "    <option>&#3624;&#3633;&#3621;&#3618;&#3585;&#3619;&#3619;&#3617;</option>";
print "    <option>&#3585;&#3619;&#3632;&#3604;&#3641;&#3585;&#3649;&#3621;&#3632;&#3586;&#3657;&#3629;</option>";
print "    <option>&#3624;&#3633;&#3621;&#3618;&#3660;&#3607;&#3634;&#3591;&#3648;&#3604;&#3636;&#3609;&#3611;&#3633;&#3626;&#3626;&#3634;&#3623;&#3632;</option>";
print "    <option>&#3626;&#3641;&#3605;&#3636;-&#3609;&#3619;&#3637;&#3648;&#3623;&#3594;</option>";
print "    <option>&#3624;&#3633;&#3621;&#3618;&#3660;&#3619;&#3632;&#3610;&#3610;&#3611;&#3619;&#3632;&#3626;&#3634;&#3607;</option>";
print "   </select></font></p>";



print "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "&nbsp;&nbsp;&nbsp;";
print "<input type='submit' value='       &#3605;&#3585;&#3621;&#3591;       ' name='B1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
//print "<input type='reset' value='  &#3621;&#3610;&#3607;&#3636;&#3657;&#3591;  ' name='B2'></p>";
print "</form>";
print "</body>";
*/
?>




    