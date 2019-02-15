<?php 

include 'bootstrap.php'; 
$db = Mysql::load();
$db->set_charset('TIS620');


$action = input('action');

if ( $action == 'save' ) {

    $xray = input_post('xray');
    $xray2 = input_post('xray2');
    $code = $_POST['code'];
    $labextra = input_post('labextra');
    $id = input_post('id');
    $hn = input_post('hn');
    $officer = $_SESSION['sOfficer'];
    $lab_old = input_post('lab_old');
    $xray_old = input_post('xray_old');
    $officer_old = input_post('officer_old');
    $labextra_old = input_post('labextra_old');

    $detail2 = input_post('detail2');

    $where_detail2 = '';
    if( $detail2 != false ){
        $where_detail2 = ", `detail2` = '$detail2' ";
    }

    $appoint_lab = array();
    foreach ($code as $key => $item) {
        $appoint_lab[] = $item;
    }
    $appoint_lab_txt = implode(',', $appoint_lab);

    $xray_txt = $xray.( $xray2 != false ? ','.$xray2 : false );


    $sql = "UPDATE `appoint` SET 
        `patho`='$appoint_lab_txt', 
        `xray`='$xray_txt', 
        `labextra`='$labextra' 
        $where_detail2
        WHERE (`row_id`='$id');";
    $db->update($sql);

    $sql = "DELETE FROM `appoint_lab` WHERE `id` = '$id' ";
    $db->delete($sql);

    foreach ($code as $key => $item) {
        $sql = "INSERT INTO `appoint_lab` (`row_id`, `id`, `code`) VALUES (NULL, '$id', '$item');";
        $db->insert($sql);
    }

    $sql = "INSERT INTO `log_appoint` (
        `id`, `date`, `hn`, `lab_old`, `lab`, 
        `labextra`, `labextra_old`, `xray`, `xray_old`, `office`, `officer_old`
    ) VALUES (
        NULL, NOW(), '$hn', '$lab_old', '$appoint_lab_txt', 
        '$labextra', '$labextra_old', '$xray_txt', '$xray_old', '$officer', '$officer_old'
    );";
    $db->insert($sql);

    header('Location: appoint_edit.php?action=print&id='.$id);
    exit;

}else if( $action == 'print' ){

    $id = input_get('id');

    echo "<p>�ѹ�֡���������º����</p>";
    echo '<p><a href="appinsert2.php?row_id='.$id.'" target="_blank">�����㺹Ѵ</a></p>';
    echo '<p><a href="appoint_edit.php">��Ѻ˹�����</a></p>';
    exit;

}

?>

<style>
/* ���ҧ */
body, button{
    font-family: TH Sarabun NEW, TH SarabunPSK;
    font-size: 16pt;
}
.chk_table{
    border-collapse: collapse;
}

.chk_table th,
.chk_table td{
    padding: 3px;
    border: 1px solid black;
    font-size: 16pt;
}
</style>

<div>
    <a href="../nindex.htm">&lt;&lt;&nbsp;������ѡ �.�.</a>
</div>

<h3>�к���� LAB, X-RAY �����¹Ѵ(��ǧ���ͺ)</h3>
<?php 
if( isset($_SESSION['msg']) ){
    ?><div style="border: 1px solid #bfbf00;padding: 4px;background-color: #ffffbc;display: table;width: 50%;"><?=$_SESSION['msg'];?></div><?php
    $_SESSION['msg'] = NULL;
}
?>
<form action="appoint_edit.php" method="post">
    <fieldset style="width: 200px;">
        <legend>���ҵ�� HN</legend>
        <div>
            HN: <input type="text" name="hn" id="hn">
        </div>
        <div>
            <button type="submit">����</button>
            <input type="hidden" name="page" value="search">
        </div>
    </fieldset>
</form>
<?php 

$page = input('page');

