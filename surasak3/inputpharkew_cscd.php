<?php
session_start();

include("connect.inc");
$today=date("d-m-").(date("Y")+543);	
$today1=(date("Y")+543).date("-m-d");	
$tomonth=(date("Y")+543).date("-m");	

$today=date("d-m-").(date("Y")+543);	
$todaytime=date("H:i:s");	
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

$nVn=$row->runno;
$dVndate=$row->startday;
$dVndate=substr($dVndate,0,10);
$today11 = date("Y-m-d");  

if($today11==$dVndate){
		
		//print "<font face='Angsana New' size=5>$today11</font><br>";
}

if(isset($_GET["cTdatehn"])){

	$cTdatehn = $today.$_GET["cTdatehn"];
    $cTdatehn1 =$_GET["cTdatehn"];

$sql = "Select pharin,kewphar,item,ptname,hn,tvn,ptright,nessdn,dpn,dsn From dphardep WHERE hn = '".$cTdatehn1."' AND  date LIKE '$today1%' limit 1 ";
//echo $sql ;
$result = Mysql_Query($sql);
list($pharin,$kewphar,$item,$ptname,$hn,$tvn,$ptright,$nessdn,$dpn,$dsn) = Mysql_fetch_row($result);

	if(empty($pharin)){
		echo "<script>alert('ไม่สามารถพิมพ์คิวได้ เนื่องจากผู้ป่วยรายนี้ยังไม่ได้ผ่านจุดรับใบสั่งยา');</script>";
		?>
        <script>window.close();</script>
        <?
	}else{
	
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
		
		//echo "===>".$_GET["cTdatehn"];	
			if(empty($kewphar)){
			$query3 = "select idguard,ptright  from opcard where hn= '$hn'  ";
			$row3 = mysql_query($query3);
			list($idguard,$ptright) = mysql_fetch_array($row3);
			$idguard=substr($idguard,0,4);  //ประเภทผู้รับบริการ
			$ptright=substr($ptright,0,3);  //สิทธิการรักษา
				if($idguard =='MX01' or $idguard =='MX03' or $idguard =='MX03' ){
					$pharinx="pharin_m";  //ทค=ทหาร/ครอบครัว
				}else{
					$pharinx="pharin_l";  //ทั่วไป
				}
				//if($item<='4'){$pharinx="pharin_m";}else{$pharinx="pharin_l";};
					$sql = "Select prefix,runno From runno WHERE title ='$pharinx' ";
					$result = Mysql_Query($sql);
					list($prefix,$runno) = Mysql_fetch_row($result);
			
					$runno=sprintf('%03d',$runno);
					$kew=$prefix.$runno;
					//echo "คิว".$kew;
	
					$query ="update dphardep SET pharin ='".date("H:i:s")."', kewphar='$kew' WHERE hn = '".$cTdatehn1."' AND  date LIKE '$today1%'  ";
					$result = mysql_query($query) or die("Query failed,update thaywin");
	
					$sql ="update runno SET runno = runno+1 WHERE title='$pharinx'";
					$result = Mysql_Query($sql);
					
	
					echo "<body Onload='window.print();'>";
					echo "<font  style='line-height:18px;'  face='Angsana New' size='3'><center>ใบรอรับยา รพ.ค่ายสุรศักดิ์มนตรี<br></FONT>";
					echo " <font style='line-height:20px;'  face='Angsana New' size='3'>เวลายื่นใบยา&nbsp;$today&nbsp;$todaytime<br>"; 
					echo "<font style='line-height:20px;'  face='Angsana New' size='4'><b>ชื่อ &nbsp;$ptname <br> <font face='Angsana New' size='2'>&nbsp;HN:$hn&nbsp;VN:$tvn</b><br>";
					echo " <font style='line-height:35px;'  face='Angsana New' size='7'>$kew<BR>";
					echo " <font style='line-height:20px;'  face='Angsana New' size='3'>**กรุณารอเรียกชื่อและคิว**</center>";
					echo " <font style='line-height:20px;'  face='Angsana New' size='3'><center>**ในกรณีที่เรียกผ่านแล้ว</center>";
					echo " <font style='line-height:20px;'  face='Angsana New' size='3'><center>ให้ติดต่อช่องหมายเลข 6**</center>";				
			}else{  //else ถ้าคิวไม่ว่าง
					echo "<body Onload='window.print();'>";
					echo "<font   style='line-height:18px;'  face='Angsana New' size='3'><center>ได้รับคิวไปเรียบร้อย<br></FONT>";
					echo " <font style='line-height:20px;'  face='Angsana New' size='3'>เวลายื่นใบยา&nbsp;$today&nbsp;$todaytime<br>"; 
					echo "<font style='line-height:20px;'  face='Angsana New' size='4'><b>ชื่อ &nbsp;$ptname <br> <font face='Angsana New' size='2'>&nbsp;HN:$hn&nbsp;VN:$tvn</b><br>";
					echo " <font style='line-height:35px;'  face='Angsana New' size='7'>$kewphar<BR>";
					echo " <font style='line-height:20px;'  face='Angsana New' size='3'>**กรุณารอเรียกชื่อและคิว**</center>";
					echo " <font style='line-height:20px;'  face='Angsana New' size='3'><center>**ในกรณีที่เรียกผ่านแล้ว</center>";
					echo " <font style='line-height:20px;'  face='Angsana New' size='3'><center>ให้ติดต่อช่องหมายเลข 6**</center>";
								
			} //close เช็คคิว
		}
}  //close if(isset($_GET["cTdatehn"])){			