<?php 

include 'bootstrap.php';

$action = input('action');
$db = Mysql::load();
// $db = Mysql::load();

include 'chk_menu.php';
    ?>
    <h3>���� ����-ʡ�� �ҡ�Ţ�ѵû�ЪҪ�</h3>
    <form action="chk_test_ipcard.php" method="post" enctype="multipart/form-data">
        <div>
            ������� : <input type="file" name="file">
        </div>
        <div>
            <p><b>������ҧ �ٻẺ��èѴ��� Excel</b></p>
            <table class="chk_table">
                <tr>
                    <td>�Ţ�ѵû�ЪҪ�</td>
                    <td>����</td>
                    <td>ʡ��</td>
                </tr>
            </table>
        </div>
        <div>
            <button type="submit">��Ǩ�ͺ����Ţ�ѵ�</button>
            <input type="hidden" name="action" value="test">
        </div>
    </form>
    <?php 


if( $action == false ){ 
    
}elseif ( $action == 'test' ) {
    
    $file = $_FILES['file'];
    $content = file_get_contents($file['tmp_name']);

    if( $content !== false ){
        $items = explode("\r\n", $content);
        
        ?>
        <style>
        .chk_table{
            border-collapse: collapse;
        }
        .chk_table th, 
        .chk_table td{
            border: 1px solid black;
            padding: 3px;
        }
        </style>
        <table class="chk_table">
            <tr>
                <th rowspan="2">#</th>
                <th colspan="3">�����ŷ���Ǩ�ͺ</th>
                <th colspan="4">�����Ũҡ�ҹ������</th>
            </tr>
            <tr>
                <th>�Ţ�ѵû�ЪҪ�</th>
                <th>����</th>
                <th>ʡ��</th>
                <th>�Ţ�ѵû�ЪҪ�</th>
                <th>�ӹ�˹��</th>
                <th>����</th>
                <th>ʡ��</th>
                <th>HN</th>
            </tr>
        <?php

        $i = 0;
        foreach ( $items as $key => $item ) {

            list($idcard, $name, $surname) = explode(',', $item,3);

            if( !empty($idcard) ){

                ++$i;
            
                $sql = "SELECT `hn`,`yot`,`name`,`surname`,CONCAT(`yot`,`name`,' ',`surname`) AS `ptname`, `idcard`,`sex` 
                FROM `opcard` 
                WHERE `idcard` = '$idcard' ";
                $db->select($sql);
                $user = $db->get_item();
                
                $color = '';

                if( $name != $user['name'] ){
                    $color = 'style="background-color: yellow;"';
                }

                if( $surname != $user['surname'] ){
                    $color = 'style="background-color: yellow;"';
                }

                ?>
                <tr <?=$color;?>>
                    <td><?=$i;?></td>
                    <td><?=$idcard;?></td>
                    <td><?=$name;?></td>
                    <td><?=$surname;?></td>
                    <td><?=$user['idcard'];?></td>
                    <td><?=$user['yot'];?></td>
                    <td><?=$user['name'];?></td>
                    <td><?=$user['surname'];?></td>
                    <td><?=$user['hn'];?></td>
                </tr>
                <?php
            }

        }
        ?>
        </table>
        <?php
    }
}