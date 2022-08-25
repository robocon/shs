<?php
session_start();
include("configs/connections.php");
?>
<script language="javascript">
//window.opener.location.reload();
//window.opener.location.reload(true);
window.print();
	setTimeout(function(){ 
            window.close();
	}, 1000);
</script>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
	margin-top: 0px;
	padding:0px;	
}
.txtbig{
	font-size: 22px;
}

.txtbig1{
	font-size: 36px;
}

.txt{
	font-size: 16px;
}
-->
</style>
<div align="center">
<?php
$datey=date("Y")+543;
$datemd=date("d/m/");
$date="$datemd$datey";

$sql="select * from queue_opd where id = '".$_GET["getid"]."'";
//echo $sql;
$query=mysql_query($sql);
$rows=mysql_fetch_array($query);
$qno=substr($rows["queue_no"],1);
$wait=$qno-1;
$_SESSION["cHn"] = $rows["hn"];
?> 
<div align="center">
<table width="100%" border="0" cellpadding="5" cellspacing="0">
<!--  <tr>
    <td align="center"><img src="images/logo.png" width="52" height="79" /></td>
    </tr>
  <tr>-->
    <td><table width="90%" border="0" align="center" cellpadding="5" cellspacing="0">
      <tr>
        <td align="center" class="txtbig"><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี</strong></td>
      </tr>
      <tr>
        <td align="center">ตรวจโรคทั่วไป</td>
      </tr>
      <tr>
        <td align="center">HN : <?php echo $rows["hn"];?>&nbsp;&nbsp;&nbsp;&nbsp;VN : <?php echo $rows["vn"];?></td>
      </tr>
      <tr>
        <td align="center"><?php echo $rows["ptname"];?></td>
      </tr>
      <tr>
        <td align="center"><strong>ประเภท <?php echo $rows["typename"];?></strong></td>
      </tr>
      <tr>
        <td align="center">คิวซักประวัติ</td>
      </tr>
      <tr>
        <td align="center" class="txtbig1"><strong><?php echo $rows["queue_no"];?></strong></td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" class="txt">จำนวนคิวที่รอ <?php echo $wait; ?> คิว</td>
      </tr>
      <tr>
        <td align="center" class="txt"><?php echo $date." ".date("H:i:s");?></td>
      </tr>
    </table></td>
    </tr>
</table><br />
<?
include("opd/class_printvn_l.php");
$classopd = new printvn();
$classopd->input_hn($_SESSION["cHn"]);
$classopd->outputprint();
?>
</div>
