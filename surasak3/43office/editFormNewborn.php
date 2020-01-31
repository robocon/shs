<?php 
include '../bootstrap.php';
include 'head.php';

$db = Mysql::load();

$id = input('id');
// dump($id);
$sql = "SELECT a.*,b.`discharge`
FROM `43newborn` AS a 
LEFT JOIN `gyn_newborn` AS b ON a.`gyn_id` = b.`id` 
WHERE `gyn_id` = '$id' ";

// dump($sql);

$db->select($sql);
$item = $db->get_item();

// dump($item);

?>
<form action="editFormNewborn.php" method="post">

<table>
    <tr>
        <td>รหัสสถานบริการ : </td>
        <td><input type="text" name="HOSPCODE" value="<?=$item['HOSPCODE'];?>"></td>
    </tr>
    <tr>
        <td>ทะเบียนบุคคลเด็ก : </td>
        <td></td>
    </tr>
    <tr>
        <td>เลขที่บัตรประชาชน : </td>
        <td></td>
    </tr>
    <tr>
        <td>ทะเบียนบุคคลแม่ : </td>
        <td></td>
    </tr>
    <tr>
        <td>ครรภ์ที่ : </td>
        <td></td>
    </tr>
    <tr>
        <td>อายุครรภ์เมื่อคลอด : </td>
        <td></td>
    </tr>
    <tr>
        <td>วันที่-เวลาคลอด : </td>
        <td></td>
    </tr>
    <tr>
        <td>สถานที่คลอด : </td>
        <td></td>
    </tr>
    <tr>
        <td>ลำดับที่ของทารกที่คลอด : </td>
        <td></td>
    </tr>
    <tr>
        <td>วิธีการคลอด : </td>
        <td></td>
    </tr>
    <tr>
        <td>ประเภทผู้ทำคลอด : </td>
        <td></td>
    </tr>
    <tr>
        <td>น้ำหนักแรกคลอด : </td>
        <td>กรัม</td>
    </tr>
    <tr>
        <td>ภาวะการขาดออกซิเจน : </td>
        <td></td>
    </tr>
    <tr>
        <td>ได้รับ VIT K : </td>
        <td></td>
    </tr>
    <tr>
        <td>ได้รับการตรวจ TSH : </td>
        <td></td>
    </tr>
    <tr>
        <td>ผลการตรวจ TSH</td>
        <td></td>
    </tr>
    <tr>
        <td colspan="2">
            <button type="submit"></button>
        </td>
    </tr>
</table>

</form>