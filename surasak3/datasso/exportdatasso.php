<?
include("../connect.inc");
$thiyr=$_POST["thiyr"]-543;
$yrmonth=$_POST["rptmo"];
$yrdate=$_POST["rptdate"];
$yrmonthdate="$thiyr-$yrmonth-$yrdate";
$gend=date("Y-m-d");
$gent=date("H:i:s");
$gendt=$gend."T".$gent;

// ź����͹-----------------)
$filename1 = "BILLTRAN$thiyr$yrmonth$yrdate.txt";
$filename2 = "BILLDISP$thiyr$yrmonth$yrdate.txt";
$filename3= "OPServices$thiyr$yrmonth$yrdate.txt";

if(file_exists("$filename1") && file_exists("$filename2") && file_exists("$filename2")){
	unlink("$filename1");
	unlink("$filename2");
	unlink("$filename3");					
	//echo "ź������������º���� </br>";				
}
// �� ź���-----------------)
?>

<?

//-------------------- Create file BillTran ����� 1 --------------------//
$thimonth=$_POST["thiyr"]."-".$_POST["rptmo"]."-".$_POST["rptdate"];
$numcscd=0;
$cscd="��Сѹ�ѧ��";
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
<HNAME>�ç��Һ�Ť�������ѡ��������</HNAME>\n
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
while (list ($date,$hn,$vn,$billno,$price,$cerdit,$depart,$paidcscd,$detail,$row_id,$txdate,$vercode) = mysql_fetch_row ($result)) {	  //ǹ�ٻ
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
	
	$chkdate=substr($txdate,0,10);  //�ѹ����Դ��������


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
if($detail=="�����"){$t=$ti1;} else
if($detail=="(55020/55021)��Һ�ԡ�ü����¹͡"){$t=$ti2;}
  else{$t=$ti3;};

$numNcscd=$price-$paidcscd;
$vn=sprintf('%04d',$vn);
$billno=sprintf('%03d',$billno);
$numcscd=sprintf('%04d',$numcscd);
$paidcscd=number_format( $paidcscd, 2, '.', '');
$numNcscd=number_format( $numNcscd, 2, '.', '');
$row_id1=sprintf('%04d',$row_id1);
$pay=$price-$paidcscd;  //����ѡ����������� - �ӹǹ�Թ����ԡ��


$sqlopc="select hn from opday where hn='$hn' and thidate like '$chkdate%' and toborow='EX41 ��������Ѻ�ҵ�����ͧ��Ѻ��ҹ (VIP)' order by row_id desc limit 1";
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

$tflag="A";  //12.��������÷���¡��  A=���ԡ, E=�����¡��, D=¡��ԡ��¡��
$ptname=$name."  ".$surname;  //14.����-ʡ�� ����Ѻ��ԡ��
$hmain="11512";  //15.����ʶҹ��Һ����ѡ
$payplan="80";  //16.���ʡͧ�ع�����ԡ����ѡ�Ҿ�Һ��  00=������Է��, 10=����ѭ�ա�ҧ, 20= ���, 30=�ʷ�, 31=���, 80=��Сѹ�ѧ��, 81=�ͧ�ع��᷹, 86=�ؾ��Ҿ


$amount=$price;  //9.�ʹ�Թ���������¡�纤���ѡ��
$otherpay="0.00";  //19.�ʹ�Թ�����ǹ����Է��� ���ͼ������������� ��������  �� �Է�� �ú.

if($price > $paidcscd){ 
//echo $hn."=".$price."-->".$paidcscd."<br>";
	$paid=$price - $paidcscd;
	$paid=number_format($paid, 2, '.', '');  //10.�ʹ�Թ���������Ѻ��ԡ�è������Թʴ (����ǹ�Թ)
	$claimamt=$paidcscd;  //17.�ʹ�Թ�����ԡ
}else{
	$paid="0.00";  //10.�ʹ�Թ���������Ѻ��ԡ�è������Թʴ  (�������ǹ�Թ)
	$claimamt=$paidcscd;  //17.�ʹ�Թ�����ԡ
}

$datetran=$date1.$t;
$subdate=substr($datetran,0,10);
$subtime=substr($datetran,11,8);
$dttran=$subdate."T".$subtime;


$hcode="11512";

$invbillno=str_replace(array("/"," "),'',$billno);	
$invbillno=sprintf('%05d',$invbillno);
$invvn=sprintf('%03d',$vn);

$invno=$date2.$invvn.$invbillno;  //��駤�� billtran.invno ��Ҵ�����ŵ�ͧ >=9 && <= 16

$rowid_new=sprintf('%08d',$row_id);
$billtran_billno=$date2.$rowid_new;  //��駤�� billtran.billno

if($vercode=="��Сѹ�ѧ��"){
	$vercode="";
}

//�Ӣ�������� Billtran �ش��� 1
$strText12="01|$authcode|$dttran|$hcode|$invno|$billtran_billno|$hn|$memberno|$amount|$paid|$vercode|$tflag|$pid|$ptname|$hmain|$payplan|$claimamt|$otherpayplan|$otherpay\r\n";  //�ش��á�������Թ BillTran �� 19 ��Ŵ�

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
					$sql3 = "select medical_sup_free from druglst where drugcode = '".$result2['drugcode']."' ";  //��������Ǫ�ѳ������¹͡�ԡ�����������  0=�ԡ�����  1=�ԡ��
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

$strText14="<BillItems>\r\n";  //����� Billitems

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

$invno=$date2.$invvn.$invbillno;  //��ҧ�ԧ billtran.invno ��Ҵ�����ŵ�ͧ >=9 && <= 16

	
		
if($depart=='PHAR'){  // �����
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
			 * ����ͧ���ҧ SUM(`DPY`) ������ա 1 ����ջѭ���Ҩҡ��� group by part 㹵�� Statement
			 * �����óշ���� row ����� 2 ��Ǣ���������Ҽ��������ӹǹ
			 */
			$sql2 = "select part,drugcode,sum(amount) as amount,sum(price) as price,DPY,DPN  from drugrx where idno = '".$result1['row_id']."' and amount > 0 and price > 0 group by drugcode, part";
			//echo $sql2."<br>";
			$row2 = mysql_query($sql2);
			while($result2 = mysql_fetch_array($row2)){
			
				$lccode=$result2['drugcode'];
			
				$qty=$result2['amount'];  //7.�ӹǹ�ͧ��ԡ�����ͼ�Ե�ѳ�������
				
				$up=$result2['price']/$result2['amount'];  //8.�ҤҢ�µ��˹���
				$up=number_format($up,2, '.','');
				$chargeamt=$result2['price'];  //�Ҥҷ�����¡��
		
				$svdate=$date1;		
				
if($result2["part"]=='DDL'){$billmuad='3';}
else if($result2["part"]=='DDY'){$billmuad='3';}
else if($result2["part"]=='DDN'){$billmuad='3';}
else if($result2["part"]=='DSY'){$billmuad='5';}   //�Ǫ�ѳ��
else if($result2["part"]=='DSN'){$billmuad='5';}   //�Ǫ�ѳ��
else if($result2["part"]=='DPY'){$billmuad='2';}  //�ػ�ó�
else if($result2["part"]=='DPN'){$billmuad='2';}  //�ػ�ó�

			$sql3 = "select drugcode,tradname,genname,tmt,edpri,dpy_code,medical_sup_free  from druglst where drugcode = '".$result2['drugcode']."'";
			//echo $sql3;
			$query3 = mysql_query($sql3);
			list($drugcode,$tradname,$genname,$tmt,$edpri,$dpycode,$supfree)=mysql_fetch_array($query3);
			$stdcode=trim($tmt);  //5.���ʺ�ԡ�����ͼ�Ե�ѳ����ͧ�ع�آ�Ҿ��˹�
			$claimup=$edpri;  //10.�Ҥ��ԡ����˹��·��ͧ�ع�آ�Ҿ��˹�
			
if($result2["part"]=='DDL' || $result2["part"]=='DDY'){$claimamount=$chargeamt; $desc=$tradname; $svrefid=$date2.$xrow.$vn; $claimup=$up;  //10.�Ҥ��ԡ����˹��·��ͧ�ع�آ�Ҿ��˹�  //����繤���ҵ�ͧ�к� ������ҧ�ԧ�ҡ Dispenseditems �ͧ��� Billdisp
}else if($result2["part"]=='DDN'){$claimamount='0.00'; $desc=$tradname; $svrefid=$date2.$xrow.$vn; $claimup='0.00';  //10.�Ҥ��ԡ����˹��·��ͧ�ع�آ�Ҿ��˹�  //����繤���ҵ�ͧ�к� ������ҧ�ԧ�ҡ Dispenseditems �ͧ��� Billdisp
}else if($result2["part"]=='DSY'){ $desc=$tradname; 

	if($supfree=="0"){  //�ԡ�����
	$claimamount='0.00';
	$claimup='0.00';  //10.�Ҥ��ԡ����˹��·��ͧ�ع�آ�Ҿ��˹�  //�Ǫ�ѳ���ԡ��
	}else{
	$claimamount=$chargeamt;
	$claimup=$up;  //10.�Ҥ��ԡ����˹��·��ͧ�ع�آ�Ҿ��˹�  //�Ǫ�ѳ���ԡ��
	}
	$svrefid=$date2.$xrow.$vn;
}else if($result2["part"]=='DSN'){  //�Ǫ�ѳ���ԡ�����
$claimamount='0.00';  $desc=$tradname;  $svrefid=$date2.$xrow.$vn; $claimup='0.00';  //10.�Ҥ��ԡ����˹��·��ͧ�ع�آ�Ҿ��˹�  
}else if($result2["part"]=='DPY'){  //�ػ�ó��ԡ��
$claimamount=$chargeamt; $stdcode=$dpycode;  $desc=$tradname; $svrefid=''; $claimup=$up; //10.�Ҥ��ԡ����˹��·��ͧ�ع�آ�Ҿ��˹� 
}else if($result2["part"]=='DPN'){  //�ػ�ó��ԡ�����
$claimamount='0.00';  $desc=$tradname; $svrefid='';  $claimup='0.00'; 
}  


$claimcat="OP1";  //13.�������ѭ�ա���ԡ
$lccode=trim($lccode);
$desc=str_replace(array("\r","\n","\r\n",'"',"'","<",">","&"),'',$desc);		
//�Ӣ�������� Billitems �ó�����	
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
			
}else{  //������ � �͡�˹�ͨҡ�����
				$sql2 = "select *  from patdata where date = '".$txdate."' and  hn='$hn' and price >0 and amount >0";
				//echo $sql2."<br>";
				$row2 = mysql_query($sql2);
				while($result2 = mysql_fetch_array($row2)){	
				//��Ǵ 3 �����Ǵ 5 (�ҧ��ǹ) ������� BillDisp  ��Ѻ����� 23/01/61 By Amp
				$svrefid=""; //��˹�����繤����ҧ����͹
				if($result2['part']=="DPY"){
					$billmuad="2";  //������������� ����ػ�ó�㹡�úӺѴ
				}else if($result2['part']=="DSY"){
					$billmuad="5";  //��Ǵ 5 �Ǫ�ѳ�����������		
				}elseif($result2['part']=="BLOOD"){
					$billmuad="6";  //��Һ�ԡ�����Ե�����ǹ��Сͺ�ͧ���ʹ
				}else if($result2['part']=="LAB"){
					$billmuad="7";  //��ҵ�Ǩ�ԹԨ��·ҧ෤�Ԥ���ᾷ��
				}elseif($result2['part']=="XRAY"){
					$billmuad="8";  //��ҵ�Ǩ�ԹԨ��·ҧ�ѧ���Է��
				}elseif($result2['part']=="SINV"){
					$billmuad="9";  //��ҵ�Ǩ�ԹԨ����ä���Ըվ��������
				}elseif($result2['part']=="TOOL"){
					$billmuad="A";  //��Ǵ 10 ����ػ�ó�ͧ���������ͧ��� 
				}elseif($result2['part']=="SURG"){
					$billmuad="B";  //��Ǵ 11 ��ҷ��ѵ����������ѭ��
					//��䢵Դ T17  ��������� 17-09-61 19:30:00
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
							$svrefid=$date2.$rowid;  //��ҧ�ԧ OPService.SvID					
						}
					}
					
				}elseif($result2['part']=="NCARE"){
					$billmuad="C";  //��Ǵ 12 ��Һ�ԡ�÷ҧ��þ�Һ��
				}elseif($result2['part']=="OTHER"){
					$billmuad="C";  //��Ǵ 12 ��Һ�ԡ�÷ҧ��þ�Һ��					
				}elseif($result2['part']=="DENTA"){  
					$billmuad="D";  //��Ǵ 13 ��Һ�ԡ�÷ҧ�ѹ�����
				}elseif($result2['part']=="PT"){
					$billmuad="E";  //��Ǵ 14 ��Һ�ԡ�÷ҧ����Ҿ�ӺѴ
				}elseif($result2['part']=="STX"){
					$billmuad="F";  //��Ǵ 15 ��Һ�ԡ�ýѧ���
				}elseif($result2['part']=="MC"){
					$billmuad="G";  //��Ǵ 16 ��Һ�ԡ������
				}else{
					$billmuad="G";  //��Ǵ 16 ��Һ�ԡ������
				}				
				
			//	echo $depart1;
				$lccode=$result2['code'];
				$lccode=trim($lccode);  //4.���� þ.��˹�
				
				$qty=$result2['amount'];  //7.�ӹǹ�ͧ��ԡ�����ͼ�Ե�ѳ�������
				$up=$result2['price']/$result2['amount'];  //8.�ҤҢ�µ��˹���
				$up=number_format( $up, 2, '.', '');
					
				$claimup=$result2['yprice']/$result2['amount'];  //10.�Ҥ��ԡ����˹��·��ͧ�ع�آ�Ҿ��˹�
				$claimup=number_format( $claimup, 2, '.', '');
				
				$svdate=$date1;				
				
if($result2["detail"]=="(55020/55021 ��Һ�ԡ�ü����¹͡)"){	
	$stdcode="55020";  //5.���ʺ�ԡ�����ͼ�Ե�ѳ����ͧ�ع�آ�Ҿ��˹�
	$desc="(55020/55021 ��Һ�ԡ�ü����¹͡)";  //6.��͸Ժ�¢ͧ��ԡ�����ͼ�Ե�ѳ��
	$claimup="50.00";  //10.�Ҥ��ԡ����˹��·��ͧ�ع�آ�Ҿ��˹�
	$up="50.00";  //8.�ҤҢ�µ��˹���
}else if($result2["detail"]=="(55823 ��ҩմ�Ҽ����¹͡)"){	
	$stdcode="55823";  //5.���ʺ�ԡ�����ͼ�Ե�ѳ����ͧ�ع�آ�Ҿ��˹�
	$desc="(55823 ��ҩմ�Ҽ����¹͡)";  //6.��͸Ժ�¢ͧ��ԡ�����ͼ�Ե�ѳ��
	$claimup="20.00";  //10.�Ҥ��ԡ����˹��·��ͧ�ع�آ�Ҿ��˹�
	$up="20.00";  //8.�ҤҢ�µ��˹���
}else{				
			$sql3 = "select codex,detail,price,yprice,nprice  from labcare where code = '".$result2['code']."'";
			//echo $sql3."<br>";
			$query3 = mysql_query($sql3);
			list($codex,$detail,$pricelabcare,$ypricelabcare,$npricelabcare)=mysql_fetch_array($query3);
			$stdcode=trim($codex);  //5.���ʺ�ԡ�����ͼ�Ե�ѳ����ͧ�ع�آ�Ҿ��˹�
			$desc=$detail;  //6.��͸Ժ�¢ͧ��ԡ�����ͼ�Ե�ѳ��
					
}

$chargeamt=$up*$qty;  //9.�Ҥҷ�����¡��
$chargeamt=number_format( $chargeamt, 2, '.', '');

$claimamount=$claimup*$qty;  //11.�ʹ�Թ�����ԡ
$claimamount=number_format( $claimamount, 2, '.', '');


$claimcat="OP1";  //13.�������ѭ�ա���ԡ
$desc=str_replace(array("\r","\n","\r\n",'"',"'","<",">","&"),'',$desc);	
				$strText15="$invno|$svdate|$billmuad|$lccode|$stdcode|$desc|$qty|$up|$chargeamt|$claimup|$claimamount|$svrefid|$claimcat\r\n";  //����Ң����� billitems �óշ���������
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
//-------------------- Create file BillDisp ����� 2 --------------------//
$thimonth=$_POST["thiyr"]."-".$_POST["rptmo"]."-".$_POST["rptdate"];
$numcscd=0;
$countdisp=0;
$cscd='��Сѹ�ѧ��';
    $query02="CREATE TEMPORARY TABLE reportcscd02 SELECT date,hn,vn,billno,price,credit,depart,sum(paidcscd),detail,row_id,txdate FROM opacc WHERE date LIKE '$thimonth%' and credit = '$cscd' AND depart='PHAR' AND paidcscd > $numcscd  group by row_id" ;  //���੾����/�Ǫ�ѳ�����ԡ��
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
				$sql3 = "select medical_sup_free,freepri from druglst where drugcode = '".$result2['drugcode']."' ";  //��������Ǫ�ѳ������¹͡�ԡ�����������  0=�ԡ�����  1=�ԡ��
				
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
<HNAME>��������ѡ��������</HNAME>\n
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
	if($detail=="�����"){$t=$ti1;} else
	if($detail=="(55020/55021)��Һ�ԡ�ü����¹͡"){$t=$ti2;}
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
	$chargeamt=$sumprice-$dpy-$dpn;  //����Ҥ��������ػ�ó� 20/09/61
	
	$ddl=0;
	$ddn=0;
	
	$sql2 = "select sum(price) as price,count(row_id) as counter,part,drugcode  from drugrx where idno = '".$xrow."' AND price >0 group by drugcode, part";  //�������͹� price>0 �ѹ��� 27/05/59
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
		}elseif($result2['part']=="DSY"){  //�Ǫ�ѳ��
			$sql3 = "select medical_sup_free,freepri from druglst where drugcode = '".$result2['drugcode']."' ";  //��������Ǫ�ѳ������¹͡�ԡ�����������  0=�ԡ�����  1=�ԡ��
			$row3 = mysql_query($sql3);
			list($supfree,$freepri) = mysql_fetch_array($row3);
			if($supfree==1){  //�ԡ��
				if($result2['price']>$freepri){
					$ddl+=$freepri;
					$ddn+=($result2['price']-$freepri);
				}else{
					$ddl+=$result2['price'];
				}
			}else{//�ԡ�����
				$ddn+=$result2['price'];
			}
		}elseif($result2['part']=="DDN" || $result2['part']=="DSN"){
			$ddn+=$result2['price'];
		}
	}
	if($ddl>0){

		$posdr = strpos($doctor,"(�.");
		$posdrd = strpos($doctor,"(�.");
		$posdrd1 = strpos($doctor,"(��.�");
		
		if($posdr==false){ // ����� �.
			if($posdrd==false){ // ����� �.
				if($posdrd1==false){ // ����� ��.�
					$seldr = "select doctorcode from doctor where name like '%".substr($doctor,0,9)."%' ";
					$rowdr = mysql_query($seldr);
					
					$numrow_dr = mysql_num_rows($rowdr);
					
					if( $numrow_dr > 0 ){
						list($dr) = mysql_fetch_array($rowdr);
						$dc="�";
						$dr1="$dc$dr";
					}else{ // ����ѧ������Ţ�������Ѻ���� opday
						
						list($opDate, $opTime) = explode(' ', $dateop);
						
						if( !empty($pVn) ){
							$whereOpd = " `vn` = '$pVn'";
						}else{
							$whereOpd = " `an` = '$pAn'";
						}
						
						// @todo �ѧ������礡óշ�� vn �͡��� ��������� doctor �ѹ���͡�Ҷ١��ͧ�ֻ���
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
							$dr1 = "�".$doc['doctorcode'];
						}
						
					}
					
				}else{
					$dr = substr($doctor,($posdrd1+6),4);
					$dc="-";
					$dr1="$dc$dr";
				
				}
				
			}else{
				$dr = substr($doctor,($posdrd+3),4);
				$dc="�";
				$dr1="$dc$dr";
			}
			
		}else{
			$dr = substr($doctor,($posdr+3),5);
			$dc="�";
			$dr1="$dc$dr";
			if(strlen($dr)<4){
				$seldr = "select doctorcode from doctor where name like '%".substr($doctor,0,9)."%' ";
				$rowdr = mysql_query($seldr);
				list($dr) = mysql_fetch_array($rowdr);
				$dc="�";
				$dr1="$dc$dr";
			}
		}
		
