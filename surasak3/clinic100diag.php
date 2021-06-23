<?php
 session_start();
    $cHn="";
    $cPtname="";
    $cPtright="";
    $nRunno="";
    session_register("nRunno");
    session_register("cHn");
    session_register("cPtname");
    session_register("cPtright");

	function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

return $pAge;
}


   $tvn="";
    session_register("tvn");
If (!empty($hn)){
    include("connect.inc");
	


    $today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  
	$thidatehn=$d.'-'.$m.'-'.$yr.$hn;

	$sql = "Select vn From opday where thdatehn = '".$thidatehn."' ORDER BY row_id DESC limit 1";
	$opday_result = Mysql_Query($sql);
	$opday_row = mysql_num_rows($opday_result);
	
	if($opday_row > 0){
		list($vn) = mysql_fetch_row($opday_result);
		$tvn = $vn;
	}else{
		$query = "SELECT `idcard` , `hn` , `yot` , `name` , `surname` , `goup` , `dbirth` , `idguard` , `ptright` , `note` , `camp`   FROM opcard WHERE hn = '".$hn."' limit 1";
	    $result = mysql_query($query) or die("Query failed");
		list($cIdcard,$cHn,$cYot,$cName,$cSurname,$cGoup,$dbirth,$cIdguard,$cPtright,$cNote,$cCamp) = mysql_fetch_row($result);
		$cAge=calcage($dbirth);
		$cPtname=$cYot.' '.$cName.'  '.$cSurname;
		$vnlab = 'EX04 ผู้ป่วยนัด';
		$query = "SELECT runno, startday FROM runno WHERE title = 'VN' ";
	    $result = mysql_query($query) or die("Query failed1");
		list($nVn, $dVndate) = mysql_fetch_row($result);
		$dVndate=substr($dVndate,0,10);
		
		if(date("Y-m-d")==$dVndate){
			$nVn++;
			$query ="UPDATE runno SET runno = $nVn WHERE title='VN' limit 1 ";

		}else if(date("Y-m-d") <> $dVndate){
			$nVn=1;
			$query ="UPDATE runno SET runno = $nVn,startday=now()  WHERE title='VN' limit 1 ";
		}
			$result = mysql_query($query) or die("Query failed2");
			$tvn = $vn=$nVn;

			$time1 = date("H:i:s");
			$thidate = date("d-m-").(date("Y")+543);
			$thdatevn=$thidate.$nVn;
			$thidate_now = (date("Y")+543).date("-m-d").date(" H:i:s");
			 $query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname, ptright,goup,camp,note,toborow,time1,idcard,dxgroup,officer)VALUES('".$thidate_now."','".$thidatehn."','".$cHn."','".$nVn."', '".$thdatevn."','".$cPtname."','".$cPtright."','".$cGoup."','".$cCamp."','".$cNote."','".$vnlab."','".$time1."','".$cIdcard."','21','".$_SESSION["sOfficer"]."');";
			$result = mysql_query($query) or die("Query failed,cannot insert into opday");
	}


    $thdatevn=$d.'-'.$m.'-'.$yr.$vn;
// ตรวจดูว่าลงทะเบียนหรือยัง
    $query = "SELECT * FROM opday WHERE thdatevn = '$thdatevn'";

    $result = mysql_query($query)
        or die("Query failed,opday");
/*
    echo mysql_errno() . ": " . mysql_error(). "\n";
    echo "<br>";
*/
        for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }	
//กรณียังไม่ลงทะเบียน
    If (empty($row->hn)){
        print "VN :$vn<br>";
        print "ยังไม่ได้ลงทะเบียนตรวจวันนี้  โปรดขอ VN ใหม่จากห้องทะเบียน<br>";
                                    }
