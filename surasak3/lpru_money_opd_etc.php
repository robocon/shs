<p align="center">คิดค่าใช้จ่าย OPD ราชภัฏ61 สิทธิข้าราชการ
<form name="form1" id="form1" method="post" action="lpru_money_opd_etc.php">
<input name="act" type="hidden" value="add">   
<input name="Submit" type="submit" value="กดที่นี่ เพื่อคิดค่าใช้จ่าย OPD" />
</form>
</p>
<?php 
if($_POST["act"]=="add"){

include("connect.inc"); 
$getdate=date("Y-m-d");
// $sql="select * from chkup_solider where finance_date like '$getdate%' and finance_xray !='1' and yearchkup='61' and active='y' order by row_id";
//echo $sql;
$sql = "SELECT a.*,b.`vn`,b.`thidate`,b.`ptname`,b.`ptright` 
FROM `opcardchk` AS a 
LEFT JOIN ( 
    SELECT * FROM `opday` WHERE `thidate` LIKE '2561-09-20%' 
) AS b ON b.`hn` = a.`hn`
WHERE a.`part` = 'lpru61' 

AND ( a.`HN` = '61-6056' OR a.`HN` = '51-4968' OR a.`HN` = '48-19666' OR a.`HN` = '49-5922' )

ORDER BY a.`row` ASC";
$query=mysql_query($sql);
$num=mysql_num_rows($query);

$date=(date("Y")+543)."-".date("m-d H:i:s");

while($rows=mysql_fetch_array($query)){

	// $chkuprow_id=$rows["row_id"];
    $ptname=$rows["ptname"];
    $hn = $rows['HN'];
    $vn = $rows['vn'];
    $cPtright = $rows['ptright'];
	
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
	
	
	$arrxray=array('41001');
	$item=1;
	$price=50;
	$sumyprice=50;
	$sumnprice=0;
	$paid=0;
	
	$add1=mysql_query("insert into depart set chktranx='$nStktranx',
										  date='$date',
										  ptname='$ptname',
										  hn='$hn',
										  doctor='',
										  depart='OTHER',
										  item='$item',
										  detail='(55020/55021 ค่าบริการผู้ป่วยนอก)',
										  price='$price',
										  sumyprice='$sumyprice',
										  sumnprice='$sumnprice',
										  paid='$paid',
										  idname='ระบบคอมพิวเตอร์',
										  diag='',
										  tvn='$vn',
										  ptright='$cPtright',
										  status='Y';");
	var_dump($add1);
$maxid=mysql_insert_id();
//echo "==>$add1<br>";

	// foreach ($arrxray as $value) {
	//    list($code,$oldcode,$detail,$price,$yprice,$nprice) = mysql_fetch_row(mysql_query("Select code,oldcode,detail,price,yprice,nprice From labcare where code = '".$value."' limit 0,1 ")); 
	
		$add2=mysql_query("insert into patdata set date='$date',
												hn='$hn',
												ptname='$ptname',
												doctor='',
												item='$item',
												code='SERVICE',
												detail='(55020/55021 ค่าบริการผู้ป่วยนอก)',
												amount='1',
												price='$price',
												yprice='$yprice',
												nprice='$nprice',
												depart='OTHER',
												part='OTHER',
												idno='$maxid',
												ptright='$cPtright',
												status='Y';");
		var_dump($add2);
	//echo $add2."<br>";
	// }										

// $edit="update chkup_solider set finance_xray='1' where row_id='$chkuprow_id';";
// $query5=mysql_query($edit);

$nStktranx++;
$query3 ="UPDATE runno SET runno = $nStktranx WHERE title='stktranx'";
$result3 = mysql_query($query3) or die("Query failed runno");


	echo "<hr>";

}  //close while

echo "นำเข้าข้อมูลเรียบร้อย";
}  //close if act=add
?>