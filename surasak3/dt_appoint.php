<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start();

if(isset($_GET["action"])){
	// header("content-type: application/x-javascript; charset=TIS-620");
}
include("connect.inc");

// ���ͺ user ����Ѻ����餹����
if( $_SESSION['sIdname'] == 'md19921' ){
	include_once 'includes/connect_md013.php';
}

// ��Ѻ�͹�֧���ҧ������� mysqli
$dbi = new mysqli($ServerName,$User,$Password,$DatabaseName);

$_SESSION["list_lab"] = array() ;

function calcage($birth){

	$pAge = array();

	list($bY, $bM, $bD) = explode('-', $birth);
	$end_time = strtotime(($bY - 543)."-$bM-$bD");
	$start_time = time();

	$test = getdate(($start_time - $end_time));

	$pAge['year'] = $test['year'] - 1970;
	$pAge['month'] = $test['mon'] - 1;
	$pAge['day'] = $test['mday'] - 1;

	return $pAge;
}

/* �ѧ���� LastDay() ������Ѻ���ѹ����ش���¢ͧ��͹/�շ���к������������͹/�շ���кع���ա���ѹ*/
function LastDay($m, $y) {
   for ($i=29; $i<=32; $i++) {
      if (checkdate($m, $i, $y) == 0) {
         return $i - 1;
      }
   }
}
if( !function_exists('dump') ){
	function dump($txt){
		echo "<pre>";
		var_dump($txt);
		echo "</pre>";
	}
}

