

<?php
session_start();

include("connect.inc");
$today=date("d-m-").(date("Y")+543);	
$today1=(date("Y")+543).date("-m-d");	
$tomonth=(date("Y")+543).date("-m");	


//หา VN จาก runno table
$query = "SELECT * FROM runno WHERE title = 'pharin_l'";
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
$nVn=$row->runno;
$dVndate=$row->startday;
$dVndate=substr($dVndate,0,10);
$today11 = date("Y-m-d");  
//print "$today<br>";
//print "$dVndate<br>";
//print "$nVn.'A'<br>";




if($today11==$dVndate){
		
		//print "<font face='Angsana New' size=5>$today11</font><br>";
	}

	//วันใหม่
	if($today11<>$dVndate){   
	$nVn=1; 
		$query ="UPDATE runno SET runno = $nVn,startday=now()  WHERE title='pharin_l'";
		$result = mysql_query($query) or die("Query failed");
		//   	         echo mysql_errno() . ": " . mysql_error(). "\n";
		//                       echo "<br>";
		print "ปรับคิวใหม่ <br>";
		
		$query ="UPDATE runno SET runno = $nVn,startday=now()  WHERE title='pharin_m'";
		$result = mysql_query($query) or die("Query failed");
		//   	         echo mysql_errno() . ": " . mysql_error(). "\n";
		//                       echo "<br>";
		print "ปรับคิวใหม่ <br>";
	}	







    $month["01"] = "มกราคม";
    $month["02"] = "กุมภาพันธ์";
    $month["03"] = "มีนาคม";
    $month["04"] = "เมษายน";
    $month["05"] = "พฤษภาคม";
    $month["06"] = "มิถุนายน";
    $month["07"] = "กรกฏาคม";
    $month["08"] = "สิงหาคม";
    $month["09"] = "กันยายน";
    $month["10"] = "ตุลาคม";
    $month["11"] = "พฤศจิกายน";
    $month["12"] = "ธันวาคม";




$refresh = "<meta http-equiv=\"refresh\" content=\"2;URL=".$_SERVER['PHP_SELF']."\">";

