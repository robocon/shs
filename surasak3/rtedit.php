<?php
//    session_start();
//    $cHn="";
    $cPtname="";
    $cPtright="";    
    $nVn="";

    session_register("cHn");  
    session_register("cPtname");
    session_register("cPtright");
    session_register("nVn");  
    include("connect.inc");

    $query = "SELECT * FROM opcard WHERE hn = '$cHn'";
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
//	$cRegisdate=$row->regisdate;
	$cIdcard =$row->idcard;
	$cHn =$row->hn;
	$cYot=$row->yot;
	$cName=$row->name;
	$cSurname =$row->surname;
	$cGoup =$row->goup;
	$cMarried =$row->married;
//	$cCbirth (�ѹ�Դ��ͤ���������)
	$cCbirth = $row->cbirth;  // (�ѹ�Դ��ͤ���������)
	$cDbirth =$row->dbirth;
	$cGuardian=$row->guardian;
	$cIdguard=$row->idguard;
	$cNation =$row->nation;
	$cReligion =$row->religion;
	$cCareer =$row->career;
	$cPtright =$row->ptright;
	$cAddress =$row->address;
	$cTambol =$row->tambol;
	$cAmpur =$row->ampur;
	$cChangwat =$row->changwat;
	$cPhone =$row->phone;
	$cFather =$row->father;
	$cMother =$row->mother;
	$cCouple =$row->couple;
	$cNote=$row->note;
	$cSex =$row->sex;
	$cCamp =$row->camp;
	$cRace=$row->race;
//  2494-05-28
    $cD=substr($cDbirth,8,2);
    $cM=substr($cDbirth,5,2); 
    $cY=substr($cDbirth,0,4); 
                  }  
   else {
      echo "��辺 HN : $cHn ";
           }    
include("unconnect.inc");

print "<body bgcolor='#808080' text='#FFFFFF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>";
print "<form method='POST' action='rteditok.php' target='_BLANK'>";

print "  <table border='0' cellpadding='0' cellspacing='0' width='100%' height='367'>";
print "    <tr>";
print "      <td width='1%' height='367'></td>";
print "      <td width='99%' height='367'>";
print "   <p>&nbsp;&nbsp;<font face='Angsana New'>�ѹ�Դ&nbsp;$cCbirth&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>��Ǩ�ͺ��䢢����ŷӺѵõ�Ǩ�ä</b></font></p>";
print "    <p><font face='Angsana New'>&nbsp;&nbsp;&nbsp; ��&nbsp;&nbsp; <input type='text' name='yot' size='5' value='$cYot'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  ����&nbsp; <input type='text' name='name' size='15' value='$cName'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  ʡ��&nbsp; <input type='text' name='surname' size='15' value='$cSurname'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

print " ��&nbsp;"; 
print " <select name='sex'>";
print " <OPTION value='$cSex'>";
print " <option value='$cSex' selected> $cSex </option>";
print " <option value='0' ><-���͡-></option>";
print " <option value='�' >�</option>";
print " <option value='�' >�</option>";
print "</select>";

print "    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; �Ţ�ѵ�";
print "    ���. <input type='text' name='idcard' size='15' value='$cIdcard'></font></p>";
print "  <p><font face='Angsana New'>&nbsp;&nbsp; �ѹ�Դ&nbsp;<input type='text' name='d' size='2' value='$cD' maxlength='2'><input type='text' name='m' size='2' value='$cM' maxlength='2'><input type='text' name='y' size='4' value='$cY' maxlength='4'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

print "���ͪҵ�&nbsp;";
print " <select  name='race'>";
print " <OPTION value='$cRace'>";
print " <option value='$cRace' selected>$cRace</option>";
print " <option value='0' ><-���͡-></option>";
print " <option value='��'>��</option>";
print " <option value='�չ'>�չ</option>";
print " <option value='���'>���</option>";
print " <option value='����'>����</option>";
print " <option value='����٪�'>����٪�</option>";
print " <option value='�Թ���'>�Թ���</option>";
print " <option value='���´���'>���´���</option>";
print " <option value='����'>����</option>";
print "   </select>";

