<?php 
include 'bootstrap.php';
?>
<form action="edit_opacc2.php" method="post">

    <div>
        วันที่: <input type="text" name="date" id="date" value="<?=$_REQUEST['date'];?>"> * 2563-09-13
    </div>
    <div>
        HN: <input type="text" name="hn" id="hn" value="<?=$_REQUEST['hn'];?>">
    </div>
    <div>
        <button type="submit">search</button>
    </div>

</form>

<?php 

if ($_REQUEST['hn']) {

    $date = $_REQUEST['date'];
    $hn = $_REQUEST['hn'];
    $sql = "SELECT * FROM `opacc` WHERE `date` LIKE '$date%' AND `hn` = '$hn' ";
    $configs = array('host' => '192.168.131.250', 'port' => '', 'dbname' => 'smdb', 'user' => 'remoteuser', 'pass' => '' );
    $db = Mysql::load($configs);

    $db->select($sql);
    $items = $db->get_items();

    ?>
    <table>
        <tr>
            <td>row_id</td>
            <td>date</td>
            <td>depart</td>
            <td>detail</td>
            <td>credit</td>
            <td>ptright</td>
            <td>billno</td>
            <td>vn</td>
            <td>paidcscd</td>
            <td></td>
        </tr>
    
    <?php
    foreach ($items as $key => $item) { 

        ?>
        <tr>
            <td><a href="edit_opacc3.php?date=<?=$date;?>&hn=<?=$hn;?>" target="depart"><?=$item['row_id'];?></a></td>
            <td><?=$item['date'];?></td>
            <td><?=$item['depart'];?></td>
            <td><?=$item['detail'];?></td>
            <td><?=$item['credit'];?></td>
            <td><?=$item['ptright'];?></td>
            <td><?=$item['billno'];?></td>
            <td><?=$item['vn'];?></td>
            <td><?=$item['paidcscd'];?></td>
            <td><a href="edit_opacc5.php?type=opacc&id=<?=$item['row_id'];?>" target="edit">edit</a></td>
        </tr>
        <?php
    }
    ?>
    </table>
    <?php
}