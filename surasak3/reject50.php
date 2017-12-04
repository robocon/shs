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
   print "<form method='POST' action='reject50.php'>";
    print "<p><font face='Angsana New'>ยกเลิกค่าบริการ 50 บาท</font></p>";
    print "<p><font face='Angsana New'>วันที่&nbsp;&nbsp; ";
    print "<input type='text' name='d' size='2' value=$d>&nbsp;&nbsp;";
    print "เดือน&nbsp; <input type='text' name='m' size='2' value=$m>&nbsp;&nbsp;&nbsp;";
    print "พ.ศ. <input type='text' name='yr' size='8' value=$yr></font></p>";
  print "<p><font face='Angsana New'>&nbsp;&nbsp;HN:&nbsp;&nbsp;<input type='text' name='hhn' size='8' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
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
?>
<TABLE  width='100%' style="font-family:AngsanaUPC;">
<TR align="center" bgcolor=6495ED>
	<TD colspan='10'><B>ค่าบริการ 50 บาท</B></TD>
</TR>
<TR align="center" bgcolor=6495ED>
	<TD>VN</TD>
	<TD>วันที่</TD>
	<TD>HN</TD>
    <TD>AN</TD>
	<TD>ชื่อ-สกุล</TD>
	<TD>สิทธิ์</TD>
	<TD>จำนวนเงิน</TD>
	<TD>แผนก</TD>
	<TD>เจ้าหน้าที่</TD>
	<TD>ออกOPCARDโดย</TD>
</TR>
<?
	$sql = "Select tvn, hn, ptname, ptright, price,an,date,depart,idname,row_id,accno From depart  where date like '$yr-$m-$d%' AND hn = '$hhn' AND `status` = 'Y' AND price > 0 and depart = 'OTHER' ORDER BY date ";
	$result  = Mysql_Query($sql);
	while($arr = Mysql_fetch_assoc($result)){
	   $sqlf = "select toborow,an from opday where hn='".$arr['hn']."' and thidate like '$yr-$m-$d%' ";
	   list($toborow,$Tan) = mysql_fetch_array(mysql_query($sqlf));
?>
<TR BGCOLOR=66CDAA>
	<TD BGCOLOR="<?php echo $color ?>"><a target=_BLANK  href="labdetail.php?sDate=<?=$arr['date']?>&nRow_id=<?=$arr['row_id']?>&nAccno=<?=$arr['accno']?>"><?php echo $arr["tvn"];?></a></TD>
		<TD BGCOLOR="<?php echo $color ?>"><?php echo $arr["date"];?></TD>
	<TD BGCOLOR="<?php echo $color ?>"><?php echo $arr["hn"];?></TD>
    <TD BGCOLOR="<?php echo $color ?>"><?=$Tan?></TD>
	<TD BGCOLOR="<?php echo $color ?>"><?php echo $arr["ptname"];?></TD>
	<TD BGCOLOR="<?php echo $color ?>"><?php echo $arr["ptright"];?></TD>
	<TD  align="right" BGCOLOR="<?php echo $color ?>"><?php echo $arr["price"];?></TD>
		<TD BGCOLOR="<?php echo $color ?>"><?php echo $arr["depart"];?></TD>
			<TD BGCOLOR="<?php echo $color ?>"><?php echo $arr["idname"];?></TD>
	<TD BGCOLOR="<?php echo $color ?>"><?=$toborow?></TD>
</TR>

<?
	}
}
?>
</TABLE>
</body>
</html>