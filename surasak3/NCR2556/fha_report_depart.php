<? 
session_start();
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>�к���§ҹ�˵ء�ó��Ӥѭ/�غѵԡ�ó�/��������ʹ���ͧ</title>
    <!-- InstanceEndEditable -->
    <link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script>
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>
<body>
<?php include 'menu.php'; ?>

<div><!-- InstanceBeginEditable name="detail" -->
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
<div id="no_print" >
<form name="f1" action="" method="post">
<table  border="0" cellpadding="3" cellspacing="3">
  <tr class="forntsarabun">
    <td  align="right" bgcolor="#FFFFCC">&nbsp;</td>
    <td bgcolor="#FFFFCC" >����</td>
  </tr>
  <tr class="forntsarabun">
    <td width="64"  align="right">���͡��</td>
    <td width="387" >
<? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' class='forntsarabun'>";
				foreach($dates as $i){
 
				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?></td>
    </tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="����"/>&nbsp;&nbsp;
    <input type="button" name="button" value="�������§ҹ"  onClick="JavaScript:window.print();" class="forntsarabun"></td>
  </tr>
</table>
</form>
</div>
<?php
include("connect.inc");

if($_POST['y_start']!=''){
	$date1=($_POST['y_start']);
}else{
	$date1=(date("Y")+543);
}
?>
<h1 align="center" class="forntsarabun">��§ҹ��ػ������Ҵ����͹�ҧ��</h1>
	<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
<tr>
  <td rowspan="2" align="center" bgcolor="#00CCFF" class="forntsarabun">
    <p>Ἱ�</p></td>
<td colspan="13" align="center" bgcolor="#00CCFF" class="forntsarabun">�� 
  <?=($date1)?></td>
</tr>
<tr>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">�.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">�.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">��.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">��.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">�.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">��.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">�.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">�.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">�.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">�.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">�.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">�.�.</td>
  <td align="center" bgcolor="#00CCFF" class="forntsarabun">���</td>
</tr>
<?php
$sql = "SELECT `code` AS `newdepart`  
FROM `departments` 
WHERE `report_drug` = 1 ";
$query = mysql_query($sql);
while( $arruntil = mysql_fetch_assoc($query) ){
	
	$sqlname="SELECT name  FROM `departments` WHERE code='".$arruntil['newdepart']."'  ";
	$queryname=mysql_query($sqlname);
	$arrname=mysql_fetch_assoc($queryname)
	?>
	<tr>
	<td class="forntsarabun"><?=$arrname['name']?></td>
	<?php 
	$sum = 0;
	$sum2 = 0;
	for($n=1; $n<=12; $n++){
		if($n<10){
			$m = "0".$n;
		} else {
			$m = $n;
		}

		$selectsql = "SELECT COUNT(*)as count 
		FROM drug_fail_2 
		WHERE depart ='".$arruntil['newdepart']."' 
		AND fha_date LIKE '".$date1."-".$m."-%'";
		$result = mysql_query($selectsql);
		$arr01 = mysql_fetch_array($result);
		if ($arr01['count']!=0){
			?>
			<td align="center" class="forntsarabun"><a href="detail_fha_report_progarm.php?y=<?=$date1;?>&m=<?=$m;?>&depart=<?=$arruntil['newdepart']?>" target="_blank"><?=$arr01['count'];?></a></td>
			<?php 
		}else{
			?>
			<td align="center" class="forntsarabun"><?=$arr01['count'];?></td>
			<?php
		}
		$sum += $arr01['count'];
		$sum2 += $sum;
	}
  ?>
  <td align="center" class="forntsarabun"  width="7%"><?=$sum;?></td>
  </tr>

<? 

} 

?>
<tr>
  <td align="center"  class="forntsarabun">���</td>
  <? 

 	 for($n=1;$n<=12;$n++){
		if($n<10){
			$m = "0".$n;
		}
		else $m = $n;
		
		$selectsql = "SELECT COUNT(*)as count  FROM  drug_fail_2  WHERE fha_date  like '".$date1."-".$m."-%' "; 	
		$result = mysql_query($selectsql);
		$arr01 = mysql_fetch_array($result);	
		$sum2=0;
		for($a=0;$a<=11;$a++){
		$sum2+=$arr01[$a];
  		}
		$sumall+=$sum2;
  ?>
  
<td  align="center" bgcolor="#FFFFCC"  class="forntsarabun"><?=$sum2;?></td>
  
  <? 
	 } 
  ?>
  <td align="center" bgcolor="#FFFFCC" class="forntsarabun"><strong><?=$sumall;?></strong></td>
  </tr>
</table>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>