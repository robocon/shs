<?php 
include 'bootstrap.php';

$db = Mysql::load();
$action = input_post('action');

if ( $action == 'save' ) {
    
    $cxr_items = $_POST['cxr'];
    $details = $_POST['cxr_detail'];
    $part = input_post('part');

    foreach ($cxr_items as $hn => $item) {
        
        $cxr = $item.' '.$details[$hn];

        $sql = "SELECT `row_id` WHERE `hn` = `$hn` AND `part` = '$part' ";
        $db->select($sql);
        $row = $db->get_rows();

        if( $row > 0 ){
            // update 

        }elseif ( $row == 0 ) {

            $sql = "SELECT *,,CONCAT(`name`,' ',`surname`) AS `ptname` FROM `opcardchk` WHERE `HN` = '$hn' AND `part` = '$part' ";
            $db->select($sql);
            $user = $db->get_item();

            $ptname = $user['ptname'];

            // insert 
            $sql = "INSERT INTO `out_result_chkup` 
            (`row_id`, `hn`, `ptname`, `cxr`, `year_chk`, `officer`, `register`, `part`, `last_officer`, `last_update`, ) 
            VALUES 
            (NULL, '$hn', '$ptname', '$cxr', '', '', NOW(), '$part', '', NOW() );";



        }

    }
    // dump($_POST);
    exit;
}

?>
<fieldset>
    <legend>ค้นหาตามบริษัท</legend>
    <form action="chk_cxr_doctor.php" method="post">
        <div>
            <?php 
            $db->select("SELECT `name`,`code` FROM `chk_company_list` WHERE `status` = '1' ORDER BY `id` DESC");
            $items = $db->get_items();
            ?>
            เลือกบริษัท : 
            <select name="part" id="">
                <option value="">-- รายชื่อบริษัท --</option>
                <?php
                foreach ($items as $key => $item) {
                    ?><option value="<?=$item['code'];?>"><?=$item['name'].' ('.$item['code'].')';?></option><?php
                }
                ?>
            </select>
        </div>
        <div>
            <button type="submit">แสดงรายชื่อ</button>
            <input type="hidden" name="page" value="search">
        </div>
    </form>
</fieldset>
<?php 

$page = input_post('page');

if ( $page == 'search' ) {

    $part = input_post('part');

    if( empty($part) ){
        echo "กรุณาเลือกบริษัท";
        exit;
    }

    $sql = "SELECT *,CONCAT(`name`,' ',`surname`) AS `ptname` FROM `opcardchk` WHERE `part` = '$part' ORDER BY `row` ";
    $db->select($sql);
    $items = $db->get_items();
    
    ?>
    <fieldset>
        <legend>บันทึกข้อมูล</legend>
        <form action="chk_cxr_doctor.php" method="post">
            <div>
                <table>
                    <tr>
                        <th>HN</th>
                        <th>ชื่อ-สกุล</th>
                        <th></th>
                    </tr>

                    <?php 
                    foreach ($items as $key => $item) {
                        
                        $row = $item['row'];
                        $hn = $item['HN'];
                        ?>
                        <tr>
                            <td><?=$item[$hn];?></td>
                            <td><?=$item['ptname'];?></td>
                            <td>
                                <label for="cxr<?=$row;?>a"><input type="radio" name="cxr[<?=$hn;?>]" id="cxr<?=$row;?>a" value="ปกติ" checked="checked"> ปกติ</label>
                                <label for="cxr<?=$row;?>b"><input type="radio" name="cxr[<?=$hn;?>]" id="cxr<?=$row;?>b" value="ผิดปกติ"> ผิดปกติ</label>
                                <input type="text" name="cxr_detail[<?=$hn;?>]" id="" size="40">
                                <input type="hidden" name="hn[]" value="<?=$item['HN'];?>">
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
            <div>
                <button type="submit">บันทึกข้อมูล</button>
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="part" value="<?=$part;?>">
            </div>
        </form>
    </fieldset>
    <?php

}