if(isset($_POST["cTdatehn"])){
	$cTdatehn = $today.$_POST["cTdatehn"];
    $cTdatehn1 =$_POST["cTdatehn"];

$sql = "Select pharin,kewphar,item,ptname,hn,tvn,ptright,nessdn,dpn,dsn From dphardep WHERE hn = '".$cTdatehn1."' AND  date LIKE '$today1%'  and (kewphar = '' or kewphar is null) limit 1 ";
//echo $sql ;
	$result = Mysql_Query($sql);

if(Mysql_num_rows($result) > 0){
		list($pharin,$kewphar,$item,$ptname,$hn,$tvn,$ptright,$nessdn,$dpn,$dsn) = Mysql_fetch_row($result);
		
		$m_pay=$nessdn+$dpn+$dsn;  //ผลรวมยาที่เบิกไม่ได้
		$ptright111=substr($ptright,0,3);	
		
	 	$sql = "Select code, pay From ptright where code like '$ptright111%' ";
     	$result = Mysql_Query($sql);
		list($codept, $pay) = Mysql_fetch_row($result);
		//echo $ptright111;
		//echo $pay;
if(($codept=="R07" && $m_pay =="16.5") || ($codept=="R07" && $m_pay =="33") || ($codept=="R09" && $m_pay =="16.5") || ($codept=="R09" && $m_pay =="33")){  //เช็คสิทธิ์ว่าเป็น 30 บาท หรือ ประกันสังคม หรือไม่? ถ้าใช่ให้เช็คต่อว่าเดือนนั้นๆ รับยาเกิน 1 หลอดแล้วหรือไม่?
$sqlb="select sum(amount) from drugrx where date like '$tomonth%' and hn='".$cTdatehn1."' and drugcode='4MET25'";
$queryb=mysql_query($sqlb);
list($sumamount)=mysql_fetch_array($queryb);

if($sumamount > 1){  //ถ้าเดือนนี้รับยาไปมากกว่า 1 หลอดให้ไปจ่ายเงิน แล้วออกคิว
	echo "<body Onload='window.print();'>";  
	echo "<font face='Angsana New' size='3'><center>HN:$hn VN:$tvn<br>$ptname<br>ผู้ป่วยต้องชำระเงิน<BR>ให้รอคิวที่ห้องจ่ายเงิน<br>หลังจากชำระเงินเสร็จสิ้น<br>ดูคิวรับยาที่ใบเสร็จรับเงิน</center>"; 
	$query ="update dphardep SET pharin ='".date("H:i:s")."' WHERE hn = '".$cTdatehn1."' AND  date LIKE '$today1%'  ";
	$result = mysql_query($query) or die("Query failed,update thaywin");
}else{  //ถ้ายังไม่ได้รับยา หรือ รับยาไม่ถึง 1 หลอดให้ออกคิวได้เลย
   		if(empty($kewphar)){  // ถ้าคิวว่าง
		$query3 = "select idguard  from opcard where hn= '$hn'  ";
		$row3 = mysql_query($query3);
		list($idguard) = mysql_fetch_array($row3);
		$idguard=substr($idguard,0,4);
			if($idguard =='MX01' or $idguard =='MX03' or $idguard =='MX03' ){$pharinx="pharin_m";}else{$pharinx="pharin_l";};
			//if($item<='4'){$pharinx="pharin_m";}else{$pharinx="pharin_l";};
				$sql = "Select prefix,runno From runno WHERE title ='$pharinx' ";
				$result = Mysql_Query($sql);
				list($prefix,$runno) = Mysql_fetch_row($result);
		
				$runno=sprintf('%03d',$runno);
				$kew=$prefix.$runno;

				$query ="update dphardep SET pharin ='".date("H:i:s")."', kewphar='$kew' WHERE hn = '".$cTdatehn1."' AND  date LIKE '$today1%'  ";
				$result = mysql_query($query) or die("Query failed,update thaywin");

				$sql ="update runno SET runno = runno+1 WHERE title='$pharinx'";
				$result = Mysql_Query($sql);
				
				$today=date("d-m-").(date("Y")+543);	
				$todaytime=date("H:i:s");	

				echo "<body Onload='window.print();'>";
				echo "<font   style='line-height:18px;'  face='Angsana New' size='3'><center>ใบรอรับยา รพ.ค่ายสุรศักดิ์มนตรี<br></FONT>";
				 //  echo "<font face='Angsana New' size='3'>โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง<br>";
	   	   		echo " <font style='line-height:20px;'  face='Angsana New' size='3'>เวลายื่นใบยา&nbsp;$today&nbsp;$todaytime<br>"; 
	       		echo "<font style='line-height:20px;'  face='Angsana New' size='4'><b>ชื่อ &nbsp;$ptname <br> <font face='Angsana New' size='2'>&nbsp;HN:$hn&nbsp;VN:$tvn</b><br>";
	   	   		echo " <font style='line-height:35px;'  face='Angsana New' size='7'>$kew<BR>";
		   		echo " <font style='line-height:20px;'  face='Angsana New' size='3'>**กรุณารอเรียกชื่อและคิว**</center>";
		   		echo " <font style='line-height:20px;'  face='Angsana New' size='3'><center>**ในกรณีที่เรียกผ่านแล้ว</center>";
		    	echo " <font style='line-height:20px;'  face='Angsana New' size='3'><center>ให้ติดต่อช่องหมายเลข 6**</center>";
	   		}else{  //else ถ้าคิวไม่ว่าง
				echo "<body Onload='window.print();'>";
				echo "<font style='line-height:18px;'  face='Angsana New' size='5'><center>ได้ให้คิวไปเรียบร้อยแล้ว<br>"; 
				echo "<font style='line-height:25px;'  face='Angsana New' size='7'><b>ชื่อ &nbsp;$ptname <br> <font face='Angsana New' size='2'>&nbsp;HN:$hn&nbsp;VN:$tvn</b><br>";
        		echo "<font style='line-height:25px;'  face='Angsana New' size='10'>คิวที่ $kewphar</center>";						
			}  //close เช็คคิว
}  //จบการเช็ครับยาเกินหรือไม่เกิน 1 หลอด

}else{  //ถ้าเป็นสิทธิ์อื่นๆ นอกเหนือจากสิทธิ์ 30 บาท และประกันสังคม
	if($pay =='y' || ($pay =='x' and $m_pay >0)){  //เช็คว่าต้องชำระเงินหรือไม่ ถ้าชำระเงินให้ออกคิวที่จัดเก็บรายได้
		
		echo "<body Onload='window.print();'>";  
		echo "<font face='Angsana New' size='3'><center>HN:$hn VN:$tvn<br>$ptname<br>ผู้ป่วยต้องชำระเงิน<BR>ให้รอคิวที่ห้องจ่ายเงิน<br>หลังจากชำระเงินเสร็จสิ้น<br>ดูคิวรับยาที่ใบเสร็จรับเงิน</center>"; 
		$query ="update dphardep SET pharin ='".date("H:i:s")."' WHERE hn = '".$cTdatehn1."' AND  date LIKE '$today1%'  ";
		$result = mysql_query($query) or die("Query failed,update thaywin");
		
	}else{  //else ถ้าไม่ต้องชำระเงิน
   		if(empty($kewphar)){
		$query3 = "select idguard  from opcard where hn= '$hn'  ";
		$row3 = mysql_query($query3);
		list($idguard) = mysql_fetch_array($row3);
		$idguard=substr($idguard,0,4);
			if($idguard =='MX01' or $idguard =='MX03' or $idguard =='MX03' ){$pharinx="pharin_m";}else{$pharinx="pharin_l";};
			//if($item<='4'){$pharinx="pharin_m";}else{$pharinx="pharin_l";};
				$sql = "Select prefix,runno From runno WHERE title ='$pharinx' ";
				$result = Mysql_Query($sql);
				list($prefix,$runno) = Mysql_fetch_row($result);
		
				$runno=sprintf('%03d',$runno);
				$kew=$prefix.$runno;

				$query ="update dphardep SET pharin ='".date("H:i:s")."', kewphar='$kew' WHERE hn = '".$cTdatehn1."' AND  date LIKE '$today1%'  ";
				$result = mysql_query($query) or die("Query failed,update thaywin");

				$sql ="update runno SET runno = runno+1 WHERE title='$pharinx'";
				$result = Mysql_Query($sql);
				
				$today=date("d-m-").(date("Y")+543);	
				$todaytime=date("H:i:s");	

				echo "<body Onload='window.print();'>";
				echo "<font   style='line-height:18px;'  face='Angsana New' size='3'><center>ใบรอรับยา รพ.ค่ายสุรศักดิ์มนตรี<br></FONT>";
				 //  echo "<font face='Angsana New' size='3'>โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง<br>";
	   	   		echo " <font style='line-height:20px;'  face='Angsana New' size='3'>เวลายื่นใบยา&nbsp;$today&nbsp;$todaytime<br>"; 
	       		echo "<font style='line-height:20px;'  face='Angsana New' size='4'><b>ชื่อ &nbsp;$ptname <br> <font face='Angsana New' size='2'>&nbsp;HN:$hn&nbsp;VN:$tvn</b><br>";
	   	   		echo " <font style='line-height:35px;'  face='Angsana New' size='7'>$kew<BR>";
		   		echo " <font style='line-height:20px;'  face='Angsana New' size='3'>**กรุณารอเรียกชื่อและคิว**</center>";
		   		echo " <font style='line-height:20px;'  face='Angsana New' size='3'><center>**ในกรณีที่เรียกผ่านแล้ว</center>";
		    	echo " <font style='line-height:20px;'  face='Angsana New' size='3'><center>ให้ติดต่อช่องหมายเลข 6**</center>";
	   	}else{  //else ถ้าคิวไม่ว่าง
			echo "<body Onload='window.print();'>";
			echo "<font style='line-height:18px;'  face='Angsana New' size='5'><center>ได้ให้คิวไปเรียบร้อยแล้ว<br>"; 
			echo "<font style='line-height:25px;'  face='Angsana New' size='7'><b>ชื่อ &nbsp;$ptname <br> <font face='Angsana New' size='2'>&nbsp;HN:$hn&nbsp;VN:$tvn</b><br>";
        	echo "<font style='line-height:25px;'  face='Angsana New' size='10'>คิวที่ $kewphar</center>";						
		} //close เช็คคิว
	}  //close if เช็คการชำระเงิน
}  //close if ptright 30 บาท หรือ ประกันสังคม
}else{  //else if(Mysql_num_rows($result) > 0){
	echo "<font face='Angsana New' size='5'><center>ไม่มีหมายเลขรับยานี้</center>"; 
}  //close if(Mysql_num_rows($result) > 0){
	echo $refresh;
	exit();
}  //close if(isset($_POST["cTdatehn"])){
 
