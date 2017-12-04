<p align="center">คิดค่าใช้จ่าย Lab ตรวจสุขภาพอินทราเซรามิค 2560
<form name="form1" id="form1" method="post" action="<? $PHP_SELF; ?>">
<input name="act" type="hidden" value="add">   
<input name="Submit" type="submit" value="กดที่นี่ เพื่อคิดค่าใช้จ่าย XRAY" />
</form>
</p>
<?
if($_POST["act"]=="add"){
include("connect.inc"); 
$sql="select * from opcardchk where part='อินทราเซรามิค60'  and active='w' order by row asc";
//echo $sql;
$query=mysql_query($sql);
$num=mysql_num_rows($query);

$date=(date("Y")+543)."-".date("m-d H:i:s");

while($rows=mysql_fetch_array($query)){
	
	$sqlchk="select vn from opday where thidate like '2560-06-30%' and hn='$rows[HN]' limit 0,1";
	$querychk=mysql_query($sqlchk);
	list($tvn)=mysql_fetch_array($querychk);

$ptname=$rows["name"]." ".$rows["surname"];

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

	$item=1;
	$price=200;
	$sumyprice=200;
	$sumnprice=0;
	$paid=0;
	
	$add1=mysql_query("insert into depart set chktranx='$nStktranx',
										  date='$date',
										  ptname='$ptname',
										  hn='$rows[HN]',
										  doctor='MD022 (ไม่ทราบแพทย์)',
										  depart='XRAY',
										  item='$item',
										  detail='ค่าตรวจวิเคราะห์โรค',
										  price='$price',
										  sumyprice='$sumyprice',
										  sumnprice='$sumnprice',
										  paid='$paid',
										  idname='ศรัณย์ มกรพฤติพงศ์',
										  diag='ตรวจสุขภาพ',
										  tvn='$tvn',
										  ptright='R07 ประกันสังคม',
										  status='Y';");
$maxid=mysql_insert_id();										  							  

//echo "==>$add1<br>";

$value="41001-sso";  //รหัส xray ประกันสังคม
   list($code,$oldcode,$detail,$price,$yprice,$nprice) = mysql_fetch_row(mysql_query("Select code,oldcode,detail,price,yprice,nprice From labcare where code = '".$value."' limit 0,1 ")); 

	$add2=mysql_query("insert into patdata set date='$date',
											hn='$rows[HN]',
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
											ptright='R07 ประกันสังคม',
											film_size='DIGITA',
											status='Y';");
//echo $add2."<br>";						


$nStktranx++;
$query3 ="UPDATE runno SET runno = $nStktranx WHERE title='stktranx'";
$result3 = mysql_query($query3) or die("Query failed runno");
}  //close while
}  //close if act=add
?>