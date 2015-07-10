<?
session_start();
include("../Connections/connect.inc.php"); 

if(isset($_POST['okok'])){ 

		$sql = "update booking set status='อนุมัติ',comment='".$_POST['room']."',officer_con='".$_SESSION['sOfficer']."' where row_id= '".$_GET['row_id']."'  ";
		mysql_query($sql);
?>
		<script>
        	window.location.href="booking_confirm.php?code=<?=$_POST['code']?>";
        </script>
<?
}else{
	$sql2 = "select * from booking where row_id='".$_GET['row_id']."' "; 
	$row2 = mysql_query($sql2);
	$result2= mysql_fetch_array($row2);
?>
<form id="form1" name="form1" method="post" action="<? $_SERVER['PHP_SELF']?>">
<table width="289" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse; font-family: 'Angsana New'; font-size: 18px;">
<tr>
	<td colspan="2" align="center" bgcolor="#00CCFF">ยืนยันการจองเตียง</td>
</tr>
<tr>
	<td colspan="2" bgcolor="#FFFFCC">ชื่อ-สกุล : <?=$result2['ptname']?></td>
  </tr>
  <tr>
	<td colspan="2" bgcolor="#FFFFCC">เตียง/ห้อง : <?=$result2['bed']?></td>
  </tr>
<tr>
	<td width="84" bgcolor="#FFFFCC">หมายเลขเตียง :</td>
	<td width="199" bgcolor="#FFFFCC"><input name="room" type="text" id="room" /></td>
</tr>
<tr>
	<td colspan="2" align="center" bgcolor="#FFFFCC">
    <input type="hidden" name="code" value="<?=$_GET['code']?>" />
    <input name="okok" type="submit" value=" ตกลง "/></td>
</tr>
</table>
<form>
<?
}
?>
