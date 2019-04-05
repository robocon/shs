<?php 
// header('Content-Type: text/html; charset=utf-8');
include '../bootstrap.php';

/**
 * @todo
 * - ·ĞàºÕÂ¹
 * - lab 
 * - «Ñ¡»ÃĞÇÑµÔ
 * - á¾·Âì
 */

$configs = array(
    'host' => '192.168.1.2',
    'port' => '3306',
    'dbname' => 'smdb',
    'user' => 'remoteuser',
    'pass' => ''
);

$db = Mysql::load($configs);
// $db->exec("SET NAMES UTF8");


$sql = "CREATE TEMPORARY TABLE `tmp_regis` 
SELECT a.`hn`,a.`ptname`,a.`vn` 
FROM `opday` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
WHERE a.`thidate` LIKE '2562-04-01%' 
AND b.`employee` = 'y' ";
dump($sql);
$db->exec($sql);

$sql = "SELECT * FROM `tmp_regis`";
dump($sql);
$db->select($sql);
$items = $db->get_items();
// dump($sql);
dump($items);