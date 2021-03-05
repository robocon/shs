<?php 
include 'bootstrap.php';
$db = Mysql::load();

$action = $_GET['action'];
if($action == 'cancel')
{
    $id = $_GET['id'];
    if(empty($id))
    {
        redirect('cancel_admit.php',"ไม่มี id ง้ออออออออออออ");
        exit;
    }
    $sql = "SELECT a.`row_id`,a.`bedcode`,a.`dcdate`,b.`row_id` AS `bedRow`FROM `ipcard` AS a LEFT JOIN `bed` AS b ON b.`an` = a.`an`WHERE a.`row_id` = :id LIMIT 1 ";
    $db->select($sql, array(':id' => $id));
    $item = $db->get_item();
    if(empty($item['bedRow']))
    {
        $dcDate = (date('Y')+543).date('-m-d').' 00:00:00';
        $sql = "UPDATE `ipcard` SET `dcdate` = '$dcDate' WHERE `row_id` = :id ";
        $save = $db->exec($sql, array(':id' => $id));
        if($save===true)
        {
            $msg = "ยกเลิกเรียบร้อย";
        }
        else
        {
            $msg = "ไม่สามารถดำเนินการได้ ".$save['error'];
        }
    }
    else
    {
        $msg = "ไม่สามารถยกเลิกได้ กรุณาประสาน WARD ";
    }
    redirect('cancel_admit.php', $msg);
    exit;
}

?>
<style>
.chk_table{
    border-collapse: collapse;
}
.chk_table th,
.chk_table td{
    padding: 3px;
    border: 1px solid black;
}
</style>
<h3>ข้อมูลผู้ป่วยใน ไม่มีเตียง และไม่ได้ทำการ Discharge </h3>
<?php 
if($_SESSION['x-msg'])
{
    ?><div style="border: 2px solid #a2a200;background-color: #ffff9d;padding:8px;"><?=$_SESSION['x-msg'];?></div><?php 
    $_SESSION['x-msg'] = NULL;
}
?>
<table class="chk_table">
    <tr>
        <th>วันที่ขอเลขผู้ป่วยใน</th>
        <th>AN</th>
        <th>HN</th>
        <th>ชื่อ-สกุล</th>
        <th>เลขเตียง(ทะเบียน)</th>
        <th>เลขเตียง(ward)</th>
        <th>ผู้บันทึก</th>
        <th></th>
    </tr>
<?php 
$prev1Year = ( date("Y", strtotime("-1 year")) + 543 ).'-'.date("m-d", strtotime("-1 year"));
$sql = "SELECT `row_id`,`date`,`an`,`hn`,`ptname`,`bed` FROM `ipcard` WHERE `date` >= '$prev1Year' AND `bedcode` IS NULL AND `dcdate` = '0000-00-00 00:00:00' ";
$db->select($sql);
$items = $db->get_items();
foreach ($items as $key => $item) { 

    $id=$item['row_id'];

    list($opdDate, $opdTime) = explode(' ', $item['date']);
    list($y, $m, $d) = explode('-', $opdDate);
    $hndatehn = $d.'-'.$m.'-'.$y.$item['hn'];
    $sql = "SELECT `officer` FROM `opday` WHERE `thdatehn` = '$hndatehn' ";
    $db->select($sql);
    $user = $db->get_item();

    $sql = "SELECT `row_id` FROM `bed` WHERE `an` = '".$item['an']."' ";
    $db->select($sql);
    $bed = $db->get_item();
    // var_dump($bed);

    ?>
    <tr>
        <td><?=$item['date'];?></td>
        <td><?=$item['an'];?></td>
        <td><?=$item['hn'];?></td>
        <td><?=$item['ptname'];?></td>
        <td><?=$item['bed'];?></td>
        <td><?=$bed['row_id'];?></td>
        <td><?=$user['officer'];?></td>
        <td>
            <a href="cancel_admit.php?id=<?=$item['row_id'];?>&action=cancel">ยกเลิก</a>
        </td>
    </tr>
    <?php
}
?>
</table>