if($_GET["action"] == "carlendar"){

	// �� mdcode �ͧ���
	$sql = "Select mdcode From inputm where name = '".$_SESSION["dt_doctor"]."' limit 1";
	list($mdcode) = Mysql_fetch_row(Mysql_Query($sql));

	// 
	$sql = "Select name From doctor where name like '".$mdcode."%' limit 1 ";
	list($appoint_doctor) = Mysql_fetch_row(Mysql_Query($sql));

   /* $diffHour ��� $diffMinute ��͵���÷�����纨ӹǹ���������Шӹǹ�ҷշ��ᵡ��ҧ�ѹ�����ҧ����ͧ ���͹��Ѻ����ͧ��������� 
   ����ӴѺ �蹶�����Ңͧ����ͧ����繵����ǡ������Ңͧ����ͧ��������� 11 ������� 15 �ҷ� ������˹� $diffHour �� 11 
   ��С�˹� $diffMinute �� 15 */
	$diffHour = 0;
	$diffMinute = 0;

	if ( empty($dfMonth) ) {

		/* �������ա���к�����ʴ���ԷԹ�ͧ��͹���͹˹�� ��Ҩ��ʴ���ԷԹ�ͧ��͹�Ѩ�غѹ������������ͧ����繵� 
		����ѧ���� getdate() ���ҧ�ѹ���/���һѨ�غѹ�ͧ����ͧ����繵������㹵���� $calTime 
		��觿ѧ���蹹��Ф׹��ҡ�Ѻ������������ */
		$calTime = getdate(date(mktime(date("H") + $diffHour,
		date("i") + $diffMinute)));
		$today = $calTime["mday"];     //�ѹ���
		$month = $calTime["mon"];      //��͹
		$year = $calTime["year"];        // ��
	} else {

		/* �óշ���к�����ʴ���ԷԹ�ͧ��͹/��˹��� ��� ���ա���觵���� $today,
		$dfMonth ��� $dfYear ��ҹ�ҷҧ query string ���� */
		if ($dfMonth == 0) {

			/* ��ҵ���� $dfMonth �� 0 ��Ҩ��ʴ���ԷԹ�ͧ��͹�ѹ�Ҥ��ͧ�շ����¡��һշ����ѧ�ʴ����� */
			$dfMonth = 12;
			$dfYear = $dfYear - 1;
		}elseif ($dfMonth == 13) {

			/* ��ҵ���� $dfMonth �� 13 ��Ҩ��ʴ���ԷԹ�ͧ��͹���Ҥ��ͧ�շ���ҡ���һշ����ѧ�ʴ����� */
			$dfMonth = 1;
			$dfYear = $dfYear + 1;
		}

		//���ҧ�ѹ/���Ңͧ��͹��лշ�������к� �����㹵���� $calTime
		$calTime = getdate(date(mktime((date("H") + $diffHour), (date("i") + $diffMinute), 0, $dfMonth, $today, $dfYear)));
		$today = $calTime["mday"];      //�ѹ���
		$month = $calTime["mon"];       //��͹
		$year = $calTime["year"];         //��
	}

	/* ���¡�ѧ��ѹ LastDay() ����繿ѧ���蹷��������ҧ����ͧ ������"�ӹǹ�ѹ" 
	�ͧ��͹��лշ����ʴ���ԷԹ �������㹵���� $Lday */
	$Lday = LastDay($month, $year);
	//�� timestamp �ͧ�ѹ��� 1 �ͧ��͹�����ʴ���ԷԹ ���㹵���� $FTime
	$FTime = getdate(date(mktime(0, 0, 0, $month, 1, $year)));
	//�� "�ѹ��ѻ����" (�ѹ���, �ѧ��� ���) �ͧ�ѹ��� 1 �ͧ��͹���㹵���� $wday
	$wday = $FTime["wday"];

	//���ҧ����ê�Դ���������纪�����͹������
	$thmonthname = array("���Ҥ�", "����Ҿѹ��", "�չҤ�", "����¹", "����Ҥ�", "�Զع�¹", "�á�Ҥ�", "�ԧ�Ҥ�", "�ѹ��¹", "���Ҥ�", "��Ȩԡ�¹", "�ѹ�Ҥ�");

	// �֧������Ẻ temp ���ѧ��� group 
	$sql_temp = "CREATE TEMPORARY TABLE `tmp_appointment` 
	SELECT `appdate`, `apptime`, `hn`, `other` 
	FROM `appoint` 
	WHERE `appdate` LIKE '% ".$thmonthname[$month - 1]." ".($year+543)."' 
	AND doctor in ('".$_SESSION["dt_doctor"]."','".$appoint_doctor."') 
	AND apptime <> '¡��ԡ��ùѴ' ";
	// mysql_query($sql_temp);
	$dbi->query($sql_temp);

	// $sql = "Select appdate, apptime, count(distinct hn) as total_app 
	// From appoint  
	// where appdate like '% ".$thmonthname[$month - 1]." ".($year+543)."' 
	// AND doctor in ('".$_SESSION["dt_doctor"]."','".$appoint_doctor."') 
	// AND apptime <> '¡��ԡ��ùѴ' 
	// GROUP BY appdate, apptime  ";

	$sql = "Select appdate, apptime, count(distinct hn) as total_app 
	From `tmp_appointment`  
	GROUP BY appdate, apptime  ";
	// $result = Mysql_Query($sql);
	$list_app = array();
	// while($arr = Mysql_fetch_assoc($result)){
	// 	$list_app["A".substr($arr["appdate"],0,2)]["detail"] .= " ".$arr["apptime"]." �ӹǹ ".$arr["total_app"]." ��<BR>";
	// 	$list_app["A".substr($arr["appdate"],0,2)]["sum"] = $list_app["A".substr($arr["appdate"],0,2)]["sum"] + $arr["total_app"];
	// }

	$result = $dbi->query($sql);
	while ($arr = $result->fetch_assoc()) {
		$list_app["A".substr($arr["appdate"],0,2)]["detail"] .= " ".$arr["apptime"]." �ӹǹ ".$arr["total_app"]." ��<BR>";
		$list_app["A".substr($arr["appdate"],0,2)]["sum"] = $list_app["A".substr($arr["appdate"],0,2)]["sum"] + $arr["total_app"];
	}
	$result->free();

	// �����ҹ�Ѩ�غѹ��ᾷ���Ǫ��Ժѵ�������� �������� query statement �͡��
	$dr_intern = false;
	
	if( $_SESSION['sLevel'] == 'intern' ){
		$dr_intern = true;
	}

	$sql = "Select date_format(date_holiday,'%d') as date_holiday2, detail From holiday where date_holiday like '".($year+543)."-".sprintf("%02d",$month)."%' ";
	$result = Mysql_Query($sql);
	while($arr = Mysql_fetch_assoc($result)){
		$holiday["A".$arr["date_holiday2"]]["date"] = true;
		$holiday["A".$arr["date_holiday2"]]["detail"] = $arr["detail"];
	}

	/////vaccine
	// $sql = "Select appdate, apptime, count(distinct hn) as total_app,other 
	// From `appoint` 
	// where appdate like '% ".$thmonthname[$month - 1]." ".($year+543)."' 
	// AND (doctor like '%".$_SESSION["dt_doctor"]."%' OR doctor like '%".substr($appoint_doctor,0,5)."%') 
	// AND apptime <> '¡��ԡ��ùѴ' 
	// and other!='' 
	// GROUP BY appdate, apptime ,other ";


	$sql = "Select appdate, apptime, count(distinct hn) as total_app,other 
	From `tmp_appointment` 
	WHERE other!='' 
	GROUP BY appdate, apptime ,other ";
	// $result = Mysql_Query($sql);
	$list_vac = array();
	// while($arr = Mysql_fetch_assoc($result)){
	// 	$list_vac["A".substr($arr["appdate"],0,2)]["detail"] .= " ".$arr["other"]." �ӹǹ ".$arr["total_app"]." ��<BR>";
	// 	$list_vac["A".substr($arr["appdate"],0,2)]["sum"] = $list_app["A".substr($arr["appdate"],0,2)]["sum"] + $arr["total_app"];
	// }

	$result = $dbi->query($sql);
	while ($arr = $result->fetch_assoc()) {
		$list_vac["A".substr($arr["appdate"],0,2)]["detail"] .= " ".$arr["other"]." �ӹǹ ".$arr["total_app"]." ��<BR>";
		$list_vac["A".substr($arr["appdate"],0,2)]["sum"] = $list_app["A".substr($arr["appdate"],0,2)]["sum"] + $arr["total_app"];
	}
	$result->free();

	// mysql_query("DROP TEMPORARY TABLE `tmp_appointment`;");
	$dbi->query("DROP TEMPORARY TABLE `tmp_appointment`;");

	$long_time = $month+$year;
	$month2 = date("m");
	$year2 = date("Y");
	$long_time2 = $month2 + $year2;

	if($year == $year2){
		if(($long_time - $long_time2) >0 )
			$title_time = " (�Ѵ ".($long_time - $long_time2)." ��͹)";
	}else{
		$title_time = " (�Ѵ ".(12 - date("m") + $month )." ��͹)";
	}

	echo "<TABLE><TR valign=\"top\"><TD>";
	echo "</TD></TD><TD>";

	if(!checkdate  ( $month - 1, $today  , $year  )){
		$today1 = "1";
	}else{
		$today1 = $today;
	}

	if(!checkdate  ( $month + 1, $today  , $year  )){
		$today2 = "1";
	}else{
		$today2 = $today;
	}

	// ᾷ��intern 
	if( $dr_intern == true OR $_SESSION['smenucode'] == 'ADM' ){

		$next_1month = strtotime(date('Y-m-d')." +1 month");
		$next_2month = strtotime(date('Y-m-d')." +2 months");
		$next_3month = strtotime(date('Y-m-d')." +3 months");

		$next_6month = strtotime(date('Y-m-d')." +6 months");
		$next_1year = strtotime(date('Y-m-d')." +1 year");
		$next_2year = strtotime(date('Y-m-d')." +2 years");

		list($n1mY, $n1mM, $n1mD) = explode('-', date('Y-m-d', $next_1month));
		list($n2mY, $n2mM, $n2mD) = explode('-', date('Y-m-d', $next_2month));
		list($n3mY, $n3mM, $n3mD) = explode('-', date('Y-m-d', $next_3month));

		list($n6mY, $n6mM, $n6mD) = explode('-', date('Y-m-d', $next_6month));
		list($n1yY, $n1yM, $n1yD) = explode('-', date('Y-m-d', $next_1year));
		list($n2yY, $n2yM, $n2yD) = explode('-', date('Y-m-d', $next_2year));

		echo '<a href="javascript: void(0);" onclick="show_carlendar(\'&today='.$n1mD.'&dfMonth='.$n1mM.'&dfYear='.$n1mY.'\')">&gt;&gt; �Ѵ 1��͹</a>&nbsp;||&nbsp;';
		echo '<a href="javascript: void(0);" onclick="show_carlendar(\'&today='.$n2mD.'&dfMonth='.$n2mM.'&dfYear='.$n2mY.'\')">&gt;&gt; �Ѵ 2��͹</a>&nbsp;||&nbsp;';
		echo '<a href="javascript: void(0);" onclick="show_carlendar(\'&today='.$n3mD.'&dfMonth='.$n3mM.'&dfYear='.$n3mY.'\')">&gt;&gt; �Ѵ 3��͹</a>';
		echo '<br>';
		echo '<a href="javascript: void(0);" onclick="show_carlendar(\'&today='.$n6mD.'&dfMonth='.$n6mM.'&dfYear='.$n6mY.'\')">&gt;&gt; �Ѵ 6��͹</a>&nbsp;||&nbsp;';
		echo '<a href="javascript: void(0);" onclick="show_carlendar(\'&today='.$n1yD.'&dfMonth='.$n1yM.'&dfYear='.$n1yY.'\')">&gt;&gt; �Ѵ 1��</a>&nbsp;||&nbsp;';
		echo '<a href="javascript: void(0);" onclick="show_carlendar(\'&today='.$n2yD.'&dfMonth='.$n2yM.'&dfYear='.$n2yY.'\')">&gt;&gt; �Ѵ 2��</a>';
		echo '<br>';

	}

	// �ʴ��ͧ�����
	if( $_SESSION['sIdname'] == 'md19921' ){ 

		$next_3month = strtotime(date('Y-m-d')." +3 months");
		$next_6month = strtotime(date('Y-m-d')." +6 months");
		$next_1year = strtotime(date('Y-m-d')." +1 year");

		list($n3mY, $n3mM, $n3mD) = explode('-', date('Y-m-d', $next_3month));
		list($n6mY, $n6mM, $n6mD) = explode('-', date('Y-m-d', $next_6month));
		list($n1yY, $n1yM, $n1yD) = explode('-', date('Y-m-d', $next_1year));

		echo '<a href="javascript: void(0);" onclick="show_carlendar(\'&today='.date('d').'&dfMonth='.date('m').'&dfYear='.date('Y').'\')">�ѹ�Ѩ�غѹ</a>&nbsp;||&nbsp;';
		echo '<a href="javascript: void(0);" onclick="show_carlendar(\'&today='.$n3mD.'&dfMonth='.$n3mM.'&dfYear='.$n3mY.'\')">&gt;&gt; �Ѵ 3��͹</a>&nbsp;||&nbsp;';
		echo '<a href="javascript: void(0);" onclick="show_carlendar(\'&today='.$n6mD.'&dfMonth='.$n6mM.'&dfYear='.$n6mY.'\')">&gt;&gt; �Ѵ 6��͹</a>&nbsp;||&nbsp;';
		echo '<a href="javascript: void(0);" onclick="show_carlendar(\'&today='.$n1yD.'&dfMonth='.$n1yM.'&dfYear='.$n1yY.'\')">&gt;&gt; �Ѵ 1��</a>';
		echo '<br>';

	}

	// �ʴ��ͧ�����ͻ�Ѫ�� 
	// ��ԡ����Ф��駨��繡�ùѴ���� 3��͹ 1��
	if( $_SESSION['sIdname'] == 'md32166' OR $_SESSION['smenucode'] == 'ADM' ){
		echo '<a href="javascript: void(0);" onclick="show_carlendar(\'&today='.$today1.'&dfMonth='.($month + 3).'&dfYear='.$year.'\')">&gt;&gt; ���͹�Ѵ�ա 3��͹</a>';
		echo '&nbsp;||&nbsp;';
		echo '<a href="javascript: void(0);" onclick="show_carlendar(\'&today='.$today1.'&dfMonth='.$month.'&dfYear='.($year+1).'\')">&gt;&gt; ���͹�Ѵ�ա 1��</a>';
	}


	if( $_SESSION['sIdname'] == 'md27035' OR $_SESSION['smenucode'] == 'ADM' ){

		// �ͧ������Է�� ���繹Ѵ�� 2.5�Ǻ �Ѻ 4�Ǻ 
		$sql = "SELECT a.`age`,b.`dbirth`  
		FROM `opday` AS a 
		LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
		WHERE a.`thdatevn` = '".date("d-m-").(date("Y")+543).$_SESSION["vn_now"]."' ";
		$q = mysql_query($sql);
		$pt = mysql_fetch_assoc($q);
		$pt_age = calcage($pt['dbirth']);

		if( $pt_age['year'] >= 0 && $pt_age['year'] < 4 ){

			list($y, $m, $d) = explode('-', $pt['dbirth']);
			
			$next_2years = strtotime(($y - 543)."-$m-$d +2 years +6 months");
			$next_4years = strtotime(($y - 543)."-$m-$d +4 years");
			
			
			list($yinj, $minj, $dinj) = explode('-', date('Y-m-d', $next_2years));
			list($yinj2, $minj2, $dinj2) = explode('-', date('Y-m-d', $next_4years));

			// ��ԡ������仵͹ 2�Ǻ���� ���4�Ǻ
			echo '<br>';
			echo '<a href="javascript: void(0);" onclick="show_carlendar(\'&today='.date('d').'&dfMonth='.date('m').'&dfYear='.date('Y').'\')">���͡�ѹ�Ѩ�غѹ</a>';

			// 0 - 2�Ǻ����
			if( $pt_age['year'] <= 2 && $pt_age['month'] < 6 ) {
				echo '&nbsp;||&nbsp;';
				echo '<a href="javascript: void(0);" onclick="show_carlendar(\'&today='.$dinj.'&dfMonth='.$minj.'&dfYear='.$yinj.'\')">�Ѵ�� 2�Ǻ����</a>';
			}
			
			if( $pt_age['year'] < 4 ) {
				echo '&nbsp;||&nbsp;';
				echo '<a href="javascript: void(0);" onclick="show_carlendar(\'&today='.$dinj2.'&dfMonth='.$minj2.'&dfYear='.$yinj2.'\')">�Ѵ�� 4�Ǻ</a>';
			}
			
		}

	}

	echo "<table border=\"1\" bordercolor=\"black\" width=\"320\" height=\"270\">
	<tr class=\"norm\"><td width=\"50\" align=\"center\">
	<a href=\"javascript:void(0);\" Onclick=\"show_carlendar('&today=".$today1."&dfMonth=".($month - 1)."&dfYear=".$year."');\">&lt;</a>
	</td>
	<td width=\"250\" align=\"center\" colspan=\"5\" bgcolor=\"#00CC99\">
	".$thmonthname[$month - 1]."&nbsp;
	".($year + 543)." ".$title_time."
	</td>
	<td width=\"50\" align=\"center\">
	<a href=\"javascript:void(0);\" Onclick=\"show_carlendar('&today=".$today2."&dfMonth=".($month + 1)."&dfYear=".$year."');\">&gt;</a>
	</td></tr>

	<tr><td width=\"50\" align=\"center\" class=\"sunday\">��</td>
	<td width=\"50\" align=\"center\" class=\"norm\">�</td>
	<td width=\"50\" align=\"center\" class=\"norm\">�</td>
	<td width=\"50\" align=\"center\" class=\"norm\">�</td>
	<td width=\"50\" align=\"center\" class=\"norm\">��</td>
	<td width=\"50\" align=\"center\" class=\"norm\">�</td>
	<td width=\"50\" align=\"center\" class=\"saturday\">�</td></tr><tr height=\"60\" valign=\"top\">";

	$iday = 1;
	//�ʴ����á�ͧ��ԷԹ
	for ($i=0; $i<=6; $i++) {
		$holiday_detail = "";
		if ($i < $wday) {    //�ʴ�������ҧ��͹�ѹ��� 1 �ͧ��͹
			if ($i == 0) {       //�óշ�����ѹ�ҷԵ��
				echo "<td width=\"50\" align=\"center\" class=\"sunday\">&nbsp;</td>\n";
			}else if ($i == 6) {       //�óշ�����ѹ�����
				echo "<td width=\"50\" align=\"center\" class=\"saturday\">&nbsp;</td>\n";
			}
			else {              //�óշ�����ѹ���� ���������ѹ�ҷԵ��
				echo "<td width=\"50\" align=\"center\" class=\"norm\">&nbsp;</td>\n";
			}
		} else {                  //�ʴ��ѹ�������á�ͧ��ԷԹ

			// ���� �������Ǩ�ͺ��Ҩҡ Array
			$key = 'A'.sprintf("%02d",$iday);

			if ($i == 0 ) {
			//�óշ�����ѹ�ҷԵ�� ���������ѹ�Ѩ�غѹ
				echo "<td width=\"50\" valign=\"top\" align=\"center\" class=\"sunday\">
				<A class=\"sunday countnum\" href=\"javascript:void(0);\" Onclick=\"document.getElementById('date_appoint').value='".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."';\">$iday</A>";
				if(!empty($list_app["A".sprintf("%02d",$iday)]["sum"]))
					echo "<BR>(<A HREF=\"javascript:void(0);\" OnmouseOver = \"show_tooltip('�����¹Ѵ','".$list_app["A".sprintf("%02d",$iday)]["detail"]."<br>".$list_vac["A".sprintf("%02d",$iday)]["detail"]."','left',-280,-260);\" OnmouseOut = \"hid_tooltip();\" class=\"total_appointsunday\">".$list_app["A".sprintf("%02d",$iday)]["sum"]."</A>)";
				else
					echo "<BR>&nbsp;";

				echo "</td>\n";
			}else  if ($i == 6 ) {
			//�óշ�����ѹ�ҷԵ�� ���������ѹ�Ѩ�غѹ
				echo "<td width=\"50\" align=\"center\" class=\"saturday\">
				<A class=\"saturday countnum\" href=\"javascript:void(0);\" Onclick=\"document.getElementById('date_appoint').value='".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."';\">$iday</A>";
				if(!empty($list_app["A".sprintf("%02d",$iday)]["sum"]))
					echo "<BR>(<A HREF=\"javascript:void(0);\" OnmouseOver = \"show_tooltip('�����¹Ѵ','".$list_app["A".sprintf("%02d",$iday)]["detail"]."<br>".$list_vac["A".sprintf("%02d",$iday)]["detail"]."','left',-280,-260);\" OnmouseOut = \"hid_tooltip();\" class=\"total_appointsaturday\">".$list_app["A".sprintf("%02d",$iday)]["sum"]."</A>)";
				else
					echo "<BR>&nbsp;";

				echo "</td>\n";

			} else { // �ѹ �. - �.

				if($holiday["A".sprintf("%02d",$iday)]["date"]){
					$class = "sunday";
					$holiday_detail = " OnmouseOver = \"show_tooltip('�ѹ��ش','".$holiday["A".sprintf("%02d",$iday)]["detail"]."','left',-200,-260);\" OnmouseOut = \"hid_tooltip();\" ";
				}else{
					$class = "norm";
				}

				echo "<td width=\"50\" align=\"center\" class=\"".$class."\">
				<A class=\"".$class." countnum\" href=\"javascript:void(0);\" Onclick=\"document.getElementById('date_appoint').value='".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."';\"  ".$holiday_detail.">$iday</A>";
				if(!empty($list_app["A".sprintf("%02d",$iday)]["sum"]))
					echo "<BR>(<A HREF=\"javascript:void(0);\" OnmouseOver = \"show_tooltip('�����¹Ѵ','".$list_app["A".sprintf("%02d",$iday)]["detail"]."<br>".$list_vac["A".sprintf("%02d",$iday)]["detail"]."','left',-280,-260);\" OnmouseOut = \"hid_tooltip();\" class=\"total_appoint".$class."\">".$list_app["A".sprintf("%02d",$iday)]["sum"]."</A>)";
				else
					echo "<BR>&nbsp;";

				echo "</td>\n";

			}

			$iday++;

		}
	}
	
	//�ʴ��Ƿ������ͧ͢��ԷԹ (��ѧ�ҡ�ʴ����á����� ����������ҧ�ҡ 5 ��)
	for ($j=0; $j<=4; $j++) { // �ʴ�4�ҷԵ��
		if ($iday <= $Lday) {
			echo "<tr  height=\"60\" valign=\"top\">\n";
				for ($i=0; $i<=6; $i++) { // �ʴ��ѹ��ҷԵ�����
					$holiday_detail = "";
					if ($iday <= $Lday) {

						// ���� �������Ǩ�ͺ��Ҩҡ Array
						$key = 'A'.sprintf("%02d",$iday);

						if ($i == 0 ) { // ������ѹ�ҷԵ��
							if($holiday["A".sprintf("%02d",$iday)]["date"]){
								$class = "sunday";
								$holiday_detail = " OnmouseOver = \"show_tooltip('�ѹ��ش','".$holiday["A".sprintf("%02d",$iday)]["detail"]."','left',-200,-260);\" OnmouseOut = \"hid_tooltip();\" ";
							}else{
								$class = "norm";
							}

							echo "<td width=\"50\" align=\"center\" class=\"sunday\">
							<A class=\"sunday countnum\" href=\"javascript:void(0);\" Onclick=\"document.getElementById('date_appoint').value='".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."';\" ".$holiday_detail.">$iday</A>";
							
							if(!empty($list_app["A".sprintf("%02d",$iday)]["sum"])){
								echo "<BR>(<A HREF=\"javascript:void(0);\" OnmouseOver = \"show_tooltip('�����¹Ѵ','".$list_app["A".sprintf("%02d",$iday)]["detail"]."<br>".$list_vac["A".sprintf("%02d",$iday)]["detail"]."','left',-280,-260);\" OnmouseOut = \"hid_tooltip();\" class=\"total_appointsunday\">".$list_app["A".sprintf("%02d",$iday)]["sum"]."</A>)";
								
							}

							echo "</td>\n";
						}else  if ($i == 6 ) { // ������ѹ�����
							if($holiday["A".sprintf("%02d",$iday)]["date"]){
								$class = "sunday";
								$holiday_detail = " OnmouseOver = \"show_tooltip('�ѹ��ش','".$holiday["A".sprintf("%02d",$iday)]["detail"]."','left',-200,-260);\" OnmouseOut = \"hid_tooltip();\" ";
							}else{
								$class = "norm";
							}

							echo "<td width=\"50\" align=\"center\" class=\"saturday\">
							<A class=\"saturday countnum\" href=\"javascript:void(0);\" Onclick=\"document.getElementById('date_appoint').value='".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."';\" ".$holiday_detail." >$iday</A>";
								if(!empty($list_app["A".sprintf("%02d",$iday)]["sum"]))
									echo "<BR>(<A HREF=\"javascript:void(0);\" OnmouseOver = \"show_tooltip('�����¹Ѵ','".$list_app["A".sprintf("%02d",$iday)]["detail"]."<br>".$list_vac["A".sprintf("%02d",$iday)]["detail"]."','left',-280,-260);\" OnmouseOut = \"hid_tooltip();\" class=\"total_appointsaturday\">".$list_app["A".sprintf("%02d",$iday)]["sum"]."</A>)";
							
							echo "</td>\n";
						}else { // ������ѹ������

							if($holiday[$key]["date"]){
								$class = "sunday";
								$holiday_detail = " OnmouseOver = \"show_tooltip('�ѹ��ش','".$holiday[$key]["detail"]."','left',-200,-260);\" OnmouseOut = \"hid_tooltip();\" ";
							}else{
								$class = "norm";
							}
							
							echo "<td width=\"50\" align=\"center\" class=\"".$class."\">
								<A class=\"".$class." countnum\" href=\"javascript:void(0);\" Onclick=\"document.getElementById('date_appoint').value='".sprintf("%02d",$iday)." ".$thmonthname[$month - 1]." ".($year+543)."';\" ".$holiday_detail." >$iday</A>";
							if(!empty($list_app[$key]["sum"])){
								echo "<BR>
								(<A HREF=\"javascript:void(0);\" OnmouseOver = \"show_tooltip('�����¹Ѵ','".$list_app[$key]["detail"]."<br>".$list_vac[$key]["detail"]."','left',-280,-260);\" OnmouseOut = \"hid_tooltip();\" class=\"total_appoint".$class."\">".$list_app[$key]["sum"]."</A>)";
							}
							
							echo "</td>\n";
						}

						$iday++;

					} else {

					echo "<td width=\"50\" align=\"center\" class=\"norm\">&nbsp;</td>\n";
				}
			}
			echo "</tr>\n";
		}
		else {
			break;
		}
	}

	echo "</table></TD>
	</TR>
	</TABLE>";
	
	exit();

}

if(isset($_GET["action"]) && $_GET["action"] == "lab"){

	$i=0;
	$sql2 = "SELECT *
FROM labcare
WHERE lab_list !=0 AND version != 'OLD' AND labstatus = 'Y'
ORDER BY lab_list ASC";
	$rows2=mysql_query($sql2);
	while($result2=mysql_fetch_array($rows2)){	
		$list_lab_check[$i]["code"] = $result2['code'];
		$list_lab_check[$i]["detail"] = $result2['lab_listdetail'];
		$i++;
	}
	
	$r=4;
	$count = count($list_lab_check);


	echo "
	<TABLE width=\"100%\" border=\"0\">
	<TR valign=\"top\">
		<TD width=\"500\">
	<TABLE width=\"100%\" align=\"left\" border=\"0\">
	<TR  valign=\"top\">
		<TD  colspan=\"".($r*2)."\" align='left' >LAB ���� : <INPUT TYPE=\"text\" NAME=\"\" size=\"8\" onkeypress=\"searchSuggest('lab',this.value,3);\"><Div id=\"list\"></Div></TD>
	</TR>
	<TR>
	";

	for($i=1;$i<=$count;$i++){
		
		echo "<TD align='right' >";
			echo "<INPUT TYPE=\"checkbox\" NAME=\"\" id=\"".jschars($list_lab_check[$i-1]["code"])."\" onclick=\"addbycheck(this.checked, '".jschars($list_lab_check[$i-1]["code"])."');\"";
		
		foreach ($_SESSION["list_code"] as $j => $value) {
			if($value == $list_lab_check[$i-1]["code"]){
				$check=true;
			}
		}
			if($check==true){
				echo " Checked ";
			}
				$check = false;

			echo ">";
		echo "</TD>";
		echo "<TD>".jschars($list_lab_check[$i-1]["detail"])."</TD>";
		if($i%$r==0)
			echo "</TR><TR>";
	}

	echo "</TR><TR><TD colspan=\"".($r*2)."\">";

echo "	</TD>
</TR>
</TABLE>
";
exit();
}
//*****************************�ʴ���Ǫ��� Other********************//
if(isset($_GET["action"]) && $_GET["action"] == "other"){
	
	$sql34 = "Select distinct(other) from appoint where other like '%".$_GET["search1"]."%' limit 10 ";
	$result34 = Mysql_Query($sql34)or die(Mysql_error());

	if(Mysql_num_rows($result34) > 0){
		echo "<Div style=\"position: absolute;text-align: center; width:400px; height:430px; overflow:auto; \">";

		echo "<table width=\"400\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#FF99CC\"><tr align=\"center\" bgcolor=\"#333333\">
		<td width=\"10\"><strong>&nbsp;</strong></td>
		<td width=\"200\"><font style=\"color: #FFFFFF;\"><strong>��¡��</strong></font></td>
		<td width=\"10\"><strong>&nbsp;&nbsp;<A HREF=\"#\" onclick=\"document.getElementById('list1').innerHTML='';\"><font style=\"color: #FFFF99;\">�Դ</font></A></strong></td>
		</tr>";
		
		//$i=1;
		while($se = Mysql_fetch_assoc($result34)){
		echo "<tr>
		<td valign=\"top\" width=\"10\"></td>
		<td width=\"200\"><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('other').value = '".$se['other']."';document.getElementById('list1').innerHTML ='';\">".$se['other']."</A></td>
		<td width=\"10\">&nbsp;</td></tr>";
		}
		echo "</TABLE></Div>";
	}
exit();
}
//************************** �ʴ���¡�� lab  ********************************************************
if(isset($_GET["action"]) && $_GET["action"] == "addtolist"){
	$sql = "Select detail, yprice, nprice From labcare where code = '".$_GET["code"]."' limit 1; ";
	list($detail, $yprice, $nprice) = Mysql_fetch_row(Mysql_Query($sql));

	array_push($_SESSION["list_code"],$_GET["code"]);
	array_push($_SESSION["list_detail"],$detail);
	array_push($_SESSION["list_nprice"],$nprice);
	array_push($_SESSION["list_yprice"],$yprice);

	exit();
}

if(isset($_GET["action"]) && $_GET["action"] == "viewlablist"){
	
	$i=0;
	$list = "";
	echo "<FONT SIZE=\"2\" >";
	foreach($_SESSION["list_code"] as $key=> $value){
		echo "<INPUT TYPE=\"hidden\" name=\"list_lab_appoint[]\" value=\"".jschars($value)."\"><A HREF=\"javascript:void(0);\" Onclick=\"del_list('".$value."');show_listlab();\">".$_SESSION["list_detail"][$i]."</A><BR>";
		$i++;
		$list .= " '".$value."',";
	}

	if($i>0){
		$sql = "Select (sum(yprice)+sum(nprice)) as ynprice From labcare where code in (".substr($list,0,-1).");";
		$result = Mysql_Query($sql);
		list($ynprice) = Mysql_fetch_row($result);
		echo "�Ҥ���� ".$ynprice." �ҷ";
	}

	echo "</FONT>";
	exit();
}

//************************** ź�������͡�ҡ��¡��  ********************************************************
if(isset($_GET["action"]) && $_GET["action"] == "delete"){
	
	$count = count($_SESSION["list_code"]);
	
	for($i=0;$i<$count;$i++){
		
		if($_GET["code"] == $_SESSION["list_code"][$i]){
			$j=$i;
			break;
		}

	}

	for($i=$j;$i<$count;$i++){
		$_SESSION["list_code"][$i] = $_SESSION["list_code"][$i+1];
		$_SESSION["list_detail"][$i] = $_SESSION["list_detail"][$i+1];
		$_SESSION["list_nprice"][$i] = $_SESSION["list_nprice"][$i+1];
		$_SESSION["list_yprice"][$i] = $_SESSION["list_yprice"][$i+1];
	}
	
	unset($_SESSION["list_code"][$count-1]);
	unset($_SESSION["list_detail"][$count-1]);
	unset($_SESSION["list_nprice"][$count-1]);
	unset($_SESSION["list_yprice"][$count-1]);

	exit();
}

if(isset($_GET["action"]) && $_GET["action"] == "reloadcookie"){

	//onMouseover=\"pull()\"
	//onMouseout=\"draw()\"
	//style=\"display:none\"
	echo "<layer id=\"slidemenubar\" onMouseover=\"pull()\" onMouseout=\"draw()\" style=\"display:none\">

	<TABLE width=\"450\" border=\"0\" cellpadding=\"4\" cellspacing=\"4\">
	<TR>
	<TD width=\"400\" bgcolor=\"#FFFFFF\" >";
	
	$i=  count($_COOKIE);
	if($i > 1){

		foreach($_COOKIE as $key => $value){
			
			$xxx = explode(">",$value);
			$yyy = explode("<",$xxx[1]);

			$zzz = $yyy[0];
			// $sql = "Select count(appdate) as c_app From appoint where appdate = '".$zzz."' AND doctor = '".$_SESSION["dt_doctor"]."' AND apptime <> '¡��ԡ��ùѴ'  ";
			// $result = Mysql_Query($sql) or die(mysql_error());
			// list($c_app) = Mysql_fetch_row($result);

			echo "&nbsp;&nbsp;",$value,"&nbsp;<BR>";
			$i--;
			if($i==1)
				break;
		}
	}
		
	echo "</TD>
	<TD valign=\"top\" width=\"45\"><Span style=\"background-color: #33CCFF\";><B>�ѹ�Ѵ</B></Span></TD>
	</TR>
	</TABLE>
	</layer>";
	exit();
}

if(isset($_GET["action"]) && $_GET["action"] == "deletecookie"){
	setcookie($_GET["id"], "", time()-(3600*6));
	exit();
}


/********************************************************* END AJAX *******************************************************************/
function jschars($str)
{
    $str = str_replace("\\\\", "\\\\", $str);
    $str = str_replace("\"", "\\\"", $str);
    //$str = str_replace("'", "\\'", $str);
    $str = str_replace("\r\n", "\\n", $str);
    $str = str_replace("\r", "\\n", $str);
    $str = str_replace("\n", "\\n", $str);
    $str = str_replace("\t", "\\t", $str);
    $str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
    $str = str_replace(">", "\\x3E", $str);
    return $str;
}


$_SESSION["list_code"] = array() ;
$_SESSION["list_detail"] = array() ;
$_SESSION["list_nprice"] = array() ;
$_SESSION["list_yprice"] = array() ;

?>
<html>
<head>
<title><?php echo $_SESSION["dt_doctor"];?> �͡㺹Ѵ������</title>
<style type="text/css">
body,td,th {
	font-family: Angsana New;
	font-size: 24px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_menu {background-color: #FFFFC1;  }

#slidemenubar, #slidemenubar2{
	position:absolute;
	left:-400px;
	width:450px;
	top:260px;

	layer-background-color:#000000;
	font:bold 16px ms sans serif;
	line-height:20px;

}
</style>
</head>
<body>

<SCRIPT LANGUAGE="JavaScript">
	
	window.onload = function(){
		show_carlendar('');
		reloadcookie();

	}

	function newXmlHttp(){
	var xmlhttp = false;

		try{
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
		try{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e){
				xmlhttp = false;
			}
		}

		if(!xmlhttp && document.createElement){
			xmlhttp = new XMLHttpRequest();
		}
	return xmlhttp;
}

function searchSuggest(action,str,len) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'dt_lab.php?action='+action+'&search=' + str;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			document.getElementById('list').style.display=''
			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}

function show_carlendar(xxx){

	xmlhttp = newXmlHttp();
	
	url = 'dt_appoint.php?action=carlendar' + xxx;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	document.getElementById("div_right_list").innerHTML = xmlhttp.responseText;

}

function show_listlab(){

	xmlhttp = newXmlHttp();
	
	url = 'dt_appoint.php?action=lab';
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	document.getElementById("div_right_list").innerHTML = xmlhttp.responseText;

}

function reloadcookie(){

	xmlhttp = newXmlHttp();
	
	url = 'dt_appoint.php?action=reloadcookie';
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	document.getElementById("slidemenubar2").innerHTML = xmlhttp.responseText;

}

function deletecookie(xxx){

	xmlhttp = newXmlHttp();
	
	url = 'dt_appoint.php?action=deletecookie&id='+xxx;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	reloadcookie();

}

function addtolist(code){
	
	xmlhttp = newXmlHttp();
	url = 'dt_appoint.php?action=addtolist&code=' + code;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	viewlablist();
	document.getElementById('list').innerHTML='';
	document.getElementById('list').style.display='none';
}


function addbycheck(statuscheck, code){

	if(statuscheck == true){
		addtolist(code);
	}else if(statuscheck == false){
		del_list(code);
	}

}

function del_list(code){

	url = 'dt_appoint.php?action=delete&code=' + code;
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
	viewlablist();
}

function viewlablist(){
	xmlhttp = newXmlHttp();
	url = 'dt_appoint.php?action=viewlablist';
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	document.getElementById("div_list_lab").innerHTML = xmlhttp.responseText;
}

function searchOther1(str,len) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'dt_appoint.php?action=other&search1=' + str;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list1").innerHTML = xmlhttp.responseText;
		}
}