// ��䢵Դ S15 ��������� 17-9-61 18:47:00
// ��䢵Դ S15 ��������� 17-9-61 18:47:00
if($doctor=="MD058  ᾷ��Ἱ��"){
	$prescb="-2252";  //˷���ѵ��
}else if($doctor=="�.�.˷���ѵ�� ��Ūԧ��� (��.�.2252)"){
	$svpid="-2252";  // ˷���ѵ�� 	
}else if($doctor=="�Ѩ��� �Ǵ���� (��.�. 2556)"){
	$prescb="-2556";  //�Ѩ���
}else if($doctor=="MD074  �ѡ����Ҿ�ӺѴ"){
	$prescb="-3023";  //�.�. �ط�ȹ�
}else{
	if($dr1=="�"){
		$prescb="�00000";
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
	$dispdt = "$op3-$op2-$op1"."T"."$op4:$op5:$op6";  //7.�ѹ-���� ������
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

$invno=$date2.$invvn.$invbillno;  //��ҧ�ԧ billtran.invno ��Ҵ�����ŵ�ͧ >=9 && <= 16
	
	$paid=$chargeamt-$ddl;
	$paid=number_format($paid,2, '.','');
	$reimburser="HP";  //14.����ԡ
	$benefitplan="SS";  //15.���¡�纤������ǹ����ԡ��ҡ ���ʴԡ�� ������Է��
	$dispestat="1";  //16.ʶҹС�è����� 1=�Ѻ������


$subdateop=substr($dateop,0,10);
$subtimeop=substr($dateop,11,8);
$dispdt=$subdateop."T".$subtimeop;	
	
$txdate=substr($txdate,0,10);

$sql102 = "Select row_id From opday where hn = '$hn' and thidate like '$txdate%'   ";
//echo $sql102."<br>";
$result102 = Mysql_Query($sql102);
list($opday_rowid) = Mysql_fetch_row($result102);

$rowid=sprintf('%08d',$row_id);  //opacc.row_id
$svid=$date2.$rowid;  //��駤�� OPService.SvID
	
		if($dr==""){ 
			$strText22="$providerid|$dispid|$invno|$hn|$cid|$datepx|$dispdt|$prescb|$pitem|$chargeamt|$ddl|$paid|0.00|HP|$benefitplan|$dispestat|$svid|\r\n";  //������ Dispensing
		
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
			$strText22="$providerid|$dispid|$invno|$hn|$cid|$datepx|$dispdt|$prescb|$pitem|$chargeamt|$ddl|$paid|0.00|HP|$benefitplan|$dispestat|$svid|\r\n";  //������ Dispensing
		
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
	
	$query6 = "SELECT a.drugcode, b.genname, a.slcode, a.amount, a.price, a.part , c.detail1, c.detail2, c.detail3 ,b.unit ,a.reason, b.drugcode,b.product_category FROM drugrx as a left join druglst as b on a.drugcode = b.drugcode left join drugslip as c on c.slcode = a.slcode WHERE a.hn = '$hn'  AND a.idno = '$xrow' AND a.price >0 and a.part NOT LIKE 'DP%' ";  //�������͹� price>0 �ѹ��� 27/05/59
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
			$sql3 = "select medical_sup_free,freepri from druglst where drugcode = '".$drugcode."' ";  //��������Ǫ�ѳ������¹͡�ԡ�����������  0=�ԡ�����  1=�ԡ��
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
if($part=="DSY" || $part=="DSN"){  //�Ǫ�ѳ��
	$product_category="6";  //�Ǫ�ѳ�����������
	$tmt="";
}else if($part=="DPY" || $part=="DPN"){  //�ػ�ó�
	$product_category="7";  //����
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
//-------------------- Create file OPServices ����� 3  --------------------//
$thimonth=$_POST["thiyr"]."-".$_POST["rptmo"]."-".$_POST["rptdate"];
$numcscd=0;
$cscd="��Сѹ�ѧ��";
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
<HNAME>�ç��Һ�Ť�������ѡ��������</HNAME>\n
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
	
//-----��ǹ�ͧ�����ŷ��֧�Ҩҡ�к�-----//	
$authcode='';
$paidcscdall1=0;

	$query="SELECT * FROM reportcscd03";
	$result = mysql_query($query);
	
    while (list ($date,$hn,$vn,$billno,$price,$cerdit,$depart,$paidcscd,$detail,$row_id,$txdate,$credit_detail) = mysql_fetch_row ($result)) {	  //ǹ�ٻ
	$numcscd++;
	$num1=11512;  //����ʶҹ��Һ��
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
if($detail=="�����"){$t=$ti1;} else
if($detail=="(55020/55021)��Һ�ԡ�ü����¹͡"){$t=$ti2;}
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


$typeserv='';  //������㹡������ԡ��
$typein='';  //�������������Ѻ��ԡ��
$clinic='';  //Ἱ�����ʶҹ���
$sql102 = "Select row_id,doctor,thidate,toborow,clinic From opday where hn = '$hn' and thidate like '$date1235%'   ";
//echo $sql102."<br>" ;
$result102 = Mysql_Query($sql102);
list($opday_rowid,$doctor,$thidate,$toborow,$clinic) = Mysql_fetch_row($result102);

if($doctor=="MD022 (����Һᾷ��)"){
	$sql101 = "Select doctor From opd where hn = '$hn' and thidate like '$date1235%'   ";
	//echo $sql101."<br>";
	$result101 = Mysql_Query($sql101);
	list($doctor) = Mysql_fetch_row($result101);
}else{
	$doctor=$doctor;
}


if($clinic=="����á���" || $clinic=="01 ����á���" || $clinic=="01 �����ᾷ��" || $clinic=="01�����ᾷ��"){
	$clinic="01";
}else if($clinic=="���¡���" || $clinic=="02 ���¡���"){
	$clinic="02";
}else if($clinic=="�ٵԡ���" || $clinic=="03 �ٵԡ���" || $clinic=="03 �ٵԹ��ᾷ��"){
	$clinic="03";	
}else if($clinic=="����Ǫ����"){
	$clinic="04";		
}else if($clinic=="������Ǫ����" || $clinic=="05 �����ᾷ��" || $clinic=="05 ������Ǫ"){
	$clinic="05";	
}else if($clinic=="�ʵ �� ���ԡ" || $clinic=="06 �ʵ �� ���ԡᾷ��" || $clinic=="06 �ʵ �� ���ԡ"){
	$clinic="06";	
}else if($clinic=="�ѡ���Է��" || $clinic=="07 �ѡ��" || $clinic=="07 �ѡ��ᾷ��"){
	$clinic="07";			
}else if($clinic=="���¡�������⸻Դԡ�" || $clinic=="08 ����ᾷ���д١��" || $clinic=="08 ���¡�����д١"){
	$clinic="08";
}else if($clinic=="�Ե�Ǫ" || $clinic=="09 �Ե�Ǫ"){
	$clinic="09";	
}else if($clinic=="�ѧ���Է��" || $clinic=="11 �ѧ��ᾷ��" || $clinic=="10 �ѧ���Է��"){
	$clinic="10";			
}else if($clinic=="�ѹ�����" || $clinic=="11 �ѹ�����"){
	$clinic="11";
}else if($clinic=="�Ǫ��ʵ��ء�Թ��йԵ��Ǫ" || $clinic=="12 �ء�Թ"){
	$clinic="12";	
}else{
	if($toborow=="EX07 �ѹ�����"){
		$clinic="11";
	}else if($toborow=="EX02 �����©ء�Թ"){
		$clinic="12";
	}else{
		$clinic="99";
	}
}

if($toborow=="EX01 �ѡ���ä�����������Ҫ���"){
	$typein="1"; //����Ѻ��ԡ���ͧ
}else if($toborow=="EX11 �ѡ���ä�͡�����Ҫ���"){
	$typein="1"; //����Ѻ��ԡ���ͧ	
}else if($toborow=="EX04 �����¹Ѵ"){
	$typein="2"; //����Ѻ��ԡ�õ���Ѵ����
}else if($toborow=="EX02 �����©ء�Թ"){
	$typein="4";  //����Ѻ��ԡ��Ẻ�ء�Թ
}else{
	if($typein==''){$typein='9';}
}

if($toborow=="EX02 �����©ء�Թ"){
	$typeserv="05";  //�Ѻ��ԡ�áóթء�Թ
}else{
	$typeserv="02";  //�Ѻ��ԡ�÷����
}



    $thidated=substr($thidate,8,2);
    $thidatem=substr($thidate,5,2); 
	$thidatey=substr($thidate,0,4); 
	$thidatet1=substr($thidate,11,8); 	

$thidatey=$thidatey-543;
$thidatetall1="$thidatey-$thidatem-$thidated";
$thidatetall2="$m$d";
$begdt=$thidatetall1.'T'.$thidatet1;


	$posdr = strpos($doctor,"(�.");
	$posdrd = strpos($doctor,"(�.");
	if($posdr==false){
		if($posdrd==false){
			$seldr = "select doctorcode from doctor where name like '%".substr($doctor,0,9)."%' ";
			$rowdr = mysql_query($seldr);
			list($dr) = mysql_fetch_array($rowdr);
			$dc="�";
			$dr1="$dc$dr";
		}else{
			$dr = substr($doctor,($posdrd+3),4);
			$dc="�";
			$dr1="$dc$dr";
		}
	}else{
		$dr = substr($doctor,($posdr+3),5);
		$dc="�";
		$dr1="$dc$dr";
		if(strlen($dr)<4){
			$seldr = "select doctorcode from doctor where name like '%".substr($doctor,0,9)."%' ";
			$rowdr = mysql_query($seldr);
			list($dr) = mysql_fetch_array($rowdr);
			$dc="�";
			$dr1="$dc$dr";
		}
	}


if($toborow=="EX12 �͹�ç��Һ��"){
$typeout='2';  //�Ѻ����繼������
}else{
$typeout='1';  //��˹��¡�Ѻ��ҹ
}


$completion='Y';
$clamcat='OP1';

// ��䢵Դ S15 ��������� 17-9-61 18:47:00
if($doctor=="MD058  ᾷ��Ἱ��"){
	$svpid="-2252";  // ˷���ѵ��
}else if($doctor=="�.�.˷���ѵ�� ��Ūԧ��� (��.�.2252)"){
	$svpid="-2252";  // ˷���ѵ�� 
}else if($doctor=="�Ѩ��� �Ǵ���� (��.�. 2556)"){
	$svpid="-2556";  // �Ѩ���
}else if($doctor=="MD074  �ѡ����Ҿ�ӺѴ"){
	$svpid="-3023";  // �.�.�ط�ȹ�
}else{
	if($dr1=="�"){
		$svpid="�16633"; //����Ţ �. ��.þ.����� 21/09/61
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

$invno=$date2.$invvn.$invbillno;  //��ҧ�ԧ billtran.invno ��Ҵ�����ŵ�ͧ >=9 && <= 16

$rowid=sprintf('%08d',$row_id);  //opacc.row_id
$svid=$date2.$rowid;  //��駤�� OPService.SvID

$chkdate=substr($txdate,0,10);
if($depart=="PHAR"){  //�������
	$class="EC"; //��õ�Ǩ�ѡ��
}else if($depart=="PATHO"){  //����繤�ҵ�Ǩ���������ä
	$class="EC"; //��õ�Ǩ�ѡ��
}else if($depart=="OTHER" && $detail=="(55020/55021 ��Һ�ԡ�ü����¹͡)"){  //����繤�Һ�ԡ�ü����¹͡
	$class="EC"; //��õ�Ǩ�ѡ��
}else{  //�������Ǵ����
	$sql2 = "select *  from patdata where date like '".$chkdate."%' and  hn='$hn' and price >0 and amount >0 and part='SURG'";
	//echo $sql2."<br>";
	$rowp = mysql_query($sql2);
	$nump=mysql_num_rows($rowp);
	if($nump > 0){  //����բ�����
	$resultp=mysql_fetch_array($rowp);
	$class="OP"; //�ѵ����
	$lccode=$resultp["code"];
	$codeset="IN";  //ICD9CM
	
	$qty=$resultp['amount'];  //7.�ӹǹ�ͧ��ԡ�����ͼ�Ե�ѳ�������
	$up=$resultp['price']/$resultp['amount'];  //8.�ҤҢ�µ��˹���	
	$chargeamt=$up*$qty;  //9.�Ҥҷ�����¡��
	$svcharge=number_format( $chargeamt, 2, '.', '');		
	
		$sql102 = "Select icd9cm From opday where hn = '$hn' and thidate like '$chkdate%'";
		//echo $sql102."<br>" ;
		$result102 = Mysql_Query($sql102);
		list($icd9cm) = Mysql_fetch_row($result102);
		if($icd9cm==""){  //���㹵��ҧ opday ����ա��ŧ icd9cm
			$sql106 = "Select icd9cm From opicd9cm where hn = '$hn' and svdate like '$date1235%' ";
			//echo $sql106;
			$result106 = Mysql_Query($sql106);
			list($icd9cm) = Mysql_fetch_row($result106);
			$stdcode=$icd9cm;
		}else{
			$stdcode=$icd9cm;
		}
	
	}else{  //���������ѵ����
		$class="EC"; //��õ�Ǩ�ѡ��
	}
}
//$class="IV"; //��õ�Ǩ�ԹԨ��´����Ըվ����
//$class="ZZ"; //���� ����ѧ����˹�


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
//----- �����ǹ�ͧ��ô֧��������к�-----//

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





//----�֧��������к����ǹ��� 2-----//
$authcode='';
$paidcscdall1=0;
	
	$query="SELECT * FROM reportcscd03";
	$result = mysql_query($query);
    while (list ($date,$hn,$vn,$billno,$price,$cerdit,$depart,$paidcscd,$detail,$row_id,$txdate,$credit_detail) = mysql_fetch_row ($result)) {	  //ǹ�ٻ
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
if($detail=="�����"){$t=$ti1;} else
if($detail=="(55020/55021)��Һ�ԡ�ü����¹͡"){$t=$ti2;}
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

if($icd10==""){  //���㹵��ҧ opday ����ա��ŧ icd10
	$sql106 = "Select icd10 From diag where hn = '$hn' and svdate like '$date1235%' ";
	//echo $sql106;
	$result106 = Mysql_Query($sql106);
	list($icd10) = Mysql_fetch_row($result106);
	//echo "NULL===>".$icd10;
}else{
	$icd10=$icd10;
}

if($icd9cm==""){  //���㹵��ҧ opday ����ա��ŧ icd9cm
	$sql106 = "Select icd9cm From opicd9cm where hn = '$hn' and svdate like '$date1235%' ";
	//echo $sql106;
	$result106 = Mysql_Query($sql106);
	list($icd9cm) = Mysql_fetch_row($result106);
	//echo "NULL===>".$icd10;
}else{
	$icd9cm=$icd9cm;
}

if($depart=="PHAR"){   //������� ���� LAB
//echo $row_id;

$typeout='1';
$completion='Y';
$clamcat='OP1';

$rowid=sprintf('%08d',$row_id);  //opacc.row_id
$svid=$date2.$rowid;  //��ҧ�ԧ OPService.SvID

$class="EC"; //��õ�Ǩ�ѡ��
$codeset="TT";  //ICD-10-TM

if($icd10 !=""){  //����ա��ŧ���� ICD10
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
	if($doctor=="MD058  ᾷ��Ἱ��"){  //�кص�����йӾ��� Coder þ.�ӻҧ ������ M7919
		$icd10="U7505";
	}else if($toborow=="EX20 �ǴἹ��" || $toborow=="EX94 �͡ VN �� �ǴἹ��"){
		$icd10="U7505";
	}else if($toborow=="EX19 �͡ VN ����(������ͧ)" || $toborow=="EX02 �����©ء�Թ"){	
		$icd10="Z480";
	}else{
		$icd10="";  //ICD10 ��������ҧ Diag Not Found ��� Z480 仡�͹ ��ͧ��Ѻ�������
	}
	
		$sql109 = "Select code,detail From icd10  where code =  '$icd10'   ";
		//echo $sql109."<br>" ;
		$result109 = Mysql_Query($sql109);
		list($code,$detail) = Mysql_fetch_row($result109);
		$desc=str_replace(array("\r","\n","\r\n",'"',"'","<",">","&"),'',$detail);	
}

if($code=="" && $desc==""){
echo "- �����ż������ѹ��� $date1235 HN : $hn ����բ����š��ŧ�����ä ICD10 �������ö���ԡ�� <br>";
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
}else if($depart=="PATHO"){   //����繤�ҵ�Ǩ���������ä
//echo $row_id;

$typeout='1';
$completion='Y';
$clamcat='OP1';

$rowid=sprintf('%08d',$row_id);  //opacc.row_id
$svid=$date2.$rowid;  //��ҧ�ԧ OPService.SvID

$class="EC"; //��õ�Ǩ�ѡ��
$codeset="TT";  //ICD-10-TM

if($icd10 !=""){  //����ա��ŧ���� ICD10
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
	if($doctor=="MD058  ᾷ��Ἱ��"){  //�кص�����йӾ��� Coder þ.�ӻҧ ������ M7919
		$icd10="U7505";
	}else if($toborow=="EX20 �ǴἹ��" || $toborow=="EX94 �͡ VN �� �ǴἹ��"){
		$icd10="U7505";
	}else if($toborow=="EX19 �͡ VN ����(������ͧ)" || $toborow=="EX02 �����©ء�Թ"){	
		$icd10="Z480";
	}else{
		$icd10="";  //ICD10 ��������ҧ Diag Not Found ��� Z480 仡�͹ ��ͧ��Ѻ�������
	}
	
		$sql109 = "Select code,detail From icd10  where code =  '$icd10'   ";
		//echo $sql109."<br>" ;
		$result109 = Mysql_Query($sql109);
		list($code,$detail) = Mysql_fetch_row($result109);
		$desc=str_replace(array("\r","\n","\r\n",'"',"'","<",">","&"),'',$detail);	
}

if($code=="" && $desc==""){
echo "- �����ż������ѹ��� $date1235 HN : $hn ����բ����š��ŧ�����ä ICD10 �������ö���ԡ�� <br>";
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
}else if($depart=="OTHER" && $detail=="(55020/55021 ��Һ�ԡ�ü����¹͡)"){   //����繤�ҵ�Ǩ���������ä
//echo $row_id;

$typeout='1';
$completion='Y';
$clamcat='OP1';

$rowid=sprintf('%08d',$row_id);  //opacc.row_id
$svid=$date2.$rowid;  //��ҧ�ԧ OPService.SvID

$class="EC"; //��õ�Ǩ�ѡ��
$codeset="TT";  //ICD-10-TM

if($icd10 !=""){  //����ա��ŧ���� ICD10
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
	if($doctor=="MD058  ᾷ��Ἱ��"){  //�кص�����йӾ��� Coder þ.�ӻҧ ������ M7919
		$icd10="U7505";
	}else if($toborow=="EX20 �ǴἹ��" || $toborow=="EX94 �͡ VN �� �ǴἹ��"){
		$icd10="U7505";
	}else if($toborow=="EX19 �͡ VN ����(������ͧ)" || $toborow=="EX02 �����©ء�Թ"){	
		$icd10="Z480";
	}else{
		$icd10="";  //ICD10 ��������ҧ Diag Not Found ��� Z480 仡�͹ ��ͧ��Ѻ�������
	}
	
		$sql109 = "Select code,detail From icd10  where code =  '$icd10'   ";
		//echo $sql109."<br>" ;
		$result109 = Mysql_Query($sql109);
		list($code,$detail) = Mysql_fetch_row($result109);
		$desc=str_replace(array("\r","\n","\r\n",'"',"'","<",">","&"),'',$detail);	
}

if($code=="" && $desc==""){
echo "- �����ż������ѹ��� $date1235 HN : $hn ����բ����š��ŧ�����ä ICD10 �������ö���ԡ�� <br>";
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
}else{  //���������� �繤�����������
//echo $row_id;
$chkdate=substr($txdate,0,10);
$sqlp = "select *  from patdata where date like '$chkdate%' AND hn='$hn' and price >0 and amount >0 and part='SURG'";
//echo $sqlp."<br>";
$rowp = mysql_query($sqlp);
$nump=mysql_num_rows($rowp);
$result2 = mysql_fetch_array($rowp);

if($nump > 0){  //����ա�÷��ѵ����   
//echo $sqlp."<br>";
	$typeout='1';
	$completion='Y';
	$clamcat='OP1';
	
	$rowid=sprintf('%08d',$row_id);  //opacc.row_id
	$svid=$date2.$rowid;  //��ҧ�ԧ OPService.SvID
	
	$class="OP"; //�ѵ����
	$codeset="IN";  //ICD-9-CM
		
		if($icd9cm !=""){  //����� icd9cm
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
			}else{		  //������ô�	
				$sql108 = "Select code,detail From icd9cm  where code ='$icd9cm'";
				//echo $hn."===>".$sql108."<br>" ;
				$result108 = Mysql_Query($sql108);
				list($code,$detail) = Mysql_fetch_row($result108);
			}
			
		}
		$desc=str_replace(array("\r","\n","\r\n",'"',"'","<",">","&"),'',$detail);
if($code=="" && $desc==""){
echo "<div style='color:#0000FF;'>�����ż������ѹ��� $date1235 HN : $hn ����բ����š�÷��ѵ���� ICD9CM �������ö���ԡ�� </div>";
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
		
}else{  //���������ѵ���� ����Ң����š���ѡ�� EC

$typeout='1';
$completion='Y';
$clamcat='OP1';

$rowid=sprintf('%08d',$row_id);  //opacc.row_id
$svid=$date2.$rowid;  //��ҧ�ԧ OPService.SvID

$class="EC"; //��õ�Ǩ�ѡ��
$codeset="TT";  //ICD-10-TM

if($icd10 !=""){  //����ա��ŧ���� ICD10
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
	if($doctor=="MD058  ᾷ��Ἱ��"){  //�кص�����йӾ��� Coder þ.�ӻҧ ������ M7919
		$icd10="U7505";
	}else if($toborow=="EX20 �ǴἹ��" || $toborow=="EX94 �͡ VN �� �ǴἹ��"){
		$icd10="U7505";
	}else if($toborow=="EX19 �͡ VN ����(������ͧ)" || $toborow=="EX02 �����©ء�Թ"){	
		$icd10="Z480";
	}else{
		$icd10="";  //ICD10 ��������ҧ Diag Not Found ��� Z480 仡�͹ ��ͧ��Ѻ�������
	}
	
		$sql109 = "Select code,detail From icd10  where code =  '$icd10'   ";
		//echo $sql109."<br>" ;
		$result109 = Mysql_Query($sql109);
		list($code,$detail) = Mysql_fetch_row($result109);
		$desc=str_replace(array("\r","\n","\r\n",'"',"'","<",">","&"),'',$detail);	
}

if($code=="" && $desc==""){
echo "- �����ż������ѹ��� $date1235 HN : $hn ����բ����š��ŧ�����ä ICD10 �������ö���ԡ�� <br>";
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
}  //�Դ 
//-----����ô֧��������к����ǹ��� 2-----//


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
<div style='color:#FF0000; font-weight:bold;'>��������ԡ��Ҫ��·ҧ���ᾷ������¹͡ �Է�Ի�Сѹ�ѧ�� (SSO)</div>
<div>���Ѳ���к�&nbsp;&nbsp;&nbsp;�.�. ��Թ ������ ���˹�ҷ���ٹ���ԡ�ä���������&nbsp;&nbsp;&nbsp;��. 8500</div>
</p>";
echo "<br>";
echo "��ǹ���Ŵ�������١˹���Сѹ�ѧ�� ��������� ʡ�. �ѹ��� $yrmonthdate <a href=$ZipName>��ԡ�����</a> <br>";
echo "<a href='../exportsso_data.php'><< ���͡�ѹ�������</a>";	
//-------------------- Close add to zip --------------------//
include("unconnect.inc");
?>
