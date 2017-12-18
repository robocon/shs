<?php
include 'bootstrap.php';

$page = input('page');
$action = input_post('action');
$db = Mysql::load();

if ( empty($page) ) {
    
    include 'chk_menu.php';

    $sql = "SELECT * FROM `labcare` WHERE `chkup` = 'chk' AND `lab_list` IS NULL ";
    $db->select($sql);

    $items = $db->get_items();
    ?>
    <div>
        <a href="chk_labcare.php?page=form">สร้างรหัส</a>
    </div>
    <div>
        <h3>ระบบจัดการรายการ Lab สำหรับการตรวจสุขภาพ</h3>
    </div>
    <div>
        <table class="chk_table">
            <tr>
                <th>#</th>
                <th>รหัสLab</th>
                <th>รายละเอียด</th>
                <th>ราคา</th>
                <th>เบิกได้</th>
                <th>เบิกไม่ได้</th>
                <th>ประเภท</th>
            </tr>
            <?php
            foreach ($items as $key => $item) {
                ?>
                <tr>
                    <td><?=dump($item);?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
    <?php
} elseif ( $page == 'form' ) {
    ?>
    <form action="chk_labcare.php" method="post">
        <div>
        
        </div>
    </form>
    <?php
}
?>

