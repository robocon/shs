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

     $query = "SELECT ipcard.an,ipcard.hn,ipcard.date,ipcard.bedcode,opcard.yot,opcard.name,opcard.surname,opcard.idcard,opcard.ptright,opcard.dbirth,opcard.sex,opcard.address,opcard.tambol,opcard.ampur,opcard.changwat,opcard.phone,opcard.ptf,opcard.ptfadd,opcard.ptffone, ipcard.my_ward, ipcard.my_bedcode, ipcard.my_earnest, ipcard.my_confirmbk, ipcard.my_food, ipcard.my_cure, ipcard.my_etc, ipcard.my_blood,ipcard.date,ipcard.ptright,opcard.note FROM ipcard LEFT JOIN opcard ON ipcard.hn=opcard.hn WHERE an = '$Can'";
    $result = mysql_query($query)or die("Query failed");
    while (list ($an,$hn,$date,$bedcode,$yot,$name,$surname,$idcard,$ptright,$dbirth,$sex,$address,$tambol,$ampur,$changwat,$phone,$ptf,$ptfadd,$ptffone,$my_ward, $my_bedcode, $my_earnest, $my_confirmbk, $my_food, $my_cure, $my_etc, $my_blood,$date,$ptright1,$note ) = mysql_fetch_row ($result)) {


  $d=substr($dbirth,8,2);
    $m=substr($dbirth,5,2); 
    $y=substr($dbirth,0,4); 
    $birthdate="$d-$m-$y"; //print into opdcard
    $cAge=calcage($dbirth);
    $cPtname=$yot.' '.$name.' '.$surname;
if($sex=='�'){$sex1='���';}
else {$sex1='˭ԧ';}

$cIdcard1=substr($idcard,0,1);
$cIdcard2=substr($idcard,1,4);
$cIdcard3=substr($idcard,5,5);
$cIdcard4=substr($idcard,10,2);
$cIdcard5=substr($idcard,12,1);
$idcard13=$cIdcard1."-".$cIdcard2."-".$cIdcard3."-".$cIdcard4."-".$cIdcard5;

 $d1=substr($date,8,2);
    $m1=substr($date,5,2); 
    $y1=substr($date,0,4); 
	$time1=substr($date,11,8); 
    $date="$d1-$m1-$y1&nbsp;$time1"; 

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

print ".fc1-0 { COLOR:000000;FONT-SIZE:30PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

print ".fc1-1 { COLOR:000000;FONT-SIZE:20PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

print ".fc1-2 { COLOR:000000;FONT-SIZE:20PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-3 { COLOR:000000;FONT-SIZE:17PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

	print ".fc1-4 { COLOR:000000;FONT-SIZE:18PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print "</STYLE>";



print "<TITLE>Crystal Report Viewer</TITLE>";

print "</head>";

print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";

print "<DIV style='z-index:0'> &nbsp; </div>";
//print "<DIV style='left:500PX;top:190PX;width:600PX;height:30PX;'><span class='fc1-1'>�ͼ�����:&nbsp;&nbsp;$bed</span></DIV>";


print "<DIV style='left:170PX;top:20PX;width:600PX;height:30PX;'><span class='fc1-0'>㺢����ż����¹͹�ç��Һ��</span></DIV>";

print "<DIV style='left:200PX;top:70PX;width:600PX;height:30PX;'><span class='fc1-2'>�ç��Һ�Ť�������ѡ�������� �ӻҧ</span></DIV>";
print "<DIV style='left:60PX;top:100PX;width:800PX;height:30PX;'><span class='fc1-3'>��ǹ���Թ����� �͡��������Ţ FR-CAS-002/4 ��䢤��駷�� 01 �ѹ����ռźѧ�Ѻ�� &nbsp;11 �Զع�¹ 2552</span></DIV>";
print "<DIV style='left:210PX;top:130PX;width:800PX;height:30PX;'><span class='fc1-3'>********************************************</span></DIV>";

print "<DIV style='left:60PX;top:160PX;width:800PX;height:30PX;'><span class='fc1-2'>�ͼ������Ѻ...".$my_ward."....��§/��ͧ..".$my_bedcode."..&nbsp;&nbsp;�ͼ����¨�˹���...................��§/��ͧ..............</span></DIV>";
//print "<DIV style='left:60PX;top:200PX;width:800PX;height:30PX;'><span class='fc1-4'>�ѹ����Ѻ...$Thaidate&nbsp;����:&nbsp;$Thaitime...�ѹ����˹���.......................����...........����ѡ��...........�ѹ</span></DIV>";
print "<DIV style='left:60PX;top:200PX;width:800PX;height:30PX;'><span class='fc1-4'>�ѹ����Ѻ...$date...�ѹ����˹���.......................����...........����ѡ��...........�ѹ</span></DIV>";
print "<DIV style='left:60PX;top:280PX;width:800PX;height:30PX;'><span class='fc1-2'>����-ʡ��.........$cPtname...........</span></DIV>";
print "<DIV style='left:440PX;top:280PX;width:800PX;height:30PX;'><span class='fc1-1'>����....$cAge... </span></DIV>";
print "<DIV style='left:60PX;top:330PX;width:800PX;height:30PX;'><span class='fc1-1'>�ѹ ��͹ ���Դ ....$d-$m-$y..... �Ţ��Шӵ�ǻ�ЪҪ�......$idcard13..... </span></DIV>";
print "<DIV style='left:60PX;top:380PX;width:800PX;height:30PX;'><span class='fc1-3'>�������..��ҹ�Ţ���$address&nbsp;�Ӻ�$tambol&nbsp;�����$ampur&nbsp;�ѧ��Ѵ$changwat �� $phone</span></DIV>";
print "<DIV style='left:60PX;top:430PX;width:800PX;height:30PX;'><span class='fc1-1'>�����Դ�����.....&nbsp;$ptf ����Ǣ�ͧ�� :&nbsp;$ptfadd ���Ѿ�� :&nbsp;$ptffone</span></DIV>";
print "<DIV style='left:60PX;top:460PX;width:800PX;height:30PX;'><span class='fc1-1'>�����˵�&nbsp;$note</span></DIV>";
print "<DIV style='left:60PX;top:500PX;width:800PX;height:30PX;'><span class='fc1-2'>�Ţ�������......$hn.......�Ţ�������......$an...... </span></DIV>";
print "<DIV style='left:520PX;top:500PX;width:800PX;height:30PX;'><span class='fc1-1'>���˹ѡ���...".$_GET["weight"]."...�� </span></DIV>";

print "<DIV style='left:60PX;top:550PX;width:800PX;height:30PX;'><span class='fc1-1'>�ѧ�Ѵ..............................................�ä................................................(������)</span></DIV>";

print "<DIV style='left:60PX;top:630PX;width:800PX;height:30PX;'><span class='fc1-2'>�Է�ԡ���ѡ��...$ptright1..&nbsp;&nbsp;�ҧ����Ѵ��....".$my_earnest."....�ҷ</span></DIV>";
print "<DIV style='left:90PX;top:670PX;width:800PX;height:30PX;'><span class='fc1-3'>˹ѧ����Ѻ�ͧ�Է��� &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;   ..".($my_confirmbk=='������' ? "<img src = '..\check.gif'>":""  ).".. ������  &nbsp;&nbsp;      ..".($my_confirmbk=='�ѧ�����' ? "<img src = '..\check.gif'>":""  ).".. �ѧ�����  &nbsp;&nbsp;  ..".($my_confirmbk=='�͡���¤���������' ? "<img src = '..\check.gif'>":""  )."..  �͡���¤���������  &nbsp;&nbsp;  ..".($my_confirmbk=='�����' ? "<img src = '..\check.gif'>":""  )."..  �����</span></DIV>";
print "<DIV style='left:90PX;top:710PX;width:800PX;height:30PX;'><span class='fc1-3'>�����ͧ������������Թ�ѹ��...........".$my_food.".............�ҷ&nbsp;(����Է�ԡ���ѡ��)</span></DIV>";
print "<DIV style='left:90PX;top:750PX;width:800PX;height:30PX;'><span class='fc1-3'>����ѡ�Ҿ�Һ������Թ������.........".$my_cure."..........�ҷ&nbsp;(����Է�ԡ���ѡ��)</span></DIV>";
print "<DIV style='left:90PX;top:790PX;width:800PX;height:30PX;'><span class='fc1-3'>����������������Թ�ѹ��...............".$my_etc.".............�ҷ&nbsp;(����Է�ԡ���ѡ��)</span></DIV>";
print "<DIV style='left:90PX;top:830PX;width:800PX;height:30PX;'><span class='fc1-3'>�͡���Ե��������ͧ�����..........".$my_blood.".........����</span></DIV>";


print "<DIV style='left:60PX;top:880PX;width:800PX;height:30PX;'><span class='fc1-2'>�͹��ͧ��� (400)..............�ѹ ��ͧ����� (1000)..............�ѹ ��ͧ ICU............. �ѹ</span></DIV>";
print "<DIV style='left:60PX;top:910PX;width:800PX;height:30PX;'><span class='fc1-2'>��ͧ����� (1200)......................�ѹ ��ͧ����� (1600)........................�ѹ</span></DIV>";
print "<DIV style='left:60PX;top:940PX;width:800PX;height:30PX;'><span class='fc1-2'>����ѹ�͹......................�ѹ&nbsp;&nbsp;&nbsp;&nbsp;�����ͧ��ǹ�Թ........................................�ҷ</span></DIV>";

print "<DIV style='left:60PX;top:980PX;width:800PX;height:30PX;'><span class='fc1-3'>����Ѻ����...........................����˹���..................................���Դ�Ҥ���................................</span></DIV>";









 }
include("unconnect.inc");

//end opdcard
?>




