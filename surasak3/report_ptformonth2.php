<?php
session_start();
include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 22px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
.txt{
	font-family: TH SarabunPSK;
	font-size: 16px;
}
.txt1 {	font-family: TH SarabunPSK;
	font-size: 20px;
}
#printable { display: block; }
@media print { 
	#non-printable { display: none; } 
	/*#printable { page-break-after:always; } */
	thead{
		display: table-header-group;
	}
} 
-->
</style>
<div id="non-printable">
	<form id="form1" name="form1" method="post" action="<?=$PHP_SELF;?>">
		<h1 style="text-align: center;">��§ҹ�ǴἹ��<u>��Ш���͹</u>(�͡�����Ҫ���)</h1>
		<input name="act" type="hidden" value="show" />
		<table width="100%" border="0" cellspacing="0" cellpadding="2">
			<tr>
				<td align="center">���͡��͹       
					<?php
					$thaimonthFull = array('01' => '���Ҥ�', '02' => '����Ҿѹ��', '03' => '�չҤ�', '04' => '����¹', 
					'05' => '����Ҥ�', '06' => '�Զع�¹', '07' => '�á�Ҥ�', '08' => '�ԧ�Ҥ�', 
					'09' => '�ѹ��¹', '10' => '���Ҥ�', '11' => '��Ȩԡ�¹', '12' => '�ѹ�Ҥ�');
					
					$selmon = isset($_POST['selmon']) ? $_POST['selmon'] : date('m');
					
					echo "<select name='selmon' size='1'  class='txt'>";
					for($i=1; $i <= count($thaimonthFull); $i++){
						
						$i = sprintf('%02d', $i);
						$selected = ( $selmon === $i ) ? 'selected="selected"' : '' ;
						echo "<option value='$i' $selected>".$thaimonthFull[$i]."</option>";
					}
					echo "</select>";
					?>
					�� 
					<?php
					$y=date("Y")+543;
					$date=date("Y")+543+5;
					$dates=range(2547,$date);
					echo "<select name='selyear' size='1' class='txt'>";
					foreach($dates as $i){
						?>
						<option value="<?=$i;?>" <? if($y==$i){ echo "selected"; }?>><?=$i;?></option>
						<?php
					}
					echo "</select>";
					?>        <span style="margin-left: 65px;">
					<input type="submit" value="���Ң�����" name="B1"  class="txt" />
					</span>
				</td>
			</tr>
			<tr>
				<td align="center"><a href="../nindex.htm">��Ѻ������ѡ</a>  || <a href="report_ptmonth2.php">��§ҹ�ǴἹ�µ����ǧ���� (�͡�����Ҫ���)</a></td>
			</tr>
		</table>
	</form>
