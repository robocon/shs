<?
include("../connect.inc");
$newdate=$_GET["newdate"];
$d=substr($newdate,8,2);
$m=substr($newdate,5,2); 
$y=substr($newdate,0,4); 
$thiyr=$y-543;
$yrmonth=$m;
$yrdate=$d;

$yrmonthdate="$thiyr-$yrmonth-$yrdate";

// ลบไฟล์ก่อน-----------------)
$filename1 = "billtran$thiyr$yrmonth$yrdate.txt";
$filename2 = "billdisp$thiyr$yrmonth$yrdate.txt";

if(file_exists("$filename1") && file_exists("$filename2")){
	unlink("$filename1");
	unlink("$filename2");					
	echo "ลบข้อมูลเดิมเรียบร้อย </br>";				
}
// จบ ลบไฟล์-----------------)
?>

<?
//-------------------- Create file billtran ไฟล์ที่ 1 --------------------//
$thimonth=$newdate;
$numcscd=0;
$cscd="จ่ายตรง";

	$query="CREATE TEMPORARY TABLE reportcscd01 SELECT date,hn,vn,billno,price,credit,depart,paidcscd,detail,row_id,txdate FROM opacc INNER JOIN datacscdcon ON opacc.hn=datacscdcon.hn WHERE opacc.date LIKE '$thimonth%' and opacc.credit = '$cscd'  AND opacc.paidcscd > $numcscd" ;
	$result = mysql_query($query) or die("Query failed billtran 43");	
	
	


     $query="SELECT * FROM reportcscd01";
     $result = mysql_query($query) or die("Query xxx failed");
	 $count =mysql_num_rows($result);


$query = "SELECT * FROM runno WHERE title = 'cscdrun' ";
$result = mysql_query($query) or die("Query failed");

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	if (!mysql_data_seek($result, $i)) {
		echo "Cannot seek to row $i\n";
		continue;
	}
		if(!($row = mysql_fetch_object($result)))
		continue;
}

$ncscd2=$row->runno;

$ncscd2=sprintf('%04d',$ncscd2);
$ncscd3 = $ncscd2 +1;

 $query ="UPDATE runno SET runno = $ncscd3  WHERE title='cscdrun ' ";
 $result = mysql_query($query);

$strText11="<ClaimRec System=\"OP\" PayPlan=\"CS\" Version=\"0.9\"></ClaimRec>\n
<HCODE>11512</HCODE>\n
<HNAME>ค่ายสุรศักดิ์มนตรี</HNAME>\n
<DATETIME>2010-12-14 08:33:18</DATETIME>\n
<SESSNO>$ncscd2</SESSNO>\n
<RECCOUNT>$count</RECCOUNT>\n
<BILLTRAN>\r\n";


