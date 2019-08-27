<?php
    $cHn="";
    $cPtname="";
    $cPtright="";
    $nRunno="";
	$tvn="";
    session_register("nRunno");
    session_register("cHn");
    session_register("cPtname");
    session_register("cPtright");
    session_register("tvn");
	
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
	
?>
<form method="POST" action="<?php echo $PHP_SELF ?>">
  <p>ผู้ป่วยนอก  HN (ได้จากเวชระเบียน)</p>
  <p>&nbsp;&nbsp;HN&nbsp;&nbsp;<input type="text" name="hn" size="12" id="aLink"><script type="text/javascript">

document.getElementById('aLink').focus();

</script></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="        ตกลง        " name="B1"></p>
</form>

<?php
include("connect.inc");
if(!empty($_POST['hn']) && $confirm != true){

$ipsql="select * from ipcard where hn='".$_POST['hn']."' order by row_id desc limit 1";
$ipquery=mysql_query($ipsql);
$iprows=mysql_fetch_array($ipquery);
$my_ward=$iprows["my_ward"];
$dcdate=$iprows["dcdate"];
if($dcdate=="0000-00-00 00:00:00"){
	echo "<script>alert('ผู้ป่วยรายนี้ Admit อยู่ที่ $my_ward กรุณาคิดค่าใช้จ่ายเป็นผู้ป่วยใน');</script>";
}

$today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  

$thdatehn=$d.'-'.$m.'-'.$yr.$hn;
 $query = "SELECT idcard ,hn, concat(yot,' ',name,' ',surname) as ptname, ptright,dbirth,ptright1 FROM opcard WHERE hn = '".$_POST['hn']."'  limit 1 ";
 $result = mysql_query($query) or die(Mysql_Error());
 $row=mysql_num_rows($result);
 list($ccc,$xxx,$yyy,$zzz,$dbirth,$ptright1) = Mysql_fetch_row($result);
$age=calcage($dbirth);	
if($row){	
	

	print "HN :$xxx<br>";
   	print "$yyy<br>";
	print "อายุ : $age<br>";
	print "สิทธิหลัก : $ptright1<br>";
   	print "สิทธิการรักษาครั้งล่าสุด :$zzz";
	if(substr($zzz,0,3)=='R07'){
			$sql = "Select id From ssodata where id LIKE '$ccc%' limit 1 ";
			$query = mysql_query($sql) or die(mysql_error());
			$numrows_r07 = mysql_num_rows($query);

			if( $numrows_r07 == 0 ){
				echo "<span style=\"background-color: #FF0000\"><B><FONT SIZE=\"3\"  COLOR=\"#0033CC\"><BR>&nbsp;&nbsp;&nbsp;ตรวจสอบจากสิทธิผู้ป่วยหมดสิทธิประกันสังคม&nbsp;&nbsp;&nbsp;</FONT></B></span>";
				echo "</br><FONT SIZE=\"3\"  COLOR=\"#0033CC\">กรุณาติดต่อแผนกทะเบียนเพื่อปรับปรุงสิทธิการรักษา</FONT><br>";
			}else if( $numrows_r07 > 0 ){
				echo "<span style=\"background-color: #0033CC\"><B><FONT SIZE=\"3\"  COLOR=\"#FFFF00\"><BR>&nbsp;&nbsp;&nbsp;ตรวจสอบจากสิทธิผู้ป่วยมีสิทธิประกันสังคม&nbsp;&nbsp;&nbsp;</FONT></B></span>";

			}

			print "<br><a href='hnlab.php?hn=".$xxx."&confirm=true'>!ชื่อถูกต้อง ทำรายการต่อไป...</a>";
			print "<br>";
			print "<br><a href='hnlab.php?hn=".$xxx."&confirm=true&chk=sso'>! ชื่อถูกต้อง และต้องการ ตรวจสุขภาพสิทธิประกันสังคม</a>";

			
		}else if(substr($zzz,0,3)=='R03'){
			$sql = "Select hn, status From cscddata where hn = '$xxx' AND ( status like '%U%' OR status = '\r' OR status like '%V%' )  limit 1 ";

			if(Mysql_num_rows(Mysql_Query($sql)) > 0){
			echo "<span style=\"background-color: #0033CC\"><B><FONT SIZE=\"3\"  COLOR=\"#FFFF00\"><BR>&nbsp;&nbsp;&nbsp;ตรวจสอบจากสิทธิผู้ป่วยมีสิทธิจ่ายตรง&nbsp;&nbsp;&nbsp;</FONT></B></span>";
			
			 print "<br><a href='hnlab.php?hn=".$xxx."&confirm=true'>!ชื่อถูกต้อง ทำรายการต่อไป</a>";
			}else{
				echo "<span style=\"background-color: #FF0000\"><B><FONT SIZE=\"3\"  COLOR=\"#0033CC\"><BR>&nbsp;&nbsp;&nbsp;ตรวจสอบจากสิทธิผู้ป่วยหมดสิทธิจ่ายตรง&nbsp;&nbsp;&nbsp;</FONT></B></span>";
				echo "</br><FONT SIZE=\"3\"  COLOR=\"#0033CC\">กรุณาติดต่อแผนกทะเบียนเพื่อปรับปรุงสิทธิการรักษา</FONT>";
			}
		}else{
			if(substr($zzz,0,3)=='R12' || substr($zzz,0,3)=='R13' || substr($zzz,0,3)=='R14' || substr($zzz,0,3)=='R35'){
				echo "<div style=\"background-color: #FF0000;\">กรุณาทบทวนสิทธิการรักษาและค่ารักษาพยาบาล<br>เบิกต้นสังกัดได้ไม่เกิน 700 บาท</div>";
			}
			print "<br><a href='hnlab.php?hn=".$xxx."&confirm=true'>!ชื่อถูกต้อง ทำรายการต่อไป...</a>";
		}
	}else{
	echo "ไม่พบ HN $xxx";
	}
	
   

}else if (!empty($hn) && !empty($confirm)){

	$chk_user = ( !empty($_GET['chk']) && $_GET['chk'] == "sso" ) ? '?chk=sso' : '' ;

	//$tvn=$vn;
	//$cHn=$hn;
    include("connect.inc");
    $vnlab = 'EX93 ออก VN โดย LAB';   
    $today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  
    $thdatehn=$d.'-'.$m.'-'.$yr.$hn;
    $thidate = (date("Y")+543).date("-m-d H:i:s"); 
	
// ตรวจดูว่าลงทะเบียนหรือยัง
    $query = "SELECT * FROM opday WHERE thdatehn = '$thdatehn' Order by row_id DESC ";
    $result = mysql_query($query)
        or die("Query failed,opday");

		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}
	
			if(!($row = mysql_fetch_object($result)))
				continue;
         }

 //     $cHn=$row->hn;
        if(mysql_num_rows($result)){
  //กรณีลงทะเบียนแล้ว
  	      $cHn=$row->hn;
  	      $cPtname=$row->ptname;
 	       $cPtright=$row->ptright;
  	  $tvn=$row->vn;
  	      //print "VN  :$tvn<br>";
 	      // print "HN :$cHn<br>";
   	     //print "$cPtname<br>";
   	     //print "สิทธิการรักษา :$cPtright";
    	    //print "<br><a href='labask.php'>!ชื่อถูกต้อง ทำรายการต่อไป</a>";
			 echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=labask.php$chk_user\">";
		}
		else{
//หาข้อมูลจาก opcard ของ $cHn เพื่อใช้ทั้งในกรณีลงทะเบียนแล้ว หรือยังไม่ลง
	    $query = "SELECT * FROM opcard WHERE hn = '$hn'";
	    $result = mysql_query($query) or die("Query failed");

	    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	        if (!mysql_data_seek($result, $i)) {
	            echo "Cannot seek to row $i\n";
	            continue;
			}
	        if(!($row = mysql_fetch_object($result)))
	            continue;
		}
        if(mysql_num_rows($result)){
	      $cHn=$row->hn;
	      $cYot = $row->yot;
	      $cName = $row->name;
	      $cSurname = $row->surname;
          $cPtname=$cYot.' '.$cName.'  '.$cSurname;
	      $cPtright = $row->ptright;
		  $cPtright1 = $row->ptright1;
          $cGoup=$row->goup;
	      $cCamp=$row->camp;
          $cNote=$row->note;
   		  $cIdcard=$row->idcard;
		  $dbirth=$row->dbirth;
		  $cAge=calcage($dbirth);
		  

    //print"$cPtname $cGoup<br>";

    //กำหนดค่า VN จาก runno table
	    $query = "SELECT * FROM runno WHERE title = 'VN'";
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
	    $today = date("Y-m-d");  
                    //ยังไม่เปลี่ยนวันที่
                    if($today==$dVndate){
                         $nVn++;
             	         $thdatevn=$d.'-'.$m.'-'.$yr.$nVn;
      	         $query ="UPDATE runno SET runno = $nVn WHERE title='VN'";
	         $result = mysql_query($query) or die("Query failed");
	   $tvn=$nVn;
//	        print "ได้หมายเลข VN = $nVn<br>";
					}
//วันใหม่
                    if($today<>$dVndate){    
                         $nVn=1;
             	         $thdatevn=$d.'-'.$m.'-'.$yr.$nVn;
      	         $query ="UPDATE runno SET runno = $nVn,startday=now()  WHERE title='VN'";
	         $result = mysql_query($query) or die("Query failed");
	    $tvn=$nVn;
//                         print "วันใหม่  เริ่ม VN = $nVn <br>";
					}
//ลงทะเบียนใน opday table
	    $query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname,age,
                	   ptright,goup,camp,note,toborow,idcard,officer)VALUES('$thidate','$thdatehn','$cHn','$nVn',
	                    '$thdatevn','$cPtname','$cAge','$cPtright','$cGoup','$cCamp','$cNote','$vnlab',' $cIdcard','".$_SESSION["sOfficer"]."');";
	    $result = mysql_query($query) or die("Query failed,cannot insert into opday1");
		
