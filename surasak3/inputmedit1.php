<?php
    include("connect.inc");

    $query = "SELECT  idname,name,menucode,pword FROM inputm WHERE idname = '$idname'";
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
        $idname=$row->idname;
   $name=$row->name;
        $menucode=$row->menucode;
  $pword=$row->pword;
                  }  
   else {
      echo "��辺 ���� : $idname ";
           }    
include("unconnect.inc");

print "<body bgcolor='#808080' text='#FFFFFF'>";
print "<form method='POST' action='inputmupdate.php' target='_BLANK'>";
print "<table border='0' width='100%' height='345'>";
print "<tr>";
print " <td width='7%' height='21'></td>";
print "  <td width='48%' height='21'>";
print "  <p align='center'><b>'��䢢����ż����ҹ;</b>&nbsp;&nbsp;</td>";
print "  <td width='45%' height='21'><b>&#3650;&#3611;&#3619;&#3604;&#3607;&#3635;&#3604;&#3657;&#3623;&#3618;&#3588;&#3623;&#3634;&#3617;&#3619;&#3632;&#3617;&#3633;&#3604;&#3619;&#3632;&#3623;&#3633;&#3591;</b></td>";
print " </tr>";
print " <tr>";
print " login ";
print "   <input type='text' name='idname' size='20' tabindex='5'value=$idname><br>";
print " �����ӡ������¹ login ��ҵ�ͧ�������¹���ź��������������� ";
print " <td width='7%' height='236'></td>";
print " ����-ʡ��";
print "   <input type='text' name='name' size='30' tabindex='5'value=$name><br>";
print " Ἱ�";
print "   <input type='text' name='menucode' size='20' tabindex='5'value=$menucode><br>";
print " ���ʼ�ҹ";
print "   <input type='text' name='pword' size='20' tabindex='5'value=$pword><br>";

print " ";
print " ";
print " Ἱ�";
print " *admin	ADM	**
��ͧ����Ҿ	ADMPT	**
��ͧ��ҵѴ	ADMSUR	**
admin��	ADMPHA	**
��ͧ������	ADMPHARX	**
�����	ADMHEM	**
����Թ	ADMMON	**
�ء�Թ	ADMER	**
��ͧ�͡������	ADMXR	**
��Ҹ�	ADMLAB	**
����¹	ADMOPD	**
�ѹ�����	ADMDEN	**
�ͼ�����	ADMWM	**
�ç�����	ADMFOD	**
ʶԵ�	ADMSTD	**


";
print "  <input type='submit' value='   &#3605;&#3585;&#3621;&#3591;   ' name='B1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "    <input type='reset' value='  &#3621;&#3610;&#3607;&#3636;&#3657;&#3591;  ' name='B2'></td>";
print "     <td width='45%' height='76'></td>";
print "    </tr>";
print " </table>";
print "</form>";
print "</body>";

?>




    