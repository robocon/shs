<?php
if( empty($_SESSION['sRowid']) ){ echo '<a href="login_page.php">กรุณาเข้าสู่ระบบอีกครั้ง</a>'; exit; }
?>
<style type="text/css">
.clearfix:after{
    content: "";
    display: table;
    clear: both;
}

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
<?php

$menu_list = array(
    array('link' => '../nindex.htm', 'name' => 'ระบบหลักรพ', 'access' => 'ADM|ADMNEWCHKUP'),
    array('link' => 'chk_company.php', 'name' => 'จัดการรายชื่อบริษัท', 'access' => 'ADM|ADMNEWCHKUP'),
    array('link' => 'chk_import_user.php', 'name' => 'นำเข้าข้อมูลสู่ระบบ', 'access' => 'ADM|ADMNEWCHKUP'),
    array('link' => 'cxr_out_result.php', 'name' => 'นำเข้าข้อมูล X-Ray', 'access' => 'ADM|ADMNEWCHKUP'),
    array('link' => 'chk_lab_order.php', 'name' => 'นำเข้าOrder Lab', 'access' => 'ADM|ADMNEWCHKUP'),
    array('link' => 'chk_sso.php', 'name' => 'Walk-in ปกส.', 'access' => 'ALL'),
    array('link' => 'dt_emp_manual_index.php', 'name' => 'ลงผลตรวจ ปกส.', 'access' => 'ADM|ADMNEWCHKUP', 'target' => '_blank'),

);


?>
<div class="clearfix" style="height: 105px;">
    <h3>ระบบจัดการข้อมูล ตรวจสุขภาพ</h3>
    <div class="chk_menu clearfix">

        <ul>
            <?php 
            // ตรวจสอบสิทธิในการดูเมนู
            foreach ($menu_list as $key => $item) { 
                if( $item['access'] != 'ALL' ){
                    if( preg_match('/'.$_SESSION['smenucode'].'/', $item['access']) == 0 ){
                        continue;
                    }
                }

                $target = ( !empty($item['target']) ) ? 'target="'.$item['target'].'"' : '' ;

                ?>
                <li><a href="<?=$item['link'];?>" <?=$target;?> ><?=$item['name'];?></a></li>
                <?php
            }
            ?>
        </ul>
    </div>
</div>
<?php
if( isset($_SESSION['x-msg']) ){
    ?><p style="background-color: #ffffc1; border: 1px solid #f0f000; padding: 5px;"><?=$_SESSION['x-msg'];?></p><?php
    unset($_SESSION['x-msg']);
}