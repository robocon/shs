<?php

include 'bootstrap.php';

$page = input('page');
$db = Mysql::load();

if( $page == false ){
    include 'chk_menu.php';

    $part = input_get('part');

    $sql = "SELECT `name` FROM `chk_company_list` WHERE `code` = '$part'";
    $db->select($sql);
    $company = $db->get_item();

    $sql = "SELECT *, `HN` AS `hn`  
    FROM `opcardchk` 
    WHERE `part` = '$part' ";
    $db->select($sql);
    $items = $db->get_items();
    $rows = $db->get_rows();
    if( $rows > 0 ){

        ?>
        <h3>��ª��ͼ���Ǩ�آ�Ҿ - <?=$company['name'];?></h3>
        <table class="chk_table">
            <tr>
                <th>#</th>
                <th>HN</th>
                <th>����ʡ��</th>
                <th>�Ţ�ѵû�ЪҪ�</th>
                <th>����</th>
                <th>��䢢����ž�鹰ҹ</th>
                <th>��䢼��Ż</th>
                <th>ź</th>
            </tr>
            <?php
            $i = 1;
            foreach ($items as $key => $item) {
                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$item['hn'];?></td>
                    <td><?=$item['name'];?> <?=$item['surname'];?></td>
                    <td><?=$item['idcard'];?></td>
                    <td><?=$item['agey'];?></td>
                    <td align="center"><a href="chk_user.php?page=form&id=<?=$item['row'];?>">���</a></td>
                    <td align="center"><a href="chk_lab.php?page=form&id=<?=$item['row'];?>">��Ѻ���Ż</a></td>
                    <td align="center"><a href="chk_show_user.php?page=del&id=<?=$item['row'];?>&part=<?=$item['part'];?>" onclick="return confirm_del()">ź</a></td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </table>
        <script type="text/javascript">
            function confirm_del(){
                var c = confirm('�س�׹�ѹ����ź������?'+"\n"+'�����ź����Ǩ��������ö���׹���������ա');
                var status = true;
                if( c === false ){
                    status = false;
                }
                return status;
            }
        </script>
        <?php

    }else{
        ?>
        <p>��辺�����Ź����</p>
        <?php
    }

}elseif ( $page === 'del' ) {

    $id = input_get('id');

    if( $id === false ){
        echo "��辺������";
        exit;
    }

    $part = input_get('part');
    
    $sql = "DELETE FROM `opcardchk` WHERE `row` = '$id' ";
    $delete = $db->delete($sql);

    $msg = 'ź���������º����';
    if( $delete !== true ){
		$msg = errorMsg('delete', $delete['id']);
    }

    redirect('chk_show_user.php?part='.$part, $msg);
    
}