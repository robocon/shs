<?
include("connect.inc");
	if($_POST['y_start']!=''){
	$date1=($_POST['y_start']);
	}else{
	$date1=(date("Y")+543);
	}
	
	?>
    
<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
<tr>
  <td rowspan="2" align="center" bgcolor="#00CCFF" class="forntsarabun">
    <p>โปรแกรม</p></td>
<td colspan="12" align="center" bgcolor="#00CCFF" class="forntsarabun">ระดับความรุนแรงทางคลินิก</td>
</tr>
<tr>
<?  for ($i='A'; $i<='I'; $i++) {  ?>
<td align="center" bgcolor="#00CCFF" class="forntsarabun"><?=$i;?></td>
<? }?>
</tr>
    
    <?

for($n=1;$n<=9;$n++){
	for ($i='A'; $i<='I'; $i++) { 


		$selectsql = "SELECT COUNT(*)as count FROM    ncr2556  WHERE nonconf_date  like '".$date1."%' and 
		risk$n='1' and clinic ='$i'  ";
		$result = mysql_query($selectsql);
		
}
}
	//	array_push($list01,$arr01[0]);
	while ($arr01= mysql_fetch_array($result)){
	
		
		//echo $arr01['count']."<BR>";
		?>
 <tr>
<td class="forntsarabun">1.Clinical Risk </td>
<td align="center" class="forntsarabun"><?=$arr01['count'];?></a></td>
</tr>
		<?
		
		
	}

?>

</table>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
<tr>
    <td>ncr</td>
    <td>risk1</td>
    <td>risk2</td>
    <td>risk3</td>
    <td>risk4</td>
    <td>risk5</td>
    <td>risk6</td>
    <td>risk7</td>
    <td>8</td>
    <td>9</td>
    <td>&nbsp;</td>
  </tr>
<?
$sql="SELECT ncr, risk1, risk2, risk3, risk4, risk5, risk6, risk7, risk8, risk9
FROM  `ncr2556` 
WHERE 1  AND  `nonconf_date` 
LIKE  '2556%' AND ( `risk1`  =1 OR  `risk2`  =1 OR  `risk3`  =1 OR  `risk4`  =1 OR  `risk5`  =1 OR  `risk6`  =1 OR  `risk7`  =1 OR  `risk8`  =1 OR  `risk9`  =1 )";
$query=mysql_query($sql);

while($arr=mysql_fetch_array($query)){
	
	
	$sum=$arr['risk1']+$arr['risk2']+$arr['risk3']+$arr['risk4']+$arr['risk5']+$arr['risk6']+$arr['risk7']+$arr['risk8']+$arr['risk9'];
	
	if($sum>1){
		$col="#CCFFFF";
	}else{
		$col="#FFFFFF";
	}
?>	
	
    
    
  <tr bgcolor="<?=$col;?>">
    <td><?=$arr['ncr'];?></td>
    <td><?=$arr['risk1'];?></td>
    <td><?=$arr['risk2'];?></td>
    <td><?=$arr['risk3'];?></td>
    <td><?=$arr['risk4'];?></td>
    <td><?=$arr['risk5'];?></td>
    <td><?=$arr['risk6'];?></td>
    <td><?=$arr['risk7'];?></td>
    <td><?=$arr['risk8'];?></td>
    <td><?=$arr['risk9'];?></td>
    <td><?=$sum;?></td>
  </tr>

<?
}


?>
</table>