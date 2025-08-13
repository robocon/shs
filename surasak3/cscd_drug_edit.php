<?
session_start();
include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 16px;
}
.txt{
	font-family: TH SarabunPSK;
	font-size: 16px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
background-color: #D6EEEE;
-->
</style>

<?
$sql="select a.row_id,a.date,a.drugcode,a.tradname,a.amount,a.price,a.idno,b.hn,b.tvn,b.ptname,b.datedr from drugrx as a inner join phardep as b on a.idno=b.row_id where a.row_id=".$_GET['row_id']."";
//echo $sql;
$query=mysql_query($sql);
$i=0;
$rows=mysql_fetch_array($query);
if($rows["drugcode"]=="1PARA"){
	$newprice=$rows["amount"]*1;
}

$unit=$rows["price"]/$rows["amount"];	
?>
<p align="center"><strong>แก้ไขข้อมูลยา</strong></p>
<form id="form1" name="form1" method="post" action="cscd_drug_edit.php">
<input type="hidden" name="act" value="update" />
<input type="hidden" name="row_id" value="<?=$rows["row_id"]?>" />
<input type="hidden" name="idno" value="<?=$rows["idno"]?>" />
<input type="hidden" name="txdate" value="<?=$rows["date"]?>" />
<input type="hidden" name="hn" value="<?=$rows["hn"]?>" />
<input type="hidden" name="datedr" value="<?=$rows["datedr"]?>" />
<input type="hidden" name="drugcode" value="<?=$rows["drugcode"]?>" />
<input type="hidden" name="amount" value="<?=$rows["amount"]?>" />
<input type="hidden" name="depart" value="PHAR" />
<table width="80%" border="0" align="center" cellpadding="4" cellspacing="0" style="background-color:#FFFFE0;">
  <tr>
    <td><strong>วัน/เดือน/ปี </strong></td>
    <td align="center">:</td>
    <td><?=$rows["date"];?></td>
  </tr> 
  <tr>
    <td width="19%"><strong>HN</strong></td>
    <td width="3%" align="center">:</td>
    <td width="78%"><?=$rows["hn"];?></td>
  </tr>
  <tr>
    <td><strong>VN</strong></td>
    <td align="center">:</td>
    <td><?=$rows["tvn"];?></td>
  </tr>
  <tr>
    <td><strong>ชื่อ - นามสกุล</strong></td>
    <td align="center">:</td>
    <td><?=$rows["ptname"];?></td>
  </tr>
  <tr>
    <td><strong>รหัส</strong></td>
    <td align="center">:</td>
    <td><?=$rows["drugcode"];?></td>
  </tr>
  <tr>
    <td><strong>รายการ</strong></td>
    <td align="center">:</td>
    <td><?=$rows["tradname"];?></td>
  </tr>
  <tr>
    <td><strong>จำนวนที่จ่าย</strong></td>
    <td align="center">:</td>
    <td><?=$rows["amount"];?></td>
  </tr>
  <tr bgcolor="#fadbd8">
    <td><strong>ราคายาเดิม</strong></td>
    <td align="center">:</td>
    <td><?=$rows["price"];?> &nbsp;&nbsp;&nbsp;(เฉลี่ยหน่วยละ <?=$unit;?> บาท)&nbsp;&nbsp;&nbsp;<span style="margin-left:20px;color:red;">ติด C เนื่องจากราคาไม่ตรงกับ Drug Catalogue</span></td>
  </tr>
  <tr bgcolor="20B2AA">
    <td><strong>ราคายาใหม่</strong></td>
    <td align="center">:</td>
    <td><input name="newprice" type="text" class="txt" id="newprice" value="<?=number_format($newprice,2);?>"></td>
  </tr>  
  <tr>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td><input type="submit" value="แก้ไขข้อมูล" name="submit"  class="txt" id="submit" /></td>
  </tr>
</table>
</form>
<?php
if($_POST["act"]=="update"){
	$drugrx_id=$_POST["row_id"];
	$drugrx_idno=$_POST["idno"];
	$newprice=$_POST["newprice"];
	$txdate=$_POST["txdate"];
	list($phardepdate,$phardeptime)=explode(" ",$_POST["txdate"]);
	$hn=$_POST["hn"];
	$drugcode=$_POST["drugcode"];
	$amount=$_POST["amount"];
	$datedr=$_POST["datedr"];
	$depart=$_POST["depart"];
	
	$salepri=$newprice/$amount;
	
	$edit="update drugrx set price='$newprice' where row_id='$drugrx_id'";
	if(mysql_query($edit)){

		$sql="select sum(price) as sumprice from drugrx where idno='$drugrx_idno'";
		$query=mysql_query($sql);
		list($sumprice)=mysql_fetch_array($query);
		
		
		
		$sql11="select sum(price) as essd from drugrx where idno='$drugrx_idno' and part='DDL'";
		$query11=mysql_query($sql11);
		list($essd)=mysql_fetch_array($query11);	

		$sql12="select sum(price) as nessdy from drugrx where idno='$drugrx_idno' and part='DDY'";
		$query12=mysql_query($sql12);
		list($nessdy)=mysql_fetch_array($query12);			
		
		
		
		
		$edit1="update phardep set price='$sumprice',paid='$sumprice',essd='$essd',nessdy='$nessdy' where row_id='$drugrx_idno'";
		mysql_query($edit1);
		
		$edit2="update dphardep set price='$sumprice',essd='$essd',nessdy='$nessdy' where date='$datedr' and hn='$hn' and stkcutdate='$phardeptime'";
		mysql_query($edit2);

		$edit3="update ddrugrx set salepri='$salepri', price='$newprice' where date='$datedr' and hn='$hn' and drugcode='$drugcode'";
		mysql_query($edit3);
		
		$edit4="update opacc set price='$sumprice',paid='$sumprice',essd='$essd',nessdy='$nessdy',paidcscd='$sumprice' where txdate='$txdate' and hn='$hn' and depart='$depart' and credit='จ่ายตรง' ";
		mysql_query($edit4);		
		
		echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว');window.location='cscd_list.php?depart=$depart&txdate=$txdate&hn=$hn';</script>";
	}else{
		echo "<script>alert('!!!ผิดพลาด...ไม่สามารถแก้ไขข้อมูลได้');window.location='cscd_drug_edit.php?row_id=$drugrx_id&idno=$drugrx_idno';</script>";
	}
}
?>