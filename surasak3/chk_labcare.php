<?php
include 'bootstrap.php';

$page = input('page');
$action = input_post('action');
$db = Mysql::load();

include 'chk_menu.php';

if ( empty($page) ) {
    
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
    <div>
        <h3>ฟอร์มบันทึก</h3>
    </div>
    <div>
        <form action="chk_labcare.php" method="post">
            <div>
                รหัสLab: <input type="text" name="" id="">
            </div>
            <div>
                รายละเอียด: <input type="text" name="" id="">
            </div>
            <div>
                Part: <input type="text" name="" id=""> 
            </div>
            <div>
                ราคาเต็ม: <input type="text" name="" id=""> บาท
            </div>
            <div>
                เบิกได้: <input type="text" name="" id=""> บาท
            </div>
            <div>
                เบิกไม่ได้: <input type="text" name="" id=""> บาท
            </div>
            <div>
                ประเภทLab: <input type="radio" name="" id=""> ในรพ. <input type="radio" name="" id=""> นอกรพ.
            </div>
            <!--
            @todo
            [] labcareeditrow.php labนอกมีบริษัทให้เลือก
            -->
            <div>
                <button type="submit">บันทึกข้อมูล</button>
            </div>
        </form>
    </div>
    <?php
}
?>

