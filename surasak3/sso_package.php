<?php

// $conn = mysql_connect('localhost', 'root', '1234') or die( mysql_error() );
// mysql_select_db('smdb', $conn) or die( mysql_error() );
// mysql_query("SET NAMES UTF8", $conn);

include 'bootstrap.php';

// เพิ่ม ลบ แก้ไข
if( $_POST['action'] === 'save' ){

    $package = json_encode($_POST['packages']);
    $package_name = $_POST['package_name'];
    $detail = $_POST['detail'];

    $sql = "INSERT INTO `sso_package`
    (`id`,
    `name`,
    `detail`,
    `list`)
    VALUES
    (NULL,
    '$package_name',
    '$detail',
    '$package');";
    $save = mysql_query($sql, $conn) or die( mysql_error() );
    if( $save !== true ){
        exit;
    }else{
        header('Location: sso_package.php');
    }
}

// ส่วนของ view // 
$view = $_GET['view'];
if( empty($view) ){
    ?>
    <div>
        <a href="sso_package.php?view=form">เพิ่ม package</a>
    </div>
    <?php
    $sql = "SELECT * FROM `sso_package` ORDER BY `id` DESC";
    $q = mysql_query($sql, $conn);
    ?>
    <table>
        <tr>
            <th>#</th>
            <th>ชื่อPackage</th>
            <th>รายละเอียด</th>
        </tr>
        <?php
        $i = 1;
        while ( $item = mysql_fetch_assoc($q) ) {
            ?>
            <tr>
                <td><?=$i;?></td>
                <td><?=$item['name'];?></td>
                <td><?=$item['detail'];?></td>
            </tr>
            <?php
            $i++;
        }
        ?>
    </table>
    <?php

}else if( $view === 'form' ){

    $sql = "SELECT * FROM `sso_checkup`";
    $q = mysql_query($sql, $conn) or die( mysql_error() );
    ?>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <form action="sso_package.php" method="post">
        <div>
            <label for="package_name">
                ชื่อ Package: 
                <input type="text" id="package_name" name="package_name">
            </label>
        </div>
        <div>
            <label for="detail">
                รายละเอียด Package: 
                <textarea name="detail" id="detail" cols="30" rows="10"></textarea>
            </label>
        </div>
        <table>
            <tr>
                <th>#</th>
                <th>รายละเอียด</th>
                <th>ช่วงอายุ</th>
                <th>ความถี่</th>
            </tr>
            <?php
            while ( $item = mysql_fetch_assoc($q) ) {
                ?>
                <tr>
                    <td>
                        <input type="checkbox" id="<?=$item['code'];?>" name="packages[]" value="<?=$item['code'];?>">
                    </td>
                    <td><label for="<?=$item['code'];?>"><?=$item['detail'];?></label></td>
                    <td align="center">
                        <?php
                        $age_txt = '';
                        if( !empty($item['age_year']) ){
                            $age_txt = 'สำหรับผู้ที่เกิดก่อนปี '.($item['age_year'] + 543);
                        }else{
                            if( !empty($item['age_min']) && empty($item['age_max']) ){
                                $age_txt = $item['age_min'].' ปีขึ้นไป';
                            }else{
                                $age_txt = $item['age_min'].'-'.$item['age_max'].' ปี';
                            }
                        }
                        echo $age_txt;
                        ?>
                    </td>
                    <td align="center">
                        <?php
                            $frequence = '';
                            if( !empty($item['onetime']) ){
                                $frequence = $item['onetime'].'ครั้ง';
                            } else if ( !empty($item['special']) ){
                                $frequence = 'ตามความเหมาะสมหรือมีความเสี่ยง';
                            } else {
                                $frequence = $item['frequence'].'ครั้ง/ปี';
                            }

                            echo $frequence;
                        ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <div>
            <button type="submit">บันทึก</button>
            <input type="hidden" name="action" value="save">
        </div>
    </form>
    <?php
}


