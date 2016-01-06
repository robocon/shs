<body Onload="window.print();">

<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
	
	if($cPtname == "" || $cHn == "" || $cDoctor == "" || $cDepart==""){

		echo "ขออภัยครับระบบมีความผิดพลาดเล็กน้อย กรุณาปิดโปรแกรมโรงพยาบาลและทำการเข้าระบบใหม่ครับ";
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

//เลข LAB

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
                die("**เตือน ! เมื่อพบหน้าต่างนี้แสดงว่าได้บันทึกข้อมูลไปก่อนแล้ว หรือการบันทึกล้มเหลว<br>
	*โปรดตรวจสอบว่ามีรายการในเมนู [ดูการจ่ายเงิน] หรือไม่<br>
	*ถ้ามีแสดงว่า ได้บันทึกไปก่อนแล้ว<br>
	*ถ้าไม่มีแสดงว่า  การบันทึกล้มเหลว<br><br>
                -------- รายการ ---------<br> 
	$Thaidate<br>
	$cPtname HN:$cHn AN:$cAn VN:$tvn<br>
                สิทธิ: $cPtright<br>
                โรค:$cDiag<br>
                แพทย์:$cDoctor<br>
                $aDetail<br>
               จำนวน $item รายการ<br>
               ราคารวม $Netprice บาท<br>
               จนท. $sOfficer<br>");

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
//ใบแจ้งหนี้
  print "ใบแจ้งหนี้<br>";
     print "<font face='Angsana New'>$cPtname HN:$cHn VN:$tvn  สิทธิ: $cPtright&nbsp;";
//    print "สิทธิ: $cPtright<br>";
    print "โรค:$cDiag แพทย์:$cDoctor<br>";
//    print "แพทย์:$cDoctor<br>";
      print "<table>";
      print " <tr>";
      print "  <th>#</th>";
      print "  <th>รายการ</th>";
      print "  <th>จำนวน</th>";
      print "  <th>ราคา</th>";
      print "  <th>เบิกไม่ได้</th>";
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
   print "<B>ราคารวม $Netprice บาท </B>&nbsp;&nbsp;&nbsp;";
   if ($aSumNprice>0){
			print"<B>(เบิกไม่ได้ $aSumNprice บาท )</B>&nbsp;&nbsp;";
					   }
   print "จนท. $sOfficer";  
      print "<font face='Angsana New'>&nbsp;&nbsp;$Thaidate<br>";
      print "*************นำใบแจ้งหนี้ไปที่ห้องเก็บเงิน***************";  
$cDoctor1=substr($cDoctor,5,50);
$cDoctor2=substr($cDoctor,0,5);
/*if($cDoctor2=='MD054'){$doctorcode='ว.13553';}else
if($cDoctor2=='MD052'){$doctorcode='ว.14286';}else
if($cDoctor2=='MD037'){$doctorcode='ว.10212';}else{$doctorcode='';};*/
include("connect.inc");

// แพทย์แผนจีน
if( $cDoctor2 === 'MD115' ){
    $yot = 'นาย';
    $cDoctor1 = 'ภาคภูมิ พิสุทธิวงษ์';
    $doctorcode = 'พจ. 714';
    $position = 'แพทย์แผนจีน';
}else{
    $dbsql="select * from doctor where name like '%$cDoctor1%'";
    $dbquery = mysql_query($dbsql);
    $num = mysql_num_rows($dbquery);
    $dbrow = mysql_fetch_array($dbquery);
    $yot = $dbrow["yot"];
    $doctorcode = "ว. ".$dbrow["doctorcode"];
    $position = 'แพทย์';
}

print "<font face='Angsana New' size ='4'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<CENTER><B>ใบรับรองการตรวจร่างกายของแพทย์</B> โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง<BR></CENTER></font>"; 
if( $cDoctor2 === 'MD115' ){
    list($nid_date, $nid_time) = explode(' ', $Thaidate);
    print "<CENTER>วันที่ <b>$nid_date</b></CENTER>"; 
}

print "ข้าพเจ้า <B>$yot$cDoctor1</B> ตำแหน่ง "; 
print $position;
print "ประจำโรงพยาบาลค่ายสุรศักดิ์มนตรี<BR> ";
print "ใบอนุญาตประกอบอาชีพเวชกรรมเลขที่ &nbsp;$doctorcode<BR>"; 
print "ได้ทำการตรวจร่างกาย &nbsp;<B>$cPtname</B> &nbsp;HN:$cHn  &nbsp;&nbsp;เป็นโรค:&nbsp;&nbsp;$cDiag<BR>"; 
print "เห็นสมควรให้บริการรักษาด้วยการฝังเข็ม&nbsp;";
$diag_list = array('อัมพฤกษ์','อัมพาต','CVA');
if( $cDoctor2 === 'MD115' OR $cDoctor2 === 'MD037' OR $cDoctor2 === 'MD054' OR $cDoctor2 === 'MD089' ){
    if( in_array($cDiag, $diag_list) === true ){
        print 'เพื่อ ฟื้นฟูสมรรถภาพ';
    }else{
        print 'เพื่อ การรักษา';
    }
}else{
    print "&nbsp;&nbsp;1&nbsp;&nbsp;ครั้ง&nbsp;&nbsp;ตั้งแต่เวลา........................ถึง........................น."; 
}

print "<br>";
print "<CENTER>&nbsp;$yot&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;แพทย์ผู้ตรวจ<BR></CENTER>";
print "<CENTER>($cDoctor1)</CENTER>"; 
if( $cDoctor2 === 'MD115' ){
    print "<CENTER>$position</CENTER>"; 
}

	    // print "<B>นำใบแจ้งหนี้ไปชำระเงินที่ห้องเก็บเงิน</B>";  
//จบใบแจ้งหนี้
?>