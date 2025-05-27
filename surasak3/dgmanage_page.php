<?php
include_once dirname(__FILE__).'/bootstrap.php';
include_once dirname(__FILE__).'/includes/JSON.php';
$json = new Services_JSON();

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");
?>
<div class="container mt-2">
    <h3>จัดการข้อมูลกลุ่มยาที่มีโอกาสแพ้</h3>
    <div class="mt-2">
        <button type="button" class="btn btn-primary" onclick="addReactGroup()">➕&nbsp;เพิ่มกลุ่ม</button>
    </div>
    <table class="table table-striped mt-2">
        <tr>
            <th>#</th>
            <th>ชื่อ</th>
            <th>จำนวนยา</th>
            <th colspan="2">จัดการ</th>
        </tr>
        <?php 
        $sql = "SELECT a.*,COUNT(b.id) AS cnt 
        FROM ( SELECT * FROM `drugreact_group` WHERE `status` = 'y' ORDER BY `id` ASC ) AS a 
        LEFT JOIN `drugreact_group_list` AS b ON a.`id` = b.`drugreact_group` 
        GROUP BY a.`id`";
        $q = $dbi->query($sql);
        $i = 1;
        while ($a = $q->fetch_assoc()) {
            ?>
            <tr id="item-tr-<?=$a['id'];?>">
                <td><?=$i;?></td>
                <td id="item-id-<?=$a['id'];?>"><?=$a['name'];?></td>
                <td><?=$a['cnt'];?></td>
                <td>
                    <a href="javascript:void(0);" title="แก้ไข" onclick="editReactGroup('<?=$a['id'];?>')">✏️</a>
                </td>
                <td>
                    <a href="javascript:void(0);" title="ลบ" onclick="delReactGroup('<?=$a['id'];?>')">🗑️</a>
                </td>
            </tr>
            <?php
            $i++;
        }
        ?>
    </table>
</div>