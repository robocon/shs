<p align="center">�Դ�������� Xray ��Ǩ�آ�Ҿ�١��ҧ 2560
<form name="form1" id="form1" method="post" action="<? $PHP_SELF; ?>">
<input name="act" type="hidden" value="add">   
<input name="Submit" type="submit" value="������� ���ͤԴ�������� Xray" />
</form>
</p>
<?
if($_POST["act"]=="add"){
include("connect.inc"); 
$sql="select * from opcardchk as a inner join  dxofyear_emp as b on a.HN=b.hn where a.part='�١��ҧ60' and b.thidate like '2017-03-17%' and (a.HN='58-2184') group by b.hn order by a.exam_no asc";
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

	$item=1;
	$price=200;
	$sumyprice=200;
	$sumnprice=0;
	$paid=0;
	
	$add1=mysql_query("insert into depart set chktranx='$nStktranx',
										  date='$date',
										  ptname='$ptname',
										  hn='$rows[HN]',
										  doctor='MD022 (����Һᾷ��)',
										  depart='XRAY',
										  item='$item',
										  detail='��ҵ�Ǩ���������ä',
										  price='$price',
										  sumyprice='$sumyprice',
										  sumnprice='$sumnprice',
										  paid='$paid',
										  idname='��ѳ�� ��þĵԾ���',
										  diag='��Ǩ�آ�Ҿ',
										  tvn='$rows[vn]',
										  ptright='$ptright',
										  status='Y';");
$maxid=mysql_insert_id();										  							  

//echo "==>$add1<br>";

$value="41001-sso";  //���� xray ��Сѹ�ѧ��
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
											depart='XRAY',
											part='XRAY',
											idno='$maxid',
											ptright='$ptright',
											film_size='DIGITA',
											status='Y';");
//echo $add2."<br>";										


$nStktranx++;
$query3 ="UPDATE runno SET runno = $nStktranx WHERE title='stktranx'";
$result3 = mysql_query($query3) or die("Query failed runno");
}  //close while
}  //close if act=add
?>