<p align="center">�Դ�������� Lab HDL ��Ǩ�آ�Ҿ��Шӻշ��� 2561
<form name="form1" id="form1" method="post" action="<? $PHP_SELF; ?>">
<input name="act" type="hidden" value="add">   
<input name="Submit" type="submit" value="������� ���ͤԴ�������� Lab" />
</form>
</p>
<?
if($_POST["act"]=="add"){
include("connect.inc"); 
$getdate=date("Y-m-d");
$sql="select * from chkup_solider where finance_date like '$getdate%' and finance_lab !='1' and yearchkup='61' and active='y' order by row_id";
//echo $sql;
$query=mysql_query($sql);
$num=mysql_num_rows($query);

$date=(date("Y")+543)."-".date("m-d H:i:s");

while($rows=mysql_fetch_array($query)){

$chkuprow_id=$rows["row_id"];
$ptname=$rows["yot"]." ".$rows["ptname"];

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

if($rows["age"] >=35){
	$arrlab=array('HDL');
	$item=1;
	$price=100;
	$sumyprice=0;	
	$sumnprice=100;
	$paid=0;
	
	$add1=mysql_query("insert into depart set chktranx='$nStktranx',
										  date='$date',
										  ptname='$ptname',
										  hn='$rows[hn]',
										  doctor='MD022 (����Һᾷ��)',
										  depart='PATHO',
										  item='$item',
										  detail='��Ǩ�آ�Ҿ',
										  price='$price',
										  sumyprice='$sumyprice',
										  sumnprice='$sumnprice',
										  paid='$paid',
										  idname='�Ѫ�� �ӿ�',
										  diag='��Ǩ�آ�Ҿ',
										  tvn='$rows[vn]',
										  ptright='R22 ��Ǩ�آ�Ҿ��Шӻաͧ�Ѿ��',
										  lab='$rows[qlab]',
										  status='Y';");
$maxid=mysql_insert_id();
}
//echo "==>$add1<br>";

	foreach ($arrlab as $value) {
	   list($code,$oldcode,$detail,$price,$yprice,$nprice) = mysql_fetch_row(mysql_query("Select code,oldcode,detail,price,yprice,nprice From labcare where code = '".$value."' limit 0,1 ")); 
	
		$add2=mysql_query("insert into patdata set date='$date',
												hn='$rows[hn]',
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
												ptright='R22 ��Ǩ�آ�Ҿ��Шӻաͧ�Ѿ��',
												status='Y';");
	//echo $add2."<br>";
	}

$edit="update chkup_solider set finance_lab='1' where row_id='$chkuprow_id';";
$query5=mysql_query($edit);

$nStktranx++;
$query3 ="UPDATE runno SET runno = $nStktranx WHERE title='stktranx'";
$result3 = mysql_query($query3) or die("Query failed runno");



}  //close while


}  //close if act=add
?>