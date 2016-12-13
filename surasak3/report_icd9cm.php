<?php
session_start();
include 'includes/connect.php';
include 'includes/functions.php';
?>
<style type="text/css">
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
@media print{
	#no_print{display:none;}
}
.theBlocktoPrint {
	background-color: #000; 
	color: #FFF; 
} 
</style>
<div id="no_print" >
	<table>
		<tr>
			<td><a href="../nindex.htm" class="forntsarabun">��Ѻ������ѡ</a></td>
			<td> | <a href="icd10top10.php" class="forntsarabun" target="_blank">��§ҹ������ TOP10</a></td>
		</tr>
	</table>
	<form name="f1" action="" method="post" onsubmit="JavaScript:return fncSubmit();">
		<table width="600"  border="0" cellpadding="3" cellspacing="3">
			
			<tr class="forntsarabun">
				<td>
					<fieldset>
						<legend>�����</legend>
						��͹: 
						<?php
						$default_month = date('m');
						$month_val = input_post('month', $default_month);
						echo getMonthList('month', $month_val, 'forntsarabun');
						?>

						��: 
						<?php
						$default_year = date('Y');
						$year_range = range(2004, $default_year);
						$year_val = input_post('y_start', $default_year);
						echo getYearList('y_start', $thai = true, $year_val, $year_range, 'forntsarabun');
						?>
					</fieldset>
				</td>
				<td>
					<fieldset>
						<legend>���֧</legend>
						��͹: 
						<?php
						$month_val = input_post('end_month', $default_month);
						echo getMonthList('end_month', $month_val, 'forntsarabun');
						?>

						��: 
						<?php
						$year_val = input_post('end_year', $default_year);
						echo getYearList('end_year', $thai = true, $year_val, $year_range, 'forntsarabun');
						?>
					</fieldset>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="left">
					<input name="submit" type="submit" class="forntsarabun" value="����"/>
				</td>
			</tr>
		</table>
	</form>
	<hr>
</div>

<?php
if(isset($_POST['submit'])){
	$month = input_post('month');
	$date1 = ad_to_bc(input_post('y_start'));

	$end_month = input_post('end_month');
	$end_year = ad_to_bc(input_post('end_year'));
	?>
	<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td>
				<h3 class="forntsarabun">ICD9CM �����¹͡ ����� <?=$def_fullm_th[$month];?> <?=$date1;?> ���֧ <?=$def_fullm_th[$end_month];?> <?=$end_year;?></h3>
			</td>
		</tr>
		<tr>
			<td valign="top">
				<?php
				// $month = $_POST['month'];
				// $date1 = $_POST['y_start'];

				// $dateshow = "ICD9CM �����¹͡ ��Шӻ� ".$date1.' ��͹ '.$def_fullm_th[$month];
				?>
				<p></p>
				<?php
				// print "<font class='forntsarabun' >  $dateshow </font><br />
				// <br />";
				$strsql = "SELECT `icd9cm`, COUNT(`icd9cm`) AS `Cdetail` 
				FROM `opday` 
				WHERE 
				( `thidate` >= '$date1-$month-01' AND `thidate` <= '$end_year-$end_month-31' ) 
				AND (`icd9cm` != null OR `icd9cm` !='') 
				GROUP BY `icd9cm` 
				ORDER BY `Cdetail` DESC";
				// dump($strsql);
				$result = mysql_query($strsql);
				$rows = mysql_num_rows($result);
				?>
				<table border="1" cellspacing="0" cellpadding="0" class="forntsarabun" style="border-collapse:collapse" bordercolor="#000000">
					<tr bgcolor=#ffff99 onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
						<td>�ӴѺ</td>
						<td align="center"><span class="forntsarabun1">icd9</span></td>
						<td align="center">�����ä</td>
						<td>�ӹǹ</td>
					</tr>
					<?php
					if($rows>0){

						while($dbarr=mysql_fetch_array ($result)) {
							$n++;

							$icd9cm=$dbarr['icd9cm'];
							$Cdetail=$dbarr['Cdetail'];

							$sqlname="SELECT detail FROM `icd9cm` WHERE  code ='$icd9cm' ";
							$resultname=mysql_query($sqlname);
							$dbarrname=mysql_fetch_array ($resultname);
							?>
							<tr onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
								<td align="center"><?=$n;?></td>
								<td><a href='#'><?=$icd9cm;?></a></td>
								<td><?=$dbarrname['detail'];?></td>
								<td align="center"><?=$dbarr['Cdetail'];?></td>
							</tr>
							<?php
							$sum+=$dbarr['Cdetail'];
						}
						?>
						<tr>
							<td colspan="3" align="center" bgcolor="#99FFCC">���</td>
							<td align="center" bgcolor="#99FFCC"><?=$sum;?></td>
						</tr>
						<?php
					}else{ 
						echo "<tr><td colspan='3' align='center'>��辺��¡��</td></tr>";
					}
					?>
				</table>
			</td>
			<td valign="top">
				<?php
				$n = 0;
				// $date1 = $_POST['y_start'];
				// $dateshow = "ICD9CM ������� ��Шӻ� ".$_POST['y_start'].' ��͹ '.$def_fullm_th[$month];;
				// print "<font class='forntsarabun' >  $dateshow </font><br />
				// <br />";
				$strsql = "SELECT `icd9cm`, COUNT(`icd9cm`) AS `Cdetail` 
				FROM ipicd9cm 
				WHERE 
				( `admdate` >= '$date1-$month-01' AND `admdate` <= '$end_year-$end_month-31' ) 
				AND (`icd9cm` != null OR `icd9cm` != '' OR `icd9cm` != '-') 
				GROUP BY `icd9cm` 
				ORDER BY `Cdetail` DESC";
				// dump($strsql);
				$result = mysql_query($strsql);
				$rows = mysql_num_rows($result);
				?>
	<table border="1" cellspacing="0" cellpadding="0" class="forntsarabun" style="border-collapse:collapse" bordercolor="#000000">
	<tr bgcolor=#ffff99 onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
	<td>�ӴѺ</td>
	<td align="center"><span class="forntsarabun1">icd9</span></td>
	<td align="center">�����ä</td>
	<td>�ӹǹ</td>
	</tr>
	<?php
	if($rows > 0){
		while($dbarr2=mysql_fetch_array ($result)) {
			$n++;

			$icd9cm=$dbarr2['icd9cm'];
			$Cdetail=$dbarr2['Cdetail'];

			$sqlname="SELECT detail FROM `icd9cm` WHERE  code ='$icd9cm' ";
			$resultname=mysql_query($sqlname);
			$dbarrname=mysql_fetch_array ($resultname);
			?>
			<tr onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
				<td align="center"><?=$n;?></td>
				<td><a href='#'><?=$icd9cm;?></a></td>
				<td><?=$dbarrname['detail'];?></td>
				<td align="center"><?=$dbarr2['Cdetail'];?></td>
			</tr>
			<?php
			$sum1+=$dbarr2['Cdetail'];
		}
		?>
		<tr>
			<td colspan="3" align="center" bgcolor="#99FFCC">���</td>
			<td align="center" bgcolor="#99FFCC"><?=$sum1;?></td>
		</tr>
		<?php
	}else{ 
		echo "<tr><td colspan='3' align='center'>��辺��¡��</td></tr>";
	}
	?>
	</table>    
	</td>
	</tr>
	</table>
	<?php
} 
?>