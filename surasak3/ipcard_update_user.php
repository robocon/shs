<?php

include 'bootstrap.php';


?>
<div>
    <div>
        <h3>�к���䢢����ż������(��ǧ���ͺ)</h3>
    </div>
    <div>
        <form action="ipcard_update_user.php" method="post">
            <div>
                <label for="id_an">�Ţ��� AN : </label>
                <input type="text" name="id_an" id="id_an">
            </div>
            <div>
                <button type="submit">����</button>
                <input type="hidden" name="page" value="search_an">
            </div>
        </form>
    </div>
    
</div>
<?php

$page = input_post('page');
if( $action == 'search_an' ){

    $db = Mysql::load();
    $an = input_post('id_an');

    $sql = "SELECT * FROM `ipcard` WHERE `an` = '$an' AND `dcdate` = '0000-00-00 00:00:00' ";
    $db->select($sql);
    $user = $db->get_item();
    

    if( empty($user) ){
        echo "������ D/C ����º��������";
    }else {

        ?>
        <div>
            <form action="ipcard_update_user.php" method="post">
                <fieldset>
                    <legend>��������ǹ���</legend>
                    <div>
                        <label for="ptname">����ʡ�� : </label>
                        <input type="text" name="ptname" id="ptname" value="<?=$user['ptname'];?>">
                    </div>
                </fieldset>

                <fieldset>
                    <legend>�Է�ԡ���ѡ��</legend>
                    <div>
                        <label for="">������ : </label>
                        goup
                    </div>
                    <div>
                        <label for="">�ѧ�Ѵ : </label>
                        camp
                    </div>
                    <div>
                        <label for="ptright">�Է�ԡ���ѡ�� : </label>
                        <?php
                        $sql = "SELECT * FROM `ptright` ORDER BY `code` ASC";
                        $db->select($sql);
                        $ptright_items = $db->get_items();
                        ?>
                        <select name="ptright" id="ptright">
                            <?php
                            foreach ($ptright_items as $key => $item) { 

                                $codename = $item['code'].'&nbsp;'.$item['name'];
                                ?>
                                <option value="<?=$codename;?>"><?=$codename;?></option>
                                <?php
                            }
                            ?>
                        </select>
                        
                    </div>
                    
                </fieldset>


                
            </form>
        </div>
        <div style="color: red;">
            <b>���ͺ�к�</b> ͹حҵ��������੾�� ����-ʡ�� ��� �Է�ԡ���ѡ�� ��ҹ��
        </div>
        <?php 

        $db->close();
    }
}