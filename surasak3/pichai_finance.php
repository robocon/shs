<p align="center">�Դ�������� Lab ��Ǩ�آ�Ҿ�Ⱥ�žԪ�� 2560
<form name="form1" id="form1" method="post" action="<? $PHP_SELF; ?>">
<input name="act" type="hidden" value="add">   
<input name="Submit" type="submit" value="������� ���ͤԴ�������� Lab" />
</form>
</p>
<?
if($_POST["act"]=="add"){
include("connect.inc"); 
$sql="select * from opcardchk where part='�Ⱥ�žԪ��60' order by row asc";
//echo $sql;
$query=mysql_query($sql);
$num=mysql_num_rows($query);

$date=(date("Y")+543)."-".date("m-d H:i:s");

while($rows=mysql_fetch_array($query)){

$ptname=$rows["name"];

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

if($rows["pid"]=="1"){
	$arrlab=array('CBC','UA');
	$item=2;
	$price=140;
	$sumyprice=140;
	$sumnprice=0;
	$paid=0;
	
	$add1=mysql_query("insert into depart set chktranx='$nStktranx',
										  date='$date',
										  ptname='$rows[name]',
										  hn='$rows[HN]',
										  doctor='MD022 (����Һᾷ��)',
										  depart='PATHO',
										  item='$item',
										  detail='��ҵ�Ǩ���������ä',
										  price='$price',
										  sumyprice='$sumyprice',
										  sumnprice='$sumnprice',
										  paid='$paid',
										  idname='�Ѫ�� �ӿ�',
										  diag='��Ǩ�آ�Ҿ',
										  tvn='$rows[course]',
										  ptright='R33 �ԡ���µç ͻ�.',
										  lab='$rows[exam_no]',
										  status='Y';");
$maxid=mysql_insert_id();										  							  
}else if($rows["pid"]=="3"){
	$arrlab=array('CBC','UA','BS','BUN','CR','SGOT','SGPT','ALK','URIC','CHOL','TRI');
	$item=11;
	$price=610;
	$sumyprice=610;	
	$sumnprice=0;
	$paid=0;
	
	$add1=mysql_query("insert into depart set chktranx='$nStktranx',
										  date='$date',
										  ptname='$rows[name]',
										  hn='$rows[HN]',
										  doctor='MD022 (����Һᾷ��)',
										  depart='PATHO',
										  item='$item',
										  detail='��ҵ�Ǩ���������ä',
										  price='$price',
										  sumyprice='$sumyprice',
										  sumnprice='$sumnprice',
										  paid='$paid',
										  idname='�Ѫ�� �ӿ�',
										  diag='��Ǩ�آ�Ҿ',
										  tvn='$rows[course]',
										  ptright='R33 �ԡ���µç ͻ�.',
										  lab='$rows[exam_no]',
										  status='Y';");
$maxid=mysql_insert_id();
}
//echo "==>$add1<br>";

foreach ($arrlab as $value) {
   list($code,$oldcode,$detail,$price,$yprice,$nprice) = mysql_fetch_row(mysql_query("Select code,oldcode,detail,price,yprice,nprice From labcare where code = '".$value."' limit 0,1 ")); 

	$add2=mysql_query("insert into patdata set date='$date',
											hn='$rows[HN]',
											ptname='$rows[name]',
											doctor='MD022 (����Һᾷ��)',
											item='$item',
											code='$code',
											detail='$detail',
											amount='1',
											price='$price',
											yprice='$yprice',
											nprice='$nprice',
											depart='PATHO',
											part='LAB',
											idno='$maxid',
											ptright='R33 �ԡ���µç ͻ�.',
											status='Y';");
//echo $add2."<br>";
}										


$nStktranx++;
$query3 ="UPDATE runno SET runno = $nStktranx WHERE title='stktranx'";
$result3 = mysql_query($query3) or die("Query failed runno");
}  //close while
}  //close if act=add
?>