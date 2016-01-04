<?php

// define php version id e.g. 50217 is PHP Version 5.2.17
if (!defined('PHP_VERSION_ID')) {
	$version = explode('.', PHP_VERSION);
	define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
}

function pagination($total, $page = 1, $params = false, $limit = 50){
	
	$total = ceil(( $total / $limit ));
	
	if( $total > 1 ){
		
		
		$base = ( $params !== false ) ? DOMAIN_REQUEST.'?'.$params.'&' : DOMAIN_REQUEST.'?' ;
		dump($base);
		// $base .= '?';
		// if( count($_GET) > 0 ){
		// 	$base .= '&';
		// }
		
		?><div class="sm-pagging-contain"><?php
		for( $i = 1; $i <= $total; $i++ ){
			$active = ( $i == $page ) ? 'pagging-active' : '' ;
			?>
			<div class="sm-pagging <?=$active;?>"><a href="<?=$base;?>page=<?=$i;?>"><?=$i;?></a></div>
			<?php
		}
		?></div><?php
	}
}

if( !function_exists('input') ){
	function input($t, $d = false){
		$v = ( isset($_POST[$t]) ) ? trim($_POST[$t]) : ( ( isset($_GET[$t]) ) ? trim($_GET[$t]) : $d );
		return htmlspecialchars(strip_tags($v));
	}
}

/**
 * ดึงค่าจาก id ที่เป็น method GET
 */
function getId(){
	$id = isset($_GET['id']) ? intval($_GET['id']) : false ;
	return $id;
}

function errorMsg($status = NULL, $id = ''){
	$msg = 'บันทึก';
	if( $status === 'edit' ){
		$msg = 'แก้ไข';
	} elseif( $status === 'delete' ) {
		$msg = 'ลบ';
	}
	
	return "ไม่สามารถ$msgข้อมูลได้ กรุณาเก็บรหัส $id นี้เพื่อแจ้งผู้ดูแลระบบเพื่อทำการแก้ไขต่อไป";
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
 * ดึงค่า Session
 */
function get_session($name){
	return $_SESSION[$name];
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

$def_month_th = array('01' => 'ม.ค.', '02' => 'ก.พ.', '03' => 'มี.ค', '04' => 'เม.ษ.', '05' => 'พ.ค.', '06' => 'มิ.ย.', '07' => 'ก.ค.', '08' => 'ส.ค.', '09' => 'ก.ย.', '10' => 'ต.ค.', '11' => 'พ.ย.', '12' => 'ธ.ค.');

function getMonthValue($keyMatch){
	global $def_month_th;
	$val = $def_month_th[$keyMatch];
	return $val;
}

function getDateList($name = 'days', $match = null){
	
}

/**
 * แสดงเดือนเป็น Dropdown
 *
 */
function getMonthList($name = 'months', $match = null){
	global $def_month_th;
	if( empty($def_month_th) ){
		echo 'กรุณาเปิด global variable ใน php.ini';
		exit;
	}
	?>
	<select name="<?=$name;?>">
		<?php foreach($def_month_th as $key => $month): ?>
		<?php $select = ( $match == $key ) ? 'selected="selected"' : '' ; ?>
		<option value="<?=$key;?>" <?=$select;?>><?=$month;?></option>
		<?php endforeach; ?>
	</select>
	<?php
}

/**
 * แสดงปีเป็น Dropdown
 * $name	string	ชื่อของ input
 * $thai	bool	เป็นตัวบอกว่าจะให้แสดงเป็นปี พศ หรือไม่
 * $year	int		เป็นตัวกำหนดการแสดง selected
 * range	mixed	กำหนดค่าน้อยสุดไปจนถึงมากสุดโดยใช้ปี คศ เป็นหลัก
 *
 * @example
 * getYearList('new_name', true, 2558, array(2556,2557,2558,2559));
 * เป็นการตั้งชื่อ input ชื่อ new_name แสดงเป็นปี พศ และแสดงปี 2558 เป็นค่าเริ่มต้นโดยมีช่วงการแสดงผลตั้งแต่ปี 2556 ถึง 2559
 */
function getYearList($name = 'years', $thai = false, $year = null, $range = array()){
	?>
	<select name="<?=$name;?>">
		<?php
		$th_int = ( $thai === true ) ? 543 : 0 ;
		if( !empty($range) ){

		}else{
			$y_min = ( date("Y")+$th_int ) - 5 ;
			$y_max = ( date("Y")+$th_int ) + 5 ;
		}
		for($a=$y_min;$a<$y_max;$a++){
			?>
			<option value="<?=$a?>" <?php if($year==$a) echo "selected='selected'"?>>
				<?=$a?>
			</option>
			<?php
		}
		?>
	</select>
	<?php
}

/**
 * ค.ศ. เป็น พ.ศ.
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
 * พ.ศ. เป็น ค.ศ.
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

/**
 * เรียกดูปีงบประมาณ(ปกติจะอยู่ระหว่าง 1ตค ถึง 30กย)
 *
 * $long	bool	เป็นการเรียกดูปีแบบเต็มรูปแบบ
 * $en		bool	เรียกดูปีแบบ ค.ศ.
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