print "    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�ѭ�ҵ�&nbsp;&nbsp; ";
print " <select  name='nation'>";
print " <OPTION value='$cNation'>";
print " <option value='$cNation' selected>$cNation</option>";
print " <option value='0' ><-���͡-></option>";
print " <option value='��'>��</option>";
print " <option value='�չ'>�չ</option>";
print " <option value='���'>���</option>";
print " <option value='����'>����</option>";
print " <option value='����٪�'>����٪�</option>";
print " <option value='�Թ���'>�Թ���</option>";
print " <option value='���´���'>���´���</option>";
print " <option value='����'>����</option>";
print "   </select>";
print "   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

print "  ��ʹ�&nbsp; ";
print " <select  name='religion'>";
print " <OPTION value='$cReligion'>";
print " <option value='$cReligion' selected>$cReligion</option>";
print " <option value='0' ><-���͡-></option>";
print " <option value='�ط�'>�ط�</option>";
print " <option value='���ʵ�'>���ʵ�</option>";
print " <option value='������'>������</option>";
print " <option value='����'>����</option>";
print "   </select>";

print "  &nbsp;&nbsp;&nbsp;&nbsp;ʶҹ�Ҿ&nbsp;";
print " <select  name='married'>";
print " <OPTION value='$cMarried'>";
print " <option value='$cMarried' selected>$cMarried</option>";
print " <option value='0' ><-���͡-></option>";
print " <option value='�ʴ'>�ʴ</option>";
print " <option value='����'>����</option>";
print " <option value='�����/����'>�����/����</option>";
print " <option value='����'>����</option>";
print "   </select>";
print "  </font></p>";

print "    <p><font face='Angsana New'>&nbsp;&nbsp;�Ҫվ&nbsp; ";
print " <select  name='career'>";
print " <OPTION value='$cCareer'>";
print " <option value='$cCareer' selected>$cCareer</option>";
print " <option value='0' ><-���͡-></option>";
print " <option value='01&nbsp;&nbsp; �ɵá�'>01&nbsp;&nbsp; �ɵá�</option>";
 print " <option value='02&nbsp;&nbsp; �Ѻ��ҧ�����'>02&nbsp;&nbsp; �Ѻ��ҧ�����</option>";
print " <option value='03&nbsp;&nbsp; ��ҧ�����'>03&nbsp;&nbsp; ��ҧ�����'</option>";
print " <option value='04&nbsp;&nbsp; ��áԨ'>04&nbsp;&nbsp; ��áԨ</option>";
print " <option value='05&nbsp;&nbsp; ����/���Ǩ'>05&nbsp;&nbsp; ����/���Ǩ</option>";
print " <option value='06&nbsp;&nbsp; �ѡ�Է���ҵ����йѡ෤�ԡ'>06&nbsp;&nbsp; �ѡ�Է���ҵ����йѡ෤�ԡ</option>";
print " <option value='07&nbsp;&nbsp; �ؤ�ҡô�ҹ�Ҹ�ó�آ'>07&nbsp;&nbsp; �ؤ�ҡô�ҹ�Ҹ�ó�آ</option>";
print " <option value='08&nbsp;&nbsp; �ѡ�ԪҪվ/�ѡ�Ԫҡ��'>08&nbsp;&nbsp; �ѡ�ԪҪվ/�ѡ�Ԫҡ��</option>";
print " <option value='09&nbsp;&nbsp; ����Ҫ��÷����'>09&nbsp;&nbsp; ����Ҫ��÷����</option>";
print " <option value='10&nbsp;&nbsp; �Ѱ����ˡԨ'>10&nbsp;&nbsp; �Ѱ����ˡԨ</option>";
print " <option value='11&nbsp;&nbsp; ��������������Ҫվ'>11&nbsp;&nbsp; ��������������Ҫվ</option>";
print " <option value='12&nbsp;&nbsp; �ѡ�Ǫ/�ҹ��ҹ��ʹ�'>12&nbsp;&nbsp; �ѡ�Ǫ/�ҹ��ҹ��ʹ�</option>";
print " <option value='13&nbsp;&nbsp; ����'>13&nbsp;&nbsp; ����</option>";
print "   </select>";

print "    &nbsp;&nbsp;&nbsp;������&nbsp; ";
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
print "  &nbsp;&nbsp;&nbsp;�ѧ�Ѵ&nbsp; ";

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

