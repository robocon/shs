<?php
    include("connect.inc");
	$build = array("42"=>"�ͼ�����˭ԧ","44"=>"�ͼ����� ICU","43"=>"�ͼ������ٵ�","45"=>"�ͼ����¾����");

    $query = "SELECT * FROM ipcard WHERE an = '$cAn'";
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
date,dcdate,days,hn,an,icd10,goup,camp, ptname, diag
CREATE TABLE ipcard (
  row_id int(11) NOT NULL auto_increment,
  date datetime default NULL,
  an varchar(12) NOT NULL default '',
  hn varchar(12) NOT NULL default '',
  ptname varchar(30) default NULL,
  age varchar(24) default NULL,
  ptright varchar(32) default NULL,
  goup varchar(24) default NULL,
  camp varchar(24) default NULL,
  bedcode varchar(8) default NULL,
  dcdate datetime default NULL,
  days int(4) default NULL,
  dcstatus varchar(4) default NULL,
  diag varchar(56) default NULL,
  icd10 varchar(20) default NULL,
  comorbid varchar(16) default NULL,
  complica varchar(16) default NULL,
  icd9cm varchar(20) default NULL,
  second varchar(16) default NULL,
  result varchar(16) default NULL,
  dctype varchar(20) default NULL,
  doctor varchar(48) default NULL,
  price double(12,2) default NULL,
  paid double(12,2) default NULL,
  calc datetime default NULL,
  PRIMARY KEY  (row_id),
  KEY an (an)
) TYPE=MyISAM;
*/
   If ($result){
	  $cDate=$row->date;	
        $cHn=$row->hn;
        $cAn= $row->an;
        $cPtname=$row->ptname;
        $cPtright=$row->ptright;
        $cGoup=$row->goup;
        $cCamp=$row->camp;
        $cDiag=$row->diag;
        $cIcd10=$row->icd10;
        $cComorbid=$row->comorbid;
        $cComplica=$row->complica;
	  $cOther=$row->other;
 	  $cExtcause=$row->extcause;
        $cIcd9=$row->icd9cm;
        $cSecond=$row->second;
        $cResult=$row->result;
	  $cDctype=$row->dctype; 
        $cDoctor=$row->doctor;
		$cClinic = $row->clinic;
				$cDcdate = $row->dcdate;
				$cBedcode = $row->bedcode;
                  }  
   else {
      echo "��辺 AN : $cAn";
           }    
include("unconnect.inc");

print "<body bgcolor='#008080' text='#00FFFF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>";
//print "<body bgcolor='##669999' text='#FFFFFF'>";
//print "<form method='POST' action='dxipok.php' target='_BLANK'>";
//print "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
//print "�����੾��  �������ؤ��  �ѧ�Ѵ˹���  ���� ICD �š���ѡ�� ���ʶҹ�Ҿ��˹��� ��ҹ��</p>";

print "  <div align='left'>";
print "    <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "      <tr>";
print "        <td width='8%'></td>";
print "        <td width='24%' valign='top'>HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='hn' size='20' value='$cHn'>";
print "&nbsp;&nbsp;&nbsp;&nbsp;ADMIT&nbsp;&nbsp;<input type='text' name='admdate' size='20' value='$cDate'><br>";

print "          AN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


