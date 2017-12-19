<?php
include 'bootstrap.php';

$page = input('page');
$action = input_post('action');
$db = Mysql::load();

if ( $action == 'save' ) {
    
    $labcode = input_post('labcode');
    $detail = input_post('detail');
    $codex = input_post('codex');
    $depart = input_post('depart');
    $part = input_post('part');
    $price = input_post('price');
    $yprice = input_post('yprice');
    $nprice = input_post('nprice');
    $labtype = input_post('labtype');
    $outlab_name = '';
    if( $labtype == 'OUT' ){
        $outlab_name = input_post('outlab_name');
    }
    $olddetail = "($codex) $detail";
    $status = 'Y';

    $sql = "INSERT INTO `labcare` (
        `row_id`, `numbered`, `depart`, `part`, `code`, `codebak`, 
        `codex`, `detail`, `olddetail`, `icd9cm`, `unit`, `price`, 
        `yprice`, `nprice`, `note`, `oldcode`, `lablis`, `codelab`, 
        `outlab_name`, `labpart`, `labtype`, `labstatus`, `chkup`, `reportlabno`, 
        `lab_list`, `lab_listdetail`, `report_m`
    ) VALUES (
        NULL, '', '$depart', '$part', '$labcode', '$labcode', 
        '$codex', '$detail', '$olddetail', NULL, '', '$price', 
        '$yprice', '$nprice', '', '', NULL, '', 
        '$outlab_name', '', '$labtype', '$status', 'chk', '', 
        '', '', '');";
    $save = $db->insert($sql);

    $msg = '�ѹ�֡���������º����';
    if( $save !== true ){
		$msg = errorMsg('save', $save['id']);
    }
    redirect('chk_labcare.php', $msg);
    exit;
}

include 'chk_menu.php';

if ( empty($page) ) {
    
    $sql = "SELECT * FROM `labcare` WHERE `chkup` = 'chk' AND `lab_list` IS NULL ";
    $db->select($sql);

    $items = $db->get_items();
    ?>
    <div>
        <a href="chk_labcare.php?page=form">���ҧ����</a>
    </div>
    <div>
        <h3>�к��Ѵ�����¡�� Lab ����Ѻ��õ�Ǩ�آ�Ҿ</h3>
    </div>
    <div>
        <table class="chk_table">
            <tr>
                <th>#</th>
                <th>����Lab</th>
                <th>��������´</th>
                <th>�Ҥ�</th>
                <th>�ԡ��</th>
                <th>�ԡ�����</th>
                <th>������</th>
            </tr>
            <?php
            foreach ($items as $key => $item) {
                ?>
                <tr>
                    <td><?=dump($item);?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
    <?php
} elseif ( $page == 'form' ) {

    $part_list = array('Heamato','Chemistry','Micros','Micro','Serology','Outlab','Blood Bank');
    $outlab_list = array('�Ѱ���','�Թ����-�Ż','������-�Ż','���ʵ���-�Ż');
    $depart_list = array('DENTA','OTHER','PATHO','XRAY');
    ?>
    <div>
        <h3>������ѹ�֡</h3>
    </div>
    <div>
        <form action="chk_labcare.php" method="post">
            <div>
                ����Lab: <input type="text" name="labcode" id="">
            </div>
            <div>
                ��������´: <input type="text" name="detail" id="">
            </div>
            <div>
                ���ʡ���ѭ�ա�ҧ: <input type="text" name="codex" id="">
            </div>
            <div>
                Ἱ�: <select name="depart" id="">
                    <?php
                    foreach ($depart_list as $key => $depart_item) {
                        ?>
                        <option value="<?=$depart_item;?>"><?=$depart_item;?></option>
                        <?php
                    }
                    ?>
                    
                </select> 
            </div>
            <div>
                Part: <select name="part" id="">
                    <?php
                    foreach ($part_list as $key => $part_item) {
                        ?>
                        <option value="<?=$part_item;?>"><?=$part_item;?></option>
                        <?php
                    }
                    ?>
                    
                </select> 
            </div>
            <div>
                �Ҥ����: <input type="text" name="price" id=""> �ҷ
            </div>
            <div>
                �ԡ��: <input type="text" name="yprice" id=""> �ҷ
            </div>
            <div>
                �ԡ�����: <input type="text" name="nprice" id=""> �ҷ
            </div>
            <div>
                ������Lab: 
                <label for="labin" class="test_labin"><input type="radio" name="labtype" id="labin" value="IN"> �þ.</label> 
                <label for="labout" class="test_labout"><input type="radio" name="labtype" id="labout" value="OUT"> �͡þ.</label>
                <span style="display: none;" id="outlab_list">
                    <select name="outlab_name" id="">
                        <?php
                        foreach ($outlab_list as $key => $outlab_item) {
                            ?>
                            <option value="<?=$outlab_item;?>"><?=$outlab_item;?></option>
                            <?php
                        }
                        ?>
                    </select>
                </span>
            </div>
            <div>
                <button type="submit">�ѹ�֡������</button>
                <input type="hidden" name="action" value="save">
            </div>
        </form>
    </div>
    <div><a href="labcareedit1.php" target="_blank">������ҧ��¡���Ѷ�����ͧ LAB</a></div>
    <script src="js/vendor/jquery-1.11.2.min.js"></script>
    <script>
        
        $(function(){

            $(document).on('click', '.test_labout', function(){
                $('#outlab_list').show();
            });

            $(document).on('click', '.test_labin', function(){
                $('#outlab_list').hide();
            });

        });

    </script>
    <?php
}