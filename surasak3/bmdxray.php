<?
session_start();
include("connect.inc");
?>
<style>
.font1{
	font-family:AngsanaUPC;
	font-size:14px;
}
</style>
<body class="font1">
<?php

$query = "select prefix,runno from runno where title = 'depart' ";
$row = mysql_query($query);
list($prefix,$runno) = mysql_fetch_array($row);
		
$runno2=++$runno;
$query2 = "update runno set runno='$runno2' where title='depart' ";
mysql_query($query2);

$datenow = (date("Y")+543)."-".date("m-d H:i:s");
$sql = "select * from orderbmd where row_id = '".$_POST['idno']."' ";
$row = mysql_query($sql);
$result = mysql_fetch_array($row);

$sql2 = "select * from dorderbmd where idno = '".$_POST['idno']."' ";
$row2 = mysql_query($sql2);
$result2 = mysql_fetch_array($row2);

$query2 ="insert into depart (chktranx,date,ptname,hn,an,doctor,depart,item,detail,price,sumyprice,	sumnprice,paid,idname,diag,accno,tvn,ptright,lab,detailbydr,status,priority,patient_from) values ('".$runno2."','".$datenow."','".$result['ptname']."','".$result['hn']."','','".$_POST['doctor']."','XRAY','2','ค่าตรวจวิเคราะห์โรค','2000.00','".$result2['sumyprice']."','".$result2['sumnprice']."','0.00','".$_SESSION['sOfficer']."','".$_POST['diag']."','0','".$_SESSION['tvn']."','".$_POST['pt']."','','','Y','','')";
$rep2 = mysql_query($query2);
if($rep2){
	$nrow = mysql_insert_id();
	$idnopat=$nrow;
	if($result2['sumyprice']>0){
		$ypri=1000;
		$npri=0;
	}else{
		$ypri=0;
		$npri=1000;
	}
	for($q=0;$q<2;$q++){
		$query3 ="insert into patdata (date,hn,an,ptname,doctor,item,code,detail,amount,	price,yprice,nprice,depart,part,idno,ptright,status) values ('".$datenow."','".$result['hn']."','','".$result['ptname']."','".$_POST['doctor']."','1','42702','(42702
)Bone density: X-rays 1 part','1','1000.00','".$ypri."','".$npri."','XRAY','XRAY','".$nrow."','".$_POST['pt']."','Y')";
		$result3 = mysql_query($query3);
	}
	if($_POST['payout']){
		$query4 = "SELECT title,prefix,runno FROM runno WHERE title = 'depart'";
		$result4 = mysql_query($query4)
			or die("Query failed");
	
		for ($i = mysql_num_rows($result4) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result4, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}
	
			if(!($row = mysql_fetch_object($result4)))
				continue;
			 }
	
		$nRunno=$row->runno;
		$nRunno++;
	
		$query9 ="UPDATE runno SET runno = $nRunno WHERE title='depart'";
		$result9 = mysql_query($query9) or die("Query failed");
		
		$query5 = "INSERT INTO depart(chktranx,date,ptname,hn,an,depart,item,detail,price,sumyprice,sumnprice,paid, idname,accno,tvn,ptright)VALUES('".$nRunno."','".$datenow."','".$result['ptname']."','".$result['hn']."','','OTHER','1','(55020/55021 ค่าบริการผู้ป่วยนอกเวลาราชการ)', '200','0','200','','".$_SESSION["sOfficer"]."','0','".$_SESSION['tvn']."','".$_POST['pt']."');";
		$result5 = mysql_query($query5);
		$idno=mysql_insert_id();
		
		$query6 = "INSERT INTO patdata(date,hn,an,ptname,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright) VALUES('".$datenow."','".$result['hn']."','','".$result['ptname']."','1','SERVICE','(55020/55021 ค่าบริการผู้ป่วยนอกเวลาราชการ)','1','200','0','200','OTHER','OTHER','".$idno."','".$_POST['pt']."');";
		$result6 = mysql_query($query6) or die("Query failed,cannot insert into patdata");
		$today = date("d-m-Y");   
        $d=substr($today,0,2);
    	$m=substr($today,3,2);
    	$yr=substr($today,6,4) +543;  
		$idout = $idno;
		$thdatehn=$d.'-'.$m.'-'.$yr.$result['hn'];
		$query7 ="UPDATE opday SET other=(other+200) WHERE thdatehn= '$thdatehn' AND vn = '".$_SESSION['tvn']."' ";
      	$result7 = mysql_query($query7) or die("Query failed,update opday");
	}
}
			