$strFileName1 = "billtran$thiyr$yrmonth$yrdate.txt";
$objFopen1 = fopen($strFileName1, 'a');
fwrite($objFopen1, $strText11);

	if($objFopen1){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
	fclose($objFopen1);


   $query="SELECT * FROM reportcscd01";
   $result = mysql_query($query);
    while (list ($date,$hn,$vn,$billno,$price,$cerdit,$depart,$paidcscd,$detail,$row_id,$txdate) = mysql_fetch_row ($result)) {	  //วนลูป
	$numcscd++;
	$num1=11512;
	$num2=543;
	$num4=1;
	$num5=2;
	$num3=0;
    $d=substr($txdate,8,2);
    $m=substr($txdate,5,2); 
	$y=substr($txdate,0,4); 
	$t1=substr($txdate,10,4); 
 	$t2=substr($txdate,14,2); 
	$t3=substr($txdate,16,3); 
if($t2<'3'){$t2='03';};
   $t4=$t2-$num4;
   $t5=$t2-$num5;

   $y1=$y-$num2;
   $y2=substr($y1,2,2);
   
 $date11="$d/$m/$y2"; 
$date1="$y1-$m-$d";
$date2="$y1$m$d";
   $clinic1=substr($clinic,0,2);
   $row_id1=substr($row_id,-4);
   
$t4=sprintf('%02d',$t4);
$t5=sprintf('%02d',$t5);

$ti1="$t1$t4$t3";
$ti2="$t1$t5$t3";
$ti3="$t1$t2$t3";
if($detail=="ค่ายา"){$t=$ti1;} else
if($detail=="(55020/55021)ค่าบริการผู้ป่วยนอก"){$t=$ti2;}
  else{$t=$ti3;};

$numNcscd=$price-$paidcscd;
$vn=sprintf('%04d',$vn);
$billno=sprintf('%03d',$billno);
$numcscd=sprintf('%04d',$numcscd);
$paidcscd=number_format( $paidcscd, 2, '.', '');
$numNcscd=number_format( $numNcscd, 2, '.', '');
$row_id1=sprintf('%04d',$row_id1);

$strText12="01||$date1$t|11512|$date2$row_id1$vn|$date2$row_id|$hn||$paidcscd|0.00||\r\n";

$strFileName1 = "billtran$thiyr$yrmonth$yrdate.txt";
$objFopen1 = fopen($strFileName1, 'a');
fwrite($objFopen1, $strText12);

	if($objFopen1){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
	fclose($objFopen1);
}



$strText13="</BILLTRAN>\r\n";
$strFileName1 = "billtran$thiyr$yrmonth$yrdate.txt";
$objFopen1 = fopen($strFileName1, 'a');
fwrite($objFopen1, $strText13);

	if($objFopen1){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
	fclose($objFopen1);

$count2=0;
$query="SELECT * FROM reportcscd01  ";
   $result = mysql_query($query);
    while (list ($date,$hn,$vn,$billno,$price,$cerdit,$depart,$paidcscd,$detail,$row_id,$txdate) = mysql_fetch_row ($result)) {	
			
		if($depart=='PHAR'){
			$ddl=0;
			$dpy=0;
			$dsy=0;
			$sql1 = "select * from phardep where date = '".$txdate."' ";
			$row1 = mysql_query($sql1);
			$result1 = mysql_fetch_array($row1);
			$sql2 = "select sum(price) as suma,part,drugcode  from drugrx where idno = '".$result1['row_id']."' group by part";
			$row2 = mysql_query($sql2);
			while($result2 = mysql_fetch_array($row2)){
				if($result2['part']=="DDL"||$result2['part']=="DDY"){
					$ddl+=$result2['suma'];
				}elseif($result2['part']=="DPY"){
					$dpy+=$result2['suma'];
				}elseif($result2['part']=="DSY"){
					$sql3 = "select medical_sup_free from druglst where drugcode = '".$result2['drugcode']."' ";
					$row3 = mysql_query($sql3);
					list($supfree) = mysql_fetch_array($row3);
					if($supfree==1){
						$dsy+=$result2['suma'];
					}
				}
			}
			if($ddl>0){
				$count2++;
			}
			if($dpy>0){
				$count2++;
			}
			if($dsy>0){
				$count2++;
			}
			
		}else{
			$sql1 = "select * from depart where date = '".$txdate."' ";
			$row1 = mysql_query($sql1);
			$result1 = mysql_fetch_array($row1);
			$sql2 = "select sum(price) as sumb,part  from patdata where idno = '".$result1['row_id']."' group by part";
			$row2 = mysql_query($sql2);
			$result2 = mysql_fetch_array($row2);
			$count2++;
		}
	}

$strText14="<OPBills invcount=\"$count\" lines=\"$count2\">\r\n";


$strFileName1 = "billtran$thiyr$yrmonth$yrdate.txt";
$objFopen1 = fopen($strFileName1, 'a');
fwrite($objFopen1, $strText14);

	if($objFopen1){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
	fclose($objFopen1);


$numcscd=0;
   $query="SELECT * FROM reportcscd01  ";
   $result = mysql_query($query);
    while (list ($date,$hn,$vn,$billno,$price,$cerdit,$depart,$paidcscd,$detail,$row_id,$txdate) = mysql_fetch_row ($result)) {	
		$numcscd++;
		$num1=11512;
		$num2=543;
		$num4=1;
		$num3=0;
		$d=substr($txdate,8,2);
		$m=substr($txdate,5,2); 
		$y=substr($txdate,0,4); 
		$y1=$y-$num2;
		$y2=substr($y1,2,2);
	   
		$date11="$d/$m/$y2"; 
		$date1="$y1-$m-$d";
		$date2="$y1$m$d";

   		$clinic1=substr($clinic,0,2);
     	$row_id1=substr($row_id,-4);
 		$paidcscd=number_format( $paidcscd, 2, '.', '');
		$vn=sprintf('%04d',$vn);
		$billno=sprintf('%03d',$billno);
		$numcscd=sprintf('%04d',$numcscd);
		$row_id1=sprintf('%04d',$row_id1);
		$numNcscd=$price-$paidcscd;
		$numNcscd=number_format( $numNcscd, 2, '.', '');
		
		if($depart=='PHAR'){
			$ddl=0;
			$dpy=0;
			$dsy=0;
			$sql1 = "select * from phardep where date = '".$txdate."' ";
			$row1 = mysql_query($sql1);
			$result1 = mysql_fetch_array($row1);
			$sql2 = "select sum(price) as suma,part,drugcode  from drugrx where idno = '".$result1['row_id']."' group by part";
			$row2 = mysql_query($sql2);
			while($result2 = mysql_fetch_array($row2)){
				if($result2['part']=="DDL"||$result2['part']=="DDY"){
					$ddl+=$result2['suma'];
				}elseif($result2['part']=="DPY"){
					$dpy+=$result2['suma'];
				}elseif($result2['part']=="DSY"){
					$sql3 = "select medical_sup_free from druglst where drugcode = '".$result2['drugcode']."' ";
					$row3 = mysql_query($sql3);
					list($supfree) = mysql_fetch_array($row3);
					if($supfree==1){
						$dsy+=$result2['suma'];
					}
				}
			}
			if($ddl>0){
				$ddl = number_format($ddl,2);
				$strText15="$date2$row_id1$vn|4|$ddl|0.00\r\n";
				
				$strFileName1 = "billtran$thiyr$yrmonth$yrdate.txt";
				$objFopen1 = fopen($strFileName1, 'a');
				fwrite($objFopen1, $strText15);
				
					if($objFopen1){
						/*echo "File writed.";*/
					}else{
						/*echo "File can not write";*/
					}
					fclose($objFopen1);
			}
			if($dpy>0){
				$dpy = number_format($dpy,2);
				$strText15="$date2$row_id1$vn|2|$dpy|0.00\r\n";
				
				$strFileName1 = "billtran$thiyr$yrmonth$yrdate.txt";
				$objFopen1 = fopen($strFileName1, 'a');
				fwrite($objFopen1, $strText15);
				
					if($objFopen1){
						/*echo "File writed.";*/
					}else{
						/*echo "File can not write";*/
					}
					fclose($objFopen1);				
			}
			if($dsy>0){
				$dsy = number_format($dsy,2);
				$strText15="$date2$row_id1$vn|5|$dsy|0.00\r\n";
				
				$strFileName1 = "billtran$thiyr$yrmonth$yrdate.txt";
				$objFopen1 = fopen($strFileName1, 'a');
				fwrite($objFopen1, $strText15);
				
					if($objFopen1){
						/*echo "File writed.";*/
					}else{
						/*echo "File can not write";*/
					}
					fclose($objFopen1);					
			}
			
		}else{
			$sql1 = "select * from depart where date = '".$txdate."' ";
			$row1 = mysql_query($sql1);
			$result1 = mysql_fetch_array($row1);
			$sql2 = "select sum(price) as sumb,part  from patdata where idno = '".$result1['row_id']."' group by part";
			$row2 = mysql_query($sql2);
			$result2 = mysql_fetch_array($row2);
				if($result2['part']=="LAB"){
					$depart1="7";
				}elseif($result2['part']=="BLOOD"){
					$depart1="6";
				}elseif($result2['part']=="XRAY"){
					$depart1="8";
				}elseif($result2['part']=="SINV"){
					$depart1="9";
				}elseif($result2['part']=="TOOL"){
					$depart1="A";
				}elseif($result2['part']=="SURG"){
					$depart1="B";
				}elseif($result2['part']=="NCARE"||$result2['part']=="OTHER"||$result2['part']=="EMER"){
					$depart1="C";
				}elseif($result2['part']=="DENTA"){
					$depart1="D";
				}elseif($result2['part']=="PT"){
					$depart1="E";
				}elseif($result2['part']=="STX"||$result2['part']=="NID"){
					$depart1="F";
				}elseif($result2['part']=="MC"){
					$depart1="G";
				}else{
					$depart1="C";
				}	
				$strText15="$date2$row_id1$vn|$depart1|$paidcscd|0.00\r\n";
				
				$strFileName1 = "billtran$thiyr$yrmonth$yrdate.txt";
				$objFopen1 = fopen($strFileName1, 'a');
				fwrite($objFopen1, $strText15);
				
					if($objFopen1){
						/*echo "File writed.";*/
					}else{
						/*echo "File can not write";*/
					}
					fclose($objFopen1);	
		}
	}
				$strText16="</OPBills>\r\n";
				
				
				$strFileName1 = "billtran$thiyr$yrmonth$yrdate.txt";
				$objFopen1 = fopen($strFileName1, 'a');
				fwrite($objFopen1, $strText16);
				
					if($objFopen1){
						/*echo "File writed.";*/
					}else{
						/*echo "File can not write";*/
					}
					fclose($objFopen1);																						
	
//-------------------- Close create file billtran --------------------//
?>

<?
//-------------------- Create file billdisp ไฟล์ที่ 2 --------------------//
$thimonth=$newdate;
$numcscd=0;
$cscd='จ่ายตรง';
    $query="CREATE TEMPORARY TABLE reportcscd02 SELECT date,hn,vn,billno,price,credit,depart,paidcscd,detail,row_id,txdate FROM opacc WHERE date LIKE '$thimonth%' and credit = '$cscd' AND depart='PHAR' " ;
    $result = mysql_query($query) or die("Query failed billdisp 379");


     $query="SELECT * FROM reportcscd02";
     $result = mysql_query($query) or die("Query xxx failed");
	 while (list ($date,$hn,$vn,$billno,$price,$cerdit,$depart,$paidcscd,$detail,$row_id,$txdate) = mysql_fetch_row ($result)) {	
		 $query3 = "select date,item,doctor,row_id from phardep where date = '$txdate' and price>0 and hn='$hn' ";
		 $row3 = mysql_query($query3);
		 list($datepx,$pitem,$doctor,$xrow) = mysql_fetch_array($row3);
		 $ddl=0;
		 $sql2 = "select sum(price) as suma,part,drugcode  from drugrx where idno = '".$xrow."' group by part";
		 $row2 = mysql_query($sql2);
		 while($result2 = mysql_fetch_array($row2)){
			 if($result2['part']=="DDL"||$result2['part']=="DDY"||$result2['part']=="DDN"||$result2['part']=="DSN"){
				 $ddl+=$result2['suma'];
			 }elseif($result2['part']=="DSY"){
				$sql3 = "select medical_sup_free,freepri from druglst where drugcode = '".$result2['drugcode']."' ";
				$row3 = mysql_query($sql3);
				list($supfree,$freepri) = mysql_fetch_array($row3);
				if($supfree==1){
					if($result2['suma']>$freepri){
						$ddl+=$freepri;
					}else{
						$ddl+=$result2['suma'];
					}
				}else{
					$ddl+=$result2['suma'];	
				}
			 }
		 }
		 if($ddl>0){
			$countdisp++;
		 }
	 }

$query = "SELECT * FROM runno WHERE title = 'cscdrun' ";
$result = mysql_query($query) or die("Query failed");

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	if (!mysql_data_seek($result, $i)) {
		echo "Cannot seek to row $i\n";
		continue;
	}
		if(!($row = mysql_fetch_object($result)))
		continue;
}

$ncscd2=$row->runno;
$ncscd2 = $ncscd2 -1;
$ncscd2=sprintf('%04d',$ncscd2);	

$strText21="<?xml version=\"1.0\" encoding=\"windows-874\"?>\n
<ClaimRec System=\"OP\" PayPlan=\"CS\" Version=\"0.91\">\n
<Header>\n
<HCODE>11512</HCODE>\n
<HNAME>ค่ายสุรศักดิ์มนตรี</HNAME>\n
<DATETIME>2010-12-14 08:33:18</DATETIME>\n
<SESSNO>$ncscd2</SESSNO>\n
<RECCOUNT>$countdisp</RECCOUNT>\n
</Header>\n
<Dispensing>\r\n";

	$strFileName2 = "billdisp$thiyr$yrmonth$yrdate.txt";
	$objFopen2 = fopen($strFileName2, 'a');
	fwrite($objFopen2, $strText21);
			
	if($objFopen2){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
	fclose($objFopen2);

   $query="SELECT * FROM reportcscd02  ";
   $result = mysql_query($query);
    while (list ($date,$hn,$vn,$billno,$price,$cerdit,$depart,$paidcscd,$detail,$row_id,$txdate) = mysql_fetch_row ($result)) {	
		$numcscd++;
		$pitem=0; 
	$num1=11512;
	$num2=543;
	$num3=0;
    $num4=1;
    $num5=2;
	$dr1="";
    $d=substr($txdate,8,2);
    $m=substr($txdate,5,2); 
    $y=substr($txdate,0,4); 

    $t1=substr($txdate,10,4); 
    $t2=substr($txdate,14,2); 
    $t3=substr($txdate,16,3); 
	if($t2<'3'){$t2='03';};
	$t4=$t2-$num4;
	$t5=$t2-$num5;

    $y1=$y-$num2;
    $y2=substr($y1,2,2);
   
    $date11="$d/$m/$y2"; 
    $date1="$y1-$m-$d";
    $date2="$y1$m$d";
    $clinic1=substr($clinic,0,2);
    $row_id1=substr($row_id,-4);
   
	$t4=sprintf('%02d',$t4);
	$t5=sprintf('%02d',$t5);

	$ti1="$t1$t4$t3";
	$ti2="$t1$t5$t3";
	$ti3="$t1$t2$t3";
	if($detail=="ค่ายา"){$t=$ti1;} else
	if($detail=="(55020/55021)ค่าบริการผู้ป่วยนอก"){$t=$ti2;}
	  else{$t=$ti3;};

	$numNcscd=$price-$paidcscd;
	$vn=sprintf('%04d',$vn);
	$billno=sprintf('%03d',$billno);
	$numcscd=sprintf('%04d',$numcscd);
	$paidcscd=number_format( $paidcscd, 2, '.', '');
	$numNcscd=number_format( $numNcscd, 2, '.', '');
	$row_id1=sprintf('%04d',$row_id1);

	$query2 = "select idcard from opcard where hn= '$hn' ";
	$row2 = mysql_query($query2);
	list($cid) = mysql_fetch_array($row2);
	$dphardate = $y."-".$m."-".$d;
	
	$query3 = "select date from dphardep where date like '".substr($txdate,0,10)."%' and dr_cancle is null and stkcutdate is not null and hn='$hn' ";
	$row3 = mysql_query($query3);
	list($datepx) = mysql_fetch_array($row3);
	
	$query4 = "select date,doctor,row_id from phardep where date = '$txdate' and hn='$hn' and price>0";
	$row4 = mysql_query($query4);
	list($dateop,$doctor,$xrow) = mysql_fetch_array($row4);
	
	$ddl=0;
	$ddn=0;
	
	$sql2 = "select sum(price) as price,count(row_id) as counter,part,drugcode  from drugrx where idno = '".$xrow."' and (part='DDL' or part='DDY' or part='DDN' or part='DSY' or part='DSN' ) group by part,drugcode";
//or part='DPY'
	$row2 = mysql_query($sql2);
	while($result2 = mysql_fetch_array($row2)){
		if($result2['part']=="DDL"||$result2['part']=="DDY"){
			$pitem+=$result2['counter'];
			$ddl+=$result2['price'];
		}elseif($result2['part']=="DSY"){
			$sql3 = "select medical_sup_free,freepri from druglst where drugcode = '".$result2['drugcode']."' ";
			$row3 = mysql_query($sql3);
			list($supfree,$freepri) = mysql_fetch_array($row3);
			if($supfree==1){
				if($result2['price']>$freepri){
					$ddl+=$freepri;
					$ddn+=($result2['price']-$freepri);
					$pitem+=$result2['counter'];
				}else{
					$ddl+=$result2['price'];
					$pitem+=$result2['counter'];
				}
			}else{//เบิกไม่ได้
				$ddn+=$result2['price'];
				$pitem+=$result2['counter'];
			}
		}elseif($result2['part']=="DDN"||$result2['part']=="DSN"){
			$ddn+=$result2['price'];
			$pitem+=$result2['counter'];
		}
	}
	if($ddl>0){
	$posdr = strpos($doctor,"ว.");
	$posdrd = strpos($doctor,"ท.");
	if($posdr==false){
		if($posdrd==false){
			$seldr = "select doctorcode from doctor where name like '%".substr($doctor,0,9)."%' ";
			$rowdr = mysql_query($seldr);
			list($dr) = mysql_fetch_array($rowdr);
			$dc="ว";
			$dr1="$dc$dr";
		}
		else{
			$dr = substr($doctor,($posdrd+2),4);
			$dc="ท";
			$dr1="$dc$dr";
		}
	}
	else{
		$dr = substr($doctor,($posdr+2),5);
		$dc="ว";
		$dr1="$dc$dr";
		if(strlen($dr)<4){
			$seldr = "select doctorcode from doctor where name like '%".substr($doctor,0,9)."%' ";
			$rowdr = mysql_query($seldr);
			list($dr) = mysql_fetch_array($rowdr);
			$dc="ว";
			$dr1="$dc$dr";
		}
	}
	$px1=substr($datepx,8,2); 
    $px2=substr($datepx,5,2); 
    $px3=substr($datepx,0,4)-543; 
	$px4=substr($datepx,11,2); 
	$px5=substr($datepx,14,2); 
	$px6=substr($datepx,17,2); 
	$datepx = "$px3-$px2-$px1 $px4:$px5:$px6";
	
	$op1=substr($dateop,8,2); 
    $op2=substr($dateop,5,2); 
    $op3=substr($dateop,0,4)-543; 
	$op4=substr($dateop,11,2); 
	$op5=substr($dateop,14,2); 
	$op6=substr($dateop,17,2); 
	$dateop = "$op3-$op2-$op1 $op4:$op5:$op6";
	if($datepx=="-543-- ::"){ $datepx=$dateop;}
	$all=$ddl+$ddn;
	$ddl=number_format($ddl,2, '.', '');
	$ddn=number_format($ddn,2, '.', '');
	$all=number_format($all,2, '.', '');
		if($dr==""){	
			$strText22="11512|$date2$xrow$vn|$date2$row_id1$vn|$hn|$cid|$datepx|$dateop|$dr1|$pitem|$all|$ddl|$ddn|0.00|||\r\n";
		
			$strFileName2 = "billdisp$thiyr$yrmonth$yrdate.txt";
			$objFopen2 = fopen($strFileName2, 'a');
			fwrite($objFopen2, $strText22);
					
			if($objFopen2){
				/*echo "File writed.";*/
			}else{
				/*echo "File can not write";*/
			}
			fclose($objFopen2);
		}else{
			$strText22="11512|$date2$xrow$vn|$date2$row_id1$vn|$hn|$cid|$datepx|$dateop|$dr1|$pitem|$all|$ddl|$ddn|0.00|||\r\n";
		
			$strFileName2 = "billdisp$thiyr$yrmonth$yrdate.txt";
			$objFopen2 = fopen($strFileName2, 'a');
			fwrite($objFopen2, $strText22);
					
			if($objFopen2){
				/*echo "File writed.";*/
			}else{
				/*echo "File can not write";*/
			}
			fclose($objFopen2);		
		}

	}
}

$strText23="</Dispensing>\n
<DispensedItems>\r\n";
		
			$strFileName2 = "billdisp$thiyr$yrmonth$yrdate.txt";
			$objFopen2 = fopen($strFileName2, 'a');
			fwrite($objFopen2, $strText23);
					
			if($objFopen2){
				/*echo "File writed.";*/
			}else{
				/*echo "File can not write";*/
			}
			fclose($objFopen2);			

$numcscd=0;
   $query="SELECT * FROM reportcscd01  ";
   $result = mysql_query($query);
    while (list ($date,$hn,$vn,$billno,$price,$cerdit,$depart,$paidcscd,$detail,$row_id,$txdate) = mysql_fetch_row ($result)) {	
		$numcscd++;
	$num1=11512;
	$num2=543;
	$num4=1;
	$num3=0;
    $d=substr($txdate,8,2);
    $m=substr($txdate,5,2); 
   	$y=substr($txdate,0,4); 

   	$y1=$y-$num2;
   	$y2=substr($y1,2,2);
   
    $date11="$d/$m/$y2"; 
	$date1="$y1-$m-$d";
	$date2="$y1$m$d";

	$clinic1=substr($clinic,0,2);
	$row_id1=substr($row_id,-4);

	$paidcscd=number_format( $paidcscd, 2, '.', '');
	$vn=sprintf('%04d',$vn);
	$billno=sprintf('%03d',$billno);
	$numcscd=sprintf('%04d',$numcscd);
	$row_id1=sprintf('%04d',$row_id1);
	$numNcscd=$price-$paidcscd;
	$numNcscd=number_format( $numNcscd, 2, '.', '');


	$dphardate = $y."-".$m."-".$d;
	$query3 = "select date,item,doctor,row_id from phardep where hn= '$hn' and date like '$txdate%' and price='$price'";
	$row3 = mysql_query($query3);
	list($datepx,$pitem,$doctor,$xrow) = mysql_fetch_array($row3);
	
	$query6 = "SELECT a.drugcode, b.genname, a.slcode, a.amount, a.price, a.part , c.detail1, c.detail2, c.detail3 ,b.unit ,a.reason,b.tmt FROM drugrx as a , druglst as b , drugslip as c WHERE a.hn = '$hn' AND a.drugcode = b.drugcode AND c.slcode = a.slcode AND a.idno = '$xrow' and (a.part='DDL' or a.part='DDY' or a.part='DDN' or a.part='DSY' or a.part='DSN' )";// or a.part='DPY'
	$row6 = mysql_query($query6);
	while(list($drugcode,$genname,$slcode,$amount,$price,$part,$detail1,$detail2,$detail3,$unit,$reason,$tmt) = mysql_fetch_array($row6)){
		$perunit = number_format($price/$amount,2, '.', '');
		if($part=='DDY'||$part=='DDL'){
			$xpart="1";
			$reimb = $perunit;
		}
		elseif($part=='DDN'){
			$xpart="1";
			$reimb = 0.00;
		}
		elseif($part=='DSY'){
			$xpart="6";
			$sql3 = "select medical_sup_free,freepri from druglst where drugcode = '".$drugcode."' ";
			$row3 = mysql_query($sql3);
			list($supfree,$freepri) = mysql_fetch_array($row3);
			if($supfree==1){
				if($price>$freepri){
					$reimb = $freepri;
				}else{
					$reimb = $perunit;
				}
				//$reimb = $perunit;
			}else{
				$reimb = 0.00;
			}
		}
		else{$xpart="7";
		$reimb = $perunit;}
		
		$first = substr($drugcode,0,1);
		$sec = substr($drugcode,1,1);
		
		if(ord($sec)<48||ord($sec)>57){
			$dose = $first;
		}else{
			$dose = $first.$sec;
		}
		$priceall=$amount*$perunit;
		$reimball=$amount*$reimb;
		$priceall = number_format($priceall,2, '.', '');
		$reimball = number_format($reimball,2, '.', '');
		$reimb = number_format($reimb,2, '.', '');
		if($part=="DDY"){
			if($reason==""){
				$reason="B";
			}
			$claimcontrol="E".substr($reason,0,1);
			if($reason=="") $color="FF0000";
			else{ $color="66CDAA";}
		}else{
			$claimcontrol="";
			$color="66CDAA";
		}
		$tmt=trim($tmt);	
		
		$strText24="$date2$xrow$vn|$xpart|$drugcode|$tmt|$dose|$genname|$unit|$slcode|$detail1 $detail2 $detail3|$amount|$perunit|$priceall|$reimb|$reimball|||$claimcontrol|\r\n";
		
			$strFileName2 = "billdisp$thiyr$yrmonth$yrdate.txt";
			$objFopen2 = fopen($strFileName2, 'a');
			fwrite($objFopen2, $strText24);
					
			if($objFopen2){
				/*echo "File writed.";*/
			}else{
				/*echo "File can not write";*/
			}
			fclose($objFopen2);			
	}
}
$strText25="</DispensedItems>\n
</ClaimRec>\r\n";
		
			$strFileName2 = "billdisp$thiyr$yrmonth$yrdate.txt";
			$objFopen2 = fopen($strFileName2, 'a');
			fwrite($objFopen2, $strText25);
					
			if($objFopen2){
				/*echo "File writed.";*/
			}else{
				/*echo "File can not write";*/
			}
			fclose($objFopen2);			
//-------------------- Close create file diag --------------------//
?>

<?
//-------------------- Add to zip --------------------//
	$dbfname =$yrmonthdate;
	$ZipName = "cscd/$dbfname.zip";
	require_once("dZip.inc.php"); // include Class
	$zip = new dZip($ZipName); // New Class
	$zip->addFile($strFileName1, $strFileName1); // Source,Destination	
	$zip->addFile($strFileName2, $strFileName2); // Source,Destination	
	
	$zip->save();
	
	echo "ดาวน์โหลดข้อมูลยอดโอนเงินจ่ายตรงที่ค้างรับ... <a href=$ZipName>คลิกที่นี่</a> <br>";	
//-------------------- Close add to zip --------------------//
include("unconnect.inc");
?>
