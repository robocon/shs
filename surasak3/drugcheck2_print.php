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
<center><span class="font2">บัญชีรับ-จ่ายวัตถุออกฤทธิ์ที่มีไว้ในครอบครอง <u>ใบอนุญาตให้มีไว้ในครอบครองฯ เลขที่ 98/253</u><br />
ชื่อผู้รับอนุญาต พ.อ.วุฒิไชย อิศระ  <strong>สถานที่ชื่อ <u>โรงพยาบาลค่ายสุรศักดิ์มนตรี</u> จังหวัด <u>ลำปาง</u></strong><br />
สถานที่ตั้ง 1 หมู่ 1 ตำบลพิชัย อำเภอเมือง จังหวัดลำปาง</span></center>
<span class="font2">แบบ บ.จ.8</span>
<table width="100%" border="1" class="font2" style="border-collapse:collapse" cellpadding="0" cellspacing="0">
  <tr>
    <td rowspan="2" align="center">วัน เดือน ปี</td>
    <td rowspan="2" align="center">ชื่อวัตถุออกฤทธิ์</td>
    <td rowspan="2" align="center">เลขที่หรืออักษร<br />
    ของครั้งที่ผลิต</td>
    <td rowspan="2" align="center">ได้มา<br />
    จาก</td>
    <td colspan="3" align="center">จ่ายไปให้</td>
    <td colspan="4" align="center">ปริมาณวัตถุออกฤทธิ์</td>
    <td rowspan="2" align="center">ผู้รับอนุญาต<br />
    ให้มีไว้ใน<br />
    ครอบครอง</td>
  </tr>
  <tr>
    <td align="center">ชื่อผู้รับยา</td>
    <td align="center">อายุ</td>
    <td align="center">ที่อยู่</td>
    <td align="center">ยกมา</td>
    <td align="center">รับ</td>
    <td align="center">จ่าย</td>
    <td align="center">คงเหลือ</td>
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
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
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
		list($fullname,$ptright,$addr,$birth) = mysql_fetch_row(mysql_query("Select concat(yot,' ',name,' ',surname),ptright,concat(address,' ต.',tambol,' อ.',ampur,' จ.',changwat),dbirth From opcard where hn = '".$hn."' limit 1 "));
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