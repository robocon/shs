<?php 
session_start(); 
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
	<title>ŧ�������� �ͺ���Ǩ63</title>
	<link type="text/css" href="chk_style.css" rel="stylesheet" />
</head>
<body>
	<form name="frmbill" method="post" action="chk_opacc">
		<table width="50%" border="0" align="center" class="fontsara">
			<tr>
				<td colspan="3" align="center">&nbsp;</td>
			</tr>
			<tr>
				<td align="right" width="15%">�к� HN</td>
				<td width="15%"><input type="text" name="Chkhn" value="<?=$_POST['Chkhn'];?>" class="fontsara" /></td>
				<td width="20%"><input type="submit" name="submit" value=" ���� " class="fontsara"><a target=_self  href='../nindex.htm' class="fontsara"> &larr;�����</a> </td>
			</tr>
		</table>
	</form>

<BR />
<hr />
<BR />

<?php

if(isset($_POST['Chkhn'])){
	include("connect.inc");

	$strsql="SELECT *, CONCAT(`yot`,`name`,' ',`surname`) as ptname 
	FROM `opcardchk` 
	WHERE  HN = '".$_POST['Chkhn']."' 
	and part='�ͺ���Ǩ62'";
	$query=mysql_query($strsql) or die (mysql_error());
	$Row=mysql_num_rows($query);

	if($Row ==0){
		echo "<div align='center' class='fontsara'>!!! ��辺 HN  $_POST[Chkhn]!! </div>";	
	}else{

		$arr=mysql_fetch_array($query);

		?>
		<form name="form1" action="" method="post">
			<table width="50%" border="0" align="center" cellpadding="2" cellspacing="2" class="fontsara">
				<tr>
					<td width="20%" align="right" valign="top">HN:</td>
					<td width="26%">
						<strong><?=$arr['HN'];?></strong>
					</td>
					<td>����-ʡ��: 
						<strong><?=$arr['name'].' '.$arr['surname'];?></strong>
					</td>
				</tr>
				<tr>
					<td align="right" valign="top">�ӴѺ���:</td>
					<td>
						<strong><?=$arr['exam_no'];?></strong>
					</td>
					<td>
						�Ţ��Шӵ���ͺ: <strong><?=$arr['pid'];?></strong>
					</td>
				</tr>
				<tr>
					<td align="right" valign="top">�Ţ�����</td>
					<td colspan="2">
						<input name="billno" type="text" class="fontsara" id="billno" value="" />
					</td>
				</tr>
				<tr>
					<td colspan="3" align="center">
						<input type="hidden" name="hn" value="<?=$arr['HN'];?>">
						<input type="submit" name="Submit" value=" �ѹ�֡������ "  class="fontsara" />
						<!--<a target=_self  href='../backoffice/index.php'>&larr; �����</a>--><br>
					</td>
				</tr>
			</table>
		</form>
		<? 
	} 
	include("unconnect.inc");
}

if(isset($_POST['Submit'])){

	include("connect.inc");	
	$Thidate2 =(date("Y")+543).date("-m-d H:i:s");
	$depart = "OTHER";

	$detail = "��Һ�ԡ�õ�Ǩ�آ�Ҿ���Ǩ";
	$price =880;
	$paid  =880;
	$idname='�ҧ�ǧ��� �㨻ԧ';

	$credit="�Թʴ";

	$sql = "INSERT INTO `opacc` ( `date` , `txdate` , `hn` , `depart` , `detail` , `price` , `paid` , `idname` , `credit` , `ptright` , `credit_detail` , `billno`)
	VALUES ('$Thidate2', '$Thidate2', '".$_POST['hn']."', '$depart', '$detail', '$price', '$paid', '$idname',  '$credit', 'R01 �Թʴ', '', '".$_POST['billno']."');";
	$result = mysql_query($sql)or die("Query failed,INSERT opacc ");

	if($result){

		echo "<div align=\"center\" class=\"fontsara1\">�ѹ�֡���������º��������</div>";
		echo"<meta http-equiv='refresh' content='1;url=chk_opacc.php'>";
		//echo "<div align=\"center\" class=\"fontsara1\"><a href='chk_labslip4bc.php?labno=$labno&hn=$_POST[hn]&ptname=$_POST[name]' target='_blank'>�����ʵԡ���� Barcode</a></div>";
		?>
		<!--<script>
		window.open('chk_labslip4bc.php?labno=<?//=$labno;?>&hn=<?//=$_POST['hn'];?>&ptname=<?//=$_POST['name'];?>',null,'height=500,width=850,scrollbars=1');
		</script>-->
		<?
	}
	//echo "<BR>$query";
}
 include("unconnect.inc");
?>

</body>
</html>