print "  <p><font face='Angsana New'>&nbsp;&nbsp;&nbsp; �������&nbsp; <input type='text' name='address' size='20' value='$cAddress'>&nbsp;&nbsp;";
print "  &nbsp;&nbsp;�Ӻ�&nbsp; <input type='text' name='tambol' size='10' value='$cTambol'>&nbsp;&nbsp;";
print "  &nbsp;&nbsp;�����&nbsp; <input type='text' name='ampur' size='10' value='$cAmpur'>&nbsp;&nbsp;";
print "  &nbsp;&nbsp;";
print "  �ѧ��Ѵ&nbsp; <input type='text' name='changwat' size='10' value='$cChangwat'>&nbsp;&nbsp;&nbsp;&nbsp;";
print "  ��. <input type='text' name='phone' size='12' value='$cPhone'></font></p>";
print "  <p><font face='Angsana New'>&nbsp;&nbsp;&nbsp; ���ͺԴ�&nbsp;&nbsp;";
print "  <input type='text' name='father' size='20' value='$cFather'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  &nbsp;&nbsp;&nbsp;&nbsp;������ô�&nbsp;&nbsp; <input type='text' name='mother' size='20' value='$cMother'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  &nbsp;&nbsp;&nbsp; ���ͤ������&nbsp;&nbsp;&nbsp; <input type='text' name='couple' size='20' value='$cCouple'></font></p>";

print "  <p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;�Է�ԡ���ѡ��&nbsp;";
print " <select  name='ptright'>";
print " <OPTION value='$cPtright'>";
print " <option value='$cPtright' selected>$cPtright</option>";
print " <option value='0' ><-���͡�Է�ԡ���ѡ��-></option>";
print " <option value='R01&nbsp;�Թʴ' >R01&nbsp;�Թʴ</option>";
print " <option value='R02&nbsp;�ԡ��ѧ�ѧ��Ѵ' >R02&nbsp;�ԡ��ѧ�ѧ��Ѵ</option>";
print " <option value='R03&nbsp;�Ѱ����ˡԨ' >R03&nbsp;�Ѱ����ˡԨ</option>";
print " <option value='R04&nbsp;�.�.�.������ͧ�����ʺ��¨ҡö' >R04&nbsp;�.�.�.������ͧ�����ʺ��¨ҡö</option>";
print " <option value='R05&nbsp;��Сѹ�ѧ��' >R05&nbsp;��Сѹ�ѧ��</option>";
print " <option value='R06&nbsp;��Сѹ�آ�Ҿ��ǹ˹��(30�ҷ)' >R06&nbsp;��Сѹ�آ�Ҿ��ǹ˹��(30�ҷ)</option>";
print " <option value='R07&nbsp;�.�.44(�Ҵ��㹧ҹ)' >R07&nbsp;�.�.44(�Ҵ��㹧ҹ)</option>";
print " <option value='R08&nbsp;��Сѹ�آ�Ҿ�ѡ���¹(����ѷ)' >R08&nbsp;��Сѹ�آ�Ҿ�ѡ���¹(����ѷ)</option>";
print " <option value='R09&nbsp;�֡�Ҹԡ��(����͡��)' >R09&nbsp;�֡�Ҹԡ��(����͡��)</option>";
print " <option value='R10&nbsp;�ŷ���' >R09&nbsp;�ŷ���</option>";
print "   </select>";

print "  &nbsp;&nbsp;&nbsp;&nbsp;������Է���ԡ&nbsp; <input type='text' name='guardian' size='15' value='$cGuardian'>&nbsp;&nbsp;";
print "  &nbsp;&nbsp;";
print "  �Ţ�ѵ� ���.&nbsp; <input type='text' name='idguard' size='15' value='$cIdguard'></font></p>";
print "  <p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;";
print "  �����˵�&nbsp;&nbsp;&nbsp; <input type='text' name='note' size='50' value='$cNote'></font>";
print "  &nbsp;&nbsp;";
print "  <input type='submit' value='   �ѹ�֡   ' name='B1'>&nbsp;&nbsp;";
print "  <input type='reset' value=' ź��� ' name='B2'>&nbsp;";
print "  <a target=_self  href='../nindex.htm'><-�����</a>";
print "    </td>";
print "    </tr>";
print "  </table>";
print "</form";
print "</body>";

?>