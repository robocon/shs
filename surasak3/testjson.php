<?php
include 'bootstrap.php';
include 'includes/JSON.php';

?>
<form action="testjson.php" method="post">
    <input type="text" name="1_1" value="1">
    <input type="text" name="1_2" value="1">
    <input type="text" name="1_2_detail" value="·´ÊÍº¼Ô´»¡µÔ">
    <input type="text" name="2_1" value="1">
    <input type="text" name="2_2" value="1">
    <input type="text" name="2_3" value="1">
    <button type="submit">Action</button>
</form>

<?php


dump($_POST);

$json = new Services_JSON();
$output = $json->encode($_POST);

var_dump($output);

// $set = array();
// foreach ($_POST as $key => $value) {
//     $value = htmlspecialchars($value, ENT_QUOTES);
//     $set[] = '"'.$key.'":"'.$value.'"';
// }
// $pre_set = implode(',', $set);
// dump('{'.$pre_set.'}');


