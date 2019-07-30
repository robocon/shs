<?
session_start();
include("connect.inc");
?><style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#000000">
  <tr>
    <td align="center"><strong>ลำดับ</strong></td>
    <td align="center"><strong>HN</strong></td>
    <td align="center"><strong>ชื่อ - นามสกุล</strong></td>
    <td align="center"><strong>เลขที่บัตรประชาชน</strong></td>
    <td align="center"><strong>เลขที่บัตรประชาชน edc</strong></td>
    <td align="center"><strong>จำนวนเงิน</strong></td>
    <td align="center"><strong>จำนวนเงิน edc</strong></td>
    <td align="center"><strong>เลข appcode</strong></td>
    <td align="center"><strong>appcode edc</strong></td>
  </tr>
  <?
  $sql="select *,sum(price) as sumpaidcscd from opacc where date like '2562-07-11%' and credit='จ่ายตรง' and credit_detail='' group by credit_detail,hn,billno";
  $query=mysql_query($sql);
  $i=0;
  while($rows=mysql_fetch_array($query)){
	$i++;
	$hn=$rows["hn"];
	$sqlpid="select idcard,yot,name,surname from opcard where hn='$hn' limit 1;";
	//echo "$sqlpid<br>";
	$querypid=mysql_query($sqlpid);
	list($pid,$yot,$name,$surname)=mysql_fetch_array($querypid);	
	
	
$sqlopc="select idcard1,appcode,price from edc where idcard1='$pid' and price='".$rows["sumpaidcscd"]."'";
//echo "$sqlopc<br>";
$queryopc=mysql_query($sqlopc);
$num=mysql_num_rows($queryopc);
list($chkidcard,$appcode,$chkprice)=mysql_fetch_array($queryopc);	
//if($num > 0){
	$edit="update opacc set credit_detail='$appcode' where date='".$rows["date"]."' and hn='".$rows["hn"]."' and credit_detail='' and billno='".$rows["billno"]."' and credit='จ่ายตรง'";
	//echo $edit."<br>";
	//mysql_query($edit);
	//echo $rows["txdate"]."-->".$rows["hn"]."<br>";
  ?>
  <tr>
    <td><?=$i;?></td>
    <td><?=$rows["hn"];?></td>
    <td><?=$name." ".$surname;?></td>
    <td><?=$pid;?></td>
    <td><?=$chkidcard;?></td>
    <td><?=$rows["sumpaidcscd"];?></td>
    <td><?=$chkprice;?></td>    
    <td><?=$rows["credit_detail"];?></td>
    <td><?=$appcode;?></td>
  </tr>
  <?
  	//}
  }
  ?>
</table>

