<?php

include 'bootstrap.php';


?>
<div>
    <div>
        <h3>ระบบแก้ไขข้อมูลผู้ป่วยใน(ช่วงทดสอบ)</h3>
    </div>
    <div>
        <form action="ipcard_update_user.php" method="post">
            <div>
                <label for="id_an">เลขที่ AN : </label>
                <input type="text" name="id_an" id="id_an">
            </div>
            <div>
                <button type="submit">ค้นหา</button>
                <input type="hidden" name="page" value="search_an">
            </div>
        </form>
    </div>
    
</div>
<?php

$page = input_post('page');
if( $action == 'search_an' ){

    $db = Mysql::load();
    $an = input_post('id_an');

    $sql = "SELECT * FROM `ipcard` WHERE `an` = '$an' AND `dcdate` = '0000-00-00 00:00:00' ";
    $db->select($sql);
    $user = $db->get_item();
    

    if( empty($user) ){
        echo "ผู้ป่วย D/C ไปเรียบร้อยแล้ว";
    }else {

        ?>
        <div>
            <form action="ipcard_update_user.php" method="post">
                <fieldset>
                    <legend>ข้อมูลส่วนตัว</legend>
                    <div>
                        <label for="ptname">ชื่อสกุล : </label>
                        <input type="text" name="ptname" id="ptname" value="<?=$user['ptname'];?>">
                    </div>
                </fieldset>

                <fieldset>
                    <legend>สิทธิการรักษา</legend>
                    <div>
                        <label for="">ประเภท : </label>
                        goup
                    </div>
                    <div>
                        <label for="">สังกัด : </label>
                        camp
                    </div>
                    <div>
                        <label for="ptright">สิทธิการรักษา : </label>
                        <?php
                        $sql = "SELECT * FROM `ptright` ORDER BY `code` ASC";
                        $db->select($sql);
                        $ptright_items = $db->get_items();
                        ?>
                        <select name="ptright" id="ptright">
                            <?php
                            foreach ($ptright_items as $key => $item) { 

                                $codename = $item['code'].'&nbsp;'.$item['name'];
                                ?>
                                <option value="<?=$codename;?>"><?=$codename;?></option>
                                <?php
                            }
                            ?>
                        </select>
                        
                    </div>
                    
                </fieldset>


                
            </form>
        </div>
        <div style="color: red;">
            <b>ทดสอบระบบ</b> อนุญาตให้แก้ไขได้เฉพาะ ชื่อ-สกุล และ สิทธิการรักษา เท่านั้น
        </div>
        <?php 

        $db->close();
    }
}