?>
<html>
<head>
<title>ให้คิวด้วย  HN ผู้ป่วย</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="100;URL=<?php echo $_SERVER['PHP_SELF'];?>">
</head>
<body onLoad="document.getElementById('cTdatehn').focus();" onclick="document.getElementById('cTdatehn').focus();">
<?php

    echo "วันที่ ".date("d")." ".$month[date("m")]." ".(date("Y")+543)." ";
//	echo " $today1";
//    echo "<BR>  <a target=_self  href='../nindex.htm'>&lt;&lt;ไปเมนู............</a><br> ";
     echo "<BR><font size='5' color='#00ff00'>ลงเวลารับใบสั่งยาผู้ป่วยด้วย  HN ผู้ป่วย</font>&nbsp;&nbsp; <a target=bank  href='phakewmanual.php'>ให้คิว Manual</a>&nbsp;&nbsp; <a target=bank  href='phas.php'>เปิดเสียงพูด</a>&nbsp;&nbsp; <a target=bank  href='kewpharedit.php'>RESET Q</a>&nbsp;&nbsp;  <a target=_self  href='../nindex.htm'>&lt;&lt;ไปเมนู............</a><br> ";
    
$today=(date("Y")+543).date("-m-d");
$N='N';

?>

<FORM METHOD=POST ACTION="<?php echo $_SERVER['PHP_SELF'];?>">
	<TABLE>
		<TR>
			<TD>HN&nbsp;:&nbsp;</TD>
			<TD><INPUT ID="cTdatehn" TYPE="text" NAME="cTdatehn"></TD>
		</TR>
	</TABLE>
