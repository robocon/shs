<?php 
include 'bootstrap.php';

$action = input_post('action');


if ( $action === false ) {
	
	$defDate = ( date('Y') + 543 ).date('-m');
	$date = input_post('dateSelect', $defDate);
	?>
	<div>
		<a href="../nindex.htm">&lt;&lt;&nbsp;������ѡ����� SHS</a>
	</div>
	<div>
		<h3>�к��������������㹡�����Ѻ��</h3>
	</div>
	<form action="drugtimer.php" method="post">
		<div>
			<label for="dateSelect">
				��-��͹
			</label>
			<input type="text" id="dateSelect" name="dateSelect" value="<?=$date;?>">
		</div>
		<div>
			<button type="submit">�ʴ���</button>
			<input type="hidden" name="action" value="show">
		</div>
	</form>
	<?php
} else if ( $action === 'show' ) {
	
	$thaimonthFull = array('01' => '���Ҥ�', '02' => '����Ҿѹ��', '03' => '�չҤ�', '04' => '����¹', 
	'05' => '����Ҥ�', '06' => '�Զع�¹', '07' => '�á�Ҥ�', '08' => '�ԧ�Ҥ�', 
	'09' => '�ѹ��¹', '10' => '���Ҥ�', '11' => '��Ȩԡ�¹', '12' => '�ѹ�Ҥ�');
	
	DB::load();
	$dateSelect = input_post('dateSelect');
	list($yName, $mName) = explode('-', $dateSelect);
	$sql = "
	SELECT `date`, `tvn`, `pharin`, `pharout`, 
	TIMEDIFF(`pharout`, `pharin`) AS `phartime`, 
	TIME_TO_SEC(TIMEDIFF(`pharout`, `pharin`)) AS `timediff`, 
	SUBSTRING(`ptright`, 1, 3) AS `ptcode`
	FROM `dphardep` 
	WHERE `date` LIKE '$dateSelect%' 
	AND ( `pharin` IS NOT NULL AND `pharout` IS NOT NULL ) 
	AND `dr_cancle` IS NULL
	AND ( `tvn` != '' AND `tvn` REGEXP '[[:digit:]]+' );
	";
	$items = DB::select($sql);
	
	// ������Ф�ͺ���� 08:30
	$sol8 = 0;
	$sol9 = 0;
	$solTime8 = 0;
	$solid8Time = 0;
	$solid9Time = 0;
	$solMaxTime8 = 0;
	$solMaxTime9 = 0;
	
	// ������Ф�ͺ���� 09:00
	$sol8_2 = 0;
	$sol9_2 = 0;
	$solTime8_2 = 0;
	$solid8Time_2 = 0;
	$solid9Time_2 = 0;
	$solMaxTime8_2 = 0;
	$solMaxTime9_2 = 0;
	
	
	// �����͹����� 08:30
	$user8 = 0;
	$user9 = 0;
	$userTime8 = 0;
	$user8Time = 0;
	$user9Time = 0;
	$userMaxTime8 = 0;
	$userMaxTime9 = 0;
	
	// �����͹����� 09:00
	$user8_2 = 0;
	$user9_2 = 0;
	$userTime8_2 = 0;
	$user8Time_2 = 0;
	$user9Time_2 = 0;
	$userMaxTime8_2 = 0;
	$userMaxTime9_2 = 0;
	
	$allMax8 = 0;
	$allMax9 = 0;
	
	$allMax8_2 = 0;
	$allMax9_2 = 0;
	
	$time9Over30 = 0;
	$time11Over30 = 0;
	
	foreach( $items as $key => $item ){
		
		// �¡����Է��
		// ����繷�����Ф�ͺ����
		if( $item['ptcode'] === 'R03' ){
			
			// 08:30 �֧ 12:30
			if( $item['pharin'] >= "08:30" && $item['pharin'] <= "12:30" ){
				if( $item['pharin'] >= "08:30" && $item['pharin'] <= "10:30" ){
					
					$sol8++;
					$solid8Time += $item['timediff'];
					$solMaxTime8 = ( $solMaxTime8 > $item['timediff'] ) ? $solMaxTime8 : $item['timediff'] ;
					
				} elseif( $item['pharin'] >= "10:31" && $item['pharin'] <= "12:30" ) {
					
					$sol9++;
					$solid9Time += $item['timediff'];
					$solMaxTime9 = ( $solMaxTime9 > $item['timediff'] ) ? $solMaxTime9 : $item['timediff'] ;
					
				}
				$solTime8 += $item['timediff'];
			}
			
			// 09:00 �֧ 13:00
			if( $item['pharin'] >= "09:00" && $item['pharin'] <= "13:00" ){
				if( $item['pharin'] >= "09:00" && $item['pharin'] <= "11:00" ){
					
					$sol8_2++;
					$solid8Time_2 += $item['timediff'];
					$solMaxTime8_2 = ( $solMaxTime8_2 > $item['timediff'] ) ? $solMaxTime8_2 : $item['timediff'] ;
					
				} elseif( $item['pharin'] >= "11:01" && $item['pharin'] <= "13:00" ) {
					$sol9_2++;
					$solid9Time_2 += $item['timediff'];
					$solMaxTime9_2 = ( $solMaxTime9_2 > $item['timediff'] ) ? $solMaxTime9_2 : $item['timediff'] ;
				}
				$solTime8_2 += $item['timediff'];
			}
				
		}else{ // �����͹�����
			
			// 08:30 �֧ 12:30
			if( $item['pharin'] >= "08:30" && $item['pharin'] <= "12:30" ){
				if( $item['pharin'] >= "08:30:00" && $item['pharin'] <= "10:30" ){
					
					$user8++;
					$user8Time += $item['timediff'];
					$userMaxTime8 = ( $userMaxTime8 > $item['timediff'] ) ? $userMaxTime8 : $item['timediff'] ;
					
				} elseif( $item['pharin'] >= "10:31" && $item['pharin'] <= "12:30" ) {
					
					$user9++;
					$user9Time += $item['timediff'];
					$userMaxTime9 = ( $userMaxTime9 > $item['timediff'] ) ? $userMaxTime9 : $item['timediff'] ;
					
				}
				$userTime8 += $item['timediff'];
			}
			
			// 09:00 �֧ 13:00
			if( $item['pharin'] >= "09:00" && $item['pharin'] <= "13:00" ){
				if( $item['pharin'] >= "09:00" && $item['pharin'] <= "11:00" ){
					
					$user8_2++;
					$user8Time_2 += $item['timediff'];
					$userMaxTime8_2 = ( $userMaxTime8_2 > $item['timediff'] ) ? $userMaxTime8_2 : $item['timediff'] ;
					
					// ���Թ 30�ҷ�
					if( $item['timediff'] > 1800 ){
						$time9Over30++;
					}
				} elseif( $item['pharin'] >= "11:01" && $item['pharin'] <= "13:00" ) {
					
					$user9_2++;
					$user9Time_2 += $item['timediff'];
					$userMaxTime9_2 = ( $userMaxTime9_2 > $item['timediff'] ) ? $userMaxTime9_2 : $item['timediff'] ;
					
					// ���Թ 30�ҷ�
					if( $item['timediff'] > 1800 ){
						$time11Over30++;
					}
				}
				$userTime8_2 += $item['timediff'];
			}
				
		} // ������¡����Է��
		
		
		// �¡�����ǧ���� 08:30 �֧ 12:30
		if( $item['pharin'] >= "08:30:00" && $item['pharin'] <= "10:30" ){
			$allMax8 = ( $allMax8 > $item['timediff'] ) ? $allMax8 : $item['timediff'] ;
		}
		
		if( $item['pharin'] >= "10:31" && $item['pharin'] <= "12:30" ) {
			$allMax9 = ( $allMax9 > $item['timediff'] ) ? $allMax9 : $item['timediff'] ;
		}
		
		// �¡�����ǧ���� 09:00 �֧ 13:00
		if( $item['pharin'] >= "09:00" && $item['pharin'] <= "11:00" ){
			$allMax8_2 = ( $allMax8_2 > $item['timediff'] ) ? $allMax8_2 : $item['timediff'] ;
		}
		
		if( $item['pharin'] >= "11:01" && $item['pharin'] <= "13:00" ) {
			$allMax9_2 = ( $allMax9_2 > $item['timediff'] ) ? $allMax9_2 : $item['timediff'] ;
		}
		
		
		
		
	} // End while
	
	// ������Ф�ͺ���� 8.30-10.30
	$sol8Avg = ( $solid8Time / $sol8 );
	$avgSolTime8 = gmdate("H:i:s", $sol8Avg);
	
	// ������Ф�ͺ���� 10:30-12:30
	$sol9Avg = ( $solid9Time / $sol9 );
	$avgSolTime9 = gmdate("H:i:s", $sol9Avg);
	
	// ������Ф�ͺ���� 8.30-12:30
	$solAvgTime = ( $solTime8 / ( $sol8 + $sol9 ) );
	$avgSolidTime8 = gmdate('H:i:s', $solAvgTime);
	
	
	
	// ������Ф�ͺ���� 9:00-11:00
	$sol8Avg = ( $solid8Time_2 / $sol8 );
	$avgSolTime8_2 = gmdate("H:i:s", $sol8Avg);
	
	// ������Ф�ͺ���� 11:00-13:00
	$sol9Avg = ( $solid9Time_2 / $sol9 );
	$avgSolTime9_2 = gmdate("H:i:s", $sol9Avg);
	
	// ������Ф�ͺ���� 9:00-13:00
	$solAvgTime = ( $solTime8_2 / ( $sol8_2 + $sol9_2 ) );
	$solDate9 = gmdate('H:i:s', $solAvgTime);
	
	
	
	// �����͹����� 8.30-10.30
	$user8Avg = ( $user8Time / $user8 );
	$avgUserTime8 = gmdate("H:i:s", $user8Avg);
	
	// �����͹����� 10:30-12:30
	$user9Avg = ( $user9Time / $user9 );
	$avgUserTime9 = gmdate("H:i:s", $user9Avg);
	
	// �����͹����� 8.30-12:30
	$userAvgTime = ( $userTime8 / ( $user8 + $user9 ) );
	$userDate8 = gmdate('H:i:s', $userAvgTime);
	
	
	
	// �����͹����� 9:00-11:00
	$user8Avg = ( $user8Time_2 / $user8_2 );
	$avgUserTime8_2 = gmdate("H:i:s", $user8Avg);
	
	// �����͹����� 11:00-13:00
	$user9Avg = ( $user9Time_2 / $user9_2 );
	$avgUserTime9_2 = gmdate("H:i:s", $user9Avg);
	
	// �����͹����� 9:00-13:00
	$userAvgTime = ( $userTime8_2 / ( $user8_2 + $user9_2 ) );
	$userDate9 = gmdate('H:i:s', $userAvgTime);
	
	
	// Ẻ��������� 08:30-10:30
	$allUser8 = $sol8 + $user8;
	$allAvg8 = ( $solid8Time + $user8Time ) / $allUser8 ;
	$allAvg8Time = gmdate("H:i:s", $allAvg8);
	
	// Ẻ��������� 10:30-12:30
	$allUser9 = $sol9 + $user9;
	$allAvg9 = ( $solid9Time + $user9Time ) / $allUser9 ;
	$allAvg9Time = gmdate("H:i:s", $allAvg9);
	
	
	$avgFinal = ( ($solid8Time + $user8Time  + $solid9Time + $user9Time) / ($sol8 + $user8 + $sol9 + $user9) );
	$finalTime8 = gmdate("H:i:s", $avgFinal);
	
	
	
	// Ẻ��������� 9:00-11:00
	$allUser8_2 = $sol8_2 + $user8_2;
	$allAvg8_2 = ( $solid8Time_2 + $user8Time_2) / $allUser8_2 ;
	$allAvg8Time_2 = gmdate("H:i:s", $allAvg8_2);
	
	// Ẻ��������� 11:00-13:00
	$allUser9_2 = $sol9_2 + $user9_2;
	$allAvg9_2 = ( $solid9Time_2 + $user9Time_2) / $allUser9_2 ;
	$allAvg9Time_2 = gmdate("H:i:s", $allAvg9_2);
	
	$avgFinal_2 = ( ($solid8Time_2 + $user8Time_2  + $solid9Time_2 + $user9Time_2) / ($sol8_2 + $user8_2 + $sol9_2 + $user9_2) );
	$finalTime8_2 = gmdate("H:i:s", $avgFinal_2);
	
	?>
	<style type="text/css">
		p, h3{margin: 0;padding: 0;}
		span{border-bottom: 1px solid #000000; padding: 0px 0.5em;}
		.header{margin-top: 12px;}
		.space{padding: 4px 0;}
		@media print{.no-print{ display: none; }}
	</style>
	<div class="no-print"><a href="drugtimer.php">&lt;&lt;&nbsp;��Ѻ�˹�Ҥ���</a></div>
	<h3>�������������㹡�����Ѻ�� ��͹ <?=$thaimonthFull[$mName];?> �� <?=$yName;?></h3>
	<table>
		<tbody>
			<tr>
				<td>
					<p class="header"><b>������Ф�ͺ����</b></p>
					<p>�������������㹡�����Ѻ��<br>
					��ǧ���� 08:30-10:30 �.<br>
					�ӹǹ���<span><?=$sol8;?></span> �����������<span><?=$avgSolTime8;?></span><br>
					���ҷ�����ҡ�ش<span><?=gmdate('H:i:s', $solMaxTime8);?></span></p>
					
					<div class="space"></div>
					
					<p>��ǧ���� 10:30-12:30 �.<br>
					�ӹǹ���<span><?=$sol9;?></span> �����������<span><?=$avgSolTime9;?></span><br>
					���ҷ�����ҡ�ش<span><?=gmdate('H:i:s', $solMaxTime9);?></span></p>
					
					<div class="space"></div>
					
					<p>����������������<span><?=$avgSolidTime8;?></span></p>
				</td>
			</tr>
			<tr>
				<td>
					<p class="header"><b>������Ф�ͺ����</b></p>
					<p>�������������㹡�����Ѻ��<br>
					��ǧ���� 09:00-11:00 �.<br>
					�ӹǹ���<span><?=$sol8_2;?></span> �����������<span><?=$avgSolTime8_2;?></span><br>
					���ҷ�����ҡ�ش<span><?=gmdate('H:i:s', $solMaxTime8_2);?></span></p>
					
					<div class="space"></div>
					
					<p>��ǧ���� 11:00-13:00 �.<br>
					�ӹǹ���<span><?=$sol9_2;?></span> �����������<span><?=$avgSolTime9_2;?></span><br>
					���ҷ�����ҡ�ش<span><?=gmdate('H:i:s', $solMaxTime9_2);?></span></p>
					
					<div class="space"></div>
					
					<p>����������������<span><?=$solDate9;?></span></p>
				</td>
			</tr>
			<tr>
				<td>
					<p class="header"><b>�����͹�����</b></p>
					<p>�������������㹡�����Ѻ��<br>
					��ǧ���� 08:30-10:30 �.<br>
					�ӹǹ���<span><?=$user8;?></span> �����������<span><?=$avgUserTime8;?></span><br>
					���ҷ�����ҡ�ش<span><?=gmdate('H:i:s', $userMaxTime8);?></span></p>
					
					<div class="space"></div>
					
					<p>��ǧ���� 10:30-12:30 �.<br>
					�ӹǹ���<span><?=$user9;?></span> �����������<span><?=$avgUserTime9;?></span><br>
					���ҷ�����ҡ�ش<span><?=gmdate('H:i:s', $userMaxTime9);?></span></p>
					
					<div class="space"></div>
					
					<p>����������������<span><?=$userDate8;?></span></p>
				</td>
			</tr>
			<tr>
				<td>
					<p class="header"><b>�����͹�����</b></p>
					<p>�������������㹡�����Ѻ��<br>
					��ǧ���� 09:00-11:00 �.<br>
					�ӹǹ���<span><?=$user8_2;?></span> �����������<span><?=$avgUserTime8_2;?></span><br>
					���ҷ�����ҡ�ش<span><?=gmdate('H:i:s', $userMaxTime8_2);?></span><br>
					�ӹǹ��ҷ�����Թ 30 �ҷ� <span><?=$time9Over30;?></span></p>
					
					<div class="space"></div>
					
					<p>��ǧ���� 11:00-13:00 �.<br>
					�ӹǹ���<span><?=$user9_2;?></span> �����������<span><?=$avgUserTime9_2;?></span><br>
					���ҷ�����ҡ�ش<span><?=gmdate('H:i:s', $userMaxTime9_2);?></span><br>
					�ӹǹ��ҷ�����Թ 30 �ҷ� <span><?=$time11Over30;?></span></p>
					
					<div class="space"></div>
					
					<p>����������������<span><?=$userDate9;?></span></p>
				</td>
			</tr>
			<tr>
				<td>
					<p class="header"><b>������Ф�ͺ���� ��� �����͹�����</b></p>
					<p>�������������㹡�����Ѻ��<br>
					��ǧ���� 08:30-10:30 �.<br>
					�ӹǹ���<span><?=$allUser8;?></span> �����������<span><?=$allAvg8Time;?></span><br>
					���ҷ�����ҡ�ش<span><?=gmdate('H:i:s', $allMax8);?></span></p>
					
					<div class="space"></div>
					
					<p>��ǧ���� 10:30-12:30 �.<br>
					�ӹǹ���<span><?=$allUser9;?></span> �����������<span><?=$allAvg9Time;?></span><br>
					���ҷ�����ҡ�ش<span><?=gmdate('H:i:s', $allMax9);?></span></p>
					
					<div class="space"></div>
					
					<p>����������������<span><?=$finalTime8;?></span></p>
				</td>
			</tr>
			<tr>
				<td>
					<p class="header"><b>������Ф�ͺ���� ��� �����͹�����</b></p>
					<p>�������������㹡�����Ѻ��<br>
					��ǧ���� 09:00-11:00 �.<br>
					�ӹǹ���<span><?=$allUser8_2;?></span> �����������<span><?=$allAvg8Time_2;?></span><br>
					���ҷ�����ҡ�ش<span><?=gmdate('H:i:s', $allMax8_2);?></span></p>
					
					<div class="space"></div>
					
					<p>��ǧ���� 11:00-13:00 �.<br>
					�ӹǹ���<span><?=$allUser9_2;?></span> �����������<span><?=$allAvg9Time_2;?></span><br>
					���ҷ�����ҡ�ش<span><?=gmdate('H:i:s', $allMax9_2);?></span></p>
					
					<div class="space"></div>
					
					<p>����������������<span><?=$finalTime8_2;?></span></p>
				</td>
			</tr>
		</tbody>
	</table>
	<?php
}
