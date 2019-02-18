<?php 

include 'bootstrap.php';

$action = input_post('action');
if( $action == 'save' ){

    INSERT INTO `smdb`.`policy` (`id`, `hospcode`, `policy_id`, `policy_year`, `policy_data`, `d_update`) VALUES (NULL, NULL, NULL, NULL, NULL, NULL);

    HOSPCODE | POLICY_ID | POLICY_YEAR | POLICY_DATA | D_UPDATE
11111 | 001 | 2017 | {'HOSPCODE' : '11111', 'PID' : '999999','BDATE' :'20170701', 'HC' : 35.0} | 20170820200000

    exit;
}

?>

<fieldset>
    <legend>���ҵ�� HN</legend>
    <form method="post" action="policy.php">

        <div>
            HN: <input type="text" name="hn" id="">
        </div>
        <div>
            <button type="submit">��ŧ</button>
            <input type="hidden" name="page" value="search">
        </div>
    </form> 
</fieldset>

<?php

$page = input('page');

if ( empty($page) ) { 

    $db = Mysql::load();
    $hn = input_post('hn');
    $sql = "SELECT * FROM `opday` WHERE `hn` = '$hn' ORDER BY `thidate` DESC";
    $db->select($sql);

    $items = $db->get_items();
    ?>
    <div>
        <div>�����š�����ç��Һ��</div>
        <table>
            <tr>
                <th>�ѹ���</th>
                <th>HN</th>
                <th>VN</th>
                <th>����-ʡ���</th>
                <th>ᾷ��</th>
                <th>�ѹ�֡</th>
            </tr>
            <?php 
            foreach ($items as $key => $item) {
                ?>
                <tr>
                    <td><?=$item['thidate'];?></td>
                    <td><?=$item['hn'];?></td>
                    <td><?=$item['vn'];?></td>
                    <td><?=$item['ptname'];?></td>
                    <td><?=$item['doctor'];?></td>
                    <td><a href="policy.php?page=form&id=<?=$item['row_id'];?>">ŧ������</a></td>
                </tr>
                <?php
            }
            ?>
            
        </table>
    </div>
    
    <?php
}elseif ( $page == 'form' ) {

    $id = input_get('id');

    $sql = "SELECT * FROM `opday` WHERE `row_id` = '$id'";
    $db->select($sql);

    $item = $db->get_item();

    ?>
    <div>
        <form action="policy.php" method="post">
            <div>
                �ͺ�������: <input type="text" name="hc" id="">
            </div>

            <div>
                <button type="submit">�ѹ�֡</button>
                <input type="hidden" name="id" value="<?=$item['row_id'];?>">
                <input type="hidden" name="action" value="save">
            </div>
        </form>
    </div>
    <?php

}

?>

