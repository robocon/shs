<?
include("../connect.inc");
$thiyr=$_POST["thiyr"]-543;
$yrmonth=$_POST["rptmo"];
$yrdate=$_POST["rptdate"];
$yrmonthdate="$thiyr-$yrmonth-$yrdate";

// ลบไฟล์ก่อน-----------------)
$filename1 = "billtran$thiyr$yrmonth$yrdate.txt";
$filename2 = "billdisp$thiyr$yrmonth$yrdate.txt";

if(file_exists("$filename1") && file_exists("$filename2")){
	unlink("$filename1");
	unlink("$filename2");					
	//echo "ลบข้อมูลเดิมเรียบร้อย </br>";				
}
// จบ ลบไฟล์-----------------)
?>

<?
//-------------------- Create file billtran ไฟล์ที่ 1 --------------------//
$thimonth=$_POST["thiyr"]."-".$_POST["rptmo"]."-".$_POST["rptdate"];
$numcscd=0;
$cscd="จ่ายตรง";
    $query="CREATE TEMPORARY TABLE reportcscd01 SELECT date,hn,vn,billno,price,credit,depart,paidcscd,detail,row_id,txdate FROM opacc WHERE date LIKE '$thimonth%' and credit = '$cscd'  AND paidcscd > $numcscd " ;
	//echo $query;
    $result = mysql_query($query) or die("Query failed billtran, Create reportcscd01 Error !!!");


     $query="SELECT * FROM reportcscd01";
     $result = mysql_query($query) or die("Query reportcscd01 failed");
	 $counttran =mysql_num_rows($result);


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
<DATETIME>2014-10-07 08:33:18</DATETIME>\n
<SESSNO>$ncscd2</SESSNO>\n
<RECCOUNT>$counttran</RECCOUNT>\n
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
	
	$chkdate=substr($txdate,0,10);  //วันที่เกิดค่าใช้จ่าย


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
$pay=$price-$paidcscd;


$sqlopc="select hn from opday where hn='$hn' and thidate like '$chkdate%' and toborow='EX41 ผู้ป่วยในรับยาต่อเนื่องกลับบ้าน (VIP)' order by row_id desc limit 1";
//echo "$sqlopc<br>";
$queryopc=mysql_query($sqlopc);
list($chkhn)=mysql_fetch_array($queryopc);

$sqlip="select opreg from ipcard where hn='$chkhn' and dcdate like '$chkdate%' order by row_id desc limit 1";
//echo "$sqlip<br>";
$queryip=mysql_query($sqlip);
list($authcode)=mysql_fetch_array($queryip);

$sqlpid="select idcard,yot,name,surname from opcard where hn='$hn' limit 1;";
//echo "$sqlpid<br>";
$querypid=mysql_query($sqlpid);
list($pid,$yot,$name,$surname)=mysql_fetch_array($querypid);

$strText12="01|$authcode|$date1$t|11512|$date2$row_id1$vn|$date2$row_id|$hn||$paidcscd|0.00|||$pid\r\n";

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
			$sql1 = "select * from phardep where date = '".$txdate."' and hn='$hn' ";
			$row1 = mysql_query($sql1);
			$result1 = mysql_fetch_array($row1);
			$sql2 = "select sum(price) as suma,part,drugcode  from drugrx where idno = '".$result1['row_id']."' group by part";
			$row2 = mysql_query($sql2);
			while($result2 = mysql_fetch_array($row2)){
				if($result2['part']=="DDL" || $result2['part']=="DDY"){
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
				//echo "1) DDL : $count2 <br>";
			}
			if($dpy>0){
				$count2++;
				//echo "2) DPY : $count2 <br>";
			}
			if($dsy>0){
				$count2++;
				//echo "3) DSY : $count2 <br>";
			}
		}else{
			$sql1 = "select * from depart where date = '".$txdate."' and hn='$hn' ";
			$row1 = mysql_query($sql1);
			$result1 = mysql_fetch_array($row1);
			$sqlp = "select sum(yprice) as sumyprice,part  from patdata where idno = '".$result1['row_id']."' AND yprice > 0 group by part";
			$rowp = mysql_query($sqlp);
			$numchk = mysql_num_rows($rowp);
			while($result2 = mysql_fetch_array($rowp)){
				if($numchk > 0){
					$count2++;
					//echo "5) PATDATA : $count2 <br>";
				}
			}
		}
	}

