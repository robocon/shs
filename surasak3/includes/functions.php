<?php

// define php version id e.g. 50217 is PHP Version 5.2.17
if (!defined('PHP_VERSION_ID')) {
	$version = explode('.', PHP_VERSION);
	define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
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
function filter_post($items){
	$post = array();
	foreach($items as $key => $name){
		if(isset($_POST[$key])){
			if(gettype($_POST[$key]) == 'string'){
				$post[$key] = strip_tags(trim($name));
			}else{
				$post[$key] = $name;
			}
		}else{
			$post[$key] = null;
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


function getDateList(){

}

function getMonthList(){

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
function getYearList($name = 'years', $thai = false, $year = null, $range = array()){
	?>
	<select name="$name">
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
