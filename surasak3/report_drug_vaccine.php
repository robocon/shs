<?php

// @todo
// ������������ö㹡�� order ��ҧ� �� order ����ѹ ���� ��������� 

session_start();
include 'connect.php';
include 'Connections/all_function.php'; 
include 'templates/classic/header.php';

$thaimonthFull = array('01' => '���Ҥ�', '02' => '����Ҿѹ��', '03' => '�չҤ�', '04' => '����¹', 
'05' => '����Ҥ�', '06' => '�Զع�¹', '07' => '�á�Ҥ�', '08' => '�ԧ�Ҥ�', 
'09' => '�ѹ��¹', '10' => '���Ҥ�', '11' => '��Ȩԡ�¹', '12' => '�ѹ�Ҥ�');

$thShortMonth = array('01' => '�.�.', '02' => '�.�.', '03' => '��.�', '04' => '��.�.', '05' => '�.�.', '06' => '��.�.', 
'07' => '�.�.', '08' => '�.�.', '09' => '�.�.', '10' => '�.�.', '11' => '�.�.', '12' => '�.�.');
					
$showdate = date("Y-m");
$d =date('Y-m-d');
$dateN = explode("-",$d);
$mm = $dateN[0].'-'.$dateN[1];

$defMonth = empty($_POST['m_start']) ? date('m') : $_POST['m_start'];;
?>
<div id="no_print">
	<div>
		<a href="../nindex.htm">&lt;&lt;˹����ѡ�����SHS</a> | <a href="report_vaccine_appoint.php">��ª��͹Ѵ�մ�Ѥ�չ��</a>
	</div>
	<h3>������ª����硷��մ�Ѥ�չ</h3>
    <form method="post" action="report_drug_vaccine.php" name="FrmR">

		<select name="m_start">
			<?php
			foreach( $thaimonthFull as $key => $month ){
				$select = ( $key == $defMonth ) ? 'selected="selected"' : '' ;
				?>
				<option value="<?=$key;?>" <?=$select?>><?=$month;?></option>
				<?php
			}
			?>
		</select>
		<?php 
		$Y = date("Y") + 543;
		$date = date("Y") + 543 + 5;
		$dates = range(2547, $date);

		?>
		<select name="y_start">
			<?php
			foreach($dates as $i){
				?>
				<option value='<?=$i?>' <?php if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
				<?php
			}
			?>
		</select>
			
		<input  name="SubReoprt" type="submit" value="View Report" />
		<input type="hidden" name="show" value="report">
	</form>
</div>
<?php

