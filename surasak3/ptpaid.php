<?php
  	session_start();
    $Thaidate=date("d-m-").(date("Y")+543);

    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
	include("connect.inc");
 	$aCode = array("รหัส");
    $aDetail  = array("รายการ");
    $aDSPY = array("dspy"); 
	$aDSPN = array("dspn"); 
    $aAmount  = array("จำนวน");
    $aMCprice  = array("ราคารวม");
    $aYprino= array("ราคาเบิกได้");
    $aNprino= array("ราคาเบิกไม่ได้");
    $no=0;
	for($no=1; $no<=12; $no++){
		if($_POST['item'.$no] !=""){
			$NetMcpri=$NetMcpri+$_POST['price'.$no]; //รวมเงินทั้งหมด
			$Netyprice=$Netyprice+$_POST['yprice'.$no]; //รวมเงินที่เบิกได้
			$Netnprice=$Netnprice+$_POST['nprice'.$no]; //รวมเงินที่เบิกไม่ได้
			if($_POST['yprice'.$no] >=0&&$_POST['dsp'.$no] =="DS") {
				$ydspp="DSY";
			}elseif($_POST['yprice'.$no] >=0&&$_POST['dsp'.$no] =="DP") {
				$ydspp="DPY";
			}
			
			if($_POST['nprice'.$no] >=0&&$_POST['dsp'.$no] =="DS") {
				$ndspp="DSN";
			}elseif($_POST['nprice'.$no] >=0&&$_POST['dsp'.$no] =="DP") {
				$ndspp="DPN";
			}
			
			$aCode[$no] = "PHYSI";
			$aDetail[$no]  = $_POST['dpycode'.$no].' '.$_POST['item'.$no];
			$aDSPY[$no]= $ydspp;
			$aDSPN[$no]= $ndspp;
			$aAmount[$no]  = $_POST['amount'.$no];
			$aMCprice[$no]  = $_POST['price'.$no];
			$aYprino[$no]= $_POST['yprice'.$no]; 
			$aNprino[$no]=$_POST['nprice'.$no]; 
			$item++;
		}
		if($_POST['item1']==""){
			 if (!empty($cAn)){
			?>
			<script>
				alert("ไม่มีรายการค่าอุปกรณ์ กรุณาลงบันทึกใหม่");
				window.location.href='ptipitem.php';
			</script>
			<?
			}
			else{
			?>
			<script>
				alert("ไม่มีรายการค่าอุปกรณ์ กรุณาลงบันทึกใหม่");
				window.location.href='ptpage.php';
			</script>
			<?
			} 
		}
	}
       //insert data into depart
	   if (!empty($cAn)){
                $tvn=$cAn;
       	}
    	else{
                $tvn=$tvn;
		} 
       $query = "INSERT INTO depart(date,ptname,hn,an,doctor,depart,item,detail,price,sumyprice,sumnprice,
                    idname,diag,accno,tvn,ptright)VALUES('$Thidate','$cPtname','$cHn','$cAn','$cDoctor','PHYSI','$item','ค่าอวัยวะเทียม/อุปกรณ์ในการบำบัดรักษา',
                    '$NetMcpri','$Netyprice','$Netnprice','$sOfficer','$cDiag','$cAccno','$tvn','$cPtright');";
       $result = mysql_query($query) or die("Query failed,cannot insert into depart");
       $idno=mysql_insert_id();

    echo "<font face='Angsana New'>รายการค่าอวัยวะเทียม/อุปกรณ์ในการบำบัดรักษา วันที่ $Thaidate<br>";
    if (!empty($cAn)){
                echo"ผู้ป่วยใน ชื่อ: $cPtname,HN: $cHn,AN: $cAn, เตียง: $cBedcode<br>";  
       	}
    else{
                echo"ผู้ป่วยนอก ชื่อ: $cPtname,HN: $cHn<br>"; 
	} 
    echo "สิทธิ: $cPtright, โรค: $cDiag<br>";
    echo "แพทย์: $cDoctor<br>";


