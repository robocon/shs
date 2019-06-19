<?php 

include 'bootstrap.php';

$db = Mysql::load();
$action = input_post('action');
$officer = $_SESSION['sOfficer'];
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
@media print{
    .menu-container, fieldset{
        display: none;
    }
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
            <li><a href="chk_cxr_doctor.php">บันทึกผล X-Ray</a></li>
        </ul>
    </div>
    <p class="clearfix"></p>
</div>

<fieldset>
    <legend>ค้นหาตามบริษัท</legend>
    <form action="chk_report_cxr.php" method="post">
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
        <label for="orderby1"><input type="radio" name="orderby" id="orderby1" value="hn" checked>เรียงตามเลขHN</label>&nbsp;
        <label for="orderby2"><input type="radio" name="orderby" id="orderby2" value="number">เรียงตามลำดับพี่หนา</label>
        </div>
        <div>
            <button type="submit">แสดงรายชื่อ</button>
            <input type="hidden" name="page" value="search">
        </div>
    </form>
</fieldset>

<?php 

$page = input_post('page');

if ( $page === 'search' ) {

    $part = input_post('part');
    $order = input_post('orderby');

    $db->select("SELECT `name`,`code` FROM `chk_company_list` WHERE `code` = '$part'");
    $company = $db->get_item();

    $db->select("SELECT `hn`,`ptname`,`cxr`,`detail` FROM `chk_cxr` WHERE `part` = '$part' ");

    if ( $db->get_rows() == 0 ) {
        echo "ยังไม่ได้ลงผล";
        exit;
    }
    $items = $db->get_items();

    if( $order == 'hn' ){

        $pre_items = array();
        foreach ($items as $key => $item) {
            
            list($year, $number) = explode('-', $item['hn']);
            $number = sprintf('%05d', $number);
            $key = $year.$number;

            $pre_items[$key] = $item;

        }
        ksort($pre_items); 

        $items = $pre_items;

    }

    ?>
    <h3>ผลการตรวจรังษีบริษัท <?=$company['name'];?></h3>
    <table class="chk_table">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>HN</th>
                <th>ชื่อสกุล</th>
                <th>ผลการตรวจ</th>
                <th>รายละเอียด</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i = 1;
            foreach ($items as $key => $value) {
            ?>
            <tr>
                <td><?=$i;?></td>
                <td><?=$value['hn'];?></td>
                <td><?=$value['ptname'];?></td>
                <td><?=$value['cxr'];?></td>
                <td><?=$value['detail'];?></td>
            </tr>
            <?php 
                $i++;
            }
            ?>
        </tbody>
    </table>
    <?php

    exit;
}