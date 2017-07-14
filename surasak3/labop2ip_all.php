<a href="../nindex.htm" class="forntsarabun">กลับเมนูหลัก</a>&nbsp;<a href="monerase.php" class="forntsarabun">โอนค่าใช้จ่ายรายต่อไป</a><br />

<?php
    session_start();

	//*******************************************//
$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
$Thidate = (date("Y")+543).date("-m-d H:i:s"); 

$ptname=$_POST['ptname'];
$tvn=$_POST['tvn'];
$ptright=$_POST['ptright'];
$cDiag=$_POST['diag'];
$cDoctor=$_POST['doctor'];
$grow_id=$_POST['grow_id'];


 include("connect.inc");

$Thidate1 = (date("Y")+543).date("-m-d"); 
$sql = "Select an From ipcard where hn = '".$_GET['hn']."'  order by date desc limit 1 ";
$result2 = mysql_query($sql) or die(mysql_error());
list($cAn) = mysql_fetch_row($result2);


  

// in case of inpatient insert data into ipacc
if (!empty($cAn)){
	for($n=0;$n<count($_POST["chk"]);$n++){	 
		if($_POST["chk"][$n] != ""){
			$query = "SELECT a.row_id,a.idno,a.date,a.ptname,a.hn,a.an,a.code,a.detail,a.depart,a.amount,a.price,a.yprice,a.nprice,a.part ,b.diag,b.doctor,b.ptright ,b.tvn FROM patdata as a ,depart as b WHERE a.idno=b.row_id and a.row_id='".$_POST["chk"][$n]."' ";

			$result = mysql_query($query)or die("Query failed");
  			list ($row_id,$idno,$date,$ptname,$hn,$an,$code,$detail,$depart,$amount,$price,$yprice,$nprice,$part,$diag,$doctor,$ptright,$tvn) = mysql_fetch_row ($result);
  
			if($part=="LAB"||$part=="NCARE"||$part=="TOOL"||$part=="XRAY"||$part=="MC"||$part=="SINV"||$part=="SURG"||$part=="PT"||$part=="DENTA"||$part=="OTHER"||$part=="BLOOD"||$part=="STX"){
				$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,yprice,nprice,idname,part,accno,idno,ptright) VALUES('$Thidate','$cAn','$code','$depart','$detail','$amount','$yprice','$yprice','0','$sOfficer','".$part."Y','1','$idno','$ptright');";
				
				$result = mysql_query($query) or die("Query failed,cannot insert into ipacc1");//เบิกได้
				if($nprice>0){
					$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,yprice,nprice,idname,part,accno,idno,ptright)VALUES('$Thidate','$cAn','$code','$depart','$detail(ส่วนเกิน)','$amount','$nprice','0','$nprice','$sOfficer','".$part."N','1','$idno','$ptright');";
					$result = mysql_query($query) or die("Query failed,cannot insert into ipacc2");//เบิกไม่ได้
					
				}
			}else{
				$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,yprice,nprice,idname,part,accno,idno,ptright) VALUES('$Thidate','$cAn','$code','$depart','$detail','$amount','$price','$yprice','$nprice','$sOfficer','$part','1','$idno','$ptright');";
				$result = mysql_query($query) or die("Query failed,cannot insert into ipacc3");//ปกติ
				
			}    
	
			//echo $_POST['grow_id'][$n]."<br>";	  
			/*$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,yprice,nprice,idname,part,idno)VALUES('$Thidate','$cAn','".$code."','".$depart."','".$detail."','".$amount."','".$price."','".$yprice."','".$nprice."','$sOfficer','".$part."','".$idno."')";
 				  $result = mysql_query($query) or die("Query failed,cannot insert into ipacc");
			*/
			if($_POST["chk"][$n] != ""){
				  $update="UPDATE patdata set tranipacc='ipacc' WHERE row_id='".$_POST['chk'][$n]."' ";
 				  $resultupdate= mysql_query($update) or die("Query failed,update tranipacc ");
			}
			
			
	}		   
}
//ใบแจ้งการส่งข้อมูลไป บ/ช ผป.ใน



    print "<font face='Angsana New'>$Thaidate<br>";
    print "$ptname HN:$hn VN:$tvn AN:$cAn<br>";
    print "สิทธิ: $ptright<br>";
    print "โรค :$cDiag<br>";
    print "แพทย์:$cDoctor<br>";

      print "<table>";
      print " <tr>";
      print "  <th>#</th>";
      print "  <th>รายการ</th>";
      print "  <th>จำนวน</th>";
      print "  <th>ราคา</th>";
      print " </tr>";

    $no=0;
for($n=0;$n<count($_POST["chk"]);$n++){

If (!empty($code)){
  $no++;      
$query1 = "SELECT a.row_id,a.idno,a.date,a.ptname,a.hn,a.an,a.code,a.detail,a.depart,a.amount,a.price,a.yprice,a.nprice,a.part ,b.diag,b.doctor,b.ptright ,b.tvn FROM patdata as a ,depart as b WHERE a.idno=b.row_id and a.row_id='".$_POST["chk"][$n]."' ";
$result1 = mysql_query($query1)or die("Query failed");
list ($row_id,$idno,$date,$ptname,$hn,$an,$code,$detail1,$depart,$amount1,$price1,$yprice,$nprice,$part,$diag,$doctor,$ptright,$tvn) = mysql_fetch_row ($result1);    
 
	    print (" <tr>\n".
           "  <td>$no</td>\n".
           "  <td>$detail1</td>\n".
           "  <td>$amount1</td>\n".
           "  <td>$price1</td>\n".
           " </tr>\n");
		   $Netprice+=$price1; 
		}
	}
   print "</table>";
   print "ราคารวม $Netprice บาท<br>";
//จบใบแจ้งการส่งข้อมูล
      print "ส่งข้อมูลเข้าบัญชีผู้ป่วยใน $ptname  AN: $cAn เรียบร้อย <br>";
      print "จนท. $sOfficer  $Thaidate<br>";
	}
else{
	  echo $cAn;
	  print"<FONT SIZE=\"4\" COLOR=\"#FF0000\">ไม่สามารถส่งข้อมูลเข้าบัญชีผู้ป่วยในได้ เนื่องจาก ผู้ป่วยเป็นผู้ป่วยนอก ไม่ได้ทำการadmit</FONT>";
}
?>
 
