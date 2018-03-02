<?php

include 'bootstrap.php';

$page = input('page');
$db = Mysql::load();

if( $page == false ){
    include 'chk_menu.php';

    $part = input_get('part');

    $sql = "SELECT `name` FROM `chk_company_list` WHERE `code` = '$part'";
    $db->select($sql);
    $company = $db->get_item();

    $sql = "SELECT *, `HN` AS `hn`  
    FROM `opcardchk` 
    WHERE `part` = '$part' ";
    $db->select($sql);
    $items = $db->get_items();
    $rows = $db->get_rows();
    if( $rows > 0 ){

        ?>
        <h3>รายชื่อผู้ตรวจสุขภาพ - <?=$company['name'];?></h3>
        <table class="chk_table">
            <tr>
                <th>#</th>
                <th>HN</th>
                <th>ชื่อสกุล</th>
                <th>เลขบัตรประชาชน</th>
                <th>อายุ</th>
                <th>แก้ไขข้อมูลพื้นฐาน</th>
                <th>แก้ไขผลแลป</th>
                <th>ลบ</th>
            </tr>
            <?php
            $i = 1;
            foreach ($items as $key => $item) {
                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$item['hn'];?></td>
                    <td><?=$item['name'];?> <?=$item['surname'];?></td>
                    <td><?=$item['idcard'];?></td>
                    <td><?=$item['agey'];?></td>
                    <td align="center"><a href="chk_user.php?page=form&id=<?=$item['row'];?>">แก้ไข</a></td>
                    <td align="center"><a href="chk_lab.php?page=form&id=<?=$item['row'];?>">ปรับผลแลป</a></td>
                    <td align="center"><a href="chk_show_user.php?page=del&id=<?=$item['row'];?>&part=<?=$item['part'];?>" onclick="return confirm_del()">ลบ</a></td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </table>
        <script type="text/javascript">
            function confirm_del(){
                var c = confirm('คุณยืนยันที่จะลบข้อมูล?'+"\n"+'เมื่อลบไปแล้วจะไม่สามารถกู้คืนข้อมูลได้อีก');
                var status = true;
                if( c === false ){
                    status = false;
                }
                return status;
            }
        </script>
        <?php

    }else{
        ?>
        <p>ไม่พบข้อมูลนำเข้า</p>
        <?php
    }

}elseif ( $page === 'del' ) {

    $id = input_get('id');

    if( $id === false ){
        echo "ไม่พบข้อมูล";
        exit;
    }

    $part = input_get('part');
    
    $sql = "DELETE FROM `opcardchk` WHERE `row` = '$id' ";
    $delete = $db->delete($sql);

    $msg = 'ลบข้อมูลเรียบร้อย';
    if( $delete !== true ){
		$msg = errorMsg('delete', $delete['id']);
    }

    redirect('chk_show_user.php?part='.$part, $msg);
    
}