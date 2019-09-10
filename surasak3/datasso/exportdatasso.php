<?
include("../connect.inc");
$thiyr=$_POST["thiyr"]-543;
$yrmonth=$_POST["rptmo"];
$yrdate=$_POST["rptdate"];
$yrmonthdate="$thiyr-$yrmonth-$yrdate";
$gend=date("Y-m-d");
$gent=date("H:i:s");
$gendt=$gend."T".$gent;

// ลบไฟล์ก่อน-----------------)
$filename1 = "BILLTRAN$thiyr$yrmonth$yrdate.txt";
$filename2 = "BILLDISP$thiyr$yrmonth$yrdate.txt";
$filename3= "OPServices$thiyr$yrmonth$yrdate.txt";

if(file_exists("$filename1") && file_exists("$filename2") && file_exists("$filename2")){
	unlink("$filename1");
	unlink("$filename2");
	unlink("$filename3");					
	//echo "ลบข้อมูลเดิมเรียบร้อย </br>";				
}
// จบ ลบไฟล์-----------------)
?>

<?

//-------------------- Create file BillTran ไฟล์ที่ 1 --------------------//
$thimonth=$_POST["thiyr"]."-".$_POST["rptmo"]."-".$_POST["rptdate"];
$numcscd=0;
$cscd="ประกันสังคม";
    $query="CREATE TEMPORARY TABLE reportcscd01 SELECT date,hn,vn,billno,sum(price) as price,credit,depart,sum(paidcscd),detail,row_id,txdate,credit_detail FROM opacc WHERE date LIKE '$thimonth%' and credit = '$cscd' AND paidcscd > $numcscd group by hn, billno" ;
	//echo $query;
    $result = mysql_query($query) or die("Query failed BillTran, Create reportcscd01 Error !!!");

     $query="SELECT * FROM reportcscd01";
     $result = mysql_query($query) or die("Query reportcscd01 failed");
	 $counttran =mysql_num_rows($result);


$query = "SELECT * FROM runno WHERE title = 'ssorun' ";
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

 $query ="UPDATE runno SET runno = $ncscd3  WHERE title='ssorun ' ";
 $result = mysql_query($query);

$strText11="<?xml version=\"1.0\" encoding=\"windows-874\"?>\n
<ClaimRec System=\"OP\" PayPlan=\"SS\" Version=\"0.93\">\n
<Header>\n
<HCODE>11512</HCODE>\n
<HNAME>โรงพยาบาลค่ายสุรศักดิ์มนตรี</HNAME>\n
<DATETIME>$gendt</DATETIME>\n
<SESSNO>$ncscd2</SESSNO>\n
<RECCOUNT>$counttran</RECCOUNT>\n
</Header>\n
<BILLTRAN>\r\n";


