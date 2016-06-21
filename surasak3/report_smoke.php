<?php
if( !function_exists('session_start') ){ session_start(); }

if( !function_exists('dump') ){
	function dump($str){
		echo "<pre>";
		var_dump($str);
		echo "</pre>";
	}
}

// ajax
$action = ( isset($_POST['action']) ) ? trim($_POST['action']) : false;
$ajax = ( isset($_POST['ajax']) ) ? trim($_POST['ajax']) : false;
if( $action === 'show_user' ){

	include 'includes/connect.php';

	$code = $_POST['icd_code'];
	$year_select = $_POST['year_select'];
	$title = $_POST['title'];
	$ciga = $_POST['ciga'];
	$cigaval = $_POST['cigaval'];

	$test_icd = strpos($code, '|');
	
	if( $test_icd > 0 ){
		$codes = explode('|', $code);
		$icd_lists = array();
		foreach( $codes as $key => $icd ){
			$icd_lists[] = "`icd10` LIKE '$icd%'";
		}
		$icd_where = 'AND ('.implode(' OR ', $icd_lists).') ';

	}else{
		$icd_where = "AND `icd10` LIKE '$code%' ";
	}

	// if( $ciga === 'cigarette' ){
		$ciga_txt = "AND a.`$ciga` = '$cigaval' ";
	// }

	$sql = "SELECT a.`thidate`, a.`hn`, a.`ptname`, a.`cigarette`, a.`cigok`, b.`icd10` 
	FROM  `opd` AS a
	LEFT JOIN  `opday` AS b ON b.`thdatehn` = a.`thdatehn`
	WHERE a.`thidate` LIKE  '$year_select%' 
	$icd_where 
	$ciga_txt 
	";
	// dump($sql);
	$query = mysql_query($sql);
	$rows = mysql_num_rows($query);
	if( $rows > 0 ){
		?>
		<br>
		<h3 style="margin: 0;"><?=iconv("UTF-8","TIS-620",$title);?></h3>
		<table border="1" align="left" cellpadding="3" cellspacing="0" bordercolor="#000000">
			<thead>
				<tr>
					<th>#</th>
					<th>HN</th>
					<th>ชื่อสกุล</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$i = 1;
			while ( $item = mysql_fetch_assoc($query) ) {
			?>
				<tr>
					<td><?=$i;?></td>
					<td><?=$item['hn'];?></td>
					<td><?=$item['ptname'];?></td>
				</tr>
			<?php
				$i++;
			}
			?>
			</tbody>
		</table>
		<?php
	}
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
body,td,th,button{
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.show_user{
	cursor: pointer;
	text-decoration: none;
}
.show_user:hover{
	text-decoration: underline;
}
@media print{
	.not-show{
		display: none;
	}
}

-->
</style></head>
<body>
<?php
include("connect.inc");
?>
<a href ="../nindex.htm" class="not-show">&lt;&lt; ไปเมนู</a></p>
<?php
$def_year = (date('Y') + 543);
$year_select = ( isset($_POST['year_select']) ) ? trim($_POST['year_select']) : $def_year ;
?>
<div class="not-show">
	<div>
		<h3>เลือกการแสดงผลตามปี</h3>
	</div>
	<form action="report_smoke.php" method="post">
		<div>
			<label for="year_select">เลือกปี: </label>
			<input type="text" id="year_select" name="year_select" value="<?=$year_select;?>">
		</div>
		<div>
			<button type="submit">แสดงผล</button>
			<input type="hidden" name="show" value="item">
		</div>
	</form>
</div>
<?php
$show = ( isset($_POST['show']) ) ? trim($_POST['show']) : false ;
if( $show === 'item' ){
	?>
	<h3>รายงานการเลิกบุหรี่ในโรคเรื้อรังแบ่งตาม ICD10 ปี<?=$year_select;?></h3>
	<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td width="30%">
			<?php

			$sql = "DROP TEMPORARY TABLE IF EXISTS `cigarette_tmp`;";
			mysql_query($sql) or die ( mysql_error() );

			$sql = "CREATE TEMPORARY TABLE `cigarette_tmp`
			SELECT `hn`,`thdatehn`,`icd10`
			FROM  `opday` 
			WHERE `thidate` LIKE '$year_select%'
			AND `icd10` != ''";
			mysql_query($sql) or die ( mysql_error() );


			// @readme
			// Statement ตัวเดิมมีปัญหาคือข้อมูลไม่ใช่ตัวล่าสุด เช็กได้จาก Select thidate เพื่อดูวันที่ได้

			// $sql1="SELECT `cigarette`, `cigok`
			// FROM `opd` as a inner join opday as b on a.hn=b.hn
			// WHERE b.`icd10` like 'J44%' AND b.`thidate` like '$year_select%' group by b.hn";

			$sql = "SELECT a.`thidate`, a.`hn` , a.`cigarette` , a.`cigok` , b.`icd10` 
			FROM  `opd` AS a
			LEFT JOIN  `cigarette_tmp` AS b ON b.`thdatehn` = a.`thdatehn`
			WHERE b.`icd10` LIKE  'J44%' 
			AND a.`thidate` LIKE  '$year_select%'";
			$query1 = mysql_query($sql) or die ( mysql_error() );
			$num1 = mysql_num_rows($query1);
			
			$cigarette0 = 0;
			$cigarette1 = 0;
			$cigarette2 = 0;
			$cigok0 = 0;
			$cigok1 = 0;
			
			while($rows1=mysql_fetch_array($query1)){
				if($rows1["cigarette"]=="" || $rows1["cigarette"]=="0"){  //ไม่สูบ
					$cigarette0++;
				}else if($rows1["cigarette"]=="1"){  //สูบ
					$cigarette1++;
					if( $rows1["cigok"]=="0" OR empty($rows1["cigok"]) ){  //ไม่อยากเลิก
						$cigok0++;
					}else if($rows1["cigok"]=="1"){  //อยากเลิก
						$cigok1++;
					}
				}else if($rows1["cigarette"]=="2"){  //เคยสูบ
					$cigarette2++;
				}
			}
			?>
			<table width="80%" border="1" align="left" cellpadding="3" cellspacing="0" bordercolor="#000000">
			<tr>
				<td colspan="2" align="center" bgcolor="#CCCCCC"><strong>COPD (J44)</strong></td>
			</tr>
			<tr>
				<td><strong>ทั้งหมด</strong></td>
				<td align="right"><?=$num1;?></td>
			</tr>
			<tr>
				<td width="38%"><strong>1. ไม่สูบบุหรี่</strong></td>
				<td width="62%" align="right"><?=$cigarette0;?></td>
			</tr>
			<tr>
				<td><strong>2. เคยสูบบุหรี่</strong></td>
				<td align="right"><?=$cigarette2;?></td>
			</tr>
			<tr>
				<td><strong>3. สูบบุหรี่</strong></td>
				<td align="right">
					<div class="show_user" data-icd="J44" data-year="<?=$year_select;?>" data-title="COPD (J44)" data-ciga="cigarette" data-cigaval="1">
						<?=$cigarette1;?>
					</div>
				</td>
			</tr>
			<tr>
				<td><strong>&nbsp;&nbsp;3.1 อยากเลิก</strong></td>
				<td align="right"><?=$cigok1;?></td>
			</tr>
			<tr>
				<td><strong>&nbsp;&nbsp;3.2 ไม่อยากเลิก</strong></td>
				<td align="right"><?=$cigok0;?></td>
			</tr>
			</table>        </td>
		<td width="30%">
			<?php

			
			// $sql2="SELECT `cigarette`, `cigok`
			// FROM `opd` as a inner join opday as b on a.hn=b.hn
			// WHERE (b.`icd10` like 'A15%' OR b.`icd10` like 'A16%')  AND b.`thidate` like '$year_select%' group by b.hn";
			
			$sql = "SELECT a.`cigarette` , a.`cigok` 
			FROM  `opd` AS a
			LEFT JOIN  `cigarette_tmp` AS b ON b.`thdatehn` = a.`thdatehn`
			WHERE ( b.`icd10` LIKE 'A15%' OR b.`icd10` LIKE 'A16%' ) 
			AND a.`thidate` LIKE  '$year_select%'";

			$query2=mysql_query($sql) or die ("Query Error");
			$num2=mysql_num_rows($query2);
			$cigarette0=0;
			$cigarette1=0;
			$cigarette2=0;
			$cigok0=0;
			$cigok1=0;
			
			while($rows2=mysql_fetch_array($query2)){
				if($rows2["cigarette"]=="" || $rows2["cigarette"]=="0"){  //ไม่สูบ
					$cigarette0++;
				}else if($rows2["cigarette"]=="1"){  //สูบ
					$cigarette1++;
					if( $rows2["cigok"]=="0" OR empty($rows2["cigok"]) ){  //ไม่อยากเลิก
						$cigok0++;
					}else if($rows2["cigok"]=="1"){  //อยากเลิก
						$cigok1++;
					}
				}else if($rows2["cigarette"]=="2"){  //เคยสูบ
					$cigarette2++;
				}
			}
			?>
			<table width="80%" border="1" align="left" cellpadding="3" cellspacing="0" bordercolor="#000000">
			<tr>
				<td colspan="2" align="center" bgcolor="#CCCCCC"><strong>TB (A15, A16)</strong></td>
			</tr>
			<tr>
				<td><strong>ทั้งหมด</strong></td>
				<td align="right"><?=$num2;?></td>
			</tr>
			<tr>
				<td width="38%"><strong>1. ไม่สูบบุหรี่</strong></td>
				<td width="62%" align="right"><?=$cigarette0;?></td>
			</tr>
			<tr>
				<td><strong>2. เคยสูบบุหรี่</strong></td>
				<td align="right"><?=$cigarette2;?></td>
			</tr>
			<tr>
				<td><strong>3. สูบบุหรี่</strong></td>
				<td align="right"><?=$cigarette1;?></td>
			</tr>
			<tr>
				<td><strong>&nbsp;&nbsp;3.1 อยากเลิก</strong></td>
				<td align="right"><?=$cigok1;?></td>
			</tr>
			<tr>
				<td><strong>&nbsp;&nbsp;3.2 ไม่อยากเลิก</strong></td>
				<td align="right"><?=$cigok0;?></td>
			</tr>
			</table>    </td>
		<td width="30%">
			<?php
			// $sql3="SELECT `cigarette`, `cigok`
			// FROM `opd` as a inner join opday as b on a.hn=b.hn
			// WHERE (b.`icd10` like 'I10%' OR b.`icd10` like 'I251%')  AND b.`thidate` like '$year_select%' group by b.hn";
			//echo $sql2;

			$sql = "SELECT a.`cigarette` , a.`cigok` 
			FROM  `opd` AS a
			LEFT JOIN  `cigarette_tmp` AS b ON b.`thdatehn` = a.`thdatehn`
			WHERE ( b.`icd10` LIKE 'I10%' OR b.`icd10` LIKE 'I251%' ) 
			AND a.`thidate` LIKE  '$year_select%'";

			$query3=mysql_query($sql) or die ( mysql_error() );
			$num3=mysql_num_rows($query3);
			$cigarette0=0;
			$cigarette1=0;
			$cigarette2=0;
			$cigok0=0;
			$cigok1=0;
			
			while($rows3=mysql_fetch_array($query3)){
				if($rows3["cigarette"]=="" || $rows3["cigarette"]=="0"){  //ไม่สูบ
					$cigarette0++;
				}else if($rows3["cigarette"]=="1"){  //สูบ
					$cigarette1++;
					if($rows3["cigok"]=="0" OR empty($rows3["cigok"]) ){  //ไม่อยากเลิก
						$cigok0++;
					}else if($rows3["cigok"]=="1"){  //อยากเลิก
						$cigok1++;
					}
				}else if($rows3["cigarette"]=="2"){  //เคยสูบ
					$cigarette2++;
				}
			}
			?>
			<table width="80%" border="1" align="left" cellpadding="3" cellspacing="0" bordercolor="#000000">
			<tr>
				<td colspan="2" align="center" bgcolor="#CCCCCC"><strong>หัวใจ, HT, CAD (I10, I251)</strong></td>
			</tr>
			<tr>
				<td><strong>ทั้งหมด</strong></td>
				<td align="right"><?=$num3;?></td>
			</tr>
			<tr>
				<td width="38%"><strong>1. ไม่สูบบุหรี่</strong></td>
				<td width="62%" align="right"><?=$cigarette0;?></td>
			</tr>
			<tr>
				<td><strong>2. เคยสูบบุหรี่</strong></td>
				<td align="right"><?=$cigarette2;?></td>
			</tr>
			<tr>
				<td><strong>3. สูบบุหรี่</strong></td>
				<td align="right"><?=$cigarette1;?></td>
			</tr>
			<tr>
				<td><strong>&nbsp;&nbsp;3.1 อยากเลิก</strong></td>
				<td align="right">
					<div class="show_user" data-icd="I10|I251" data-year="<?=$year_select;?>" data-title="หัวใจ, HT, CAD (I10, I251)" data-ciga="cigok" data-cigaval="1">
						<?=$cigok1;?>
					</div>
				</td>
			</tr>
			<tr>
				<td><strong>&nbsp;&nbsp;3.2 ไม่อยากเลิก</strong></td>
				<td align="right"><?=$cigok0;?></td>
			</tr>
			</table>    </td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>
			<?php

			// $sql4="SELECT `cigarette`, `cigok`
			// FROM `opd` as a inner join opday as b on a.hn=b.hn
			// WHERE (b.`icd10` like 'I61%' OR b.`icd10` like 'I63%' OR b.`icd10` like 'I64%' OR b.`icd10` like 'I69%') AND b.`thidate` like '$year_select%' group by b.hn";
			$sql = "SELECT a.`cigarette` , a.`cigok` 
			FROM  `opd` AS a
			LEFT JOIN  `cigarette_tmp` AS b ON b.`thdatehn` = a.`thdatehn`
			WHERE (b.`icd10` LIKE 'I61%' OR b.`icd10` LIKE 'I63%' OR b.`icd10` LIKE 'I64%' OR b.`icd10` LIKE 'I69%') 
			AND a.`thidate` LIKE  '$year_select%'";
			$query4=mysql_query($sql) or die ( mysql_error() );
			$num4=mysql_num_rows($query4);
			$cigarette0=0;
			$cigarette1=0;
			$cigarette2=0;
			$cigok0=0;
			$cigok1=0;
			
			while($rows4=mysql_fetch_array($query4)){
				if($rows4["cigarette"]=="" || $rows4["cigarette"]=="0"){  //ไม่สูบ
					$cigarette0++;
				}else if($rows4["cigarette"]=="1"){  //สูบ
					$cigarette1++;
					if($rows4["cigok"]=="0" OR empty($rows4["cigok"]) ){  //ไม่อยากเลิก
						$cigok0++;
					}else if($rows4["cigok"]=="1"){  //อยากเลิก
						$cigok1++;
					}
				}else if($rows4["cigarette"]=="2"){  //เคยสูบ
					$cigarette2++;
				}
			}
			?>
			<table width="80%" border="1" align="left" cellpadding="3" cellspacing="0" bordercolor="#000000">
			<tr>
				<td colspan="2" align="center" bgcolor="#CCCCCC"><strong>สมอง Stroke (I61, I63, I64, I69)</strong></td>
			</tr>
			<tr>
				<td><strong>ทั้งหมด</strong></td>
				<td align="right"><?=$num4;?></td>
			</tr>
			<tr>
				<td width="38%"><strong>1. ไม่สูบบุหรี่</strong></td>
				<td width="62%" align="right"><?=$cigarette0;?></td>
			</tr>
			<tr>
				<td><strong>2. เคยสูบบุหรี่</strong></td>
				<td align="right"><?=$cigarette2;?></td>
			</tr>
			<tr>
				<td><strong>3. สูบบุหรี่</strong></td>
				<td align="right"><?=$cigarette1;?></td>
			</tr>
			<tr>
				<td><strong>&nbsp;&nbsp;3.1 อยากเลิก</strong></td>
				<td align="right">
					<div class="show_user" data-icd="I61|I63|I64|I69" data-year="<?=$year_select;?>" data-title="สมอง Stroke (I61, I63, I64, I69)" data-ciga="cigok" data-cigaval="1">
						<?=$cigok1;?>
					</div>
				</td>
			</tr>
			<tr>
				<td><strong>&nbsp;&nbsp;3.2 ไม่อยากเลิก</strong></td>
				<td align="right"><?=$cigok0;?></td>
			</tr>
			</table>        </td>
		<td width="30%">
			<?php
			// $sql5="SELECT `cigarette`, `cigok` 
			// FROM `opd` as a inner join opday as b on a.hn=b.hn
			// WHERE (b.`icd10` like 'E10%' OR b.`icd10` like 'E11%' OR b.`icd10` like 'E14%')  AND b.`thidate` like '$year_select%' group by b.hn";
			//echo $sql2;
			$sql = "SELECT a.`cigarette` , a.`cigok` 
			FROM  `opd` AS a
			LEFT JOIN  `cigarette_tmp` AS b ON b.`thdatehn` = a.`thdatehn`
			WHERE (b.`icd10` LIKE 'E10%' OR b.`icd10` LIKE 'E11%' OR b.`icd10` LIKE 'E14%') 
			AND a.`thidate` LIKE  '$year_select%'";
			$query5=mysql_query($sql) or die ( mysql_error() );
			$num5=mysql_num_rows($query5);
			$cigarette0=0;
			$cigarette1=0;
			$cigarette2=0;
			$cigok0=0;
			$cigok1=0;
			
			while($rows5=mysql_fetch_array($query5)){
				if($rows5["cigarette"]=="" || $rows5["cigarette"]=="0"){  //ไม่สูบ
					$cigarette0++;
				}else if($rows5["cigarette"]=="1"){  //สูบ
					$cigarette1++;
					if($rows5["cigok"]=="0" OR empty($rows5["cigok"]) ){  //ไม่อยากเลิก
						$cigok0++;
					}else if($rows5["cigok"]=="1"){  //อยากเลิก
						$cigok1++;
					}
				}else if($rows5["cigarette"]=="2"){  //เคยสูบ
					$cigarette2++;
				}
			}
			?>
			<table width="80%" border="1" align="left" cellpadding="3" cellspacing="0" bordercolor="#000000">
			<tr>
				<td colspan="2" align="center" bgcolor="#CCCCCC"><strong>เบาหวาน (E10, E11, E14)</strong></td>
			</tr>
			<tr>
				<td><strong>ทั้งหมด</strong></td>
				<td align="right"><?=$num5;?></td>
			</tr>
			<tr>
				<td width="38%"><strong>1. ไม่สูบบุหรี่</strong></td>
				<td width="62%" align="right"><?=$cigarette0;?></td>
			</tr>
			<tr>
				<td><strong>2. เคยสูบบุหรี่</strong></td>
				<td align="right"><?=$cigarette2;?></td>
			</tr>
			<tr>
				<td><strong>3. สูบบุหรี่</strong></td>
				<td align="right"><?=$cigarette1;?></td>
			</tr>
			<tr>
				<td><strong>&nbsp;&nbsp;3.1 อยากเลิก</strong></td>
				<td align="right">
					<div class="show_user" data-icd="E10|E11|E14" data-year="<?=$year_select;?>" data-title="เบาหวาน (E10, E11, E14)" data-ciga="cigok" data-cigaval="1">
						<?=$cigok1;?>
					</div>
				</td>
			</tr>
			<tr>
				<td><strong>&nbsp;&nbsp;3.2 ไม่อยากเลิก</strong></td>
				<td align="right"><?=$cigok0;?></td>
			</tr>
			</table>    
		</td>
		<td>
			<?php
			// $sql6="SELECT `cigarette`, `cigok` 
			// FROM `opd` as a inner join opday as b on a.hn=b.hn
			// WHERE (b.`icd10` like 'F10%' OR b.`icd10` like 'F20%' OR b.`icd10` like 'F32%' OR b.`icd10` like 'F41%')  AND b.`thidate` like '$year_select%' group by b.hn";
			// //echo $sql2;
			$sql = "SELECT a.`cigarette` , a.`cigok` 
			FROM  `opd` AS a
			LEFT JOIN  `cigarette_tmp` AS b ON b.`thdatehn` = a.`thdatehn`
			WHERE (b.`icd10` LIKE 'E10%' OR b.`icd10` LIKE 'E11%' OR b.`icd10` LIKE 'E14%') 
			AND a.`thidate` LIKE  '$year_select%'";
			$query6=mysql_query($sql)or die ( mysql_error() );
			$num6=mysql_num_rows($query6);
			$cigarette0=0;
			$cigarette1=0;
			$cigarette2=0;
			$cigok0=0;
			$cigok1=0;
			
			while($rows6=mysql_fetch_array($query6)){
				if($rows6["cigarette"]=="" || $rows6["cigarette"]=="0"){  //ไม่สูบ
					$cigarette0++;
				}else if($rows6["cigarette"]=="1"){  //สูบ
					$cigarette1++;
					if($rows6["cigok"]=="0" OR empty($rows6["cigok"]) ){  //ไม่อยากเลิก
						$cigok0++;
					}else if($rows6["cigok"]=="1"){  //อยากเลิก
						$cigok1++;
					}
				}else if($rows6["cigarette"]=="2"){  //เคยสูบ
					$cigarette2++;
				}
			}
			?>
			<table width="80%" border="1" align="left" cellpadding="3" cellspacing="0" bordercolor="#000000">
			<tr>
				<td colspan="2" align="center" bgcolor="#CCCCCC"><strong>จิตเวช (F10, F20, F32, F41)</strong></td>
			</tr>
			<tr>
				<td><strong>ทั้งหมด</strong></td>
				<td align="right"><?=$num6;?></td>
			</tr>
			<tr>
				<td width="38%"><strong>1. ไม่สูบบุหรี่</strong></td>
				<td width="62%" align="right"><?=$cigarette0;?></td>
			</tr>
			<tr>
				<td><strong>2. เคยสูบบุหรี่</strong></td>
				<td align="right"><?=$cigarette2;?></td>
			</tr>
			<tr>
				<td><strong>3. สูบบุหรี่</strong></td>
				<td align="right"><?=$cigarette1;?></td>
			</tr>
			<tr>
				<td><strong>&nbsp;&nbsp;3.1 อยากเลิก</strong></td>
				<td align="right">
					<div class="show_user" data-icd="F10|F20|F32|F41" data-year="<?=$year_select;?>" data-title="จิตเวช (F10, F20, F32, F41)" data-ciga="cigok" data-cigaval="1">
						<?=$cigok1;?>
					</div>
				</td>
			</tr>
			<tr>
				<td><strong>&nbsp;&nbsp;3.2 ไม่อยากเลิก</strong></td>
				<td align="right"><?=$cigok0;?></td>
			</tr>
			</table>    
		
		</td>
	</tr>
	</table>


	<div id="show_hn_list">
	</div>

	<script type="text/javascript" src="js/vendor/jquery-1.11.2.min.js"></script>
	<script type="text/javascript">
	$(function(){
		$(document).on('click', '.show_user', function(){
			
			$('#show_hn_list').html('กำลังโหลดข้อมูล');

			var icd_code = $(this).attr('data-icd');
			var year_select = $(this).attr('data-year');
			var title = $(this).attr('data-title');
			var ciga = $(this).attr('data-ciga');
			var cigaval = $(this).attr('data-cigaval');

			$.ajax({
				header: 'x-www-form-urlencoded',
				method: 'POST',
				dataType: 'html',
				url: 'report_smoke.php',
				data: {
					'action':'show_user', 
					'icd_code': icd_code, 
					'year_select': year_select, 
					'title': title,
					'ciga': ciga,
					'cigaval': cigaval
				},
				success: function(msg){
					// console.log(msg);

					$('#show_hn_list').html(msg);

				}
			});
		});
	});
	</script>
	<?php
}
?>
</body>
</html>
