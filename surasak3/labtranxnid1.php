<?php
session_start();
if (!isset($sIdname)){ exit(); } //for security
$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
$Thaidate = date("d-m-").(date("Y")+543)."  ".date("H:i:s");

if($cPtname == "" || $cHn == "" || $cDoctor == "" || $cDepart==""){
    echo "�����¤�Ѻ�к��դ����Դ��Ҵ��硹��� ��سһԴ������ç��Һ����зӡ������к������Ѻ";
    exit();
}

//item count
$item=0;
for ($n=1; $n<=$x; $n++){
    if ( !empty($aDgcode[$n]) ){
        $item++;
    }
}

include("connect.inc");

//�Ţ LAB
$query = "SELECT * FROM runno WHERE title = 'nid_c'";
$result = mysql_query($query) or die("Query failed");

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	if (!mysql_data_seek($result, $i)) {
		echo "Cannot seek to row $i\n";
		continue;
	}
    
    if(!($row = mysql_fetch_object($result)))
        continue;
}

//  	    $cTitle=$row->title;  //=VN
$nNid=$row->runno;
$fNid=$row->prefix;
$today = date("Y-m-d"); 

$nRunno=$fNid.''.$nNid;
$cPart='nid';

//insert data into depart
$thidate5 = (date("Y")+543).date("-m-d H:i:s"); 
$query = "INSERT INTO medicalcertificate  (thidate,number,hn,part,doctor)VALUES(' $thidate5','$nRunno','$cHn','$cPart','$cDoctor');";
$result = mysql_query($query) or die("**��͹ ! ����;�˹�ҵ�ҧ����ʴ������ѹ�֡������仡�͹���� ���͡�úѹ�֡�������<br>");

$cDoctor1 = substr($cDoctor,5,50);
$cDoctor2 = substr($cDoctor,0,5);

/*if($cDoctor2=='MD054'){$doctorcode='�.13553';}else
if($cDoctor2=='MD052'){$doctorcode='�.14286';}else
if($cDoctor2=='MD037'){$doctorcode='�.10212';}else
if($cDoctor2=='MD089'){$doctorcode='�.32166';}else{$doctorcode='';};*/


$Thaidate1=substr($Thaidate,0,10);

// ᾷ��Ἱ�չ
if( $cDoctor2 === 'MD115' ){
    $yot = '���';
    $cDoctor1 = '�Ҥ���� ���ط��ǧ��';
    $doctorcode = '��. 714';
    $position = 'ᾷ��Ἱ�չ';
}else{
    $sql = "select * from doctor where name like '%$cDoctor1%'";
    $query = mysql_query($sql);
    $rows = mysql_fetch_array($query);
    $yot = $rows["yot"];
    $doctorcode = "�. ".$rows["doctorcode"];
    $position = 'ᾷ��';
}

?><body Onload="window.print();"><?php
print "<CENTER><img  WIDTH=100 HEIGHT=100 SRC='logo.jpg'></CENTER><font face='Angsana New' size ='4'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�Ţ���&nbsp;$nRunno";

print "<font face='Angsana New' size ='4'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<CENTER><B>��Ѻ�ͧ��õ�Ǩ��ҧ��¢ͧᾷ��</B>&nbsp;�ç��Һ�Ť�������ѡ�������� �ӻҧ<BR></CENTER></font>"; 
print "<font face='Angsana New' size ='3'><CENTER>�ѹ���&nbsp;&nbsp;&nbsp; <B> $Thaidate1</B><BR></CENTER> "; 
print "<font face='Angsana New' size ='3'>��Ҿ��� <B>$yot$cDoctor1</B> ���˹� "; 
print $position;
print "��Ш��ç��Һ�Ť�������ѡ��������<BR> ";
print "<font face='Angsana New' size ='3'>�͹حҵ��Сͺ�Ҫվ�Ǫ�����Ţ��� &nbsp;&nbsp;&nbsp;<B>$doctorcode</B><BR>"; 
print "<font face='Angsana New' size ='3'>��ӡ�õ�Ǩ��ҧ��� &nbsp;<B>$cPtname</B> &nbsp;HN:$cHn  &nbsp;&nbsp;���ä:&nbsp;&nbsp;<B>$cDiag</B><BR>"; 
//   print "<font face='Angsana New' size ='3'>������������ԡ���ѡ�Ҵ��¡�ýѧ���&nbsp;&nbsp;&nbsp;1&nbsp;&nbsp;����&nbsp;&nbsp;���������........................�֧........................�.<BR>";
//   print "<font face='Angsana New' size ='3'>������������ԡ���ѡ�Ҵ��¡�ýѧ���&nbsp;&nbsp;&nbsp;1&nbsp;&nbsp;����&nbsp;&nbsp;����................................................<BR>"; 
print "<font face='Angsana New' size ='3'>������������ԡ���ѡ�Ҵ��¡�ýѧ���&nbsp;&nbsp;&nbsp;";

$diag_list = array('����ġ��','����ҵ','CVA');
if( $cDoctor2 === 'MD115' ){
    if( in_array($cDiag, $diag_list) === true ){
        print '���� ��鹿����ö�Ҿ';
    }else{
        print '���� ����ѡ��';
    }
}else{
    print "����................................................";
}
print "<BR>";

print "<font face='Angsana New' size ='3'><CENTER>&nbsp;$yot&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ᾷ�����Ǩ<BR></CENTER>";
print "<font face='Angsana New' size ='3'><CENTER>($cDoctor1)</CENTER>"; 
if( $cDoctor2 === 'MD115' ){
    print "<font face='Angsana New' size ='3'><CENTER>$position</CENTER>"; 
}
$nNid++;
$query ="UPDATE runno SET runno = $nNid WHERE title='nid_c'";
$result = mysql_query($query) or die("Query failed");
