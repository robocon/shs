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
			
			$aCode[$no] = "SURG";
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
				window.location.href='oripitem.php';
			</script>
			<?
			}
			else{
			?>
			<script>
				alert("ไม่มีรายการค่าอุปกรณ์ กรุณาลงบันทึกใหม่");
				window.location.href='vnordx.php';
			</script>
			<?
			} 
		}
	}
    /*$aCode = array("รหัส");
    $aDetail  = array("รายการ");
    $aDSP = array("dsp"); 
    $aAmount  = array("จำนวน");
    $aMCprice  = array("ราคารวม");
    $aYprino[1]= array("ราคาเบิกได้");
    $aNprino[1]= array("ราคาเบิกไม่ได้");
	
    $aCode[1] = "surg";
    $aDetail[1]  = $dpycode1.' '.$item1;
    $aDSP[1]= $dsp1; 
    $aAmount[1]  = $amount1;
    $aMCprice[1]  = $price1;
    $aYprino[1]= $yprice1; 
    $aNprino[1]=$nprice1; 

    $aCode[2] = "surg";
	$aDetail[2]  = $dpycode2.' '.$item2;
    $aDSP[2]= $dsp2; 
    $aAmount[2]  = $amount2;
    $aMCprice[2]  = $price2;
    $aYprino[2]= $yprice2; 
    $aNprino[2]=$nprice2; 

    $aCode[3] = "surg";
	$aDetail[3]  = $dpycode3.' '.$item3;
    $aDSP[3]= $dsp3; 
    $aAmount[3]  = $amount3;
    $aMCprice[3]  = $price3;
    $aYprino[3]= $yprice3; 
    $aNprino[3]=$nprice3; 

    $aCode[4] = "surg";
	$aDetail[4]  = $dpycode4.' '.$item4;
    $aDSP[4]= $dsp4; 
    $aAmount[4]  = $amount4;
    $aMCprice[4]  = $price4;
    $aYprino[4]= $yprice4; 
    $aNprino[4]=$nprice4; 

    $aCode[5] = "surg";
    $aDetail[5]  = $dpycode5.' '.$item5;
    $aDSP[5]= $dsp5; 
    $aAmount[5]  = $amount5;
    $aMCprice[5]  = $price5;
    $aYprino[5]= $yprice5; 
    $aNprino[5]=$nprice5; 

    $aCode[6] = "surg";
    $aDetail[6]  = $dpycode6.' '.$item6;
    $aDSP[6]= $dsp6; 
    $aAmount[6]  = $amount6;
    $aMCprice[6]  = $price6;
    $aYprino[6]= $yprice6; 
    $aNprino[6]=$nprice6; 

    $aCode[7] = "surg";
    $aDetail[7]  = $dpycode7.' '.$item7;
    $aDSP[7]= $dsp7; 
    $aAmount[7]  = $amount7;
    $aMCprice[7]  = $price7;
    $aYprino[7]= $yprice7; 
    $aNprino[7]=$nprice7; 

    $aCode[8] = "surg";
    $aDetail[8]  = $dpycode8.' '.$item8;
    $aDSP[8]= $dsp8; 
    $aAmount[8]  = $amount8;
    $aMCprice[8]  = $price8;
    $aYprino[8]= $yprice8; 
    $aNprino[8]=$nprice8; 

    $aCode[9] = "surg";
   	$aDetail[9]  = $dpycode9.' '.$item9;
    $aDSP[9]= $dsp9; 
    $aAmount[9]  = $amount9;
    $aMCprice[9]  = $price9;
    $aYprino[9]= $yprice9; 
    $aNprino[9]=$nprice9; 

    $aCode[10] = "surg";
   	$aDetail[10]  = $dpycode10.' '.$item10;
    $aDSP[10]= $dsp10; 
    $aAmount[10]  = $amount10;
    $aMCprice[10]  = $price10;
    $aYprino[10]= $yprice10; 
    $aNprino[10]=$nprice10; 

    $aCode[11] = "surg";
  	$aDetail[11]  = $dpycode11.' '.$item11;
    $aDSP[11]= $dsp11; 
    $aAmount[11]  = $amount11;
    $aMCprice[11]  = $price11;
    $aYprino[11]= $yprice11; 
    $aNprino[11]=$nprice11; 

    $aCode[12] = "surg";
	$aDetail[12]  = $dpycode12.' '.$item12;
    $aDSP[12]= $dsp12; 
    $aAmount[12]  = $amount12;
    $aMCprice[12]  = $price12;
    $aYprino[12]= $yprice12; 
    $aNprino[12]=$nprice12; 

    $NetMcpri=0;
    $Netyprice=0;
    $Netnprice=0;
    $item=0;*/
       //insert data into depart
	   if (!empty($cAn)){
                $tvn=$cAn;
       	}
    	else{
                $tvn=$tvn;
		} 
       $query = "INSERT INTO depart(date,ptname,hn,an,doctor,depart,item,detail,price,sumyprice,sumnprice,
                    idname,diag,accno,tvn,ptright)VALUES('$Thidate','$cPtname','$cHn','$cAn','$cDoctor','SURG','$item','ค่าอุปกรณ์เวชภัณฑ์ในการผ่าตัด',
                    '$NetMcpri','$Netyprice','$Netnprice','$sOfficer','$cDiag','$cAccno','$tvn','$cPtright');";
       $result = mysql_query($query) or die("Query failed,cannot insert into depart");
       $idno=mysql_insert_id();

    echo "<font face='Angsana New'>รายการค่าอุปกรณ์เวชภัณฑ์ในการผ่าตัด วันที่ $Thaidate<br>";
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
		   $query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,yprice,nprice,depart,part,ptright,idno) VALUES('$Thidate','$cHn','$cAn','$cPtname','$cDoctor','$item','SURG','$aDetail[$no]','$aAmount[$no]','$aMCprice[$no]','$aYprino[$no]','$aNprino[$no]','SURG','$aDSPY[$no]','$cPtright','$idno');";
		  	$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
	   }else{
		   $query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,yprice,nprice,depart,part,ptright,idno) VALUES('$Thidate','$cHn','$cAn','$cPtname','$cDoctor','$item','SURG','$aDetail[$no]','$aAmount[$no]','$aMCprice[$no]','$aYprino[$no]','$aNprino[$no]','SURG','$aDSPN[$no]','$cPtright','$idno');";
		  	$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
	   }


	if ($cAn!=""){
		if($aYprino[$no] > 0 and ($aDSPY[$no]=="DPY" or $aDSPY[$no]=="DSY")){
            //insert data into ipacc
       		$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,idname,part,accno,idno,ptright)VALUES('$Thidate','$cAn','$aCode[$no]','SURG','$aDetail[$no]','$aAmount[$no]','$aYprino[$no]','$sOfficer','$aDSPY[$no]','$cAccno','$idno','$cPtright');";
       		$result1 = mysql_query($query) or die("Query failed,cannot insert into ipacc");
	   }
       if($aNprino[$no] > 0 and $aDSPN[$no]=="DPN"){
            $cNprice='(เบิกไม่ได้)';
            $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                    idname,part,accno,idno,ptright)VALUES('$Thidate','$cAn',
	'$aCode[$no]','SURG','$aDetail[$no] $cNprice',
                    '$aAmount[$no]','$aNprino[$no]','$sOfficer','$aDSPN[$no]','$cAccno','$idno','$cPtright');";
          	$result1 = mysql_query($query) or die("Query failed,cannot insert into ipacc");
	   }
		if($aNprino[$no] > 0 and $aDSPN[$no]=="DSN"){
            $cNprice='(เบิกไม่ได้)';
            $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                    idname,part,accno,idno,ptright)VALUES('$Thidate','$cAn',
	'$aCode[$no]','SURG','$aDetail[$no] $cNprice',
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
	$sql2 ="select detail,part,amount,price,yprice,nprice from patdata where an='$cAn' and date ='$Thidate' and code='SURG' ";
}elseif($result){
	$sql2 ="select detail,part,amount,price,yprice,nprice from patdata where hn='$cHn' and date ='$Thidate' and code='SURG' ";
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