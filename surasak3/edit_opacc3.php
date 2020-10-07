<?php 
include 'bootstrap.php';

$configs = array('host' => '192.168.1.2', 'port' => '', 'dbname' => 'smdb', 'user' => 'remoteuser', 'pass' => '' );
$db = Mysql::load($configs);

$date = $_REQUEST['date'];
$hn = $_REQUEST['hn'];

if($date && $hn){

$sql = "SELECT * FROM `depart` WHERE `date` LIKE '$date%' AND `hn` = '$hn' ";
$db->select($sql);
$items = $db->get_items();
?>
<table>

<tr>
    <td>row_id</td>
    <td>date</td>
    <td>depart</td>
    <td>detail</td>
    <td>price</td>
    <td>sumyprice</td>
    <td>sumnprice</td>
    <td>paid</td>
    <td>tvn</td>
    <td>cashok</td>
    <td></td>
</tr>

<?php
foreach ($items as $key => $item) {
    ?>
    <tr>
        <td><a href="edit_opacc4.php?id=<?=$item['row_id'];?>" target="patdata"><?=$item['row_id'];?></a></td>
        <td><?=$item['date'];?></td>
        <td><?=$item['depart'];?></td>
        <td><?=$item['detail'];?></td>
        <td><?=$item['price'];?></td>
        <td><?=$item['sumyprice'];?></td>
        <td><?=$item['sumnprice'];?></td>
        <td><?=$item['paid'];?></td>
        <td><?=$item['tvn'];?></td>
        <td><?=$item['cashok'];?></td>
        <td><a href="edit_opacc5.php?type=depart&id=<?=$item['row_id'];?>" target="edit">edit</a></td>
    </tr>
    <?php
}
?>
</table>

<?php 
}