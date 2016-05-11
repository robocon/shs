<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 

 include("connect.inc");
 
function jschars($str)
{
    $str = str_replace("\\\\", "\\\\", $str);
    $str = str_replace("\"", "\\\"", $str);
    $str = str_replace("'", "\'", $str);
    $str = str_replace("\r\n", "\\n", $str);
    $str = str_replace("\r", "\\n", $str);
    $str = str_replace("\n", "\\n", $str);
    $str = str_replace("\t", "\\t", $str);
    $str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
    $str = str_replace(">", "\\x3E", $str);
    return $str;
}

    // ก่อนการตัดยา เพิ่มเงื่อนในการตรวจสอบว่าหมอได้ยกเลิกรายการนี้ไปแล้วรึยัง
    $query = "SELECT * FROM `dphardep` 
	WHERE `row_id` = '$sRow_id' 
	AND `date` = '".$_SESSION["session_Date"]."' 
	AND `dr_cancle` IS NULL"; 
    $result = mysql_query($query) or die("Query failed");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
	}
	
	// ถ้า $row จาก fetch object เป็น NULL
	if( is_null($row) ){
		?><p>รายการยาดังกล่าวหมอได้ยกเลิกไปแล้วกรุณาปิดหน้าจอนี้ และกลับไปRefreshหน้าจอ รายการใบสั่งยาจากแพทย์ อีกครั้ง</p><?php
		exit;
	}
	
    $nRunno=$row->chktranx;
	$dr_date=$row->date;
    $cHn=$row->hn;
    $cPtname=$row->ptname;
    $cDoctor=$row->doctor;
    $item=$row->item;
    $Essd=$row->essd;
    $Nessdy=$row->nessdy;
    $Nessdn=$row->nessdn;
    $DPY=$row->dpy;
    $DPN=$row->dpn;   
    $DSY=$row->dsy;
    $DSN=$row->dsn;
    $Netprice=$row->price;
    $cDiag=$row->diag;
    $tvn=$row->tvn;
    $cPtright=$row->ptright;
	$stkcutdate_now = $row->stkcutdate;

	if($stkcutdate_now != ""){
		echo "<BR><BR><CENTER><FONT COLOR=\"#FF0000\"><B>รายการนี้เคยตัดสต๊อกไปแล้วไม่สามารถตัดอีกรอบได้</B></FONT></CENTER>";
		exit();
	}

   //////////////
	$Thdhn=date("d-m-").(date("Y")+543).$cHn;
   ///////////
   $aReason = array(" เหตุผล ");
    $query = "SELECT drugcode,tradname,amount,price,slcode,part,reason,drug_inject_amount , drug_inject_unit,drug_inject_amount2 , drug_inject_unit2 , drug_inject_time, drug_inject_slip,  drug_inject_type,  drug_inject_etc, DPY, DPN  FROM ddrugrx WHERE idno = '$sRow_id' AND date = '".$_SESSION["session_Date"]."'  ";
    $result = mysql_query($query)
        or die("Query failed");
    $x=0;
    while (list ($drugcode,$tradname,$amount,$price,$slcode,$part,$reason,$drug_inject_amount , $drug_inject_unit,$drug_inject_amount2 , $drug_inject_unit2, $drug_inject_time, $drug_inject_slip,  $drug_inject_type,  $drug_inject_etc,$tb_dpy,$tb_dpn) = mysql_fetch_row ($result)) {
        $x++;
        $aDgcode[$x]=$drugcode;
        $aTrade[$x]=$tradname;
        $aAmount[$x]=$amount;
        $aMoney[$x]=$price;  
        $aSlipcode[$x]=$slcode;        
        $aPart[$x]=$part;
		$aReason[$x] = $reason;
		$aDPY[$x] = $tb_dpy;
		$aDPN[$x] = $tb_dpn;

		$aDrug_inject_amount[$x] = $drug_inject_amount;
		$aDrug_inject_unit[$x] = $drug_inject_unit;
		$aDrug_inject_amount2[$x] = $drug_inject_amount2;
		$aDrug_inject_unit2[$x] = $drug_inject_unit2;
		$aDrug_inject_time[$x] = $drug_inject_time;
		$aDrug_inject_slip[$x] = $drug_inject_slip;
		$aDrug_inject_type[$x] = $drug_inject_type;
		$aDrug_inject_etc[$x] = $drug_inject_etc;
	     };
/////////

$netfree=$Essd+$Nessdy+$DPY+$DSY;
$netpay=$Nessdn+ $DSN+$DPN;
$total=$Essd+$Nessdy+$DSY+$DPY+$Nessdn+$DSN+$DPN;

