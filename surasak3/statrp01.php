<?php 

if(isset($_POST["submit"])){
	include("connect.inc");

	$month_["01"] = "���Ҥ�";
	$month_["02"] = "����Ҿѹ��";
	$month_["03"] = "�չҤ�";
	$month_["04"] = "����¹";
	$month_["05"] = "����Ҥ�";
	$month_["06"] = "�Զع�¹";
	$month_["07"] = "�á�Ҥ�";
	$month_["08"] = "�ԧ�Ҥ�";
	$month_["09"] = "�ѹ��¹";
	$month_["10"] = "���Ҥ�";
	$month_["11"] = "��Ȩԡ�¹";
	$month_["12"] = "�ѹ�Ҥ�";

	if($_POST["day"] != "")
		$_POST["day"] = sprintf("%02d",$_POST["day"]);
	
	$sql = "CREATE TEMPORARY TABLE depart1 
	SELECT date, hn, diag, ptright
	FROM depart 
	WHERE date Like '".$_POST["year"]."-".$_POST["month"]."-".$_POST["day"]."%' 
	AND price > 0 
	and status = 'Y' ";
	$result  = Mysql_Query($sql);
	
	if($_POST["code"] == "58001")
		$where = " AND (code like '".$_POST["code"]."%' OR code like '58020%')  ";
	else
		if($_POST["code"] == "58002")
		$where = " AND code like '".$_POST["code"]."%'  ";
	else
		$where = " AND code = '".$_POST["code"]."'  ";

	$sql = "CREATE TEMPORARY TABLE patdata1 
	SELECT date, hn,amount   
	FROM patdata 
	WHERE date Like '".$_POST["year"]."-".$_POST["month"]."-".$_POST["day"]."%' 
	AND amount > 0 ".$where." ";
	$result2  = Mysql_Query($sql);

	$sql = "Select count(distinct hn) From patdata1 ";
	$result = Mysql_Query($sql);
	list($sum) = Mysql_fetch_row($result);

if($_POST["code"] == "11227"||$_POST["code"] == "11229"){
?>
<TABLE>
<TR>
	<TD colspan="3">�ӹǹ�����·���ҵ�Ǩ  <?php echo $_POST["day"],"/",$month_[$_POST["month"]],"/",$_POST["year"];?> ������ <?php echo $sum;?> ��</TD>
</TR>
<TR>
	<TD width="306">�ӹǹ�ä���������ҵ�Ǩ </TD>
	<TD width="52">����</TD>
	<TD width="45">�ش/���</TD>
</TR>
<?php 

$sql = "Select  a.diag, count(a.hn),b.amount From depart1 as a INNER JOIN patdata1 as b ON a.hn = b.hn AND a.date = b.date Group by a.diag Order by a.diag ASC ";
$result = Mysql_Query($sql);
$sum=0;
$sum2=0;
while(list($diag,$count,$amount) = Mysql_fetch_row($result)){
?>
<TR>
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $diag;?></TD>
	<TD><?php echo $count; $sum = $sum+$count;?></TD>
	<TD><? echo $amount; $sum2 = $sum2+$amount;?></TD>
</TR>
<?php 
}
?>

<TR>
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���</TD>
	<TD><?php echo $sum;?></TD>
	<TD><?php echo $sum2;?></TD>
</TR>

</TABLE>

<?php
}else{
?>
<TABLE>
	<TR>
		<TD colspan="2">�ӹǹ�����·���ҵ�Ǩ  <?php echo $_POST["day"],"/",$month_[$_POST["month"]],"/",$_POST["year"];?> ������ <?php echo $sum;?> ��</TD>
	</TR>
	<TR>
		<TD colspan="2">�ӹǹ�ä���������ҵ�Ǩ (����)</TD>
	</TR>
	<?php 
	$sql = "Select  a.diag, count(a.hn) 
	From depart1 as a 
	INNER JOIN patdata1 as b 
	ON a.hn = b.hn 
	AND a.date = b.date 
	Group by a.diag 
	Order by a.diag ASC ";
	$result = Mysql_Query($sql);
	$sum=0;
	while(list($diag,$count) = Mysql_fetch_row($result)){
	?>
	<TR>
		<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $diag;?></TD>
		<TD><?php echo $count; $sum = $sum+$count;?></TD>
	</TR>
	<?php 
	}
	?>
	<TR>
		<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���</TD>
		<TD><?php echo $sum;?></TD>
	</TR>
</TABLE>
<?php
}

	$sql = "Select a.`ptright`, COUNT(a.`ptright`) AS rows
	FROM `depart1` as a 
	INNER JOIN `patdata1` as b ON a.`hn` = b.`hn` 
	AND a.`date` = b.`date` 
	GROUP BY a.`ptright`";
	$query = mysql_query($sql);
	$count = mysql_num_rows($query);
	if( $count > 0 ){
		
		$new_lists = array();
		while( $item = mysql_fetch_assoc($query) ){
			
			$key_code = substr($item['ptright'], 0, 3);
			if( !$new_lists[$key_code] ){
				$new_lists[$key_code] = array(
					'name' => $item['ptright'],
					'count' => (int)$item['rows']
				);
			}else{
				$new_lists[$key_code]['count'] += (int)$item['rows'];
			}
		}
		
		?>
		<table>
			<thead>
				<tr>
					<th>�¡����Է��</th>
					<th>�ӹǹ</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$total = 0;
			foreach( $new_lists as $key => $val ){
				$total += $val['count'];
				?>
				<tr>
					<td><?=$val['name'];?></td>
					<td><?=$val['count'];?></td>
				</tr>
				<?php
			}
			?>
				<tr>
					<td>���������</td>
					<td><?=$total;?></td>
				</tr>
			</tbody>
		</table>
		<?php
		
	}

}
 include("unconnect.inc");
 
 ?>