<input type='text' name='an' size='20' value='$cAn'>";
print "&nbsp;&nbsp;&nbsp;&nbsp;DC&nbsp;&nbsp;<input type='text' name='dcdate' size='20' value='$cDcdate'><br>";
print "          ���ͼ�����&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type='text' name='ptname' size='30' value='$cPtname'>";
print "          bedcode&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".($build[substr($cBedcode,0,2)])."<br>";
print "          �Է�ԡ���ѡ��&nbsp;&nbsp;<input type='text' name='ptright' size='30' value='$cPtright'><br>";
// add
print " �������ؤ��&nbsp; ";
print " <select  name='goup'>";
print " <OPTION value='$cGoup'>";
print " <option value='$cGoup' selected>$cGoup</option>";
print " <option value='0' ><-���͡�������ؤ�-></option>";
print " <option value='G11&nbsp;�.1 ��·��û�Шӡ��'>G11&nbsp;�.1 ��·��û�Шӡ��</option>";
print " <option value='G12&nbsp;�.2 ����Ժ  �ŷ��û�Шӡ��'>G12&nbsp;�.2 ����Ժ  �ŷ��û�Шӡ��</option>";
print " <option value='G13&nbsp;�.3 ����Ҫ��á����������͹'>G13&nbsp;�.3 ����Ҫ��á����������͹</option>";
print " <option value='G14&nbsp;�.4 �١��ҧ��Ш�'>G14&nbsp;�.4 �١��ҧ��Ш�</option>";
print " <option value='G15 &nbsp;�.5 �١��ҧ���Ǥ���'>G15 &nbsp;�.5 �١��ҧ���Ǥ���</option>";
print " <option value='G21&nbsp;�.1 �Ժ��� �ŷ��áͧ��Шӡ��'>G21&nbsp;�.1 �Ժ��� �ŷ��áͧ��Шӡ��</option>";
print " <option value='G22&nbsp;�.2 �ѡ���¹����'>G22&nbsp;�.2 �ѡ���¹����</option>";
print " <option value='G23 &nbsp;�.3 ������Ѥ÷��þ�ҹ'>G23 &nbsp;�.3 ������Ѥ÷��þ�ҹ</option>";
print " <option value='G24 &nbsp;�.4 �ѡ�ɷ���'>G24 &nbsp;�.4 �ѡ�ɷ���</option>";
print " <option value='G31&nbsp;�.1 ��ͺ���Ƿ���'>G31&nbsp;�.1 ��ͺ���Ƿ���</option>";
print " <option value='G32&nbsp;�.2 ���ù͡��Шӡ��'>G32&nbsp;�.2 ���ù͡��Шӡ��</option>";
print " <option value='G33&nbsp;�.3 �ѡ�֡���Ԫҷ���(ô)'>G33&nbsp;�.3 �ѡ�֡���Ԫҷ���(ô)</option>";
print " <option value='G34&nbsp;�.4 ���Ѳ������ͧ'>G34&nbsp;�.4 ���Ѳ������ͧ</option>";
print " <option value='G35&nbsp;�.5 �ѵû�Сѹ�ѧ��'>G35&nbsp;�.5 �ѵû�Сѹ�ѧ��</option>";
print " <option value='G36&nbsp;�.6 �ѵ÷ͧ30�ҷ'>G36&nbsp;�.6 �ѵ÷ͧ30�ҷ</option>";
print " <option value='G37&nbsp;�.7 ����Ҫ��þ����͹(�ԡ���ѧ�Ѵ)'>G37&nbsp;�.7 ����Ҫ��þ����͹(�ԡ���ѧ�Ѵ)</option>";
print " <option value='G38&nbsp;�.8 �����͹(����ԡ���ѧ�Ѵ)'>G38&nbsp;�.8 �����͹(����ԡ���ѧ�Ѵ)</option>";
print " <option value='G39&nbsp;�.9 ��������к�'>G39&nbsp;�.9 ��������к�</option>";

print "   </select>";
print " <br>�ѧ�Ѵ˹���&nbsp;&nbsp;&nbsp;";

print " <select  name='camp'>";
print " <OPTION value='$cCamp'>";
print " <option value='$cCamp' selected>$cCamp</option>";
print " <option value='0' ><-���͡�ѧ�Ѵ-></option>";
print " <option value='M01&nbsp; �����͹' >M01&nbsp; �����͹</option>";
print " <option value='M02&nbsp; �.17 �ѹ2' >M02&nbsp; �.17 �ѹ2</option>";
print " <option value='M03&nbsp; ���ŷ��ú����32' >M03&nbsp; ���ŷ��ú����32</option>";
print " <option value='M04&nbsp; �.�.��������ѡ�������' >M04&nbsp; �.�.��������ѡ�������</option>";
print " <option value='M05&nbsp; �.�ѹ4' >M05&nbsp; �.�ѹ4</option>";
print " <option value='M06&nbsp;���½֡ú����ɻ�еټ�' >M06&nbsp;���½֡ú����ɻ�еټ�</option>";
print " <option value='M07&nbsp; ˹��·�������' >M07&nbsp; ˹��·�������</option>";
print "   </select>";
print "   </font></p>";

//print "          <a target=_TOP href='goup.htm'>�������ؤ��</a>&nbsp;&nbsp;<input type='text' name='goup' size='20' value='$cGoup'><br>";
//print "          <a target=_TOP href='camp.htm'>�ѧ�Ѵ˹���</a>&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='camp' size='20' value='$cCamp'><br>";

