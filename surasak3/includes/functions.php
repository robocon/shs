<?php

// define php version id e.g. 50217 is PHP Version 5.2.17
if (!defined('PHP_VERSION_ID')) {
	$version = explode('.', PHP_VERSION);
	define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
}

$def_month_th = array('01' => '�.�.', '02' => '�.�.', '03' => '��.�', '04' => '��.�.', '05' => '�.�.', '06' => '��.�.', '07' => '�.�.', '08' => '�.�.', '09' => '�.�.', '10' => '�.�.', '11' => '�.�.', '12' => '�.�.');
$def_fullm_th = array('01' => '���Ҥ�', '02' => '����Ҿѹ��', '03' => '�չҤ�', '04' => '����¹', 
					'05' => '����Ҥ�', '06' => '�Զع�¹', '07' => '�á�Ҥ�', '08' => '�ԧ�Ҥ�', 
					'09' => '�ѹ��¹', '10' => '���Ҥ�', '11' => '��Ȩԡ�¹', '12' => '�ѹ�Ҥ�');
$th_number = array('1' => '�','2' => '�','3' => '�','4' => '�','5' => '�','6' => '�','7' => '�','8' => '�','9' => '�','0' => '�');

function to_thai_number($number){
	global $th_number;
	$lists = str_split($number);
	$th_str = '';
	foreach( $lists as $key => $item ){

		if( isset($th_number[$item]) ){
			$th_str .= $th_number[$item];
		}else{
			$th_str .= $item;
		}
		
	}
	return $th_str;
}
/**
 * ��˹��
 * $total	�ӹǹ������
 * $page	˹�ҷ����ѧ�ʴ�
 * $params	parameter ��ҧ�
 * $limit	�ӹǹ����ͧ�������ʴ����˹��
 */
function pagination($total, $page = 1, $params = false, $limit = 50){
	$total = ceil(( $total / $limit ));
	if( $total > 1 ){
		?><div class="sm-pagging-contain"><?php
		for( $i = 1; $i <= $total; $i++ ){
			$active = ( $i == $page ) ? 'pagging-active' : '' ;

			$url = DOMAIN_PATH.'/'.$params.'&page='.$i;
			?>
			<div class="sm-pagging <?=$active;?>"><a href="<?=$url;?>"><?=$i;?></a></div>
			<?php
		}
		?></div><?php
	}
}

if( !function_exists('input') ){
	function input($t, $d = false){
		$v = ( isset($_POST[$t]) ) ? trim($_POST[$t]) : ( ( isset($_GET[$t]) ) ? trim($_GET[$t]) : $d );
		if( $v !== false && $v !== NULL ){
			return htmlspecialchars(strip_tags($v));
		}else{
			return $d;
		}
	}
}

if( !function_exists('input_post') ){
	function input_post($t, $d = false){
		$v = ( !empty($_POST[$t]) ) ? trim($_POST[$t]) : $d ;
		if( $v !== false ){
			$res = htmlspecialchars(strip_tags($v), ENT_QUOTES);
		}else{
			$res = $v;
		}
		return $res;
	}
}

if( !function_exists('input_get') ){
	function input_get($t, $d = false){
		$v = ( isset($_GET[$t]) ) ? trim($_GET[$t]) : $d ;
		if( $v !== false ){
			$res = htmlspecialchars(strip_tags($v), ENT_QUOTES);
		}else{
			$res = $v;
		}
		return $res;
	}
}

if( !function_exists('clean_input') ){
	function clean_input(){
		
	}
}

/**
 * �֧��Ҩҡ id ����� method GET
 */
function getId(){
	$id = isset($_GET['id']) ? intval($_GET['id']) : false ;
	return $id;
}

function errorMsg($status = NULL, $id = ''){
	$msg = '�ѹ�֡';
	if( $status === 'edit' ){
		$msg = '���';
	} elseif( $status === 'delete' ) {
		$msg = 'ź';
	}

	return "�������ö{$msg}�������� ��س������� $id ��������駼������к����ͷӡ����䢵���";
}

/**
 * Clean single quote and double quote with mysql escape string ... some thing like Injection
 *
 * Example
 *
 * $sql = clean_query(
 * 		"SELECT * FROM XXX WHERE `id` = ':id' AND `pass` = ':pass';",
 * 		array(':id' => 'test', ':pass' => '1234'));
 */
function clean_sql($sql, $args){

	foreach($args as $key => $arg){
		$pure_arg = mysql_real_escape_string($arg);
		$sql = str_replace($key, $pure_arg, $sql);
	}

	return $sql;
}

/**
 * Debug in pre tag
 */
function dump($args){
	echo '<pre>';
	var_dump($args);
	echo '</pre>';
}

/**
 * Check user from $_SESSION['sRowid']
 */
function authen(){
	$auth = isset($_SESSION['sRowid']) ? $_SESSION['sRowid'] : false ;
	return $auth;
}

/**
 *
 */
function post2null($args, $method = 'post'){

	if(is_array($args)){
		$items = array();
		foreach($args as $key => $val){
			if(!is_array($val)){
				$items[$key] = filter2null($key, $method);
			}else{
				$items[$key] = $val;
			}
		}
	}
	return $items;
}

function filter2null($name, $method_type = 'post'){

	$method = ( $method_type === 'post' ) ? $_POST : $_GET ;
	$item = isset($method[$name]) ? trim($method[$name]) : null ;
	return $item;
}

/**
 * Filter from white lists
 */
