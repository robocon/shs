<body Onload="window.print();">

<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
	
	if($cPtname == "" || $cHn == "" || $cDoctor == "" || $cDepart==""){

		echo "�����¤�Ѻ�к��դ����Դ��Ҵ��硹��� ��سһԴ������ç��Һ����зӡ������к������Ѻ";
		exit();
	}

   //item count
   $item=0;
   for ($n=1; $n<=$x; $n++){
        If (!empty($aDgcode[$n])){
             $item++;
	}
            };

    include("connect.inc");

//�Ţ LAB

if ($cDepart == 'PATHO'){

$query = "SELECT * FROM runno WHERE title = 'lab'";
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
$nLab=$row->runno;
$dLabdate=$row->startday;
$dLabdate=substr($dVndate,0,10);
$today = date("Y-m-d"); 

}

	
//insert data into depart
   $query = "INSERT INTO depart(chktranx,date,ptname,hn,an,doctor,depart,item,detail,price,sumyprice,sumnprice,paid, idname,diag,accno,tvn,ptright,lab)VALUES('$nRunno','$Thidate','$cPtname','$cHn','$cAn','$cDoctor','$cDepart','$item','$aDetail',
                    '$Netprice','$aSumYprice','$aSumNprice','','$sOfficer','$cDiag','$cAccno','$tvn','$cPtright','$nLab');";

       $result = mysql_query($query) or 
                die("**��͹ ! ����;�˹�ҵ�ҧ����ʴ������ѹ�֡������仡�͹���� ���͡�úѹ�֡�������<br>
	*�ô��Ǩ�ͺ�������¡������� [�١�è����Թ] �������<br>
	*������ʴ���� ��ѹ�֡仡�͹����<br>
	*���������ʴ����  ��úѹ�֡�������<br><br>
                -------- ��¡�� ---------<br> 
	$Thaidate<br>
	$cPtname HN:$cHn AN:$cAn VN:$tvn<br>
                �Է��: $cPtright<br>
                �ä:$cDiag<br>
                ᾷ��:$cDoctor<br>
                $aDetail<br>
               �ӹǹ $item ��¡��<br>
               �Ҥ���� $Netprice �ҷ<br>
               ���. $sOfficer<br>");

//test 9/4/47 to find the last row
//printf ("Last inserted record has id %d\n",mysql_insert_id());
  $idno=mysql_insert_id();
//print "<br>$idno <br>";
//test 9/4/47 to find the last row

//insert data into patdata
    for ($n=1; $n<=$x; $n++){
         If (!empty($aDgcode[$n])){
                $query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright)
                                 VALUES('$Thidate','$cHn','$cAn','$cPtname','$cDoctor','$item','$aDgcode[$n]','$aTrade[$n]','$aAmount[$n]',
                                 '$aMoney[$n]','$aYprice[$n]','$aNprice[$n]','$cDepart','$aPart[$n]','$idno','$cPtright');";
                $result = mysql_query($query) or die("Query failed,cannot insert into patdata");
        }
        }

// in case of inpatient insert data into ipacc
IF (!empty($cAn)) {
     for ($n=1; $n<=$x; $n++){
          If (!empty($aDgcode[$n])){
                   $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                                    idname,part,accno,idno)VALUES('$Thidate','$cAn','$aDgcode[$n]','$cDepart','$aTrade[$n]',
                                    '$aAmount[$n]','$aMoney[$n]','$sOfficer','$aPart[$n]','$cAccno','$idno');";
                   $result = mysql_query($query) or die("Query failed,cannot insert into ipacc");
        }
   }
}
//update data in opday 
	if ($cDepart == 'XRAY'){
			    $xraypri=$Netprice;
	            }
	else {
					    $xraypri=0;
	         }
	if ($cDepart =='PATHO'){
			    $pathopri=$Netprice;
	            }
	else {
					    $pathopri=0;
	         }
	if ($cDepart =='EMER'){
			    $emerpri=$Netprice;
	            }
	else {
					    $emerpri=0;
	         }
	if ($cDepart =='SURG'){
			    $surgpri=$Netprice;
	            }
	else {
					    $surgpri=0;
	         }
	if ($cDepart =='PHYSI'){
			    $physipri=$Netprice;
	            }
	else {
					    $physipri=0;
	         }
	if ($cDepart =='DENTA'){
			    $dentapri=$Netprice;
	            }
	else {
					    $dentapri=0;
	         }
	if ($cDepart =='OTHER'){
			    $otherpri=$Netprice;
	            }
	else {
					    $otherpri=0;
	         }

		$Thdhn=date("d-m-").(date("Y")+543).$cHn;
        $query ="UPDATE opday SET   xray= xray+$xraypri,
																patho=patho+$pathopri,
																emer=emer+$emerpri,
																surg=surg+$surgpri,
																physi=physi+$physipri,
																denta=denta+$dentapri,
																other=other+$otherpri
					   WHERE thdatehn= '$Thdhn' AND vn = '".$tvn."' ";
        $result = mysql_query($query) or die("Query failed,update opday");