for($no=1; $no<=12; $no++){
   if($_POST['item'.$no] !="") {
       //insert data into patdata
	   if($_POST['yprice'.$no] >0){
		   $query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,yprice,nprice,depart,part,ptright,idno) VALUES('$Thidate','$cHn','$cAn','$cPtname','$cDoctor','$item','PHYSI','$aDetail[$no]','$aAmount[$no]','$aMCprice[$no]','$aYprino[$no]','$aNprino[$no]','PHYSI','$aDSPY[$no]','$cPtright','$idno');";
		  	$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
	   }else{
		   $query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,yprice,nprice,depart,part,ptright,idno) VALUES('$Thidate','$cHn','$cAn','$cPtname','$cDoctor','$item','PHYSI','$aDetail[$no]','$aAmount[$no]','$aMCprice[$no]','$aYprino[$no]','$aNprino[$no]','PHYSI','$aDSPN[$no]','$cPtright','$idno');";
		  	$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
	   }


	if ($cAn!=""){
		if($aYprino[$no] > 0 and ($aDSPY[$no]=="DPY" or $aDSPY[$no]=="DSY")){
            //insert data into ipacc
       		$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,idname,part,accno,idno,ptright)VALUES('$Thidate','$cAn','$aCode[$no]','PHYSI','$aDetail[$no]','$aAmount[$no]','$aYprino[$no]','$sOfficer','$aDSPY[$no]','$cAccno','$idno','$cPtright');";
       		$result1 = mysql_query($query) or die("Query failed,cannot insert into ipacc");
	   }
       if($aNprino[$no] > 0 and $aDSPN[$no]=="DPN"){
            $cNprice='(เบิกไม่ได้)';
            $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                    idname,part,accno,idno,ptright)VALUES('$Thidate','$cAn',
	'$aCode[$no]','PHYSI','$aDetail[$no] $cNprice',
                    '$aAmount[$no]','$aNprino[$no]','$sOfficer','$aDSPN[$no]','$cAccno','$idno','$cPtright');";
          	$result1 = mysql_query($query) or die("Query failed,cannot insert into ipacc");
	   }
		if($aNprino[$no] > 0 and $aDSPN[$no]=="DSN"){
            $cNprice='(เบิกไม่ได้)';
            $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                    idname,part,accno,idno,ptright)VALUES('$Thidate','$cAn',
	'$aCode[$no]','PHYSI','$aDetail[$no] $cNprice',
                    '$aAmount[$no]','$aNprino[$no]','$sOfficer','$aDSPN[$no]','$cAccno','$idno','$cPtright');";
            $result1 = mysql_query($query) or die("Query failed,cannot insert into ipacc");
		}
	}
   }
}

print"<table>";
print" <tr>";
print"  <th bgcolor=6495ED>#</th>";
print"  <th bgcolor=6495ED>ชื่อรายการ</th>";
print"  <th bgcolor=6495ED>ประเภท</th>";
print"  <th bgcolor=6495ED>จำนวน</th>";
print"  <th bgcolor=6495ED>ราคารวม</th>";
print"  <th bgcolor=6495ED>เบิกได้</th>";
print"  <th bgcolor=6495ED>เบิกไม่ได้</th>";
print"  </tr>";
if($result1){
	$sql2 ="select detail,part,amount,price,yprice,nprice from patdata where an='$cAn' and date ='$Thidate' and code='PHYSI' ";
}elseif($result){
	$sql2 ="select detail,part,amount,price,yprice,nprice from patdata where hn='$cHn' and date ='$Thidate' and code='PHYSI' ";
}
$result5 = mysql_query($sql2);
while(list($detail,$part,$amount,$price,$yprice,$nprice) = mysql_fetch_array($result5)){
	$nnn++;
print("<tr>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$nnn</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$detail</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$part</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$amount</td>\n".    
                "<td bgcolor=F5DEB3><font face='Angsana New'>$price</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$yprice</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$nprice</td>\n".  
                " </tr>\n");
}
print"</table>";
////////////////
if($result1||$result){
    print "บันทึกข้อมูลเรียบร้อย,ผู้บันทึก:$sOfficer";
    print "<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
  include("unconnect.inc");
    session_unregister("cHn");  
    session_unregister("cPtname");
    session_unregister("cPtright");
    session_unregister("cDiag");
    session_unregister("cAn"); 
    session_unregister("cDoctor"); 
    session_unregister("cAccno"); 
    session_unregister("cBedcode"); 
}else{
	print "บันทึกข้อมูลผิดพลาด กรุณาบันทึกใหม่";
}
?>