////////////คิดเงิน 50 บาท
		$check = "select * from depart where hn = '".$cHn."' and  detail = '(55020/55021 ค่าบริการผู้ป่วยนอก)' and date like '".(date("Y")+543).date("-m-d")."%' ";
		$resultcheck = mysql_query($check);
		$cal = mysql_num_rows($resultcheck);
		if($cal==0){
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
		
			$query = "INSERT INTO depart(chktranx,date,ptname,hn,an,depart,item,detail,price,sumyprice,sumnprice,paid, idname,accno,tvn,ptright)VALUES('".$nRunno."','".$thidate."','".$cPtname."','".$cHn."','','OTHER','1','(55020/55021 ค่าบริการผู้ป่วยนอก)', '50','50','0','','".$_SESSION["sOfficer"]."','0','".$nVn."','".$cPtright."');";
			$result = mysql_query($query);
			$idno=mysql_insert_id();
		 
			$query = "INSERT INTO patdata(date,hn,an,ptname,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright) VALUES('".$thidate."','".$cHn."','','".$cPtname."','1','SERVICE','(55020/55021 ค่าบริการผู้ป่วยนอก)','1','50','50','0','OTHER','OTHER','".$idno."','".$cPtright."');";
			$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
			
			$query ="UPDATE opday SET other=(other+50) WHERE thdatehn= '$thdatehn' AND vn = '".$nVn."' ";
      		$result = mysql_query($query) or die("Query failed,update opday");
		}
		////////////////////////////////จบคิดเงิน 50 บาท

      //  print "VN  :$tvn<br>";
       // print "HN :$cHn<br>";
       // print "$cPtname<br>";
       // print "สิทธิการรักษา :$cPtright";
       // print "<br><a href='labask.php'>ชื่อถูกต้อง ทำรายการต่อไป</a>";
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=labask.php$chk_user\">";
		}
		else{
   			print"ไม่พบ HN $hn ในเวชระเบียน";
		}
		}
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
/*
        print "VN  :$tvn<br>";
        print "HN :$cHn<br>";
        print "$cPtname<br>";
        print "สิทธิการรักษา :$cPtright";
        print "<br><a href='labask.php'>ชื่อถูกต้อง ทำรายการต่อไป</a>";
*/

    include("unconnect.inc");
}
?>

