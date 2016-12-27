<?php

include 'bootstrap.php';

$db = Mysql::load();

// default value
$template_item = array(
    '1_1' => '0', '1_1_detail' => '', 
    
    '2_1' => '0', 
    '2_2' => '0', '2_2_detail' => '', 
    '2_3' => '0', '2_3_detail' => '', 
    '2_4' => '0', '2_4_detail' => '', 
    '2_5' => '0', '2_6' => '0', '2_7' => '0', '2_7_detail' => '', 
    
    '3_1' => '0', '3_2' => '0', '3_3' => '0', '3_4' => '0', '3_5' => '0', 
    '3_6' => '0', '3_7' => '0', '3_8' => '0', '3_9' => '0', '3_10' => '0', 
    '3_11' => '0', '3_12' => '0', '3_12_detail' => '', 

    '4_1' => '0', '4_1_detail' => '', 
    '4_2' => '0', 
    '4_3' => '0', 
    '4_4' => '0', '4_4_detail' => '', 
    '4_5' => '0', '4_5_detail' => '', 
    '4_6' => '0', '4_6_detail' => '', 
    '4_7' => '0', 

    '5_1' => '0', '5_2' => '0', '5_3' => '0', 

    '6_1' => '0', '6_2' => '0', '6_3' => '0', '6_4' => '0', '6_5' => '0', '6_6' => '0', 
    '6_7' => '0', '6_8' => '0', '6_9' => '0', '6_10' => '0', '6_11' => '0', '6_12' => '0', 

    '7_1' => '0', '7_2' => '0', '7_3' => '0', 
    '7_4' => '0', '7_5' => '0', '7_6' => '0', 

    '8_1' => '0', '8_2' => '0', '8_3' => '0', 
    '8_4' => '0', '8_5' => '0', 

    '9_1' => '0', '9_2' => '0', '9_3' => '0', 
    '9_4' => '0', '9_5' => '0', '9_6' => '0', 

    '10_1' => ''
);



$action = input('action');
if( $action === 'save' ){

    $token = input_post('token_form');
    $valid = check_token($token, 'save_form');
    if( $valid !== true ){
        echo 'Invalid token';
        exit;
    }

    // Clean up date befor insert into DB
    $data = array();
    foreach( $template_item AS $key => $item ){
        
        if( isset($_POST[$key]) && $_POST[$key] != '' ){
            $data[$key] = urlencode(input_post($key));
        }
    }

    if( empty($data) ){
        ?>
        <script>
            alert('กรุณาเลือกอย่างน้อย 1รายการเพื่อบันทึกข้อมูล');
            window.location = 'den_agesurvey.php?page=form';
        </script>
        <?php
        exit;
    }

    $date_add = input_post('date_add');
    $ptname = input_post('ptname');
    $age = input_post('age');
    $hn = input_post('hn');
    $doctor = input_post('doctor');
    $officer = get_session('sOfficer');

    /**
     * @readme Class JSON ยังไม่รองรับภาษาไทย ฉะนั้นเวลาใช้งานถ้าต้องการ encode ส่วนที่มีภาษาไทยรวมอยู่ด้วย
     * ควรแปลงค่าเป็นชนิดอื่นที่อยู่ในรูปแบบของ a-zA-Z0-9 เช่นใช้ urlencode เป็นต้น หรือจะใช้ function อื่นก็ได้
     * สุดแล้วแต่จะหามาใช้งานได้
     */
    include 'includes/JSON.php';
    $json = new Services_JSON();
    $json_data = $json->encode($data);
    
    $sql = "INSERT INTO `smdb`.`den_agesurvey`
    (`id`,
    `date_add`,
    `ptname`,
    `age`,
    `hn`,
    `data`,
    `doctor`,
    `owner`)
    VALUES
    (NULL,
    '$date_add',
    '$ptname',
    '$age',
    '$hn',
    '$json_data',
    '$doctor',
    '$officer');
    ";
    $insert = $db->insert($sql);
    $msg = 'บันทึกข้อมูลเรียบร้อย';
    if( $insert !== true ){
        $msg = errorMsg('delete', $insert['id']);
    }
    
    redirect('den_agesurvey.php', $msg);
    exit;

} else if ( $action === 'delete' ){

    $id = (int) input_get('id');
    $token = input_get('token');
    $valid = check_token($token, 'delete'.$id);

    if( $valid !== true ){
        echo 'Invalid token';
        exit;
    }

    $sql = "DELETE FROM `smdb`.`den_agesurvey`
    WHERE `id` = '$id';";
    $delete = $db->delete($sql);
    
    $msg = 'ลบข้อมูลเรียบร้อย';
    if( $delete !== true ){
        $msg = errorMsg('delete', $delete['id']);
    }
    redirect('den_agesurvey.php',$msg);
    exit;
}


include 'templates/classic/header.php';

?>
<div class="col no-print">
    <div class="cell">
        <ul class="nav">
            <li>
                <a href="../nindex.htm">หน้าหลัก รพ.</a>
            </li>
            <li>
                <a href="den_agesurvey.php">หน้ารายการ</a>
            </li>
            <li>
                <a href="den_agesurvey.php?page=form">เพิ่มข้อมูล</a>
            </li>
        </ul>
    </div>
