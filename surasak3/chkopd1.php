<?php
    $sTdatehn=$cTdatehn;
    session_register("sTdatehn");
 session_register("cHn");

    include("connect.inc");

    $query = "SELECT * FROM opday WHERE thdatehn = '$cTdatehn' AND vn = '".$_GET["cVn"]."' ";
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
/*
CREATE TABLE opday (
  row_id int(11) NOT NULL auto_increment,
  thidate datetime default NULL,
  thdatehn varchar(20) default NULL,
  hn varchar(12) NOT NULL default '',
  vn varchar(5) default NULL,
  thdatevn varchar(13) default NULL,
  an varchar(12) default NULL,
  ptname varchar(40) default NULL,
  ptright varchar(40) default NULL,
  goup varchar(40) default NULL,
  camp varchar(32) default NULL,
  dxgroup char(2) default NULL,
  diag varchar(40) default NULL,
  icd10 varchar(8) default NULL,
  doctor varchar(40) default NULL,
  waittime int(8) default NULL,
  okopd char(1) default 'N',
  PRIMARY KEY  (row_id),
  KEY thdatehn (thdatehn),
  KEY thdatevn (thdatevn),
  KEY admno (an)
) TYPE=MyISAM;
*/
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
print "<form method='POST' action='okopd1.php' >";
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
print "<option value='MD006 ���͡ ��ҹ���ҧ'>���͡ ��ҹ���ҧ</option>";
print "<option value='MD007 �ç�� ��մ�͹ѹ��آ'>�ç�� ��մ�͹ѹ��آ</option>";
print "<option value='MD008 ��ó� �����ѡ���'>��ó� �����ѡ���</option>";
print "<option value='MD009 ����� �����ѡ���'>����� �����ѡ���</option>";
print "<option value='MD010 �ظ� �ѵ�Ҹ����Ѳ��'>�ظ� �ѵ�Ҹ����Ѳ��</option>";
print "<option value='MD011 ͹ؾ��� �ʹ���'>͹ؾ��� �ʹ���</option>";
print "<option value='MD013 ����Թ��� ����չҤ'>����Թ��� ����չҤ</option>";
print "<option value='MD014 ��Ѫ�� ���¨���'>��Ѫ�� ���¨���</option>";
print "<option value='MD015 ������ ������ó'>������ ������ó</option>";
print "<option value='MD016 ����Թ ���๵�'>����Թ ���๵�</option>";
print "<option value='MD017 �Է�Ԫ�� �Ե���Թ��'>�Է�Ԫ�� �Ե���Թ��</option>";
print "<option value='MD018 ���ѵ� �ҹ��'>���ѵ� �ҹ��</option>";
print "<option value='MD019 ������ѵ� ������'>������ѵ� ������</option>";
print "<option value='MD020 ˹��ķ�� ����ȹѹ��'>˹��ķ�� ����ȹѹ��</option>";
print "<option value='MD023 �ѹ�ѡ��� �����ѵ��'>�ѹ�ѡ��� �����ѵ��</option>";
print "<option value='MD025 �ؾ���� ����Է�����è��'>�ؾ���� ����Է�����è��</option>";
print "<option value='MD026 ͪ�� ྪô�'>ͪ�� ྪô�</option>";
print "<option value='MD027 ���� ���§��'>���� ���§��</option>";
print "<option value='MD028 ���ô� ���§��'>���ô� ���§��</option>";
print "<option value='MD029 ���� �ʹ����ѡɳ�'>���� �ʹ����ѡɳ�</option>";
print "<option value='MD030 ���͡�� �����Ѿ��'>���͡�� �����Ѿ��</option>";
print "<option value='MD031 �Ѫ��Թ��� ������Ҥ�'>�Ѫ��Թ��� ������Ҥ�</option>";
print "<option value='MD032 �آʶԵ�� ��ѧ��'>�آʶԵ�� ��ѧ��</option>";
print "<option value='MD033 ���ѹ�� ��蹪�'>���ѹ�� ��蹪�</option>";
print "<option value='MD034 ���� �����Թѹ��'>���� �����Թѹ��</option>";
print "<option value='MD035 �ç���ѡ���  �ɮ��ѷá���'> �ç���ѡ���  �ɮ��ѷá���</option>";

print "<option value='MD036 ����Է���  ���ռ��'>����Է���  ���ռ��</option>";

print "<option value='MD037 ��Ծ���  ��շ��ѳ��'>��Ծ���  ��շ��ѳ��</option>";

print "<option value='MD038 �Է���  �����ѵ��'>�Է���  �����ѵ��</option>";

print "<option value='MD039 ���Ծѹ��  ���ҧ���'>���Ծѹ��  ���ҧ���</option>";

print "<option value='MD040 �ѯ�ҡ�  ǧ�����Թ���'>�ѯ�ҡ�  ǧ�����Թ���</option>";

print "<option value='MD041 �����ط�� ǧ��ѹ���'>�����ط�� ǧ��ѹ���</option>";
print "<option value='MD055  ����Թ  ���ǻԧ'>����Թ  ���ǻԧ</option>";
print "<option value='MD056  �ԾԸ  ����ʡ��'> �ԾԸ  ����ʡ��</option>";
print "<option value='MD057  侺����  ������ʧ'> 侺����  ������ʧ</option>";
print "<option value='MD058  ����  �����͹' >����  �����͹</option>";
print "<option value='MD059  ���๵�����  ๵þԹԨ' >���๵�����  ๵þԹԨ</option>";
print "<option value='MD060  ���кص�  �ح��' >���кص�  �ح��</option>";
print "</select></font>";

print "<p><input type='text' name='diag' size='30' value='$cDiag'></p>";

print " <select  name='okopd'>";
//print " <OPTION value='$cOkopd'>";
//print " <option value='$cOkopd' selected>$cOkopd</option>";
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
print "<INPUT TYPE=\"hidden\" Name=\"cVn\" Value=\"".$_GET["cVn"]."\">";
print "</form>";
print "</body>";
?>




    