//กรณีลงทะเบียนแล้ว
   else { 
        $cHn=$row->hn;
        $cPtname=$row->ptname;
        $cPtright=$row->ptright;

		$x=0;
    $aDgcode = array("รหัส");
    $aTrade  = array("รายการ");
    $aPrice  = array("ราคา ");
    $aPart = array("part");
    $aAmount = array("        จำนวน   ");
    $aMoney= array("       รวมเงิน   ");
    $Netprice="";   

    $aYprice = array("ราคา ");
    $aNprice = array("ราคา ");
    $aSumYprice = array("ราคา ");
    $aSumNprice = array("ราคา ");
    session_register("aYprice");
    session_register("aNprice");
    session_register("aSumYprice");
    session_register("aSumNprice");

    $cPart="";
    $cDiag=$diag;
    $cDoctor=$doctor;
    $cAn="";
    $cAccno=0;
	$tvn="$tvn";
    session_register("x");
    session_register("aDgcode");
    session_register("aTrade");
    session_register("aPrice");
    session_register("aPart");
    session_register("aAmount");
    session_register("aMoney");
    session_register("Netprice");
    session_register("cPart");
    session_register("cDiag");
    session_register("cAn"); 
    session_register("cDoctor"); 
    session_register("cAccno"); 
	session_register("tvn"); 
	session_register("list_codeed");

	session_register("cDepart"); 

	$_SESSION["list_codeed"] = array();
	//$_SESSION["cDoctor"] = "MD013 ธนบดินทร์ ผลศรีนาค";
	$_SESSION["cDiag"] = "";
	$_SESSION["Amount"] = 1;
	$Amount = 1;

	$query = "SELECT * FROM labcare WHERE code = 'clinic100' ";
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
	    $x++;
	    $aDgcode[$x]=$row->code; 
	    $aTrade[$x]=$row->detail;
	    $aPrice[$x]=$row->price;

	    $aPart[$x]=$row->part;
	    $aAmount[$x]=$Amount;
	    $money = $Amount*$row->price ;
	    $aMoney[$x]=$money;
	    $Netprice=array_sum($aMoney);

	    $aYprice[$x]=$row->yprice*$Amount;
		$aNprice[$x]=$row->nprice*$Amount;
		
		$cDepart = $row->depart;

	    //$aSumYprice=array_sum($aYprice);
	    //$aSumNprice=array_sum($aNprice);
?>
<form action="clinic100print.php" method="post" target="_blank">
<?
	print "ผู้ป่วยนอก<br>";
	print "HN :$cHn<br>";
	print "VN :$tvn<br>";
	print "$cPtname<br>";
	print "สิทธิการรักษา :$cPtright<br>";
	print "โรค :$cDiag<br>";
	//print "แพทย์ :$cDoctor<br>";
	print "แพทย์ :";
?>
<select name="cDoctor" id="cDoctor"> 
<option value="" selected="selected">- - กรุณาเลือกแพทย์ - -</option>
<option value="MD007 ณรงค์ ปรีดาอนันทสุข" >MD007 ณรงค์ ปรีดาอนันทสุข</option>  
<option value="MD009 นภสมร ธรรมลักษมี" >MD009 นภสมร ธรรมลักษมี</option>
<option value="MD013 ธนบดินทร์ ผลศรีนาค" >MD013 ธนบดินทร์ ผลศรีนาค</option>
<option value="MD100 เชาวรินทร์ อุ่นเครือ" >MD100 เชาวรินทร์ อุ่นเครือ</option>
<!-- <option value="MD070 ประทีป เหลือแก้ว" >MD070 ประทีป เหลือแก้ว</option> -->
<option value="MD105 ภควดี วุฒิพิทยามงคล" >MD105 ภควดี วุฒิพิทยามงคล</option> 
<option value="MD106 มนัสจิตต์ บุณยทรรพ" >MD106 มนัสจิตต์ บุณยทรรพ</option> 
<option value="MD107 รวี อัศวกิติพงษ์" >MD107 รวี อัศวกิติพงษ์</option> 
<option value="MD117 ณัชญ์ระวี บุรีคำ" >MD117 ณัชญ์ระวี บุรีคำ</option> 
<option value="MD122 นวมน สุนทรวราภาส" >MD122 นวมน สุนทรวราภาส</option> 
<option value="MD123 วาทินี แสนโภชน์" >MD123 วาทินี แสนโภชน์</option>
<!-- <option value="MD125 จรรยวรรธน์  สร้างสมวงษ์" >MD125 จรรยวรรธน์  สร้างสมวงษ์</option> -->
<option value="MD136 ปริญญา เรือนวิไล" >MD136 ปริญญา เรือนวิไล</option> 
<option value="MD137 กฤษฎิ์พงษ์ ศิริสารศักดา" >MD137 กฤษฎิ์พงษ์ ศิริสารศักดา</option> 
<option value="MD138 มัทนา อัมพะเศวต" >MD138 มัทนา อัมพะเศวต</option> 
<option value="MD140 ชัชวาลย์  เชวงชุติรัตน์" >MD140 ชัชวาลย์  เชวงชุติรัตน์</option>
<option value="MD141 อมร ตามไท" >MD141 อมร ตามไท</option> 
<option value="MD142 กรรณิการ์  ศรีสุวรรณ" >MD142 กรรณิการ์  ศรีสุวรรณ</option>
<option value="MD144 อนวัช บุปผาเจริญสุข" >MD144 อนวัช บุปผาเจริญสุข</option>
<option value="MD150 รัตนเกียรติ พงษ์รัตนกุล" >MD150 รัตนเกียรติ พงษ์รัตนกุล</option>
<option value="MD152 ยิ่งวิชช์ วิทยาวิศวสกุล" >MD152 ยิ่งวิชช์ วิทยาวิศวสกุล</option>
<option value="MD164 ชนะรัตน์ โชคชัยสมุทร" >MD164 ชนะรัตน์ โชคชัยสมุทร</option>
<option value="MD171 วีรวัฒน์ เลิศฤทธิ์เดชา" >MD171 วีรวัฒน์ เลิศฤทธิ์เดชา</option>
</select>
<?
	print "<br><br>ราคา :";
	?>
<select name="cPrice" id="cPrice"> 
<option value="" >- - กรุณาเลือกค่าบริการ- -</option>
<option value="100">100 บาท</option>  
<option value="150">150 บาท</option>
<option value="200">200 บาท</option>
<option value="300" selected="selected">300 บาท</option>  
</select>
<br /><br />
<input name="save" type="submit" value="ชื่อถูกต้อง คิดค่าใช้จ่าย" />
</form>
	<?
      //  print "VN  :$vn<br>";
      //  print "HN :$cHn<br>";
      //  print "$cPtname<br>";
     //   print "สิทธิการรักษา :$cPtright";
        //print "<br><a target=_BLANK href=\"clinic100print.php\">ชื่อถูกต้อง คิดค่าใช้จ่าย</a>";
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
    $result = mysql_query($query)
        or die("Query failed");
//end  runno  for chktranx
           }
   include("unconnect.inc");
   }
?>