$strText14="<OPBills invcount=\"$counttran\" lines=\"$count2\">\r\n";

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
$i=0;
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
		
if($depart=='PHAR'){  // ค่ายา
			$ddl=0;
			$dpy=0;
			$dsy=0;
			$ddn=0;
			$dpn=0;
			$dpy1 = 0;
			$sql1 = "select * from phardep where date = '".$txdate."' and hn='$hn' ";
			$row1 = mysql_query($sql1);
			$result1 = mysql_fetch_array($row1);
			
			/**
			 * @readme
			 * ที่ต้องสร้าง SUM(`DPY`) ขึ้นมาอีก 1 ตัวมีปัญหามาจากการ group by part ในตัว Statement
			 * ทำให้กรณีที่มี row ตั้งแต่ 2 ตัวขึ้นไปไม่ได้ค่าผลรวมตามจำนวน
			 */
			$sql2 = "select sum(price) as suma,part,drugcode,DPY,DPN,amount,SUM(`DPY`) AS `sum_dpy`  from drugrx where idno = '".$result1['row_id']."' group by part";
			$row2 = mysql_query($sql2);
			while($result2 = mysql_fetch_array($row2)){
				if($result2['part']=="DDL"||$result2['part']=="DDY"){
					$ddl+=$result2['suma'];
				}elseif($result2['part']=="DDN"){
					$ddn+=$result2['suma'];
				}elseif($result2['part']=="DPY"){
					
					$dpy+=$result2['suma'];
					
					// $dpy1=$result2['DPY'];
					$dpy1 = $result2['sum_dpy']; // ใช้แทน dpy ตัวเดิม
					
					$dpn1=$result2['DPN'];
					
				}elseif($result2['part']=="DPN"){
					$dpn+=$result2['suma'];
				}elseif($result2['part']=="DSN"){
					$dsn+=$result2['suma'];
				}elseif($result2['part']=="DSY"){

					$sql3 = "select dsy,dsn from phardep where row_id = '".$result1['row_id']."' ";
					$row3 = mysql_query($sql3);
					list($dsy,$dsn) = mysql_fetch_array($row3);
					$dsy=$dsy;
					$dsn=$dsn;

				}
			} // End while
			



			if($ddl>0){
				$ddl = number_format($ddl,2);
				//$ddl=number_format($ddl, 2, '.', '');
				$ddl = str_replace(",","",$ddl);
				//$n=$dsn+dsy;
				//$ddl=$ddl+$n;
				$ddlddn=$ddl+$ddn;
				
				$ddlddn=number_format($ddlddn, 2, '.', '');
				$ddn=number_format($ddn, 2, '.', '');

				$n=number_format($n, 2, '.', '');
				$ddl1=$ddl+$ddn;

				$strText15="$date2$row_id1$vn|3|$ddl|0.00\r\n";  //หมวด 3 ค่ายา และสารอาหาร
				
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
				$dpy = str_replace(",","",$dpy);
				$dpydpn=$dpy;
				$dpydpn=number_format($dpydpn, 2, '.', '');
				$dpn=number_format($dpn, 2, '.', '');

				$dpy1=number_format($dpy1, 2, '.', '');
				$dpn1=number_format($dpn1, 2, '.', '');
				$dpydpn=$dpy+$dpn;
				$dpydpn=number_format($dpydpn, 2, '.', '');

				$strText15="$date2$row_id1$vn|2|$dpy1|0.00\r\n";  //หมวด 2 ค่าอวัยวะเทียม และอุปกรณ์ในการบำบัดรักษา
				
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
				//$dsy = number_format($dsy,2);
				$dsy=number_format($dsy, 2, '.', '');
				$strText15="$date2$row_id1$vn|5|$dsy|0.00\r\n";  //หมวด 5 ค่าเวชภัณฑ์ที่ไม่ใช่ยา
				
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
			
}else{  //ค่าอื่น ๆ นอกเหนือจากค่ายา

			$sql1 = "select * from depart where date = '".$txdate."' and hn='$hn' ";
			//echo $sql1."<br>";
			$row1 = mysql_query($sql1);
			$result1 = mysql_fetch_array($row1);
			//$cvn=sprintf('%04d',$result1["tvn"]);
				$sql2 = "select hn,sum(yprice) as sumb,depart,part  from patdata where idno = '".$result1['row_id']."' AND yprice > 0  group by part";
				//echo $sql2;
				$row2 = mysql_query($sql2);
				while($result2 = mysql_fetch_array($row2)){	
				//หมวด 3 และหมวด 5 (บางส่วน) อยู่ไฟล์ Billdisp  ปรับเมื่อ 23/01/61 By Amp
				if($result2['part']=="DPY"){
					$depart1="2";  //ค่าอวัยวะเทียม และอุปกรณ์ในการบำบัด
				}else if($result2['part']=="DSY"){
					$depart1="5";  //หมวด 5 เวชภัณฑ์ที่ไม่ใช่ยา		
				}elseif($result2['part']=="BLOOD"){
					$depart1="6";  //ค่าบริการโลหิตและส่วนประกอบของเลือด
				}else if($result2['part']=="LAB"){
					$depart1="7";  //ค่าตรวจวินิจฉัยทางเทคนิคการแพทย์
				}elseif($result2['part']=="XRAY"){
					$depart1="8";  //ค่าตรวจวินิจฉัยทางรังสีวิทยา
				}elseif($result2['part']=="SINV"){
					$depart1="9";  //ค่าตรวจวินิจฉัยโรคโดยวิธีพิเศษอื่นๆ
				}elseif($result2['part']=="TOOL"){
					$depart1="A";  //หมวด 10 ค่าอุปกรณ์ของใช้และเครื่องมือ 
				}elseif($result2['part']=="SURG"){
					$depart1="B";  //หมวด 11 ค่าทำหัตถการและวิสัญญี
				}elseif($result2['part']=="NCARE"){
					$depart1="C";  //หมวด 12 ค่าบริการทางการพยาบาล
				}elseif($result2['part']=="OTHER"){
					$depart1="C";  //หมวด 12 ค่าบริการทางการพยาบาล					
				}elseif($result2['part']=="DENTA"){  
					$depart1="D";  //หมวด 13 ค่าบริการทางทันตกรรม
				}elseif($result2['part']=="PT"){
					$depart1="E";  //หมวด 14 ค่าบริการทางกายภาพบำบัด
				}elseif($result2['part']=="STX"){
					$depart1="F";  //หมวด 15 ค่าบริการฝังเข็ม
				}elseif($result2['part']=="MC"){
					$depart1="G";  //หมวด 16 ค่าบริการอื่นๆ
				}else{
					$depart1="G";  //หมวด 16 ค่าบริการอื่นๆ
				}				
				
			//	echo $depart1;
	
				$npaidcscd111=$price-$paidcscd;
				$sumb=$result2['sumb'];  //ราคาที่เบิกได้
				
				$strText15="$date2$row_id1$vn|$depart1|$sumb|0.00\r\n";  //เพิ่มรายการใน OPBills ของไฟล์ Billtran
				//echo $strText15."<br>";
				$strFileName1 = "billtran$thiyr$yrmonth$yrdate.txt";
				$objFopen1 = fopen($strFileName1, 'a');
				fwrite($objFopen1, $strText15);
				
					if($objFopen1){
						/*echo "File writed.";*/
					}else{
						/*echo "File can not write";*/
					}
					fclose($objFopen1);	
				}  //close patdata
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
$thimonth=$_POST["thiyr"]."-".$_POST["rptmo"]."-".$_POST["rptdate"];
$numcscd=0;
$cscd='จ่ายตรง';
    $query02="CREATE TEMPORARY TABLE reportcscd02 SELECT date,hn,vn,billno,price,credit,depart,paidcscd,detail,row_id,txdate FROM opacc WHERE date LIKE '$thimonth%' and credit = '$cscd' AND depart='PHAR' AND paidcscd > $numcscd AND (essd >0 OR nessdy >0) " ;  //เพิ่มคำสั่ง AND (essd >0 OR nessdy >0) วันที่ 27/05/59 เอาเฉพาะยาที่เบิกได้
	//echo $query02;
	
    $result02 = mysql_query($query02) or die("Query failed billdisp, Create reportcscd02 Error !!!");


     $querytmp02="SELECT * FROM reportcscd02";
     $resulttmp02 = mysql_query($querytmp02) or die("Query xxx failed");
	 while (list ($date,$hn,$vn,$billno,$price,$cerdit,$depart,$paidcscd,$detail,$row_id,$txdate) = mysql_fetch_row ($resulttmp02)) {	
		 $query3 = "select date,item,doctor,row_id from phardep where date = '$txdate' and price>0 and hn='$hn' ";
		 $row3 = mysql_query($query3);
		 list($datepx,$pitem,$doctor,$xrow) = mysql_fetch_array($row3);
		 $ddl=0;
		 $sql2 = "select sum(price) as suma,part,drugcode  from drugrx where idno = '".$xrow."' group by part";
		 $row2 = mysql_query($sql2);
		 $e;
		 while($result2 = mysql_fetch_array($row2)){
		
			 if($result2['part']=="DDL"||$result2['part']=="DDY"){
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
	
	$query4 = "select date,doctor,row_id, hn, tvn, an from phardep where date = '$txdate' and hn='$hn' and price>0";
	$row4 = mysql_query($query4);
	list($dateop,$doctor,$xrow, $pHn, $pVn, $pAn) = mysql_fetch_array($row4);
	
	$ddl=0;
	$ddn=0;
	
	$sql2 = "select sum(price) as price,count(row_id) as counter,part,drugcode  from drugrx where idno = '".$xrow."' and (part='DDL' or part='DDY') AND price >0 group by part,drugcode";  //เพิ่มเงื่อนไข price>0 วันที่ 27/05/59
	//echo "==>$sql2<br>";
	$row2 = mysql_query($sql2);
	$num2=mysql_num_rows($row2);
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
		
//echo $doctor;
// echo "<pre>";
// var_dump($doctor);
// echo "</pre>";

		$posdr = strpos($doctor,"(ว.");
		$posdrd = strpos($doctor,"(ท.");
		$posdrd1 = strpos($doctor,"(พท.ป");
		
		if($posdr==false){ // ไม่มี ว.
			if($posdrd==false){ // ไม่มี ท.
				if($posdrd1==false){ // ไม่มี พท.ป
					$seldr = "select doctorcode from doctor where name like '%".substr($doctor,0,9)."%' ";
					$rowdr = mysql_query($seldr);
					
					$numrow_dr = mysql_num_rows($rowdr);
					
					if( $numrow_dr > 0 ){
						list($dr) = mysql_fetch_array($rowdr);
						$dc="ว";
						$dr1="$dc$dr";
					}else{ // ถ้ายังไม่มีเลขหมอให้กลับไปหาใน opday
						
						list($opDate, $opTime) = explode(' ', $dateop);
						
						if( !empty($pVn) ){
							$whereOpd = " `vn` = '$pVn'";
						}else{
							$whereOpd = " `an` = '$pAn'";
						}
						
						// @todo ยังไม่ได้เช็กกรณีที่ vn ออกซ้ำ ไม่แน่ใจว่า doctor มันจะออกมาถูกต้องรึป่าว
						$sql = "SELECT `doctor` 
						FROM `opday` 
						WHERE `thidate` LIKE '$opDate%' 
						AND `hn` = '$pHn' 
						AND $whereOpd ";
						$query = mysql_query($sql);
						$opday = mysql_fetch_assoc($query);
						
						$match = preg_match('/(MD\d+)/', $opday['doctor'], $word);
						if( $match > 0 ){
							$sql = "SELECT `doctorcode` FROM `doctor` WHERE `name` LIKE '".$word['1']."%'";
							$query = mysql_query($sql);
							$doc = mysql_fetch_assoc($query);
							$dr1 = "ว".$doc['doctorcode'];
						}
						
					}
					
				}else{
					$dr = substr($doctor,($posdrd1+6),4);
					$dc="-";
					$dr1="$dc$dr";
				
				}
				
			}else{
				$dr = substr($doctor,($posdrd+3),4);
				$dc="ท";
				$dr1="$dc$dr";
			}
			
		}else{
			$dr = substr($doctor,($posdr+3),5);
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
	
	// exit;
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
			$strText22="11512|$date2$xrow$vn|$date2$row_id1$vn|$hn|$cid|$datepx|$dateop|$dr1|$pitem|$ddl|$ddl|0.00|0.00|||\r\n";
		
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
			$strText22="11512|$date2$xrow$vn|$date2$row_id1$vn|$hn|$cid|$datepx|$dateop|$dr1|$pitem|$ddl|$ddl|$ddn|0.00|||\r\n";
		
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

	} // if ddl > 0
}

// exit;



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
$query="SELECT * FROM reportcscd01";
$result = mysql_query($query);
while (list ($date,$hn,$vn,$billno,$price,$cerdit,$depart,$paidcscd,$detail,$row_id,$txdate) = mysql_fetch_row ($result)) {	  //while1
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
	$query3 = "select date,item,doctor,row_id from phardep where hn= '$hn' and date like '$txdate%'  and price='$price' ";
	//echo "-->".$query3."<br>";
	$row3 = mysql_query($query3);
	list($datepx,$pitem,$doctor,$xrow) = mysql_fetch_array($row3);
	
	$query6 = "SELECT a.drugcode, b.genname, a.slcode, a.amount, a.price, a.part , c.detail1, c.detail2, c.detail3 ,b.unit ,a.reason, b.drugcode,b.product_category FROM drugrx as a left join druglst as b on a.drugcode = b.drugcode left join drugslip as c on c.slcode = a.slcode WHERE a.hn = '$hn' and (a.part='DDL' or a.part='DDY' ) AND a.idno = '$xrow' AND a.price >0";  //เพิ่มเงื่อนไข price>0 วันที่ 27/05/59
	//echo $query6."<br>";
	$row6 = mysql_query($query6);
	while(list($drugcode,$genname,$slcode,$amount,$price,$part,$detail1,$detail2,$detail3,$unit,$reason,$drugcode1,$product_category) = mysql_fetch_array($row6)){  //while2
		$perunit = number_format($price/$amount,2, '.', '');

//$sql = "Select drugcode From druglst where drugcode = '$drugcode' ";
//$result = Mysql_Query($sql);
//list($drugcode1) = Mysql_fetch_row($result);

//echo 	$drugcode/$drugcode1 ;



		if($part=='DDY'||$part=='DDL'){
			$xpart="1";
			$reimb = $perunit;
		}elseif($part=='DDN'){
			$xpart="1";
			$reimb = 0.00;
		}elseif($part=='DSY'){
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
		}else{$xpart="7";
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
		$claimcontrol="E".substr($reason,0,1);
	}else{
		$claimcontrol="E".substr($reason,0,1);
	}
}else{
$claimcontrol="";
}	

if(trim($detail1) ==""){
		$slcode='b';
		$detail1='.............';
		$detail2='.............';
		$detail3='.............';
}


$sqltmt="select tmt from druglst where drugcode = '$drugcode1'";
//echo "-->".$sqltmt."<br>";
$querytmt=mysql_query($sqltmt);
list($tmt)=mysql_fetch_array($querytmt);
$tmt=trim($tmt);

//echo $drugcode1;
$drugcode1= rtrim($drugcode1);
//echo $drugcode1;

if($product_category==''){$product_category='1';} else {$product_category=$product_category;};
		$strText24="$date2$xrow$vn|$product_category|$drugcode1|$tmt|$dose|$genname|$unit|$slcode|$detail1 $detail2 $detail3|$amount|$perunit|$priceall|$reimb|$reimball|||$claimcontrol|\r\n";
		
		
			$strFileName2 = "billdisp$thiyr$yrmonth$yrdate.txt";
			$objFopen2 = fopen($strFileName2, 'a');
			fwrite($objFopen2, $strText24);
					
			if($objFopen2){
				/*echo "File writed.";*/
			}else{
				/*echo "File can not write";*/
			}
			fclose($objFopen2);	
	}  //close while2	
}  //close while1

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
	
	echo "<p>
<div style='color:#FF0000; font-weight:bold;'>โปรแกรมส่งเบิกค่าชดเชยทางการแพทย์ผู้ป่วยนอก สิทธิเบิกจ่ายตรง (CSCD)</div>
<div style='color:#0000FF;'>ปรับปรุงล่าสุด Date.11/05/2561 By Pfc.แอมป์ โทร.6203</div></p>";
echo "<div style='margin-left: 15px;'>1) ปรับปรุงไฟล์ BillTran เพิ่มเลขที่บัตรประชาชน (PID) ในฟิลด์ที่ 13</div>";
echo "<br>";
echo "ดาวน์โหลดข้อมูลลูกหนี้เบิกจ่ายตรง เพื่อส่งให้ สกส. วันที่ $yrmonthdate <a href=$ZipName>คลิกที่นี่</a> <br>";
echo "<a href='../exportcscd_data.php'><< เลือกวันที่ใหม่</a>";	
//-------------------- Close add to zip --------------------//
include("unconnect.inc");
?>
