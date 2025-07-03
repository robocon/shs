<?php
if( empty($_SESSION['sRowid']) ){ echo '<a href="login_page.php">กรุณาเข้าสู่ระบบอีกครั้ง</a>'; exit; }
?>
<style type="text/css">
*{
    font-family: "TH SarabunPSK";
    font-size:20px;
}
h3{
    font-size: 32px;
    margin:8px 0;
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

/* ตาราง */
.chk_table{
    border-collapse: collapse;
}
.chk_table th{
    background-color: #e3e3e3;
}
.chk_table th,
.chk_table td{
    padding: 3px;
    border: 1px solid black;
}

.chk_table a{
    text-decoration: none;
}
.chk_table a:hover{
    text-decoration: underline;
}

.chk_menu ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #808080;
}

.chk_menu li {
  float: left;
}

.chk_menu li a, .dropbtn {
  display: inline-block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.chk_menu li a:hover, .dropdown:hover .dropbtn {
  background-color: #04AA6D;
}

.chk_menu li.dropdown {
  display: inline-block;
}

.chk_menu .dropdown-content {
  display: none;
  position: absolute;
  background-color: #808080;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.chk_menu .dropdown-content a {
  color: #ffffff;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.chk_menu .dropdown-content a:hover {background-color: #04AA6D;}

.chk_menu .dropdown:hover .dropdown-content {
  display: block;
}
.button {
    background-color: #04AA6D; /* Green */
    border: none;
    color: white;
    padding: 8px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
}
ol.itemMenu{
    margin:0; 
    padding:0; 
    list-style-type:none;
}
ol.itemMenu li:hover{
    background-color: #e3e3e3;
}
button:hover, label:hover{
    cursor: pointer;
}
.tb_title{
    font-weight: bold;
    text-align: right;
}
legend{
    font-weight: bold;
}








ol > li {
    margin-bottom: 6px;
}
/* Model */
.modal {
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
#myModalContainer{
    width: 90%;
    background: #fff;
    padding: 1em;
    margin:0 auto;
}
/* Model */

/**
 * ปุ่มที่เป็น readonly ให้ลงสีเป็นสีเทา
 */
input[readonly]{
    background-color: #c8c8c8;
}

/* ปุ่ม Back to top */

#myBtn {
  display: none; /* Hidden by default */
  position: fixed; /* Fixed/sticky position */
  bottom: 20px; /* Place the button at the bottom of the page */
  right: 30px; /* Place the button 30px from the right */
  z-index: 99; /* Make sure it does not overlap */
  border: none; /* Remove borders */
  outline: none; /* Remove outline */
  background-color: red; /* Set a background color */
  color: white; /* Text color */
  cursor: pointer; /* Add a mouse pointer on hover */
  padding: 15px; /* Some padding */
  border-radius: 10px; /* Rounded corners */
  font-size: 18px; /* Increase font size */
}

#myBtn:hover {
  background-color: #555; /* Add a dark-grey background on hover */
}
html {
  scroll-behavior: smooth;
}
/* ปุ่ม Back to top */

</style>
<?php