$up1= "update orderbmd set status='Y' where row_id = '".$_POST['idno']."' ";
mysql_query($up1);
$up2= "update dorderbmd set status='Y' where idno = '".$_POST['idno']."' ";
mysql_query($up2);


/*echo "วันที่ทำ:".date("d-m-").(date("Y")+543)." ".date("H:i:s")."&nbsp;&nbsp;";
echo "วันที่สั่ง:".substr($result["date"],8,2)."-".substr($result["date"],5,2)."-".substr($result["date"],0,4)." ".substr($result["date"],11)."<br>";
echo "HN:".$result['hn']."&nbsp;&nbsp;";
echo "ชื่อ:".$result['ptname']."&nbsp;&nbsp;";
echo "อายุ:".$result['age']."<br>";
echo "เหตุผลการส่งตรวจ :";
for($i=1;$i<11;$i++){
	if($result['sub'.$i]!=""){
		$str_arr = str_split($result['sub'.$i],50);
		for($m=0;$m<count($str_arr);$m++){
			$str_all .= $str_arr[$m]."<br/>";
		}
		echo "-".$str_all;
	}
}*/
	$sel5 = "select * from patdata where idno = '$idnopat' ";
	$row5 = mysql_query($sel5);
//ใบแจ้งหนี้
  print "ใบแจ้งหนี้<br>";
     print "<font face='Angsana New'>$result[ptname] HN:$result[hn] VN:$_SESSION[tvn]  สิทธิ: ".$_POST['pt']."<br>";
//    print "สิทธิ: $cPtright<br>";
    print "โรค:".$_POST['diag']." แพทย์:".$_POST['doctor']."<br>";
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
  	while($arr5= mysql_fetch_array($row5)){
              $no++;
         print (" <tr>\n".
           "  <td>$no</td>\n".
           "  <td>$arr5[detail]</td>\n".
           "  <td>$arr5[amount]</td>\n".
           "  <td>$arr5[price]</td>\n".
           "  <td>$arr5[nprice]</td>\n".
           " </tr>\n");
		 $Netprice +=$arr5['price'];
		 $aSumNprice+=$arr5[nprice];
	}
	if($idout!=""){
		$sel6 = "select * from patdata where idno = '$idout' ";
		$row6 = mysql_query($sel6);
		while($arr6= mysql_fetch_array($row6)){
				  $no++;
			 print (" <tr>\n".
			   "  <td>$no</td>\n".
			   "  <td>$arr6[detail]</td>\n".
			   "  <td>$arr6[amount]</td>\n".
			   "  <td>$arr6[price]</td>\n".
			   "  <td>$arr6[nprice]</td>\n".
			   " </tr>\n");
			 $Netprice +=$arr6['price'];
			 $aSumNprice+=$arr6[nprice];
		}
	}
      print "</table>";
   print "<B>ราคารวม $Netprice บาท </B><br>";
   if ($aSumNprice>0){
			print"<B>(เบิกไม่ได้ $aSumNprice บาท )</B><br>";
					   }
   print "จนท. $sOfficer";  
      print "<font face='Angsana New'>&nbsp;&nbsp;$datenow<br>";
      print "***************************************************<br>";  
	     print "<B>นำใบแจ้งหนี้ไปชำระเงินที่ห้องเก็บเงิน</B>";  
//จบใบแจ้งหนี้
?>
	<script>
		window.print();
    </script>
<?
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"3;URL=bmdhn.php\">";
?>
</body>