function listb(number){
	
	if(document.getElementById("detail").value=='FU01 ��Ǩ����Ѵ'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=1;
		}
		else if(number=="3"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=0;
		}
	}
	else if(document.getElementById("detail").value=='FU02 ����ŵ�Ǩ'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=1;
		}
		else if(number=="3"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=0;
		}
	}
	else if(document.getElementById("detail").value=='FU03 �͹�ç��Һ��'){
		document.getElementById("room").selectedIndex=2;
	}
	else if(document.getElementById("detail").value=='FU04 �ѹ�����'){
		document.getElementById("room").selectedIndex=4;
	}
	else if(document.getElementById("detail").value=='FU05 ��ҵѴ'){
		document.getElementById("room").selectedIndex=2;
	}
	else if(document.getElementById("detail").value=='FU06 �ٵ�'){
		document.getElementById("room").selectedIndex=7;
	}
	else if(document.getElementById("detail").value=='FU07 ��չԡ�ѧ���'){
		document.getElementById("room").selectedIndex=9;
	}
	else if(document.getElementById("detail").value=='FU08 Echo'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=1;
		}
		else if(number=="3"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=0;
		}
	}
	else if(document.getElementById("detail").value=='FU09 ��š�д١'){
		document.getElementById("room").selectedIndex=2;
	}
	else if(document.getElementById("detail").value=='FU10 ����Ҿ'){
		document.getElementById("room").selectedIndex=8;
	}
	else if(document.getElementById("detail").value=='FU11 ��Ǩ����Ѵ���������ѵԼ������'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=1;
		}
		else if(number=="3"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=0;
		}
	}
	else if(document.getElementById("detail").value=='FU12 �ǴἹ��'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=1;
		}
		else if(number=="3"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=0;
		}		
	}
	else if(document.getElementById("detail").value=='FU13 ��ͧ������'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=1;
		}
		else if(number=="3"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=0;
		}
	}
	else if(document.getElementById("detail").value=='FU14 ������ʹ��辺ᾷ��'){
		document.getElementById("room").selectedIndex=17;  <!--��ͧ���Թ�����-->	
	}
	else if(document.getElementById("detail").value=='FU15 OPD �͡����'){
		document.getElementById("room").selectedIndex=2;
	}
	else if(document.getElementById("detail").value=='FU16 ��Թԡ�����'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=1;
		}
		else if(number=="3"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=0;
		}
	}
	else if(document.getElementById("detail").value=='FU22 ��Ǩ����ѴOPD �Ǫ��ʵ���蹿�'){
		document.getElementById("room").selectedIndex=8;
	}
	else if(document.getElementById("detail").value=='FU23 OPD ����Ҿ'){
		document.getElementById("room").selectedIndex=8;
	}
	else if(document.getElementById("detail").value=='FU24 ��Ǩ����Ѵ OPD �ѡ��(��)'){
		document.getElementById("room").selectedIndex=10;
	}
	else if(document.getElementById("detail").value=='FU26 EMG'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=1;
		}
		else if(number=="3"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=0;
		}
	}
	else if(document.getElementById("detail").value=='FU27 X-ray ��͹��ᾷ��'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=1;
		}
		else if(number=="3"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=0;
		}
	}
	else if(document.getElementById("detail").value=='FU28 Lab ��͹��ᾷ��'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=1;
		}
		else if(number=="3"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=0;
		}
		else if(number=="4"){
			document.getElementById("room").selectedIndex=17;
		}			
	}
	else if(document.getElementById("detail").value=='FU29 X-ray + Lab ��͹��ᾷ��'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=1;
		}
		else if(number=="3"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=0;
		}
		else if(number=="4"){
			document.getElementById("room").selectedIndex=17;
		}			
	}

}