//insert data into phardep
       $query = "INSERT INTO phardep(chktranx,date,ptname,hn,price,doctor,item,
                    idname,diag,essd,nessdy,nessdn,dpy,dpn,dsy,dsn,tvn,ptright, phapt,datedr)VALUES('".$_SESSION["sChktranx"]."','$Thidate','$cPtname','$cHn',
                    '$Netprice','$cDoctor','$item','$sOfficer','".jschars($cDiag)."','$Essd','$Nessdy',
	    '$Nessdn','$DPY','$DPN','$DSY','$DSN','$tvn','$cPtright','$sOfficer','$dr_date');";

$msg = "**เตือน ! เมื่อพบหน้าต่างนี้แสดงว่าได้ตัด stock ไปก่อนแล้ว หรือการตัด stock ล้มเหลว<br>
	*โปรดตรวจสอบว่ามีรายการยาในเมนู [ใบสั่งยา,การจ่ายเงิน] หรือไม่<br>
	*ถ้ามีแสดงว่า ได้ตัด stock ไปก่อนแล้ว<br>
	*ถ้าไม่มีแสดงว่า  การตัด stock ล้มเหลว<br><br>
                -------- รายการจ่าย ---------<br> 
                $Thaidate<br>
                $cPtname  HN:$cHn VN:$tvn<br>
                สิทธิ:$cPtright<br>
                โรค $cDiag<br>
                รวมเงินค่ายา  $total  บาท<br>
                แพทย์ $cDoctor<br>";
       $result = mysql_query($query) or die($msg);

//test 9/4/47 to find the last row
//printf ("Last inserted record has id %d\n",mysql_insert_id());
  $idno=mysql_insert_id();
//print "<br>$idno <br>";
//test 9/4/47 to find the last row

//update data in druglst 
 for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){
        $query ="UPDATE druglst SET stock = stock-$aAmount[$n],
              			  rxaccum = rxaccum + $aAmount[$n],
             			  rx1day   = rx1day +$aAmount[$n],
        			  totalstk = stock + mainstk
                       WHERE drugcode= '$aDgcode[$n]' ";
        $result = mysql_query($query)or die("Query failed,update druglst");
			}
        };
	$injectno=0;	
//insert data into drugrx
for ($n=1; $n<=$x; $n++){
   If (!empty($aDgcode[$n])){
	   
	   	 $sql = "Select stock,mainstk From druglst where drugcode = '".$aDgcode[$n]."' limit 0,1 ";
		 $result = Mysql_Query($sql);
		 $arr = Mysql_fetch_assoc($result);
		 $stock = $arr["stock"];
		 $mainstk = $arr["mainstk"];
		 
	   		$c1 = substr($aDgcode[$n],0,1);
			$c2 = substr($aDgcode[$n],0,2);
			
	   if($aDgcode[$n]=='1DILA' || $aDgcode[$n]=='1GPO30*'  || $aDgcode[$n]=='20SGPO30'  || $aDgcode[$n]=='20SGPO30' || $aDgcode[$n]=='1COTR4' || $aDgcode[$n]=='1ALLO3'){
		   
		   $sql="Select  * from drugrx  where drugcode='".$aDgcode[$n]."' and hn='".$cHn."' ";
		   $query = mysql_query($sql) or die("Query failed, chk drugrx");
		   $row=mysql_num_rows($query);
		   
		   if($row>0){
			  	  
		   $query = "INSERT INTO drugrx(date,hn,drugcode,tradname,
				 amount,price,item,slcode,part,idno,stock,mainstk,reason,drug_inject_amount,drug_inject_unit ,drug_inject_amount2,drug_inject_unit2 ,drug_inject_time , drug_inject_slip,  drug_inject_type,  drug_inject_etc,DPY,DPN,drug_status,datedr )VALUES('$Thidate','$cHn','$aDgcode[$n]','$aTrade[$n]',
				 '$aAmount[$n]','$aMoney[$n]','$item','$aSlipcode[$n]','$aPart[$n]','$idno','$stock','$mainstk','$aReason[$n]','$aDrug_inject_amount[$n]','$aDrug_inject_unit[$n]','$aDrug_inject_amount2[$n]','$aDrug_inject_unit2[$n]','$aDrug_inject_time[$n]','$aDrug_inject_slip[$n]','$aDrug_inject_type[$n]','$aDrug_inject_etc[$n]','$aDPY[$n]','$aDPN[$n]','old','$dr_date');";
			$result = mysql_query($query) or die("Query failed,insert into drugrxr1");
			
		   }else{
			
			$query = "INSERT INTO drugrx(date,hn,drugcode,tradname,
				 amount,price,item,slcode,part,idno,stock,mainstk,reason,drug_inject_amount,drug_inject_unit  ,drug_inject_amount2,drug_inject_unit2, drug_inject_time, drug_inject_slip,  drug_inject_type,  drug_inject_etc,DPY,DPN,drug_status,datedr )VALUES('$Thidate','$cHn','$aDgcode[$n]','$aTrade[$n]',
				 '$aAmount[$n]','$aMoney[$n]','$item','$aSlipcode[$n]','$aPart[$n]','$idno','$stock','$mainstk','$aReason[$n]','$aDrug_inject_amount[$n]','$aDrug_inject_unit[$n]','$aDrug_inject_amount2[$n]','$aDrug_inject_unit2[$n]','$aDrug_inject_time[$n]','$aDrug_inject_slip[$n]','$aDrug_inject_type[$n]','$aDrug_inject_etc[$n]','$aDPY[$n]','$aDPN[$n]','new','$dr_date');";
			$result = mysql_query($query) or die("Query failed,insert into drugrxr2");
			
		   }
		}else{
			$query = "INSERT INTO drugrx(date,hn,drugcode,tradname,
				 amount,price,item,slcode,part,idno,stock,mainstk,reason,drug_inject_amount , drug_inject_unit,drug_inject_amount2,drug_inject_unit2, drug_inject_time, drug_inject_slip,  drug_inject_type,  drug_inject_etc,DPY,DPN,drug_status,datedr )VALUES('$Thidate','$cHn','$aDgcode[$n]','$aTrade[$n]',
				 '$aAmount[$n]','$aMoney[$n]','$item','$aSlipcode[$n]','$aPart[$n]','$idno','$stock','$mainstk','$aReason[$n]','$aDrug_inject_amount[$n]','$aDrug_inject_unit[$n]','$aDrug_inject_amount2[$n]','$aDrug_inject_unit2[$n]','$aDrug_inject_time[$n]','$aDrug_inject_slip[$n]','$aDrug_inject_type[$n]','$aDrug_inject_etc[$n]','$aDPY[$n]','$aDPN[$n]','','$dr_date');";
			$result = mysql_query($query) or die("Query failed,insert into drugrx");
		}
		
		//////////// นับจำนวนสำหรับการคิดเงินค่าฉีดยา
		// ถ้าโค้ดยาขึ้นต้นด้วย 0 หรือ 2 และไม่ได้ตามด้วย20
		if( $c2 != '20' && ( $c1 == '2' || $c1 == '0' ) ){
			
			// เพิ่มการนับจำนวนยาด้วย เพราะบางตัว amount เป็น0 แต่มีการคิดค่าฉีดยาเบิ้ล
			if( isset($_GET['inject']) && $aAmount[$n] > 0 ){
				$sqlopday = "select toborow from opday where hn='".$cHn."' and thdatehn = '".$Thdhn."' ";
				$res= mysql_query($sqlopday) or die("Query failed");
				list($toborow) = mysql_fetch_row($res);
				$tob = substr($toborow,0,4);
				if($tob!="EX10"){ // ถ้าไม่ใช่ไตเทียม
					$injectno++;
				}
			}
		}
		////////////////////////////////จบนับจำนวนสำหรับการคิดเงินค่าฉีดยา
   }
}

