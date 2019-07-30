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
    <td align="center"><strong>vn</strong></td>
    <td align="center"><strong>billno</strong></td>
    <td align="center"><strong>วันที่ OPACC</strong></td>
    <td align="center"><strong>วันที่ STM</strong></td>
    <td align="center"><strong>INVNO OPACC</strong></td>
    <td align="center"><strong>INVNO STM</strong></td>
    <td align="center"><strong>จำนวนเงิน OPACC</strong></td>
    <td align="center"><strong>จำนวนเงิน STM</strong></td>
  </tr>
  <?
  $sql="select *,sum(paidcscd) as chkpaid from opacc where date like '2562-06-11%' and credit='จ่ายตรง' and typecscd !='C' group by billno order by hn";
  //echo $sql;
  $query=mysql_query($sql);
  $i=0;
  while($rows=mysql_fetch_array($query)){
	$i++;
	$hn=$rows["hn"];
	
	$sqlpid="select idcard,yot,name,surname from opcard where hn='$hn' limit 1;";
	//echo "$sqlpid<br>";
	$querypid=mysql_query($sqlpid);
	list($pid,$yot,$name,$surname)=mysql_fetch_array($querypid);	
	
		
	$txdate=$rows["txdate"];
	$vn=$rows["vn"];
	$billno=$rows["billno"];
	$chkpaid=$rows["chkpaid"];
	
    $d=substr($txdate,8,2);
    $m=substr($txdate,5,2); 
    $y=substr($txdate,0,4); 
	$y=$y-543;
	$chkdate="$y$m$d";
	
$invbillno=str_replace(array("/"," "),'',$billno);	
$invbillno=sprintf('%05d',$invbillno);
$invvn=sprintf('%03d',$vn);

$invno=$chkdate.$invvn;  //อ้างอิง billtran.invno ขนาดข้อมูลต้อง >=9 && <= 16
	
		
$sqlopc="select * from chkstm where hn='$hn' and invno like '$invno%' and amount ='$chkpaid' ";
//echo "$sqlopc<br>";
$queryopc=mysql_query($sqlopc);
$num=mysql_num_rows($queryopc);
$result=mysql_fetch_array($queryopc);	
if($num > 0){
//echo $result["invno"]."<br>";
//echo $rows["date"]."-->".$hn."<br>";
	$edit="update opacc set stm_invno='".$result["invno"]."' where date='".$rows["date"]."' and hn='".$rows["hn"]."' and billno='".$rows["billno"]."' and credit='จ่ายตรง'";
	//echo $edit."<br>";
	mysql_query($edit);
	
	$edit1="update chkstm set status='y' where hn='".$rows["hn"]."' and invno='".$result["invno"]."'";
	//echo $edit1."<br>";
	mysql_query($edit1);
		
	//echo $rows["txdate"]."-->".$rows["hn"]."<br>";
  ?>
  <tr>
    <td><?=$i;?></td>
    <td><?=$rows["hn"];?></td>
    <td><?=$name." ".$surname;?></td>
     <td><?=$invvn;?></td>
     <td><?=$rows["billno"];?></td>
    <td><?=$rows["txdate"];?></td>
    <td><?=$result["dttran"];?></td>
    <td><?=$invno;?></td>
    <td><?=$result["invno"];?></td>
    <td><?=$rows["chkpaid"];?></td>
    <td><?=$result["amount"];?></td>
  </tr>
  <?
  	}
  }
  ?>
</table>