$strFileName1 = "BILLTRAN$thiyr$yrmonth$yrdate.txt";
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
while (list ($date,$hn,$vn,$billno,$price,$cerdit,$depart,$paidcscd,$detail,$row_id,$txdate,$vercode) = mysql_fetch_row ($result)) {	  //วนลูป
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
$pay=$price-$paidcscd;  //ค่ารักษารวมทั้งสิ้น - จำนวนเงินที่เบิกได้


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

$tflag="A";  //12.ประเภทการทำรายการ  A=ขอเบิก, E=แก้ไขรายการ, D=ยกเลิกรายการ
$ptname=$name."  ".$surname;  //14.ชื่อ-สกุล ผู้รับบริการ
$hmain="11512";  //15.รหัสสถานพยาบาลหลัก
$payplan="80";  //16.รหัสกองทุนที่จะเบิกค่ารักษาพยาบาล  00=ไม่ใช้สิทธิ, 10=กรมบัญชีกลาง, 20= กทม, 30=กสทช, 31=กกต, 80=ประกันสังคม, 81=กองทุนทดแทน, 86=ทุพลภาพ


$amount=$price;  //9.ยอดเงินรวมการเรียกเก็บค่ารักษา
$otherpay="0.00";  //19.ยอดเงินรวมส่วนที่สิทธิฯ หรือผู้ร่วมจ่ายอื่น ร่วมจ่าย  เช่น สิทธิ พรบ.

if($price > $paidcscd){ 
//echo $hn."=".$price."-->".$paidcscd."<br>";
	$paid=$price - $paidcscd;
	$paid=number_format($paid, 2, '.', '');  //10.ยอดเงินรวมที่ผู้รับบริการจ่ายเป็นเงินสด (มีส่วนเกิน)
	$claimamt=$paidcscd;  //17.ยอดเงินที่ขอเบิก
}else{
	$paid="0.00";  //10.ยอดเงินรวมที่ผู้รับบริการจ่ายเป็นเงินสด  (ไม่มีส่วนเกิน)
	$claimamt=$paidcscd;  //17.ยอดเงินที่ขอเบิก
}

$datetran=$date1.$t;
$subdate=substr($datetran,0,10);
$subtime=substr($datetran,11,8);
$dttran=$subdate."T".$subtime;


$hcode="11512";

$invbillno=str_replace(array("/"," "),'',$billno);	
$invbillno=sprintf('%05d',$invbillno);
$invvn=sprintf('%03d',$vn);

$invno=$date2.$invvn.$invbillno;  //ตั้งค่า billtran.invno ขนาดข้อมูลต้อง >=9 && <= 16

$rowid_new=sprintf('%08d',$row_id);
$billtran_billno=$date2.$rowid_new;  //ตั้งค่า billtran.billno

if($vercode=="ประกันสังคม"){
	$vercode="";
}

//นำข้อมูลเข้า Billtran ชุดที่ 1
$strText12="01|$authcode|$dttran|$hcode|$invno|$billtran_billno|$hn|$memberno|$amount|$paid|$vercode|$tflag|$pid|$ptname|$hmain|$payplan|$claimamt|$otherpayplan|$otherpay\r\n";  //ชุดธุรกรรมการเงิน BillTran มี 19 ฟิลด์

$strFileName1 = "BILLTRAN$thiyr$yrmonth$yrdate.txt";
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
$strFileName1 = "BILLTRAN$thiyr$yrmonth$yrdate.txt";
$objFopen1 = fopen($strFileName1, 'a');
fwrite($objFopen1, $strText13);

	if($objFopen1){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
	fclose($objFopen1);

$count2=0;
$numcscd=0;
$querybit="SELECT date,hn,vn,billno,price price,credit,depart,paidcscd,detail,row_id,txdate,credit_detail FROM opacc WHERE date LIKE '$thimonth%' and credit = '$cscd'  AND paidcscd > $numcscd";
//echo $query;
$resultbit = mysql_query($querybit);
while (list ($date,$hn,$vn,$billno,$price,$cerdit,$depart,$paidcscd,$detail,$row_id,$txdate) = mysql_fetch_row ($resultbit)) {	
			
		if($depart=='PHAR'){
		//echo $depart;
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
					$sql3 = "select medical_sup_free from druglst where drugcode = '".$result2['drugcode']."' ";  //เช็คว่าเป็นเวชภัณฑ์ผู้ป่วยนอกเบิกได้หรือไม่ได้  0=เบิกไม่ได้  1=เบิกได้
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

$strText14="<BillItems>\r\n";  //เริ่ม Billitems

$strFileName1 = "BILLTRAN$thiyr$yrmonth$yrdate.txt";
$objFopen1 = fopen($strFileName1, 'a');
fwrite($objFopen1, $strText14);

	if($objFopen1){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
	fclose($objFopen1);


$numcscd=0;
$querybit="SELECT date,hn,vn,billno,price price,credit,depart,paidcscd,detail,row_id,txdate,credit_detail FROM opacc WHERE date LIKE '$thimonth%' and credit = '$cscd' AND paidcscd > $numcscd";
//echo $querybit;
$resultbit = mysql_query($querybit);
$i=0;
while (list ($date,$hn,$vn,$billno,$price,$cerdit,$depart,$paidcscd,$detail,$row_id,$txdate) = mysql_fetch_row ($resultbit)) {
		$numcscd++;
		$num1=11512;
		$num2=543;
		$num4=1;
		$num3=0;
		$d=substr($txdate,8,2);
		$m=substr($txdate,5,2); 
		$y=substr($txdate,0,4); 
		$t1=substr($txdate,10,9); 
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
		
$invbillno=str_replace(array("/"," "),'',$billno);	
$invbillno=sprintf('%05d',$invbillno);
$invvn=sprintf('%03d',$vn);

$invno=$date2.$invvn.$invbillno;  //อ้างอิง billtran.invno ขนาดข้อมูลต้อง >=9 && <= 16

	
		
if($depart=='PHAR'){  // ค่ายา
			$ddl=0;
			$dpy=0;
			$dsy=0;
			$ddn=0;
			$dpn=0;
			$dpy1 = 0;
			$sql1 = "select * from phardep where date = '".$txdate."' and hn='$hn' and datedr is not null";
			$row1 = mysql_query($sql1);
			$result1 = mysql_fetch_array($row1);
			$xrow=$result1["row_id"];
			
			/**
			 * @readme
			 * ที่ต้องสร้าง SUM(`DPY`) ขึ้นมาอีก 1 ตัวมีปัญหามาจากการ group by part ในตัว Statement
			 * ทำให้กรณีที่มี row ตั้งแต่ 2 ตัวขึ้นไปไม่ได้ค่าผลรวมตามจำนวน
			 */
			$sql2 = "select part,drugcode,sum(amount) as amount,sum(price) as price,DPY,DPN  from drugrx where idno = '".$result1['row_id']."' and amount > 0 and price > 0 group by drugcode, part";
			//echo $sql2."<br>";
			$row2 = mysql_query($sql2);
			while($result2 = mysql_fetch_array($row2)){
			
				$lccode=$result2['drugcode'];
			
				$qty=$result2['amount'];  //7.จำนวนของบริการหรือผลิตภัณฑ์ที่จ่าย
				
				$up=$result2['price']/$result2['amount'];  //8.ราคาขายต่อหน่วย
				$up=number_format($up,2, '.','');
				$chargeamt=$result2['price'];  //ราคาที่เรียกเก็บ
		
				$svdate=$date1;		
				
if($result2["part"]=='DDL'){$billmuad='3';}
else if($result2["part"]=='DDY'){$billmuad='3';}
else if($result2["part"]=='DDN'){$billmuad='3';}
else if($result2["part"]=='DSY'){$billmuad='5';}   //เวชภัณฑ์
else if($result2["part"]=='DSN'){$billmuad='5';}   //เวชภัณฑ์
else if($result2["part"]=='DPY'){$billmuad='2';}  //อุปกรณ์
else if($result2["part"]=='DPN'){$billmuad='2';}  //อุปกรณ์

			$sql3 = "select drugcode,tradname,genname,tmt,edpri,dpy_code,medical_sup_free  from druglst where drugcode = '".$result2['drugcode']."'";
			//echo $sql3;
			$query3 = mysql_query($sql3);
			list($drugcode,$tradname,$genname,$tmt,$edpri,$dpycode,$supfree)=mysql_fetch_array($query3);
			$stdcode=trim($tmt);  //5.รหัสบริการหรือผลิตภัณฑ์ที่กองทุนสุขภาพกำหนด
			$claimup=$edpri;  //10.ราคาเบิกได้ต่อหน่วยที่กองทุนสุขภาพกำหนด
			
if($result2["part"]=='DDL' || $result2["part"]=='DDY'){$claimamount=$chargeamt; $desc=$tradname; $svrefid=$date2.$xrow.$vn; $claimup=$up;  //10.ราคาเบิกได้ต่อหน่วยที่กองทุนสุขภาพกำหนด  //ถ้าเป็นค่ายาต้องระบุ รหัสอ้างอิงจาก Dispenseditems ของไฟล์ Billdisp
}else if($result2["part"]=='DDN'){$claimamount='0.00'; $desc=$tradname; $svrefid=$date2.$xrow.$vn; $claimup='0.00';  //10.ราคาเบิกได้ต่อหน่วยที่กองทุนสุขภาพกำหนด  //ถ้าเป็นค่ายาต้องระบุ รหัสอ้างอิงจาก Dispenseditems ของไฟล์ Billdisp
}else if($result2["part"]=='DSY'){ $desc=$tradname; 

	if($supfree=="0"){  //เบิกไม่ได้
	$claimamount='0.00';
	$claimup='0.00';  //10.ราคาเบิกได้ต่อหน่วยที่กองทุนสุขภาพกำหนด  //เวชภัณฑ์เบิกได้
	}else{
	$claimamount=$chargeamt;
	$claimup=$up;  //10.ราคาเบิกได้ต่อหน่วยที่กองทุนสุขภาพกำหนด  //เวชภัณฑ์เบิกได้
	}
	$svrefid=$date2.$xrow.$vn;
}else if($result2["part"]=='DSN'){  //เวชภัณฑ์เบิกไม่ได้
$claimamount='0.00';  $desc=$tradname;  $svrefid=$date2.$xrow.$vn; $claimup='0.00';  //10.ราคาเบิกได้ต่อหน่วยที่กองทุนสุขภาพกำหนด  
}else if($result2["part"]=='DPY'){  //อุปกรณ์เบิกได้
$claimamount=$chargeamt; $stdcode=$dpycode;  $desc=$tradname; $svrefid=''; $claimup=$up; //10.ราคาเบิกได้ต่อหน่วยที่กองทุนสุขภาพกำหนด 
}else if($result2["part"]=='DPN'){  //อุปกรณ์เบิกไม่ได้
$claimamount='0.00';  $desc=$tradname; $svrefid='';  $claimup='0.00'; 
}  


$claimcat="OP1";  //13.ประเภทบัญชีการเบิก
$lccode=trim($lccode);
$desc=str_replace(array("\r","\n","\r\n",'"',"'","<",">","&"),'',$desc);		
//นำข้อมูลเข้า Billitems กรณีเป็นยา	
//echo $hn."==>".$invno."<br>";
$strText15="$invno|$svdate|$billmuad|$lccode|$stdcode|$desc|$qty|$up|$chargeamt|$claimup|$claimamount|$svrefid|$claimcat\r\n";  
				
				$strFileName1 = "BILLTRAN$thiyr$yrmonth$yrdate.txt";
				$objFopen1 = fopen($strFileName1, 'a');
				fwrite($objFopen1, $strText15);
				
				if($objFopen1){
					/*echo "File writed.";*/
				}else{
					/*echo "File can not write";*/
				}
				fclose($objFopen1);
	
	}  //end while
			
}else{  //ค่าอื่น ๆ นอกเหนือจากค่ายา
				$sql2 = "select *  from patdata where date = '".$txdate."' and  hn='$hn' and price >0 and amount >0";
				//echo $sql2."<br>";
				$row2 = mysql_query($sql2);
				while($result2 = mysql_fetch_array($row2)){	
				//หมวด 3 และหมวด 5 (บางส่วน) อยู่ไฟล์ BillDisp  ปรับเมื่อ 23/01/61 By Amp
				$svrefid=""; //กำหนดให้เป็นค่าว่างไว้ก่อน
				if($result2['part']=="DPY"){
					$billmuad="2";  //ค่าอวัยวะเทียม และอุปกรณ์ในการบำบัด
				}else if($result2['part']=="DSY"){
					$billmuad="5";  //หมวด 5 เวชภัณฑ์ที่ไม่ใช่ยา		
				}elseif($result2['part']=="BLOOD"){
					$billmuad="6";  //ค่าบริการโลหิตและส่วนประกอบของเลือด
				}else if($result2['part']=="LAB"){
					$billmuad="7";  //ค่าตรวจวินิจฉัยทางเทคนิคการแพทย์
				}elseif($result2['part']=="XRAY"){
					$billmuad="8";  //ค่าตรวจวินิจฉัยทางรังสีวิทยา
				}elseif($result2['part']=="SINV"){
					$billmuad="9";  //ค่าตรวจวินิจฉัยโรคโดยวิธีพิเศษอื่นๆ
				}elseif($result2['part']=="TOOL"){
					$billmuad="A";  //หมวด 10 ค่าอุปกรณ์ของใช้และเครื่องมือ 
				}elseif($result2['part']=="SURG"){
					$billmuad="B";  //หมวด 11 ค่าทำหัตถการและวิสัญญี
					//แก้ไขติด T17  เพิ่มเมื่อ 17-09-61 19:30:00
 					$querybb="SELECT row_id FROM opacc WHERE date LIKE '$date%' and hn='$hn' and depart !='PHAR' group by hn, billno,depart,detail" ;
					//echo $querybb."<br>";
    				$resultbb = mysql_query($querybb) or die("Query failed !!!");
					while(list($rowid,$chkdate)=mysql_fetch_array($resultbb)){
						$sqlbb2 = "select *  from patdata where date = '".$chkdate."' and  hn='$hn' and price >0 and amount >0 and part='SURG'";
						//echo $sqlbb2."<br>";
						$rowbb2 = mysql_query($sqlbb2);
						$numbb2 = mysql_num_rows($rowbb2);
						if($numbb2 > 0){
							$rowid=sprintf('%08d',$rowid);  //opacc.row_id			
							$svrefid=$date2.$rowid;  //อ้างอิง OPService.SvID					
						}
					}
					
				}elseif($result2['part']=="NCARE"){
					$billmuad="C";  //หมวด 12 ค่าบริการทางการพยาบาล
				}elseif($result2['part']=="OTHER"){
					$billmuad="C";  //หมวด 12 ค่าบริการทางการพยาบาล					
				}elseif($result2['part']=="DENTA"){  
					$billmuad="D";  //หมวด 13 ค่าบริการทางทันตกรรม
				}elseif($result2['part']=="PT"){
					$billmuad="E";  //หมวด 14 ค่าบริการทางกายภาพบำบัด
				}elseif($result2['part']=="STX"){
					$billmuad="F";  //หมวด 15 ค่าบริการฝังเข็ม
				}elseif($result2['part']=="MC"){
					$billmuad="G";  //หมวด 16 ค่าบริการอื่นๆ
				}else{
					$billmuad="G";  //หมวด 16 ค่าบริการอื่นๆ
				}				
				
			//	echo $depart1;
				$lccode=$result2['code'];
				$lccode=trim($lccode);  //4.รหัส รพ.กำหนด
				
				$qty=$result2['amount'];  //7.จำนวนของบริการหรือผลิตภัณฑ์ที่จ่าย
				$up=$result2['price']/$result2['amount'];  //8.ราคาขายต่อหน่วย
				$up=number_format( $up, 2, '.', '');
					
				$claimup=$result2['yprice']/$result2['amount'];  //10.ราคาเบิกได้ต่อหน่วยที่กองทุนสุขภาพกำหนด
				$claimup=number_format( $claimup, 2, '.', '');
				
				$svdate=$date1;				
				
if($result2["detail"]=="(55020/55021 ค่าบริการผู้ป่วยนอก)"){	
	$stdcode="55020";  //5.รหัสบริการหรือผลิตภัณฑ์ที่กองทุนสุขภาพกำหนด
	$desc="(55020/55021 ค่าบริการผู้ป่วยนอก)";  //6.คำอธิบายของบริการหรือผลิตภัณฑ์
	$claimup="50.00";  //10.ราคาเบิกได้ต่อหน่วยที่กองทุนสุขภาพกำหนด
	$up="50.00";  //8.ราคาขายต่อหน่วย
}else if($result2["detail"]=="(55823 ค่าฉีดยาผู้ป่วยนอก)"){	
	$stdcode="55823";  //5.รหัสบริการหรือผลิตภัณฑ์ที่กองทุนสุขภาพกำหนด
	$desc="(55823 ค่าฉีดยาผู้ป่วยนอก)";  //6.คำอธิบายของบริการหรือผลิตภัณฑ์
	$claimup="20.00";  //10.ราคาเบิกได้ต่อหน่วยที่กองทุนสุขภาพกำหนด
	$up="20.00";  //8.ราคาขายต่อหน่วย
}else{				
			$sql3 = "select codex,detail,price,yprice,nprice  from labcare where code = '".$result2['code']."'";
			//echo $sql3."<br>";
			$query3 = mysql_query($sql3);
			list($codex,$detail,$pricelabcare,$ypricelabcare,$npricelabcare)=mysql_fetch_array($query3);
			$stdcode=trim($codex);  //5.รหัสบริการหรือผลิตภัณฑ์ที่กองทุนสุขภาพกำหนด
			$desc=$detail;  //6.คำอธิบายของบริการหรือผลิตภัณฑ์
					
}

$chargeamt=$up*$qty;  //9.ราคาที่เรียกเก็บ
$chargeamt=number_format( $chargeamt, 2, '.', '');

$claimamount=$claimup*$qty;  //11.ยอดเงินที่ขอเบิก
$claimamount=number_format( $claimamount, 2, '.', '');


$claimcat="OP1";  //13.ประเภทบัญชีการเบิก
$desc=str_replace(array("\r","\n","\r\n",'"',"'","<",">","&"),'',$desc);	
				$strText15="$invno|$svdate|$billmuad|$lccode|$stdcode|$desc|$qty|$up|$chargeamt|$claimup|$claimamount|$svrefid|$claimcat\r\n";  //นำเข้าข้อมูล billitems กรณีที่ไม่ใช่ยา
				//echo $strText15."<br>";
				$strFileName1 = "BILLTRAN$thiyr$yrmonth$yrdate.txt";
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

				$strText16="</BillItems>\r\n";
				$strFileName1 = "BILLTRAN$thiyr$yrmonth$yrdate.txt";
				$objFopen1 = fopen($strFileName1, 'a');
				fwrite($objFopen1, $strText16);
				
					if($objFopen1){
						/*echo "File writed.";*/
					}else{
						/*echo "File can not write";*/
					}
					fclose($objFopen1);
					



					$strText161="</ClaimRec>\r\n";
				$strFileName1 = "BILLTRAN$thiyr$yrmonth$yrdate.txt";
				$objFopen1 = fopen($strFileName1, 'a');
				fwrite($objFopen1, $strText161);
				
					if($objFopen1){
						/*echo "File writed.";*/
					}else{
						/*echo "File can not write";*/
					}
					fclose($objFopen1);			



$md5filetran = md5_file($strFileName1);
$md5filetran1="<?EndNote Checksum=\"".$md5filetran."\"?>";
$objFopen11 = fopen($strFileName1, 'a');
				fwrite($objFopen11,$md5filetran1);
				
					if($objFopen11){
						/*echo "File writed.";*/
					}else{
						/*echo "File can not write";*/
					}
					fclose($objFopen11);		
				
//-------------------- Close create file BillTran --------------------//
?>











<?
//-------------------- Create file BillDisp ไฟล์ที่ 2 --------------------//
$thimonth=$_POST["thiyr"]."-".$_POST["rptmo"]."-".$_POST["rptdate"];
$numcscd=0;
$countdisp=0;
$cscd='ประกันสังคม';
    $query02="CREATE TEMPORARY TABLE reportcscd02 SELECT date,hn,vn,billno,price,credit,depart,sum(paidcscd),detail,row_id,txdate FROM opacc WHERE date LIKE '$thimonth%' and credit = '$cscd' AND depart='PHAR' AND paidcscd > $numcscd  group by row_id" ;  //เอาเฉพาะยา/เวชภัณฑ์ที่เบิกได้
	//echo $query02;
	
    $result02 = mysql_query($query02) or die("Query failed BillDisp, Create reportcscd02 Error !!!");


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
				$sql3 = "select medical_sup_free,freepri from druglst where drugcode = '".$result2['drugcode']."' ";  //เช็คว่าเป็นเวชภัณฑ์ผู้ป่วยนอกเบิกได้หรือไม่ได้  0=เบิกไม่ได้  1=เบิกได้
				
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

$query = "SELECT * FROM runno WHERE title = 'ssorun' ";
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
<ClaimRec System=\"OP\" PayPlan=\"SS\" Version=\"0.93\">\n
<Header>\n
<HCODE>11512</HCODE>\n
<HNAME>ค่ายสุรศักดิ์มนตรี</HNAME>\n
<DATETIME>$gendt</DATETIME>\n
<SESSNO>$ncscd2</SESSNO>\n
<RECCOUNT>$countdisp</RECCOUNT>\n
</Header>\n
<Dispensing>\r\n";

	$strFileName2 = "BILLDISP$thiyr$yrmonth$yrdate.txt";
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
	
	$query4 = "select date,doctor,row_id, hn, tvn, an, price,dpy,dpn from phardep where date = '$txdate' and hn='$hn' and price>0";
	//echo $query4."<br>";
	$row4 = mysql_query($query4);
	list($dateop,$doctor,$xrow, $pHn, $pVn, $pAn, $sumprice, $dpy, $dpn) = mysql_fetch_array($row4);
	$chargeamt=$sumprice-$dpy-$dpn;  //แก้ไขราคาไม่รวมอุปกรณ์ 20/09/61
	
	$ddl=0;
	$ddn=0;
	
	$sql2 = "select sum(price) as price,count(row_id) as counter,part,drugcode  from drugrx where idno = '".$xrow."' AND price >0 group by drugcode, part";  //เพิ่มเงื่อนไข price>0 วันที่ 27/05/59
	//echo "==>$sql2<br>";
	$row2 = mysql_query($sql2);
	$num2=mysql_num_rows($row2);
	$pitem=0;
	while($result2 = mysql_fetch_array($row2)){
	if($result2['part']=="DDL" || $result2['part']=="DDY" || $result2['part']=="DDN" || $result2['part']=="DSY" || $result2['part']=="DSN"){
		$pitem+=$result2['counter'];
	}
		if($result2['part']=="DDL" || $result2['part']=="DDY"){
			$ddl+=$result2['price'];
		}elseif($result2['part']=="DSY"){  //เวชภัณฑ์
			$sql3 = "select medical_sup_free,freepri from druglst where drugcode = '".$result2['drugcode']."' ";  //เช็คว่าเป็นเวชภัณฑ์ผู้ป่วยนอกเบิกได้หรือไม่ได้  0=เบิกไม่ได้  1=เบิกได้
			$row3 = mysql_query($sql3);
			list($supfree,$freepri) = mysql_fetch_array($row3);
			if($supfree==1){  //เบิกได้
				if($result2['price']>$freepri){
					$ddl+=$freepri;
					$ddn+=($result2['price']-$freepri);
				}else{
					$ddl+=$result2['price'];
				}
			}else{//เบิกไม่ได้
				$ddn+=$result2['price'];
			}
		}elseif($result2['part']=="DDN" || $result2['part']=="DSN"){
			$ddn+=$result2['price'];
		}
	}
	if($ddl>0){

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
						
						// @todo ยังไม่ได้เช็คกรณีที่ vn ออกซ้ำ ไม่แน่ใจว่า doctor มันจะออกมาถูกต้องรึป่าว
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
		
// แก้ไขติด S15 เพิ่มเมื่อ 17-9-61 18:47:00
// แก้ไขติด S15 เพิ่มเมื่อ 17-9-61 18:47:00
if($doctor=="MD058  แพทย์แผนไทย"){
	$prescb="-2252";  //หทัยรัตน์
}else if($doctor=="น.ส.หทัยรัตน์ กุลชิงชัย (พท.ป.2252)"){
	$svpid="-2252";  // หทัยรัตน์ 	
}else if($doctor=="อัจฉรา อวดห้าว (พท.ป. 2556)"){
	$prescb="-2556";  //อัจฉรา
}else if($doctor=="MD074  นักกายภาพบำบัด"){
	$prescb="-3023";  //ร.อ. สุทัศน์
}else{
	if($dr1=="ว"){
		$prescb="ว00000";
	}else{
		$prescb=$dr1;
	}
}	
	
	// exit;
	$px1=substr($datepx,8,2); 
    $px2=substr($datepx,5,2); 
    $px3=substr($datepx,0,4)-543; 
	$px4=substr($datepx,11,2); 
	$px5=substr($datepx,14,2); 
	$px6=substr($datepx,17,2); 
	$datepx = "$px3-$px2-$px1"."T"."$px4:$px5:$px6";
	
	$op1=substr($dateop,8,2); 
    $op2=substr($dateop,5,2); 
    $op3=substr($dateop,0,4)-543; 
	$op4=substr($dateop,11,2); 
	$op5=substr($dateop,14,2); 
	$op6=substr($dateop,17,2); 
	$dispdt = "$op3-$op2-$op1"."T"."$op4:$op5:$op6";  //7.วัน-เวลา จ่ายยา
	//echo $datepx."<br>";
	if($datepx=="-543--T::"){ 
		$subdatepx=substr($dateop,0,10);
		$subtimepx=substr($dateop,11,8);
		$datepx=$subdatepx."T".$subtimepx;			
	}
	$all=$ddl+$ddn;
	$ddl=number_format($ddl,2, '.', '');
	$ddn=number_format($ddn,2, '.', '');
	$all=number_format($all,2, '.', '');
	$providerid="11512";
	$dispid=$date2.$xrow.$vn;
	
$invbillno=str_replace(array("/"," "),'',$billno);	
$invbillno=sprintf('%05d',$invbillno);
$invvn=sprintf('%03d',$vn);

$invno=$date2.$invvn.$invbillno;  //อ้างอิง billtran.invno ขนาดข้อมูลต้อง >=9 && <= 16
	
	$paid=$chargeamt-$ddl;
	$paid=number_format($paid,2, '.','');
	$reimburser="HP";  //14.ผู้เบิก
	$benefitplan="SS";  //15.เรียกเก็บค่ายาส่วนที่เบิกได้จาก สวัสดิการ ที่มีสิทธิ
	$dispestat="1";  //16.สถานะการจ่ายยา 1=รับยาแล้ว


$subdateop=substr($dateop,0,10);
$subtimeop=substr($dateop,11,8);
$dispdt=$subdateop."T".$subtimeop;	
	
$txdate=substr($txdate,0,10);

$sql102 = "Select row_id From opday where hn = '$hn' and thidate like '$txdate%'   ";
//echo $sql102."<br>";
$result102 = Mysql_Query($sql102);
list($opday_rowid) = Mysql_fetch_row($result102);

$rowid=sprintf('%08d',$row_id);  //opacc.row_id
$svid=$date2.$rowid;  //ตั้งค่า OPService.SvID
	
		if($dr==""){ 
			$strText22="$providerid|$dispid|$invno|$hn|$cid|$datepx|$dispdt|$prescb|$pitem|$chargeamt|$ddl|$paid|0.00|HP|$benefitplan|$dispestat|$svid|\r\n";  //ใบสั่งยา Dispensing
		
			$strFileName2 = "BILLDISP$thiyr$yrmonth$yrdate.txt";
			$objFopen2 = fopen($strFileName2, 'a');
			fwrite($objFopen2, $strText22);
					
			if($objFopen2){
				/*echo "File writed.";*/
			}else{
				/*echo "File can not write";*/
			}
			fclose($objFopen2);
		}else{
			$strText22="$providerid|$dispid|$invno|$hn|$cid|$datepx|$dispdt|$prescb|$pitem|$chargeamt|$ddl|$paid|0.00|HP|$benefitplan|$dispestat|$svid|\r\n";  //ใบสั่งยา Dispensing
		
			$strFileName2 = "BILLDISP$thiyr$yrmonth$yrdate.txt";
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

			$strFileName2 = "BILLDISP$thiyr$yrmonth$yrdate.txt";
			$objFopen2 = fopen($strFileName2, 'a');
			fwrite($objFopen2, $strText23);
					
			if($objFopen2){
				/*echo "File writed.";*/
			}else{
				/*echo "File can not write";*/
			}
			fclose($objFopen2);	

$numcscd=0;
$querydisp="SELECT * FROM reportcscd02";
$resultdisp = mysql_query($querydisp);
while (list ($date,$hn,$vn,$billno,$price,$cerdit,$depart,$paidcscd,$detail,$row_id,$txdate) = mysql_fetch_row ($resultdisp)) {	  //while1

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
	
	$query6 = "SELECT a.drugcode, b.genname, a.slcode, a.amount, a.price, a.part , c.detail1, c.detail2, c.detail3 ,b.unit ,a.reason, b.drugcode,b.product_category FROM drugrx as a left join druglst as b on a.drugcode = b.drugcode left join drugslip as c on c.slcode = a.slcode WHERE a.hn = '$hn'  AND a.idno = '$xrow' AND a.price >0 and a.part NOT LIKE 'DP%' ";  //เพิ่มเงื่อนไข price>0 วันที่ 27/05/59
	//echo $query6."<br>";
	$row6 = mysql_query($query6);
	while(list($drugcode,$genname,$slcode,$amount,$price,$part,$detail1,$detail2,$detail3,$unit,$reason,$drugcode1,$product_category) = mysql_fetch_array($row6)){  //while2
		$perunit = number_format($price/$amount,2, '.', '');



		if($part=='DDY'||$part=='DDL'){
			$xpart="1";
			$reimb = $perunit;
		}elseif($part=='DDN'){
			$xpart="1";
			$reimb = 0.00;
		}elseif($part=='DSY'){
			$xpart="6";
			$sql3 = "select medical_sup_free,freepri from druglst where drugcode = '".$drugcode."' ";  //เช็คว่าเป็นเวชภัณฑ์ผู้ป่วยนอกเบิกได้หรือไม่ได้  0=เบิกไม่ได้  1=เบิกได้
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

$claimcontrol='';
if($part=="DDY"){
	/*if($reason==""){
	$reason="B";
	$claimcontrol="E".substr($reason,0,1);
	$claimcontrol="IN";
	}else{
	$claimcontrol="E".substr($reason,0,1);
	}*/
	$claimcontrol="";
}else {
	$claimcontrol="OD";
}


if($claimcontrol==''){$claimcontrol="OD";}else{$claimcontrol=$claimcontrol;};

if(trim($detail1) ==""){
		$slcode='b';
		$detail1='.............';
		$detail2='.............';
		$detail3='.............';
}


$sqltmt="select tradname,tmt,dosecode,strength,dpy_code from druglst where drugcode = '$drugcode1'";
//echo "-->".$sqltmt."<br>";
$querytmt=mysql_query($sqltmt);
list($tradname,$tmt,$dosecode,$strength,$dpycode)=mysql_fetch_array($querytmt);

$drugcode1= rtrim($drugcode1);
//echo $drugcode1;
$unit=trim($unit);
$claimcat="OP1";
//echo "$drugcode1==>$part<br>";
if($part=="DSY" || $part=="DSN"){  //เวชภัณฑ์
	$product_category="6";  //เวชภัณฑ์ที่ไม่ใช่ยา
	$tmt="";
}else if($part=="DPY" || $part=="DPN"){  //อุปกรณ์
	$product_category="7";  //อื่นๆ
	$tmt="";
}else{
	if($product_category==''){
		$product_category='1';
	}else{
		$product_category=$product_category;
	}
	$tmt=trim($tmt);
}

$tradname=str_replace(array("\r","\n","\r\n",'"',"'","<",">","&"),'',$tradname);	
		$strText24="$date2$xrow$vn|$product_category|$drugcode1|$tmt|$dsfcode|$tradname|$unit|$slcode|$detail1 $detail2 $detail3|$amount|$perunit|$priceall|$reimb|$reimball||$claimcontrol|$claimcat||\r\n";	
		//echo $strText24."<br>";
		
		
			$strFileName2 = "BILLDISP$thiyr$yrmonth$yrdate.txt";
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
		
			$strFileName2 = "BILLDISP$thiyr$yrmonth$yrdate.txt";
			$objFopen2 = fopen($strFileName2, 'a');
			fwrite($objFopen2, $strText25);
					
			if($objFopen2){
				/*echo "File writed.";*/
			}else{
				/*echo "File can not write";*/
			}
			fclose($objFopen2);
			
$md5filedisp = md5_file($strFileName2);
$md5filedisp2="<?EndNote Checksum=\"".$md5filedisp."\"?>";
$objFopen21 = fopen($strFileName2, 'a');
				fwrite($objFopen21,$md5filedisp2);
				
					if($objFopen21){
						/*echo "File writed.";*/
					}else{
						/*echo "File can not write";*/
					}
					fclose($objFopen21);			
//-------------------- Close create file diag --------------------//
?>













<?
//-------------------- Create file OPServices ไฟล์ที่ 3  --------------------//
$thimonth=$_POST["thiyr"]."-".$_POST["rptmo"]."-".$_POST["rptdate"];
$numcscd=0;
$cscd="ประกันสังคม";
    $query="CREATE TEMPORARY TABLE reportcscd03 SELECT date,hn,vn,billno,price,credit,depart,paidcscd,detail,row_id,txdate,credit_detail FROM opacc WHERE date LIKE '$thimonth%' and credit = '$cscd'  AND paidcscd > $numcscd group by hn, billno,depart,detail" ;
	
	//echo $query;
    $result = mysql_query($query) or die("Query failed OPServices, Create reportcscd03 Error !!!");


     $query="SELECT * FROM reportcscd03";
     $result = mysql_query($query) or die("Query reportcscd03 failed");
	 $counttran =mysql_num_rows($result);
	 
$query = "SELECT * FROM runno WHERE title = 'ssorun' ";
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
$ncscd3 = $ncscd2 +1;

 $query ="UPDATE runno SET runno = $ncscd3  WHERE title='ssorun ' ";
 $result = mysql_query($query);
 
$strText31="<?xml version=\"1.0\" encoding=\"windows-874\"?>\n
<ClaimRec System=\"OP\" PayPlan=\"SS\" Version=\"0.93\">\n
<Header>\n
<HCODE>11512</HCODE>\n
<HNAME>โรงพยาบาลค่ายสุรศักดิ์มนตรี</HNAME>\n
<DATETIME>$gendt</DATETIME>\n
<SESSNO>$ncscd2</SESSNO>\n
<RECCOUNT>$counttran</RECCOUNT>\n
</Header>\n
<OPServices>\r\n";

$strFileName3 = "OPServices$thiyr$yrmonth$yrdate.txt";
$objFopen3 = fopen($strFileName3, 'a');
fwrite($objFopen3, $strText31);

	if($objFopen3){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
	fclose($objFopen3);
	
//-----ส่วนของข้อมูลที่ดึงมาจากระบบ-----//	
$authcode='';
$paidcscdall1=0;

	$query="SELECT * FROM reportcscd03";
	$result = mysql_query($query);
	
    while (list ($date,$hn,$vn,$billno,$price,$cerdit,$depart,$paidcscd,$detail,$row_id,$txdate,$credit_detail) = mysql_fetch_row ($result)) {	  //วนลูป
	$numcscd++;
	$num1=11512;  //รหัสสถานพยาบาล
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
$date21="$m$d";
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


    $d1235=substr($date1,8,2);
    $m1235=substr($date1,5,2); 
	$y1235=substr($date1,0,4); 
    $y1235=$y1235+543;


	
    $d12356=substr($date,8,2);
    $m12356=substr($date,5,2); 
	$y12356=substr($date,0,4); 
   $t1t=substr($date,10,9); 
   $y12356=$y12356-543;
$date11=$y12356.'-'.$m12356.'-'.$d12356;
    $td1235=substr($date,11,2);
    $tm1235=substr($date,14,2); 
	$ty1235=substr($date,17,2); 
$time_date=$td1235.''.$tm1235.''.$ty1235;

$date1235=$y1235.'-'.$m1235.'-'.$d1235;
$sql1235 = "Select clame_code From ipcard where hn = '$hn' and dcdate like '$date1235%'   ";
//echo $sql1235 ;
$result1235 = Mysql_Query($sql1235);
list($authcode) = Mysql_fetch_row($result1235);

$sql12356 = "Select idcard,yot,name,surname From opcard where hn = '$hn'   ";
//echo $sql1235 ;
$result12356 = Mysql_Query($sql12356);
list($idcard,$yot,$name,$surname) = Mysql_fetch_row($result12356);
$fname=$yot.''.$name.'  '.$surname;


$typeserv='';  //ประเภทในการให้บริการ
$typein='';  //ประเภทการเข้ารับบริการ
$clinic='';  //แผนกหรือสถานที่
$sql102 = "Select row_id,doctor,thidate,toborow,clinic From opday where hn = '$hn' and thidate like '$date1235%'   ";
//echo $sql102."<br>" ;
$result102 = Mysql_Query($sql102);
list($opday_rowid,$doctor,$thidate,$toborow,$clinic) = Mysql_fetch_row($result102);

if($doctor=="MD022 (ไม่ทราบแพทย์)"){
	$sql101 = "Select doctor From opd where hn = '$hn' and thidate like '$date1235%'   ";
	//echo $sql101."<br>";
	$result101 = Mysql_Query($sql101);
	list($doctor) = Mysql_fetch_row($result101);
}else{
	$doctor=$doctor;
}


if($clinic=="อายุรกรรม" || $clinic=="01 อายุรกรรม" || $clinic=="01 อายุรแพทย์" || $clinic=="01อายุรแพทย์"){
	$clinic="01";
}else if($clinic=="ศัลยกรรม" || $clinic=="02 ศัลยกรรม"){
	$clinic="02";
}else if($clinic=="สูติกรรม" || $clinic=="03 สูติกรรม" || $clinic=="03 สูตินรีแพทย์"){
	$clinic="03";	
}else if($clinic=="นรีเวชกรรม"){
	$clinic="04";		
}else if($clinic=="กุมารเวชกรรม" || $clinic=="05 กุมารแพทย์" || $clinic=="05 กุมารเวช"){
	$clinic="05";	
}else if($clinic=="โสต ศอ นาสิก" || $clinic=="06 โสต คอ นาสิกแพทย์" || $clinic=="06 โสต ศอ นาสิก"){
	$clinic="06";	
}else if($clinic=="จักษุวิทยา" || $clinic=="07 จักษุ" || $clinic=="07 จักษุแพทย์"){
	$clinic="07";			
}else if($clinic=="ศัลยกรรมออร์โธปิดิกส" || $clinic=="08 ศัลยแพทย์กระดูกแล" || $clinic=="08 ศัลยกรรมกระดูก"){
	$clinic="08";
}else if($clinic=="จิตเวช" || $clinic=="09 จิตเวช"){
	$clinic="09";	
}else if($clinic=="รังสีวิทยา" || $clinic=="11 รังสีแพทย์" || $clinic=="10 รังษีวิทยา"){
	$clinic="10";			
}else if($clinic=="ทันตกรรม" || $clinic=="11 ทันตกรรม"){
	$clinic="11";
}else if($clinic=="เวชศาสตร์ฉุกเฉินและนิติเวช" || $clinic=="12 ฉุกเฉิน"){
	$clinic="12";	
}else{
	if($toborow=="EX07 ทันตกรรม"){
		$clinic="11";
	}else if($toborow=="EX02 ผู้ป่วยฉุกเฉิน"){
		$clinic="12";
	}else{
		$clinic="99";
	}
}

if($toborow=="EX01 รักษาโรคทั่วไปในเวลาราชการ"){
	$typein="1"; //เข้ารับบริการเอง
}else if($toborow=="EX11 รักษาโรคนอกเวลาราชการ"){
	$typein="1"; //เข้ารับบริการเอง	
}else if($toborow=="EX04 ผู้ป่วยนัด"){
	$typein="2"; //เข้ารับบริการตามนัดหมาย
}else if($toborow=="EX02 ผู้ป่วยฉุกเฉิน"){
	$typein="4";  //เข้ารับบริการแบบฉุกเฉิน
}else{
	if($typein==''){$typein='9';}
}

if($toborow=="EX02 ผู้ป่วยฉุกเฉิน"){
	$typeserv="05";  //รับบริการกรณีฉุกเฉิน
}else{
	$typeserv="02";  //รับบริการทั่วไป
}



    $thidated=substr($thidate,8,2);
    $thidatem=substr($thidate,5,2); 
	$thidatey=substr($thidate,0,4); 
	$thidatet1=substr($thidate,11,8); 	

$thidatey=$thidatey-543;
$thidatetall1="$thidatey-$thidatem-$thidated";
$thidatetall2="$m$d";
$begdt=$thidatetall1.'T'.$thidatet1;


	$posdr = strpos($doctor,"(ว.");
	$posdrd = strpos($doctor,"(ท.");
	if($posdr==false){
		if($posdrd==false){
			$seldr = "select doctorcode from doctor where name like '%".substr($doctor,0,9)."%' ";
			$rowdr = mysql_query($seldr);
			list($dr) = mysql_fetch_array($rowdr);
			$dc="ว";
			$dr1="$dc$dr";
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


if($toborow=="EX12 นอนโรงพยาบาล"){
$typeout='2';  //รับเข้าเป็นผู้ป่วยใน
}else{
$typeout='1';  //จำหน่ายกลับบ้าน
}


$completion='Y';
$clamcat='OP1';

// แก้ไขติด S15 เพิ่มเมื่อ 17-9-61 18:47:00
if($doctor=="MD058  แพทย์แผนไทย"){
	$svpid="-2252";  // หทัยรัตน์
}else if($doctor=="น.ส.หทัยรัตน์ กุลชิงชัย (พท.ป.2252)"){
	$svpid="-2252";  // หทัยรัตน์ 
}else if($doctor=="อัจฉรา อวดห้าว (พท.ป. 2556)"){
	$svpid="-2556";  // อัจฉรา
}else if($doctor=="MD074  นักกายภาพบำบัด"){
	$svpid="-3023";  // ร.อ.สุทัศน์
}else{
	if($dr1=="ว"){
		$svpid="ว16633"; //ใส่เลข ว. ผอ.รพ.ค่ายฯ 21/09/61
	}else{
		$svpid=$dr1;
	}
}

$lccode="";
$codeset="";
$stdcode="";
$svcharge="";

$invbillno=str_replace(array("/"," "),'',$billno);	
$invbillno=sprintf('%05d',$invbillno);
$invvn=sprintf('%03d',$vn);

$invno=$date2.$invvn.$invbillno;  //อ้างอิง billtran.invno ขนาดข้อมูลต้อง >=9 && <= 16

$rowid=sprintf('%08d',$row_id);  //opacc.row_id
$svid=$date2.$rowid;  //ตั้งค่า OPService.SvID

$chkdate=substr($txdate,0,10);
if($depart=="PHAR"){  //ถ้าเป็นยา
	$class="EC"; //การตรวจรักษา
}else if($depart=="PATHO"){  //ถ้าเป็นค่าตรวจวิเคราะห์โรค
	$class="EC"; //การตรวจรักษา
}else if($depart=="OTHER" && $detail=="(55020/55021 ค่าบริการผู้ป่วยนอก)"){  //ถ้าเป็นค่าบริการผู้ป่วยนอก
	$class="EC"; //การตรวจรักษา
}else{  //ถ้าเป็นหมวดอื่นๆ
	$sql2 = "select *  from patdata where date like '".$chkdate."%' and  hn='$hn' and price >0 and amount >0 and part='SURG'";
	//echo $sql2."<br>";
	$rowp = mysql_query($sql2);
	$nump=mysql_num_rows($rowp);
	if($nump > 0){  //ถ้ามีข้อมูล
	$resultp=mysql_fetch_array($rowp);
	$class="OP"; //หัตถการ
	$lccode=$resultp["code"];
	$codeset="IN";  //ICD9CM
	
	$qty=$resultp['amount'];  //7.จำนวนของบริการหรือผลิตภัณฑ์ที่จ่าย
	$up=$resultp['price']/$resultp['amount'];  //8.ราคาขายต่อหน่วย	
	$chargeamt=$up*$qty;  //9.ราคาที่เรียกเก็บ
	$svcharge=number_format( $chargeamt, 2, '.', '');		
	
		$sql102 = "Select icd9cm From opday where hn = '$hn' and thidate like '$chkdate%'";
		//echo $sql102."<br>" ;
		$result102 = Mysql_Query($sql102);
		list($icd9cm) = Mysql_fetch_row($result102);
		if($icd9cm==""){  //ถ้าในตาราง opday ไม่มีการลง icd9cm
			$sql106 = "Select icd9cm From opicd9cm where hn = '$hn' and svdate like '$date1235%' ";
			//echo $sql106;
			$result106 = Mysql_Query($sql106);
			list($icd9cm) = Mysql_fetch_row($result106);
			$stdcode=$icd9cm;
		}else{
			$stdcode=$icd9cm;
		}
	
	}else{  //ถ้าไม่มีหัตถการ
		$class="EC"; //การตรวจรักษา
	}
}
//$class="IV"; //การตรวจวินิจฉัยด้วยวิธีพิเศษ
//$class="ZZ"; //อื่นๆ ที่ยังไม่กำหนด


$strText32="$invno|$svid|$class|$num1|$hn|$idcard|1|$typeserv|$typein|$typeout|$dtappoi|$svpid|$clinic|$begdt|$enddt|$lccode|$codeset|$stdcode|$svcharge|$completion|$svtxcode|$clamcat\r\n";
	$strFileName3 = "OPServices$thiyr$yrmonth$yrdate.txt";
	$objFopen3 = fopen($strFileName3, 'a');
	fwrite($objFopen3, $strText32);
			
	if($objFopen3){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
	fclose($objFopen3);

}
//----- จบในส่วนของการดึงข้อมูลในระบบ-----//

$strText33="</OPServices>\n
<OPDx>\r\n";
		
$strFileName3 = "OPServices$thiyr$yrmonth$yrdate.txt";
$objFopen3 = fopen($strFileName3, 'a');
fwrite($objFopen3, $strText33);
				
if($objFopen3){
	/*echo "File writed.";*/
}else{
	/*echo "File can not write";*/
}
fclose($objFopen3);		





//----ดึงข้อมูลในระบบในส่วนที่ 2-----//
$authcode='';
$paidcscdall1=0;
	
	$query="SELECT * FROM reportcscd03";
	$result = mysql_query($query);
    while (list ($date,$hn,$vn,$billno,$price,$cerdit,$depart,$paidcscd,$detail,$row_id,$txdate,$credit_detail) = mysql_fetch_row ($result)) {	  //วนลูป
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
$date21="$m$d";
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


    $d1235=substr($date1,8,2);
    $m1235=substr($date1,5,2); 
	$y1235=substr($date1,0,4); 
    $y1235=$y1235+543;


	
    $d12356=substr($date,8,2);
    $m12356=substr($date,5,2); 
	$y12356=substr($date,0,4); 
   $t1t=substr($date,10,9); 
   $y12356=$y12356-543;
$date11=$y12356.'-'.$m12356.'-'.$d12356;
    $td1235=substr($date,11,2);
    $tm1235=substr($date,14,2); 
	$ty1235=substr($date,17,2); 
$time_date=$td1235.''.$tm1235.''.$ty1235;

$date1235=$y1235.'-'.$m1235.'-'.$d1235;




$sql102 = "Select row_id,doctor,icd10,icd9cm,doctor,toborow,diag From opday where hn = '$hn' and thidate like '$date1235%'   ";
//echo $sql102."<br>" ;
$result102 = Mysql_Query($sql102);
list($opday_rowid,$doctor,$icd10,$icd9cm,$doctor,$toborow,$diag) = Mysql_fetch_row($result102);

if($icd10==""){  //ถ้าในตาราง opday ไม่มีการลง icd10
	$sql106 = "Select icd10 From diag where hn = '$hn' and svdate like '$date1235%' ";
	//echo $sql106;
	$result106 = Mysql_Query($sql106);
	list($icd10) = Mysql_fetch_row($result106);
	//echo "NULL===>".$icd10;
}else{
	$icd10=$icd10;
}

if($icd9cm==""){  //ถ้าในตาราง opday ไม่มีการลง icd9cm
	$sql106 = "Select icd9cm From opicd9cm where hn = '$hn' and svdate like '$date1235%' ";
	//echo $sql106;
	$result106 = Mysql_Query($sql106);
	list($icd9cm) = Mysql_fetch_row($result106);
	//echo "NULL===>".$icd10;
}else{
	$icd9cm=$icd9cm;
}

if($depart=="PHAR"){   //ถ้าเป็นยา หรือ LAB
//echo $row_id;

$typeout='1';
$completion='Y';
$clamcat='OP1';

$rowid=sprintf('%08d',$row_id);  //opacc.row_id
$svid=$date2.$rowid;  //อ้างอิง OPService.SvID

$class="EC"; //การตรวจรักษา
$codeset="TT";  //ICD-10-TM

if($icd10 !=""){  //ถ้ามีการลงรหัส ICD10
	if($icd10 =="U7506"){
		$icd10="U7505";
	}else if($icd10=="S811"){
		$icd10="S818";
	}else if($icd10=="S511"){
		$icd10="S518";
	}else if($icd10=="B181"){
		$icd10="B1819";
	}else if($icd10=="K051"){
		$icd10="K0519";
	}else if($icd10=="R104"){
		$icd10="R1049";
	}else if($icd10=="R11"){
		$icd10="R119";
	}else if($icd10=="I48"){
		$icd10="I489";
	}else if($icd10=="J158"){
		$icd10="J1588";
	}else if($icd10=="R51"){
		$icd10="R510";
	}else if($icd10=="K011"){
		$icd10="K0119";
	}else if($icd10=="S4220"){
		$icd10="S42209";
	}else if($icd10=="K040"){
		$icd10="K0409";
	}else if($icd10=="D180"){
		$icd10="D1809";
	}else if($icd10=="K121"){
		$icd10="K1219";
	}else if($icd10=="I840" || $icd10=="I841" || $icd10=="I842" || $icd10=="I843" || $icd10=="I844" || $icd10=="I845" || $icd10=="I846" || $icd10=="I847" || $icd10=="I848" || $icd10=="I849"){
		$icd10="K648";	
	}else if($icd10=="M6740" || $icd10=="M6741" || $icd10=="M6742" || $icd10=="M6743" || $icd10=="M6744" || $icd10=="M6745" || $icd10=="M6746" || $icd10=="M6747" || $icd10=="M6748" || $icd10=="M6749"){
		$icd10="M674";										
	}else{
		$icd10=$icd10;
	}
		$icd10=trim($icd10);
		$sql103 = "Select code,detail From icd10  where code =  '$icd10'   ";
		//echo $sql103."<br>" ;
		$result103 = Mysql_Query($sql103);
		list($code,$detail) = Mysql_fetch_row($result103);
		
		if($code=="" && $detail==""){
			$code=$icd10;
			$detail=$diag;
		}
		$desc=str_replace(array("\r","\n","\r\n",'"',"'","<",">","&"),'',$detail);
		//echo "$hn===>".$code."<br>" ;
}else{
	if($doctor=="MD058  แพทย์แผนไทย"){  //ระบุตามคำแนะนำพี่ปู Coder รพ.ลำปาง ให้ใส่ M7919
		$icd10="U7505";
	}else if($toborow=="EX20 นวดแผนไทย" || $toborow=="EX94 ออก VN โดย นวดแผนไทย"){
		$icd10="U7505";
	}else if($toborow=="EX19 ออก VN ทำแผล(ต่อเนื่อง)" || $toborow=="EX02 ผู้ป่วยฉุกเฉิน"){	
		$icd10="Z480";
	}else{
		$icd10="";  //ICD10 ข้อมูลว่าง Diag Not Found ใส่ Z480 ไปก่อน ต้องปรับแก้ไขใหม่
	}
	
		$sql109 = "Select code,detail From icd10  where code =  '$icd10'   ";
		//echo $sql109."<br>" ;
		$result109 = Mysql_Query($sql109);
		list($code,$detail) = Mysql_fetch_row($result109);
		$desc=str_replace(array("\r","\n","\r\n",'"',"'","<",">","&"),'',$detail);	
}

if($code=="" && $desc==""){
echo "- ข้อมูลผู้ป่วยวันที่ $date1235 HN : $hn ไม่มีข้อมูลการลงรหัสโรค ICD10 ไม่สามารถส่งเบิกได้ <br>";
}
    $strText34="$class|$svid|1|$codeset|$code|$desc\r\n";
	$strFileName3 = "OPServices$thiyr$yrmonth$yrdate.txt";
	$objFopen3 = fopen($strFileName3, 'a');
	fwrite($objFopen3, $strText34);
			
	if($objFopen3){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
	fclose($objFopen3);
}else if($depart=="PATHO"){   //ถ้าเป็นค่าตรวจวิเคราะห์โรค
//echo $row_id;

$typeout='1';
$completion='Y';
$clamcat='OP1';

$rowid=sprintf('%08d',$row_id);  //opacc.row_id
$svid=$date2.$rowid;  //อ้างอิง OPService.SvID

$class="EC"; //การตรวจรักษา
$codeset="TT";  //ICD-10-TM

if($icd10 !=""){  //ถ้ามีการลงรหัส ICD10
	if($icd10 =="U7506"){
		$icd10="U7505";
	}else if($icd10=="S811"){
		$icd10="S818";
	}else if($icd10=="S511"){
		$icd10="S518";
	}else if($icd10=="B181"){
		$icd10="B1819";
	}else if($icd10=="K051"){
		$icd10="K0519";
	}else if($icd10=="R104"){
		$icd10="R1049";
	}else if($icd10=="R11"){
		$icd10="R119";
	}else if($icd10=="I48"){
		$icd10="I489";
	}else if($icd10=="J158"){
		$icd10="J1588";
	}else if($icd10=="R51"){
		$icd10="R510";
	}else if($icd10=="K011"){
		$icd10="K0119";
	}else if($icd10=="S4220"){
		$icd10="S42209";
	}else if($icd10=="K040"){
		$icd10="K0409";
	}else if($icd10=="D180"){
		$icd10="D1809";
	}else if($icd10=="K121"){
		$icd10="K1219";
	}else if($icd10=="I840" || $icd10=="I841" || $icd10=="I842" || $icd10=="I843" || $icd10=="I844" || $icd10=="I845" || $icd10=="I846" || $icd10=="I847" || $icd10=="I848" || $icd10=="I849"){
		$icd10="K648";	
	}else if($icd10=="M6740" || $icd10=="M6741" || $icd10=="M6742" || $icd10=="M6743" || $icd10=="M6744" || $icd10=="M6745" || $icd10=="M6746" || $icd10=="M6747" || $icd10=="M6748" || $icd10=="M6749"){
		$icd10="M674";										
	}else{
		$icd10=$icd10;
	}
		$icd10=trim($icd10);
		$sql103 = "Select code,detail From icd10  where code =  '$icd10'   ";
		//echo $sql103."<br>" ;
		$result103 = Mysql_Query($sql103);
		list($code,$detail) = Mysql_fetch_row($result103);
		
		if($code=="" && $detail==""){
			$code=$icd10;
			$detail=$diag;
		}
		$desc=str_replace(array("\r","\n","\r\n",'"',"'","<",">","&"),'',$detail);
		//echo "$hn===>".$code."<br>" ;
}else{
	if($doctor=="MD058  แพทย์แผนไทย"){  //ระบุตามคำแนะนำพี่ปู Coder รพ.ลำปาง ให้ใส่ M7919
		$icd10="U7505";
	}else if($toborow=="EX20 นวดแผนไทย" || $toborow=="EX94 ออก VN โดย นวดแผนไทย"){
		$icd10="U7505";
	}else if($toborow=="EX19 ออก VN ทำแผล(ต่อเนื่อง)" || $toborow=="EX02 ผู้ป่วยฉุกเฉิน"){	
		$icd10="Z480";
	}else{
		$icd10="";  //ICD10 ข้อมูลว่าง Diag Not Found ใส่ Z480 ไปก่อน ต้องปรับแก้ไขใหม่
	}
	
		$sql109 = "Select code,detail From icd10  where code =  '$icd10'   ";
		//echo $sql109."<br>" ;
		$result109 = Mysql_Query($sql109);
		list($code,$detail) = Mysql_fetch_row($result109);
		$desc=str_replace(array("\r","\n","\r\n",'"',"'","<",">","&"),'',$detail);	
}

if($code=="" && $desc==""){
echo "- ข้อมูลผู้ป่วยวันที่ $date1235 HN : $hn ไม่มีข้อมูลการลงรหัสโรค ICD10 ไม่สามารถส่งเบิกได้ <br>";
}
    $strText34="$class|$svid|1|$codeset|$code|$desc\r\n";
	$strFileName3 = "OPServices$thiyr$yrmonth$yrdate.txt";
	$objFopen3 = fopen($strFileName3, 'a');
	fwrite($objFopen3, $strText34);
			
	if($objFopen3){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
	fclose($objFopen3);
}else if($depart=="OTHER" && $detail=="(55020/55021 ค่าบริการผู้ป่วยนอก)"){   //ถ้าเป็นค่าตรวจวิเคราะห์โรค
//echo $row_id;

$typeout='1';
$completion='Y';
$clamcat='OP1';

$rowid=sprintf('%08d',$row_id);  //opacc.row_id
$svid=$date2.$rowid;  //อ้างอิง OPService.SvID

$class="EC"; //การตรวจรักษา
$codeset="TT";  //ICD-10-TM

if($icd10 !=""){  //ถ้ามีการลงรหัส ICD10
	if($icd10 =="U7506"){
		$icd10="U7505";
	}else if($icd10=="S811"){
		$icd10="S818";
	}else if($icd10=="S511"){
		$icd10="S518";
	}else if($icd10=="B181"){
		$icd10="B1819";
	}else if($icd10=="K051"){
		$icd10="K0519";
	}else if($icd10=="R104"){
		$icd10="R1049";
	}else if($icd10=="R11"){
		$icd10="R119";
	}else if($icd10=="I48"){
		$icd10="I489";
	}else if($icd10=="J158"){
		$icd10="J1588";
	}else if($icd10=="R51"){
		$icd10="R510";
	}else if($icd10=="K011"){
		$icd10="K0119";
	}else if($icd10=="S4220"){
		$icd10="S42209";
	}else if($icd10=="K040"){
		$icd10="K0409";
	}else if($icd10=="D180"){
		$icd10="D1809";
	}else if($icd10=="K121"){
		$icd10="K1219";
	}else if($icd10=="I840" || $icd10=="I841" || $icd10=="I842" || $icd10=="I843" || $icd10=="I844" || $icd10=="I845" || $icd10=="I846" || $icd10=="I847" || $icd10=="I848" || $icd10=="I849"){
		$icd10="K648";	
	}else if($icd10=="M6740" || $icd10=="M6741" || $icd10=="M6742" || $icd10=="M6743" || $icd10=="M6744" || $icd10=="M6745" || $icd10=="M6746" || $icd10=="M6747" || $icd10=="M6748" || $icd10=="M6749"){
		$icd10="M674";										
	}else{
		$icd10=$icd10;
	}
		$icd10=trim($icd10);
		$sql103 = "Select code,detail From icd10  where code =  '$icd10'   ";
		//echo $sql103."<br>" ;
		$result103 = Mysql_Query($sql103);
		list($code,$detail) = Mysql_fetch_row($result103);
		
		if($code=="" && $detail==""){
			$code=$icd10;
			$detail=$diag;
		}
		$desc=str_replace(array("\r","\n","\r\n",'"',"'","<",">","&"),'',$detail);
		//echo "$hn===>".$code."<br>" ;
}else{
	if($doctor=="MD058  แพทย์แผนไทย"){  //ระบุตามคำแนะนำพี่ปู Coder รพ.ลำปาง ให้ใส่ M7919
		$icd10="U7505";
	}else if($toborow=="EX20 นวดแผนไทย" || $toborow=="EX94 ออก VN โดย นวดแผนไทย"){
		$icd10="U7505";
	}else if($toborow=="EX19 ออก VN ทำแผล(ต่อเนื่อง)" || $toborow=="EX02 ผู้ป่วยฉุกเฉิน"){	
		$icd10="Z480";
	}else{
		$icd10="";  //ICD10 ข้อมูลว่าง Diag Not Found ใส่ Z480 ไปก่อน ต้องปรับแก้ไขใหม่
	}
	
		$sql109 = "Select code,detail From icd10  where code =  '$icd10'   ";
		//echo $sql109."<br>" ;
		$result109 = Mysql_Query($sql109);
		list($code,$detail) = Mysql_fetch_row($result109);
		$desc=str_replace(array("\r","\n","\r\n",'"',"'","<",">","&"),'',$detail);	
}

if($code=="" && $desc==""){
echo "- ข้อมูลผู้ป่วยวันที่ $date1235 HN : $hn ไม่มีข้อมูลการลงรหัสโรค ICD10 ไม่สามารถส่งเบิกได้ <br>";
}
    $strText34="$class|$svid|1|$codeset|$code|$desc\r\n";
	$strFileName3 = "OPServices$thiyr$yrmonth$yrdate.txt";
	$objFopen3 = fopen($strFileName3, 'a');
	fwrite($objFopen3, $strText34);
			
	if($objFopen3){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
	fclose($objFopen3);		
}else{  //ถ้าไม่ใช่ยา เป็นค่าใช้จ่ายอื่นๆ
//echo $row_id;
$chkdate=substr($txdate,0,10);
$sqlp = "select *  from patdata where date like '$chkdate%' AND hn='$hn' and price >0 and amount >0 and part='SURG'";
//echo $sqlp."<br>";
$rowp = mysql_query($sqlp);
$nump=mysql_num_rows($rowp);
$result2 = mysql_fetch_array($rowp);

if($nump > 0){  //ถ้ามีการทำหัตถการ   
//echo $sqlp."<br>";
	$typeout='1';
	$completion='Y';
	$clamcat='OP1';
	
	$rowid=sprintf('%08d',$row_id);  //opacc.row_id
	$svid=$date2.$rowid;  //อ้างอิง OPService.SvID
	
	$class="OP"; //หัตถการ
	$codeset="IN";  //ICD-9-CM
		
		if($icd9cm !=""){  //ถ้ามี icd9cm
			$sql104 = "Select code,detail From icd9cm  where code =  '$icd9cm'";
			//echo $sql104."<br>" ;
			$result104 = Mysql_Query($sql104);
			list($code,$detail) = Mysql_fetch_row($result104);
			
		}else{
			if($result2["code"]=="E-INJ"){
				$code="9922";
				$detail="Inject anti-infect NEC";
			}else if($result2["code"]=="E-IV"){
				$code="9918";
				$detail="Inject/infuse electrolyt";
			}else if($result2["code"]=="E-TAPPING"){
				$code="5491";
				$detail="Paracentesis";
			}else if($result2["code"]=="13103"){
				$code="863";
				$detail="Other local destruc skin";					
			}else{		  //ใส่อะไรดี	
				$sql108 = "Select code,detail From icd9cm  where code ='$icd9cm'";
				//echo $hn."===>".$sql108."<br>" ;
				$result108 = Mysql_Query($sql108);
				list($code,$detail) = Mysql_fetch_row($result108);
			}
			
		}
		$desc=str_replace(array("\r","\n","\r\n",'"',"'","<",">","&"),'',$detail);
if($code=="" && $desc==""){
echo "<div style='color:#0000FF;'>ข้อมูลผู้ป่วยวันที่ $date1235 HN : $hn ไม่มีข้อมูลการทำหัตถการ ICD9CM ไม่สามารถส่งเบิกได้ </div>";
}		
		$strText34="$class|$svid|1|$codeset|$code|$desc\r\n";
		$strFileName3 = "OPServices$thiyr$yrmonth$yrdate.txt";
		$objFopen3 = fopen($strFileName3, 'a');
		fwrite($objFopen3, $strText34);
				
		if($objFopen3){
			/*echo "File writed.";*/
		}else{
			/*echo "File can not write";*/
		}
		fclose($objFopen3);
		
}else{  //ถ้าไม่มีหัตถการ นำเข้าข้อมูลการรักษา EC

$typeout='1';
$completion='Y';
$clamcat='OP1';

$rowid=sprintf('%08d',$row_id);  //opacc.row_id
$svid=$date2.$rowid;  //อ้างอิง OPService.SvID

$class="EC"; //การตรวจรักษา
$codeset="TT";  //ICD-10-TM

if($icd10 !=""){  //ถ้ามีการลงรหัส ICD10
	if($icd10 =="U7506"){
		$icd10="U7505";
	}else if($icd10=="S811"){
		$icd10="S818";
	}else if($icd10=="S511"){
		$icd10="S518";
	}else if($icd10=="B181"){
		$icd10="B1819";
	}else if($icd10=="K051"){
		$icd10="K0519";
	}else if($icd10=="R104"){
		$icd10="R1049";
	}else if($icd10=="R11"){
		$icd10="R119";
	}else if($icd10=="I48"){
		$icd10="I489";
	}else if($icd10=="J158"){
		$icd10="J1588";
	}else if($icd10=="R51"){
		$icd10="R510";
	}else if($icd10=="K011"){
		$icd10="K0119";
	}else if($icd10=="S4220"){
		$icd10="S42209";
	}else if($icd10=="K040"){
		$icd10="K0409";
	}else if($icd10=="D180"){
		$icd10="D1809";
	}else if($icd10=="K121"){
		$icd10="K1219";
	}else if($icd10=="I840" || $icd10=="I841" || $icd10=="I842" || $icd10=="I843" || $icd10=="I844" || $icd10=="I845" || $icd10=="I846" || $icd10=="I847" || $icd10=="I848" || $icd10=="I849"){
		$icd10="K648";	
	}else if($icd10=="M6740" || $icd10=="M6741" || $icd10=="M6742" || $icd10=="M6743" || $icd10=="M6744" || $icd10=="M6745" || $icd10=="M6746" || $icd10=="M6747" || $icd10=="M6748" || $icd10=="M6749"){
		$icd10="M674";										
	}else{
		$icd10=$icd10;
	}
		$icd10=trim($icd10);
		$sql103 = "Select code,detail From icd10  where code =  '$icd10'   ";
		//echo $sql103."<br>" ;
		$result103 = Mysql_Query($sql103);
		list($code,$detail) = Mysql_fetch_row($result103);
		
		if($code=="" && $detail==""){
			$code=$icd10;
			$detail=$diag;
		}
		$desc=str_replace(array("\r","\n","\r\n",'"',"'","<",">","&"),'',$detail);
		//echo "$hn===>".$code."<br>" ;
}else{
	if($doctor=="MD058  แพทย์แผนไทย"){  //ระบุตามคำแนะนำพี่ปู Coder รพ.ลำปาง ให้ใส่ M7919
		$icd10="U7505";
	}else if($toborow=="EX20 นวดแผนไทย" || $toborow=="EX94 ออก VN โดย นวดแผนไทย"){
		$icd10="U7505";
	}else if($toborow=="EX19 ออก VN ทำแผล(ต่อเนื่อง)" || $toborow=="EX02 ผู้ป่วยฉุกเฉิน"){	
		$icd10="Z480";
	}else{
		$icd10="";  //ICD10 ข้อมูลว่าง Diag Not Found ใส่ Z480 ไปก่อน ต้องปรับแก้ไขใหม่
	}
	
		$sql109 = "Select code,detail From icd10  where code =  '$icd10'   ";
		//echo $sql109."<br>" ;
		$result109 = Mysql_Query($sql109);
		list($code,$detail) = Mysql_fetch_row($result109);
		$desc=str_replace(array("\r","\n","\r\n",'"',"'","<",">","&"),'',$detail);	
}

if($code=="" && $desc==""){
echo "- ข้อมูลผู้ป่วยวันที่ $date1235 HN : $hn ไม่มีข้อมูลการลงรหัสโรค ICD10 ไม่สามารถส่งเบิกได้ <br>";
}
    $strText34="$class|$svid|1|$codeset|$code|$desc\r\n";
	$strFileName3 = "OPServices$thiyr$yrmonth$yrdate.txt";
	$objFopen3 = fopen($strFileName3, 'a');
	fwrite($objFopen3, $strText34);
			
	if($objFopen3){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
	fclose($objFopen3);
}	
}
}  //ปิด 
//-----จบการดึงข้อมูลในระบบในส่วนที่ 2-----//


$strText35="</OPDx>\n
</ClaimRec>\r\n";
	$strFileName3 = "OPServices$thiyr$yrmonth$yrdate.txt";
	$objFopen3 = fopen($strFileName3, 'a');
	fwrite($objFopen3, $strText35);
			
	if($objFopen3){
		/*echo "File writed.";*/
	}else{
		/*echo "File can not write";*/
	}
	fclose($objFopen3);


$md5fileops = md5_file($strFileName3);
$md5fileops3="<?EndNote Checksum=\"".$md5fileops."\"?>";
$objFopen31 = fopen($strFileName3, 'a');
				fwrite($objFopen31,$md5fileops3);
				
					if($objFopen31){
						/*echo "File writed.";*/
					}else{
						/*echo "File can not write";*/
					}
					fclose($objFopen31);		
?>

<?
//-------------------- Add to zip --------------------//
$query = "SELECT * FROM runno WHERE title = 'ssorun' ";
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

    $d12356=substr($yrmonthdate,8,2);
    $m12356=substr($yrmonthdate,5,2); 
	$y12356=substr($yrmonthdate,0,4); 
	
	$date11=$y12356.''.$m12356.''.$d12356;


	$dbfname ="11512_SSOPBIL_".$ncscd2."_01_".$date11."-090000";
	//$dbfname =$yrmonthdate;
	$ZipName = "sso/$dbfname.zip";
	require_once("dZip.inc.php"); // include Class
	$zip = new dZip($ZipName); // New Class
	$zip->addFile($strFileName1, $strFileName1); // Source,Destination	
	$zip->addFile($strFileName2, $strFileName2); // Source,Destination	
	$zip->addFile($strFileName3, $strFileName3); // Source,Destination	
	
	$zip->save();
	
	echo "<p>
<div style='color:#FF0000; font-weight:bold;'>โปรแกรมส่งเบิกค่าชดเชยทางการแพทย์ผู้ป่วยนอก สิทธิประกันสังคม (SSO)</div>
<div>ผู้พัฒนาระบบ&nbsp;&nbsp;&nbsp;ส.ต. เทวิน ศรีแก้ว เจ้าหน้าที่ศูนย์บริการคอมพิวเตอร์&nbsp;&nbsp;&nbsp;โทร. 8500</div>
</p>";
echo "<br>";
echo "ดาวน์โหลดข้อมูลลูกหนี้ประกันสังคม เพื่อส่งให้ สกส. วันที่ $yrmonthdate <a href=$ZipName>คลิกที่นี่</a> <br>";
echo "<a href='../exportsso_data.php'><< เลือกวันที่ใหม่</a>";	
//-------------------- Close add to zip --------------------//
include("unconnect.inc");
?>
