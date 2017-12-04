<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>ออกใบเสร็จรับเงิน</title>
</head>
<body>
<?
include("../Connections/connect.inc.php");

	$y=date('Y')+543;
	$m=date('m');
	$d=date('d');
	$datetime=$d.'-'.$m.'-'.$y.' '.date('H:i:s');
	
	
if($_GET['do']=='form1'){
	
		$sql1="INSERT INTO  receipt  (type_receipt,no_cheque ,from_name,sing_name,thidate) VALUES ('".$_POST['type_rec']."','".$_POST['idchk']."','".$_POST['from']."','".$_POST['sign_name']."','".$datetime."') ";
		$query1=mysql_query($sql1);
		 
		 
 for($i=1;$i<=$_POST["hdnLine"];$i++)
	{
	
		if($_POST["detail_pay$i"] != "")
		{

		$max="SELECT MAX( row_receipt ) AS Max FROM receipt";
		$query=mysql_query($max);
		$arr=mysql_fetch_array($query);
		$id=$arr['Max'];
			
			$strSQL = "INSERT INTO detail_receipt ";
			$strSQL .="(row_receipt,detail_pay , cashy ,cashn) ";
			$strSQL .="VALUES ";
			$strSQL .="('".$id."','".$_POST["detail_pay$i"]."', ";
			$strSQL .="'".$_POST["cashy$i"]."' ";
			$strSQL .=",'".$_POST["cashn$i"]."')";
			$objQuery = mysql_query($strSQL);
			
			
		}
	}
	
	if($query1 && $objQuery){

		echo "<h1 align=center>เพิ่มข้อมูลเสร็จเรียบร้อยแล้ว</h1>";
		echo "<div align='center'><a href='receipt_report.php?receipt_id=$id' target='_blank'>พิมพ์ใบเสร็จรับเงิน (แนวนอน)</a>    <a href='receipt_report1.php?receipt_id=$id' target='_blank'>พิมพ์ใบเสร็จรับเงิน (แนวตั้ง)</a><br>";
		echo "<a href='javascript:history.back();'>กลับ</a></div>";
	
	//	echo "<meta http-equiv='refresh' content='2; url=receipt.php'>" ;
	}
}
///////////////////////////

if($_GET['do']=='form2'){

		$sql2="INSERT INTO receipt (type_receipt,no_cheque ,from_name,hn,an,sing_name,thidate,indate,dcdate,sumtotal,diag) VALUES ('".$_POST['type_rec']."','".$_POST['idchk']."','".$_POST['from']."','".$_POST['hn']."','".$_POST['an']."','".$_POST['sign_name']."','".$datetime."','".$_POST['indate']."','".$_POST['dcdate']."','".$_POST['sumtotal']."','".$_POST['diag']."') ";
		$query2=mysql_query($sql2);
		
		echo $sql2;
		
		$max="SELECT MAX( row_receipt ) AS Max FROM receipt";
		$query=mysql_query($max);
		$arr=mysql_fetch_array($query);
		$idmax=$arr['Max'];
		
			$strSQL = "INSERT INTO detail_receipt2 ";
			$strSQL .="(`row_receipt` , `1y` ,  `1n` ,  `1sy` ,  `1sn` ,  `2y` ,  `2n` ,  `3y` ,  `3n` ,  `4y` ,  `4n` ,  `5y` ,  `5n` ,  `6y` ,  `6n` ,  `7y` ,  `7n` ,  `8y` ,  `8n` ,  `9y` ,  `9n` ,  `10y` ,  `10n` ,  `11y` ,  `11n` ,  `12y`,`12n` , `13y`,`13n` ,  `14y` ,  `14n` ,  `15y` ,  `15n` ,  `16y` ,  `16n` )";
			$strSQL .="VALUES ";
			$strSQL .="('".$idmax."' ";
			$strSQL .=",'".$_POST["1y"]."' ";
			$strSQL .=",'".$_POST["1n"]."' ";
			$strSQL .=",'".$_POST["1sy"]."' ";
			$strSQL .=",'".$_POST["1sn"]."'";
			$strSQL .=",'".$_POST["2y"]."'";
			$strSQL .=",'".$_POST["2n"]."'";
			$strSQL .=",'".$_POST["3y"]."'";
			$strSQL .=",'".$_POST["3n"]."'";
			$strSQL .=",'".$_POST["4y"]."'";
			$strSQL .=",'".$_POST["4n"]."'";
			$strSQL .=",'".$_POST["5y"]."'";
			$strSQL .=",'".$_POST["5n"]."'";
			$strSQL .=",'".$_POST["6y"]."'";
			$strSQL .=",'".$_POST["6n"]."'";
			$strSQL .=",'".$_POST["7y"]."'";
			$strSQL .=",'".$_POST["7n"]."'";
			$strSQL .=",'".$_POST["8y"]."'";
			$strSQL .=",'".$_POST["8n"]."'";
			$strSQL .=",'".$_POST["9y"]."'";
			$strSQL .=",'".$_POST["9n"]."'";
			$strSQL .=",'".$_POST["10y"]."'";
			$strSQL .=",'".$_POST["10n"]."'";
			$strSQL .=",'".$_POST["11y"]."'";
			$strSQL .=",'".$_POST["11n"]."'";
			$strSQL .=",'".$_POST["12y"]."'";
			$strSQL .=",'".$_POST["12n"]."'";
			$strSQL .=",'".$_POST["13y"]."'";
			$strSQL .=",'".$_POST["13n"]."'";
			$strSQL .=",'".$_POST["14y"]."'";
			$strSQL .=",'".$_POST["14n"]."'";
			$strSQL .=",'".$_POST["15y"]."'";
			$strSQL .=",'".$_POST["15n"]."'";
			$strSQL .=",'".$_POST["16y"]."'";
			$strSQL .=",'".$_POST["16n"]."')";
			$objQuery = mysql_query($strSQL);
			
	if($query2 && $objQuery){
		
		echo "<h1 align=center>เพิ่มข้อมูลเสร็จเรียบร้อยแล้ว</h1>";
		echo "<div align='center'><a href='receipt_report2.php?receipt_id=$idmax' target='_blank'>พิมพ์ใบเสร็จรับเงิน</a><br>";
		echo "<a href='javascript:history.back();'>กลับ</a> </div>";

	}
			
		
}
?>
</body>
</html>