if ($cDepart == 'PATHO'){
		$nLab++;
		$query ="UPDATE runno SET runno = $nLab WHERE title='lab'";
		$result = mysql_query($query) or die("Query failed");
}
    
   include("unconnect.inc");
//���˹��
  print "���˹��<br>";
     print "<font face='Angsana New'>$cPtname HN:$cHn VN:$tvn  �Է��: $cPtright&nbsp;";
//    print "�Է��: $cPtright<br>";
    print "�ä:$cDiag ᾷ��:$cDoctor<br>";
//    print "ᾷ��:$cDoctor<br>";
      print "<table>";
      print " <tr>";
      print "  <th>#</th>";
      print "  <th>��¡��</th>";
      print "  <th>�ӹǹ</th>";
      print "  <th>�Ҥ�</th>";
      print "  <th>�ԡ�����</th>";
      print " </tr>";

    $no=0;
    for ($n=1; $n<=$x; $n++){
          If (!empty($aDgcode[$n])){
              $no++;
         print (" <tr>\n".
           "  <td>$no</td>\n".
           "  <td>$aTrade[$n]</td>\n".
           "  <td>$aAmount[$n]</td>\n".
           "  <td>$aMoney[$n]</td>\n".
           "  <td>$aNprice[$n]</td>\n".
           " </tr>\n");
                         }
                         } ;
      print "</table>";
   print "<B>�Ҥ���� $Netprice �ҷ </B>&nbsp;&nbsp;&nbsp;";
   if ($aSumNprice>0){
			print"<B>(�ԡ����� $aSumNprice �ҷ )</B>&nbsp;&nbsp;";
					   }
   print "���. $sOfficer";  
      print "<font face='Angsana New'>&nbsp;&nbsp;$Thaidate<br>";
      print "*************�����˹��价����ͧ���Թ***************";  
$cDoctor1=substr($cDoctor,5,50);
$cDoctor2=substr($cDoctor,0,5);
/*if($cDoctor2=='MD054'){$doctorcode='�.13553';}else
if($cDoctor2=='MD052'){$doctorcode='�.14286';}else
if($cDoctor2=='MD037'){$doctorcode='�.10212';}else{$doctorcode='';};*/
include("connect.inc");

// ᾷ��Ἱ�չ
if( $cDoctor2 === 'MD115' ){
    $yot = '���';
    $cDoctor1 = '�Ҥ���� ���ط��ǧ��';
    $doctorcode = '��. 714';
    $position = 'ᾷ��Ἱ�չ';
}else{
    $dbsql="select * from doctor where name like '%$cDoctor1%'";
    $dbquery = mysql_query($dbsql);
    $num = mysql_num_rows($dbquery);
    $dbrow = mysql_fetch_array($dbquery);
    $yot = $dbrow["yot"];
    $doctorcode = "�. ".$dbrow["doctorcode"];
    $position = 'ᾷ��';
}

print "<font face='Angsana New' size ='4'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<CENTER><B>��Ѻ�ͧ��õ�Ǩ��ҧ��¢ͧᾷ��</B> �ç��Һ�Ť�������ѡ�������� �ӻҧ<BR></CENTER></font>"; 
if( $cDoctor2 === 'MD115' ){
    list($nid_date, $nid_time) = explode(' ', $Thaidate);
    print "<CENTER>�ѹ��� <b>$nid_date</b></CENTER>"; 
}

print "��Ҿ��� <B>$yot$cDoctor1</B> ���˹� "; 
print $position;
print "��Ш��ç��Һ�Ť�������ѡ��������<BR> ";
print "�͹حҵ��Сͺ�Ҫվ�Ǫ�����Ţ��� &nbsp;$doctorcode<BR>"; 
print "��ӡ�õ�Ǩ��ҧ��� &nbsp;<B>$cPtname</B> &nbsp;HN:$cHn  &nbsp;&nbsp;���ä:&nbsp;&nbsp;$cDiag<BR>"; 
print "������������ԡ���ѡ�Ҵ��¡�ýѧ���&nbsp;";
$diag_list = array('����ġ��','����ҵ','CVA');
if( $cDoctor2 === 'MD115' OR $cDoctor2 === 'MD037' OR $cDoctor2 === 'MD054' OR $cDoctor2 === 'MD089' ){
    if( in_array($cDiag, $diag_list) === true ){
        print '���� ��鹿����ö�Ҿ';
    }else{
        print '���� ����ѡ��';
    }
}else{
    print "&nbsp;&nbsp;1&nbsp;&nbsp;����&nbsp;&nbsp;���������........................�֧........................�."; 
}

print "<br>";
print "<CENTER>&nbsp;$yot&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ᾷ�����Ǩ<BR></CENTER>";
print "<CENTER>($cDoctor1)</CENTER>"; 
if( $cDoctor2 === 'MD115' ){
    print "<CENTER>$position</CENTER>"; 
}

	    // print "<B>�����˹��仪����Թ�����ͧ���Թ</B>";  
//�����˹��
?>