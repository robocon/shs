<?php
	include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<style type="text/css">
<!--
.ppo {
	font-family:"Angsana New";
	font-size:20px;
}
-->
</style>
</head>
 
<body>

<a href ="../nindex.htm" >&lt;&lt; �����</a>&nbsp;&nbsp;<a href ="upd_labstatus.php" class="tet">[ HN ���� ]</a>


<?
if(isset($_POST['hn'])){
	$sql = "select * from resulthead where hn='".$_POST['hn']."' group by labnumber order by orderdate desc";
  	$rows = mysql_query($sql);
	echo "<table class='ppo' border='1' width='100%' align='center' cellpadding='0' cellspacing='0' style='border-collapse:collapse'><tr><td align='center'>HN</td><td align='center'>���� - ʡ��</td><td align='center'>Orderdate</td><td align='center'>ʶҹС�õ�Ǩ</td><td align='center'>���</td></tr>";
  	while($result = mysql_fetch_array($rows)){
	echo "<tr><td align='center'>".$result['hn']."</td><td align='center'>".$result['patientname']."</td><td align='center'>".$result['orderdate']."</td><td>&nbsp;".$result['clinicalinfo']."</td><td align='center'><a href='upd_labstatus.php?ids=".$result['labnumber']."' >���</a></td></tr>";
	}
	echo "</table>";
}
elseif(isset($_GET['ids'])){
	////*runno ��Ǩ�آ�Ҿ*/////////
	$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nPrefix=$row->prefix;
	////*runno ��Ǩ�آ�Ҿ*/////////
	$sql2 = "select * from resulthead where labnumber='".$_GET['ids']."'";
  	$rows2 = mysql_query($sql2);
	$result2 = mysql_fetch_array($rows2);
	?>
	<form id="form1" name="form1" method="post" action="upd_labstatus.php">
<table width="29%" border='0' align='center'>
  <tr>
    <td align="center">ʶҹ� : 
    <select  name='clinic'>
        <option value='<?=$result2['clinicalinfo']?>'><?=$result2['clinicalinfo']?></option>
        <option value='��Ǩ�آ�Ҿ��Шӻ�<?=$nPrefix?>'>��Ǩ�آ�Ҿ��Шӻ�<?=$nPrefix?></option>
		<option value='��Ǩ�آ�Ҿ��Шӻ�60'>��Ǩ�آ�Ҿ��Шӻ�60</option>
        <option value='��Ǩ�آ�Ҿ��Шӻ�59'>��Ǩ�آ�Ҿ��Шӻ�59</option>
        <option value='��Ǩ�آ�Ҿ��Шӻ�58'>��Ǩ�آ�Ҿ��Шӻ�58</option>
         <option value='��Ǩ�آ�Ҿ��ͧ7'>��Ǩ�آ�Ҿ��ͧ7</option>
 <option value='¡��ԡ'>¡��ԡ</option>

	</select>&nbsp;
    <input name='ids' type="hidden" value="<?=$_GET['ids']?>" />
    <input type="submit" name="upbtn" id="button" value="��ŧ" /></td>
    </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
</table>
</form>
	<?
}
elseif(isset($_POST['upbtn'])){
	$sql2 = "update resulthead set clinicalinfo= '".$_POST['clinic']."' where labnumber='".$_POST['ids']."'";
  	$result = mysql_query($sql2);
	if($result){
		echo "<br><center>��Ѻ��ا���������º��������</center>";
		echo "<meta http-equiv='refresh' content='3' />";
	}
}else{

	$send_hn = $_GET['send_hn'];

?>
<form id="form1" name="form1" method="post" action="upd_labstatus.php">

<table width="29%" border='0' align='center'>
  <tr>
    <td align="center">��Ѻ��اʶҹ���ͧLAB</td>
  </tr>
  <tr>
    <td align="center">HN : 
      <input name="hn" type="text" id="hn" size="10" value="<?=$send_hn;?>"/>&nbsp;<input type="submit" name="okbtn" id="button" value="��ŧ" /></td>
    </tr>
</table>
</form>
<?
}
?>
</body>
</html>