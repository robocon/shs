<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
	session_register('ponumber');
	$_SESSION['ponumber'] = $_POST['ponum'];
    print  "ตรวจสอบยาเวชภัณฑ์ในคลังของบริษัท เพื่อการสั่งซื้อ<a target=_parent  href='../nindex.htm'><<ไปเมนู</a> ";
    print  "<a target=_parent  href='dgorder.php'><<สั่งซื้อยาใหม่</a> ";
	
$datey=date('Y')+543;
$date=$datey."-".date('m')."-".date('d');
$lastmonth=date('Y-m-d', strtotime("-3 month"));	

list($yy,$mm,$dd)=explode("-",$lastmonth);
$y=$yy+543;
$lastmonth="$y-$mm-$dd";


$date1=date('Y-m-d');
$lastmonth1=date('Y-m-d', strtotime("-3 month"));	
?>
<table>
 <tr>
  <th bgcolor=3399CC><font face='Angsana New'>#</th>
  <th bgcolor=3399CC><font face='Angsana New'>รหัสยา</th>
  <th bgcolor=3399CC><font face='Angsana New'>ชื่อการค้า</th>
  <th bgcolor=3399CC><font face='Angsana New'>ประเภท</th>
  <th bgcolor=3399CC><font face='Angsana New'>วางระดับ</th>
  <th bgcolor=3399CC><font face='Angsana New'>เหลือสุทธิ</th>
  <th bgcolor=3399CC><font face='Angsana New'>ในคลัง</th>
  <th bgcolor=3399CC><font face='Angsana New'>ห้องยา</th>
  <th bgcolor=3399CC><font face='Angsana New'>ใช้ไปต่อเดือน</th>  
  <th bgcolor=EC7063><font face='Angsana New'>เหลือใช้อีกกี่เดือน</th>
  <th bgcolor=F5B041><font face='Angsana New'>สป. ใช้ไปต่อเดือน</th>
  <th bgcolor=3399CC><font face='Angsana New'>หน่วยนับ</th>
  <th bgcolor=3399CC><font face='Angsana New'>ขนาดบรรจุ</th>
  <th bgcolor=3399CC><font face='Angsana New'>ราคา(+vat)/pack</th>
  <th bgcolor=3399CC><font face='Angsana New'>ราคา(ไม่รวมvat)</th>
  <th bgcolor=3399CC><font face='Angsana New'>spec</th>
  <th bgcolor=3399CC><font face='Angsana New'>หมายเหตุ</th>
 </tr>

<?php
  $n=0;
