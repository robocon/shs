<p align="center">�Դ�������� Lab ��Ǩ�آ�Ҿ�١��ҧ 2560
<form name="form1" id="form1" method="post" action="<? $PHP_SELF; ?>">
<input name="act" type="hidden" value="add">   
<input name="Submit" type="submit" value="������� ���ͤԴ�������� Lab" />
</form>
</p>
<?
if($_POST["act"]=="add"){
include("connect.inc"); 
$sql="select * from opcardchk as a inner join  dxofyear_emp as b on a.HN=b.hn where a.part='�١��ҧ60' and b.thidate like '2017-03-22%' group by b.hn order by a.exam_no asc";
//echo $sql;
$query=mysql_query($sql);
$num=mysql_num_rows($query);

$date=(date("Y")+543)."-".date("m-d H:i:s");

while($rows=mysql_fetch_array($query)){

$ptname=$rows["name"]." ".$rows["surname"];

if($rows["branch"] !="��Сѹ�ѧ��"){
	$ptsql="select ptright from opcard where hn='".$rows["HN"]."'";
	$ptquery=mysql_query($ptsql);
	$ptrows=mysql_fetch_array($ptquery);
	$ptright=$ptrows["ptright"];
}else{
	$ptright="R07 ��Сѹ�ѧ��";
}

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
										  ptname='$ptname',
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
										  tvn='$rows[vn]',
										  ptright='$ptright',
										  lab='$rows[exam_no]',
										  status='Y';");
$maxid=mysql_insert_id();										  							  
}else if($rows["pid"]=="3"){
	$arrlab=array('CBC','UA','BS','BUN','CR','SGOT','SGPT','ALK','URIC','LIPID');
	$item=10;
	$price=690;
	$sumyprice=690;	
	$sumnprice=0;
	$paid=0;
	
	$add1=mysql_query("insert into depart set chktranx='$nStktranx',
										  date='$date',
										  ptname='$ptname',
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
										  tvn='$rows[vn]',
										  ptright='$ptright',
										  lab='$rows[exam_no]',
										  status='Y';");
$maxid=mysql_insert_id();
}else if($rows["pid"]=="4"){
	if($rows["agey"] < 35){
		$arrlab=array('CBC','UA','HBSAG','HBSAB');
		$item=4;
		$price=450;
		$sumyprice=450;	
		$sumnprice=0;
		$paid=0;
	}else{
		$arrlab=array('CBC','UA','BS','BUN','CR','SGOT','SGPT','ALK','URIC','LIPID','HBSAG','HBSAB');
		$item=12;
		$price=1000;
		$sumyprice=1000;	
		$sumnprice=0;
		$paid=0;
	}
	
	$add1=mysql_query("insert into depart set chktranx='$nStktranx',
										  date='$date',
										  ptname='$ptname',
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
										  tvn='$rows[vn]',
										  ptright='$ptright',
										  lab='$rows[exam_no]',
										  status='Y';");
$maxid=mysql_insert_id();
}else if($rows["pid"]=="5"){
	if($rows["agey"] < 35){
		$arrlab=array('CBC','UA','HBSAB');
		$item=3;
		$price=320;
		$sumyprice=320;	
		$sumnprice=0;
		$paid=0;
	}else{
		$arrlab=array('CBC','UA','BS','BUN','CR','SGOT','SGPT','ALK','URIC','LIPID','HBSAB');
		$item=11;
		$price=870;
		$sumyprice=870;	
		$sumnprice=0;
		$paid=0;
	}
	
	$add1=mysql_query("insert into depart set chktranx='$nStktranx',
										  date='$date',
										  ptname='$ptname',
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
										  tvn='$rows[vn]',
										  ptright='$ptright',
										  lab='$rows[exam_no]',
										  status='Y';");
$maxid=mysql_insert_id();
}
//echo "==>$add1<br>";

foreach ($arrlab as $value) {
   list($code,$oldcode,$detail,$price,$yprice,$nprice) = mysql_fetch_row(mysql_query("Select code,oldcode,detail,price,yprice,nprice From labcare where code = '".$value."' limit 0,1 ")); 

	$add2=mysql_query("insert into patdata set date='$date',
											hn='$rows[HN]',
											ptname='$ptname',
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
											ptright='$ptright',
											status='Y';");
//echo $add2."<br>";
}										


$nStktranx++;
$query3 ="UPDATE runno SET runno = $nStktranx WHERE title='stktranx'";
$result3 = mysql_query($query3) or die("Query failed runno");
}  //close while
}  //close if act=add
?>