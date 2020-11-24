<?php 
include 'bootstrap.php';

$configs = array('host' => '192.168.131.250', 'port' => '', 'dbname' => 'smdb', 'user' => 'remoteuser', 'pass' => '' );
$db = Mysql::load($configs);

$id = $_REQUEST['id'];

if ($id) {

$sql = "SELECT * FROM `patdata` WHERE `idno` = '$id' ";
$db->select($sql);
$items = $db->get_items();

?>
<table>
<tr>
    <td>row_id</td>
    <td>date</td>
    <td>code</td>
    <td>detail</td>
    <td>price</td>
    <td>yprice</td>
    <td>nprice</td>
    <td></td>
</tr>

<?php
foreach ($items as $key => $item) {
    ?>
    <tr>
        <td><?=$item['row_id'];?></td>
        <td><?=$item['date'];?></td>
        <td><?=$item['code'];?></td>
        <td><?=$item['detail'];?></td>
        <td><?=$item['price'];?></td>
        <td><?=$item['yprice'];?></td>
        <td><?=$item['nprice'];?></td>
        <td><a href="edit_opacc5.php?type=patdata&id=<?=$item['row_id'];?>" target="edit">edit</a></td>
    </tr>
    <?php
}
?>
</table>

<?php 
}