if ( $page == 'search' ) {
    
    $hn = input_post('hn');
    $sql = "SELECT * FROM `appoint` WHERE `hn` = '$hn' ORDER BY `row_id` DESC ";
    $db->select($sql);
    $rows = $db->get_rows();

    if ( $rows > 0 ) {
        $items = $db->get_items();

        ?>
        <table class="chk_table">
            <tr>
                <th>�ѹ���ŧ������</th>
                <th>�Ѵ�ҵ�Ǩ�ѹ���</th>
                <th>���ҷ��Ѵ��Ǩ</th>
                <th>�Ѵ������</th>
                <th>ᾷ��</th>
                <th></th>
            </tr>
            <?php 
            foreach ($items as $key => $item) {
                ?>
                <tr>
                    <td><?=$item['date'];?></td>
                    <td><?=$item['appdate'];?></td>
                    <td><?=$item['apptime'];?></td>
                    <td><?=$item['detail'];?></td>
                    <td><?=$item['doctor'];?></td>
                    <td><a href="appoint_edit.php?page=form&id=<?=$item['row_id'];?>">���</a></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }else{
        ?>
        <p><b>��辺������</b></p>
        <?php
    }

}elseif ( $page == 'form' ) {
    
    $id = input_get('id');

    $sql = "SELECT * FROM `appoint` WHERE `row_id` = '$id' ";
    $db->select($sql);
    $rows = $db->get_rows();

    if( $rows > 0 ){

        $item = $db->get_item();

        $sql = "SELECT a.*, b.`detail`
        FROM `appoint_lab` AS a 
        LEFT JOIN `labcare` AS b ON b.`code` = a.`code` 
        WHERE a.`id` = '$id'";
        $db->select($sql);

        $row_lab = $db->get_rows();
        // 

        ?>
        <style>
        .lab_container{
            display: none;
            position: absolute;
            top: 260px;
            left: 140px;
            background-color: #ffffff;
            border: 1px solid red;
            padding: 4px;
            width: 600px;
        }
        .btn-close-lab:hover{
            cursor: pointer;
            text-decoration: underline;
        }
        </style>

        <fieldset>
            <legend>�������䢢�����</legend>

            <form action="appoint_edit.php" method="post">
                <div>
                    <b>����-ʡ��:</b> <?=$item['ptname'];?> <b>HN:</b> <?=$item['hn'];?> ���� <?=$item['age'];?> <br>
                    <b>ᾷ��:</b> <?=$item['doctor'];?> <b>�Ѵ�ҵ�Ǩ�ѹ���:</b> <?=$item['appdate'];?> ���� <?=$item['apptime'];?>
                </div>

                <?php 
                
                $xray_lists = array(
                    'NA' => '����ա���͡�����',
                    'CXR' => 'CXR',
                    'KUB' => 'KUB',
                    '�͡����� ��͹��ᾷ��' => '�͡����� ��͹��ᾷ��',
                    '��ŵ�ҫ�ǹ��' => '��ŵ�ҫ�ǹ��',
                    '��Ǩ IVP' => '��Ǩ IVP'
                );

                // �ó��� , �¡ xray 
                $item_xray = trim($item['xray']);
                $xray1 = $xray2 = false;

                if( strpos($item_xray, ',') !== false ){ 

                    list($xray1, $xray2) = explode(',', $item_xray,2);

                }elseif( strpos($item_xray, ' ') !== false ){

                    list($xray1, $xray2) = explode(' ', $item_xray,2);
                    
                }else{

                    $xray1 = $item_xray;
                    
                }

                if( $xray1 == '�����' ){
                    $xray1 = 'NA';
                }

                if( $item['detail'] == 'FU02 ����ŵ�Ǩ' ){
                    ?>
                    <div>
                        �Ѵ������ : ����ŵ�Ǩ <input type="text" name="detail2" value="<?=$item['detail2'];?>" style="width: 250px;">
                    </div>
                    <?php
                }
                ?>
                
                <div>
                    �͡�����: <select name="xray" id="">
                        <option value="">-- ���͡����͡����� --</option>
                    <?php 
                    // Test ��͹���� xray1 �� false �ֻ��� ���������ʴ����ǹ�ͧ xray 2
                    $test_match = false;
                    foreach ($xray_lists as $key => $xray) { 

                        $selected = '';
                        if( $key == $xray1 ){
                            $selected = 'selected="selected"';
                            $test_match = true;
                        }
                        ?>
                        <option value="<?=$key;?>" <?=$selected;?> ><?=$xray;?></option>
                        <?php
                    }
                    ?>
                    </select> 
                    <?php 
                    if( $test_match === false ){
                        $xray2 = $xray1.( $xray2 != false ? $xray2 : false );
                    }
                    ?>
                    <input type="text" name="xray2" id="" value="<?=$xray2;?>" style="width: 200px;"> <span style="font-size: 14pt;color: red;">* �ҡ���ҡ���� 1��¡������� Comma(,) 㹡������¡�õ�Ǩ �� CXR,KUB �繵�</span>
                </div>

                <fieldset>
                    <legend>��¡�� LAB</legend>
                    <div>
                        <button class="table_lab">������¡�� LAB</button>
                    </div>
                    <div id="list_patho">
                        <?php
                        if ( $row_lab > 0 ) { 

                            $lab_items = $db->get_items();
                            foreach ($lab_items as $key => $lab) {
                                ?>
                                <div>
                                    <?=$lab['detail'];?> <a href="javascript:void(0);" class="del_item">[ ź ]</a>
                                    <input type="hidden" name="code[]" value="<?=$lab['code'];?>">
                                </div>
                                <?php
                            }

                        }
                        ?>
                    </div>
                    ������ʹ������� <input type="text" name="labextra" id="" value="<?=$item['labextra'];?>">
                </fieldset>

                <div>
                    <button type="submit">�ѹ�֡������</button>
                    <input type="hidden" name="action" value="save">
                    <input type="hidden" name="id" value="<?=$item['row_id'];?>">
                    <input type="hidden" name="hn" value="<?=$item['hn'];?>">
                    <input type="hidden" name="lab_old" value="<?=$item['patho'];?>">
                    <input type="hidden" name="xray_old" value="<?=$item_xray;?>">
                    <input type="hidden" name="officer_old" value="<?=$item['officer'];?>">
                    <input type="hidden" name="labextra_old" value="<?=$item['labextra'];?>">
                </div>

            </form>

        </fieldset>

        <div class="lab_container">
            <div style="position: absolute; top: 0; right: 0;" class="btn-close-lab">[ �Դ ]</div>
            <p style="text-align: center; "><b>��¡�õ�Ǩ�ҧ��Ҹ�</b></p>
            <?php
            $db->select("SELECT * FROM `labcare` WHERE `lab_list` !=0 ORDER BY `lab_list` ASC");
            $labcare_list = $db->get_items();
            ?>
            <table class="chk_table" width="100%">
                <tr>
                    <?php 
                    // ���� 5
                    $i = 0;
                    foreach ($labcare_list as $key => $result2) {

                        ++$i;
                        ?>
                        <td>
                            <a href="javascript: void(0);" title="<?=$result2['detail']?>" data-detail="<?=$result2['detail']?>" data-code="<?=$result2['code']?>" class="lab_add"><?=$result2['lab_listdetail']?></a>
                        </td>
                        <?php

                        if( $i % 5 == 0 ){
                            ?></tr><tr><?php
                            $i = 0;

                        }
                    }
                    ?>
                    
                </tr>
            </table>
        </div>

        <script src="js/vendor/jquery-1.11.2.min.js" type="text/javascript"></script>
        <script type="text/javascript">

            // button �Դ-�Դ
            $(document).on('click', '.table_lab', function(){
                $('.lab_container').toggle();
                return false;
            });

            // �����Դ manual
            $(document).on('click', '.btn-close-lab', function(){
                $('.lab_container').hide();
            });

            // ��������㹿����
            $(document).on('click', '.lab_add', function(){
                var code = $(this).attr('data-code');
                var detail = $(this).attr('data-detail');
                
                var htm = '<div>'+detail+' <a href="javascript:void(0);" class="del_item">[ ź ]</a> <input type="hidden" name="code[]" value="'+code+'"></div>';
                
                $('#list_patho').append(htm);
            });

            // ź�͡�ҡ�����
            $(document).on('click', '.del_item', function(){
                var c = confirm('�׹�ѹź��¡�� LAB?');
                if( c == true ){
                    $(this).parent().remove();
                }
            });
            
        </script>

        <?php

    }else {
        ?>
        <p><b>��辺������</b></p>
        <?php
    }

}