$menu_list = array(
    array('link' => '../nindex.htm', 'name' => 'หน้าหลักร.พ.', 'access' => 'ADM|ADMNEWCHKUP'),
    array('link' => 'chk_company.php', 'name' => 'จัดการรายชื่อบริษัท', 'access' => 'ADM|ADMNEWCHKUP'),
    array(
        'link' => 'javascript:void(0)', 
        'name' => 'นำเข้าข้อมูล', 
        'access' => 'ALL',
        'submenu' => array(
            array('link' => 'chk_import_user.php', 'name' => 'นำเข้าข้อมูลพื้นฐาน', 'access' => 'ADM|ADMNEWCHKUP'),
            array('link' => 'chk_lab_order.php', 'name' => 'นำเข้าOrder Lab', 'access' => 'ADM|ADMNEWCHKUP|ADMLAB'),
            array('link' => 'chk_lab_lis.php', 'name' => 'สั่ง LAB เข้า LIS', 'access' => 'ADM|ADMNEWCHKUP|ADMLAB'),
        )
    ),
    array(
        'link' => 'javascript:void(0)', 
        'name' => 'ลงผลและซักประวัติ', 
        'access' => 'ALL',
        'submenu' => array( 
            array('link' => 'dt_emp_manual_index.php', 'name' => 'ลงผลตรวจ ปกส.', 'access' => 'ADM|ADMNEWCHKUP', 'target' => '_blank'),
            array('link' => 'dx_ofyear_out.php', 'name' => 'ซักประวัติ(สิทธิ ปกส.)', 'access' => 'ALL', 'target' => '_blank'),
            array('link' => 'cxr_out_result.php', 'name' => 'ลงผล X-Ray ออกหน่วย สิทธิ ปกส.', 'access' => 'ADM|ADMNEWCHKUP|ADMXR'),
            array('link' => 'cxr_edit_result.php', 'name' => 'แก้ไขผล X-Ray', 'access' => 'ADM|ADMNEWCHKUP|ADMXR')
        )
    ),
    array(
        'link' => 'javascript:void(0)', 
        'name' => 'ค้นหา', 
        'access' => 'ALL',
        'submenu' => array(
            array('link' => 'chk_sso.php', 'name' => 'ค้นหา Walk-in ปกส.', 'access' => 'ALL'),
            array('link' => 'chk_test_hn.php', 'name' => 'ตรวจสอบรายชื่อจาก HN', 'access' => 'ALL'),
            array('link' => 'chk_test_ipcard.php', 'name' => 'ตรวจสอบรายชื่อจาก เลขบัตรประชาชน', 'access' => 'ALL'),
            array('link' => 'chk_report_cxr.php', 'name' => 'ดูผล X-Ray ออกหน่วย สิทธิ ปกส.', 'access' => 'ADM|ADMNEWCHKUP|ADMXR')
        ),
    ),
    array(
        'link' => 'pm_shs.php',
        'name' => 'เมนูย่อย พี่สอง', 
        'access' => 'ALL',
    )
);

function create_menu($menu_list){

    ?>
    <ul>
        <?php 
        foreach ($menu_list as $key => $item) {

            $class_sub = '';
            $li_dropdown = '';
            if (count($item['submenu']) > 0) {
                $class_sub = 'class="dropbtn"';
                $li_dropdown = 'class="dropdown"';
            }

            if( $item['access'] != 'ALL' ){
                if( preg_match('/'.$_SESSION['smenucode'].'/', $item['access']) == 0 ){
                    continue;
                }
            }

            $target_a = '_parent';
            if($item['target'] != ''){
                $target_a = $item['target'];
            }

            ?>
            <li <?=$li_dropdown;?>>
                <a href="<?=$item['link'];?>" <?=$class_sub;?> target="<?=$target_a;?>"><?=$item['name'];?></a>
                <?php 
                if (count($item['submenu']) > 0) {
                    submenu($item['submenu']);
                }
                ?>
            </li>
            <?php 
        }
        ?>
        
    </ul>
    <?php
}

function submenu($submenu_list){

    ?>
    <div class="dropdown-content">
        <?php 
        foreach ($submenu_list as $key => $menu) {

            if( $menu['access'] != 'ALL' ){
                if( preg_match('/'.$_SESSION['smenucode'].'/', $menu['access']) == 0 ){
                    continue;
                }
            }

            $target_a = '_parent';
            if($menu['target'] != ''){
                $target_a = $menu['target'];
            }

            ?>
            <a href="<?=$menu['link'];?>" target="<?=$target_a;?>"><?=$menu['name'];?></a>
            <?php
        }
        ?>
    </div>
    <?php 

}
?>
<!--[if IE]>
<style type="text/css">
.clearfix{
    zoom: 1;
}
</style>
<![endif]-->
<div class="">
    <h3>ระบบจัดการข้อมูล ตรวจสุขภาพ</h3>
    <div class="chk_menu">
        
        <?php 
        create_menu($menu_list);
        ?>
        
    </div>
</div>
<div class="clearfix"></div>
<br>
<?php
if( isset($_SESSION['x-msg']) ){
    ?><p style="background-color: #ffffc1; border: 1px solid #f0f000; padding: 5px;"><?=$_SESSION['x-msg'];?></p><?php
    unset($_SESSION['x-msg']);
}