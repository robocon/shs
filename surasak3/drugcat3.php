<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="MyXls3.xls"');#ª×èÍä¿Åì
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
    	<td align="center">HospDrugCode</td>
        <td align="center">ProductCat</td>
        <td align="center">TMTID</td>
        <td align="center">SpecPrep</td>
        <td align="center">GenericName</td>
        <td align="center">TradeName</td>
        <td align="center">DSFCode</td>
        <td align="center">DosageForm</td>
        <td align="center">Strength</td>
        <td align="center">Content</td>
        <td align="center">Distributor</td>
        <td align="center">Manufacture</td>
        <td align="center">ISED</td>
        <td align="center">NDC24</td>
        <td align="center">Unitsize</td>
        <td align="center">UnitPrice</td>
        <td align="center">updateflag</td>
        <td align="center">Datechange</td>
        <td align="center">DateUpdate</td>
        <td align="center">DateEffective</td>
  </tr>
<?
include("connect.inc");
$sql = "select * from druglst where  (part = 'ddl' or part = 'ddy' or part = 'ddn')  order by drugcode asc";
$rows = mysql_query($sql);
while($result = mysql_fetch_array($rows)){
	$i++;
	
	$code=strval($result['code24']);
	//$code24=(string) floatval($code);
	
	$first = substr($result['drugcode'],0,1);
	$sec = substr($result['drugcode'],1,1);
	
	if(ord($sec)<48||ord($sec)>57){
		$dose = $first;
	}else{
		$dose = $first.$sec;
		
	}
	$product_category =$result['product_category'];
	if ($product_category==''){$product_category='1';}else{$product_category=$product_category;}; 
	
	
?>
    <tr>
           
            <td><?=$result['drugcode']?></td>
            <td><?=$product_category;?></td>
            <td><?=$result['tmt']?></td>
            <td><?=$result['specprep']?></td>
            <td><?=$result['genname']?></td>
			<td><?=$result['tradname']?></td>
            <td><?=$dose?></td>
            <td><?=$result['unit']?></td>
            <td><?=$result['strength']?></td>
            <td><?=$result['content']?></td>
            <td><?=$result['comname']?></td>
            <td><?=$result['manufac']?></td>
            <td><? if($result['part']=='DDL'){ echo "E";}elseif($result['part']=='DDY'||$result['part']=='DDN' ){echo "N";}else{ echo " ";}?></td>
            <td align="left"><?="c".$result['code24'];?></td>
            <td><? if(empty($result['unitsize'])){ echo "1";}else{ echo $result['unitsize'];}?></td>
            <td><?=$result['salepri']?></td>
            <td><? echo "E"; //$result['updateflag']; ?></td>
            <td><?=date("d-m-Y")?></td>
            <td><?=date("d-m-Y")?></td>
            <td><?=date("d-m-Y")?></td>
    </tr>
<?
}

	$query1 ="update druglst SET drugcatstatus ='E'  ";
		$result = mysql_query($query1) or die("Query failed,update druglsdrugcatstatust");
?>
</table>

</body>
</html>