</FORM>

<?php
/*
function strtime($time){

		$subtime = explode(":",$time);
		$rt = mktime($subtime[0],$subtime[1],$subtime[2],date("m"),date("d"),date("Y"));

	return  $rt;
}
*/
$sql = "Select prefix,runno From runno WHERE title ='pharin_m' ";
	$result = Mysql_Query($sql);
		list($prefixm,$runnom) = Mysql_fetch_row($result);

$kewm=$prefixm.$runnom;


		$sql = "Select prefix,runno From runno WHERE title ='pharin_l' ";
	$result = Mysql_Query($sql);
		list($prefixl,$runnol) = Mysql_fetch_row($result);

$kewl=$prefixl.$runnol;

       echo " <center><font face='Angsana New' size ='5' >คิวต่อไป &nbsp;&nbsp; $kewl &nbsp;&nbsp; $kewm	</center> ";



    $query = "SELECT chktranx,date,ptname,hn,an,price,tvn,ptright,kew,pharout,doctor,pharin,pharout1,kewphar FROM dphardep WHERE date LIKE '$today1%' and pharin <> ''  and kewphar <> ''  and dr_cancle 	is null order by pharin DESC   ";

    $result = mysql_query($query) or die("Query failed");
	if(Mysql_num_rows($result) > 0){
?>
<table  align="center" style="font-family: Angsana New; font-size: 25px;">
 <tr>
  </tr>
 <tr>

 <th bgcolor="6495ED">คิว</th>	
 <th bgcolor="6495ED">##</th>	
	<th bgcolor="6495ED">VN</th>
    <th bgcolor="6495ED">HN</th>
    <th bgcolor="6495ED">##</th>	
	<th bgcolor="6495ED">ชื่อ-สกุล</th>
    <th bgcolor="6495ED">สิทธิ</th>
	
	
	 
	  <th bgcolor="6495ED">Part</th>
  
	   <th bgcolor="6495ED">เวลารอ</th>
  </tr>

<?php

     $j=0;
	$countavg = 0;
    while (list ($chktranx,$date,$ptname,$hn,$an,$price,$tvn,$ptright,$kew,$pharout,$doctor,$pharin,$pharout1,$kewphar) = mysql_fetch_row ($result)) {
        $time=substr($thidate,11);
		
	$query3 = "select idguard,ptright  from opcard where hn= '$hn'  ";
	$row3 = mysql_query($query3);
	list($idguard,$ptright) = mysql_fetch_array($row3);	
		
$ptright=substr($ptright,0,25);
/*	if($pharout != ""){

$subtime = explode(":",$pharin);
$rt = mktime($subtime[0],$subtime[1],$subtime[2],date("m"),date("d"),date("Y"));
$stringtime = strtime($pharout) - $rt;
if($stringtime > 600){
	$pharout = date("H:i:s",mktime($subtime[0],$subtime[1]+5,$subtime[2]+rand(1,60),date("m"),date("d"),date("Y")));
}
					$stringtime1 = strtime($pharin);
					$stringtime2 = strtime($pharout);
					$stringtime3 = $stringtime2-$stringtime1;
					$time3 = date("i:s",mktime(0,0,0+$stringtime3,date("m"),date("d"),date("Y")));
					$countavg = $countavg+$stringtime3;
					$j++;
				}else{
					$time3 = "";
				}
*/

$starttime = $pharin;
	$lasttime = $pharout;
	if($lasttime!=""and $starttime!=""){
		$stringtime3=strtotime($lasttime) - strtotime($starttime);
		$time3 = date("H:i:s",mktime(0,0,0+$stringtime3,date("m"),date("d"),date("Y")));	
	}else{
		$time3 = "&nbsp;";
	}

        print (
					" <tr>\n".
				
			"  <td BGCOLOR=ffffff><font face='Angsana New' size ='5'><b>$kewphar</b></td>\n".
			"  <td BGCOLOR=fffffff><font face='Angsana New' ></td>\n".
					"  <td BGCOLOR=fffffff><font face='Angsana New' >$tvn</td>\n".
						"  <td BGCOLOR=fffffff><font face='Angsana New'  color='red' ><b>$hn</b></td>\n".
							"  <td BGCOLOR=fffffff><font face='Angsana New' size ='3'  >$kew</td>\n".
					"  <td BGCOLOR=fffffff><font face='Angsana New' size ='5' ><b>$ptname</b></td>\n".
					
						"  <td BGCOLOR=fffffff><font face='Angsana New' size ='2' >$ptright</td>\n".
					//"  <td BGCOLOR=ffffff><font face='Angsana New'>$hn</td>\n".
					//"  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptright</td>\n".
					//"  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".
					//"  <td BGCOLOR=ffffff><font face='Angsana New'>$pharin</td>\n".
				//	"  <td BGCOLOR=ffffff><font face='Angsana New'>$pharout</td>\n".
//"  <td BGCOLOR=66CDAA><font face='Angsana New'>$pharout1</td>\n".
		"  <td BGCOLOR=fffffff><font face='Angsana New' size='3'>$idguard</td>\n".
					"  <td BGCOLOR=fffffff><font face='Angsana New' size='3'><b>$time3</b></td>\n".
					" </tr>\n");
       }
	
?>

</table>

<?php
	}
	
	
	
		$query3 = "select newpha from newpha  ";
	$row3 = mysql_query($query3);
	list($newpha) = mysql_fetch_array($row3);
	
    include("unconnect.inc");
?>

</body>
<MARQUEE><STRONG><SPAN  <font color=#ffffff><font size="9"  face="THSarabunPSK"  color="#000099"> 
***<?php echo $newpha ?> ***</FONT></FONT></SPAN></STRONG></MARQUEE>
</html>