////////////คิดเงิน20บาท
if($injectno!=0){
			//runno  for chktranx
				$query = "SELECT title,prefix,runno FROM runno WHERE title = 'depart'";
				$result = mysql_query($query)
					or die("Query failed");
			
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
			
				$query ="UPDATE runno SET runno = $nRunno WHERE title='depart'";
				$result = mysql_query($query) or die("Query failed");
					/////////////////////////////////////////////////////////////
				$query = "INSERT INTO depart(chktranx,date,ptname,hn,an,depart,item,detail,price,sumyprice,sumnprice,paid, idname,accno,tvn,ptright)VALUES('".$nRunno."','".$Thidate."','".$cPtname."','".$cHn."','','EMER','".$injectno."','(55823 ค่าฉีดยาผู้ป่วยนอก)', '".(20*$injectno)."','".(20*$injectno)."','0','','".$sOfficer."','0','".$tvn."','".$cPtright."');";
				$result = mysql_query($query);
				$idno1=mysql_insert_id();
			 
				$query = "INSERT INTO patdata(date,hn,an,ptname,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright) VALUES('".$Thidate."','".$cHn."','','".$cPtname."','".$injectno."','INJ','(55823 ค่าฉีดยาผู้ป่วยนอก)','".$injectno."','".(20*$injectno)."','".(20*$injectno)."','0','EMER','NCARE','".$idno1."','".$cPtright."');";
				$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
}
////////////จบคิดเงิน20บาท
//update data in opday 

        $query ="UPDATE opday SET diag = '".jschars($cDiag)."',
              			         doctor='$cDoctor',
			         phar= phar+$Netprice
                       WHERE thdatehn= '$Thdhn' AND vn = '$tvn' ";
        $result = mysql_query($query)
                       or die("Query failed,update opday");
		
		$query = "UPDATE dphardep set stkcutdate = '".date("H:i:s")."'  WHERE row_id = '$sRow_id' "; 
		$result = mysql_query($query);
		if($result){
		?>
		<script>
        	window.opener.location.reload();
        </script>
		<?
		}
 include("unconnect.inc");
 include("slipprntest1.php");
?>

