<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<style>
.font2{
	font-size:18px;
	font-family:"TH SarabunPSK";
}
</style>
<body>
<center><span class="font2">�ѭ���Ѻ-�����ѵ���͡ķ����������㹤�ͺ��ͧ <u>�͹حҵ��������㹤�ͺ��ͧ� �Ţ��� 98/253</u><br />
���ͼ���Ѻ͹حҵ �.�.�ز��� �����  <strong>ʶҹ������ <u>�ç��Һ�Ť�������ѡ��������</u> �ѧ��Ѵ <u>�ӻҧ</u></strong><br />
ʶҹ����� 1 ���� 1 �ӺžԪ�� ��������ͧ �ѧ��Ѵ�ӻҧ</span></center>
<span class="font2">Ẻ �.�.8</span>
<table width="100%" border="1" class="font2" style="border-collapse:collapse" cellpadding="0" cellspacing="0">
  <tr>
    <td rowspan="2" align="center">�ѹ ��͹ ��</td>
    <td rowspan="2" align="center">�����ѵ���͡ķ���</td>
    <td rowspan="2" align="center">�Ţ��������ѡ��<br />
    �ͧ���駷���Ե</td>
    <td rowspan="2" align="center">����<br />
    �ҡ</td>
    <td colspan="3" align="center">��������</td>
    <td colspan="4" align="center">����ҳ�ѵ���͡ķ���</td>
    <td rowspan="2" align="center">����Ѻ͹حҵ<br />
    ���������<br />
    ��ͺ��ͧ</td>
  </tr>
  <tr>
    <td align="center">���ͼ���Ѻ��</td>
    <td align="center">����</td>
    <td align="center">�������</td>
    <td align="center">¡��</td>
    <td align="center">�Ѻ</td>
    <td align="center">����</td>
    <td align="center">�������</td>
  </tr>
  <?
include("connect.inc");
function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ��";
	}else{
		$pAge="$ageY �� $ageM ��͹";
	}

	return $pAge;
	}
	
 $query = "SELECT hn,an,date,drugcode,tradname,amount,price,stock,mainstk,slcode,reason,part FROM drugrx WHERE drugcode = '".$_GET['drug']."' and date LIKE '".$_GET['date']."%' ";
 $result = mysql_query($query)
        or die("Query failed");
$j = $i= Mysql_num_rows($result);
    while (list ($hn,$an,$date,$drugcode,$tradname,$amount,$price,$stock,$mainstk,$slcode,$reason,$part) = mysql_fetch_row ($result)) {
		$sumtotal = $stock+$mainstk;
        $Total =$Total+$amount;  
		$sal_price = $sal_price+$price;
		$list_hn[$i] = $hn;
		$list_peoper["A".$hn] = true;
		list($fullname,$ptright,$addr,$birth) = mysql_fetch_row(mysql_query("Select concat(yot,' ',name,' ',surname),ptright,concat(address,' �.',tambol,' �.',ampur,' �.',changwat),dbirth From opcard where hn = '".$hn."' limit 1 "));
		$age = calcage($birth);
		$sql = "Select doctor,idname From phardep where date = '$date'  ";
	//$result = Mysql_Query($sql);
	//list($doctor1,$idname1) = Mysql_fetch_row($result);
		list($doctor1,$idname1)  = mysql_fetch_row(Mysql_Query($sql));
?>
  <tr>
    <td><?=substr($date,8,2)."-".substr($date,5,2)."-".substr($date,0,4)?></td>
    <td><?=$tradname?></td>
    <td align="center"><?=$_GET['num']?></td>
    <td align="center"><?=$_GET['napo']?></td>
    <td><?=$fullname?></td>
    <td><?=$age?></td>
    <td><?=$addr?></td>
    <td><?=$amount+$sumtotal?></td>
    <td>&nbsp;</td>
    <td><?=$amount?></td>
    <td><?=$sumtotal?></td>
    <td>&nbsp;</td>
  </tr>
  <?
	}
  ?>
</table>

</body>
</html>