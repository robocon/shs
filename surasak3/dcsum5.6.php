<SCRIPT LANGUAGE="JavaScript">

window.onload = function(){
	window.print();
}
</SCRIPT>
<?php

session_start();
    $Thaidate=date("d-m-").(date("Y")+543);
$Thaitime=date("H:i");
	Function calcage($birth){
      $today = getdate();   
      $nY  = $today['year']; 
      $nM = $today['mon'] ;
      $bY=substr($birth,0,4)-543;
      $bM=substr($birth,5,2);
      $ageY=$nY-$bY;
      $ageM=$nM-$bM;
       if ($ageM<0) {
           $ageY=$ageY-1;
           $ageM=12+$ageM;
                    }
      if ($ageM==0){
           $pAge="$ageY ��";
             }
      else{
            $pAge="$ageY �� $ageM ��͹";
                        }
      return $pAge;
          }
   
    include("connect.inc");

     $query = "SELECT ipcard.an,ipcard.hn,ipcard.date,ipcard.bedcode,opcard.yot,opcard.name,opcard.surname,opcard.idcard,opcard.ptright,opcard.dbirth,opcard.sex,opcard.address,opcard.tambol,opcard.ampur,opcard.changwat,opcard.phone,opcard.ptf,opcard.ptfadd,opcard.ptffone FROM ipcard LEFT JOIN opcard ON ipcard.hn=opcard.hn WHERE an = '$Can'";
    $result = mysql_query($query)or die("Query failed");
    while (list ($an,$hn,$date,$bedcode,$yot,$name,$surname,$idcard,$ptright,$dbirth,$sex,$address,$tambol,$ampur,$changwat,$phone,$ptf,$ptfadd,$ptffone) = mysql_fetch_row ($result)) {


  $d=substr($dbirth,8,2);
    $m=substr($dbirth,5,2); 
    $y=substr($dbirth,0,4); 
    $birthdate="$d-$m-$y"; //print into opdcard
    $cAge=calcage($dbirth);
    $cPtname=$yot.' '.$name.' '.$surname;




//print opd card ����� �ҡ opdcardprn.htm  by frontpage

print "<HTML>";

print "<script>";

 print "ie4up=nav4up=false;";

 print "var agt = navigator.userAgent.toLowerCase();";

 print "var major = parseInt(navigator.appVersion);";

 print "if ((agt.indexOf('msie') != -1) && (major >= 4))";

   print "ie4up = true;";

 print "if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))";

   print "nav4up = true;";

print "</script>";



print "<head>";

print "<STYLE>";

 print "A {text-decoration:none}";

 print "A IMG {border-style:none; border-width:0;}";

 print "DIV {position:absolute; z-index:25;}";

print ".fc1-0 { COLOR:000000;FONT-SIZE:23PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

print ".fc1-1 { COLOR:000000;FONT-SIZE:19PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

print ".fc1-2 { COLOR:000000;FONT-SIZE:14PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-3 { COLOR:000000;FONT-SIZE:13PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print "</STYLE>";



print "<TITLE>Crystal Report Viewer</TITLE>";

print "</head>";

print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";

//print "<DIV style='z-index:0'> &nbsp; </div>";
//print "<DIV style='left:100PX;top:110PX;width:200PX;height:30PX;'><span class='fc1-0'>AN:$an</span></DIV>";
//print "<DIV style='left:230PX;top:110PX;width:200PX;height:30PX;'><span class='fc1-0'>HN:$hn</span></DIV>";
//print "<DIV style='left:380PX;top:110PX;width:600PX;height:30PX;'><span class='fc1-0'>����-ʡ��:$cPtname </span></DIV>";

print "<center><font face='Angsana New' face='Angsana New' size='3' >��������йӷ���ٹ�������� <b>�Է����ԡ&nbsp;�ú</b></font><br>";
print "<font face='Angsana New' size='3' >�ç��Һ�Ť�������ѡ��������</font><br>";
print "<font face='Angsana New' size='2' >�ͧ/Ἱ�/��ǹ �ٹ��������&nbsp;�ͧ��Ǩ�ä�����¹͡ �͡��������Ţ FR-IPC001/6,04,1 ,.8. 56</font><br>";
print "<font face='Angsana New' size='1' >***************************************</font><br></center>";

print "<font face='Angsana New' size='4' >���ͼ�����&nbsp;$cPtname&nbsp;HN:$hn&nbsp;<b>AN:$an</b>&nbsp;ADMIT:$date</font><br>";
print "<font face='Angsana New' size='2' >�Է��������&nbsp;$ptright</font><br>";
print "<font face='Angsana New' size='4' >�͡��÷������µ�ͧ�����</font><br>";
print "<font face='Angsana New' size='2' ><input type='checkbox' >���Һѵû�Шӵ�ǻ�ЪҪ�������ҷ���¹��ҹ��Ңͧö</font><br>";
print "<font face='Angsana New' size='2' ><input type='checkbox' >���Һѵû�Шӵ�ǻ�ЪҪ�������ҷ���¹��ҹ������</font><br>";
print "<font face='Angsana New' size='2' ><input type='checkbox' >�ѹ�֡��Ш��ѹ</font>&nbsp;";
print "<font face='Angsana New' size='2' ><input type='checkbox' >���Ҥ�����ö</font>&nbsp;";
print "<font face='Angsana New' size='2' ><input type='checkbox' >���� �ú</font><br>";
print "<font face='Angsana New' size='2' ><input type='checkbox' >�ѵû�Шӵ�ǻ�ЪҪ���Ǩ�ԧ�����Ἱ�����¹</font><br>";
print "<font face='Angsana New' size='4' >��äԴ��Һ�ԡ�âͧ�ç��Һ��</font><br>";
print "<font face='Angsana New' size='3' ><input type='checkbox' >�Դ�����ͧ�������õ���ѹ&nbsp;�Ҥҵ���ѹ<input type='checkbox' >��ͧ���ѭ 400 �ҷ&nbsp;<input type='checkbox' >��ͧ����� (<input type='checkbox' >1000/<input type='checkbox' >1200/<input type='checkbox' >1600) �ҷ</font><br>";
print "<font face='Angsana New' size='3' ><input type='checkbox' >�����ͧ��ǹ�Թ(�Է����ԡ����ͧ���ѭ) �ӹǹ....................../�׹</font><br>";
print "<font face='Angsana New' size='3' ><input type='checkbox' ><b>�����·��͹��ͧ����� ��ͧ�խҵ���� 24 �������</b> ............................................�Ѻ��Һ</font><br>";

print "<font face='Angsana New' size='3' ><input type='checkbox' >����� ����Ǫ�ѳ�� ��Һ�ԡ�� ������ǹ����ԡ�����ҡ�Է�Ի�Сѹ�آ�Ҿ��ǹ˹��</font><br>";
print "<font face='Angsana New' size='3' ><input type='checkbox' >��ػ����������ǹ����ԡ�����������¡�纷ء�ѹ�ظ</font><br>";
print "<br>";
print "<font face='Angsana New' size='3' ><center>����¹..................................................&nbsp;����Ѻ��÷��ǹ..................................................</center></font><br>";
print "<font face='Angsana New' size='3' ><center>��ǹ���Թ�����..................................................&nbsp;����Ѻ��÷��ǹ..................................................</center></font>";







 }
include("unconnect.inc");

//end opdcard
?>




