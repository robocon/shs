<?php 
include 'bootstrap.php';

$db = Mysql::load();
$action = input_post('action');

if ( $action == 'save' ) {
    
    $cxr_items = $_POST['cxr'];
    $detail = $_POST['cxr_detail'];
    $part = input_post('part');

    $officer = $_SESSION['sOfficer'];

    $msg = "บันทึกข้อมูลเรียบร้อย";

    foreach ($cxr_items as $hn => $item) {

        $yearchk = get_year_checkup();
        
        $sql = "SELECT `id` FROM `chk_cxr` WHERE `hn` = '$hn' AND `part` = '$part' ";

        $cxr = $item;
        $cxr_detail = $detail[$hn];

        $db->select($sql);
        $row = $db->get_rows();
        if( $row > 0 ){

            // update 
            $out_items = $db->get_item();
            $row_id = $out_items['id'];

            $sql = "UPDATE `chk_cxr` SET 
            `cxr`='$cxr', 
            `detail`='$cxr_detail', 
            `editor`='$officer', 
            `edit_date`=NOW()
            WHERE (`id`='$row_id');";
            $save = $db->update($sql);
            if( $save !== true ){
                $msg = errorMsg('update', $save['id']);
            }


        }elseif ( $row == 0 ) {

            $sql = "SELECT *,CONCAT(`name`,' ',`surname`) AS `ptname` FROM `opcardchk` WHERE `HN` = '$hn' AND `part` = '$part' ";
            $db->select($sql);
            $user = $db->get_item();

            $ptname = $user['ptname'];

            // insert 
            $sql = "INSERT INTO `chk_cxr` (
                `id`, `hn`, `ptname`, `cxr`, `detail`, `officer`, `date`, `editor`, `edit_date`, `part`, `year_chk` 
            ) VALUES (
                NULL, '$hn', '$ptname', '$cxr', '$cxr_detail', '$officer', NOW(), '$officer', NOW(), '$part', '$yearchk'
            );";
            $save = $db->insert($sql);
            if( $save !== true ){
                $msg = errorMsg('insert', $save['id']);
            }

        }


    } // end for 

    redirect('chk_cxr_doctor.php', $msg);
    exit;
}

?>

<style type="text/css">
*{
    font-family: "TH Sarabun New","TH SarabunPSK";
    font-size: 14pt;
}
.clearfix:after{
    content: ".";
    display: block;
    clear: both;
    height: 0;
    visibility: hidden;
}
.clearfix{
    min-height: 1%;
}
.menu-container{
    display: flow-root;
}
label{
    cursor: pointer;
}

/* ตาราง */
.chk_table{
    border-collapse: collapse;
}
.chk_table th,
.chk_table td{
    padding: 3px;
    border: 1px solid black;
}

/* เมนู */
.chk_menu{
    margin-bottom: 1em;
    padding-bottom: 5px;
}
.chk_menu ul{
    margin: 0;
    padding: 0;
}
.chk_menu ul li{
    list-style: none;
    float: left;
}
.chk_menu ul li a{
    float: left;
    padding: 10px;
    text-decoration: none;
    color: #000000;
    background-color: #e2e2e2;
    margin-right: 2px;
}
.chk_menu ul li a:hover{
    background-color: #bfbfbf;
}
</style>
<!--[if IE]>
<style type="text/css">
.clearfix{
    zoom: 1;
}
</style>
<![endif]-->
<div class="menu-container">
    <div class="chk_menu">
        <ul>
            <li><a href="../nindex.htm">หน้าหลัก ร.พ.ฯ</a></li>
        </ul>
    </div>
    <p class="clearfix"></p>
</div>

<?php


if( isset($_SESSION['x-msg']) ){
    ?><p style="background-color: #ffffc1; border: 1px solid #f0f000; padding: 5px;"><?=$_SESSION['x-msg'];?></p><?php
    unset($_SESSION['x-msg']);
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
            เลือกบริษัทที่จะบันทึกข้อมูล : 
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

    $db->select("SELECT `name`,`code` FROM `chk_company_list` WHERE `code` = '$part'");
    $company = $db->get_item();

    $sql = "SELECT *,CONCAT(`name`,' ',`surname`) AS `ptname` FROM `opcardchk` WHERE `part` = '$part' ORDER BY `row` ";
    $db->select($sql);
    $items = $db->get_items();
    
    ?>
    <fieldset>
        <legend>บันทึกข้อมูล <?=$company['name'];?></legend>
        <form action="chk_cxr_doctor.php" method="post">
            <div>
                <table class="chk_table">
                    <tr>
                        <th>HN</th>
                        <th>ชื่อ-สกุล</th>
                        <th>บันทึกผล</th>
                    </tr>

                    <?php 
                    foreach ($items as $key => $item) {
                        
                        $row = $item['row'];
                        $hn = $item['HN'];

                        $db->select("SELECT `cxr`,`detail` FROM `chk_cxr` WHERE `hn` = '$hn' AND `part` = '$part' ");
                        $user = $db->get_item();

                        $normal = 'checked="checked"';
                        $res_detail = '';
                        $unnormal = '';

                        if( $db->get_rows() > 0 ){

                            // list($res, $res_detail) = explode(' ', $user['cxr']);

                            $res = $user['cxr'];
                            $res_detail = $user['detail'];

                            if( $res == 'ปกติ' ){
                                $normal = 'checked="checked"';
                            } 

                            if( $res == 'ผิดปกติ' ){
                                $unnormal = 'checked="checked"';
                            } 

                        }

                        ?>
                        <tr>
                            <td><?=$hn;?></td>
                            <td><?=$item['ptname'];?></td>
                            <td>
                                <label for="cxr<?=$row;?>a">
                                    <input type="radio" name="cxr[<?=$hn;?>]" id="cxr<?=$row;?>a" value="ปกติ" <?=$normal;?> > ปกติ
                                </label>
                                <label for="cxr<?=$row;?>b">
                                    <input type="radio" name="cxr[<?=$hn;?>]" id="cxr<?=$row;?>b" value="ผิดปกติ" <?=$unnormal;?> > ผิดปกติ
                                </label>
                                <input type="text" name="cxr_detail[<?=$hn;?>]" id="" size="40" value="<?=$res_detail;?>">
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