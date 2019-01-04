<?php 

include 'bootstrap.php'; 
$db = Mysql::load();
$db->set_charset('TIS620');
?>

<style>
/* ตาราง */
body, button{
    font-family: TH Sarabun NEW, TH SarabunPSK;
    font-size: 16pt;
}
.chk_table{
    border-collapse: collapse;
}

.chk_table th,
.chk_table td{
    padding: 3px;
    border: 1px solid black;
    font-size: 16pt;
}
</style>
<h3>ระบบแก้ไข LAB, X-RAY ผู้ป่วยนัด(ช่วงทดสอบ)</h3>
<form action="" method="post">
    <fieldset>
        <legend>ค้นหาตาม HN</legend>
        <div>
            HN: <input type="text" name="hn" id="hn">
        </div>
        <div>
            <button type="submit">ค้นหา</button>
            <input type="hidden" name="page" value="search">
        </div>
    </fieldset>
</form>
<?php 

$page = input('page');

if ( $page == 'search' ) {
    
    $hn = input_post('hn');
    $sql = "SELECT * FROM `appoint` WHERE `hn` = '$hn' ";
    $db->select($sql);
    $rows = $db->get_rows();

    if ( $rows > 0 ) {
        $items = $db->get_items();

        ?>
        <table class="chk_table">
            <tr>
                <th>วันที่ลงข้อมูล</th>
                <th>นัดมาตรวจวันที่</th>
                <th>เวลาที่นัดตรวจ</th>
                <th>แพทย์</th>
                <th></th>
            </tr>
            <?php 
            foreach ($items as $key => $item) {
                ?>
                <tr>
                    <td><?=$item['date'];?></td>
                    <td><?=$item['appdate'];?></td>
                    <td><?=$item['apptime'];?></td>
                    <td><?=$item['doctor'];?></td>
                    <td><a href="appoint_edit.php?page=form&id=<?=$item['row_id'];?>">แก้ไข</a></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }else{
        ?>
        <p><b>ไม่พบข้อมูล</b></p>
        <?php
    }

}elseif ( $page == 'form' ) {
    
    $id = input_get('id');

    $sql = "SELECT * FROM `appoint` WHERE `row_id` = '$id' ";
    $db->select($sql);
    $rows = $db->get_rows();

    if( $rows > 0 ){

        $item = $db->get_item();

        $sql = "SELECT a.*, b.`detail`
        FROM `appoint_lab` AS a 
        LEFT JOIN `labcare` AS b ON b.`code` = a.`code` 
        WHERE a.`id` = '$id'";
        $db->select($sql);

        $row_lab = $db->get_rows();
        // 

        ?>
        <style>
        .lab_container{
            display: none;
            position: absolute;
            top: 260px;
            left: 140px;
            background-color: #ffffff;
            border: 1px solid red;
            padding: 4px;
            width: 600px;
        }
        </style>
        <form action="appoint_edit.php" method="post">
            <div>
                <b>ชื่อ-สกุล:</b> <?=$item['ptname'];?> <b>HN:</b> <?=$item['hn'];?> อายุ <?=$item['age'];?> <br>
                <b>แพทย์:</b> <?=$item['doctor'];?> <b>นัดมาตรวจวันที่:</b> <?=$item['appdate'];?> เวลา <?=$item['apptime'];?>
            </div>

            <div>
                <button class="table_lab">เพิ่มรายการ LAB</button>
            </div>

            <div id="list_patho">
                <?php
                if ( $row_lab > 0 ) { 

                    $lab_items = $db->get_items();
                    foreach ($lab_items as $key => $lab) {
                        ?>
                        <div>
                            <?=$lab['detail'];?><a href="javascript:void(0);" class="del_item"> [ลบ]</a>
                        </div>
                        <?php
                    }

                }
                ?>
            </div>

        </form>

        <div class="lab_container">
            <p style="text-align: center; "><b>รายการตรวจทางพยาธิ</b></p>
            <?php
            $sql2 = "select * from labcare where lab_list !=0 order by lab_list asc";
            $rows2 = mysql_query($sql2);
            ?>
            <table class="chk_table" width="100%">
                <tr>
                    <?php 
                    // แถวละ 5
                    $i = 0;
                    while($result2 = mysql_fetch_array($rows2)){ 
                        ++$i;
                        ?>
                        <td>
                            <a href="javascript: void(0);" title="<?=$result2['detail']?>" data-code="<?=$result2['code']?>" class="lab_add"><?=$result2['lab_listdetail']?></a>
                        </td>
                        <?php

                        if( $i % 5 == 0 ){
                            ?></tr><tr><?php
                            $i = 0;

                        }
                    }
                    ?>
                    
                </tr>
            </table>
        </div>

        <script src="js/vendor/jquery-1.11.2.min.js" type="text/javascript"></script>
        <script type="text/javascript">

            /**
             * [] เปิด-ปิด รายการ lab
             * [] คลิกที่เมนูแล้วเพิ่มไปยังฟอร์ม
             * [] ลบรายการออกจากฟอร์ม
             */
            $(document).on('click', '.table_lab', function(){
                $('.lab_container').toggle();
                return false;
            });
            
        </script>

        <?php

    }else {
        ?>
        <p><b>ไม่พบข้อมูล</b></p>
        <?php
    }

}