$show = $_POST['show'];
if( $show === 'report' ){

	$monthCode = $_POST['m_start'];
	$printmonth = $thaimonthFull[$monthCode];

	$dateshow = $printmonth." ".$_POST['y_start'];
	$today = ($_POST['y_start']-543).'-'.$_POST['m_start'].'-'.$_POST['d_start'];

	$sql = "SELECT  * 
	FROM `opcard` AS a 
	INNER JOIN `tb_service` AS b ON b.`hn` = a.`hn` 
	INNER JOIN `vaccine` AS c ON c.`id_vac` = b.`id_vac` 
	WHERE  b.`date_ser` LIKE '$today%' 
	ORDER BY b.`date_ser` ASC ";
	
	$result = mysql_query($sql);
	$rows = mysql_num_rows($result);
	$n=1;

	?>
	<h3>��ª����硷������Ѻ��éմ�Ѥ�չ��Ш���͹<?=$printmonth;?> ��<?=$_POST['y_start'];?></h3>
	<table width="100%"  border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse" bordercolor="#000000">
		<tr align="center">
			<th>�ӴѺ</th>
			<th>�.�.�.</th>
			<th>hn</th>
			<th>���� - ʡ��</th>
			<th>����</th>
			<th width="20%">�������</th>
			<th>�Ѥ�չ</th>
			<th>������</th>
			<th>LotNo</th>
			<th>Exp.</th>
			<th>�Ѥ�չ</th>
			<th>������</th>
			<th>LotNo</th>
			<th>Exp.</th>
			<th>ᾷ��</th>
		</tr>
		<?php
		$r=0;
		if($rows){

			$ipv = 0;
			$dpt_hb = 0;
			$dpt_new = 0;
			$opv_new = 0;
			$hb = 0;

			while($row= mysql_fetch_array($result)){
				
				$r++;

				if( preg_match('/IPV/', $row['vac_name'], $matchs) > 0 ){
					$ipv++;
				}

				if( preg_match('/OPV/', $row['vac_name'], $matchs) > 0 ){
					$opv_new++;
				}

				if( preg_match('/DPT\+HB/', $row['vac_name'], $matchs) > 0 ){
					$dpt_hb++;
				}

				if( preg_match('/DPT/', $row['vac_name'], $matchs) > 0 ){
					$dpt_new++;
				}

				if( preg_match('/HB/', $row['vac_name'], $matchs) > 0 ){
					$hb++;
				}

				$name2 = '';
				
				if($row['vac_name']=="VAC+OPV"){
						
					$name1=substr($row['vac_name'],0,3);

					if($name1=="VAC"){ 
						$vac++; 
					}
					$name2=substr($row['vac_name'],4,3);

					if($name2=="OPV"){ 
						$opv++; 
					}

				}elseif($row['vac_name']=="DPT+OPV"){
					
					$name1=substr($row['vac_name'],0,3);

					if($name1=="DPT"){ 
						$dpt++; 
					}

					$name2=substr($row['vac_name'],4,3);

					if($name2=="OPV"){ 
						$opv++; 
					}

				}else{
					$name1=$row['vac_name'];  


					if($name1=="MMR"){ 
						$mmr++; 
					}elseif($name1=="JEV"){ 
						$jev++; 
					}elseif($name1=="TT"){ 
						$tt++; 
					}elseif($name1=="VEROLAB"){ 
						$vero++; 
					}elseif($name1=="HBV"){ 
						$hvb++; 
					}
				}
				
				$y = substr($row['date_ser'],0,4);
				$m = substr($row['date_ser'],5,2);
				$d = substr($row['date_ser'],8,2);

				$named=substr($row['name_doc'],6);
				$namedoc=trim($named);

				$y=$y+543;
				
				$printmonth = $thShortMonth[$m];
				$dateshow = $d." ".$printmonth." ".$y;
				?>
				<tr class="forntsarabun">
					<td align="right"><?=$n++; ?></td>
					<td><?=$dateshow;?></td>
					<td align="left"><?=$row['hn'];?></td>
					<td><?=$row['yot'].$row['name'].' '.$row['surname'];?></td>
					<td><?=calcage($row['dbirth']);?></td>
					<td><?=$row['address'].' '.$row['tambol'].' '.$row['ampur'].' '.$row['changwat'];?></td>
					<td align="left"><?= $name1;?></td>
					<td align="right"><?=$row['num'];?></td>
					<td align="left"><?=$row['lotno'];?></td>
					<td align="left"><?=$row['date_end'];?></td>
					<td align="left">
						<?php if ($row['lotno2']=='' && $row['date_end2']==''){ echo "&nbsp;"; }else{ echo $name2; }?>
					</td>
					<td align="right"><?php if ($row['lotno2']=='' && $row['date_end2']==''){ echo "&nbsp;"; }else{ echo $row['num']; }?></td>
					<td align="left"><?php if ($row['lotno2']=='' && $row['date_end2']==''){ echo "&nbsp;"; }else{ echo $row['lotno2']; }?></td>
					<td align="left"><?php if ($row['lotno2']=='' && $row['date_end2']==''){ echo "&nbsp;"; }else{ echo $row['date_end2']; }?></td>
					<td><?=$namedoc;?></td>
				</tr>
				<?php
			} // End while
		} else {
			echo "<tr>";
			echo "<td colspan='10' align=center class='forntsarabun'><font color=red>�ѧ�������¡��</font></td>";
			echo "</tr>";
		}
		?>
	</table>

	<h3>�ʹ����ͧ�Ѥ�չ���Ъ�Դ</h3>
	<table width="50%"  border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse" bordercolor="#000000">
		<tr align="right">
			<td bgcolor="#CCCCCC">�Ѥ�չ</td>
			<td>MMR</td>
			<td>JEV</td>
			<td>IPV</td>
			<td>DPT+HB</td>
			<td>OPV</td>
			<td>BCG</td>
			<td>DPT</td>
			<td>DT</td>
			<td>HB</td>
		</tr>
		<tr align="right">
			<td bgcolor="#CCCCCC">�ӹǹ����Ѻ��ԡ��</td>
			<td><?php if($mmr==''){ echo "0"; }else{ echo $mmr; }?></td>
			<td><?php if($jev){ echo $jev; }else{  echo "0"; }?></td>
			<td><?php if($ipv){ echo $ipv; }else{ echo "0"; }?></td>
			<td><?php if($dpt_hb){ echo $dpt_hb; }else{ echo "0";; }?></td>
			<td><?php if($opv_new){ echo $opv_new; }else{ echo "0"; }?></td>
			<td><?php if($bcg){ echo $bcg; }else{ echo "0"; }?></td>
			<td><?php if($dpt_new){ echo $dpt_new; }else{ echo "0"; }?></td>
			<td><?php if($dt){ echo $dt; }else{ echo "0"; }?></td>
			<td><?php if($hb){ echo $hb; }else{ echo "0"; }?></td>
		</tr>
	</table>
	<?php
}
include 'templates/classic/footer.php';