<?
include("connect.inc"); 
$strsql="select HN,name,surname from opcardchk where part='ทหารลงดอย58-2' order by row asc";
echo $strsql."<br>";
$strquery=mysql_query($strsql);
$num=mysql_num_rows($strquery);
echo $num;
$no=0;
while($rows=mysql_fetch_array($strquery)){
$no++;
$hn=$rows["HN"];
echo "คนที่ $no HN : $hn <br>";
$dbirth="00-00-00 00:00:00";
$ptname=$rows["name"]." ".$rows["surname"];
$Thidate = (date("Y")+543).date("-m-d H:i:s");
$doctor="MD022 (ไม่ทราบแพทย์)";
$thdatehn= date("d-m-").(date("Y")+543).$hn;
$vnlab = 'EX93 ออก VN โดย LAB';   

// หาเลข LAB
	$query = "SELECT runno, startday FROM runno WHERE title = 'lab'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nLab=$row->runno;
	$dLabdate=$row->startday;
	$dLabdate=substr($dLabdate,0,10);	
//จบ เลข Lab

/////////////////// Start ออก VN ///////////////////
// ตรวจดูว่าลงทะเบียนหรือยัง
$query = "SELECT * FROM opday WHERE thdatehn = '$thdatehn' Order by row_id DESC ";
$result = mysql_query($query) or die("Query failed,opday");

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	if (!mysql_data_seek($result, $i)) {
		echo "Cannot seek to row $i\n";
		continue;
	}
	
	if(!($row = mysql_fetch_object($result)))
		continue;
     }

	//$cHn=$row->hn;
	if(mysql_num_rows($result)){
	//กรณีลงทะเบียนแล้ว
  	      	$cHn=$row->hn;
  	      	$cPtname=$row->ptname;
 	      	$cPtright=$row->ptright;
  	  		$tvn=$row->vn;
		}else{  //else if(mysql_num_rows($result)){
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
			  $cGoup=$row->goup;
			  $cCamp=$row->camp;
			  $cNote=$row->note;
			  $cIdcard=$row->idcard;
	
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
		        print "ได้หมายเลข VN = $nVn<br>";
			}
	//วันใหม่
			if($today<>$dVndate){    
				$nVn=1;
				$thdatevn=$d.'-'.$m.'-'.$yr.$nVn;
				$query ="UPDATE runno SET runno = $nVn,startday=now()  WHERE title='VN'";
				$result = mysql_query($query) or die("Query failed");
				$tvn=$nVn;
	                         print "วันใหม่  เริ่ม VN = $nVn <br>";
			}
	//ลงทะเบียนใน opday table
			$thdatevn = date("d-m-").(date("Y")+543).$nVn;
			$query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname,ptright,goup,camp,note,toborow,idcard,officer)VALUES('$Thidate','$thdatehn','$cHn','$nVn','$thdatevn','$cPtname','$cPtright','$cGoup','$cCamp','$cNote','$vnlab',' $cIdcard','สมยศ แสงสุข');";
			echo $query."<br>";
			$result = mysql_query($query) or die("Query failed,cannot insert into opday");
			}  //close if(mysql_num_rows($result)){ Line 81
		}  //close else Line 68
/////////////////// End ออก VN ///////////////////



/////////////////// Start คิดค่าใช้จ่าย ///////////////////
// ค่า Service
// หาเลข chktranx
	$query = "SELECT runno FROM runno WHERE title = 'depart'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$chktranx=$row->runno;
	$chktranx++;
//จบ เลข chktranx

$query1 = "INSERT INTO depart(chktranx,date,ptname,hn,an,doctor,depart,item,detail,price,sumyprice,sumnprice,paid, idname,diag,accno,tvn,ptright,lab) VALUES ('$chktranx','$Thidate','$ptname','$hn','','','OTHER','1','(55020/55021 ค่าบริการผู้ป่วยนอก)', '50.00','50.00','0.00','0.00','สมยศ แสงสุข','','0','$nVn','$cPtright','$nLab');";
echo $query1."<br>";
if(mysql_query($query1)){
$idno=mysql_insert_id();
echo "1==>$idno<br>";
$sqlpat1 = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright) VALUES('$Thidate','$hn','','$ptname','','1','SERVICE','(55020/55021 ค่าบริการผู้ป่วยนอก)','1','50.00','50.00','0.00','OTHER','OTHER','$idno','$cPtright');";
echo $sqlpat1."<br>";
$resultpat1 = mysql_query($sqlpat1) or die("Query failed,cannot insert into patdata1");

$sql10 ="UPDATE runno SET runno ='$chktranx' WHERE title='depart'";
$query10 = mysql_query($sql10) or die("Query failed runno Depart1");	
}else{
	echo "Error insert into depart Line 159 <br>";
}