function filter_post($items, $default = null){
	$post = array();
	foreach($items as $key => $name){
		if(isset($_POST[$key])){
			if(gettype($_POST[$key]) == 'string'){
				$post[$key] = strip_tags(trim($name));
			}else{
				$post[$key] = $name;
			}
		}else{
			$post[$key] = $default;
		}
	}
	return $post;
}

/**
 * �֧��� Session
 */
function get_session($name){
	return $_SESSION[$name];
}

function set_session($n, $v){
	if( isset($_SESSION[$n]) ){
		$_SESSION[$n] = $v;
	}
}

/**
 * Redirect Page to any location
 */
function redirect($to = 'index.php', $msg = null){
	if(!empty($msg)){
		$_SESSION['x-msg'] = $msg ;
	}
	header("Location: $to");
	exit;
}
					
function getMonthValue($keyMatch){
	global $def_month_th;
	$val = $def_month_th[$keyMatch];
	return $val;
}

function getDateList($name = 'days', $match = null){
	$def_day = range(1, 31);
	?>
	<select name="<?=$name;?>">
		<?php foreach($def_day as $key => $day): ?>
		<?php $select = ( $match == $day ) ? 'selected="selected"' : '' ; ?>
		<option value="<?=sprintf('%02d',$day);?>" <?=$select;?>><?=$day;?></option>
		<?php endforeach; ?>
	</select>
	<?php
}

/**
 * �ʴ���͹�� Dropdown
 * $name string ���ͧ͢�����
 * $match string ��ҷ��Ѻ���� value
 */
function getMonthList($name = 'months', $match = null, $class_name = false){
	global $def_month_th;
	if( empty($def_month_th) ){
		echo '��س��Դ global variable � php.ini';
		exit;
	}
	?>
	<select name="<?=$name;?>" class="<?=$class_name;?>">
		<?php foreach($def_month_th as $key => $month): ?>
		<?php $select = ( $match == $key ) ? 'selected="selected"' : '' ; ?>
		<option value="<?=$key;?>" <?=$select;?>><?=$month;?></option>
		<?php endforeach; ?>
	</select>
	<?php
}

/**
 * �ʴ����� Dropdown
 * $name	string	���ͧ͢ input
 * $thai	bool	�繵�Ǻ͡��Ҩ�����ʴ��繻� �� �������
 * $year	int		�繵�ǡ�˹�����ʴ� selected
 * range	mixed	��˹���ҹ����ش仨��֧�ҡ�ش����� �� ����ѡ
 *
 * @example
 * getYearList('new_name', true, 2558, array(2556,2557,2558,2559));
 * �繡�õ�駪��� input ���� new_name �ʴ��繻� �� ����ʴ��� 2558 �繤������������ժ�ǧ����ʴ��ŵ����� 2556 �֧ 2559
 */
function getYearList($name = 'years', $thai = false, $year = null, $range = array(), $class_name = false){
	?>
	<select name="<?=$name;?>" class="<?=$class_name;?>">
		<?php
		if( !empty($range) ){
			$y_min = min($range);
			$y_max = max($range);
		}else{
			$y_min = date("Y") - 5 ;
			$y_max = date("Y") + 5 ;
		}

		for($a=$y_min; $a<=$y_max; $a++){

			$y = ( $thai === true ) ? $a + 543 : $a ;
			?>
			<option value="<?=$a?>" <?php if($year==$a) echo "selected='selected'"?>><?=$y?></option>
			<?php
		}
		?>
	</select>
	<?php
}

/**
 * �.�. �� �.�.
 */
if( !function_exists('ad_to_bc') ){
	function ad_to_bc($time = null){
		$time = preg_replace_callback('/^\d{4,}/', 'cal_to_bc', $time);
		return $time;
	}
}

if( !function_exists('cal_to_bc') ){
	function cal_to_bc($match){
		return ( $match['0'] + 543 );
	}
}

/**
 * �.�. �� �.�.
 */
if( !function_exists('bc_to_ad') ){
	function bc_to_ad($time = null){
		$time = preg_replace_callback('/^\d{4,}/', 'cal_to_ad', $time);
		return $time;
	}
}

if( !function_exists('cal_to_ad') ){
	function cal_to_ad($match){
		if( intval($match['0']) === 0 ){
			return $match['0'];
		}
		return ( $match['0'] - 543 );
	}
}


function get_date_ad($full = true){
	$format = ( $full === false ) ? 'Y-m-d' : 'Y-m-d H:i:s' ;
	return date($format);
}

function get_date_bc($format = false){
	
	$format = ( $format !== false ) ? $format : 'Y-m-d H:i:s' ;
	$date_bc = ad_to_bc(date($format));
	
	return $date_bc;
}

/**
 * ���¡�ٻէ�����ҳ(���Ԩ����������ҧ 1�� �֧ 30��)
 *
 * $long	bool	�繡�����¡�ٻ�Ẻ����ٻẺ
 * $en		bool	���¡�ٻ�Ẻ �.�.
 * 
 * get_year_checkup(); // 59
 * get_year_checkup(true); // 2559
 */
function get_year_checkup($long = false, $en = false){
	$d = date('d');
	$m = date('m');
	$y = date('Y') + 543 ;

	if( $m >= 10 && $d >= 1 ){
		$y += 1;
	}

	if( $en === true ){
		$y -= 543 ;
	}

	if( $long === true ){
		return $y;
	}

	$y = substr($y, 2);
	return $y;
}

function generate_token($name){
	$session_id = session_id();
	return hash('sha256', $session_id.$name.TOKEN_KEY);
}

function check_token($token, $name){
	$check_token = false;
	$get_token = generate_token($name);
	if( $token === $get_token ){
		$check_token = true;
	}
	return $check_token;
}