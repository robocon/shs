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
$getdepart=$_GET['depart'];
$sql="select * from opacc where row_id=".$_GET['row_id']."";
//echo $sql;
$query=mysql_query($sql);
$i=0;
$rows=mysql_fetch_array($query);

$strSQL = "SELECT * FROM opcard WHERE hn='".$rows["hn"]."'";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
$hn=$objResult["hn"];
$ptname=$objResult["yot"]." ".$objResult["name"]." ".$objResult["surname"];

?>
<p align="center"><strong>แก้ไขข้อมูลวันที่เกิดค่าใช้จ่าย</strong></p>
<form id="form1" name="form1" method="post" action="cscdtype_c_edittxdate.php">
<input type="hidden" name="act" value="update" />
<input type="hidden" name="row_id" value="<?=$rows["row_id"]?>" />
<input type="hidden" name="txdate" value="<?=$rows["txdate"]?>" />
<input type="hidden" name="hn" value="<?=$rows["hn"]?>" />
<input type="hidden" name="detail" value="<?=$rows["detail"]?>" />
<input type="hidden" name="depart" value="<?=$getdepart;?>" />
<table width="80%" border="0" align="center" cellpadding="4" cellspacing="0" style="background-color:#FFFFE0;">
    <tr>
    <td><strong>วันที่เกิดค่าใช้จ่าย </strong></td>
    <td align="center">:</td>
    <td><?=$rows["txdate"];?></td>
  </tr> 
  <tr>
    <td><strong>วันที่ใหม่</strong></td>
    <td align="center">:</td>
    <td><?=$rows["txdate"];?></td>
  </tr>   
  <tr>
    <td width="19%"><strong>HN</strong></td>
    <td width="3%" align="center">:</td>
    <td width="78%"><?=$rows["hn"];?></td>
  </tr>
  <tr>
    <td><strong>VN</strong></td>
    <td align="center">:</td>
    <td><?=$rows["vn"];?></td>
  </tr>
  <tr>
    <td><strong>ชื่อ - นามสกุล</strong></td>
    <td align="center">:</td>
    <td><?=$ptname;?></td>
  </tr>
  <tr>
    <td><strong>ประเภท</strong></td>
    <td align="center">:</td>
    <td><?=$rows["depart"];?></td>
  </tr>
  <tr>
    <td><strong>รายการ</strong></td>
    <td align="center">:</td>
    <td><?=$rows["detail"];?></td>
  </tr>
  <tr>
    <td><strong>ลูกหนี้</strong></td>
    <td align="center">:</td>
    <td><?=$rows["credit"];?></td>
  </tr>  
  <tr bgcolor="#fadbd8">
    <td><strong>จำนวนเงิน</strong></td>
    <td align="center">:</td>
    <td><input name="newprice" type="text" class="txt" id="newprice" value="<?=$rows["price"];?>"></td>
  </tr>
  <tr bgcolor="#fadbd8">
    <td><strong>ESSD</strong></td>
    <td align="center">:</td>
    <td><input name="newessd" type="text" class="txt" id="newessd" value="<?=$rows["essd"];?>"></td>
  </tr> 
  <tr bgcolor="#fadbd8">
    <td><strong>NESSDY</strong></td>
    <td align="center">:</td>
    <td><input name="newnessdy" type="text" class="txt" id="newnessdy" value="<?=$rows["nessdy"];?>"></td>
  </tr>
  <tr bgcolor="#fadbd8">
    <td><strong>NESSDN</strong></td>
    <td align="center">:</td>
    <td><input name="newnessdn" type="text" class="txt" id="newnessdn" value="<?=$rows["nessdn"];?>"></td>
  </tr>  
   <tr bgcolor="20B2AA">
    <td><strong>ขอเบิก</strong></td>
    <td align="center">:</td>
    <td><input name="newpaidcscd" type="text" class="txt" id="newpaidcscd" value="<?=$rows["paidcscd"];?>"><span style="margin-left:20px;color:red;">  *** หากเป็นค่าว่างไม่ต้องแก้ไขใดๆ ครับ ***</span></td>
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
	$opacc_id=$_POST["row_id"];
	$txdate=$_POST["txdate"];
	$newprice=$_POST["newprice"];
	$newpaidcscd=$_POST["newpaidcscd"];
	$hn=$_POST["hn"];
	$depart=$_POST["depart"];
	$detail=$_POST["detail"];
	$lastupdate=(date("Y")+543)."-".date("m-d H:i:s");
	
	
	if(!empty($newpaidcscd)){
		$edit="update opacc set price='$newprice', paidcscd='$newpaidcscd',lastupdate='$lastupdate' where row_id='$opacc_id'";
	}else{
		$edit="update opacc set price='$newprice',lastupdate='$lastupdate' where row_id='$opacc_id'";
	}	
	if(mysql_query($edit)){

		if($depart=="PHAR"){
			$edit1="update dphardep set date='$newtxdate' where date='$txdate' and hn='$hn'";
			mysql_query($edit1);
			$edit11="update ddrugrx set date='$newtxdate' where date='$txdate' and hn='$hn'";
			mysql_query($edit11);
			
			$edit2="update phardep set date='$newtxdate' where date='$txdate' and hn='$hn'";
			mysql_query($edit2);
			$edit22="update drugrx set date='$newtxdate' where date='$txdate' and hn='$hn'";
			mysql_query($edit22);
		}else{
			$edit1="update depart set date='$newtxdate' where date='$txdate' and hn='$hn' and detail='$detail'";
			mysql_query($edit1);
			
			$edit2="update patdata set date='$newtxdate' where date='$txdate' and hn='$hn' and detail='$detail'";
			mysql_query($edit2);			
		}	
		
		echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว');window.close();</script>";
	}else{
		echo "<script>alert('!!!ผิดพลาด...ไม่สามารถแก้ไขข้อมูลได้');window.location='cscdtype_c_edittxdate.php?depart=$depart&row_id=$opacc_idno';</script>";
	}
}
?>