// ค่า Lab 10574 ,filaria2 ,MP ,LEPA ที่เจาะตรวจ
// หาเลข chktranx
	$query = "SELECT runno FROM runno WHERE title = 'depart'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$chktranx=$row->runno;
	$chktranx++;
//จบ เลข chktranx
$query2 = "INSERT INTO depart(chktranx,date,ptname,hn,an,doctor,depart,item,detail,price,sumyprice,sumnprice,paid, idname,diag,accno,tvn,ptright,lab) VALUES ('$chktranx','$Thidate','$ptname','$hn','','$doctor','PATHO','4','ค่าตรวจวิเคราะห์โรค', '550.00','550.00','0.00','0.00','สมยศ แสงสุข','ตรวจวิเคราะห์เพื่อการรักษา','0','$nVn','$cPtright','$nLab');";
echo $query2."<br>";
if(mysql_query($query2)){
	$idno=mysql_insert_id();
	echo "2==>$idno<br>";
	$sqlpat2 = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright) VALUES('$Thidate','$hn','','$ptname','','4','10574','(36601)Chikungunya-Ab','1','250.00','250.00','0.00','PATHO','LAB','$idno','$cPtright');";
	echo $sqlpat2."<br>";
	$resultpat2 = mysql_query($sqlpat2) or die("Query failed,cannot insert into patdata2");	
	
	$sqlpat3 = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright) VALUES('$Thidate','$hn','','$ptname','','4','filaria2','(38999)Micro Filaria Ab','1','50.00','50.00','0.00','PATHO','LAB','$idno','$cPtright');";
	echo $sqlpat3."<br>";
	$resultpat3 = mysql_query($sqlpat3) or die("Query failed,cannot insert into patdata3");
	
	$sqlpat4 = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright) VALUES('$Thidate','$hn','','$ptname','','4','MP','(30126)Malarial film','1','50.00','50.00','0.00','PATHO','LAB','$idno','$cPtright');";
	echo $sqlpat4."<br>";	
	$resultpat4 = mysql_query($sqlpat4) or die("Query failed,cannot insert into patdata4");
	
	
	$sqlpat5 = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright) VALUES('$Thidate','$hn','','$ptname','','4','LEPA','(36007)Leptospira-Ab screening','1','200.00','200.00','0.00','PATHO','LAB','$idno','$cPtright');";
	echo $sqlpat5."<br>";	
	$resultpat5 = mysql_query($sqlpat5) or die("Query failed,cannot insert into patdata5");
	
	$sql11 ="UPDATE runno SET runno = $chktranx WHERE title='depart'";
	$query11 = mysql_query($sql11) or die("Query failed runno Depart2");	
}else{
	echo "Error insert into depart Line 159 <br>";
}

/////////////////// End คิดค่าใช้จ่าย ///////////////////



/////////////////// Start Order Lab ///////////////////
$Thidate2 = date("Y").date("-m-d H:i:s");
$patienttype = "OPD";

$clinicalinfo = "10574 ,filaria2 ,MP ,LEPA ,";
$gender = "M";
$priority = "R";

$sql1 = "INSERT INTO `orderhead` ( `autonumber` , `orderdate` , `labnumber` , `hn` , `patienttype` , `patientname` , `sex` , `dob` , `sourcecode` , `sourcename` , `room` , `cliniciancode` , `clinicianname` , `priority` , `clinicalinfo`  ) VALUES ('', '".$Thidate2."', '".date("ymd").sprintf("%03d", $nLab)."', '".$hn."', '".$patienttype."', '".$ptname."', '".$gender."', '".$dbirth."', '', '', '','".$cliniciancode."', 'MD022 (ไม่ทราบแพทย์)', '".$priority."', '".$clinicalinfo."');";
echo $sql1."<br>";
$result1 = mysql_query($sql1)or die("Query failed,INSERT orderhead ");

$arrlab=array('10574','filaria2','MP','LEPA');
foreach ($arrlab as $value) {
   list($code,$oldcode,$detail) = mysql_fetch_row(mysql_query("Select code,oldcode,detail From labcare where code = '".$value."' limit 0,1 "));   
   
$sql2 = "INSERT INTO `orderdetail` ( `labnumber` , `labcode`, `labcode1` , `labname` ) VALUES ('".date("ymd").sprintf("%03d", $nLab)."', '".$code."', '".$oldcode."', '".$detail."');";
$result2 = mysql_query($sql2) or die("Query failed,INSERT orderdetail");
echo "==>".$sql2."<br>";
}

$nLab++;
$query3 ="UPDATE runno SET runno = $nLab, startday = '$dLabdate' WHERE title='lab'";
$result3 = mysql_query($query3) or die("Query failed runno");	

/////////////////// End Order Lab /////////////

echo "<p>*********************************</p>";
} //close while
?>