function frmchk(){

	var test_return = true;

	if(document.getElementById('date_appoint').value==""){
		alert("��س����͡�ѹ�����¤��");
		test_return = false;
	}

	return test_return;
}
</SCRIPT>

<style type="text/css">
	.today { font-family: Angsana New; font-size: 24px; font-weight: bold; background-color: #C6B3FF; color: #000000;  }
	.sunday { font-family: Angsana New; font-size: 24px; font-weight: bold; background-color: #FF99CC; color: #FFFFFF; }
	.saturday { font-family: Angsana New; font-size: 24px; font-weight: bold; background-color: #9999FF; color: #000000; }
	.norm     { font-family: Angsana New; font-size: 24px; font-weight: bold; background-color: #FFFFFF; color: #000000; }
	.link_calendar { font-family: Angsana New; font-size: 24px; font-weight: bold; background-color: #FFFFFF; color: #000000; }
	.total_appointnorm { font-family: Angsana New; font-size: 24px; font-weight: bold; background-color: #FFFFFF; color: #FF0000; text-decoration:none;}
	.total_appointsunday { font-family: Angsana New; font-size: 24px; font-weight: bold; background-color: #FF9393; color: #FF0000;
	text-decoration:none;}
	.total_appointsaturday { font-family: Angsana New; font-size: 24px; font-weight: bold; background-color: #ECC4FF; color: #FF0000;
	text-decoration:none;}
</style>


<?php include("dt_menu.php");?><BR>
<?php 

$style_menu="2";
include("dt_patient.php");

?>
<TABLE width="100%" border="0">
<TR   valign="top">
	<TD width="45%">
	
<FORM METHOD=POST ACTION="dt_appoint_add.php" onSubmit="return frmchk()">
<TABLE width="90%" border="1" bordercolor="#F0F000">
<TR>
	<TD>
	<TABLE width="100%" cellpadding="0" cellspacing="2">
<TR >
	<TD align="right" class="tb_detail">�ѹ���Ѵ�������� : </TD>
	<TD>
    <?
	if($_SESSION["sIdname"] == "md19921"){
	?>
		<INPUT TYPE="text" ID="date_appoint" NAME="date_appoint" size="15">&nbsp;
	<?
	}else{
    ?>
		<INPUT TYPE="text" ID="date_appoint" NAME="date_appoint" size="15" readonly>&nbsp;
    <?
	}
	?>
	</TD>
	<TD><A HREF="javascript:void(0);" Onclick="show_carlendar('');"><IMG SRC="../butcalendar.gif" WIDTH="21" HEIGHT="20" BORDER="0" ALT=""></A>
	</TD>
</TR>
<?

	if( $_SESSION["sIdname"] == "md12891" //������͡
		|| $_SESSION["sIdname"] == "md19364" // ��͹����
		|| $_SESSION["sIdname"] == "md12456" // ��ͳç��
		|| $_SESSION["sIdname"] == "md29262" 
		|| $_SESSION["sIdname"] == "md21329" 
		|| $_SESSION["sIdname"] == "md24535" 
		|| $_SESSION["sIdname"] == "���Թ" 
		|| $_SESSION["sIdname"] == "md16633" // �����ó�
		|| $_SESSION["sIdname"] == "md37533" // �������
		|| $_SESSION["sIdname"] == "md50807" // �������Ѳ��
		|| $_SESSION["sIdname"] == "md65035" // intern ��2020
		|| $_SESSION["sIdname"] == "md65052" // intern
		|| $_SESSION["sIdname"] == "md65067" // intern
		|| $_SESSION["sIdname"] == "md65006" // intern
		|| $_SESSION["sIdname"] == "md65053" // intern 
	){
		$counter="2";
	}elseif($_SESSION["sIdname"] == "thaywin"){
		$counter="3";
	}elseif( $_SESSION["sIdname"] == "md20278" || $_SESSION["sIdname"] == "md27035" ){ // �������Է�� + �������Է�� default ���ش�Ѵ��ԡ�÷��1
		$counter="1";
	}else{ 			 
		$counter="1";
	}	
//if($_SESSION["sIdname"]!= "md16633" ||$_SESSION["sIdname"]!="md19364"&&$_SESSION["sIdname"]!="md12456"&&$_SESSION["sIdname"]!="md29262"&&$_SESSION["sIdname"]!="md20278"&&$_SESSION["sIdname"]!="md27035"&&$_SESSION["sIdname"]!="md21329"&&$_SESSION["sIdname"]!="md24535")
?>
<TR>
	<TD align="right" class="tb_detail" valign="top">�Ѵ������ : </TD>
	<TD colspan="2">
		<select size="1" name="detail" id="detail" onChange="listb(<?=$counter?>)">
        <?
		 	$app = "select * from applist where status='Y' ";
	  		$row = mysql_query($app);
	 	 	while($result = mysql_fetch_array($row)){
		?>
        	<option value="<?=$result['appvalue']?>"><?=$result['applist']?></option>
        <?
	  		}	
		?>
		 <!--<option value="FU01 ��Ǩ����Ѵ">��Ǩ����Ѵ</option>
		 <option value="FU02 ����ŵ�Ǩ">����ŵ�Ǩ</option>
		<option value="FU03 �͹�ç��Һ��">�͹�ç��Һ��</option>
		<option value="FU04 �ѹ�����">�ѹ�����</option>
		<option value="FU05 ��ҵѴ">��ҵѴ</option>
		<option value="FU06 �ٵ�">�ٵ�</option>
		<option value="FU07 ��չԡ�ѧ���">��չԡ�ѧ���</option>
		<option value="FU08 Echo">Echo</option>
		<option value="FU09 ��š�д١">��š�д١</option>
		<option value="FU10 ����Ҿ">����Ҿ</option>
		<option value="FU11 ��Ǩ����Ѵ���������ѵԼ������">��Ǩ����Ѵ���������ѵԼ������</option>
		<option value="FU12 �ǴἹ��">�ǴἹ��</option>
		<option value="FU13 ��ͧ������">��ͧ������</option>
		<option value="FU14 ������ʹ��辺ᾷ��">������ʹ��辺ᾷ��</option>
		<option value="FU15 OPD �͡����">OPD �͡����</option>
		<option value="FU16 ��Թԡ�����">��Թԡ�����</option>
		<option value="FU22 ��Ǩ����ѴOPD �Ǫ��ʵ���蹿�">��Ǩ����ѴOPD �Ǫ��ʵ���蹿�</option>
        <option value="FU26 EMG">EMG</option>
        <option value="FU27 X-ray ��͹��ᾷ��">X-ray ��͹��ᾷ��</option>
        <option value="FU28 Lab ��͹��ᾷ��">Lab ��͹��ᾷ��</option>
        <option value="FU29 X-ray + Lab ��͹��ᾷ��">X-ray + Lab ��͹��ᾷ��</option>-->
		</select><BR>
		���� : <INPUT TYPE="text" NAME="detail2" size="19">
	</TD>
</TR>
<TR>
	<TD align="right" class="tb_detail">���㺹Ѵ��� : </TD>
	<TD colspan="2">
		<select name="room" id='room'>
			<option <?php if($counter=="1") echo " Selected ";?>>�ش��ԡ�ùѴ��� 1</option>
			<option <?php if($counter=="2") echo " Selected ";?>>�Ҥ������������õ�</option>
			<option <?php if($counter=="3") echo " Selected ";?>>Ἱ�����¹</option>
			<option>��ͧ�ء�Թ</option>
			<option>�ͧ�ѹ�����</option>
			<option>Ἱ���Ҹ��Է��</option>
			<option>Ἱ��͡�����</option>
			<option>�ͧ�ٵ�-����</option>
			<option>����Ҿ</option>  <!--#8-->
			<option>��չԡ�ѧ���</option>
			<option>��ͧ��Ǩ�ѡ��(��)</option>
			<option>�ǴἹ��</option>
        	<option>��ͧ��Ǩ�ѡ��(��)</option>
        	<option>��ͧ��Ǩ����Ҿ�ӺѴ(�֡����Ҿ)</option>
        	<option>��Ǩ����Ѵ OPD�Ǫ��ʵ���鹿�</option>
        	<option>��չԡ�ä�</option>
		 	<option>����Ҿ�ӺѴ��� 2</option>
         	<option>��ͧ���Թ����� ����4</option>  <!--#17-->
		</select>
	</TD>

</TR>
<TR>
	<TD align="right" class="tb_detail">���� : </TD>
	<TD colspan="2">
		<select name="capptime" id='capptime'>
			
			<option selected>08:00 �. - 10.00 �.</option>
			<option>08:00 �. - 11.00 �.</option>
			<option>07:00 �.</option>
			<option>07:30 �.</option>
			<option>08:00 �.</option>
			<option>08:30 �.</option>
			<option>09:00 �.</option>
			<option>09:30 �.</option>
			<option>10:00 �.</option>
			<option>10:30 �.</option>
			<option>11:00 �.</option>
			<option>11:30 �.</option>
			<option>13:00 �.</option>
			<option>13:30 �.</option>
			<option>14:00 �.</option>
			<option>14:30 �.</option>
			<option>15:00 �.</option>
			<option>15:30 �.</option>
			<option>16:00 �.</option>
			<option>16:30 �.</option>
			<option>17:00 �.</option>
			<option>17:30 �.</option>
			<option>18:00 �.</option>
			<option>18:30 �.</option>
			<option>19:00 �.</option>
			<option>19:30 �.</option>
			<option>20:00 �.</option>
			<option>21:00 �.</option>
		</select>
	</TD>
</TR>
<TR>
	<TD align="right" class="tb_detail">��Ժѵԡ�͹��ᾷ�� : </TD>
	<TD colspan="2">
		<select size="1" name="advice" id="advice">
    <option value="�����">�����</option>
    <option>����ͧ��������������</option>
    <option>�������ҹ����������ѧ���� 20:00 �.(���������������)</option>
    <option>�������ҹ����������ѧ���� 24:00 �.(���������������)</option>
	<option>���������������ѧ���� 20:00 �.</option>
    <option>���������������ѧ���� 24:00 �.</option>
	<option>���������������ѧ���� .............. �.</option>
	<option>�͡����� ��͹��ᾷ��</option>
         <option>������������ͧ��дѺ �����Ū��,�駺���ǳ�鹤� ᢹ ��Т�</option>
	
  </select>
	</TD>
</TR>
<TR>
	<TD align="right" class="tb_detail">������ʹ : </TD>
	<TD><div id="div_list_lab">&nbsp;</div></TD>
	<TD><A HREF="javascript:void(0);" Onclick="show_listlab();"><IMG SRC="../butcalendar.gif" WIDTH="21" HEIGHT="20" BORDER="0" ALT=""></A>
	</TD>
</TR>
<TR>
	<TD align="right"  class="tb_detail" valign="top">�͡����� : </TD>
	<TD colspan="2">
		<TEXTAREA NAME="xray" ROWS="4" COLS="26"></TEXTAREA>
	</TD>
</TR>
<TR>
	<TD align="right"  class="tb_detail">��ҵѴ : </TD>
	<TD colspan="2">
		<SELECT NAME="operate">
			<Option value="">�����</Option>
			<Option value="Excision">Excision</Option>
			<Option value="Proctoscope">Proctoscope</Option>
			<Option value="Sigmoidoscope">Sigmoidoscope</Option>
			<Option value="Hemorrhoidectomy">Hemorrhoidectomy</Option>
			<Option value="Coagulation">Coagulation</Option>
			<Option value="Debridement">Debridement</Option>
			<Option value="Suture">Suture</Option>
			<Option value="Herniorrhaphy">Herniorrhaphy</Option>
		</SELECT>
	</TD>
</TR>
<TR>
	<TD align="right"  class="tb_detail">�Ѥ�չ : </TD>
	<TD colspan="2">
		<SELECT NAME="inj">
			<Option value="">�����</Option>
			<Option value="Tritunrix Hb., DPV">Tritunrix Hb., DPV</Option>
			<Option value="DPT,OPV">DPT,OPV</Option>
			<Option value="JEV">JEV</Option>
			<Option value="MMR">MMR</Option>
			<Option value="OPV">OPV</Option>
			<Option value="HBV">HBV</Option>

		</SELECT>
	</TD>
</TR>
<TR>
	<TD align="right"  class="tb_detail">���� : </TD>
	<TD colspan="2"><Div id="list1" style="left:100PX;top:350PX;position:absolute;"></Div><input type="text" name="other" id="other" size="30" onKeyPress="searchOther1(this.value,3);"></TD>
</TR>
<TR>
	<TD align="center" colspan="3">
		<INPUT TYPE="submit" value="��ŧ">
	</TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
</FORM>
	
	</TD>
	
	<TD width="55%"  valign="top">
		<div id="div_right_list" ></div>
	</TD>
</TR>
</TABLE>
<!-- 
	<div id="slidemenubar2" style="left:-405" onMouseover="pull()" onMouseout="draw()"></div>
 -->
 <div id="slidemenubar2" style="left:-405" onMouseover="pull()" onMouseout="draw()"></div>
<script language="JavaScript1.2">

	if (document.all){

		themenu=document.all.slidemenubar2.style
		rightboundary=0
		leftboundary=-400
	}else{
		themenu=document.layers.slidemenubar
		rightboundary=400
		leftboundary=10
	}

	function pull(){
		document.getElementById('room').style.display = 'none';
		document.getElementById('capptime').style.display = 'none';
		document.getElementById('detail').style.display = 'none';
		document.getElementById('advice').style.display = 'none';

		
		
		if (window.drawit)
			clearInterval(drawit)
		pullit=setInterval("pullengine()",5)
	}

	function draw(){
		document.getElementById('room').style.display = '';
		document.getElementById('capptime').style.display = '';
		document.getElementById('detail').style.display = '';
		document.getElementById('advice').style.display = '';
		clearInterval(pullit)
		drawit=setInterval("drawengine()",5)
	}

	function pullengine(){
		if (document.all && themenu.pixelLeft < rightboundary)
			themenu.pixelLeft+=20
		else if(document.layers && themenu.left<rightboundary)
			themenu.left+=5
		else if (window.pullit)
			clearInterval(pullit)
	}

	function drawengine(){
		if (document.all && themenu.pixelLeft > leftboundary)
			themenu.pixelLeft-=20
		else if(document.layers && themenu.left > leftboundary)
			themenu.left-=5
		else if (window.drawit)
			clearInterval(drawit)
	}
</script>

</body>
<?php include("unconnect.inc");?>
</html>