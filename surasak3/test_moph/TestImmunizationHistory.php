<?php 
function dump($txt)
{
    echo "<pre>";
    var_dump($txt);
    echo "</pre>";
}
function toTIS620($str)
{
	$str = iconv("UTF-8", "TIS-620", $str );
	return $str;
}

$post_request = array(
    'page' => 'ImmunizationHistory' // and other page Ex. ImmunizationHistory, ImmunizationTarget and ETC.
);

$post_query = http_build_query($post_request);
$curl = curl_init();
curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE);
curl_setopt($curl, CURLOPT_URL, "http://localhost/moph/index.php"); // ยังไม่เปิดใจเย็นๆ
curl_setopt($curl, CURLOPT_POSTFIELDS, $post_query);
curl_setopt($curl, CURLOPT_HTTPHEADER, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($curl);
curl_close($curl);


echo "<h3>Response FROM ImmunizationHistory</h3>";
$res_data = json_decode($output, true);

$res_data['result']['patient']['prefix'] = toTIS620($res_data['result']['patient']['prefix']);
$res_data['result']['patient']['first_name'] = toTIS620($res_data['result']['patient']['first_name']);
$res_data['result']['patient']['last_name'] = toTIS620($res_data['result']['patient']['last_name']);
echo "<pre>";
var_dump($res_data);
echo "</pre>";