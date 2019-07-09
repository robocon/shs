<?php

include 'bootstrap.php';
$db = Mysql::load();

$task = input('task');
if ( $task == 'edit' ) {

    $id = input_post('id');
    
    $sql = "DELETE FROM `chk_cxr` WHERE `id` = '$id' LIMIT 1 ";
    // dump($sql);
    $del = $db->delete($sql);
    // dump($sql);
    $status = 1;
    if( $del !== true ){
        $status = 0;
    }

    echo $status;
    exit;
}

include 'chk_menu.php';

?>
<form action="cxr_edit_result.php" method="post" enctype="multipart/form-data">
    <div>
        <fieldset style="padding: 20px;">
            <div>
            <?php 
                $db->select("SELECT `name`,`code` FROM `chk_company_list` WHERE `status` = '1' ORDER BY `id` DESC");
                $items = $db->get_items();
                ?>
                ���͡����ѷ������䢢����� : 
                <select name="part" id="">
                    <option value="">-- ��ª��ͺ���ѷ --</option>
                    <?php
                    foreach ($items as $key => $item) {
                        ?><option value="<?=$item['code'];?>"><?=$item['name'].' ('.$item['code'].')';?></option><?php
                    }
                    ?>
                </select>
            </div>
            <div>
                <button type="submit">�ѹ�֡������</button>
                <input type="hidden" name="page" value="show">
            </div>
        </fieldset>
    </div>
</form>
<?php

$page = input_post('page');
if ( $page == 'show' ) {

    $part = input_post('part');
    $sql = "SELECT * FROM `chk_cxr` WHERE `part` = '$part' ";
    $db->select($sql);
    $items = $db->get_items();

    ?>
    <h3>�š�õ�Ǩ�ѧ�պ���ѷ <?=$company['name'];?></h3>
    <table class="chk_table">
        <thead>
            <tr>
                <th>�ӴѺ</th>
                <th>HN</th>
                <th>����ʡ��</th>
                <th>�š�õ�Ǩ</th>
                <th>��������´</th>
                <th>���</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i = 1;
            foreach ($items as $key => $value) {
            ?>
            <tr class="item_row<?=$value['id'];?>">
                <td><?=$i;?></td>
                <td><?=$value['hn'];?></td>
                <td><?=$value['ptname'];?></td>
                <td><?=$value['cxr'];?></td>
                <td><?=$value['detail'];?></td>
                <td>
                    <a href="javascript:void(0);" onclick="javascript:alert('��ǧ���ͺ������');">���</a> | <a href="javascript:void(0);" class="del_item" data-id="<?=$value['id'];?>">ź</a>
                </td>
            </tr>
            <?php 
                $i++;
            }
            ?>
        </tbody>
    </table>
    <script src="js/vendor/jquery-1.11.2.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery.noConflict();
        (function( $ ) {
            $(function() {
                
                $(document).on('click', '.del_item', function(){
                    var c=confirm('�׹�ѹ���ź������?');
                    if( c === true ){

                        var id = $(this).attr('data-id');

                        $.ajax({
                            method: "POST",
                            url: "cxr_edit_result.php",
                            data: { 'task': 'edit','id': id},
                            success: function(response){

                                if( response == 1 ){
                                    alert('���Թ������º����');
                                    $('.del_item').parents('.item_row'+id).remove();
                                }else if( response == 0 ){
                                    alert('�������ö���Թ�����');
                                }

                            }
                        });
                        
                    }
                });
                

            });
        })(jQuery);
    </script>
    <?php
}