print "  �ԹԨ����ä&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='diag' size='30' value='$cDiag'><br>";
print "  ��չԡ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select  name='clinic'>
<option value='$cClinic' selected>$cClinic</option>
<option value='00' >--���͡��չԡ--</option>
<option value='01 ����á���'>����á���</option>
<option value='02 ���¡���'>���¡���</option>
<option value='03 �ٵԡ���'>�ٵԡ���</option>
<option value='04 �����Ǫ����'>�����Ǫ����</option>
<option value='05 ������Ǫ'>������Ǫ</option>
<option value='06 �ʵ �� ���ԡ'>�ʵ �� ���ԡ</option>
<option value='07 �ѡ��'>�ѡ��</option>
<option value='08 ���¡�����д١'>���¡�����дء</option>
<option value='09 �Ե�Ǫ'>�Ե�Ǫ</option>
<option value='10 �ѧ���Է��'>�ѧ���Է��</option>
<option value='11 �ѹ�����'>�ѹ�����</option>
<option value='12 ����'>����</option>
  </select><br></td>";
print "      </tr>";
print "    </table>";
print "  </div>";
print "  <div align='left'>";
print "    <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "      <tr>";
print "        <td width='6%'></td>";
print "        <td width='38%' valign='top'><b>ICD10 (diagnosis)&nbsp;</b><br>";
//print "          <br>";
print "          principle :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type='text' name='icd10' size='15' value='$cIcd10'><br>";
//print "          <br>";
print "          comorbidity&nbsp;&nbsp;&nbsp; <input type='text' name='comorbid' size='15' value='$cComorbid'><br>";
print "          complication&nbsp;&nbsp;&nbsp;<input type='text' name='complica' size='15' value='$cComplica'><br>";

print "          other&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='other' size='15' value='$cOther'><br>";
print "          external cause&nbsp;<input type='text' name='extcause' size='15' value='$cExtcause'></td>";


print "        <td width='33%' valign='top'><b>ICD9CM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>�ѹ���(01/01/2549)<br>";

print "          <input type='text' name='icd9cm1' size='15'>&nbsp<input type='text' name='icddate1' size='20'><br>";
print "          <input type='text' name='icd9cm2' size='15'>&nbsp<input type='text' name='icddate2' size='20'><br>";
print "          <input type='text' name='icd9cm3' size='15'>&nbsp<input type='text' name='icddate3' size='20'><br>";
print "          <input type='text' name='icd9cm4' size='15'>&nbsp<input type='text' name='icddate4' size='20'><br>";
print "          <input type='text' name='icd9cm5' size='15'>&nbsp<input type='text' name='icddate5' size='20'><br>";
print "          <input type='text' name='icd9cm6' size='15'>&nbsp<input type='text' name='icddate6' size='20'></td>";

print "      </tr>";
print "    </table>";
print "  </div>";
print "  <div align='left'>";
print "    <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "      <tr>";
print "        <td width='8%'></td>";
print "        <td width='24%'>�š���ѡ��<br>";
print "        ʶҹ�Ҿ��˹���<br>";

print "          ᾷ��</td>";

  print "<td width='68%' valign='top'><select  name='result'>";
  print " <OPTION value='$cResult'>";
 print "<option value='$cResult' selected>$cResult</option>";
 print " <option value='0' ><-���͡-></option>";
  print "<option value='complete recovery'>complete recovery</option>";
  print "<option value='improved'>improved</option>";
  print "<option value='not improved'>not improved</option>";
  print "<option value='dead'>dead</option>";
  print "</select><br>";

//print " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' value='       &#3605;&#3585;&#3621;&#3591;       ' name='B1'>&nbsp;&nbsp;&nbsp;&nbsp;";
//print " <input type='reset' value='   &#3621;&#3610;&#3607;&#3636;&#3657;&#3591;   ' name='B2'><br>";

  print "<select  name='dctype'>";
 print " <OPTION value='$cDctype'>";
  print "<option value='$cDctype' selected>$cDctype</option>";
 print " <option value='0' ><-���͡-></option>";
  print "<option value='with approval'>with approval</option>";
  print "<option value='against advice'>against advice</option>";
  print "<option value='by escape'>by escape</option>";
  print "<option value='by transfer'>by transfer</option>";
  print "<option value='other'>other</option>";
  print "<option value='dead'>dead</option>";
  print "</select><br>";

print "          <input type='text' name='doctor' size='30' value='$cDoctor'></td>";
print "      </tr>";
print "    </table>";

print "  </div>";
print "  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </p>";
print "</form>";
print "</body>";
?>


    