</div> 
<?php
if($_POST["act"]=="show"){

	$selmon = trim($_POST["selmon"]);
	if($selmon=="01"){
		$showmon="���Ҥ�";
	}else if($selmon=="02"){
		$showmon="����Ҿѹ��";
	}else if($selmon=="03"){
		$showmon="�չҤ�";
	}else if($selmon=="04"){
		$showmon="����¹";
	}else if($selmon=="05"){
		$showmon="����Ҥ�";
	}else if($selmon=="06"){
		$showmon="�Զع�¹";
	}else if($selmon=="07"){
		$showmon="�á�Ҥ�";
	}else if($selmon=="08"){
		$showmon="�ԧ�Ҥ�";
	}else if($selmon=="09"){
		$showmon="�ѹ��¹";
	}else if($selmon=="10"){
		$showmon="���Ҥ�";
	}else if($selmon=="11"){
		$showmon="��Ȩԡ�¹";
	}else if($selmon=="12"){
		$showmon="�ѹ�Ҥ�";																				
	}
	
						
	$thyear = $_POST["selyear"];
	$ksyear = $_POST["selyear"]-543;
	
	// ��ǧ����
	// ��ª��ͼ��Ǵ
	$date_between = " AND `date` >= '$thyear-$selmon-01' AND `date` <= '$thyear-$selmon-31'";
	
	$sql = "SELECT `staf_massage` 
	FROM `depart` 
	WHERE `staf_massage` !='' 
	$date_between 
	GROUP BY `staf_massage` ";
	$query = mysql_query($sql);
	$num = mysql_num_rows($query);
	while( $row = mysql_fetch_array($query) ){
		$staf_massage = $row["staf_massage"];
		?>
		<div id="printable"> 
			<p align="center"><strong>��ª��ͼ�����Ѻ��ԡ�ùǴἹ��</strong></p>
			<div style="margin-left: 5%;"><strong>���;�ѡ�ҹ�Ǵ : </strong><?=$staf_massage;?></div>
			<div style="margin-left: 5%;"><strong>��Ш���͹ <?=$showmon;?> �.�. <?=$thyear;?></div>
			<table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
				<thead>
					<tr bgcolor="#FFCCCC">
						<th width="8%" align="center"><strong>�ӴѺ</strong></th>
						<th align="center" bgcolor="#FFCCCC"><strong>�ѹ/��͹/��</strong></th>
						<th align="center"><strong>HN</strong></th>
						<th align="center"><strong>���� - ���ʡ��</strong></th>
						<th align="center" bgcolor="#FFCCCC"><strong>��è�����</strong></th>
					</tr>
				</thead>
				<tbody>
				<?php
					
					/* Condition ����ǡѺ���� �������¹�� �.�. ������� mysql �ӹǳ�ѹ�����١��ͧ */
					$sql1 = "SELECT b.*, a.`code`
FROM `patdata` AS a, (

	SELECT *, DATE_FORMAT(`date`,'%H:%i:%s') AS `time`, 
	CONCAT((DATE_FORMAT(`date`,'%Y')-543), DATE_FORMAT(`date`, '-%m-%d')) AS `date2`, 
	DATE_FORMAT( CONCAT((DATE_FORMAT(`date`,'%Y')-543), DATE_FORMAT(`date`, '-%m-%d')) , '%w') AS `day_name` 
	FROM `depart` 
	WHERE `staf_massage` !='' 
	$date_between

) AS b 
WHERE b.`row_id` = a.`idno` 
AND a.`code` in (
	'58002' , '58003' ,'58004' ,'58002a','58002b','58002c','58005','58006','58007','58008','58101','58102','58130','58131','58201','58301','58301a'
) 
AND b.`staf_massage` = '$staf_massage'
AND a.`status` = 'Y'
ORDER BY b.`date` ASC";
				// echo "<pre>";
				//var_dump($sql1);
				// echo "<pre>";
				
				$result = mysql_query($sql1) or die( mysql_error() ); 
				$i = 0;
				while($rows = mysql_fetch_array($result)){
					
					// 0 is Sunday
					// 6 is Saturday
					// �������� �ѹ��� �֧ �ء�� �������㹪�ǧ�����Ҫ�������ҹ���� ���Ѻ
					// @todo �Կ������ջѭ������ͧ��������� 20 �ҷ� ����Կ��Ѻ�����鴹����ͧ��Ѻ���ҵ������
					$dayNum = (int) $rows['day_name'];
					if( ( $dayNum > 0 AND $dayNum < 6 ) AND ( $rows['time'] >= "08:20:00" AND $rows['time'] <= "16:20:00" ) ){
						continue;
					}
					
					$qdate = substr($rows["date"],0,10);
					list($yy,$mm,$dd) = explode("-",$qdate);
					$dateshow = "$dd/$mm/$yy";
					// $showtime = substr($rows["date"],11,8);
					
					$i++;
					
					?>
					<tr>
						<td align="center"><?=$i;?></td>
						<td align="center"><?=$dateshow;?></td>
						<td><?=$rows["hn"];?></td>
						<td align="left"><?=$rows["ptname"];?></td>
						<?php
						$sql3="select * from drugrx where date like '$qdate%' and hn='".$rows["hn"]."'";
						$query3=mysql_query($sql3);
						$num3=mysql_num_rows($query3);
						if(empty($num3)){
							$showdrug="";
						}else{
							$item = mysql_fetch_assoc($query3);
							$showdrug = $item['tradname'];
						}
						?>
						<td align="center"><?=$showdrug;?></td>
					</tr>
					<?php
				}
				?>
				</tbody>
			</table>
			<br />
			<table width="100%" border="0" cellspacing="0" cellpadding="2">
				<tr>
					<td width="15%" align="right"><strong>���ѹ�֡</strong></td>
					<td width="32%" valign="bottom"><div style="width:150px;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></div></td>
					<td width="18%" align="right"><strong>��Ǩ�١��ͧ</strong></td>
					<td width="35%" align="right">&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td valign="bottom"><div style="width:150px;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></div></td>
					<td align="right">�.�.</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="left"><div style="margin-left:10px;">(���Ծ�&nbsp;&nbsp;&nbsp;&nbsp; �Թ�ѹ)</div></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="left"><div style="margin-left:25px;">ᾷ��Ἱ��</div></td>
				</tr>
			</table>
		</div>
		<div style="page-break-after:always;"></div>
	<?php
	} // while
} // end if act show
?>