If (!empty($comcode)){
    include("connect.inc");

    $query = "SELECT drugcode,tradname,minimum,totalstk,mainstk,stock,rxrate,stkpmon,packing,pack,packpri_vat,packpri,comname,row_id,snspec,spec FROM druglst  WHERE comcode = '$comcode' and  grouptype !='pc'"; 
	 
    $result = mysql_query($query) or die("Query failed");
	 for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	        if (!mysql_data_seek($result, $i)) {
	            echo "Cannot seek to row $i\n";
	            continue;
	       }

	        if(!($row = mysql_fetch_object($result)))
	            continue;
 	        }
        $cComname  =$row->comname;
        $cComcode   =$comcode;

    if(mysql_num_rows($result)){
	
	$query = "SELECT startday FROM runno WHERE title = 'RXAC'";
	list($dStartday) = mysql_fetch_row(mysql_query($query));

	$date2=date("Y-m-d H:i:s");  //วันที่คำนวณ 
	$s = strtotime($date2)-strtotime($dStartday);

	//echo strtotime($date2)," - ",strtotime($dStartday)," + ",$s,"<BR>";
	//   echo "จำนวนวินาที $s<br>";  //seconds
	$d = intval($s/86400);   //day

	$s -= $d*86400;
	$h  = intval($s/3600);    //hour
	//   echo "จำนวนวัน  $d วัน $h ชั่วโมง<br>";

	$days= $d;
	if ($h>12){
		$days=$d+1;
	}  

        print "<font face='Angsana New' size='5'>$comcode :$cComname &nbsp;&nbsp;&nbsp;<u>เลขที่ใบสั่งซื้อ ".$_SESSION['ponumber']."</u><br>";
        print "<font face='Angsana New' size='2'>ใช้/เดือน คืออัตราการจ่ายต่อเดือน <br>";
        print "เหลือ ? เดือน คือยังมีเหลือใช้ได้กี่เดือน (เหลือสุทธิ/อัตราการจ่ายต่อเดือน)";

        $query = "SELECT drugcode,tradname,minimum,totalstk,mainstk,stock,rxrate,stkpmon,packing,pack,packpri_vat,packpri,row_id,snspec,spec,rxaccum,part FROM druglst  WHERE comcode = '$comcode' and  grouptype !='pc' ";  
        $result = mysql_query($query) or die("Query failed");
        while (list ($drugcode,$tradname,$minimum,$totalstk,$mainstk,$stock,
	$rxrate,$stkpmon,$packing,$pack,$packpri_vat,$packpri,$row_id,$snspec,$spec,$rxaccum,$part
	) = mysql_fetch_row ($result)) {
if($snspec!=''){$snspec1='('.$snspec.')';}
else{$snspec1=$snspec;};

$nRxacc = $rxaccum;   
//echo $nRxacc," ",$days;
//exit();
	if ($nRxacc > 0 && $days > 0){
		$nRate      = ($nRxacc/$days)*30;      //จำนวนใช้ต่อเดือน
		$nMonth    = $totalstk/$nRate;           //จะมีเหลือใช้ได้อีกกี่เดือน
		
		$nRate = number_format($nRate,0);
		$nMonth = number_format($nMonth,1);

	}else {
		$nRate   = 0;
		$nMonth = 0;
	}

		if($part=="DPY" || $part=="DPN" || $part=="DSY" || $part=="DSN"){
			$sql1="select sum(stkcut) as amount from stktranx where drugcode = '$drugcode' and getdate between '$lastmonth1' and '$date1' ";
			//echo $sql1."<br>";
			$query1=mysql_query($sql1);
			list($amount)=mysql_fetch_array($query1);
			if($amount < 1){
				$amount=0;
				$rxrate3m=$amount/3;  //เฉลี่ยใช้ 3 เดือน
				$comment="มีการใช้ยาครั้งล่าสุดมากกว่า 3 เดือน";
			}else{
				$rxrate3m=$amount/3;  //เฉลี่ยใช้ 3 เดือน
			}
		}else{
			$drugcode=trim($drugcode);

			$sql1="select SUM(`amount`) as amount FROM drugrx where drugcode = '$drugcode' and (date >= '$lastmonth 00:00:00' and date <='$date 23:59:59') ";
			//echo $sql1."<br>";
			$query1=mysql_query($sql1);
			list($amount)=mysql_fetch_array($query1);
			if($amount < 1){
				$amount=0;
				$rxrate3m=$amount/3;  //เฉลี่ยใช้ 3 เดือน
				$comment="มีการใช้ยาครั้งล่าสุดมากกว่า 3 เดือน";
			}else{
				$rxrate3m=$amount/3;  //เฉลี่ยใช้ 3 เดือน
			}	
			//echo "$drugcode ==> $rxrate3m=$amount/3 <br>";
			if($drugcode=="2INTRAV" || 
			$drugcode=="2FORA" || 
			$drugcode=="2HEPA5" || 
			$drugcode=="2INSU_N" || 
			$drugcode=="2INSU_R" || 
			$drugcode=="2NSS3" || 
			$drugcode=="2NSS5ML" || 
			$drugcode=="2SEVO" || 
			$drugcode=="2SUCC" || 
			$drugcode=="2SWFI10" || 
			$drugcode=="2XY1" || 
			$drugcode=="2XY1AC" || 
			$drugcode=="2XY2_20" || 
			$drugcode=="3NSSI" || 
			$drugcode=="3WFI" || 
			$drugcode=="4ALC450" || 
			$drugcode=="4ALC95" || 
			$drugcode=="4AMMO5" || 
			$drugcode=="4DER25" || 
			$drugcode=="4EKC" || 
			$drugcode=="4STGEL" || 
			$drugcode=="4VAS50" || 
			$drugcode=="4XYLJ" || 
			$drugcode=="4XYLS" || 
			$drugcode=="6ATRO" || 
			$drugcode=="6CHLOO" || 
			$drugcode=="6MYDR" || 
			$drugcode=="7BERSO-NN"){			
				$sql2="select sum(stkcut) as amount from stktranx where drugcode = '$drugcode' and getdate between '$lastmonth1' and '$date1' ";
				//echo $sql2."<br>";
				$query2=mysql_query($sql2);
				list($amount2)=mysql_fetch_array($query2);
				$stkrate3m=$amount2/3;  //เฉลี่ยใช้ 3 เดือน
			}else{
				$stkrate3m="0.00";
			}
		}
		$nMonth_new=$totalstk/$rxrate3m;

            $n++;
            print (" <tr>\n".
               "  <td bgcolor=3399CC>$n</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
               "  <td BGCOLOR=66CDAA><a target=_BLANK  href=\"podgamt.php? Dgcode=$drugcode&Trade=".urlencode($tradname)." & Packing=$packing & Pack=$pack & Minimum=$minimum & Totalstk=$totalstk &Packpri_vat=$packpri_vat & Packpri=$packpri&Spec=$spec&Snspec=$snspec\"><font face='Angsana New'>$tradname $snspec1</a></td>\n".
			   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
				     "  <td BGCOLOR=66CDAA align='right'><font face='Angsana New'>$minimum</td>\n".
               "  <td BGCOLOR=66CDAA align='right'><font face='Angsana New'>".(number_format($totalstk))."</td>\n".
               "  <td BGCOLOR=66CDAA align='right'><font face='Angsana New'>".(number_format($mainstk))."</td>\n".
               "  <td BGCOLOR=66CDAA align='right'><font face='Angsana New'>".(number_format($stock))."</td>\n".
				"  <td BGCOLOR=66CDAA align='right'><font face='Angsana New'>".(number_format($rxrate3m,2))."</td>\n".
               "  <td BGCOLOR=EC7063 align='right'><font face='Angsana New'>".(number_format($nMonth_new,2))."</td>\n".
			   "  <td BGCOLOR=F5B041 align='right'><font face='Angsana New'>".(number_format($stkrate3m,2))."</td>\n".
               "  <td BGCOLOR=66CDAA align='center'><font face='Angsana New'>$packing</td>\n".
               "  <td BGCOLOR=66CDAA align='center'><font face='Angsana New'>$pack</td>\n".
               "  <td BGCOLOR=66CDAA align='right'><font face='Angsana New'>".(number_format($packpri_vat,2))."</td>\n".
               "  <td BGCOLOR=66CDAA align='right'><font face='Angsana New'>".(number_format($packpri,2))."</td>\n".
			   "  <td BGCOLOR=66CDAA align='center><font face='Angsana New'>$spec</td>\n".
			   "  <td BGCOLOR=66CDAA align='center><font face='Angsana New' size='2'>$comment</td>\n".
               " </tr>\n");
               }
	}
    else {
           die("ไม่พบรหัส $comcode ");
           }

   include("unconnect.inc");
          }
?>

</table>


 
