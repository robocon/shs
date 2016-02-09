<?php
    session_start();
	include("connect.inc");
    if (isset($sIdname)){} else {die;} //for security
	if(!isset($_POST['B1'])){
		$today = date("d-m-Y");   
		$d=substr($today,0,2);
		$m=substr($today,3,2);
		$yr=substr($today,6,4) +543;  
	}
   print "<form method='POST' action='service50.php'>";
    print "<p><font face='Angsana New'>คิดค่าบริการผู้ป่วยนอก 50 บาท</font></p>";
    //print "<p><font face='Angsana New'>วันที่&nbsp;&nbsp; ";
    //print "<input type='text' name='d' size='2' value=$d>&nbsp;&nbsp;";
   // print "เดือน&nbsp; <input type='text' name='m' size='2' value=$m>&nbsp;&nbsp;&nbsp;";
    //print "พ.ศ. <input type='text' name='yr' size='8' value=$yr></font></p>";
  print "<p><font face='Angsana New'>&nbsp;&nbsp;HN:&nbsp;&nbsp;<input type='text' name='chn' size='8' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    print "<input type='submit' value='          ตกลง          ' name='B1'>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
//    print "<input type='reset' value='ลบทิ้ง' name='B2'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;";
    print "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
    print "</form>";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
<?
if(isset($_POST['B1'])){
	
	$query = "select * from opday where hn='$chn' and thidate like '".(date("Y")+543).date("-m-d")."%' ";
	$result = mysql_query($query) or die("Query failed");
	$cal2 = mysql_num_rows($result);
	if($cal2==0){
		echo "<br><br><font style='font-size:20px;' >ผู้ป่วย HN: $chn ไม่ได้ลงทะเบียนวันนี้</font>";
	}else{
	$arr = mysql_fetch_array($result);
	
	?>
<TABLE  width='100%' style="font-family:AngsanaUPC;">
<TR align="center" bgcolor=6495ED>
	<TD>VN</TD>
	<TD>วันที่</TD>
	<TD>HN</TD>
    <TD>AN</TD>
	<TD>ชื่อ-สกุล</TD>
	<TD>สิทธิ์</TD>
	<TD>ออกOPCARDโดย</TD>
</TR>
<TR BGCOLOR=66CDAA>
	<TD align="center" BGCOLOR="<?php echo $color ?>"><a href="service50.php?chn=<?=$arr["hn"]?>"><?php echo $arr["vn"];?></a></TD>
		<TD align="center" BGCOLOR="<?php echo $color ?>"><?php echo $arr["thidate"];?></TD>
	<TD align="center" BGCOLOR="<?php echo $color ?>"><?php echo $arr["hn"];?></TD>
    <TD align="center" BGCOLOR="<?php echo $color ?>"><?php echo $arr["an"];?></TD>
	<TD align="center" BGCOLOR="<?php echo $color ?>"><?=$arr["ptname"]?></TD>
	<TD align="center" BGCOLOR="<?php echo $color ?>"><?php echo $arr["ptright"];?></TD>
	<TD align="center" BGCOLOR="<?php echo $color ?>"><?php echo $arr["toborow"];?></TD>
</TR>
</TABLE>
	<?
	}
}
elseif(isset($_GET['chn'])){
	$thidate = (date("Y")+543).date("-m-d H:i:s"); 
	$thdatehn=$d.'-'.$m.'-'.$yr.$cHn; 
	$check = "select * from depart where hn = '".$chn."' and  detail = '(55020/55021 ค่าบริการผู้ป่วยนอก)' and date like '".(date("Y")+543).date("-m-d")."%' ";
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
			
			$query = "SELECT * FROM opcard WHERE hn = '$chn'";
			$result = mysql_query($query) or die("Query failed");
			
			for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
				if (!mysql_data_seek($result, $i)) {
					echo "Cannot seek to row $i\n";
					continue;
				}
			
				if(!($row = mysql_fetch_object($result)))
				continue;
			}
			
			if($result){
				//	      $cHn=$row->hn;
				$cYot = $row->yot;
				$cIdcard = $row->idcard;
				$cName = $row->name;
				$cSurname = $row->surname;
				$cPtname=$cYot.' '.$cName.'  '.$cSurname;
				$cPtright = $row->ptright;
			}
			
			$query = "select vn from opday where hn='$chn' and thidate like '".(date("Y")+543).date("-m-d")."%' ";
			$result = mysql_query($query) or die("Query failed");
			list($nVn) = mysql_fetch_array($result);
				/////////////////////////////////////////////////////////////
			$query = "INSERT INTO depart(chktranx,date,ptname,hn,an,depart,item,detail,price,sumyprice,sumnprice,paid, idname,accno,tvn,ptright)VALUES('$nRunno','$thidate','$cPtname','$chn','','OTHER','1','(55020/55021 ค่าบริการผู้ป่วยนอก)', '50','50','0','','$sOfficer','0','$nVn','$cPtright');";
			$result = mysql_query($query);
			$idno=mysql_insert_id();
		 
			$query = "INSERT INTO patdata(date,hn,an,ptname,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright)
VALUES('$thidate','$chn','','$cPtname','1','SERVICE','(55020/55021 ค่าบริการผู้ป่วยนอก)','1','50','50','0','OTHER','OTHER','$idno','$cPtright');";
			$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
			
			$query ="UPDATE opday SET other=(other+50) WHERE thdatehn= '$thdatehn' AND vn = '".$nVn."' ";
      		$result = mysql_query($query) or die("Query failed,update opday");
			if($result){
				echo "<font style='font-size:20px;' ><br><br>เพิ่มค่าบริการผู้ป่วยนอกเรียบร้อยแล้ว";
				echo "<br><a href='service50.php' >กลับหน้าแรก</a></font>";
			}
		}else{
			$rep = mysql_fetch_array($resultcheck);
			echo "<br><br><font style='font-size:20px;' >ผู้ป่วย HN: $chn ถูกคิดค่าใช้จ่ายแล้วที่ VN: $rep[tvn]</font>";
		}
		
}
?>
</TABLE>
</body>
</html>