</div>
<?php 
if( isset($_SESSION['x-msg']) ){
    ?>
    <div class="col">
        <div class="cell">
            <div class="notify-warning no-print"><?php echo $_SESSION['x-msg']; ?></div>
        </div>
    </div>
    <?php 
    unset($_SESSION['x-msg']); 
} 

$page = input('page');
if( $page === false ){

    $sql = "SELECT `id`,`date_add`,`ptname`,`age`,`hn`,`data`,`doctor`,`owner`
    FROM `den_agesurvey` 
    ORDER BY `id` DESC ;";
    $db->select($sql);
    $items = $db->get_items();
    ?>
    <div class="col">
        <div class="cell">
            <h1>รายชื่อคัดกรองผู้ป่วย</h1>
        </div>
    </div>
    <div class="col">
        <div class="cell">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>HN</th>
                        <th>ชื่อ-สกุล</th>
                        <th>วันที่เพิ่ม</th>
                        <th>แพทย์ผู้รักษา</th>
                        <th>ลบ</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                foreach ($items as $key => $item) {
                    $unit_id = $item['id'];
                    $token = generate_token('delete'.$unit_id);
                ?>
                    <tr>
                        <td><?=$i;?></td>
                        <td>
                            <a href="den_agesurvey.php?page=print_detail&id=<?=$unit_id;?>"><?=$item['hn'];?></a>
                        </td>
                        <td><?=$item['ptname'];?></td>
                        <td><?=$item['date_add'];?></td>
                        <td><?=$item['doctor'];?></td>
                        <td>
                            <a href="den_agesurvey.php?action=delete&id=<?=$unit_id;?>&token=<?=$token;?>">ลบ</a>
                        </td>
                    </tr>
                <?php
                    $i++;
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
}else if( $page === 'form' ){

    $page_action = input_post('page_action');
    $search_hn = input_post('search_hn');

    $token = generate_token('search_hn');

    ?>
    <div class="col">
        <div class="cell">
            <form action="den_agesurvey.php?page=form" method="post">
                <div class="col">
                    <div class="cell">
                        <label for="search_hn">ค้นหาตาม HN</label>
                        <input type="text" name="search_hn" value="<?=$search_hn;?>">
                    </div>
                </div>
                <div class="col">
                    <div class="cell">
                        <button type="submit">ค้นหา</button>
                        <input type="hidden" name="page_action" value="search">
                        <input type="hidden" name="token" value="<?=$token;?>">
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <?php
    if( $page_action === 'search' ){

        $post_token = input_post('token');
        $valid = check_token($post_token, 'search_hn');
        if( $valid !== true ){
            echo 'Invalid token';
            exit;
        }

        $sql = "SELECT (SUBSTRING(`dbirth`,1,4) - 543) AS `year_birth`,`hn`,`name`,`surname`,CONCAT(`name`,' ',`surname`) AS `ptname`
        FROM `opcard` WHERE `hn` = '$search_hn'";
        $db->select($sql);

        $item = $db->get_item();
        if( !is_null($item) ){
        
            $age = date('Y') - $item['year_birth'];
            if( $age < 0 ){
                $age = '-';
            }
            $ptname = $item['ptname'];
            $hn = $search_hn;
            $date_add = ad_to_bc(date('Y-m-d H:i:s'));
            $writer = false;
            $id = false;

            ?>
            <div class="col">
                <div class="cell">
                    <h1>แนวทางคัดกรองผู้ป่วยสูงอายุ &gt;60ปี</h1>
                    <form action="den_agesurvey.php" method="post">
                        <?php

                        // เฉพาะฟอร์มด้านในอย่างเดียว
                        include 'den_agesurvey_form.php';
                        ?>
                        <div class="col">
                            <div class="cell">
                                <button type="submit">บันทึก</button>
                                <input type="hidden" name="action" value="save">
                                <input type="hidden" name="id" value="<?=$id;?>">
                                <input type="hidden" name="token_form" value="<?=generate_token('save_form');?>">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <?php
        }
    }
} else if( $page === 'print_detail' ){

    $id = input_get('id');

    $sql = "SELECT * 
    FROM `den_agesurvey` 
    WHERE `id` = '$id'";
    $db->select($sql);
    $survey = $db->get_item();

    include 'includes/JSON.php';
    $json = new Services_JSON();
    $items = $json->decode($survey['data']);

    // Class to Array
    $json_items = array();
    foreach( $items as $key => $item ){
        $json_items[$key] = $item;
    }

    // เรียงข้อมูลใหม่
    $item = array();
    foreach( $template_item as $key => $def ){
        $item[$key] = $json_items[$key];
    }

    $age = $survey['age'];
    $ptname = $survey['ptname'];
    $hn = $survey['hn'];
    $writer = $survey['doctor'];
    $date_add = $survey['date_add'];

    list($name, $surname) = explode(' ', $survey['ptname']);
    $item['name'] = $name;
    $item['surname'] = $surname;
    
    ?>
    <div class="col">
        <div class="cell">
            <h1>แนวทางคัดกรองผู้ป่วยสูงอายุ &gt;60ปี</h1>
            
            <?php

            // เฉพาะฟอร์มด้านในอย่างเดียว
            include 'den_agesurvey_form.php';
            ?>
            
            
        </div>
    </div>
    <?php
    // include 'den_agesurvey_form.php';
    // exit;
}
include 'templates/classic/footer.php';