<p align="center">คิดค่าใช้จ่าย XRAY ราชภัฎ61 สิทธิประกันสังคม
<form name="form1" id="form1" method="post" action="lpru_money_xray_sso.php">
<input name="act" type="hidden" value="add">   
<input name="Submit" type="submit" value="กดที่นี่ เพื่อคิดค่าใช้จ่าย XRAY" />
</form>
</p>
<?php 
if($_POST["act"]=="add"){

include("connect.inc"); 
$getdate=date("Y-m-d");

$sql = "SELECT a.* 
FROM `opcardchk` AS a 
WHERE a.`part` = 'ราชภัฎ61' 
ORDER BY a.`row` ASC";
$query=mysql_query($sql);
$num=mysql_num_rows($query);

$date=(date("Y")+543)."-".date("m-d H:i:s");

while($rows=mysql_fetch_array($query)){

	// $chkuprow_id=$rows["row_id"];
    $ptname=$rows["name"].' '.$rows['surname'];
    $hn = $rows['HN'];
    $vn = '';
    $cPtright = 'R07 ประกันสังคม';
	
	$query1 = "SELECT runno, startday FROM runno WHERE title = 'stktranx'";
	$result = mysql_query($query1) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	$nStktranx=$row->runno;
	
	
	$arrxray=array('41001-sso');
	$item=1;
	$price=200;
	$sumyprice=200;
	$sumnprice=0;
	$paid=0;
	
	$add1=mysql_query("insert into depart set chktranx='$nStktranx',
										  date='$date',
										  ptname='$ptname',
										  hn='$hn',
										  doctor='MD022 (ไม่ทราบแพทย์)',
										  depart='XRAY',
										  item='$item',
										  detail='ค่าตรวจวิเคราะห์โรค',
										  price='$price',
										  sumyprice='$sumyprice',
										  sumnprice='$sumnprice',
										  paid='$paid',
										  idname='สุทธิชัย หนูมา',
										  diag='ตรวจสุขภาพ',
										  tvn='$vn',
										  ptright='$cPtright',
										  cashok='SSOCHECKUP61'
										  status='Y';");
$maxid=mysql_insert_id();
//echo "==>$add1<br>";

	foreach ($arrxray as $value) {
	   list($code,$oldcode,$detail,$price,$yprice,$nprice) = mysql_fetch_row(mysql_query("Select code,oldcode,detail,price,yprice,nprice From labcare where code = '".$value."' limit 0,1 ")); 
	
		$add2=mysql_query("insert into patdata set date='$date',
												hn='$hn',
												ptname='$ptname',
												doctor='MD022 (ไม่ทราบแพทย์)',
												item='$item',
												code='$code',
												detail='$detail',
												amount='1',
												price='$price',
												yprice='$yprice',
												nprice='$nprice',
												depart='XRAY',
												part='XRAY',
												idno='$maxid',
												ptright='$cPtright',
												status='Y';");
	//echo $add2."<br>";
	}										

// $edit="update chkup_solider set finance_xray='1' where row_id='$chkuprow_id';";
// $query5=mysql_query($edit);

$nStktranx++;
$query3 ="UPDATE runno SET runno = $nStktranx WHERE title='stktranx'";
$result3 = mysql_query($query3) or die("Query failed runno");



}  //close while

echo "นำเข้าข้อมูลเรียบร้อย";
}  //close if act=add
?>