<?php
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
	<form name="f1" action="" method="post" onsubmit="JavaScript:return fncSubmit();">
		<table width="402"  border="0" cellpadding="3" cellspacing="3">
			<tr>
				<td colspan="2" align="left">
					<a href="../nindex.htm" class="forntsarabun">กลับเมนูหลัก</a>
				</td>
			</tr>
			<tr class="forntsarabun">
				<td width="30%">
					เดือน: 
					<select name="month" id="month" class="forntsarabun">
					<?php
					foreach ($def_month_th as $key => $month) {
						?>
						<option value="<?=$key;?>"><?=$month;?></option>
						<?php
					}
					?>
					</select>
				</td>
				<td>
					ปี: 
					<?php
					$Y = date("Y")+543;
					$date = date("Y")+543+5;
					$dates = range(2547, $date);
					echo "<select name='y_start' class='forntsarabun'>";
					foreach($dates as $i){
						?>
						<option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
						<?php
					}
					echo "<select>";
				?>
					
				</td>
			</tr>
			<tr>
				<td colspan="2" align="left">
					<input name="submit" type="submit" class="forntsarabun" value="ค้นหา"/>
				</td>
			</tr>
		</table>
	</form>
	<hr />
</div>

<?php
if(isset($_POST['submit'])){
	?>
	<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td valign="top">
				<?php
				$month = $_POST['month'];
				$date1 = $_POST['y_start'];

				$dateshow = "ICD9CM ผู้ป่วยนอก ประจำปี ".$_POST['y_start'].' เดือน '.$def_fullm_th[$month];
				print "<font class='forntsarabun' >  $dateshow </font><br />
				<br />";
				$strsql = "SELECT  icd9cm, COUNT(icd9cm) AS Cdetail
				FROM opday
				WHERE thidate
				LIKE '$date1-$month%' and (icd9cm !=null or icd9cm !='')
				GROUP BY icd9cm
				ORDER BY Cdetail DESC";
				$result = mysql_query($strsql);
				$rows = mysql_num_rows($result);
				?>
				<table border="1" cellspacing="0" cellpadding="0" class="forntsarabun" style="border-collapse:collapse" bordercolor="#000000">
					<tr bgcolor=#ffff99 onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
						<td>ลำดับ</td>
						<td align="center"><span class="forntsarabun1">icd9</span></td>
						<td align="center">ชื่อโรค</td>
						<td>จำนวน</td>
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
							<td colspan="3" align="center" bgcolor="#99FFCC">รวม</td>
							<td align="center" bgcolor="#99FFCC"><?=$sum;?></td>
						</tr>
						<?php
					}else{ 
						echo "<tr><td colspan='3' align='center'>ไม่พบรายการ</td></tr>";
					}
					?>
				</table>
			</td>
			<td valign="top">
				<?php
				$n = 0;
				$date1 = $_POST['y_start'];
				$dateshow = "ICD9CM ผู้ป่วยใน ประจำปี ".$_POST['y_start'].' เดือน '.$def_fullm_th[$month];;
				print "<font class='forntsarabun' >  $dateshow </font><br />
				<br />";
				$strsql = "SELECT  icd9cm, COUNT(icd9cm) AS Cdetail
				FROM ipicd9cm
				WHERE admdate
				LIKE '$date1%' and (icd9cm !=null or icd9cm !='' or  icd9cm !='-')
				GROUP BY icd9cm
				ORDER BY Cdetail DESC";
				$result = mysql_query($strsql);
				$rows = mysql_num_rows($result);
				?>
	<table border="1" cellspacing="0" cellpadding="0" class="forntsarabun" style="border-collapse:collapse" bordercolor="#000000">
	<tr bgcolor=#ffff99 onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
	<td>ลำดับ</td>
	<td align="center"><span class="forntsarabun1">icd9</span></td>
	<td align="center">ชื่อโรค</td>
	<td>จำนวน</td>
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
			<td colspan="3" align="center" bgcolor="#99FFCC">รวม</td>
			<td align="center" bgcolor="#99FFCC"><?=$sum1;?></td>
		</tr>
		<?php
	}else{ 
		echo "<tr><td colspan='3' align='center'>ไม่พบรายการ</td></tr>";
	}
	?>
	</table>    
	</td>
	</tr>
	</table>
	<?php
} 
?>