<?php

include 'bootstrap.php';


$action = input_post('action');
$page = input('page');
$db = Mysql::load();

if ( $action == "save" ) {
    $companyname = input_post('companyname');
    $status = input_post('status');
    $id = input_post('id', 0);

    // dump($companyname);
    // dump($status);

    if( empty($companyname) OR empty($status) ){

        echo "<p>กรุณากรอกข้อมูล ชื่อบริษัท และ เลือกสถานะ</p>";
        echo '<a href="javascript: window.history.back()">คลิกที่นี่ </a>เพื่อกลับไปแก้ไข'; 
        exit;
    }

    if( $id == 0 ){
        $sql = "INSERT INTO `chkcompany` (`code`,`name`,`status`) VALUES 
        ('$companyname','$companyname','$status');";
        $save = $db->insert($sql);

    }else if( $id > 0 ){
        $sql = "UPDATE `chkcompany` SET 
        `code` = '$companyname',
        `name` = '$companyname',
        `status` = '$status'
        WHERE `row_id` = '$id' LIMIT 1";
        $save = $db->update($sql);
    }  

    $msg = 'บันทึกข้อมูลเรียบร้อย';
    if( $save !== true ){
		$msg = errorMsg('save', $save['id']);
    }

    redirect('opd_chkcompany.php', $msg);
}

?>
<ul>
    <li><a href="../nindex.htm">หน้าหลัก รพ.</a></li>
    <li><a href="opd_chkcompany.php">รายชื่อหน่วยงาน</a></li>
    <li><a href="opd_chkcompany.php?page=form">ฟอร์มเพิ่มชื่อหน่วยงาน</a></li>
</ul>
<style>
/* ตาราง */
.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
}

.chk_table th,
.chk_table td{
    padding: 3px;
}
</style>
<?php

if( isset($_SESSION['x-msg']) ){
    ?><p style="background-color: #ffffc1; border: 1px solid #f0f000; padding: 5px;"><?=$_SESSION['x-msg'];?></p><?php
    unset($_SESSION['x-msg']);
}

if( empty($page) ){
    
    $sql = "SELECT * FROM `chkcompany` WHERE `code` NOT LIKE 'C%' ORDER BY `row_id` ASC";
    $db->select($sql);
    $items = $db->get_items();

    ?>
    
    <table class="chk_table">
        <tr>
            <th>#</th>
            <th>ชื่อหน่วยงาน</th>
            <th>สถานะ</th>
            <th>แก้ไข</th>
        </tr>
        <?php
        $i = 1; 
        foreach ($items as $key => $item) {
            ?>
            <tr>
                <td><?=$i;?></td>
                <td><?=$item['name'];?></td>
                <td align="center">
                <?php
                $status_txt = 'ปิด';
                if( $item['status'] == "y" ){
                    $status_txt = 'เปิดใช้งาน';
                }
                echo $status_txt;
                ?>
                </td>
                <td>
                    <a href="opd_chkcompany.php?page=form&id=<?=$item['row_id'];?>">แก้ไข</a>
                </td>
            </tr>
            <?php
            $i++;
        }
        ?>
    </table>
    <?php
}elseif ( $page == "form") {
    $id = input_get('id', 0);
    $companyname = '';
    $status = '';
    if( !empty($id) ){
        $sql = "SELECT * FROM `chkcompany` WHERE `row_id` = '$id' LIMIT 1";
        $db->select($sql);

        $item = $db->get_item();
        $companyname = $item['name'];
        $status = $item['status'];
    }
    ?>
    <form action="opd_chkcompany.php" method="post">
        <div>
            <h3>ฟอร์มจัดการชื่อหน่วยงาน ตรวจสุขภาพ นอกหน่วย(Walk-in)</h3>
        </div>
        <div>
            ชื่อหน่วย <input type="text" name="companyname" id="" value="<?=$companyname;?>">
        </div>
        <div>
            <?php
            $status_n = ( $status == "n" ) ? 'checked="checked"' : '' ;
            $status_y = ( $status == "y" ) ? 'checked="checked"' : '' ;
            
            ?>
            สถานะ 
            <label for="radio0">
                <input type="radio" name="status" id="radio0" value="n" <?=$status_n;?>> ปิด 
            </label>
            <label for="radio1">
                <input type="radio" name="status" id="radio1" value="y" <?=$status_y;?>> เปิด 
            </label>
        </div>
        <div>
            <button type="submit">บันทึก</button>
            <input type="hidden" name="action" value="save">
            <input type="hidden" name="id" value="<?=$id;?>">
        </div>
    </form>
    <?php
}
?>
