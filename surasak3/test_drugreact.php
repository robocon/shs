<?php 
require_once 'bootstrap.php';
require_once 'class_file/class_drugreact.php';

$hn = '47-4661';
// $hn = '47-1';

$drugreact = new Drugreact();
// $res = $drugreact->getDrugreactFromHn($hn);

// $res = $drugreact->getGroupNameFromHn($hn);

// $fields = array('groupname');
// $where = "AND groupname <> ''";
// $group = 'GROUP BY groupname';
// $res = $drugreact->getDrugreactFromHn($hn, $fields, $where, $group);

// $res = $drugreact->getDrugreactInGroupRelation($hn);

$name = "กลุ่ม G6PD Deficiency";
// $res = $drugreact->getDrugreactGroup();

$id = 9;
$res = $drugreact->getDrugreactGroupList($id);
var_dump($res);