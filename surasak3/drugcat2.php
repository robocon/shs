<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="MyXls.xls"');#ª×èÍä¿Åì
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.font1 {
	font-family: AngsanaUPC;
}
-->
</style>
</head>

<body>
<table border="1" cellpadding="0" cellspacing="0" class="font1" style="border-collapse:collapse">
<tr>
    	<td align="center">#</td>
    	<td align="center">HospDrugCode</td>
        <td align="center">GenericName</td>
        <td align="center">TradeName</td>
        <td align="center">DSFCode</td>
        <td align="center">Dosage Form</td>
        <td align="center">Strength</td>
        <td align="center">Content</td>
        <td align="center">UnitPrice</td>
        <td align="center">Distributor</td>
        <td align="center">Manufacture</td>
        <td align="center">ISED</td>
        <td align="center">NDC24</td>
        <td align="center">Packsize</td>
        <td align="center">PackPrice</td>
        <td align="center">updateflag</td>
        <td align="center">Datechange</td>
        <td align="center">DateEffective</td>
</tr>
<?
include("connect.inc");
$sql = "select * from druglst where drugcode='1IMDU-C' or drugcode='6LOTE'";
$rows = mysql_query($sql);
while($result = mysql_fetch_array($rows)){
	$i++;
	
	$first = substr($result['drugcode'],0,1);
	$sec = substr($result['drugcode'],1,1);
	
	if(ord($sec)<48||ord($sec)>57){
		$dose = $first;
	}else{
		$dose = $first.$sec;
	}
?>
    <tr>
            <td><?=$i?></td>
            <td><?=$result['drugcode']?></td>
            <td><?=$result['genname']?></td>
			<td><?=$result['tradname']?></td>
            <td><?=$dose?></td>
            <td><?=$result['unit']?></td>
            <td><?=$result['strength']?></td>
            <td><?=$result['content']?></td>
            <td><?=$result['salepri']?></td>
            <td><?=$result['comname']?></td>
            <td><?=$result['manufac']?></td>
            <td><? if($result['part']=='DDL'){ echo "E";}elseif($result['part']=='DDY'||$result['part']=='DDN' ){echo "N";}else{ echo " ";}?></td>
            <td><?=$result['code24']?></td>
            <td><?=$result['packsize']?></td>
            <td><?=$result['packprice']?></td>
            <td><?=$result['updateflag']?></td>
            <td><?=date("d-m-Y")?></td>
            <td><?=date("d-m-Y")?></td>
    </tr>
<?
}
?>
</table>

</body>
</html>