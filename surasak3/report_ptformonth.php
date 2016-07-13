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
	<form id="form1" name="form1" method="post" action="<? $PHP_SELF;?>">
		<input name="act" type="hidden" value="show" />
		<table width="100%" border="0" cellspacing="0" cellpadding="2">
			<tr>
				<td align="center">ประจำเดือน       
					<?php
					$thaimonthFull=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม", "พฤศจิกายน","ธันวาคม");
					echo "<select name='selmon' size='1'  class='txt'>";
					for($i=0;$i<count($thaimonthFull);$i++){
						echo "<option value='".($i+1)."' ";
						if(date("m")==$i+1){
							echo " selected";
						}
						echo ">".$thaimonthFull[$i]."</option>";
					}
					echo "</select>";
					?>
					ปี 
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
					<input type="submit" value="ค้นหาข้อมูล" name="B1"  class="txt" />
					</span>
			  </td>
		  </tr>
			<tr>
				<td align="center">
					<a href="../nindex.htm">กลับเมนูหลัก</a> || <a href="report_ptmonth.php">รายงานนวดแผนไทยตามห้วงเวลา</a> || <a href="report_ptformonth25.php">รายงานนวดแผนไทยตามห้วงเวลา(หลัง25)</a>
				</td>
			</tr>
		</table>
	</form>
</div> 
<?php
if($_POST["act"]=="show"){
	$selmon = $_POST["selmon"];
	if($selmon=="01"){
		$mon ="มกราคม";
		$selmon="01";
	}else if($selmon=="02"){
		$mon ="กุมภาพันธ์";
		$selmon="02";
	}else if($selmon=="03"){
		$mon ="มีนาคม";
		$selmon="03";
	}else if($selmon=="04"){
		$mon ="เมษายน";
		$selmon="04";
	}else if($selmon=="05"){
		$mon ="พฤษภาคม";
		$selmon="05";
	}else if($selmon=="06"){
		$mon ="มิถุนายน";
		$selmon="06";
	}else if($selmon=="07"){
		$mon ="กรกฎาคม";
		$selmon="07";
	}else if($selmon=="08"){
		$mon ="สิงหาคม";
		$selmon="08";
	}else if($selmon=="09"){
		$mon ="กันยายน";
		$selmon="09";
	}else if($selmon=="10"){
		$mon ="ตุลาคม";
		$selmon="10";
	}else if($selmon=="11"){
		$mon ="พฤศจิกายน";
		$selmon="11";
	}else if($selmon=="12"){
		$mon ="ธันวาคม";
		$selmon="12";
	}
	$thyear = $_POST["selyear"];
	$ksyear = $_POST["selyear"]-543;
	
	// $end_date = date("t", mktime(0,0,0,$selmon,1,$ksyear));

	// ห้วงเวลา
	// รายชื่อผู้นวด
	$sql = "SELECT distinct(staf_massage) 
	FROM depart 
	WHERE staf_massage !='' 
	AND date BETWEEN '$thyear-$selmon-01 00:00:00' AND '$thyear-$selmon-25 23:59:59'";
	
	$query = mysql_query($sql);
	$num = mysql_num_rows($query);
	while($row = mysql_fetch_array($query)){
		
		$staf_massage=$row["staf_massage"];
		?>
		<div id="printable"> 
			<p align="center"><strong>รายชื่อผู้มารับบริการนวดแผนไทย</strong></p>
			<div style="margin-left: 5%;"><strong>ชื่อพนักงานนวด : </strong><?=$staf_massage;?></div>
			<div style="margin-left: 5%;"><strong>ประจำเดือน : </strong><?=$mon;?> พ.ศ. <?=$thyear;?></div>
			<table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
				<thead>
					<tr bgcolor="#FFCCCC">
						<th width="8%" align="center"><strong>ลำดับ</strong></th>
						<th align="center" bgcolor="#FFCCCC"><strong>วัน/เดือน/ปี</strong></th>
						<th align="center"><strong>HN</strong></th>
						<th align="center"><strong>ชื่อ - นามสกุล</strong></th>
						<th align="center" bgcolor="#FFCCCC"><strong>การจ่ายยา</strong></th>
					</tr>
				</thead>
				<tbody>
				<?php
					$sql1 = "SELECT b.date, b.ptname, b.hn, b.an, b.depart, b.detail, b.price, b.paid, b.row_id, b.accno, b.tvn ,b.staf_massage,b.diag,b.ptright,b.idname 
					FROM `patdata` AS a, 
					depart AS b 
					WHERE b.row_id = a.idno 
					AND ( a.code IN ('58002' , '58003' ,'58004' ,'58002a','58002b','58002c','58005','58006','58007','58008','58101','58102','58130','58131','58201','58301','58301a')) 
					AND (
						b.date between '$thyear-$selmon-01 00:00:00' 
						AND 
						'$thyear-$selmon-25 23:59:59'
					) 
					AND  a.status = 'Y' 
					AND a.price > 0 
					AND staf_massage = '$staf_massage' 
					GROUP BY b.date ,b.hn,a.code";	
				$result = mysql_query($sql1) or die("Query failed ".$sql1.""); 
				$i=0;
				while($rows=mysql_fetch_array($result)){
					$i++;
					$showdate=substr($rows["date"],0,10);
					list($yy,$mm,$dd)=explode("-",$showdate);
					$dateshow="$dd/$mm/$yy";
					$showtime=substr($rows["date"],11,8);
					?>
					<tr>
						<td align="center"><?=$i;?></td>
						<td align="center"><?=$dateshow;?></td>
						<td><?=$rows["hn"];?></td>
						<td align="left"><?=$rows["ptname"];?></td>
						<?php
						$sql3="select * from drugrx where date like '$showdate%' and hn='".$rows["hn"]."'";
						$query3=mysql_query($sql3);
						$num3=mysql_num_rows($query3);
						if(empty($num3)){
							$showdrug="";
						}else{
							$showdrug="";
						}
						?>
						<td align="center"><?=$showdrug;?></td>
					</tr>
					<?php
					/*
					if( $i % 32 === 0 ){
						?> <tr><td><div style="page-break-after:always;"></div></td></tr> <?php
					}
					*/
				}
				?>
				</tbody>
			</table>
			<br />
			<table width="100%" border="0" cellspacing="0" cellpadding="2">
				<tr>
					<td width="15%" align="right"><strong>ผู้บันทึก</strong></td>
					<td width="32%" valign="bottom"><div style="width:150px;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></div></td>
					<td width="18%" align="right"><strong>ตรวจถูกต้อง</strong></td>
					<td width="35%" align="right">&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td valign="bottom"><div style="width:150px;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></div></td>
					<td align="right">น.ส.</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="left"><div style="margin-left:10px;">(ศิริพร&nbsp;&nbsp;&nbsp;&nbsp; อินปัน)</div></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="left"><div style="margin-left:25px;">แพทย์แผนไทย</div></td>
				</tr>
			</table>
		</div>
		<div style="page-break-after:always;"></div>
	<?php
	} // while
} // end if act show
?>

