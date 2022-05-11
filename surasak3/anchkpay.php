<?php
session_start();
include("connect.inc");
?>
<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตรวจสอบหมายเลข  AN ผู้ป่วยสิทธิจ่ายตรง</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; AN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="an" size="12" id="aLink" value="<?=$_GET["an"];?>" ></p>
<script type="text/javascript">
document.getElementById('aLink').focus();
</script>

  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="      ตกลง      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<ไปเมนู</a></p>
</form>

<table>
 <tr>
  <th bgcolor=CD853F>AN</th>
  <th bgcolor=CD853F>HN</th>
  <th bgcolor=CD853F>ชื่อ-สกุล</th>
  <th bgcolor=CD853F>สิทธิ</th>
  <th bgcolor=CD853F>รับป่วย</th>
  <th bgcolor=CD853F>จำหน่าย</th>
  <th bgcolor=CD853F>โรค</th>
  <th bgcolor=CD853F>แพทย์</th>
  <th bgcolor=CD853F>เตียง</th>
  <th bgcolor=CD853F>วันนอน</th>
  <th bgcolor=CD853F>ค่าใช้จ่าย</th>
  <th bgcolor=CD853F>เก็บเงิน</th>
  <th bgcolor=CD853F>Home Isolation</th>
  <th bgcolor=CD853F>ค่าห้อง/ค่าอาหาร</th>
  <th bgcolor=CD853F>ดำเนินการ</th>
 </tr>

<?php
If (!empty($an)){
    global $hn;
    $query = "SELECT an,hn,ptname,ptright,date,dcdate,diag,doctor,bedcode,fname,days,price,paid,hi_type,my_food FROM ipcard WHERE an = '$an'";
    $result = mysql_query($query) or die("Query failed");

    while (list ($an,$hn,$ptname,$ptright,$date,$dcdate,$diag,$doctor,$bedcode,$fname,$days,$price,$paid,$hi_type,$my_food) = mysql_fetch_row ($result)) {

	
        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3>$an</td>\n".
           "  <td BGCOLOR=F5DEB3>$hn</td>\n".
           "  <td BGCOLOR=F5DEB3>$ptname</td>\n".
           "  <td BGCOLOR=F5DEB3>$ptright</a></td>\n".
           "  <td BGCOLOR=F5DEB3>$date</a></td>\n".
           "  <td BGCOLOR=F5DEB3>$dcdate</td>\n".
           "  <td BGCOLOR=F5DEB3>$diag</td>\n".
           "  <td BGCOLOR=F5DEB3>$doctor</td>\n".
           "  <td BGCOLOR=F5DEB3>$bedcode</td>\n".
		   "  <td BGCOLOR=F5DEB3 align='center'>$days</td>\n".
		   "  <td BGCOLOR=F5DEB3>$price</td>\n".
		   "  <td BGCOLOR=F5DEB3>$paid</td>\n".
		   "  <td BGCOLOR=F5DEB3>$hi_type</td>\n".
		   "  <td BGCOLOR=F5DEB3>$my_food</td>\n".
   "  <td BGCOLOR=F5DEB3 align='center'><a href=\"anchkpay.php?an=$an&act=show&days=$days\" >แก้ไขค่าห้อง</td>\n".
           " </tr>\n");
       }
}
?>
</table>
<?

if($_GET["act"]=="show"){
echo "<br><hr><br>";
$sql1="select * from ipacc where an='".$_GET["an"]."' and (code='21501' || code='21502' || code='9901') order by part desc";
$query1=mysql_query($sql1);
$i=0;
while($result=mysql_fetch_array($query1)){
$i++;
$code=$result["code"];
$detail=$result["detail"];
$amount=$result["amount"];
$price=$result["price"];
$paid=$result["paid"];

echo "<div align='center'>$i) $code $detail $amount $price $paid </div>";	
}

	
$sql="select * from ipmonrep where an='".$_GET["an"]."' and credit ='จ่ายตรง' order by row_id desc limit 1";
$query=mysql_query($sql);
$rows=mysql_fetch_array($query);

$newbfy=$_GET["days"]*1000;
$difference=$newbfy-$rows["bfy"];

$newprice=$rows["price"]+$difference;
$newcash=$rows["cash"]+$difference;
?>
<br><hr><br>
<form name="f2" method="post" action="anchkpay.php">
<input type="hidden" name="act" value="edit">
<input type="hidden" name="row_id" value="<?=$rows["row_id"];?>">
<input type="hidden" name="an" value="<?=$rows["an"];?>">
<table width="50%" align="center" bgcolor="#52BE80" cellspacing="5" cellpadding="5">
<tr>
	<td colspan="2" align="center">ข้อมูลผู้ป่วยใน</td>
</tr>
<tr>
	<td align="right">AN</td>
	<td><?=$rows["an"];?></td>
</tr>
<tr>
	<td align="right">HN</td>
	<td><?=$rows["hn"];?></td>
</tr>
<tr>
	<td align="right">ชื่อ-สกุล</td>
	<td><?=$rows["ptname"];?></td>
</tr>
<tr>
	<td align="right">สิทธิ</td>
	<td><?=$rows["ptright"];?></td>
</tr>
<tr>
	<td align="right">ค่าใช้จ่าย</td>
	<td><?=$rows["price"];?></td>
</tr>
	<tr>
	<td align="right">เก็บเงิน</td>
	<td><?=$rows["cash"];?></td>
</tr>
</tr>
	<tr>
	<td align="right">ค่าห้อง/เดิม</td>
	<td><?=$rows["bfy"];?></td>
</tr>
</tr>
	<tr>
	<td align="right">ค่าห้อง/ใหม่</td>
	<td><input type="hidden" name="newbfy" value="<?=$newbfy;?>"><?=$newbfy;?></td>
</tr>
</tr>
	<tr>
	<td align="right">ค่าห้อง/ส่วนต่าง</td>
	<td><?=$difference;?></td>
</tr>
</tr>
	<tr>
	<td align="right">ค่าใช้จ่าย/ใหม่</td>
	<td><input type="hidden" name="newprice" value="<?=$newprice;?>"><?=$newprice;?></td>
</tr>
</tr>
	<tr>
	<td align="right">เก็บเงิน/ใหม่</td>
	<td><input type="hidden" name="newcash" value="<?=$newcash;?>"><?=$newcash;?></td>
</tr>
<tr>
	<td colspan="2" align="center"><input type="submit" name="submit" value="  แก้ไขข้อมูล "></td>
</tr>
</table>
</form>
<?
}
?>
<?
if($_POST["act"]=="edit"){
	$chkan=$_POST["an"];
	$edit1="UPDATE ipmonrep SET price='".$_POST["newprice"]."',
								cash='".$_POST["newcash"]."',
								bfy='".$_POST["newbfy"]."' 
			WHERE row_id='".$_POST["row_id"]."'";
	//echo $edit1;
	if(mysql_query($edit1)){
		$edit2="UPDATE ipcard SET price='".$_POST["newprice"]."',
									paid='".$_POST["newcash"]."',
									my_food='1000' 
				WHERE an='".$_POST["an"]."'";
		mysql_query($edit2);
		echo "ทำการแก้ไขข้อมูลเรียบร้อยแล้ว";
		echo "<meta http-equiv=\"refresh\" content=\"1;url=anchkpay.php?an=$chkan\">";
	}else{
		echo "ผิดพลาด แก้ไขข้อมูลไม่สำเร็จ";
		echo "<meta http-equiv=\"refresh\" content=\"1;url=anchkpay.php?an=$chkan\">";
	}

}
?>