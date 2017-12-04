<?php
include("connect.inc");
?>
<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a><br>
สรุปผลการตรวจสุขภาพประจำปี (บริษัท)
<form action="<? $_SERVER['PHP_SELF']?>" method="post">
<?
$sql ="select * from chkcompany";
$rows=mysql_query($sql);
echo "บริษัท : <select name='comp'>";
while($result = mysql_fetch_array($rows)){
?>
<option value="<?=$result['code']?>"><?=$result['name']?></option>
<?
}
echo "</select>";

echo " ปี : <select name='year'>";
for($i=date("Y")+540;$i<date("Y")+545;$i++){
?>
<option value="<?php echo $i;?>" <?php if($i == date("Y")+543) echo "Selected"; ?> >
<?php echo $i;?></option>
<?php 
}
?>
</select>
<input type="submit" value=" ตกลง " name="confirm">
</form>

<?
if(isset($_POST['confirm'])){
	$query="SELECT  a.program,a.company,count(*) as dupicate FROM chkup_company as a WHERE a.company like '$comp%' and a.hn in (SELECT  hn FROM condxofyear_so as b where yearcheck='$year') GROUP BY a.program ORDER BY a.program";

    $rows2 = mysql_query($query);
	?>
	<table width="50%" border="0">
    	<tr bgcolor="#CCCCCC"><td align="center">#</td><td align="center">ชื่อบริษัท</td><td align="center">โปรแกรม</td><td align="center">จำนวน</td></tr>
    <?
    while($result2= mysql_fetch_array($rows2)){
		$k++;
	?>
		<tr bgcolor="#FFFFCC"><td align="center"><?=$k?></td><td><?=$result2['company']?></td><td><a href="sum_chkup2.php?id=<?=substr($result2['company'],0,3)?>&pro=<?=$result2['program']?>&yr=<?=$year?>" target="_blank"><?=$result2['program']?></a></td><td align="center"><?=$result2['dupicate']?></td></tr>
	<?
	}
	?>
    </table>
	<?
}
?>