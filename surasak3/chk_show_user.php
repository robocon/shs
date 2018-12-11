<?php

include 'bootstrap.php';

$page = input('page');
$db = Mysql::load();

if( $page == false ){
    include 'chk_menu.php';

    $part = input_get('part');

    $sql = "SELECT `name`,`code` FROM `chk_company_list` WHERE `code` = '$part'";
    $db->select($sql);
    $company = $db->get_item();

    $sql = "SELECT *, `HN` AS `hn`  
    FROM `opcardchk` 
    WHERE `part` = '$part' 
    ORDER BY `row`";
    $db->select($sql);
    $items = $db->get_items();
    $rows = $db->get_rows();
    if( $rows > 0 ){

        ?>
        <style>
            label{
                cursor: pointer;
            }
        </style>
        <h3>��ª��ͼ���Ǩ�آ�Ҿ - <?=$company['name'];?>(<?=$company['code'];?>)</h3>
        <form action="chk_show_user.php" method="post">
        <table class="chk_table">
            <tr>
                <th>���͡</th>
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
                    <td style="text-align: center;">
                        <input type="checkbox" name="ids[]" class="id" value="<?=$item['row'];?>">
                    </td>
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
            <tr>
                <td>
                    <label for="selected_all"><input type="checkbox" name="" id="selected_all"> ���͡������</label>
                </td>
                <td colspan="8" align="center">
                    <button type="submit">ź������������͡</button>
                    <input type="hidden" name="page" value="del_multiple">
                    <input type="hidden" name="part" value="<?=$part;?>">
                </td>
            </tr>
        </table>
        </form>
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

        <script src="js/vendor/jquery-1.11.2.min.js"></script>
        <script>
            jQuery.noConflict();
            (function( $ ) {
            $(function() {

                $(document).on('click', "#selected_all", function(){
                    $("input:checkbox").not(this).prop("checked", this.checked);
                });
                
            });
            })(jQuery);
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
    exit;
    
}elseif ( $page === 'del_multiple' ) {

    $items = $_POST['ids'];
    $part = input_post('part');
    foreach ($items as $key => $id) {
        
        $sql = "DELETE FROM `opcardchk` WHERE `row` = '$id' LIMIT 1";
        $delete = $db->delete($sql);

    }

    $msg = 'ź���������º����';
    if( $delete !== true ){
		$msg = errorMsg('delete', $delete['id']);
    }

    redirect('chk_show_user.php?part='.$part, $msg);

    exit;

}