<?php
if( empty($_SESSION['sRowid']) ){ echo '<a href="login_page.php">��س��������к��ա����</a>'; exit; }
?>
<style type="text/css">
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


/* ���ҧ */
.chk_table{
    border-collapse: collapse;
}
.chk_table th,
.chk_table td{
    padding: 3px;
    border: 1px solid black;
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
  background-color: #4ba800;
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

.chk_menu .dropdown-content a:hover {background-color: #4ba800;}

.chk_menu .dropdown:hover .dropdown-content {
  display: block;
}



</style>
<?php

$menu_list = array(
    array('link' => '../nindex.htm', 'name' => '˹����ѡ�.�.', 'access' => 'ADM|ADMNEWCHKUP'),
    array('link' => 'chk_company.php', 'name' => '�Ѵ�����ª��ͺ���ѷ', 'access' => 'ADM|ADMNEWCHKUP'),
    array(
        'link' => 'javascript:void(0)', 
        'name' => '����Ң�����', 
        'access' => 'ALL',
        'submenu' => array(
            array('link' => 'chk_import_user.php', 'name' => '����Ң����ž�鹰ҹ', 'access' => 'ADM|ADMNEWCHKUP'),
            array('link' => 'chk_lab_order.php', 'name' => '�����Order Lab', 'access' => 'ADM|ADMNEWCHKUP|ADMLAB'),
            array('link' => 'chk_lab_lis.php', 'name' => '��� LAB ��� LIS', 'access' => 'ADM|ADMNEWCHKUP|ADMLAB'),
        )
    ),
    array(
        'link' => 'javascript:void(0)', 
        'name' => 'ŧ����Ыѡ����ѵ�', 
        'access' => 'ALL',
        'submenu' => array( 
            array('link' => 'dt_emp_manual_index.php', 'name' => 'ŧ�ŵ�Ǩ ���.', 'access' => 'ADM|ADMNEWCHKUP', 'target' => '_blank'),
            array('link' => 'dx_ofyear_out.php', 'name' => '�ѡ����ѵ�(�Է�� ���.)', 'access' => 'ALL', 'target' => '_blank'),
            array('link' => 'cxr_out_result.php', 'name' => 'ŧ�� X-Ray �͡˹��� �Է�� ���.', 'access' => 'ADM|ADMNEWCHKUP|ADMXR')
        )
    ),
    array(
        'link' => 'javascript:void(0)', 
        'name' => '����', 
        'access' => 'ALL',
        'submenu' => array(
            array('link' => 'chk_sso.php', 'name' => '���� Walk-in ���.', 'access' => 'ALL'),
            array('link' => 'chk_test_hn.php', 'name' => '��Ǩ�ͺ��ª��ͨҡ HN', 'access' => 'ALL'),
            array('link' => 'chk_test_ipcard.php', 'name' => '��Ǩ�ͺ��ª��ͨҡ �Ţ�ѵû�ЪҪ�', 'access' => 'ALL'),
            array('link' => 'chk_report_cxr.php', 'name' => '�ټ� X-Ray �͡˹��� �Է�� ���.', 'access' => 'ADM|ADMNEWCHKUP|ADMXR')
        ),
    ),
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
    <h3>�к��Ѵ��â����� ��Ǩ�آ�Ҿ</h3>
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