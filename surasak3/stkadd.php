<?php
    session_start();
    $cStkno="$stkno";
    $cDocno="$docno";
    $cBillno="$billno";
    $cBilldate="$billdate";
    $cGetdate="$getdate";
    $cComcode="$comcode";
	
	
	$amountfree =$_POST["amountfree"];
//    $cComname="$comname";

    $nNetprice=$nNetprice + $price;
    $nItem=$nItem+1; 

  include("connect.inc");
//runno to make unique for dgexplot
    $nRunno="";


    $query = "SELECT title,prefix,runno FROM runno WHERE title = 'combill'";
    $result = mysql_query($query) or die( mysql_error() );

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

    $nRunno=$row->runno;
    $nRunno++;

    
        
//end  runno  to make unique for dgexplot

//seek comname from company by comcode
    $query = "SELECT comcode,comname FROM company WHERE comcode = '$cComcode' ";
    $result = mysql_query($query) or die("Query company failed ");
        for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

    if(mysql_num_rows($result)){
	$cComname=$row->comname;
			}

$query = "Select docno From combill where dgexplot = '$drugcode$expdate$lotno$nRunno' ";
$result = Mysql_Query($query);
$rows = Mysql_num_rows($result);

if($rows > 1){
	echo "
		<SCRIPT LANGUAGE=\"JavaScript\">
		<!--
			alert('ไม่สามารถบันทึกข้อมูลได้ กรุณาทบทวนสิ่งที่ท่านทำก่อนหน้าเพื่อบอกผู้ดูแลระบบ');
		//-->
		</SCRIPT>
<meta http-equiv=\"refresh\" content=\"0;url=procure.php\" />

	";

exit();
}

//insert data into combill
   $query = "INSERT INTO combill(`date`,docno,billno,billdate,comcode,comname,drugcode,
                   tradname,genname,lotno,unit,amount,stkbak,price,unitpri,salepri,mfdate, 
                   expdate,getdate,paid,person,stkno,dgexplot,packing,packamt,packpri,packpri_vat,amountfree)VALUES('".date("Y-m-d H:i:s")."','$docno','$billno','$billdate',
                   '$comcode','$cComname','$drugcode','$tradname','$genname','$lotno','$unit',
                   '$amount','$amount','$price','$unitpri','$salepri','$mfdate','$expdate',
                   '$getdate','','$sOfficer','$stkno','$drugcode$expdate$lotno$nRunno','$packing','$packamt','$packpri','$packpri_vat','$amountfree');";
  $result = mysql_query($query) or die("Query failed,insert into combill");
   $idno=mysql_insert_id();
//   echo mysql_errno() . ": " . mysql_error(). "\n";
//   echo "<br>";
//
if($result){
$query ="update runno SET runno = $nRunno WHERE title='combill'";

    $result = mysql_query($query) or die("Query failed");
}

 $Thidate = (date("Y")+543).date("-m-d");  
 $acdate = date("Y-m-d");
   $query = "INSERT INTO stktranx(date,drugcode,tradname,expdate,lotno,stkcut,unit,officer,billno,department,unitpri,amount,netlotno,getdate,mainstk,stock,totalstk,amountfree) VALUES('$acdate','$drugcode','$tradname','$expdate','$lotno','','$unit','$sOfficer','$billno','$cComname','$unitpri','$amount','$amount','$getdate',$cMainstk+$amount,$cTotalstk-$cMainstk,$cTotalstk+$amount,'$amountfree');";
  $result = mysql_query($query) or die("failed,insert into stktranx");
 
//   echo mysql_errno() . ": " . mysql_error(). "\n";
//   echo "<br>";

/*
table combill
  row_id int(11) NOT NULL auto_increment,
  docno char(10) default NULL,
  billno char(10) default NULL,
  billdate date default NULL,
  comcode char(10) default NULL,
  comname char(40) default NULL,
 * drugcode char(10) default NULL,
  tradname char(30) default NULL,
  genname char(30) default NULL,
 * lotno char(10) default NULL,
  unit char(10) default NULL,
  amount int(11) default NULL,
  price double default NULL,
  unitpri double default NULL,
  salepri double default NULL,
  mfdate date default NULL,
 * expdate date default NULL,
  getdate date default NULL,
  paid double default NULL,
  person char(20) default NULL,
  stkno char(10) default NULL,  //ลำดับคลัง
  contract double default NULL,//บริษัทจ่ายจ่าย%แล้วเท่าไร
  percent double default NULL,//%บริษัทจ่าย
  dgexplot char(28) default NULL
*/
print "cMainstk $cMainstk<br>";
print "cTotalstk $cTotalstk<br>";
print "amount $amount<br>";
print "$cComcode, $cComname<br>";
        $query ="update druglst SET  comcode  = '$cComcode',
			           comname = '$cComname',
					   tradname = '$tradname',
			           mainstk= $cMainstk+$amount,
                       totalstk = $cTotalstk+$amount,
			           salepri  =  $salepri,
			           unitpri   =  $unitpri,
         			   packpri   =  $packpri,
					   packpri_vat   =  $packpri_vat,
			           packing = '$packing',
          			   packamt = $packamt	,
					   	pack = '$pack'	
                       WHERE drugcode= '$drugcode' ";

        $result = mysql_query($query) or die("Query failed,update druglst");
		
//        echo mysql_errno() . ": " . mysql_error(). "\n";
//        echo "<br>";
print "<br><br>บันทึกข้อมูลเรียบร้อย <A HREF=\"dgprocure_print.php?id=".$idno."\" target=\"_blank\">พิมพ์ข้อมูลการซื้อ</A><br>";
print "<br><a href='newitem.php'>บันทึกรายการต่อไป (ใบส่งของเดิม)</a><br>";
print "<br><a href='stkok.php'>หมดรายการบันทึก</a><br>";
//print "<br><a href='../nindex.htm'><< ไปเมนู</a><br>";

include("unconnect.inc");
?>






